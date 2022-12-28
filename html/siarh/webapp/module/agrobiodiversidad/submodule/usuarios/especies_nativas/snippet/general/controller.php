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
            $item = $objItem->get_item($id, "especies_nativas");
            $especieMacroregiones = $subObjItem->getEspecieMacroregiones($id);
            $especieDeptos = $subObjItem->getEspecieDeptos($id);
            $especieMunicipios = $subObjItem->getEspecieMunicipios($id);
            $item['macroregion_itemid'] = $especieMacroregiones;
            $item['depto_itemid'] = ltrim(rtrim($especieDeptos['depto_itemid'], "}"),"{");
            $item['municipio_itemid'] = ltrim(rtrim($especieMunicipios['municipio_itemid'], "}"),"{");
            $smarty->assign("item", $item);
        }
        $listaMacroregiones = $subObjItem->getMacroregiones();
        $smarty->assign("macroregiones", $listaMacroregiones);
        $smarty->assign("subpage", $webm["sc_index"]);
        break;

    case 'itemupdatesql':
        $respuesta = $subObjItem->item_update($item, $itemId, "campos_especies_nativas", $type, "especies_nativas");
        if($respuesta["res"] == 1) {
             if ($type == "update") {
                $subObjItem->item_delete($respuesta["id"], "especie_nativa_macroregiones");
                $subObjItem->item_delete($respuesta["id"], "especie_nativa_deptos");
                $subObjItem->item_delete($respuesta["id"], "especie_nativa_municipios");
            }
            foreach ($item["macroreg_itemid"] as $clave => $valor) {
                $registro = array("espenativa_itemid" => $respuesta["id"], "macroreg_itemid" => $valor);
                $respuesta_municipio = $subObjItem->item_update($registro, $itemId, "campos_especie_nativa_macroregiones", "new", "especie_nativa_macroregiones");
            }
            foreach ($item["depto_itemid"] as $clave => $valor) {
                $registro = array("espenativa_itemid" => $respuesta["id"], "depto_itemid" => $valor);
                $respuesta_municipio = $subObjItem->item_update($registro, $itemId, "campos_especie_nativa_deptos", "new", "especie_nativa_deptos");
            }
            foreach ($item["municipio_itemid"] as $clave => $valor) {
                $registro = array("espenativa_itemid" => $respuesta["id"], "municipio_itemid" => $valor);
                $respuesta_municipio = $subObjItem->item_update($registro, $itemId, "campos_especie_nativa_municipios", "new", "especie_nativa_municipios");
            }
        }
        $core->print_json($respuesta);
        break;

    case 'getDeptos':
        $respuesta = $subObjItem->getDeptos($macroId);
        $core->print_json($respuesta);
        break;

    case 'getMunicipios':
        $respuesta = $subObjItem->getMunicipios($deptoId);
        $core->print_json($respuesta);
        break;

    case 'descargarRecurso':
        $subObjItem->descargarRecurso($id);
        break;

}
