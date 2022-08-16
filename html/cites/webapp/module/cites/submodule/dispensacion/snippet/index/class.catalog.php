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

    public function conf_catalog_datos_general(){
        $this->addCatalogList($this->tabla["c_estado"],"estado","nombre","","","itemId","","");
        $this->addCatalogList($this->tabla["c_tipo_documento"],"tipo_documento","nombre","","","","","");
        $this->addCatalogList($this->tabla["c_especie"],"especie","","concat(nombre,' (',nombre_comun,' )')","","itemId","","");
    }

    public function conf_catalog_datos_general_print(){
        $this->addCatalogList($this->tabla["c_pais"],"pais","","concat('(',sigla,')',' - ',nombre)","","","","");
        $this->addCatalogList($this->tabla["c_tipo_documento"],"tipo_documento","","","","itemId","","");
        $this->addCatalogList($this->tabla["c_tipo_proposito"],"tipo_proposito","","sigla","","","","");
        $this->addCatalogList($this->tabla["c_dispensacion_tipo"],"dispensacion_tipo","","concat(nombre,' (Costo Bs. ',monto,')')","","itemId","","");
        $this->addCatalogList($this->tabla["c_puerto_embarque"],"puerto_embarque","","","","","","");

    }

    public function conf_catalog_sustitucion(){
        $where = " categoria_id = 3 ";
        //$this->addCatalogList($this->tabla["c_pais"],"pais","","concat('(',sigla,')',' - ',nombre)","","","","");
        $this->addCatalogList($this->tabla["c_sustitucion_causal"],"causal","","","","","$where","");
        $this->addCatalogList($this->tabla["c_sustitucion_tipo"],"tipo","","","","","$where","");
    }


    public function get_activo_option(){
        $dato = array();
        $dato["1"] = "Activo";
        $dato["0"] = "Inactivo";
        return $dato;
    }


}