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
     * Función que obtiene permisos de usuario
     **/
    function getUserPermisos($privFace){
        $permisos = $this->getUser($_SESSION['userv']['itemId']);
        if (empty($permisos)) {
            $privFace['crear'] = 0;
            $privFace['editar'] = 0;
            $privFace['eliminar'] = 0;
        } else {
            $privFace['crear'] = $permisos[0]['crear'];
            $privFace['editar'] = $permisos[0]['editar'];
            $privFace['eliminar'] = $permisos[0]['eliminar'];
        }
        return $privFace;
    }

    /**
     * Función que obtiene permisos de usuario
     **/
    function getUser($id){
        global $db_conf_datatable;
        $db_conf = $db_conf_datatable["principal"];
        $dbm = ADONewConnection($db_conf["type"]);
        $dbm->Connect($db_conf["server"],$db_conf["user"] ,$db_conf["password"],$db_conf["database"]) or die("ERROR CONNECT " . $db_conf["database"]);
        $dbm->setCharset('utf8');
        $dbm->SetFetchMode(ADODB_FETCH_ASSOC);
        $sql = "SELECT user_itemid, crear, editar, eliminar 
        FROM usuario_permisos 
        WHERE user_itemid=".$id;
        $datos = $dbm->Execute($sql);
        $respuesta = $datos->GetRows();
        $dbm->Close();
        return $respuesta;
    }

    /**
     * ================================================================
     * INICIO: FUNCIONES DE ESTADÍSTICA POR DEPARTAMENTOS
     * ================================================================
     **/
    /**
     * Función que obtiene datos de un proyecto
     **/
    function getProyecto($id){
        global $db_conf_datatable;
        $db_conf = $db_conf_datatable["principal"];
        $dbm = ADONewConnection($db_conf["type"]);
        $dbm->Connect($db_conf["server"],$db_conf["user"] ,$db_conf["password"],$db_conf["database"]) or die("ERROR CONNECT " . $db_conf["database"]);
        $dbm->setCharset('utf8');
        $dbm->SetFetchMode(ADODB_FETCH_ASSOC);
        $sql = "SELECT t1.nombre, t1.codigo,
        DATE_FORMAT(t1.fecha_inicio, '%d/%m/%Y') AS fecha_inicio,
        DATE_FORMAT(t1.fecha_final, '%d/%m/%Y') AS fecha_final,
        t2.monto,
        t3.contacto,
		t3.telefono
        FROM proyectos t1
        LEFT JOIN (
        SELECT proy_itemid, SUM(monto) AS monto
        FROM proyecto_financiamiento
        WHERE proy_itemid=".$id."
        ) t2
        ON t1.itemId=t2.proy_itemid
        LEFT JOIN (
            SELECT proy_itemid, contacto, telefono
            FROM proyecto_referencias
            WHERE proy_itemid=".$id."
            ORDER BY itemId ASC
            LIMIT 1
        ) t3
        ON t1.itemId=t3.proy_itemid
        WHERE t1.itemId=".$id;
        $datos = $dbm->Execute($sql);
        $respuesta = $datos->fields;
        $dbm->Close();
        return $respuesta;
    }

    function getProyectoGeneral($fecha_inicio, $fecha_final){
        global $db_conf_datatable;
        $db_conf = $db_conf_datatable["principal"];
        $dbm = ADONewConnection($db_conf["type"]);
        $dbm->Connect($db_conf["server"],$db_conf["user"] ,$db_conf["password"],$db_conf["database"]) or die("ERROR CONNECT " . $db_conf["database"]);
        $dbm->setCharset('utf8');
        $dbm->SetFetchMode(ADODB_FETCH_ASSOC);
        $sql = "SELECT COUNT(*) AS cantidad
        FROM (
        SELECT t3.proy_itemid
        FROM cultivos t1
        INNER JOIN cultivo_proyectos t3
        ON t1.itemId=t3.cult_itemid
        INNER JOIN cultivo_informacion_adicional t4
        ON t1.itemId=t4.itemId
        WHERE 
        (t4.fecha_inicio BETWEEN '".$fecha_inicio."' AND '".$fecha_final."')
        AND (t4.fecha_vigencia BETWEEN '".$fecha_inicio."' AND '".$fecha_final."')
        GROUP BY t3.proy_itemid
        ) ta";
        $datos = $dbm->Execute($sql);
        $respuesta = $datos->fields;
        $dbm->Close();
        return $respuesta;
    }

    /**
     * Función que obtiene datos de departamentos
     **/
    function getDeptos(){
        global $db_conf_datatable;
        $db_conf = $db_conf_datatable["principal"];
        $dbm = ADONewConnection($db_conf["type"]);
        $dbm->Connect($db_conf["server"],$db_conf["user"] ,$db_conf["password"],$db_conf["database"]) or die("ERROR CONNECT " . $db_conf["database"]);
        $dbm->setCharset('utf8');
        $dbm->SetFetchMode(ADODB_FETCH_ASSOC);
        $sql = "SELECT id, nombre
        FROM mapa_departamentos
        ORDER BY nombre ASC";
        $datos = $dbm->Execute($sql);
        $respuesta = $datos->GetRows();
        $dbm->Close();
        return $respuesta;
    }

    /**
     * Función que obtiene datos de especie categorizados
     **/
    function getEstadisticaCategoriaEspecies($id, $fecha_inicio, $fecha_final){
        global $db_conf_datatable;
        $db_conf = $db_conf_datatable["principal"];
        $dbm = ADONewConnection($db_conf["type"]);
        $dbm->Connect($db_conf["server"],$db_conf["user"] ,$db_conf["password"],$db_conf["database"]) or die("ERROR CONNECT " . $db_conf["database"]);
        $dbm->setCharset('utf8');
        $dbm->SetFetchMode(ADODB_FETCH_ASSOC);
        $sql = "SELECT t1.depto_itemid, t2.cat_itemid, COUNT(*) AS cantidad
        FROM cultivos t1
        INNER JOIN especies t2
        ON t1.espe_itemid=t2.itemId
        INNER JOIN cultivo_proyectos t3
        ON t1.itemId=t3.cult_itemid
        INNER JOIN cultivo_informacion_adicional t4
        ON t1.itemId=t4.itemId
        WHERE t3.proy_itemid=".$id."
        AND (t4.fecha_inicio BETWEEN '".$fecha_inicio."' AND '".$fecha_final."')
        AND (t4.fecha_vigencia BETWEEN '".$fecha_inicio."' AND '".$fecha_final."')
        GROUP BY t1.depto_itemid, t2.cat_itemid";
        $datos = $dbm->Execute($sql);
        $respuesta = $datos->GetRows();
        $dbm->Close();
        return $respuesta;
    }

    function getEstadisticaCategoriaEspeciesGeneral($fecha_inicio, $fecha_final){
        global $db_conf_datatable;
        $db_conf = $db_conf_datatable["principal"];
        $dbm = ADONewConnection($db_conf["type"]);
        $dbm->Connect($db_conf["server"],$db_conf["user"] ,$db_conf["password"],$db_conf["database"]) or die("ERROR CONNECT " . $db_conf["database"]);
        $dbm->setCharset('utf8');
        $dbm->SetFetchMode(ADODB_FETCH_ASSOC);
        $sql = "SELECT t1.depto_itemid, t2.cat_itemid, COUNT(*) AS cantidad
        FROM cultivos t1
        INNER JOIN especies t2
        ON t1.espe_itemid=t2.itemId
        INNER JOIN cultivo_proyectos t3
        ON t1.itemId=t3.cult_itemid
        INNER JOIN cultivo_informacion_adicional t4
        ON t1.itemId=t4.itemId
        WHERE (t4.fecha_inicio BETWEEN '".$fecha_inicio."' AND '".$fecha_final."')
        AND (t4.fecha_vigencia BETWEEN '".$fecha_inicio."' AND '".$fecha_final."')
        GROUP BY t1.depto_itemid, t2.cat_itemid";
        $datos = $dbm->Execute($sql);
        $respuesta = $datos->GetRows();
        $dbm->Close();
        return $respuesta;
    }

    /**
     * Función que obtiene datos de poblacion
     **/
    function getEstadisticaPoblacion($id, $fecha_inicio, $fecha_final){
        global $db_conf_datatable;
        $db_conf = $db_conf_datatable["principal"];
        $dbm = ADONewConnection($db_conf["type"]);
        $dbm->Connect($db_conf["server"],$db_conf["user"] ,$db_conf["password"],$db_conf["database"]) or die("ERROR CONNECT " . $db_conf["database"]);
        $dbm->setCharset('utf8');
        $dbm->SetFetchMode(ADODB_FETCH_ASSOC);
        $sql = "SELECT t1.depto_itemid, SUM(t3.cant_hombres) AS cant_hombres, SUM(t3.cant_mujeres) AS cant_mujeres
        FROM cultivos t1
        INNER JOIN cultivo_proyectos t2
        ON t1.itemId=t2.cult_itemid
        INNER JOIN cultivo_informacion_adicional t3
        ON t1.itemId=t3.itemId
        WHERE t2.proy_itemid=".$id."
        AND (t3.fecha_inicio BETWEEN '".$fecha_inicio."' AND '".$fecha_final."')
        AND (t3.fecha_vigencia BETWEEN '".$fecha_inicio."' AND '".$fecha_final."')
        GROUP BY t1.depto_itemid";
        $datos = $dbm->Execute($sql);
        $respuesta = $datos->GetRows();
        $dbm->Close();
        return $respuesta;
    }

    function getEstadisticaPoblacionGeneral($fecha_inicio, $fecha_final){
        global $db_conf_datatable;
        $db_conf = $db_conf_datatable["principal"];
        $dbm = ADONewConnection($db_conf["type"]);
        $dbm->Connect($db_conf["server"],$db_conf["user"] ,$db_conf["password"],$db_conf["database"]) or die("ERROR CONNECT " . $db_conf["database"]);
        $dbm->setCharset('utf8');
        $dbm->SetFetchMode(ADODB_FETCH_ASSOC);
        $sql = "SELECT t1.depto_itemid, SUM(t3.cant_hombres) AS cant_hombres, SUM(t3.cant_mujeres) AS cant_mujeres
        FROM cultivos t1
        INNER JOIN cultivo_proyectos t2
        ON t1.itemId=t2.cult_itemid
        INNER JOIN cultivo_informacion_adicional t3
        ON t1.itemId=t3.itemId
        WHERE (t3.fecha_inicio BETWEEN '".$fecha_inicio."' AND '".$fecha_final."')
        AND (t3.fecha_vigencia BETWEEN '".$fecha_inicio."' AND '".$fecha_final."')
        GROUP BY t1.depto_itemid";
        $datos = $dbm->Execute($sql);
        $respuesta = $datos->GetRows();
        $dbm->Close();
        return $respuesta;
    }

    /**
     * Función que obtiene datos de superficie
     **/
    function getEstadisticaSuperficie($id, $fecha_inicio, $fecha_final){
        global $db_conf_datatable;
        $db_conf = $db_conf_datatable["principal"];
        $dbm = ADONewConnection($db_conf["type"]);
        $dbm->Connect($db_conf["server"],$db_conf["user"] ,$db_conf["password"],$db_conf["database"]) or die("ERROR CONNECT " . $db_conf["database"]);
        $dbm->setCharset('utf8');
        $dbm->SetFetchMode(ADODB_FETCH_ASSOC);
        $sql = "SELECT t1.depto_itemid, SUM(t1.superficie + t1.superficie_amplia) AS superficie
        FROM cultivos t1
        INNER JOIN cultivo_proyectos t2
        ON t1.itemId=t2.cult_itemid
        INNER JOIN cultivo_informacion_adicional t3
        ON t1.itemId=t3.itemId
        WHERE t2.proy_itemid=".$id."
        AND (t3.fecha_inicio BETWEEN '".$fecha_inicio."' AND '".$fecha_final."')
        AND (t3.fecha_vigencia BETWEEN '".$fecha_inicio."' AND '".$fecha_final."')
        GROUP BY t1.depto_itemid";
        $datos = $dbm->Execute($sql);
        $respuesta = $datos->GetRows();
        $dbm->Close();
        return $respuesta;
    }

    function getEstadisticaSuperficieGeneral($fecha_inicio, $fecha_final){
        global $db_conf_datatable;
        $db_conf = $db_conf_datatable["principal"];
        $dbm = ADONewConnection($db_conf["type"]);
        $dbm->Connect($db_conf["server"],$db_conf["user"] ,$db_conf["password"],$db_conf["database"]) or die("ERROR CONNECT " . $db_conf["database"]);
        $dbm->setCharset('utf8');
        $dbm->SetFetchMode(ADODB_FETCH_ASSOC);
        $sql = "SELECT t1.depto_itemid, SUM(t1.superficie + t1.superficie_amplia) AS superficie
        FROM cultivos t1
        INNER JOIN cultivo_proyectos t2
        ON t1.itemId=t2.cult_itemid
        INNER JOIN cultivo_informacion_adicional t3
        ON t1.itemId=t3.itemId
        WHERE (t3.fecha_inicio BETWEEN '".$fecha_inicio."' AND '".$fecha_final."')
        AND (t3.fecha_vigencia BETWEEN '".$fecha_inicio."' AND '".$fecha_final."')
        GROUP BY t1.depto_itemid";
        $datos = $dbm->Execute($sql);
        $respuesta = $datos->GetRows();
        $dbm->Close();
        return $respuesta;
    }

    /**
     * Función que obtiene datos de municipios
     **/
    function getEstadisticaMunicipios($id, $fecha_inicio, $fecha_final){
        global $db_conf_datatable;
        $db_conf = $db_conf_datatable["principal"];
        $dbm = ADONewConnection($db_conf["type"]);
        $dbm->Connect($db_conf["server"],$db_conf["user"] ,$db_conf["password"],$db_conf["database"]) or die("ERROR CONNECT " . $db_conf["database"]);
        $dbm->setCharset('utf8');
        $dbm->SetFetchMode(ADODB_FETCH_ASSOC);
        $sql = "SELECT ta.depto_itemid, SUM(ta.cantidad) AS cantidad
        FROM (
        SELECT t1.depto_itemid, t1.municipio_itemid, COUNT(*) AS cantidad
        FROM cultivos t1
        INNER JOIN cultivo_proyectos t2
        ON t1.itemId=t2.cult_itemid
        INNER JOIN cultivo_informacion_adicional t3
        ON t1.itemId=t3.itemId
        WHERE t2.proy_itemid=".$id."
        AND (t3.fecha_inicio BETWEEN '".$fecha_inicio."' AND '".$fecha_final."')
        AND (t3.fecha_vigencia BETWEEN '".$fecha_inicio."' AND '".$fecha_final."')
        GROUP BY t1.depto_itemid, t1.municipio_itemid
        ) ta
        GROUP BY ta.depto_itemid";
        $datos = $dbm->Execute($sql);
        $respuesta = $datos->GetRows();
        $dbm->Close();
        return $respuesta;
    }

    function getEstadisticaMunicipiosGeneral($fecha_inicio, $fecha_final){
        global $db_conf_datatable;
        $db_conf = $db_conf_datatable["principal"];
        $dbm = ADONewConnection($db_conf["type"]);
        $dbm->Connect($db_conf["server"],$db_conf["user"] ,$db_conf["password"],$db_conf["database"]) or die("ERROR CONNECT " . $db_conf["database"]);
        $dbm->setCharset('utf8');
        $dbm->SetFetchMode(ADODB_FETCH_ASSOC);
        $sql = "SELECT ta.depto_itemid, SUM(ta.cantidad) AS cantidad
        FROM (
        SELECT t1.depto_itemid, t1.municipio_itemid, COUNT(*) AS cantidad
        FROM cultivos t1
        INNER JOIN cultivo_proyectos t2
        ON t1.itemId=t2.cult_itemid
        INNER JOIN cultivo_informacion_adicional t3
        ON t1.itemId=t3.itemId
        WHERE (t3.fecha_inicio BETWEEN '".$fecha_inicio."' AND '".$fecha_final."')
        AND (t3.fecha_vigencia BETWEEN '".$fecha_inicio."' AND '".$fecha_final."')
        GROUP BY t1.depto_itemid, t1.municipio_itemid
        ) ta
        GROUP BY ta.depto_itemid";
        $datos = $dbm->Execute($sql);
        $respuesta = $datos->GetRows();
        $dbm->Close();
        return $respuesta;
    }

    /**
     * Función que obtiene datos de municipios
     **/
    function getEstadisticaComunidades($id, $fecha_inicio, $fecha_final){
        global $db_conf_datatable;
        $db_conf = $db_conf_datatable["principal"];
        $dbm = ADONewConnection($db_conf["type"]);
        $dbm->Connect($db_conf["server"],$db_conf["user"] ,$db_conf["password"],$db_conf["database"]) or die("ERROR CONNECT " . $db_conf["database"]);
        $dbm->setCharset('utf8');
        $dbm->SetFetchMode(ADODB_FETCH_ASSOC);
        $sql = "SELECT ta.depto_itemid, SUM(ta.cantidad) AS cantidad
        FROM (
        SELECT t1.depto_itemid, t1.comunidad, COUNT(*) AS cantidad
        FROM cultivos t1
        INNER JOIN cultivo_proyectos t2
        ON t1.itemId=t2.cult_itemid
        INNER JOIN cultivo_informacion_adicional t3
        ON t1.itemId=t3.itemId
        WHERE t2.proy_itemid=".$id."
        AND (t3.fecha_inicio BETWEEN '".$fecha_inicio."' AND '".$fecha_final."')
        AND (t3.fecha_vigencia BETWEEN '".$fecha_inicio."' AND '".$fecha_final."')
        GROUP BY t1.depto_itemid, t1.comunidad
        ) ta
        GROUP BY ta.depto_itemid";
        $datos = $dbm->Execute($sql);
        $respuesta = $datos->GetRows();
        $dbm->Close();
        return $respuesta;
    }

    function getEstadisticaComunidadesGeneral($fecha_inicio, $fecha_final){
        global $db_conf_datatable;
        $db_conf = $db_conf_datatable["principal"];
        $dbm = ADONewConnection($db_conf["type"]);
        $dbm->Connect($db_conf["server"],$db_conf["user"] ,$db_conf["password"],$db_conf["database"]) or die("ERROR CONNECT " . $db_conf["database"]);
        $dbm->setCharset('utf8');
        $dbm->SetFetchMode(ADODB_FETCH_ASSOC);
        $sql = "SELECT ta.depto_itemid, SUM(ta.cantidad) AS cantidad
        FROM (
        SELECT t1.depto_itemid, t1.comunidad, COUNT(*) AS cantidad
        FROM cultivos t1
        INNER JOIN cultivo_proyectos t2
        ON t1.itemId=t2.cult_itemid
        INNER JOIN cultivo_informacion_adicional t3
        ON t1.itemId=t3.itemId
        WHERE (t3.fecha_inicio BETWEEN '".$fecha_inicio."' AND '".$fecha_final."')
        AND (t3.fecha_vigencia BETWEEN '".$fecha_inicio."' AND '".$fecha_final."')
        GROUP BY t1.depto_itemid, t1.comunidad
        ) ta
        GROUP BY ta.depto_itemid";
        $datos = $dbm->Execute($sql);
        $respuesta = $datos->GetRows();
        $dbm->Close();
        return $respuesta;
    }
    /**
     * ================================================================
     * FIN: FUNCIONES DE ESTADÍSTICA POR DEPARTAMENTOS
     * ================================================================
     **/

    /**
     * ================================================================
     * INICIO: FUNCIONES DE ESTADÍSTICA PARA METAS
     * ================================================================
     **/

    /**
     * Función que obtiene las metas de proyecto
     **/
    function getMetas($id)
    {
        global $db_conf_datatable;
        $db_conf = $db_conf_datatable["principal"];
        $dbm = ADONewConnection($db_conf["type"]);
        $dbm->Connect($db_conf["server"], $db_conf["user"], $db_conf["password"], $db_conf["database"]) or die("ERROR CONNECT " . $db_conf["database"]);
        $dbm->setCharset('utf8');
        $dbm->SetFetchMode(ADODB_FETCH_ASSOC);
        $sql = "SELECT t1.itemId, t2.nombre AS detalle, t1.meta_itemid, t1.linea_base, t1.meta, 0 AS total, '' AS descrip, t3.itemId AS cat_itemid, t3.nombre AS categoria, 0 AS porcentaje 
        FROM proyecto_metas t1 INNER JOIN catalogo_proyecto_metas t2 
        ON t1.meta_itemid=t2.itemId 
        INNER JOIN catalogo_proyecto_categoria_metas t3 
        ON t2.categoriameta_itemid=t3.itemId 
        WHERE t1.proy_itemid=" . $id . " 
        ORDER BY t3.itemId ASC";
        $datos = $dbm->Execute($sql);
        $respuesta = $datos->GetRows();
        $dbm->Close();
        return $respuesta;
    }

    /**
     * Función que obtiene el número de especies cultivadas
     **/
    function geCantidadEcotipos($id)
    {
        global $db_conf_datatable;
        $db_conf = $db_conf_datatable["principal"];
        $dbm = ADONewConnection($db_conf["type"]);
        $dbm->Connect($db_conf["server"], $db_conf["user"], $db_conf["password"], $db_conf["database"]) or die("ERROR CONNECT " . $db_conf["database"]);
        $dbm->setCharset('utf8');
        $dbm->SetFetchMode(ADODB_FETCH_ASSOC);
        $sql = "SELECT COUNT(*) AS cantidad
        FROM especie_ecotipos t1
        INNER JOIN especie_proyectos t2
        ON t1.espe_itemid=t2.espe_itemid
        WHERE t2.proy_itemid=" . $id;
        $datos = $dbm->Execute($sql);
        $respuesta = $datos->GetRows();
        $dbm->Close();

        $total = $respuesta[0]['cantidad'];
        $descrip = 'Cantidad total de ecotipos';
        return array(
            'descrip' => $descrip,
            'total' => $total
        );
    }

    /**
     * Función que obtiene el número de especies cultivadas
     **/
    function getEspeciesCultivadas($id)
    {
        global $db_conf_datatable;
        $db_conf = $db_conf_datatable["principal"];
        $dbm = ADONewConnection($db_conf["type"]);
        $dbm->Connect($db_conf["server"], $db_conf["user"], $db_conf["password"], $db_conf["database"]) or die("ERROR CONNECT " . $db_conf["database"]);
        $dbm->setCharset('utf8');
        $dbm->SetFetchMode(ADODB_FETCH_ASSOC);
        $sql = "SELECT COUNT(*) AS cantidad
        FROM especies t1
        INNER JOIN especie_proyectos t2
        ON t1.itemId=t2.espe_itemid
        INNER JOIN proyectos t3
        ON t2.proy_itemid=t3.itemId
        WHERE t1.cat_itemid=2
        AND t3.itemId=" . $id;

        $datos = $dbm->Execute($sql);
        $respuesta = $datos->GetRows();
        $dbm->Close();

        $total = $respuesta[0]['cantidad'];
        $descrip = 'Cantidad total de especies silvestres';
        return array(
            'descrip' => $descrip,
            'total' => $total
        );
    }
    /**
     * Función que obtiene el número de especies silvestres
     **/
    function getEspeciesSilvestres($id)
    {
        global $db_conf_datatable;
        $db_conf = $db_conf_datatable["principal"];
        $dbm = ADONewConnection($db_conf["type"]);
        $dbm->Connect($db_conf["server"], $db_conf["user"], $db_conf["password"], $db_conf["database"]) or die("ERROR CONNECT " . $db_conf["database"]);
        $dbm->setCharset('utf8');
        $dbm->SetFetchMode(ADODB_FETCH_ASSOC);
        $sql = "SELECT COUNT(*) AS cantidad
        FROM especies t1
        INNER JOIN especie_proyectos t2
        ON t1.itemId=t2.espe_itemid
        INNER JOIN proyectos t3
        ON t2.proy_itemid=t3.itemId
        WHERE t1.cat_itemid=1
        AND t3.itemId=" . $id;

        $datos = $dbm->Execute($sql);
        $respuesta = $datos->GetRows();
        $dbm->Close();

        $total = $respuesta[0]['cantidad'];
        $descrip = 'Cantidad total de especies silvestres';
        return array(
            'descrip' => $descrip,
            'total' => $total
        );
    }
    /**
     * Función que obtiene el número de familias
     **/
    function getEspeciesMmaya($id)
    {
        global $db_conf_datatable;
        $db_conf = $db_conf_datatable["principal"];
        $dbm = ADONewConnection($db_conf["type"]);
        $dbm->Connect($db_conf["server"], $db_conf["user"], $db_conf["password"], $db_conf["database"]) or die("ERROR CONNECT " . $db_conf["database"]);
        $dbm->setCharset('utf8');
        $dbm->SetFetchMode(ADODB_FETCH_ASSOC);
        $sql = "SELECT count(*) as cantidad  FROM especies_nativas
                 WHERE codigo_registro <> ''";

        $datos = $dbm->Execute($sql);
        $respuesta = $datos->GetRows();
        $dbm->Close();

        $total = 0;
        $descrip = '';
        foreach ($respuesta as $clave => $valor) {
            //$descrip .= '('.$valor['municipio'].'='.$valor['superficie'].') ';
            $total += $valor['cantidad'];
        }
        return array(
            'descrip' => $descrip,
            'total' => $total
        );
    }
    /**
     * Función que obtiene la cantidad de especies cultivadas con clase de vinculacion in situ
     **/
    function getCultivosInsitu($id)
    {
        global $db_conf_datatable;
        $db_conf = $db_conf_datatable["principal"];
        $dbm = ADONewConnection($db_conf["type"]);
        $dbm->Connect($db_conf["server"], $db_conf["user"], $db_conf["password"], $db_conf["database"]) or die("ERROR CONNECT " . $db_conf["database"]);
        $dbm->setCharset('utf8');
        $dbm->SetFetchMode(ADODB_FETCH_ASSOC);
        $sql = "SELECT count(*) as cantidad  FROM  cultivos C
                inner JOIN cultivo_proyectos CP
                ON C.itemId = CP.cult_itemid
                INNER JOIN catalogo_clases_vinculacion ca
                ON C.vincula_itemid = ca.vincula_itemid
                WHERE ca.nombre LIKE '%In situ%' AND  CP.proy_itemid=" . $id;

        $datos = $dbm->Execute($sql);
        $respuesta = $datos->GetRows();
        $dbm->Close();

        $total = 0;
        $descrip = '';
        foreach ($respuesta as $clave => $valor) {
            //$descrip .= '('.$valor['municipio'].'='.$valor['superficie'].') ';
            $total += $valor['cantidad'];
        }
        return array(
            'descrip' => $descrip,
            'total' => $total
        );
    }
    /**
     * Función que obtiene la cantidad de especies cultivadas con clase de vinculacion in situ
     **/
    function getCultivosExsitu($id)
    {
        global $db_conf_datatable;
        $db_conf = $db_conf_datatable["principal"];
        $dbm = ADONewConnection($db_conf["type"]);
        $dbm->Connect($db_conf["server"], $db_conf["user"], $db_conf["password"], $db_conf["database"]) or die("ERROR CONNECT " . $db_conf["database"]);
        $dbm->setCharset('utf8');
        $dbm->SetFetchMode(ADODB_FETCH_ASSOC);
        $sql = "SELECT count(*) as cantidad  FROM  cultivos C
                inner JOIN cultivo_proyectos CP
                ON C.itemId = CP.cult_itemid
                INNER JOIN catalogo_clases_vinculacion ca
                ON C.vincula_itemid = ca.vincula_itemid
                WHERE ca.nombre LIKE '%Ex situ%' AND  CP.proy_itemid=" . $id;

        $datos = $dbm->Execute($sql);
        $respuesta = $datos->GetRows();
        $dbm->Close();

        $total = 0;
        $descrip = '';
        foreach ($respuesta as $clave => $valor) {
            //$descrip .= '('.$valor['municipio'].'='.$valor['superficie'].') ';
            $total += $valor['cantidad'];
        }
        return array(
            'descrip' => $descrip,
            'total' => $total
        );
    }
    /**
     * Función que obtiene la cantidad de especies cultivadas con clase de vinculacion in situ
     **/
    function getPlanManejoProduccion($id)
    {
        global $db_conf_datatable;
        $db_conf = $db_conf_datatable["principal"];
        $dbm = ADONewConnection($db_conf["type"]);
        $dbm->Connect($db_conf["server"], $db_conf["user"], $db_conf["password"], $db_conf["database"]) or die("ERROR CONNECT " . $db_conf["database"]);
        $dbm->setCharset('utf8');
        $dbm->SetFetchMode(ADODB_FETCH_ASSOC);
        $sql = "SELECT COUNT(*)  as cantidad from cultivos C
        INNER JOIN cultivo_proyectos CP
        ON C.itemId = CP.cult_itemid
        INNER JOIN catalogo_clases_vinculacion ca
        ON C.vincula_itemid = ca.vincula_itemid
        WHERE ca.nombre LIKE '%Plan%' AND  CP.proy_itemid=" . $id;

        $datos = $dbm->Execute($sql);
        $respuesta = $datos->GetRows();
        $dbm->Close();

        $total = 0;
        $descrip = '';
        foreach ($respuesta as $clave => $valor) {
            //$descrip .= '('.$valor['municipio'].'='.$valor['superficie'].') ';
            $total += $valor['cantidad'];
        }
        return array(
            'descrip' => $descrip,
            'total' => $total
        );
    }

    /* Función que obtiene la cantidad de especies cultivadas con clase de vinculacion in situ
    **/
    function getCertificcion($id)
    {
        global $db_conf_datatable;
        $db_conf = $db_conf_datatable["principal"];
        $dbm = ADONewConnection($db_conf["type"]);
        $dbm->Connect($db_conf["server"], $db_conf["user"], $db_conf["password"], $db_conf["database"]) or die("ERROR CONNECT " . $db_conf["database"]);
        $dbm->setCharset('utf8');
        $dbm->SetFetchMode(ADODB_FETCH_ASSOC);
        $sql = "SELECT COUNT(*)  as cantidad from cultivos C
       INNER JOIN cultivo_proyectos CP
       ON C.itemId = CP.cult_itemid
       INNER JOIN catalogo_clases_vinculacion ca
       ON C.vincula_itemid = ca.vincula_itemid
       WHERE ca.nombre LIKE '%Certificación%' AND  CP.proy_itemid=" . $id;

        $datos = $dbm->Execute($sql);
        $respuesta = $datos->GetRows();
        $dbm->Close();

        $total = 0;
        $descrip = '';
        foreach ($respuesta as $clave => $valor) {
            //$descrip .= '('.$valor['municipio'].'='.$valor['superficie'].') ';
            $total += $valor['cantidad'];
        }
        return array(
            'descrip' => $descrip,
            'total' => $total
        );
    }

    /* Función que obtiene la cantidad de especies cultivadas con clase de vinculacion in situ
    **/
    function getSistemaAgroforestal($id)
    {
        global $db_conf_datatable;
        $db_conf = $db_conf_datatable["principal"];
        $dbm = ADONewConnection($db_conf["type"]);
        $dbm->Connect($db_conf["server"], $db_conf["user"], $db_conf["password"], $db_conf["database"]) or die("ERROR CONNECT " . $db_conf["database"]);
        $dbm->setCharset('utf8');
        $dbm->SetFetchMode(ADODB_FETCH_ASSOC);
        $sql = "SELECT COUNT(*)  as cantidad from cultivos C
        INNER JOIN cultivo_proyectos CP
        ON C.itemId = CP.cult_itemid
        INNER JOIN catalogo_clases_vinculacion ca
        ON C.vincula_itemid = ca.vincula_itemid
        WHERE ca.nombre LIKE '%Sistema%' AND  CP.proy_itemid=" . $id;

        $datos = $dbm->Execute($sql);
        $respuesta = $datos->GetRows();
        $dbm->Close();

        $total = 0;
        $descrip = '';
        foreach ($respuesta as $clave => $valor) {
            //$descrip .= '('.$valor['municipio'].'='.$valor['superficie'].') ';
            $total += $valor['cantidad'];
        }
        return array(
            'descrip' => $descrip,
            'total' => $total
        );
    }

    /* Función que obtiene la cantidad de especies cultivadas con clase de vinculacion in situ
    **/
    function getSistgetSistemaFamiliar($id)
    {
        global $db_conf_datatable;
        $db_conf = $db_conf_datatable["principal"];
        $dbm = ADONewConnection($db_conf["type"]);
        $dbm->Connect($db_conf["server"], $db_conf["user"], $db_conf["password"], $db_conf["database"]) or die("ERROR CONNECT " . $db_conf["database"]);
        $dbm->setCharset('utf8');
        $dbm->SetFetchMode(ADODB_FETCH_ASSOC);
        $sql = "SELECT COUNT(*)  as cantidad from cultivos C
        INNER JOIN cultivo_proyectos CP
        ON C.itemId = CP.cult_itemid
        INNER JOIN catalogo_clases_vinculacion ca
        ON C.vincula_itemid = ca.vincula_itemid
        WHERE ca.nombre LIKE '%Cultivo%' AND  CP.proy_itemid=" . $id;

        $datos = $dbm->Execute($sql);
        $respuesta = $datos->GetRows();
        $dbm->Close();

        $total = 0;
        $descrip = '';
        foreach ($respuesta as $clave => $valor) {
            //$descrip .= '('.$valor['municipio'].'='.$valor['superficie'].') ';
            $total += $valor['cantidad'];
        }
        return array(
            'descrip' => $descrip,
            'total' => $total
        );
    }


    /* Función que obtiene la cantidad de especies cultivadas con clase de vinculacion in situ
    **/
    function getRecoleccion($id)
    {
        global $db_conf_datatable;
        $db_conf = $db_conf_datatable["principal"];
        $dbm = ADONewConnection($db_conf["type"]);
        $dbm->Connect($db_conf["server"], $db_conf["user"], $db_conf["password"], $db_conf["database"]) or die("ERROR CONNECT " . $db_conf["database"]);
        $dbm->setCharset('utf8');
        $dbm->SetFetchMode(ADODB_FETCH_ASSOC);
        $sql = "SELECT COUNT(*)  as cantidad from cultivos C
        INNER JOIN cultivo_proyectos CP
        ON C.itemId = CP.cult_itemid
        INNER JOIN catalogo_clases_vinculacion ca
        ON C.vincula_itemid = ca.vincula_itemid
        WHERE ca.nombre LIKE '%Recolección%' AND  CP.proy_itemid=" . $id;

        $datos = $dbm->Execute($sql);
        $respuesta = $datos->GetRows();
        $dbm->Close();

        $total = 0;
        $descrip = '';
        foreach ($respuesta as $clave => $valor) {
            //$descrip .= '('.$valor['municipio'].'='.$valor['superficie'].') ';
            $total += $valor['cantidad'];
        }
        return array(
            'descrip' => $descrip,
            'total' => $total
        );
    }

    /* Función que obtiene la cantidad de especies cultivadas con clase de vinculacion in situ
    **/
    function getTransformacion($id)
    {
        global $db_conf_datatable;
        $db_conf = $db_conf_datatable["principal"];
        $dbm = ADONewConnection($db_conf["type"]);
        $dbm->Connect($db_conf["server"], $db_conf["user"], $db_conf["password"], $db_conf["database"]) or die("ERROR CONNECT " . $db_conf["database"]);
        $dbm->setCharset('utf8');
        $dbm->SetFetchMode(ADODB_FETCH_ASSOC);
        $sql = "SELECT COUNT(*)  as cantidad from cultivos C
        INNER JOIN cultivo_proyectos CP
        ON C.itemId = CP.cult_itemid
        INNER JOIN catalogo_clases_vinculacion ca
        ON C.vincula_itemid = ca.vincula_itemid
        WHERE CP.proy_itemid=" . $id;

        $datos = $dbm->Execute($sql);
        $respuesta = $datos->GetRows();
        $dbm->Close();

        $total = 0;
        $descrip = '';
        foreach ($respuesta as $clave => $valor) {
            //$descrip .= '('.$valor['municipio'].'='.$valor['superficie'].') ';
            $total += $valor['cantidad'];
        }
        return array(
            'descrip' => $descrip,
            'total' => $total
        );
    }
    /* Función que obtiene la cantidad de especies cultivadas con clase de vinculacion in situ
    **/
    function getRegistroSanitario($id)
    {
        global $db_conf_datatable;
        $db_conf = $db_conf_datatable["principal"];
        $dbm = ADONewConnection($db_conf["type"]);
        $dbm->Connect($db_conf["server"], $db_conf["user"], $db_conf["password"], $db_conf["database"]) or die("ERROR CONNECT " . $db_conf["database"]);
        $dbm->setCharset('utf8');
        $dbm->SetFetchMode(ADODB_FETCH_ASSOC);
        $sql = "SELECT COUNT(*)  as cantidad from cultivos C
        INNER JOIN cultivo_proyectos CP
        ON C.itemId = CP.cult_itemid
        INNER JOIN catalogo_clases_vinculacion ca
        ON C.vincula_itemid = ca.vincula_itemid
        WHERE ca.nombre LIKE '%Registro Sanitario%' AND  CP.proy_itemid=" . $id;

        $datos = $dbm->Execute($sql);
        $respuesta = $datos->GetRows();
        $dbm->Close();

        $total = 0;
        $descrip = '';
        foreach ($respuesta as $clave => $valor) {
            //$descrip .= '('.$valor['municipio'].'='.$valor['superficie'].') ';
            $total += $valor['cantidad'];
        }
        return array(
            'descrip' => $descrip,
            'total' => $total
        );
    }


    /* Función que obtiene la suma de superficiecultivadas con clase de vinculacion plan
    **/
    function getSuperficieManejoProduccion($id)
    {
        global $db_conf_datatable;
        $db_conf = $db_conf_datatable["principal"];
        $dbm = ADONewConnection($db_conf["type"]);
        $dbm->Connect($db_conf["server"], $db_conf["user"], $db_conf["password"], $db_conf["database"]) or die("ERROR CONNECT " . $db_conf["database"]);
        $dbm->setCharset('utf8');
        $dbm->SetFetchMode(ADODB_FETCH_ASSOC);
        $sql = "SELECT SUM(superficie + superficie_amplia) AS cantidad  FROM  cultivos C
        inner JOIN cultivo_proyectos CP
        ON C.itemId = CP.cult_itemid
        INNER JOIN catalogo_clases_vinculacion ca
        ON C.vincula_itemid = ca.vincula_itemid
        WHERE ca.nombre LIKE '%Plan%' AND  CP.proy_itemid=" . $id;
        $datos = $dbm->Execute($sql);
        $respuesta = $datos->GetRows();
        $dbm->Close();

        $total = 0;
        $descrip = '';
        foreach ($respuesta as $clave => $valor) {
            $descrip .= '(' . $valor['municipio'] . '=' . $valor['superficie'] . ') ';
            $total += $valor['superficie'];
        }
        return array(
            'descrip' => $descrip,
            'total' => $total
        );
    }


    /* Función que obtiene la suma de superficiecultivadas con clase de vinculacion plan
    **/
    function getSuperficieCertificada($id)
    {
        global $db_conf_datatable;
        $db_conf = $db_conf_datatable["principal"];
        $dbm = ADONewConnection($db_conf["type"]);
        $dbm->Connect($db_conf["server"], $db_conf["user"], $db_conf["password"], $db_conf["database"]) or die("ERROR CONNECT " . $db_conf["database"]);
        $dbm->setCharset('utf8');
        $dbm->SetFetchMode(ADODB_FETCH_ASSOC);
        $sql = "SELECT SUM(superficie + superficie_amplia) AS cantidad  FROM  cultivos C
        inner JOIN cultivo_proyectos CP
        ON C.itemId = CP.cult_itemid
        INNER JOIN catalogo_clases_vinculacion ca
        ON C.vincula_itemid = ca.vincula_itemid
        WHERE ca.nombre LIKE '%certificación%' AND  CP.proy_itemid=" . $id;

        $datos = $dbm->Execute($sql);
        $respuesta = $datos->GetRows();
        $dbm->Close();

        $total = 0;
        $descrip = '';
        foreach ($respuesta as $clave => $valor) {
            //$descrip .= '('.$valor['municipio'].'='.$valor['superficie'].') ';
            $total += $valor['cantidad'];
        }
        return array(
            'descrip' => $descrip,
            'total' => $total
        );
    }

    /* Función que obtiene la suma de superficiecultivadas con clase de vinculacion plan
    **/
    function getSuperficieAgroforestal($id)
    {
        global $db_conf_datatable;
        $db_conf = $db_conf_datatable["principal"];
        $dbm = ADONewConnection($db_conf["type"]);
        $dbm->Connect($db_conf["server"], $db_conf["user"], $db_conf["password"], $db_conf["database"]) or die("ERROR CONNECT " . $db_conf["database"]);
        $dbm->setCharset('utf8');
        $dbm->SetFetchMode(ADODB_FETCH_ASSOC);
        $sql = "SELECT SUM(superficie + superficie_amplia) AS cantidad  FROM  cultivos C
        inner JOIN cultivo_proyectos CP
        ON C.itemId = CP.cult_itemid
        INNER JOIN catalogo_clases_vinculacion ca
        ON C.vincula_itemid = ca.vincula_itemid
        WHERE ca.nombre LIKE '%sistema%' AND  CP.proy_itemid=" . $id;

        $datos = $dbm->Execute($sql);
        $respuesta = $datos->GetRows();
        $dbm->Close();

        $total = 0;
        $descrip = '';
        foreach ($respuesta as $clave => $valor) {
            //$descrip .= '('.$valor['municipio'].'='.$valor['superficie'].') ';
            $total += $valor['cantidad'];
        }
        return array(
            'descrip' => $descrip,
            'total' => $total
        );
    }

    /* Función que obtiene la suma de superficiecultivadas con clase de vinculacion plan
    **/
    function getSuperficieSiembraRecoleccion($id)
    {
        global $db_conf_datatable;
        $db_conf = $db_conf_datatable["principal"];
        $dbm = ADONewConnection($db_conf["type"]);
        $dbm->Connect($db_conf["server"], $db_conf["user"], $db_conf["password"], $db_conf["database"]) or die("ERROR CONNECT " . $db_conf["database"]);
        $dbm->setCharset('utf8');
        $dbm->SetFetchMode(ADODB_FETCH_ASSOC);
        $sql = "SELECT SUM(superficie + superficie_amplia) AS cantidad  FROM  cultivos C
        inner JOIN cultivo_proyectos CP
        ON C.itemId = CP.cult_itemid
        INNER JOIN catalogo_clases_vinculacion ca
        ON C.vincula_itemid = ca.vincula_itemid
        WHERE ca.nombre LIKE '%Siembra o Recolección%' AND  CP.proy_itemid=" . $id;

        $datos = $dbm->Execute($sql);
        $respuesta = $datos->GetRows();
        $dbm->Close();

        $total = 0;
        $descrip = '';
        foreach ($respuesta as $clave => $valor) {
            //$descrip .= '('.$valor['municipio'].'='.$valor['superficie'].') ';
            $total += $valor['cantidad'];
        }
        return array(
            'descrip' => $descrip,
            'total' => $total
        );
    }

    /* Función que obtiene la suma de superficiecultivadas con clase de vinculacion plan
    **/
    function getSuperficietotal($id)
    {
        global $db_conf_datatable;
        $db_conf = $db_conf_datatable["principal"];
        $dbm = ADONewConnection($db_conf["type"]);
        $dbm->Connect($db_conf["server"], $db_conf["user"], $db_conf["password"], $db_conf["database"]) or die("ERROR CONNECT " . $db_conf["database"]);
        $dbm->setCharset('utf8');
        $dbm->SetFetchMode(ADODB_FETCH_ASSOC);
        $sql = "SELECT SUM(superficie + superficie_amplia) AS cantidad  FROM  cultivos C
        inner JOIN cultivo_proyectos CP
        ON C.itemId = CP.cult_itemid
        INNER JOIN catalogo_clases_vinculacion ca
        ON C.vincula_itemid = ca.vincula_itemid
        WHERE  CP.proy_itemid=" . $id;

        $datos = $dbm->Execute($sql);
        $respuesta = $datos->GetRows();
        $dbm->Close();

        $total = 0;
        $descrip = '';
        foreach ($respuesta as $clave => $valor) {
            //$descrip .= '('.$valor['municipio'].'='.$valor['superficie'].') ';
            $total += $valor['cantidad'];
        }
        return array(
            'descrip' => $descrip,
            'total' => $total
        );
    }
    /* Función que obtiene la suma de HOMBRES en conservacion
    **/
    function getConservacionHombres($id)
    {
        global $db_conf_datatable;
        $db_conf = $db_conf_datatable["principal"];
        $dbm = ADONewConnection($db_conf["type"]);
        $dbm->Connect($db_conf["server"], $db_conf["user"], $db_conf["password"], $db_conf["database"]) or die("ERROR CONNECT " . $db_conf["database"]);
        $dbm->setCharset('utf8');
        $dbm->SetFetchMode(ADODB_FETCH_ASSOC);
        $sql = "SELECT SUM(cant_hombres)  as cantidad from cultivo_informacion_adicional CU
        INNER JOIN cultivos C
        ON CU.itemId = C.itemId
        INNER JOIN cultivo_proyectos CP
        ON C.itemId = CP.cult_itemid
        INNER JOIN catalogo_vinculaciones CV
        ON C.vincula_itemid = CV.itemId
        WHERE CV.nombre LIKE '%Conservación%' AND  CP.proy_itemid=" . $id;

        $datos = $dbm->Execute($sql);
        $respuesta = $datos->GetRows();
        $dbm->Close();

        $total = 0;
        $descrip = '';
        foreach ($respuesta as $clave => $valor) {
            //$descrip .= '('.$valor['municipio'].'='.$valor['superficie'].') ';
            $total += $valor['cantidad'];
        }
        return array(
            'descrip' => $descrip,
            'total' => $total
        );
    }

    /* Función que obtiene la suma de MUJERES en conservacion
    **/
    function getConservacionMujeres($id)
    {
        global $db_conf_datatable;
        $db_conf = $db_conf_datatable["principal"];
        $dbm = ADONewConnection($db_conf["type"]);
        $dbm->Connect($db_conf["server"], $db_conf["user"], $db_conf["password"], $db_conf["database"]) or die("ERROR CONNECT " . $db_conf["database"]);
        $dbm->setCharset('utf8');
        $dbm->SetFetchMode(ADODB_FETCH_ASSOC);
        $sql = "SELECT SUM(cant_mujeres)  as cantidad from cultivo_informacion_adicional CU
        INNER JOIN cultivos C
        ON CU.itemId = C.itemId
        INNER JOIN cultivo_proyectos CP
        ON C.itemId = CP.cult_itemid
        INNER JOIN catalogo_vinculaciones CV
        ON C.vincula_itemid = CV.itemId
        WHERE CV.nombre LIKE '%Conservación%' AND  CP.proy_itemid=" . $id;

        $datos = $dbm->Execute($sql);
        $respuesta = $datos->GetRows();
        $dbm->Close();

        $total = 0;
        $descrip = '';
        foreach ($respuesta as $clave => $valor) {
            //$descrip .= '('.$valor['municipio'].'='.$valor['superficie'].') ';
            $total += $valor['cantidad'];
        }
        return array(
            'descrip' => $descrip,
            'total' => $total
        );
    }
    /* Función que obtiene la suma de hombres  en plan
    **/
    function getPlanesHombres($id)
    {
        global $db_conf_datatable;
        $db_conf = $db_conf_datatable["principal"];
        $dbm = ADONewConnection($db_conf["type"]);
        $dbm->Connect($db_conf["server"], $db_conf["user"], $db_conf["password"], $db_conf["database"]) or die("ERROR CONNECT " . $db_conf["database"]);
        $dbm->setCharset('utf8');
        $dbm->SetFetchMode(ADODB_FETCH_ASSOC);
        $sql = "SELECT SUM(cant_hombres)  as cantidad from cultivo_informacion_adicional CU
        INNER JOIN cultivos C
        ON CU.itemId = C.itemId
        INNER JOIN cultivo_proyectos CP
        ON C.itemId = CP.cult_itemid
        INNER JOIN catalogo_vinculaciones CV
        ON C.vincula_itemid = CV.itemId
        WHERE CV.nombre LIKE '%Plan%' AND  CP.proy_itemid=" . $id;

        $datos = $dbm->Execute($sql);
        $respuesta = $datos->GetRows();
        $dbm->Close();

        $total = 0;
        $descrip = '';
        foreach ($respuesta as $clave => $valor) {
            //$descrip .= '('.$valor['municipio'].'='.$valor['superficie'].') ';
            $total += $valor['cantidad'];
        }
        return array(
            'descrip' => $descrip,
            'total' => $total
        );
    }

    /* Función que obtiene la suma de MUJERES en conservacion
    **/
    function getPlanesMujeres($id)
    {
        global $db_conf_datatable;
        $db_conf = $db_conf_datatable["principal"];
        $dbm = ADONewConnection($db_conf["type"]);
        $dbm->Connect($db_conf["server"], $db_conf["user"], $db_conf["password"], $db_conf["database"]) or die("ERROR CONNECT " . $db_conf["database"]);
        $dbm->setCharset('utf8');
        $dbm->SetFetchMode(ADODB_FETCH_ASSOC);
        $sql = "SELECT SUM(cant_mujeres)  as cantidad from cultivo_informacion_adicional CU
        INNER JOIN cultivos C
        ON CU.itemId = C.itemId
        INNER JOIN cultivo_proyectos CP
        ON C.itemId = CP.cult_itemid
        INNER JOIN catalogo_vinculaciones CV
        ON C.vincula_itemid = CV.itemId
        WHERE CV.nombre LIKE '%Plan%' AND  CP.proy_itemid=" . $id;

        $datos = $dbm->Execute($sql);
        $respuesta = $datos->GetRows();
        $dbm->Close();

        $total = 0;
        $descrip = '';
        foreach ($respuesta as $clave => $valor) {
            //$descrip .= '('.$valor['municipio'].'='.$valor['superficie'].') ';
            $total += $valor['cantidad'];
        }
        return array(
            'descrip' => $descrip,
            'total' => $total
        );
    }

    /* Función que obtiene la suma de hombres  en plan
    **/
    function getCertificacionHombres($id)
    {
        global $db_conf_datatable;
        $db_conf = $db_conf_datatable["principal"];
        $dbm = ADONewConnection($db_conf["type"]);
        $dbm->Connect($db_conf["server"], $db_conf["user"], $db_conf["password"], $db_conf["database"]) or die("ERROR CONNECT " . $db_conf["database"]);
        $dbm->setCharset('utf8');
        $dbm->SetFetchMode(ADODB_FETCH_ASSOC);
        $sql = "SELECT SUM(cant_hombres)  as cantidad from cultivo_informacion_adicional CU
        INNER JOIN cultivos C
        ON CU.itemId = C.itemId
        INNER JOIN cultivo_proyectos CP
        ON C.itemId = CP.cult_itemid
        INNER JOIN catalogo_vinculaciones CV
        ON C.vincula_itemid = CV.itemId
        WHERE CV.nombre LIKE '%Certificación%' AND  CP.proy_itemid=" . $id;

        $datos = $dbm->Execute($sql);
        $respuesta = $datos->GetRows();
        $dbm->Close();

        $total = 0;
        $descrip = '';
        foreach ($respuesta as $clave => $valor) {
            //$descrip .= '('.$valor['municipio'].'='.$valor['superficie'].') ';
            $total += $valor['cantidad'];
        }
        return array(
            'descrip' => $descrip,
            'total' => $total
        );
    }

    /* Función que obtiene la suma de MUJERES en conservacion
    **/
    function getCertificacionMujeres($id)
    {
        global $db_conf_datatable;
        $db_conf = $db_conf_datatable["principal"];
        $dbm = ADONewConnection($db_conf["type"]);
        $dbm->Connect($db_conf["server"], $db_conf["user"], $db_conf["password"], $db_conf["database"]) or die("ERROR CONNECT " . $db_conf["database"]);
        $dbm->setCharset('utf8');
        $dbm->SetFetchMode(ADODB_FETCH_ASSOC);
        $sql = "SELECT SUM(cant_mujeres)  as cantidad from cultivo_informacion_adicional CU
        INNER JOIN cultivos C
        ON CU.itemId = C.itemId
        INNER JOIN cultivo_proyectos CP
        ON C.itemId = CP.cult_itemid
        INNER JOIN catalogo_vinculaciones CV
        ON C.vincula_itemid = CV.itemId
        WHERE CV.nombre LIKE '%Certificación%' AND  CP.proy_itemid=" . $id;

        $datos = $dbm->Execute($sql);
        $respuesta = $datos->GetRows();
        $dbm->Close();

        $total = 0;
        $descrip = '';
        foreach ($respuesta as $clave => $valor) {
            //$descrip .= '('.$valor['municipio'].'='.$valor['superficie'].') ';
            $total += $valor['cantidad'];
        }
        return array(
            'descrip' => $descrip,
            'total' => $total
        );
    }



    /* Función que obtiene la suma de hombres  en plan
    **/
    function getAgroforestalHombres($id)
    {
        global $db_conf_datatable;
        $db_conf = $db_conf_datatable["principal"];
        $dbm = ADONewConnection($db_conf["type"]);
        $dbm->Connect($db_conf["server"], $db_conf["user"], $db_conf["password"], $db_conf["database"]) or die("ERROR CONNECT " . $db_conf["database"]);
        $dbm->setCharset('utf8');
        $dbm->SetFetchMode(ADODB_FETCH_ASSOC);
        $sql = "SELECT SUM(cant_hombres)  as cantidad from cultivo_informacion_adicional CU
        INNER JOIN cultivos C
        ON CU.itemId = C.itemId
        INNER JOIN cultivo_proyectos CP
        ON C.itemId = CP.cult_itemid
        INNER JOIN catalogo_vinculaciones CV
        ON C.vincula_itemid = CV.itemId
        WHERE CV.nombre LIKE '%Sistemas%' AND  CP.proy_itemid=" . $id;

        $datos = $dbm->Execute($sql);
        $respuesta = $datos->GetRows();
        $dbm->Close();

        $total = 0;
        $descrip = '';
        foreach ($respuesta as $clave => $valor) {
            //$descrip .= '('.$valor['municipio'].'='.$valor['superficie'].') ';
            $total += $valor['cantidad'];
        }
        return array(
            'descrip' => $descrip,
            'total' => $total
        );
    }

    /* Función que obtiene la suma de MUJERES en conservacion
    **/
    function getAgroforestalMujeres($id)
    {
        global $db_conf_datatable;
        $db_conf = $db_conf_datatable["principal"];
        $dbm = ADONewConnection($db_conf["type"]);
        $dbm->Connect($db_conf["server"], $db_conf["user"], $db_conf["password"], $db_conf["database"]) or die("ERROR CONNECT " . $db_conf["database"]);
        $dbm->setCharset('utf8');
        $dbm->SetFetchMode(ADODB_FETCH_ASSOC);
        $sql = "SELECT SUM(cant_mujeres)  as cantidad from cultivo_informacion_adicional CU
        INNER JOIN cultivos C
        ON CU.itemId = C.itemId
        INNER JOIN cultivo_proyectos CP
        ON C.itemId = CP.cult_itemid
        INNER JOIN catalogo_vinculaciones CV
        ON C.vincula_itemid = CV.itemId
        WHERE CV.nombre LIKE '%Sistemas%' AND  CP.proy_itemid=" . $id;

        $datos = $dbm->Execute($sql);
        $respuesta = $datos->GetRows();
        $dbm->Close();

        $total = 0;
        $descrip = '';
        foreach ($respuesta as $clave => $valor) {
            //$descrip .= '('.$valor['municipio'].'='.$valor['superficie'].') ';
            $total += $valor['cantidad'];
        }
        return array(
            'descrip' => $descrip,
            'total' => $total
        );
    }

    /* Función que obtiene la suma de hombres  en plan
    **/
    function getSiembraRecoleccionHombres($id)
    {
        global $db_conf_datatable;
        $db_conf = $db_conf_datatable["principal"];
        $dbm = ADONewConnection($db_conf["type"]);
        $dbm->Connect($db_conf["server"], $db_conf["user"], $db_conf["password"], $db_conf["database"]) or die("ERROR CONNECT " . $db_conf["database"]);
        $dbm->setCharset('utf8');
        $dbm->SetFetchMode(ADODB_FETCH_ASSOC);
        $sql = "SELECT SUM(cant_hombres)  as cantidad from cultivo_informacion_adicional CU
        INNER JOIN cultivos C
        ON CU.itemId = C.itemId
        INNER JOIN cultivo_proyectos CP
        ON C.itemId = CP.cult_itemid
        INNER JOIN catalogo_vinculaciones CV
        ON C.vincula_itemid = CV.itemId
        WHERE CV.nombre LIKE '%Siembra o recolección%' AND  CP.proy_itemid=" . $id;

        $datos = $dbm->Execute($sql);
        $respuesta = $datos->GetRows();
        $dbm->Close();

        $total = 0;
        $descrip = '';
        foreach ($respuesta as $clave => $valor) {
            //$descrip .= '('.$valor['municipio'].'='.$valor['superficie'].') ';
            $total += $valor['cantidad'];
        }
        return array(
            'descrip' => $descrip,
            'total' => $total
        );
    }

    /* Función que obtiene la suma de MUJERES en conservacion
    **/
    function getSiembraRecoleccionMujeres($id)
    {
        global $db_conf_datatable;
        $db_conf = $db_conf_datatable["principal"];
        $dbm = ADONewConnection($db_conf["type"]);
        $dbm->Connect($db_conf["server"], $db_conf["user"], $db_conf["password"], $db_conf["database"]) or die("ERROR CONNECT " . $db_conf["database"]);
        $dbm->setCharset('utf8');
        $dbm->SetFetchMode(ADODB_FETCH_ASSOC);
        $sql = "SELECT SUM(cant_mujeres)  as cantidad from cultivo_informacion_adicional CU
        INNER JOIN cultivos C
        ON CU.itemId = C.itemId
        INNER JOIN cultivo_proyectos CP
        ON C.itemId = CP.cult_itemid
        INNER JOIN catalogo_vinculaciones CV
        ON C.vincula_itemid = CV.itemId
        WHERE CV.nombre LIKE '%Siembra o recolección%' AND  CP.proy_itemid=" . $id;

        $datos = $dbm->Execute($sql);
        $respuesta = $datos->GetRows();
        $dbm->Close();

        $total = 0;
        $descrip = '';
        foreach ($respuesta as $clave => $valor) {
            //$descrip .= '('.$valor['municipio'].'='.$valor['superficie'].') ';
            $total += $valor['cantidad'];
        }
        return array(
            'descrip' => $descrip,
            'total' => $total
        );
    }


    /* Función que obtiene la suma de hombres  en plan
    **/
    function getEmprendimientosHombres($id)
    {
        global $db_conf_datatable;
        $db_conf = $db_conf_datatable["principal"];
        $dbm = ADONewConnection($db_conf["type"]);
        $dbm->Connect($db_conf["server"], $db_conf["user"], $db_conf["password"], $db_conf["database"]) or die("ERROR CONNECT " . $db_conf["database"]);
        $dbm->setCharset('utf8');
        $dbm->SetFetchMode(ADODB_FETCH_ASSOC);
        $sql = "SELECT SUM(cant_hombres)  as cantidad from cultivo_informacion_adicional CU
        INNER JOIN cultivos C
        ON CU.itemId = C.itemId
        INNER JOIN cultivo_proyectos CP
        ON C.itemId = CP.cult_itemid
        INNER JOIN catalogo_vinculaciones CV
        ON C.vincula_itemid = CV.itemId
        WHERE CV.nombre LIKE '%Transformación%' AND  CP.proy_itemid=" . $id;

        $datos = $dbm->Execute($sql);
        $respuesta = $datos->GetRows();
        $dbm->Close();

        $total = 0;
        $descrip = '';
        foreach ($respuesta as $clave => $valor) {
            //$descrip .= '('.$valor['municipio'].'='.$valor['superficie'].') ';
            $total += $valor['cantidad'];
        }
        return array(
            'descrip' => $descrip,
            'total' => $total
        );
    }

    /* Función que obtiene la suma de MUJERES en conservacion
    **/
    function getEmprendimientosMujeres($id)
    {
        global $db_conf_datatable;
        $db_conf = $db_conf_datatable["principal"];
        $dbm = ADONewConnection($db_conf["type"]);
        $dbm->Connect($db_conf["server"], $db_conf["user"], $db_conf["password"], $db_conf["database"]) or die("ERROR CONNECT " . $db_conf["database"]);
        $dbm->setCharset('utf8');
        $dbm->SetFetchMode(ADODB_FETCH_ASSOC);
        $sql = "SELECT SUM(cant_mujeres)  as cantidad from cultivo_informacion_adicional CU
        INNER JOIN cultivos C
        ON CU.itemId = C.itemId
        INNER JOIN cultivo_proyectos CP
        ON C.itemId = CP.cult_itemid
        INNER JOIN catalogo_vinculaciones CV
        ON C.vincula_itemid = CV.itemId
        WHERE CV.nombre LIKE '%Transformación%' AND  CP.proy_itemid=" . $id;

        $datos = $dbm->Execute($sql);
        $respuesta = $datos->GetRows();
        $dbm->Close();

        $total = 0;
        $descrip = '';
        foreach ($respuesta as $clave => $valor) {
            //$descrip .= '('.$valor['municipio'].'='.$valor['superficie'].') ';
            $total += $valor['cantidad'];
        }
        return array(
            'descrip' => $descrip,
            'total' => $total
        );
    }


    /* Función que obtiene la suma de MUJERES en conservacion
    **/
    function getSemillaConservada($id)
    {
        global $db_conf_datatable;
        $db_conf = $db_conf_datatable["principal"];
        $dbm = ADONewConnection($db_conf["type"]);
        $dbm->Connect($db_conf["server"], $db_conf["user"], $db_conf["password"], $db_conf["database"]) or die("ERROR CONNECT " . $db_conf["database"]);
        $dbm->setCharset('utf8');
        $dbm->SetFetchMode(ADODB_FETCH_ASSOC);
        $sql = "SELECT SUM(cantidad)  as cantidad from cultivos CU
        INNER JOIN cultivo_proyectos CP
        ON CU.itemId = CP.cult_itemid
        INNER JOIN catalogo_vinculaciones CV
        ON CU.vincula_itemid = CV.itemId
        WHERE CV.nombre LIKE '%Conservación%' AND unidad_medida = 'Kg'  CP.proy_itemid=" . $id;

        $datos = $dbm->Execute($sql);
        $respuesta = $datos->GetRows();
        $dbm->Close();

        $total = 0;
        $descrip = '';
        foreach ($respuesta as $clave => $valor) {
            //$descrip .= '('.$valor['municipio'].'='.$valor['superficie'].') ';
            $total += $valor['cantidad'];
        }
        return array(
            'descrip' => $descrip,
            'total' => $total
        );
    }


    /* Función que obtiene la suma de MUJERES en conservacion
    **/
    function getPlantinConservada($id)
    {
        global $db_conf_datatable;
        $db_conf = $db_conf_datatable["principal"];
        $dbm = ADONewConnection($db_conf["type"]);
        $dbm->Connect($db_conf["server"], $db_conf["user"], $db_conf["password"], $db_conf["database"]) or die("ERROR CONNECT " . $db_conf["database"]);
        $dbm->setCharset('utf8');
        $dbm->SetFetchMode(ADODB_FETCH_ASSOC);
        $sql = "SELECT SUM(cantidad)  as cantidad from cultivos CU
        INNER JOIN cultivo_proyectos CP
        ON CU.itemId = CP.cult_itemid
        INNER JOIN catalogo_vinculaciones CV
        ON CU.vincula_itemid = CV.itemId
        WHERE CV.nombre LIKE '%Conservación%' AND unidad_medida = 'Plantín'  CP.proy_itemid=" . $id;

        $datos = $dbm->Execute($sql);
        $respuesta = $datos->GetRows();
        $dbm->Close();

        $total = 0;
        $descrip = '';
        foreach ($respuesta as $clave => $valor) {
            //$descrip .= '('.$valor['municipio'].'='.$valor['superficie'].') ';
            $total += $valor['cantidad'];
        }
        return array(
            'descrip' => $descrip,
            'total' => $total
        );
    }


    /* Función que obtiene la suma de MUJERES en conservacion
    **/
    function getProduccionPlanes($id)
    {
        global $db_conf_datatable;
        $db_conf = $db_conf_datatable["principal"];
        $dbm = ADONewConnection($db_conf["type"]);
        $dbm->Connect($db_conf["server"], $db_conf["user"], $db_conf["password"], $db_conf["database"]) or die("ERROR CONNECT " . $db_conf["database"]);
        $dbm->setCharset('utf8');
        $dbm->SetFetchMode(ADODB_FETCH_ASSOC);
        $sql = "SELECT SUM(cant_recolectada)  as cantidad from cultivos CU
        INNER JOIN cultivo_proyectos CP
        ON CU.itemId = CP.cult_itemid
        INNER JOIN catalogo_vinculaciones CV
        ON CU.vincula_itemid = CV.itemId
        WHERE CV.nombre LIKE '%Planes de Manejo y Certificación%' AND  CP.proy_itemid=" . $id;
        $datos = $dbm->Execute($sql);
        $respuesta = $datos->GetRows();
        $dbm->Close();

        $total = 0;
        $descrip = '';
        foreach ($respuesta as $clave => $valor) {
            //$descrip .= '('.$valor['municipio'].'='.$valor['superficie'].') ';
            $total += $valor['cantidad'];
        }
        return array(
            'descrip' => $descrip,
            'total' => $total
        );
    }
    /* Función que obtiene la suma de MUJERES en conservacion
    **/
    function getProduccionCertificacion($id)
    {
        global $db_conf_datatable;
        $db_conf = $db_conf_datatable["principal"];
        $dbm = ADONewConnection($db_conf["type"]);
        $dbm->Connect($db_conf["server"], $db_conf["user"], $db_conf["password"], $db_conf["database"]) or die("ERROR CONNECT " . $db_conf["database"]);
        $dbm->setCharset('utf8');
        $dbm->SetFetchMode(ADODB_FETCH_ASSOC);
        $sql = "SELECT SUM(cant_recolectada)  as cantidad from cultivos CU
        INNER JOIN cultivo_proyectos CP
        ON CU.itemId = CP.cult_itemid
        INNER JOIN catalogo_vinculaciones CV
        ON CU.vincula_itemid = CV.itemId
        WHERE CV.nombre LIKE '%Planes de Manejo y Certificación%' AND  CP.proy_itemid=" . $id;
        $datos = $dbm->Execute($sql);
        $respuesta = $datos->GetRows();
        $dbm->Close();

        $total = 0;
        $descrip = '';
        foreach ($respuesta as $clave => $valor) {
            //$descrip .= '('.$valor['municipio'].'='.$valor['superficie'].') ';
            $total += $valor['cantidad'];
        }
        return array(
            'descrip' => $descrip,
            'total' => $total
        );
    }


    /* Función que obtiene Cantidad de Producción en Sistemas Agroforestale
    **/
    function getProduccionAgroforestal($id)
    {
        global $db_conf_datatable;
        $db_conf = $db_conf_datatable["principal"];
        $dbm = ADONewConnection($db_conf["type"]);
        $dbm->Connect($db_conf["server"], $db_conf["user"], $db_conf["password"], $db_conf["database"]) or die("ERROR CONNECT " . $db_conf["database"]);
        $dbm->setCharset('utf8');
        $dbm->SetFetchMode(ADODB_FETCH_ASSOC);
        $sql = "SELECT SUM(cant_recolectada)  as cantidad from cultivos CU
        INNER JOIN cultivo_proyectos CP
        ON CU.itemId = CP.cult_itemid
        INNER JOIN catalogo_vinculaciones CV
        ON CU.vincula_itemid = CV.itemId
        WHERE CU.clasevincula_itemid=8 AND CP.proy_itemid=" . $id;
        $datos = $dbm->Execute($sql);
        $respuesta = $datos->GetRows();
        $dbm->Close();

        $total = 0;
        $descrip = '';
        foreach ($respuesta as $clave => $valor) {
            //$descrip .= '('.$valor['municipio'].'='.$valor['superficie'].') ';
            $total += $valor['cantidad'];
        }
        return array(
            'descrip' => $descrip,
            'total' => $total
        );
    }


    /* Función que obtiene Cantidad de Producción en siembra o recolección
    **/
    function getProduccionSiembraRecoleccion($id)
    {
        global $db_conf_datatable;
        $db_conf = $db_conf_datatable["principal"];
        $dbm = ADONewConnection($db_conf["type"]);
        $dbm->Connect($db_conf["server"], $db_conf["user"], $db_conf["password"], $db_conf["database"]) or die("ERROR CONNECT " . $db_conf["database"]);
        $dbm->setCharset('utf8');
        $dbm->SetFetchMode(ADODB_FETCH_ASSOC);
        $sql = "SELECT SUM(cant_recolectada)  as cantidad from cultivos CU
        INNER JOIN cultivo_proyectos CP
        ON CU.itemId = CP.cult_itemid
        INNER JOIN catalogo_vinculaciones CV
        ON CU.vincula_itemid = CV.itemId
        WHERE CU.vincula_itemid=3 AND CP.proy_itemid=" . $id;
        $datos = $dbm->Execute($sql);
        $respuesta = $datos->GetRows();
        $dbm->Close();

        $total = 0;
        $descrip = '';
        foreach ($respuesta as $clave => $valor) {
            //$descrip .= '('.$valor['municipio'].'='.$valor['superficie'].') ';
            $total += $valor['cantidad'];
        }
        return array(
            'descrip' => $descrip,
            'total' => $total
        );
    }

    /* Función que obtiene Cantidad Cantidad para la Venta en Planes
    **/
    function getProduccionVentaPlanes($id)
    {
        global $db_conf_datatable;
        $db_conf = $db_conf_datatable["principal"];
        $dbm = ADONewConnection($db_conf["type"]);
        $dbm->Connect($db_conf["server"], $db_conf["user"], $db_conf["password"], $db_conf["database"]) or die("ERROR CONNECT " . $db_conf["database"]);
        $dbm->setCharset('utf8');
        $dbm->SetFetchMode(ADODB_FETCH_ASSOC);
        $sql = " SELECT SUM(cant_recolectada)  as cantidad from cultivos CU
        INNER JOIN cultivo_proyectos CP
        ON CU.itemId = CP.cult_itemid
        INNER JOIN catalogo_vinculaciones CV
        ON CU.vincula_itemid = CV.itemId
        WHERE CU.vincula_itemid=2 AND CP.proy_itemid=" . $id;
        $datos = $dbm->Execute($sql);
        $respuesta = $datos->GetRows();
        $dbm->Close();

        $total = 0;
        $descrip = '';
        foreach ($respuesta as $clave => $valor) {
            //$descrip .= '('.$valor['municipio'].'='.$valor['superficie'].') ';
            $total += $valor['cantidad'];
        }
        return array(
            'descrip' => $descrip,
            'total' => $total
        );
    }
/* Función que obtiene Cantidad Cantidad para la sistemas agroforestales
    **/
    function getProduccionVentaAgroforestal($id)
    {
        global $db_conf_datatable;
        $db_conf = $db_conf_datatable["principal"];
        $dbm = ADONewConnection($db_conf["type"]);
        $dbm->Connect($db_conf["server"], $db_conf["user"], $db_conf["password"], $db_conf["database"]) or die("ERROR CONNECT " . $db_conf["database"]);
        $dbm->setCharset('utf8');
        $dbm->SetFetchMode(ADODB_FETCH_ASSOC);
        $sql = "SELECT SUM(CU.cant_recolectada * CU.destino_comercia)  as cantidad from cultivos CU
        JOIN cultivo_proyectos CP
        ON CU.itemId = CP.cult_itemid
        JOIN catalogo_clases_vinculacion CV
        ON CU.clasevincula_itemid = CV.itemId
        WHERE CU.clasevincula_itemid = 8 AND CP.proy_itemid=" . $id;
        $datos = $dbm->Execute($sql);
        $respuesta = $datos->GetRows();
        $dbm->Close();

        $total = 0;
        $descrip = '';
        foreach ($respuesta as $clave => $valor) {
            //$descrip .= '('.$valor['municipio'].'='.$valor['superficie'].') ';
            $total += $valor['cantidad'];
        }
        return array(
            'descrip' => $descrip,
            'total' => $total
        );
    }
/* Función que obtiene Cantidad Cantidad para la siembra y recoleccion
    **/
    function getProduccionVentaSiembraRecoleccion($id)
    {
        global $db_conf_datatable;
        $db_conf = $db_conf_datatable["principal"];
        $dbm = ADONewConnection($db_conf["type"]);
        $dbm->Connect($db_conf["server"], $db_conf["user"], $db_conf["password"], $db_conf["database"]) or die("ERROR CONNECT " . $db_conf["database"]);
        $dbm->setCharset('utf8');
        $dbm->SetFetchMode(ADODB_FETCH_ASSOC);
        $sql = "SELECT SUM(CU.cant_recolectada * CU.destino_comercia)  as cantidad from cultivos CU
        JOIN cultivo_proyectos CP
        ON CU.itemId = CP.cult_itemid
        JOIN catalogo_clases_vinculacion CV
        ON CU.clasevincula_itemid = CV.itemId
        WHERE CU.clasevincula_itemid = 10 or CU.clasevincula_itemid = 11 AND CP.proy_itemid=" . $id;
        $datos = $dbm->Execute($sql);
        $respuesta = $datos->GetRows();
        $dbm->Close();

        $total = 0;
        $descrip = '';
        foreach ($respuesta as $clave => $valor) {
            //$descrip .= '('.$valor['municipio'].'='.$valor['superficie'].') ';
            $total += $valor['cantidad'];
        }
        return array(
            'descrip' => $descrip,
            'total' => $total
        );
    }
/* Función que obtiene Comercialización de Producción en Planes [Bs]
    **/
    function getComercializacionPlanes($id)
    {
        global $db_conf_datatable;
        $db_conf = $db_conf_datatable["principal"];
        $dbm = ADONewConnection($db_conf["type"]);
        $dbm->Connect($db_conf["server"], $db_conf["user"], $db_conf["password"], $db_conf["database"]) or die("ERROR CONNECT " . $db_conf["database"]);
        $dbm->setCharset('utf8');
        $dbm->SetFetchMode(ADODB_FETCH_ASSOC);
        $sql = "SELECT SUM(CU.cant_recolectada * CU.destino_comercia * CU.precio_comercia)  as cantidad from cultivos CU
        JOIN cultivo_proyectos CP
        ON CU.itemId = CP.cult_itemid
        JOIN catalogo_clases_vinculacion CV
        ON CU.clasevincula_itemid = CV.itemId
        WHERE CU.clasevincula_itemid =5 or CU.clasevincula_itemid = 6 AND CP.proy_itemid=" . $id;
        $datos = $dbm->Execute($sql);
        $respuesta = $datos->GetRows();
        $dbm->Close();

        $total = 0;
        $descrip = '';
        foreach ($respuesta as $clave => $valor) {
            //$descrip .= '('.$valor['municipio'].'='.$valor['superficie'].') ';
            $total += $valor['cantidad'];
        }
        return array(
            'descrip' => $descrip,
            'total' => $total
        );
    }
    /* Función que obtiene Comercialización de Producción en Certificación [Bs]
    **/
    function getComercializacionCertificacion($id)
    {
        global $db_conf_datatable;
        $db_conf = $db_conf_datatable["principal"];
        $dbm = ADONewConnection($db_conf["type"]);
        $dbm->Connect($db_conf["server"], $db_conf["user"], $db_conf["password"], $db_conf["database"]) or die("ERROR CONNECT " . $db_conf["database"]);
        $dbm->setCharset('utf8');
        $dbm->SetFetchMode(ADODB_FETCH_ASSOC);
        $sql = "SELECT SUM(CU.cant_recolectada * CU.destino_comercia * CU.precio_comercia)  as cantidad from cultivos CU
        JOIN cultivo_proyectos CP
        ON CU.itemId = CP.cult_itemid
        JOIN catalogo_clases_vinculacion CV
        ON CU.clasevincula_itemid = CV.itemId
        WHERE CU.clasevincula_itemid =7 AND CP.proy_itemid=" . $id;
        $datos = $dbm->Execute($sql);
        $respuesta = $datos->GetRows();
        $dbm->Close();

        $total = 0;
        $descrip = '';
        foreach ($respuesta as $clave => $valor) {
            //$descrip .= '('.$valor['municipio'].'='.$valor['superficie'].') ';
            $total += $valor['cantidad'];
        }
        return array(
            'descrip' => $descrip,
            'total' => $total
        );
    }
 /* Función que obtiene Comercialización de Producción en Sistemas Agroforestales [Bs]
    **/
    function getComercializacionAgroforestales($id)
    {
        global $db_conf_datatable;
        $db_conf = $db_conf_datatable["principal"];
        $dbm = ADONewConnection($db_conf["type"]);
        $dbm->Connect($db_conf["server"], $db_conf["user"], $db_conf["password"], $db_conf["database"]) or die("ERROR CONNECT " . $db_conf["database"]);
        $dbm->setCharset('utf8');
        $dbm->SetFetchMode(ADODB_FETCH_ASSOC);
        $sql = "SELECT SUM(CU.cant_recolectada * CU.destino_comercia * CU.precio_comercia)  as cantidad from cultivos CU
        JOIN cultivo_proyectos CP
        ON CU.itemId = CP.cult_itemid
        JOIN catalogo_clases_vinculacion CV
        ON CU.clasevincula_itemid = CV.itemId
        WHERE CU.clasevincula_itemid =8 AND CP.proy_itemid=" . $id;
        $datos = $dbm->Execute($sql);
        $respuesta = $datos->GetRows();
        $dbm->Close();

        $total = 0;
        $descrip = '';
        foreach ($respuesta as $clave => $valor) {
            //$descrip .= '('.$valor['municipio'].'='.$valor['superficie'].') ';
            $total += $valor['cantidad'];
        }
        return array(
            'descrip' => $descrip,
            'total' => $total
        );
    }
/* Función que obtiene Comercialización dProducción en siembra o recolección [Bs]
    **/
    function getComercializacionSiembraRecoleccion($id)
    {
        global $db_conf_datatable;
        $db_conf = $db_conf_datatable["principal"];
        $dbm = ADONewConnection($db_conf["type"]);
        $dbm->Connect($db_conf["server"], $db_conf["user"], $db_conf["password"], $db_conf["database"]) or die("ERROR CONNECT " . $db_conf["database"]);
        $dbm->setCharset('utf8');
        $dbm->SetFetchMode(ADODB_FETCH_ASSOC);
        $sql = "SELECT SUM(CU.cant_recolectada * CU.destino_comercia * CU.precio_comercia)  as cantidad from cultivos CU
        JOIN cultivo_proyectos CP
        ON CU.itemId = CP.cult_itemid
        JOIN catalogo_clases_vinculacion CV
        ON CU.clasevincula_itemid = CV.itemId
        WHERE CU.clasevincula_itemid =10 OR  CU.clasevincula_itemid =11 AND CP.proy_itemid=" . $id;
        $datos = $dbm->Execute($sql);
        $respuesta = $datos->GetRows();
        $dbm->Close();

        $total = 0;
        $descrip = '';
        foreach ($respuesta as $clave => $valor) {
            //$descrip .= '('.$valor['municipio'].'='.$valor['superficie'].') ';
            $total += $valor['cantidad'];
        }
        return array(
            'descrip' => $descrip,
            'total' => $total
        );
    }

    /* Función que obtiene ComercializaciónComercialización de Emprendimientos [Bs]
    **/
    function getComercializacionEmprendimiento($id)
    {
        global $db_conf_datatable;
        $db_conf = $db_conf_datatable["principal"];
        $dbm = ADONewConnection($db_conf["type"]);
        $dbm->Connect($db_conf["server"], $db_conf["user"], $db_conf["password"], $db_conf["database"]) or die("ERROR CONNECT " . $db_conf["database"]);
        $dbm->setCharset('utf8');
        $dbm->SetFetchMode(ADODB_FETCH_ASSOC);
        $sql = "SELECT SUM(CU.cant_recolectada * CU.destino_comercia * CU.precio_comercia)  as cantidad from cultivos CU
        JOIN cultivo_proyectos CP
        ON CU.itemId = CP.cult_itemid
        JOIN catalogo_clases_vinculacion CV
        ON CU.clasevincula_itemid = CV.itemId
        WHERE CU.vincula_itemid =4 AND CP.proy_itemid=" . $id;
        $datos = $dbm->Execute($sql);
        $respuesta = $datos->GetRows();
        $dbm->Close();

        $total = 0;
        $descrip = '';
        foreach ($respuesta as $clave => $valor) {
            //$descrip .= '('.$valor['municipio'].'='.$valor['superficie'].') ';
            $total += $valor['cantidad'];
        }
        return array(
            'descrip' => $descrip,
            'total' => $total
        );
    }

     /* Función que obtiene Comercialización de Emprendimientos con Registro Sanitario [Bs]
    **/
    function getComercializacionRegistroSanitario($id)
    {
        global $db_conf_datatable;
        $db_conf = $db_conf_datatable["principal"];
        $dbm = ADONewConnection($db_conf["type"]);
        $dbm->Connect($db_conf["server"], $db_conf["user"], $db_conf["password"], $db_conf["database"]) or die("ERROR CONNECT " . $db_conf["database"]);
        $dbm->setCharset('utf8');
        $dbm->SetFetchMode(ADODB_FETCH_ASSOC);
        $sql = "SELECT SUM(CU.cant_recolectada * CU.destino_comercia)  as cantidad from cultivos CU
        JOIN cultivo_proyectos CP
        ON CU.itemId = CP.cult_itemid
        JOIN catalogo_clases_vinculacion CV
        ON CU.clasevincula_itemid = CV.itemId
        WHERE CU.vincula_itemid =7 AND CP.proy_itemid=" . $id;
        $datos = $dbm->Execute($sql);
        $respuesta = $datos->GetRows();
        $dbm->Close();

        $total = 0;
        $descrip = '';
        foreach ($respuesta as $clave => $valor) {
            //$descrip .= '('.$valor['municipio'].'='.$valor['superficie'].') ';
            $total += $valor['cantidad'];
        }
        return array(
            'descrip' => $descrip,
            'total' => $total
        );
    }

     /* Función que obtiene Cantidad de Documentos 
    **/
    function getCantidadDocumentos($id)
    {
        global $db_conf_datatable;
        $db_conf = $db_conf_datatable["principal"];
        $dbm = ADONewConnection($db_conf["type"]);
        $dbm->Connect($db_conf["server"], $db_conf["user"], $db_conf["password"], $db_conf["database"]) or die("ERROR CONNECT " . $db_conf["database"]);
        $dbm->setCharset('utf8');
        $dbm->SetFetchMode(ADODB_FETCH_ASSOC);
        $sql = " SELECT COUNT(*) AS cantidad FROM documentos DO
        JOIN documento_proyectos DP
        ON DO.itemId = DP.doc_itemid
        GROUP BY DP.proy_itemid
        WHERE DP.proy_itemid=" . $id;
        $datos = $dbm->Execute($sql);
        $respuesta = $datos->GetRows();
        $dbm->Close();

        $total = 0;
        $descrip = '';
        foreach ($respuesta as $clave => $valor) {
            //$descrip .= '('.$valor['municipio'].'='.$valor['superficie'].') ';
            $total += $valor['cantidad'];
        }
        return array(
            'descrip' => $descrip,
            'total' => $total
        );
    }

         /* Función que obtiene Cantidad de Documentos Cantidad de Documentos Normativa y planificacion
    **/
    function getCantidadDocumentosNormativaPlani($id)
    {
        global $db_conf_datatable;
        $db_conf = $db_conf_datatable["principal"];
        $dbm = ADONewConnection($db_conf["type"]);
        $dbm->Connect($db_conf["server"], $db_conf["user"], $db_conf["password"], $db_conf["database"]) or die("ERROR CONNECT " . $db_conf["database"]);
        $dbm->setCharset('utf8');
        $dbm->SetFetchMode(ADODB_FETCH_ASSOC);
        $sql = "SELECT COUNT(*) AS cantidad FROM documentos DOC
        JOIN documento_proyectos DP
        ON DOC.itemId = DP.doc_itemid
        GROUP BY DP.proy_itemid
        WHERE DOC.tipodoc_itemid= 4 AND  DP.proy_itemid=" . $id;
        $datos = $dbm->Execute($sql);
        $respuesta = $datos->GetRows();
        $dbm->Close();

        $total = 0;
        $descrip = '';
        foreach ($respuesta as $clave => $valor) {
            //$descrip .= '('.$valor['municipio'].'='.$valor['superficie'].') ';
            $total += $valor['cantidad'];
        }
        return array(
            'descrip' => $descrip,
            'total' => $total
        );
    }

    
         /* Función que obtiene Cantidad deCantidad de Documentos Diseño e Infraestructura
    **/
    function getCantidadDocumentosDiseñoInf($id)
    {
        global $db_conf_datatable;
        $db_conf = $db_conf_datatable["principal"];
        $dbm = ADONewConnection($db_conf["type"]);
        $dbm->Connect($db_conf["server"], $db_conf["user"], $db_conf["password"], $db_conf["database"]) or die("ERROR CONNECT " . $db_conf["database"]);
        $dbm->setCharset('utf8');
        $dbm->SetFetchMode(ADODB_FETCH_ASSOC);
        $sql = "SELECT COUNT(*) AS cantidad FROM documentos DOC
        JOIN documento_proyectos DP
        ON DOC.itemId = DP.doc_itemid
        GROUP BY DP.proy_itemid
        WHERE DOC.tipodoc_itemid= 6 AND  DP.proy_itemid=" . $id;
        $datos = $dbm->Execute($sql);
        $respuesta = $datos->GetRows();
        $dbm->Close();

        $total = 0;
        $descrip = '';
        foreach ($respuesta as $clave => $valor) {
            //$descrip .= '('.$valor['municipio'].'='.$valor['superficie'].') ';
            $total += $valor['cantidad'];
        }
        return array(
            'descrip' => $descrip,
            'total' => $total
        );
    }

    
    /* Función que obtiene CantidaCantidad de Documentos Bases de Dato
    **/
    function getCantidadDocumentosBaseDatos($id)
    {
        global $db_conf_datatable;
        $db_conf = $db_conf_datatable["principal"];
        $dbm = ADONewConnection($db_conf["type"]);
        $dbm->Connect($db_conf["server"], $db_conf["user"], $db_conf["password"], $db_conf["database"]) or die("ERROR CONNECT " . $db_conf["database"]);
        $dbm->setCharset('utf8');
        $dbm->SetFetchMode(ADODB_FETCH_ASSOC);
        $sql = "SELECT COUNT(*) AS cantidad FROM documentos DOC
        JOIN documento_proyectos DP
        ON DOC.itemId = DP.doc_itemid
        GROUP BY DP.proy_itemid
        WHERE DOC.tipodoc_itemid= 7 AND  DP.proy_itemid=" . $id;
        $datos = $dbm->Execute($sql);
        $respuesta = $datos->GetRows();
        $dbm->Close();

        $total = 0;
        $descrip = '';
        foreach ($respuesta as $clave => $valor) {
            //$descrip .= '('.$valor['municipio'].'='.$valor['superficie'].') ';
            $total += $valor['cantidad'];
        }
        return array(
            'descrip' => $descrip,
            'total' => $total
        );
    }
     /**
     * ================================================================
     * FIN: FUNCIONES DE ESTADÍSTICA PARA METAS
     * ================================================================
     **/

     /**
     * ================================================================
     * INICIO: FUNCIONES DE ESTADÍSTICA PARA VINCULACIÓN
     * ================================================================
     **/

     /**
     * Función que obtiene datos de producción en planes
     **/
    function getVinculacionProduccionPlanes($id, $fecha_inicio, $fecha_final){
        global $db_conf_datatable;
        $db_conf = $db_conf_datatable["principal"];
        $dbm = ADONewConnection($db_conf["type"]);
        $dbm->Connect($db_conf["server"],$db_conf["user"] ,$db_conf["password"],$db_conf["database"]) or die("ERROR CONNECT " . $db_conf["database"]);
        $dbm->setCharset('utf8');
        $dbm->SetFetchMode(ADODB_FETCH_ASSOC);
        $sql = "SELECT CU.itemId,PC.proy_itemid,'Cantidad de Producción en Planes' AS detalle, SUM(CU.cant_recolectada) AS produccion,SUM(CU.precio_comercia) AS venta
        FROM cultivos CU 
        JOIN cultivo_proyectos PC 
        ON CU.itemId = PC.cult_itemid
        JOIN cultivo_informacion_adicional CI 
        ON CU.itemId=CI.itemId
        WHERE CU.clasevincula_itemid=9 
        AND CI.fecha_inicio='".$fecha_inicio."' 
        AND CI.fecha_vigencia='".$fecha_final."' 
        AND PC.proy_itemid = ".$id."
        GROUP BY CU.itemId, PC.proy_itemid";
        $datos = $dbm->Execute($sql);
        $respuesta = $datos->GetRows();
        $dbm->Close();
        return $respuesta;
    }

    function getVinculacionProduccionPlanesGeneral($fecha_inicio, $fecha_final){
        global $db_conf_datatable;
        $db_conf = $db_conf_datatable["principal"];
        $dbm = ADONewConnection($db_conf["type"]);
        $dbm->Connect($db_conf["server"],$db_conf["user"] ,$db_conf["password"],$db_conf["database"]) or die("ERROR CONNECT " . $db_conf["database"]);
        $dbm->setCharset('utf8');
        $dbm->SetFetchMode(ADODB_FETCH_ASSOC);
        $sql = "SELECT CU.itemId,PC.proy_itemid,'Cantidad de Producción en Planes' AS detalle, SUM(CU.cant_recolectada) AS produccion,SUM(CU.precio_comercia) AS venta
        FROM cultivos CU 
        JOIN cultivo_proyectos PC 
        ON CU.itemId = PC.cult_itemid
        JOIN cultivo_informacion_adicional CI 
        ON CU.itemId=CI.itemId
        WHERE CU.clasevincula_itemid=9 
        AND CI.fecha_inicio='".$fecha_inicio."' 
        AND CI.fecha_vigencia='".$fecha_final."' 
        GROUP BY CU.itemId, PC.proy_itemid";
        $datos = $dbm->Execute($sql);
        $respuesta = $datos->GetRows();
        $dbm->Close();
        return $respuesta;
    }

    /**
     * Función que obtiene datos de producción en certificación
     **/
    function getVinculacionProduccionCertificacion($id, $fecha_inicio, $fecha_final){
        global $db_conf_datatable;
        $db_conf = $db_conf_datatable["principal"];
        $dbm = ADONewConnection($db_conf["type"]);
        $dbm->Connect($db_conf["server"],$db_conf["user"] ,$db_conf["password"],$db_conf["database"]) or die("ERROR CONNECT " . $db_conf["database"]);
        $dbm->setCharset('utf8');
        $dbm->SetFetchMode(ADODB_FETCH_ASSOC);
        $sql = "SELECT CU.itemId,PC.proy_itemid,'Cantidad de Producción en Certificación' AS detalle, SUM(CU.cant_recolectada) AS produccion,SUM(CU.precio_comercia) AS venta
        FROM cultivos CU 
        JOIN cultivo_proyectos PC ON CU.itemId = PC.cult_itemid
        JOIN cultivo_informacion_adicional CI ON CU.itemId=CI.itemId
        WHERE CU.clasevincula_itemid=7 
        AND CI.fecha_inicio='".$fecha_inicio."' 
        AND CI.fecha_vigencia='".$fecha_final."' 
        AND PC.proy_itemid = ".$id."
        GROUP BY CU.itemId, PC.proy_itemid";
        $datos = $dbm->Execute($sql);
        $respuesta = $datos->GetRows();
        $dbm->Close();
        return $respuesta;
    }

    function getVinculacionProduccionCertificacionGeneral($fecha_inicio, $fecha_final){
        global $db_conf_datatable;
        $db_conf = $db_conf_datatable["principal"];
        $dbm = ADONewConnection($db_conf["type"]);
        $dbm->Connect($db_conf["server"],$db_conf["user"] ,$db_conf["password"],$db_conf["database"]) or die("ERROR CONNECT " . $db_conf["database"]);
        $dbm->setCharset('utf8');
        $dbm->SetFetchMode(ADODB_FETCH_ASSOC);
        $sql = "SELECT CU.itemId,PC.proy_itemid,'Cantidad de Producción en Certificación' AS detalle, SUM(CU.cant_recolectada) AS produccion,SUM(CU.precio_comercia) AS venta
        FROM cultivos CU 
        JOIN cultivo_proyectos PC ON CU.itemId = PC.cult_itemid
        JOIN cultivo_informacion_adicional CI ON CU.itemId=CI.itemId
        WHERE CU.clasevincula_itemid=7 
        AND CI.fecha_inicio='".$fecha_inicio."' 
        AND CI.fecha_vigencia='".$fecha_final."' 
        GROUP BY CU.itemId, PC.proy_itemid";
        $datos = $dbm->Execute($sql);
        $respuesta = $datos->GetRows();
        $dbm->Close();
        return $respuesta;
    }

    /**
     * Función que obtiene datos de producción de sistemas agroforestales
     **/
    function getVinculacionProduccionSistemasAgroforestales($id, $fecha_inicio, $fecha_final){
        global $db_conf_datatable;
        $db_conf = $db_conf_datatable["principal"];
        $dbm = ADONewConnection($db_conf["type"]);
        $dbm->Connect($db_conf["server"],$db_conf["user"] ,$db_conf["password"],$db_conf["database"]) or die("ERROR CONNECT " . $db_conf["database"]);
        $dbm->setCharset('utf8');
        $dbm->SetFetchMode(ADODB_FETCH_ASSOC);
        $sql = "SELECT CU.itemId,PC.proy_itemid,'Cantidad de Producción en Sistemas Agroforestales' AS detalle, SUM(CU.cant_recolectada) AS produccion,SUM(CU.precio_comercia) AS venta
        FROM cultivos CU 
        JOIN cultivo_proyectos PC ON CU.itemId = PC.cult_itemid
        JOIN cultivo_informacion_adicional CI ON CU.itemId=CI.itemId
        WHERE CU.clasevincula_itemid=8 
        AND CI.fecha_inicio='".$fecha_inicio."' 
        AND CI.fecha_vigencia='".$fecha_final."' 
        AND PC.proy_itemid = ".$id."
        GROUP BY CU.itemId, PC.proy_itemid";
        $datos = $dbm->Execute($sql);
        $respuesta = $datos->GetRows();
        $dbm->Close();
        return $respuesta;
    }

    function getVinculacionProduccionSistemasAgroforestalesGeneral($fecha_inicio, $fecha_final){
        global $db_conf_datatable;
        $db_conf = $db_conf_datatable["principal"];
        $dbm = ADONewConnection($db_conf["type"]);
        $dbm->Connect($db_conf["server"],$db_conf["user"] ,$db_conf["password"],$db_conf["database"]) or die("ERROR CONNECT " . $db_conf["database"]);
        $dbm->setCharset('utf8');
        $dbm->SetFetchMode(ADODB_FETCH_ASSOC);
        $sql = "SELECT CU.itemId,PC.proy_itemid,'Cantidad de Producción en Sistemas Agroforestales' AS detalle, SUM(CU.cant_recolectada) AS produccion,SUM(CU.precio_comercia) AS venta
        FROM cultivos CU 
        JOIN cultivo_proyectos PC ON CU.itemId = PC.cult_itemid
        JOIN cultivo_informacion_adicional CI ON CU.itemId=CI.itemId
        WHERE CU.clasevincula_itemid=8 
        AND CI.fecha_inicio='".$fecha_inicio."' 
        AND CI.fecha_vigencia='".$fecha_final."' 
        GROUP BY CU.itemId, PC.proy_itemid";
        $datos = $dbm->Execute($sql);
        $respuesta = $datos->GetRows();
        $dbm->Close();
        return $respuesta;
    }

    /**
     * Función que obtiene datos de producción de siembra y recolección
     **/
    function getVinculacionProduccionSiembraRecoleccion($id, $fecha_inicio, $fecha_final){
        global $db_conf_datatable;
        $db_conf = $db_conf_datatable["principal"];
        $dbm = ADONewConnection($db_conf["type"]);
        $dbm->Connect($db_conf["server"],$db_conf["user"] ,$db_conf["password"],$db_conf["database"]) or die("ERROR CONNECT " . $db_conf["database"]);
        $dbm->setCharset('utf8');
        $dbm->SetFetchMode(ADODB_FETCH_ASSOC);
        $sql = "SELECT CU.itemId,PC.proy_itemid,'Cantidad de Producción en Siembra y recolección' AS detalle, SUM(CU.cant_recolectada) AS produccion,SUM(CU.precio_comercia) AS venta
        FROM cultivos CU 
        JOIN cultivo_proyectos PC ON CU.itemId = PC.cult_itemid
        JOIN cultivo_informacion_adicional CI ON CU.itemId=CI.itemId
        WHERE CU.clasevincula_itemid=11 
        AND CI.fecha_inicio='".$fecha_inicio."' 
        AND CI.fecha_vigencia='".$fecha_final."' 
        AND PC.proy_itemid = ".$id."
        GROUP BY CU.itemId, PC.proy_itemid";
        $datos = $dbm->Execute($sql);
        $respuesta = $datos->GetRows();
        $dbm->Close();
        return $respuesta;
    }

    function getVinculacionProduccionSiembraRecoleccionGeneral($fecha_inicio, $fecha_final){
        global $db_conf_datatable;
        $db_conf = $db_conf_datatable["principal"];
        $dbm = ADONewConnection($db_conf["type"]);
        $dbm->Connect($db_conf["server"],$db_conf["user"] ,$db_conf["password"],$db_conf["database"]) or die("ERROR CONNECT " . $db_conf["database"]);
        $dbm->setCharset('utf8');
        $dbm->SetFetchMode(ADODB_FETCH_ASSOC);
        $sql = "SELECT CU.itemId,PC.proy_itemid,'Cantidad de Producción en Siembra y recolección' AS detalle, SUM(CU.cant_recolectada) AS produccion,SUM(CU.precio_comercia) AS venta
        FROM cultivos CU 
        JOIN cultivo_proyectos PC ON CU.itemId = PC.cult_itemid
        JOIN cultivo_informacion_adicional CI ON CU.itemId=CI.itemId
        WHERE CU.clasevincula_itemid=11 
        AND CI.fecha_inicio='".$fecha_inicio."' 
        AND CI.fecha_vigencia='".$fecha_final."' 
        GROUP BY CU.itemId, PC.proy_itemid";
        $datos = $dbm->Execute($sql);
        $respuesta = $datos->GetRows();
        $dbm->Close();
        return $respuesta;
    }

    /**
     * Función que obtiene datos de producción de siembra y recolección
     **/
    function getVinculacionComercializacionTransformacion($id, $fecha_inicio, $fecha_final){
        global $db_conf_datatable;
        $db_conf = $db_conf_datatable["principal"];
        $dbm = ADONewConnection($db_conf["type"]);
        $dbm->Connect($db_conf["server"],$db_conf["user"] ,$db_conf["password"],$db_conf["database"]) or die("ERROR CONNECT " . $db_conf["database"]);
        $dbm->setCharset('utf8');
        $dbm->SetFetchMode(ADODB_FETCH_ASSOC);
        $sql = "SELECT CU.itemId,PC.proy_itemid,'Cantidad de Comercialización en Transformación' AS detalle, SUM(CU.cant_recolectada) AS produccion,SUM(CU.precio_comercia) AS venta
        FROM cultivos CU 
        JOIN cultivo_proyectos PC ON CU.itemId = PC.cult_itemid
        JOIN cultivo_informacion_adicional CI ON CU.itemId=CI.itemId
        WHERE CU.clasevincula_itemid=12 
        AND CI.fecha_inicio='".$fecha_inicio."' 
        AND CI.fecha_vigencia='".$fecha_final."' 
        AND PC.proy_itemid = ".$id."
        GROUP BY CU.itemId, PC.proy_itemid";
        $datos = $dbm->Execute($sql);
        $respuesta = $datos->GetRows();
        $dbm->Close();
        return $respuesta;
    }

    function getVinculacionComercializacionTransformacionGeneral($fecha_inicio, $fecha_final){
        global $db_conf_datatable;
        $db_conf = $db_conf_datatable["principal"];
        $dbm = ADONewConnection($db_conf["type"]);
        $dbm->Connect($db_conf["server"],$db_conf["user"] ,$db_conf["password"],$db_conf["database"]) or die("ERROR CONNECT " . $db_conf["database"]);
        $dbm->setCharset('utf8');
        $dbm->SetFetchMode(ADODB_FETCH_ASSOC);
        $sql = "SELECT CU.itemId,PC.proy_itemid,'Cantidad de Comercialización en Transformación' AS detalle, SUM(CU.cant_recolectada) AS produccion,SUM(CU.precio_comercia) AS venta
        FROM cultivos CU 
        JOIN cultivo_proyectos PC ON CU.itemId = PC.cult_itemid
        JOIN cultivo_informacion_adicional CI ON CU.itemId=CI.itemId
        WHERE CU.clasevincula_itemid=12 
        AND CI.fecha_inicio='".$fecha_inicio."' 
        AND CI.fecha_vigencia='".$fecha_final."' 
        GROUP BY CU.itemId, PC.proy_itemid";
        $datos = $dbm->Execute($sql);
        $respuesta = $datos->GetRows();
        $dbm->Close();
        return $respuesta;
    }
    /**
     * ================================================================
     * FIN: FUNCIONES DE ESTADÍSTICA PARA VINCULACIÓN
     * ================================================================
     **/

    /**
     * ================================================================
     * INICIO: FUNCIONES DE ESTADÍSTICA DE DOCUMENTOS
     * ================================================================
     **/

    /**
     * Función que obtiene datos de municipios
     **/
    function getDocumentos($id){
        global $db_conf_datatable;
        $db_conf = $db_conf_datatable["principal"];
        $dbm = ADONewConnection($db_conf["type"]);
        $dbm->Connect($db_conf["server"],$db_conf["user"] ,$db_conf["password"],$db_conf["database"]) or die("ERROR CONNECT " . $db_conf["database"]);
        $dbm->setCharset('utf8');
        $dbm->SetFetchMode(ADODB_FETCH_ASSOC);
        $sql = "SELECT (
        SELECT COUNT(*)
        FROM documentos t1
        INNER JOIN documento_proyectos t2
        ON t1.itemId=t2.doc_itemid
        WHERE t2.proy_itemid=".$id."
        AND t1.tipodoc_itemid NOT IN (4)
        ) AS cantidad,
        (
        SELECT COUNT(*)
        FROM documentos t1
        INNER JOIN documento_proyectos t2
        ON t1.itemId=t2.doc_itemid
        WHERE t2.proy_itemid=".$id."
        AND t1.tipodoc_itemid=4
        ) AS cantidad_normativas";
        $datos = $dbm->Execute($sql);
        $respuesta = $datos->fields;
        $dbm->Close();
        return $respuesta;
    }

    function getDocumentosGeneral(){
        global $db_conf_datatable;
        $db_conf = $db_conf_datatable["principal"];
        $dbm = ADONewConnection($db_conf["type"]);
        $dbm->Connect($db_conf["server"],$db_conf["user"] ,$db_conf["password"],$db_conf["database"]) or die("ERROR CONNECT " . $db_conf["database"]);
        $dbm->setCharset('utf8');
        $dbm->SetFetchMode(ADODB_FETCH_ASSOC);
        $sql = "SELECT (
        SELECT COUNT(*)
        FROM documentos t1
        INNER JOIN documento_proyectos t2
        ON t1.itemId=t2.doc_itemid
        WHERE t1.tipodoc_itemid NOT IN (4)
        ) AS cantidad,
        (
        SELECT COUNT(*)
        FROM documentos t1
        INNER JOIN documento_proyectos t2
        ON t1.itemId=t2.doc_itemid
        WHERE t1.tipodoc_itemid=4
        ) AS cantidad_normativas";
        $datos = $dbm->Execute($sql);
        $respuesta = $datos->fields;
        $dbm->Close();
        return $respuesta;
    }
     /**
     * ================================================================
     * FIN: FUNCIONES DE ESTADÍSTICA DE DOCUMENTOS
     * ================================================================
     **/

     /**
     * ================================================================
     * INICIO: FUNCIONES DE ESTADÍSTICA DE ESPECIES POR DEPARTAMENTO
     * ================================================================
     **/

    /**
     * Función que obtiene especies por departamento
     **/
    function getAnexoEspeciesDepto($id, $fecha_inicio, $fecha_final){
        global $db_conf_datatable;
        $db_conf = $db_conf_datatable["principal"];
        $dbm = ADONewConnection($db_conf["type"]);
        $dbm->Connect($db_conf["server"],$db_conf["user"] ,$db_conf["password"],$db_conf["database"]) or die("ERROR CONNECT " . $db_conf["database"]);
        $dbm->setCharset('utf8');
        $dbm->SetFetchMode(ADODB_FETCH_ASSOC);
        $sql = "SELECT t5.nombre AS depto, GROUP_CONCAT(DISTINCT t2.nombre_comun) AS especies
        FROM cultivos t1
        INNER JOIN especies t2
        ON t1.espe_itemid=t2.itemId
        INNER JOIN cultivo_proyectos t3
        ON t1.itemId=t3.cult_itemid
        INNER JOIN cultivo_informacion_adicional t4
        ON t1.itemId=t4.itemId
        INNER JOIN mapa_departamentos t5
        ON t1.depto_itemid=t5.id
        WHERE t3.proy_itemid=".$id."
        AND (t4.fecha_inicio BETWEEN '".$fecha_inicio."' AND '".$fecha_final."')
        AND (t4.fecha_vigencia BETWEEN '".$fecha_inicio."' AND '".$fecha_final."')
        GROUP BY t1.depto_itemid";
        $datos = $dbm->Execute($sql);
        $respuesta = $datos->GetRows();
        $dbm->Close();
        return $respuesta;
    }
     /**
     * ================================================================
     * FIN: FUNCIONES DE ESTADÍSTICA DE ESPECIES POR DEPARTAMENTO
     * ================================================================
     **/

    /**
     * Función que obtiene datos estadísticos por departamentos
     **/
    function getEstadisticaDeptos($id, $fecha_inicio, $fecha_final) {
        $deptos = $this->getDeptos();
        $estadistica = array();
        foreach($deptos as $clave => $valor) {
            $estadistica[$valor['id']] = array(
                'depto' => $valor['nombre'],
                'municipios' => 0,
                'comunidades' => 0,
                'superficie' => 0,
                'poblacion' => array(0, 0),
                'especies' => array('1' => 0, '2' => 0)
            );
        }

        $especies = $this->getEstadisticaCategoriaEspecies($id, $fecha_inicio, $fecha_final);
        foreach($especies as $clave => $valor) {
            $estadistica[$valor['depto_itemid']]['especies'][$valor['cat_itemid']] = $valor['cantidad'];
        }

        $poblacion = $this->getEstadisticaPoblacion($id, $fecha_inicio, $fecha_final);
        foreach($poblacion as $clave => $valor) {
            $estadistica[$valor['depto_itemid']]['poblacion'][0] = $valor['cant_hombres'];
            $estadistica[$valor['depto_itemid']]['poblacion'][1] = $valor['cant_mujeres'];
        }

        $superficie = $this->getEstadisticaSuperficie($id, $fecha_inicio, $fecha_final);
        foreach($superficie as $clave => $valor) {
            $estadistica[$valor['depto_itemid']]['superficie'] = $valor['superficie'];
        }

        $municipios = $this->getEstadisticaMunicipios($id, $fecha_inicio, $fecha_final);
        foreach($municipios as $clave => $valor) {
            $estadistica[$valor['depto_itemid']]['municipios'] = $valor['cantidad'];
        }

        $comunidades = $this->getEstadisticaComunidades($id, $fecha_inicio, $fecha_final);
        foreach($comunidades as $clave => $valor) {
            $estadistica[$valor['depto_itemid']]['comunidades'] = $valor['cantidad'];
        }

        return $estadistica;
    }

    function getEstadisticaDeptosGeneral($fecha_inicio, $fecha_final) {
        $deptos = $this->getDeptos();
        $estadistica = array();
        foreach($deptos as $clave => $valor) {
            $estadistica[$valor['id']] = array(
                'depto' => $valor['nombre'],
                'municipios' => 0,
                'comunidades' => 0,
                'superficie' => 0,
                'poblacion' => array(0, 0),
                'especies' => array('1' => 0, '2' => 0)
            );
        }

        $especies = $this->getEstadisticaCategoriaEspeciesGeneral($fecha_inicio, $fecha_final);
        foreach($especies as $clave => $valor) {
            $estadistica[$valor['depto_itemid']]['especies'][$valor['cat_itemid']] = $valor['cantidad'];
        }

        $poblacion = $this->getEstadisticaPoblacionGeneral($fecha_inicio, $fecha_final);
        foreach($poblacion as $clave => $valor) {
            $estadistica[$valor['depto_itemid']]['poblacion'][0] = $valor['cant_hombres'];
            $estadistica[$valor['depto_itemid']]['poblacion'][1] = $valor['cant_mujeres'];
        }

        $superficie = $this->getEstadisticaSuperficieGeneral($fecha_inicio, $fecha_final);
        foreach($superficie as $clave => $valor) {
            $estadistica[$valor['depto_itemid']]['superficie'] = $valor['superficie'];
        }

        $municipios = $this->getEstadisticaMunicipiosGeneral($fecha_inicio, $fecha_final);
        foreach($municipios as $clave => $valor) {
            $estadistica[$valor['depto_itemid']]['municipios'] = $valor['cantidad'];
        }

        $comunidades = $this->getEstadisticaComunidadesGeneral($fecha_inicio, $fecha_final);
        foreach($comunidades as $clave => $valor) {
            $estadistica[$valor['depto_itemid']]['comunidades'] = $valor['cantidad'];
        }

        return $estadistica;
    }

    /**
     * Función que obtiene datos estadísticos de metas por proyecto
     **/
    function getEstadisticaMetas($id) {
        $metas = $this->getMetas($id);
        foreach ($metas as $clave => $valor) {
            switch ($valor['meta_itemid']) {
                case 1:
                    $res = $this->geCantidadEcotipos($id);
                    $metas[$clave]['total'] = $res['total'];
                    $metas[$clave]['descrip'] = $res['descrip'];
                    $metas[$clave]['porcentaje'] = round(($res['total'] / $valor['meta']) * 100, 2);
                    break;
                case 2:
                    $res = $this->getEspeciesCultivadas($id);
                    $metas[$clave]['total'] = $res['total'];
                    $metas[$clave]['descrip'] = $res['descrip'];
                    $metas[$clave]['porcentaje'] = round(($res['total'] / $valor['meta']) * 100, 2);
                    break;
                case 3:
                    $res = $this->getEspeciesSilvestres($id);
                    $metas[$clave]['total'] = $res['total'];
                    $metas[$clave]['descrip'] = $res['descrip'];
                    $metas[$clave]['porcentaje'] = round(($res['total'] / $valor['meta']) * 100, 2);
                    break;
                case 4:
                    $res = $this->getEspeciesMmaya($id);
                    $metas[$clave]['total'] = $res['total'];
                    $metas[$clave]['descrip'] = $res['descrip'];
                    $metas[$clave]['porcentaje'] = round(($res['total'] / $valor['meta']) * 100, 2);
                    break;
                case 5:
                    $res = $this->getCultivosInsitu($id);
                    $metas[$clave]['total'] = $res['total'];
                    $metas[$clave]['descrip'] = $res['descrip'];
                    $metas[$clave]['porcentaje'] = round(($res['total'] / $valor['meta']) * 100, 2);
                    break;
                case 6:
                    $res = $this->getCultivosExsitu($id);
                    $metas[$clave]['total'] = $res['total'];
                    $metas[$clave]['descrip'] = $res['descrip'];
                    $metas[$clave]['porcentaje'] = round(($res['total'] / $valor['meta']) * 100, 2);
                    break;
                case 7:
                    $res = $this->getPlanManejoProduccion($id);
                    $metas[$clave]['total'] = $res['total'];
                    $metas[$clave]['descrip'] = $res['descrip'];
                    $metas[$clave]['porcentaje'] = round(($res['total'] / $valor['meta']) * 100, 2);
                    break;
                case 8:
                    $res = $this->getCertificcion($id);
                    $metas[$clave]['total'] = $res['total'];
                    $metas[$clave]['descrip'] = $res['descrip'];
                    $metas[$clave]['porcentaje'] = round(($res['total'] / $valor['meta']) * 100, 2);
                    break;
                case 9:
                    $res = $this->getSistemaAgroforestal($id);
                    $metas[$clave]['total'] = $res['total'];
                    $metas[$clave]['descrip'] = $res['descrip'];
                    $metas[$clave]['porcentaje'] = round(($res['total'] / $valor['meta']) * 100, 2);
                    break;
                case 10:
                    $res = $this->getSistgetSistemaFamiliar($id);
                    $metas[$clave]['total'] = $res['total'];
                    $metas[$clave]['descrip'] = $res['descrip'];
                    $metas[$clave]['porcentaje'] = round(($res['total'] / $valor['meta']) * 100, 2);
                    break;
                case 11:
                    $res = $this->getRecoleccion($id);
                    $metas[$clave]['total'] = $res['total'];
                    $metas[$clave]['descrip'] = $res['descrip'];
                    $metas[$clave]['porcentaje'] = round(($res['total'] / $valor['meta']) * 100, 2);
                    break;
                case 12:
                    $res = $this->getTransformacion($id);
                    $metas[$clave]['total'] = $res['total'];
                    $metas[$clave]['descrip'] = $res['descrip'];
                    $metas[$clave]['porcentaje'] = round(($res['total'] / $valor['meta']) * 100, 2);
                    break;
                case 13:
                    $res = $this->getRegistroSanitario($id);
                    $metas[$clave]['total'] = $res['total'];
                    $metas[$clave]['descrip'] = $res['descrip'];
                    $metas[$clave]['porcentaje'] = round(($res['total'] / $valor['meta']) * 100, 2);
                    break;
                case 14:
                    $res = $this->getSuperficieManejoProduccion($id);
                    $metas[$clave]['total'] = $res['total'];
                    $metas[$clave]['descrip'] = $res['descrip'];
                    $metas[$clave]['porcentaje'] = round(($res['total'] / $valor['meta']) * 100, 2);
                    break;
                case 15:
                    $res = $this->getSuperficieCertificada($id);
                    $metas[$clave]['total'] = $res['total'];
                    $metas[$clave]['descrip'] = $res['descrip'];
                    $metas[$clave]['porcentaje'] = round(($res['total'] / $valor['meta']) * 100, 2);
                    break;
                case 16:
                    $res = $this->getSuperficieAgroforestal($id);
                    $metas[$clave]['total'] = $res['total'];
                    $metas[$clave]['descrip'] = $res['descrip'];
                    $metas[$clave]['porcentaje'] = round(($res['total'] / $valor['meta']) * 100, 2);
                    break;
                case 17:
                    $res = $this->getSuperficieSiembraRecoleccion($id);
                    $metas[$clave]['total'] = $res['total'];
                    $metas[$clave]['descrip'] = $res['descrip'];
                    $metas[$clave]['porcentaje'] = round(($res['total'] / $valor['meta']) * 100, 2);
                    break;
                case 18:
                    $res = $this->getSuperficietotal($id);
                    $metas[$clave]['total'] = $res['total'];
                    $metas[$clave]['descrip'] = $res['descrip'];
                    $metas[$clave]['porcentaje'] = round(($res['total'] / $valor['meta']) * 100, 2);
                    break;
                case 19:
                    $res = $this->getConservacionHombres($id);
                    $metas[$clave]['total'] = $res['total'];
                    $metas[$clave]['descrip'] = $res['descrip'];
                    $metas[$clave]['porcentaje'] = round(($res['total'] / $valor['meta']) * 100, 2);
                    break;
                case 20:
                    $res = $this->getConservacionMujeres($id);
                    $metas[$clave]['total'] = $res['total'];
                    $metas[$clave]['descrip'] = $res['descrip'];
                    $metas[$clave]['porcentaje'] = round(($res['total'] / $valor['meta']) * 100, 2);
                    break;

                case 21:
                    $res = $this->getPlanesHombres($id);
                    $metas[$clave]['total'] = $res['total'];
                    $metas[$clave]['descrip'] = $res['descrip'];
                    $metas[$clave]['porcentaje'] = round(($res['total'] / $valor['meta']) * 100, 2);
                    break;
                case 22:
                    $res = $this->getPlanesMujeres($id);
                    $metas[$clave]['total'] = $res['total'];
                    $metas[$clave]['descrip'] = $res['descrip'];
                    $metas[$clave]['porcentaje'] = round(($res['total'] / $valor['meta']) * 100, 2);
                    break;
                case 23:
                    $res = $this->getCertificacionHombres($id);
                    $metas[$clave]['total'] = $res['total'];
                    $metas[$clave]['descrip'] = $res['descrip'];
                    $metas[$clave]['porcentaje'] = round(($res['total'] / $valor['meta']) * 100, 2);
                    break;
                case 24:
                    $res = $this->getCertificacionMujeres($id);
                    $metas[$clave]['total'] = $res['total'];
                    $metas[$clave]['descrip'] = $res['descrip'];
                    $metas[$clave]['porcentaje'] = round(($res['total'] / $valor['meta']) * 100, 2);
                    break;
                case 25:
                    $res = $this->getAgroforestalHombres($id);
                    $metas[$clave]['total'] = $res['total'];
                    $metas[$clave]['descrip'] = $res['descrip'];
                    $metas[$clave]['porcentaje'] = round(($res['total'] / $valor['meta']) * 100, 2);
                    break;
                case 26:
                    $res = $this->getAgroforestalMujeres($id);
                    $metas[$clave]['total'] = $res['total'];
                    $metas[$clave]['descrip'] = $res['descrip'];
                    $metas[$clave]['porcentaje'] = round(($res['total'] / $valor['meta']) * 100, 2);
                    break;
                case 27:
                    $res = $this->getSiembraRecoleccionHombres($id);
                    $metas[$clave]['total'] = $res['total'];
                    $metas[$clave]['descrip'] = $res['descrip'];
                    $metas[$clave]['porcentaje'] = round(($res['total'] / $valor['meta']) * 100, 2);
                    break;
                case 28:
                    $res = $this->getSiembraRecoleccionMujeres($id);
                    $metas[$clave]['total'] = $res['total'];
                    $metas[$clave]['descrip'] = $res['descrip'];
                    $metas[$clave]['porcentaje'] = round(($res['total'] / $valor['meta']) * 100, 2);
                    break;
                case 29:
                    $res = $this->getEmprendimientosHombres($id);
                    $metas[$clave]['total'] = $res['total'];
                    $metas[$clave]['descrip'] = $res['descrip'];
                    $metas[$clave]['porcentaje'] = round(($res['total'] / $valor['meta']) * 100, 2);
                    break;
                case 30:
                    $res = $this->getEmprendimientosMujeres($id);
                    $metas[$clave]['total'] = $res['total'];
                    $metas[$clave]['descrip'] = $res['descrip'];
                    $metas[$clave]['porcentaje'] = round(($res['total'] / $valor['meta']) * 100, 2);
                    break;
                case 31:
                    $res = $this->getSemillaConservada($id);
                    $metas[$clave]['total'] = $res['total'];
                    $metas[$clave]['descrip'] = $res['descrip'];
                    $metas[$clave]['porcentaje'] = round(($res['total'] / $valor['meta']) * 100, 2);
                    break;
                case 32:
                    $res = $this->getPlantinConservada($id);
                    $metas[$clave]['total'] = $res['total'];
                    $metas[$clave]['descrip'] = $res['descrip'];
                    $metas[$clave]['porcentaje'] = round(($res['total'] / $valor['meta']) * 100, 2);
                    break;
                case 33:
                    $res = $this->getProduccionPlanes($id);
                    $metas[$clave]['total'] = $res['total'];
                    $metas[$clave]['descrip'] = $res['descrip'];
                    $metas[$clave]['porcentaje'] = round(($res['total'] / $valor['meta']) * 100, 2);
                    break;

                case 34:
                    $res = $this->getProduccionCertificacion($id);
                    $metas[$clave]['total'] = $res['total'];
                    $metas[$clave]['descrip'] = $res['descrip'];
                    $metas[$clave]['porcentaje'] = round(($res['total'] / $valor['meta']) * 100, 2);
                    break;
                case 35:
                    $res = $this->getProduccionAgroforestal($id);
                    $metas[$clave]['total'] = $res['total'];
                    $metas[$clave]['descrip'] = $res['descrip'];
                    $metas[$clave]['porcentaje'] = round(($res['total'] / $valor['meta']) * 100, 2);
                    break;
                case 36:
                    $res = $this->getProduccionSiembraRecoleccion($id);
                    $metas[$clave]['total'] = $res['total'];
                    $metas[$clave]['descrip'] = $res['descrip'];
                    $metas[$clave]['porcentaje'] = round(($res['total'] / $valor['meta']) * 100, 2);
                    break;
                case 37:
                    $res = $this->getProduccionVentaPlanes($id);
                    $metas[$clave]['total'] = $res['total'];
                    $metas[$clave]['descrip'] = $res['descrip'];
                    $metas[$clave]['porcentaje'] = round(($res['total'] / $valor['meta']) * 100, 2);
                    break;
                case 38:
                    $res = $this->getProduccionVentaAgroforestal($id);
                    $metas[$clave]['total'] = $res['total'];
                    $metas[$clave]['descrip'] = $res['descrip'];
                    $metas[$clave]['porcentaje'] = round(($res['total'] / $valor['meta']) * 100, 2);
                    break;
                case 39:
                    $res = $this->getProduccionVentaSiembraRecoleccion($id);
                    $metas[$clave]['total'] = $res['total'];
                    $metas[$clave]['descrip'] = $res['descrip'];
                    $metas[$clave]['porcentaje'] = round(($res['total'] / $valor['meta']) * 100, 2);
                    break;
                case 40:
                    $res = $this->getComercializacionPlanes($id);
                    $metas[$clave]['total'] = $res['total'];
                    $metas[$clave]['descrip'] = $res['descrip'];
                    $metas[$clave]['porcentaje'] = round(($res['total'] / $valor['meta']) * 100, 2);
                    break;
                case 41:
                    $res = $this->getComercializacionCertificacion($id);
                    $metas[$clave]['total'] = $res['total'];
                    $metas[$clave]['descrip'] = $res['descrip'];
                    $metas[$clave]['porcentaje'] = round(($res['total'] / $valor['meta']) * 100, 2);
                    break;
                case 42:
                    $res = $this->getComercializacionAgroforestales($id);
                    $metas[$clave]['total'] = $res['total'];
                    $metas[$clave]['descrip'] = $res['descrip'];
                    $metas[$clave]['porcentaje'] = round(($res['total'] / $valor['meta']) * 100, 2);
                    break;
                case 43:
                    $res = $this->getComercializacionSiembraRecoleccion($id);
                    $metas[$clave]['total'] = $res['total'];
                    $metas[$clave]['descrip'] = $res['descrip'];
                    $metas[$clave]['porcentaje'] = round(($res['total'] / $valor['meta']) * 100, 2);
                    break;
                case 44:
                    $res = $this->getComercializacionEmprendimiento($id);
                    $metas[$clave]['total'] = $res['total'];
                    $metas[$clave]['descrip'] = $res['descrip'];
                    $metas[$clave]['porcentaje'] = round(($res['total'] / $valor['meta']) * 100, 2);
                    break;
                case 45:
                    $res = $this->getComercializacionRegistroSanitario($id);
                    $metas[$clave]['total'] = $res['total'];
                    $metas[$clave]['descrip'] = $res['descrip'];
                    $metas[$clave]['porcentaje'] = round(($res['total'] / $valor['meta']) * 100, 2);
                    break;
                case 46:
                    $res = $this->getCantidadDocumentos($id);
                    $metas[$clave]['total'] = $res['total'];
                    $metas[$clave]['descrip'] = $res['descrip'];
                    $metas[$clave]['porcentaje'] = round(($res['total'] / $valor['meta']) * 100, 2);
                    break;
                case 47:
                    $res = $this->getCantidadDocumentosNormativaPlani($id);
                    $metas[$clave]['total'] = $res['total'];
                    $metas[$clave]['descrip'] = $res['descrip'];
                    $metas[$clave]['porcentaje'] = round(($res['total'] / $valor['meta']) * 100, 2);
                    break;
                case 48:
                    $res = $this->getCantidadDocumentosDiseñoInf($id);
                    $metas[$clave]['total'] = $res['total'];
                    $metas[$clave]['descrip'] = $res['descrip'];
                    $metas[$clave]['porcentaje'] = round(($res['total'] / $valor['meta']) * 100, 2);
                    break;
                case 49:
                    $res = $this->getCantidadDocumentosBaseDatos($id);
                    $metas[$clave]['total'] = $res['total'];
                    $metas[$clave]['descrip'] = $res['descrip'];
                    $metas[$clave]['porcentaje'] = round(($res['total'] / $valor['meta']) * 100, 2);
                    break;
            }
        }

        foreach ($metas as $clave => $valor) {
            $metas[$clave]['porcentaje'] = round(($valor['total']/$valor['meta'])*100, 2);
        }
        
        return $metas;
    }

    function getCategoriasMetas($metas) {
        $categorias = array();
        $catId = $metas[0]['cat_itemid'];
        $contador = 0;
        $suma = 0;
        foreach ($metas as $clave => $valor) {
            if ($valor['cat_itemid'] != $catId) {
                $contador = 0;
                $suma = 0;
            }
            $contador++;
            $suma += $valor['porcentaje'];
            $categorias[$valor['cat_itemid']] = array(
                'cat.nombre' => $valor['categoria'],
                'cat.porcentaje' => $suma,
                'cat.contador' => $contador,
                'cat.total' => 0
            );
            $catId = $valor['cat_itemid'];
        }
        foreach ($categorias as $clave => $valor) {
            $calculo = round($valor['cat.porcentaje']/$valor['cat.contador'], 2);
            $categorias[$clave]['cat.total'] = ($calculo > 100 ? 100 : $calculo);
        }

        return $categorias;
    }

    /**
     * Función que obtiene datos estadísticos de metas por proyecto
     **/
    function getEstadisticaVinculacion($id, $fecha_inicio, $fecha_final) {
        $vinculacion = array(
            array('detalle' => 'Cantidad de Producción en Planes', 'produccion' => 0, 'venta' => 0),
            array('detalle' => 'Cantidad de Producción en Certificación', 'produccion' => 0, 'venta' => 0),
            array('detalle' => 'Cantidad de Producción en Sistemas Agroforestales', 'produccion' => 0, 'venta' => 0),
            array('detalle' => 'Cantidad de Producción en Siembra y recolección', 'produccion' => 0, 'venta' => 0),
            array('detalle' => 'Cantidad de Comercialización en Transformación', 'produccion' => 0, 'venta' => 0)
        );
        $produccionPlanes = $this->getVinculacionProduccionPlanes($id, $fecha_inicio, $fecha_final);
        $produccionCertificacion = $this->getVinculacionProduccionCertificacion($id, $fecha_inicio, $fecha_final);
        $produccionSistemasForestales = $this->getVinculacionProduccionSistemasAgroforestales($id, $fecha_inicio, $fecha_final);
        $produccionSiembraRecoleccion = $this->getVinculacionProduccionSiembraRecoleccion($id, $fecha_inicio, $fecha_final);
        $comercializacionTransformacion = $this->getVinculacionComercializacionTransformacion($id, $fecha_inicio, $fecha_final);
        if (count($produccionPlanes) > 0) {
            $vinculacion[0]['produccion'] = $produccionPlanes[0]['produccion'];
            $vinculacion[0]['venta'] = $produccionPlanes[0]['venta'];
        }
        if (count($produccionCertificacion) > 0) {
            $vinculacion[1]['produccion'] = $produccionCertificacion[0]['produccion'];
            $vinculacion[1]['venta'] = $produccionCertificacion[0]['venta'];
        }
        if (count($produccionSistemasForestales) > 0) {
            $vinculacion[2]['produccion'] = $produccionSistemasForestales[0]['produccion'];
            $vinculacion[2]['venta'] = $produccionSistemasForestales[0]['venta'];
        }
        if (count($produccionSiembraRecoleccion) > 0) {
            $vinculacion[3]['produccion'] = $produccionSiembraRecoleccion[0]['produccion'];
            $vinculacion[3]['venta'] = $produccionSiembraRecoleccion[0]['venta'];
        }
        if (count($comercializacionTransformacion) > 0) {
            $vinculacion[4]['produccion'] = $comercializacionTransformacion[0]['produccion'];
            $vinculacion[4]['venta'] = $comercializacionTransformacion[0]['venta'];
        }
        
        return $vinculacion;
    }

    function getEstadisticaVinculacionGeneral($fecha_inicio, $fecha_final) {
        $vinculacion = array(
            array('detalle' => 'Cantidad de Producción en Planes', 'produccion' => 0, 'venta' => 0),
            array('detalle' => 'Cantidad de Producción en Certificación', 'produccion' => 0, 'venta' => 0),
            array('detalle' => 'Cantidad de Producción en Sistemas Agroforestales', 'produccion' => 0, 'venta' => 0),
            array('detalle' => 'Cantidad de Producción en Siembra y recolección', 'produccion' => 0, 'venta' => 0),
            array('detalle' => 'Cantidad de Comercialización en Transformación', 'produccion' => 0, 'venta' => 0)
        );
        $produccionPlanes = $this->getVinculacionProduccionPlanesGeneral($fecha_inicio, $fecha_final);
        $produccionCertificacion = $this->getVinculacionProduccionCertificacionGeneral($fecha_inicio, $fecha_final);
        $produccionSistemasForestales = $this->getVinculacionProduccionSistemasAgroforestalesGeneral($fecha_inicio, $fecha_final);
        $produccionSiembraRecoleccion = $this->getVinculacionProduccionSiembraRecoleccionGeneral($fecha_inicio, $fecha_final);
        $comercializacionTransformacion = $this->getVinculacionComercializacionTransformacionGeneral($fecha_inicio, $fecha_final);
        if (count($produccionPlanes) > 0) {
            $vinculacion[0]['produccion'] = $produccionPlanes[0]['produccion'];
            $vinculacion[0]['venta'] = $produccionPlanes[0]['venta'];
        }
        if (count($produccionCertificacion) > 0) {
            $vinculacion[1]['produccion'] = $produccionCertificacion[0]['produccion'];
            $vinculacion[1]['venta'] = $produccionCertificacion[0]['venta'];
        }
        if (count($produccionSistemasForestales) > 0) {
            $vinculacion[2]['produccion'] = $produccionSistemasForestales[0]['produccion'];
            $vinculacion[2]['venta'] = $produccionSistemasForestales[0]['venta'];
        }
        if (count($produccionSiembraRecoleccion) > 0) {
            $vinculacion[3]['produccion'] = $produccionSiembraRecoleccion[0]['produccion'];
            $vinculacion[3]['venta'] = $produccionSiembraRecoleccion[0]['venta'];
        }
        if (count($comercializacionTransformacion) > 0) {
            $vinculacion[4]['produccion'] = $comercializacionTransformacion[0]['produccion'];
            $vinculacion[4]['venta'] = $comercializacionTransformacion[0]['venta'];
        }
        
        return $vinculacion;
    }

    /**
     * Función que obtiene datos estadísticos de metas por proyecto
     **/
    function getEstadisticaDocumentos($id) {
        $documentos = $this->getDocumentos($id);

        return $documentos;
    }

    function getEstadisticaDocumentosGeneral() {
        $documentos = $this->getDocumentosGeneral();

        return $documentos;
    }

    /**
     * Función que genera reporte en formato *.docx
     **/
    function getReporteTecnico($id, $fecha_inicio, $fecha_final) {
        //Crear documento a partir de plantilla
        $archivo = 'reporte_tecnico.docx';
        $doc = new \PhpOffice\PhpWord\TemplateProcessor('module/agrobiodiversidad/submodule/reportes/snippet/templates/'.$archivo);

        //Consulta información a la base de datos
        $info_proyecto = $this->getProyecto($id);
        $info_deptos = $this->getEstadisticaDeptos($id, $fecha_inicio, $fecha_final);
        $info_metas = $this->getEstadisticaMetas($id);
        $info_categoria_metas = $this->getCategoriasMetas($info_metas);
        $info_vinculacion = $this->getEstadisticaVinculacion($id, $fecha_inicio, $fecha_final);
        $info_documentos = $this->getEstadisticaDocumentos($id);
        $info_anexo_especies = $this->getAnexoEspeciesDepto($id, $fecha_inicio, $fecha_final);

        //Datos de información de fechas
        $doc->setValue('fecha.inicio', date_create($fecha_inicio)->format('d/m/Y'));
        $doc->setValue('fecha.final', date_create($fecha_final)->format('d/m/Y'));
        $doc->setValue('fecha.sistema', date('d/m/Y'));

        //Datos información general
        $doc->setValue('proy_nombre', $info_proyecto['nombre']);
        $doc->setValue('proy_codigo', $info_proyecto['codigo']);
        $doc->setValue('proy_fecha_inicio', $info_proyecto['fecha_inicio']);
        $doc->setValue('proy_fecha_final', $info_proyecto['fecha_final']);
        $doc->setValue('proy_monto', number_format($info_proyecto['monto'], 2));
        $doc->setValue('proy_contacto', $info_proyecto['contacto']);
        $doc->setValue('proy_telefono', $info_proyecto['telefono']);

        //Datos estadísticos por departamentos
        $sumas = array(0, 0, 0, 0, 0, 0, 0);
        $contador = 1;
        $tamanio = count($info_deptos);
        $doc->cloneRow('col.depto', $tamanio);
        foreach ($info_deptos as $valor) {
            $doc->setValue('col.depto#'.$contador, $valor['depto']);
            $doc->setValue('col.0#'.$contador, $valor['municipios']);
            $doc->setValue('col.1#'.$contador, $valor['comunidades']);
            $doc->setValue('col.2#'.$contador, $valor['superficie']);
            $doc->setValue('col.3#'.$contador, $valor['poblacion'][0]);
            $doc->setValue('col.4#'.$contador, $valor['poblacion'][1]);
            $doc->setValue('col.5#'.$contador, $valor['especies'][1]);
            $doc->setValue('col.6#'.$contador, $valor['especies'][2]);
            $contador++;
            $sumas[0] = $sumas[0] + $valor['municipios'];
            $sumas[1] = $sumas[1] + $valor['comunidades'];
            $sumas[2] = $sumas[2] + $valor['superficie'];
            $sumas[3] = $sumas[3] + $valor['poblacion'][0];
            $sumas[4] = $sumas[4] + $valor['poblacion'][1];
            $sumas[5] = $sumas[5] + $valor['especies'][1];
            $sumas[6] = $sumas[6] + $valor['especies'][2];
        }
        $doc->setValue('suma.0', $sumas['0']);
        $doc->setValue('suma.1', $sumas['1']);
        $doc->setValue('suma.2', $sumas['2']);
        $doc->setValue('suma.3', $sumas['3']);
        $doc->setValue('suma.4', $sumas['4']);
        $doc->setValue('suma.5', $sumas['5']);
        $doc->setValue('suma.6', $sumas['6']);
        $doc->setValue('suma.personas', $sumas['3']+$sumas['4']);

        //Datos de metas
        $contador = 1;
        $tamanio = count($info_metas);
        $doc->cloneRow('meta.detalle', $tamanio);
        foreach ($info_metas as $valor) {
            $doc->setValue('meta.detalle#'.$contador, $valor['detalle']);
            $doc->setValue('meta.realizado#'.$contador, $valor['total']);
            $doc->setValue('meta.meta#'.$contador, $valor['meta']);
            $doc->setValue('meta.porcentaje#'.$contador, $valor['porcentaje']);
            $contador++;
        }

        //Datos de metas categorizadas
        $contador = 1;
        $tamanio = count($info_categoria_metas);
        $doc->cloneRow('cat.total', $tamanio);
        $suma = 0;
        foreach ($info_categoria_metas as $valor) {
            $doc->setValue('cat.total#'.$contador, $valor['cat.total']);
            $doc->setValue('cat.nombre#'.$contador, $valor['cat.nombre']);
            $contador++;
            $suma += $valor['cat.total'];
        }
        $doc->setValue('cat.porcentaje_total', round($suma/($contador-1), 2));

        //Datos estadísticos por vinculación
        $sumas = array(0, 0);
        $contador = 1;
        $tamanio = count($info_vinculacion);
        $doc->cloneRow('col.detalle', $tamanio);
        foreach ($info_vinculacion as $valor) {
            $doc->setValue('col.detalle#'.$contador, $valor['detalle']);
            $doc->setValue('col.produccion#'.$contador, $valor['produccion']);
            $doc->setValue('col.venta#'.$contador, $valor['venta']);
            $contador++;
            $sumas[0] = $sumas[0] + $valor['produccion'];
            $sumas[1] = $sumas[1] + $valor['venta'];
        }
        $doc->setValue('suma.produccion', $sumas['0']);
        $doc->setValue('suma.venta', $sumas['1']);

        //Datos de documentos
        $doc->setValue('doc.general', $info_documentos['cantidad']);
        $doc->setValue('doc.normativas', $info_documentos['cantidad_normativas']);

        //Datos anexo metas
        $contador = 1;
        $tamanio = count($info_metas);
        $doc->cloneRow('anx.detalle', $tamanio);
        $catId = null;
        foreach ($info_metas as $valor) {
            if ($catId != $valor['cat_itemid']) {
                $doc->setValue('anx.detalle#'.$contador, $info_categoria_metas[$valor['cat_itemid']]['cat.nombre']);
                $doc->setValue('anx.linea#'.$contador, "Línea");
                $doc->setValue('anx.meta#'.$contador, "Meta");
                $doc->setValue('anx.realizado#'.$contador, "Realizado");
                $doc->setValue('anx.porcentaje#'.$contador, $info_categoria_metas[$valor['cat_itemid']]['cat.total']);
                $contador++;
            }
            $doc->setValue('anx.detalle#'.$contador, $valor['detalle']);
            $doc->setValue('anx.linea#'.$contador, $valor['linea_base']);
            $doc->setValue('anx.meta#'.$contador, $valor['meta']);
            $doc->setValue('anx.realizado#'.$contador, $valor['total']);
            $doc->setValue('anx.porcentaje#'.$contador, $valor['porcentaje']);
            $contador++;
            $catId = $valor['cat_itemid'];
        }

        //Datos anexo especies
        $contador = 1;
        $tamanio = count($info_anexo_especies);
        $doc->cloneRow('anx.depto', $tamanio);
        foreach ($info_anexo_especies as $valor) {
            $doc->setValue('anx.depto#'.$contador, $valor['depto']);
            $doc->setValue('anx.especies#'.$contador, $valor['especies']);
            $contador++;
        }

        //Permite descargar archivo
        header("Content-Description: File Transfer");
        header("Content-Disposition: attachment; filename=".$archivo);
        header("Content-Type: application/vnd.openxmlformats-officedocument.wordprocessingml.document");
        header("Content-Transfer-Encoding: binary");
        header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
        header("Expires: 0");
        $doc->saveAs("php://output");
        echo file_get_contents($archivo);
        exit();
    }

    /**
     * Función que genera reporte en formato *.docx
     **/
    function getReporteGeneral($fecha_inicio, $fecha_final) {
        //Crear documento a partir de plantilla
        $archivo = 'reporte_general.docx';
        $doc = new \PhpOffice\PhpWord\TemplateProcessor('module/agrobiodiversidad/submodule/reportes/snippet/templates/'.$archivo);

        //Consulta información a la base de datos
        $info_proyectos = $this->getProyectoGeneral($fecha_inicio, $fecha_final);
        $info_deptos = $this->getEstadisticaDeptosGeneral($fecha_inicio, $fecha_final);
        $info_vinculacion = $this->getEstadisticaVinculacionGeneral($fecha_inicio, $fecha_final);
        $info_documentos = $this->getEstadisticaDocumentosGeneral();

        //Datos de información de fechas
        $doc->setValue('fecha.inicio', date_create($fecha_inicio)->format('d/m/Y'));
        $doc->setValue('fecha.final', date_create($fecha_final)->format('d/m/Y'));
        $doc->setValue('fecha.sistema', date('d/m/Y'));

        //Datos de información de fechas
        $doc->setValue('proy.cantidad', $info_proyectos['cantidad']);

        //Datos estadísticos por departamentos
        $sumas = array(0, 0, 0, 0, 0, 0, 0);
        $contador = 1;
        $tamanio = count($info_deptos);
        $doc->cloneRow('col.depto', $tamanio);
        foreach ($info_deptos as $valor) {
            $doc->setValue('col.depto#'.$contador, $valor['depto']);
            $doc->setValue('col.0#'.$contador, $valor['municipios']);
            $doc->setValue('col.1#'.$contador, $valor['comunidades']);
            $doc->setValue('col.2#'.$contador, $valor['superficie']);
            $doc->setValue('col.3#'.$contador, $valor['poblacion'][0]);
            $doc->setValue('col.4#'.$contador, $valor['poblacion'][1]);
            $doc->setValue('col.5#'.$contador, $valor['especies'][1]);
            $doc->setValue('col.6#'.$contador, $valor['especies'][2]);
            $contador++;
            $sumas[0] = $sumas[0] + $valor['municipios'];
            $sumas[1] = $sumas[1] + $valor['comunidades'];
            $sumas[2] = $sumas[2] + $valor['superficie'];
            $sumas[3] = $sumas[3] + $valor['poblacion'][0];
            $sumas[4] = $sumas[4] + $valor['poblacion'][1];
            $sumas[5] = $sumas[5] + $valor['especies'][1];
            $sumas[6] = $sumas[6] + $valor['especies'][2];
        }
        $doc->setValue('suma.0', $sumas['0']);
        $doc->setValue('suma.1', $sumas['1']);
        $doc->setValue('suma.2', $sumas['2']);
        $doc->setValue('suma.3', $sumas['3']);
        $doc->setValue('suma.4', $sumas['4']);
        $doc->setValue('suma.5', $sumas['5']);
        $doc->setValue('suma.6', $sumas['6']);
        $doc->setValue('suma.personas', $sumas['3']+$sumas['4']);

        //Datos estadísticos por vinculación
        $sumas = array(0, 0);
        $contador = 1;
        $tamanio = count($info_vinculacion);
        $doc->cloneRow('col.detalle', $tamanio);
        foreach ($info_vinculacion as $valor) {
            $doc->setValue('col.detalle#'.$contador, $valor['detalle']);
            $doc->setValue('col.produccion#'.$contador, $valor['produccion']);
            $doc->setValue('col.venta#'.$contador, $valor['venta']);
            $contador++;
            $sumas[0] = $sumas[0] + $valor['produccion'];
            $sumas[1] = $sumas[1] + $valor['venta'];
        }
        $doc->setValue('suma.produccion', $sumas['0']);
        $doc->setValue('suma.venta', $sumas['1']);

        //Datos de documentos
        $doc->setValue('doc.general', $info_documentos['cantidad']);
        $doc->setValue('doc.normativas', $info_documentos['cantidad_normativas']);

        //Permite descargar archivo
        header("Content-Description: File Transfer");
        header("Content-Disposition: attachment; filename=".$archivo);
        header("Content-Type: application/vnd.openxmlformats-officedocument.wordprocessingml.document");
        header("Content-Transfer-Encoding: binary");
        header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
        header("Expires: 0");
        $doc->saveAs("php://output");
        echo file_get_contents($archivo);
        exit();
    }

}
