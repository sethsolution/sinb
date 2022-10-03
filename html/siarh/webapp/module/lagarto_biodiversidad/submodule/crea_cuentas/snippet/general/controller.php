<?php
/**
 * Todo el sub Control se recuperará mediante llamadas por ajax
 */
$templateModule = $templateModuleAjax;
$ids=explode(",",$_REQUEST["id"]);
$municipioId=$ids[0];
$rolId=$ids[1];

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
        $var=$smarty->getTemplateVars("type");
        if($type=="update"){
            $item = $objItem->get_item($id,"tipo");
            $item["password"]="";
            $nombre=explode('/',$item["archivo"]);
            $item["path_doc_ver"]=$nombre[1].".pdf";
            $smarty->assign("item",$item); 
        	$subObjCatalog->conf_catalog_datos_general($item["municipio_itemId"],"","",1);          
        }
        else{
        $smarty->assign("item",$item);
        $subObjCatalog->conf_catalog_datos_general($item["municipio_itemId"],$item["departamento"],$item["provincia"],0);
    }           
 
        $cataobj = $subObjCatalog->getCatalogList();
        // print_struc($cataobj);

        $smarty->assign("cataobj",$cataobj);
        $smarty->assign("subpage",$webm["sc_index"]);
        break;



    case 'itemupdatesql':
        if($type==="new"){
            $respuesta = $subObjItem->item_update($item,$itemId,"vrhr_snir.core_usuario",$type);
            $core->print_json($respuesta);
        }
        else{
            $respuesta = $subObjItem->item_update($item,$itemId,"vrhr_snir.core_usuario",$type);
            $core->print_json($respuesta);

        }
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