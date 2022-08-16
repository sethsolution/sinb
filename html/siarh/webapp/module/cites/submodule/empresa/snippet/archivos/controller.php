<?php
/**
 * Todo el sub Control se recuperará mediante llamadas por ajax
 */
$templateModule = $templateModuleAjax;

//print_struc($CFGm->tabla);

switch($accion){
    /**
     * Página por defecto (index)
     */
    default:
        /**
         * Sacamos los datos de la grilla
         */
        //print_struc($cataobj);exit();
        $grill_list = $objItem->get_grilla_list_sbm("archivo");
        $smarty->assign("grill_list", $grill_list);
        $smarty->assign("subpage",$webm["sc_index"]);
        break;
    /**
     * Creación de JSON
     */
    case 'getItemList':
        //$datatable_debug = true;
        $res = $subObjItem->get_item_datatable_Rows($item_id);
        $core->print_json($res);
        break;

    case 'get.form':
        $subObjCatalog->conf_catalog_form();
        
        $cataobj = $subObjCatalog->getCatalogList();
        $smarty->assign("cataobj" , $cataobj);
        $smarty->assign("item_id",$item_id);

        if($type=="update"){
            $item = $subObjItem->get_item($id,$item_id);
            $smarty->assign("item",$item);
        }

        $smarty->assign("type",$type);
        $smarty->assign("id",$id);
        $smarty->assign("subpage",$webm["sc_form"]);
        break;

    case 'itemupdatesql':
        $respuesta = $subObjItem->item_update($item,$itemId,"archivo",$type,$item_id,$input_archivo);
        $core->print_json($respuesta);
        break;

    case 'itemDelete':
        $res = $subObjItem->item_delete($id,$item_id);
        $core->print_json($res);
        break;

    case 'itemDescarga':
        $subObjItem->get_file($id,$item_id);
        break;

}