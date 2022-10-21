<?php
/**
  * User: henrytaby
 * Date: 17/06/2020
 * Time: 19:14
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
        //print_struc($this->tabla);
        //$this->addCatalogList($this->tabla["c_empresa_tipo"],"empresa_tipo","","","","","","1");
    }

    public function conf_catalog_datos_general_print(){
        //$this->addCatalogList($this->tabla["c_pais"],"pais","","concat('(',sigla,')',' - ',nombre)","","","","");
        $this->addCatalogList($this->tabla["c_pais"],"pais","","","","","","");
        //$this->addCatalogList($this->tabla["c_tipo_documento"],"tipo_documento","","","","itemId","","");
        //$this->addCatalogList($this->tabla["c_tipo_documento"],"tipo_documento","","","","itemId","","");
        $this->addCatalogList($this->tabla["c_tipo_proposito"],"tipo_proposito","","sigla","","","","");
        $this->addCatalogList($this->tabla["c_puerto_embarque"],"puerto_embarque","","","","","","");
        $this->addCatalogList($this->tabla["c_cites_tipo"],"cites_tipo","","concat(nombre,' (Costo Bs. ',monto,')')","","itemId","","");
    }
    public function get_tipo_documento_options(){

        $sql = "SELECT * from ".$this->tabla["c_tipo_documento"]." AS  td WHERE td.activo=1";
        $item = $this->dbm->Execute($sql)->GetRows();
        /*
        $res = array();
        foreach ($item as $row){
            $res[$row["titulo"]] [$row["itemId"]] = "Grupo: ".$row["grupo"]." | ".$row["nombre"]."";
        }
        */
        return $item;
    }
}