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

        $objCatalog->conf_catalog_datos_general();
        $cataobj = $objCatalog->getCatalogList();
        $cataobj["activo"] = $catalogo=$objCatalog->get_activo_option();
       // $cataobj["categoria"] = $catalogo=$objCatalog->get_item_option();
        //print_struc($cataobj);exit;
        $smarty->assign("cataobj", $cataobj);
        /**
         * Sacamos los datos de la grilla
         */
        $grill_list = $objItem->get_grilla_list_sbm("archivo");
       // print_struc($grill_list); exit;
        $smarty->assign("grill_list", $grill_list);
        $smarty->assign("subpage",$webm["sc_index"]);
        break;
    /**
     * Creación de JSON
     */

        /**
         * Catalogos
         */
        $cataobj["tipo"] = $subObjCatalog->get_tipo_option();
        $smarty->assign("cataobj" , $cataobj);
        //print_struc($cataobj);

        $smarty->assign("subpage",$webm["sc_index"]);
        break;


    case 'getItemList':
        //$datatable_debug =true;
        $res = $subObjItem->get_item_datatable_Rows($item_id);
        $core->print_json($res);
        break;


    case 'get.form':
        $subObjCatalog->conf_catalog_form();
        $cataobj = $subObjCatalog->getCatalogList();
        $cataobj["tipo"] = $subObjCatalog->get_tipo_option();
        $cataobj["categoria"] = $subObjCatalog->get_item_padre();
        $smarty->assign("cataobj",$cataobj);
        //print_struc($cataobj);

        $opt_item = $subObjCatalog->get_item_options();
        $cataobj["items"] = $opt_item;

        $smarty->assign("item_id",$item_id);
        $smarty->assign("opt_item",$opt_item);
        //print_struc($opt_item);


        if($type=="update"){
            $item = $subObjItem->get_item($id,$item_id);
            //print_struc($item);exit;
            $smarty->assign("item",$item);
        }

        $smarty->assign("type",$type);
        $smarty->assign("id",$id);
        $smarty->assign("subpage",$webm["sc_form"]);
        break;

    case 'itemupdatesql':
        $respuesta = $subObjItem->item_update($item,$itemId,"archivo",$type,$item_id);
        $core->print_json($respuesta);
        break;

    case 'get.tipo':
        $item = $subObjCatalog->get_tipo_options($id);
        $core->print_json($item);
        break;

    case 'itemDelete':
        $res = $subObjItem->item_delete($id,$item_id);
        $core->print_json($res);
        break;


}
