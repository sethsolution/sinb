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
        $cataobj["activo"] = $catalogo=$objCatalog->get_activo_option();

        // Obtenemos datos de grupos para select 
        $opt_item = $objCatalog->get_item_options();
        $cataobj["items"] = $opt_item;

        //$smarty->assign("item_id",$item_id);
        $smarty->assign("opt_item",$opt_item);
        //fin de obtencion de datos de grupos para select


        $smarty->assign("cataobj", $cataobj);
        $grill_list = $objItem->get_grilla_list_sbm("item");
        //print_struc($grill_list);exit;
        $smarty->assign("grill_list", $grill_list);
        /**
         * usamos el template para mootools
         */
        $smarty->assign("subpage", $webm["index"]);
        $smarty->assign("subpage_js", $webm["index_js"]);
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
        //$datatable_debug = true;
        $res = $objItem->get_item_datatable_Rows();
        $core->print_json($res);
        break;


    case 'itemUpdate':
        $smarty->assign("type", $type);
        $smarty->assign("id", $id);

        $menu_tab = $objItem->get_item_tab_sbm($type,"index");

        $smarty->assign("menu_tab", $menu_tab);
        $smarty->assign("menu_tab_active", "menu");

        if ($type == "update") {
            $item = $objItem->get_item($id, "c_categoria");
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