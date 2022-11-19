<?PHP
namespace App\Setting\Module\Geoviewer\Snippet\General;
use Core\CoreResources;
class Catalog extends CoreResources{

    function __construct(){
        /**
         * Inicializamos todas las librerias y variables para el submodulo
         */
        $this->appInit();
    }

    public function getTypeOption(){
        global $smarty;
        $dato = array();
        $dato["app"] = $smarty->config_vars["OptApp"];
        $dato["url"] = $smarty->config_vars["OptUrl"];
        return $dato;
    }
}