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


    function get_item($idItem){
        $item = '';
        if($idItem!=''){

            $sql = "SELECT i.* 
                    FROM ".$this->tabla["registro"]." as i 
                    WHERE i.itemId='".$idItem."'";
            $info = $this->dbm->Execute($sql);
            $item = $info->fields;
        }

        return $item;
    }
    
    public function get_item_datatable_Rows(){
        global $db_conf_datatable;
        /**
         * tabla de la base de datos que listaremos
         */
        $table = $this->tabla["registro"];
        /**
         * El nombre del campo que guarda id principal
         */
        $primaryKey = 'itemId';
        /**
         * Que configuraciòn de grilla utilizaremos
         */
        $grilla = "index";
        /**
         * la configuración de base de datos que utilizaremos
         * que se la realiza en inc/db.php
         */
        $db=$db_conf_datatable["principal"];
        /**
         * Configuraciones adicionales
         */
        $extraWhere = "tipo = 1";
        $groupBy = "";
        $having = "";
        /**
         * Resultado de la consulta enviada
         */
        $resultado = $this->get_grilla_datatable_simple($db,$grilla,$table, $primaryKey, $extraWhere, $groupBy, $having);
        /**
         * apartir de aca podemos transformar datos, de acuerdo a requerimiento
         */
        foreach ($resultado['data'] as $itemId => $valor) {
            $resultado['data'][$itemId]['fecha'] = date_format(date_create($valor['fecha']),"d/m/Y");
        }
        $resultado = $this->get_grilla_datatable_simple($db,$grilla,$table, $primaryKey, $extraWhere, $groupBy, $having, "right");
        $resultado["recordsTotal"]=$resultado["recordsFiltered"];


        foreach ($resultado['data'] as $itemId => $valor) {
            $field = "dateCreate";
            if(isset($result['data'][$itemId][$field]) && $result['data'][$itemId][$field]!="" ) $result['data'][$itemId][$field] = $this->changeDataFormat($result['data'][$itemId][$field],"d/m/Y H:i:s");
            $field = "dateUpdate";
            if(isset($result['data'][$itemId][$field]) && $result['data'][$itemId][$field]!="" ) $result['data'][$itemId][$field] = $this->changeDataFormat($result['data'][$itemId][$field],"d/m/Y H:i:s");

            $field = "enviado_fecha";
            if(isset($result['data'][$itemId][$field]) && $result['data'][$itemId][$field]!="" ) $result['data'][$itemId][$field] = $this->changeDataFormat($result['data'][$itemId][$field],"d/m/Y H:i:s");
            $field = "emitido_fecha";
            if(isset($result['data'][$itemId][$field]) && $result['data'][$itemId][$field]!="" ) $result['data'][$itemId][$field] = $this->changeDataFormat($result['data'][$itemId][$field],"d/m/Y H:i:s");
            $field = "fecha_expiracion";
            if(isset($result['data'][$itemId][$field]) && $result['data'][$itemId][$field]!="" ) $result['data'][$itemId][$field] = $this->changeDataFormat($result['data'][$itemId][$field],"d/m/Y H:i:s");
        }

        return $resultado;

    }

    /**
     * Borrar un registro de la base de datos
     */
    function item_delete($id){
        /**
         * borramos  el dato principal
         */
        $campo_id="itemId";
        $where = "";
        $res = $this->item_delete_sbm($id,$campo_id,$this->tabla["registro"],$where);
        return $res;
    }

}