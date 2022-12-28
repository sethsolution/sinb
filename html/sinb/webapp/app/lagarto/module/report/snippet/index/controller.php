<?PHP
use App\Lagarto\Report\Index\Index;
use App\Lagarto\Report\Index\Catalog;
use Core\Core;

$objItem = new Index();
$objCatalog = new Catalog();
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
         * Smarty vars
         * Type = update, new
         * id = item id
         */
        $type = "update";
        $id = 0;
        $smarty->assign("type", $type);
        $smarty->assign("id", $id);
        /**
         * Tabs
         */
        $menu_tab = $objItem->getTabItem($type,"index");
        $smarty->assign("menu_tab", $menu_tab);
        $smarty->assign("menu_tab_active", "institucion");
        /**
         * Template for index and js
         */
        $smarty->assign("subpage", $webm["index"]);
        $smarty->assign("subpage_js", $webm["index_js"]);
        break;

}