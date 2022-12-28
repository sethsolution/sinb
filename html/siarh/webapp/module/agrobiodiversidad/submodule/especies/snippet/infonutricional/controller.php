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

        $listaCompuestos = $subObjItem->getCompuestos($id);
        $listaTiposValorCompuesto = $subObjItem->getTiposValorCompuesto();
        $smarty->assign("listaCompuestos", $listaCompuestos);
        $smarty->assign("listaTiposValorCompuesto", $listaTiposValorCompuesto);

        if($type=="update") {
            //$item = $objItem->get_item($id, "alimentos");
            //$smarty->assign("item", $item);
        }
        $smarty->assign("subpage", $webm["sc_index"]);
        break;

    case 'itemupdatesql':
        $item = array(
            'espe_itemid' => $espe_itemid,
            'compuesto_itemid' => $compuesto_itemid,
            'valor' => $valor,
            'tipovalor_itemid' => $tipovalor_itemid
            );
        $registro = $subObjItem->get_item($espe_itemid, $compuesto_itemid, "especie_informacion_nutricional");
        if (!array_key_exists('itemId', $registro)) {
            $type = 'new';
            $respuesta = $subObjItem->item_update($item, $itemId, "campos_infonutricional", $type, "especie_informacion_nutricional");
        } else {
            $type = 'update';
            $respuesta = $subObjItem->set_info_nutricional($item, $itemId);
        }
        //$respuesta = $subObjItem->item_update($item, $itemId, "campos_infonutricional", $type, "especie_informacion_nutricional");
        $core->print_json($respuesta);
        break;

}
