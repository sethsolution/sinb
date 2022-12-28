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
        /*$subObjCatalog->conf_catalog_datos_general();
        $cataobj = $subObjCatalog->getCatalogList();
        $smarty->assign("cataobj", $cataobj);*/
        $smarty->assign("type", $type);

        if($type=="update") {
            $item = $objItem->get_item($id, "enlaces_institucionales");
            $smarty->assign("item", $item);
        }
        $smarty->assign("subpage", $webm["sc_index"]);
        break;

    case 'itemupdatesql':
        $respuesta = $subObjItem->item_update($item, $itemId, "campos_enlaces_institucionales", $type, "enlaces_institucionales");
        $core->print_json($respuesta);
        break;

}
