<?php
/**
 * Todo el sub Control se recuperará mediante llamadas por ajax
 */
$templateModule = $templateModuleAjax;

switch($accion) {
    /**
     * Página por defecto (index)
     */
    default:
        $grill_list = $subObjItem->get_grilla_list_sbm("grilla_especie_adjuntos");
        $smarty->assign("grill_list", $grill_list);
        $smarty->assign("subpage", $webm["sc_index"]);
        //$smarty->assign("subpage_js", $webm["index_js"]);
        break;

    case 'getItemList':
        $res = $subObjItem->get_item_datatable_Rows($id);
        $core->print_json($res);
        break;

    case 'getForm':
        $smarty->assign("id", $id);
        $smarty->assign("adjId", $adjId);
        $smarty->assign("type", $type);
        if($type=="update") {
            $item = $subObjItem->get_item($adjId, "especie_adjuntos");
            $smarty->assign("item", $item);
        }
        $smarty->assign("subpage", $webm["form_sc_index"]);
        break;

    case 'itemupdatesql':
        //$respuesta = $subObjItem->item_update($item, $itemId, "campos_especie_adjuntos", $type, "especie_adjuntos");
        $respuesta = $subObjItem->item_update($item, $itemId, "campos_especie_adjuntos", $type, $item['espe_itemid'], $adjunto);
        $core->print_json($respuesta);
        break;

    case 'itemDelete':
        $res = $subObjItem->item_delete($id, "itemId", "especie_adjuntos");
        $core->print_json($res);
        break;

    case 'setRecursoImagen':
        $res = $subObjItem->set_recurso_imagen($id, $adjId);
        $core->print_json($res);
        break;

    case 'setRecursoFicha':
        $res = $subObjItem->set_recurso_ficha($id, $adjId);
        $core->print_json($res);
        break;

    case 'setRecursoDescriptor':
        $res = $subObjItem->set_recurso_descriptor($id, $adjId);
        $core->print_json($res);
        break;

}
