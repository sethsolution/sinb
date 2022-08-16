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
        $smarty->assign("cataobj" , $cataobj);

        $smarty->assign("type",$type);

        if($type=="update"){
            $item = $objItem->get_item($id);
            $smarty->assign("item",$item);

        }else{
            $item = array();
        }
        //$privFace["input"]='disabled';

        if($item["estado_id"] != 2){
            $privFace["editar"]=$privFace["eliminar"]=$privFace["crear"]=0;
            $privFace["input2"]='disabled';
            $privFace["input"]='disabled';
        }

        //$smarty->debugging = true;
        $smarty->assign("privFace",$privFace);
        $smarty->assign("subpage",$webm["sc_index"]);
        break;

    case 'ver':
        /**
         * Sacamos los datos CITES
         */
        $item = $objItem->get_item($id);
        $smarty->assign("item",$item);

        $smarty->assign("subpage",$webm["form"]);
        break;

    case 'guardar':
        $respuesta = $subObjItem->item_update($item,$item_id,"general",$type);
        $core->print_json($respuesta);
        break;


}