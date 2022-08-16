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
        $this->addCatalogList($this->tabla["c_categoria"],"categoria","nombre","","","","padre=0 or padre is NULL","");
    }

    public function get_activo_option(){
        $dato = array();
        $dato["1"] = "Activo";
        $dato["0"] = "Inactivo";
        return $dato;
    }

    public function get_item_options(){
        //$this->dbm->debug = true;
        $sql = "select (select s.nombre from catalogo_categoria s where s.itemId=c.padre) as titulo, c.itemId, c.nombre
                from ".$this->tabla["c_categoria"]." c
                where c.padre!=0 or c.padre is not null
                ";

        $item = $this->dbm->Execute($sql)->GetRows();
        //print_struc($item);exit();

        $res = array();
        foreach ($item as $row){
            $res[$row["titulo"]] [$row["itemId"]] = $row["nombre"]."";
        }
        return $res;
    }
}