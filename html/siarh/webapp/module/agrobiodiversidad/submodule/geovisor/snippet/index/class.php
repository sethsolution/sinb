<?php
/**
 * Created by PhpStorm.
 * User: henrytaby
 * Date: 3/5/2018
 * Time: 15:23
 */

class Index extends Table {

    function __construct()
    {
        /**
         * Inicializamos todas las librerias y variables para el submodulo
         */
        $this->submodule_init_sbm();
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
     * Función que lista departamentos
     **/
    function getDepartamentos(){
        global $db_conf_datatable;
        $db_conf = $db_conf_datatable["principal"];
        $dbm = ADONewConnection($db_conf["type"]);
        $dbm->Connect($db_conf["server"],$db_conf["user"] ,$db_conf["password"],$db_conf["database"]) or die("ERROR CONNECT " . $db_conf["database"]);
        $dbm->setCharset('utf8');
        $dbm->SetFetchMode(ADODB_FETCH_ASSOC);
        $sql = "SELECT id AS itemId, nombre 
        FROM mapa_departamentos 
        ORDER BY nombre ASC";
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
     * Función que lista especies
     **/
    function getEspecies(){
        global $db_conf_datatable;
        $db_conf = $db_conf_datatable["principal"];
        $dbm = ADONewConnection($db_conf["type"]);
        $dbm->Connect($db_conf["server"],$db_conf["user"] ,$db_conf["password"],$db_conf["database"]) or die("ERROR CONNECT " . $db_conf["database"]);
        $dbm->setCharset('utf8');
        $dbm->SetFetchMode(ADODB_FETCH_ASSOC);
        $sql = "SELECT itemId, nombre_comun AS nombre 
        FROM especies 
        ORDER BY nombre_comun ASC";
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
     * Función que recupera municipios
     **/
    function getMunicipios($deptos) {
        if (empty($deptos)) {
            return array();
        }
        $sqlWhere = $this->prepararSqlIn($deptos);
        global $db_conf_datatable;
        $db_conf = $db_conf_datatable["principal"];
        $dbm = ADONewConnection($db_conf["type"]);
        $dbm->Connect($db_conf["server"],$db_conf["user"] ,$db_conf["password"],$db_conf["database"]) or die("ERROR CONNECT " . $db_conf["database"]);
        $dbm->setCharset('utf8');
        $dbm->SetFetchMode(ADODB_FETCH_ASSOC);
        $sql = "SELECT m.id AS itemId, m.municipio AS nombre 
        FROM mapa_departamentos d INNER JOIN mapa_municipios m 
        ON (ST_CONTAINS(d.geom, m.geom)) 
        WHERE d.id IN (".$sqlWhere.")";
        $datos = $dbm->Execute($sql);
        $datos = $datos->GetRows();
        $dbm->Close();
        return $datos;
    }

    /**
     * Función que guarda un polígono en la
     * tabla mapa_poligonos
     **/
    function guardarPoligono($row){
        global $db_conf_datatable;
        $db_conf = $db_conf_datatable["principal"];
        $dbm = ADONewConnection($db_conf["type"]);
        $dbm->Connect($db_conf["server"],$db_conf["user"] ,$db_conf["password"],$db_conf["database"]) or die("ERROR CONNECT " . $db_conf["database"]);
        $dbm->setCharset('utf8');
        $dbm->SetFetchMode(ADODB_FETCH_ASSOC);
        $sql = "INSERT INTO mapa_poligonos (nombre, geom) VALUES ('"
        .$row['nombre']."', ST_GeomFromText('".$row['geom']."',4326))";
        $datos = $dbm->Execute($sql);
        $dbm->Close();
        if ($datos) {
            return json_encode(array(
                'res' => 1,
                'msg' => 'Registro guardado con éxito.'
                ), JSON_NUMERIC_CHECK);
        } else {
            return json_encode(array(
                'res' => 2,
                'msg' => 'El registro no se pudo guardar.'
                ), JSON_NUMERIC_CHECK);
        }
    }

    /**
     * Función que convierte array en string Multipolígono
     **/
    function convertirArregloPoligono($capa_geom) {
        $geom = '';
        for ($i = 0; $i < count($capa_geom); $i++) {
            $row = $capa_geom[$i][0];
            $geom_row = '(';
            for ($j = 0; $j < count($capa_geom[$i]); $j++) {
                $geom_col = $capa_geom[$i][$j];
                $geom_row .= $geom_col[1].' '.$geom_col[0].',';
            }
            $geom_row .= $row[1].' '.$row[0].',';
            $geom_row = rtrim($geom_row, ',');
            $geom .= $geom_row . '),';
        }
        $geom = 'POLYGON('.rtrim($geom, ',').')';
        //$geom = 'MultiPolygon(('.rtrim($geom, ',').'))';
        return $geom;
    }

    /**
     * Borrar un registro de la base de datos
     */
    function item_delete($id, $campo_referencia, $tabla_referencia) {
        $campo_id=$campo_referencia;
        $where = "";
        $res = $this->item_delete_sbm($id, $campo_id, $this->tabla[$tabla_referencia], $where);
        return $res;
    }

    /**
     * Función que agrupa los valores de un array como un texto en serie
     **/
    function prepararSqlIn($arreglo) {
        $sql = '';
        foreach ($arreglo as $clave => $valor) {
            $sql .= $valor.',';
        }
        $sql = rtrim($sql, ',');
        return $sql;
    }

    /**
     * Función que recupera shapefiles
     **/
    function getShapefiles() {
        global $db_conf_datatable;
        $db_conf = $db_conf_datatable["principal"];
        $dbm = ADONewConnection($db_conf["type"]);
        $dbm->Connect($db_conf["server"],$db_conf["user"] ,$db_conf["password"],$db_conf["database"]) or die("ERROR CONNECT " . $db_conf["database"]);
        $dbm->setCharset('utf8');
        $dbm->SetFetchMode(ADODB_FETCH_ASSOC);
        $sql = "SELECT * FROM shapefiles";
        $datos = $dbm->Execute($sql);
        $datos = $datos->GetRows();
        $dbm->Close();
        $res = array();
        foreach($datos as $indice => $item) {
            $res[] = array(
                $item['itemId'],
                $item['nombre']
            );
        }
        return array('data' => $res);
    }

    function getShapefile($id) {
        global $db_conf_datatable;
        $db_conf = $db_conf_datatable["principal"];
        $dbm = ADONewConnection($db_conf["type"]);
        $dbm->Connect($db_conf["server"],$db_conf["user"] ,$db_conf["password"],$db_conf["database"]) or die("ERROR CONNECT " . $db_conf["database"]);
        $dbm->setCharset('utf8');
        $dbm->SetFetchMode(ADODB_FETCH_ASSOC);
        $sql = "SELECT * FROM shapefiles WHERE itemId=".$id;
        $datos = $dbm->Execute($sql);
        $datos = $datos->fields;
        $dbm->Close();
        return $datos;
    }

    function descargarShapefile($id) {
        $item = $this->getShapefile($id);
        if($item["itemId"] != "") {
            $dir  = $this->get_dir_item_archivo_sbm($item["itemId"]);
            $dir = str_replace("geovisor", "shapefiles", $dir);
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
            echo "El archivo no existe.";
            exit;
        }
    }

}
