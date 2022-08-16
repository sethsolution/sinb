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
         * Catalogos
         */
        //$dbm->debug = true;
        $subObjCatalog->conf_catalog_datos_general();
        $cataobj = $subObjCatalog->getCatalogList();
        //print_struc($cataobj);
        $smarty->assign("cataobj" , $cataobj);

        $smarty->assign("type",$type);
        if($type=="update"){
            $item = $objItem->get_item($id);
            $smarty->assign("item",$item);
            //print_struc($item);exit();
        }
        /**
         * construimos la grilla de numeracion
         */
        $grill_list = $objItem->get_grilla_list_sbm("mensaje");
        $smarty->assign("grill_list", $grill_list);

        $smarty->assign("subpage",$webm["sc_index"]);
        break;

    case 'get.form':

        $smarty->assign("item_id",$item_id);

        if($type=="update"){
            $item = $subObjItem->get_item($id,$item_id);
            $smarty->assign("item",$item);
        }

        $smarty->assign("type",$type);
        $smarty->assign("id",$id);
        $smarty->assign("subpage",$webm["sc_form"]);
        break;

    /**
     * Creación de JSON
     */
    case 'getItemList':
        $res = $subObjItem->get_item_datatable_Rows($item_id);
        $core->print_json($res);
        break;

    case 'itemupdatesql':
        //print_struc($item);exit();
        $respuesta = $subObjItem->item_update($item,$itemId,"general",$type);
        $core->print_json($respuesta);
        break;

    case 'get.unidad':
        $item = $subObjCatalog->get_unidad_options($id);
        $core->print_json($item);
        break;

}