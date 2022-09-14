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

        $objCatalog->conf_catalog_datos_general();
        
        $cataobj = $objCatalog->getCatalogList();
        //print_struc($cataobj);exit();
        $smarty->assign("cataobj", $cataobj);
        
        $grill_list = $objItem->get_grilla_list_sbm("index", "right");
        //print_struc($grill_list);exit;
        $smarty->assign("grill_list", $grill_list);
        /**
         * usamos el template para mootools
         */
        $smarty->assign("subpage", $webm["index"]);
        $smarty->assign("subpage_js", $webm["index_js"]);
        break;

        /*
     * Creación de JSON
     */
    case 'getItemList':
        //$datatable_debug = true;
        $res = $objItem->get_item_datatable_Rows();
        $core->print_json($res);
        break;

    case 'itemUpdate':

        $smarty->assign("type", $type);
        $smarty->assign("id", $id);

        $menu_tab = $objItem->get_item_tab_sbm($type,"index");

        $smarty->assign("menu_tab", $menu_tab);
        $smarty->assign("menu_tab_active", "general");

        if ($type == "update") {
            //$dbm->debug = true;
            $item = $objItem->get_item($id);
            $smarty->assign("item", $item);
            //print_struc($item);exit();
        }


        $smarty->assign("subpage", $webm["item_index"]);
        $smarty->assign("subpage_js", $webm["item_index_js"]);
        break;

    case 'itemupdatesql':
        print_struc($item);exit();
        $respuesta = $subObjItem->item_update($item,$itemId,"catalogo",$type,$item_id);
        $core->print_json($respuesta);
        break;

    case 'getItemList':
        //$datatable_debug = true;
        $res = $objItem->get_item_datatable_Rows();
        $core->print_json($res);
        //$dbm->debug = true;
        break;

    case 'itemDelete':
        $res = $objItem->item_delete($id);
        $core->print_json($res);
        break;

}