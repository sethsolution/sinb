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
        $table = $this->tabla["shapefiles"];
        /**
         * El nombre del campo que guarda id principal
         */
        $primaryKey = "itemId";
        /**
         * Que configuraciòn de grilla utilizaremos
         */
        $grilla = "grilla_shapefiles";
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
        //eliminamos el archivo físico
        $item = $this->get_item($id, $tabla_referencia);
        $dir = $this->get_dir_item_archivo_sbm($item["itemId"], 0);
        $file = $dir.$id.".".$item["adjunto_extension"];
        if (file_exists($file)) {
            unlink($file);
        }
        //eliminamos registro de la BD
        $res = $this->item_delete_sbm($id, $campo_id, $this->tabla[$tabla_referencia], $where);
        return $res;
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

    function descargarShapefile($id) {
        $item = $this->get_item($id, "shapefiles");
        if($item["itemId"] != "") {
            $dir  = $this->get_dir_item_archivo_sbm($item["itemId"]);
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
