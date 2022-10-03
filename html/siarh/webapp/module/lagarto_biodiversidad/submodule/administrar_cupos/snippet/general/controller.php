<?php
/**
 * Todo el sub Control se recuperará mediante llamadas por ajax
 */
$templateModule = $templateModuleAjax;
$municipioId=$_REQUEST["id"];
$gestion=$_GET["gestion"];
switch($accion){

    /**
     * Página por defecto (index)
     */

    default:
        if(isset($_REQUEST["item"])){
            $aux=$_REQUEST["item"];
            $item=json_decode($aux,true);
            echo "<script>console.log('".json_encode($item)."')</script>";
        }
        $smarty->assign("type",$type);
        if($type=="update"){
            $item = $objItem->get_item($id,"tipo");
            $municipioId=$item["municipio_itemId"];   
            $gestion=$item["gestion_itemId"];
            $smarty->assign("item",$item); 
            $smarty->assign("item",$item);        
        }
        else{
            $item["gestion_itemId"]=$gestion;
            $smarty->assign("item",$item);    
        }           
 
        $subObjCatalog->conf_catalog_datos_general($gestion,$item["departamento"],$item["provincia"]);
        $cataobj = $subObjCatalog->getCatalogList();    
        $cataobj["Tco"]=$subObjItem->obtenerTCO($gestion,$item["municipio"],$type);
        $smarty->assign("cataobj",$cataobj);
        $smarty->assign("subpage",$webm["sc_index"]);
        break;



    case 'itemupdatesql':
        $respuesta = $subObjItem->item_update($item,$itemId,"gestion_tco",$type);
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