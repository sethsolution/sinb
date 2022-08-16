<? 
switch($accion){

    /**
     * P�gina por defecto (index)
     */
    default:
            $id = $_SESSION["userv"]["memberId"];
            $item = $objItem->getItem($id,0);
            $smarty->assign("item",$item);
            /** Carga de Catalogos */
            $smarty->assign("listCatalogo",$objItem->listCatalogo('index',$item["itemId"],$fichaId));
            
            $listForm = $objItem->getConfigUnset($objItem->getConfig("usuario"),"personal");
            $smarty->assign("listDataPersonal",$listForm);            
            $listForm = $objItem->getConfigUnset($objItem->getConfig("usuario"),"usuario");
            $smarty->assign("listDataUsuario",$listForm);
  
            /*************************************************************************/
            $smarty->assign("accion","update");
            $smarty->assign("id",$id);
            $smarty->assign("subpage",$templateIndex);            
            
        break;
    
    case 'getInstitucion':
            $templateModule=$templateModuleAjax;
            $smarty->assign("subpage",$templateListInstitucion);
            
        break;
    
    case 'getListInstitucion':
            $res = $objItem->getDataTableInstitucion($_GET);
            echo $res;    
            exit;
        break;
    
    case 'itemnewsql':
            $res = $objItem->itemSave($item,0);
            echo  json_encode($res);
            exit;
        break;        
        
    case 'verificarUsuario':
            $res = $objItem->verificarUsuario($currentUser, $lastUser);
            echo  json_encode($res);
            exit;
        break;    
    
    case 'itemupdatesql':
            $item["lastUsuario"] = $lastuser;
            $res = $objItem->itemUpdate($item,$itemId,0);
            echo  json_encode($res);
            exit;
        break;    
   
    case 'getPhoto':
              
              if($itemId!=""){
                //$item = $this->getItem($itemId);

                $dirAttached = $objItem->directory."$itemId/";
            
                $conten_Disposition = "inline";
                
                if($type==0){
                    $file = $dirAttached."small/".$itemId.".jpg";
                }elseif($type==1){
                    $file = $dirAttached."thumbails/b_".$itemId.".jpg";
                }
                
                $type = "image/jpeg";
                header ("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
                header ("Last-Modified: " . gmdate("D,d M YH:i:s") . " GMT");
                header ("Cache-Control: no-cache, must-revalidate");
                header ("Pragma: no-cache");
                header ("Content-Type: $type");
                header ('Content-Disposition: '.$conten_Disposition.'; filename="portada.jpg"');
                //header ("Content-Length: ".$item["photoSize"]);
                readfile($file);
        }
        exit;
        break;     
  
   case 'small':
        $item = $objItem->getPhotoItem($itemId);

        if($item["itemId"]!=""){
            $fichaId = $item["fichaId"];
            //$dirAttached = $objItem->directory.floor($fichaI/$CFG->itemDir)."/".$fichaId."/";
            $dirAttached = $objItem->directory.$fichaId."/";
            //echo "=>".$dirAttached;exit;
            $conten_Disposition = "inline";
            if($type==0){
                $file = $dirAttached."thumbails/b_".$itemId.".jpg";
            }else if($type==1){
                $file = $dirAttached."medium/".$itemId.".jpg";
            }else if ($type==2){
                $conten_Disposition = "attachment";
                $file = $dirAttached.$itemId.".jpg";
            }else{
                $file = $dirAttached."thumbails/b_".$itemId.".jpg";
            }
            $type = "image/jpeg";
            header ("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
            header ("Last-Modified: " . gmdate("D,d M YH:i:s") . " GMT");
            header ("Cache-Control: no-cache, must-revalidate");
            header ("Pragma: no-cache");
            header ("Content-Type: $type");
            header ('Content-Disposition: '.$conten_Disposition.'; filename="'.$item["titulo"].'.jpg"');
            //header ("Content-Length: ".$item["photoSize"]);
            readfile($file);
        }
        exit;
    break;
}
