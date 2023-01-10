<?PHP
use App\Ilicito\Ilicito\Ubicacion\Index;
use App\Ilicito\Ilicito\Ubicacion\Catalog;
use Core\Core;
use App\Ilicito\Ilicito\index\Index as indexParent;
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
        /**
         * Language settings, section
         */
        \Core\Core::setLenguage("index");
        $smarty->assign("type",$type);

        if($type=="update"){
            $item = $objItemParent->getItem($id);
            if(trim($item["location_latitude_decimal"]=="") or  trim($item["location_longitude_decimal"]=="")  ){
                $item["location_latitude_decimal"] = -16.513279;
                $item["location_longitude_decimal"] = -68.1666655;
            }
        }else{
            $item["location_latitude_decimal"] = -16.513279;
            $item["location_longitude_decimal"] = -68.1666655;
        }
        $smarty->assign("item",$item);
        /**
         * Catalog
         */
        $objCatalog->confCatalog();
        $cataobj= $objCatalog->getCatalogList();
        //print_struc($cataobj);exit;
        $smarty->assign("cataobj", $cataobj);
        $smarty->assign("item_id", $item_id);
        /**
         * Grid configuration
         */
        $gridItem = $objItem->getGridItem("index");
        $smarty->assign("gridItem", $gridItem);
        $smarty->assign("subpage",$webm["sc_index"]);
        break;

    case 'save.principal':
        $respuesta = $objItem->updateData($_REQUEST["item"],$id,"module",$type);
        Core::printJson($respuesta);
        break;
}
