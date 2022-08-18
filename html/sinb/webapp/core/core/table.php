<?PHP
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

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
    public $table;
    public $table_core;
    public $pentaho;
    var $image;

    function changeDataFormat($data,$format="d/m/Y"){
        if(trim($data)!="")
            $data = date_format(date_create($data),$format);
        return $data;
    }

    public function getMultiSelectionData($table,$relationshipField,$relationshipId,$fieldDataName){
        $sql = "SELECT * FROM ".$table." AS mt WHERE mt.".$relationshipField." = ".$relationshipId;
        $item = $this->dbm->Execute($sql);
        $item = $item->getRows();
        $res = array();
        foreach ($item as $row){
            $res[]=$row[$fieldDataName];
        }
        return $res;
    }

    public function saveMultiSelectionData($table,$relationshipField,$relationshipId,$fieldDataName,$data){
        $multiData = implode(",",$data);
        /**
         * borramos la data que no se encuentra en selección
         */
        if ($multiData ==""){
            $sql = "delete from ".$table." where ".$relationshipField."=".$relationshipId;
        }else{
            $sql = "delete from ".$table." where ".$relationshipField."=".$relationshipId." and ".$fieldDataName." NOT IN (".$multiData.")";
        }
        $this->dbm->Execute($sql);
        /**
         * Sacamos los Id que todavia quedan en la base de datos
         */
        $sql = "Select ".$fieldDataName." from ".$table." where ".$relationshipField."=".$relationshipId;
        $item = $this->dbm->Execute($sql);
        $item = $item->getRows();
        $data2 = array();
        foreach ($item as $row){
            $data2[] = $row[$fieldDataName];
        }
        /**
         * Comparamos los dos arreglos y  el resultado es el que guardaremos en la base de datos
         */
        $resultado = array_diff($data, $data2);
        foreach ($resultado as $row){
            $dato = array();
            $dato[$relationshipField] = $relationshipId;
            $dato[$fieldDataName] = $row;
            $dato["created_at"] = date("Y-m-d H:i:s");
            $dato["updated_at"] = date("Y-m-d H:i:s");
            $dato["user_create"] = $this->userId;
            $dato["user_update"] = $this->userId;

            $this->dbm->AutoExecute($table,$dato);
        }
        $res["res"] = 1;
        return $res;
    }

    function setGeomPointPostgis($long,$lat,$table,$fieldGeom,$fieldId,$id){
        $lat = trim($lat);
        $long = trim($long);

        if($lat!="" and $long!=""){
            $geom = "'SRID=4326;POINT(".$long." ".$lat.")'";
            $sql = "update ".$this->table[$table]." set \"".$fieldGeom."\" = ".$geom." where \"".$fieldId."\"=".$id;
            $res = $this->dbm->Execute($sql);

            if($res){
                $request["res"] = 1;
            }else{
                $request["res"] = 2;
                $request["msg"] = "problem saving geographic data";
                $request["msgdb"] = $this->dbm->ErrorMsg();
            }
        }else{
            $request["res"] = 2;
            $request["msg"] = "No data";
        }
        return $request;
    }



    function getCatalogList(){
        $res = array();
        foreach($this->catalogList as $row){
            if($row["parent"]==0){
                $res[$row["name"]] = $this->getCatalogListSimple($row);
            }else{
                $res[$row["name"]] = $this->getCatalogListGroup($row);
            }
        }
        return $res;
    }
    
    function getCatalogListSimple($row){

        $this->dbm->SetFetchMode(ADODB_FETCH_ASSOC);
        $sql = "select " . $row["id"] . "," . $row["data"] . " from " . $row["table"] . " ";
        if ($row["where"] != "") {
            $sql .= " where " . $row["where"] . " ";
        }
        $sql .= " ORDER BY " . $row["order"] . " " . $row["dirOrder"];

        $info = $this->dbm->Execute($sql);
        $item = $info->GetRows();

        if ($row["concatenated"]) {
            $dato = trim($row["data_name"]);
        } else {
            $dato = $row["data"];
        }
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
    function addCatalogList($table,$name="",$id="",$dataaux="",$noutf8=0,$order="",$where="",$parent="",$concatena=0,$dataName="name"){
        
        $dato = array();
        $dato["table"] = $table;
        $dato["name"] = (trim($name)=="")?$table:trim($name);
        $dato["id"] = (trim($id)=="")?"id":trim($id);
        $dato["data"] = (trim($dataaux)=="")?"name":trim($dataaux);
        $dato["noutf8"] = (trim($noutf8)=="")?0:trim($noutf8);
        $ordenAux = explode("|",$order);
        //$dato["orden"] = (trim($orden)=="")?"nombre":trim($orden);
        if($concatena){
            $dato["order"] = (trim($ordenAux[0])=="")?"name":trim($ordenAux[0]);
        }else{
            $dato["order"] = (trim($ordenAux[0])=="")?$dato["data"]:trim($ordenAux[0]);
        }
        $dato["dirOrder"] = (!isset($ordenAux[1]) || trim($ordenAux[1])=="")?"ASC":trim($ordenAux[1]);
        $dato["where"] = (trim($where)=="")?"":trim($where);
        $dato["parent"] = (trim($parent)=="")?0:trim($parent);
        $dato["concatenated"] = (trim($concatena)=="")?0:trim($concatena);
        $dato["data_name"] = (trim($dataName)=="")?"name":trim($dataName);
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

    /**
     * Todas las herramientas para un submodulo
     * -----------------------------------------------------------------------------------------------------------------
     */
    function submodule_init_sbm()
    {
        global $CFGm,$CFG, $dbm,$privFace,$privSM,$core,$grid,$grid_table_join,$tabs,$fields;
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
        $this->table = $appVars["table"] ;
        $this->table_core = $CFG->table;
        /**
         * Datos del usuario en session
         */
        $this->userv = $_SESSION["userv"];
        $this->userId = $_SESSION["userv"]["id"];
        $this->usuario_id = $_SESSION["userv"]["id"];
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
        $this->grilla = $grid;
        $this->grilla_tablas_adicionales = $grid_table_join;
        /**
         * Configuración de los tabs
         */
        $this->tabs = $tabs;
        /**
         * Configuración de los tabs
         */
        $this->campos = $fields;

        $this->telegram = $CFGm->telegram;
    }
    /**
     * Funcionalidad para generar los tabs de los items
     */
    public function getTabItem($type,$tabs){
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
     * Nos devuelve la grilla necesitamos utilizar, se añade el id y el la posición de los botones de acciones
     */
    public function getGridItem($grid,$position="right",$id_name="id"){
        global $smarty;

        $grid = $this->grilla[$grid];
        $id_add[]=array(
            "field"=> $id_name
        ,   "label"=> $smarty->config_vars["gltableAction"]
        ,   "type_field"=>"text"
        ,   "as" => "actions"
        ,   "responsive" => true
        );
        if($position=="left"){
            $grid = array_merge($id_add,$grid);
        }else{
            $grid = array_merge($grid,$id_add);
        }
        return $grid;
    }
    /**
     * le datmos formato al arreglo de grilla para mandar a generar el json
     */
    public function get_grilla_tranformar_arreglo_sbm($campos){

        $col = array();
        for($i=0 ; $i<count($campos);$i++){
            $field = $campos[$i]["field"];
            $col_extra = $campos[$i];
            if(trim($campos[$i]["table_as"])==""){
                $col_extra["db"] = 'i.'.$field.'';
            }else{
                $col_extra["db"] = ''.trim($campos[$i]["table_as"]).'.'.$field.'';
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

        return $col;
    }
    public function getGridDatatableSimple( $db,$grid,$table, $primaryKey, $extraWhere, $groupBy="", $having="",$position="right"){

        /**
         * Recojemos todos los campos que mostraremos en la lista
         * y le damos formato de un arreglo para generar el json para datatable
         */
        $campos = $this->getGridItem($grid,$position,$primaryKey);
        $col = $this->get_grilla_tranformar_arreglo_sbm($campos);
        $tablas_adicionales = $this->grilla_tablas_adicionales[$grid];


        $joinQuery = "FROM ".$table." AS i \n\r";
        $join_extra = " ";
        if(count($tablas_adicionales)>0){
            foreach ($tablas_adicionales as $row){
                $join_extra .= " left join ".$row["table"]." as ".$row["alias"]." \n";
                if( strpos($row["relationship_id"], ".") === false){
                    $relacion = "i.".$row["relationship_id"]."";
                }else{
                    $relacion = $row["relationship_id"];
                }
                $join_extra .= " on  (".$row["alias"].".".$row["field_id"]." = ".$relacion." ) \n";
            }
        }

        $joinQuery = $joinQuery.$join_extra;

        $sql_details = array(
            'type' => $db["type"],
            'user' => $db["user"],
            'pass' => $db["password"],
            'db'   => $db["database"],
            'host' => $db["server"],
            'port' => $db["port"]
        );
        /**
         * Cargamos la libreria, depende de que tipo de base de datos esta utilizando
         */
        if($db["type"]=="pgsql"){
            require("./lib/datatable/ssp.class.pg.php");
        }else{
            require("./lib/datatable/ssp.seth.class.php");
        }
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
    public function processFields($item,$campos,$accion){

        $resultado = array();
        foreach (array_keys($campos) as $clave) {
            if(isset($item[$clave])) {

                $resultado[$clave] = trim($item[$clave]);
                switch ($campos[$clave]["type"]){
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

                    case 'checkbox_02':
                        if ($resultado[$clave] == "") $resultado[$clave]='false';
                        else $resultado[$clave] = 'true';
                        break;
                }

            }else{
                switch ($campos[$clave]["type"]){
                    /**
                     * si es de tipo checkbox_01 si o si guarda a la base de datos con 0 o 1
                     */
                    case 'checkbox_01':
                        if ($resultado[$clave] == "") $resultado[$clave]=0;
                        else $resultado[$clave] = 1;
                        break;
                    case 'checkbox_02':
                        if ($resultado[$clave] == "") $resultado[$clave]='false';
                        else $resultado[$clave] = 'true';
                        break;
                }
            }


        }
        /**
         * añadimos los datos de fechas y usuarios que actualizan los datos
         */
        if($accion =="update"){
            $resultado["updated_at"] = date("Y-m-d H:i:s");
            $resultado["user_update"] = $this->userId;
        }
        if($accion=="new"){
            $resultado["created_at"] = $resultado["updated_at"] = date("Y-m-d H:i:s");
            $resultado["user_create"] = $resultado["user_update"] = $this->userId;
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
    function deleteItem($itemId,$campo_id,$tabla,$where=""){
        global $privFace;


        if($privFace["delete"]){
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
                        $res["type"] = 1;
                        $res["msg"] = "No se logro eliminar el registro de la B.D.";
                        $res["msgdb"] = $this->dbm->ErrorMsg();
                    }

                }else{
                    $res["res"] = 2;
                    $res["type"] = 2;
                    $res["msg"] = "El registro con ID = '".$itemId."'' que desea eliminar no existe ";
                }
            }else{
                $res["res"] = 2;
                $res["type"] = 3;
                $res["msg"] = "El id del registro que quiere eliminar esta vacio";
            }
        }else{
            $res["res"] = 2;
            $res["type"] = 4;
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
    function getAttachmentDir($item_id,$create = 0,$carpeta="archivos"){
        $dir = $this->get_dir_item_sbm($item_id,$create);
        $dir .= $carpeta."/";
        if($create) $this->viewDirectory($dir);
        return $dir;
    }
    function deleteAttachmentFile($id,$item_id,$extension,$folder="archivos"){
        $dir = $this->getAttachmentDir($item_id,0,$folder);
        $file = $dir.$id.".".$extension;
        unlink($file);
    }

    function item_delete_archivo_item_sbm($id,$item_id,$item,$carpeta="archivos"){
        $dir = $this->getAttachmentDir($item_id,0,$carpeta);
        $file = $dir.$id.".".$item["attached_extension"];
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
                $dir = $this->getAttachmentDir($item_id,1,$carpeta);
            }else{
                $dir = $this->getAttachmentDir($id,1,$carpeta);
            }



            /**
             * Borramos el archivo previamente almacenado
             */
            if($accion=="update"){
                unlink($dir.$id.".".$item["attached_extension"]);
            }
            /**
             * Sacamos la extensión del archivo
             */
            $res["attached_extension"] = $this->getExtFile($adjunto["name"]);
            /**
             * Realizamos la copia del archivo
             */
            $adjunto_local = $dir.$id.".".$res["attached_extension"];
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
                $datos["attached_name"]=$adjunto["name"];
                $datos["attached_extension"] = $res["attached_extension"];
                $datos["attached_size"]=$adjunto["size"];
                $datos["attached_type"]=$adjunto["type"];
                $datos["avatar"]=1;

                $res = $this->updateItem($id,$datos,$tabla,"update",$campo_id,$where);
                /**
                 * Iniciamos a generar los otros tipos gráficos
                 */
                $this->item_imagen_subir_sbm($adjunto_local,$dir,$id,$res["attached_extension"]);
                if($res["res"]==1){
                    $res["res"] = 1;
                    $res["msg"] = "se adjunto con exito el archivo";
                }else{
                    $res["res"] = 2;
                    $res["msg"] = $res["msgdb"];
                }
            }else{
                $datos = array();
                $datos["attached_name"] = "";
                $datos["attached_extension"] = "";
                $datos["attached_size"] = "";
                $datos["attached_type"] = "";
                $datos["avatar"]=0;

                $res = $this->updateItem($id,$datos,$tabla,"update",$campo_id,$where);

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
    function saveAttachment($item,$tabla,$input_file,$item_id,$id,$accion="new",$folder="archivos",$item_id_name="item_id",$id_name="id"){
        $res = array();
        if(isset($input_file["name"]) && $input_file["name"]!="" && $input_file["error"]==0){

            $dir = $this->getAttachmentDir($item_id,1,$folder);
            /**
             * Borramos el archivo previamente almacenado
             */
            if($accion=="update"){
                $file = $dir.$id.".".$item["attached_extension"];
                unlink($file);
            }
            /**
             * Sacamos la extensión del archivo
             */
            $res["attached_extension"] = $this->getExtFile($input_file["name"]);
            /**
             * Realizamos la copia del archivo
             */
            $attached_local = $dir.$id.".".$res["attached_extension"];
            if(copy($input_file["tmp_name"],$attached_local)) $copy = 1;
            else $copy = 0;

            $where = $item_id_name."='".$item_id."'";
            if ($copy==1){
                chmod($attached_local,0777);
                $datos = array();
                $datos["attached_name"]=$input_file["name"];
                $datos["attached_extension"] = $res["attached_extension"];
                $datos["attached_size"]=$input_file["size"];
                $datos["attached_type"]=$input_file["type"];

                $res = $this->updateItem($id,$datos,$tabla,"update",$id_name,$where);

                if($res["res"]==1){
                    $res["res"] = 1;
                    $res["msg"] = "se adjunto con exito el archivo";
                }else{
                    $res["res"] = 2;
                    $res["msg"] = $res["msgdb"];
                }
            }else{
                $datos = array();
                $datos["attached_name"] = "";
                $datos["attached_extension"] = "";
                $datos["attached_size"] = "";
                $datos["attached_type"] = "";

                $res = $this->updateItem($id,$datos,$tabla,"update",$id_name,$where);

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
    function updateItem($itemId,$rec,$tabla,$accion="new",$campo_id="",$where=""){
        global $privFace;
        if(count($rec)>0){
            if($accion=="update"){
                if($itemId!=''){
                    if($privFace["edit"]){
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
                                $res["type"] = 1;
                                $res["msg"] = "No se logro actualizar la informacion en la B.D.";
                                $res["msgdb"] = $this->dbm->ErrorMsg();
                            }
                        }else{
                            $res["res"] = 2;
                            $res["type"] = 2;
                            $res["msg"] = "El registro con ID = '".$itemId."'' que desea actualizar no existe o fue borrado ";
                        }
                    }else{
                        $res["res"] = 2;
                        $res["type"] = 3;
                        $res["msg"] = "No tiene los permisos para editar este registro.";
                    }
                }else{
                    $res["res"] = 2;
                    $res["type"] = 4;
                    $res["msg"] = "No existe ID del registro que quiere editar.";
                }

            }else if($accion=="new"){
                if($privFace["add"]){

                    $resupdate = $this->dbm->AutoExecute($tabla,$rec);

                    if($resupdate){
                        $res["res"] = 1;
                        $res["id"] = $this->dbm->Insert_ID();
                    }else{
                        $res["res"] = 2;
                        $res["type"] = 1;
                        $res["msg"] = "No se logro actualizar la informacion en la B.D.";
                        $res["msgdb"] = $this->dbm->ErrorMsg();
                    }
                }else{
                    $res["res"] = 2;
                    $res["type"] = 5;
                    $res["msg"] = "No tiene permisos para crear nuevo registros";
                }
            }else{
                $res["res"] = 2;
                $res["type"] = 6;
                $res["msg"] = "No envio una acción a realizar";
            }

        }else{
            $res["res"] = 2;
            $res["type"] = 7;
            $res["msg"] = "El arreglo de datos enviado esta vacio";
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

    public function get_config_core(){
        global $db;
        $sql =  "SELECT * FROM ".$this->table_core["config"]." WHERE activo =1 LIMIT 1";
        $info = $db->execute($sql);
        $item = $info->fields;
        return $item;

    }
    public function send_email_system($to,$asunto,$base=""){
        global $subcontrol,$path_sbm,$appPath,$smarty_template,$smarty,$frontend,$CFGm,$CFG;
        /**
         * Configuración de template para sacar datos de los tpl para enviar el correo
         */
        $smarty_template = array();
        $smarty_template[] = "./app/core/template/email_core/";
        $smarty_template[] = $path_sbm."snippet/".$subcontrol."/view/";
        $smarty_template[] = APP_PATH."template/frontend/";
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
            $mail->AddEmbeddedImage($archivos.'email_logo.png','emailLogo','email_logo.png');

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

    /**
     * Borrar un directorio de forma recursiva
     */
    function rmdirRecursive($dir) {
        $files = scandir($dir);
        array_shift($files);    // remove '.' from array
        array_shift($files);    // remove '..' from array

        foreach ($files as $file) {
            $file = $dir . '/' . $file;
            if (is_dir($file)) {
                $this->rmdirRecursive($file);
                rmdir($file);
            } else {
                unlink($file);
            }
        }
        rmdir($dir);
    }
}