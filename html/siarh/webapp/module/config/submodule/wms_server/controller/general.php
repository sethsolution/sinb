<?
$subObjItem = new General();

switch($accion){

    /**
     * P�gina por defecto (index)
     */
    default:
            $templateModule = $templateModuleAjax;
            
            if($type=="update"){
              $item = $subObjItem->getItem($id,0);
              $smarty->assign("item",$item);
            }else{
                
            }
            /** Carga de Catalogos */            
            $listForm = $objItem->getConfig("server");
            $smarty->assign("listDataServer",$listForm);            
            /*************************************************************************/
            $smarty->assign("accion",$type);
            $smarty->assign("subpage",$templateItem_InfoGral);            
            
        break;
    
    case 'getLayer':
            $templateModule=$templateModuleAjax;
            $objCatalog->configCatalogListIndex();
            $cataobj = $objCatalog->getCatalogList();
            $smarty->assign("listCatalogo",$cataobj);
            $smarty->assign("arrayCondicion",$objCatalog->getArrayCondicion());
            if($type=="update"){
              $item = $subObjItem->getItem($id,1);
              $smarty->assign("item",$item);
            }
            $smarty->assign("idFicha",$idFicha);
            $smarty->assign("accion",$type);
            $smarty->assign("subpage",$templateFormLayer);
            
        break;
    
    case 'getListLayer':
            $res = $subObjItem->getDataTableLayer($_GET, $id);
            echo $res;    
            exit;
        break;
    
    case 'itemnewsql':
            $res = $subObjItem->itemSave($item,0);
            echo  json_encode($res);
            exit;
        break;        
        
    
    case 'itemupdatesql':
            $res = $subObjItem->itemUpdate($item,$itemId,0);
            echo  json_encode($res);
            exit;
        break;    

    case 'layernewsql':
            $res = $subObjItem->itemSave($item,1);
            echo  json_encode($res);
            exit;
        break;        
        
    
    case 'layerupdatesql':
            $res = $subObjItem->itemUpdate($item,$itemId,1);
            echo  json_encode($res);
            exit;
        break;    

    case 'update':
            $res = $subObjItem->update($grupoId,$id);
            echo json_encode($res);
            exit;
      break;

    case 'itemStatus':  $item["activo"]=$status;
                        $res = $subObjItem->itemUpdateStatus($item,$itemId);
                        echo json_encode($res);
                        exit;
        break;
   case 'deleteLayer': $res = $subObjItem->deleteLayerItem($itemId,$id);
                // print_r($res);exit;
                       echo json_encode($res);
                       exit;
        break;
   case "setOrder": $res = $subObjItem->setOrderPhoto($itemId,$tipo,$id);
                    echo json_encode($res);
                    exit;              
        break;   
}
