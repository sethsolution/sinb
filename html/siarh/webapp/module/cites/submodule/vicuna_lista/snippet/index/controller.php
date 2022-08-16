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
        //$dbm->debug = true;
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
        $smarty->assign("menu_tab", $menu_tab);
        $smarty->assign("menu_tab_active", "requisitos");

        if ($type == "update") {
            //$dbm->debug = true;
            $item = $objItem->get_item($id);
            $smarty->assign("item", $item);
        }

        $smarty->assign("subpage", $webm["item_index"]);
        $smarty->assign("subpage_js", $webm["item_index_js"]);
        break;
    /**
     * Creación de JSON
     */
    case 'getItemList':
        //$datatable_debug = true;
        $res = $objItem->get_item_datatable_Rows();
        $core->print_json($res);
        break;

    case 'borrar':
        $res = $objItem->item_delete($id);
        $core->print_json($res);
        break;

    case 'resumen':
        $res = $objItem->get_resumen($item_id);
        $core->print_json($res);
        print_struc($res);exit();
        break;

    case 'enviar':
        $res = $objItem->enviar($item_id);
        $core->print_json($res);
        break;

    case 'imprime':
        $objCatalog->conf_catalog_datos_general_print();
        $cataobj = $objCatalog->getCatalogList();
        $smarty->assign("cataobj" , $cataobj);

        $item = $objItem->get_item($item_id);
        $smarty->assign("item",$item);

        $especie = $objItem->get_especie_list($item_id);
        $smarty->assign("especie", $especie);

        $objItem->imprime($item_id);
        break;

    case 'enviar.obs':
        $smarty->assign("subpage", $webm["email_obs"]);
        $res = $objItem->enviar_obs($item);
        $core->print_json($res);
        break;

    case 'enviar.aprobar':
        /*
        print_struc($_REQUEST);
        exit;
        */
        $smarty->assign("subpage", $webm["email_aprobar"]);
        $res = $objItem->enviar_aprobar($item);
        $core->print_json($res);
        break;

}