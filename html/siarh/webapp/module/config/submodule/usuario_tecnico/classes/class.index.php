<?php
class Index extends Table {
    //var $prefix;
	function __construct(){
	   global $CFG,$module,$smoduleName, $dbm,$CFGm;
       $smoduleTableName = $CFGm->dbDatabase.".";
       //$this->prefix = $CFG->prefix;
       $this->prefix = $CFG->prefix;
       $this->tableName = $smoduleTableName."core_usuario";
       
       $smoduleTableName = $this->prefix."institucion".".";
       $this->conteTableName[0] = $smoduleTableName."item";
       $smoduleTableName = $CFGm->dbDatabase.".";
       $this->conteTableName[1] = $smoduleTableName."core_submodulo";
       $this->conteTableName[2] = $smoduleTableName."core_modulo";
       $this->conteTableName[3] = $smoduleTableName."core_usuario_permisos";
       $this->conteTableName[4] = $smoduleTableName."core_grupo";
       $this->conteTableName[5] = $smoduleTableName."core_catalogo_modulo_tecnicos";
	   $this->idName = "itemId";
       
       $this->userId = $_SESSION["userv"]["memberId"]; 
       
        /*Configuracion de preguntas II*/
       $this->dataItem = array("usuario"=>array(1=>array("campo"=>"portada"
                                                        ,"descripcion"=>"Foto"
                                                        ,"tipoInput"=>"file")
                                              ,2=>array("campo"=>"usuario"
                                                       ,"descripcion"=>"Usuario"
                                                       ,"tipoInput"=>"text")
                                              ,3=>array("campo"=>"nombre"
                                                       ,"descripcion"=>"Nombre(s)"
                                                       ,"tipoInput"=>"text")
                                              ,4=>array("campo"=>"apellido"
                                                       ,"descripcion"=>"Apellido(s)"
                                                       ,"tipoInput"=>"text")
                                              ,5=>array("campo"=>"tipoUsuario"
                                                       ,"descripcion"=>"Tipo usuario"
                                                       ,"tipoInput"=>"select")
                                              ,6=>array("campo"=>"institucionId"
                                                       ,"descripcion"=>"Instituci�n"
                                                       ,"tabla"=>$this->conteTableName[0]
                                                       ,"tipoInput"=>"select")
                                              ,7=>array("campo"=>"grupoId"
                                                       ,"descripcion"=>"Grupo"
                                                       ,"tabla"=>$this->conteTableName[4]
                                                       ,"tipoInput"=>"select")
                                              ,8=>array("campo"=>"lastLogin"
                                                       ,"descripcion"=>"Ultimo ingreso"
                                                       ,"tipoInput"=>"select")
                                              ,9=>array("campo"=>"telefono"
                                                       ,"descripcion"=>"Telefono"
                                                       ,"tipoInput"=>"number")
                                              ,10=>array("campo"=>"celular"
                                                       ,"descripcion"=>"Celular"
                                                       ,"tipoInput"=>"number")
                                             ,11=>array("campo"=>"email"
                                                       ,"descripcion"=>"E-mail"
                                                       ,"tipoInput"=>"text")
                                             ,12=>array("campo"=>"direccion"
                                                      ,"descripcion"=>"Direcci�n"
                                                      ,"tipoInput"=>"text")
                                             ,13=>array("campo"=>"descripcion"
                                                      ,"descripcion"=>"Descripci�n"
                                                      ,"tipoInput"=>"text")
                                            ,14=>array("campo"=>"ip"
                                                      ,"descripcion"=>"IP")
                                            ,15=>array("campo"=>"activo"
                                                      ,"descripcion"=>"Activo")
                                            ,16=>array("campo"=>"dateCreate"
                                                      ,"descripcion"=>"Fecha Creaci�n")
                                            ,17=>array("campo"=>"dateUpdate"
                                                      ,"descripcion"=>"Fecha Actualizaci�n"))
                              ,"permiso"=>array(1=>array("campo"=>"moduloId"
                                                       ,"descripcion"=>"Modulo"
                                                       ,"tipoInput"=>"select"
                                                       ,"tabla"=>$this->conteTableName[5]),
                                                2=>array("campo"=>"fichaId"
                                                       ,"descripcion"=>"Item"))
                              ,"submodulo"=>array(1=>array("campo"=>"nombre"
                                                        ,"descripcion"=>"Submodulo")
                                              ,2=>array("campo"=>"moduloId"
                                                       ,"descripcion"=>"Modulo"
                                                       ,"tabla"=>$this->conteTableName[2])
                                              ,3=>array("campo"=>"parent"
                                                       ,"descripcion"=>"Submodulo"
                                                       ,"tabla"=>$this->conteTableName[1] )));
       
       
        //==================================
		// Directorio de datos del modulo
		//==================================
	    $this->directory = $CFG->data.$module."/";
	    $this->viewDirectory($this->directory);
	    $this->directory = $this->directory.$smoduleName."/";//Cargamos la carpeta del modulo
	    $this->viewDirectory($this->directory);//verificamos si existe la carpeta, si no existe lo crea
       
	}
    
    function getConfig($tipo){
      $aux = $this->dataItem[$tipo];
      
      return $aux;
    }
    
    /** 
     * Construye el json del datatable para listado de usuarios
     * @param $arrayGet : array
     * 
     * @return $output : json
     **/
    function itemDatatableRows($arrayGet){
         global $dbm,$getModule,$module, $smoduleName, $privFace, $objCatalog, $subcontrol;
        
        $columns = $columnsSelect = array();
    	/* Easy set variables*/
	
    	// Array of database columns which should be read and sent back to DataTables.
        // The `db` parameter represents the column name in the database, while the `dt`
        // parameter represents the DataTables column identifier. In this case simple indexes
        $dataItem = $this->getConfig("usuario");
        
        $columnsDefault = array(array("db"=>' ',"dt"=>0),array("db"=>'itemId',"dt"=>1));
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
    	$table = $this->tableName." i ";
	
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
//	$dtColumns = $columns;
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
				    $globalSearch[] = "i".$columnIdx.".nombre LIKE '%".$valFilter."%'";
				  }else{
				    if($columnIdx==6){
				      $globalSearch[] = " IF(i.tipoUsuario=0,'administrador',IF(i.tipoUsuario=1,'administrador','tecnico')) LIKE '%".$valFilter."%'";   
				    }else{
				      $globalSearch[] = "i.".$column['db']." LIKE '%".$valFilter."%'";
                    }  
				  }//END IF
                  	
				}//END IF
                
			}//END FOR
		}//END IF

		// Individual column filtering
		for ( $i=0, $ien=count($arrayGet['columns']) ; $i<$ien ; $i++ ) {
			$requestColumn = $arrayGet['columns'][$i];
			$columnIdx = array_search( $requestColumn['data'], $dtColumns );
			$column = $columns[ $columnIdx ];

			$str = $requestColumn['search']['value'];

			if ( $requestColumn['searchable'] == 'true' && $str != '' ) {
				//$binding = $this->bind( $bindings, '%'.$str.'%', PDO::PARAM_STR );
                //$binding = $this->bind($bindings);

				if($columnIdx==7 || $columnIdx==6 || $columnIdx==8 || $columnIdx==16){
				  $columnSearch[] = " i.".$column['db']." = '".$str."' ";    
				}else{
				  $columnSearch[] = " i.".$column['db']." LIKE '%".$str."%' ";  
				}

			}
		}

		// Combine the filters into a single string
		$where = ' i.tipoUsuario IN(3) ';

    if ($_SESSION["userv"]["tipoUsuario"] != 0 && $_SESSION["userv"]["tipoUsuario"] != 1)
            $where.= ' AND i.institucionId IN ( '.$_SESSION["userv"]["instituciones"].") ";

		if ( count( $globalSearch ) ) {
			$where .= ' AND ('.implode(' OR ', $globalSearch).')';
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
                        ";
        
        $sForm = '';
        
        foreach($dataItem as $idx => $row){
            
          if(isset($row["tabla"])){
            $sql.= " , i".$idx.".nombre as ".$row["campo"]."Name ";
            $sForm.=" LEFT JOIN ".$row["tabla"]." i".$idx." ON i.".$row["campo"]."=i".$idx.".itemId ";
          }//END IF
           
        }//END FOREACH
                        
        $sql.= " FROM ".$table." ".$sForm;
        $sql.= " $where $order $limit";     
//echo $sql;
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
                		 "iTotalRecords" => $iTotal== NULL?0:$iTotal,
                		 "iTotalDisplayRecords" => $iFilteredTotal==NULL ?0:$iFilteredTotal,
                		 "iSummary" => $this->getSummary($where),
                		 "aaData" => array());
    
	    $contRow = $arrayGet['iDisplayStart'];
        $listTipoUsuario = $objCatalog->getArrayTipoUsuario();
        $activo = $objCatalog->getArrayCondicion();
     //   print_struc($columns);
    	foreach ( $rResult as $aRow ){
 
    	  $row = array();
          $contRow++;
    	  
          for ( $i=0 ; $i<count($columns) ; $i++ ){  
             if($i==0){
               $btnDetail = '<img src="./template/user/images/icon/details_open.png" class="iconDetail"/> ';
               $row[] = $contRow;
              
               $action='';
               if($aRow["activo"]==1)
                  $btnPrincipal = '<img src="template/user/images/icon/active.png" class="iconDetail" onclick="updatePrincipal('.$aRow["itemId"].',0)"/>';
                 else
                  $btnPrincipal = '<img src="template/user/images/icon/deactive.png" class="iconDetail" onclick="updatePrincipal('.$aRow["itemId"].',1)"/>';
               
               //$action .=$btnPrincipal;

               $btnEditar = '<a  href="javascript:void(0);" onclick="itemUpdate('.$aRow["itemId"].',\'update\')" class="linkAction">
                             <center> <img src="./template/user/images/icon/ver2.png" border="0" title="Modificar"/></center></a>';
               $action.= $btnEditar;
          
               if($privFace["eliminar"] && $aRow["totalItem"]==0){
                 $nameaux = utf8_encode(str_replace('"', "&#034;", $aRow["nombre"]));  
                 $nameaux = utf8_encode(str_replace("'", "&#039;", $nameaux));
                 $btnEliminar = '<a href="javascript:void(0);" onclick="itemDelete('.$aRow["itemId"].',\''.$nameaux.'\')" title="Delete Item" class="linkAction">
                                <img src="./template/user/images/icon/delete.png" title="Eliminar" border="0" /></a>';
                 //$action.= $btnEliminar;
               }
          
               $row[] = $action;
             }elseif($i==2){
                $numRand = rand(10, 100);
                if($aRow["portada"]==1)
                  $row[] = '<img src="'.$getModule.'&accion=general_getPhoto&type=1&itemId='.$aRow[$primaryKey].'&rand='.$numRand.'" />';
                else
                  $row[] = "";  
             }elseif( $i==7 || $i==8){//PAra campos enlazados a otras tablas (catalogo)
    		   $row[] = utf8_encode($aRow[$columns[$i]."Name"]);
             }elseif($i==6){
               $row[] = ($listTipoUsuario[$aRow[$columns[$i]]]);
             }elseif($i==16){
                $row[] = $activo[$aRow[$columns[$i]]];
             }elseif($i!=1){
                $row[] = utf8_encode($aRow[$columns[$i]]);
             }
             
    	  }//END FOR
          
    	  $output['aaData'][] = $row;
    	}//END FOREACH
        
        return json_encode( $output );     
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

  function updatePrincipal($rec,$id){
        global $dbm;
        $res = array();

        if($id!="" && $id!=0){
            $rec["dateCreate"] = date("Y-m-d H:i:s");
            $rec["userUpdate"] = $this->userId;
            
            $resupdate = $dbm->AutoExecute($this->tableName,$rec,"UPDATE","itemId=".$id);
            
            if($resupdate){
              $res["res"] = 1;
              $res["id"] = $id;
            }else{
              $res["res"] = 2;
              $res["msg"] = utf8_encode("Error: No se logro actualizar en la BD. ".$dbm->ErrorMsg());
            }
          }else{
          $res["res"] = 2;
          $res["msg"] = utf8_encode("No existe el ID del elemento seleccionado.");  
        }
        
        return $res;
    }

    function getSummary($sWhereAux){
         global $dbm;
        $dbm->SetFetchMode(ADODB_FETCH_ASSOC);
   
        $sql = 'SELECT COUNT(3) as totalItem
                FROM '.$this->tableName.' i
                LEFT JOIN '.$this->conteTableName[0].' i6 on i.institucionId=i6.itemId
                LEFT JOIN core_grupo i7 on i.grupoId=i7.itemId
                ';
        $sql.= $sWhereAux;
        
//echo "=>".$sql;
        $info = $dbm->Execute($sql);
        $info = $info->fields;
        
        return $info;
        
    }
    
    
    function getItem($id){
      global $dbm;
      $dbm->SetFetchMode(ADODB_FETCH_ASSOC);
      
      $sql = "SELECT i.*
              FROM ".$this->tableName." i  
              WHERE i.itemId=".$id;
      $info = $dbm->Execute($sql);
      $info = $info->fields;
      
      return $info;        
    }
    
    function setOptions($list){
        $options = '<option value="0">Seleccione una Provincia</option>';
        foreach($list as $key=>$row){
            $options.='<option value="'.$key.'">'.utf8_encode($row).'</option>';
        }
        $res["opt"] = $options; 
        return $res;
    }
    
    /**
	 * Elimina una ficha de presa
	 * 
	 * @param int $id
	 * @return array fields
	 */
     
     function deleteItem($id){
        global $dbm,$privFace;
      
        if($privFace["eliminar"]){
            
            if(trim($id)){
                
              $respermiso = $this->deleteItemTabla($id,3);
              
              if($respermiso==1){              
                $sql = "delete from ".$this->tableName." WHERE itemId=".$id;//echo ":::".$sql;
                $resdelete = $dbm->Execute($sql);
                
                if($resdelete){
                  $res["res"] = 1;
                  
                  //Eliminamos foto adjunto
                  $this->directory = $this->directory.$id."/";
                  $res["file"] = $this->deleteModuleFiles($id,1,0);
                  
                }else{
                  $res["res"] = 2;  
                  $res["msg"] = utf8_encode($dbm->ErrorMsg());
                }
                
              }else{
                $res["res"] = 2;  
                $msguax = "No se logro eliminar datos de la tabla:";
                
                if($respermiso==0)
                  $msguax.= "\n - Permisos";
                  
                $res["msg"] = utf8_encode($msguax);
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
     
     function deleteItemTabla($id,$idx){
        global $dbm;
        $dbm->SetFetchMode(ADODB_FETCH_ASSOC);
        
        $sql = "delete from ".$this->conteTableName[$idx]." WHERE usuarioId=".$id;//echo ":::".$sql;
        $resdelete = $dbm->Execute($sql);
        
        if($resdelete)
          return 1;
        else
          return 0;
                
     }
     
     
	/**
	 * Table::deleteModuleFiles()
	 * Borra la portada o el archivos adjunto o los dos
	 * 
	 * @param integer $id
	 * @param integer $portada Portada
	 * @param integer $file Adjuntos
	 * @return void
	 */
	function deleteModuleFiles($id,$portada=1,$file=0){
		global $core,$db;
		if($portada==1){
			$dirPortada = $this->directory."";
			$res["default"] = unlink($dirPortada."".$id.".jpg");
            $res["small"] = unlink($dirPortada."small/".$id.".jpg");//
            $res["vsmall"] = unlink($dirPortada."vsmall/".$id.".jpg");
			$res["medium"] = unlink($dirPortada."medium/".$id.".jpg");//
			$res["big"] = unlink($dirPortada."big/".$id.".jpg");//
			$res["panel"] = unlink($dirPortada."panel/".$id.".jpg");
            $res["thumbails_a"] = unlink($dirPortada."thumbails/a_".$id.".jpg");
            $res["thumbails_b"] = unlink($dirPortada."thumbails/b_".$id.".jpg");
            $res["thumbails_c"] = unlink($dirPortada."thumbails/c_".$id.".jpg");
            
            if($res["default"] && $res["small"] && $res["vsmall"] && $res["medium"] && $res["big"]
               && $res["panel"] && $res["thumbails_a"] && $res["thumbails_b"] && $res["thumbails_b"] ){
               $res["res"]=1; 
            }else{
               $res["res"]=2; 
            }
		}	
        
		if($file==1){
			$dirAttached = $this->directory."attached/";
			
			$sql = "select attachedExt from ".$this->conteTableName." where ".$this->conteIdName."=".$id;
			$info = $db->Execute($sql);
			$datos = array();
			$datos["attached"]=0;
			$datos["attachedName"]="";
			$datos["attachedSize"]="";
			$datos["attachedUpdate"]=date('Y-m-d H:i:s');
			$datos["attachedType"]="";
			$datos["attachedExt"] = "";
			$resupdate = $db->AutoExecute($this->conteTableName,$datos,'UPDATE',$this->conteIdName.' = '.$id);
			
            if($resupdate==1){
			  $res["res"] = 1;
              //$core->writeLog(print_r($info->fields,true),__FILE__,__LINE__); 
			  $resunlink = unlink($dirAttached.$id.".".$info->fields["attachedExt"]);
              
              if($resunlink){ 
                $res["file"] = 1;
              }else{ 
                $res["file"] = 2;
                $res["msg"] = utf8_encode("No se logro elimnar fisicamente el anexo: ".$id);
              }  
              
            }else{
              $res["res"] = 2;
              $res["msg"] = "No se elimin� el registro de la BD. ".$db->ErrorMsg();
            }
		}
        return $res;
	}
    
    
    function pdfDompdf($idficha){
        global $dbm,$CFG,$core,$smarty,$templateModulePrintPage,$pathmodule,$module,$smoduleName,$objCatalog;
        
        require_once('./lib/dompdf/dompdf_config.inc.php');
        $dompdf = new DOMPDF();
        /**
         * Datos para mostrar en el PDF
         */

        $item = $this->getDataPrintItem($idficha);
       // print_struc($item);exit;
        $objCatalog->configCatalogList();
        $cataobj = $objCatalog->getCatalogList();
        
        $smarty->assign('item',$item);
        $smarty->assign('id',$idficha);
        $smarty->assign('userprint', $this->getUserPrint());
        date_default_timezone_set('America/La_Paz');
        $smarty->assign('dateprint', date("d/m/Y  H:i:s"));
        
        $html = $smarty->fetch($templateModulePrintPage);
        
        $dompdf->load_html(utf8_encode($html));
        $dompdf->set_paper("letter");
        $dompdf->render();
        $options[Attachment]=0;
        
        $dompdf->stream(date("Ymd_His_").'- Ficha_Lineabase ID-'.$item['itemId'].'.pdf',$options);
    }    
    
    
    function getDataPrintItem($id){
        global $dbm,$objCatalog;
        $dbm->SetFetchMode(ADODB_FETCH_ASSOC);
        
        $sql = "SELECT i.*, p.nombre as proyectoName 
                      ,CONCAT(e.nombres,' ',e.apellidos) as encuestadorName  
                      ,(SELECT CONCAT(ip.nombres,' ',ip.apellidos) 
                        FROM ".$this->conteTableName[1]." ip 
                        WHERE ip.encuestado=1 AND i.itemId=ip.lineaBaseId) as encuestadoName
                      , d.nombre as departamentoName
                      , m.nombre as municipioName  
                FROM ".$this->tableName." AS i
                LEFT JOIN ".$this->prefix."proyecto.item p ON p.itemId=i.proyectoId
                LEFT JOIN ".$this->conteTableName[8]." e ON e.itemId=i.encuestadorId
                LEFT JOIN ".$this->prefix."catalogo.catalogo_departamento d ON d.itemId=i.departamentoId
                LEFT JOIN ".$this->prefix."catalogo.catalogo_municipio m ON m.codigoINE=i.municipioId
                
                WHERE i.itemId=".$id;//echo "=>".$sql;
        $item = $dbm->Execute($sql);
        $item = $item->fields;
        
        $item["listSocio"] = $this->getListItem($id,1);
        $item["listServicio"] = $this->getListItem($id,2);
        $item["listAgricola"] = $this->getListItem($id,3);
        $item["listAnimales"] = $this->getListItem($id,4);
        $item["listLeche"] = $this->getListItem($id,5);
        $item["listDesicion"] = $this->getListItem($id,6);
        $item["listTecnologia"] = $this->getListItem($id,7);
        
        return $item;
    }
    
    function getListItem($id,$tipo){
        global $dbm;
        $dbm->SetFetchMode(ADODB_FETCH_ASSOC);
   
        $sql = 'SELECT i.*
                FROM '.$this->conteTableName[$tipo].' i
                WHERE i.lineaBaseId='.$id;//echo $sql;
        $info = $dbm->Execute($sql);
        $info = $info->GetRows();
        
        return $info;
    }
    
    function getUserPrint(){
        global $db;
        $db->SetFetchMode(ADODB_FETCH_ASSOC);
        $sql = "SELECT CONCAT(u.nombre,' ',u.apellido) as username FROM core_usuario u WHERE u.itemId=".$this->userId;
        $info = $db->Execute($sql);
        return $info->fields;   
    }
    
}

