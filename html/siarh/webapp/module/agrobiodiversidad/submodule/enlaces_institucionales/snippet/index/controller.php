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
        //$objCatalog->conf_catalog_datos_general();
        //$cataobj = $objCatalog->getCatalogList();
        //$smarty->assign("cataobj", $cataobj);
        if ($_SESSION['userv']['itemId'] != 1) {
            $smarty->assign("privFace", $objItem->getUserPermisos($privFace));
        }

        $grill_list = $objItem->get_grilla_list_sbm("grilla_enlaces_institucionales");
        $smarty->assign("grill_list", $grill_list);
        $smarty->assign("subpage", $webm["index"]);
        $smarty->assign("subpage_js", $webm["index_js"]);
        break;

    /**
     * Creación de JSON
     */
    case 'getItemList':
        $res = $objItem->get_item_datatable_Rows();
        $core->print_json($res);
        break;

    case 'itemUpdate':
        $smarty->assign("type", $type);
        $smarty->assign("id", (int) $id);

        $menu_tab = $objItem->get_item_tab_sbm($type, "tab_enlaces_institucionales");
        $smarty->assign("menu_tab", $menu_tab);
        $smarty->assign("menu_tab_active", "general");

        if ($type == "update") {
            $item = $objItem->get_item($id, "enlaces_institucionales");
            $smarty->assign("item", $item);
        }
        $smarty->assign("subpage", $webm["item_index"]);
        $smarty->assign("subpage_js", $webm["item_index_js"]);
        break;

    case 'itemDelete':
        $res = $objItem->item_delete($id, "itemId", "enlaces_institucionales");
        $core->print_json($res);
        break;

    case 'codice':
        echo "Es una mala llamada de un snippet.";
        exit();
        break;
        
}
