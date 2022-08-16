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
    public function get_tipo_option(){
        $dato = array();
        $dato["INDEX"] = "SUBSISTEMA";
        $dato["SB"] = "SUBMÓDULO DE SUBSISTEMA";
        $dato["CARPETA"] = "CARPETA";
        $dato["URL"] = "URL";
        return $dato;
    }
    public function conf_catalog_table($item_id){

        $this->addCatalogList($this->tabla["submodulo"],"submodulo","nombre","","","","parent=0 and moduloId='".$item_id."' ","","");
    }

    public function conf_catalog_form($item_id){

        $this->addCatalogList($this->tabla["submodulo"],"submodulo","","","","","parent=0 and moduloId='".$item_id."' ","","");
        $this->addCatalogList($this->tabla["modulo"],"modulo","","titulo","","itemid","","");
        $this->addCatalogList($this->tabla["c_categoria"],"categoria","","nombre","","itemid","","");
    }

    public function get_activo_option(){
        $dato = array();
        $dato["1"] = "Activo";
        $dato["0"] = "Inactivo";
        return $dato;
    }
    public function get_item_options(){
        //$this->dbm->debug = true;
        $sql = "select 
                m.titulo , sb.itemId, sb.moduloId ,(SELECT sb2.nombre from ".$this->tabla["submodulo"]." as sb2
                where sb2.itemId = sb.parent) as grupo,sb.nombre, sb.carpeta, sb.parent
                from ".$this->tabla["submodulo"]." as sb
                left join ".$this->tabla["modulo"]."  as m on m.itemId = sb.moduloId
                where sb.parent!=0
                order by sb.moduloId, sb.parent
                ";

        $item = $this->dbm->Execute($sql)->GetRows();
        // print_struc($item);

        $res = array();
        foreach ($item as $row){
            $res[$row["titulo"]] [$row["itemId"]] = "Grupo: ".$row["grupo"]." | ".$row["nombre"]."";
        }
        return $res;
    }

}