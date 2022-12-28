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
            $item = $objItem->get_item($id, "especies");
            $item_adjunto = $subObjItem->getRowsAdjunto($id);
            $item_foto = null;
            $item_ficha = null;
            if (count($item_adjunto) > 0) {
                foreach ($item_adjunto as $clave => $valor) {
                    if ($valor['estado'] == 'foto') {
                        $item_foto = $valor;
                    }
                    if ($valor['estado'] == 'ficha') {
                        $item_ficha = $valor;
                    }
                }
            }
            $especieMunicipios = $subObjItem->getEspecieMunicipios($id);
            $item['municipio_itemid'] = ltrim(rtrim($especieMunicipios['municipio_itemid'], "}"),"{");
            $smarty->assign("item", $item);
            $smarty->assign("itemFoto", $item_foto);
            $smarty->assign("itemFicha", $item_ficha);
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
        $respuesta = $subObjItem->item_update($item, $itemId, "campos_especies", $type, "especies");
        if($respuesta["res"] == 1) {
             if ($type == "update") {
                $subObjItem->item_delete($respuesta["id"], "especie_municipios");
            }
            foreach ($item["municipio_itemid"] as $clave => $valor) {
                $registro = array("espe_itemid" => $respuesta["id"], "municipio_itemid" => $valor);
                $respuesta_municipio = $subObjItem->item_update($registro, $itemId, "campos_especie_municipios", "new", "especie_municipios");
            }
        }
        $core->print_json($respuesta);
        break;

    case 'getMunicipios':
        $respuesta = $subObjItem->getMunicipios($macroId);
        $core->print_json($respuesta);
        break;

    case 'getEstrategiasConservacion':
        $respuesta = $subObjItem->getEstrategiasConservacion($metconservaId);
        $core->print_json($respuesta);
        break;

    case 'descargarRecurso':
        $subObjItem->descargarRecurso($id);
        break;

}
