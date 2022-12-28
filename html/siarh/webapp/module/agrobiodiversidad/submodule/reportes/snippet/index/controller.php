<?php
/**
 * Created by PhpStorm.
 * User: henrytaby
 * Date: 3/5/2018
 * Time: 15:27
 */

switch($accion) {
    /**
     * Página por defecto
     */
    default:
        /**
         * Cargamos catalogos necesarios
         */
        $objCatalog->conf_catalog_datos_general();
        $cataobj = $objCatalog->getCatalogList();
        $smarty->assign("cataobj", $cataobj);

        if ($_SESSION['userv']['itemId'] != 1) {
            $smarty->assign("privFace", $objItem->getUserPermisos($privFace));
        }
        
        $smarty->assign("subpage", $webm["index"]);
        $smarty->assign("subpage_js", $webm["index_js"]);
        break;

    case 'downloadReporteTecnico':
        $objItem->getReporteTecnico($proy_id, $fecha_inicio, $fecha_final);
        exit;
        break;
    
    case 'downloadReporteGeneral':
        $objItem->getReporteGeneral($fecha_inicio, $fecha_final);
        exit;
        break;

    case 'downloadReporteMetas':
        $metas = $objItem->getEstadisticaMetas($proy_id);
        $smarty->assign("metas", $metas);
        $smarty->display($webm["tabla_resumen_index"]);
        exit;
        break;

    case 'codice':
        echo "Es una mala llamada de un snippet.";
        exit();
        break;
        
}
