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
        $subObjCatalog->conf_catalog_form();
        $cataobj = $subObjCatalog->getCatalogList();
        $smarty->assign("cataobj" , $cataobj);

        /**
         * Sacamos los datos de los requisitos
         */
        $requisito = $subObjItem->get_requisito();
        $smarty->assign("requisito", $requisito);

        /**
         * sacamos los datos de la empresa
         */
        $item = $subObjItem->get_item_detalle();
        $smarty->assign("item",$item);
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
        $res = $subObjItem->get_item_datatable_Rows();
        $core->print_json($res);
        break;

    case 'get.form':
        $item = $subObjItem->get_item($id2);
        if ($item["estado_id"]!=1 and $item["estado_id"]!=3){
            $privFace["editar"]=$privFace["eliminar"]=$privFace["crear"]=0;
            $privFace["input"]='disabled';
            $smarty->assign("privFace",$privFace);
        }

        $smarty->assign("item",$item);
        $smarty->assign("type",$type);
        $smarty->assign("id",$id2);
        $smarty->assign("subpage",$webm["sc_form"]);
        break;

    case 'descarga':
        $subObjItem->get_file($id);
        break;

    case 'guardar':
        $respuesta = $subObjItem->item_update($item,$id2,"archivo",$type,$input_archivo);
        $core->print_json($respuesta);
        break;

    case 'guardar.detalle':
        $respuesta = $subObjItem->item_update_detalle($item,"general");
        $core->print_json($respuesta);

        break;

    case 'borrar':
        $res = $subObjItem->item_delete($id);
        $core->print_json($res);
        break;
}