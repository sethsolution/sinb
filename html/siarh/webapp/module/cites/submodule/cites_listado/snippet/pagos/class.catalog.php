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
    public function conf_catalog_form(){
        $where = "itemId in (1,3,4) ";
        $this->addCatalogList($this->tabla["c_empresa_pago_estado"],"estado","","","","itemId",$where,"");
    }
}