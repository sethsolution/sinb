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

   /* public function get_tipo_option(){
        $dato = array();
        $dato["INDEX"] = "INDEX";
        $dato["URL"] = "URL";
        $dato["SB"] = "SB";
        return $dato;
    }*/

    public function conf_catalog_form($item_id){
       // $this->dbm->debug=true;
        //echo "id:".$item_id;
        $this->addCatalogList($this->tabla["direccion"],"direccion","","","","","entidad_id='".$item_id."' ","");

    }
}