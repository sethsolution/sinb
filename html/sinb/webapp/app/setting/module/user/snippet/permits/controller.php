<?PHP
use App\Setting\Module\User\Snippet\Permits\Index;
use App\Setting\Module\User\Snippet\Permits\Catalog;
use Core\Core;
use App\Setting\Module\User\Snippet\index\Index as indexParent;
$objItem = new Index();
$objCatalog = new Catalog();
$objItemParent = new indexParent();
/**
 * Todo el sub Control se recuperará mediante llamadas por ajax
 */
$templateModule = $frontend["baseAjax"];

switch($action){
    /**
     * Página por defecto (index)
     */
    default:
        $item = $objItem->getItem($id,"app");
        $smarty->assign("item",$item);
        /**
         * Language settings, section
         */
        \Core\Core::setLenguage("index");

        /*
        $cataobj["activo"] = $objCatalog->get_activo_option();
        $smarty->assign("cataobj", $cataobj);
        */
        /**
         * Grid configuration
         */
        $gridItem = $objItem->getGridItem("index");
        $smarty->assign("gridItem", $gridItem);
        $smarty->assign("subpage",$webm["sc_index"]);
        break;
    /**
     * Creación de JSON
     */
    case 'list':
        //$datatable_debug= true;
        $res = $objItem->getItemDatatableRows($item_id);
        //print_struc($res);exit;
        Core::printJson($res);
        break;
    case 'get.form':
        /**
         * Language settings, section
         */
        \Core\Core::setLenguage("formItem");

        $smarty->assign("item_id",$item_id);
        /**
         * Grid configuration
         */
        $gridItem = $objItem->getGridItem("form");
        $smarty->assign("gridItem", $gridItem);
        /**
         * Item
         */
        if($type=="update"){
            $item = $objItem->getItem($id2,$item_id);
        }else{
            //$item = "";
            $item["class"] = "fab fa-buffer";
            $item["order"] = "1";
            $item["active"] = "1";
        }
        $smarty->assign("item",$item);

        $objCatalog->conf_catalog_form($item,$item_id);
        $cataobj = $objCatalog->getCatalogList();
        //print_struc($cataobj);
        //$cataobj["mes"] = $objCatalog->getMonthList();
        $smarty->assign("cataobj" , $cataobj);
        //print_struc($cataobj);
        //print_struc($cataobj);

        $smarty->assign("type",$type);
        $smarty->assign("id",$id2);
        $smarty->assign("subpage",$webm["sc_form"]);
        break;

    case 'save':
        $respuesta = $objItem->updateData($_REQUEST["item"],"index",$item_id);
        Core::printJson($respuesta);
        break;
    case 'delete':
        $res = $objItem->deleteData($id2,$item_id);
        Core::printJson($res);
        break;

    case 'saveCheck':
        $response = $objItem->saveCheck($item_id,$_REQUEST["user_module_id"],$_REQUEST["permitType"],$_REQUEST["value"]);
        Core::printJson($response);
        break;
    case 'listform':
        //$datatable_debug= true;
        $res = $objItem->getItemFormDatatableRows($item_id);
        Core::printJson($res);
        break;
}
