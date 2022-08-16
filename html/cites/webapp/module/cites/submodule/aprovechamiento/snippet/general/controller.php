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

            if ($item["estado_id"]!=1 and $item["estado_id"]!=3){
                $privFace["editar"]=$privFace["eliminar"]=$privFace["crear"]=0;
                $privFace["input"]='disabled';
                $smarty->assign("privFace",$privFace);
            }
        }
        //obtenemos los datos de la empresa
        $item_empresa = $subObjItem->get_item_empresa();
        $smarty->assign("item_empresa",$item_empresa);

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

    case 'guardar':
        $respuesta = $subObjItem->item_update($item,$item_id,"general",$type);
        $core->print_json($respuesta);
        break;


}