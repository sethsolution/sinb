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
        //$core->writeLog($privFace,__FILE__,__LINE__);
        $smarty->assign("type", $type);
        if($type=="update"){
            $item = $objItem->get_item($id, "catalogos");
            $smarty->assign("item", $item);
        }
        $smarty->assign("subpage", $webm["sc_index"]);
        break;

    case 'itemupdatesql':
        $respuesta = $subObjItem->item_update($item, $itemId, "campos_catalogos", $type);
        $core->print_json($respuesta);
        break;
}