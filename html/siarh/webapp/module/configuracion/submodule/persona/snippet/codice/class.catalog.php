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
    public function conf_catalog_datos_general(){
        //$this->addCatalogList($this->tabla["o_departamento"],"departamento","","","","","activo=1","");
        //$this->addCatalogList($this->tabla["c_genero"],"genero","","","","","","");
        //$this->addCatalogList($this->tabla["c_estado_civil"],"estado_civil","","","","","","");
    }

}