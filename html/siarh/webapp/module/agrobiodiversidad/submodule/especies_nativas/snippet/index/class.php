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
        $table = $this->tabla["especies_nativas"];
        /**
         * El nombre del campo que guarda id principal
         */
        $primaryKey = "itemId";
        /**
         * Que configuraciòn de grilla utilizaremos
         */
        $grilla = "grilla_especies_nativas";
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
        $archivo = 'especies_nativas.docx';
        $doc = new \PhpOffice\PhpWord\TemplateProcessor('module/agrobiodiversidad/submodule/especies_nativas/snippet/index/templates/'.$archivo);

        //Consulta información a la base de datos
        $info_general = $this->get_info_general($id);
        $info_macroregiones = $this->get_info_macroregiones($id);
        $info_departamentos = $this->get_info_departamentos($id);
        $info_municipios = $this->get_info_municipios($id);
        $info_adjuntos = $this->get_info_adjuntos($id);
        
        //Datos información general
        $doc->setValue('nombre_comun', $info_general[0]['nombre_comun']);
        $doc->setValue('nombre_cientifico', $info_general[0]['nombre_cientifico']);
        $doc->setValue('nombre_vernacular', $info_general[0]['nombre_vernacular']);
        $doc->setValue('carac_botanicas', $info_general[0]['carac_botanicas']);
        $doc->setValue('com_cultiva_aprovecha', $info_general[0]['com_cultiva_aprovecha']);
        $doc->setValue('categoria_uso', $info_general[0]['categoria_uso']);
        $doc->setValue('tiempo_uso', $info_general[0]['tiempo_uso']);
        $doc->setValue('rel_etnobotanica', $info_general[0]['rel_etnobotanica']);
        $doc->setValue('carac_bioculturales', $info_general[0]['carac_bioculturales']);
        $doc->setValue('status_conservacion', $info_general[0]['status_conservacion']);
        $doc->setValue('codigo_registro', $info_general[0]['codigo_registro']);
        $doc->setValue('macroregiones', $info_macroregiones[0]['macroregiones']);
        $doc->setValue('deptos', $info_departamentos[0]['deptos']);
        $doc->setValue('municipios', $info_municipios[0]['municipios']);
        
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
     * Función que obtiene informacion general de especie nativa
     **/
    function get_info_general($id){
        global $db_conf_datatable;
        $db_conf = $db_conf_datatable["principal"];
        $dbm = ADONewConnection($db_conf["type"]);
        $dbm->Connect($db_conf["server"],$db_conf["user"] ,$db_conf["password"],$db_conf["database"]) or die("ERROR CONNECT " . $db_conf["database"]);
        $dbm->setCharset('utf8');
        $dbm->SetFetchMode(ADODB_FETCH_ASSOC);
        $sql = "SELECT t1.itemId, 
        t1.nombre_comun, 
        t1.nombre_cientifico, 
        t1.nombre_vernacular, 
        t1.carac_botanicas, 
        t1.com_cultiva_aprovecha, 
        t2.nombre AS categoria_uso, 
        t1.tiempo_uso, 
        t1.rel_etnobotanica, 
        t1.carac_bioculturales, 
        t3.nombre AS status_conservacion, 
        t1.codigo_registro 
        FROM especies_nativas t1 
        INNER JOIN catalogo_categorias_uso t2 
        ON t1.catuso_itemid=t2.itemId 
        INNER JOIN catalogo_status_conservacion t3 
        ON t1.statusconserva_itemid=t3.itemId 
        WHERE t1.itemId=".$id;
        $datos = $dbm->Execute($sql);
        $respuesta = $datos->GetRows();
        $dbm->Close();
        return $respuesta;
    }

    /**
     * Función que obtiene informacion de macroregiones de la especie nativa
     **/
    function get_info_macroregiones($id){
        global $db_conf_datatable;
        $db_conf = $db_conf_datatable["principal"];
        $dbm = ADONewConnection($db_conf["type"]);
        $dbm->Connect($db_conf["server"],$db_conf["user"] ,$db_conf["password"],$db_conf["database"]) or die("ERROR CONNECT " . $db_conf["database"]);
        $dbm->setCharset('utf8');
        $dbm->SetFetchMode(ADODB_FETCH_ASSOC);
        $sql = "SELECT GROUP_CONCAT(t2.descrip) AS macroregiones 
        FROM especie_nativa_macroregiones t1 INNER JOIN mapa_macroregiones t2 
        ON t1.macroreg_itemid=t2.id 
        WHERE t1.espenativa_itemid=".$id;
        $datos = $dbm->Execute($sql);
        $respuesta = $datos->GetRows();
        $dbm->Close();
        return $respuesta;
    }

    /**
     * Función que obtiene informacion de macroregiones de la especie nativa
     **/
    function get_info_departamentos($id){
        global $db_conf_datatable;
        $db_conf = $db_conf_datatable["principal"];
        $dbm = ADONewConnection($db_conf["type"]);
        $dbm->Connect($db_conf["server"],$db_conf["user"] ,$db_conf["password"],$db_conf["database"]) or die("ERROR CONNECT " . $db_conf["database"]);
        $dbm->setCharset('utf8');
        $dbm->SetFetchMode(ADODB_FETCH_ASSOC);
        $sql = "SELECT GROUP_CONCAT(t2.nombre) AS deptos 
        FROM especie_nativa_deptos t1 INNER JOIN mapa_departamentos t2 
        ON t1.depto_itemid=t2.id 
        WHERE t1.espenativa_itemid=".$id;
        $datos = $dbm->Execute($sql);
        $respuesta = $datos->GetRows();
        $dbm->Close();
        return $respuesta;
    }

    /**
     * Función que obtiene informacion de municipios de la especie nativa
     **/
    function get_info_municipios($id){
        global $db_conf_datatable;
        $db_conf = $db_conf_datatable["principal"];
        $dbm = ADONewConnection($db_conf["type"]);
        $dbm->Connect($db_conf["server"],$db_conf["user"] ,$db_conf["password"],$db_conf["database"]) or die("ERROR CONNECT " . $db_conf["database"]);
        $dbm->setCharset('utf8');
        $dbm->SetFetchMode(ADODB_FETCH_ASSOC);
        $sql = "SELECT GROUP_CONCAT(t2.municipio) AS municipios 
        FROM especie_nativa_municipios t1 INNER JOIN mapa_municipios t2 
        ON t1.municipio_itemid=t2.id 
        WHERE t1.espenativa_itemid=".$id;
        $datos = $dbm->Execute($sql);
        $respuesta = $datos->GetRows();
        $dbm->Close();
        return $respuesta;
    }

    /**
     * Función que obtiene informacion de archivos adjuntos de la especie nativa
     **/
    function get_info_adjuntos($id){
        global $db_conf_datatable;
        $db_conf = $db_conf_datatable["principal"];
        $dbm = ADONewConnection($db_conf["type"]);
        $dbm->Connect($db_conf["server"],$db_conf["user"] ,$db_conf["password"],$db_conf["database"]) or die("ERROR CONNECT " . $db_conf["database"]);
        $dbm->setCharset('utf8');
        $dbm->SetFetchMode(ADODB_FETCH_ASSOC);
        $sql = "SELECT adjunto_nombre, descrip 
        FROM especie_nativa_adjuntos 
        WHERE espenativa_itemid=".$id;
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
