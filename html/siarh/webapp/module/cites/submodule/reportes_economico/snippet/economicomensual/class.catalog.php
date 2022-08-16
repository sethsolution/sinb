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
    /**
     * Implementación desde aca
     */
    public function conf_catalog_datos_general(){
        $where = "itemId = 2 or itemId = 3";
        //$this->addCatalogList($this->tabla["c_estado"],"estado","nombre","","","itemId","","");
        //$this->addCatalogList($this->tabla["c_tipo_documento"],"tipo_documento","nombre","","","","","");
        $this->addCatalogList($this->tabla["c_categoria"],"categoria","","","","","$where","");
    }

}