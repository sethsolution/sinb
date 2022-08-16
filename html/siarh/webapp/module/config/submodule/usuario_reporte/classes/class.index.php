<?php

/**
 * Index
 * 
 * @package gadc
 * @author seeyourweb
 * @copyright 2012
 * @version $Id$
 * @access public
 */
class Index extends Table {
     var $objExcel;
     var $table01;
    var $table02;
    var $table03;
    var $table04;
    var $table05;
  function __construct(){ 
     global $CFG,$module,$smoduleName;
       $smoduleTableName = "item";
       $this->pref = $CFGm->prefix;
       $this->tableName = $this->pref.$smoduleTableName;
     $this->idName = "itemId";
       
       $this->userId = $_SESSION["userv"]["memberId"];
       
       $this->table01 = "vrhr_territorio.";
       $this->table02 = "vrhr_catalogo.";
       $this->table03 = "vrhr_snir.";
       $this->table04 = "vrhr_cuenca.";
       $this->table05 = "vrhr_presa.";
    }
    
    function getSummary($sql, $condicionales){
      global $dbm;
      $dbm->SetFetchMode(ADODB_FETCH_ASSOC);
      
      $sql2 = "SELECT ".$condicionales['tipo'].", SUM(i2.arRegableAnual) as totalArea,
                      SUM(i2.totalFam) as totalFamilia,
                      COUNT(i2.itemId) as totalFicha
                FROM (".$sql.") as i2 ".$condicionales['grupo'];//echo $sql2;
      $info = $dbm->Execute($sql2);
      $info = $info->GetRows();
      
      return $info;  
    }

    function getList($tipo, $departamentoId,$reporte=1){
        $where = false;
        $sql = "SELECT  i.itemId,  i.fechaLlenado, i.nombre, i.alcanceId,d.nombre as departamentoName, i.departamentoId,
                i.provinciaId,m.nombre as municipioName, i.municipioId , i.arRegableAnual, a.nombre as zonaNombre,i.agroecologicaId,/* SUM(pi.noFamilias) as familiaBeneficiada,*/
                (SELECT SUM(p.noFamilias) 
                       FROM item_poblaciontenencia p 
                       WHERE p.fichaId=i.itemId ) as totalFam   
                FROM vrhr_inventario.item as i 
                LEFT JOIN catalogo_alcance cc ON cc.itemId=i.alcanceId
                LEFT JOIN vrhr_territorio.departamento AS d ON d.itemId=i.departamentoId
                LEFT JOIN vrhr_territorio.provincia AS p ON p.itemId=i.provinciaId
                LEFT JOIN vrhr_territorio.municipio AS m ON m.itemId=i.municipioId
                LEFT JOIN vrhr_catalogo.agroecologica AS a ON a.itemId=i.agroecologicaId 
                LEFT JOIN item_poblaciontenencia as pi ON pi.fichaId = i.itemId";
        if ($tipo!=3 && $departamentoId!=0){
            $sql .= " WHERE i.departamentoId=".$departamentoId;
            $where = true;
            if ($reporte == 0){
              $condicionales["tipo"] = "i2.municipioName as Nombre";
              $condicionales["grupo"] = "group by i2.municipioId";
            }else{
              $condicionales["tipo"] = "i2.zonaNombre as Nombre";
              $condicionales["grupo"] = "group by i2.agroecologicaId";              
            }
        }else if($tipo!=3 && $departamentoId==0){
          if($reporte == 0){
            $condicionales["tipo"] = "i2.departamentoName as Nombre";
            $condicionales["grupo"] = "group by i2.departamentoId";
          }else{
              $condicionales["tipo"] = "i2.zonaNombre as Nombre";
              $condicionales["grupo"] = "group by i2.agroecologicaId";              
            }
        }
        switch ($tipo) {
            case 1:
                $res = $this->getSummary($sql,$condicionales);
                break;
            case 2:
                $rec = array("Mic", "Peq", "Med", "Gra");
                $min = array(1.99,10,100,500);
                $max = array(10,100,500,null);
                $i = 0;
                foreach($rec as $r){
                  if ($where)
                    $sql1 = $sql." AND ";
                  else
                    $sql1 = $sql." WHERE ";
                  $sql1 .= " (i.arRegableAnual>".$min[$i];
                  $sql1 .= ($max[$i]!=null?" AND i.arRegableAnual<=".$max[$i]:"").")";

                  $r = $this->getSummary($sql1,$condicionales);
                  $res[$rec[$i]]=$r;
                  $i++;
                }
                $res = $this->agruparArray($res);
                break;
            case 3:
              $condicionales["tipo"] = "i2.alcanceId";
              $condicionales["grupo"] = "group by i2.alcanceId";
              $rec = array("Nuevo","Mejorado","Rehabilitado",utf8_decode("Rústico"));
              if ($departamentoId !=0){
                $add= " AND i.departamentoId=".$departamentoId;
              }
              $valores = array(4,1,3,2);
              $i=0;
              foreach ($rec as $r){
                $sql1= $sql." WHERE alcanceId=".$valores[$i].$add;
                $r = $this->getSummary($sql1,$condicionales);
                $r[0]["Nombre"] = $rec[$i];
                $res[] = $r[0];
                $i++;
              }
              break;

        }
        return $res;
    }

    function getListFuente($departamentoId){
      $departamentoId = 0;
      global $dbm;
      $dbm->SetFetchMode(ADODB_FETCH_ASSOC);
      $datos = array(1=>"Rios",
                2=>"Vertientes",
                8=>"Subterranea",
                4=>"Embalse",
                5=>"Quebrada",
                9=>"Deshielo",
                7=>"Reuso");

      $sql = " count(i.itemId) as totalActivo";

      foreach ($datos as $id => $nombre) {
        $sql.=",SUM(if(w.tipoFuenteId = $id, 1, 0)) as $nombre,
                SUM(if(w.tipoFuenteId = $id, ifnull(i.arRegableAnual,0),0)) as ".$nombre."Area,
                SUM(if(w.tipoFuenteId = $id, ifnull(w.volumen,0), 0)) as ".$nombre."Volumen
                ";
      }
      $sqlFrom= " FROM item i 
                  LEFT JOIN item_fuenteagua w on w.fichaId=i.itemId
                  LEFT JOIN vrhr_territorio.municipio AS m ON m.itemId=i.municipioId
                  LEFT JOIN vrhr_territorio.departamento AS d ON d.itemId=i.departamentoId";
      $sqlWhere = " WHERE w.principal=1 and i.arRegableAnual>=0 ";
      if ($departamentoId != 0){
        $sql = "SELECT m.nombre,".$sql;
        $sqlWhere .= " and i.departamentoId = $departamentoId ";
        $sqlGroup = " group by i.municipioId ";
      }else{
        $sql = "SELECT d.nombre,".$sql;
        $sqlGroup = " group by d.itemId ";
      }
      $sql .= $sqlFrom.$sqlWhere.$sqlGroup;

    }

    function agruparArray($res){
        $rec = array("Mic", "Peq", "Med", "Gra");
        $resp = array();
        $i=0;
        foreach($res as $r){
          foreach($r as $r2){
            //$resp[] = 
            $resp[utf8_encode($r2["Nombre"])]["Nombre"] = utf8_encode($r2["Nombre"]);
            $resp[utf8_encode($r2["Nombre"])]["totalArea".$rec[$i]] = $r2["totalArea"];
            $resp[utf8_encode($r2["Nombre"])]["totalFamilia".$rec[$i]] = $r2["totalFamilia"];
            $resp[utf8_encode($r2["Nombre"])]["totalFicha".$rec[$i]] = $r2["totalFicha"];
          }
          $i++;
        }
        return $resp;
    }
}

