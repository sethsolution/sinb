<?PHP
use App\Login\Module\Index\Snippet\Index\Index;
use App\Login\Module\Index\Snippet\Index\Catalog;
use Core\Core;
$objItem = new Index();
$objCatalog = new Catalog();

$templateModule = $frontend_app["template"];

switch($action) {
    /**
     * Página por defecto
     */
    default:
        if($_SESSION['auth']){
            
            $_SESSION["exit"] = "/login";
            switch ($_SESSION["userv"]["type"]){
                case 3:
                    /**
                     * Revisamos todos los accesos al sistema
                     * si no tuviera algun acceso se actualizará
                     */

                    $url = 'Location: /distribuidor';
                    break;
                default:
                    $url = 'Location: /cites';
                    break;
            }

            header($url);
            exit;
        }
        /**
         * usamos el template para mootools
         */
        $smarty->assign("subpage", $webm["index"]);
        $smarty->assign("subpage_js", $webm["index_js"]);
        break;
    case 'dd':
        echo "hola!";
        exit;
        break;
}