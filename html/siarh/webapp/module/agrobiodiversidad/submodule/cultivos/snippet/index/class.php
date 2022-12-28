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

    public function get_item_datatable_Rows(){
        global $db_conf_datatable;
        /**
         * tabla de la base de datos que listaremos
         */
        $table = $this->tabla["cultivos"];
        /**
         * El nombre del campo que guarda id principal
         */
        $primaryKey = "itemId";
        /**
         * Que configuraciòn de grilla utilizaremos
         */
        $grilla = "grilla_cultivos";
        /**
         * la configuración de base de datos que utilizaremos
         * que se la realiza en inc/db.php
         */
        $db = $db_conf_datatable["principal"];
        /**
         * Configuraciones adicionales
         */
        $extraWhere = "";
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
        $res = $this->item_delete_sbm($id, $campo_id, $this->tabla[$tabla_referencia], $where);
        return $res;
    }

    /**
     * Método que genera ficha de la especie
     */
    public function getFicha($id) {
        //Crear documento a partir de plantilla
        $archivo = 'cultivos.docx';
        $doc = new \PhpOffice\PhpWord\TemplateProcessor('module/agrobiodiversidad/submodule/cultivos/snippet/index/templates/'.$archivo);

        //Consulta información a la base de datos
        $info_general = $this->get_info_general($id);
        //$info_productor_custodio = $this->get_info_productor_custodio($id);
        //$info_proyectos = $this->get_info_proyectos($id);
        //$info_adicional = $this->get_info_adicional($id);
        //$info_adjuntos = $this->get_info_adjuntos($id);
        
        //Datos información general
        $doc->setValue('especie', $info_general[0]['especie']);
        $doc->setValue('ecotipo', $info_general[0]['ecotipo']);
        $doc->setValue('especie_asocia_cultivo', $info_general[0]['especie_asocia_cultivo']);
        $doc->setValue('vinculacion', $info_general[0]['vinculacion']);
        $doc->setValue('clase_vinculacion', $info_general[0]['clase_vinculacion']);
        $doc->setValue('espemain', $info_general[0]['espemain']);
        $doc->setValue('cantidad', $info_general[0]['cantidad']);
        $doc->setValue('unidad_medida', $info_general[0]['unidad_medida']);
        $doc->setValue('espe_adicional', $info_general[0]['espe_adicional']);
        $doc->setValue('superficie', $info_general[0]['superficie']);
        $doc->setValue('superficie_amplia', $info_general[0]['superficie_amplia']);
        $doc->setValue('cod_certifica', $info_general[0]['cod_certifica']);
        $doc->setValue('densidad', $info_general[0]['densidad']);
        $doc->setValue('unidad_medida_densidad', $info_general[0]['unidad_medida_densidad']);
        $doc->setValue('cant_recolectada', $info_general[0]['cant_recolectada']);
        $doc->setValue('destino_conserva', $info_general[0]['destino_conserva']);
        $doc->setValue('destino_autoconsumo', $info_general[0]['destino_autoconsumo']);
        $doc->setValue('destino_comercia', $info_general[0]['destino_comercia']);
        $doc->setValue('precio_comercia', $info_general[0]['precio_comercia']);
        $doc->setValue('cant_familias', $info_general[0]['cant_familias']);
        $doc->setValue('cant_materia_prima', $info_general[0]['cant_materia_prima']);
        $doc->setValue('producto', $info_general[0]['producto']);
        $doc->setValue('cant_producto', $info_general[0]['cant_producto']);
        $doc->setValue('precio_produccion', $info_general[0]['precio_produccion']);
        $doc->setValue('precio_venta', $info_general[0]['precio_venta']);
        $doc->setValue('operarios', $info_general[0]['operarios']);
        $doc->setValue('macroregion', $info_general[0]['macroregion']);
        $doc->setValue('depto', $info_general[0]['depto']);
        $doc->setValue('municipio', $info_general[0]['municipio']);
        $doc->setValue('comunidad', $info_general[0]['comunidad']);
        $doc->setValue('zona', $info_general[0]['zona']);
        $doc->setValue('longitud', $info_general[0]['longitud']);
        $doc->setValue('latitud', $info_general[0]['latitud']);
        $doc->setValue('utm_norte', $info_general[0]['utm_norte']);
        $doc->setValue('utm_este', $info_general[0]['utm_este']);
        $doc->setValue('utm_zona', $info_general[0]['utm_zona']);
        $doc->setValue('altitud', $info_general[0]['altitud']);
        $doc->setValue('fecha', $info_general[0]['fecha']);

        //Datos información productor custodio
        $doc->setValue('prod_organizacion', htmlspecialchars($info_productor_custodio[0]['prod_organizacion']));
        $doc->setValue('prod_nombres_apellidos', htmlspecialchars($info_productor_custodio[0]['prod_nombres_apellidos']));
        $doc->setValue('prod_ci', $info_productor_custodio[0]['prod_ci']);
        $doc->setValue('prod_sexo', $info_productor_custodio[0]['prod_sexo']);
        $doc->setValue('prod_celular', $info_productor_custodio[0]['prod_celular']);
        $doc->setValue('cus_nombres_apellidos', htmlspecialchars($info_productor_custodio[0]['cus_nombres_apellidos']));
        $doc->setValue('cus_ci', $info_productor_custodio[0]['cus_ci']);
        $doc->setValue('cus_sexo', $info_productor_custodio[0]['cus_sexo']);
        $doc->setValue('cus_celular', $info_productor_custodio[0]['cus_celular']);

        //Datos información proyectos
        $contador = 1;
        $tamanio = count($info_proyectos);
        $doc->cloneRow('proyecto.nombre', $tamanio);
        for ($i=0; $i < $tamanio; $i++) {
            $doc->setValue('proyecto.nombre#'.$contador, htmlspecialchars($info_proyectos[$i]['nombre']));
            $doc->setValue('proyecto.objetivo#'.$contador, htmlspecialchars($info_proyectos[$i]['objetivo_principal']));
            $doc->setValue('proyecto.descrip#'.$contador, htmlspecialchars($info_proyectos[$i]['descrip']));
            $contador++;
        }

        //Datos información adicional
        $doc->setValue('gestion', $info_adicional[0]['gestion']);
        
        //Datos información de archivos adjuntos
        $contador = 1;
        $tamanio = count($info_adjuntos);
        $doc->cloneRow('adjunto.nombre', $tamanio);
        for ($i=0; $i < $tamanio; $i++) {
            $doc->setValue('adjunto.nombre#'.$contador, htmlspecialchars($info_adjuntos[$i]['adjunto_nombre']));
            $doc->setValue('adjunto.descrip#'.$contador, htmlspecialchars($info_adjuntos[$i]['descrip']));
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
     * Función que obtiene informacion general de cultivo
     **/
    function get_info_general($id){
        global $db_conf_datatable;
        $db_conf = $db_conf_datatable["principal"];
        $dbm = ADONewConnection($db_conf["type"]);
        $dbm->Connect($db_conf["server"],$db_conf["user"] ,$db_conf["password"],$db_conf["database"]) or die("ERROR CONNECT " . $db_conf["database"]);
        $dbm->setCharset('utf8');
        $dbm->SetFetchMode(ADODB_FETCH_ASSOC);
        $sql = "SELECT t2.nombre_comun AS especie,
        t3.nombre AS ecotipo,
        t1.especie_asocia_cultivo,
        t4.nombre AS vinculacion,
        t5.nombre AS clase_vinculacion,
        t6.nombre_comun AS espemain,
        t1.cantidad,
        t1.unidad_medida,
        t1.espe_adicional,
        t1.superficie,
        t1.superficie_amplia,
        t1.cod_certifica,
        t1.densidad,
        t1.unidad_medida_densidad,
        t1.cant_recolectada,
        t1.destino_conserva,
        t1.destino_autoconsumo,
        t1.destino_comercia,
        t1.precio_comercia,
        t1.cant_familias,
        t1.cant_materia_prima,
        t1.producto,
        t1.cant_producto,
        t1.precio_produccion,
        t1.precio_venta,
        t1.operarios,
        t7.descrip AS macroregion,
        t8.nombre AS depto,
        t9.municipio,
        t1.comunidad,
        t1.zona,
        t1.longitud,
        t1.latitud,
        t1.utm_norte,
        t1.utm_este,
        t1.utm_zona,
        t1.altitud,
        DATE_FORMAT(t1.fecha, '%d/%m/%Y') AS fecha
        FROM cultivos t1
        INNER JOIN especies t2
        ON t1.espe_itemid=t2.itemId
        INNER JOIN especie_ecotipos t3
        ON t1.ecotipo_itemid=t3.itemId
        INNER JOIN catalogo_vinculaciones t4
        ON t1.vincula_itemid=t4.itemId
        INNER JOIN catalogo_clases_vinculacion t5
        ON t1.clasevincula_itemid=t5.itemId
        LEFT JOIN especies t6
        ON t1.espemain_itemid=t6.itemId
        INNER JOIN mapa_macroregiones t7
        ON t1.macroreg_itemid=t7.id
        INNER JOIN mapa_departamentos t8
        ON t1.depto_itemid=t8.id
        INNER JOIN mapa_municipios t9
        ON t1.municipio_itemid=t9.id
        WHERE t1.itemId=".$id;
        $datos = $dbm->Execute($sql);
        $respuesta = $datos->GetRows();
        $dbm->Close();
        return $respuesta;
    }

    /**
     * Función que obtiene informacion de productor custodio
     **/
    function get_info_productor_custodio($id){
        global $db_conf_datatable;
        $db_conf = $db_conf_datatable["principal"];
        $dbm = ADONewConnection($db_conf["type"]);
        $dbm->Connect($db_conf["server"],$db_conf["user"] ,$db_conf["password"],$db_conf["database"]) or die("ERROR CONNECT " . $db_conf["database"]);
        $dbm->setCharset('utf8');
        $dbm->SetFetchMode(ADODB_FETCH_ASSOC);
        $sql = "SELECT prod_organizacion,
        prod_nombres_apellidos,
        prod_ci,
        prod_sexo,
        prod_celular,
        cus_nombres_apellidos,
        cus_ci,
        cus_sexo,
        cus_celular
        FROM cultivo_productores_custodios
        WHERE itemId=".$id;
        $datos = $dbm->Execute($sql);
        $respuesta = $datos->GetRows();
        $dbm->Close();
        return $respuesta;
    }

    /**
     * Función que obtiene informacion de proyectos del cultivo
     **/
    function get_info_proyectos($id){
        global $db_conf_datatable;
        $db_conf = $db_conf_datatable["principal"];
        $dbm = ADONewConnection($db_conf["type"]);
        $dbm->Connect($db_conf["server"],$db_conf["user"] ,$db_conf["password"],$db_conf["database"]) or die("ERROR CONNECT " . $db_conf["database"]);
        $dbm->setCharset('utf8');
        $dbm->SetFetchMode(ADODB_FETCH_ASSOC);
        $sql = "SELECT cp.itemId, p.nombre, p.objetivo_principal, p.descrip
        FROM proyectos p INNER JOIN cultivo_proyectos cp
        ON p.itemId=cp.proy_itemid
        WHERE cp.cult_itemid=".$id;
        $datos = $dbm->Execute($sql);
        $respuesta = $datos->GetRows();
        $dbm->Close();
        return $respuesta;
    }

    /**
     * Función que obtiene informacion adicional del cultivo
     **/
    function get_info_adicional($id){
        global $db_conf_datatable;
        $db_conf = $db_conf_datatable["principal"];
        $dbm = ADONewConnection($db_conf["type"]);
        $dbm->Connect($db_conf["server"],$db_conf["user"] ,$db_conf["password"],$db_conf["database"]) or die("ERROR CONNECT " . $db_conf["database"]);
        $dbm->setCharset('utf8');
        $dbm->SetFetchMode(ADODB_FETCH_ASSOC);
        $sql = "SELECT gestion
        FROM cultivo_informacion_adicional
        WHERE itemId=".$id;
        $datos = $dbm->Execute($sql);
        $respuesta = $datos->GetRows();
        $dbm->Close();
        return $respuesta;
    }

    /**
     * Función que obtiene informacion de archivos adjuntos del cultivo
     **/
    function get_info_adjuntos($id){
        global $db_conf_datatable;
        $db_conf = $db_conf_datatable["principal"];
        $dbm = ADONewConnection($db_conf["type"]);
        $dbm->Connect($db_conf["server"],$db_conf["user"] ,$db_conf["password"],$db_conf["database"]) or die("ERROR CONNECT " . $db_conf["database"]);
        $dbm->setCharset('utf8');
        $dbm->SetFetchMode(ADODB_FETCH_ASSOC);
        $sql = "SELECT adjunto_nombre, descrip
        FROM cultivo_adjuntos
        WHERE cult_itemid=".$id;
        $datos = $dbm->Execute($sql);
        $respuesta = $datos->GetRows();
        $dbm->Close();
        return $respuesta;
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

}
