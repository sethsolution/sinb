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
        $subObjCatalog->conf_catalog_form();
        $cataobj = $subObjCatalog->getCatalogList();
        $smarty->assign("cataobj" , $cataobj);
        /**
         * sacamos los datos de la cites
         */
        $item = $subObjItem->get_item_detalle($item_id);
        $smarty->assign("item",$item);

        if ($item["estado_id"]!=1 and $item["estado_id"]!=3){
            $privFace["editar"]=$privFace["eliminar"]=$privFace["crear"]=0;
            $privFace["input"]='disabled';
            $smarty->assign("privFace",$privFace);
        }

        /**
         * Sacamos los datos de los requisitos
         */
        $requisito = $subObjItem->get_requisito($item_id,$item["tipo_id"]);
        $smarty->assign("requisito", $requisito);

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
    case 'lista':
        $res = $subObjItem->get_item_datatable_Rows($item_id);
        $core->print_json($res);
        break;

    case 'get.form':

        $item_padre = $subObjItem->get_item_detalle($item_id);
        $smarty->assign("item_padre",$item_padre);
        if ($item_padre["estado_id"]!=1 and $item_padre["estado_id"]!=3){
            $privFace["editar"]=$privFace["eliminar"]=$privFace["crear"]=0;
            $privFace["input"]='disabled';
            $smarty->assign("privFace",$privFace);
        }

        $item = $subObjItem->get_item($id2,$item_id);
        if ($item["estado_id"]!=1 and $item["estado_id"]!=3){
            $privFace["editar"]=$privFace["eliminar"]=$privFace["crear"]=0;
            $privFace["input"]='disabled';
            $smarty->assign("privFace",$privFace);
        }



        $smarty->assign("item",$item);
        $smarty->assign("type",$type);
        $smarty->assign("id",$id2);
        $smarty->assign("item_id",$item_id);
        $smarty->assign("subpage",$webm["sc_form"]);
        break;

    case 'descarga':
        $subObjItem->get_file($id2,$item_id);
        break;
    case 'guardar':
        $respuesta = $subObjItem->item_update($item,$id2,"archivo",$type,$item_id,$input_archivo);
        $core->print_json($respuesta);
        break;
    case 'guardar.detalle':
        $respuesta = $subObjItem->item_update_detalle($item,$item_id,"general");
        $core->print_json($respuesta);
        break;
}