<?php
/**
 * Todo el sub Control se recuperará mediante llamadas por ajax
 */
$templateModule = $templateModuleAjax;
/**
echo "Accion:".$accion."<br>";
echo "ID2:".$id2."<br>";
echo "ID:".$id."<br>";
exit;
/**/
switch($accion){
    /**
     * Página por defecto (index)
     */
    default:
        /**
         * Sacamos los datos del cite general (padre)
         */
        $item_padre = $objItem->get_item($item_id);
        $smarty->assign("item_padre", $item_padre);
        /**
         * Sacamos los datos de la grilla
         */
        $grill_list = $objItem->get_grilla_list_sbm("archivo");
        $smarty->assign("grill_list", $grill_list);
        $smarty->assign("subpage",$webm["sc_index"]);
        break;
    /**
     * Creación de JSON
     */
    case 'lista':
        //$datatable_debug = true;
        $res = $subObjItem->get_item_datatable_Rows($item_id);
        foreach ($res['data'] as $itemId => $valor) {
            $res['data'][$itemId]['fecha_pago'] = date_format(date_create($valor['fecha_pago']),"d/m/Y");
        }
        $core->print_json($res);
        break;

}