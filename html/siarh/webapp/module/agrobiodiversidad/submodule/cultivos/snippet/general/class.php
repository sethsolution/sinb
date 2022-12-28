<?php
/** 
* Inclusión librería gpoint
**/
require_once ('lib/gpoint/Class.GeoConversao.php');
require_once ('lib/gpoint/gPoint.php');

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
        //$tabla = $this->tabla["proyectos"];
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
            case 'campos_cultivos':
                /**
                 * $rec = es el arreglo de datos que proviene del formulario, desde el frontend
                 * $$this->item_form = es el arreglo de configuraciòn de datos que se procesaran
                 * $accion = new, update
                 */
                $dato_resultado = $this->procesa_campos_sbm($rec, $this->campos[$que_form], $accion);
                break;

            case 'campos_propietarios_custodios':
                $dato_resultado = $this->procesa_campos_sbm($rec, $this->campos[$que_form], $accion);
                break;

            case 'otros_formularios':
                break;
        }
        return $dato_resultado;
    }

    /**
     * Función que recupera especies
     **/
    function getEspecies() {
        global $db_conf_datatable;
        $db_conf = $db_conf_datatable["principal"];
        $dbm = ADONewConnection($db_conf["type"]);
        $dbm->Connect($db_conf["server"],$db_conf["user"] ,$db_conf["password"],$db_conf["database"]) or die("ERROR CONNECT " . $db_conf["database"]);
        $dbm->setCharset('utf8');
        $dbm->SetFetchMode(ADODB_FETCH_ASSOC);
        $sql = "SELECT itemId, nombre_comun AS nombre 
        FROM especies 
        ORDER BY itemid ASC";
        $datos = $dbm->Execute($sql);
        $datos = $datos->GetRows();
        $dbm->Close();
        return $datos;
    }

    /**
     * Función que recupera ecotipos
     **/
    function getEcotipos($id) {
        global $db_conf_datatable;
        $db_conf = $db_conf_datatable["principal"];
        $dbm = ADONewConnection($db_conf["type"]);
        $dbm->Connect($db_conf["server"],$db_conf["user"] ,$db_conf["password"],$db_conf["database"]) or die("ERROR CONNECT " . $db_conf["database"]);
        $dbm->setCharset('utf8');
        $dbm->SetFetchMode(ADODB_FETCH_ASSOC);
        $sql = "SELECT itemId, nombre 
        FROM especie_ecotipos 
        WHERE espe_itemid=".$id." 
        ORDER BY itemid ASC";
        $datos = $dbm->Execute($sql);
        $datos = $datos->GetRows();
        $dbm->Close();
        return $datos;
    }

    /**
     * Función que recupera clases de vinculación
     **/
    function getClasesVinculacion($id) {
        global $db_conf_datatable;
        $db_conf = $db_conf_datatable["principal"];
        $dbm = ADONewConnection($db_conf["type"]);
        $dbm->Connect($db_conf["server"],$db_conf["user"] ,$db_conf["password"],$db_conf["database"]) or die("ERROR CONNECT " . $db_conf["database"]);
        $dbm->setCharset('utf8');
        $dbm->SetFetchMode(ADODB_FETCH_ASSOC);
        $sql = "SELECT itemId, nombre 
        FROM catalogo_clases_vinculacion 
        WHERE vincula_itemid=".$id." 
        ORDER BY itemId ASC";
        $datos = $dbm->Execute($sql);
        $datos = $datos->GetRows();
        $dbm->Close();
        return $datos;
    }

    /**
     * Función que recupera el departamento a partir de una coordenada
     **/
    function ubicarDepartamento($lon, $lat){
        global $db_conf_datatable;
        $db_conf = $db_conf_datatable["principal"];
        $dbm = ADONewConnection($db_conf["type"]);
        $dbm->Connect($db_conf["server"],$db_conf["user"] ,$db_conf["password"],$db_conf["database"]) or die("ERROR CONNECT " . $db_conf["database"]);
        $dbm->setCharset('utf8');
        $dbm->SetFetchMode(ADODB_FETCH_ASSOC);
        $sql = "SELECT a.id AS itemId, a.nombre 
        FROM mapa_departamentos a 
        WHERE ST_CONTAINS(a.geom, ST_GeomFromText(CONCAT('POINT(', ".$lon.", ' ', ".$lat.", ')'),4326))";
        $datos = $dbm->Execute($sql);
        $respuesta = $datos->fields;
        $dbm->Close();
        return $respuesta;
    }

    /**
     * Función que recupera el departamento
     **/
    function getDepartamento($id){
        global $db_conf_datatable;
        $db_conf = $db_conf_datatable["principal"];
        $dbm = ADONewConnection($db_conf["type"]);
        $dbm->Connect($db_conf["server"],$db_conf["user"] ,$db_conf["password"],$db_conf["database"]) or die("ERROR CONNECT " . $db_conf["database"]);
        $dbm->setCharset('utf8');
        $dbm->SetFetchMode(ADODB_FETCH_ASSOC);
        $sql = "SELECT a.id AS itemId, a.nombre 
        FROM mapa_departamentos a 
        WHERE a.id=".$id." 
        LIMIT 1";
        $datos = $dbm->Execute($sql);
        $respuesta = $datos->fields;
        $dbm->Close();
        return $respuesta;
    }

    /**
     * Función que recupera el municipio a partir de una coordenada
     **/
    function ubicarMunicipio($lon, $lat) {
        global $db_conf_datatable;
        $db_conf = $db_conf_datatable["principal"];
        $dbm = ADONewConnection($db_conf["type"]);
        $dbm->Connect($db_conf["server"],$db_conf["user"] ,$db_conf["password"],$db_conf["database"]) or die("ERROR CONNECT " . $db_conf["database"]);
        $dbm->setCharset('utf8');
        $dbm->SetFetchMode(ADODB_FETCH_ASSOC);
        $sql = "SELECT a.id AS itemId, a.municipio AS nombre 
        FROM mapa_municipios a 
        WHERE ST_CONTAINS(a.geom, ST_GeomFromText(CONCAT('POINT(', ".$lon.", ' ', ".$lat.", ')'),4326))";
        $datos = $dbm->Execute($sql);
        $respuesta = $datos->fields;
        $dbm->Close();
        return $respuesta;
    }

    /**
     * Función que recupera el municipio
     **/
    function getMunicipio($id) {
        global $db_conf_datatable;
        $db_conf = $db_conf_datatable["principal"];
        $dbm = ADONewConnection($db_conf["type"]);
        $dbm->Connect($db_conf["server"],$db_conf["user"] ,$db_conf["password"],$db_conf["database"]) or die("ERROR CONNECT " . $db_conf["database"]);
        $dbm->setCharset('utf8');
        $dbm->SetFetchMode(ADODB_FETCH_ASSOC);
        $sql = "SELECT a.id AS itemId, a.municipio AS nombre 
        FROM mapa_municipios a 
        WHERE a.id=".$id." 
        LIMIT 1";
        $datos = $dbm->Execute($sql);
        $respuesta = $datos->fields;
        $dbm->Close();
        return $respuesta;
    }

    /**
     * Función que recupera la comunidad
     **/
    function ubicarComunidad($lon, $lat) {
        global $db_conf_datatable;
        $db_conf = $db_conf_datatable["principal"];
        $dbm = ADONewConnection($db_conf["type"]);
        $dbm->Connect($db_conf["server"],$db_conf["user"] ,$db_conf["password"],$db_conf["database"]) or die("ERROR CONNECT " . $db_conf["database"]);
        $dbm->setCharset('utf8');
        $dbm->SetFetchMode(ADODB_FETCH_ASSOC);
        $sql = "SELECT id AS itemId, comunidad AS nombre, 
        ST_Distance(ST_GeomFromText('POINT(".$lon." ".$lat.")',4326), geom) AS distancia 
        FROM mapa_comunidades 
        ORDER by distancia ASC 
        LIMIT 1";
        $datos = $dbm->Execute($sql);
        $respuesta = $datos->fields;
        $dbm->Close();
        return $respuesta;
    }

    /**
     * Función que recupera la macroregión a partir de una coordenada
     **/
    function ubicarMacroregion($lon, $lat) {
        global $db_conf_datatable;
        $db_conf = $db_conf_datatable["principal"];
        $dbm = ADONewConnection($db_conf["type"]);
        $dbm->Connect($db_conf["server"],$db_conf["user"] ,$db_conf["password"],$db_conf["database"]) or die("ERROR CONNECT " . $db_conf["database"]);
        $dbm->setCharset('utf8');
        $dbm->SetFetchMode(ADODB_FETCH_ASSOC);
        $sql = "SELECT id AS itemId, descrip AS nombre 
        FROM mapa_macroregiones 
        WHERE ST_CONTAINS(geom, ST_GeomFromText(CONCAT('POINT(', ".$lon.", ' ', ".$lat.", ')'),4326))";
        $datos = $dbm->Execute($sql);
        $respuesta = $datos->fields;
        $dbm->Close();
        return $respuesta;
    }

    /**
     * Función que recupera la macroregión
     **/
    function getMacroregion($id) {
        global $db_conf_datatable;
        $db_conf = $db_conf_datatable["principal"];
        $dbm = ADONewConnection($db_conf["type"]);
        $dbm->Connect($db_conf["server"],$db_conf["user"] ,$db_conf["password"],$db_conf["database"]) or die("ERROR CONNECT " . $db_conf["database"]);
        $dbm->setCharset('utf8');
        $dbm->SetFetchMode(ADODB_FETCH_ASSOC);
        $sql = "SELECT id AS itemId, descrip AS nombre 
        FROM mapa_macroregiones 
        WHERE id=".$id." 
        LIMIT 1";
        $datos = $dbm->Execute($sql);
        $respuesta = $datos->fields;
        $dbm->Close();
        return $respuesta;
    }

    /**
     * Convierte grados, minutos y segundos (DMS) en grados decimal
     */
    function convertirDmsDecimal($lon_dms, $lat_dms) {
        $conversor = new GeoConversao();
        $lon_decimal = $conversor->DMS2Dd($lon_dms);
        $lat_decimal = $conversor->DMS2Dd($lat_dms);
        unset($conversor);
        return array(
            'lon_decimal' => (float) $lon_decimal,
            'lat_decimal' => (float) $lat_decimal
        );
    }

    /**
     * Convierte grados decimal a utm
     */
    function convertirDecimalUtm($lon_decimal, $lat_decimal) {
        $punto = new gPoint("WGS 84");
        $punto->setLongLat($lon_decimal, $lat_decimal);
        $punto->convertLLtoTM();
        $utm_este = $punto->utmEasting;
        $utm_norte = $punto->utmNorthing;
        $utm_zona = $punto->utmZone;
        if ($utm_zona[strlen($utm_zona) - 1] == 'L') {
            $utm_zona = rtrim($utm_zona, 'L');
            $utm_zona = $utm_zona.'K';
        }
        unset($punto);
        return array(
            'utm_este' => (float) round($utm_este, 3),
            'utm_norte' => (float) round($utm_norte, 3),
            'utm_zona' => $utm_zona
        );
    }

    /**
     * Convierte utm a grados decimal
     */
    function convertirUtmDecimal($utm_este, $utm_norte, $utm_zona) {
        $punto = new gPoint("WGS 84");
        $punto->setUTM($utm_este, $utm_norte, $utm_zona);
        $punto->convertTMtoLL();
        $lon_decimal = $punto->long;
        $lat_decimal = $punto->lat;
        unset($punto);
        return array(
            'lon_decimal' => (float) $lon_decimal,
            'lat_decimal' => (float) $lat_decimal
        );
    }

    /**
     * Convierte grados decimal en grados, minutos y segundos (DMS)
     */
    function convertirDecimalDms($lon_decimal, $lat_decimal) {
        $conversor = new GeoConversao();
        $lon_dms = explode('-', $conversor->Dd2DMS($lon_decimal.'o'));
        $lat_dms = explode('-', $conversor->Dd2DMS($lat_decimal.'s'));
        unset($conversor);
        return array(
            'lon_gra' => (int) $lon_dms[0],
            'lon_min' => (int) trim(str_replace('','\u0000', $lon_dms[1])),
            'lon_seg' => (float) round($lon_dms[2], 3),
            'lat_gra' => (int) $lat_dms[0],
            'lat_min' => (int) trim(str_replace('','\u0000', $lat_dms[1])),
            'lat_seg' => (float) round($lat_dms[2], 3)
        );
    }

    function descargarRecurso($id) {
        $item = $this->get_item($id, "cultivo_adjuntos");
        if($item["itemId"] != "") {
            $dir  = $this->get_dir_item_archivo_sbm($item["cult_itemid"]);
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

    /**
     * Función que recupera registro de archivo adjunto
     **/
    function getRowsAdjunto($id){
        global $db_conf_datatable;
        $db_conf = $db_conf_datatable["principal"];
        $dbm = ADONewConnection($db_conf["type"]);
        $dbm->Connect($db_conf["server"],$db_conf["user"] ,$db_conf["password"],$db_conf["database"]) or die("ERROR CONNECT " . $db_conf["database"]);
        $dbm->setCharset('utf8');
        $dbm->SetFetchMode(ADODB_FETCH_ASSOC);
        $sql = "SELECT * 
        FROM cultivo_adjuntos 
        WHERE cult_itemid=".$id." 
        AND estado IN ('foto') 
        LIMIT 1";
        $datos = $dbm->Execute($sql);
        $respuesta = $datos->GetRows();
        $dbm->Close();
        return $respuesta;
    }

}