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
    public function conf_catalog_form(){

        $this->addCatalogList($this->tabla["c_tco"],"tco","","","","",$where,"");
    }
    public function get_departamento($item_id){

        $sql = "SELECT 
c.itemId
, d.nombre
FROM cupo AS c
LEFT JOIN catalogo_departamento AS d ON d.itemId = c.departamento_Id
WHERE c.gestion_id = '".$item_id."'";

        $item = $this->dbm->execute($sql);
        $item = $item->getRows();
        $res = array();
        foreach ($item as $row){
            $res[$row["itemId"]] = $row["nombre"];
        }
        return $res;
    }

}