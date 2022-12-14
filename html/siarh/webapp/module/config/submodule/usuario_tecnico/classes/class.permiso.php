<?php
class Permiso extends Table {

	function __construct(){
	   global $CFG,$module,$smoduleName,$getModule,$CFG,$CFGm;
       $this->prefix = $CFG->prefix;
       $smoduleTableName = $CFGm->dbDatabase.".";
       $this->tableName[0] = $smoduleTableName."core_usuario_permisos";
       $this->tableName[1] = $smoduleTableName."core_modulo";
       $this->tableName[2] = $smoduleTableName."core_submodulo";
       $this->tableName[3] = $smoduleTableName."core_permisos_fichas_tecnicos";
       $this->tableName[4] = $smoduleTableName."core_catalogo_modulo_tecnicos";
       
       $this->idName = "itemId";
       
       $this->userId = $_SESSION["userv"]["memberId"];

       $this->dataFichas = array("campo"=>array(1=>"nombre")
                                ,"descripcion"=>array(1=>"Nombre")
                                ,"tipoInput"=>array(1=>"text"));
	}

    /**
     * Funcion que elimina datos segun tipo de tabla
     * @param $list: array
     * @param $tipo:string
     * 
     * @return $list
     **/
    function getConfigUnset($list,$tipo){
        
        if($tipo=='permiso'){
          //unset($list[1]);
          //$list[3] = array("descripcion"=>"Modulo");
          //$list[4] = array("descripcion"=>"Submodulo");
          //$list[5] = array("descripcion"=>"ModuloId");
          //$list[6] = array("descripcion"=>"SubmoduloId");
        }
        
        return $list;
    }
    
    /** 
     * Construye el json del datatable para listado de usuarios
     * @param $arrayGet : array
     * 
     * @return $output : json
     **/
    function itemDatatableRows($arrayGet,$fichaId){
         global $dbm,$getModule,$module, $smoduleName, $privFace, $objCatalog, $subcontrol, $objItem;
        
        $columns = $columnsSelect = array();
    	/* Easy set variables*/
	
    	// Array of database columns which should be read and sent back to DataTables.
        // The `db` parameter represents the column name in the database, while the `dt`
        // parameter represents the DataTables column identifier. In this case simple indexes
        $dataItem = $objItem->getConfig("permiso");
    
        $columnsDefault = array(array("db"=>' ',"dt"=>0));
        $contColumnDefault = count($columnsDefault)-1;
        $columnsSelect = $this->pluck($columnsDefault,"db");
         
        foreach($dataItem as $idx => $row){
            
          if(is_array($row["campo"])){
            foreach($row["campo"] as $idx2 => $row2){
              
              array_push($columns,array( 'db' => $row2,   'dt' => $idx2 ));
              array_push($columnsSelect,$row["campo"]);
              
            }//END FOREACH
            
          }else{  
            array_push($columns,array( 'db' => $row["campo"],   'dt' => $idx+$contColumnDefault ));
            array_push($columnsSelect,$row["campo"]);
          } //END IF
              
        }//END FOREACH

        $columns = array_merge($columnsDefault,$columns);

    	/* Indexed column (used for fast and accurate table cardinality) */
    	$primaryKey = "itemId";
	
    	/* DB table to use */
    	$table = $this->tableName[3]." i ";
	
    	/* If you just want to use the basic configuration for DataTables with PHP server-side, there is
    	 * no need to edit below this line */
	
    	/* Paging*/
    	$limit = '';
		if ( isset($arrayGet['start']) && $arrayGet['length'] != -1 ) {
			$limit = "LIMIT ".intval($arrayGet['start']).", ".intval($arrayGet['length']);
		}
        
        $dtColumns = $this->pluck( $columns, 'dt' );
        
        /* Ordering*/
        $order = 'ORDER BY i.moduloId ASC ';

		if ( isset($arrayGet['order']) && count($arrayGet['order']) ) {
			$orderBy = array();
			
//	$dtColumns = $columns;
			for ( $i=0, $ien=count($arrayGet['order']) ; $i<$ien ; $i++ ) {
				// Convert the column index into the column data property
				$columnIdx = intval($arrayGet['order'][$i]['column']);
				$requestColumn = $arrayGet['columns'][$columnIdx];
               
				$columnIdx = array_search( $requestColumn['data'], $dtColumns );

                if(isset($dataItem[$columnIdx-1]["tabla"])){
                  //$columnIdx--;
                 
                  if($columnIdx==2)
                    $column['db'] = "i".$columnIdx.".titulo ";
                  else
                    $column['db'] = "i".$columnIdx.".nombre ";
                    
                }else{
                  $columnaux = $columns[ $columnIdx ]["db"];                
                  $column['db'] = "i.".$columnaux;
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
		$dtColumns = $this->pluck( $columns, 'dt' );

		if ( isset($arrayGet['search']) && $arrayGet['search']['value'] != '' ) {
			$str = $arrayGet['search']['value'];

			for ( $i=0, $ien=count($arrayGet['columns']) ; $i<$ien ; $i++ ) {
				
                $requestColumn = $arrayGet['columns'][$i];

				$columnIdx = array_search( $requestColumn['data'], $dtColumns );
				$column = $columns[ $columnIdx ]; 
            
				if ( $requestColumn['searchable'] == 'true' && $columnIdx!="") {
				    
				  $valFilter = $arrayGet["search"]["value"];

                  if(isset($dataItem[$columnIdx]["tabla"])){
				    $globalSearch[] = "i".$columnIdx.".nombre LIKE '%".$valFilter."%'";
                    $globalSearch[] = "m.titulo LIKE '%".$valFilter."%'";
                    $globalSearch[] = "i3.nombre LIKE '%".$valFilter."%'";
				  }else{
				    $globalSearch[] = "i.".$column['db']." LIKE '%".$valFilter."%'";  
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
		$where = ' i.tecnicoId='.$fichaId;

		if ( count( $globalSearch ) ) {
			$where.= ' AND ('.implode(' OR ', $globalSearch).')';
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
                        , i.itemId ";
        
        $sForm = '';
        
        foreach($dataItem as $idx => $row){
            
          if(isset($row["tabla"])){
            $sql.= " , i".$idx.".nombre as ".$row["campo"]."Name ";
            $sForm.=" LEFT JOIN ".$row["tabla"]." i".$idx." ON i.".$row["campo"]."=i".$idx.".itemId ";
          }//END IF
           
        }//END FOREACH
                        
        $sql.= " FROM ".$table." 
                ".$sForm."
                ";
        $sql.= " $where $order $limit";     
//print_struc($sql);
    	$rResult = $dbm->Execute($sql);        
    	$rResult = $rResult->GetRows();
 
	    /* Data set length after filtering */
    	$sql = "SELECT FOUND_ROWS() as totalFilter";
        $rResultFilterTotal = $dbm->Execute($sql);
        $aResultFilterTotal = $rResultFilterTotal->fields;
    	$iFilteredTotal = $aResultFilterTotal["totalFilter"];

	    /* Total data set length */
	    $sql = "select COUNT(3) as resultTotal FROM $table";
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
        //print_struc($columns);
        $auxNameModulo='-1';
    	foreach ( $rResult as $aRow ){
 
    	  $row = array();
          $contRow++;
            
          for ( $i=0 ; $i<count($columns) ; $i++ ){  
             
             if($i==0){
              $row[] = $contRow;
              
              $action='';
             
               if($privFace["eliminar"]){
                 $nameaux = utf8_encode(str_replace('"', "&#034;",  $aRow["padreName"]." - ".$aRow["subModuloIdName"]));  
                 $nameaux = str_replace("'", "&#039;", $nameaux);
                 $btnEliminar = '<a href="javascript:void(0);" onclick="itemDelete('.$aRow["itemId"].')" title="Delete Item" class="linkAction">
                                <img src="./template/user/images/icon/delete.png" title="Eliminar" border="0" /></a>';
                 $action.= $btnEliminar;
               }
          
               $row[] = $action;
             }elseif( $i==1){//PAra campos enlazados a otras tablas (catalogo)
           $row[] = utf8_encode($aRow[$columns[$i]."Name"]);
             }elseif( $i==2){//PAra campos enlazados a otras tablas (catalogo)
           $row[] = utf8_encode($this->searchName($aRow[$columns[$i]],$aRow[$columns[1]]));
             }elseif($i!=1 && $i!=2){
                $row[] = utf8_encode($aRow[$columns[$i]]);
             }
             
    	  }//END FOR
          
          $row[] = utf8_encode($aRow["moduloName"]);
          $row[] = utf8_encode($aRow["padreName"]);
          $row[] = utf8_encode($aRow["moduloName"]."|".$aRow["moduloId"]);
          $row[] = utf8_encode($aRow["padreName"]."|".$aRow["padreId"]);
          
    	  $output['aaData'][] = $row;
    	}//END FOREACH
        
        return json_encode( $output );     
    } 

  function searchName($fichaId,$moduloId){
      global $dbm;
        $dbm->SetFetchMode(ADODB_FETCH_ASSOC);
        $table = $this->searchDataBase($moduloId);
        
        $sql = 'SELECT i.nombre
                FROM '.$table.' i
                WHERE i.itemId='.$fichaId;
        $info = $dbm->Execute($sql);
        $info = $info->fields;
        //proprint_struc($info);
        return $info["nombre"];
  }

  function searchDataBase($moduloId){
      global $dbm;
        $dbm->SetFetchMode(ADODB_FETCH_ASSOC);
      $sql = 'SELECT CONCAT(i.dbNombre,".",i.tablaRef) as nameTable 
                FROM '.$this->tableName[4].' i
                WHERE i.itemId='.$moduloId;
      $info = $dbm->Execute($sql);
      $info = $info->fields;
      //print_struc($info);
      return $info["nameTable"];  
  }



  function getDataTableFichas($arrayGet,$nameTable,$fichasSeteadas,$moduloId){
         global $dbm,$getModule,$module, $smoduleName, $privFace, $objCatalog;
        $aux = false;
        $columns = $columnsSelect = array();
      /* Easy set variables*/
      
      // Array of database columns which should be read and sent back to DataTables.
        // The `db` parameter represents the column name in the database, while the `dt`
        // parameter represents the DataTables column identifier. In this case simple indexes
        $dataItem = $this->dataFichas;
        
        $columnsDefault = array(array("db"=>' ',"dt"=>0),array("db"=>'itemId',"dt"=>1));
        $contColumnDefault = count($columnsDefault)-1;
        $columnsSelect = $this->pluck($columnsDefault,"db");
        foreach($dataItem["campo"] as $idx2 => $row2){
              array_push($columns,array( 'db' => $row2,   'dt' => $idx2+1 ));
              array_push($columnsSelect,$row2);
            }//END FOREACH
      $columns = array_merge($columnsDefault,$columns);

      /* Indexed column (used for fast and accurate table cardinality) */
      $primaryKey = "itemId";
  
      /* DB table to use */
      $table = $nameTable." i ";
  
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

    if ( isset($arrayGet['search']) && $arrayGet['search']['value'] != '' ) {
      $str = $arrayGet['search']['value'];
//echo $str;
      for ( $i=0, $ien=count($arrayGet['columns']) -1; $i<$ien ; $i++ ) {
        
        $requestColumn = $arrayGet['columns'][$i];

        $columnIdx = array_search( $requestColumn['data'], $dtColumns );
        $column = $columns[ $columnIdx ]; 
                //print_r( $column);
        //if ( $requestColumn['searchable'] == 'true' ) { 
            
          $valFilter = $arrayGet["search"]["value"];
          $pos = strpos($valFilter, "'");
          if($pos !== false ){
            $valFilter = str_replace("'", "\'", $valFilter);
          }
          
          //if(isset($dataItem[$columnIdx-1]["tabla"])){
                    $columnIdx--;
            $globalSearch[] = "i.nombre LIKE '%".$valFilter."%'";
          //}else{
            //$globalSearch[] = "`".$column['db']."` LIKE '%".$valFilter."%'";  
          //}//END IF
                    
        //}//END IF
                
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
    $where = '';
    // Combine the filters into a single string
    if ( $fichasSeteadas!=NULL ) {
      $where = ' i.itemId NOT IN('.$fichasSeteadas.') AND';
    }
    
    if ( count( $globalSearch ) ) {
      $where .= ' ('.implode(' OR ', $globalSearch).') AND';
    }

    if ( count( $columnSearch ) ) {
      $where = $where === '' ?
        implode(' AND ', $columnSearch) :
        $where .' AND '. implode(' AND ', $columnSearch);
    }


    if ( $where !== '' ) {
      $where = 'WHERE '.$where;
      $where = substr($where,0,-3);
    }
        //$where.= " AND i1.tipo= ".$tipoRiego." ";
        /* SQL queries
       * Get data to display */
        //$columns = $this->pluck($columns,'db');
        $columns = $columnsSelect;

   
        $sql = "SELECT SQL_CALC_FOUND_ROWS ".str_replace(" , ", " ", implode(", i.", $columns));
        
        
                     
        $sql.= " FROM ".$table." ".$sForm;
        
        $sql.= " $where $order $limit"; //print_struc($sql);
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
      $indice = 0;
      foreach ( $rResult as $aRow ){
        $indice++;
        $row = array();
          $contRow++;
        
          for ( $i=0 ; $i<count($columns) ; $i++ ){  
          
            if($i==1){
            
              $action='';
              $nameaux = utf8_encode($aRow["nombre"]);  
              $nameaux = str_replace("'", "&#039;", $nameaux);
               //$vasrasd =str_replace(',','', $aRow["itemId"]);
                 $action.= '<a href="javascript:void(0);" onclick="setPersonas('.$aRow["itemId"].', \''.$moduloId.'\');"><img src="./template/user/images/icon/add.png" width="20px"/></a>';
            
               $row[] = $action;
             }else if($i!=0){
                $row[] = utf8_encode($aRow[$columns[$i]]);
             }else{
                $row[] = $indice;
             }
             
        }//END FOR
          
        $output['aaData'][] = $row;
      }//END FOREACH
        
        return json_encode( $output );
    }

  public function saveFichasItem($idFicha,$idFichaSet,$idModulo,$nameTable){
    global $dbm,$getModule,$module, $smoduleName, $privFace, $portada;
    //echo $idFicha." ".$idFichaSet." ".$idModulo." ".$nameTable." ";
    $res = array();
      if($privFace["crear"]){
        $rec["tecnicoId"]= $idFicha;
        $rec["fichaId"]=$idFichaSet;
        $rec["moduloId"] = $idModulo;       
        $rec["dateCreate"] = $rec["dateUpdate"] = date("Y-m-d H:i:s");
        $rec["userCreate"] = $rec["userUpdate"] = $rec["administradorId"] = $this->userId;

        $ressave = $dbm->AutoExecute($this->tableName[3],$rec);
        if($ressave){
            $res["res"] = 1;
            $res["id"] = $id = $dbm->Insert_ID();           
          }else{
            $res["res"] = 2;
            $res["msg"] = utf8_encode('No se logro realizar el registro correspondiente.');
            $res["msgdb"] = utf8_encode($dbm->ErrorMsg());
          }
         
      }else{
        $res["res"] = 2;
        $res["msg"] = utf8_encode('No tiene permisos para realizar esta operaci???n.');
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
    
    /** Funcion que retorna listado de los catalogos
     * @param $id: int default: null
     * @param $idficha: int; 
     * 
     * @return $res: array
     **/
    function listCatalogoPermiso(){
        global $objCatalog,$objItem;
        
        $objCatalog->configCatalogListPermiso();
        $cataobj = $objCatalog->getCatalogList();//print_struc($cataobj);
      //  unset($cataobj["core_submodulo"]); 
       
        return $cataobj;        
    }
    
    /** Funcion que retorna listado de los catalogos
     * @param $id: int default: null
     * @param $idficha: int; 
     * 
     * @return $res: array
     **/
    function listCatalogoPermisoUsuario($itemId){
        global $dbm;
        $dbm->SetFetchMode(ADODB_FETCH_ASSOC);
        
        $sql = 'SELECT m.itemId, m.titulo
                FROM '.$this->tableName[0].' i
                    ,'.$this->tableName[2].' sm
                    ,'.$this->tableName[1].' m
                
                WHERE i.usuarioId='.$itemId." AND i.subModuloId=sm.itemId AND sm.moduloId=m.itemId 
                GROUP BY m.itemId
                ORDER BY m.titulo ASC";
        $info = $dbm->Execute($sql);
        $info = $info->GetRows();
        
        $info = $this->getArrayData($info,"itemId","titulo",1);

        return $info;
    }
    
    function getListPermiso($id=null, $fichaId){
        global $dbm;

        $sql = 'SELECT i.subModuloId
                FROM '.$this->tableName[0].' i
                WHERE i.usuarioId='.$fichaId;
        
        if($id!=null){
            $sql.= ' AND i.subModuloId!='.$id;
        }

        $info = $dbm->Execute($sql);
        $info = $info->GetRows();  
        $info = $this->array_column($info,"subModuloId");
      
        return $info;
    } 
    
    /** Funcion extra de una matriz a una arreglo
     * @param $input: array
     * @param $column_key: int
     * @param $index_key: int; DEFAULT NULLL
     * @return array
     **/
      function array_column( array $input, $column_key=null, $index_key = null ) {
    
        $result = array();
        foreach( $input as $k => $v )
          if($column_key!=null){
            $result[ $index_key ? $v[ $index_key ] : $k ] = $v[ $column_key ];
          }else{
            foreach($v as $k2 => $v2){
              $result[ $k2 ] = $v2;
            }
          }
        return $result;
      }
     
     
     
     function listSubmodulo(){
        global $dbm;
        
        $dbm->SetFetchMode(ADODB_FETCH_ASSOC);
        
        $sql = "SELECT i.itemId, i.nombre, i.moduloId, i.parent,i2.nombre as parentName, m.titulo as moduloName
                FROM ".$this->tableName[2]." i
                , ".$this->tableName[2]." i2
                , ".$this->tableName[1]." m
                WHERE i.activo=1 AND i.moduloId=m.itemId AND i.parent!=0 AND i.parent=i2.itemId
                ORDER BY m.titulo ASC, i2.nombre ASC";
        $info = $dbm->Execute($sql);
        $info = $info->GetRows();
        
        return $info;
     }

     function getFichasSet($fichaId,$moduloId,$nameTable){
        global $dbm;
        
        $dbm->SetFetchMode(ADODB_FETCH_ASSOC);
        
        $sql = "SELECT GROUP_CONCAT(i.fichaId) as fichasIds
                FROM ".$this->tableName[3]." i                
                WHERE i.moduloId =".$moduloId." AND i.tecnicoId=".$fichaId;
        //echo $sql;
        $info = $dbm->Execute($sql);
        $info = $info->fields;
        return $info["fichasIds"];
     }

     function listModulos(){
        global $dbm;
        
        $dbm->SetFetchMode(ADODB_FETCH_ASSOC);
        
        $sql = "SELECT i.itemId, i.nombre
                ,CONCAT(i.dbNombre,'.',i.tablaRef) as nameTable

                FROM ".$this->tableName[4]." i                
                ORDER BY i.itemId ASC";
        $info = $dbm->Execute($sql);
        $info = $info->GetRows();
        //echo $sql;
        return $info;
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
        
        $resprocesa = $this->procesaDatos($tipoTabla,$rec);
       
        if($resprocesa["res"]==1){
          
          $recrow["dateCreate"] = $recrow["dateUpdate"] = date("Y-m-d H:i:s");
          $recrow["userCreate"] = $recrow["userUpdate"] = $this->userId;
          $recrow["usuarioId"] = $resprocesa["rec"]["id"];
          
          $right = 0;$wrong = 0;$msgwrong = '';  
          foreach($resprocesa["rec"]["list"] as $row){
            
            $resParent = $this->verificarParent($row,$resprocesa["rec"]["id"]);
            
            if($resParent["res"]==1){             
            
                $recrow["subModuloId"] = $row;
                $recrow["tipo"] = 0;
                $ressave = $dbm->AutoExecute($this->tableName[$tipoTabla],$recrow);
                
                if($ressave){
                 $right++;
                }else{
                  $wrong++;
                  $msgwrong.= "\n\t - Error en el ingreso submodulo (".$row."): ".$dbm->ErrorMsg();
                }//END IF
                
            }else{
              $wrong++;
              $msgwrong.= "\n\t - Error en el ingreso del padre del submodulo (".$row."): ".$resParent["msg"];
            }//END IF
            
          }//END FOREACH
          
          if($wrong==0){
            $res["res"] = 1;
            
          }else{
            $res["res"] = 2;
            $res["msg"] = utf8_encode('No se logro realizar el registro correspondiente.');
            $res["msgdb"] = utf8_encode($msgwrong);
          }
              
        }else{
            $res["res"] = 2;
            $res["msg"] = "Los siguientes campos no son validos: ".$resprocesa["msg"];
        }
         
      }else{
        $res["res"] = 2;
        $res["msg"] = utf8_encode('No tiene permisos para realizar esta operaci???n.');
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
                    
                    if(count($rec["list"])==0){
                      $bRigth=1;
                      $msgRigth.=utf8_encode('<br>- Seleccione submodulos para el usuario.');  
                    }
                      
                    if(trim($rec["id"])==0 || trim($rec["id"])==""){
                      $bRigth=1;
                      $msgRigth.=utf8_encode('<br>- ID de usuario inv???lido.');  
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
      
    function getSubmoduloItem($fichaId){
        global $dbm;
        $dbm->SetFetchMode(ADODB_FETCH_ASSOC);
        
        $sql = 'SELECT i.subModuloId 
                FROM  '.$this->tableName[0].' i
                WHERE i.usuarioId='.$fichaId;
        $info = $dbm->Execute($sql);
        $info = $info->GetRows();

        $res = '';
        
        if(count($info)>0){
          foreach($info as $row){
            $res.= ''.$row["subModuloId"].", ";
          }
          $res = substr($res,0,-2);
        }

        return $res;
    }
    
    /**
	 * Elimina una ficha de presa
	 * 
	 * @param int $id
	 * @return array fields
	 */
     
     function deleteItem($id,$itemId){
        global $dbm,$privFace;
      
        if($privFace["eliminar"]){
            
            if(trim($id)){
                            
                $sql = "delete from ".$this->tableName[3]." WHERE itemId=".$id;//echo ":::".$sql;
                $resdelete = $dbm->Execute($sql);
                
                if($resdelete){
                  $res["res"] = 1;
                    
                }else{
                  $res["res"] = 2;  
                  $res["msg"] = utf8_encode($dbm->ErrorMsg());
                }
                
              
            }else{
              $res["res"] = 2;  
              $res["msg"] = utf8_encode("No existe ID de la presa");  
            }
        }else{
            $res["res"] = 2;  
            $res["msg"] = utf8_encode("No tiene los permisos para eliminar una ficha");
        }
        
        return $res;
     }
     
}
