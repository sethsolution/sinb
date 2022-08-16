<?php
/**
 * Todo el sub Control se recuperará mediante llamadas por ajax
 */
$templateModule = $templateModuleAjax;
/**
echo "Accion:".$accion."<br>";
echo "ID2:".$id2."<br>";
echo "ID:".$id."<br>";
exit;
/**/
switch($accion){
    /**
     * Página por defecto (index)
     */
    default:
        /**
         * Sacamos los datos del cite general (padre)
         */
        if($type=="update"){
            $item = $objItem->get_item($id);
            $smarty->assign("item",$item);
        }else{
            $item = array();
        }

        $smarty->assign("type",$type);
        /**
         * Sacamos los datos de la grilla
         */
        $grill_list = $objItem->get_grilla_list_sbm("archivo");
        $smarty->assign("grill_list", $grill_list);

        $smarty->assign("subpage",$webm["sc_index"]);
        break;
    /**
     * Creación de JSON
     */
    case 'lista':
        //print_struc($item_id);exit;
        //$datatable_debug =true;
        $res = $subObjItem->get_item_datatable_Rows($item_id);
        $core->print_json($res);
        break;

    case 'get.form':
        /**
         * Sacamos los datos del cite general (padre)
         */
        $item_padre = $objItem->get_item($item_id);
        $smarty->assign("item_padre", $item_padre);
        /**
         * Sacamos datos de los catalogos a usar
         */

        $subObjCatalog->conf_catalog_form($id);
        $cataobj = $subObjCatalog->getCatalogList();
        $smarty->assign("cataobj" , $cataobj);
        //print_struc($cataobj);

        $smarty->assign("item_id",$item_id);

        if($type=="update"){
            $item = $subObjItem->get_item($id,$item_id);
            $smarty->assign("item",$item);
        }
        $smarty->assign("type",$type);
        $smarty->assign("id",$id);
        $smarty->assign("subpage",$webm["sc_form"]);
        break;

    case 'guardar':
        $respuesta = $subObjItem->item_update($item,$itemId,"numero",$type,$item_id);
        $core->print_json($respuesta);
        break;

    case 'borrar':
        $res = $subObjItem->item_delete($id,$item_id);
        $core->print_json($res);
        break;

    case 'guardar.detalle':
        //print_struc($type);exit();
        $respuesta = $subObjItem->item_update_detalle($item,$itemId,"general",$type,$item_id);
        $core->print_json($respuesta);
        break;

}