<?PHP
use App\Setting\Module\Index\Snippet\Index\Index;
use App\Setting\Module\Index\Snippet\Index\Catalog;
use Core\Core;
$objItem = new Index();
$objCatalog = new Catalog();

switch($action) {
    /**
     * Página por defecto
     */
    default:
        //$smarty->debugging = true;
        /**
         * usamos el template para mootools
         */
        $smarty->assign("subpage", $webm["index"]);
        $smarty->assign("subpage_js", $webm["index_js"]);
        break;
}
/**
 * Como la página no cambia muy frecuentemente, se crea una cache
 */
//$smarty->caching = true;