<?php
/**
 * User: henrytaby
 * Date: 3/5/2018
 * Time: 15:27
 */

$templateModule = $templateModuleAjax;

switch($accion) {
    /**
     * Página por defecto
     */
    default:
        $grill_list = $objItem->get_grilla_list_sbm("item");
        //print_struc($grill_list);exit;
        $smarty->assign("grill_list", $grill_list);

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






    /**
     * Creación de reportes
     */
    case 'reporte':
        $objItem->get_report($tipo);
        break;
    /**
     * Creación de JSON
     */
    case 'getItemList':
        $res = $objItem->get_item_datatable_Rows();
        $core->print_json($res);
        break;

    case 'itemUpdate':
        //$smarty->debugging=true;
        $smarty->assign("type", $type);
        $smarty->assign("id", $id);

        $menu_tab = $objItem->get_item_tab_sbm($type,"index");

        $smarty->assign("menu_tab", $menu_tab);
        $smarty->assign("menu_tab_active", "general");

        if ($type == "update") {
            $item = $objItem->get_item($id, "c_ip_publica");

            $smarty->assign("item", $item);
        }
        $smarty->assign("subpage", $webm["item_index"]);
        $smarty->assign("subpage_js", $webm["item_index_js"]);
        break;

    case 'itemDelete':
        $res = $objItem->item_delete($id);
        $core->print_json($res);
        break;
    case 'codice':
        echo "es una mala llamada de un snippet";
        exit;
        break;

}
