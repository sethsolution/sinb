<? 
switch($accion){
    /**
     * P�gina por defecto
     */
    default:
            /**
             *  llamada a catalogo
             */
             $objCatalog->configCatalogListIndex(0);
             $cataobj = $objCatalog->getCatalogList();

             $smarty->assign("cataobj",$cataobj);
                     
             $smarty->assign("subpage",$templateIndex);
             
        break;
    /**
     * Para Tab
     */
    case 'viewData':
            $templateModule=$templateModuleAjax;

            $listConfig = $objItem->getConfig("server");
            $smarty->assign("listConfig",$listConfig);
        
            $smarty->assign("subpage",$templateTab01);
        break;
    
    case 'getItemList':
            $res = $objItem->itemDatatableRows($_POST);
            echo $res;
            exit;
        break;
    
    case 'itemUpdate':
                if(isset($optab))  $smarty->assign("optabMain",$optab);
                else  $smarty->assign("optabMain",1);
               
                $smarty->assign("subpage",$templateItem);
                $smarty->assign("accion",$type);
               
                if($type==='update'){
                  $item = $objItem->getItem($id);
                  $smarty->assign("id",$item["itemId"]);
                  $smarty->assign("item",$item);
                }
             
        break;
     
    case 'itemDelete': 
            $res = $objItem->deleteItem($id);
            echo json_encode($res);
            exit; 
        break;
      
      
}
