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

    public function conf_catalog_datos_general($where=""){

        
        $this->addCatalogList("curtiembre","Curtiembre","","curtiembre","","itemId",$where,"","");
        $this->addCatalogList("gestion","Gestion","","itemId","","itemId","","","");


    }

}