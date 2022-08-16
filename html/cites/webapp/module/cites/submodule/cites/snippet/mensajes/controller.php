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
        //print_struc($cataobj);exit();

        $grill_list = $objItem->get_grilla_list_sbm("mensaje");
        $smarty->assign("grill_list", $grill_list);
        $smarty->assign("subpage",$webm["sc_index"]);
        break;
    /**
     * Creación de JSON
     */
    case 'lista':
        $res = $subObjItem->get_item_datatable_Rows($item_id);
        $core->print_json($res);
        break;

    case 'get.form':
        $subObjCatalog->conf_catalog_form();
        
        $cataobj = $subObjCatalog->getCatalogList();
        $smarty->assign("cataobj" , $cataobj);
        $smarty->assign("item_id",$item_id);

        if($type=="update"){
            $item = $subObjItem->get_item($id2,$item_id);
            $smarty->assign("item",$item);
        }

        $smarty->assign("type",$type);
        $smarty->assign("id",$id2);
        $smarty->assign("subpage",$webm["sc_form"]);
        break;

    case 'guardar':
        $respuesta = $subObjItem->item_update($item,$id2,"index",$type,$item_id);
        $core->print_json($respuesta);
        break;

    case 'borrar':
        $res = $subObjItem->item_delete($id2,$item_id);
        $core->print_json($res);
        break;
    case 'noregistro':
        $smarty->assign("subpage", $webm["no_registro"]);
        $smarty->assign("subpage_js", $webm["no_registro_js"]);
        break;
}