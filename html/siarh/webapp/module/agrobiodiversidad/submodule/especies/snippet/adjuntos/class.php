<?php
class Snippet extends Table {
    //var $item_form;
    function __construct() {
        /**
         * Inicializamos todas las librerias y variables para el submodulo
         */
        $this->submodule_init_sbm();
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
    function item_update($rec, $itemId, $que_form, $accion, $item_id, $archivo_adjunto) {
        $tabla = $this->tabla["especie_adjuntos"];
        /**
         * preprocesamos los datos
         */
        $respuesta_procesa = $this->procesa_datos($que_form, $rec, $accion, $item_id);
        /**
         * Guardo los datos ya procesados
         */
        $campo_id="itemId";
        $where = "";
        $res = $this->item_update_sbm($itemId, $respuesta_procesa, $tabla, $accion, $campo_id, $where);
        $res["accion"] = $accion;
        /**
         * Procesamos el archivo
         */
        if( $res["res"]==1){
            $item = $this->get_item($res["id"], $tabla);
            $adjunto = $this->item_adjunto_sbm($archivo_adjunto, $item_id, $res["id"], $item, $tabla, $accion, 'espe_itemid');
        }
        return $res;
    }

    /**
     * Función que valida los campos a ser guardados
     **/
    function procesa_datos($que_form, $rec, $accion="new") {
        $dato_resultado = array();
        switch($que_form){
            case 'campos_especie_adjuntos':
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

    function get_item($idItem, $tipoTabla, $variante="") {
        $this->dbm->SetFetchMode(ADODB_FETCH_ASSOC);
        $info = '';
        if($idItem!=''){
            if($tipoTabla=='item'){
                $sqlSelect = ' i.*
                           , CONCAT_WS(" ",u1.nombre,u1.apellido) as userCreater
                           , CONCAT_WS(" ",u2.nombre,u2.apellido) as userUpdater';
                $sqlFrom = ' '.$this->tabla[$tipoTabla].' i
                         LEFT JOIN '.$this->tabla["o_usuario"].' u1 on u1.itemId=i.userCreate
                         LEFT JOIN '.$this->tabla["o_usuario"].' u2 on u2.itemId=i.userUpdate';
                $sqlWhere = ' i.itemId='.$idItem;
                $sqlGroup = ' GROUP BY i.itemId';
            }else{
                $sqlSelect = ' i.*';
                $sqlFrom = ' '.$this->tabla[$tipoTabla].' i ';
                $sqlWhere = ' i.itemId='.$idItem;
                $sqlGroup = '';
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

    public function get_item_datatable_Rows($id){
        global $db_conf_datatable;
        /**
         * tabla de la base de datos que listaremos
         */
        $table = $this->tabla["especie_adjuntos"];
        /**
         * El nombre del campo que guarda id principal
         */
        $primaryKey = "itemId";
        /**
         * Que configuraciòn de grilla utilizaremos
         */
        $grilla = "grilla_especie_adjuntos";
        /**
         * la configuración de base de datos que utilizaremos
         * que se la realiza en inc/db.php
         */
        $db = $db_conf_datatable["principal"];
        /**
         * Configuraciones adicionales
         */
        $extraWhere = "espe_itemid=".$id;
        $groupBy = "";
        $having = "";
        /**
         * Resultado de la consulta enviada
         */
        $resultado = $this->get_grilla_datatable_simple($db, $grilla, $table, $primaryKey, $extraWhere, $groupBy, $having);
        /**
         * apartir de aca podemos transformar datos, de acuerdo a requerimiento
         */
        return $resultado;
    }

    /**
     * Borrar un registro de la base de datos
     */
    function item_delete($id, $campo_referencia, $tabla_referencia) {
        $campo_id=$campo_referencia;
        $where = "";
        //eliminamos el archivo físico
        $item = $this->get_item($id, $tabla_referencia);
        $dir = $this->get_dir_item_archivo_sbm($item["espe_itemid"], 0);
        $file = $dir.$id.".".$item["adjunto_extension"];
        if (file_exists($file)) {
            unlink($file);
        }
        //eliminamos registro de la BD
        $res = $this->item_delete_sbm($id, $campo_id, $this->tabla[$tabla_referencia], $where);
        return $res;
    }

    /**
     * Función actualiza el campo estado de la tabla especie_adjuntos
     **/
    function set_recurso_imagen($id, $adjId) {
        global $db_conf_datatable;
        $db_conf = $db_conf_datatable["principal"];
        $dbm = ADONewConnection($db_conf["type"]);
        $dbm->Connect($db_conf["server"],$db_conf["user"] ,$db_conf["password"],$db_conf["database"]) or die("ERROR CONNECT " . $db_conf["database"]);
        $dbm->setCharset('utf8');
        $dbm->SetFetchMode(ADODB_FETCH_ASSOC);
        $sql = "UPDATE especie_adjuntos SET estado=NULL WHERE estado='' OR estado='foto' AND espe_itemid=".$id;
        $datos = $dbm->Execute($sql);
        $sql = "UPDATE especie_adjuntos SET estado='foto' WHERE itemId=".$adjId;
        $datos = $dbm->Execute($sql);
        $dbm->Close();
        if ($datos) {
            $respuesta = array(
                'res' => 1,
                'msg' => 'Este recurso se estableció como imagen por defecto de la especie.'
            );
        } else {
            $respuesta = array(
                'res' => 2,
                'msg' => 'No se pudo asignar este recurso.'
            );
        }
        return $respuesta;
    }

    /**
     * Función actualiza el campo estado de la tabla especie_adjuntos
     **/
    function set_recurso_ficha($id, $adjId) {
        global $db_conf_datatable;
        $db_conf = $db_conf_datatable["principal"];
        $dbm = ADONewConnection($db_conf["type"]);
        $dbm->Connect($db_conf["server"],$db_conf["user"] ,$db_conf["password"],$db_conf["database"]) or die("ERROR CONNECT " . $db_conf["database"]);
        $dbm->setCharset('utf8');
        $dbm->SetFetchMode(ADODB_FETCH_ASSOC);
        $sql = "UPDATE especie_adjuntos SET estado=NULL WHERE estado='' OR estado='ficha' AND espe_itemid=".$id;
        $datos = $dbm->Execute($sql);
        $sql = "UPDATE especie_adjuntos SET estado='ficha' WHERE itemId=".$adjId;
        $datos = $dbm->Execute($sql);
        $dbm->Close();
        if ($datos) {
            $respuesta = array(
                'res' => 1,
                'msg' => 'Este recurso se estableció como ficha por defecto de la especie.'
            );
        } else {
            $respuesta = array(
                'res' => 2,
                'msg' => 'No se pudo asignar este recurso.'
            );
        }
        return $respuesta;
    }

    /**
     * Función actualiza el campo estado de la tabla especie_adjuntos
     **/
    function set_recurso_descriptor($id, $adjId) {
        global $db_conf_datatable;
        $db_conf = $db_conf_datatable["principal"];
        $dbm = ADONewConnection($db_conf["type"]);
        $dbm->Connect($db_conf["server"],$db_conf["user"] ,$db_conf["password"],$db_conf["database"]) or die("ERROR CONNECT " . $db_conf["database"]);
        $dbm->setCharset('utf8');
        $dbm->SetFetchMode(ADODB_FETCH_ASSOC);
        $sql = "UPDATE especie_adjuntos SET estado=NULL WHERE estado='' OR estado='descriptor' AND espe_itemid=".$id;
        $datos = $dbm->Execute($sql);
        $sql = "UPDATE especie_adjuntos SET estado='descriptor' WHERE itemId=".$adjId;
        $datos = $dbm->Execute($sql);
        $dbm->Close();
        if ($datos) {
            $respuesta = array(
                'res' => 1,
                'msg' => 'Este recurso se estableció como descriptor por defecto de la especie.'
            );
        } else {
            $respuesta = array(
                'res' => 2,
                'msg' => 'No se pudo asignar este recurso.'
            );
        }
        return $respuesta;
    }

}