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
            $smarty->assign("listCatalogo",$subObjItem->listCatalogo('index',$item["itemId"],$fichaId));
            
            $listForm = $subObjItem->getConfigUnset($objItem->getConfig("grupo"),"personal");
            $smarty->assign("listDataPersonal",$listForm);            
  
            /*************************************************************************/
            $smarty->assign("accion",$type);
            $smarty->assign("subpage",$templateItem_InfoGral);            
            
        break;
    
    case 'getInstitucion':
            $templateModule=$templateModuleAjax;
            $smarty->assign("subpage",$templateListInstitucion);
            
        break;
    
    case 'getListInstitucion':
            $res = $subObjItem->getDataTableInstitucion($_GET);
            echo $res;    
            exit;
        break;
    
    case 'itemnewsql':
            $res = $subObjItem->itemSave($item,0);
            echo  json_encode($res);
            exit;
        break;        
        
    case 'verificarUsuario':
            $res = $subObjItem->verificarUsuario($currentUser, $lastUser);
            echo  json_encode($res);
            exit;
        break;    
    
    case 'itemupdatesql':
            $item["lastUsuario"] = $lastuser;
            $res = $subObjItem->itemUpdate($item,$itemId,0);
            echo  json_encode($res);
            exit;
        break;    
   
    case 'getPhoto':
              
              if($itemId!=""){
                //$item = $this->getItem($itemId);
                
                $dirAttached = $subObjItem->directory."$itemId/";
            
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
        $item = $subObjItem->getPhotoItem($itemId);

        if($item["itemId"]!=""){
            $fichaId = $item["fichaId"];
            //$dirAttached = $subObjItem->directory.floor($fichaI/$CFG->itemDir)."/".$fichaId."/";
            $dirAttached = $subObjItem->directory.$fichaId."/";
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


    case 'copiarDatos':
            $res = $subObjItem->copiarPermisos($id);
            echo json_encode($res);
            exit;
      break;
}
