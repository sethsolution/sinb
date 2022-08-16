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

       $this->addCatalogList($this->tabla["direccion"],"direccion","","","","nombre","","");
        //print_struc($this->tabla); exit;
        //$this->dbm->debug=true;
    }




    public function get_unidad_options($id){

        global $objItem;
        $this->dbm->SetFetchMode(ADODB_FETCH_ASSOC);

        //$direccion= $objItem->get_item($id, "direccion");
        $sql = "select 
                u.itemId, u.nombre , u.sigla
                from ".$this->tabla['unidad']." as u
                where u.direccion_id=".$id;

        $item = $this->dbm->Execute($sql);
        $item = $item->GetRows();
        //print_struc($item);
       // exit;
        return $item;


    }

    public function get_unidad_options_inicio($id){

        global $objItem;
        $this->dbm->SetFetchMode(ADODB_FETCH_ASSOC);

        //$direccion= $objItem->get_item($id, "direccion");
        $sql = "select 
                u.itemId, u.nombre
                from ".$this->tabla['unidad']." as u
                where u.direccion_id=".$id;

        $item = $this->dbm->Execute($sql);
        $item = $item->GetRows();
        //print_struc($item);
        // exit;

        foreach ($item as $unidad){
            $arr [$unidad['itemId']] = $unidad['nombre'];
        }

        return $arr;


    }

}