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
        $smarty->assign("type",$type);
        if($type=="update"){
            $item = $objItem->get_item($id,"tipo");
            $nombre=explode('/',$item["resolucion_path"]);
            $item["resolucion_path"]=$nombre[1].".pdf";
            $smarty->assign("item",$item); 
        }
        else{
            $item["ini_rueda_negocios"]=date("Y")."-01-1";
            $item["fin_rueda_negocios"]=date("Y")."-04-30";
            $item["ini_caza"]=date("Y")."-05-1";
            $item["fin_caza"]=date("Y")."-08-31";
            $item["ini_movilizacion"]=date("Y")."-09-1";
            $item["fin_movilizacion"]=date("Y")."-12-16";
            $smarty->assign("item",$item);    
        }           
 
        $subObjCatalog->conf_catalog_datos_general($gestion);
        $cataobj = $subObjCatalog->getCatalogList();    
        
        $smarty->assign("cataobj",$cataobj);
        $smarty->assign("subpage",$webm["sc_index"]);
        break;



    case 'itemupdatesql':
        $respuesta = $subObjItem->item_update($item,$itemId,"gestion",$type,$input_archivo);
        $core->print_json($respuesta);
        break;
    case 'itemDescarga':
        $subObjItem->get_file($id,$item_id);
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