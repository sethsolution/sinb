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
        $respuesta = $subObjItem->item_update($item,$item_id,"general",$type,$item_id);
        $core->print_json($respuesta);
        break;


}