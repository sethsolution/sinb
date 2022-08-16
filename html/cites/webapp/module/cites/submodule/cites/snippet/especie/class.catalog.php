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
    public function conf_catalog_form($item){
        //print_struc($item);exit();
        $where  = $this->get_tipo_cite_where($item);
        $this->addCatalogList($this->tabla["c_especie"],"especie","","concat(nombre, ' (',nombre_comun,')')","","itemId",$where,"");
        $this->addCatalogList($this->tabla["c_pais"],"pais","","concat(sigla,' - ',nombre)","","","","");
        $this->addCatalogList($this->tabla["c_apendice"],"apendice","","","","","","");
        $this->addCatalogList($this->tabla["c_tipo_origen"],"origen","","concat(sigla,' - ',nombre)","","itemId","","");

        if($item["tipo_id"] == 1){
            $where = " itemId in (8,9) and activo = 1";
        }else{
            $where = "activo = 1";
        }

        $this->addCatalogList($this->tabla["c_tipo_unidad"],"unidad","","concat(unidad,' (',nombre,')')","","itemId",$where,"");
    }
    public function get_tipo_cite_where($item){
        switch ($item["tipo_id"]){
            case 1:
                $where = "especie_tipo_id = '2'";
                break;
            case 2:
                $where = "itemId = '84'";
                break;
            case 3:
                $where = "itemId = '426'";
                break;
            case 8:
                $where = "itemId = '42'";
                break;
            default:
                if($item["proposito_id"] == "5"){
                    $where = "apendice_id IN (2,3)";
                }else{
                    $where = "";
                }
                break;
        }
        if($where != ""){
            $where .=" and ";
        }
        $where .=" tipo = '1' or tipo = '2'";
        return $where;
    }

}