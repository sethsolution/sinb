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
        //print_struc($item); exit;

        /**
         * Sacamos los datos de ESPECIES
         */
        $especie = $objItem->get_especie_list($id);
        $smarty->assign("especie", $especie);
        /**
         * Sacamos los datos de los requisitos
         */
        $requisito = $objItem->get_requisitos($id);
        $smarty->assign("requisito", $requisito);

        $smarty->assign("subpage",$webm["form"]);
        break;

    case 'guardar':
        $respuesta = $subObjItem->item_update($item,$itemId,"general", $type);
        $core->print_json($respuesta);
        break;
}