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
             $cataobj["tipo"] = $objCatalog->getArrayTipoUsuario(0);
             $cataobj["activo"] = $objCatalog->getArrayCondicion();

             $smarty->assign("cataobj",$cataobj);
                     
             $smarty->assign("subpage",$templateIndex);
             
        break;
    /**
     * Para Tab
     */
    case 'viewData':
            $templateModule=$templateModuleAjax;

            $listConfig = $objItem->getConfig("usuario");
            $smarty->assign("listConfig",$listConfig);
        
            $smarty->assign("subpage",$templateTab01);
        break;
    
    case 'getItemList':
            //$idins = ($_SESSION["userv"]["tipoUsuario"] == 0 || $_SESSION["userv"]["tipoUsuario"] == 1)?null:$_SESSION["userv"]["instituciones"];
            $res = $objItem->itemDatatableRows($_POST);
            echo $res;
            exit;
        break;
    
    case 'updatePrincipal':
            $item["activo"] = $tipo;
            $res = $objItem->updatePrincipal($item,$id);
            echo json_encode($res);
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
        
    case 'printManual':
        $file = "./../dataFile/manuales/Manual_Usuarios.pdf";
        $type = "application/pdf";
        //echo $file;exit;
        header ("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
        header ("Last-Modified: " . gmdate("D,d M YH:i:s") . " GMT");
        header ("Cache-Control: no-cache, must-revalidate");
        header ("Pragma: no-cache");
        header ("Content-Type: $type");
        readfile($file);
        exit;
    break;
      
      
      
}
