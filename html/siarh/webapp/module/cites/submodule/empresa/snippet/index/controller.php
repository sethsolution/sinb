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

        //$dbm->debug  = true;
        $objCatalog->conf_catalog_datos_general();
        $cataobj = $objCatalog->getCatalogList();
        //print_struc($cataobj);exit;

        //$cataobj["activo"] = $objCatalog->get_activo_option();
        //print_struc($cataobj); exit;
        $smarty->assign("cataobj", $cataobj);
        
        $grill_list = $objItem->get_grilla_list_sbm("index");
        //print_struc($grill_list);exit;
        $smarty->assign("grill_list", $grill_list);
        /**
         * usamos el template para mootools
         */
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
        $smarty->assign("id", $id);
        if ($type == "update") {
            $item = $objItem->get_item($id, "item");
            $smarty->assign("item", $item);
        }

        $menu_tab = $objItem->get_item_tab_sbm($type,"index");

        if($item["tipo_id"] == 12 or $item["tipo_id"] == 10){
            unset($menu_tab[1]);
            unset($menu_tab[2]);
        }

        $smarty->assign("menu_tab", $menu_tab);
        $smarty->assign("menu_tab_active", "general");


        $smarty->assign("subpage", $webm["item_index"]);
        $smarty->assign("subpage_js", $webm["item_index_js"]);
        break;
    case 'resumen':
        $res = $objItem->get_resumen($item);
        $core->print_json($res);
        break;

    case 'enviar.obs':
        $smarty->assign("subpage", $webm["email_obs"]);
        $res = $objItem->enviar_obs($item);
        $core->print_json($res);
        break;

    case 'enviar.aprobar':
        $smarty->assign("subpage", $webm["email_aprobar"]);
        $res = $objItem->enviar_aprobar($item);
        $core->print_json($res);
        break;
}