<?PHP
use App\Web\Module\Geovisor\Snippet\Index\Index;
use App\Web\Module\Geovisor\Snippet\Index\Catalog;
use Core\Core;

$objItem = new Index();
$objCatalog = new Catalog();
$templateModule = $frontend["baseGeo2"];

switch($action) {
    default:
        /**
         * Tabs
         */
        $smarty->assign("google_map_key", $_ENV["GOOLE_MAP_KEY"]);
        $smarty->assign("stadiamaps_key", $_ENV["STADIAMAPS_KEY"]);

        $menu_tab = $objItem->getTabItem($type,"index");
        $smarty->assign("menu_tab", $menu_tab);
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
         * catalog configuration
         */
        //$dbm->debug = true;
        $objCatalog->confCatalog();
        $cataobj= $objCatalog->getCatalogList();

        //print_struc($cataobj);
        $smarty->assign("cataobj", $cataobj);

        /**
         * Grid configuration
         */
        $gridItem = $objItem->getGridItem("item");
        $smarty->assign("gridItem", $gridItem);
        /**
         * Template for index and js
         */
        $smarty->assign("subpage", $webm["index"]);
        $smarty->assign("subpage_js", $webm["index_js"]);
        break;
    /**
     * Creación de JSON
     */
    case 'list':
        //$datatable_debug = true;
        $res = $objItem->getItemDatatableRows();
        Core::printJson($res);
        break;

    case 'itemUpdate':
        /**
         * Smarty Options
         */
        //$smarty->caching = true;
        //$smarty->debugging = true;
        /**
         * Language settings, section
         */
        \Core\Core::setLenguage("item");
        /**
         * Smarty vars
         * Type = update, new
         * id = item id
         */
        $smarty->assign("type", $type);
        $smarty->assign("id", $id);
        /**
         * Tabs
         */
        $menu_tab = $objItem->getTabItem($type,"index");
        $smarty->assign("menu_tab", $menu_tab);
        $smarty->assign("menu_tab_active", "general");
        /**
         * GetItem
         */
        if ($type == "update") {
            $item = $objItem->getItem($id);
            $smarty->assign("item", $item);
        }
        /**
         * Template for index and js
         */
        $smarty->assign("subpage", $webm["item_index"]);
        $smarty->assign("subpage_js", $webm["item_index_js"]);
        break;
    case 'delete':
        $res = $objItem->deleteData($id);
        Core::printJson($res);
        break;

    case 'get.point':
        $res = $objItem->getPoint($filter);
        Core::printJson($res);
        exit;
        break;

    case 'get.summary':
        $res = $objItem->getSummary($item);
        Core::printJson($res);
        exit;
        break;
}