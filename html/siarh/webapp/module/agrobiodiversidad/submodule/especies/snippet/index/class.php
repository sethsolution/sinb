<?php
/**
 * Created by PhpStorm.
 * User: henrytaby
 * Date: 3/5/2018
 * Time: 15:23
 */
use PhpOffice\PhpWord\TemplateProcessor;

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
        $table = $this->tabla["especies"];
        /**
         * El nombre del campo que guarda id principal
         */
        $primaryKey = "itemId";
        /**
         * Que configuraciòn de grilla utilizaremos
         */
        $grilla = "grilla_especies";
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
        $archivo = 'especies.docx';
        $doc = new \PhpOffice\PhpWord\TemplateProcessor('module/agrobiodiversidad/submodule/especies/snippet/index/templates/'.$archivo);

        //Consulta información a la base de datos
        $info_general = $this->get_info_general($id);
        $info_municipios = $this->get_info_municipios($id);
        $info_nutricional = $this->get_info_nutricional($id);
        $info_ecotipos = $this->get_info_ecotipos($id);
        $info_descriptores = $this->get_info_descriptores($id);
        $info_proyectos = $this->get_info_proyectos($id);
        $info_adicional = $this->get_info_adicional($id);
        $info_adjuntos = $this->get_info_adjuntos($id);
        
        //Datos información general
        $doc->setValue('nombre_comun', $info_general[0]['nombre_comun']);
        $doc->setValue('nombre_cientifico', $info_general[0]['nombre_cientifico']);
        $doc->setValue('categoria', $info_general[0]['categoria']);
        $doc->setValue('macroregion', $info_general[0]['macroregion']);
        $doc->setValue('municipios', $info_municipios[0]['municipios']);
        $doc->setValue('division', $info_general[0]['division']);
        $doc->setValue('clase', $info_general[0]['clase']);
        $doc->setValue('orden', $info_general[0]['orden']);
        $doc->setValue('familia', $info_general[0]['familia']);
        $doc->setValue('genero', $info_general[0]['genero']);
        $doc->setValue('especie', $info_general[0]['especie']);
        $doc->setValue('subespecie', $info_general[0]['subespecie']);
        $doc->setValue('descrip', $info_general[0]['descrip']);

        //Datos información nutricional
        $contador = 1;
        $tamanio = count($info_nutricional);
        $doc->cloneRow('infonutri.compuesto', $tamanio);
        for ($i=0; $i < $tamanio; $i++) {
            $doc->setValue('infonutri.compuesto#'.$contador, htmlspecialchars($info_nutricional[$i]['compuesto']));
            $doc->setValue('infonutri.unidad#'.$contador, htmlspecialchars($info_nutricional[$i]['unidad']));
            $doc->setValue('infonutri.valor#'.$contador, $info_nutricional[$i]['valor']);
            $doc->setValue('infonutri.grupo#'.$contador, $info_nutricional[$i]['grupo']);
            $contador++;
        }

        //Datos información ecotipos
        $contador = 1;
        $tamanio = count($info_ecotipos);
        $doc->cloneRow('ecotipo.nombre', $tamanio);
        for ($i=0; $i < $tamanio; $i++) {
            $doc->setValue('ecotipo.nombre#'.$contador, htmlspecialchars($info_ecotipos[$i]['nombre']));
            $doc->setValue('ecotipo.descrip#'.$contador, htmlspecialchars($info_ecotipos[$i]['descrip']));
            $contador++;
        }

        //Datos información de descriptores
        $doc->setValue('descrip_carac_planta', htmlspecialchars($info_descriptores[0]['carac_planta']));
        $doc->setValue('descrip_habito_crecimiento', htmlspecialchars($info_descriptores[0]['habito_crecimiento']));
        $doc->setValue('descrip_altura_planta', htmlspecialchars($info_descriptores[0]['altura_planta']));
        $doc->setValue('descrip_carac_floracion', htmlspecialchars($info_descriptores[0]['carac_floracion']));
        $doc->setValue('descrip_carac_hojas', htmlspecialchars($info_descriptores[0]['carac_hojas']));
        $doc->setValue('descrip_carac_tallo', htmlspecialchars($info_descriptores[0]['carac_tallo']));
        $doc->setValue('descrip_carac_area_aprovechable', htmlspecialchars($info_descriptores[0]['carac_area_aprovechable']));

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
        $doc->setValue('metodo_conservacion', htmlspecialchars($info_adicional[0]['metodo_conservacion']));
        $doc->setValue('estrategia_conservacion', htmlspecialchars($info_adicional[0]['estrategia_conservacion']));
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
     * Función que obtiene informacion general de especie
     **/
    function get_info_general($id){
        global $db_conf_datatable;
        $db_conf = $db_conf_datatable["principal"];
        $dbm = ADONewConnection($db_conf["type"]);
        $dbm->Connect($db_conf["server"],$db_conf["user"] ,$db_conf["password"],$db_conf["database"]) or die("ERROR CONNECT " . $db_conf["database"]);
        $dbm->setCharset('utf8');
        $dbm->SetFetchMode(ADODB_FETCH_ASSOC);
        $sql = "SELECT e.itemId, e.nombre_comun, e.nombre_cientifico, cc.nombre AS categoria,
        mm.descrip AS macroregion,
        td.nombre AS division,
        tc.nombre AS clase,
        tor.nombre AS orden,
        tf.nombre AS familia,
        tg.nombre AS genero,
        te.nombre AS especie,
        e.subespecie,
        e.descrip
        FROM especies e
        INNER JOIN catalogo_categorias cc
        ON e.cat_itemid=cc.itemId
        INNER JOIN mapa_macroregiones mm
        ON e.macroreg_itemid=mm.id
        INNER JOIN catalogo_taxonomia_division td
        ON e.taxdiv_itemid=td.itemId
        INNER JOIN catalogo_taxonomia_clase tc
        ON e.taxclase_itemid=tc.itemId
        INNER JOIN catalogo_taxonomia_orden tor
        ON e.taxorden_itemid=tor.itemId
        INNER JOIN catalogo_taxonomia_familia tf
        ON e.taxfam_itemid=tf.itemId
        INNER JOIN catalogo_taxonomia_genero tg
        ON e.taxgen_itemid=tg.itemId
        INNER JOIN catalogo_taxonomia_especie te
        ON e.taxespe_itemid=te.itemId
        WHERE e.itemId=".$id;
        $datos = $dbm->Execute($sql);
        $respuesta = $datos->GetRows();
        $dbm->Close();
        return $respuesta;
    }

    /**
     * Función que obtiene informacion de municipios de la especie
     **/
    function get_info_municipios($id){
        global $db_conf_datatable;
        $db_conf = $db_conf_datatable["principal"];
        $dbm = ADONewConnection($db_conf["type"]);
        $dbm->Connect($db_conf["server"],$db_conf["user"] ,$db_conf["password"],$db_conf["database"]) or die("ERROR CONNECT " . $db_conf["database"]);
        $dbm->setCharset('utf8');
        $dbm->SetFetchMode(ADODB_FETCH_ASSOC);
        $sql = "SELECT GROUP_CONCAT(mm.municipio) AS municipios
        FROM especie_municipios em INNER JOIN mapa_municipios mm
        ON em.municipio_itemid=mm.id
        WHERE espe_itemid=".$id;
        $datos = $dbm->Execute($sql);
        $respuesta = $datos->GetRows();
        $dbm->Close();
        return $respuesta;
    }

    /**
     * Función que obtiene informacion nutricional de especie
     **/
    function get_info_nutricional($id){
        global $db_conf_datatable;
        $db_conf = $db_conf_datatable["principal"];
        $dbm = ADONewConnection($db_conf["type"]);
        $dbm->Connect($db_conf["server"],$db_conf["user"] ,$db_conf["password"],$db_conf["database"]) or die("ERROR CONNECT " . $db_conf["database"]);
        $dbm->setCharset('utf8');
        $dbm->SetFetchMode(ADODB_FETCH_ASSOC);
        $sql = "SELECT e.itemId, cc.nombre AS compuesto, COALESCE(e.valor,'') AS valor, 
        cc.medida AS unidad,
        cga.nombre AS grupo
        FROM especie_informacion_nutricional e 
        INNER JOIN catalogo_compuestos cc 
        ON e.compuesto_itemid=cc.itemId 
        INNER JOIN catalogo_grupos_analisis cga 
        ON cc.grpanalisis_itemid=cga.itemId 
        AND e.espe_itemid=".$id." 
        ORDER BY cc.itemId, cc.grpanalisis_itemid ASC";
        $datos = $dbm->Execute($sql);
        $respuesta = $datos->GetRows();
        $dbm->Close();
        return $respuesta;
    }

    /**
     * Función que obtiene informacion de ecotipos de la especie
     **/
    function get_info_ecotipos($id){
        global $db_conf_datatable;
        $db_conf = $db_conf_datatable["principal"];
        $dbm = ADONewConnection($db_conf["type"]);
        $dbm->Connect($db_conf["server"],$db_conf["user"] ,$db_conf["password"],$db_conf["database"]) or die("ERROR CONNECT " . $db_conf["database"]);
        $dbm->setCharset('utf8');
        $dbm->SetFetchMode(ADODB_FETCH_ASSOC);
        $sql = "SELECT itemId, nombre, descrip
        FROM especie_ecotipos
        WHERE espe_itemid=".$id." 
        ORDER BY nombre ASC";
        $datos = $dbm->Execute($sql);
        $respuesta = $datos->GetRows();
        $dbm->Close();
        return $respuesta;
    }

    /**
     * Función que obtiene informacion de descriptor de la especie
     **/
    function get_info_descriptores($id){
        global $db_conf_datatable;
        $db_conf = $db_conf_datatable["principal"];
        $dbm = ADONewConnection($db_conf["type"]);
        $dbm->Connect($db_conf["server"],$db_conf["user"] ,$db_conf["password"],$db_conf["database"]) or die("ERROR CONNECT " . $db_conf["database"]);
        $dbm->setCharset('utf8');
        $dbm->SetFetchMode(ADODB_FETCH_ASSOC);
        $sql = "SELECT *
        FROM especie_descriptores
        WHERE itemId=".$id;
        $datos = $dbm->Execute($sql);
        $respuesta = $datos->GetRows();
        $dbm->Close();
        return $respuesta;
    }

    /**
     * Función que obtiene informacion de proyectos de la especie
     **/
    function get_info_proyectos($id){
        global $db_conf_datatable;
        $db_conf = $db_conf_datatable["principal"];
        $dbm = ADONewConnection($db_conf["type"]);
        $dbm->Connect($db_conf["server"],$db_conf["user"] ,$db_conf["password"],$db_conf["database"]) or die("ERROR CONNECT " . $db_conf["database"]);
        $dbm->setCharset('utf8');
        $dbm->SetFetchMode(ADODB_FETCH_ASSOC);
        $sql = "SELECT ep.itemId, p.nombre, p.objetivo_principal, p.descrip
        FROM proyectos p INNER JOIN especie_proyectos ep
        ON p.itemId=ep.proy_itemid
        WHERE ep.espe_itemid=".$id;
        $datos = $dbm->Execute($sql);
        $respuesta = $datos->GetRows();
        $dbm->Close();
        return $respuesta;
    }

    /**
     * Función que obtiene informacion adicional de la especie
     **/
    function get_info_adicional($id){
        global $db_conf_datatable;
        $db_conf = $db_conf_datatable["principal"];
        $dbm = ADONewConnection($db_conf["type"]);
        $dbm->Connect($db_conf["server"],$db_conf["user"] ,$db_conf["password"],$db_conf["database"]) or die("ERROR CONNECT " . $db_conf["database"]);
        $dbm->setCharset('utf8');
        $dbm->SetFetchMode(ADODB_FETCH_ASSOC);
        $sql = "SELECT cmc.nombre AS metodo_conservacion, cec.nombre AS estrategia_conservacion, eia.gestion
        FROM especie_informacion_adicional eia
        INNER JOIN catalogo_metodos_conservacion cmc
        ON eia.metconserva_itemid=cmc.itemId
        INNER JOIN catalogo_estrategias_conservacion cec
        ON eia.econserva_itemid=cec.itemId
        WHERE eia.itemId=".$id;
        $datos = $dbm->Execute($sql);
        $respuesta = $datos->GetRows();
        $dbm->Close();
        return $respuesta;
    }

    /**
     * Función que obtiene informacion de archivos adjuntos de la especie
     **/
    function get_info_adjuntos($id){
        global $db_conf_datatable;
        $db_conf = $db_conf_datatable["principal"];
        $dbm = ADONewConnection($db_conf["type"]);
        $dbm->Connect($db_conf["server"],$db_conf["user"] ,$db_conf["password"],$db_conf["database"]) or die("ERROR CONNECT " . $db_conf["database"]);
        $dbm->setCharset('utf8');
        $dbm->SetFetchMode(ADODB_FETCH_ASSOC);
        $sql = "SELECT adjunto_nombre, descrip
        FROM especie_adjuntos
        WHERE espe_itemid=".$id;
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
