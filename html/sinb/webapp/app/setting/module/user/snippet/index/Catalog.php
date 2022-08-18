<?PHP
namespace App\Setting\Module\User\Snippet\Index;
use Core\CoreResources;
class Catalog extends CoreResources{
    function __construct(){
        /**
         * We initialize all the libraries and variables for the new class
         */
        $this->appInit();
    }

    public function getActiveOption(){
        global $smarty;
        $dato = array();
        $dato["1"] = $smarty->config_vars["glOptActive"];
        $dato["0"] = $smarty->config_vars["glOptInactive"];
        return $dato;
    }

    public function getUserType(){
        global $smarty;
        $dato = array();
        $dato["Administrador"] = $smarty->config_vars["opt_typeuser_1"];
        $dato["Normal"] = $smarty->config_vars["opt_typeuser_2"];
        //$dato[3] = $smarty->config_vars["opt_typeuser_3"];
        return $dato;
    }
}