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
        $this->addCatalogList($this->tabla["entidad"],"entidad","nombre","","","","","");
        //$this->addCatalogList($this->tabla["unidad"],"unidad","nombre","","","","","");
    }

    public function get_activo_option(){
        $dato = array();
        $dato["1"] = "Activo";
        $dato["0"] = "Inactivo";
        return $dato;
    }

    public function get_item_options(){
        //$this->dbm->debug = true;
        $sql = "select * from ".$this->tabla["lugar"];
        $item = $this->dbm->Execute($sql)->GetRows();

        $res = array();
        foreach ($item as $row){
            $res[$row["titulo"]] [$row["itemId"]] = $row["nombre"]."";
        }
        return $res;
    }
}