<?PHP
use App\Icas\Geovisor\Distribuidora\Index;
use App\Icas\Geovisor\Distribuidora\Catalog;
use Core\Core;

$objItem = new Index();
$objCatalog = new Catalog();

$templateModule = $frontend["baseAjax"];

switch($action) {
    /**
     * Página por defecto (index)
     */
    default:
        $filtervar = $objItem->getFilter($filter);
        //print_struc($filtervar);exit;
        $smarty->assign("filter",$filtervar);

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