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
        //$this->addCatalogList($this->tabla["c_item_archivo_tipo"],"tipo","","","","","","");
        $this->addCatalogList($this->tabla["c_pais"],"pais","","concat('(',sigla,')',' - ',nombre)","","","","");
        $this->addCatalogList($this->tabla["c_tipo_unidad"],"unidad","","concat(unidad,' (',nombre,')')","","itemId","","");
        $this->addCatalogList($this->tabla["c_departamento"],"expedido","","concat(' - ',sigla)","","","","");    }

}