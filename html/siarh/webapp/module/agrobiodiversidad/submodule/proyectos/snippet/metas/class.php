<?php
class Snippet extends Table
{
    //var $item_form;
    function __construct()
    {
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
    function item_update($rec, $itemId, $que_form, $accion, $tabla)
    {
        /**
         * preprocesamos los datos
         */
        $respuesta_procesa = $this->procesa_datos($que_form, $rec, $accion, $item_id);
        /**
         * Guardo los datos ya procesados
         */
        $campo_id = "itemId";
        $where = "";
        $tabla = $tabla;
        $res = $this->item_update_sbm($itemId, $respuesta_procesa, $tabla, $accion, $campo_id, $where);
        $res["accion"] = $accion;

        return $res;
    }

    /**
     * Función que valida los campos a ser guardados
     **/
    function procesa_datos($que_form, $rec, $accion = "new")
    {
        $dato_resultado = array();
        switch ($que_form) {
            case 'campos_proyecto_metas':
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

    function get_item($idItem, $tipoTabla, $variante = "")
    {
        $this->dbm->SetFetchMode(ADODB_FETCH_ASSOC);
        $info = '';
        if ($idItem != '') {
            if ($tipoTabla == 'item') {
                $sqlSelect = ' i.*
                           , CONCAT_WS(" ",u1.nombre,u1.apellido) as userCreater
                           , CONCAT_WS(" ",u2.nombre,u2.apellido) as userUpdater';
                $sqlFrom = ' ' . $this->tabla[$tipoTabla] . ' i
                         LEFT JOIN ' . $this->tabla["o_usuario"] . ' u1 on u1.itemId=i.userCreate
                         LEFT JOIN ' . $this->tabla["o_usuario"] . ' u2 on u2.itemId=i.userUpdate';
                $sqlWhere = ' i.itemId=' . $idItem;
                $sqlGroup = ' GROUP BY i.itemId';
            } else {
                $sqlSelect = ' i.*';
                $sqlFrom = ' ' . $this->tabla[$tipoTabla] . ' i ';
                $sqlWhere = ' i.itemId=' . $idItem;
                $sqlGroup = '';
            }

            $sql = 'SELECT ' . $sqlSelect . '
                  FROM ' . $sqlFrom . '
                  WHERE ' . $sqlWhere . '
                  ' . $sqlGroup;
            $info = $this->dbm->Execute($sql);
            $info = $info->fields;
        }
        return $info;
    }

    public function get_item_datatable_Rows($id)
    {
        global $db_conf_datatable;
        /**
         * tabla de la base de datos que listaremos
         */
        $table = $this->tabla["proyecto_metas"];
        /**
         * El nombre del campo que guarda id principal
         */
        $primaryKey = "itemId";
        /**
         * Que configuraciòn de grilla utilizaremos
         */
        $grilla = "grilla_proyecto_metas";
        /**
         * la configuración de base de datos que utilizaremos
         * que se la realiza en inc/db.php
         */
        $db = $db_conf_datatable["principal"];
        /**
         * Configuraciones adicionales
         */
        $extraWhere = "proy_itemid=" . $id;
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
    function item_delete($id, $campo_referencia, $tabla_referencia)
    {
        $campo_id = $campo_referencia;
        $where = "";
        $res = $this->item_delete_sbm($id, $campo_id, $this->tabla[$tabla_referencia], $where);
        return $res;
    }

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
        $sql = "SELECT t1.itemId, t2.nombre AS detalle, t1.meta_itemid, t1.linea_base, t1.meta, '' AS total, '' AS descrip, t3.itemId AS cat_itemid, t3.nombre AS categoria 
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
      
         
}
