<?php
class Catalogo{
 
    function getCategorias(){
        $res = array();    
        $res[0][1] = "Catalogo General";
            $res[0][2] = "Catalogo General";
        $res[1][1] = "Cuenca";
            $res[1][2] = "Cuenca";
        $res[2][1] = "Territorio";
            $res[2][2] = "Territorio";
        $res[3][1] = "Proyectos MMAyA";
            $res[3][2] = "Cartera";
        $res[4][1] = "Proyectos MMAyA";
            $res[4][2] = "Entidad";
       
        return $res;
    }
    
    function getTablas($identificador=1){
        $res = array();
        switch($identificador){
            case 0:
                $res["vrhr_catalogo.agroecologica"] = "Agroecologica";
                $res["vrhr_catalogo.comercial"] = "Comercial";
                $res["vrhr_catalogo.cultivo"] = "Cultivo";
                $res["vrhr_catalogo.cultivo_tipo"] = "Tipo de Cultivo";
                $res["vrhr_catalogo.pecuaria"] = "Pecuaria";
            break;
            case 1:
                $res["vrhr_cuenca.nivel5"]="Cuenca Nivel 5";
            break;
            case 2:
                $res["vrhr_territorio.municipio"]="Municipio";
                $res["vrhr_territorio.provincia"]="Provincia";
                $res["vrhr_territorio.region"]="Region";            
            break;
            case 3:
                $res["vrhr_proyecto.catalogo_componente"]="Componentes";
                $res["vrhr_proyecto.catalogo_unidad"]="Unidades";
            break;
            case 4:
                $res["vrhr_institucion.catalogo_organismo"]="Organismo";
                $res["vrhr_institucion.catalogo_modalidad"]="Modalidad";
            break;
        }
        return $res;
    }
    
    function getDatos($from){
        global $db;
		$db->SetFetchMode(ADODB_FETCH_ASSOC);
        $sql = "SELECT * FROM ".$from."  
            order by nombre";
        $info = $db->Execute($sql);
        $item = $info->GetRows();
        return $item;
    }
    
    function getDatosPadre($from, $id=0, $selected=0, $contador=0){
        global $db;
        //$db->debug = true;
		$db->SetFetchMode(ADODB_FETCH_ASSOC);
        $sql = "SELECT * FROM info_catalogo_".$from."  
        WHERE parent=".$id." order by nombre";
        //echo $sql;
        $info = $db->Execute($sql);
        $item = $info->GetRows();
        $res = "";
        foreach($item as $row){
            if($this->tieneHijos($from, $row["itemId"],$contador++)){
                $aux="";
                if ($row["itemId"] == $selected){
                    $aux = "selected='selected'";
                }
                $res = $res.'<option value="'.$row["itemId"].' "'.$aux.'>'.$row["nombre"].'</option>';
                $res= $res.'<optgroup label="'.$row["nombre"].'">';
                $res = $res.$this->getDatosPadre($from,$row["itemId"], $selected, $contador);    
                $res = $res.'</optgroup>';
                $contador--;
            }
            else{
                $contador--;
                $aux="";
                if ($row["itemId"] == $selected){
                    $aux = "selected='selected'";
                }
                $res = $res.'<option value="'.$row["itemId"].' "'.$aux.'>'.$row["nombre"].'</option>';
            }
        }         
        return $res;
    }
    
    function tieneHijos($from, $id, $contador){
        if ($contador >= 1){
            return false;
        }
        global $db;
   	    $db->SetFetchMode(ADODB_FETCH_ASSOC);
        $sql = "SELECT * FROM info_catalogo_".$from."  
        WHERE parent=".$id." order by nombre";
        //echo $sql;
        $info = $db->Execute($sql);
        $item = $info->GetRows();
        if (count($item)>0){
            return true;
        }
        return false;
    }
    
    function getPadre($from, $id=0){
        if ($id==0)
            return 0;
        global $db;
       	$db->SetFetchMode(ADODB_FETCH_ASSOC);
        $sql = "SELECT * FROM info_catalogo_".$from."  
        WHERE itemId=".$id;
        //echo $sql;
        $info = $db->Execute($sql);
        $item = $info->fields;
        return $item["parent"];
    }
    
    function getItem($id, $from){
  		global $db;
        $sql = "select * from ".$from;
        $sql.= " where itemId = '".$id."' ";
        //echo $sql;
		$db->SetFetchMode(ADODB_FETCH_ASSOC);
		$item = $db->Execute($sql);	
		return $item->fields;
    }
    
    function getDatosListas($from){
        global $db;
		$db->SetFetchMode(ADODB_FETCH_ASSOC);
        $sql = "SELECT * FROM ".$from."  
        order by nombre";
        $info = $db->Execute($sql);//echo $sql;
        $item = $info->GetRows();
        $res = array();
        foreach($item as $row){
            $res[$row["itemId"]] = utf8_encode($row["nombre"]);
        }         
        return $res;
    }
    
    function getDatosArray($from){
        $res = array();
        switch ($from){
            case 'actividadproduccion':
                $res[1] ="Industria - Industria Manufacturera";
                $res[2] ="Industria - Consumo Intermedio";
                $res[3] ="Comercio - Consumo Intermedio";
                $res[4] ="Servicios - Consumo Intermedio";
              break;
            case 'areaDepartamento':
                $res[1] ="Comercio";
                $res[2] ="Servicio";
              break;
            case 'plantarefineria':
                $res[1] = "GLP Plantas";
                $res[2] = "GLP Refinerias";
              break;
                
        }
        return $res;
    }
    
    function getDatosDepartamento(){
        global $db;
		$db->SetFetchMode(ADODB_FETCH_ASSOC);
        $sql = "SELECT * FROM gadc_departamento 
        order by descripcion";
        //echo $sql;
        $info = $db->Execute($sql);
        $item = $info->GetRows();
        $res = array();
        foreach($item as $row){
            $res[$row["itemId"]] = $row["descripcion"];
        }         
        return $res;
    }
    
    function getEntidades($gestion,$entidadId){
        global $db;
		$db->SetFetchMode(ADODB_FETCH_ASSOC);
        $sql = "SELECT i.nombre, i.itemId FROM gadc_entidad i 
        where i.itemId not in(select o.entidadId from gadc_organigrama o where
        o.gestionId=".$gestion." )";
        if($entidadId!='')
         $sql.= " or i.itemId=".$entidadId;
         
         $sql.= " order by i.nombre";
     // echo $sql;
        $info = $db->Execute($sql);
        $item = $info->GetRows();
        $opt = array();
        for($i=0;$i<count($item);$i++){
            $opt[$item[$i]["itemId"]] = $item[$i]["nombre"];
        }
		return $opt;
    }
       
        function getNiveles(){
        global $db;
		$db->SetFetchMode(ADODB_FETCH_ASSOC);
        $sql = "SELECT i.nombre, i.itemId FROM gadc_entidad_nivel i order by i.nombre ";
        $info = $db->Execute($sql);
        $item = $info->GetRows();
        $opt = array();
        for($i=0;$i<count($item);$i++){
            $opt[$item[$i]["itemId"]] = $item[$i]["nombre"];
        }
		return $opt;
    }
        function getGestiones(){
        global $db;
		$db->SetFetchMode(ADODB_FETCH_ASSOC);
        $sql = "SELECT i.itemId FROM gadc_gestion i ";
        $info = $db->Execute($sql);
        $item = $info->GetRows();
        $opt = array();
        for($i=0;$i<count($item);$i++){
            $opt[$item[$i]["itemId"]] = $item[$i]["itemId"];
        }
		return $opt;
    }

    function guia($parentGestion,$parentPadre,$parentEntidad){
		global $db;
        if($parentGestion!=''){
            $ret[0]['gestion'] = $parentGestion;
            $ret[0]['name'] = $parentGestion;
        }
        if ($parentPadre=='' && $parentEntidad!=''){
            $ret[1]['gestion'] = $parentGestion;
            $ret[1]['padre'] = $parentPadre;
            $ret[1]['entidad'] = $parentEntidad;
            $ret[1]['name'] = $this->getEntidadName($parentEntidad);
        }else if($parentPadre!='' && $parentEntidad!=''){

              $res=$this->verPadre($parentGestion,$parentPadre,$parentEntidad);
              $ret=array_merge($ret,$res);
        }
       
		return  $ret;
	}
    
    function getEntidadName($id){
     global $db;
		$sql = "select en.nombre from gadc_organigrama o,gadc_entidad en
                where o.entidadId=en.itemId and o.itemId =".$id;
        //echo $sql;
		$db->SetFetchMode(ADODB_FETCH_ASSOC);
		$item = $db->Execute($sql);	
		return $item->fields['nombre'];       
     }
     
     function getEntidad($id){
     global $db;
		$sql = "select * from gadc_entidad ";
		$sql.= " where itemId = '".$id."' ";
        //echo $sql;
		$db->SetFetchMode(ADODB_FETCH_ASSOC);
		$item = $db->Execute($sql);	
		return $item->fields['nombre'];       
     }
    function verPadre($parentGestion,$parentPadre,$entidadId){
		global $db;
        $padreId=0;
        $k=1;
        
        $res[$k]['gestion']=$parentGestion;
        $res[$k]['padre']=$parentPadre;//228
        $res[$k]['entidad']=$entidadId;//230
        $res[$k]['name']=$this->getEntidadName($entidadId);
        
        $sql = "select padreId from gadc_organigrama where itemId=".$entidadId." and gestionId=".$parentGestion;
	// echo "1.-".$sql."--";
    	$info = $db->Execute($sql);
        $padreId=$info->fields["padreId"];//235
        
          $sql = "select padreId from gadc_organigrama where itemId=".$padreId." and gestionId=".$parentGestion;
	// echo "1.-".$sql."--";
    	$info = $db->Execute($sql);
        $padreDePadre=$info->fields["padreId"];//230
        
        while($padreId!=null){
            $k=$k+1;
		    $res[$k]['gestion']=$parentGestion;
		    $res[$k]['padre']=$padreDePadre;//230,228,null
		    $res[$k]['entidad']=$padreId;//235,230,228
            $res[$k]['name']=$this->getEntidadName($padreId);
            $padreAnt=$padreId;
            $sql = "select padreId from gadc_organigrama where itemId=".$padreId." and gestionId=".$parentGestion;
       		$info = $db->Execute($sql);
            $padreId=$info->fields["padreId"];//230,228
            
            $sql = "select padreId from gadc_organigrama where itemId=".$padreId." and gestionId=".$parentGestion;
           	$info = $db->Execute($sql);
            $padreDePadre=$info->fields["padreId"];//228,null
            
            
		}
        $res=array_reverse($res,false);
       return $res;
    }
    
    function gesListPadres($idgestion,$parentEntidad,$parentPadre){
        global $db;
        $db->SetFetchMode(ADODB_FETCH_ASSOC);
     //echo $parentEntidad." - ".$parentPadre;
          //Obtenemos los datos de la misma secretaria
        $sql = 'SELECT  o.itemId , en.nombre as nombreGestion
                FROM gadc_organigrama o,gadc_entidad en where o.entidadId=en.itemId and o.itemId='.$parentEntidad;  
        $info = $db->Execute($sql);
        $info = $info->fields;
                
        $res = '<select name="item[padreId]" id="listPadres" class="input" style="font-size:10px !important;">';
         $res.= '<option value="null" ';
        if($parentPadre == '')
          $res.= 'selected="selected" ';  
          $res.= '>Raiz</option>';
        
        $resaux = $this->getListSecretary($idgestion,$parentEntidad,$parentPadre);
      // echo "<pre>".print_r($resaux)."</pre>";
        $resoptaux = "";
        
        foreach($resaux as $row){
            $resoptaux.= '<option value="'.$row["itemId"].'" ';
          //   echo $parentEntidad." - ".$row["itemId"]."<BR/>";
            if($parentPadre == $row["itemId"]){
              $resoptaux.= 'selected="selected"';  
            }
            $resoptaux.= '>'.$row["nombreGestion"].'</option>';
        }
        
        $res.= $resoptaux;
        $res.= '</select>';
        
        return $res;
               
        
    }
    
   function getListSecretary($gestion,$parentEntidad,$parentPadre){
        global $db;

        $sql = 'SELECT o.itemId, en.nombre as nombreGestion,o.padreId,o.entidadId 
                FROM gadc_organigrama o,gadc_entidad en 
                WHERE o.entidadId=en.itemId and 
                o.padreId is null and o.gestionId='.$gestion." 
                ORDER BY o.nombreGestion ASC";
          //  echo "3-$sql";
        $list = $db->Execute($sql);
        $list = $list->GetRows();
        $res = array();
        
        foreach($list as $row){
            if($parentPadre==''){
             if($row["itemId"]!=$parentEntidad ){
                 $row["nombreGestion"] = "+ ".$row["nombreGestion"]; 
                   $res[$row["itemId"]] = $row;
                   if($this->verifyChild($row["itemId"]) ){
                       $res = $res+$this->getListUnity2($row["itemId"],$gestion," - ");
                    } 
                }
            }else{
              $row["nombreGestion"] = "+  ".$row["nombreGestion"]; 
                   $res[$row["itemId"]] = $row;
                   if($this->verifyChild($row["itemId"]) ){
                        $res = $res+$this->getListUnity($row["itemId"],$gestion," - ",$parentEntidad);
                   }   
            }
        }     
      
        //echo "<pre>".print_r($res)."</pre>";
        return $res;
    } 
    
       function getListUnity($id,$gestion,$space,$parentEntidad){
        global $db;

        $sql = 'SELECT o.itemId, en.nombre as nombreGestion,o.padreId,o.entidadId FROM gadc_organigrama o,gadc_entidad en 
                WHERE o.entidadId=en.itemId and 
                o.padreId='.$id.' and o.gestionId='.$gestion."
                ORDER BY o.nombreGestion ASC";
            //  echo "3-$sql";
        $list = $db->Execute($sql);
        $list = $list->GetRows();
        $res = array();
        foreach($list as $row){
         //   echo "<BR/>".$row["itemId"]."**".$parentEntidad;
          if($row["itemId"]!=$parentEntidad){
             $row["nombreGestion"] = " ".$space.$row["nombreGestion"]; 
             $res[$row["itemId"]] = $row;
          // echo print_r($res);
            if($this->verifyChild($row["itemId"])){
              $res = $res+$this->getListUnity($row["itemId"],$gestion,$space." - ",$parentEntidad);
            }
           }
        }
       
      //  echo print_r($res);
        return $res;
    } 
       function getListUnity2($id,$gestion,$space){
        global $db;

        $sql = 'SELECT o.itemId, en.nombre as nombreGestion,o.padreId,o.entidadId FROM gadc_organigrama o,gadc_entidad en 
                WHERE o.entidadId=en.itemId and 
                o.padreId='.$id.' and o.gestionId='.$gestion."
                ORDER BY o.nombreGestion ASC";
            //  echo "3-$sql";
        $list = $db->Execute($sql);
        $list = $list->GetRows();
        $res = array();
        foreach($list as $row){
          
         $row["nombreGestion"] = " ".$space.$row["nombreGestion"]; 
         $res[$row["itemId"]] = $row;
          // echo print_r($res);
           if($this->verifyChild($row["itemId"])){
              $res = $res+$this->getListUnity2($row["itemId"],$gestion,$space." - ");
           }
        }
       
      //  echo print_r($res);
        return $res;
    }
    function verifyChild($id){
        global $db;
        $db->SetFetchMode(ADODB_FETCH_ASSOC);
        
        $sql = "SELECT COUNT(3) as total FROM gadc_organigrama o WHERE o.padreId=".$id;
        $info = $db->Execute($sql);
        
        if($info->fields["total"]>0)
          $res = true;
        else
          $res=false;
          
        return $res;    
    }
}
