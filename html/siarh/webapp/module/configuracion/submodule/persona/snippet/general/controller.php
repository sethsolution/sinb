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
        //print_struc($cataobj);
        $smarty->assign("type",$type);
        if($type=="update"){
            $item = $objItem->get_item($id,"persona");
            $smarty->assign("item",$item);
        }
        $smarty->assign("subpage",$webm["sc_index"]);
        break;

    case 'itemupdatesql':
        $respuesta = $subObjItem->item_update($item,$itemId,"datos_general",$type);
        $core->print_json($respuesta);
        break;
}