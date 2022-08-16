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
        $where ="tipo=1";
        //$this->addCatalogList($this->tabla["c_especie"],"especie",""," concat(nombre,' (',nombre_comun,' )')","","itemId",$where,"");

    }

}