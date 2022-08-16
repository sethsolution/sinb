<?php
/**
 * User: henrytaby
 * Date: 3/5/2018
 * Time: 15:22
 */

class Catalogo extends Table
{

    function __construct()
    {
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

    function configCatalogListIndex($departamentoId = null)
    {
        $this->addCatalogList($this->tabla["o_departamento"], "departamento", "nombre", "", "", "", "activo=1", "");
        $this->addCatalogList($this->tabla["c_afp"], "afp", "nombre", "", "", "", "", "");
        $this->addCatalogList($this->tabla["c_genero"], "genero", "nombre", "", "", "", "", "");
        $this->addCatalogList($this->tabla["c_modalidad"], "modalidad", "nombre", "", "", "itemId", "", "");
        $this->addCatalogList($this->tabla["o_entidad"], "entidad", "", "", "", "itemId", "", "");
    }

    function config_catalog_pop()
    {
        $this->addCatalogList($this->tabla["c_genero"], "genero", "", "", "", "", "", "");
        $this->addCatalogList($this->tabla["c_modalidad"], "modalidad", "", "", "", "itemId", "", "");
    }

    function getActivo()
    {
        $res = array();
        $res["1"] = $this->setUtf8("SI", $butf8);
        $res["0"] = $this->setUtf8("NO", $butf8);
        return $res;
    }


}