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
            $templateModule=$templateModuleAjax;
            $smarty->assign("listModulos",$subObjItem->listModulos());
            $smarty->assign("fichaId",$fichaId);
            //print_struc($subObjItem->listModulos());
            $smarty->assign("subpage",$templateFormPermiso);
        break;

    case 'getModulosList':
            $templateModule=$templateModuleAjax;
            $smarty->assign("dataFichas",$subObjItem->dataFichas);
            $smarty->assign("nameTable",$nameTable);
            $smarty->assign("moduloId",$moduloId); 
            $smarty->assign("subpage",$templateFormAsignacion);
        break;

    case 'getFichasList':
            $fichasSeteadas = $subObjItem->getFichasSet($fichaId,$moduloId,$nameTable);
            $res = $subObjItem->getDataTableFichas($_GET,$nameTable,$fichasSeteadas,$moduloId);
            echo $res;    
            exit;
        break;

    case 'setPersona':
         $res = $subObjItem->saveFichasItem($fichaId,$idFichaSet,$idModulo,$nameTable);
         echo json_encode($res);
         exit;
    /**
    *
    *
    */
    case 'getSubmoduloList':
            $res = $subObjItem->submoduloDatatableRows($_POST,$fichaId);
            echo $res;
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
