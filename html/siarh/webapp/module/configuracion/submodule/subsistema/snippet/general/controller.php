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
            //$dbm->debug = true;
            $item = $objItem->get_item($id,"modulo");
            //print_struc($item);
            //exit;
            $smarty->assign("item",$item);

        }
        /**
         * Catalogos
         */
        $cataobj["core_modulo"] = $subObjCatalog->get_tipo_option();//cambio de core_modulo a modulo
        $smarty->assign("cataobj" , $cataobj);
        //print_struc($cataobj);

        $smarty->assign("subpage",$webm["sc_index"]);
        break;

    case 'itemupdatesql':
        $respuesta = $subObjItem->item_update($item,$itemId,"modulo",$type);
        $core->print_json($respuesta);
        break;

    case 'get.tipo':
        $item = $subObjCatalog->get_tipo_options($id);
        $core->print_json($item);
        break;
    case 'get.unidad':
        $item = $subObjCatalog->get_unidad_options($id);
        $core->print_json($item);
        break;

}