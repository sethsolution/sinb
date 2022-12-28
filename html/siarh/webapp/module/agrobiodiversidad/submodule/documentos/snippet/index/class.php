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
        $table = $this->tabla["documentos"];
        /**
         * El nombre del campo que guarda id principal
         */
        $primaryKey = "itemId";
        /**
         * Que configuraciòn de grilla utilizaremos
         */
        $grilla = "grilla_documentos";
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
     * Funcion que recupera un registro de la tabla documentos
     **/
    function obtenerArchivo($id) {
        global $db_conf_datatable;
        $db_conf = $db_conf_datatable["principal"];
        $dbm = ADONewConnection($db_conf["type"]);
        $dbm->Connect($db_conf["server"],$db_conf["user"] ,$db_conf["password"],$db_conf["database"]) or die("ERROR CONNECT " . $db_conf["database"]);
        $dbm->setCharset('utf8');
        $dbm->SetFetchMode(ADODB_FETCH_ASSOC);
        $sql = "SELECT itemId, adjunto_nombre, adjunto_extension, adjunto_tipo, adjunto_tamano 
        FROM documentos 
        WHERE itemId=".$id." LIMIT 1";
        $datos = $dbm->Execute($sql);
        $datos = $datos->fields;
        $dbm->Close();
        return $datos;
    }

    /**
     * Funcion que recupera un archivo y lo envia para descarga
     **/
    function descargarArchivo($id) {
        $item = $this->obtenerArchivo($id);
        if($item["itemId"] != "") {
            $dir  = $this->get_dir_item_archivo_sbm($id);
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
            echo "<center><b><font color='red' face='arial'>El archivo no existe.</font></b></center>";
            exit;
        }
    }

    /**
     * Método que genera ficha de la especie
     */
    public function getFicha($id) {
        //Crear documento a partir de plantilla
        $archivo = 'documentos.docx';
        $doc = new \PhpOffice\PhpWord\TemplateProcessor('module/agrobiodiversidad/submodule/documentos/snippet/index/templates/'.$archivo);

        //Consulta información a la base de datos
        $info_general = $this->get_info_general($id);
        $info_proyectos = $this->get_info_proyectos($id);
        
        //Datos información general
        $doc->setValue('titulo', $info_general[0]['titulo']);
        $doc->setValue('territorio', $info_general[0]['territorio']);
        $doc->setValue('anio_publicacion', $info_general[0]['anio_publicacion']);
        $doc->setValue('pais_origen', $info_general[0]['pais_origen']);
        $doc->setValue('autor', $info_general[0]['autor']);
        $doc->setValue('nombre_cientifico', $info_general[0]['nombre_cientifico']);
        $doc->setValue('macroregion', $info_general[0]['macroregion']);
        $doc->setValue('tipo', $info_general[0]['tipo']);
        $doc->setValue('eje_tematico', $info_general[0]['eje_tematico']);
        $doc->setValue('especies', $info_general[0]['especies']);
        $doc->setValue('adjunto_nombre', $info_general[0]['adjunto_nombre']);
        $doc->setValue('adjunto_tamano', $info_general[0]['adjunto_tamano']);
        $doc->setValue('adjunto_extension', $info_general[0]['adjunto_extension']);

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
     * Función que obtiene informacion general de documento
     **/
    function get_info_general($id){
        global $db_conf_datatable;
        $db_conf = $db_conf_datatable["principal"];
        $dbm = ADONewConnection($db_conf["type"]);
        $dbm->Connect($db_conf["server"],$db_conf["user"] ,$db_conf["password"],$db_conf["database"]) or die("ERROR CONNECT " . $db_conf["database"]);
        $dbm->setCharset('utf8');
        $dbm->SetFetchMode(ADODB_FETCH_ASSOC);
        $sql = "SELECT t1.titulo,
        t2.nombre AS territorio,
        t1.anio_publicacion,
        t1.pais_origen,
        t1.autor,
        t1.nombre_cientifico,
        t3.descrip AS macroregion,
        t4.nombre AS tipo,
        t5.nombre AS eje_tematico,
        t1.especies,
        t1.adjunto_nombre,
        t1.adjunto_extension,
        ROUND((t1.adjunto_tamano/1024)) AS adjunto_tamano
        FROM documentos t1
        INNER JOIN catalogo_territorios t2
        ON t1.territorio_itemid=t2.itemId
        INNER JOIN mapa_macroregiones t3
        ON t1.macroreg_itemid=t3.id
        INNER JOIN catalogo_tipo_documentos t4
        ON t1.tipodoc_itemid=t4.itemId
        INNER JOIN catalogo_ejes_tematicos t5
        ON t1.ejetem_itemid=t5.itemId
        WHERE t1.itemId=".$id;
        $datos = $dbm->Execute($sql);
        $respuesta = $datos->GetRows();
        $dbm->Close();
        return $respuesta;
    }

    /**
     * Función que obtiene informacion de proyectos de documento
     **/
    function get_info_proyectos($id){
        global $db_conf_datatable;
        $db_conf = $db_conf_datatable["principal"];
        $dbm = ADONewConnection($db_conf["type"]);
        $dbm->Connect($db_conf["server"],$db_conf["user"] ,$db_conf["password"],$db_conf["database"]) or die("ERROR CONNECT " . $db_conf["database"]);
        $dbm->setCharset('utf8');
        $dbm->SetFetchMode(ADODB_FETCH_ASSOC);
        $sql = "SELECT dp.itemId, p.nombre, p.objetivo_principal, p.descrip
        FROM proyectos p INNER JOIN documento_proyectos dp
        ON p.itemId=dp.proy_itemid
        WHERE dp.doc_itemid=".$id;
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
