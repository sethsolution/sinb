<?php
class Index extends Table {

	function __construct(){
	   global $CFG,$module,$smoduleName;
       $smoduleTableName = "organigrama";
       $this->pref = $CFG->prefix;
       $this->tableName = $this->pref.$smoduleTableName;
	   $this->idName = "itemId";
       
       $smoduleConteTableName = "item_gestion";
       $this->conteTableName = $this->pref.$smoduleConteTableName;
	   $this->conteIdName = "itemId";
       
       $this->userId = $_SESSION["userv"]["memberId"]; 
       $this->catalogosEspeciales = array(1=>"vrhr_catalogo.agroecologica" //Tengo
                                ,2=>"vrhr_catalogo.cultivo" //Tengo
                                ,3=>"vrhr_catalogo.cultivo_tipo" // Tengo
                                ,4=>"vrhr_cuenca.nivel5" //Tengo
                                ,5=>"vrhr_territorio.municipio" //Tengo
                                ,6=>"vrhr_territorio.provincia"
                                ,7=>"vrhr_proyecto.catalogo_unidad"); //Tengo
	}

    function getDataConfig($catalogo="vacio"){
        $res = array (1=>"nombre");
        $caso = array_search($catalogo,$this->catalogosEspeciales);
        if ($caso != null){
            switch ($caso){
                case 1:
                    $res[2] = "code";
                    break;
                case 2:
                    $res[2] = "codigo";
                    $res[3] = "tipoId";
                    break;
                case 3:
                    $res[2] = "abreviatura";
                    break;
                case 4:
                    $res[2] = "nivel1";
                    $res[3] = "nivel2";
                    $res[4] = "nivel3";
                    $res[5] = "nivel4";
                    $res[6] = "nivel5";
                    break;
                case 5:
                    $res[2] = "provinciaId";
                    $res[3] = "regionId";
                    break;
                case 6:
                    $res[2] = "departamentoId";
                    break;   
                case 7:
                    $res[2] = "componenteId";
                    break;             
            }
        }
        return $res;
    }
    
    function getDataConfigDescripcion($catalogo="vacio"){
        $res = array (1=>"Nombre");
        $caso = array_search($catalogo,$this->catalogosEspeciales);
        if ($caso != null){
            switch ($caso){
                case 1:
                    $res[2] = "Code";
                    break;
                case 2:
                    $res[2] = "Codigo";
                    $res[3] = "Tipo de Cultivo";
                    break;
                case 3:
                    $res[2] = "Abreviatura";
                    break;
                case 4:
                    $res[2] = "Nivel 1";
                    $res[3] = "Nivel 2";
                    $res[4] = "Nivel 3";
                    $res[5] = "Nivel 4";
                    $res[6] = "Nivel 5";
                    break;
                case 5:
                    $res[2] = "Provincia";
                    $res[3] = "Region";
                    break;
                case 6:
                    $res[2] = "Departamento";
                    break;
                case 7:
                    $res[2] = "Componente";
                    break;
            }
        }
        return $res;
    }

    function getDataConfigTipo($catalogo="vacio"){
        $res = array (1=>"text");
        $caso = array_search($catalogo,$this->catalogosEspeciales);
        if ($caso != null){
            switch ($caso){
                case 1:
                    $res[2] = "number";
                    break;
                case 2:
                    $res[2] = "number";
                    $res[3] = "select";
                    break;
                case 3:
                    $res[2] = "text";
                    break;
                case 4:
                    $res[2] = "number";
                    $res[3] = "number";
                    $res[4] = "number";
                    $res[5] = "number";
                    $res[6] = "number";
                    break;
                case 5:
                    $res[2] = "select";
                    $res[3] = "select";
                    break;
                case 6:
                    $res[2] = "select";
                    break;
                case 7:
                    $res[2] = "select";
                    break;
            }
        }
        return $res;
    }
    
    function saveItemGestion($rec){
        global $db, $CFG,$privFace;
        $db->SetFetchMode(ADODB_FETCH_ASSOC);
        $tablaNombre = "gadc_gestion_estadistico";
        $res = array();
        if($privFace["crear"]){ 
            $rec["itemId"] = $rec["nombre"];
            $rec["descripcion"] = "Gesti�n ".$rec["itemId"];
            unset($rec["nombre"]);
            $filtro = "";
            $filtro .= ' itemId="'.$rec["itemId"].'"';                
            $axuId = $this->verificarRegistro($filtro, $tablaNombre);
            if($axuId==0){//Ingresamos nuevo dato  
                $rec["dateCreate"] = $rec["dateUpdate"] = date("Y-m-d H:i:s");
                $rec["userCreate"] = $rec["userUpdate"] = $this->userId;
                $ressave = $db->AutoExecute($tablaNombre,$rec);
                if($ressave){
                    $res["res"] = 1;
                }else{
                    $res["res"] = 2;
                    $res["msg"] = utf8_encode("No se logr� almacenar en la B.D.");
                    $res["msgdb"] = utf8_encode($db->ErrorMsg());
                }
            }else{//Actualizmos dato                   
                $res["res"] = 2;
                $res["msg"] = utf8_encode("Se econtro un dato con el mismo nombre, no se realizo ninguna acci�n");
            } 
        }else{
            $res["res"] = 2;
            $res["msg"] = utf8_encode("No tiene los permisos necesarios para realizar esta operaci�n");
        }
        return $res;
    }
    
    function saveItem($rec, $tabla){
        global $db, $CFG,$privFace;
        $db->SetFetchMode(ADODB_FETCH_ASSOC);
        $tablaNombre = $tabla;
        $res = array();
        if($privFace["crear"]){ 
            $filtro = "";
            $filtro .= ' nombre="'.$rec["nombre"].'"';                
            $axuId = $this->verificarRegistro($filtro, $tablaNombre);
            if($axuId==0){//Ingresamos nuevo dato  
                $rec["dateCreate"] = $rec["dateUpdate"] = date("Y-m-d H:i:s");
                $rec["userCreate"] = $rec["userUpdate"] = $this->userId;
                $ressave = $db->AutoExecute($tablaNombre,$rec);
                if($ressave){
                    $res["res"] = 1;
                }else{
                    $res["res"] = 2;
                    $res["msg"] = utf8_encode("No se logr� almacenar en la B.D.");
                    $res["msgdb"] = utf8_encode($db->ErrorMsg());
                }
            }else{//Actualizmos dato                   
                $res["res"] = 2;
                $res["msg"] = utf8_encode("Se econtro un dato con el mismo nombre, no se realizo ninguna acci�n");
            } 
        }else{
            $res["res"] = 2;
            $res["msg"] = utf8_encode("No tiene los permisos necesarios para realizar esta operaci�n");
        }
        return $res;
    }
    
    function verificarRegistro($filtro,$tablaNombre){
        global $db;
        $db->SetFetchMode(ADODB_FETCH_ASSOC);
        
        $sql = "SELECT i.* 
                FROM ".$tablaNombre." i
                WHERE ".$filtro;
        $info = $db->Execute($sql);
        //echo $sql;
        if($info->RecordCount()==0)
          return 0;
        else
          return $info->fields["itemId"];
        
    }
    
    function updateItem($rec,$tabla,$id){//print_struc($rec);echo "=============".$id;
        global $db;
        $db->SetFetchMode(ADODB_FETCH_ASSOC);
        $tablaNombre = $tabla;
        if(trim($id)!='' && trim($id)!=0){
          $rec["dateUpdate"] = date('Y-m-d H:i:s');
          $rec["userUpdate"] = $this->userId;
            
          $resupdate = $db->AutoExecute($tablaNombre,$rec,'UPDATE','itemId='.$id);
          if($resupdate){
            $res["res"] = 1;
            $res["id"] = $id;
          }else{
            $res["res"] = 2;
            $res["msg"] = utf8_encode("Error: no se logr� actualizar en la B.D.");
            $res["msgDB"] = utf8_encode($db->ErrorMsg());            
          }      
        }else{
            $res["res"] = 2;
            $res["msg"] = utf8_encode("No existe ID del registro relacionado al dato");
        }
        
        return $res;
    }

    function deleteItem($id,$tabla){
        global $db,$CFG,$privFace;
        $db->SetFetchMode(ADODB_FETCH_ASSOC);
        $tablaNombre = $tabla;
        if($privFace["eliminar"]){
              $sql = "DELETE FROM ".$tablaNombre." WHERE itemId =".$id." ";
              $resdelete = $db->Execute($sql);
              if($resdelete){
                $res["res"] = 1;
              }else{
                $res["res"] = 2;
                $res["msg"] = $db->ErrorMsg();
              }
        }else{
          $res["res"] = 2;
          $res["msg"] = utf8_encode("No tiene los permisos necesarios para realizar la operaci�n.");  
        }
        
        return $res;
    }
}

