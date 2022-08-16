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

    public function get_report($tipo){
        /**
         * Si mandaremos algun parametro
         */
        $parametros = array();
        /**
         * Archivo de reporte que utilizaremos
         */
        $reporte_file = "rrhh_items_lista.prpt";
        /**
         * Nombre del archivo
         */
        $nombre = "Item - Lista";
        /**
         * Generamos el reporte mediante pentaho
         */
        $this->pentaho_get_report($reporte_file,$tipo,$nombre,$parametros);
    }


    function get_item($idItem,$tipoTabla){


        $this->dbm->SetFetchMode(ADODB_FETCH_ASSOC);
        $info = '';
        if($idItem!=''){
            if($tipoTabla=='tipo'){
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
        $table = $this->tabla["menu"];
        /**
         * El nombre del campo que guarda id principal
         */
        $primaryKey = 'itemId';
        /**
         * Que configuraciòn de grilla utilizaremos
         */
        $grilla = "item";
        /**
         * la configuración de base de datos que utilizaremos
         * que se la realiza en inc/db.php
         */
        $db=$db_conf_datatable["principal"];
        /**
         * Configuraciones adicionales
         */
        $extraWhere = "categoria_id!=0";
        $groupBy = "";
        $having = "";
        /**
         * Resultado de la consulta enviada
         */
        $resultado = $this->get_grilla_datatable_simple($db,$grilla,$table, $primaryKey, $extraWhere, $groupBy, $having);
        /**
         * apartir de aca podemos transformar datos, de acuerdo a requerimiento
         */
        return $resultado;

    }

    /**
     * Borrar un registro de la base de datos
     */
    function item_delete($id){
        $campo_id="itemId";
        $res = $this->item_delete_sbm($id,$campo_id,$this->tabla["menu"]);
        return $res;
    }

}