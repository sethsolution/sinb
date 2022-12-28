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
        $grill_list = $subObjItem->get_grilla_list_sbm("grilla_proyecto_financiamiento");
        $smarty->assign("grill_list", $grill_list);
        $smarty->assign("subpage", $webm["sc_index"]);
        //$smarty->assign("subpage_js", $webm["index_js"]);
        break;

    case 'getItemList':
        $res = $subObjItem->get_item_datatable_Rows($id);
        $core->print_json($res);
        break;

    case 'getForm':
        $subObjCatalog->conf_catalog_datos_general();
        $cataobj = $subObjCatalog->getCatalogList();
        $smarty->assign("cataobj", $cataobj);
        $smarty->assign("id", $id);
        $smarty->assign("proyfinanciaId", $proyfinanciaId);
        $smarty->assign("type", $type);
        if($type=="update") {
            $item = $subObjItem->get_item($proyfinanciaId, "proyecto_financiamiento");
            $smarty->assign("item", $item);
        }
        $listaTipos = array(
            "Financiador" => "Financiador",
            "Cofinanciador" => "Cofinanciador"
            );
        $smarty->assign("listaTipos", $listaTipos);
        $smarty->assign("subpage", $webm["form_sc_index"]);
        break;

    case 'itemupdatesql':
        $respuesta = $subObjItem->item_update($item, $itemId, "campos_proyecto_financiamiento", $type, "proyecto_financiamiento");
        $core->print_json($respuesta);
        break;

    case 'itemDelete':
        $res = $objItem->item_delete($id, "itemId", "proyecto_financiamiento");
        $core->print_json($res);
        break;

}
