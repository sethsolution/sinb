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
        if($type=="update") {
            $item = $objItem->get_item($id, "especie_informacion_adicional");
            if (!array_key_exists('itemId', $item)) {
                $type = "new";
            }
            $smarty->assign("item", $item);
        }
        $smarty->assign("type", $type);
        $smarty->assign("subpage", $webm["sc_index"]);
        break;

    case 'itemupdatesql':
        $respuesta = $subObjItem->item_update($item, $itemId, "campos_informacion_adicional", $type, "especie_informacion_adicional");
        $core->print_json($respuesta);
        break;

}
