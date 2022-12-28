<?php

/**
 * Todo el sub Control se recuperará mediante llamadas por ajax
 */
$templateModule = $templateModuleAjax;

switch ($accion) {
        /**
     * Página por defecto (index)
     */
    default:
        $grill_list = $subObjItem->get_grilla_list_sbm("grilla_proyecto_metas");
        $smarty->assign("grill_list", $grill_list);
        $smarty->assign("subpage", $webm["sc_index"]);
        //$smarty->assign("subpage_js", $webm["index_js"]);
        break;

    case 'getItemList':
        $res = $subObjItem->get_item_datatable_Rows($id);
        $core->print_json($res);
        break;

    case 'getForm':
        $subObjCatalog->conf_catalog_datos_general();
        $cataobj = $subObjCatalog->getCatalogList();
        $smarty->assign("cataobj", $cataobj);
        $smarty->assign("id", $id);
        $smarty->assign("proymetaId", $proymetaId);
        $smarty->assign("type", $type);
        if ($type == "update") {
            $item = $subObjItem->get_item($proymetaId, "proyecto_metas");
            $smarty->assign("item", $item);
        }
        $smarty->assign("subpage", $webm["form_sc_index"]);
        break;

    case 'itemupdatesql':
        $respuesta = $subObjItem->item_update($item, $itemId, "campos_proyecto_metas", $type, "proyecto_metas");
        $core->print_json($respuesta);
        break;

    case 'itemDelete':
        $res = $objItem->item_delete($id, "itemId", "proyecto_metas");
        $core->print_json($res);
        break;

    case 'verResumen':
        $metas = $subObjItem->getMetas($id);
        foreach ($metas as $clave => $valor) {
            switch ($valor['meta_itemid']) {
                case 1:
                    $res = $subObjItem->geCantidadEcotipos($id);
                    $metas[$clave]['total'] = $res['total'];
                    $metas[$clave]['descrip'] = $res['descrip'];
                    $metas[$clave]['porcentaje'] = round(($res['total'] / $valor['meta']) * 100, 2);
                    break;
                case 2:
                    $res = $subObjItem->getEspeciesCultivadas($id);
                    $metas[$clave]['total'] = $res['total'];
                    $metas[$clave]['descrip'] = $res['descrip'];
                    $metas[$clave]['porcentaje'] = round(($res['total'] / $valor['meta']) * 100, 2);
                    break;
                case 3:
                    $res = $subObjItem->getEspeciesSilvestres($id);
                    $metas[$clave]['total'] = $res['total'];
                    $metas[$clave]['descrip'] = $res['descrip'];
                    $metas[$clave]['porcentaje'] = round(($res['total'] / $valor['meta']) * 100, 2);
                    break;
                case 4:
                    $res = $subObjItem->getEspeciesMmaya($id);
                    $metas[$clave]['total'] = $res['total'];
                    $metas[$clave]['descrip'] = $res['descrip'];
                    $metas[$clave]['porcentaje'] = round(($res['total'] / $valor['meta']) * 100, 2);
                    break;
                case 5:
                    $res = $subObjItem->getCultivosInsitu($id);
                    $metas[$clave]['total'] = $res['total'];
                    $metas[$clave]['descrip'] = $res['descrip'];
                    $metas[$clave]['porcentaje'] = round(($res['total'] / $valor['meta']) * 100, 2);
                    break;
                case 6:
                    $res = $subObjItem->getCultivosExsitu($id);
                    $metas[$clave]['total'] = $res['total'];
                    $metas[$clave]['descrip'] = $res['descrip'];
                    $metas[$clave]['porcentaje'] = round(($res['total'] / $valor['meta']) * 100, 2);
                    break;
                case 7:
                    $res = $subObjItem->getPlanManejoProduccion($id);
                    $metas[$clave]['total'] = $res['total'];
                    $metas[$clave]['descrip'] = $res['descrip'];
                    $metas[$clave]['porcentaje'] = round(($res['total'] / $valor['meta']) * 100, 2);
                    break;
                case 8:
                    $res = $subObjItem->getCertificcion($id);
                    $metas[$clave]['total'] = $res['total'];
                    $metas[$clave]['descrip'] = $res['descrip'];
                    $metas[$clave]['porcentaje'] = round(($res['total'] / $valor['meta']) * 100, 2);
                    break;
                case 9:
                    $res = $subObjItem->getSistemaAgroforestal($id);
                    $metas[$clave]['total'] = $res['total'];
                    $metas[$clave]['descrip'] = $res['descrip'];
                    $metas[$clave]['porcentaje'] = round(($res['total'] / $valor['meta']) * 100, 2);
                    break;
                case 10:
                    $res = $subObjItem->getSistgetSistemaFamiliar($id);
                    $metas[$clave]['total'] = $res['total'];
                    $metas[$clave]['descrip'] = $res['descrip'];
                    $metas[$clave]['porcentaje'] = round(($res['total'] / $valor['meta']) * 100, 2);
                    break;
                case 11:
                    $res = $subObjItem->getRecoleccion($id);
                    $metas[$clave]['total'] = $res['total'];
                    $metas[$clave]['descrip'] = $res['descrip'];
                    $metas[$clave]['porcentaje'] = round(($res['total'] / $valor['meta']) * 100, 2);
                    break;
                case 12:
                    $res = $subObjItem->getTransformacion($id);
                    $metas[$clave]['total'] = $res['total'];
                    $metas[$clave]['descrip'] = $res['descrip'];
                    $metas[$clave]['porcentaje'] = round(($res['total'] / $valor['meta']) * 100, 2);
                    break;
                case 13:
                    $res = $subObjItem->getRegistroSanitario($id);
                    $metas[$clave]['total'] = $res['total'];
                    $metas[$clave]['descrip'] = $res['descrip'];
                    $metas[$clave]['porcentaje'] = round(($res['total'] / $valor['meta']) * 100, 2);
                    break;
                case 14:
                    $res = $subObjItem->getSuperficieManejoProduccion($id);
                    $metas[$clave]['total'] = $res['total'];
                    $metas[$clave]['descrip'] = $res['descrip'];
                    $metas[$clave]['porcentaje'] = round(($res['total'] / $valor['meta']) * 100, 2);
                    break;
                case 15:
                    $res = $subObjItem->getSuperficieCertificada($id);
                    $metas[$clave]['total'] = $res['total'];
                    $metas[$clave]['descrip'] = $res['descrip'];
                    $metas[$clave]['porcentaje'] = round(($res['total'] / $valor['meta']) * 100, 2);
                    break;
                case 16:
                    $res = $subObjItem->getSuperficieAgroforestal($id);
                    $metas[$clave]['total'] = $res['total'];
                    $metas[$clave]['descrip'] = $res['descrip'];
                    $metas[$clave]['porcentaje'] = round(($res['total'] / $valor['meta']) * 100, 2);
                    break;
                case 17:
                    $res = $subObjItem->getSuperficieSiembraRecoleccion($id);
                    $metas[$clave]['total'] = $res['total'];
                    $metas[$clave]['descrip'] = $res['descrip'];
                    $metas[$clave]['porcentaje'] = round(($res['total'] / $valor['meta']) * 100, 2);
                    break;
                case 18:
                    $res = $subObjItem->getSuperficietotal($id);
                    $metas[$clave]['total'] = $res['total'];
                    $metas[$clave]['descrip'] = $res['descrip'];
                    $metas[$clave]['porcentaje'] = round(($res['total'] / $valor['meta']) * 100, 2);
                    break;
                case 19:
                    $res = $subObjItem->getConservacionHombres($id);
                    $metas[$clave]['total'] = $res['total'];
                    $metas[$clave]['descrip'] = $res['descrip'];
                    $metas[$clave]['porcentaje'] = round(($res['total'] / $valor['meta']) * 100, 2);
                    break;
                case 20:
                    $res = $subObjItem->getConservacionMujeres($id);
                    $metas[$clave]['total'] = $res['total'];
                    $metas[$clave]['descrip'] = $res['descrip'];
                    $metas[$clave]['porcentaje'] = round(($res['total'] / $valor['meta']) * 100, 2);
                    break;

                case 21:
                    $res = $subObjItem->getPlanesHombres($id);
                    $metas[$clave]['total'] = $res['total'];
                    $metas[$clave]['descrip'] = $res['descrip'];
                    $metas[$clave]['porcentaje'] = round(($res['total'] / $valor['meta']) * 100, 2);
                    break;
                case 22:
                    $res = $subObjItem->getPlanesMujeres($id);
                    $metas[$clave]['total'] = $res['total'];
                    $metas[$clave]['descrip'] = $res['descrip'];
                    $metas[$clave]['porcentaje'] = round(($res['total'] / $valor['meta']) * 100, 2);
                    break;
                case 23:
                    $res = $subObjItem->getCertificacionHombres($id);
                    $metas[$clave]['total'] = $res['total'];
                    $metas[$clave]['descrip'] = $res['descrip'];
                    $metas[$clave]['porcentaje'] = round(($res['total'] / $valor['meta']) * 100, 2);
                    break;
                case 24:
                    $res = $subObjItem->getCertificacionMujeres($id);
                    $metas[$clave]['total'] = $res['total'];
                    $metas[$clave]['descrip'] = $res['descrip'];
                    $metas[$clave]['porcentaje'] = round(($res['total'] / $valor['meta']) * 100, 2);
                    break;
                case 25:
                    $res = $subObjItem->getAgroforestalHombres($id);
                    $metas[$clave]['total'] = $res['total'];
                    $metas[$clave]['descrip'] = $res['descrip'];
                    $metas[$clave]['porcentaje'] = round(($res['total'] / $valor['meta']) * 100, 2);
                    break;
                case 26:
                    $res = $subObjItem->getAgroforestalMujeres($id);
                    $metas[$clave]['total'] = $res['total'];
                    $metas[$clave]['descrip'] = $res['descrip'];
                    $metas[$clave]['porcentaje'] = round(($res['total'] / $valor['meta']) * 100, 2);
                    break;
                case 27:
                    $res = $subObjItem->getSiembraRecoleccionHombres($id);
                    $metas[$clave]['total'] = $res['total'];
                    $metas[$clave]['descrip'] = $res['descrip'];
                    $metas[$clave]['porcentaje'] = round(($res['total'] / $valor['meta']) * 100, 2);
                    break;
                case 28:
                    $res = $subObjItem->getSiembraRecoleccionMujeres($id);
                    $metas[$clave]['total'] = $res['total'];
                    $metas[$clave]['descrip'] = $res['descrip'];
                    $metas[$clave]['porcentaje'] = round(($res['total'] / $valor['meta']) * 100, 2);
                    break;
                case 29:
                    $res = $subObjItem->getEmprendimientosHombres($id);
                    $metas[$clave]['total'] = $res['total'];
                    $metas[$clave]['descrip'] = $res['descrip'];
                    $metas[$clave]['porcentaje'] = round(($res['total'] / $valor['meta']) * 100, 2);
                    break;
                case 30:
                    $res = $subObjItem->getEmprendimientosMujeres($id);
                    $metas[$clave]['total'] = $res['total'];
                    $metas[$clave]['descrip'] = $res['descrip'];
                    $metas[$clave]['porcentaje'] = round(($res['total'] / $valor['meta']) * 100, 2);
                    break;
                case 31:
                    $res = $subObjItem->getSemillaConservada($id);
                    $metas[$clave]['total'] = $res['total'];
                    $metas[$clave]['descrip'] = $res['descrip'];
                    $metas[$clave]['porcentaje'] = round(($res['total'] / $valor['meta']) * 100, 2);
                    break;
                case 32:
                    $res = $subObjItem->getPlantinConservada($id);
                    $metas[$clave]['total'] = $res['total'];
                    $metas[$clave]['descrip'] = $res['descrip'];
                    $metas[$clave]['porcentaje'] = round(($res['total'] / $valor['meta']) * 100, 2);
                    break;
                case 33:
                    $res = $subObjItem->getProduccionPlanes($id);
                    $metas[$clave]['total'] = $res['total'];
                    $metas[$clave]['descrip'] = $res['descrip'];
                    $metas[$clave]['porcentaje'] = round(($res['total'] / $valor['meta']) * 100, 2);
                    break;

                case 34:
                    $res = $subObjItem->getProduccionCertificacion($id);
                    $metas[$clave]['total'] = $res['total'];
                    $metas[$clave]['descrip'] = $res['descrip'];
                    $metas[$clave]['porcentaje'] = round(($res['total'] / $valor['meta']) * 100, 2);
                    break;
                case 35:
                    $res = $subObjItem->getProduccionAgroforestal($id);
                    $metas[$clave]['total'] = $res['total'];
                    $metas[$clave]['descrip'] = $res['descrip'];
                    $metas[$clave]['porcentaje'] = round(($res['total'] / $valor['meta']) * 100, 2);
                    break;
                case 36:
                    $res = $subObjItem->getProduccionSiembraRecoleccion($id);
                    $metas[$clave]['total'] = $res['total'];
                    $metas[$clave]['descrip'] = $res['descrip'];
                    $metas[$clave]['porcentaje'] = round(($res['total'] / $valor['meta']) * 100, 2);
                    break;
                case 37:
                    $res = $subObjItem->getProduccionVentaPlanes($id);
                    $metas[$clave]['total'] = $res['total'];
                    $metas[$clave]['descrip'] = $res['descrip'];
                    $metas[$clave]['porcentaje'] = round(($res['total'] / $valor['meta']) * 100, 2);
                    break;
                case 38:
                    $res = $subObjItem->getProduccionVentaAgroforestal($id);
                    $metas[$clave]['total'] = $res['total'];
                    $metas[$clave]['descrip'] = $res['descrip'];
                    $metas[$clave]['porcentaje'] = round(($res['total'] / $valor['meta']) * 100, 2);
                    break;
                case 39:
                    $res = $subObjItem->getProduccionVentaSiembraRecoleccion($id);
                    $metas[$clave]['total'] = $res['total'];
                    $metas[$clave]['descrip'] = $res['descrip'];
                    $metas[$clave]['porcentaje'] = round(($res['total'] / $valor['meta']) * 100, 2);
                    break;
                case 40:
                    $res = $subObjItem->getComercializacionPlanes($id);
                    $metas[$clave]['total'] = $res['total'];
                    $metas[$clave]['descrip'] = $res['descrip'];
                    $metas[$clave]['porcentaje'] = round(($res['total'] / $valor['meta']) * 100, 2);
                    break;
                case 41:
                    $res = $subObjItem->getComercializacionCertificacion($id);
                    $metas[$clave]['total'] = $res['total'];
                    $metas[$clave]['descrip'] = $res['descrip'];
                    $metas[$clave]['porcentaje'] = round(($res['total'] / $valor['meta']) * 100, 2);
                    break;
                case 42:
                    $res = $subObjItem->getComercializacionAgroforestales($id);
                    $metas[$clave]['total'] = $res['total'];
                    $metas[$clave]['descrip'] = $res['descrip'];
                    $metas[$clave]['porcentaje'] = round(($res['total'] / $valor['meta']) * 100, 2);
                    break;
                case 43:
                    $res = $subObjItem->getComercializacionSiembraRecoleccion($id);
                    $metas[$clave]['total'] = $res['total'];
                    $metas[$clave]['descrip'] = $res['descrip'];
                    $metas[$clave]['porcentaje'] = round(($res['total'] / $valor['meta']) * 100, 2);
                    break;
                case 44:
                    $res = $subObjItem->getComercializacionEmprendimiento($id);
                    $metas[$clave]['total'] = $res['total'];
                    $metas[$clave]['descrip'] = $res['descrip'];
                    $metas[$clave]['porcentaje'] = round(($res['total'] / $valor['meta']) * 100, 2);
                    break;
                case 45:
                    $res = $subObjItem->getComercializacionRegistroSanitario($id);
                    $metas[$clave]['total'] = $res['total'];
                    $metas[$clave]['descrip'] = $res['descrip'];
                    $metas[$clave]['porcentaje'] = round(($res['total'] / $valor['meta']) * 100, 2);
                    break;
                case 46:
                    $res = $subObjItem->getCantidadDocumentos($id);
                    $metas[$clave]['total'] = $res['total'];
                    $metas[$clave]['descrip'] = $res['descrip'];
                    $metas[$clave]['porcentaje'] = round(($res['total'] / $valor['meta']) * 100, 2);
                    break;
                case 47:
                    $res = $subObjItem->getCantidadDocumentosNormativaPlani($id);
                    $metas[$clave]['total'] = $res['total'];
                    $metas[$clave]['descrip'] = $res['descrip'];
                    $metas[$clave]['porcentaje'] = round(($res['total'] / $valor['meta']) * 100, 2);
                    break;
                case 48:
                    $res = $subObjItem->getCantidadDocumentosDiseñoInf($id);
                    $metas[$clave]['total'] = $res['total'];
                    $metas[$clave]['descrip'] = $res['descrip'];
                    $metas[$clave]['porcentaje'] = round(($res['total'] / $valor['meta']) * 100, 2);
                    break;
                case 49:
                    $res = $subObjItem->getCantidadDocumentosBaseDatos($id);
                    $metas[$clave]['total'] = $res['total'];
                    $metas[$clave]['descrip'] = $res['descrip'];
                    $metas[$clave]['porcentaje'] = round(($res['total'] / $valor['meta']) * 100, 2);
                    break;
            }
        }
        $smarty->assign("metas", $metas);
        $smarty->assign("subpage", $webm["tabla_resumen_sc_index"]);
        break;
}
