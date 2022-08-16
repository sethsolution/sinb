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
        $this->addCatalogList($this->tabla["c_pais"],"pais","","concat('(',sigla,')',' - ',nombre)","","","","");
        $this->addCatalogList($this->tabla["c_tipo_documento"],"tipo_documento","","","","itemId","","");
        $this->addCatalogList($this->tabla["c_tipo_proposito"],"tipo_proposito","","concat(sigla,' - ',nombre)","","","","");
        $this->addCatalogList($this->tabla["c_cites_tipo"],"cites_tipo","","concat(nombre,' (Costo Bs. ',monto,')')","","itemId","","");
        $this->addCatalogList($this->tabla["c_puerto_embarque"],"puerto_embarque","","","","","");

    }

}