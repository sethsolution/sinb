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

        $subObjCatalog->conf_catalog_datos_general();
        $cataobj = $subObjCatalog->getCatalogList();
        $cataobj["tipo_documento"] = $subObjCatalog->get_tipo_documento_options();
        $smarty->assign("cataobj" , $cataobj);
           //print_struc($cataobj);
        
        $smarty->assign("type",$type);
        if($type=="update"){
            $item = $objItem->get_item($id);
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
        $respuesta = $subObjItem->item_update($item,$item_id,"general",$type);
        $core->print_json($respuesta);
        break;
}