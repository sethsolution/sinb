<?PHP
/**
 * User: henrytaby
 * Date: 3/5/2018
 * Time: 15:27
 */

$templateModule = $frontend["baseAjax"];

switch($action) {
    /**
     * Página por defecto
     */
    default:
        $gridItem = $objItem->getGridItem("item");
        //print_struc($gridItem);exit;
        $smarty->assign("gridItem", $gridItem);

        /**
         * Cargamos catalogos necesarios
         */
        $objCatalog->conf_catalog_datos_general();
        $cataobj = $objCatalog->getCatalogList();
        $smarty->assign("cataobj", $cataobj);
     // print_struc($cataobj);exit;


        /**
         * usamos el template para mootools
         */
        $smarty->assign("subpage", $webm["index"]);
        $smarty->assign("subpage_js", $webm["index_js"]);
        break;

    /**
     * Login Form
     */
    case 'get.form.login':
        $smarty->assign("subpage",$webm["sc_form_login"]);
        break;
    case 'get.form.reg':
        $smarty->assign("subpage",$webm["sc_form_registro"]);
        break;
}
