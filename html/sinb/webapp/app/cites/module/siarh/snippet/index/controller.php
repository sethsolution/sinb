<?PHP
use AApp\Cites\Siarh\Index\Index;
use AApp\Cites\Siarh\Index\Catalog;
use Core\Core;

$objItem = new Index();
$objCatalog = new Catalog();
$templateModule = $frontend["baseGeo2"];

switch($action) {
    default:
        /**
         * Smarty Options
         */
        //$smarty->caching = true;
        //$smarty->debugging = true;
        /**
         * Language settings, section
         */
        \Core\Core::setLenguage("index");

        /**
         * Template for index and js
         */
        $smarty->assign("subpage", $webm["index"]);
        $smarty->assign("subpage_js", $webm["index_js"]);
        break;

}