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
        if($type=="update") {
            $item = $objItem->get_item($id, "especie_descriptores");
            if (!array_key_exists('itemId', $item)) {
                $type = "new";
            }
            $item_adjunto = $subObjItem->getRowsAdjunto($id);
            $item_descriptor = null;
            if (count($item_adjunto) > 0) {
                $item_descriptor = $item_adjunto[0];
            }
            $smarty->assign("item", $item);
            $smarty->assign("itemDescriptor", $item_descriptor);
        }
        $smarty->assign("type", $type);
        $smarty->assign("subpage", $webm["sc_index"]);
        break;

    case 'itemupdatesql':
        $respuesta = $subObjItem->item_update($item, $itemId, "campos_descriptores", $type, "especie_descriptores");
        $core->print_json($respuesta);
        break;

    case 'descargarRecurso':
        $subObjItem->descargarRecurso($id);
        break;

}
