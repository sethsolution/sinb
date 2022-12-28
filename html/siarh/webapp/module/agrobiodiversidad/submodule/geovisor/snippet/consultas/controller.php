<?php
/**
 * Todo el sub Control se recuperará mediante llamadas por ajax
 */
$templateModule = $templateModuleAjax;

switch($accion){

    /**
     * Página por defecto (index)
     */
    default:
        $smarty->assign("subpage", $webm["vista_depto_sc_index"]);
        break;

    case 'getCultivos':
        $res_geojson = $subObjItem->get_formato_geojson($subObjItem->getCultivos($macroregion, $depto));
        echo $res_geojson;
        exit();
        break;

    case 'getEspecies':
        $res_geojson = $subObjItem->get_formato_geojson_especies($subObjItem->getEspecies($macroregion, $depto));
        echo $res_geojson;
        exit();
        break;

    case 'getEspeciesNativas':
        $res_geojson = $subObjItem->get_formato_geojson_especies_nativas($subObjItem->getEspeciesNativas($macroregion, $depto, $municipio));
        echo $res_geojson;
        exit();
        break;

    case 'getCultivosFiltrado':
        $res_geojson = $subObjItem->get_formato_geojson($subObjItem->getCultivosFiltrado($item));
        echo $res_geojson;
        exit();
        break;

    case 'getEspeciesFiltrado':
        $res_geojson = $subObjItem->get_formato_geojson_especies($subObjItem->getEspeciesFiltrado($item));
        echo $res_geojson;
        exit();
        break;

    case 'getEspeciesNativasFiltrado':
        $res_geojson = $subObjItem->get_formato_geojson_especies_nativas($subObjItem->getEspeciesNativasFiltrado($macroregion, $depto, $municipio));
        echo $res_geojson;
        exit();
        break;

    case 'getCultivosPoligono':
        $res_geojson = $subObjItem->get_formato_geojson($subObjItem->getCultivosPoligono($id));
        echo $res_geojson;
        exit();
        break;

    case 'getEspeciesPoligono':
        $res_geojson = $subObjItem->get_formato_geojson_especies($subObjItem->getEspeciesPoligono($id));
        echo $res_geojson;
        exit();
        break;

    case 'getEspeciesNativasPoligono':
        $res_geojson = $subObjItem->get_formato_geojson_especies_nativas($subObjItem->getEspeciesNativasPoligono($id));
        echo $res_geojson;
        exit();
        break;

    case 'getDatosGeneral':
        // Consulta datos de especies
        $datos_especies = array();
        $res_especies_total = $subObjItem->getDatosGeneralEspecies();
        $res_especies_actual = $subObjItem->getDatosGeneralEspeciesActual();
        $cont_especies = 0;
        foreach ($res_especies_total as $clave => $valor) {
            $cont_especies += $valor['total_especies'];
            $datos_especies['total_especie_'.$valor['categoria']] = $valor['total_especies'];
        }
        $datos_especies['total_especies'] = $cont_especies;
        $datos_especies['total_especies_actual'] = $res_especies_actual[0]['total_especies_actual'];
        $datos_especies['porcentaje_especies_actual'] = ($res_especies_actual[0]['total_especies_actual']*100)/$cont_especies;

        // Consulta datos de cultivos
        $datos_cultivos = array();
        $res_cultivos_total = $subObjItem->getDatosGeneralCultivos();
        $res_cultivos_actual = $subObjItem->getDatosGeneralCultivosActual();
        $cont_cultivos = 0;
        $cont_superficie = 0;
        foreach ($res_cultivos_total as $clave => $valor) {
            $cont_cultivos += $valor['total_cultivos'];
            $cont_superficie += $valor['superficie_total'];
        }
        $datos_cultivos['total_cultivos'] = $cont_cultivos;
        $datos_cultivos['superficie_total'] = $cont_superficie;
        $datos_cultivos['total_deptos'] = count($res_cultivos_total);
        $datos_cultivos['total_cultivos_actual'] = $res_cultivos_actual[0]['total_cultivos_actual'];
        $datos_cultivos['porcentaje_cultivos_actual'] = ($res_cultivos_actual[0]['total_cultivos_actual']*100)/$cont_cultivos;

        // Consulta datos de documentos
        $datos_docs = array();
        $res_docs_total = $subObjItem->getDatosGeneralDocumentos();
        $res_docs_actual = $subObjItem->getDatosGeneralDocumentosActual();
        $cont_docs = 0;
        $cont_superficie = 0;
        foreach ($res_docs_total as $clave => $valor) {
            $cont_docs += $valor['total_docs'];
        }
        $datos_docs['total_docs'] = $cont_docs;
        $datos_docs['total_docs_actual'] = $res_docs_actual[0]['total_docs_actual'];
        $datos_docs['porcentaje_docs_actual'] = ($res_docs_actual[0]['total_docs_actual']*100)/$cont_docs;

        $smarty->assign("datos_especies", $datos_especies);
        $smarty->assign("datos_cultivos", $datos_cultivos);
        $smarty->assign("datos_docs", $datos_docs);
        $smarty->assign("subpage", $webm["vista_general_sc_index"]);
        break;

    case 'getDatosCobertura':
        // Consulta datos de especies
        $datos_depto = $subObjItem->getDatosDepto($depto);
        $etiquetas = array();
        $datos = array();
        $datos_sup = array();
        foreach ($datos_depto as $clave => $valor) {
            $etiquetas[] = $valor['categoria'].' ('.$valor['depto'].')';
            $datos[] = $valor['total'];
            $datos_sup[] = $valor['total_superficie'];
        }
        $smarty->assign("datos_depto", $datos_depto);
        $smarty->assign("etiquetas", json_encode($etiquetas, JSON_NUMERIC_CHECK));
        $smarty->assign("datos", json_encode($datos, JSON_NUMERIC_CHECK));
        $smarty->assign("datos_sup", json_encode($datos_sup, JSON_NUMERIC_CHECK));

        $datos_depto_especie = $subObjItem->getDatosDeptoEspecie($depto);
        $etiquetas = array();
        $datos = array();
        foreach ($datos_depto_especie as $clave => $valor) {
            $etiquetas[] = $valor['especie'];
            $datos[] = $valor['total_superficie'];
        }
        $smarty->assign("datos_depto_especie", $datos_depto_especie);
        $smarty->assign("etiquetas_especie", json_encode($etiquetas, JSON_NUMERIC_CHECK));
        $smarty->assign("datos_especie", json_encode($datos, JSON_NUMERIC_CHECK));
        $smarty->assign("subpage", $webm["vista_depto_sc_index"]);
        break;

    case 'getDatosMacroregion':
        // Consulta datos de especies
        $datos_macroregion = $subObjItem->getDatosMacroregion($macroregion);
        $etiquetas = array();
        $datos = array();
        $datos_sup = array();
        foreach ($datos_macroregion as $clave => $valor) {
            $etiquetas[] = $valor['categoria'].' ('.$valor['macroregion'].')';
            $datos[] = $valor['total'];
            $datos_sup[] = $valor['total_superficie'];
        }
        $smarty->assign("datos_macroregion", $datos_macroregion);
        $smarty->assign("etiquetas", json_encode($etiquetas, JSON_NUMERIC_CHECK));
        $smarty->assign("datos", json_encode($datos, JSON_NUMERIC_CHECK));
        $smarty->assign("datos_sup", json_encode($datos_sup, JSON_NUMERIC_CHECK));

        $datos_macroregion_especie = $subObjItem->getDatosMacroregionEspecie($macroregion);
        $etiquetas = array();
        $datos = array();
        foreach ($datos_macroregion_especie as $clave => $valor) {
            $etiquetas[] = $valor['especie'];
            $datos[] = $valor['total_superficie'];
        }
        $smarty->assign("datos_macroregion_especie", $datos_macroregion_especie);
        $smarty->assign("etiquetas_especie", json_encode($etiquetas, JSON_NUMERIC_CHECK));
        $smarty->assign("datos_especie", json_encode($datos, JSON_NUMERIC_CHECK));
        $smarty->assign("subpage", $webm["vista_macroregion_sc_index"]);
        break;

    case 'descargarImagen':
        $subObjItem->descargarImagen($id);
        break;

    case 'getPoligonos':
        $res_geojson = $subObjItem->get_formato_geojson_poligonos($subObjItem->getPoligonos());
        echo $res_geojson;
        exit();
        break;

    case 'codice':
        echo "Definir función...";
        break;
}