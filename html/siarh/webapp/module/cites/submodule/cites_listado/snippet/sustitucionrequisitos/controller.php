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
         * Recogemos el id del dato de sustitución
         */
        /*
        $sus_detalle = $subObjItem->get_item_id($id);
        $item_id = $sus_detalle["itemId"];
        print_struc($sus_detalle);
        */

        $subObjCatalog->conf_catalog_form();
        $cataobj = $subObjCatalog->getCatalogList();
        $smarty->assign("cataobj" , $cataobj);
        /**/
        $item_padre = $subObjItem->get_item_detalle($id);
        $smarty->assign("item_padre",$item_padre);

        /**
         * sacamos los datos de la cites
         */
        $item = $subObjItem->get_item_id($id);
        //print_struc($item_padre);
        $smarty->assign("item",$item);


        $privFace["input"]='disabled';
        if($item["estado_id"] != 2){
            $privFace["editar"]=$privFace["eliminar"]=$privFace["crear"]=0;
            $privFace["input2"]='disabled';
        }
        $smarty->assign("privFace",$privFace);

        /**
         * Sacamos los datos de los requisitos
         */
        $requisito = $subObjItem->get_requisito($item["itemId"],$item["tipo_id"]);
        $smarty->assign("requisito", $requisito);
        /**
         * Sacamos los datos de la grilla
         */
        //print_struc($requisito);exit();
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
        /**
         * Recogemos el id del dato de sustitución
         */
        $sus_detalle = $subObjItem->get_item_id($item_id);
        //$item_id = $sus_detalle["itemId"];
        $item_padre = $subObjItem->get_item_detalle($item_id);
        $smarty->assign("item_padre",$item_padre);
        if ($item_padre["estado_id"]!=2){
            $privFace["editar"]=$privFace["eliminar"]=$privFace["crear"]=0;
            $privFace["input"]='disabled';
            $smarty->assign("privFace",$privFace);
        }
        $item = $subObjItem->get_item($id,$item_id);


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
        $smarty->assign("cataobj" , $cataobj);

        $smarty->assign("item",$item);
        $smarty->assign("type",$type);
        $smarty->assign("id",$id);
        $smarty->assign("item_id",$item_id);
        $smarty->assign("subpage",$webm["sc_form"]);
        break;

    case 'descarga':
        /**
         * Recogemos el id del dato de sustitución
         */
        $subObjItem->get_file($id,$item_id,$tipo);
        break;
    case 'guardar':
        $respuesta = $subObjItem->item_update($item,$itemId,"archivo",$item_id);
        $core->print_json($respuesta);
        break;
    case 'guardar.detalle':
        /**
         * Recogemos el id del dato de sustitución
         */
        $respuesta = $subObjItem->item_update_detalle($item,$item_id,"general");
        $core->print_json($respuesta);
        break;
}