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
        $grill_list = $subObjItem->get_grilla_list_sbm("grilla_especie_proyectos");
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
        $smarty->assign("proyId", $proyId);
        $smarty->assign("type", $type);
        if($type=="update") {
            $item = $subObjItem->get_item($proyId, "especie_proyectos");
            $smarty->assign("item", $item);
        }
        $smarty->assign("subpage", $webm["form_sc_index"]);
        break;

    case 'itemupdatesql':
        $respuesta = $subObjItem->item_update($item, $itemId, "campos_especie_proyectos", $type, "especie_proyectos");
        $core->print_json($respuesta);
        break;

    case 'itemDelete':
        $res = $objItem->item_delete($id, "itemId", "especie_proyectos");
        $core->print_json($res);
        break;

    case 'getProyectos':
        $respuesta = $subObjItem->getProyectos($buscaProy, $especieId);
        $core->print_json($respuesta);
        break;

}
