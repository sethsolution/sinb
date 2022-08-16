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
        //$this->dbm->debug = true;
        $sql = "SELECT 
                 (SELECT COUNT(*)  FROM ".$this->tabla["cites"]." AS ci WHERE ci.empresa_id = e.itemId ) AS total_cites
                , (SELECT COUNT(*)  FROM ".$this->tabla["dispensacion"]." AS di WHERE di.empresa_id = e.itemId ) AS total_dispensacion
                ,et.nombre AS empresa_tipo 
                , es.nombre as estado
                ,e.* 
                from ".$this->tabla["empresa"]." AS e 
                LEFT JOIN ".$this->tabla["c_empresa_tipo"]." AS et ON et.itemId = e.tipo_id
                left join ".$this->tabla["c_empresa_estado"]." AS es ON es.itemId = e.estado_id
                WHERE e.itemId= '".$this->empresa_id."'";
        $info = $this->dbm->Execute($sql);
        $info = $info->fields;
        return $info;
    }
}