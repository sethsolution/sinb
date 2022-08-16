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

    public function conf_catalog_datos_general(){
        $this->addCatalogList($this->tabla["c_pais"],"pais","","concat('(',sigla,')',' - ',nombre)","","","","");
        $this->addCatalogList($this->tabla["c_dispensacion_tipo"],"dispensacion_tipo","","concat(monto,' bs. - ',nombre)","","itemId","","");
        $this->addCatalogList($this->tabla["c_tipo_documento"],"tipo_documento","","","","itemId","","");
        $this->addCatalogList($this->tabla["c_tipo_proposito"],"tipo_proposito","","concat(sigla,' - ',nombre)","","","","");

        $this->addCatalogList($this->tabla["c_dispensacion_tipo"],"dispensacion_tipo","","concat(monto,' bs. - ',nombre)","","itemId","","");

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