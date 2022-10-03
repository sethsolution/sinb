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
        $smarty->assign("usuarioInfo", $objItem->obtener_permiso_usuarios());
        if(isset($_REQUEST["item"])){
            $aux=$_REQUEST["item"];
            $item=json_decode($aux,true);
        $smarty->assign("item",$item);
            echo "<script>console.log('".json_encode($item)."')</script>";
        }
        $smarty->assign("type",$type);
        $usu=$subObjItem->obtenerUsuario();
        if($usu){
            if($usu["rol_itemId"]==3){
            $subObjCatalog->conf_catalog_datos_general($item["departamento"],$item["provincia"],"itemId=".$usu["tco_itemId"],1);
            }else{
            $subObjCatalog->conf_catalog_datos_general($item["departamento"],$item["provincia"],$item["municipio"],0);}
            $cataobj = $subObjCatalog->getCatalogList();
            // print_struc($cataobj);
    
            $smarty->assign("cataobj",$cataobj);
        }
        $smarty->assign("subpage",$webm["sc_index"]);
        break;



    case 'itemupdatesql':
        $respuesta = $subObjItem->item_update($item,$itemId,"c_indice",$type);
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