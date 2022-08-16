<?php
/**
  * User: henrytaby
 * Date: 3/5/2018
 * Time: 15:22
 */

class Catalogo extends Table{

    function __construct(){
        /**
         * Inicializamos todas las librerias y variables para el submodulo
         */
        $this->submodule_init_sbm();
    }

    /**
     * Catalogo::configCatalogList()
     *
     * configura el arreglo de tablas de donde sacara los catalogos,
     * utilizando el metodo addCatalogList de la clase padres
     *
     * parametros: Tabla, id, dato, noutf8, orden
     *
     * si tuviera que sacar datos de una tabla que se encuentra en otra
     * base de datos se utilizara:   base_de_datos.Tabla
     *
     * como ayuda para sacar la lista de tablas,
     * se puede utilizar la funcion sql en mysql
     *
     * "show tables"
     *
     * @return void
     */
    public function conf_catalog_form(){

        /*
        $this->addCatalogList($this->tabla["c_convenio_moneda"],"moneda","","","","","","");
        $this->addCatalogList($this->tabla["c_convenio_financiadora"],"financiadora","","","","","","");
        $this->addCatalogList($this->tabla["c_convenio_implementadora"],"implementadora","","","","","","");
        $this->addCatalogList($this->tabla["c_convenio_tipo_financiamiento"],"tipo_fin","","","","","","");
        */
        //$this->addCatalogList($this->tabla["c_convenio_ejecutora"],"ejecutora","","","","","","");

    }
    
    public function conf_catalog_datos_general(){
        $this->addCatalogList($this->tabla["c_empresa_estado"],"estado","nombre","","","","","");
        /*
        $this->addCatalogList($this->tabla["programa_item"],"programa","sigla","CONCAT(sigla,' / ',nombre) ","","","","");
        $this->addCatalogList($this->tabla["o_departamento"],"departamento","nombre","","","","","");
        $this->addCatalogList($this->tabla["c_accion"],"accion","nombre","","","","","");

        */
        /*

        $this->addCatalogList($this->tabla["item"],"programa","nombre","","","","","");
        */
    }

    public function get_activo_option(){
        $dato = array();
        $dato["1"] = "Activo";
        $dato["0"] = "Inactivo";
        return $dato;
    }
}