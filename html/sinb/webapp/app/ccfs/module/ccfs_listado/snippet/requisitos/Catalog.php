<?PHP
namespace App\Ccfs\Module\Ccfs_listado\Snippet\adjunto;
use Core\CoreResources;
class Catalog extends CoreResources{

    function __construct(){
        /**
         * Inicializamos todas las librerias y variables para el submodulo
         */
        $this->appInit();
    }
    /**
     * Implementación desde aca
     */
    public function conf_catalog_form(){
        $where = "active=true";
        $this->addCatalogList($this->table["ca.ccfs_requisito"]
            ,"ccfs_requisito","","nombre",""
            ,"id","$where","","");
    }
    public function get_activo_option(){
        global $smarty;
        $dato = array();
        $dato["1"] = $smarty->config_vars["glOptActive"];
        $dato["0"] = $smarty->config_vars["glOptInactive"];
        return $dato;
    }
}