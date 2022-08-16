<?php
/**
 * User: henrytaby
 * Date: 3/5/2018
 * Time: 15:22
 */

class Subcatalogo extends Table{

    function __construct(){
        /**
         * Inicializamos todas las librerias y variables para el submodulo
         */
        $this->submodule_init_sbm();

    }

    public function conf_catalog_form_adicional(){
        $this->addCatalogList($this->tabla["c_especie"],"especie","","concat(nombre_comun, ' (',nombre,')')","","itemId","","");
    }

    public function conf_catalog_form(){
        $where = "itemId in (1,3,4) ";
        $this->addCatalogList($this->tabla["c_estado"],"estado","","","","itemId",$where,"");
    }

}