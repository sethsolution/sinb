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
        $item_padre = $objItem->get_item($item_id);
        $smarty->assign("item_padre", $item_padre);
        /**
         * sacamos los datos del parovechamiento
         */
        $item = $objItem->get_item($item_id);
        $smarty->assign("item",$item);
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
        //print_struc($item_padre);

        if ($item_padre["estado_id"]!=1 and $item_padre["estado_id"]!=3){
            $privFace["editar"]=$privFace["eliminar"]=$privFace["crear"]=0;
            $privFace["input"]='disabled';
            $smarty->assign("privFace",$privFace);
        }

        $smarty->assign("item_id",$item_id);

        if($type=="update"){
            $item = $subObjItem->get_item($id2,$item_id);
            $smarty->assign("item",$item);
        }
        /**
         * Sacamos datos de los catalogos a usar
         */

        $subObjCatalog->conf_catalog_form($item_padre);
        $cataobj = $subObjCatalog->getCatalogList();
        $smarty->assign("cataobj" , $cataobj);
        //print_struc($cataobj);

        $smarty->assign("type",$type);
        $smarty->assign("id",$id2);
        $smarty->assign("subpage",$webm["sc_form"]);
        break;

    case 'guardar':
        $respuesta = $subObjItem->item_update($item,$id2,"precinto",$type,$item_id);
        $core->print_json($respuesta);
        break;

    case 'borrar':
        $res = $subObjItem->item_delete($id2,$item_id);
        $core->print_json($res);
        break;

    case 'guardar.detalle':
        $respuesta = $subObjItem->item_update_detalle($item,$item_id,"general",$item_id);
        $core->print_json($respuesta);
        break;

}