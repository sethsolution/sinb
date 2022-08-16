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
        $res = $subObjItem->get_item_datatable_Rows($item_id);
        foreach ($res['data'] as $itemId => $valor) {
            $res['data'][$itemId]['fecha_pago'] = date_format(date_create($valor['fecha_pago']),"d/m/Y");
        }
        $core->print_json($res);
        break;

    case 'get.form':
        /**
         * Sacamos datos de los catalogos a usar
         */
        $smarty->assign("item_id",$item_id);
        if($type=="update"){
            $item = $subObjItem->get_item($id,$item_id);
            $smarty->assign("item",$item);

        }
        /**
         * Catalogo
         */
        $subObjCatalog->conf_catalog_form($item,$item_id);
        $cataobj = $subObjCatalog->getCatalogList();
        $smarty->assign("cataobj" , $cataobj);

        $smarty->assign("type",$type);
        $smarty->assign("id",$id);
        $smarty->assign("subpage",$webm["sc_form"]);
        break;

    case 'guardar':
        $respuesta = $subObjItem->item_update($item,$itemId,"archivo",$type,$item_id);
        $core->print_json($respuesta);
        break;

    case 'borrar':
        $res = $subObjItem->item_delete($id,$item_id);
        $core->print_json($res);
        break;

    case 'descarga':
        $subObjItem->get_file($id2,$item_id);
        break;

}