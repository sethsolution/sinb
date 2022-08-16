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

        $smarty->assign("type",$type);
        if($type=="update"){
            $item = $objItem->get_item($id,"entidad");
            $smarty->assign("item",$item);

        }
        /**
         * Catalogos
         */
        $subObjCatalog->conf_catalog_datos_general();
        $cataobj = $subObjCatalog->getCatalogList();

        $smarty->assign("cataobj" , $cataobj);
        //print_struc($cataobj);

        $smarty->assign("subpage",$webm["sc_index"]);
        break;

    case 'itemupdatesql':
        $respuesta = $subObjItem->item_update($item,$itemId,"entidad",$type);
        $core->print_json($respuesta);
        break;

    case 'get.unidad':
        $item = $subObjCatalog->get_unidad_options($id);
        $core->print_json($item);
        break;

}