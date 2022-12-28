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
            $item = $objItem->get_item($id, "cultivos");
            $item_adjunto = $subObjItem->getRowsAdjunto($id);
            $item_foto = null;
            if (count($item_adjunto) > 0) {
                $item_foto = $item_adjunto[0];
            }
            $depto = $subObjItem->getDepartamento($item['depto_itemid']);
            $municipio = $subObjItem->getMunicipio($item['municipio_itemid']);
            $macroregion = $subObjItem->getMacroregion($item['macroreg_itemid']);
            $item['depto_nombre'] = $depto['nombre'];
            $item['municipio_nombre'] = $municipio['nombre'];
            $item['macroreg_nombre'] = $macroregion['nombre'];
            $smarty->assign("item", $item);
            $smarty->assign("itemFoto", $item_foto);
        }
        $listaEspecies = $subObjItem->getEspecies();
        $especies = array();
        foreach ($listaEspecies as $clave => $valor) {
            $especies[$valor['itemId']] = $valor['nombre'];
        }
        $especieAsociaCultivos = array('Si' => 'Si', 'No' => 'No');
        $semillaPlantin = array('Kg' => 'Kg', 'Plantín' => 'Plantín');
        $unidadesSiembra = array('Kg/Ha' => 'Kg/Ha', 'Planta/Ha' => 'Planta/Ha');
        $smarty->assign("listaEspecies", $especies);
        $smarty->assign("especieAsociaCultivos", $especieAsociaCultivos);
        $smarty->assign("semillaPlantin", $semillaPlantin);
        $smarty->assign("unidadesSiembra", $unidadesSiembra);
        $smarty->assign("subpage", $webm["sc_index"]);
        break;

    case 'itemupdatesql':
        $respuesta = $subObjItem->item_update($item, $itemId, "campos_cultivos", $type, "cultivos");
        $core->print_json($respuesta);
        break;

    case 'obtenerUbicacion':
        $info_ubicacion = array();
        $depto = $subObjItem->ubicarDepartamento($longitud, $latitud);
        if (count($depto) == 1) {
            echo json_encode(
                array('res' => 2,
                    'msg' => 'Ubique el punto en territorio boliviano.',
                    'data' => ''
                )
            );
            exit();
        }
        $municipio = $subObjItem->ubicarMunicipio($longitud, $latitud);
        $comunidad = $subObjItem->ubicarComunidad($longitud, $latitud);
        $macroregion = $subObjItem->ubicarMacroregion($longitud, $latitud);
        $datos_departamento = array("depto_nombre" => $depto['nombre'], "depto_id" => $depto['itemId']);
        $datos_municipio = array("municipio_nombre" => $municipio['nombre'], "municipio_id" => $municipio['itemId']);
        $datos_comunidad = array("comunidad_nombre" => $comunidad['nombre'], "comunidad_id" => $comunidad['itemId']);
        $datos_macroregion = array("macroreg_nombre" => $macroregion['nombre'], "macroreg_id" => $macroregion['itemId']);
        $coord_decimal = array("lat_decimal" => $latitud, "lon_decimal" => $longitud);
        $coord_utm = $subObjItem->convertirDecimalUtm($longitud, $latitud);
        $coord_dms = $subObjItem->convertirDecimalDms($longitud, $latitud);
        $info_ubicacion = array_merge($datos_departamento, $datos_municipio, $datos_comunidad, $datos_macroregion, $coord_decimal, $coord_utm, $coord_dms);
        echo json_encode(array("res" => 1, "msg" => "Conversión exitosa.", "data" => $info_ubicacion), JSON_NUMERIC_CHECK);
        exit;
        break;

    case 'obtenerUbicacionUtm':
        $info_ubicacion = array();
        $coord_decimal = $subObjItem->convertirUtmDecimal($utm_este, $utm_norte, $utm_zona);
        $longitud = $coord_decimal['lon_decimal'];
        $latitud = $coord_decimal['lat_decimal'];

        $depto = $subObjItem->ubicarDepartamento($longitud, $latitud);
        if (count($depto) == 0) {
            echo json_encode(
                array('res' => 2,
                    'msg' => 'Ubique el punto en territorio boliviano.',
                    'data' => ''
                )
            );
            exit();
        }
        $municipio = $subObjItem->ubicarMunicipio($longitud, $latitud);
        $comunidad = $subObjItem->ubicarComunidad($longitud, $latitud);
        $macroregion = $subObjItem->ubicarMacroregion($longitud, $latitud);
        $datos_departamento = array("depto_nombre" => $depto['nombre'], "depto_id" => $depto['itemId']);
        $datos_municipio = array("municipio_nombre" => $municipio['nombre'], "municipio_id" => $municipio['itemId']);
        $datos_comunidad = array("comunidad_nombre" => $comunidad['nombre'], "comunidad_id" => $comunidad['itemId']);
        $datos_macroregion = array("macroreg_nombre" => $macroregion['nombre'], "macroreg_id" => $macroregion['itemId']);
        $coord_utm = array("utm_este" => $utm_este, "utm_norte" => $utm_norte, "utm_zona" => $utm_zona);
        $coord_dms = $subObjItem->convertirDecimalDms($longitud, $latitud);
        $info_ubicacion = array_merge($datos_departamento, $datos_municipio, $datos_comunidad, $datos_macroregion, $coord_decimal, $coord_utm, $coord_dms);
        echo json_encode(array("res" => 1, "msg" => "Conversión exitosa.", "data" => $info_ubicacion), JSON_NUMERIC_CHECK);
        exit;
        break;

    case 'getEcotipos':
        $listaEcotipos = $subObjItem->getEcotipos($especieId);
        echo json_encode($listaEcotipos, JSON_NUMERIC_CHECK);
        exit;
        break;

    case 'getClasesVinculacion':
        $listaClasesVinculacion = $subObjItem->getClasesVinculacion($vinculaId);
        echo json_encode($listaClasesVinculacion, JSON_NUMERIC_CHECK);
        exit;
        break;

    case 'descargarRecurso':
        $subObjItem->descargarRecurso($id);
        break;

}
