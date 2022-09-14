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
         * Sacamos los datos de la grilla
         */
        $grill_list = $objItem->get_grilla_list_sbm("catalogo", "right");
        //print_struc($grill_list); exit;
        $smarty->assign("grill_list", $grill_list);
        $smarty->assign("id",$id);
        $smarty->assign("subpage",$webm["sc_index"]);
        //print_struc($grill_list);exit;
        break;
    /**
     * Creación de JSON
     */
    case 'getItemList':
        //$datatable_debug=true;
        $res = $subObjItem->get_item_datatable_Rows();
     //   print_struc($res); exit;
        $core->print_json($res);
        break;

    case 'get.form':

        if($type=="update"){
            $item = $subObjItem->get_item($id);
            //print_struc($item);
            $smarty->assign("item",$item);
        }

        $smarty->assign("type",$type);
        $smarty->assign("id",$id);
        $smarty->assign("subpage",$webm["sc_form"]);
        break;

    case 'itemupdatesql':
        $respuesta = $subObjItem->item_update($item,$itemId,"catalogo",$type,$item_id);
        $core->print_json($respuesta);
        break;

    case 'itemDelete':
        $res = $subObjItem->item_delete($id,$item_id);
        $core->print_json($res);
        break;
}