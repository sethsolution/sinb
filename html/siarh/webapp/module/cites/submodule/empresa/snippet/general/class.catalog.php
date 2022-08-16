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
        $this->addCatalogList($this->tabla["c_empresa_ocasional"],"empresa_ocasional","","","","","","");
        $this->addCatalogList($this->tabla["c_empresa_entidad_cientifica"],"empresa_entidad_cientifica","","","","","","");
        $this->addCatalogList($this->tabla["c_pais"],"pais","","concat('(',sigla,')',' - ',nombre)","","","","");
        $this->addCatalogList($this->tabla["c_departamento"],"departamento","","","","","","");
        $this->addCatalogList($this->tabla["c_departamento"],"expedido","","concat(' - ',sigla)","","","","");
        $this->addCatalogList($this->tabla["c_empresa_tipo_institucion"],"empresa_tipo_institucion","","nombre","","itemId","","");
    }

}