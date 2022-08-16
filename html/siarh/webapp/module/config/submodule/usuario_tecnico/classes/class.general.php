<?php
class General extends Table {
    var $contenedorDir;
	function __construct(){
	   global $CFG,$module,$smoduleName,$getModule,$CFG,$CFGm;
       $this->prefix = $CFG->prefix;
       $smoduleTableName = $CFGm->database.".";
       $this->tableName[0] = $smoduleTableName."core_usuario";
       $this->tableName[2] = $smoduleTableName."core_grupo";
       $this->tableName[3] = $smoduleTableName."core_usuario_institucion";
       
       $smoduleTableName = $this->prefix."institucion".".";
       $this->tableName[1] = $smoduleTableName."item";
       $smoduleTableName = "item";
       
       $this->idName = "itemId";
       
       $smoduleTableName = $this->prefix."institucion".".";
       $this->conteTableName[0] = $smoduleTableName.'catalogo_tipo';
       
       $this->userId = $_SESSION["userv"]["memberId"];
       
	   $this->directory = $CFG->data.$module."/";
	   $this->viewDirectory($this->directory);
       $this->directory = $this->directory.$smoduleName."/";
	   $this->viewDirectory($this->directory);
              
       $this->contenedorDir = "fotos";
	}
    
    function getConfigUnset($list,$tipo){
        
        if($tipo=='personal'){
          unset($list[1],$list[2],$list[5],$list[6],$list[7],$list[8],$list[14],$list[15],$list[16],$list[17]);
        }elseif($tipo=='usuario'){
          unset($list[1],$list[3],$list[4],$list[6],$list[7],$list[8],$list[9],$list[10],$list[11],$list[12],$list[13],$list[14],$list[15],$list[16],$list[17]);
          /*$list[18] = array("campo"=>"password"
                           ,"descripcion"=>"Contrase�a"
                           ,"tipoInput"=>"password");*/
          $list[19] = array("campo"=>"activo"
                           ,"descripcion"=>"Activo"
                           ,"tipoInput"=>"select");
        }
        
        return $list;
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
          $res[19] = $objCatalog->getArrayCondicion();  
      }
    
      return $res;   
    }
    
      /**
   * Pull a particular property from each assoc. array in a numeric array, 
   * returning and array of the property values from each item.
   *
   *  @param  array  $a    Array to get data from
   *  @param  string $prop Property to read
   *  @return array        Array of property values
   */
  function pluck ( $a, $prop ){ 
    $out = array();

    for ( $i=0, $len=count($a) ; $i<$len ; $i++ ) {
      $out[] = $a[$i][$prop];
    }

    return $out;
  }

   function actualizarProgramas($id,$programas){
    global $dbm;
    $sql = "delete from ".$this->tableName[3]." WHERE usuarioId=".$id;//echo ":::".$sql;
    $resdelete = $dbm->Execute($sql);
    foreach ($programas as $programa) {
        $rec["usuarioId"] = $id;
        $rec["institucionId"] = $programa;
        $rec["activo"] = 1;
        $rec["dateCreate"] = $rec["dateUpdate"] = date("Y-m-d H:m:s");
        $rec["userCreate"] = $rec["userUpdate"] = $this->userId;
        $resupdate = $dbm->AutoExecute($this->tableName[3],$rec); 
    }
   }
    /**
     * Funcion que arma el json del datatable para institucion
     * @param
     * 
     * @return 
     **/
    function getDataTableInstitucion($arrayGet){
         global $dbm,$getModule,$module, $smoduleName, $privFace, $objCatalog;
        
        $columns = $columnsSelect = array();
    	/* Easy set variables*/
	
    	// Array of database columns which should be read and sent back to DataTables.
        // The `db` parameter represents the column name in the database, while the `dt`
        // parameter represents the DataTables column identifier. In this case simple indexes
        $dataItem = $columnsSelect = array(0=>" ", 1=>"nombre", 2=>"tipoId");
        
        foreach($dataItem as $idx => $row)
            array_push($columns,array( 'db' => $row,   'dt' => $idx));
//print_struc($columns);
    	/* Indexed column (used for fast and accurate table cardinality) */
    	$primaryKey = "itemId";
	
    	/* DB table to use */
    	$table = $this->tableName[1]." i ";
	
    	/* If you just want to use the basic configuration for DataTables with PHP server-side, there is
    	 * no need to edit below this line */
	
    	/* Paging*/
    	$limit = '';
		if ( isset($arrayGet['start']) && $arrayGet['length'] != -1 ) {
			$limit = "LIMIT ".intval($arrayGet['start']).", ".intval($arrayGet['length']);
		}

        /* Ordering*/
        $order = '';
//print_struc($arrayGet['order']);
		if ( isset($arrayGet['order']) && count($arrayGet['order']) ) {
			$orderBy = array();
			$dtColumns = $this->pluck( $columns, 'dt' );
//	$dtColumns = $columns;
			for ( $i=0, $ien=count($arrayGet['order']) ; $i<$ien ; $i++ ) {
				// Convert the column index into the column data property
				$columnIdx = intval($arrayGet['order'][$i]['column']);
				$requestColumn = $arrayGet['columns'][$columnIdx];
               
				$columnIdx = array_search( $requestColumn['data'], $dtColumns );
//echo $columnIdx."<---------";
                if(isset($dataItem[$columnIdx-1]["tabla"])){
                  $columnIdx--;
                  $column['db'] = "i".($columnIdx==0?"":$columnIdx).".nombre ";
                }else{
                  //echo $columnIdx;
                  $column['db'] = $columns[ $columnIdx ];
                }//END IF
//print_struc($column);                  
				if ( $requestColumn['orderable'] == 'true' ) {
				    
				    $dir = $arrayGet['order'][$i]['dir'] === 'asc' ? 'ASC' : 'DESC';
                    $orderBy[] = ''.$column['db'].' '.$dir;
            //print_struc($orderBy);
				}//END IF
			}//ENDFOR

			$order = 'ORDER BY '.implode(', ', $orderBy);//echo "=>>".$order;
		}

    	/* Filtering
    	 * NOTE this does not match the built-in DataTables filtering which does it
    	 * word by word on any field. It's possible to do here, but concerned about efficiency
    	 * on very large tables, and MySQL's regex functionality is very limited
    	 */
    	
        $globalSearch = array();
		$columnSearch = array();
	//	$dtColumns = $this->pluck( $columns, 'dt' );

		if ( isset($arrayGet['search']) && $arrayGet['search']['value'] != '' ) {
			$str = $arrayGet['search']['value'];

			for ( $i=0, $ien=count($arrayGet['columns']) ; $i<$ien ; $i++ ) {
				
                $requestColumn = $arrayGet['columns'][$i];
				$columnIdx = array_search( $requestColumn['data'], $dtColumns );
				$column = $columns[ $columnIdx ]; 
                
				if ( $requestColumn['searchable'] == 'true' ) { 
				    
				  $valFilter = $arrayGet["search"]["value"];
                  if(isset($dataItem[$columnIdx-1]["tabla"])){
                    $columnIdx--;
				    $globalSearch[] = "i".($columnIdx==0?"":$columnIdx).".nombre LIKE '%".$valFilter."%'";
				  }else{
				    $globalSearch[] = "`".$column['db']."` LIKE '%".$valFilter."%'";  
				  }//END IF
                  	
				}//END IF
                
			}//END FOR
		}//END IF

		// Individual column filtering
		/*for ( $i=0, $ien=count($arrayGet['columns']) ; $i<$ien ; $i++ ) {
			$requestColumn = $arrayGet['columns'][$i];
			$columnIdx = array_search( $requestColumn['data'], $dtColumns );
			$column = $columns[ $columnIdx ];

			$str = $requestColumn['search']['value'];

			if ( $requestColumn['searchable'] == 'true' &&
			 $str != '' ) {
				//$binding = $this->bind( $bindings, '%'.$str.'%', PDO::PARAM_STR );
                $binding = $this->bind($bindings);
				$columnSearch[] = "`".$column['db']."` LIKE ".$binding;
			}
		}*/

		// Combine the filters into a single string
		$where = '';

		if ( count( $globalSearch ) ) {
			$where = ' ('.implode(' OR ', $globalSearch).')';
		}

		if ( count( $columnSearch ) ) {
			$where = $where === '' ?
				implode(' AND ', $columnSearch) :
				$where .' '. implode(' AND ', $columnSearch);
		}

		if ( $where !== '' ) {
			$where = 'WHERE '.$where;
		}
        
        /* SQL queries
    	 * Get data to display */
        //$columns = $this->pluck($columns,'db');
        $columns = $columnsSelect;
   
        $sql = "SELECT SQL_CALC_FOUND_ROWS ".str_replace(" , ", " ", implode(", i.", $columns))."
                       ,i.itemId ";
        
        $sForm = '';
       
            $sql.= " , i1.nombre as tipoName ";
            $sForm.=" LEFT JOIN ".$this->conteTableName[0]." i1 ON i.tipoId=i1.itemId ";
  
                        
        $sql.= " FROM ".$table." ".$sForm;
        $sql.= " $where $order $limit";     //print_struc($sql);
     
    	$rResult = $dbm->Execute($sql);        
    	$rResult = $rResult->GetRows();
 
	    /* Data set length after filtering */
    	$sql = "SELECT FOUND_ROWS() as totalFilter";
        $rResultFilterTotal = $dbm->Execute($sql);
        $aResultFilterTotal = $rResultFilterTotal->fields;
    	$iFilteredTotal = $aResultFilterTotal["totalFilter"];

	    /* Total data set length */
	    $sql = "select COUNT(3) as resultTotal FROM $sTable";
    	$iTotal = $dbm->Execute($sql);
        $iTotal = $iTotal->fields;
        $iTotal = $iTotal["resultTotal"];

    	/* Output */
        $output = array( "sEcho" => intval($arrayGet['sEcho']),
                		 "iTotalRecords" => $iTotal,
                		 "iTotalDisplayRecords" => $iFilteredTotal,
                		 "aaData" => array());
    
	    $contRow = $arrayGet['iDisplayStart'];
        $listTipoUsuario = $objCatalog->getArrayTipoUsuario();

    	foreach ( $rResult as $aRow ){
 
    	  $row = array();
          $contRow++;
    	  
          for ( $i=0 ; $i<count($columns) ; $i++ ){  
          
            if($i==0){
            
              $action='';
              $nameaux = utf8_encode($aRow["nombre"]);  
              $nameaux = str_replace("'", "&#039;", $nameaux);  
              $action.= '<a href="javascript:void(0);" onclick="setInstitucion(\''.$aRow["itemId"].'\', \''.$nameaux.'\');"><img src="./template/user/images/icon/add.png" width="20px"/></a>';
                
               $row[] = $action;
             }elseif( $i==2 ){//PAra campos enlazados a otras tablas (catalogo)
           $row[] = utf8_encode($aRow["tipoName"]);
             }else{
                $row[] = utf8_encode($aRow[$columns[$i]]);
             }
             
    	  }//END FOR
          
    	  $output['aaData'][] = $row;
    	}//END FOREACH
        
        return json_encode( $output );
    }
    
    function getDataTableGrupo($arrayGet){
         global $dbm,$getModule,$module, $smoduleName, $privFace, $objCatalog;
        
        $columns = $columnsSelect = array();
      /* Easy set variables*/
  
      // Array of database columns which should be read and sent back to DataTables.
        // The `db` parameter represents the column name in the database, while the `dt`
        // parameter represents the DataTables column identifier. In this case simple indexes
        $dataItem = $columnsSelect = array(0=>" ", 1=>"nombre");
        
        foreach($dataItem as $idx => $row)
            array_push($columns,array( 'db' => $row,   'dt' => $idx));

      /* Indexed column (used for fast and accurate table cardinality) */
      $primaryKey = "itemId";
  
      /* DB table to use */
      $table = $this->tableName[2]." i ";
  
      /* If you just want to use the basic configuration for DataTables with PHP server-side, there is
       * no need to edit below this line */
  
      /* Paging*/
      $limit = '';
    if ( isset($arrayGet['start']) && $arrayGet['length'] != -1 ) {
      $limit = "LIMIT ".intval($arrayGet['start']).", ".intval($arrayGet['length']);
    }

        /* Ordering*/
        $order = '';

    if ( isset($arrayGet['order']) && count($arrayGet['order']) ) {
      $orderBy = array();
      $dtColumns = $this->pluck( $columns, 'dt' );
//  $dtColumns = $columns;
      for ( $i=0, $ien=count($arrayGet['order']) ; $i<$ien ; $i++ ) {
        // Convert the column index into the column data property
        $columnIdx = intval($arrayGet['order'][$i]['column']);
        $requestColumn = $arrayGet['columns'][$columnIdx];
               
        $columnIdx = array_search( $requestColumn['data'], $dtColumns );

                if(isset($dataItem[$columnIdx-1]["tabla"])){
                  $columnIdx--;
                    if ($columnIdx==0)
                      $columnIdx ='';
                  $column['db'] = "i".$columnIdx.".nombre ";
                }else{
                  $column = $columns[ $columnIdx ];
                }//END IF
                    
        if ( $requestColumn['orderable'] == 'true' ) {
            
            $dir = $arrayGet['order'][$i]['dir'] === 'asc' ? 'ASC' : 'DESC';
                    $orderBy[] = ''.$column['db'].' '.$dir;
        }//END IF
      }//ENDFOR

      $order = 'ORDER BY '.implode(', ', $orderBy);//echo "=>>".$order;
    }

      /* Filtering
       * NOTE this does not match the built-in DataTables filtering which does it
       * word by word on any field. It's possible to do here, but concerned about efficiency
       * on very large tables, and MySQL's regex functionality is very limited
       */
      
        $globalSearch = array();
    $columnSearch = array();
  //  $dtColumns = $this->pluck( $columns, 'dt' );
//print_struc($arrayGet['search']);
    if ( isset($arrayGet['search']) && $arrayGet['search']['value'] != '' ) {
      $str = $arrayGet['search']['value'];

      for ( $i=0, $ien=count($arrayGet['columns']) ; $i<$ien ; $i++ ) {
        
                $requestColumn = $arrayGet['columns'][$i];
        $columnIdx = array_search( $requestColumn['data'], $dtColumns );
        $column = $columns[ $columnIdx ]; 
                
        if ( $requestColumn['searchable'] == 'true' ) { 
            
          $valFilter = $arrayGet["search"]["value"];
                  if(isset($dataItem[$columnIdx-1]["tabla"])){
                    $columnIdx--;
                    if ($columnIdx==0)
                      $columnIdx ='';
            $globalSearch[] = "i".$columnIdx.".nombre LIKE '%".$valFilter."%'";
          }else{
            $globalSearch[] = "`".$column['db']."` LIKE '%".$valFilter."%'";  
          }//END IF
                    
        }//END IF
                
      }//END FOR
    }//END IF

    // Individual column filtering
    /*for ( $i=0, $ien=count($arrayGet['columns']) ; $i<$ien ; $i++ ) {
      $requestColumn = $arrayGet['columns'][$i];
      $columnIdx = array_search( $requestColumn['data'], $dtColumns );
      $column = $columns[ $columnIdx ];

      $str = $requestColumn['search']['value'];

      if ( $requestColumn['searchable'] == 'true' &&
       $str != '' ) {
        //$binding = $this->bind( $bindings, '%'.$str.'%', PDO::PARAM_STR );
                $binding = $this->bind($bindings);
        $columnSearch[] = "`".$column['db']."` LIKE ".$binding;
      }
    }*/

    // Combine the filters into a single string
    $where = '';

    if ( count( $globalSearch ) ) {
      $where = ' ('.implode(' OR ', $globalSearch).')';
    }

    if ( count( $columnSearch ) ) {
      $where = $where === '' ?
        implode(' AND ', $columnSearch) :
        $where .' AND '. implode(' AND ', $columnSearch);
    }

    if ( $where !== '' ) {
      $where = 'WHERE '.$where;
    }
        
        /* SQL queries
       * Get data to display */
        //$columns = $this->pluck($columns,'db');
        $columns = $columnsSelect;
   
        $sql = "SELECT SQL_CALC_FOUND_ROWS ".str_replace(" , ", " ", implode(", i.", $columns))."
                       ,i.itemId ";
        
        $sForm = '';  
                        
        $sql.= " FROM ".$table." ".$sForm;
        $sql.= " $where $order $limit";     
    // echo $sql;
      $rResult = $dbm->Execute($sql);        
      $rResult = $rResult->GetRows();
 
      /* Data set length after filtering */
      $sql = "SELECT FOUND_ROWS() as totalFilter";
        $rResultFilterTotal = $dbm->Execute($sql);
        $aResultFilterTotal = $rResultFilterTotal->fields;
      $iFilteredTotal = $aResultFilterTotal["totalFilter"];

      /* Total data set length */
      $sql = "select COUNT(3) as resultTotal FROM $sTable";
      $iTotal = $dbm->Execute($sql);
        $iTotal = $iTotal->fields;
        $iTotal = $iTotal["resultTotal"];

      /* Output */
        $output = array( "sEcho" => intval($arrayGet['sEcho']),
                     "iTotalRecords" => $iTotal,
                     "iTotalDisplayRecords" => $iFilteredTotal,
                     "aaData" => array());
    
      $contRow = $arrayGet['iDisplayStart'];
        $listTipoUsuario = $objCatalog->getArrayTipoUsuario();

      foreach ( $rResult as $aRow ){
 
        $row = array();
          $contRow++;
        
          for ( $i=0 ; $i<count($columns) ; $i++ ){  
          
            if($i==0){
            
              $action='';
              $nameaux = utf8_encode($aRow["nombre"]);  
              $nameaux = str_replace("'", "&#039;", $nameaux);  
              $action.= '<a href="javascript:void(0);" onclick="setGrupo(\''.$aRow["itemId"].'\', \''.$nameaux.'\');"><img src="./template/user/images/icon/add.png" width="20px"/></a>';
                
               $row[] = $action;
             }else{
                $row[] = utf8_encode($aRow[$columns[$i]]);
             }
             
        }//END FOR
          
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
        $programas = $rec["programas"]; unset($rec["programas"]);
        
        $resprocesa = $this->procesaDatos($tipoTabla,$rec);
       
        if($resprocesa["res"]==1){
          
          $ressave = $dbm->AutoExecute($this->tableName[$tipoTabla],$resprocesa["rec"]);
        
          if($ressave){
            $res["res"] = 1;
            $res["id"] = $id = $dbm->Insert_ID();
            $this->actualizarProgramas($res["id"],$programas);
            
            if(isset($portada["name"]) && $portada["name"]!="" && $portada["error"]==0){
    		  $this->conteTableName = $this->tableName[0];
              
              $this->directory = $this->directory.$itemId."/";
              $this->viewDirectory($this->directory);
              $res["foto"] = $this->upDateContePortada($portada,$id,'',$this->contenedorDir);      
              //$res["foto"] = $this->upDateContePortada($portada,$id,$id);
              
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
		              if( isset($rec["apellido"]) ) $rec["apellido"]= stripslashes($rec["apellido"]);	
		              if( isset($rec["password"]) ) $rec["password"]= stripslashes($rec["password"]);
                  if( isset($rec["direccion"]) ) $rec["direccion"]= stripslashes($rec["direccion"]);
                  if( isset($rec["descripcion"]) ) $rec["descripcion"]= stripslashes($rec["descripcion"]);
		            }//END IF
                    if( isset($rec["nombre"]) ) $rec["nombre"] = utf8_decode($rec["nombre"]); 
                    if( isset($rec["apellido"]) ) $rec["apellido"] = utf8_decode($rec["apellido"]); 
                    if( isset($rec["password"]) ) $rec["password"] = utf8_decode($rec["password"]); 
                    if( isset($rec["direccion"]) ) $rec["direccion"]= utf8_decode($rec["direccion"]);
                    if( isset($rec["descripcion"]) ) $rec["descripcion"]= utf8_decode($rec["descripcion"]);
                    
                    if(trim($rec["institucionId"])=='' || $rec["institucionId"]==0){
                      $bRigth=1;
                      $msgRigth.=utf8_encode('<br>- Seleccione una Instituci�n');  
                    }
                    
                    if(trim($rec["password"]) == ""){
                      unset($rec["password"]);
                    }

                    if(trim($rec["grupoId"]) == ""){
                      $rec["grupoId"]= null;
                    }


                    if (isset($rec["password"])){
                        $rec["password"] = md5($rec["password"]);
                    }

                    if(trim($rec["nombre"]=="")){
                        $bRigth=1;
                        $msgRigth.=utf8_encode('<br>- Ingrese un nombre');
                    }
                    
                    if(trim($rec["apellido"])==""){
                        $bRigth=1;
                        $msgRigth.=utf8_encode('<br>- Ingrese un apellido');
                    }

                    if(trim($rec["usuario"]=="") || (!$this->comprobarUsuario($rec["usuario"]) && $accion=="new") || ($accion=="update" && trim($rec["usuario"])!=trim($rec["lastUsuario"]) && !$this->comprobarUsuario($rec["usuario"])) ){
                        $bRigth=1;
                        $msgRigth.=utf8_encode('<br>- Ingrese un nombre de usuario v�lido.'.$this->comprobarUsuario($rec["usuario"]));
                    }

                    if($rec["tipoUsuario"]==1){
                      $rec["grupoId"] = null;
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
          if($tipoTabla==0){
            $sqlSelect = ' i.*, ins.nombre as institucionName, gru.nombre as grupoName, GROUP_CONCAT(pro.institucionId) as programas';
            $sqlFrom = ' '.$this->tableName[0].' i 
                         LEFT JOIN '.$this->tableName[1].' ins ON ins.itemId=i.institucionId
                         LEFT JOIN '.$this->tableName[2].' gru ON gru.itemId=i.grupoId
                         LEFT JOIN '.$this->tableName[3].' pro ON pro.usuarioId=i.itemId';
          
          }else{
            $sqlSelect = ' i.*';
            $sqlFrom = ' '.$this->tableName[$tipoTabla].' i ';
          }  
          $sql = 'SELECT '.$sqlSelect.' 
                  FROM '.$sqlFrom.'
                  WHERE i.itemId='.$idItem;//echo $sql;
          $info = $dbm->Execute($sql);
          $info = $info->fields;
          
          if($tipoTabla==0)
            $info["foto"] = ($info["portada"]==1?$this->getImagenUser($info["itemId"]):"");
            
        }
        //echo $sql;
        return $info;
    }
    
    function getImagenUser($idUser){
        global $getModule;
        
        $numRand=rand(10,100);
        $res='<img src="'.$getModule.'&accion=general_getPhoto&type=0&itemId='.$idUser.'&rand='.$numRand.'" />';
        
        return $res;
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
              //print_struc($rec);
              $rec["dateUpdate"] = date("Y-m-d H:m:s");
              $rec["userUpdate"] = $this->userId;
              $programas = $rec["programas"]; unset($rec["programas"]);
              
              $resprocesa = $this->procesaDatos($tipoTabla,$rec,"update");
        //print_struc($resprocesa);
              if($resprocesa["res"]==1){
                
                $resupdate = $dbm->AutoExecute($this->tableName[$tipoTabla],$resprocesa["rec"],'UPDATE','itemId='.$itemId);
                  
                if($resupdate){
                  $res["res"] = 1;
                  $res["id"] = $itemId;
                  $this->actualizarProgramas($res["id"],$programas);
                  
                  if(isset($portada["name"]) && $portada["name"]!="" && $portada["error"]==0){
                    $this->conteTableName = $this->tableName[0];
                    
                    $this->directory = $this->directory.$itemId."/";
                    $this->viewDirectory($this->directory);
                    $res["foto"] = $this->upDateContePortada($portada,$itemId,'',$this->contenedorDir);
                    
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
    function update($grupoId,$id){
      global $dbm,$getModule,$module, $smoduleName, $privFace, $objCatalog, $objItem;
      //$dbm->debug = true;
      if($privFace["crear"]){
        
        if(trim($grupoId)!="" && trim($grupoId)!=0){
            $dbm->SetFetchMode(ADODB_FETCH_ASSOC);
            $sql = "delete from core_usuario_permisos WHERE usuarioId=".$id;//echo ":::".$sql;
            $resdelete = $dbm->Execute($sql);
            if($resdelete){
                $sql = "SELECT * from core_grupo_permisos where grupoId=$grupoId";
                $rResult = $dbm->Execute($sql);        
                $rResult = $rResult->GetRows();
                $rec["dateCreate"] = $rec["dateUpdate"] = date("Y-m-d H:i:s");
                $rec["userCreate"] = $rec["userUpdate"] = $this->userId;
                $rec["usuarioId"] = $id;
                foreach ($rResult as $row) {
                  $rec["subModuloId"] = $row["subModuloId"];
                  $rec["tipo"] = $row["tipo"];
                  $rec["crear"] = $row["crear"];
                  $rec["editar"] = $row["editar"];
                  $rec["eliminar"] = $row["eliminar"];
                  $ressave = $dbm->AutoExecute("core_usuario_permisos",$rec);
                }
                $res["res"] = 1;
            }else{
              $res["res"] = 2;
              $res["msg"] = utf8_encode("No se logro eliminar el contenido del usuario.");  
            }                      
        }else{
          $res["res"] = 2;
          $res["res"] = utf8_encode("El ID del grupo es invalido.");  
        }//END IF
      }else{
        $res["res"] = 2;
        $res["res"] = utf8_encode("No tiene los permiso necesarios para realizar esta operaci�n.");
      }//END IF      
      return $res;
    }
    
}
