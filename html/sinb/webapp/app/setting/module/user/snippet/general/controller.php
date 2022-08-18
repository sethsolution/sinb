<?PHP
use App\Setting\Module\User\Snippet\General\Index;
use App\Setting\Module\User\Snippet\General\Catalog;
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
        /**
         * Language settings, section
         */
        \Core\Core::setLenguage("general");

        $smarty->assign("type",$type);
        if($type=="update"){
            $item = $objItemParent->getItem($id,"app");
        }else{
        }
        $smarty->assign("item",$item);
        /**
         * Catalog
         */
        //$cataobj["group"] = $objCatalog->getGroupOptions();
        //$cataobj["tipo"] = $objCatalog->getTypeOption();
        $cataobj["type"] = $objCatalog->getUserType();

        $smarty->assign("cataobj" , $cataobj);

        $smarty->assign("subpage",$webm["sc_index"]);
        break;

    case 'save':
        $respuesta = $objItem->updateData($_REQUEST["item"],$id,$type);
        Core::printJson($respuesta);
        break;

}