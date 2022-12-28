<?php
class Snippet extends Table {
    //var $item_form;
    function __construct() {
        /**
         * Inicializamos todas las librerias y variables para el submodulo
         */
        $this->submodule_init_sbm();
    }

    function get_item($idItem,$tipoTabla,$variante=""){
        $this->dbm->SetFetchMode(ADODB_FETCH_ASSOC);
        $info = '';
        if($idItem!=''){
            if($tipoTabla=='persona'){
                $sqlSelect = ' i.*
                           , CONCAT_WS(" ",u1.nombre,u1.apellido) as userCreater
                           , CONCAT_WS(" ",u2.nombre,u2.apellido) as userUpdater';
                $sqlFrom = ' '.$this->tabla[$tipoTabla].' i
                         LEFT JOIN '.$this->tabla["o_core_usuario"].' u1 on u1.itemId=i.userCreate
                         LEFT JOIN '.$this->tabla["o_core_usuario"].' u2 on u2.itemId=i.userUpdate';
                $sqlWhere = ' i.itemId='.$idItem;
                $sqlGroup = ' GROUP BY i.itemId';
            }else{
                $sqlSelect = ' i.*';
                $sqlFrom = ' '.$this->tabla[$tipoTabla].' i ';
                $sqlWhere = ' i.proy_itemid='.$idItem;
            }

            $sql = 'SELECT '.$sqlSelect.'
                  FROM '.$sqlFrom.'
                  WHERE '.$sqlWhere.'
                  '.$sqlGroup;
            $info = $this->dbm->Execute($sql);
            $info = $info->fields;
        }
        return $info;
    }
    
    /**
     * Function que actualiza la informacion de datos de un registro
     * $respuesta = $subObjItem->item_update($item,$itemId,0);
     * $rec = arreglo de datos que llega del formulario
     * $itemId= el id del reguistro que quiero actualizar
     * $que_form = El formulario dentro que quiero actualizar, "Es el mismo nombre del grupo de campos que quiero validar"
     * $accion = new, update ,  solo existen 2 acciones
     *
     **/
    function item_update($rec, $itemId, $que_form, $accion, $tabla) {
        /**
         * preprocesamos los datos
         */
        $respuesta_procesa = $this->procesa_datos($que_form, $rec, $accion, $item_id);
        /**
         * Guardo los datos ya procesados
         */
        $campo_id="itemId";
        $where = "";
        //$tabla = $this->tabla["proyectos"];
        $tabla = $tabla;
        $res = $this->item_update_sbm($itemId, $respuesta_procesa, $tabla, $accion, $campo_id, $where);
        $res["accion"] = $accion;
        
        return $res;
    }

    function item_update_file($rec, $itemId, $que_form, $accion, $tabla, $item_id, $archivo_adjunto) {
        /**
         * preprocesamos los datos
         */
        $respuesta_procesa = $this->procesa_datos($que_form, $rec, $accion, $item_id);
        /**
         * Guardo los datos ya procesados
         */
        $campo_id="proy_itemid";
        $where = "";
        $res = $this->item_update_sbm($itemId, $respuesta_procesa, $tabla, $accion, $campo_id, $where);
        $res["accion"] = $accion;
        /**
         * Procesamos el archivo
         */
        $id_archivo = $res["id"];
        if ($archivo_adjunto["size"] != 0) {
            $item = array();
            if ($accion == "update") {
                $item = $this->getDocumentoAdjunto($itemId);
                $id_archivo = $item["itemId"];
            }
            $procesa_archivo = $this->guardarArchivoAdjunto($archivo_adjunto, $id_archivo, $item, $accion);
            if ($procesa_archivo['res'] == 1) {
                $item_file = array();
                $item_file["adjunto_nombre"] = $archivo_adjunto["name"];
                $item_file["adjunto_extension"] = $this->getExtFile($archivo_adjunto["name"]);
                $item_file["adjunto_tamano"] = $archivo_adjunto["size"];
                $item_file["adjunto_tipo"] = $archivo_adjunto["type"];
                $res = $this->actualizarDatosAdjunto($id_archivo, $item_file);
            } else {
                $item_file = array();
                $item_file["adjunto_nombre"] = "";
                $item_file["adjunto_extension"] = "";
                $item_file["adjunto_tamano"] = "";
                $item_file["adjunto_tipo"] = "";
                $res = $this->actualizarDatosAdjunto($id_archivo, $item_file);
            }
            $res["accion"] = $accion;
        }
        return $res;
    }

    /**
     * Función que valida los campos a ser guardados
     **/
    function procesa_datos($que_form, $rec, $accion="new") {
        $dato_resultado = array();
        switch($que_form){
            case 'campos_proyecto_adjuntos':
                /**
                 * $rec = es el arreglo de datos que proviene del formulario, desde el frontend
                 * $$this->item_form = es el arreglo de configuraciòn de datos que se procesaran
                 * $accion = new, update
                 */
                $dato_resultado = $this->procesa_campos_sbm($rec, $this->campos[$que_form], $accion);
                break;

            case 'otros_formularios':
                break;
        }
        return $dato_resultado;
    }

    /**
     * Funcion que recupera un registro de la tabla proyecto adjuntos
     **/
    function getDocumentoAdjunto($id) {
        global $db_conf_datatable;
        $db_conf = $db_conf_datatable["principal"];
        $dbm = ADONewConnection($db_conf["type"]);
        $dbm->Connect($db_conf["server"],$db_conf["user"] ,$db_conf["password"],$db_conf["database"]) or die("ERROR CONNECT " . $db_conf["database"]);
        $dbm->setCharset('utf8');
        $dbm->SetFetchMode(ADODB_FETCH_ASSOC);
        $sql = "SELECT * FROM proyecto_adjuntos WHERE proy_itemid=".$id." LIMIT 1";
        $datos = $dbm->Execute($sql);
        $datos = $datos->fields;
        $dbm->Close();
        return $datos;
    }

    /**
     * Funcion que recupera un registro de la tabla proyecto adjuntos
     **/
    function actualizarDatosAdjunto($id, $datos) {
        global $db_conf_datatable;
        $db_conf = $db_conf_datatable["principal"];
        $dbm = ADONewConnection($db_conf["type"]);
        $dbm->Connect($db_conf["server"],$db_conf["user"] ,$db_conf["password"],$db_conf["database"]) or die("ERROR CONNECT " . $db_conf["database"]);
        $dbm->setCharset('utf8');
        $dbm->SetFetchMode(ADODB_FETCH_ASSOC);
        $datos = $dbm->autoExecute('proyecto_adjuntos', $datos, 'UPDATE', 'itemId = '.$id);
        $dbm->Close();
        if ($datos == 1) {
            $res = array(
                'res' => 1,
                'msg' => 'Los datos han sido guardados con éxito.',
                'id' => $id
                );
        } else {
            $res = array(
                'res' => 2,
                'msg' => 'Los datos no se han podido guardar.',
                'id' => $id
                );
        }
        return $res;
    }

    function guardarArchivoAdjunto($adjunto, $id, $item, $accion="new", $carpeta="archivos") {
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

            if ($copy==1){
                chmod($adjunto_local,0777);
                $res["res"] = 1;
                $res["msg"] = "se adjunto con exito el archivo";
            }else{
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
     * Funcion que recupera un archivo y lo envia para descarga
     **/
    function descargarArchivo($id) {
        $item = $this->getDocumentoAdjunto($id);
        if($item["itemId"] != "") {
            $dir  = $this->get_dir_item_archivo_sbm($item["itemId"]);
            $archivo = $dir.$item["itemId"].".".$item["adjunto_extension"];
            header ("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
            header ("Last-Modified: " . gmdate("D,d M YH:i:s") . " GMT");
            header ("Cache-Control: no-cache, must-revalidate");
            header ("Pragma: no-cache");
            header ("Content-Type:".$item["adjunto_tipo"]);
            header ('Content-Disposition: attachment; filename="'.$item["adjunto_nombre"].'"');
            header ("Content-Length: " . $item["adjunto_tamano"]);
            readfile($archivo);
            exit;
        } else {
            echo "<center><b><font color='red' face='arial'>El archivo no existe.</font></b></center>";
            exit;
        }
    }

}