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
        $smarty->assign("type",$type);
        if($type=="update"){
            $item = $objItem->get_item($id,"c_indice");
            $smarty->assign("item",$item);
        }
        $usu=$subObjItem->obtenerUsuario();
        if($usu){
            $where="";
            if($usu["rol_itemId"]==4){
                $where="itemId=".$usu["curtiembre_itemId"];
            }
            $subObjCatalog->conf_catalog_datos_general($where);
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