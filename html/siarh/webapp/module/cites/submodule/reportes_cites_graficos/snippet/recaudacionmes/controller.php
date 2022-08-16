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

        /**
         * sacamos las listas para los filtros
         */
        $subObjCatalog->conf_catalog_datos_general();
        $cataobj = $subObjCatalog->getCatalogList();

        $smarty->assign("cataobj", $cataobj);
        //print_struc($cataobj);

        /**
         * Sacamos los datos de la grilla
         */
        $grill_list = $objItem->get_grilla_list_sbm("catalogo");
        //print_struc($grill_list); exit;

        /**
         * Especies por defecto
         */
        $especies = array();
        $especies[] = 426; // vicuña
        $especies[] = 84; // lagarto
        $especies[] = 42; // paiche
        $especies[] = 106; // cedro Cedrela fissilis
        $especies[] = 107; // cedro Cedrela lilloi
        $especies[] = 108; // cedro Cedrela odorata
        $especies[] = 108; // cedro Cedrela odorata
        $especies[] = 81; // Mara
        $smarty->assign("especies",$especies);
        /**
         * Año actual por defecto
         */
        $anio = date("Y");
        $smarty->assign("anio",$anio);


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