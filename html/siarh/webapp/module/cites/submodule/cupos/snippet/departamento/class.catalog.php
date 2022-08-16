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
    public function conf_catalog_form($item,$item_id){

        if($item["itemId"]!=""){
            $where = " (itemId not in (SELECT c.departamento_Id FROM cupo AS c WHERE c.gestion_id = '".$item_id."' ) ) or (itemId='".$item["departamento_Id"]."')";
        }else{
            $where = " itemId not in (SELECT c.departamento_Id FROM cupo AS c WHERE c.gestion_id = '".$item_id."' ) ";
        }
        $this->addCatalogList($this->tabla["c_departamento"],"departamento","","","","",$where,"");
    }

}