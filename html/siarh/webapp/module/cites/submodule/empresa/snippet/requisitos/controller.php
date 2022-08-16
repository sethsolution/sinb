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
         * Catalogos
         */
        $subObjCatalog->conf_catalog_form_adicional();
        $cataobj = $subObjCatalog->getCatalogList();
        $smarty->assign("cataobj" , $cataobj);
        /**
         * sacamos los datos de la empresa
         */
        //echo $id."---";exit;
        $item = $subObjItem->get_item_detalle($id);
        $smarty->assign("item",$item);

        /**
         * Sacamos los datos de los requisitos
         */
        $requisito = $subObjItem->get_requisito($item);
        $smarty->assign("requisito", $requisito);
        //print_struc($requisito);exit;

        $smarty->assign("type",$type);


        $privFace["input"]='disabled';

        if($item["estado_id"] != 2){
            $privFace["editar"]=$privFace["eliminar"]=$privFace["crear"]=0;
            $privFace["input2"]='disabled';
        }

        $smarty->assign("privFace",$privFace);

        /**
         * Sacamos los datos de la grilla
         */
        //print_struc($cataobj);exit();
        $grill_list = $objItem->get_grilla_list_sbm("archivo");
        $smarty->assign("grill_list", $grill_list);

        $smarty->assign("subpage",$webm["sc_index"]);
        break;

    case 'descarga':
        $subObjItem->get_file($id,$item_id,$tipo);
        break;

    case 'get.form':
        /**
         * Sacamos los datos del cite general (padre)
         */
        $item_padre = $objItem->get_item($item_id);
        $smarty->assign("item_padre", $item_padre);
       // print_struc($item_padre);

        if ($item_padre["estado_id"]!=2){
            $privFace["editar"]=$privFace["eliminar"]=$privFace["crear"]=0;
            $privFace["input"]='disabled';
            $smarty->assign("privFace",$privFace);
        }


        $item = $subObjItem->get_item($id,$item_id);
        $smarty->assign("item",$item);

        if($item["estado_id"]!=1 and $item["estado_id"]!=3 ){
            $privFace["editar"]=$privFace["eliminar"]=$privFace["crear"]=0;
            $privFace["input"]='disabled';
            $smarty->assign("privFace",$privFace);
        }

        /**
         * sacamos datos de catalogos
         */
        $subObjCatalog->conf_catalog_form();
        $cataobj = $subObjCatalog->getCatalogList();

        if($item["estado_id"]==2 ){
            //unset($cataobj["estado"]["1"]);
        }
        $smarty->assign("cataobj" , $cataobj);



        $smarty->assign("type",$type);
        $smarty->assign("item_id",$item_id);
        $smarty->assign("id",$id);
        $smarty->assign("subpage",$webm["sc_form"]);
        break;

    case 'itemupdatesql':
        //print_struc($item);exit();
        $respuesta = $subObjItem->item_update($item,$itemId,"archivo",$item_id);
        $core->print_json($respuesta);
        break;

    case 'guardar.detalle':
        $respuesta = $subObjItem->item_update_detalle($item,$itemId,"general");
        $core->print_json($respuesta);
        break;
}