<?php
/**
 * Todo el sub Control se recuperará mediante llamadas por ajax
 */

use function GuzzleHttp\Psr7\str;

$templateModule = $templateModuleAjax;

switch($accion){
    /**
     * Página por defecto (index)
     */
    default:

        /**
         * sacamos las listas para los filtros
         */
        $subObjCatalog->conf_catalog_datos_general();
        $cataobj = $subObjCatalog->getCatalogList();

        //print_struc($cataobj); exit;
        $smarty->assign("cataobj", $cataobj);
        //print_struc($cataobj);

        /**
         * Sacamos los datos de la grilla
         */
        $grill_list = $objItem->get_grilla_list_sbm("catalogo");
        //print_struc($grill_list); exit;
        $smarty->assign("grill_list", $grill_list);
        $smarty->assign("id",$id);
        $smarty->assign("subpage",$webm["sc_index"]);
        break;
    /**
     * Creación de JSON
     */
    case 'getItemList':
     //   $datatable_debug=true;
        $res = $subObjItem->get_item_datatable_Rows();
     //   print_struc($res); exit;
        $core->print_json($res);
        break;

    case 'consultar':
        $lista = $subObjItem->consulta($item);
        //print_struc($lista);
        $smarty->assign("lista", $lista);
        $smarty->assign("subpage",$webm["sc_resultado"]);
        break;
}