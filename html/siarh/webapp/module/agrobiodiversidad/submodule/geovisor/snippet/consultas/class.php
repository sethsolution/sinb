<?php
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Settings;

class Snippet extends Table {
    
    function __construct() {
        /**
         * Inicializamos todas las librerias y variables para el submodulo
         */
        $this->submodule_init_sbm();
    }

    /**
     * Función que recupera datos de cultivos
     **/
    function getCultivos($macroregion, $depto) {
        $sqlWhereMacroregion = '';
        $sqlWhereDepto = '';
        $cont = 0;
        if (count($macroregion) > 0) {
            $cont++;
            $sqlWhereMacroregion = 'WHERE e.id IN ('.$this->prepararSqlIn($macroregion).') ';
        }
        if (count($depto) > 0) {
            if ($cont == 0) {
                $cont++;
                $sqlWhereDepto = 'WHERE c.id IN ('.$this->prepararSqlIn($depto).') ';
            } else {
                $sqlWhereDepto = ' AND c.id IN ('.$this->prepararSqlIn($depto).') ';
            }
        }
        global $db_conf_datatable;
        $db_conf = $db_conf_datatable["principal"];
        $dbm = ADONewConnection($db_conf["type"]);
        $dbm->Connect($db_conf["server"],$db_conf["user"] ,$db_conf["password"],$db_conf["database"]) or die("ERROR CONNECT " . $db_conf["database"]);
        $dbm->setCharset('utf8');
        $dbm->SetFetchMode(ADODB_FETCH_ASSOC);
        $sql = "SELECT a.itemId, 
        b.nombre_comun, 
        b.nombre_cientifico, 
        f.nombre AS vinculacion, 
        a.superficie, 
        a.superficie_amplia,  
        a.utm_este, 
        a.utm_norte, 
        a.utm_zona, 
        a.longitud, 
        a.latitud, 
        a.altitud, 
        a.comunidad, 
        a.zona,  
        c.nombre AS depto, 
        d.municipio, 
        e.descrip AS macroregion, 
        g.prod_nombres_apellidos AS productor, 
        g.cus_nombres_apellidos AS custodio, 
        h.itemId AS fotoId 
        FROM cultivos a 
        INNER JOIN especies b 
        ON (a.espe_itemid=b.itemId) 
        INNER JOIN mapa_departamentos c 
        ON (a.depto_itemid=c.id) 
        INNER JOIN mapa_municipios d 
        ON (a.municipio_itemid=d.id) 
        INNER JOIN mapa_macroregiones e 
        ON (a.macroreg_itemid=e.id) 
        INNER JOIN catalogo_vinculaciones f 
        ON (a.vincula_itemid=f.itemId) 
        LEFT JOIN cultivo_productores_custodios g 
        ON (a.itemId=g.itemId) 
        LEFT OUTER JOIN cultivo_adjuntos h 
        ON (a.itemId=h.cult_itemid AND h.estado='foto') "
        .$sqlWhereMacroregion
        .$sqlWhereDepto;
        $datos = $dbm->Execute($sql);
        $datos = $datos->GetRows();
        $dbm->Close();
        return $datos;
    }

    /**
     * Función que contruye un objeto GeoJSON
     **/
    function get_formato_geojson($datos) {
        $coordenadasFuenteInfo = array(
           'type'      => 'FeatureCollection',
           'features'  => array()
        );
        foreach ($datos as $clave => $valor) {
            $feature = array(
                'id' => $valor['itemId'],
                'type' => 'Feature', 
                'properties' => array(
                    'itemId' => $valor['itemId'],
                    'nombre_comun' => $valor['nombre_comun'],
                    'nombre_cientifico' => $valor['nombre_cientifico'],
                    'vinculacion' => $valor['vinculacion'],
                    'superficie' => $valor['superficie'],
                    'depto' => $valor['depto'],
                    'municipio' => $valor['municipio'],
                    'macroregion' => $valor['macroregion'],
                    'comunidad' => $valor['comunidad'],
                    'zona' => $valor['zona'],
                    'utm_este' => $valor['utm_este'],
                    'utm_norte' => $valor['utm_norte'],
                    'utm_zona' => $valor['utm_zona'],
                    'longitud' => $valor['longitud'],
                    'latitud' => $valor['latitud'],
                    'productor' => $valor['productor'],
                    'custodio' => $valor['custodio'],
                    'fotoId' => $valor['fotoId']
                ),
                  'geometry' => array(
                    'type' => 'Point',
                    'coordinates' => array($valor['longitud'], $valor['latitud'])
                  )
                );
            array_push($coordenadasFuenteInfo['features'], $feature);
        }
        return json_encode($coordenadasFuenteInfo, JSON_NUMERIC_CHECK);
    }

    /**
     * Función que recupera datos de alimentos
     **/
    function getEspecies($macroregion, $depto) {
        $sqlWhereMacroregion = '';
        $sqlWhereDepto = '';
        $cont = 0;
        if (count($macroregion) > 0) {
            $cont++;
            $sqlWhereMacroregion = 'WHERE t4.id IN ('.$this->prepararSqlIn($macroregion).') ';
        }
        if (count($depto) != 0) {
            $sqlWhereDepto = ' AND d.id IN ('.$this->prepararSqlIn($depto).') ';
        }
        global $db_conf_datatable;
        $db_conf = $db_conf_datatable["principal"];
        $dbm = ADONewConnection($db_conf["type"]);
        $dbm->Connect($db_conf["server"],$db_conf["user"] ,$db_conf["password"],$db_conf["database"]) or die("ERROR CONNECT " . $db_conf["database"]);
        $dbm->setCharset('utf8');
        $dbm->SetFetchMode(ADODB_FETCH_ASSOC);
        $sql = "SELECT t.*, d.id AS depto_itemid, d.nombre AS depto  
        FROM mapa_departamentos d, 
        (
            SELECT t1.itemId, 
            t1.nombre_comun, 
            t1.nombre_cientifico, 
            t5.nombre AS categoria, 
            t4.descrip AS macroregion, 
            t3.municipio, 
            ST_X(ST_CENTROID(t3.geom)) AS longitud, 
            ST_Y(ST_CENTROID(t3.geom)) AS latitud, 
            ST_GeomFromText(CONCAT('POINT(', ST_X(ST_CENTROID(t3.geom)), ' ', ST_Y(ST_CENTROID(t3.geom)), ')'),4326) AS geom, 
            t6.itemId AS fotoId 
            FROM especies t1 
            INNER JOIN especie_municipios t2 
            ON (t1.itemId=t2.espe_itemid) 
            INNER JOIN mapa_municipios t3 
            ON (t3.id=t2.municipio_itemid) 
            INNER JOIN mapa_macroregiones t4 
            ON (t4.id=t1.macroreg_itemid) 
            INNER JOIN catalogo_categorias t5 
            ON (t5.itemId=t1.cat_itemid) 
            LEFT OUTER JOIN especie_adjuntos t6 
            ON (t1.itemId=t6.espe_itemid AND t6.estado='foto') "
            .$sqlWhereMacroregion
            ."
        ) t 
        WHERE ST_CONTAINS(d.geom, t.geom) "
        .$sqlWhereDepto;

        $datos = $dbm->Execute($sql);
        $datos = $datos->GetRows();
        $dbm->Close();
        return $datos;
    }

    /**
     * Función que contruye un objeto GeoJSON
     **/
    function get_formato_geojson_especies($datos) {
        $coordenadasFuenteInfo = array(
           'type'      => 'FeatureCollection',
           'features'  => array()
        );
        foreach ($datos as $clave => $valor) {
            $feature = array(
                'id' => $valor['itemId'],
                'type' => 'Feature', 
                'properties' => array(
                    'itemId' => $valor['itemId'],
                    'nombre_comun' => $valor['nombre_comun'],
                    'nombre_cientifico' => $valor['nombre_cientifico'],
                    'categoria' => $valor['categoria'],
                    'macroregion' => $valor['macroregion'],
                    'municipio' => $valor['municipio'],
                    'longitud' => $valor['longitud'],
                    'latitud' => $valor['latitud'],
                    'fotoId' => $valor['fotoId']
                ),
                  'geometry' => array(
                    'type' => 'Point',
                    'coordinates' => array($valor['longitud'], $valor['latitud'])
                  )
                );
            array_push($coordenadasFuenteInfo['features'], $feature);
        }
        return json_encode($coordenadasFuenteInfo, JSON_NUMERIC_CHECK);
    }

    /**
     * Función que recupera datos de alimentos
     **/
    function getEspeciesNativas($macroregion=null, $depto=null, $municipio=null) {
        $sqlWhereMacroregion = '';
        $sqlWhereDepto = '';
        $sqlWhereMunicipio = '';
        if (!empty($macroregion) && $macroregion != null) {
            $sqlWhereMacroregion = 'WHERE t3.id IN ('.$this->prepararSqlIn($macroregion).') ';
        }
        if (!empty($depto) && $depto != null) {
            if (strpos($sqlWhereMacroregion, 'WHERE') === false) {
                $sqlWhereDepto = 'WHERE t5.id IN ('.$this->prepararSqlIn($depto).') ';
            } else {
                $sqlWhereDepto = ' AND t5.id IN ('.$this->prepararSqlIn($depto).') ';
            }
        }
        if (!empty($municipio) && $municipio != null) {
            $sqlWhereMunicipio = ' AND t7.id IN ('.$this->prepararSqlIn($municipio).') ';
        }
        global $db_conf_datatable;
        $db_conf = $db_conf_datatable["principal"];
        $dbm = ADONewConnection($db_conf["type"]);
        $dbm->Connect($db_conf["server"],$db_conf["user"] ,$db_conf["password"],$db_conf["database"]) or die("ERROR CONNECT " . $db_conf["database"]);
        $dbm->setCharset('utf8');
        $dbm->SetFetchMode(ADODB_FETCH_ASSOC);
        $sql = "SELECT t1.itemId,
        t1.nombre_comun,
        t1.nombre_cientifico,
        t3.descrip AS macroregion,
        t5.nombre AS depto,
        t7.municipio,
        t8.nombre AS categoria_uso,
        ST_X(ST_Centroid(t7.geom)) AS longitud,
        ST_Y(ST_Centroid(t7.geom)) AS latitud
        FROM especies_nativas t1
        INNER JOIN especie_nativa_macroregiones t2
        ON t1.itemId=t2.espenativa_itemid
        INNER JOIN mapa_macroregiones t3
        ON t2.macroreg_itemid=t3.id
        INNER JOIN especie_nativa_deptos t4
        ON t1.itemId=t4.espenativa_itemid
        INNER JOIN mapa_departamentos t5
        ON t4.depto_itemid=t5.id
        INNER JOIN especie_nativa_municipios t6
        ON t1.itemId=t6.espenativa_itemid
        INNER JOIN mapa_municipios t7
        ON t6.municipio_itemid=t7.id
        INNER JOIN catalogo_categorias t8
        ON t1.catuso_itemid=t8.itemId"
        .$sqlWhereMacroregion
        .$sqlWhereDepto
        .$sqlWhereMunicipio;
        $datos = $dbm->Execute($sql);
        $datos = $datos->GetRows();
        $dbm->Close();
        return $datos;
    }

    /**
     * Función que contruye un objeto GeoJSON
     **/
    function get_formato_geojson_especies_nativas($datos) {
        $coordenadasFuenteInfo = array(
           'type'      => 'FeatureCollection',
           'features'  => array()
        );
        foreach ($datos as $clave => $valor) {
            $feature = array(
                'id' => $valor['itemId'],
                'type' => 'Feature', 
                'properties' => array(
                    'itemId' => $valor['itemId'],
                    'nombre_comun' => $valor['nombre_comun'],
                    'nombre_cientifico' => $valor['nombre_cientifico'],
                    'categoria_uso' => $valor['categoria_uso'],
                    'macroregion' => $valor['macroregion'],
                    'municipio' => $valor['municipio'],
                    'longitud' => $valor['longitud'],
                    'latitud' => $valor['latitud']
                ),
                  'geometry' => array(
                    'type' => 'Point',
                    'coordinates' => array($valor['longitud'], $valor['latitud'])
                  )
                );
            array_push($coordenadasFuenteInfo['features'], $feature);
        }
        return json_encode($coordenadasFuenteInfo, JSON_NUMERIC_CHECK);
    }

    /**
     * Función que recupera el total de especies a nivel nacional
     **/
    function getDatosGeneralEspecies() {
        global $db_conf_datatable;
        $db_conf = $db_conf_datatable["principal"];
        $dbm = ADONewConnection($db_conf["type"]);
        $dbm->Connect($db_conf["server"],$db_conf["user"] ,$db_conf["password"],$db_conf["database"]) or die("ERROR CONNECT " . $db_conf["database"]);
        $dbm->setCharset('utf8');
        $dbm->SetFetchMode(ADODB_FETCH_ASSOC);
        $sql = "SELECT LOWER(cat.nombre) AS categoria, 
        CASE WHEN esp.totaL_especies <> 0 THEN esp.totaL_especies ELSE 0 END AS total_especies
        FROM catalogo_categorias cat 
        LEFT OUTER JOIN 
        (
        SELECT cat_itemid, COUNT(*) AS total_especies 
        FROM especies 
        GROUP BY cat_itemid
        ) esp 
        ON (cat.itemid=esp.cat_itemid)";
        $datos = $dbm->Execute($sql);
        $datos = $datos->GetRows();
        $dbm->Close();
        return $datos;
    }

    /**
     * Función que recupera el total de especies a nivel nacional
     * del año actual
     **/
    function getDatosGeneralEspeciesActual() {
        global $db_conf_datatable;
        $db_conf = $db_conf_datatable["principal"];
        $dbm = ADONewConnection($db_conf["type"]);
        $dbm->Connect($db_conf["server"],$db_conf["user"] ,$db_conf["password"],$db_conf["database"]) or die("ERROR CONNECT " . $db_conf["database"]);
        $dbm->setCharset('utf8');
        $dbm->SetFetchMode(ADODB_FETCH_ASSOC);
        $sql = "SELECT COUNT(*) AS total_especies_actual 
        FROM especies e1 INNER JOIN especie_informacion_adicional e2
        ON (e1.itemId=e2.itemId)
        WHERE e2.gestion=YEAR(CURDATE())";
        $datos = $dbm->Execute($sql);
        $datos = $datos->GetRows();
        $dbm->Close();
        return $datos;
    }

    /**
     * Función que recupera el total de cultivos a nivel nacional
     **/
    function getDatosGeneralCultivos() {
        global $db_conf_datatable;
        $db_conf = $db_conf_datatable["principal"];
        $dbm = ADONewConnection($db_conf["type"]);
        $dbm->Connect($db_conf["server"],$db_conf["user"] ,$db_conf["password"],$db_conf["database"]) or die("ERROR CONNECT " . $db_conf["database"]);
        $dbm->setCharset('utf8');
        $dbm->SetFetchMode(ADODB_FETCH_ASSOC);
        $sql = "SELECT depto_itemid, COUNT(*) AS total_cultivos, 
        SUM(superficie + superficie_amplia) AS superficie_total 
        FROM cultivos 
        GROUP BY depto_itemid";
        $datos = $dbm->Execute($sql);
        $datos = $datos->GetRows();
        $dbm->Close();
        return $datos;
    }

    /**
     * Función que recupera el total de cultivos a nivel nacional
     * del año actual
     **/
    function getDatosGeneralCultivosActual() {
        global $db_conf_datatable;
        $db_conf = $db_conf_datatable["principal"];
        $dbm = ADONewConnection($db_conf["type"]);
        $dbm->Connect($db_conf["server"],$db_conf["user"] ,$db_conf["password"],$db_conf["database"]) or die("ERROR CONNECT " . $db_conf["database"]);
        $dbm->setCharset('utf8');
        $dbm->SetFetchMode(ADODB_FETCH_ASSOC);
        $sql = "SELECT COUNT(*) AS total_cultivos_actual 
        FROM cultivos 
        WHERE YEAR(fecha) = YEAR(CURDATE())";
        $datos = $dbm->Execute($sql);
        $datos = $datos->GetRows();
        $dbm->Close();
        return $datos;
    }

    /**
     * Función que recupera el total de documentos a nivel nacional
     **/
    function getDatosGeneralDocumentos() {
        global $db_conf_datatable;
        $db_conf = $db_conf_datatable["principal"];
        $dbm = ADONewConnection($db_conf["type"]);
        $dbm->Connect($db_conf["server"],$db_conf["user"] ,$db_conf["password"],$db_conf["database"]) or die("ERROR CONNECT " . $db_conf["database"]);
        $dbm->setCharset('utf8');
        $dbm->SetFetchMode(ADODB_FETCH_ASSOC);
        $sql = "SELECT COUNT(*) AS total_docs 
        FROM documentos";
        $datos = $dbm->Execute($sql);
        $datos = $datos->GetRows();
        $dbm->Close();
        return $datos;
    }

    /**
     * Función que recupera el total de documentos a nivel nacional
     * del año actual 
     **/
    function getDatosGeneralDocumentosActual() {
        global $db_conf_datatable;
        $db_conf = $db_conf_datatable["principal"];
        $dbm = ADONewConnection($db_conf["type"]);
        $dbm->Connect($db_conf["server"],$db_conf["user"] ,$db_conf["password"],$db_conf["database"]) or die("ERROR CONNECT " . $db_conf["database"]);
        $dbm->setCharset('utf8');
        $dbm->SetFetchMode(ADODB_FETCH_ASSOC);
        $sql = "SELECT COUNT(*) AS total_docs_actual 
        FROM documentos 
        WHERE YEAR(dateCreate)=YEAR(CURDATE())";
        $datos = $dbm->Execute($sql);
        $datos = $datos->GetRows();
        $dbm->Close();
        return $datos;
    }

    /**
     * Función que recupera el total de cultivos de  especies (silvestres y cultivados)
     * por departamento
     **/
    function getDatosDepto($depto) {
        $sqlInDepto = $this->prepararSqlIn($depto);
        global $db_conf_datatable;
        $db_conf = $db_conf_datatable["principal"];
        $dbm = ADONewConnection($db_conf["type"]);
        $dbm->Connect($db_conf["server"],$db_conf["user"] ,$db_conf["password"],$db_conf["database"]) or die("ERROR CONNECT " . $db_conf["database"]);
        $dbm->setCharset('utf8');
        $dbm->SetFetchMode(ADODB_FETCH_ASSOC);
        $sql = "SELECT t1.depto, t1.categoria, COALESCE(t2.total, 0) AS total, 
        COALESCE(t2.total_superficie, 0) AS total_superficie 
        FROM 
        (
            SELECT d.id, d.nombre AS depto, cc.itemId, cc.nombre AS categoria 
            FROM mapa_departamentos d JOIN catalogo_categorias cc 
            WHERE d.id IN (".$sqlInDepto.")
        ) t1 
        LEFT JOIN 
        ( 
            SELECT c.depto_itemid, e.cat_itemid, COUNT(*) AS total, 
            SUM(c.superficie+c.superficie) AS total_superficie 
            FROM especies e 
            INNER JOIN cultivos c 
            ON (e.itemId=c.espe_itemid) 
            LEFT JOIN mapa_departamentos d 
            ON (c.depto_itemid=d.id) 
            WHERE c.depto_itemid IN (".$sqlInDepto.") 
            GROUP BY c.depto_itemid, e.cat_itemid
        ) t2 
        ON (t1.id=t2.depto_itemid AND t1.itemId=t2.cat_itemid) 
        ORDER BY t1.depto, t1.categoria ASC";
        $datos = $dbm->Execute($sql);
        $datos = $datos->GetRows();
        $dbm->Close();
        return $datos;
    }

    /**
     * Función que recupera el total de especies cultivados
     * por departamento
     **/
    function getDatosDeptoEspecie($depto) {
        $sqlInDepto = $this->prepararSqlIn($depto);
        global $db_conf_datatable;
        $db_conf = $db_conf_datatable["principal"];
        $dbm = ADONewConnection($db_conf["type"]);
        $dbm->Connect($db_conf["server"],$db_conf["user"] ,$db_conf["password"],$db_conf["database"]) or die("ERROR CONNECT " . $db_conf["database"]);
        $dbm->setCharset('utf8');
        $dbm->SetFetchMode(ADODB_FETCH_ASSOC);
        $sql = "SELECT e.nombre_comun AS especie, SUM(c.superficie+c.superficie) AS total_superficie 
        FROM especies e 
        INNER JOIN cultivos c 
        ON (e.itemId=c.espe_itemid) 
        WHERE c.depto_itemid IN (".$sqlInDepto.") 
        GROUP BY e.nombre_comun 
        ORDER BY e.nombre_comun ASC";
        $datos = $dbm->Execute($sql);
        $datos = $datos->GetRows();
        $dbm->Close();
        return $datos;
    }

    /**
     * Función que recupera el total de cultivos de  especies (silvestres y cultivados)
     * por departamento
     **/
    function getDatosMacroregion($macroregion) {
        $sqlInMacroregion = $this->prepararSqlIn($macroregion);
        global $db_conf_datatable;
        $db_conf = $db_conf_datatable["principal"];
        $dbm = ADONewConnection($db_conf["type"]);
        $dbm->Connect($db_conf["server"],$db_conf["user"] ,$db_conf["password"],$db_conf["database"]) or die("ERROR CONNECT " . $db_conf["database"]);
        $dbm->setCharset('utf8');
        $dbm->SetFetchMode(ADODB_FETCH_ASSOC);
        $sql = "SELECT t1.macroregion, t1.categoria, COALESCE(t2.total, 0) AS total, 
        COALESCE(t2.total_superficie, 0) AS total_superficie 
        FROM 
        (
            SELECT d.id, d.descrip AS macroregion, cc.itemId, cc.nombre AS categoria 
            FROM mapa_macroregiones d JOIN catalogo_categorias cc 
            WHERE d.id IN (".$sqlInMacroregion.")
        ) t1 
        LEFT JOIN 
        ( 
            SELECT c.macroreg_itemid, e.cat_itemid, COUNT(*) AS total, 
            SUM(c.superficie+c.superficie) AS total_superficie 
            FROM especies e 
            INNER JOIN cultivos c 
            ON (e.itemId=c.espe_itemid) 
            LEFT JOIN mapa_macroregiones d 
            ON (c.macroreg_itemid=d.id) 
            WHERE c.macroreg_itemid IN (".$sqlInMacroregion.") 
            GROUP BY c.macroreg_itemid, e.cat_itemid
        ) t2 
        ON (t1.id=t2.macroreg_itemid AND t1.itemId=t2.cat_itemid) 
        ORDER BY t1.macroregion, t1.categoria ASC";
        $datos = $dbm->Execute($sql);
        $datos = $datos->GetRows();
        $dbm->Close();
        return $datos;
    }

    /**
     * Función que recupera el total de especies cultivados
     * por departamento
     **/
    function getDatosMacroregionEspecie($macroregion) {
        $sqlInMacroregion = $this->prepararSqlIn($macroregion);
        global $db_conf_datatable;
        $db_conf = $db_conf_datatable["principal"];
        $dbm = ADONewConnection($db_conf["type"]);
        $dbm->Connect($db_conf["server"],$db_conf["user"] ,$db_conf["password"],$db_conf["database"]) or die("ERROR CONNECT " . $db_conf["database"]);
        $dbm->setCharset('utf8');
        $dbm->SetFetchMode(ADODB_FETCH_ASSOC);
        $sql = "SELECT e.nombre_comun AS especie, SUM(c.superficie+c.superficie) AS total_superficie 
        FROM especies e 
        INNER JOIN cultivos c 
        ON (e.itemId=c.espe_itemid) 
        WHERE c.macroreg_itemid IN (".$sqlInMacroregion.") 
        GROUP BY e.nombre_comun 
        ORDER BY e.nombre_comun ASC";
        $datos = $dbm->Execute($sql);
        $datos = $datos->GetRows();
        $dbm->Close();
        return $datos;
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
     * Función que recupera datos de tabla mapa_poligonos
     **/
    function getPoligonos() {
        global $db_conf_datatable;
        $db_conf = $db_conf_datatable["principal"];
        $dbm = ADONewConnection($db_conf["type"]);
        $dbm->Connect($db_conf["server"],$db_conf["user"] ,$db_conf["password"],$db_conf["database"]) or die("ERROR CONNECT " . $db_conf["database"]);
        $dbm->setCharset('utf8');
        $dbm->SetFetchMode(ADODB_FETCH_ASSOC);
        $sql = "SELECT itemId, nombre, ST_AsText(geom) As geom 
        FROM mapa_poligonos";
        $datos = $dbm->Execute($sql);
        $datos = $datos->GetRows();
        $dbm->Close();
        return $datos;
    }

    /**
     * Función que contruye un objeto GeoJSON
     * con polígonos
     **/
    function get_formato_geojson_poligonos($datos) {
        $coordenadasFuenteInfo = array(
           'type'      => 'FeatureCollection',
           'features'  => array()
        );
        foreach ($datos as $clave => $valor) {
            $feature = array(
                'id' => $valor['itemId'],
                'type' => 'Feature',
                'properties' => array(
                    'itemId' => $valor['itemId'],
                    'nombre' => utf8_decode($valor['nombre'])
                ),
                'geometry' => array(
                    'type' => 'Polygon',
                    'coordinates' => array($this->convertirPoligonoArreglo($valor['geom']))
                )
            );
            array_push($coordenadasFuenteInfo['features'], $feature);
        }
        return json_encode($coordenadasFuenteInfo, JSON_NUMERIC_CHECK);
    }

    /**
     * Función que convierte string de polígpono en array
     **/
    function convertirPoligonoArreglo($poligono) {
        $geom = array();
        $poligono = rtrim($poligono, '))');
        $poligono = ltrim($poligono, 'POLYGON((');
        $poly = explode(',', $poligono);
        for ($i=0; $i < count($poly); $i++) {
            $geom_coord = explode(' ', trim($poly[$i]));
            $geom[] = array($geom_coord[0], $geom_coord[1]);
        }
        return $geom;
    }

    /**
     * Función que recupera datos de cultivos
     **/
    function getCultivosFiltrado($item) {
        $sqlFiltro = $this->buildSqlFiltroCultivo($item);
        global $db_conf_datatable;
        $db_conf = $db_conf_datatable["principal"];
        $dbm = ADONewConnection($db_conf["type"]);
        $dbm->Connect($db_conf["server"],$db_conf["user"] ,$db_conf["password"],$db_conf["database"]) or die("ERROR CONNECT " . $db_conf["database"]);
        $dbm->setCharset('utf8');
        $dbm->SetFetchMode(ADODB_FETCH_ASSOC);
        $sql = "SELECT a.itemId, 
        b.nombre_comun, 
        b.nombre_cientifico, 
        f.nombre AS vinculacion, 
        a.superficie, 
        a.superficie_amplia, 
        a.utm_este, 
        a.utm_norte, 
        a.utm_zona, 
        a.longitud, 
        a.latitud, 
        a.altitud, 
        a.comunidad, 
        a.zona,  
        c.nombre AS depto, 
        d.municipio, 
        e.descrip AS macroregion, 
        g.prod_nombres_apellidos AS productor, 
        g.cus_nombres_apellidos AS custodio, 
        h.itemId AS fotoId 
        FROM cultivos a 
        INNER JOIN especies b 
        ON (a.espe_itemid=b.itemId) 
        INNER JOIN mapa_departamentos c 
        ON (a.depto_itemid=c.id) 
        INNER JOIN mapa_municipios d 
        ON (a.municipio_itemid=d.id) 
        INNER JOIN mapa_macroregiones e 
        ON (a.macroreg_itemid=e.id) 
        INNER JOIN catalogo_vinculaciones f 
        ON (a.vincula_itemid=f.itemId) 
        LEFT JOIN cultivo_productores_custodios g 
        ON (a.itemId=g.itemId) 
        LEFT OUTER JOIN cultivo_adjuntos h 
        ON (a.itemId=h.cult_itemid AND h.estado='foto') "
        .$sqlFiltro['macroregion']
        .$sqlFiltro['depto']
        .$sqlFiltro['municipio']
        .$sqlFiltro['categoria']
        .$sqlFiltro['especie']
        .$sqlFiltro['especie_asocia_cultivo']
        .$sqlFiltro['vinculacion'];
        $datos = $dbm->Execute($sql);
        $datos = $datos->GetRows();
        $dbm->Close();
        return $datos;
    }

    function buildSqlFiltroCultivo($item) {
        $sqlWhereMacroregion = '';
        $sqlWhereDepto = '';
        $sqlWhereMunicipio = '';
        $sqlWhereCategoria = '';
        $sqlWhereEspecie = '';
        $sqlWhereEspecieAsociaCultivo = '';
        $sqlWhereVinculacion = '';
        $cont = 0;
        if (!empty($item['macroregion'])) {
            $cont++;
            $sqlWhereMacroregion = 'WHERE e.id IN ('.$this->prepararSqlIn($item['macroregion']).') ';
        }
        if (!empty($item['depto'])) {
            if ($cont == 0) {
                $cont++;
                $sqlWhereDepto = 'WHERE c.id IN ('.$this->prepararSqlIn($item['depto']).') ';
            } else {
                $sqlWhereDepto = ' AND c.id IN ('.$this->prepararSqlIn($item['depto']).') ';
            }
        }
        if (!empty($item['municipio'])) {
            if ($cont == 0) {
                $cont++;
                $sqlWhereMunicipio = 'WHERE d.id IN ('.$this->prepararSqlIn($item['municipio']).') ';
            } else {
                $sqlWhereMunicipio = ' AND d.id IN ('.$this->prepararSqlIn($item['municipio']).') ';
            }
        }
        if ($item['categoria'] != '') {
            if ($cont == 0) {
                $cont++;
                $sqlWhereCategoria = 'WHERE b.cat_itemid='.$item['categoria'].' ';
            } else {
                $sqlWhereCategoria = ' AND b.cat_itemid='.$item['categoria'].' ';
            }
        }
        if (!empty($item['especie'])) {
            if ($cont == 0) {
                $cont++;
                $sqlWhereMunicipio = 'WHERE a.espe_itemid IN ('.$this->prepararSqlIn($item['especie']).') ';
            } else {
                $sqlWhereMunicipio = ' AND a.espe_itemid IN ('.$this->prepararSqlIn($item['especie']).') ';
            }
        }
        if ($item['especie_asocia_cultivo'] != '') {
            if ($cont == 0) {
                $cont++;
                $sqlWhereEspecieAsociaCultivo = "WHERE a.especie_asocia_cultivo='".$item['especie_asocia_cultivo']."'";
            } else {
                $sqlWhereEspecieAsociaCultivo = " AND a.especie_asocia_cultivo='".$item['especie_asocia_cultivo']."'";
            }
        }
        if ($item['vinculacion'] != '') {
            if ($cont == 0) {
                $cont++;
                $sqlWhereVinculacion = 'WHERE a.vincula_itemid='.$item['vinculacion'].' ';
            } else {
                $sqlWhereVinculacion = ' AND a.vincula_itemid='.$item['vinculacion'].' ';
            }
        }
        return array(
            'macroregion' => $sqlWhereMacroregion,
            'depto' => $sqlWhereDepto,
            'municipio' => $sqlWhereMunicipio,
            'categoria' => $sqlWhereCategoria,
            'especie' => $sqlWhereEspecie,
            'especie_asocia_cultivo' => $sqlWhereEspecieAsociaCultivo,
            'vinculacion' => $sqlWhereVinculacion
        );
    }

    /**
     * Función que recupera datos de especies
     **/
    function getEspeciesFiltrado($item) {
        $sqlFiltro = $this->buildSqlFiltroEspecie($item);
        global $db_conf_datatable;
        $db_conf = $db_conf_datatable["principal"];
        $dbm = ADONewConnection($db_conf["type"]);
        $dbm->Connect($db_conf["server"],$db_conf["user"] ,$db_conf["password"],$db_conf["database"]) or die("ERROR CONNECT " . $db_conf["database"]);
        $dbm->setCharset('utf8');
        $dbm->SetFetchMode(ADODB_FETCH_ASSOC);
        $sql = "SELECT t.*, d.id AS depto_itemid, d.nombre AS depto  
        FROM mapa_departamentos d, 
        (
            SELECT t1.itemId, 
            t1.nombre_comun, 
            t1.nombre_cientifico, 
            t5.nombre AS categoria, 
            t4.descrip AS macroregion, 
            t3.municipio, 
            ST_X(ST_CENTROID(t3.geom)) AS longitud, 
            ST_Y(ST_CENTROID(t3.geom)) AS latitud, 
            ST_GeomFromText(CONCAT('POINT(', ST_X(ST_CENTROID(t3.geom)), ' ', ST_Y(ST_CENTROID(t3.geom)), ')'),4326) AS geom, 
            t6.itemId AS fotoId 
            FROM especies t1 
            INNER JOIN especie_municipios t2 
            ON (t1.itemId=t2.espe_itemid) 
            INNER JOIN mapa_municipios t3 
            ON (t3.id=t2.municipio_itemid) 
            INNER JOIN mapa_macroregiones t4 
            ON (t4.id=t1.macroreg_itemid) 
            INNER JOIN catalogo_categorias t5 
            ON (t5.itemId=t1.cat_itemid) 
            LEFT OUTER JOIN especie_adjuntos t6 
            ON (t1.itemId=t6.espe_itemid AND t6.estado='foto') "
            .$sqlFiltro['macroregion']
            .$sqlFiltro['municipio']
            .$sqlFiltro['categoria']
            ."
        ) t 
        WHERE ST_CONTAINS(d.geom, t.geom) "
        .$sqlFiltro['depto'];
        $datos = $dbm->Execute($sql);
        $datos = $datos->GetRows();
        $dbm->Close();
        return $datos;
    }

    function buildSqlFiltroEspecie($item) {
        $sqlWhereMacroregion = '';
        $sqlWhereDepto = '';
        $sqlWhereMunicipio = '';
        $sqlWhereCategoria = '';
        $cont = 0;
        if (!empty($item['macroregion'])) {
            $cont++;
            $sqlWhereMacroregion = 'WHERE t4.id IN ('.$this->prepararSqlIn($item['macroregion']).') ';
        }
        if (!empty($item['depto']) ) {
            $sqlWhereDepto = ' AND d.id IN ('.$this->prepararSqlIn($item['depto']).') ';
        }
        if (!empty($item['municipio'])) {
            if ($cont == 0) {
                $cont++;
                $sqlWhereMunicipio = 'WHERE t3.id IN ('.$this->prepararSqlIn($item['municipio']).') ';
            } else {
                $sqlWhereMunicipio = ' AND t3.id IN ('.$this->prepararSqlIn($item['municipio']).') ';
            }
        }
        if ($item['categoria'] != '') {
            if ($cont == 0) {
                $cont++;
                $sqlWhereCategoria = 'WHERE t1.cat_itemid='.$item['categoria'].' ';
            } else {
                $sqlWhereCategoria = ' AND t1.cat_itemid='.$item['categoria'].' ';
            }
        }
        return array(
            'macroregion' => $sqlWhereMacroregion,
            'depto' => $sqlWhereDepto,
            'municipio' => $sqlWhereMunicipio,
            'categoria' => $sqlWhereCategoria,
        );
    }

    /**
     * Función que recupera datos de alimentos
     **/
    function getEspeciesNativasFiltrado($macroregion=null, $depto=null, $municipio=null) {
        $sqlWhereMacroregion = '';
        $sqlWhereDepto = '';
        $sqlWhereMunicipio = '';
        if (!empty($macroregion) && $macroregion != null) {
            $sqlWhereMacroregion = 'WHERE t3.id IN ('.$this->prepararSqlIn($macroregion).') ';
        }
        if (!empty($depto) && $depto != null) {
            if (strpos($sqlWhereMacroregion, 'WHERE') === false) {
                $sqlWhereDepto = 'WHERE t5.id IN ('.$this->prepararSqlIn($depto).') ';
            } else {
                $sqlWhereDepto = ' AND t5.id IN ('.$this->prepararSqlIn($depto).') ';
            }
        }
        if (!empty($municipio) && $municipio != null) {
            $sqlWhereMunicipio = ' AND t7.id IN ('.$this->prepararSqlIn($municipio).') ';
        }
        global $db_conf_datatable;
        $db_conf = $db_conf_datatable["principal"];
        $dbm = ADONewConnection($db_conf["type"]);
        $dbm->Connect($db_conf["server"],$db_conf["user"] ,$db_conf["password"],$db_conf["database"]) or die("ERROR CONNECT " . $db_conf["database"]);
        $dbm->setCharset('utf8');
        $dbm->SetFetchMode(ADODB_FETCH_ASSOC);
        $sql = "SELECT t1.itemId, 
        t1.nombre_comun, 
        t1.nombre_cientifico, 
        t3.descrip AS macroregion, 
        t5.nombre AS depto, 
        t7.municipio, 
        t8.nombre AS categoria_uso, 
        ST_X(ST_Centroid(t7.geom)) AS longitud, 
        ST_Y(ST_Centroid(t7.geom)) AS latitud 
        FROM especies_nativas t1 
        INNER JOIN especie_nativa_macroregiones t2 
        ON t1.itemId=t2.espenativa_itemid 
        INNER JOIN mapa_macroregiones t3 
        ON t2.macroreg_itemid=t3.id 
        INNER JOIN especie_nativa_deptos t4 
        ON T1.itemId=t4.espenativa_itemid 
        INNER JOIN mapa_departamentos t5 
        ON t4.depto_itemid=t5.id 
        INNER JOIN especie_nativa_municipios t6 
        ON t1.itemId=t6.espenativa_itemid 
        INNER JOIN mapa_municipios t7 
        ON t6.municipio_itemid=t7.id 
        INNER JOIN catalogo_categorias t8 
        ON t1.catuso_itemid=t8.itemId "
        .$sqlWhereMacroregion
        .$sqlWhereDepto
        .$sqlWhereMunicipio;
        $datos = $dbm->Execute($sql);
        $datos = $datos->GetRows();
        $dbm->Close();
        return $datos;
    }

    /**
     * Función que recupera datos de cultivos por polígono
     **/
    function getCultivosPoligono($id) {
        global $db_conf_datatable;
        $db_conf = $db_conf_datatable["principal"];
        $dbm = ADONewConnection($db_conf["type"]);
        $dbm->Connect($db_conf["server"],$db_conf["user"] ,$db_conf["password"],$db_conf["database"]) or die("ERROR CONNECT " . $db_conf["database"]);
        $dbm->setCharset('utf8');
        $dbm->SetFetchMode(ADODB_FETCH_ASSOC);
        $sql = "SELECT a.itemId, 
        b.nombre_comun, 
        b.nombre_cientifico, 
        f.nombre AS vinculacion, 
        a.superficie, 
        a.superficie_amplia, 
        a.utm_este, 
        a.utm_norte, 
        a.utm_zona, 
        a.longitud, 
        a.latitud, 
        a.altitud, 
        a.comunidad, 
        a.zona,  
        c.nombre AS depto, 
        d.municipio, 
        e.descrip AS macroregion, 
        COALESCE(g.prod_nombres_apellidos, '') AS productor, 
        COALESCE(g.cus_nombres_apellidos, '') AS custodio, 
        h.itemId AS fotoId 
        FROM cultivos a 
        INNER JOIN especies b 
        ON (a.espe_itemid=b.itemId) 
        INNER JOIN mapa_departamentos c 
        ON (a.depto_itemid=c.id) 
        INNER JOIN mapa_municipios d 
        ON (a.municipio_itemid=d.id) 
        INNER JOIN mapa_macroregiones e 
        ON (a.macroreg_itemid=e.id) 
        INNER JOIN catalogo_plan_manejo f 
        ON (a.vincula_itemid=f.itemId) 
        LEFT JOIN cultivo_productores_custodios g 
        ON (a.itemId=g.itemId) 
        LEFT OUTER JOIN cultivo_adjuntos h 
        ON (a.itemId=h.cult_itemid AND h.estado='foto') 
        INNER JOIN mapa_poligonos mp 
        ON (ST_CONTAINS(mp.geom, ST_GeomFromText(CONCAT('POINT(', a.longitud, ' ', a.latitud, ')'),4326))) 
        WhERE mp.itemId=".$id;
        $datos = $dbm->Execute($sql);
        $datos = $datos->GetRows();
        $dbm->Close();
        return $datos;
    }

    /**
     * Función que recupera datos de especies por polígono
     **/
    function getEspeciesPoligono($id) {
        global $db_conf_datatable;
        $db_conf = $db_conf_datatable["principal"];
        $dbm = ADONewConnection($db_conf["type"]);
        $dbm->Connect($db_conf["server"],$db_conf["user"] ,$db_conf["password"],$db_conf["database"]) or die("ERROR CONNECT " . $db_conf["database"]);
        $dbm->setCharset('utf8');
        $dbm->SetFetchMode(ADODB_FETCH_ASSOC);
        $sql = "SELECT t.*, d.id AS depto_itemid, d.nombre AS depto  
        FROM mapa_departamentos d, 
        (
            SELECT t1.itemId, 
            t1.nombre_comun, 
            t1.nombre_cientifico, 
            t5.nombre AS categoria, 
            t4.descrip AS macroregion, 
            t3.municipio, 
            ST_X(ST_CENTROID(t3.geom)) AS longitud, 
            ST_Y(ST_CENTROID(t3.geom)) AS latitud, 
            ST_GeomFromText(CONCAT('POINT(', ST_X(ST_CENTROID(t3.geom)), ' ', ST_Y(ST_CENTROID(t3.geom)), ')'),4326) AS geom, 
            t6.itemId AS fotoId 
            FROM especies t1 
            INNER JOIN especie_municipios t2 
            ON (t1.itemId=t2.espe_itemid) 
            INNER JOIN mapa_municipios t3 
            ON (t3.id=t2.municipio_itemid) 
            INNER JOIN mapa_macroregiones t4 
            ON (t4.id=t1.macroreg_itemid) 
            INNER JOIN catalogo_categorias t5 
            ON (t5.itemId=t1.cat_itemid) 
            LEFT OUTER JOIN especie_adjuntos t6 
            ON (t1.itemId=t6.espe_itemid AND t6.estado='foto') 
        ) t, 
        mapa_poligonos p 
        WHERE ST_CONTAINS(d.geom, t.geom) 
        AND ST_CONTAINS(p.geom, t.geom)
        AND p.itemId=".$id;
        $datos = $dbm->Execute($sql);
        $datos = $datos->GetRows();
        $dbm->Close();
        return $datos;
    }

    /**
     * Función que recupera datos de alimentos
     **/
    function getEspeciesNativasPoligono($id) {
        global $db_conf_datatable;
        $db_conf = $db_conf_datatable["principal"];
        $dbm = ADONewConnection($db_conf["type"]);
        $dbm->Connect($db_conf["server"],$db_conf["user"] ,$db_conf["password"],$db_conf["database"]) or die("ERROR CONNECT " . $db_conf["database"]);
        $dbm->setCharset('utf8');
        $dbm->SetFetchMode(ADODB_FETCH_ASSOC);
        $sql = "SELECT t1.itemId, 
        t1.nombre_comun, 
        t1.nombre_cientifico, 
        t3.descrip AS macroregion, 
        t5.nombre AS depto, 
        t7.municipio, 
        t8.nombre AS categoria_uso, 
        ST_X(ST_Centroid(t7.geom)) AS longitud, 
        ST_Y(ST_Centroid(t7.geom)) AS latitud 
        FROM especies_nativas t1 
        INNER JOIN especie_nativa_macroregiones t2 
        ON t1.itemId=t2.espenativa_itemid 
        INNER JOIN mapa_macroregiones t3 
        ON t2.macroreg_itemid=t3.id 
        INNER JOIN especie_nativa_deptos t4 
        ON T1.itemId=t4.espenativa_itemid 
        INNER JOIN mapa_departamentos t5 
        ON t4.depto_itemid=t5.id 
        INNER JOIN especie_nativa_municipios t6 
        ON t1.itemId=t6.espenativa_itemid 
        INNER JOIN mapa_municipios t7 
        ON t6.municipio_itemid=t7.id 
        INNER JOIN catalogo_categorias t8 
        ON t1.catuso_itemid=t8.itemId
        INNER JOIN mapa_poligonos t9
        ON ST_Contains(t9.geom, t7.geom)
        WHERE t9.itemId=".$id;
        $datos = $dbm->Execute($sql);
        $datos = $datos->GetRows();
        $dbm->Close();
        return $datos;
    }

}