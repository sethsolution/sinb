<?php
class Snippet extends Table {
    //var $item_form;
    function __construct() {
        /**
         * Inicializamos todas las librerias y variables para el submodulo
         */
        $this->submodule_init_sbm();
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
        $tabla = $tabla;
        $res = $this->item_update_sbm($itemId, $respuesta_procesa, $tabla, $accion, $campo_id, $where);
        $res["accion"] = $accion;
        
        return $res;
    }

    /**
     * Función que valida los campos a ser guardados
     **/
    function procesa_datos($que_form, $rec, $accion="new") {
        $dato_resultado = array();
        switch($que_form){
            case 'campos_especies_nativas':
                /**
                 * $rec = es el arreglo de datos que proviene del formulario, desde el frontend
                 * $$this->item_form = es el arreglo de configuraciòn de datos que se procesaran
                 * $accion = new, update
                 */
                $dato_resultado = $this->procesa_campos_sbm($rec, $this->campos[$que_form], $accion);
                break;

            case 'campos_especie_nativa_macroregiones':
                $dato_resultado = $this->procesa_campos_sbm($rec, $this->campos[$que_form], $accion);
                break;

            case 'campos_especie_nativa_deptos':
                $dato_resultado = $this->procesa_campos_sbm($rec, $this->campos[$que_form], $accion);
                break;

            case 'campos_especie_nativa_municipios':
                $dato_resultado = $this->procesa_campos_sbm($rec, $this->campos[$que_form], $accion);
                break;

            /*case 'campos_especie_adjuntos':
                $dato_resultado = $this->procesa_campos_sbm($rec, $this->campos[$que_form], $accion);
                break;*/

            case 'otros_formularios':
                break;
        }
        return $dato_resultado;
    }

    /**
     * Borrar un registro de la base de datos
     */
    function item_delete($id, $tabla_referencia){
        $campo_id="espenativa_itemid";
        $res = $this->item_delete_sbm($id,$campo_id,$this->tabla[$tabla_referencia]);
        return $res;
    }

    /**
     * Función que recupera macroregiones
     **/
    function getMacroregiones() {
        global $db_conf_datatable;
        $db_conf = $db_conf_datatable["principal"];
        $dbm = ADONewConnection($db_conf["type"]);
        $dbm->Connect($db_conf["server"],$db_conf["user"] ,$db_conf["password"],$db_conf["database"]) or die("ERROR CONNECT " . $db_conf["database"]);
        $dbm->setCharset('utf8');
        $dbm->SetFetchMode(ADODB_FETCH_ASSOC);
        $sql = "SELECT id AS itemId, descrip AS nombre 
        FROM mapa_macroregiones 
        ORDER BY id ASC";
        $datos = $dbm->Execute($sql);
        $datos = $datos->GetRows();
        $dbm->Close();
        $res = array();
        foreach ($datos as $clave => $valor) {
            $res[$valor['itemId']] = $valor['nombre'];
        }
        return $res;
    }

    /**
     * Función que recupera el listado de departamentos
     **/
    function getDeptos($macroId){
        $sqlWhereIn = "";
        if (!empty($macroId)) {
            $sqlWhereIn = implode(',', $macroId);
        }
        global $db_conf_datatable;
        $db_conf = $db_conf_datatable["principal"];
        $dbm = ADONewConnection($db_conf["type"]);
        $dbm->Connect($db_conf["server"],$db_conf["user"] ,$db_conf["password"],$db_conf["database"]) or die("ERROR CONNECT " . $db_conf["database"]);
        $dbm->setCharset('utf8');
        $dbm->SetFetchMode(ADODB_FETCH_ASSOC);
        $sql = "SELECT DISTINCT t2.id AS itemId, t2.nombre 
        FROM mapa_macroregiones t1, mapa_departamentos t2 
        WHERE t1.id IN (".$sqlWhereIn.") 
        AND ST_Intersects(t1.geom, t2.geom)";
        $datos = $dbm->Execute($sql);
        $respuesta = $datos->GetRows();
        $dbm->Close();
        return $respuesta;
    }

    /**
     * Función que recupera el listado de municipios
     **/
    function getMunicipios($deptoId){
        $sqlWhereIn = "";
        if (!empty($deptoId)) {
            $sqlWhereIn = implode(',', $deptoId);
        }
        global $db_conf_datatable;
        $db_conf = $db_conf_datatable["principal"];
        $dbm = ADONewConnection($db_conf["type"]);
        $dbm->Connect($db_conf["server"],$db_conf["user"] ,$db_conf["password"],$db_conf["database"]) or die("ERROR CONNECT " . $db_conf["database"]);
        $dbm->setCharset('utf8');
        $dbm->SetFetchMode(ADODB_FETCH_ASSOC);
        $sql = "SELECT DISTINCT tb.itemId, tb.nombre 
        FROM mapa_macroregiones ta,
        (
        SELECT t2.id AS itemId, t2.municipio AS nombre, t2.geom 
        FROM mapa_departamentos t1, mapa_municipios t2 
        WHERE t1.id IN (".$sqlWhereIn.") 
        AND ST_Intersects(t1.geom, t2.geom) 
        AND t2.municipio <> ''
        ) tb
        WHERE ST_Intersects(ta.geom, tb.geom)";
        $datos = $dbm->Execute($sql);
        $respuesta = $datos->GetRows();
        $dbm->Close();
        return $respuesta;
    }

    /**
     * Función que recupera la relación especie-macroregiones
     **/
    function getEspecieMacroregiones($id) {
        global $db_conf_datatable;
        $db_conf = $db_conf_datatable["principal"];
        $dbm = ADONewConnection($db_conf["type"]);
        $dbm->Connect($db_conf["server"],$db_conf["user"] ,$db_conf["password"],$db_conf["database"]) or die("ERROR CONNECT " . $db_conf["database"]);
        $dbm->setCharset('utf8');
        $dbm->SetFetchMode(ADODB_FETCH_ASSOC);
        $sql = "SELECT macroreg_itemid 
        FROM especie_nativa_macroregiones 
        WHERE espenativa_itemid=".$id;
        $datos = $dbm->Execute($sql);
        $datos = $datos->GetRows();
        $dbm->Close();
        $res = array();
        foreach ($datos as $clave => $valor) {
            $res[] = $valor['macroreg_itemid'];
        }
        return $res;
    }

    /**
     * Función que recupera la relación especie-departamentos
     **/
    function getEspecieDeptos($id) {
        global $db_conf_datatable;
        $db_conf = $db_conf_datatable["principal"];
        $dbm = ADONewConnection($db_conf["type"]);
        $dbm->Connect($db_conf["server"],$db_conf["user"] ,$db_conf["password"],$db_conf["database"]) or die("ERROR CONNECT " . $db_conf["database"]);
        $dbm->setCharset('utf8');
        $dbm->SetFetchMode(ADODB_FETCH_ASSOC);
        $sql = "SELECT GROUP_CONCAT(depto_itemid) AS depto_itemid 
        FROM especie_nativa_deptos 
        WHERE espenativa_itemid=".$id." 
        GROUP BY espenativa_itemid";
        $datos = $dbm->Execute($sql);
        $datos = $datos->fields;
        $dbm->Close();
        return $datos;
    }

    /**
     * Función que recupera la relación alimento-municipios
     **/
    function getEspecieMunicipios($id) {
        global $db_conf_datatable;
        $db_conf = $db_conf_datatable["principal"];
        $dbm = ADONewConnection($db_conf["type"]);
        $dbm->Connect($db_conf["server"],$db_conf["user"] ,$db_conf["password"],$db_conf["database"]) or die("ERROR CONNECT " . $db_conf["database"]);
        $dbm->setCharset('utf8');
        $dbm->SetFetchMode(ADODB_FETCH_ASSOC);
        $sql = "SELECT GROUP_CONCAT(municipio_itemid) AS municipio_itemid 
        FROM especie_nativa_municipios 
        WHERE espenativa_itemid=".$id." 
        GROUP BY espenativa_itemid";
        $datos = $dbm->Execute($sql);
        $datos = $datos->fields;
        $dbm->Close();
        return $datos;
    }

    function descargarRecurso($id) {
        $item = $this->get_item($id, "especie_nativa_adjuntos");
        if($item["itemId"] != "") {
            $dir  = $this->get_dir_item_archivo_sbm($item["espenativa_itemid"]);
            $archivo = $dir.$id.".".$item["adjunto_extension"];
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
            echo "";
            exit;
        }
    }

}