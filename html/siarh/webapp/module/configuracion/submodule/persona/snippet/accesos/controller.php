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
        $subObjCatalog->conf_catalog_datos_general();
        $cataobj = $subObjCatalog->getCatalogList();
        $smarty->assign("cataobj",$cataobj);

        $smarty->assign("type",$type);
        if($type=="update"){
            $item = $objItem->get_item($id,"persona");
            $smarty->assign("item",$item);
        }
        $smarty->assign("subpage",$webm["sc_index"]);
        break;

    case 'verasistencia':

        $reporte = $subObjItem->ver_asistencia($itemId,$item);
        //print_struc($reporte);
        $smarty->assign("reporte",$reporte);
        $smarty->assign("subpage",$webm["sc_reporte"]);
        break;

}