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
        $objCatalog->configCatalogListIndex();
        $cataobj = $objCatalog->getCatalogList();
        $smarty->assign("cataobj", $cataobj);
        //print_struc($cataobj);exit;

        $grill_list = $objItem->get_grilla_list_sbm("index");
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

        $menu_tab = $objItem->get_item_tab_sbm($type,"index");

        $smarty->assign("menu_tab", $menu_tab);
        $smarty->assign("menu_tab_active", "general");

        if ($type == "update") {
            $item = $objItem->get_item($id, "persona");
            $smarty->assign("item", $item);
        }
        $smarty->assign("subpage", $webm["item_index"]);
        $smarty->assign("subpage_js", $webm["item_index_js"]);
        break;

    case 'itemDelete':
        $res = $objItem->item_delete($id);
        $core->print_json($res);
        break;
    case 'resumen01':
        //print_struc($_REQUEST);
        $templateModule = $templateModuleAjax;
        //$item = $objItem->get_item($id, "persona");
        $item = $objItem->get_resumen01($id, "persona");
        $smarty->assign("item", $item);
        $smarty->assign("subpage", $webm["resumen01_index"]);
        break;

    case 'avatar.updatesql':
        $respuesta = $objItem->item_update_avatar($item,$itemId,"avatar",$input_archivo_avatar);
        $core->print_json($respuesta);
        exit;
        break;

    case 'foto.get':
        $objItem->get_foto($id,$type);
        break;
    case 'foto.download':
        $objItem->get_foto_download($id);
        break;
}