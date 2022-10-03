<?
require_once("./lib/hftimage/hft_image.php");
/**
 * Table
 * @copyright 2009
 * @version $Id$
 * @access public
 */
class Table
{
	var $idName;
	var $tableName;
	var $conteTableName;
    var $conteTableNameGis;
	var $conteIdName;
    var $prefBD;
	var $prefix;
    var $pref;

	var $directory;

	var $core;
	var $obj_datatable;
    /**
     * variables de submodulos
     */
    public $dbm;
    public $userId;
    public $catalogList;
    public $grilla;
    public $grilla_tablas_adicionales;
    public $tabs;
    public $campos;
    public $item_tab = array();
    public $privSM;
    public $privFace;
    public $userv;
    public $tabla;
    public $tabla_core;
    public $pentaho;
    var $image;
    /**
     * Variable para generar los archivos Excel
     */
    public $objExcel;

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
    function datatable_getsform($dataItem){
        $sForm = '';
        $sql = '';
        foreach($dataItem as $idx => $row){
            if(isset($row["tabla"])){
                $idxAux = $idx;
                $sql.= " , i".$idxAux.".nombre as ".$row["campo"]."name ";
                $sForm.=" LEFT JOIN ".$row["tabla"]." i".$idxAux." ON i.".$row["campo"]."=i".$idxAux.".itemId";

            }
        }
        $resp = array();
        $resp["sql"] = $sql;
        $resp["sForm"] = $sForm;
        return $resp;
    }

    function datatable_getfilter2($where,$arrayGet,$requestColumn,$columns,$dataItem,$column){
        $globalSearch = array();
        $columnSearch = array();

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
                        if($columnIdx==2){
                            $globalSearch[] = "i".$columnIdx."1.nombre LIKE '%".$valFilter."%'";
                        }else{
                            $globalSearch[] = "i".$columnIdx.".nombre LIKE '%".$valFilter."%'";
                        }
                    }else{
                        if($columnIdx>=3 && $columnIdx<=10){
                            $globalSearch[] = " REPLACE(REPLACE(REPLACE(FORMAT(i.".$column['db'].", 2), '.', '@'), ',', '.'), '@', ',') LIKE '%".$valFilter."%'";

                        }elseif($columnIdx==11){
                            $globalSearch[] = " REPLACE(REPLACE(REPLACE(FORMAT((i.pro_ejecutado_apl + i.pro_ejecutado_fuente), 2), '.', '@'), ',', '.'), '@', ',') LIKE '%".$valFilter."%'";

                        }else{
                            $globalSearch[] = " i.".$column['db']." LIKE '%".$valFilter."%'";
                        }
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
        /**
         * Respondiento
         */
        $resp = array();
        $resp["where"] = $where;
        return $resp;
    }
    function datatable_getfilter($where,$arrayGet,$requestColumn,$columns,$dataItem,$column){
        $globalSearch = array();
        $columnSearch = array();
        $dtColumns = $this->pluck( $columns, 'dt' );
        if ( isset($arrayGet['search']) && $arrayGet['search']['value'] != '' ) {

            $str = $arrayGet['search']['value'];

            for ( $i=0, $ien=count($arrayGet['columns']) ; $i<$ien ; $i++ ) {

                $requestColumn = $arrayGet['columns'][$i];


                $columnIdx = array_search( $requestColumn['data'], $dtColumns );

                $column = $columns[ $columnIdx ];
/*
                print_struc($dtColumns);
                print_struc($requestColumn);
                print_struc($columnIdx);
                print_struc($column);
                exit;
*/

                if ( $requestColumn['searchable'] == 'true' ) {
                    $valFilter = $arrayGet["search"]["value"];
                    if(isset($dataItem[$columnIdx-1]["tabla"])){
                        $columnIdx--;
                        $globalSearch[] = "i".$columnIdx.".nombre LIKE '%".$valFilter."%'";
                    }else{
                        if($columnIdx==2 || $columnIdx==3 || $columnIdx==5 || $columnIdx==7 || $columnIdx==9){
                            $globalSearch[] = " REPLACE(REPLACE(REPLACE(FORMAT(i.".$column['db'].", 2), '.', '@'), ',', '.'), '@', ',') LIKE '%".$valFilter."%'";
                        }else{
                            $globalSearch[] = " i.".$column['db']." LIKE '%".$valFilter."%'";
                        }
                    }
                }
            }
        }

        // Individual column filtering
        for ( $i=0, $ien=count($arrayGet['columns']) ; $i<$ien ; $i++ ) {
            $requestColumn = $arrayGet['columns'][$i];
            $columnIdx = array_search( $requestColumn['data'], $dtColumns );
            $column = $columns[ $columnIdx ];

            $str = $requestColumn['search']['value'];

            if ( $requestColumn['searchable'] == 'true' && $str != '' ) {
                //$binding = $this->bind( $bindings, '%'.$str.'%', PDO::PARAM_STR );
                //$binding = $this->bind($bindings);
                /*if($columnIdx==2 || $columnIdx==3 || $columnIdx==4 || $columnIdx==5){
                  $columnSearch[] = " i.".$column['db']." IN (".$str.") ";
                }else{*/
                $columnSearch[] = " i.".$column['db']." LIKE '%".$str."%' ";
                /*}*/
            }
        }

        // Combine the filters into a single string
        if ( count( $globalSearch ) ) {
            $where.= ' ('.implode(' OR ', $globalSearch).')';
        }

        if ( count( $columnSearch ) ) {
            $where = $where === '' ?
                implode(' AND ', $columnSearch) :
                $where .' AND '. implode(' AND ', $columnSearch);
        }
        if ( $where !== '' ) {
            $where = 'WHERE '.$where;
        }
        /**
         * Respondiento
         */
        $resp = array();
        $resp["where"] = $where;
        return $resp;
    }
    function datatable_getorder($arrayGet,$columns,$dataItem,$column){
        $order = '';

        if ( isset($arrayGet['order']) && count($arrayGet['order']) ) {
            $orderBy = array();
            $dtColumns = $this->pluck( $columns, 'dt' );

            for ( $i=0, $ien=count($arrayGet['order']) ; $i<$ien ; $i++ ) {
                // Convert the column index into the column data property
                $columnIdx = intval($arrayGet['order'][$i]['column']);
                $requestColumn = $arrayGet['columns'][$columnIdx];

                $columnIdx = array_search( $requestColumn['data'], $dtColumns );

                $tablaIdx = $columnIdx-1;
                if(isset($dataItem[$tablaIdx]["tabla"])){

                    $column['db'] = "i".$tablaIdx.".nombre ";

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
        $resp = array();
        $resp["order"] = $order;
        $resp["column"] = $column;
        $resp["requestColumn"] = $requestColumn;
        return $resp;
    }
    /**
     * @param $dataItem:array
     * @param $columnsDefault:array
     * @return array
     */
    function datatable_getcolumn($dataItem,$columnsDefault){
        $columns = $columnsSelect = array();

        //print_struc($columnsDefault);exit;
        $contColumnDefault = count($columnsDefault)-1;
        $columnsSelect = $this->pluck($columnsDefault,"db");

        foreach($dataItem as $idx => $row){
            if(is_array($row["campo"])){
                foreach($row["campo"] as $idx2 => $row2){
                    array_push($columns,array( 'db' => $row2,   'dt' => $idx2 ));
                    array_push($columnsSelect,$row["campo"]);
                }
            }else{
                array_push($columns,array( 'db' => $row["campo"],   'dt' => $idx+$contColumnDefault ));
                array_push($columnsSelect,$row["campo"]);
            }
        }

        $columns = array_merge($columnsDefault,$columns);
        $resp = array();
        $resp["select"] = $columnsSelect;
        $resp["columns"] = $columns;
        return $resp;
    }

    function postgis_getNivel5($rec,$id){
      global $dbsig, $CFGm,$core, $CFG;
      
      if($CFG->bPosgresql){
        postgisConnect();
        $sql = "SELECT * FROM \"UH_NIVEL5_NOMBRES\"
                WHERE
                ST_intersects(geom, ST_GeomFromText('POINT(".$rec["longitudDec"]." ".$rec["latitudDec"].")',".$CFGm->proyeccion."))
                limit 1";
        $info = $dbsig->Execute($sql);
        if (!$info) $core->errordb_log("postgre",$dbsig->ErrorMsg(),__FILE__,__LINE__);
        $item = $info->fields;
      
        return $item;
      }//END IF
      
    } 
    
    function postgisVerifica($id){
      global $dbsig,$CFGm,$core, $CFG;
      
      if($CFG->bPosgresql){
        $sql = "select itemId from ".$CFGm->sigTable." as f where f.itemId=".$id;
        $info = $dbsig->Execute($sql);
        if (!$info) $core->errordb_log("postgre",$dbsig->ErrorMsg(),__FILE__,__LINE__);
        
        return $info->RecordCount();
      }//END IF
    }
    
    function postgis_activo($id,$fichaId,$valor,$padreField="fichaId",$campo="activo"){
      global $dbsig,$CFGm,$core,$CFG;
      
      if($CFG->bPosgresql){  
        /**
         * Primero reseteamos todos los activos
         */
        $sql = "update ".$CFGm->sigTable." set ".$campo."=0 where ".$padreField."='".$fichaId."' ";
        $info = $dbsig->Execute($sql);
        
        if (!$info) $core->errordb_log("postgre",$dbsig->ErrorMsg(),__FILE__,__LINE__);
        
        /**
         * Asignamos el nuevo registro que sera el principal
         */
        if($valor == 1){
            $sql = "update ".$CFGm->sigTable." set ".$campo."=1 where ".$padreField."='".$fichaId."' and itemId='".$id."'";
            $info = $dbsig->Execute($sql);
            if (!$info) $core->errordb_log("postgre",$dbsig->ErrorMsg(),__FILE__,__LINE__);
        }
        
      }//END IF
      
    }
    
    function convertirFormatoDecimal($rec){
        global $dbsig,$CFGm;

        $rec = str_replace(".", "", $rec);
        $rec = str_replace(",", ".", $rec);

        return $rec;
    }
            
    function postgisDelete($id,$idname="itemId"){
      global $dbsig,$CFGm,$core,$CFG;
      
      if($CFG->bPosgresql){
        $sql = "delete from ".$CFGm->sigTable." as f where f.".$idname."=".$id;
        $info = $dbsig->Execute($sql);
        if (!$info) $core->errordb_log("postgre",$dbsig->ErrorMsg(),__FILE__,__LINE__);
        
        if($info){
          $res["res"] = 1;  
        }else{
          $res["res"] = 2;
          $res["msg"] = utf8_encode("No se logro eliminar de la B.D.");
          $res["msgdb"] = utf8_encode($dbsig->ErrorMsg());  
        }
        
        return $res;
      }//END IF
      
    }
    
    function getCatalogList(){
        $res = array();
        foreach($this->catalogList as $row){
            if($row["parent"]==0){
                $res[$row["nombre"]] = $this->getCatalogListSimple($row);                
            }else{
                $res[$row["nombre"]] = $this->getCatalogListGroup($row);
            }            
        }
        return $res;
    }
    
    function getCatalogListSimple($row){
        $this->dbm->SetFetchMode(ADODB_FETCH_ASSOC);
        $sql = "select ".$row["id"].",".$row["dato"]." from ".$row["tabla"]." ";
        if($row["where"]!=""){
            $sql.=" where ".$row["where"]." ";
        }

        $sql.=" ORDER BY ".$row["orden"]." ".$row["dirOrden"];
        $info = $this->dbm->Execute($sql);
        $item = $info->GetRows();

        if($row["concatena"])$dato = $row["orden"];
        else $dato = $row["dato"];
        //$opt = $this->getArrayData($item,$row["id"],$row["dato"],$row["noutf8"]);
        $opt = $this->getArrayData($item,$row["id"],$dato,$row["noutf8"]);
        
        return $opt;
    }
    
    function getCatalogListGroup($row){
        $this->dbm->SetFetchMode(ADODB_FETCH_ASSOC);
        $sql = "select ".$row["id"].",".$row["dato"]." from ".$row["tabla"]." ";
        $sql .= "where parent=0 ";
        if($row["where"]!=""){
            $sql.=" and ".$row["where"]." ";
        }
        //$sql.=" ORDER BY ".$row["orden"]." ASC";
        $sql.=" ORDER BY ".$row["orden"]." ".$row["dirOrden"]; //echo $sql;
        $info = $this->dbm->Execute($sql);
        $item = $info->GetRows();
        
        $opt = array();
        foreach($item as $dato){
            $con = $row;
            $con["where"] = "parent=".$dato[$row["id"]];
            $opt[utf8_encode($dato[$row["dato"]])] = $this->getCatalogListSimple($con); 
        }
                
        return $opt;
    }
    
    /**
     * Table::addCatalogList()
     * 
     * A�ade items al arreglo que ser� procesado
     * para sacar los datos
     * 
     * $tabla = es el nombre de la tabla de donde sacara el dato
     * $id = id para formar el arreglo (Si es vacio por defecto ser� "itemId")
     * $dato = es el nombre del campo que contiene el dato (Si es vacio por defecto sera "nombre")
     * $noutf8 = 1:normal, 0:codificaci�n utf8 (si es vacio por defecto sera "0")
     * 
     * @param string $tabla
     * @param string $nombre
     * @param string $id
     * @param string $dato
     * @param int $noutf8
     * @param string $orden_$dir
     * @param string $where
     * @param int $parent
     * @return void
     */
    function addCatalogList($tabla,$nombre,$id,$datoaux,$noutf8,$orden="",$where="",$parent="",$concatena=0){
        
        $dato = array();
        $dato["tabla"] = $tabla;
        $dato["nombre"] = (trim($nombre)=="")?$tabla:trim($nombre);
        $dato["id"] = (trim($id)=="")?"itemId":trim($id);
        $dato["dato"] = (trim($datoaux)=="")?"nombre":trim($datoaux);
        $dato["noutf8"] = (trim($noutf8)=="")?0:trim($noutf8);
        $ordenAux = explode("|",$orden);
        //$dato["orden"] = (trim($orden)=="")?"nombre":trim($orden);
        $dato["orden"] = (trim($ordenAux[0])=="")?$dato["dato"]:trim($ordenAux[0]);
        $dato["dirOrden"] = (!isset($ordenAux[1]) || trim($ordenAux[1])=="")?"ASC":trim($ordenAux[1]);
        $dato["where"] = (trim($where)=="")?"":trim($where);
        $dato["parent"] = (trim($parent)=="")?0:trim($parent);
        $dato["concatena"] = (trim($concatena)=="")?0:trim($concatena);

        $this->catalogList[] = $dato;
    }
    /**
     * Table::getArrayData()
     * 
     * Permite enviar un arreglo que nos devolvera otro arreglo con
     * codificaci�n utf8 o no, para poder implementar los options en smarty y otros
     * 
     * $item = Arreglo de datos 
     * $var1 = nombre del campo que ser� la llave
     * $var2 = nombre cel campo que contiene el dato de texto
     * $tipo= 1 si es utf8 y 0 si no lo es (codificaci�n de $var2)
     * 
     * @param mixed $item
     * @param mixed $var1
     * @param mixed $var2
     * @param integer $tipo
     * @return
     */
    function getArrayData($item,$var1,$var2,$tipo=0){
        $opt = array();
        foreach($item as $row){
            if ($tipo==1){
                $opt[$row[$var1]] = utf8_encode($row[$var2]);
            }else{
                $opt[$row[$var1]] = $row[$var2];
            }
        }
		return $opt;
    }
    
	/**
	 * Table::subirFotoServidor()
	 * 
	 * @param mixed $foto
	 * @param mixed $directorio
	 * @return void
	 */
	function subirFotoServidor($foto, $directorio){
	   
        $nombreFoto = $foto['name'];
        $originalFoto = $foto["tmp_name"];
        $this->viewDirectory($directorio);
        
        $this->viewDirectory($directorio."vsmall/");
        $this->viewDirectory($directorio."small/");
        $this->viewDirectory($directorio."medium/");
        $this->viewDirectory($directorio."big/");  
        $this->viewDirectory($directorio."panel/");
        $this->viewDirectory($directorio."thumbails/");

        $res["copy"] = copy($originalFoto,$directorio.$nombreFoto);
        
        //====================================================
        $image = new hft_image($originalFoto);
        $image->set_parameters('85');
        
        $contRigth=0;
        $contWrong=0;
    
        //============================================================
        //= Genera imagen para mostrar en zpanel, width maximo 50
        //= height maximo 50
        //============================================================
        $image->resize(50,'*', '-'); //Foto tama�o 100 px ancho PEQUE�O para mostrar en zpanel
        $res["panel"] = $image->output_resized($directorio."panel/".$nombreFoto, "JPEG");
        chmod($directorio."panel/".$nombreFoto,0777);
        
        if($res["panel"]) $contRigth++;
        else $contWrong++;
        
        //============================================================
        $image->resize(32,32, '-'); //Foto tama�o Medium width maximo 150px height maximo 113px
        $res["vsmall"] = $image->output_resized($directorio."vsmall/".$nombreFoto, "JPEG");
        chmod($directorio."vsmall/".$nombreFoto,0777);
        if($res["vsmall"]) $contRigth++;
        else $contWrong++;
        
        $image->resize(170,'*', '-'); //Foto tama�o Medium width maximo 150px height maximo 113px
        $res["small"] = $image->output_resized($directorio."small/".$nombreFoto, "JPEG");
        chmod($directorio."small/".$nombreFoto,0777);
        if($res["vsmall"]) $contRigth++;
        else $contWrong++;
        
        $image->resize(500,500, '-'); //Foto tama�o Medium width maximo 400px height maximo 300px
        $res["medium"] = $image->output_resized($directorio."medium/".$nombreFoto, "JPEG");
        chmod($directorio."medium/".$nombreFoto,0777);
        if($res["vsmall"]) $contRigth++;
        else $contWrong++;
        
        $image->resize(740,600,'-'); //Foto tama�o Grande width maximo 700px height maximo 525px
        $res["big"] = $image->output_resized($directorio."big/".$nombreFoto, "JPEG");
        chmod($directorio."big/".$nombreFoto,0777);
        if($res["big"]) $contRigth++;
        else $contWrong++;
        
        $image->set_parameters('90');
        
        $squareOriginal = $directorio."medium/".$nombreFoto;
            
        $tbc = $directorio."thumbails/a_".$nombreFoto;
        $this->saveSquareThumb($squareOriginal,$tbc,50);
        chmod($tbc,0777);
            
        $tbc = $directorio."thumbails/b_".$nombreFoto;
        $this->saveSquareThumb($squareOriginal,$tbc,32);
        chmod($tbc,0777);
        
        $tbc = $directorio."thumbails/c_".$nombreFoto;
        $this->saveSquareThumb($squareOriginal,$tbc,100);
        chmod($tbc,0777);
        
        if($contWrong>0)
          $res["msg"] = utf8_encode("No se crearon todas las imagenes");  
        
        return $res;
	}
    
	/**
	 * Table::getExtFile()
	 * 
	 * @param mixed $name
	 * @return
	 */
	function getExtFile($name){

		$extFile = $name;
		$extFile = strrev($extFile); //volcamos la cadena  archivo.hola.doc  = cod.aloh.ovihcra  doc
		$extFile = explode(".",$extFile);
		$extFile = $extFile[0];
		$extFile = strrev($extFile);
        $extFile = trim($extFile);
		return $extFile;
	}
	
    /**
	 * Table::viewDirectory()
	 * 
	 * @param mixed $dir
	 * @return void
	 */
	function viewDirectory($dir){
		if(!file_exists($dir)){	$res= mkdir($dir, 0777);}
	}
	
    /**
	 * Table::upDateContePortada()
	 * 
	 * @param mixed $portada
	 * @param mixed $id
	 * @return void
	 */
    function upDateContePortada($portada,$itemId,$id,$contenedorDir=''){
      global $db,$CFG;

        if($contenedorDir!=''){
          $dirPortada = $this->directory.$contenedorDir."/";
        }else{
          $dirPortada .= $this->directory.$id."/";
        }
        $this->viewDirectory($dirPortada);
       
		$foto["name"]= "$itemId.jpg";
		$foto["tmp_name"]= $portada["tmp_name"];

		$res["upload"] = $this->subirFotoServidor($foto,$dirPortada);

		$datos=array();
		$datos["photoUpdate"] = date('Y-m-d H:i:s');
        $datos["photoType"] = $portada["type"];
        $datos["photoSize"] = $portada["size"];
  
		$resupdate = $db->AutoExecute($this->conteTableName,$datos,'UPDATE',$this->idName.' = '.$itemId);
        
        if($resupdate){
          $res["res"] = 1;  
        }else{
          $auxmsg = $db->ErrorMsg();  
          $res["res"] = 2;
          $res["res"] = utf8_encode("No se actualizo datos de la imagen en la BD.<br />".$auxmsg);  
        }
        return $res; 
    }  

	/**
	 * Table::upDateConteAdjunto()
	 * 
	 * @param mixed $attached
	 * @param mixed $id
	 * @param integer $update
	 * @return void
	 */
	function upDateConteAdjunto($attached,$id,$update=0,$contenedorDir=''){
		global $dbm;
        if($contenedorDir!=''){
            $dirAttached = $this->directory.$contenedorDir."/";
        }else{
            $dirAttached = $this->directory."attached/";
        }
		$this->viewDirectory($dirAttached);

		//======================================================
		// Si es un update primer borra el archivo anterior
		//======================================================
		if($update==1){
			$sql = "select attachedExt from ".$this->conteTableName." where ".$this->conteIdName."=".$id;
			$info = $dbm->Execute($sql);
			unlink($dirAttached.$id.".".$info->fields["attachedExt"]);
		}
		//======================================================
		//= Tratamiento para optener la extensi�n del archivo  =
		//======================================================
		$extFile = $this->getExtFile($attached["name"]);
		//======================================================
		$filecp = $dirAttached.$id.".".$extFile;
		if(copy($attached["tmp_name"],$filecp)){$copy = 1;
		}else{$copy = 0;}
		if ($copy==1){
			chmod($filecp,0777);
			$datos = array();
			$datos["attached"]=1;
			$datos["attachedName"]=$attached["name"];
			$datos["attachedSize"]=$attached["size"];
			$datos["attachedUpdate"]=date('Y-m-d H:i:s');
			$datos["attachedType"]=$attached["type"];
			$datos["attachedExt"] = $extFile;
            //$dbm->debug=true;
            //$dbm->SetCharSet("latin1");
			$ressave = $dbm->AutoExecute($this->conteTableName,$datos,'UPDATE',$this->conteIdName.' = '.$id);
            
            if($ressave){
              $res["res"] = 1;    
            }else{
              $res["res"] = 2;  
              $res["msg"] = utf8_encode($dbm->ErrorMsg());
            }//END IF
            
		}else{
		  $res["res"] = 2;
          $res["msg"] = "No se copio el archivo en el servidor.";
		}//END IF
		
        return $res;
	}
	
	/**
	 * Table::deleteModuleFiles()
	 * Borra la portada o el archivos adjunto o los dos
	 * 
	 * 
	 * @param integer $id
	 * @param integer $portada Portada
	 * @param integer $file Adjuntos
	 * @return void
	 */
	function deleteModuleFiles($id,$portada=1,$file=0){
		global $core,$db;
		if($portada==1){
			$dirPortada = $this->directory;
			//echo "==".$dirPortada;
            $res["default"] = unlink($dirPortada.$id.".jpg");
            $res["big"] = unlink($dirPortada."big/".$id.".jpg");
            $res["medium"] = unlink($dirPortada."medium/".$id.".jpg");
            $res["panel"] = unlink($dirPortada."panel/".$id.".jpg");
            $res["small"] = unlink($dirPortada."small/".$id.".jpg");
			$res["thumbails_a"] = unlink($dirPortada."thumbails/a_".$id.".jpg");
            $res["thumbails_b"] = unlink($dirPortada."thumbails/b_".$id.".jpg");
            $res["thumbails_c"] = unlink($dirPortada."thumbails/c_".$id.".jpg");
			$res["vsmall"] = unlink($dirPortada."vsmall/".$id.".jpg");
            
            if($res["default"] && $res["big"] && $res["medium"] && $res["panel"] && $res["small"] && $res["thumbails_a"] && $res["thumbails_b"] && $res["thumbails_c"] && $res["vsmall"]){
              $res["res"] = 1;
            }else{
              $res["res"] = 2;
              $res["msg"] = utf8_encode("No se logr� eliminar todos las fotos");  
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
              if($resunlink) $res["file"] = 1;
              else $res["file"] = 2;
              
            }else{
              $res["res"] = 2;
              $res["msg"] = "No se elimin� el registro de la BD. ".$db->ErrorMsg();
            }
		}
        return $res;
	}

    /**
     * La funcion borra todo le directorio 
     *
     */
    public static function deleteDir($dirPath) {
      if ( is_dir($dirPath)) {
        if (substr($dirPath, strlen($dirPath) - 1, 1) != '/') {
          $dirPath .= '/';
        }
        $files = glob($dirPath . '*', GLOB_MARK);
        
        foreach ($files as $file) {
          if (is_dir($file)) {
              self::deleteDir($file);
          } else {
              unlink($file);
          }
        }
        rmdir($dirPath);
      }
    }

	/**
	 * Verifica si el padre contiene un padre
	 *
	 * @param integer $id
	 */
	function verifiesParent($id){
		global $db;
	
		  $sql = "select parent from ".$this->tableName." where ".$this->idName."=".$id;
          $info = $db->Execute($sql);
          if ($info->fields["parent"]=="0"){
            return 0;
          }else{
            return $info->fields["parent"];
          }
	}
    
    /**
     * Funcion Recursiva
     */
	function viewParent($id){
		global $db;
		$sql = "select parent from ".$this->tableName." where ".$this->idName."=".$id;
		$info = $db->Execute($sql);
		if ($info->fields["parent"]=="0"){
			return "0";
		}else{
			$miga = $this->viewParent($info->fields["parent"]);
			if($miga == "0"){
				return $info->fields["parent"]."'";
			}else{
				return $miga.",'".$info->fields["parent"]."'";
			}
		}
	}

    function saveSquareThumb($file, $savePath, $thumbD=120){
        //Obtenemos la informacion de la imagen, el array info tendra los siguientes indices:
        // 0: ancho de la imagen
        // 1: alto de la imagen
        // mime: el mime_type de la imagen        
        $info = getimagesize($file);
        //Dependiendo del mime type, creamos una imagen a partir del archivo original:
        
        switch($info['mime']){
            case 'image/jpeg':
                $image = imagecreatefromjpeg($file);
                break;
            case 'image/gif';
                $image = imagecreatefromgif($file);
                break;
            case 'image/png':
                $image = imagecreatefrompng($file);
                break;
        }
        $image = imagecreatefromjpeg($file);
        //Si el ancho es igual al alto, la imagen ya es cuadrada, por lo que podemos ahorrarnos unos pasos:		
        if($info[0] == $info[1]){
            $xpos = 0;
            $ypos = 0;
            $width  = $info[0];
            $height = $info[1];
        }else{//Si la imagen no es cuadrada, hay que hacer un par de averiguaciones:
            if($info[0] > $info[1]){ 
                //imagen horizontal
                $xpos = ceil(($info[0] - $info[1]) /2);
                $ypos = 0;
                $width  = $info[1];
                $height = $info[1];
            }else{ 
                //imagen vertical
                $ypos = ceil(($info[1] - $info[0]) /2);
                $xpos = 0;
                $width  = $info[0];
                $height = $info[0];
            }
        }
        //Creamos una nueva imagen cuadrada con las dimensiones que queremos:
        $image_new = imagecreatetruecolor($thumbD, $thumbD);
        $bgcolor = imagecolorallocate($image_new, 255, 255, 255);  
        imagefilledrectangle($image_new, 0, 0, $thumbD, $thumbD, $bgcolor);
        imagealphablending($image_new, true);
        
        //Copiamos la imagen original con las nuevas dimensiones
        imagecopyresampled($image_new, $image, 0, 0, $xpos, $ypos, $thumbD, $thumbD, $width, $height);
        
        //Guardamos la nueva imagen como jpg con una calidad del 85%
        imagejpeg($image_new, $savePath, 85);
    }

    function convertGeo($str){
        $str = explode("-",$str);
        $str = "-".$str[0]."�".$str[1]."'".$str[2]."\"";
        $str = utf8_decode($str);
        return $str;
        
    }
    function get_dec_to_utm($datum,$latitud,$longitud){

        require_once('./lib/gpoint/Class.GeoConversao.php');
        $conv = new GeoConversao();

        require_once('./lib/gpoint/gPoint.php');
        $myHome = new gPoint($datum);


        $lat = $conv->Dd2DMS($latitud);
        $lon = $conv->Dd2DMS($longitud);

        $lat = str_replace(" ","",$lat);
        $lat = explode("-",$lat);
        $lat[2] = round(trim($lat[2]),2);
        $lat = $lat[0].'-'.$lat[1]."-".$lat[2];


        $lon = str_replace(" ","",$lon);
        $lon = explode("-",$lon);
        $lon[2] = round(trim($lon[2]),2);
        $lon = $lon[0].'-'.$lon[1]."-".$lon[2];


        $myHome->setLongLat($longitud,$longitud);
        $myHome->convertLLtoTM();
        $res['utmNorthing'] = (int)$myHome->N();
        $res['utmEasting'] = (int)$myHome->E();
        $res['utmZone'] = $myHome->Z();

        $res['latitud'] = $lat;
        $res['longitud'] = $lon;

        return($res);


    }
    function getUtmDec($datum, $latD, $longD){
        /**
         * Convertimos datos
         */
        $latD = $this->convertGeo($latD);
        $longD = $this->convertGeo($longD);
        
        require_once('./lib/gpoint/Class.GeoConversao.php');
        $conv = new GeoConversao();
        
        require_once('./lib/gpoint/gPoint.php'); 
        $myHome = new gPoint($datum);
        
        $auxLatD = $conv->DMS2Dd($latD);
        $auxLongD = $conv->DMS2Dd($longD);

        $res["latDec"]=$auxLatD;
        $res["lngDec"]=$auxLongD;

        //print_struc($res);

        $myHome->setLongLat($auxLongD,$auxLatD);
        $myHome->convertLLtoTM();
        $res['utmNorthing'] = (int)$myHome->N();
        
        $res['utmEasting'] = (int)$myHome->E();
        
        $res['utmZone'] = $myHome->Z();
        
        return $res;
    }

    function getUtmLL($datum, $latD, $longD){

        require_once('./lib/gpoint/gPoint.php');
        $myHome = new gPoint($datum);

        $myHome->setLongLat($longD,$latD);
        $myHome->convertLLtoTM();
        $res['utmNorthing'] = (int)$myHome->N();

        $res['utmEasting'] = (int)$myHome->E();

        $res['utmZone'] = $myHome->Z();

        return $res;
    }

    function getLatData($datum,$utmZona, $latUtm, $longUtm){
        /**
         * Convertimos datos
         */

        require_once('./lib/gpoint/Class.GeoConversao.php');
        $conv = new GeoConversao();
        
        require_once('./lib/gpoint/gPoint.php'); 
        $myHome = new gPoint($datum);
        
        //$res["latDec"]=$auxLatD;
        //$res["lngDec"]=$auxLongD;
        
        $myHome->setUTM($latUtm,$longUtm,$utmZona);
        $myHome->convertTMtoLL();
        $res['latDec'] = $myHome->Lat();
        $res['lngDec'] = $myHome->Long();
        
        $latRes = $this->DECtoDMS($res['latDec']);
        $lngRes = $this->DECtoDMS($res['lngDec']);


        $latRes["sec"] = round(trim($latRes["sec"]),2);
        $lngRes["sec"] = round(trim($lngRes["sec"]),2);

        $res["latDMS"] = $latRes["deg"]."-".$latRes["min"]."-".$latRes["sec"];
        $res["lngDMS"] = $res["lngDMS"] = $lngRes["deg"]."-".$lngRes["min"]."-".$lngRes["sec"];

        $res["latDMS"] = substr($res["latDMS"],1);
        $res["lngDMS"] = substr($res["lngDMS"],1);

        return $res;
    }

    function DMStoDEC($deg,$min,$sec)
    {

    // Converts DMS ( Degrees / minutes / seconds ) 
    // to decimal format longitude / latitude

        return $deg+((($min*60)+($sec))/3600);
    }    

    function DECtoDMS($dec)
    {

    // Converts decimal longitude / latitude to DMS
    // ( Degrees / minutes / seconds ) 

    // This is the piece of code which may appear to 
    // be inefficient, but to avoid issues with floating
    // point math we extract the integer part and the float
    // part by using a string function.

        $vars = explode(".",$dec);
        $deg = $vars[0];
        $tempma = "0.".$vars[1];

        $tempma = $tempma * 3600;
        $min = floor($tempma / 60);
        $sec = $tempma - ($min*60);

        return array("deg"=>$deg,"min"=>$min,"sec"=>$sec);
    }  

    function getInstitucionList($institucion = null){
        global $dbm;
        $dbm->SetFetchMode(ADODB_FETCH_ASSOC);
        $where="";
        if ($institucion != null)
            $where = " and i.itemId=$institucion ";
        $sql = "SELECT i.itemId, i.nombre 
                FROM vrhr_institucion.item i WHERE i.tipoId=1 $where 
                ORDER BY i.itemId ASC";
                
        $list = $dbm->Execute($sql);
        $list = $list->GetRows();
        
        $res = array();
        foreach($list as $row){
            $res[$row["itemId"]] = utf8_encode($row["nombre"]);
        }   
        return $res;
    }

    function getSituacionList($usuario=0){
        global $dbm;
        $dbm->SetFetchMode(ADODB_FETCH_ASSOC);
        $where="";
        if ($usuario == 2)
            $where = " WHERE i.itemId IN (1,2)";
        else if ($usuario == 3)
            $where = " WHERE i.itemId IN (3,4)";            
        $sql = "SELECT i.itemId, i.nombre 
                FROM vrhr_catalogo.situacion i $where 
                ORDER BY i.itemId ASC";
                
        $list = $dbm->Execute($sql);
        $list = $list->GetRows();
        
        $res = array();
        foreach($list as $row){
            $res[$row["itemId"]] = utf8_encode($row["nombre"]);
        }   
        return $res;
    }
    
    function setUtf8($str,$ban){
        if($ban==1){
            return utf8_encode($str);
        }else{
            return $str;
        }
    }
    
    function postgisUpdateItem($id,$tipoTabla){
      global $dbm, $dbsig, $CFG;
      
      if($CFG->bPosgresql){
      
      if(trim($id)){
        
        $sSelect = 'SELECT i.itemId, i.nombre ';
        $sWhere = ' WHERE i.itemId='.$id;

        switch($tipoTabla){
            case '1': //Inventario
                    $this->conteTableNameGis = 'vrhr_inventario_item';
                    $sFrom = ' FROM vrhr_inventario.item i';
                    
                    $sSelect.=', i.cuencaPrincipal as cuenca_aporte, i.arRegable as area_regable, i.arRegableInvierno as area_invierno
                                 , i.arRegableVerano as area_verano, i.arRegableAnual as area_anual, i.familias as num_familia
                                 , cs.nombre as situacion, d.nombre as departamento
                                 , m.nombre as municipio, ca.nombre as alcance_proyecto
                                 , cag.nombre as zona_agroecologica, cn5.nombre as cuenca_nivel5
                                 , (SELECT COUNT(f.itemId) FROM vrhr_inventario.item_fuenteagua f WHERE f.fichaId=i.itemId) as num_fuente_agua
                                 , (SELECT GROUP_CONCAT(ifa.nombre SEPARATOR "; ") FROM vrhr_inventario.item_fuenteagua ifa WHERE ifa.fichaId=i.itemId) as fuente_agua_nombres
                                 , (SELECT SUM(ifa.volumen) FROM vrhr_inventario.item_fuenteagua ifa WHERE ifa.fichaId=i.itemId) as volumen_anual
                                 , (SELECT SUM(ifa.caudalSeca) FROM vrhr_inventario.item_fuenteagua ifa WHERE ifa.fichaId=i.itemId) as caudal_invierno
                                 , (SELECT SUM(ifa.caudalLluvia) FROM vrhr_inventario.item_fuenteagua ifa WHERE ifa.fichaId=i.itemId) as caudal_verano
                                 , (SELECT SUM(ifa.caudalSeca+ifa.caudalLluvia) FROM vrhr_inventario.item_fuenteagua ifa WHERE ifa.fichaId=i.itemId) as caudal_anual
                                 , (SELECT SUM(ipt.tenenciaMenor) FROM vrhr_inventario.item_poblaciontenencia ipt WHERE ipt.fichaId=i.itemId) as num_familia_menor_hectarea
                                 , (SELECT SUM(ipt.tenenciaMayor) FROM vrhr_inventario.item_poblaciontenencia ipt WHERE ipt.fichaId=i.itemId) as num_familia_mayor_hectarea
                                 , (SELECT GROUP_CONCAT(ct.nombre SEPARATOR ";") FROM vrhr_inventario.item_usotecnologia iut, vrhr_inventario.catalogo_tecnologia ct WHERE ct.itemId=iut.tecnologiaId AND ct.tipoId=1 AND iut.fichaId=i.itemId) as gravedad
                                 , (SELECT GROUP_CONCAT(ct.nombre SEPARATOR ";") FROM vrhr_inventario.item_usotecnologia iut, vrhr_inventario.catalogo_tecnologia ct WHERE ct.itemId=iut.tecnologiaId AND ct.tipoId=2 AND iut.fichaId=i.itemId) as presurizado
                                 , CONCAT(cu.nombre, cu.apellido) as usr_ingreso                    
                                 ';    
                      $sFrom.=' LEFT JOIN vrhr_catalogo.situacion cs ON cs.itemId=i.situacionId
                                LEFT JOIN vrhr_territorio.departamento d ON d.itemId=i.departamentoId
                                LEFT JOIN vrhr_territorio.municipio m on m.itemId=i.municipioId
                                LEFT JOIN vrhr_inventario.catalogo_alcance ca ON ca.itemId=i.alcanceId
                                LEFT JOIN vrhr_catalogo.agroecologica cag on cag.itemId=i.agroecologicaId 
                                LEFT JOIN vrhr_cuenca.nivel5 cn5 on cn5.itemId=i.nivel5Id
                                LEFT JOIN '.$this->tabla_core["usuario"].' cu on cu.itemId=i.userCreate';
                      
                      $sql = $sSelect.$sFrom.$sWhere."";
                      $item = $dbm->Execute($sql);
                      $item = $item->fields;
                      $this->prefBD = 'vrhr_inventario'; 
                      $item["tipo_infrestructura"] = $this->getInfraestructura($item["itemId"]);
                      
                    if($this->verificaPostItem($id)){//Actualiza
                      $this->updatePostItem($tipoTabla,$item);  
                    }else{//Registra
                      $this->savePostItem($tipoTabla,$item);
                    }
                break;
                
            case '2': //Presa
                    $this->conteTableNameGis = 'vrhr_presa_item';
                    $sFrom = ' FROM vrhr_presa.item i';
                    
                    $sSelect.=', i.codigo as codigo, i.rio, i.cuenca_volumen as capacidad_embalse, i.cuenca_capacidad as capacidad_util
                     , i.altura as altura_maxima_nivel_lecho, i.coronamiento_longitud as longitud_corona
                     , i.coronamiento_ancho as ancho_corona, i.excedencia_posicion as posicion
                     , i.excedencia_caudal as caudal, i.excedencia_retorno as periodo_retorno
                     , cu.nombre as uso_embalse, ctp.nombre as tipo_presa  
                     , m.nombre as municipio, d.nombre as departamento
                     , ce.nombre as estado, cn5.nombre as cuenca_nivel5
                     , cex.nombre as tipo_vertedor_excedencias';
          
                      $sFrom.=' LEFT JOIN vrhr_presa.catalogo_uso cu ON cu.itemId=i.usoId
                                LEFT JOIN vrhr_territorio.departamento d ON d.itemId=i.departamentoId
                                LEFT JOIN vrhr_territorio.municipio m on m.itemId=i.municipioId
                                LEFT JOIN vrhr_presa.catalogo_tipo ctp ON ctp.itemId=i.tipoId
                                LEFT JOIN vrhr_presa.catalogo_estado ce on ce.itemId=i.estadoId
                                LEFT JOIN vrhr_cuenca.nivel5 cn5 on cn5.itemId=i.nivel5Id
                                LEFT JOIN vrhr_presa.catalogo_excedencia cex on cex.itemId=i.excedenciaId';
                      
                      $sql = $sSelect.$sFrom.$sWhere."";
                      $item = $dbm->Execute($sql);
                      $item = $item->fields;
                      
                    if($this->verificaPostItem($id)){//Actualiza
                      $this->updatePostItem($tipoTabla,$item);  
                    }else{//Registra
                      $this->savePostItem($tipoTabla,$item);
                    }
                break;
                
            case '3': //Proyecto
                    $this->conteTableNameGis = 'vrhr_proyecto_item';
                    $sFrom = ' FROM vrhr_proyecto.item i';
                    
                    $sSelect.=', ce.nombre as estado_Proyecto, cs.nombre as estado_ficha
                             , ins.nombre as programa
                             , i.sisin as sisin, i.ambiental as codigo_licencia_ambiental, i.siam as codigo_siam
                             , i.fechaInicio as fecha_inicio, i.fechaFin as fecha_fin, i.fechaEntrega as fecha_entrega
                             , i.diasEjecucion as dias_ejecutados, i.areaIncremental as area_incremental
                             , i.familias as familias, i.caudal_captacion as caudal_captacion
                             , cf.nombre as fase
                             , (select group_concat(cti.nombre separator ", ") 
                                from vrhr_proyecto.item_tipo_inversion as iti 
                                    , vrhr_proyecto.catalogo_tipo_inversion as cti
                                where cti.itemId = iti.tipoinversionId and iti.proyectoId = i.itemId )as tipo_inversion
                             , ctp.nombre as tipo_proyecto, ccar.nombre as cartera
                             , m.nombre as municipio, d.nombre as departamento
                             , (select group_concat(ccomp.nombre separator ", ") 
                               from vrhr_proyecto.item_estructura_financiera as ief
                               left join vrhr_proyecto.catalogo_componente as ccomp on ccomp.itemId = ief.componenteId
                               where ief.proyectoId = i.itemId ) as componentes
                             , (select sum(ief.presupuesto_inicial) 
                                from vrhr_proyecto.item_estructura_financiera as ief
                                where ief.proyectoId = i.itemId )as presupuesto_inicial
                             , (select sum(ief.contratado ) 
                                from vrhr_proyecto.item_estructura_financiera as ief
                                where ief.proyectoId = i.itemId )as contratado
                             , (select sum(ief.modificado ) 
                                from vrhr_proyecto.item_estructura_financiera as ief
                                where ief.proyectoId = i.itemId ) as modificado
                             , (select sum(ief.vigente ) 
                                from vrhr_proyecto.item_estructura_financiera as ief
                                where ief.proyectoId = i.itemId ) as vigente
                             , (select sum(ief.avance) 
                                from vrhr_proyecto.item_estructura_financiera as ief
                                where ief.proyectoId = i.itemId ) as avance_financiero_bs
                             , (select sum(ief.avance/ief.vigente) 
                                from vrhr_proyecto.item_estructura_financiera as ief
                                where ief.proyectoId = i.itemId ) as avance_financiero_porc
                             , (select sum(ipm.ejecucion_fisica ) 
                                from vrhr_proyecto.item_pagos_mes as ipm
                                where ipm.proyectoId = i.itemId )as avance_fisico_porc
                              ';
                  
                  $sFrom.=' LEFT JOIN vrhr_proyecto.catalogo_estado ce on ce.itemId=i.estadoId
                            LEFT JOIN vrhr_catalogo.situacion cs on cs.itemId=i.situacionId
                            left join vrhr_institucion.item as ins on ins.itemId = i.institucionId
                            left join vrhr_proyecto.catalogo_fase cf on cf.itemId = i.faseId
                            left join vrhr_proyecto.catalogo_tipo_proyecto as ctp on ctp.itemId = i.tipoproyectoId
                            LEFT JOIN vrhr_territorio.departamento d ON d.itemId=i.departamentoId
                            LEFT JOIN vrhr_territorio.municipio m on m.itemId=i.municipioId
                            left join vrhr_proyecto.catalogo_cartera as ccar on ccar.itemId = i.carteraId ';


                  $sql = $sSelect.$sFrom.$sWhere."";

                  $item = $dbm->Execute($sql);
                  $item = $item->fields;
                      
                  if($this->verificaPostItem($id)){//Actualiza
                    $this->updatePostItem($tipoTabla,$item);  
                  }else{//Registra
                    $this->savePostItem($tipoTabla,$item);
                  }
                break;

            case '4': //Estudio EI-TESA
                    $this->conteTableNameGis = 'vrhr_estudio_item';
                    $sFrom = ' FROM vrhr_estudio.item i';
                    
                    $sSelect.=' ,i.*,( select t.nombre from catalogo_tipo as t
                                where itemId = i.itemId
                                ) as fichaTipo
                                ,  d.nombre as departamento
                                ,	p.nombre as provincia
                                ,	m.nombre as municipio
                                ,( select count(*) from item_ubicacion as t 
                                where t.fichaId = i.itemId
                                ) as numeroTramos                    
                                 ';    
                      $sFrom.=' LEFT JOIN vrhr_territorio.municipio as m on m.itemId = i.municipioId
                                LEFT JOIN vrhr_territorio.departamento as d on d.itemId = i.departamentoId
                                LEFT JOIN vrhr_territorio.provincia as p on p.itemId = m.provinciaId';
                      
                      $sql = $sSelect.$sFrom.$sWhere."";
                      $item = $dbm->Execute($sql);
                      $item = $item->fields;
                      $situacion = $this->getCatalogSituacion();
                      $proyecto = $this->getCatalogoProyecto();
                      $tipoFicha = $this->getCatalogoTipoFicha();
                      $tipoFiv = $this->getCatalogoTipoFiv();
                      $institucion = $this->getCatalogInstitucion();
                      $item["situacionIdName"] = $situacion[$item["situacionId"]];
                      $item["proyectoIdName"] = $proyecto[$item["proyectoId"]];
                      $item["tipoIdName"] = utf8_encode($tipoFicha[$item["tipoId"]]);
                      $item["fivIdName"] = $tipoFiv[$item["fivId"]];
                      $item["institucionIdName"] = $institucion[$item["institucionId"]];
                      
                    if($this->verificaPostItem($id)){//Actualiza
                      $this->updatePostItem($tipoTabla,$item);  
                    }else{//Registra
                      $this->savePostItem($tipoTabla,$item);
                    }
                break;
            case'5'://FIV
                    $this->conteTableNameGis = 'vrhr_fiv_item';
                    $sFrom = ' FROM vrhr_fiv.item i';
                    
                    $sSelect.=', cs.nombre as situacion, d.nombre as departamento, m.nombre as municipio, ca.nombre as tipo_proyecto
                               , cag.nombre as zona_agroecologica, i.cuencaPrincipal as cuenca_fuente, i.cuencaFuente as cuenca_mayor
                               , cn5.nombre as cuenca_nivel5, i.arRegableAnual as area_anual
                               , i.arRegable as area_regable, i.arRegableInvierno as area_invierno, i.arRegableVerano as area_verano
                               , (SELECT GROUP_CONCAT(ifa.nombre SEPARATOR "; ") FROM vrhr_fiv.item_fuenteagua ifa WHERE ifa.fichaId=i.itemId AND ifa.tipo=1) as fuente_agua_nombres
                               , (SELECT SUM(ifa.volumen) FROM vrhr_fiv.item_fuenteagua ifa WHERE ifa.fichaId=i.itemId) as volumen_anual 
                               , (SELECT SUM(ifa.caudalSeca) FROM vrhr_fiv.item_fuenteagua ifa WHERE ifa.fichaId=i.itemId) as caudal_invierno
                               , (SELECT SUM(ifa.caudalLluvia) FROM vrhr_fiv.item_fuenteagua ifa WHERE ifa.fichaId=i.itemId) as caudal_verano
                               , (SELECT SUM(ifa.caudalSeca+ifa.caudalLluvia) FROM vrhr_fiv.item_fuenteagua ifa WHERE ifa.fichaId=i.itemId) as caudal_anual
                               , IF(i.condRegistro=1,"SI","NO") as derecho_agua, IF(i.condCompartida=1,"SI","NO") as compartida 
                               , ip.familiaBeneficiada as num_familia
                               , (SELECT SUM(ipt.tenenciaMenor) FROM vrhr_fiv.item_poblaciontenencia ipt WHERE ipt.fichaId=i.itemId) as num_familia_menor_hectarea
                               , (SELECT SUM(ipt.tenenciaMayor) FROM vrhr_fiv.item_poblaciontenencia ipt WHERE ipt.fichaId=i.itemId) as num_familia_mayor_hectarea
                               , (SELECT GROUP_CONCAT(ct.nombre SEPARATOR ";") FROM vrhr_fiv.item_usotecnologia iut, vrhr_fiv.catalogo_tecnologia ct WHERE ct.itemId=iut.tecnologiaId AND ct.tipoId=1 AND iut.fichaId=i.itemId) as gravedad
                               , (SELECT GROUP_CONCAT(ct.nombre SEPARATOR ";") FROM vrhr_fiv.item_usotecnologia iut, vrhr_fiv.catalogo_tecnologia ct WHERE ct.itemId=iut.tecnologiaId AND ct.tipoId=2 AND iut.fichaId=i.itemId) as presurizado
                               , (SELECT GROUP_CONCAT(ifa.nombre SEPARATOR "; ") FROM vrhr_fiv.item_fuenteagua ifa WHERE ifa.fichaId=i.itemId AND ifa.tipo=2) as fuente_agua_nombres_p2 
                               , ip.tiempoejecucion
                               , (SELECT SUM(ic.preinversion) FROM vrhr_fiv.item_costo ic WHERE ic.fichaId=i.itemId) as total_preinversion
                               , (SELECT SUM(ic.inversion) FROM vrhr_fiv.item_costo ic WHERE ic.fichaId=i.itemId) as total_inversion 
                               , IF(ip.tipo=1,"Riego Menor","Riego Mayor") as categoria_proyecto
                               , IF(ip.metodoRiego=4,"Gravedad",IF(ip.metodoRiego=13,"Mixto",IF(ip.metodoRiego=12,"Presurizado",""))) as metodo_riego
                               , (SELECT GROUP_CONCAT(ire.nombre SEPARATOR "\t\n -") FROM vrhr_fiv.item_responsable ire WHERE ire.fichaId=i.itemId) as responsable_proyecto  
                                 ';    
                      
                      $sFrom.=' LEFT JOIN vrhr_catalogo.situacion cs ON cs.itemId=i.situacionId
                                LEFT JOIN vrhr_territorio.departamento d ON d.itemId=i.departamentoId
                                LEFT JOIN vrhr_territorio.municipio m on m.itemId=i.municipioId
                                LEFT JOIN vrhr_inventario.catalogo_alcance ca ON ca.itemId=i.alcanceId
                                LEFT JOIN vrhr_catalogo.agroecologica cag on cag.itemId=i.agroecologicaId 
                                LEFT JOIN vrhr_cuenca.nivel5 cn5 on cn5.itemId=i.nivel5Id
                                LEFT JOIN vrhr_fiv.item_proyecto ip on ip.fichaId=i.itemId';
                      
                      $sql = $sSelect.$sFrom.$sWhere."";
                      $item = $dbm->Execute($sql);
                      $item = $item->fields;
                      $this->prefBD = 'vrhr_inventario';
                      $item["tipo_infrestructura"] = $this->getInfraestructura($item["itemId"]);
                      $this->prefBD = 'vrhr_fiv';
                      $item["tipo_infrestructura_p2"] = $this->getInfraestructurap2($item["itemId"]);
                      
                    if($this->verificaPostItem($id)){//Actualiza
                      $this->updatePostItem($tipoTabla,$item);  
                    }else{//Registra
                      $this->savePostItem($tipoTabla,$item);
                    }
             break;
             case'6': //Reuso
                    $this->conteTableNameGis = 'vrhr_reuso_item';
                    $sFrom = ' FROM vrhr_reuso.item i';

                    $sSelect.=',i.*
                                ,  d.nombre as departamento
                                , m.nombre as municipio
                                , GROUP_CONCAT(cc.nombre) as contaminantes
                                , GROUP_CONCAT(ca.nombre) as actividades
                                , ct.nombre as tipoptarIdName
                                ';    
                    
                    $sFrom.=' LEFT JOIN vrhr_territorio.municipio as m on m.itemId = i.municipioId
                              LEFT JOIN vrhr_territorio.departamento as d on d.itemId = i.departamentoId
                              LEFT JOIN vrhr_reuso.item_contaminacion as ic on ic.fichaId = i.itemId
                              LEFT JOIN catalogo_contaminacion cc on ic.contaminacionId = cc.itemId
                              LEFT JOIN vrhr_reuso.item_actividad as ia on ia.fichaId = i.itemId
                              LEFT JOIN vrhr_reuso.catalogo_actividad as ca on ia.actividadId = ca.itemId
                              LEFT JOIN vrhr_reuso.catalogo_tipoptar as ct on i.tipoptarId = ct.itemId';

                     $sql = $sSelect.$sFrom.$sWhere."";
                     $item = $dbm->Execute($sql);
                     $item = $item->fields;
                     $opcion = $this->getArrayCondicion();
                     $tecnologia = $this->getCatalogTecnologia();
                    
                     $item["funcionaName"] = $opcion[$item["funciona"]];
                     $item["existe_tratamientoName"] = $opcion[$item["existe_tratamiento"]];
                     $item["planta_funcionamientoName"] = $opcion[$item["planta_funcionamiento"]];
                     $item["tecnologia_pretratamientoIdName"] = $tecnologia[$item["tecnologia_pretratamientoId"]];
                     $item["tecnologia_primarioIdName"] = $tecnologia[$item["tecnologia_primarioId"]];
                     $item["tecnologia_secundarioIdName"] = $tecnologia[$item["tecnologia_secundarioId"]];
                     $item["tecnologia_terciarioIdName"] = $tecnologia[$item["tecnologia_terciarioId"]];
                     
                     //print_struc($item);exit;
                    if($this->verificaPostItem($id)){//Actualiza
                      $this->updatePostItem($tipoTabla,$item);  
                    }else{//Registra
                      $this->savePostItem($tipoTabla,$item);
                    }
             break;
             case'7':
            //Sora
                    $this->conteTableNameGis = 'vrhr_sora_item';
                    $sFrom = ' FROM vrhr_sora.item i';

                    $sSelect.=',i.*
                                , d.nombre as departamento
                                , p.nombre as provincia
                                , m.nombre as municipio
                                , m.provinciaId  
                                ,(select count(*) from item_fuente as f where f.fichaId = i.itemId) as totalFuentes
                                ,(select group_concat(f.nombre SEPARATOR ", " ) from item_fuente as f 
                                where f.fichaId = i.itemId
                                )as nombreFuentes
                                ,(select count(*) from item_publicacion as p
                                where p.fichaId = i.itemId
                                 ) as numeroPublicaciones,
                                (select GROUP_CONCAT(m.nombre SEPARATOR "\n") from item_publicacion as p 
                                join catalogo_medio as m on m.itemId = p.medioId
                                where p.fichaId = i.itemId
                                group by p.fichaId
                                ) as totalPublicaciones 
                                ,(select count(*) from item_persona as p
                                where p.fichaId = i.itemId and p.tipo = 2
                                ) as numeroPersonasSederi
                                ,(select count(*) from item_persona as p
                                where p.fichaId = i.itemId and p.tipo = 1
                                ) as numeroPersonasSenari 
                                ,(select GROUP_CONCAT(m.nombre SEPARATOR "\n") from item_persona as p
                                join persona as m on p.personaId = m.itemId
                                where p.fichaId = i.itemId and p.tipo = 2
                                group by p.fichaId 
                                ) as nombrePersonasSederi
                                ,(select GROUP_CONCAT(m.nombre SEPARATOR "\n") from item_persona as p
                                join persona as m on p.personaId = m.itemId
                                where p.fichaId = i.itemId and p.tipo = 1
                                group by p.fichaId ) as nombrePersonasSenari 
                                ';    
                    
                    $sFrom.=' 
                              left join vrhr_territorio.municipio as m on m.itemId = i.municipioId
                              left join vrhr_territorio.departamento as d on d.itemId = i.departamentoId
                              left join vrhr_territorio.provincia as p on p.itemId = m.provinciaId';

                     $sql = $sSelect.$sFrom.$sWhere."";
                     $item = $dbm->Execute($sql);
                     $item = $item->fields;

                     $situacion = $this->getCatalogSituacion();
                     $fuente = $this->getCatalogFuentes();
                     $tipoRegistro = $this->tipoRegistroOptions();
                     $competencia = $this->getListCompetencia();
                      $item["situacionIdName"] = utf8_encode($situacion[$item["situacionId"]]);
                      $item["nivel5IdName"] = utf8_encode($fuente[$item["nivel5Id"]]);
                      $item["tipoRegistroName"] = $tipoRegistro[$item["tipoRegistro"]];
                      $item["competenciaName"] = $competencia[$item["competencia"]];
                      
                    if($this->verificaPostItem($id)){//Actualiza
                      $this->updatePostItem($tipoTabla,$item);  
                    }else{//Registra
                      $this->savePostItem($tipoTabla,$item);
                    }
             break;   
            

        }//END SWITCH
      }//END IF
      }//END IF
      
    }//END FUNCTION
    
    function verificaPostItem($id){
      global $dbsig,$core,$CFG;
        
      if($CFG->bPosgresql){
        postgisConnect();
      
        $sql = 'SELECT i.*
                FROM '.$this->conteTableNameGis.' i 
                WHERE i.itemId='.$id;        
        $info = $dbsig->Execute($sql);
        if (!$info) $core->errordb_log("postgre",$dbsig->ErrorMsg(),__FILE__,__LINE__);

        if($info->RecordCount()==0){//No existe registro
          return false;  
        }else{//Existe registro
          return true;
        }//END IF
      }//END IF
      
    }
    
    function updatePostItem($tipotabla,$rec){
      global $dbsig, $core,$CFG;
      
      if($CFG->bPosgresql){
        $this->conteTableName = $this->conteTableNameGis;
        switch($tipotabla){
            case '1'://Inventario
                    
                    $sql = "update ".$this->conteTableName." 
                            set
                            situacion='".utf8_encode($rec["situacion"])."'
                            ,nombre='".utf8_encode($rec["nombre"])."'
                            ,departamento='".utf8_encode($rec["departamento"])."'
                            ,municipio='".utf8_encode($rec["municipio"])."'
                            ,alcance_proyecto='".utf8_encode($rec["alcance_proyecto"])."'
                            ,zona_agroecologica='".utf8_encode($rec["zona_agroecologica"])."'
                            ,cuenca_aporte='".utf8_encode($rec["cuenca_aporte"])."'
                            ,cuenca_nivel5='".utf8_encode($rec["cuenca_nivel5"])."'
                            ,area_regable='".$rec["area_regable"]."'
                            ,area_invierno='".$rec["area_invierno"]."'
                            ,area_verano='".$rec["area_verano"]."'
                            ,area_anual='".$rec["area_anual"]."'
                            ,num_fuente_agua='".$rec["num_fuente_agua"]."'
                            ,fuente_agua_nombres='".utf8_encode($rec["fuente_agua_nombres"])."'
                            ,volumen_anual='".$rec["volumen_anual"]."'
                            ,caudal_anual='".$rec["caudal_anual"]."'
                            ,caudal_invierno='".$rec["caudal_invierno"]."'
                            ,caudal_verano='".$rec["caudal_verano"]."'
                            ,num_familia='".$rec["num_familia"]."'
                            ,gravedad='".utf8_encode($rec["gravedad"])."'
                            ,presurizado='".utf8_encode($rec["presurizado"])."'
                            ,usr_ingreso='".utf8_encode($rec["usr_ingreso"])."'
                            ,tipo_infrestructura='".utf8_encode($rec["tipo_infrestructura"])."'
                            where itemid=".$rec["itemId"]."
                            ;
                            ";
                break;
            
            case '2'://presas
                    
                    $sql = "update ".$this->conteTableName." 
                            set
                            codigo='".utf8_encode($rec["situacion"])."'
                            ,nombre='".utf8_encode($rec["nombre"])."'
                            ,departamento='".utf8_encode($rec["departamento"])."'
                            ,municipio='".utf8_encode($rec["municipio"])."'
                            ,estado='".utf8_encode($rec["alcance_proyecto"])."'
                            ,rio='".utf8_encode($rec["zona_agroecologica"])."'
                            ,cuenca_nivel5='".utf8_encode($rec["cuenca_nivel5"])."'
                            ,capacidad_embalse=".$rec["capacidad_embalse"]."
                            ,capacidad_util=".$rec["capacidad_util"]."
                            ,uso_embalse='".$rec["uso_embalse"]."'
                            ,tipo_presa='".$rec["tipo_presa"]."'
                            ,altura_maxima_nivel_lecho='".$rec["altura_maxima_nivel_lecho"]."'
                            ,longitud_corona='".utf8_encode($rec["longitud_corona"])."'
                            ,ancho_corona='".$rec["ancho_corona"]."'
                            ,tipo_vertedor_excedencias='".$rec["tipo_vertedor_excedencias"]."'
                            ,posicion='".$rec["posicion"]."'
                            ,caudal='".$rec["caudal"]."'
                            ,periodo_retorno='".$rec["periodo_retorno"]."'
                            where itemid=".$rec["itemId"]."
                            ;
                            ";
                break;
            
            case '3':
                    
            $sql = "update ".$this->conteTableName." 
                    set
                    estado_ficha='".utf8_encode($rec["estado_ficha"])."'
                    ,estado_proyecto='".utf8_encode($rec["estado_Proyecto"])."'
                    ,programa='".utf8_encode($rec["programa"])."'
                    ,nombre='".utf8_encode($rec["nombre"])."'
                    ,sisin='".utf8_encode($rec["sisin"])."'
                    ,codigo_licencia_ambiental='".utf8_encode($rec["codigo_licencia_ambiental"])."'
                    ,codigo_siam='".utf8_encode($rec["codigo_siam"])."'
                    ,fase='".utf8_encode($rec["fase"])."'
                    ,tipo_inversion='".utf8_encode($rec["tipo_inversion"])."'
                    ,tipo_proyecto='".utf8_encode($rec["tipo_proyecto"])."'
                    ,departamento='".utf8_encode($rec["departamento"])."'
                    ,municipio='".utf8_encode($rec["municipio"])."'
                    ,cartera='".utf8_encode($rec["cartera"])."'
                    ,fecha_inicio=".($rec["fecha_inicio"]==""?"null":"'".$rec["fecha_inicio"]."'")."
                    ,fecha_fin=".($rec["fecha_fin"]==""?"null":"'".$rec["fecha_fin"]."'")."
                    ,fecha_entrega=".($rec["fecha_entrega"]==""?"null":"'".$rec["fecha_entrega"]."'")."
                    ,dias_ejecutados='".$rec["dias_ejecutados"]."'
                    ,area_incremental=".($rec["area_incremental"]==""?"null":$rec["area_incremental"])."
                    ,familias=".($rec["familias"]==""?"null":$rec["familias"])."
                    ,caudal_captacion=".($rec["caudal_captacion"]==""?"null":$rec["caudal_captacion"])."
                    ,componentes='".utf8_encode($rec["componentes"])."'
                    ,presupuesto_inicial=".($rec["presupuesto_inicial"]==""?"null":$rec["presupuesto_inicial"])."
                    ,contratado=".($rec["contratado"]==""?"null":$rec["contratado"])."
                    ,modificado=".($rec["modificado"]==""?"null":$rec["modificado"])."
                    ,vigente=".($rec["vigente"]==""?"null":$rec["vigente"])."
                    ,avance_financiero_bs=".($rec["avance_financiero_bs"]==""?"null":$rec["avance_financiero_bs"])."
                    ,avance_financiero_porc=".($rec["avance_financiero_porc"]==""?"null":$rec["avance_financiero_porc"])."
                    ,avance_fisico_porc=".($rec["avance_fisico_porc"]==""?"null":$rec["avance_fisico_porc"])."
                    where itemid=".$rec["itemId"]."
                    ;
                    ";
                break;
            case '4'://Inventario
                    
                    $sql = "update ".$this->conteTableName." 
                            set                                                                                
                             situacion='".utf8_encode($rec["situacionIdName"])."'
                            ,proyecto='".utf8_encode($rec["proyectoIdName"])."'
                            ,nombre_proyecto='".utf8_encode($rec["nombre"])."'
                            ,tipo_ficha='".utf8_encode($rec["tipoIdName"])."'
                            ,fiv='".utf8_encode($rec["fivIdName"])."'
                            ,departamento='".utf8_encode($rec["departamento"])."'
                            ,municipio='".utf8_encode($rec["municipio"])."'
                            ,institucion='".$rec["institucionIdName"]."'
                            ,familias_beneficiadas=".($rec["familias"]==""?0:$rec["familias"])."
                            ,volumen_anual_riego=".($rec["sinproyecto_volumen_anual_riego"]==""?0:$rec["sinproyecto_volumen_anual_riego"])."
                            ,eficiencia_sistema_riego=".($rec["sinproyecto_eficiencia"]==""?0:$rec["sinproyecto_eficiencia"])."
                            ,area_riego_optimo=".($rec["sinproyecto_area_riego_optimo"]==""?0:$rec["sinproyecto_area_riego_optimo"])."
                            ,volumen_anual_riego_proyecto=".($rec["conproyecto_volumen_anual_riego"]==""?0:$rec["conproyecto_volumen_anual_riego"])."
                            ,eficiencia_sistema_riego_proyecto=".($rec["conproyecto_eficiencia"]==""?0:$rec["conproyecto_eficiencia"])."
                            ,area_riego_optimo_proyecto=".($rec["conproyecto_area_riego_optimo"]==""?0:$rec["conproyecto_area_riego_optimo"])."                                              
                            ,entidad_financiera='".utf8_encode($rec["entidad_financiera"])."'
                            ,entidad_promotora='".utf8_encode($rec["entidad_promotora"])."'
                            ,beneficiario='".utf8_encode($rec["beneficiario"])."'
                            
                            ,aporte_entidad_financiera=".($rec["entidad_financiera_aporte"]==""?0:$rec["entidad_financiera_aporte"])."
                            ,aporte_beneficiario=".($rec["beneficiario_aporte"]==""?0:$rec["beneficiario_aporte"])."
                            ,tiempo_ejecucion_dias_calendario=".($rec["tiempo_ejecucion"]==""?0:$rec["tiempo_ejecucion"])."
                            ,eficiencia_costo_ha_incremental=".($rec["costo_eficiencia_incremental"]==""?0:$rec["costo_eficiencia_incremental"])."
                            ,costo_infraestructura=".($rec["costo_infraestructura"]==""?0:$rec["costo_infraestructura"])."
                            
                            ,evaluacion_socioeconomica_social_tir=".($rec["tirs"]==""?0:$rec["tirs"])."
                            ,evaluacion_socioeconomica_social_van=".($rec["vans"]==""?0:$rec["vans"])."
                            ,evaluacion_socioeconomica_social_rbc=".($rec["rbcs"]==""?0:$rec["rbcs"])."
                            ,evaluacion_socioeconomica_privado_tir=".($rec["tirp"]==""?0:$rec["tirp"])."
                            ,evaluacion_socioeconomica_privado_van=".($rec["vanp"]==""?0:$rec["vanp"])."
                            ,evaluacion_socioeconomica_privado_rbc=".($rec["rbcp"]==""?0:$rec["rbcp"])."
                            ,eficiencia_costo_familia=".($rec["costo_eficiencia_familia"]==""?0:$rec["costo_eficiencia_familia"])."                                                      
                            
                            where itemid=".$rec["itemId"]."
                            ;
                            ";
                break;
            case'5':
                    //FIV
                    $sql = "update ".$this->conteTableName." 
                            set
                            situacion='".utf8_encode($rec["situacion"])."'
                            ,departamento='".utf8_encode($rec["departamento"])."'
                            ,municipio='".utf8_encode($rec["municipio"])."'
                            ,nombre='".utf8_encode($rec["nombre"])."'
                            ,tipo='".utf8_encode($rec["tipo_proyecto"])."'
                            ,zona_agroecologica='".utf8_encode($rec["zona_agroecologica"])."'
                            ,cuenca_fuenteagua='".utf8_encode($rec["cuenca_fuente"])."'
                            ,cuenca_mayor='".utf8_encode($rec["cuenca_mayor"])."'
                            ,cuenca_nivel5='".utf8_encode($rec["cuenca_nivel5"])."'
                            ,area_regable='".($rec["area_regable"]==""?0:$rec["area_regable"])."'
                            ,area_invierno='".($rec["area_invierno"]==""?0:$rec["area_invierno"])."'
                            ,area_verano='".($rec["area_verano"]==""?0:$rec["area_verano"])."'
                            ,area_anual='".($rec["area_anual"]==""?0:$rec["area_anual"])."'
                            ,fuente_agua_nombres='".utf8_encode($rec["fuente_agua_nombres"])."'
                            ,volumen_anual='".($rec["volumen_anual"]==""?0:$rec["volumen_anual"])."'
                            ,caudal_anual='".($rec["caudal_anual"]==""?0:$rec["caudal_anual"])."'
                            ,caudal_invierno='".($rec["caudal_invierno"]==""?0:$rec["caudal_invierno"])."'
                            ,caudal_verano='".($rec["caudal_verano"]==""?0:$rec["caudal_verano"])."'
                            ,derecho_agua='".$rec["derecho_agua"]."'
                            ,compartida='".$rec["compartida"]."'
                            ,num_familia='".($rec["num_familia"]==""?0:intval($rec["num_familia"]))."'
                            ,num_familia_menor_hectarea='".($rec["num_familia_menor_hectarea"]==""?0:intval($rec["num_familia_menor_hectarea"]))."'
                            ,num_familia_mayor_hectarea='".($rec["num_familia_mayor_hectarea"]==""?0:intval($rec["num_familia_mayor_hectarea"]))."'
                            ,gravedad='".utf8_encode($rec["gravedad"])."'
                            ,presurizado='".utf8_encode($rec["presurizado"])."'
                            ,infraestructura='".utf8_encode($rec["tipo_infrestructura"])."'
                            ,fuente_agua_nombres_p2='".utf8_encode($rec["fuente_agua_nombres_p2"])."'
                            ,infraestructura_p2='".utf8_encode($rec["tipo_infrestructura_p2"])."'
                            ,tiempo_ejecucion_meses='".($rec["tiempoejecucion"]==""?0:$rec["tiempoejecucion"])."'
                            ,total_preinversion='".($rec["total_preinversion"]==""?0:$rec["total_preinversion"])."'
                            ,total_inversion='".($rec["total_inversion"]==""?0:$rec["total_inversion"])."'
                            ,categoria_proyecto='".utf8_encode($rec["categoria_proyecto"])."'
                            ,metodo_aplicacion_riego='".utf8_encode($rec["metodo_riego"])."'
                            ,responsable='".utf8_encode($rec["responsable_proyecto"])."'
                            where itemid=".$rec["itemId"]."
                            ;
                            ";
             break;
             case'6':
                    //Reuso
                    $sql = "update ".$this->conteTableName." 
                            set
                             departamento='".utf8_encode($rec["departamento"])."'
                            ,municipio='".utf8_encode($rec["municipio"])."'
                            ,nombre='".utf8_encode($rec["nombre"])."'
                            ,funciona='".utf8_encode($rec["funcionaName"])."'
                            ,ciudad='".utf8_encode($rec["ciudad"])."'
                            ,rio='".utf8_encode($rec["rio"])."'
                            ,cuenca_mayor='".utf8_encode($rec["cuenca_mayor"])."'
                            ,habitantes=".($rec["habitantes"]==""?0:$rec["habitantes"])."
                            ,tasa_crecimiento=".($rec["tasa_crecimiento"]==""?0:$rec["tasa_crecimiento"])."
                            ,viviendas=".($rec["viviendas"]==""?0:$rec["viviendas"])."
                            ,fabricas=".($rec["fabricas"]==""?0:$rec["fabricas"])."
                            ,poblacion_alcantarillado=".($rec["poblacion_conectada"]==""?0:$rec["poblacion_conectada"])."
                            ,superficie_regada=".($rec["area_regada"]==""?0:$rec["area_regada"])."
                            ,caudal_potable=".($rec["caudal_potable"]==""?0:$rec["caudal_potable"])."
                            ,caudal_servida=".($rec["caudal_servida"]==""?0:$rec["caudal_servida"])."
                            ,caudal_reutilizada=".($rec["caudal_reutilizada"]==""?0:$rec["caudal_reutilizada"])."
                            ,precipitacion_media=".($rec["precipitacion"]==""?0:$rec["precipitacion"])."


                            ,actividades_economicas='".utf8_encode($rec["actividadEconomica"])."'
                            ,contaminantes='".utf8_encode($rec["contaminantes"])."'
                            ,existe='".utf8_encode($rec["existe_tratamientoName"])."'
                            ,tecnologia_pre_tratamiento='".utf8_encode($rec["tecnologia_pretratamientoIdName"])."'
                            ,tecnologia_primaria='".utf8_encode($rec["tecnologia_primarioIdName"])."'
                            ,tecnologia_secundaria='".utf8_encode($rec["tecnologia_secundarioIdName"])."'
                            ,tecnologia_terciaria='".utf8_encode($rec["tecnologia_terciarioIdName"])."'
                            
                            ,capacidad=".($rec["capacidad"]==""?0:$rec["capacidad"])."
                            ,efectividad=".($rec["efectividad"]==""?0:$rec["efectividad"])."
                            ,vida_util=".($rec["anios_vida"]==""?0:$rec["anios_vida"])." 
                            ,uso='".utf8_encode($rec["uso"])."'

                            where itemid=".$rec["itemId"]."
                            ;
                            ";
             break;
             case'7':
                    //Sora
              $sql = "update ".$this->conteTableName." 
                            set                                                                                
                             numero_registro='".utf8_encode($rec["numero_registro"])."'
                            ,nombre_entidad_beneficiaria='".utf8_encode($rec["nombre"])."'
                            ,fecha_inicio='".utf8_encode($rec["fechaInicioProceso"])."'
                            ,departamento='".utf8_encode($rec["departamento"])."'
                            ,municipio='".utf8_encode($rec["municipio"])."'
                            ,cuenca_nivel5='".utf8_encode($rec["nivel5IdName"])."'
                            ,tipo_registro='".utf8_encode($rec["tipoRegistroName"])."'
                            ,competencia='".utf8_encode($rec["competenciaName"])."'                                                        
                            ,area_potencial_riego=".($rec["area_potencial_riego"]==""?0:$rec["area_potencial_riego"])."
                            ,numero_familias=".($rec["familias"]==""?0:$rec["familias"])."
                            ,comunidades_convenio='".utf8_encode($rec["comunidades_convenio"])."'
                            ,numero_resolucion='".utf8_encode($rec["numero_resolucion"])."'
                            ,fecha_resolucion='".utf8_encode($rec["fecha_resolucion"])."'
                            ,total_fuentes=".($rec["totalFuentes"]==""?0:$rec["totalFuentes"])."
                            ,nombre_fuentes_agua='".utf8_encode($rec["nombreFuentes"])."'
                            ,num_publicaciones=".($rec["numeroPublicaciones"]==""?0:$rec["numeroPublicaciones"])."
                            ,publicaciones='".utf8_encode($rec["totalPublicaciones"])."'
                            ,num_personas_sederi=".($rec["numeroPersonasSederi"]==""?0:$rec["numeroPersonasSederi"])."
                            ,personas_sederi='".utf8_encode($rec["nombrePersonasSederi"])."'
                            ,num_personas_senari=".($rec["numeroPersonasSenari"]==""?0:$rec["numeroPersonasSenari"])."
                            ,personas_senari='".utf8_encode($rec["nombrePersonasSenari"])."'
                            ,estado='".utf8_encode($rec["situacionIdName"])."'
                                                                            
                            where itemid=".$rec["itemId"]."
                            ;
                            ";
             break;
        }//END SWITCH
        $resupdate = $dbsig->Execute($sql);
        if (!$resupdate)    $core->errordb_log("postgre",$dbsig->ErrorMsg(),__FILE__,__LINE__);
      }
    }
    
    function savePostItem($tipotabla,$rec){
      global $dbsig,$core,$CFG;
      
      if($CFG->bPosgresql){
        $this->conteTableName = $this->conteTableNameGis;
        switch($tipotabla){
            case '1':
                    $sql = "insert into ".$this->conteTableName."  
                    ( itemid,situacion,nombre,departamento,municipio,alcance_proyecto,zona_agroecologica,cuenca_aporte,cuenca_nivel5
                    ,area_regable,area_invierno,area_verano,area_anual,num_fuente_agua,fuente_agua_nombres,volumen_anual,caudal_anual
                    ,caudal_invierno,caudal_verano,num_familia,gravedad,presurizado,tipo_infrestructura,usr_ingreso)
                    values
                    (".$rec["itemId"]."
                    ,'".utf8_encode($rec["situacion"])."'
                    ,'".utf8_encode($rec["nombre"])."'
                    ,'".utf8_encode($rec["departamento"])."'
                    ,'".utf8_encode($rec["municipio"])."'
                    ,'".utf8_encode($rec["alcance_proyecto"])."'
                    ,'".utf8_encode($rec["zona_agroecologica"])."'
                    ,'".utf8_encode($rec["cuenca_aporte"])."'
                    ,'".utf8_encode($rec["cuenca_nivel5"])."'
                    ,'".$rec["area_regable"]."'
                    ,'".$rec["area_invierno"]."'
                    ,'".$rec["area_verano"]."'
                    ,'".$rec["area_anual"]."'
                    ,'".$rec["num_fuente_agua"]."'
                    ,'".utf8_encode($rec["fuente_agua_nombres"])."'
                    ,'".$rec["volumen_anual"]."'
                    ,'".$rec["caudal_anual"]."'
                    ,'".$rec["caudal_invierno"]."'
                    ,'".$rec["caudal_verano"]."'
                    ,'".$rec["num_familia"]."'
                    ,'".utf8_encode($rec["gravedad"])."'
                    ,'".utf8_encode($rec["presurizado"])."'
                    ,'".utf8_encode($rec["tipo_infrestructura"])."'
                    ,'".utf8_encode($rec["usr_ingreso"])."');";
                break;
        
            case '2':
                    $sql = "insert into ".$this->conteTableName."  
                            (itemid,codigo,nombre,departamento,municipio,estado,rio,cuenca_nivel5,capacidad_embalse
                            ,capacidad_util,uso_embalse,tipo_presa,altura_maxima_nivel_lecho,longitud_corona,ancho_corona
                            ,tipo_vertedor_excedencias,posicion,caudal,periodo_retorno)
                            values
                            (".$rec["itemId"]."
                            ,'".utf8_encode($rec["situacion"])."'
                            ,'".utf8_encode($rec["nombre"])."'
                            ,'".utf8_encode($rec["departamento"])."'
                            ,'".utf8_encode($rec["municipio"])."'
                            ,'".utf8_encode($rec["alcance_proyecto"])."'
                            ,'".utf8_encode($rec["zona_agroecologica"])."'
                            ,'".utf8_encode($rec["cuenca_nivel5"])."'
                            ,".$rec["capacidad_embalse"]."
                            ,".$rec["capacidad_util"]."
                            ,'".$rec["uso_embalse"]."'
                            ,'".$rec["tipo_presa"]."'
                            ,'".$rec["altura_maxima_nivel_lecho"]."'
                            ,'".utf8_encode($rec["longitud_corona"])."'
                            ,'".$rec["ancho_corona"]."'
                            ,'".$rec["tipo_vertedor_excedencias"]."'
                            ,'".$rec["posicion"]."'
                            ,'".$rec["caudal"]."'
                            ,'".$rec["periodo_retorno"]."'
                            );";

                break;
            
            case '3':
                
                    $sql = "insert into ".$this->conteTableName."  
                            (itemid,estado_ficha,estado_Proyecto,programa,nombre,sisin,codigo_licencia_ambiental,codigo_siam,fase
                            ,tipo_inversion,tipo_proyecto,departamento,municipio,cartera,fecha_inicio
                            ,fecha_fin,fecha_entrega,dias_ejecutados,area_incremental,familias,caudal_captacion,componentes
                            ,presupuesto_inicial,contratado,modificado,vigente,avance_financiero_bs,avance_financiero_porc,avance_fisico_porc)
                            values
                            (".$rec["itemId"]."
                            ,'".utf8_encode($rec["estado_ficha"])."'
                            ,'".utf8_encode($rec["estado_Proyecto"])."'
                            ,'".utf8_encode($rec["programa"])."'
                            ,'".utf8_encode($rec["nombre"])."'
                            ,'".utf8_encode($rec["sisin"])."'
                            ,'".utf8_encode($rec["codigo_licencia_ambiental"])."'
                            ,'".utf8_encode($rec["codigo_siam"])."'
                            ,'".utf8_encode($rec["fase"])."'
                            ,'".utf8_encode($rec["tipo_inversion"])."'
                            ,'".utf8_encode($rec["tipo_proyecto"])."'
                            ,'".utf8_encode($rec["departamento"])."'
                            ,'".utf8_encode($rec["municipio"])."'
                            ,'".utf8_encode($rec["cartera"])."'
                            ,".($rec["fecha_inicio"]==""?"null":"'".$rec["fecha_inicio"]."'")."
                            ,".($rec["fecha_fin"]==""?"null":"'".$rec["fecha_fin"]."'")."
                            ,".($rec["fecha_entrega"]==""?"null":"'".$rec["fecha_entrega"]."'")."
                            ,'".$rec["dias_ejecutados"]."'
                            ,".($rec["area_incremental"]==""?"null":$rec["area_incremental"])."
                            ,".($rec["familias"]==""?"null":$rec["familias"])."
                            ,".($rec["caudal_captacion"]==""?"null":$rec["caudal_captacion"])."
                            ,'".utf8_encode($rec["componentes"])."'
                            ,".($rec["presupuesto_inicial"]==""?"null":$rec["presupuesto_inicial"])."
                            ,".($rec["contratado"]==""?"null":$rec["contratado"])."
                            ,".($rec["modificado"]==""?"null":$rec["modificado"])."
                            ,".($rec["vigente"]==""?"null":$rec["vigente"])."
                            ,".($rec["avance_financiero_bs"]==""?"null":$rec["avance_financiero_bs"])."
                            ,".($rec["avance_financiero_porc"]==""?"null":$rec["avance_financiero_porc"])."
                            ,".($rec["avance_fisico_porc"]==""?"null":$rec["avance_fisico_porc"])."
                            );";
                break;
            case'4':
                    $sql = "insert into ".$this->conteTableName."  
                            (itemid,situacion,proyecto,nombre_proyecto,tipo_ficha,fiv,departamento,municipio,institucion,
                            familias_beneficiadas,area_regable,volumen_anual_riego,eficiencia_sistema_riego,area_riego_optimo,
                            volumen_anual_riego_proyecto,eficiencia_sistema_riego_proyecto,area_riego_optimo_proyecto,entidad_financiera,
                            entidad_promotora,beneficiario,aporte_entidad_financiera,aporte_beneficiario,tiempo_ejecucion_dias_calendario,
                            eficiencia_costo_ha_incremental,eficiencia_costo_familia,costo_infraestructura,costo_supervision,
                            costo_asistencia_tecnica,costo_tipo_cambio,evaluacion_socioeconomica_social_tir,evaluacion_socioeconomica_social_van,
                            evaluacion_socioeconomica_social_rbc,evaluacion_socioeconomica_privado_tir,evaluacion_socioeconomica_privado_van,
                            evaluacion_socioeconomica_privado_rbc)
                            values
                            (".$rec["itemId"]."
                            ,'".utf8_encode($rec["situacionIdName"])."'
                            ,'".utf8_encode($rec["proyectoIdName"])."'
                            ,'".utf8_encode($rec["nombre"])."'
                            ,'".utf8_encode($rec["tipoIdName"])."'
                            ,'".utf8_encode($rec["fivIdName"])."'
                            ,'".utf8_encode($rec["departamento"])."'
                            ,'".utf8_encode($rec["municipio"])."'
                            ,'".utf8_encode($rec["institucionIdName"])."'
                            ,".($rec["familias"]==""?0:$rec["familias"])."
                            ,".($rec["area_regable"]==""?0:$rec["area_regable"])."
                            ,".($rec["sinproyecto_volumen_anual_riego"]==""?0:$rec["sinproyecto_volumen_anual_riego"])."
                            ,".($rec["sinproyecto_eficiencia"]==""?0:$rec["sinproyecto_eficiencia"])."
                            ,".($rec["sinproyecto_area_riego_optimo"]==""?0:$rec["sinproyecto_area_riego_optimo"])."
                            ,".($rec["conproyecto_volumen_anual_riego"]==""?0:$rec["conproyecto_volumen_anual_riego"])."
                            ,".($rec["conproyecto_eficiencia"]==""?0:$rec["conproyecto_eficiencia"])."
                            ,".($rec["conproyecto_area_riego_optimo"]==""?0:$rec["conproyecto_area_riego_optimo"])."
                            ,'".utf8_encode($rec["entidad_financiera"])."'
                            ,'".utf8_encode($rec["entidad_promotora"])."'
                            ,'".utf8_encode($rec["beneficiario"])."'
                            ,".($rec["entidad_financiera_aporte"]==""?0:$rec["entidad_financiera_aporte"])."
                            ,".($rec["beneficiario_aporte"]==""?0:$rec["beneficiario_aporte"])."                                                                           
                            ,".($rec["tiempo_ejecucion"]==""?0:$rec["tiempo_ejecucion"])." 
                            ,".($rec["costo_eficiencia_incremental"]==""?0:$rec["costo_eficiencia_incremental"])." 
                            ,".($rec["costo_eficiencia_familia"]==""?0:$rec["costo_eficiencia_familia"])." 
                            ,".($rec["costo_infraestructura"]==""?0:$rec["costo_infraestructura"])." 
                            ,".($rec["costo_supervision"]==""?0:$rec["costo_supervision"])." 
                            ,".($rec["costo_acompa_ati"]==""?0:$rec["costo_acompa_ati"])." 
                            ,".($rec["tipo_cambio"]==""?0:$rec["tipo_cambio"])." 
                            ,".($rec["tirs"]==""?0:$rec["tirs"])." 
                            ,".($rec["vans"]==""?0:$rec["vans"])." 
                            ,".($rec["rbcs"]==""?0:$rec["rbcs"])." 
                            ,".($rec["tirp"]==""?0:$rec["tirp"])." 
                            ,".($rec["vanp"]==""?0:$rec["vanp"])." 
                            ,".($rec["rbcp"]==""?0:$rec["rbcp"])."                             
                            );";
             break;
             case'5':
                    //FIV
                    $sql = "insert into ".$this->conteTableName."  
                            (itemid,situacion,nombre,departamento,municipio,tipo,zona_agroecologica,cuenca_fuenteagua
                            ,cuenca_mayor,cuenca_nivel5,area_regable,area_invierno,area_verano,area_anual
                            ,fuente_agua_nombres,volumen_anual,caudal_anual,caudal_invierno,caudal_verano,derecho_agua
                            ,compartida,num_familia,num_familia_menor_hectarea,num_familia_mayor_hectarea
                            ,gravedad,presurizado,infraestructura,fuente_agua_nombres_p2,infraestructura_p2
                            ,tiempo_ejecucion_meses,total_preinversion,total_inversion,categoria_proyecto
                            ,metodo_aplicacion_riego,responsable)
                            values
                            (".$rec["itemId"]."
                            ,'".utf8_encode($rec["situacion"])."'
                            ,'".utf8_encode($rec["nombre"])."'
                            ,'".utf8_encode($rec["departamento"])."'
                            ,'".utf8_encode($rec["municipio"])."'
                            ,'".utf8_encode($rec["tipo_proyecto"])."'
                            ,'".utf8_encode($rec["zona_agroecologica"])."'
                            ,'".utf8_encode($rec["cuenca_fuente"])."'
                            ,'".utf8_encode($rec["cuenca_mayor"])."'
                            ,'".utf8_encode($rec["cuenca_nivel5"])."'
                            ,'".($rec["area_regable"]==""?0:$rec["area_regable"])."'
                            ,'".($rec["area_invierno"]==""?0:$rec["area_invierno"])."'
                            ,'".($rec["area_verano"]==""?0:$rec["area_verano"])."'
                            ,'".($rec["area_anual"]==""?0:$rec["area_anual"])."'
                            ,'".utf8_encode($rec["fuente_agua_nombres"])."'
                            ,'".($rec["volumen_anual"]==""?0:$rec["volumen_anual"])."'
                            ,'".($rec["caudal_anual"]==""?0:$rec["caudal_anual"])."'
                            ,'".($rec["caudal_invierno"]==""?0:$rec["caudal_invierno"])."'
                            ,'".($rec["caudal_verano"]==""?0:$rec["caudal_verano"])."'
                            ,'".$rec["derecho_agua"]."'
                            ,'".$rec["compartida"]."'
                            ,'".($rec["num_familia"]==""?0:intval($rec["num_familia"]))."'
                            ,'".($rec["num_familia_menor_hectarea"]==""?0:$rec["num_familia_menor_hectarea"])."'
                            ,'".($rec["num_familia_mayor_hectarea"]==""?0:$rec["num_familia_mayor_hectarea"])."'
                            ,'".utf8_encode($rec["gravedad"])."'
                            ,'".utf8_encode($rec["presurizado"])."'
                            ,'".utf8_encode($rec["tipo_infrestructura"])."'
                            ,'".utf8_encode($rec["fuente_agua_nombres_p2"])."'
                            ,'".utf8_encode($rec["tipo_infrestructura_p2"])."'
                            ,'".($rec["tiempo_ejecucion_meses"]==""?0:$rec["tiempoejecucion"])."'
                            ,'".($rec["total_preinversion"]==""?0:$rec["total_preinversion"])."'
                            ,'".($rec["total_inversion"]==""?0:$rec["total_inversion"])."'
                            ,'".utf8_encode($rec["categoria_proyecto"])."'
                            ,'".utf8_encode($rec["metodo_riego"])."'
                            ,'".utf8_encode($rec["responsable_proyecto"])."')
                            ;
                            ";
             break;
             case'6':
                 //Reuso
                $sql = "insert into ".$this->conteTableName."  
                            (itemid,departamento,municipio,nombre,funciona,ciudad,rio,cuenca_mayor,habitantes,tasa_crecimiento
                              ,viviendas,fabricas,poblacion_alcantarillado,superficie_regada,caudal_potable,caudal_servida,caudal_reutilizada
                              ,precipitacion_media,actividades_economicas,contaminantes,existe,tecnologia_pre_tratamiento,
                              tecnologia_primaria,tecnologia_secundaria,tecnologia_terciaria,capacidad,efectividad,vida_util,uso)
                            values
                            (".$rec["itemId"]."
                            ,'".utf8_encode($rec["departamento"])."'
                            ,'".utf8_encode($rec["municipio"])."'
                            ,'".utf8_encode($rec["nombre"])."'
                            ,'".utf8_encode($rec["funcionaName"])."'
                            ,'".utf8_encode($rec["ciudad"])."'
                            ,'".utf8_encode($rec["rio"])."'
                            ,'".utf8_encode($rec["cuenca_mayor"])."'
                            ,".($rec["habitantes"]==""?0:$rec["habitantes"])."
                            ,".($rec["tasa_crecimiento"]==""?0:$rec["tasa_crecimiento"])."
                            ,".($rec["viviendas"]==""?0:$rec["viviendas"])."
                            ,".($rec["fabricas"]==""?0:$rec["fabricas"])."

                            ,".($rec["poblacion_conectada"]==""?0:$rec["poblacion_conectada"])."
                            ,".($rec["area_regada"]==""?0:$rec["area_regada"])."
                            ,".($rec["caudal_potable"]==""?0:$rec["caudal_potable"])."
                            ,".($rec["caudal_servida"]==""?0:$rec["caudal_servida"])."
                            ,".($rec["caudal_reutilizada"]==""?0:$rec["caudal_reutilizada"])."
                            ,".($rec["precipitacion"]==""?0:$rec["precipitacion"])."
                            
                            ,'".utf8_encode($rec["actividadEconomica"])."'
                            ,'".utf8_encode($rec["contaminantes"])."'
                            ,'".utf8_encode($rec["existe_tratamientoName"])."'
                            ,'".utf8_encode($rec["tecnologia_pretratamientoIdName"])."'
                            ,'".utf8_encode($rec["tecnologia_primarioIdName"])."'
                            ,'".utf8_encode($rec["tecnologia_secundarioIdName"])."'
                            ,'".utf8_encode($rec["tecnologia_terciarioIdName"])."'

                            ,".($rec["capacidad"]==""?0:$rec["capacidad"])."
                            ,".($rec["efectividad"]==""?0:$rec["efectividad"])."
                            ,".($rec["anios_vida"]==""?0:$rec["anios_vida"])."
                            ,'".utf8_encode($rec["uso"])."'
 
                            
                            );";


             break;
             case'7':
                    //Sora
                    $sql = "insert into ".$this->conteTableName."  
                            (itemid,numero_registro,nombre_entidad_beneficiaria,fecha_inicio,departamento,municipio,cuenca_nivel5
                              ,tipo_registro,competencia,area_potencial_riego,numero_familias,comunidades_convenio,numero_resolucion
                              ,fecha_resolucion,total_fuentes,nombre_fuentes_agua,num_publicaciones,publicaciones,num_personas_sederi
                              ,personas_sederi,num_personas_senari,personas_senari,estado)
                            values
                            (".$rec["itemId"]."
                            ,'".utf8_encode($rec["numero_registro"])."'
                            ,'".utf8_encode($rec["nombre"])."'                
                            ,'".($rec["fechaInicioProceso"]==""?0:$rec["fechaInicioProceso"])."'
                            ,'".utf8_encode($rec["departamento"])."'
                            ,'".utf8_encode($rec["municipio"])."'
                            ,'".$rec["nivel5IdName"]."'
                            ,'".$rec["tipoRegistroName"]."'
                            ,'".$rec["competenciaName"]."'
                            ,".($rec["area_potencial_riego"]==""?0:$rec["area_potencial_riego"])."
                            ,".($rec["familias"]==""?0:$rec["familias"])."
                            ,'".utf8_encode($rec["comunidades_convenio"])."'
                            ,'".utf8_encode($rec["numero_resolucion"])."'
                            
                            ,'".($rec["fecha_resolucion"]=="0000-00-00"?"1970-01-01":$rec["fecha_resolucion"])."'
                            ,".($rec["totalFuentes"]==""?0:$rec["totalFuentes"])."
                            ,'".utf8_encode($rec["nombreFuentes"])."'
                            ,".($rec["numeroPublicaciones"]==""?0:$rec["numeroPublicaciones"])."
                            ,'".utf8_encode($rec["totalPublicaciones"])."'
                            ,".($rec["numeroPersonasSederi"]==""?0:$rec["numeroPersonasSederi"])."
                            ,'".utf8_encode($rec["nombrePersonasSederi"])."'
                            ,".($rec["numeroPersonasSenari"]==""?0:$rec["numeroPersonasSenari"])."
                            ,'".utf8_encode($rec["nombrePersonasSenari"])."'
                            ,'".$rec["situacionIdName"]."'
                           
                            );";
             break;
        }//END SWITCH

        $ressave = $dbsig->Execute($sql);
        if (!$ressave)  $core->errordb_log("postgre",$dbsig->ErrorMsg(),__FILE__,__LINE__);
        
      }//END IF
      
    }
    
    function getInfraestructura($id){
        global $dbm;
        $dbm->SetFetchMode(ADODB_FETCH_ASSOC);
        /** PRESAS*/
        $respresa="";
        
        $sql = 'SELECT t.nombre as tipo, count(i.itemId) as cantidad
                FROM '.$this->prefBD.'.item_infraestructurapresa i
                    , '.$this->prefBD.'.catalogo_tipo_clasificacion tc
                    , '.$this->prefBD.'.catalogo_tipo t
                WHERE i.fichaId='.$id.' and i.tipoId=tc.itemId and tc.tipoId=t.itemId
                      and tc.tipo=1
                group by tc.tipoId 
                order by t.nombre';

        $info = $dbm->Execute($sql);
        $info = $info->GetRows();
        
        foreach($info as $row){
          $respresa.=" (".$row["cantidad"].") ".$row["tipo"].", ";   
        }
        
        if($respresa!="")
           $respresa=substr($respresa, 0, -2).";\n";
        
        /** Estanques atajados*/
        $resatajado = "";
        $sql='SELECT t.nombre as tipo, ROUND(count(i.itemId),0) as cantidad
             FROM '.$this->prefBD.'.item_infraestructurapresa i
                    , '.$this->prefBD.'.catalogo_tipo_clasificacion tc
                    , '.$this->prefBD.'.catalogo_tipo t
                WHERE i.fichaId='.$id.' and i.tipoId=tc.itemId and tc.tipoId=t.itemId and tc.tipo=2
              group by tc.tipoId order by t.nombre asc';

        $info = $dbm->Execute($sql);
        $info = $info->GetRows();
        
        foreach($info as $row){
          $resatajado.=" (".$row["cantidad"].") ".$row["tipo"].", ";   
        }
        
        if($resatajado!="")
           $resatajado=substr($resatajado, 0, -2).";\n";
        
            
        /** Obras de captacion*/
        $rescaptacion="";
        $sql='SELECT t.nombre as tipo, count(i.itemId) as cantidad
             FROM '.$this->prefBD.'.item_infraestructurapresa i
                    , '.$this->prefBD.'.catalogo_tipo_clasificacion tc
                    , '.$this->prefBD.'.catalogo_tipo t
                WHERE i.fichaId='.$id.' and i.tipoId=tc.itemId and tc.tipoId=t.itemId and tc.tipo=3
             group by tc.tipoId order by t.nombre asc';
        
        $info = $dbm->Execute($sql);
        $info = $info->GetRows();
        
        foreach($info as $row){
          $rescaptacion.=" (".$row["cantidad"].") ".$row["tipo"].", ";   
        }
        
        if($rescaptacion!="")
           $rescaptacion=substr($rescaptacion, 0, -2).";\n";
     
        /** Obras de conduccion*/
        $resconduccion="";
        $sql='SELECT t.nombre as tipo, count(i.itemId) as cantidad
             FROM '.$this->prefBD.'.item_infraestructurapresa i
                    , '.$this->prefBD.'.catalogo_tipo_clasificacion tc
                    , '.$this->prefBD.'.catalogo_tipo t
                WHERE i.fichaId='.$id.' and i.tipoId=tc.itemId and tc.tipoId=t.itemId and tc.tipo=4
             group by tc.tipoId order by t.nombre asc';
        
        $info = $dbm->Execute($sql);
        $info = $info->GetRows();
        
        foreach($info as $row){
          $resconduccion.=" (".$row["cantidad"].") ".$row["tipo"].", ";   
        }
        
        if($resconduccion!="")
           $resconduccion=substr($resconduccion, 0, -2).";\n";
          
        $res = "";
        if($respresa=="")
          $res.= "Presas: ".$respresa."\n";
        
        if($resatajado=="")
          $res.= "Almacenamiento: ".$resatajado."\n";
        
        if($rescaptacion=="")
          $res.= "Obras de captacion: ".$rescaptacion."\n";
        
        if($resconduccion=="")
          $res.= "Obras de conduccion: ".$resconduccion."\n";
        
        return $res;
        
    }
    
    function getInfraestructurap2($id){
        global $dbm;
        $dbm->SetFetchMode(ADODB_FETCH_ASSOC);
        
        /** ESQUEMA HIDRAULICO */
        $resesquema="";
        
        $sql = 'SELECT cac.nombre as tipo, count(i.itemId) as cantidad
                FROM '.$this->prefBD.'.item_anexo i
                    , '.$this->prefBD.'.catalogo_anexo_categoria cac
                WHERE i.fichaId='.$id.' and i.categoriaId=cac.itemId and cac.tipo=4
                group by cac.tipo 
                order by cac.nombre';

        $info = $dbm->Execute($sql);
        $info = $info->GetRows();
        
        foreach($info as $row){
          $resesquema.=" (".$row["cantidad"].") ".$row["tipo"].", ";   
        }
        
        if($resesquema!="")
           $resesquema=substr($respresa, 0, -2).";\n";
        
        /** Croquis de la Obra */
        $rescroquis = "";
        $sql='SELECT cac.nombre as tipo, count(i.itemId) as cantidad
                FROM '.$this->prefBD.'.item_anexo i
                    , '.$this->prefBD.'.catalogo_anexo_categoria cac
                WHERE i.fichaId='.$id.' and i.categoriaId=cac.itemId and cac.tipo=5
                group by cac.tipo 
                order by cac.nombre';
//echo "<br><br>=>".$sql;
        $info = $dbm->Execute($sql);
        $info = $info->GetRows();
        
        foreach($info as $row){
          $rescroquis.=" (".$row["cantidad"].") ".$row["tipo"].", ";   
        }
        
        if($rescroquis!="")
           $rescroquis=substr($rescroquis, 0, -2).";\n";
        
            
        /** Computos metricos*/
        $rescomputo="";
        $sql='SELECT cac.nombre as tipo, count(i.itemId) as cantidad
                FROM '.$this->prefBD.'.item_anexo i
                    , '.$this->prefBD.'.catalogo_anexo_categoria cac
                WHERE i.fichaId='.$id.' and i.categoriaId=cac.itemId and cac.tipo=6
                group by cac.tipo 
                order by cac.nombre';
        
        $info = $dbm->Execute($sql);
        $info = $info->GetRows();
        
        foreach($info as $row){
          $rescomputo.=" (".$row["cantidad"].") ".$row["tipo"].", ";   
        }
        
        if($rescomputo!="")
           $rescomputo=substr($rescomputo, 0, -2).";\n";
     
        /** Presupuesto estimado - Ob. almacenamiento*/
        $pAlmacenamiento = "";
        $sql='SELECT t.nombre as tipo, ROUND(COUNT(i.itemId),0) as cantidad
             FROM '.$this->prefBD.'.item_infraestructurapresa i
                    , '.$this->prefBD.'.catalogo_tipo_clasificacion tc
                    , '.$this->prefBD.'.catalogo_tipo t
                WHERE i.fichaId='.$id.' and i.tipoId=tc.itemId and tc.tipoId=t.itemId and tc.tipo=6
              group by tc.tipo
                order by t.nombre';

        $info = $dbm->Execute($sql);
        $info = $info->GetRows();
        
        foreach($info as $row){
          $pAlmacenamiento.=" (".$row["cantidad"].") ".$row["tipo"].", ";   
        }
        
        if($pAlmacenamiento!="")
           $pAlmacenamiento=substr($pAlmacenamiento, 0, -2).";\n";
        
        /** Presupuesto estimado - Alm. Menor*/
        $pMenor = "";
        $sql='SELECT t.nombre as tipo, ROUND(COUNT(i.itemId),0) as cantidad
             FROM '.$this->prefBD.'.item_infraestructurapresa i
                    , '.$this->prefBD.'.catalogo_tipo_clasificacion tc
                    , '.$this->prefBD.'.catalogo_tipo t
                WHERE i.fichaId='.$id.' and i.tipoId=tc.itemId and tc.tipoId=t.itemId and tc.tipo=7
               group by tc.tipo
                order by t.nombre';
//echo "<br><br>=>".$sql;
        $info = $dbm->Execute($sql);
        $info = $info->GetRows();
        
        foreach($info as $row){
          $pMenor.=" (".$row["cantidad"].") ".$row["tipo"].", ";   
        }
        
        if($pMenor!="")
           $pMenor=substr($pMenor, 0, -2).";\n";
        
        /** Presupuesto estimado - Ob. Captacion*/
        $pCaptacion = "";
        $sql='SELECT t.nombre as tipo, ROUND(COUNT(i.itemId),0) as cantidad
             FROM '.$this->prefBD.'.item_infraestructurapresa i
                    , '.$this->prefBD.'.catalogo_tipo_clasificacion tc
                    , '.$this->prefBD.'.catalogo_tipo t
                WHERE i.fichaId='.$id.' and i.tipoId=tc.itemId and tc.tipoId=t.itemId and tc.tipo=8
               group by tc.tipo
                order by t.nombre';
//echo "<br><br>=>".$sql;
        $info = $dbm->Execute($sql);
        $info = $info->GetRows();
        
        foreach($info as $row){
          $pCaptacion.=" (".$row["cantidad"].") ".$row["tipo"].", ";   
        }
        
        if($pCaptacion!="")
           $pCaptacion=substr($pCaptacion, 0, -2).";\n";
        
        /** Presupuesto estimado - Ob. Conduccion*/
        $pConduccion = "";
        $sql='SELECT t.nombre as tipo, ROUND(COUNT(i.itemId),0) as cantidad
             FROM '.$this->prefBD.'.item_infraestructurapresa i
                    , '.$this->prefBD.'.catalogo_tipo_clasificacion tc
                    , '.$this->prefBD.'.catalogo_tipo t
                WHERE i.fichaId='.$id.' and i.tipoId=tc.itemId and tc.tipoId=t.itemId and tc.tipo=9
               group by tc.tipo
                order by t.nombre';
//echo "<br><br>=>".$sql;
        $info = $dbm->Execute($sql);
        $info = $info->GetRows();
        
        foreach($info as $row){
          $pConduccion.=" (".$row["cantidad"].") ".$row["tipo"].", ";   
        }
        
        if($pConduccion!="")
           $pConduccion=substr($pConduccion, 0, -2).";\n";
        
        /** Presupuesto estimado - Ob. Arte*/
        $pArte = "";
        $sql='SELECT t.nombre as tipo, ROUND(COUNT(i.itemId),0) as cantidad
             FROM '.$this->prefBD.'.item_infraestructurapresa i
                    , '.$this->prefBD.'.catalogo_tipo_clasificacion tc
                    , '.$this->prefBD.'.catalogo_tipo t
                WHERE i.fichaId='.$id.' and i.tipoId=tc.itemId and tc.tipoId=t.itemId and tc.tipo=10
               group by tc.tipo
                order by t.nombre';
//echo "<br><br>=>".$sql;
        $info = $dbm->Execute($sql);
        $info = $info->GetRows();
        
        foreach($info as $row){
          $pArte.=" (".$row["cantidad"].") ".$row["tipo"].", ";   
        }
        
        if($pArte!="")
           $pArte=substr($pArte, 0, -2).";\n";
        
        /** Presupuesto estimado - Act. Preparatorias*/
        $pPreparatoria = "";
        $sql='SELECT t.nombre as tipo, ROUND(COUNT(i.itemId),0) as cantidad
             FROM '.$this->prefBD.'.item_infraestructurapresa i
                    , '.$this->prefBD.'.catalogo_tipo_clasificacion tc
                    , '.$this->prefBD.'.catalogo_tipo t
                WHERE i.fichaId='.$id.' and i.tipoId=tc.itemId and tc.tipoId=t.itemId and tc.tipo=11
               group by tc.tipo
                order by t.nombre';

        $info = $dbm->Execute($sql);
        $info = $info->GetRows();
        
        foreach($info as $row){
          $pPreparatoria.=" (".$row["cantidad"].") ".$row["tipo"].", ";   
        }
        
        if($pPreparatoria!="")
           $pPreparatoria=substr($pPreparatoria, 0, -2).";\n";
        
          
        $res = "";
        if($resesquema=="")
          $res.= "Esquema hidraulico: ".$resesquema."\n";
        
        if($rescroquis=="")
          $res.= "Croquis de las obras: ".$rescroquis."\n";
        
        if($rescomputo=="")
          $res.= "Computos metricos: ".$rescomputo."\n";
        
        if($pAlmacenamiento=="")
          $res.= "Obras de almacenamiento: ".$pAlmacenamiento."\n";
        
        if($pMenor=="")
          $res.= "Almacenamiento menor: ".$pMenor."\n";
        
        if($pCaptacion=="")
          $res.= "Obras de captaci�n: ".$pCaptacion."\n";
        
        if($pConduccion=="")
          $res.= "Obras de conducci�n: ".$pConduccion."\n";
        
        if($pArte=="")
          $res.= "Obras de arte: ".$pArte."\n";
        
        if($pPreparatoria=="")
          $res.= "Actividades preparatorias: ".$pPreparatoria."\n";
        
        return $res;
    }
    
    function postgisDeleteItem($id,$tipoTabla){
      global $dbsig,$CFG;
      
      if($CFG->bPosgresql){
      if(trim($id)){
        postgisConnect();
      
        switch($tipoTabla){
            case '1': //Inventario
                    $this->conteTableName = 'vrhr_inventario_item';
                break;
                
            case '2': //Presa
                    $this->conteTableName = 'vrhr_presa_item';
                break;
                
            case '3': //
                    $this->conteTableName = 'vrhr_proyecto_item';
                break;
            case '4': //
                    $this->conteTableName = 'vrhr_estudio_item';
                break;
            case '5': //FIV
                    $this->conteTableName = 'vrhr_fiv_item';
                break;
            case '7': //SORA
                    $this->conteTableName = 'vrhr_sora_item';
                break;
            case '6': //Reuso
                    $this->conteTableName = 'vrhr_reuso_item';
                break;
        }//END SWITCH
        
        $sql = "DELETE FROM ".$this->conteTableName." WHERE itemId=".$id;
        
        $resdelete =$dbsig->Execute($sql); 
      }//END IF
      }//END IF
      
    }
    
    function getIdfichaItem($id,$table,$campo='fichaId'){
        global $db;
        
        $sql = "SELECT ".$campo." FROM ".$table." WHERE itemId=".$id;
        $res = $db->Execute($sql);
        $res = $res->fields[$campo];
        
        return $res;
    }
     

    function getTecnologia(){
        global $dbm;
        $dbm->SetFetchMode(ADODB_FETCH_ASSOC);
        
        $sql = "select itemId, nombre from vrhr_reuso.catalogo_tecnologia";
        $sql.=" ORDER BY nombre ASC";
        $info = $dbm->Execute($sql);
        $item = $info->GetRows();
        $opt = $this->getArrayData($item,"itemId","nombre");    
        
        return $opt;
    }

    function getCatalogSituacion($tipo=0){
        global $dbm;
		$dbm->SetFetchMode(ADODB_FETCH_ASSOC);
        
        $sql = "select itemId, nombre from vrhr_catalogo.situacion";
        $sql.=" ORDER BY nombre ASC";
        $info = $dbm->Execute($sql);
        $item = $info->GetRows();
        $opt = $this->getArrayData($item,"itemId","nombre");		
        
        return $opt;
    }
    
    function getCatalogoProyecto(){
        global $dbm;
		$dbm->SetFetchMode(ADODB_FETCH_ASSOC);
        $tableAux = "vrhr_proyecto.item";
        
        $sql = "SELECT i.itemId, i.nombre 
                FROM ".$tableAux." i";
        $info = $dbm->Execute($sql);
        $info = $info->GetRows();
        $info = $this->getArrayData($info,"itemId","nombre");
        
        return $info;
    }
    
    function getCatalogoTipoFicha(){
        global $dbm;
		$dbm->SetFetchMode(ADODB_FETCH_ASSOC);
        
        $tableAux = "vrhr_estudio.catalogo_tipo";
        
        $sql = "SELECT i.itemId, i.nombre 
                FROM ".$tableAux." i";
        $info = $dbm->Execute($sql);
        $info = $info->GetRows();
        $info = $this->getArrayData($info,"itemId","nombre");
        
        return $info;
    }
    
    function getCatalogoTipoFiv(){
        global $dbm;
		$dbm->SetFetchMode(ADODB_FETCH_ASSOC);
      
        $tableAux = "vrhr_fiv.item";
        
        $sql = "SELECT i.itemId, i.nombre 
                FROM ".$tableAux." i";
        $info = $dbm->Execute($sql);
        $info = $info->GetRows();
        $info = $this->getArrayData($info,"itemId","nombre");
    
        return $info;
    }
    
    function getCatalogInstitucion(){
        global $dbm;
		$dbm->SetFetchMode(ADODB_FETCH_ASSOC);
        
        $tableAux = "vrhr_institucion.item";
        
        $sql = "SELECT i.itemId, i.nombre 
                FROM ".$tableAux." i";
        $info = $dbm->Execute($sql);
        $info = $info->GetRows();
        $info = $this->getArrayData($info,"itemId","nombre");
        
        return $info;
    }

    function getCatalogFuentes($tipo=0){
        global $dbm;
        $dbm->SetFetchMode(ADODB_FETCH_ASSOC);
        
        $sql = "select itemId, nombre from vrhr_cuenca.nivel5";
        $sql.=" ORDER BY nombre ASC";
        $info = $dbm->Execute($sql);
        $item = $info->GetRows();
        $opt = $this->getArrayData($item,"itemId","nombre");    
        
        return $opt;
    }


    function tipoRegistroOptions($butf8=1){
      $res = array();
      $res[1] = $this->setUtf8("Individual � Familiar",$butf8);
      $res[2] = $this->setUtf8("Colectivo",$butf8);
      
      return $res;  
    }
    
    function getListCompetencia($butf8=1){
      $res = array();
      
      $res[1] = $this->setUtf8("Departamental",$butf8);
      $res[2] = $this->setUtf8("Interdepartamental",$butf8);
      
      return $res;    
    }

    function getArrayCondicion(){
        $res = array();
        
        $res[1] = 'Si';
        $res[0] = 'No';
        
        return $res;
    }

    function getCatalogTecnologia($tipo=0){
        global $dbm;
        $dbm->SetFetchMode(ADODB_FETCH_ASSOC);
        
        $sql = "select itemId, nombre from vrhr_reuso.catalogo_tecnologia";
        $sql.=" ORDER BY nombre ASC";
        $info = $dbm->Execute($sql);
        $item = $info->GetRows();
        $opt = $this->getArrayData($item,"itemId","nombre");    
        
        return $opt;
    }
    
    function limpiar_caracteres_especiales($s) {
        $s = ereg_replace("[����]","a",$s);
        $s = ereg_replace("[����]","A",$s);
        $s = ereg_replace("[���]","e",$s);
        $s = ereg_replace("[���]","E",$s);
        $s = ereg_replace("[���]","i",$s);
        $s = ereg_replace("[���]","I",$s);
        $s = ereg_replace("[�����]","o",$s);
        $s = ereg_replace("[����]","O",$s);
        $s = ereg_replace("[���]","u",$s);
        $s = ereg_replace("[���]","U",$s);
        $s = str_replace(" ","-",$s);
        $s = str_replace("�","n",$s);
        $s = str_replace("�","N",$s);
        //para ampliar los caracteres a reemplazar agregar lineas de este tipo:
        //$s = str_replace("caracter-que-queremos-cambiar","caracter-por-el-cual-lo-vamos-a-cambiar",$s);
        return $s;
    }
    
    function limpiar_texto($str){
        $str = str_replace(chr(226),"-",$str);
        $str = str_replace(chr(128),"",$str);
        $str = str_replace(chr(162),"",$str);
        
        return $str;
    }


    /**
     * Funcionalidad para DataTable de Metronic
     *
     */
    function filterArray( $array, $allowed = [] ) {
        return array_filter(
            $array,
            function ( $val, $key ) use ( $allowed ) { // N.b. $val, $key not $key, $val
                return isset( $allowed[ $key ] ) && ( $allowed[ $key ] === true || $allowed[ $key ] === $val );
            },
            ARRAY_FILTER_USE_BOTH
        );
    }

    function filterKeyword( $data, $search, $field = '' ) {
        $filter = '';
        if ( isset( $search['value'] ) ) {
            $filter = $search['value'];
        }
        if ( ! empty( $filter ) ) {
            if ( ! empty( $field ) ) {
                if ( strpos( strtolower( $field ), 'date' ) !== false ) {
                    // filter by date range
                    $data = $this->filterByDateRange( $data, $filter, $field );
                } else {
                    // filter by column
                    $data = array_filter( $data, function ( $a ) use ( $field, $filter ) {
                        return (boolean) preg_match( "/$filter/i", $a[ $field ] );
                    } );
                }

            } else {
                // general filter
                $data = array_filter( $data, function ( $a ) use ( $filter ) {
                    return (boolean) preg_grep( "/$filter/i", (array) $a );
                } );
            }
        }

        return $data;
    }

    function filterByDateRange( $data, $filter, $field ) {
        // filter by range
        if ( ! empty( $range = array_filter( explode( '|', $filter ) ) ) ) {
            $filter = $range;
        }

        if ( is_array( $filter ) ) {
            foreach ( $filter as &$date ) {
                // hardcoded date format
                $date = date_create_from_format( 'm/d/Y', stripcslashes( $date ) );
            }
            // filter by date range
            $data = array_filter( $data, function ( $a ) use ( $field, $filter ) {
                // hardcoded date format
                $current = date_create_from_format( 'm/d/Y', $a[ $field ] );
                $from    = $filter[0];
                $to      = $filter[1];
                if ( $from <= $current && $to >= $current ) {
                    return true;
                }

                return false;
            } );
        }

        return $data;
    }


    /**
     * Todas las herramientas para un submodulo
     * -----------------------------------------------------------------------------------------------------------------
     */
    function submodule_init_sbm()
    {
        global $CFGm,$CFG, $dbm,$privFace,$privSM,$core,$grilla,$grilla_tablas_adicionales,$tabs,$campos;
        /**
         * Información del servidor de reportes Pentaho
         */
        $this->pentaho = $CFGm->pentaho;

        /**
         * Recopilamos información necesaria para un submódulo
         * el submodulo
         */
        $this->obj_datatable;
        $this->core = $core;
        /**
         * Base de datos principal
         */
        $this->dbm = $dbm;
        /**
         * Mapeo de tablas
         */
        $this->tabla = $CFGm->tabla;
        $this->tabla_core = $CFG->tabla;
        /**
         * Datos del usuario en session
         */
        $this->userv = $_SESSION["userv"];
        $this->userId = $_SESSION["userv"]["memberId"];
        /**
         * Permisos de usuarios tanto para base de datos como interfaz
         */

        $this->privFace = $privFace;
        $this->privSM = $privSM;
        /**
         * Configuramos y creamos las carpetas necesarias del módulo
         */
        $this->directory = $CFGm->directory;
        /**
         * configuración de la grilla
         */
        $this->grilla = $grilla;
        $this->grilla_tablas_adicionales = $grilla_tablas_adicionales;
        /**
         * Configuración de los tabs
         */
        $this->tabs = $tabs;
        /**
         * Configuración de los tabs
         */
        $this->campos = $campos;
    }
    /**
     * Funcionalidad para generar los tabs de los items
     */
    public function get_item_tab_sbm($type,$tabs){
        $tabs_grupo = $this->tabs[$tabs];
        if(count($tabs_grupo)>0){
            $respuesta = array();
            foreach ($tabs_grupo as $row){
                $add=0;
                if($type =="new"){
                    if($row["new"]==1) $add=1;
                }else{
                    $add=1;
                }
                if ($add==1) $respuesta[] = $row;
            }
        }else{
            $respuesta[] = array(
                "label"=>"TABS No Configurado !!!"
            ,   "id_name"=>"no_tabs"
            ,   "sub_control"=>"no_tabs"
            ,   "active"=>"0"
            ,   "icon" => "flaticon-delete-2"
            ,   "new" => 0
            );
        }
        return $respuesta;
    }
    /**
     * Nos devuelve el arreglo de configuración del arreglo de items a listar
     */
    public function get_config_list_sbm($tipo){
        return $this->grilla[$tipo];
    }

    /**
     * Nos devuelve la grilla necesitamos utilizar, se añade el id y el la posición de los botones de acciones
     */
    public function get_grilla_list_sbm($grilla,$position="left",$id_name="itemId"){
        $grilla = $this->grilla[$grilla];
        $id_add[]=array(
            "campo" => $id_name
        ,    "field"=> "Actions"
        ,   "label"=> "Accion"
        ,   "type_field"=>"text"
        ,   "as" => "Actions"
        ,   "activo" => 1
        );
        if($position=="left"){
            $grilla = array_merge($id_add,$grilla);
        }else{
            $grilla = array_merge($grilla,$id_add);
        }
        return $grilla;
    }
    public function get_grilla_list_sbm_pg($grilla,$position="left",$id_name="itemid"){
        $grilla = $this->grilla[$grilla];
        $id_add[]=array(
            "campo" => $id_name
        ,   "field"=> "actions"
        ,   "label"=> "Acción"
        ,   "type_field"=>"text"
        ,   "as" => "actions"
        ,   "activo" => 1
        );
        if($position=="left"){
            $grilla = array_merge($id_add,$grilla);
        }else{
            $grilla = array_merge($grilla,$id_add);
        }
        return $grilla;
    }
    /**
     * le datmos formato al arreglo de grilla para mandar a generar el json
     */
    public function get_grilla_tranformar_arreglo_sbm($campos){
        $col = array();
        for($i=0 ; $i<count($campos);$i++){
            if($campos[$i]["activo"]){
                $field = $campos[$i]["campo"];
                $col_extra = $campos[$i];
                if(trim($campos[$i]["tabla_alias"])==""){
                    $col_extra["db"] = '`i`.`'.$field.'`';
                }else{
                    $col_extra["db"] = '`'.trim($campos[$i]["tabla_alias"]).'`.`'.$field.'`';
                }
                if(isset($campos[$i]["as"])){
                    $col_extra["dt"] = $campos[$i]["as"];
                }else{
                    $col_extra["dt"] = $campos[$i]["field"];
                }

                if($campos[$i]["as"]==""){
                    unset($col_extra["as"]);
                }
                $col[]= $col_extra;
            }
        }
        return $col;
    }
    public function get_grilla_tranformar_arreglo_sbm_pg($campos){
        $col = array();
        for($i=0 ; $i<count($campos);$i++){
            if($campos[$i]["activo"]){
                $field = $campos[$i]["campo"];
                $col_extra = $campos[$i];
                if(trim($campos[$i]["tabla_alias"])==""){
                    $col_extra["db"] = "i.".$field."";
                }else{
                    $col_extra["db"] = "".trim($campos[$i]["tabla_alias"]).".".$field."";
                }
                if(isset($campos[$i]["as"])){
                    $col_extra["dt"] = $campos[$i]["as"];
                }else{
                    $col_extra["dt"] = $campos[$i]["field"];
                }

                if($campos[$i]["as"]==""){
                    unset($col_extra["as"]);
                }
                $col[]= $col_extra;
            }
        }
        return $col;
    }
    public function get_grilla_datatable_simple( $db,$grilla,$table, $primaryKey, $extraWhere, $groupBy, $having,$position="left"){
        /**
         * Recojemos todos los campos que mostraremos en la lista
         * y le damos formato de un arreglo para generar el json para datatable
         */
        $campos = $this->get_grilla_list_sbm($grilla,$position,$primaryKey);

        $col = $this->get_grilla_tranformar_arreglo_sbm($campos);
        //print_struc($col);exit;
        $joinQuery = "FROM ".$table." AS `i` \n\r";

        $tablas_adicionales = $this->grilla_tablas_adicionales["$grilla"];
        //print_struc($tablas_adicionales);


        $joinQuery = "FROM ".$table." AS `i` ";
        $join_extra = "\n\r\n\r";
        if(count($tablas_adicionales)>0){
            foreach ($tablas_adicionales as $row){
                if($row["activo"]){
                    $join_extra .= " left join ".$row["tabla"]." as `".$row["alias"]."` \n";

                    if( strpos($row["relacion_id"], ".") === false){
                        $relacion = "`i`.`".$row["relacion_id"]."`";
                    }else{
                        $relacion = $row["relacion_id"];
                    }
                    $join_extra .= " on  (`".$row["alias"]."`.`".$row["campo_id"]."` = ".$relacion." ) \n";
                    /*
                    $join_extra .= " left join ".$row["tabla"]." as `".$row["alias"]."` \n";
                    $join_extra .= " on  (`".$row["alias"]."`.`".$row["campo_id"]."` = `i`.`".$row["relacion_id"]."`) \n";
                    */
                }

            }
        }
        $joinQuery = $joinQuery.$join_extra;

        $sql_details = array(
            'user' => $db["user"],
            'pass' => $db["password"],
            'db'   => $db["database"],
            'host' => $db["server"]
        );

        $resultado = SSP::simple( $_REQUEST, $sql_details, $table, $primaryKey, $col, $joinQuery, $extraWhere, $groupBy, $having );

        return $resultado;
    }
    public function get_grilla_datatable_simple_pg( $db,$grilla,$table, $primaryKey, $extraWhere, $groupBy, $having,$position="left"){
        /**
         * Recojemos todos los campos que mostraremos en la lista
         * y le damos formato de un arreglo para generar el json para datatable
         */
        $campos = $this->get_grilla_list_sbm_pg($grilla,$position,$primaryKey);
        //print_struc($campos);exit;
        $col = $this->get_grilla_tranformar_arreglo_sbm_pg($campos);
        //print_struc($col);exit;
        $joinQuery = "FROM ".$table." AS i ";

        $tablas_adicionales = $this->grilla_tablas_adicionales["$grilla"];
        //print_struc($tablas_adicionales);

        $joinQuery = "FROM ".$table." AS i ";
        $join_extra = "";
        if(count($tablas_adicionales)>0){
            foreach ($tablas_adicionales as $row){
                if($row["activo"]){
                    $join_extra .= " left join ".$row["tabla"]." as ".$row["alias"]." ";
                    $join_extra .= " on  (".$row["alias"].".".$row["campo_id"]." = i.".$row["relacion_id"].") ";
                }

            }
        }
        $joinQuery = $joinQuery.$join_extra;

        $sql_details = array(
            'user' => $db["user"],
            'pass' => $db["password"],
            'db'   => $db["database"],
            'host' => $db["server"]
        );

        $resultado = SSP::simple_pg( $_REQUEST, $sql_details, $table, $primaryKey, $col, $joinQuery, $extraWhere, $groupBy, $having );
        return $resultado;
    }
    /**
     * Realizamos el proceso de construcción de los datos para datable
     */

    /**
     * Procesa datos de un formulario
     *
     * $item = es el arreglo que contiene los datos enviados desde el frontend
     * $campos = arreglo de campos configurados que se procesaran.
     *
     *
     */
    public function procesa_campos_sbm($item,$campos,$accion){

        $resultado = array();
        foreach (array_keys($campos) as $clave) {
            if(isset($item[$clave])) {

                $resultado[$clave] = trim($item[$clave]);
                switch ($campos[$clave]["tipo"]){
                    case 'text':
                        if (get_magic_quotes_gpc() ){
                            $resultado[$clave] = stripslashes($resultado[$clave]);
                        }
                        break;
                    /**
                     * Para los formatos de fecha tipo: dd/mm/yyyy
                     */
                    case 'date_01':
                        $resultado[$clave] = str_replace("/","-",$resultado[$clave]);
                        $resultado[$clave] = $this->invertDate_sbm($resultado[$clave]);
                        if($resultado[$clave]=="--") unset($resultado[$clave]);
                        break;
                    case 'datetime_01':
                        $dato = explode(" ",$resultado[$clave]);
                        if(trim($dato[0])!="" && trim($dato[1])!=""){
                            $fecha = $dato[0];
                            $hora = trim($dato[1]);
                            $fecha = str_replace("/","-",$fecha);
                            $fecha = $this->invertDate_sbm($fecha);
                            $resultado[$clave] = $fecha." ".$hora;
                            //echo $resultado[$clave];exit;
                        }else{
                            unset($resultado[$clave]);
                        }


                        break;
                }
            }else{
                switch ($campos[$clave]["tipo"]){
                    /**
                     * si es de tipo checkbox_01 si o si guarda a la base de datos con 0 o 1
                     */
                    case 'checkbox_01':
                        if ($resultado[$clave] == "") $resultado[$clave]=0;
                        else $resultado[$clave] = 1;
                        break;
                }
            }


        }
        /**
         * añadimos los datos de fechas y usuarios que actualizan los datos
         */
        if($accion =="update"){
            $resultado["dateUpdate"] = date("Y-m-d H:i:s");
            $resultado["userUpdate"] = $this->userId;
        }
        if($accion=="new"){
            $resultado["dateCreate"] = $resultado["dateUpdate"] = date("Y-m-d H:i:s");
            $resultado["userCreate"] = $resultado["userUpdate"] = $this->userId;
        }

        /**/
        return $resultado;
    }

    public function procesa_campos_sbm_pg($item, $campos, $accion) {
        $resultado = array();
        foreach (array_keys($campos) as $clave) {
            if(isset($item[$clave])) {

                $resultado[$clave] = trim($item[$clave]);
                switch ($campos[$clave]["tipo"]){
                    case 'text':
                        if (get_magic_quotes_gpc() ){
                            $resultado[$clave] = stripslashes($resultado[$clave]);
                        }
                        break;
                    /**
                     * Para los formatos de fecha tipo: dd/mm/yyyy
                     */
                    case 'date_01':
                        $resultado[$clave] = str_replace("/","-",$resultado[$clave]);
                        $resultado[$clave] = $this->invertDate_sbm($resultado[$clave]);
                        if($resultado[$clave]=="--") unset($resultado[$clave]);
                        break;
                    case 'datetime_01':
                        $dato = explode(" ",$resultado[$clave]);
                        if(trim($dato[0])!="" && trim($dato[1])!=""){
                            $fecha = $dato[0];
                            $hora = trim($dato[1]);
                            $fecha = str_replace("/","-",$fecha);
                            $fecha = $this->invertDate_sbm($fecha);
                            $resultado[$clave] = $fecha." ".$hora;
                            //echo $resultado[$clave];exit;
                        }else{
                            unset($resultado[$clave]);
                        }
                        break;
                }
            }else{
                switch ($campos[$clave]["tipo"]){
                    /**
                     * si es de tipo checkbox_01 si o si guarda a la base de datos con 0 o 1
                     */
                    case 'checkbox_01':
                        if ($resultado[$clave] == "") $resultado[$clave]=0;
                        else $resultado[$clave] = 1;
                        break;
                }
            }
        }
        /**
         * añadimos los datos de fechas y usuarios que actualizan los datos
         */
        if($accion =="update"){
            $resultado["dateupdate"] = date("Y-m-d H:i:s");
            $resultado["userupdate"] = $this->userId;
        }
        if($accion=="new"){
            $resultado["datecreate"] = $resultado["dateupdate"] = date("Y-m-d H:i:s");
            $resultado["usercreate"] = $resultado["userupdate"] = $this->userId;
        }

        /**/
        return $resultado;
    }

    /**
     * Invierte el formato de uan fecha de DD/MM/YYYY a YYYY/MM/DD
     *
     * @param date $datein
     * @return date
     */
    function invertDate_sbm($datein){
        $dateaux = explode("-",$datein);
        $dateaux = $dateaux[2]."-".$dateaux[1]."-".$dateaux[0];
        return $dateaux;
    }


    function item_update_verifica_sbm($tabla,$itemId,$campo_id){
        $sql = "select ".$campo_id." from ".$tabla." where ".$campo_id."=".$itemId;
        $resultado = $this->dbm->Execute($sql);
        $resultado = $resultado->GetRows();
        if(count($resultado)==0){
            return false;
        }else{
            return true;
        }
    }

    /**
     * Borrar registro de un submodulo
     */
    function item_delete_sbm($itemId,$campo_id,$tabla,$where=""){
        global $privFace;


        if($privFace["editar"] and $privFace["eliminar"]){
            if($itemId!=''){
                if($campo_id!=""){
                    $verifica = $this->item_update_verifica_sbm($tabla,$itemId,$campo_id);
                }else{
                    $verifica = true;
                }
                if($verifica) {
                    $sql = "DELETE FROM ".$tabla." WHERE ";
                    $sqlWhere = $campo_id."=".$itemId;

                    if($where!="" && $campo_id !=""){
                        $sql .= $sqlWhere." and (".$where.")";
                    }elseif($where!="" && $campo_id ==""){
                        $sql .= $where;
                    }else{
                        $sql .= $sqlWhere;
                    }
                    if($where!="") $sql .= " and (".$where.")";
                    $resdelete = $this->dbm->Execute($sql);
                    if($resdelete){
                        $res["res"] = 1;
                        $res["id"] = $itemId;
                    }else{
                        $res["res"] = 2;
                        $res["msg"] = "No se logro eliminar el registro de la B.D.";
                        $res["msgdb"] = $this->dbm->ErrorMsg();
                    }

                }else{
                    $res["res"] = 2;
                    $res["msg"] = "El registro con ID = '".$itemId."'' que desea actualizar no existe o fue eliminado ";
                }
            }else{
                $res["res"] = 2;
                $res["msg"] = "El id del registro que quiere eliminar esta vacio";
            }
        }else{
            $res["res"] = 2;
            $res["msg"] = "No tiene permisos para eliminar este registro";
        }
        return $res;
    }

    function item_delete_sbm_pg($itemId,$campo_id,$tabla,$where=""){
        global $privFace;


        if($privFace["eliminar"]){
            if($itemId!=''){
                if($campo_id!=""){
                    $verifica = $this->item_update_verifica_sbm($tabla,$itemId,$campo_id);
                }else{
                    $verifica = true;
                }
                if($verifica) {
                    $sql = "DELETE FROM ".$tabla." WHERE ";
                    $sqlWhere = $campo_id."=".$itemId;

                    if($where!="" && $campo_id !=""){
                        $sql .= $sqlWhere." and (".$where.")";
                    }elseif($where!="" && $campo_id ==""){
                        $sql .= $where;
                    }else{
                        $sql .= $sqlWhere;
                    }
                    if($where!="") $sql .= " and (".$where.")";
                    $resdelete = $this->dbm->Execute($sql);
                    if($resdelete){
                        $res["res"] = 1;
                        $res["id"] = $itemId;
                    }else{
                        $res["res"] = 2;
                        $res["msg"] = "No se logro eliminar el registro de la B.D.";
                        $res["msgdb"] = $this->dbm->ErrorMsg();
                    }

                }else{
                    $res["res"] = 2;
                    $res["msg"] = "El registro con ID = '".$itemId."'' que desea actualizar no existe o fue eliminado ";
                }
            }else{
                $res["res"] = 2;
                $res["msg"] = "El id del registro que quiere eliminar esta vacio";
            }
        }else{
            $res["res"] = 2;
            $res["msg"] = "No tiene permisos para eliminar este registro";
        }
        return $res;
    }

    function get_dir_item_sbm($item_id,$create = 0){
        $dir = $this->directory;
        $dir = $dir.floor($item_id/100)."/";
        if($create) $this->viewDirectory($dir);
        $dir = $dir.$item_id."/";
        if($create) $this->viewDirectory($dir);
        return $dir;
    }
    function get_dir_item_archivo_sbm($item_id,$create = 0,$carpeta="archivos"){
        $dir = $this->get_dir_item_sbm($item_id,$create);
        $dir .= $carpeta."/";
        if($create) $this->viewDirectory($dir);
        return $dir;
    }
    function item_delete_archivo_sbm($id,$item_id,$carpeta="archivos"){
        $item = $this->get_item($id,$item_id);
        $dir = $this->get_dir_item_archivo_sbm($item_id,0,$carpeta);
        $file = $dir.$id.".".$item["adjunto_extension"];
        unlink($file);
    }

    function item_delete_archivo_sbm_pg($id,$item_id,$file_extension,$carpeta="archivos"){
        //$item = $this->get_item_pg($id,$item_id);
        $dir = $this->get_dir_item_archivo_sbm($item_id,0,$carpeta);
        //$file = $dir.$id.".".$item["adjunto_extension"];
        $file = $dir.$id.".".$file_extension;
        unlink($file);
    }

    private function imagen_init($archivo,$calidad="85"){
        $this->image = new hft_image($archivo);
        $this->image->set_parameters($calidad);
    }
    private function imagen_changesize_sbm($file,$w,$h,$mode="-",$type="JPEG"){

        $this->image->resize($w,$h,$mode);
        $res = $this->image->output_resized($file, "JPEG");
        chmod($file,0777);
        return $res;
    }
    function item_imagen_subir_sbm($archivo, $dir, $id){

        $imagen = $id.".jpg";
        $this->viewDirectory($dir."thumbnail/");
        //====================================================
        $this->imagen_init($archivo);

        $file = $dir."/1_".$imagen;
        $this->imagen_changesize_sbm($file,100,'*');

        $file = $dir."/2_".$imagen;
        $this->imagen_changesize_sbm($file,200,'*');

        $file = $dir."/3_".$imagen;
        $this->imagen_changesize_sbm($file,400,'*');

        $file = $dir."/4_".$imagen;
        $this->imagen_changesize_sbm($file,800,'*');

        $file = $dir."/4_".$imagen;
        $this->imagen_changesize_sbm($file,1000,'*');
        //$this->image->set_parameters('90');
        /**
         * Thumbnail
         */
        $thumbnail= "thumbnail/";

        $tbc = $dir.$thumbnail."1_".$imagen;
        $this->saveSquareThumb($archivo,$tbc,100);
        chmod($tbc,0777);

        $tbc = $dir.$thumbnail."2_".$imagen;
        $this->saveSquareThumb($archivo,$tbc,200);
        chmod($tbc,0777);

        $tbc = $dir.$thumbnail."3_".$imagen;
        $this->saveSquareThumb($archivo,$tbc,300);
        chmod($tbc,0777);
    }

    /**
     * Procesa un Imagen
     */
    function item_imagen_sbm($adjunto,$item_id,$id,$item,$tabla,$accion="new",$item_id_name="item_id",$carpeta="archivos"){

        $res = array();
        if(isset($adjunto["name"]) && $adjunto["name"]!="" && $adjunto["error"]==0){
            if($item_id!=""){
                $dir = $this->get_dir_item_archivo_sbm($item_id,1,$carpeta);
            }else{
                $dir = $this->get_dir_item_archivo_sbm($id,1,$carpeta);
            }



            /**
             * Borramos el archivo previamente almacenado
             */
            if($accion=="update"){
                unlink($dir.$id.".".$item["adjunto_extension"]);
            }
            /**
             * Sacamos la extensión del archivo
             */
            $res["adjunto_extension"] = $this->getExtFile($adjunto["name"]);
            /**
             * Realizamos la copia del archivo
             */
            $adjunto_local = $dir.$id.".".$res["adjunto_extension"];
            if(copy($adjunto["tmp_name"],$adjunto_local)){
                $copy = 1;
                unlink($adjunto["tmp_name"]);
            }
            else $copy = 0;

            $campo_id="itemId";
            if($item_id_name!="") $where = $item_id_name."='".$item_id."'";



            if ($copy==1){
                chmod($adjunto_local,0777);
                $datos = array();
                $datos["adjunto_nombre"]=$adjunto["name"];
                $datos["adjunto_extension"] = $res["adjunto_extension"];
                $datos["adjunto_tamano"]=$adjunto["size"];
                $datos["adjunto_tipo"]=$adjunto["type"];
                $datos["avatar"]=1;

                $res = $this->item_update_sbm($id,$datos,$tabla,"update",$campo_id,$where);
                /**
                 * Iniciamos a generar los otros tipos gráficos
                 */
                $this->item_imagen_subir_sbm($adjunto_local,$dir,$id,$res["adjunto_extension"]);
                if($res["res"]==1){
                    $res["res"] = 1;
                    $res["msg"] = "se adjunto con exito el archivo";
                }else{
                    $res["res"] = 2;
                    $res["msg"] = $res["msgdb"];
                }
            }else{
                $datos = array();
                $datos["adjunto_nombre"] = "";
                $datos["adjunto_extension"] = "";
                $datos["adjunto_tamano"] = "";
                $datos["adjunto_tipo"] = "";
                $datos["avatar"]=0;

                $res = $this->item_update_sbm($id,$datos,$tabla,"update",$campo_id,$where);

                $res["res"] = 2;
                $res["msg"] = "No se copio el archivo en el servidor.";
            }
        }else{
            $res["res"] = 2;
            $res["msg"] = "No se adjunto ningun archivo, el archivo enviado no cuenta con datos";
        }
        return $res;
    }

    /**
     * Procesa un archivo adjunto
     */
    function item_adjunto_sbm($adjunto,$item_id,$id,$item,$tabla,$accion="new",$item_id_name="item_id",$carpeta="archivos"){
        $res = array();
        if(isset($adjunto["name"]) && $adjunto["name"]!="" && $adjunto["error"]==0){
            $dir = $this->get_dir_item_archivo_sbm($item_id,1,$carpeta);
            /**
             * Borramos el archivo previamente almacenado
             */
            if($accion=="update"){
                unlink($dir.$id.".".$item["adjunto_extension"]);
            }
            /**
             * Sacamos la extensión del archivo
             */
            $res["adjunto_extension"] = $this->getExtFile($adjunto["name"]);
            /**
             * Realizamos la copia del archivo
             */
            $adjunto_local = $dir.$id.".".$res["adjunto_extension"];
            if(copy($adjunto["tmp_name"],$adjunto_local)) $copy = 1;
            else $copy = 0;

            $campo_id="itemId";
            $where = $item_id_name."='".$item_id."'";

            if ($copy==1){
                chmod($adjunto_local,0777);
                $datos = array();
                $datos["adjunto_nombre"]=$adjunto["name"];
                $datos["adjunto_extension"] = $res["adjunto_extension"];
                $datos["adjunto_tamano"]=$adjunto["size"];
                $datos["adjunto_tipo"]=$adjunto["type"];

                $res = $this->item_update_sbm($id,$datos,$tabla,"update",$campo_id,$where);

                if($res["res"]==1){
                    $res["res"] = 1;
                    $res["msg"] = "se adjunto con exito el archivo";
                }else{
                    $res["res"] = 2;
                    $res["msg"] = $res["msgdb"];
                }
            }else{
                $datos = array();
                $datos["adjunto_nombre"] = "";
                $datos["adjunto_extension"] = "";
                $datos["adjunto_tamano"] = "";
                $datos["adjunto_tipo"] = "";

                $res = $this->item_update_sbm($id,$datos,$tabla,"update",$campo_id,$where);

                $res["res"] = 2;
                $res["msg"] = "No se copio el archivo en el servidor.";
            }
        }else{
            $res["res"] = 2;
            $res["msg"] = "No se adjunto ningun archivo, el archivo enviado no cuenta con datos";
        }
        return $res;
    }

    /**
     * Procesa un archivo adjunto
     */
    function item_adjunto_sbm_nivel1($adjunto,$id,$item,$tabla,$accion="new",$carpeta="archivos"){
        $res = array();
        if(isset($adjunto["name"]) && $adjunto["name"]!="" && $adjunto["error"]==0){
            $dir = $this->get_dir_item_archivo_sbm($id,1,$carpeta);
            /**
             * Borramos el archivo previamente almacenado
             */
            if($accion=="update"){
                unlink($dir.$id.".".$item["adjunto_extension"]);
            }
            /**
             * Sacamos la extensión del archivo
             */
            $res["adjunto_extension"] = $this->getExtFile($adjunto["name"]);
            /**
             * Realizamos la copia del archivo
             */
            $adjunto_local = $dir.$id.".".$res["adjunto_extension"];
            if(copy($adjunto["tmp_name"],$adjunto_local)) $copy = 1;
            else $copy = 0;

            $campo_id="itemId";
            $where = "";

            if ($copy==1){
                chmod($adjunto_local,0777);
                $datos = array();
                $datos["adjunto_nombre"]=$adjunto["name"];
                $datos["adjunto_extension"] = $res["adjunto_extension"];
                $datos["adjunto_tamano"]=$adjunto["size"];
                $datos["adjunto_tipo"]=$adjunto["type"];

                $res = $this->item_update_sbm($id,$datos,$tabla,"update",$campo_id,$where);

                if($res["res"]==1){
                    $res["res"] = 1;
                    $res["msg"] = "se adjunto con exito el archivo";
                }else{
                    $res["res"] = 2;
                    $res["msg"] = $res["msgdb"];
                }
            }else{
                $datos = array();
                $datos["adjunto_nombre"] = "";
                $datos["adjunto_extension"] = "";
                $datos["adjunto_tamano"] = "";
                $datos["adjunto_tipo"] = "";

                $res = $this->item_update_sbm($id,$datos,$tabla,"update",$campo_id,$where);

                $res["res"] = 2;
                $res["msg"] = "No se copio el archivo en el servidor.";
            }
        }else{
            $res["res"] = 2;
            $res["msg"] = "No se adjunto ningun archivo, el archivo enviado no cuenta con datos";
        }
        return $res;
    }

    function item_adjunto_sbm_pg($adjunto,$item_id,$id,$item,$tabla,$accion="new",$item_id_name="item_id",$carpeta="archivos"){
        $res = array();
        if(isset($adjunto["name"]) && $adjunto["name"]!="" && $adjunto["error"]==0){
            $dir = $this->get_dir_item_archivo_sbm($item_id,1,$carpeta);
            /**
             * Borramos el archivo previamente almacenado
             */
            if($accion=="update"){
                unlink($dir.$id.".".$item["adjunto_extension"]);
            }
            /**
             * Sacamos la extensión del archivo
             */
            $res["adjunto_extension"] = $this->getExtFile($adjunto["name"]);
            /**
             * Realizamos la copia del archivo
             */
            $adjunto_local = $dir.$id.".".$res["adjunto_extension"];
            if(copy($adjunto["tmp_name"],$adjunto_local)) $copy = 1;
            else $copy = 0;

            $campo_id="itemid";
            $where = $item_id_name."='".$item_id."'";

            if ($copy==1){
                chmod($adjunto_local,0777);
                $datos = array();
                $datos["adjunto_nombre"]=$adjunto["name"];
                $datos["adjunto_extension"] = $res["adjunto_extension"];
                $datos["adjunto_tamano"]=$adjunto["size"];
                $datos["adjunto_tipo"]=$adjunto["type"];

                $res = $this->item_update_sbm_pg($id,$datos,$tabla,"update",$campo_id,$where);

                if($res["res"]==1){
                    $res["res"] = 1;
                    $res["msg"] = "se adjunto con exito el archivo";
                }else{
                    $res["res"] = 2;
                    $res["msg"] = $res["msgdb"];
                }
            }else{
                $datos = array();
                $datos["adjunto_nombre"] = "";
                $datos["adjunto_extension"] = "";
                $datos["adjunto_tamano"] = "";
                $datos["adjunto_tipo"] = "";

                $res = $this->item_update_sbm_pg($id,$datos,$tabla,"update",$campo_id,$where);

                $res["res"] = 2;
                $res["msg"] = "No se copio el archivo en el servidor.";
            }
        }else{
            $res["res"] = 2;
            $res["msg"] = "No se adjunto ningun archivo, el archivo enviado no cuenta con datos";
        }
        return $res;
    }

    function item_adjunto_mat_sbm($adjunto,$item_id,$id,$item,$tabla,$accion="new",$item_id_name="item_id",$carpeta="archivos"){
        $res = array();
        if(isset($adjunto["name"]) && $adjunto["name"]!="" && $adjunto["error"]==0){
            $dir = $this->get_dir_item_archivo_sbm($item_id,1,$carpeta);
            /**
             * Borramos el archivo previamente almacenado
             */
            if($accion=="update"){
                unlink($dir.$id.".".$item["adjunto_extension_mat"]);
            }
            /**
             * Sacamos la extensión del archivo
             */
            $res["adjunto_extension_mat"] = $this->getExtFile($adjunto["name"]);
            /**
             * Realizamos la copia del archivo
             */
            $adjunto_local = $dir.$id.".".$res["adjunto_extension_mat"];
            if(copy($adjunto["tmp_name"],$adjunto_local)) $copy = 1;
            else $copy = 0;

            $campo_id="itemId";
            $where = $item_id_name."='".$item_id."'";

            if ($copy==1){
                chmod($adjunto_local,0777);
                $datos = array();
                $datos["adjunto_nombre_mat"]=$adjunto["name"];
                $datos["adjunto_extension_mat"] = $res["adjunto_extension_mat"];
                $datos["adjunto_tamano_mat"]=$adjunto["size"];
                $datos["adjunto_tipo_mat"]=$adjunto["type"];

                $res = $this->item_update_sbm($id,$datos,$tabla,"update",$campo_id,$where);

                if($res["res"]==1){
                    $res["res"] = 1;
                    $res["msg"] = "se adjunto con exito el archivo";
                }else{
                    $res["res"] = 2;
                    $res["msg"] = $res["msgdb"];
                }
            }else{
                $datos = array();
                $datos["adjunto_nombre_mat"] = "";
                $datos["adjunto_extension_mat"] = "";
                $datos["adjunto_tamano_mat"] = "";
                $datos["adjunto_tipo_mat"] = "";

                $res = $this->item_update_sbm($id,$datos,$tabla,"update",$campo_id,$where);

                $res["res"] = 2;
                $res["msg"] = "No se copio el archivo en el servidor.";
            }
        }else{
            $res["res"] = 2;
            $res["msg"] = "No se adjunto ningun archivo, el archivo enviado no cuenta con datos";
        }
        return $res;
    }

    /**
     * Procesa un archivo adjunto de Baja
     */
    function item_adjunto_baja_sbm($adjunto,$item_id,$id,$item,$tabla,$accion="new",$item_id_name="item_id",$carpeta="archivos"){
        $res = array();
        if(isset($adjunto["name"]) && $adjunto["name"]!="" && $adjunto["error"]==0){
            $dir = $this->get_dir_item_archivo_sbm($item_id,1,$carpeta);
            /**
             * Borramos el archivo previamente almacenado
             */
            if($accion=="update"){
                unlink($dir.$id.".".$item["adjunto_extension_baja"]);
            }
            /**
             * Sacamos la extensión del archivo
             */
            $res["adjunto_extension_baja"] = $this->getExtFile($adjunto["name"]);
            /**
             * Realizamos la copia del archivo
             */
            $adjunto_local = $dir.$id.".".$res["adjunto_extension_baja"];
            if(copy($adjunto["tmp_name"],$adjunto_local)) $copy = 1;
            else $copy = 0;

            $campo_id="itemId";
            $where = $item_id_name."='".$item_id."'";

            if ($copy==1){
                chmod($adjunto_local,0777);
                $datos = array();
                $datos["adjunto_nombre_baja"]=$adjunto["name"];
                $datos["adjunto_extension_baja"] = $res["adjunto_extension_baja"];
                $datos["adjunto_tamano_baja"]=$adjunto["size"];
                $datos["adjunto_tipo_baja"]=$adjunto["type"];

                $res = $this->item_update_sbm($id,$datos,$tabla,"update",$campo_id,$where);

                if($res["res"]==1){
                    $res["res"] = 1;
                    $res["msg"] = "se adjunto con exito el archivo";
                }else{
                    $res["res"] = 2;
                    $res["msg"] = $res["msgdb"];
                }
            }else{
                $datos = array();
                $datos["adjunto_nombre_baja"] = "";
                $datos["adjunto_extension_baja"] = "";
                $datos["adjunto_tamano_baja"] = "";
                $datos["adjunto_tipo_baja"] = "";

                $res = $this->item_update_sbm($id,$datos,$tabla,"update",$campo_id,$where);

                $res["res"] = 2;
                $res["msg"] = "No se copio el archivo en el servidor.";
            }
        }else{
            $res["res"] = 2;
            $res["msg"] = "No se adjunto ningun archivo, el archivo enviado no cuenta con datos";
        }
        return $res;
    }

     /**
     * Procesa un archivo adjunto de Alta
     */
    function item_adjunto_alta_sbm($adjunto,$item_id,$id,$item,$tabla,$accion="new",$item_id_name="item_id",$carpeta="archivos"){
        $res = array();
        if(isset($adjunto["name"]) && $adjunto["name"]!="" && $adjunto["error"]==0){
            $dir = $this->get_dir_item_archivo_sbm($item_id,1,$carpeta);
            /**
             * Borramos el archivo previamente almacenado
             */
            if($accion=="update"){
                unlink($dir.$id.".".$item["adjunto_extension_alta"]);
            }
            /**
             * Sacamos la extensión del archivo
             */
            $res["adjunto_extension_alta"] = $this->getExtFile($adjunto["name"]);
            /**
             * Realizamos la copia del archivo
             */
            $adjunto_local = $dir.$id.".".$res["adjunto_extension_alta"];
            if(copy($adjunto["tmp_name"],$adjunto_local)) $copy = 1;
            else $copy = 0;

            $campo_id="itemId";
            $where = $item_id_name."='".$item_id."'";

            if ($copy==1){
                chmod($adjunto_local,0777);
                $datos = array();
                $datos["adjunto_nombre_alta"]=$adjunto["name"];
                $datos["adjunto_extension_alta"] = $res["adjunto_extension_alta"];
                $datos["adjunto_tamano_alta"]=$adjunto["size"];
                $datos["adjunto_tipo_alta"]=$adjunto["type"];

                $res = $this->item_update_sbm($id,$datos,$tabla,"update",$campo_id,$where);

                if($res["res"]==1){
                    $res["res"] = 1;
                    $res["msg"] = "se adjunto con exito el archivo";
                }else{
                    $res["res"] = 2;
                    $res["msg"] = $res["msgdb"];
                }
            }else{
                $datos = array();
                $datos["adjunto_nombre_alta"] = "";
                $datos["adjunto_extension_alta"] = "";
                $datos["adjunto_tamano_alta"] = "";
                $datos["adjunto_tipo_alta"] = "";

                $res = $this->item_update_sbm($id,$datos,$tabla,"update",$campo_id,$where);

                $res["res"] = 2;
                $res["msg"] = "No se copio el archivo en el servidor.";
            }
        }else{
            $res["res"] = 2;
            $res["msg"] = "No se adjunto ningun archivo, el archivo enviado no cuenta con datos";
        }
        return $res;
    }


 /**
     * Procesa un archivo adjunto de Alta de Contrato
     */
    function item_adjunto_contrato_sbm($adjunto,$item_id,$id,$item,$tabla,$accion="new",$item_id_name="item_id",$carpeta="archivos"){
        $res = array();
        if(isset($adjunto["name"]) && $adjunto["name"]!="" && $adjunto["error"]==0){
            $dir = $this->get_dir_item_archivo_sbm($item_id,1,$carpeta);
            /**
             * Borramos el archivo previamente almacenado
             */
            if($accion=="update"){
                unlink($dir.$id.".".$item["adjunto_extension_contrato"]);
            }
            /**
             * Sacamos la extensión del archivo
             */
            $res["adjunto_extension_contrato"] = $this->getExtFile($adjunto["name"]);
            /**
             * Realizamos la copia del archivo
             */
            $adjunto_local = $dir.$id.".".$res["adjunto_extension_contrato"];
            if(copy($adjunto["tmp_name"],$adjunto_local)) $copy = 1;
            else $copy = 0;

            $campo_id="itemId";
            $where = $item_id_name."='".$item_id."'";

            if ($copy==1){
                chmod($adjunto_local,0777);
                $datos = array();
                $datos["adjunto_nombre_contrato"]=$adjunto["name"];
                $datos["adjunto_extension_contrato"] = $res["adjunto_extension_contrato"];
                $datos["adjunto_tamano_contrato"]=$adjunto["size"];
                $datos["adjunto_tipo_contrato"]=$adjunto["type"];

                $res = $this->item_update_sbm($id,$datos,$tabla,"update",$campo_id,$where);

                if($res["res"]==1){
                    $res["res"] = 1;
                    $res["msg"] = "se adjunto con exito el archivo";
                }else{
                    $res["res"] = 2;
                    $res["msg"] = $res["msgdb"];
                }
            }else{
                $datos = array();
                $datos["adjunto_nombre_contrato"] = "";
                $datos["adjunto_extension_contrato"] = "";
                $datos["adjunto_tamano_contrato"] = "";
                $datos["adjunto_tipo_contrato"] = "";

                $res = $this->item_update_sbm($id,$datos,$tabla,"update",$campo_id,$where);

                $res["res"] = 2;
                $res["msg"] = "No se copio el archivo en el servidor.";
            }
        }else{
            $res["res"] = 2;
            $res["msg"] = "No se adjunto ningun archivo, el archivo enviado no cuenta con datos";
        }
        return $res;
    }


    function item_adjunto_tpn_sbm($adjunto,$item_id,$id,$item,$tabla,$accion="new",$item_id_name="item_id",$carpeta="archivos"){
        $res = array();
        if(isset($adjunto["name"]) && $adjunto["name"]!="" && $adjunto["error"]==0){
            $dir = $this->get_dir_item_archivo_sbm($item_id,1,$carpeta);
            /**
             * Borramos el archivo previamente almacenado
             */
            if($accion=="update"){
                unlink($dir.$id.".".$item["adjunto_extension_tpn"]);
            }
            /**
             * Sacamos la extensión del archivo
             */
            $res["adjunto_extension_tpn"] = $this->getExtFile($adjunto["name"]);
            /**
             * Realizamos la copia del archivo
             */
            $adjunto_local = $dir.$id.".".$res["adjunto_extension_tpn"];
            if(copy($adjunto["tmp_name"],$adjunto_local)) $copy = 1;
            else $copy = 0;

            $campo_id="itemId";
            $where = $item_id_name."='".$item_id."'";

            if ($copy==1){
                chmod($adjunto_local,0777);
                $datos = array();
                $datos["adjunto_nombre_tpn"]=$adjunto["name"];
                $datos["adjunto_extension_tpn"] = $res["adjunto_extension_tpn"];
                $datos["adjunto_tamano_tpn"]=$adjunto["size"];
                $datos["adjunto_tipo_tpn"]=$adjunto["type"];

                $res = $this->item_update_sbm($id,$datos,$tabla,"update",$campo_id,$where);

                if($res["res"]==1){
                    $res["res"] = 1;
                    $res["msg"] = "se adjunto con exito el archivo";
                }else{
                    $res["res"] = 2;
                    $res["msg"] = $res["msgdb"];
                }
            }else{
                $datos = array();
                $datos["adjunto_nombre_tpn"] = "";
                $datos["adjunto_extension_tpn"] = "";
                $datos["adjunto_tamano_tpn"] = "";
                $datos["adjunto_tipo_tpn"] = "";

                $res = $this->item_update_sbm($id,$datos,$tabla,"update",$campo_id,$where);

                $res["res"] = 2;
                $res["msg"] = "No se copio el archivo en el servidor.";
            }
        }else{
            $res["res"] = 2;
            $res["msg"] = "No se adjunto ningun archivo, el archivo enviado no cuenta con datos";
        }
        return $res;
    }




    /**
     * guarda los datos de items den un submodulo
     *
     */
    function item_update_sbm($itemId,$rec,$tabla,$accion="new",$campo_id="",$where=""){
        global $privFace;
        if(count($rec)>0){
            if($accion=="update"){
                if($itemId!=''){
                    if($privFace["editar"]){
                        $verifica = $this->item_update_verifica_sbm($tabla,$itemId,$campo_id);
                        if($verifica){
                            $sqlWhere = $campo_id."=".$itemId;
                            if($where!="") $sqlWhere .= " and (".$where.")";

                            $resupdate = $this->dbm->AutoExecute($tabla,$rec,'UPDATE',$sqlWhere);
                            if($resupdate){
                                $res["res"] = 1;
                                $res["id"] = $itemId;
                            }else{
                                $res["res"] = 2;
                                $res["msg"] = "No se logro actualizar la informacion en la B.D.";
                                $res["msgdb"] = $this->dbm->ErrorMsg();
                            }
                        }else{
                            $res["res"] = 2;
                            $res["msg"] = "El registro con ID = '".$itemId."'' que desea actualizar no existe o fue borrado ";
                        }
                    }else{
                        $res["res"] = 2;
                        $res["msg"] = "No tiene los permisos para editar este registro.";
                    }
                }else{
                    $res["res"] = 2;
                    $res["msg"] = "No existe ID del registro que quiere editar.";
                }

            }else if($accion=="new"){
                if($privFace["crear"]){
                    $resupdate = $this->dbm->AutoExecute($tabla,$rec);
                    if($resupdate){
                        $res["res"] = 1;
                        $res["id"] = $this->dbm->Insert_ID();
                    }else{
                        $res["res"] = 2;
                        $res["msg"] = "No se logro actualizar la informacion en la B.D.";
                        $res["msgdb"] = $this->dbm->ErrorMsg();
                    }
                }else{
                    $res["res"] = 2;
                    $res["msg"] = "No tiene permisos para crear nuevo registros";
                }
            }else{
                $res["res"] = 2;
                $res["msg"] = "No envio una acción a realizar";
            }


        }else{
            $res["res"] = 2;
            $res["msg"] = "El arreglo de datos enviado esta vacio: ";
        }
        return $res;
    }

    function item_update_sbm_pg($itemId, $rec, $tabla, $accion="new", $campo_id="", $where="") {
        global $privFace;
        if(count($rec)>0){
            if($accion=="update"){
                if($itemId!=''){
                    if($privFace["editar"]){
                        $verifica = $this->item_update_verifica_sbm($tabla, $itemId, $campo_id);
                        if($verifica){
                            $sqlWhere = $campo_id."=".$itemId;
                            if($where!="") $sqlWhere .= " and (".$where.")";

                            $resupdate = $this->dbm->AutoExecute($tabla, $rec, 'UPDATE', $sqlWhere);
                            if($resupdate){
                                $res["res"] = 1;
                                $res["id"] = $itemId;
                            }else{
                                $res["res"] = 2;
                                $res["msg"] = "No se logro actualizar la informacion en la B.D.";
                                $res["msgdb"] = $this->dbm->ErrorMsg();
                            }
                        }else{
                            $res["res"] = 2;
                            $res["msg"] = "El registro con IDEN = '".$itemId."'' que desea actualizar no existe o fue borrado ";
                        }
                    }else{
                        $res["res"] = 2;
                        $res["msg"] = "No tiene los permisos para editar este registro.";
                    }
                }else{
                    $res["res"] = 2;
                    $res["msg"] = "No existe ID del registro que quiere editar.";
                }
            }else if($accion=="new"){
                if($privFace["crear"]){
                    $resupdate = $this->dbm->AutoExecute($tabla, $rec);
                    if($resupdate){
                        $res["res"] = 1;
                        $res["id"] = $this->dbm->Insert_ID();
                    }else{
                        $res["res"] = 2;
                        $res["msg"] = "No se logro actualizar la informacion en la B.D.";
                        $res["msgdb"] = $this->dbm->ErrorMsg();
                    }
                }else{
                    $res["res"] = 2;
                    $res["msg"] = "No tiene permisos para crear nuevo registros";
                }
            }else{
                $res["res"] = 2;
                $res["msg"] = "No envio una acción a realizar";
            }
        }else{
            $res["res"] = 2;
            $res["msg"] = "El arreglo de datos enviado esta vacio: ";
        }
        return $res;
    }

    function print_json_sbm($result){
        header('Content-Type: application/json');
        header('Access-Control-Allow-Origin: *');
        header('Access-Control-Allow-Methods: GET, PUT, POST, DELETE, OPTIONS');
        header('Access-Control-Allow-Headers: Content-Type, Content-Range, Content-Disposition, Content-Description');

        echo json_encode( $result, JSON_PRETTY_PRINT );
        exit;
    }

    public function pentaho_get_report($reporte_file,$type,$nombre,$parametros_otros=""){

        $parametro = array();
        $parametro["userid"] = $this->pentaho["user"];
        $parametro["password"] = $this->pentaho["password"];

        $parametro["accepted-page"] = "-1";
        $parametro["showParameters"] = "true";
        $parametro["renderMode"] = "REPORT";
        $parametro["htmlProportionalWidth"] = "false";

        switch ($type){
            case 'html':
                $parametro["output-target"] = "table/html;page-mode=stream";
                $content_Type = "text/xml";
                break;
            case 'pdf':
                $parametro["output-target"] = "pageable/pdf";
                $content_Type = "application/pdf";
                break;
            case 'excel':
                $parametro["output-target"] = "table/excel;page-mode=flow";
                $content_Type = "application/vnd.ms-excel";
                break;
            case 'excel20017':
                $parametro["output-target"] = "application/vnd.openxmlformats-officedocument.spreadsheetml.sheet;page-mode=flow";
                $content_Type = "application/vnd.openxmlformats-officedocument.spreadsheetml.sheet";
                break;
            case 'csv':
                $parametro["output-target"] = "table/csv;page-mode=stream";
                $content_Type = "text/csv";
                break;
            case 'rtf':
                $parametro["output-target"] = "table/rtf;page-mode=flow";
                $content_Type = "application/rtf";
                break;
            case 'text':
                $parametro["output-target"] = "pageable/text";
                $content_Type = "text/plain";
                break;
            default:
                echo "<span style='color:red'>[ERROR] - Tiene que seleccionar un formato válido</span>";
                break;
        }

        if(is_array($parametros_otros))  $parametro = array_merge($parametro,$parametros_otros);
        $url = $this->pentaho["url"].$this->pentaho["carpeta"].$reporte_file."/report";
        $response = Unirest\Request::get($url, null, $parametro);
        /*
        $response->code;        // HTTP Status code
        $response->headers;     // Headers
        $response->body;        // Parsed body
        $response->raw_body;    // Unparsed body
        */
        /*
        if($type=="csv"){
            $response->raw_body = utf8_decode($response->raw_body);
        }
        */
        if($response->code==200){
            $content_Type = $response->headers["Content-Type"];

            $extension = strrev($response->headers["content-disposition"]);
            $extension = explode(".",$extension);
            $extension = strrev($extension[0]);
            $nombre_archivo = date("Ymd-H_m_s")."-".$nombre.".".$extension;

            header('Set-Cookie: fileDownload=true; path=/');
            header ("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
            header ("Last-Modified: " . gmdate("D,d M YH:i:s") . " GMT");
            header ("Cache-Control: no-cache, must-revalidate");
            header ("Pragma: no-cache");
            header ("Content-Type:".$content_Type);
            header ('Content-Disposition: attachment; filename="'.$nombre_archivo.'"');
            echo $response->raw_body;
        }else{
            echo "<span style='color:red'>[ERROR] - Tiene que seleccionar un formato válido</span>";
        }
        exit;

    }

    /**
     * Le damos formato al arreglo de grilla para mandar a generar el json
     */
    public function get_grilla_tranformar_arreglo_sbm_complex($campos){
        $col = array();
        for($i=0 ; $i<count($campos);$i++){
            if($campos[$i]["activo"]){
                $field = $campos[$i]["campo"];
                $col_extra = $campos[$i];
                if(trim($campos[$i]["tabla_alias"])==""){
                    if (trim($campos[$i]["funcion"])=="on"){
                        $col_extra["db"] = trim($campos[$i]["tipo_funcion"]).'(`i`.`'.$field.'`'.trim($campos[$i]["otro_parametro"]).')';
                    }elseif(trim($campos[$i]["funcion"])=="extra") {
                        $col_extra["db"] = trim($campos[$i]["query"]);
                    }else {
                        $col_extra["db"] = '`i`.`' . $field . '`';
                    }
                }else{
                    if (trim($campos[$i]["funcion"])=="on"){
                        $col_extra["db"] = trim($campos[$i]["tipo_funcion"]).'(`'.trim($campos[$i]["tabla_alias"]).'`.`'.$field.'`'.trim($campos[$i]["otro_parametro"]).')';
                    }elseif(trim($campos[$i]["funcion"])=="extra") {
                        $col_extra["db"] = trim($campos[$i]["query"]);
                    }else {
                        $col_extra["db"] = '`'.trim($campos[$i]["tabla_alias"]).'`.`'.$field.'`';
                    }
                }
                if(isset($campos[$i]["as"])){
                    $col_extra["dt"] = $campos[$i]["as"];
                }else{
                    $col_extra["dt"] = $campos[$i]["field"];
                }

                if($campos[$i]["as"]==""){
                    unset($col_extra["as"]);
                }
                $col[]= $col_extra;
            }
        }
        return $col;
    }


    public function get_grilla_datatable_complex( $db, $grilla, $table, $primaryKey, $extraWhere, $groupBy, $having, $join_extra="", $position="left"){
        /**
         * Recojemos todos los campos que mostraremos en la lista
         * y le damos formato de un arreglo para generar el json para datatable
         */
        $campos = $this->get_grilla_list_sbm($grilla,$position,$primaryKey);

        $col = $this->get_grilla_tranformar_arreglo_sbm_complex($campos);
        //print_struc($col);exit;

        $tablas_adicionales = $this->grilla_tablas_adicionales["$grilla"];
        //print_struc($tablas_adicionales);


        $joinQuery = "FROM ".$table." AS `i` ";

        if(count($tablas_adicionales)>0){
            foreach ($tablas_adicionales as $row){
                if($row["activo"]){
                    if ($row["position"] != ""){
                        $position = $row["position"];
                    } else{
                        $position="left";
                    }
                    $joinQuery .=  $position." join ".$row["tabla"]." as `".$row["alias"]."` ";
                    $joinQuery .= " on  (`".$row["alias"]."`.`".$row["campo_id"]."` = `i`.`".$row["relacion_id"]."`) ";
                }

            }
        }
        $joinQuery = $joinQuery.$join_extra;

        $sql_details = array(
            'user' => $db["user"],
            'pass' => $db["password"],
            'db'   => $db["database"],
            'host' => $db["server"]
        );

        $resultado = SSP::simple( $_REQUEST, $sql_details, $table, $primaryKey, $col, $joinQuery, $extraWhere, $groupBy, $having );
        return $resultado;
    }

    /**
     * Procesa un archivo adjunto
     */
    function item_adjunto_sbm_externo($adjunto,$item_id,$id,$item,$tabla,$accion="new",$campo_id,$item_id_name="item_id",$carpeta="archivos"){
        $res = array();
        if(isset($adjunto["name"]) && $adjunto["name"]!="" && $adjunto["error"]==0){
            $dir = $this->get_dir_item_archivo_sbm($item_id,1,$carpeta);
            /**
             * Borramos el archivo previamente almacenado
             */
            if($accion=="update"){
                unlink($dir.$id.".".$item["adjunto_extension"]);
            }
            /**
             * Sacamos la extensión del archivo
             */
            $res["adjunto_extension"] = $this->getExtFile($adjunto["name"]);
            /**
             * Realizamos la copia del archivo
             */
            $adjunto_local = $dir.$id.".".$res["adjunto_extension"];
            if(copy($adjunto["tmp_name"],$adjunto_local)) $copy = 1;
            else $copy = 0;

            $where = $item_id_name."='".$item_id."'";

            if ($copy==1){
                chmod($adjunto_local,0777);
                $datos = array();
                $datos["adjunto_nombre"]=$adjunto["name"];
                $datos["adjunto_extension"] = $res["adjunto_extension"];
                $datos["adjunto_tamano"]=$adjunto["size"];
                $datos["adjunto_tipo"]=$adjunto["type"];

                $res = $this->item_update_sbm($id,$datos,$tabla,"update",$campo_id,$where);

                if($res["res"]==1){
                    $res["res"] = 1;
                    $res["msg"] = "se adjunto con exito el archivo";
                }else{
                    $res["res"] = 2;
                    $res["msg"] = $res["msgdb"];
                }
            }else{
                $datos = array();
                $datos["adjunto_nombre"] = "";
                $datos["adjunto_extension"] = "";
                $datos["adjunto_tamano"] = "";
                $datos["adjunto_tipo"] = "";

                $res = $this->item_update_sbm($id,$datos,$tabla,"update",$campo_id,$where);

                $res["res"] = 2;
                $res["msg"] = "No se copio el archivo en el servidor.";
            }
        }else{
            $res["res"] = 2;
            $res["msg"] = "No se adjunto ningun archivo, el archivo enviado no cuenta con datos";
        }
        return $res;
    }

    /**
     * Metos para el uso y manejo de archivos excel en todos los módulos
     * -----------------------------------------------------------------------------------------------------------------
     */
    public function sbm_exel_init_lee($archivo){
        // Para excel 97
        //$reader = new \PhpOffice\PhpSpreadsheet\Reader\Xls();
        // Ultima versión de Excel
        $objReader = new \PhpOffice\PhpSpreadsheet\Reader\Xlsx();
        // Cargamos el archivo excel en un objeto
        $this->objExcel = $objReader->load($archivo);
    }
    public function sbm_excel_write_excel($nameFile){
        /**
         * Guardamos el archivo en formato EXCEL
         */
        $nameFile = $nameFile.".xlsx";

        header("Content-Type: text/html;charset=utf-8");
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="'.$nameFile.'"');
        header('Cache-Control: max-age=0');
        $objWriter = \PhpOffice\PhpSpreadsheet\IOFactory::createWriter($this->objExcel, 'Xlsx');
        $objWriter->save('php://output');
        exit;
    }
    public function sbm_excel_style_data($celdas){
        $styleArray = [
            'alignment' => [
                'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_TOP,
            ],
            'borders' => [
                'allBorders' => [
                    'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                ],
            ],
            /*
            'fill' => [
                'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
                'color'    => ['argb' => 'FFe7c16a'],
            ],
            */
        ];

        $this->objExcel->getActiveSheet()->getStyle($celdas)->applyFromArray($styleArray);
    }
    public function sbm_excel_get_style_cel(){
        $styleArray = [
            'alignment' => [
                'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_TOP,
            ],
            'borders' => [
                'allBorders' => [
                    'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                ],
            ],
            'fill' => [
                'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
                'color'    => ['argb' => 'FFe7c16a'],
            ],
        ];
        return $styleArray;
    }
    /**
     * Inicializamos un arreglo de columnas para crear nuestro Excel
     */
    public function sbm_excel_get_col(){

        $cols = array();
        for ($i=65;$i<=90;$i++) {
            $cols[] = chr($i);
        }
        for ($i=65;$i<=90;$i++) {
            $cols[] = "A".chr($i);
        }
        for ($i=65;$i<=90;$i++) {
            $cols[] = "B".chr($i);
        }        for ($i=65;$i<=90;$i++) {
            $cols[] = "C".chr($i);
        }        for ($i=65;$i<=90;$i++) {
            $cols[] = "D".chr($i);
        }        for ($i=65;$i<=90;$i++) {
            $cols[] = "E".chr($i);
        }        for ($i=65;$i<=90;$i++) {
            $cols[] = "F".chr($i);
        }        for ($i=65;$i<=90;$i++) {
            $cols[] = "G".chr($i);
        }        for ($i=65;$i<=90;$i++) {
            $cols[] = "H".chr($i);
        }        for ($i=65;$i<=90;$i++) {
            $cols[] = "I".chr($i);
        }        for ($i=65;$i<=90;$i++) {
            $cols[] = "J".chr($i);
        }        for ($i=65;$i<=90;$i++) {
            $cols[] = "K".chr($i);
        }        for ($i=65;$i<=90;$i++) {
            $cols[] = "L".chr($i);
        }        for ($i=65;$i<=90;$i++) {
            $cols[] = "M".chr($i);
        }        for ($i=65;$i<=90;$i++) {
            $cols[] = "N".chr($i);
        }       for ($i=65;$i<=90;$i++) {
            $cols[] = "O".chr($i);
        }        for ($i=65;$i<=90;$i++) {
            $cols[] = "P".chr($i);
        }        for ($i=65;$i<=90;$i++) {
            $cols[] = "Q".chr($i);
        }        for ($i=65;$i<=90;$i++) {
            $cols[] = "R".chr($i);
        }
        //print_struc($cols);exit();
        return $cols;
    }
    //birt
    public function birt_get_report($reporte_file,$type,$nombre,$parametros_otros, $dev = false){
        $parametro = array();

        switch ($type){
            case 'pdf':
                $content_Type = "application/pdf";
                $paramValue = "pdf";
                break;
            case 'excel':
                $content_Type = "application/vnd.ms-excel";
                $paramValue = "xls";
                break;
            case 'excel2017':
                $content_Type = "application/vnd.openxmlformats-officedocument.spreadsheetml.sheet";
                $paramValue = "xlsx";
                break;

            default:
                echo "<span style='color:red'>[ERROR] - Tiene que seleccionar un formato válido</span>";
                break;
        }

    
        global $CFG; // variable global info URL
        // * Todas las variables para configurar en el reporte
        if ($dev) {
            $url=$CFG->servicio_reporte["url_reporte_dev"];
        }else{
            $url=$CFG->servicio_reporte["url_reporte"];
        }
       // $paramValue = "pdf";

        // * Concatenacion para apuntar a la URL de BIRT
        $dest = $url;
        $dest .= urlencode( $reporte_file );
        $dest .= "&__format=" . urlencode( $paramValue );
        $dest .= ( $parametros_otros );
      
        $response = Unirest\Request::get($dest, null, null);
    
        $titulo = $nombre .".". $paramValue;
    
        if($response->code==200){
            $content_Type = $response->headers["Content-Type"];
            //  $nombre_archivo = date("Ymd-H_m_s")."-".$nombre.".".$extension;
            header('Set-Cookie: fileDownload=true; path=/');
            //header ("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
            header ("Last-Modified: " . gmdate("D,d M YH:i:s") . " GMT");
            header ("Cache-Control: no-cache, must-revalidate");
            header ("Pragma: no-cache");
            header ("Content-Transfer-Encoding: binary");
            header ("Expires: 0");
            header ("Content-Type:".$content_Type);
            header ('Content-Disposition: attachment; filename="'.$titulo.'"');
            echo $response->raw_body;
        }else{
            echo "<span style='color:red'>[ERROR] - Tiene que seleccionar un formato válido</span>";
        }
        exit;

    }

    public function getDatosUsuarioSigir() {     
        $usuario = $_SESSION['userv']['itemId'];
        $this->dbm->SetFetchMode(ADODB_FETCH_ASSOC);

        $datos = [
            'tipo_usuario' => 'Ninguno',
            'departamentos' => '0',
            'municipios' => '0'
        ];

        // Verificamos si es administrador del SIARH y lo igualamos a administrador del SIGIR
        if ($_SESSION['userv']['tipoUsuario'] == 1) {
            $tipoUsuario = 'Administrador';
        }else{
            $sql = 'select tipo_usuario from mmaya_sigir.tipo_usuario tu where tu.item_id = ' . $usuario . " limit 1";
            $info = $this->dbm->Execute($sql);
            $item = $info->GetRows();
    
            if (count($item) == 0 or count($item) > 1) {
                return $datos;
            }
            
            $tipoUsuario = $item[0]['tipo_usuario'];
            $datos['tipo_usuario']  = $item[0]['tipo_usuario'];
        }

        switch ($tipoUsuario) {
            case 'Operador GAM':
                $sql = 'select * from mmaya_sigir.permiso_gam pg where pg.id_usuario = ' . $usuario;
                $info = $this->dbm->getAll($sql);
                if(count($info) > 0) {
                    foreach ($info as $data){
                        $arr[] += $data['id_municipio'];
                    }
                    $datos['municipios'] = implode(",", $arr);
                }
                break;
            case 'Operador GAD':
                /* ------------------------------ Departamentos ----------------------------- */
                $sql = 'select * from mmaya_sigir.permiso_gad pg where pg.id_usuario = ' . $usuario;
                $info = $this->dbm->getAll($sql);
                if(count($info) > 0) {
                    foreach ($info as $data){
                        $arr[] += $data['id_departamento'];
                    }
                    $datos['departamentos'] = implode(",", $arr);
                }
                
                /* ------------------------------- Municipios ------------------------------- */
                $sql = 'select * from mmaya_sigir.gam_item a where a.departamento_id in (' . $datos['departamentos'] . ')';
                $info = $this->dbm->getAll($sql);
                if(count($info) > 0) {
                    foreach ($info as $data){
                        $arr[] += $data['municipio_id'];
                    }
                    $datos['municipios'] = implode(",", $arr);
                }

                break;
            case 'Administrador':
                /* ------------------------------ Departamentos ----------------------------- */
                $sql = 'select * from mmaya_sigir.gad_item';
                $info = $this->dbm->getAll($sql);
                if(count($info) > 0) {
                    foreach ($info as $data){
                        $arr[] += $data['departamento_id'];
                    }
                    $datos['departamentos'] = implode(",", $arr);
                }
                
                /* ------------------------------- Municipios ------------------------------- */
                $sql = 'select * from mmaya_sigir.gam_item';
                $info = $this->dbm->getAll($sql);
                if(count($info) > 0) {
                    foreach ($info as $data){
                        $arr[] += $data['municipio_id'];
                    }
                    $datos['municipios'] = implode(",", $arr);
                }
                // $datos['departamentos'] = '';
                // $datos['municipios'] = '';
                break;
        }

        return $datos;       
    }
    function verificar_permiso_usuario($rol_Id){
        try{
            $sql = "select usuario.itemId from usuario where usuario.itemId=".$_SESSION["memberId"]." and usuario.rol_itemId=".$rol_Id;
            $resultado = $this->dbm->Execute($sql);
            $resultado = $resultado->GetRows();
            if(count($resultado)==0){
                return false;
            }else{
                return true;
            }
        }
        catch(Exception $e){
            return false;
        }
    }
    function verificarTiempoResolucion($tipo){
        try{
            $sql = "select gestion.itemId from gestion where ";
            switch($tipo){
                case 1:
                    $sql.="gestion.ini_rueda_negocios <= '".date("Y:m:d")."' and gestion.fin_rueda_negocios >= '".date("Y:m:d")."'";
                    break;
                case 2:
                    $sql.="gestion.ini_caza <= '".date("Y:m:d")."' and gestion.fin_caza >= '".date("Y:m:d")."'";
                    break;
                case 3:
                    $sql.="gestion.ini_movilizacion <= '".date("Y:m:d")."' and gestion.fin_movilizacion >= '".date("Y:m:d")."'";
                    break;
            }
            $resultado = $this->dbm->Execute($sql);
            $resultado = $resultado->GetRows();
            if(count($resultado)==0){
                return false;
            }else{
                return true;
            }
        }
        catch(Exception $e){
            return false;
        }
    }
    function verificar_permiso_usuarios($rol_Ids){
        if(count($rol_Ids>0)){
            try{
                $sql = "select usuario.itemId from vrhr_snir.core_usuario usuario
                INNER JOIN mmaya_biodiversidad_trazabilidad.usuario_rol ur
                on ur.usuario_itemId=usuario.itemId
                where usuario.itemId=".$_SESSION["memberId"]." 
                and (";
                for($i =0;$i<count($rol_Ids)-1;$i++){
                    $sql.=" ur.rol_itemId=".$rol_Ids[$i]." or ";
                }            
                $sql.=" ur.rol_itemId=".$rol_Ids[count($rol_Ids)-1].");";
                $resultado = $this->dbm->Execute($sql);
                $resultado = $resultado->GetRows();
                if(count($resultado)==0){
                    return false;
                }else{
                    return true;
                }
            }
            catch(Exception $e){
                return false;
            }
        }
        else{
            return false;
        }
    }
    function get_menu_table_lagartos($tabla){
        return "mmaya_biodiversidad_trazabilidad.".$tabla;
    }
    function get_menu_principal(){
        
        global $db, $usuarioInfo;
        $sql = "select c.itemId,c.nombre, c2.nombre as padre_nombre,c.padre ,c.class
        from  ".$this->get_menu_table_lagartos("catalogo")." as c left join ".$this->get_menu_table_lagartos("catalogo")." as c2 on c2.itemId = c.padre 
        where c.estado=1 and c.padre is not NULL order by c2.orden, c.orden";
        $item = $db->Execute($sql);
        
        $item = $item->getRows();
        //print_struc($item);
        //echo count($item);
        $menu = array();
        for ($i=0;$i<count($item);$i++){

            //echo "-->i:".$i."<br>";
            $sql2 = "select 
            sub.carpeta as submodulo
            , mo.carpeta as modulo
            , m.*
            from ".$this->get_menu_table_lagartos("menu")." as m 
            left join ".$this->get_menu_table_lagartos("submodulo")." as sub on m.submodulo_itemId = sub.itemId
            left join ".$this->get_menu_table_lagartos("catalogo_rol")." as r on r.itemId=m.rol_itemId
            left join ".$this->get_menu_table_lagartos("usuario_rol")." as ur on ur.rol_itemId=r.itemId
            left join vrhr_snir.core_usuario as u on ur.usuario_itemId=u.itemId
            left join vrhr_snir.core_modulo as mo on m.modulo_id=mo.itemId
            WHERE m.catalogo_itemId='".$item[$i]["itemId"]."' 
            and u.itemId='".$_SESSION["memberId"] ."'
            and m.estado=1
            order by m.orden
            ";
            $submenu = $db->Execute($sql2);
            $submenu = $submenu->getRows();


            //echo "------------->$i ".count($submenu)."<br>\r\n";

            if(count($submenu)>0){
                //print_struc($submenu);
                $item[$i]["submenu"] = $submenu;
                $menu[] = $item[$i];
            }
        }
        //exit;
        //print_struc($item);exit;



        return $menu;

    }
    function get_submodulo_select($sub){
        global $db;
        $sql = "SELECT m.*,ca.padre,sub.carpeta
            FROM ".$this->get_menu_table_lagartos("menu")." as m 
            LEFT JOIN  ".$this->get_menu_table_lagartos("submodulo")." as sub on m.submodulo_itemId = sub.itemId
            LEFT JOIN  ".$this->get_menu_table_lagartos("catalogo")." as ca on m.catalogo_itemId=ca.itemId
            WHERE sub.carpeta='".$sub."' 
            and m.estado=1
            LIMIT 1
            ";
            $submodulo = $db->Execute($sql);
            $submodulo= $submodulo->fields;

        return $submodulo;    
    }
    function obtener_permiso_usuarios(){
        global $db;
            try{
                $sql = "select usuario.itemId,ur.rol_itemId,usuario.* from vrhr_snir.core_usuario usuario
                INNER JOIN mmaya_biodiversidad_trazabilidad.usuario_rol ur
                on ur.usuario_itemId=usuario.itemId
                where usuario.itemId='".$_SESSION["memberId"]."'";
                
                $permisos= $db->Execute($sql);
                $permisos= $permisos->fields;
                return $permisos;
            }
            catch(Exception $e){
                return false;
            }
    }
    function item_soft_delete_sbm($itemId,$campo_id,$tabla,$where=""){
        global $privFace;


        if($privFace["editar"] and $privFace["eliminar"]){
            if($itemId!=''){
                if($campo_id!=""){
                    $verifica = $this->item_update_verifica_sbm($tabla,$itemId,$campo_id);
                }else{
                    $verifica = true;
                }
                if($verifica) {
                    $sql = "UPDATE ".$tabla." SET estado=0";
                    $sqlWhere = "  WHERE ".$campo_id."=".$itemId;

                    if($where!="" && $campo_id !=""){
                        $sql .= $sqlWhere." and (".$where.")";
                    }elseif($where!="" && $campo_id ==""){
                        $sql .= $where;
                    }else{
                        $sql .= $sqlWhere;
                    }
                    if($where!="") $sql .= " and (".$where.")";
                    $resdelete = $this->dbm->Execute($sql);
                    if($resdelete){
                        $res["res"] = 1;
                        $res["id"] = $itemId;
                    }else{
                        $res["res"] = 2;
                        $res["msg"] = "No se logro eliminar el registro de la B.D.";
                        $res["msgdb"] = $this->dbm->ErrorMsg();
                    }

                }else{
                    $res["res"] = 2;
                    $res["msg"] = "El registro con ID = '".$itemId."'' que desea actualizar no existe o fue eliminado ";
                }
            }else{
                $res["res"] = 2;
                $res["msg"] = "El id del registro que quiere eliminar esta vacio";
            }
        }else{
            $res["res"] = 2;
            $res["msg"] = "No tiene permisos para eliminar este registro";
        }
        return $res;
    }

    function obtener_cuenca_servicio($latitud, $longitud){
        $fields = array(
            'latitud' => $latitud,
            'longitud' => $longitud
        );
        $fields_string = http_build_query($fields);
        $url_api=$CFG->servicio_reporte["url_api_test"];
        $url = "https://konga.mmaya.gob.bo:8443/test/funciones/v1/ubicacion-punto"; //token
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $fields_string);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        $headers = [
            'Accept: application/json',
            'Content-Type: application/x-www-form-urlencoded',
            'Authorization: Bearer eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCIsImlzcyI6Iml1ZjlYZURibjloamRWUHlYVmtIQXBhYUJLbGpnSHIwIn0.eyJzdWIiOiIxMjM0NTY3ODkwIiwibmFtZSI6IkpvaG4gRG9lIiwiaWF0IjoxNTE2MjM5MDIyfQ.0tP83tai3YKEocYHowjY5tGl_K60waaNt9YAmZNowxI'
        ];
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        $data = curl_exec($ch);
        curl_close($ch);

        if(strlen($data) > 10) {
            $data = json_decode($data, true);
            $cuencaId = $data['cuencaId'];
        }else{
            $cuencaId = 0;
        }

        return $cuencaId;
    }
}
