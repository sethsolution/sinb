<?PHP
use App\Core\Module\Index\Snippet\Index\Index;
use App\Core\Module\Index\Snippet\Index\Catalog;
use Core\Core;
$objItem = new Index();
$objCatalog = new Catalog();
if(isset($_REQUEST["type"])) $type = $_REQUEST["type"];
switch($action) {
    /**
     * Página por defecto
     */
    default:
        /**
         *
         * Forzamos a que el login se realice desde el modulo de logín
         */
        if(!$_SESSION['auth']){
            $_SESSION["exit"] = "/login";
            $url = 'Location: /login';
            header($url);
            exit;
        }
        /**
         * usamos el template para mootools
         */
        $menu_modulo_principal = $objItem->get_menu_principal();
        $smarty->assign("menu_modulo_principal", $menu_modulo_principal);
        $smarty->assign("subpage", $webm["index"]);
        $smarty->assign("subpage_js", $webm["index_js"]);
        break;
    /**
     * Creación de JSON
     */
    case 'getPhoto':
        $objItem->getPhoto($type);
        break;

}