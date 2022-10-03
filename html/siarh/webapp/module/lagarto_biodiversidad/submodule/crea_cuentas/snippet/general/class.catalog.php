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

    public function conf_catalog_datos_general($municipioId,$departamento_itemId,$provincia_itemId,$tipo){

        
        $ver=$this->verificar_permiso_usuarios(["1"]);
        if($ver){
            $this->addCatalogList("catalogo_rol","Rol","","nombre_rol","","itemId","","","");
            $this->addCatalogList("catalogo_tco","TCO","","tco","","itemId","municipio_itemId='".$municipioId."'","","");
            $this->addCatalogList("curtiembre","Curtiembre","","curtiembre","","itemId","","","");
            $this->addCatalogList("catalogo_ci_exp","CI_exp","","expedicion","","itemId","","","");
		$this->addCatalogList("vrhr_territorio.departamento","Departamento","","nombre","","itemId","","","");
            if($departamento_itemId!=null){
                $this->addCatalogList("vrhr_territorio.provincia","Provincia","","nombre","","itemId","departamentoId='".$departamento_itemId."'","","");
            }
            if($tipo==1){
                $this->addCatalogList("vrhr_territorio.municipio","Municipio","","nombre","","itemId","itemId='".$municipioId."'","","");
}
else{
if($provincia_itemId!=null){
                $this->addCatalogList("vrhr_territorio.municipio","Municipio","","nombre","","itemId","provinciaId='".$provincia_itemId."'","","");
            }
}
        }


    }

}