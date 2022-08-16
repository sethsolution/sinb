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


       //$this->addCatalogList($this->tabla["programa_item"],"programa","","","","","","");
       //$this->addCatalogList($this->tabla["programa_convenio"],"convenio","","codigo","","","","");

       /*
       $this->addCatalogList($this->tabla["o_departamento"],"departamento","","","","","activo=1","");
       $this->addCatalogList($this->tabla["o_gestion"],"gestion","","","","","","");
        $this->addCatalogList($this->tabla["c_ejecutora"],"ejecutora","","","","","","");
        */
    }

}