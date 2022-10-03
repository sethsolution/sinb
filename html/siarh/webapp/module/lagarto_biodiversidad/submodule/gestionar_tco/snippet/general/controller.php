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
        if(isset($_REQUEST["item"])){
            $aux=$_REQUEST["item"];
            $item=json_decode($aux,true);
        }
        $smarty->assign("type",$type);
        if($type=="update"){
            $item = $objItem->get_item($id,"tipo");
            $smarty->assign("item",$item);           
        }
        else{
            $smarty->assign("item",$item);
        }
 
        $subObjCatalog->conf_catalog_datos_general($item["departamento"],$item["provincia"]);
        $cataobj = $subObjCatalog->getCatalogList();
        // print_struc($cataobj);

        $smarty->assign("cataobj",$cataobj);
        $smarty->assign("subpage",$webm["sc_index"]);
        break;



    case 'itemupdatesql':
        $respuesta = $subObjItem->item_update($item,$itemId,"catalogo_tco",$type);
        $core->print_json($respuesta);
        break;

    case 'get.tipo':
        $item = $subObjCatalog->get_tipo_options($id);
        $core->print_json($item);
        break;
    case 'get.unidad':
        $item = $subObjCatalog->get_unidad_options($id);
        $core->print_json($item);
        break;

}