<?
$subObjItem = new Permiso();

switch($accion){

    /**
     * P�gina por defecto (index)
     */
    default:
            $templateModule = $templateModuleAjax;
            $smarty->assign("listCatalogo",$subObjItem->listCatalogoPermisoUsuario($id));
            
            $listForm = $subObjItem->getConfigUnset($objItem->getConfig("permiso"),"permiso");
            $smarty->assign("listDataPermiso",$listForm);            
           
            /*************************************************************************/
            $smarty->assign("accion",$type);
            $smarty->assign("subpage",$templateItem);            
            
        break;
    
    case 'getItemList':
            $res = $subObjItem->itemDatatableRows($_POST,$fichaId);
            echo $res;
            exit;
        break;
    
    case 'getItemForm':
       // print_struc($_REQUEST);
            $templateModule=$templateModuleAjax;
            $smarty->assign("listCatalogo",$subObjItem->listCatalogoPermiso());
            $smarty->assign("listSubmodulo",$subObjItem->listSubmodulo());
            $smarty->assign("subpage",$templateFormPermiso);
        break;
    
    case 'getSubmoduloList':
            $res = $subObjItem->submoduloDatatableRows($_POST,$fichaId);
            $core->print_json($res);
            exit;
        break;
    
    case 'submoduloSaveSql':
            $item["id"] = $idficha;
            $item["list"] = $submodulo;
           $res = $subObjItem->itemSave($item,0);
            echo  json_encode($res);
            exit;
        break;
    
    case 'savePermiso':
            $res = $subObjItem->itemSavePermisos(json_decode($list,true),$fichaId);
            echo json_encode($res);
            
            exit;
        break;
    
    case 'itemDelete': 
            $res = $subObjItem->deleteItem($id,$fichaId);
            echo json_encode($res);
            exit; 
        break;
      
}
