<?php
namespace Core;
use Lib\Datatable\SSP;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

class CoreResources
{

    /**
     * variables de submodulos
     */
    public $dbm;
    public $table;
    public $table_core;

    public $userv;
    public $userId;
    public $usuario_id;
    public $empresa_id;

    public $privFace;
    public $privSM;

    var $directory;

    public $grilla;
    public $grilla_tablas_adicionales;
    public $tabs;

    public $campos;


    var $userFolder = 1000;
    public $catalogList = array();

    function appInit()
    {
        global $dbm, $privFace, $privSM, $core, $grid, $grid_table_join, $tabs, $fields,$tableCore,$appVars;

        /**
         * Base de datos principal
         */
        $this->dbm = $dbm;
        /**
         * Mapeo de tablas
         */
        $this->table = isset($appVars["table"])?$appVars["table"]:array();
        $this->table_core = $tableCore;
        /**
         * Datos del usuario en session
         */
        $this->userv = $_SESSION["userv"]??array();
        $this->userId = $_SESSION["userv"]["id"]??0;
        $this->usuario_id = $_SESSION["userv"]["id"]??0;
        //$this->empresa_id = $_SESSION["empresa"]["itemId"];
        /**
         * Permisos de usuarios tanto para base de datos como interfaz
         */

        $this->privFace = $privFace;
        $this->privSM = $privSM;
        /**
         * Configuramos y creamos las carpetas necesarias del módulo
         */
        $this->directory = isset($appVars["directory"])?$appVars["directory"]:array();
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
    }

    public function addCatalogList($table, $name = "", $id = "", $dataaux = "", $noutf8 = 0, $order = "", $where = "", $parent = "", $concatena = 0, $dataName = "name")
    {
        $dato = array();
        $dato["table"] = $table;
        $dato["name"] = (trim($name) == "") ? $table : trim($name);
        $dato["id"] = (trim($id) == "") ? "id" : trim($id);
        $dato["data"] = (trim($dataaux) == "") ? "name" : trim($dataaux);
        $dato["noutf8"] = (trim($noutf8) == "") ? 0 : trim($noutf8);
        $ordenAux = explode("|", $order);
        //$dato["orden"] = (trim($orden)=="")?"nombre":trim($orden);
        if ($concatena) {
            $dato["order"] = (trim($ordenAux[0]) == "") ? "name" : trim($ordenAux[0]);
        } else {
            $dato["order"] = (trim($ordenAux[0]) == "") ? $dato["data"] : trim($ordenAux[0]);
        }
        $dato["dirOrder"] = (!isset($ordenAux[1]) || trim($ordenAux[1]) == "") ? "ASC" : trim($ordenAux[1]);
        $dato["where"] = (trim($where) == "") ? "" : trim($where);
        $dato["parent"] = (trim($parent) == "") ? 0 : trim($parent);
        $dato["concatenated"] = (trim($concatena) == "") ? 0 : trim($concatena);
        $dato["data_name"] = (trim($dataName) == "") ? "name" : trim($dataName);
        $this->catalogList[] = $dato;
    }

    public function getCatalogList()
    {
        $res = array();
        foreach ($this->catalogList as $row) {
            if ($row["parent"] == 0) {
                $res[$row["name"]] = $this->getCatalogListSimple($row);
            } else {
                $res[$row["name"]] = $this->getCatalogListGroup($row);
            }
        }
        return $res;
    }

    public function getCatalogListSimple($row)
    {

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
        $opt = $this->getArrayData($item, $row["id"], $dato, $row["noutf8"]);
        return $opt;
    }

    public function getCatalogListGroup($row)
    {
        $this->dbm->SetFetchMode(ADODB_FETCH_ASSOC);
        $sql = "select " . $row["id"] . "," . $row["dato"] . " from " . $row["tabla"] . " ";
        $sql .= "where parent=0 ";
        if ($row["where"] != "") {
            $sql .= " and " . $row["where"] . " ";
        }
        //$sql.=" ORDER BY ".$row["orden"]." ASC";
        $sql .= " ORDER BY " . $row["orden"] . " " . $row["dirOrden"]; //echo $sql;
        $info = $this->dbm->Execute($sql);
        $item = $info->GetRows();

        $opt = array();
        foreach ($item as $dato) {
            $con = $row;
            $con["where"] = "parent=" . $dato[$row["id"]];
            $opt[utf8_encode($dato[$row["dato"]])] = $this->getCatalogListSimple($con);
        }


    }

    public function getArrayData($item,$var1,$var2,$tipo=0){
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
     * Grilla para DataTable
     * -----------------------------------------------------------------------------------------------------------------
     */
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
        if(is_array($tablas_adicionales) && count($tablas_adicionales)>0){
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
            require("./core/lib/datatable/ssp.class.pg.php");
        }else{
            require("./core/lib/datatable/ssp.seth.class.php");
        }

        if(!isset($_REQUEST['columns']) || !is_array($_REQUEST['columns'])) $_REQUEST['columns'] = array();

        $resultado = SSP::simple( $_REQUEST, $sql_details, $table, $primaryKey, $col, $joinQuery, $extraWhere, $groupBy, $having );
        return $resultado;
    }
    /**
     * le datmos formato al arreglo de grilla para mandar a generar el json
     */
    public function get_grilla_tranformar_arreglo_sbm($campos){

        $col = array();
        for($i=0 ; $i<count($campos);$i++){
            $field = $campos[$i]["field"];
            $col_extra = $campos[$i];
            $campos[$i]["table_as"] = isset($campos[$i]["table_as"])?trim($campos[$i]["table_as"]):"";
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

            if( isset($campos[$i]["as"]) && $campos[$i]["as"]==""){
                unset($col_extra["as"]);
            }
            $col[]= $col_extra;
        }

        return $col;
    }
    /**
     * Grilla para DataTable
     * -----------------------------------------------------------------------------------------------------------------
     */

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

    /**
     * Manejo de actualización de datos
     * -----------------------------------------------------------------------------------------------------------------
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

    /**
     * Attachment
     * -----------------------------------------------------------------------------------------------------------------
     */
    /**
     * Procesa un archivo adjunto
     */
    function viewDirectory($dir){
        if(!file_exists($dir)){	$res= mkdir($dir, 0777);}
    }
    function getAttachmentDir($item_id,$create = 0,$carpeta="archivos"){
        $dir = $this->get_dir_item_sbm($item_id,$create);
        $dir .= $carpeta."/";
        if($create) $this->viewDirectory($dir);
        return $dir;
    }
    function get_dir_item_sbm($item_id,$create = 0){
        $dir = $this->directory;
        $dir = $dir.floor($item_id / $this->userFolder)."/";
        if($create) $this->viewDirectory($dir);
        $dir = $dir.$item_id."/";
        if($create) $this->viewDirectory($dir);
        return $dir;
    }
    function deleteAttachmentFile($id,$item_id,$extension,$folder="archivos"){
        $dir = $this->getAttachmentDir($item_id,0,$folder);
        $file = $dir.$id.".".$extension;
        if(file_exists($file)) unlink($file);
    }
    function getExtFile($name){
        $extFile = $name;
        $extFile = strrev($extFile); //volcamos la cadena  archivo.hola.doc  = cod.aloh.ovihcra  doc
        $extFile = explode(".",$extFile);
        $extFile = $extFile[0];
        $extFile = strrev($extFile);
        $extFile = trim($extFile);
        return $extFile;
    }

    function saveAttachment($item,$tabla,$input_file,$item_id,$id,$accion="new",$folder="archivos",$item_id_name="item_id",$id_name="id"){
        $res = array();
        if(isset($input_file["name"]) && $input_file["name"]!="" && $input_file["error"]==0){
            $dir = $this->getAttachmentDir($item_id,1,$folder);
            /**
             * Borramos el archivo previamente almacenado
             */
            if($accion=="update"){
                $file = $dir.$id.".".$item["attached_extension"];
                if(file_exists($file)) unlink($file);
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
     * Borrar Archivo
     * ------------------------------------------------------------------------------------------------------
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

    /**
     * Multiselección
     * --------------------------------------------------------------------------------------------
     */
    public function saveMultiSelectionData($table,$relationshipField,$relationshipId,$fieldDataName,$data){
        if(is_array($data)){
            $multiData = implode(",",$data);
        }else{
            $multiData = "";
            $data = array();
        }

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
    /**
     * Datos Geográficos
     * ------------------------------------------------------------------------------
     */
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


    function getRamdomString($length = 10) {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }

    public function getConfigCore(){
        global $db;
        $sql =  "SELECT * FROM ".$this->table_core["config"]." WHERE active =TRUE LIMIT 1";
        $info = $db->execute($sql);
        $item = $info->fields;
        return $item;

    }

    public function sendEmailSystem($to,$asunto,$base=""){
        global $subcontrol,$path_sbm,$pathmodule,$smarty_template,$smarty,$frontend;
        /**
         * Configuración de template para sacar datos de los tpl para enviar el correo
         */
        $smarty_template = array();
        $smarty_template[] = "./app/core/template/";
        $smarty_template[] = $path_sbm."snippet/".$subcontrol."/view/";
        $smarty_template[] = APP_PATH."template/frontend/";
        $smarty->setTemplateDir($smarty_template);

        if($base==""){
            $base = $frontend["email_base"];
        }
        /**
         * Sacamos los datos de configuración
         */
        $conf = $this->getConfigCore();
        /**
         * Variable dominio en la url
         */

        if($conf["ssl"]==false){
            $dominio = "http://";
        }else{
            $dominio = "https://";
        }
        $dominio .=  $conf["domain"];
        $smarty->assign("url_dominio",$dominio);
        $smarty->assign("dominio",$conf["domain"]);

        $cuerpo = $smarty->fetch($frontend["email_base"]);

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
            $mail->setFrom($conf["email_from"], $conf["email_from_name"]);
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
        return $res;
    }

    /**
     * Tiempo que transcurre entre dos fechas
     *
     * @param $fecha
     * @param string $fechaActual
     * @return array
     */
    public function getTimeElapsed($fecha,$fechaActual = ""){
        if ($fechaActual=="")  $fechaActual = date("Y-m-d H:i");
        $datetime1 = date_create($fecha);
        $datetime2 = date_create($fechaActual);
        $contador = date_diff($datetime1, $datetime2);
        $minutos = ($contador->format('%a') *24*60 ) + ($contador->h * 60) + $contador->i;
        $contador->minutos = $minutos;

        $res = array();
        $res["days"] = (int)$contador->format('%a');
        $res["hours"] = $contador->h;
        $res["minutes"] = $contador->i;
        $res["total_minutes"] = $minutos;
        return $res;
    }

    public function addMinutesToDate($fecha,$minutes,$format="Y-m-d H:i:s"){
        $mod_date = strtotime($fecha."+ ".$minutes." minute");
        return date($format,$mod_date);
    }
    public function addDaysToDate($fecha,$dias,$format="Y-m-d H:i:s"){
        $mod_date = strtotime($fecha."+ ".$dias." days");
        return date($format,$mod_date);
    }

}