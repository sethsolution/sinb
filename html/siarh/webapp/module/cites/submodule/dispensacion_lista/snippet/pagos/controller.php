<?php
/**
 * Todo el sub Control se recuperará mediante llamadas por ajax
 */
$templateModule = $templateModuleAjax;
/**
echo "Accion:".$accion."<br>";
echo "ID2:".$id2."<br>";
echo "ID:".$id."<br>";
echo "IitemId:".$itemId."<br>";
echo "Iitem_Id:".$item_id."<br>";
exit;
**/
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
        $res = $subObjItem->get_item_datatable_Rows($item_id);
        $core->print_json($res);
        break;

    case 'get.form':
        $privFace["input2"]='disabled';
        /**
         * Sacamos los datos del cite general (padre)
         */
        $item_padre = $objItem->get_item($item_id);
        $smarty->assign("item_padre", $item_padre);

        if ($item_padre["estado_id"]!=2){
            $privFace["editar"]=$privFace["eliminar"]=$privFace["crear"]=0;
            $privFace["input"]='disabled';
            //$smarty->assign("privFace",$privFace);
        }


        $smarty->assign("item_id",$item_id);
        $type="update";

        $item = $subObjItem->get_item($id,$item_id);
        $smarty->assign("item",$item);

        if($item["estado_id"]!=1 and $item["estado_id"]!=3 ){
            $privFace["editar"]=$privFace["eliminar"]=$privFace["crear"]=0;
            $privFace["input"]='disabled';

        }
        //print_struc($privFace);
        $smarty->assign("privFace",$privFace);
        /**
         * sacamos datos de catalogos
         */
        $subObjCatalog->conf_catalog_form();
        $cataobj = $subObjCatalog->getCatalogList();

        if($item["estado_id"]==2 or $item["estado_id"]==3){
            //unset($cataobj["estado"]["1"]);
        }
        $smarty->assign("cataobj" , $cataobj);

        $smarty->assign("item",$item);

        $smarty->assign("type",$type);
        $smarty->assign("id",$id);
        $smarty->assign("item_id",$item_id);
        $smarty->assign("subpage",$webm["sc_form"]);

        break;

    case 'itemupdatesql':
        $respuesta = $subObjItem->item_update($item,$itemId,"archivo",$type,$item_id);
        $core->print_json($respuesta);
        break;

    case 'descarga':
        $subObjItem->get_file($id,$item_id,$tipo);
        break;


}