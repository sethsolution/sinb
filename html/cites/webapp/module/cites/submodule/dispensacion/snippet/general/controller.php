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

            if ($item["estado_id"]!=1 and $item["estado_id"]!=3){
                $privFace["editar"]=$privFace["eliminar"]=$privFace["crear"]=0;
                $privFace["input"]='disabled';
                $smarty->assign("privFace",$privFace);
            }
        }

        /*if($item['observado'] == 0){
            if($item["estado_id"]== 4 or $item["estado_id"]== 2 or $item["estado_id"]== 3  ){
                $privFace["input"]='disabled';
            }
        }/*/
        $smarty->assign("privFace",$privFace);
        $smarty->assign("subpage",$webm["sc_index"]);
        break;

    case 'ver':
        $subObjCatalog->conf_catalog_datos_general();
        $cataobj = $subObjCatalog->getCatalogList();
        $smarty->assign("cataobj" , $cataobj);
        $item = $objItem->get_item($id);
        $smarty->assign("item",$item);
        /**
         * Sacamos los datos de ESPECIES
         */
        $especie = $objItem->get_especie_list($id);
        $smarty->assign("especie", $especie);
        //print_struc($especie);exit;
        /**
         * Sacamos los datos de los requisitos
         */
        $requisito = $subObjItem->get_requisitos($id);
        $smarty->assign("requisito", $requisito);

        $smarty->assign("subpage",$webm["form"]);

        break;
    case 'guardar':
        $respuesta = $subObjItem->item_update($item,$item_id,"general",$type);
        $core->print_json($respuesta);
        break;

    case 'noregistro':
        $smarty->assign("subpage", $webm["no_registro"]);
        $smarty->assign("subpage_js", $webm["no_registro_js"]);
        break;

}