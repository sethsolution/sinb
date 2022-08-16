<?php
class General extends Table {

	function __construct(){
	   global $CFG,$module,$smoduleName,$getModule;
       $this->tableName[0] = $smoduleTableName."server";
       $this->tableName[1] = $smoduleTableName."server_layer";
       
       $smoduleTableName = "";
       $this->conteTableName[0] = $smoduleTableName."catalogo_formato";
       
       $this->idName = "itemId";
       
       $this->userId = $_SESSION["userv"]["memberId"];
       
	   $this->directory = $CFG->data.$module."/";
	   $this->viewDirectory($this->directory);
       $this->directory = $this->directory.$smoduleName."/";
	   $this->viewDirectory($this->directory);
	}

    
    /**
     * Obtiene listado de lso catalogos requeridos
     * @param $tipo:int
     * @param $id:int
     * @param $idficha:int
     * 
     * @return $res:array
     **/
    function listCatalogo($tipo,$id=null,$idficha){
      global $objCatalog;
      
      if($tipo=='index'){
          $listaux = $objCatalog->getArrayTipoUsuario();
          unset($listaux[0]);
          $res[5] = $listaux;
          $res[14] = $objCatalog->getArrayCondicion();  
      }
    
      return $res;   
    }
    
    /**
     * Funcion que arma el json del datatable para institucion
     * @param
     * 
     * @return 
     **/
    function getDataTableLayer($arrayGet,$id){
    global $dbm,$getModule,$module,$smoduleName,$privFace;
        $dbm->SetFetchMode(ADODB_FETC_ASSOC);

      /* Easy set variables*/
  
      /* Array of database columns which should be read and sent back to DataTables. Use a space where
       * you want to insert a non-database field (for example a counter or static image)*/  
        $aColumns = array(' ', 'nombre', 'layer', 'descripcion','formatoId','visible','transparencia','opacidad','activo','orden');
  
      /* Indexed column (used for fast and accurate table cardinality) */
      $sIndexColumn = "itemId";
  
      /* DB table to use */
      $sTable = $this->tableName[1];
  

      /* no need to edit below this line*/
  
      /* Paging*/
      $sLimit = "";     
      if ( isset($arrayGet['iDisplayStart']) && $arrayGet['iDisplayLength'] != '-1' ){
        $sLimit = "LIMIT ".mysql_real_escape_string($arrayGet['iDisplayStart'] ).", ".mysql_real_escape_string($arrayGet['iDisplayLength'] );
      }

      /* Ordering*/
        $sOrder = "ORDER BY i.orden ASC  ";  
        if ( isset($arrayGet['iSortCol_0'] ) ){
        $sOrder.= "  ";
        for ( $i=0 ; $i<intval($arrayGet['iSortingCols']); $i++ ){
        if ( $arrayGet[ 'bSortable_'.intval($arrayGet['iSortCol_'.$i]) ] == "true" ){
          if(intval( $arrayGet['iSortCol_'.$i] )==1){
            $sOrder .= " c.nombre ".mysql_real_escape_string( $arrayGet['sSortDir_'.$i] ) .", ";  
          }else{
                $nameColumAux = $aColumns[ intval( $arrayGet['iSortCol_'.$i] ) ];
                $sOrder .= $nameColumAux." ".mysql_real_escape_string( $arrayGet['sSortDir_'.$i] ) .", ";
              }
        }//END IF
        }//END FOR
        
        $sOrder = substr_replace( $sOrder, "", -2 );
        if ( $sOrder == "ORDER BY" ){
        $sOrder = "";
        }
      }

      /* Filtering
       * NOTE this does not match the built-in DataTables filtering which does it
       * word by word on any field. It's possible to do here, but concerned about efficiency
       * on very large tables, and MySQL's regex functionality is very limited
       */
      $sWhere = "WHERE i.serverId=$id";
        
        if ($arrayGet['sSearch'] != "" ){
        $sWhere .= " AND (";
        for ( $i=0 ; $i<count($aColumns) ; $i++ ){
          if ( $arrayGet[ 'bSearchable_'.$i] == "true" ){
                $sWhere .= " i.".$aColumns[$i]." LIKE '%".mysql_real_escape_string($arrayGet['sSearch'])."%' OR ";
            }
        }//END FOR
        $sWhere = substr_replace( $sWhere, "", -3 );
        $sWhere .= ')';
      }// END IF

      /* Individual column filtering */
        for ( $i=0 ; $i<count($aColumns) ; $i++ ){
        if ( $arrayGet['bSearchable_'.$i] == "true" && $arrayGet['sSearch_'.$i] != '' ){      
            if ( $sWhere == "" ){
          $sWhere = "WHERE ";
        }else{
          $sWhere .= " AND ";
        }//END IF
        $sWhere .= $aColumns[$i]." LIKE '%".mysql_real_escape_string($arrayGet['sSearch_'.$i])."%' ";
        }// END IF
      }//END FOR 
  
        /*
       * SQL queries
       * Get data to display
       */
         
        $sql = "select SQL_CALC_FOUND_ROWS i.itemId,".str_replace(" , ", " ", implode(", i.", $aColumns))."
                       , c.nombre as formatoNombre
                from ".$sTable." as i
                LEFT JOIN ".$this->conteTableName[0]." c ON c.itemId=i.formatoId ";
        $sql.= " $sWhere $sOrder $sLimit";//echo "==>>".$sql;
                 
      $rResult = $dbm->Execute($sql);        
      $rResult = $rResult->GetRows();
 
      /* Data set length after filtering */
      $sql = "SELECT FOUND_ROWS() as totalFilter";
        $rResultFilterTotal = $dbm->Execute($sql);
        $aResultFilterTotal = $rResultFilterTotal->fields;
      $iFilteredTotal = $aResultFilterTotal["totalFilter"];

      /* Total data set length */
      $sql = "select COUNT(3) as resultTotal FROM $sTable WHERE serverId=$id";
      $iTotal = $dbm->Execute($sql);
        $iTotal = $iTotal->fields;
        $iTotal = $iTotal["resultTotal"];

      /*
       * Output
       */
        $output = array( "sEcho" => intval($arrayGet['sEcho']),
                     "iTotalRecords" => $iTotal,
                     "iTotalDisplayRecords" => $iFilteredTotal,
                     "aaData" => array());
    
      $contRow = $arrayGet['iDisplayStart'];
      $iRow = 0;
      $condicion = array(0=>"No", 1=>"Si");
        foreach ($rResult as $aRow){
        $row = array();
          $contRow++;
        $iRow++;
          for ( $i=0 ; $i<=count($aColumns) ; $i++ ){
        
            if($i == 0)
              $row[] = $contRow;
            elseif($i == 4){
          $row[] = utf8_encode($aRow["formatoNombre"]);
        }elseif($i==5 || $i==6){
          $row[] = $condicion[$aRow[ $aColumns[$i] ]];
        }elseif($i == 8){
          if($aRow["activo"] == 1 ){
                $row[] = '<a class="toolbar"  href="javascript:itemActive(\''.$aRow[$sIndexColumn].'\',0)">
                            <img src="./template/user/images/icon/active.png"  title="Publicado"/></a>';
              }elseif($aRow["activo"] == 0){
                $row[] = '<a class="toolbar"  href="javascript:itemActive(\''.$aRow[$sIndexColumn].'\',1)">
                            <img src="./template/user/images/icon/deactive.png"  title="Publicado"/></a>';
              }
        
            }elseif($i == 9){
              if (count($rResult)>1){
                if ($iRow == 1){
                  $auxposicion = '<a href="javascript:photoSetOrder('.$aRow[$sIndexColumn].',\'down\')">';
                  $auxposicion.= '<img src="./template/user/images/icon/downarrow.png" title="Bajar" /></a>';
                }else{
                  if ($iTotal == $iRow){
                    
                    $auxposicion = '<a href="javascript:photoSetOrder('.$aRow[$sIndexColumn].',\'up\')">';
                    $auxposicion.= '<img src="./template/user/images/icon/uparrow.png" title="Subir" /> </a>';
                  }else{
                     $auxposicion = '<a href="javascript:photoSetOrder('.$aRow[$sIndexColumn].',\'down\')">';
                     $auxposicion.= '<img src="./template/user/images/icon/downarrow.png" title="Bajar" /></a>';
                     $auxposicion.= '<a href="javascript:photoSetOrder('.$aRow[$sIndexColumn].',\'up\')">';
                   $auxposicion.= '<img src="./template/user/images/icon/uparrow.png" title="Subir" /> </a>';
                  }
                }
             } 
              $row[] = $auxposicion;  
                  
            }elseif($i == 10){
              $action = '';
                if($privFace["editar"])
          $action.= '<a href="javascript:void(0);" onclick="itemUpdate('.$aRow[$sIndexColumn].',\'update\')" class="linkAction">
                           <img src="./template/user/images/icon/modificar.gif" border="0" title="Modificar"/></a>';
          
              $nameaux = utf8_encode(str_replace('"', "&#034;", $aRow["nombre"]));  
              $nameaux = utf8_encode(str_replace("'", "\\'", $nameaux));
              if($privFace["eliminar"])
              $action .= '<a href="javascript:void(0);" onclick="itemDelete('.$aRow[$sIndexColumn].',\''.$nameaux.'\')" title="Delete Item" class="linkAction">
                            <img src="./template/user/images/icon/delete.png" title="Eliminar" border="0" /></a>';
              $row[] = $action;          
        }else{ // General output 
          $row[] = utf8_encode($aRow[ $aColumns[$i] ]);
        }//END IF
        }//END FOR
          
          //$row[]=utf8_encode($aRow["description"]);

        $output['aaData'][] = $row;
      }//END FOREACH

        return json_encode( $output );
    }

    /**
     * Funcion que guarda un registro en la B.D.
     * @param $rec: array
     * @param $tipoTabla: int (default: 0)
     * 
     * @retun $res: array
     **/   
    function itemSave($rec,$tipoTabla=0){
      global $dbm,$getModule,$module, $smoduleName, $privFace, $portada;
      
      $res = array();
      if($privFace["crear"]){
        
        $rec["dateCreate"] = $rec["dateUpdate"] = date("Y-m-d H:i:s");
        $rec["userCreate"] = $rec["userUpdate"] = $this->userId;
        
        $resprocesa = $this->procesaDatos($tipoTabla,$rec);
       
        if($resprocesa["res"]==1){
          
          if($tipoTabla==1){
              $sql = " SELECT max(orden) as orden FROM ".$this->tableName[1]." WHERE serverId = ".$rec["serverId"];
              $resaux = $dbm->Execute($sql);
          
             if($resaux->fields["orden"] != "" && $resaux->fields["orden"] != 0)
                $resprocesa["rec"]["orden"] = $resaux->fields["orden"]+1;
             else  
                $resprocesa["rec"]["orden"] = 1;

          }
          $ressave = $dbm->AutoExecute($this->tableName[$tipoTabla],$resprocesa["rec"]);
        
          if($ressave){
            $res["res"] = 1;
            $res["id"] = $id = $dbm->Insert_ID();
            
            if(isset($portada["name"]) && $portada["name"]!="" && $portada["error"]==0){
    		  $this->conteTableName = $this->tableName[0];
              $res["foto"] = $this->upDateContePortada($portada,$id,$id);
              
              $rec2["portada"]=1;
              $dbm->AutoExecute($this->tableName[$tipoTabla],$rec2,'UPDATE','itemId='.$id);
    		}
            
          }else{
            $res["res"] = 2;
            $res["msg"] = utf8_encode('No se logro realizar el registro correspondiente.');
            $res["msgdb"] = utf8_encode($dbm->ErrorMsg());
          }
              
        }else{
            $res["res"] = 2;
            $res["msg"] = "Los siguientes campos no son validos: ".$resprocesa["msg"];
        }
         
      }else{
        $res["res"] = 2;
        $res["msg"] = utf8_encode('No tiene permisos para realizar esta operaci�n.');
      }
      
      return $res;
    }
    
    /**
     * Valida los datos a ser almacenados o modificados en la B.D.
     * @param $tipoTabla: int
     * @param $rec: array
     * 
     * @return $res: array
     **/
    function procesaDatos($tipoTabla,$rec,$accion="new"){
        $bRigth=0;
        $msgRigth='';
        $res = array();
        
        switch($tipoTabla){
            case '0':
                    if (get_magic_quotes_gpc() ){
		              if( isset($rec["nombre"]) ) $rec["nombre"]= stripslashes($rec["nombre"]);	
		            }//END IF
                    if( isset($rec["nombre"]) ) $rec["nombre"] = utf8_decode($rec["nombre"]); 
                    

                    if(trim($rec["nombre"]=="")){
                        $bRigth=1;
                        $msgRigth.=utf8_encode('<br>- Ingrese un nombre');
                    }
                    
                    if(trim($rec["url"])==""){
                        $bRigth=1;
                        $msgRigth.=utf8_encode('<br>- Ingrese un URL');
                    }
                break;

            case '1':
                    if (get_magic_quotes_gpc() ){
                  if( isset($rec["nombre"]) ) $rec["nombre"]= stripslashes($rec["nombre"]); 
                  if( isset($rec["layer"]) ) $rec["layer"]= stripslashes($rec["layer"]); 
                  if( isset($rec["descripcion"]) ) $rec["descripcion"]= stripslashes($rec["descripcion"]); 
                }//END IF
                    if( isset($rec["nombre"]) ) $rec["nombre"] = utf8_decode($rec["nombre"]); 
                    if( isset($rec["layer"]) ) $rec["layer"] = utf8_decode($rec["layer"]); 
                    if( isset($rec["descripcion"]) ) $rec["descripcion"] = utf8_decode($rec["descripcion"]); 
                    

                    if(trim($rec["nombre"]=="")){
                        $bRigth=1;
                        $msgRigth.=utf8_encode('<br>- Ingrese un nombre');
                    }
                    
                    if(trim($rec["layer"])==""){
                        $bRigth=1;
                        $msgRigth.=utf8_encode('<br>- Ingrese un Layer');
                    }
                break;
                
        }//END SWITCH
        
        if($bRigth!=0){
          $res["msg"] = $msgRigth;
          $res["res"] = 2;
        }else{
          $res["res"] = 1;
          $res["rec"] = $rec;
        }  
 
        return $res;
    }
    
    /** Funcion que obtiene datos de una tabla
     * @param $idItem: int
     * @param $tipoTabla: int
     **/
    function getItem($idItem,$tipoTabla){
        global $dbm,$getModule,$module, $smoduleName, $privFace;
        $dbm->SetFetchMode(ADODB_FETCH_ASSOC);
        
        $info = '';
        if($idItem!=''){
          $sqlSelect = ' i.*';
          $sqlFrom = ' '.$this->tableName[$tipoTabla].' i ';
          $sql = 'SELECT '.$sqlSelect.' 
                  FROM '.$sqlFrom.'
                  WHERE i.itemId='.$idItem;//echo $sql;
          $info = $dbm->Execute($sql);
          $info = $info->fields;
        }
        return $info;
    }
    
    
    /**
     * Funcion que valida la existencia de nombre de usuario
     * @param $usuarioId: int
     * @param $usuarioName: string
     * 
     * @return $res: array
     **/
    function verificarUsuario($current,$last){
        
        if($current == ""){
            $res["res"] = 2;//error
            $res["msg"] = utf8_encode("Ingrese un nombre de usuario v�lido");
        }else{
            
            if($last == ''){//Nuevo Usuario
              
              if($this->comprobarUsuario($current)){
                $res["res"] = 0;
                $res["msg"] = utf8_encode("Usuario v�lido.");
              }else{
                $res["res"] = 2;
                $res["msg"] = utf8_encode("Ya existe el nombre de usuario ingresado");
              }  
                  
            }else{//Ediccion de Usuario
            
              if($current == $last){
                $res["res"] = 0;
                $res["msg"] = utf8_encode("Usuario v�lido.");
              }else{
                
                if($this->comprobarUsuario($current)){
                  $res["res"] = 0;
                  $res["msg"] = utf8_encode("Usuario v�lido.");
                }else{
                  $res["res"] = 2;
                  $res["msg"] = utf8_encode("Ya existe el nombre de usuario ingresado");
                } 
              }
            }
        }//END IF
        
        return $res;
    }
    
    /** funcion que comprueba la existencia de un usuario en la BD
     * @param $usuario: string
     * 
     * @return
     **/ 
    function comprobarUsuario($usuario){
        global $dbm,$getModule,$module, $smoduleName, $privFace;
        $dbm->SetFetchMode(ADODB_FETCH_ASSOC);
        
        $sql = "select count(3) as total";
        $sql.= " from ".$this->tableName[0]." i";
        $sql.= " where i.usuario = '".$usuario."' ";//echo $sql;
        $info = $dbm->Execute($sql);

        if($info->fields["total"] > 0){
          return false;
        }else{
          return true;
        }//END IF
         
    }
    
    /** Function que actualiza la informacion de datos de un registro
     * @param $rec: Array
     * @param $itemId: int
     * @param $tipoTabla: int
     **/
    function itemUpdate($rec,$itemId,$tipoTabla){
        global $dbm,$getModule,$module, $smoduleName, $privFace,$portada;
       // $dbm->debug=true;
        
        $res = array();
        if($itemId!=''){
            
          if($privFace["editar"]){  
              
              $rec["dateUpdate"] = date("Y-m-d H:m:s");
              $rec["userUpdate"] = $this->userId;
              
              $resprocesa = $this->procesaDatos($tipoTabla,$rec,"update");
        //print_struc($resprocesa);
              if($resprocesa["res"]==1){
                
                $resupdate = $dbm->AutoExecute($this->tableName[$tipoTabla],$resprocesa["rec"],'UPDATE','itemId='.$itemId);
                  
                if($resupdate){
                  $res["res"] = 1;
                  $res["id"] = $itemId;
                  
                  if(isset($portada["name"]) && $portada["name"]!="" && $portada["error"]==0){
                    $this->conteTableName = $this->tableName[0];
            	    $res["foto"] = $this->upDateContePortada($portada,$itemId,$itemId);
                    
                    $rec2["portada"]=1;
                    $dbm->AutoExecute($this->tableName[$tipoTabla],$rec2,'UPDATE','itemId='.$itemId);
            	  }
                  
                }else{
                  $res["res"] = 2;
                    $res["msg"] = utf8_encode("No se logro actualizar la informacion en la B.D.");
                    $res["msgdb"] = $dbm->ErrorMsg();
                }
                  
              }else{
                $res["res"] = 2;
                $res["msg"] = "Los siguientes campos no son validos: ".$resprocesa["msg"];
              }
                 
          }else{
            $res["res"] = 2;
            $res["msg"] = utf8_encode("No tiene los permisos para realizar esta operaci�n.");
          }
        }else{
          $res["res"] = 2;
          $res["msg"] = utf8_encode("No existe ID del registro correspondiente.");  
        }
        
        return $res;
    }
       
        /** 
     * Funcion que importainformacion de una ficha de inventario a la ficha FIV
     * @param int $inventarioId; 
     * @parma int $fichaId;
     * @param string $accion;
     * 
     * @return array $res
     **/

    

    function itemUpdateStatus($rec, $id){
    global $dbm,$privFace;
      
      if($privFace["editar"]){
      if(trim($id) != ""){

        $resupdate = $dbm->AutoExecute($this->tableName[1],$rec,"UPDATE",$this->idName."=".$id);
        
        if($resupdate){
          $res["response"] = 1;
        }else{
          $auxmsg = $dbm->ErrorMsg();  
          $res["response"] = 2;
          $res["msg"] = utf8_encode("No se logr� actualizar en la BD.<br />".$auxmsg);
        }
        
      }else{
        $res["response"] = 2;
        $res["msg"] = utf8_encode("No existe el ID del item");
      }
      }else{
        $res["response"] = 3;
        $res["msg"] = utf8_encode("No tiene permisos para editar la informaci�n.");
      }
      return $res;
    }
    
    function setOrderPhoto($itemId,$tipo,$id){
        global $dbm,$core,$privFace;

        $datos = $this->getPhotoItem($itemId);
        
        if ($tipo == "down"){
            $sql = "SELECT itemId, orden FROM ".$this->tableName[1]." 
                    WHERE orden > ".$datos["orden"]." AND serverId=".$id." 
                    ORDER BY orden ASC LIMIT 1";
        }else{
            $sql = "SELECT itemId, orden FROM ".$this->tableName[1]." 
                    WHERE orden < ".$datos["orden"]." AND serverId=".$id." 
                    ORDER BY orden DESC LIMIT 1";
        }
        if($privFace["editar"]){
        $result = $dbm->Execute($sql);}
        $result = $result->fields;
        $nextId = $result["itemId"];
        $posNext = $result["orden"];
        
        if ($nextId != null){
          $sql = "update ".$this->tableName[1]." set orden = ".$datos["orden"]." where itemId = $nextId";
          $dbm->Execute($sql);
          $sql = "update ".$this->tableName[1]." set orden = $posNext where itemId = $itemId";
          $dbm->Execute($sql);
          $res["response"]=1;
        }else{
           $res["response"] = 2;
           $res["mssg"] = utf8_encode(" No es posible realizar esta acci�n");
        } 
        
        return $res;
    }

    function deleteLayerItem($itemId,$id){
      global $dbm,$privFace;        //$dbm->debug=true;
      
      if($privFace["eliminar"]){      
    
        $sql = "delete from ".$this->tableName[1]." where itemId = ".$itemId;
        $resdelete = $dbm->Execute($sql);
        if(trim($id)!=""){    
          if($resdelete){
            $res["response"] = 1;
          }else{
            $auxmsg = $dbm->ErrorMsg();
            $res["response"] = 2;
            $res["mssg"] = utf8_encode("No se logro eliminar el de la BD.<br>".$auxmsg);
          }
        }else{
          $res["response"] = 2;
          $res["mssg"] = utf8_encode("No existe el ID del Layer");  
        }
      }else{
          $res["response"] = 3;
          $res["mssg"] = utf8_encode("No tiene permisos para eliminar un registro.");  
      }  
       
      return $res;
  }  


    function getPhotoItem($id){
        global $dbm;
    $dbm->SetFetchMode(ADODB_FETCH_ASSOC);
       
        $sql = "select * from ".$this->tableName[1]." where itemId=".$id;//echo $sql;
        $list = $dbm->Execute($sql);  
    $item = $list->fields;
        
        return $item;
    }
}
