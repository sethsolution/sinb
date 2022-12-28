<?php
/**
 * Created by PhpStorm.
 * User: henrytaby
 * Date: 3/5/2018
 * Time: 15:27
 */

switch($accion) {
    /**
     * Página por defecto
     */
    default:
        /**
         * Cargamos catalogos necesarios
         */
        //print_struc($CFGm->tabla);exit;
        if ($_SESSION['userv']['itemId'] != 1) {
            $smarty->assign("privFace", $objItem->getUserPermisos($privFace));
        }
        
        $grill_list = $objItem->get_grilla_list_sbm("grilla_catalogos");
        $smarty->assign("grill_list", $grill_list);
        $smarty->assign("subpage", $webm["index"]);
        $smarty->assign("subpage_js", $webm["index_js"]);
        break;
    /**
     * Creación de JSON
     */
    case 'getItemList':
        $res = $objItem->get_item_datatable_Rows("catalogos", "grilla_catalogos");
        $core->print_json($res);
        break;

    case 'itemUpdate':
        $smarty->assign("type", $type);
        $smarty->assign("id", $id);

        $menu_tab = $objItem->get_item_tab_sbm($type, "index");

        $smarty->assign("menu_tab", $menu_tab);
        $smarty->assign("menu_tab_active", "general");

        if ($type == "update") {
            $item = $objItem->get_item($id, "catalogos");
            $smarty->assign("item", $item);
        }
        $smarty->assign("subpage", $webm["item_index"]);
        $smarty->assign("subpage_js", $webm["item_index_js"]);
        break;

    case 'itemDelete':
        $res = $objItem->item_delete($id, "catalogos");
        $core->print_json($res);
        break;

    case 'codice':
        echo "es una mala llamada de un snippet";
        exit;
        break;
}