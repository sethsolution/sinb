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
        $subObjCatalog->conf_catalog_datos_general();
        $cataobj = $subObjCatalog->getCatalogList();
        $smarty->assign("cataobj", $cataobj);
        $smarty->assign("type", $type);

        if($type=="update") {
            $item = $objItem->get_item($id, "documentos");
            $smarty->assign("item", $item);
        }
        $listaMacroregiones = $subObjItem->getMacroregiones();
        $macroregiones = array();
        foreach ($listaMacroregiones as $clave => $valor) {
            $macroregiones[$valor['itemId']] = $valor['nombre'];
        }
        $smarty->assign("macroregiones", $macroregiones);
        $smarty->assign("subpage", $webm["sc_index"]);
        break;

    case 'itemupdatesql':
        $respuesta = $subObjItem->item_update_file($item, $itemId, "campos_documentos", $type, "documentos", $itemId, $archivo_adjunto);
        $core->print_json($respuesta);
        break;

}
