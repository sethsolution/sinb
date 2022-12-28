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
        
        $grill_list = $objItem->get_grilla_list_sbm("grilla_cultivos");
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

        $menu_tab = $objItem->get_item_tab_sbm($type, "tab_cultivos");
        $smarty->assign("menu_tab", $menu_tab);
        $smarty->assign("menu_tab_active", "general");

        if ($type == "update") {
            $item = $objItem->get_item($id, "cultivos");
            $smarty->assign("item", $item);
        }
        $smarty->assign("subpage", $webm["item_index"]);
        $smarty->assign("subpage_js", $webm["item_index_js"]);
        break;

    case 'itemDelete':
        $res1 = $objItem->item_delete($id, "itemId", "cultivo_productores_custodios");
        $res1 = $objItem->item_delete($id, "cult_itemid", "cultivo_proyectos");
        $res1 = $objItem->item_delete($id, "itemId", "cultivo_informacion_adicional");
        $res1 = $objItem->item_delete($id, "cult_itemid", "cultivo_adjuntos");
        $res = $objItem->item_delete($id, "itemId", "cultivos");
        $core->print_json($res);
        break;

    case 'getFicha':
        $objItem->getFicha($id);
        break;

    case 'codice':
        echo "Es una mala llamada de un snippet.";
        exit();
        break;
        
}
