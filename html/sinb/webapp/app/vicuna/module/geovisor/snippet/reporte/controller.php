<?PHP
use App\Vicuna\Geovisor\Reporte\Index;
use App\Vicuna\Geovisor\Reporte\Catalog;
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
        //echo "en proceso..";exit;
        $data = $objItem->getData($filter);
        //print_struc($data);exit;
        $smarty->assign("data",$data);
        /**
         * Language settings, section
         */
        \Core\Core::setLenguage("general");

        $smarty->assign("subpage",$webm["sc_index"]);
        break;
}