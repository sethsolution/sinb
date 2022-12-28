<?php
/**
 * Created by PhpStorm.
 * User: henrytaby
 * Date: 3/5/2018
 * Time: 15:27
 */

$templateModule = $templateModuleGeo;

switch($accion) {
    /**
     * Página por defecto
     */
    default:
        $objCatalog->conf_catalog_datos_general();
        $cataobj = $objCatalog->getCatalogList();
        $smarty->assign("cataobj", $cataobj);

        $macroregiones = $objItem->getMacroregiones();
        $deptos = $objItem->getDepartamentos();
        $especies = $objItem->getEspecies();
        $especie_asocia_cultivo = array('Si' => 'Si', 'No' => 'No');

        $smarty->assign("macroregiones", $macroregiones);
        $smarty->assign("deptos", $deptos);
        $smarty->assign("especies", $especies);
        $smarty->assign("especie_asocia_cultivo", $especie_asocia_cultivo);
        $smarty->assign("subpage", $webm["index"]);
        $smarty->assign("subpage_js", $webm["index_js"]);
        break;

    case 'guardarPoligono':
        $datos = array(
            'nombre'=> utf8_encode($capa_nombre),
            'geom'=> $objItem->convertirArregloPoligono($capa_geom)
            );
        echo $objItem->guardarPoligono($datos);
        exit;
        break;

    case 'eliminarPoligono':
        $res = $objItem->item_delete($id, "itemId", "mapa_poligonos");
        $core->print_json($res);
        break;

    case 'obtenerMunicipios':
        $res = $objItem->getMunicipios($deptoId);
        $core->print_json($res);
        break;

    case 'obtenerCapasWms':
        $cliente = curl_init();
        curl_setopt($cliente, CURLOPT_URL, $wms_url);
        curl_setopt($respuesta, CURLOPT_RETURNTRANSFER, 1);
        $contenido = curl_exec($cliente);
        $error = curl_error($ch);
        $size = curl_getinfo($cliente, CURLINFO_CONTENT_LENGTH_DOWNLOAD);
        curl_close($cliente);

        header ("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
        header ("Last-Modified: " . gmdate("D,d M YH:i:s") . " GMT");
        header ("Cache-Control: no-cache, must-revalidate");
        header ("Pragma: no-cache");
        header ("Content-Type: application/xml");
        header ('Content-Disposition: attachment; filename="doc.xml"');
        header ("Content-Length: ".$size);
        readfile($contenido);
        exit();
        break;
    
    case 'listarShapefiles':
        $res = $objItem->getShapefiles();
        $core->print_json($res);
        break;
    
    case 'descargarShapefile':
        $objItem->descargarShapefile($id);
        break;

    case 'codice':
        echo "Es una mala llamada de un snippet.";
        exit();
        break;

}
