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


    function get_item(){
        $sql = "SELECT et.nombre AS empresa_tipo ,e.* 
                from ".$this->tabla["empresa"]." AS e 
                LEFT JOIN ".$this->tabla["c_empresa_tipo"]." AS et ON et.itemId = e.tipo_id
                
                WHERE e.itemId= '".$this->empresa_id."'";
        $info = $this->dbm->Execute($sql);
        $info = $info->fields;
        return $info;
    }

}