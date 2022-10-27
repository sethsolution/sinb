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
         * Sacamos los datos de la grilla
         */
        $grill_list = $objItem->get_grilla_list_sbm("archivo", "right");
        $smarty->assign("grill_list", $grill_list);
        $smarty->assign("subpage",$webm["sc_index"]);
        break;
    /**
     * Creación de JSON
     */
    case 'lista':
        //$datatable_debug = true;
        $res = $subObjItem->get_item_datatable_Rows($item_id);
        foreach ($res['data'] as $itemId => $valor) {
            $res['data'][$itemId]['fecha_pago'] = date_format(date_create($valor['fecha_pago']),"d/m/Y");
        }
        $core->print_json($res);
        break;

    case 'get.form':
        /**
         * Sacamos los datos del cite general (padre)
         */
        $item_padre = $objItem->get_item($item_id);
        $smarty->assign("item_padre", $item_padre);
        /*
        if ($item_padre["estado_id"]!=1 and $item_padre["estado_id"]!=3){
            $privFace["editar"]=$privFace["eliminar"]=$privFace["crear"]=0;
            $privFace["input"]='disabled';
            $smarty->assign("privFace",$privFace);
        }

        */

        /**
         * Sacamos datos de los catalogos a usar
         */
        /*
        $subObjCatalog->conf_catalog_form();
        $cataobj = $subObjCatalog->getCatalogList();
        $smarty->assign("cataobj" , $cataobj);
        */
        $smarty->assign("item_id",$item_id);

        if($type=="update"){
            $item = $subObjItem->get_item($id2,$item_id);
            $smarty->assign("item",$item);
            //print_struc($item);

            if ($item["modifica"]==0){
                $privFace["editar"]=$privFace["eliminar"]=$privFace["crear"]=0;
                $privFace["input"]='disabled';
                $smarty->assign("privFace",$privFace);
            }
        }

        $smarty->assign("type",$type);
        $smarty->assign("id",$id2);
        $smarty->assign("subpage",$webm["sc_form"]);
        break;

    case 'guardar':
        $respuesta = $subObjItem->item_update($item,$id2,"archivo",$type,$item_id,$input_archivo);
        $core->print_json($respuesta);
        break;

    case 'borrar':
        $res = $subObjItem->item_delete($id2,$item_id);
        $core->print_json($res);
        break;

    case 'descarga':
        $subObjItem->get_file($id2,$item_id);
        break;

    case 'noregistro':
        $smarty->assign("subpage", $webm["no_registro"]);
        $smarty->assign("subpage_js", $webm["no_registro_js"]);
        break;

}