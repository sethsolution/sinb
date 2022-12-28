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
            $item = $objItem->get_item($id, "proyectos");
            $proyectoDeptos = $subObjItem->getProyectoDeptos($id);
            $item['depto_itemid'] = $proyectoDeptos['depto_itemid'];
            $proyectoMunicipios = $subObjItem->getProyectoMunicipios($id);
            $item['municipio_itemid'] = $proyectoMunicipios['municipio_itemid'];
            $smarty->assign("item", $item);
        }
        $resDeptos = $subObjItem->getDepartamentos();
        $deptos = array();
        foreach ($resDeptos as $clave => $valor) {
            $deptos[$valor['itemId']] = $valor['nombre'];
        }
        $smarty->assign("deptos", $deptos);
        $smarty->assign("subpage", $webm["sc_index"]);
        break;

    case 'itemupdatesql':
        $respuesta = $subObjItem->item_update($item, $itemId, "campos_proyectos", $type, "proyectos");
        if($respuesta["res"] == 1) {
             if ($type == "update") {
                $subObjItem->item_delete($respuesta["id"], "proyecto_deptos");
                $subObjItem->item_delete($respuesta["id"], "proyecto_municipios");
            }
            foreach ($item["depto_itemid"] as $clave => $valor) {
                $registro = array("proy_itemid" => $respuesta["id"], "depto_itemid" => $valor);
                $res_depto = $subObjItem->item_update($registro, $itemId, "campos_proyecto_deptos", "new", "proyecto_deptos");
            }
            foreach ($item["municipio_itemid"] as $clave => $valor) {
                $registro = array("proy_itemid" => $respuesta["id"], "municipio_itemid" => $valor);
                $res_municipio = $subObjItem->item_update($registro, $itemId, "campos_proyecto_municipios", "new", "proyecto_municipios");
            }
        }
        $core->print_json($respuesta);
        break;

    case 'getMunicipios':
        $respuesta = $subObjItem->getMunicipios($deptoId);
        $core->print_json($respuesta);
        break;

}
