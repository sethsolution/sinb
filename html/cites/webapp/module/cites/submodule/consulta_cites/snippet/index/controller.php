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
         * sacamos las listas para los filtros
         */
        $objCatalog->conf_catalog_datos_general();
        $cataobj = $objCatalog->getCatalogList();

        $smarty->assign("cataobj", $cataobj);


        $grill_list = $objItem->get_grilla_list_sbm("index");
        $smarty->assign("grill_list", $grill_list);
        //print_struc($grill_list);exit;
        /**
         * usamos el template para mootools
         */
        $smarty->assign("subpage", $webm["index"]);
        $smarty->assign("subpage_js", $webm["index_js"]);
        break;

    case 'itemUpdate':
        //$dbm->debug = true;
        $smarty->assign("type", $type);
        $smarty->assign("id", $id);

        $menu_tab = $objItem->get_item_tab_sbm($type,"index");
        //print_struc($menu_tab);exit();
        $smarty->assign("menu_tab", $menu_tab);
        $smarty->assign("menu_tab_active", "general");

        if ($type == "update") {
            //$dbm->debug = true;
            $item = $objItem->get_item($id);
            $smarty->assign("item", $item);

        }
        //print_struc($item);exit();
        $smarty->assign("subpage", $webm["item_index"]);
        $smarty->assign("subpage_js", $webm["item_index_js"]);
        break;
    /**
     * Creación de JSON
     */
    case 'lista':
        //$datatable_debug = true;
        $res = $objItem->get_item_datatable_Rows();
        $core->print_json($res);
        break;

    case 'borrar':
        $res = $objItem->item_delete($id);
        $core->print_json($res);
        break;
}