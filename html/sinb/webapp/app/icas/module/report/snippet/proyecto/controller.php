<?PHP
use App\Icas\Module\Report\Snippet\Proyecto\Index;
use App\Icas\Module\Report\Snippet\Proyecto\Catalog;
use Core\Core;

$objItem = new Index();
$objCatalog = new Catalog();
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
            //$item = $objItem->getItem($id);
            $item = array();
        }else{
            $item = array();
        }
        $smarty->assign("item",$item);
        /**
         * Catalog
         */

        $objCatalog->confCatalog($item);
        $cataobj= $objCatalog->getCatalogList();
        //print_struc($cataobj);exit;
        $smarty->assign("cataobj", $cataobj);

        $smarty->assign("subpage",$webm["sc_index"]);
        break;

    case 'consult':

        \Core\Core::setLenguage("general");
        $res = $objItem->consulta($item);

        $smarty->assign("res", $res);
        $smarty->assign("subpage",$webm["sc_resultado"]);
        break;

    case 'get.municipio':
        $item = $objCatalog->getMunicipioOptions($id);
        Core::printJson($item);
        break;


    case 'get.convenio':
        $item = $objCatalog->getConvenioOptions($id);
        Core::printJson($item);
        break;

}