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
        //$this->addCatalogList($this->tabla["c_estado"],"estado","nombre","","","itemId","","");
        //$this->addCatalogList($this->tabla["c_tipo_documento"],"tipo_documento","nombre","","","","","");
        $where ="tipo=1";
        $this->addCatalogList($this->tabla["c_especie"],"especie",""," concat(nombre,' (',nombre_comun,' )')","","itemId",$where,"");
        $this->addCatalogList($this->tabla["c_pais"],"pais","","concat(nombre,' (',sigla,')')","","","","");
        $this->addCatalogList($this->tabla["c_tipo_documento"],"tipo_documento","","","","","","");
        $this->addCatalogList($this->tabla["c_cites_tipo"],"cites_tipo","","","","","","");
    }

}