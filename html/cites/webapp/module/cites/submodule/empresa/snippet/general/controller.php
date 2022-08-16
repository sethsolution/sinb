<?php
/**
 * Todo el sub Control se recuperará mediante llamadas por ajax
 */
$templateModule = $templateModuleAjax;
/**
 * Siempre actualizará
 */
$type="update";

switch($accion){

    /**
     * Página por defecto (index)
     */
    default:
        /**
         * Catalogos
         */
        $subObjCatalog->conf_catalog_datos_general();
        $cataobj = $subObjCatalog->getCatalogList();
        $smarty->assign("cataobj" , $cataobj);


        $smarty->assign("type",$type);

        if($type=="update"){
            $item = $subObjItem->get_item();
            $smarty->assign("item",$item);
            //print_struc($item);exit();
        }
        if($item['observado'] == 0){
            if($item["estado_id"]== 4 or $item["estado_id"]== 2 or $item["estado_id"]== 3  ){
                $privFace["input"]='disabled';
            }
        }
        $smarty->assign("privFace",$privFace);
        $smarty->assign("subpage",$webm["sc_index"]);

        break;

    case 'guardar':
        $respuesta = $subObjItem->item_update($item,"general",$type,$item_id);
        $core->print_json($respuesta);

        break;



}