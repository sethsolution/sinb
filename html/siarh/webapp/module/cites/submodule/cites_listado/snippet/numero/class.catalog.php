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
    public function conf_catalog_form($id){

        $where = " tipo=1 and  itemId not in (SELECT c.numero_id FROM cites_numero AS c) ";
        if ($id !=""){
            $where .= " or itemId ='".$id."'  ";
        }


        $this->addCatalogList($this->tabla["registro_numero"],"numero","","numero","","",$where,"");

        /*
        $this->addCatalogList($this->tabla["c_especie"],"especie","","concat(nombre, ' (',nombre_comun,')')","","itemId","tipo = 1","");
        $this->addCatalogList($this->tabla["c_pais"],"pais","","concat(sigla,' - ',nombre)","","","","");
        $this->addCatalogList($this->tabla["c_apendice"],"apendice","","","","","","");
        $this->addCatalogList($this->tabla["c_tipo_unidad"],"unidad","","concat(unidad,' (',nombre,')')","","","","");
        $this->addCatalogList($this->tabla["c_tipo_origen"],"origen","","concat(sigla,' - ',nombre)","","","","");

        $where = "itemId in (1,3,4) ";
        $this->addCatalogList($this->tabla["c_estado"],"estado","","","","itemId",$where,"");
        */

    }

}