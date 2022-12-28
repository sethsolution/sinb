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
            $item = $objItem->get_item($id, "cultivo_productores_custodios");
            if (!array_key_exists('itemId', $item)) {
                $type = "new";
            }
            $smarty->assign("item", $item);
        }
        $listaSexo = array("M" => "MASCULINO", "F" => "FEMENINO");
        $smarty->assign("type", $type);
        $smarty->assign("listaSexo", $listaSexo);
        $smarty->assign("subpage", $webm["sc_index"]);
        break;

    case 'itemupdatesql':
        $respuesta = $subObjItem->item_update($item, $itemId, "campos_productores_custodios", $type, "cultivo_productores_custodios");
        $core->print_json($respuesta);
        break;

}
