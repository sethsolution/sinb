<?PHP
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

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

    var $telegram;

	var $directory;

	var $core;
	var $obj_datatable;
    /**
     * variables de submodulos
     */
    public $dbm;
    public $userId;
    public $usuario_id;
    public $empresa_id;
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


    


    
    function convertirFormatoDecimal($rec){
        global $dbsig,$CFGm;
       $res = ereg_replace("[.]", "", $rec);
       $res = ereg_replace("[,]", ".", $res);
       
        return $res;
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

            if($row["noutf8"]==1){
                $dato_aux = utf8_encode($dato[$row["dato"]]);
            }else{
                $dato_aux = $dato[$row["dato"]];
            }
            //$opt[$dato[$row["dato"]]] = $this->getCatalogListSimple($con);
            $opt[$dato_aux] = $this->getCatalogListSimple($con);

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
        
        $myHome->setLongLat($auxLongD,$auxLatD);
        $myHome->convertLLtoTM();
        $res['utmNorthing'] = (int)$myHome->N();
        
        $res['utmEasting'] = (int)$myHome->E();
        
        $res['utmZone'] = $myHome->Z();
        
        return $res;
    }

    function getLatData($datum,$utmzona, $latUtm, $longUtm){
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
        $this->userId = $_SESSION["userv"]["itemId"];
        $this->usuario_id = $_SESSION["userv"]["itemId"];
        $this->empresa_id = $_SESSION["empresa"]["itemId"];
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

        $this->telegram = $CFGm->telegram;
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

            "field"=> $id_name
        ,   "label"=> "Accion"
        ,   "type_field"=>"text"
        ,   "as" => "Actions"
        ,   "activo" => 1
        ,   "responsive" => true
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
                $field = $campos[$i]["field"];
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
                        //if($resultado[$clave]=="--") unset($resultado[$clave]);
                        if($resultado[$clave]=="--") $resultado[$clave]='null';
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


    function item_update_verifica_sbm($tabla,$itemId,$campo_id, $where=''){
        $sql = "select ".$campo_id." from ".$tabla." where ".$campo_id."=".$itemId;
        if(trim($where) != "")  $sql .= " and (".$where.")";
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


        if($privFace["eliminar"]){
            if($itemId!=''){
                if($campo_id!=""){
                    $verifica = $this->item_update_verifica_sbm($tabla,$itemId,$campo_id,$where);
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
                    }elseif($where=="" && $campo_id !=""){
                        $sql .= $sqlWhere;
                    }else{
                        $sql .= "itemId=".$itemId;
                    }

                   //if($where!="") $sql .= " and (".$where.")";
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
                    $res["msg"] = "El registro con ID = '".$itemId."'' que desea eliminar no existe ";
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

    function item_delete_archivo_item_sbm($id,$item_id,$item,$carpeta="archivos"){
        $dir = $this->get_dir_item_archivo_sbm($item_id,0,$carpeta);
        $file = $dir.$id.".".$item["adjunto_extension"];
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




    public function telegram_sendmsg($text,$data="")
    {
        global $CFG,$core;

        if(is_array($data)){

            $string_log = "";

            foreach($data as $key => $row){
                $string_log .= $key." : ".$row." |";
            }
            $string_log .= "\r\n";
            $text .= ",  <b>[Datos]</b> ".$string_log;

        }

        if($CFG->telegram["activo"]){
            $response = $core->telegram_sendMessage($this->telegram["chat_id"],$text,$this->telegram["parse_mode"]);
        }
        //return $response;
    }


    public function get_config_core(){
        global $db;
        $sql =  "SELECT * FROM ".$this->tabla_core["config"]." WHERE activo =1 LIMIT 1";
        $info = $db->execute($sql);
        $item = $info->fields;
        return $item;

    }
    public function send_email_system($to,$asunto,$base=""){
        global $subcontrol,$path_sbm,$pathmodule,$smarty_template,$smarty,$frontend,$CFGm,$CFG;
        /**
         * Configuración de template para sacar datos de los tpl para enviar el correo
         */
        $smarty_template = array();
        $smarty_template[] = "./module/core/template/email_core/";
        $smarty_template[] = $path_sbm."snippet/".$subcontrol."/view/";
        $smarty_template[] = $pathmodule."template/frontend/";
        $smarty->setTemplateDir($smarty_template);

        if($base=""){
            $base = $frontend["email_base"];
        }

        /**
         * Sacamos los datos de configuración
         */
        $conf = $this->get_config_core();

        /**
         * Variable dominio en la url
         */

        if($conf["dominio_ssl"]==0){
            $dominio = "http://";
        }else{
            $dominio = "http://";
        }
        $dominio .=  $conf["dominio"];
        $smarty->assign("url_dominio",$dominio);
        $smarty->assign("dominio",$conf["dominio"]);

        $cuerpo = $smarty->fetch($frontend["email_base"]);
        //echo $cuerpo;exit;

        $mail = new PHPMailer(true);
        try {
            //Server settings
            //$mail->SMTPDebug = SMTP::DEBUG_SERVER;                      // Enable verbose debug output
            $mail->isSMTP();                                            // Send using SMTP
            $mail->Host       = $conf["smtp_server"];                    // Set the SMTP server to send through
            $mail->SMTPAuth   = $conf["stmp_auth"];                                   // Enable SMTP authentication
            $mail->Username   = $conf["smtp_user"];                          // SMTP username
            $mail->Password   = $conf["smtp_password"];                                   // SMTP password
            $mail->SMTPSecure = 'tls';         // Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` encouraged
            $mail->Port       = $conf["smtp_port"];                          // TCP port to connect to, use 465 for `PHPMailer::ENCRYPTION_SMTPS` above

            //Recipients
            $mail->setFrom($conf["email_from"], $conf["email_from_nombre"]);
            //$mail->AddReplyTo($CFGm->phpmailer["De"], $CFGm->phpmailer["Nombre"]);
            $mail->addAddress($to["email"], $to["name"]);     // Add a recipient

            //print_struc($mail);exit;
            // Content
            $mail->isHTML(true);                                  // Set email format to HTML
            //$asunto = htmlentities($asunto,ENT_QUOTES,"UTF-8");
            //$asunto = utf8_encode($asunto);
            $asunto = utf8_decode($asunto);
            $mail->Subject = $asunto;
            $mail->Body    = $cuerpo;
            $mail->AltBody = $cuerpo;

            $archivos = "./images/email/";
            $mail->AddEmbeddedImage($archivos.'email_logo.png','mmayaLogo','email_logo.png');

            $mail->send();
            $res["res"] = 1;
            $res["msgdb"] = "Mensaje fue enviado correctamente";
        } catch (Exception $e) {
            $res["res"] = 2;
            $res["msgdb"] = "No se pudo enviar el correo electrónico {$mail->ErrorInfo}";
        }

        //exit;
        return $res;
    }

    function get_ramdom_string($length = 10) {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }

}