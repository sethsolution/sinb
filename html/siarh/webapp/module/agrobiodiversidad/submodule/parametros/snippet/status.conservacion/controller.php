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
        //print_struc($CFGm->tabla);exit;
        $grill_list = $subObjItem->get_grilla_list_sbm("grilla_status_conservacion");
        $smarty->assign("grill_list", $grill_list);
        $smarty->assign("subpage", $webm["sc_index"]);
        $smarty->assign("subpage_js", $webm["sc_index_js"]);
        break;

    case 'getItemList':
        $respuesta = $subObjItem->get_item_datatable_Rows();
        $core->print_json($respuesta);
        break;

    case 'itemUpdate':
        $smarty->assign("type", $type);
        $smarty->assign("id", $id);

        $menu_tab = $subObjItem->get_item_tab_sbm($type, "tab_status_conservacion");

        $smarty->assign("menu_tab", $menu_tab);
        $smarty->assign("menu_tab_active", "general");

        if($type=="update"){
            $item = $subObjItem->get_item($id,"c_status_conservacion");
            $smarty->assign("item", $item);
        }
        $smarty->assign("subpage", $webm["sc_item_index"]);
        $smarty->assign("subpage_js", $webm["sc_item_index_js"]);
        break;

    case 'itemDelete':
        $respuesta = $subObjItem->item_delete($id);
        $core->print_json($respuesta);
        break;

    case 'getItemForm':
        $templateModule = $templateModuleAjax;

        $smarty->assign("type",$type);
        if($type=="update"){
            $item = $subObjItem->get_item($id, "c_status_conservacion");
            $smarty->assign("item", $item);
        }
        $listaEstados = array('1' => 'ACTIVO', '0' => 'INACTIVO');
        $smarty->assign("listaEstados", $listaEstados);
        $smarty->assign("subpage", $webm["sc_form_index"]);
        $smarty->assign("subpage_js", $webm["sc_form_index_js"]);
        break;

    case 'itemupdatesql':
        $respuesta = $subObjItem->item_update($item, $itemId, "campos_status_conservacion", $type);
        $core->print_json($respuesta);
        break;

    case 'codice':
        echo "es una mala llamada de un snippet";
        exit;
        break; 
}