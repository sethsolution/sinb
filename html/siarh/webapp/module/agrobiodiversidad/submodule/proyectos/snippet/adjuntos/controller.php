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
            $item = $subObjItem->get_item($id, "proyecto_adjuntos");
            if (!array_key_exists('itemId', $item)) {
                $type = "new";
            }
            $smarty->assign("item", $item);
        }
        $smarty->assign("type", $type);
        $smarty->assign("subpage", $webm["sc_index"]);
        break;

    case 'itemupdatesql':
        $respuesta = $subObjItem->item_update_file($item, $itemId, "campos_proyecto_adjuntos", $type, "proyecto_adjuntos", $itemId, $archivo_adjunto);
        $core->print_json($respuesta);
        break;

    case 'descargarArchivo':
        $subObjItem->descargarArchivo($id);
        break;

}
