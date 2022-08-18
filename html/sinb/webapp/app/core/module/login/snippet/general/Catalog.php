<?PHP
/**
 * User: henrytaby
 * Date: 3/5/2018
 * Time: 15:22
 */

class Catalog extends CoreResources{

    function __construct(){
        /**
         * Inicializamos todas las librerias y variables para el submodulo
         */
        $this->appInit();

    }
    public function conf_catalog_datos_general(){

          $this->addCatalogList($this->table["c_ip_publica"],"ippublica","","ip","","","","");
          $this->addCatalogList($this->table["c_lugar"],"lugar","","","","","","");
          $this->addCatalogList($this->table["c_proveedor"],"proveedor","","","","","","");
    }

}