<?PHP
use App\Setting\Module\User\Snippet\Index\Index;
use App\Setting\Module\User\Snippet\Index\Catalog;
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
         * catalog configuration
         */
        $cataobj["tipo"] = $catalogo=$objCatalog->getUserType();
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
}