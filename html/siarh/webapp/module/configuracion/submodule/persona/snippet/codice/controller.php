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
        //print_struc($CFGm->tabla);
        $resumen = $subObjItem->get_codice_resumen($id);
        $smarty->assign("resumen",$resumen);
        //print_struc($resumen["usuario"]);

        //$item = $objItem->get_item();
        $smarty->assign("item",$item);

        $smarty->assign("subpage",$webm["sc_index"]);
        break;

    case 'itemupdatesql':
        $respuesta = $subObjItem->item_update($item,"datos_general");
        $core->print_json($respuesta);
        break;

}