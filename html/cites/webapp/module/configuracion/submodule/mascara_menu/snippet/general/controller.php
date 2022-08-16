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
            $item = $objItem->get_item($id,"menu");
           // print_struc($item);
            $smarty->assign("item",$item);
        }
        /**
         * Catalogos
         */

        $subObjCatalog->conf_catalog_datos_general();
        $cataobj = $subObjCatalog->getCatalogList();
        //print_struc($cataobj);

        $tipo_opt = $subObjCatalog->get_tipo_options();
        $cataobj["tipo"] =$tipo_opt;


        $opt_item = $subObjCatalog->get_item_options();
        $cataobj["items"] = $opt_item;

        $smarty->assign("cataobj" , $cataobj);
        //print_struc($cataobj);

        //$smarty->assign("tipo_opt222",$tipo_opt);

        //print_struc($tipo_opt);


        $smarty->assign("subpage",$webm["sc_index"]);
        break;

    case 'itemupdatesql':
        $respuesta = $subObjItem->item_update($item,$itemId,"menu",$type,$item_id);
        $core->print_json($respuesta);
        break;

    case 'get.tipo':
        $item = $subObjCatalog->get_tipo_option($id);
        $core->print_json($item);
        break;

    case 'get.unidad':
        $item = $subObjCatalog->get_unidad_options($id);
        $core->print_json($item);
        break;

}