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
        $dato["URL"] = "URL";
        $dato["SB"] = "SUBMODULO DE SUBSISTEMA";
        return $dato;
    }

    public function conf_catalog_form(){

        $this->addCatalogList($this->tabla["submodulo"],"submodulo","","","","itemid","","");
        //print_struc($this->tabla); exit;
        //$this->dbm->debug=true;
        $this->addCatalogList($this->tabla["modulo"],"modulo","","titulo","","itemid","","");
     //  $this->addCatalogList($this->tabla["c_categoria"],"categoria","","","","itemid","","");
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

    public function get_item_padre(){
        //$this->dbm->debug = true;
        $sql = "select (select s.nombre from catalogo_categoria s where s.itemId=c.padre) as titulo, c.itemId as itemId, c.nombre as nombre
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