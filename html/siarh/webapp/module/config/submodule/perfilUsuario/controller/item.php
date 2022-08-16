<? 
// Manera 1
        //$templateModule = $templateformdatosSistem;
        // Manera 2
        //$templateModule = $templateModuleAjax;
        //$templateModule = $templateModuleForm;
        //$templateModule = $templateModuleOtroJSP;
        //$templateModule = $templateModuleMOBILE;
        //$smarty->assign("subpage",$templateformdatosSistem);
        //$listSecre = $objCatalog->formularioSistema();
        //echo $listSecre;
        //exit;
switch($accion){       
    case 'getdatosSistema':  
        //print_r($_SESSION);
        $templateModule = $templateModuleAjax;
        $temTipUser=$objCatalog->getTipoUsuario();
        $item = $objItem->getUserData();
        $smarty->assign("item",$item);
        $smarty->assign("subpage",$templateformdatosSistem);
        $smarty->assign("tipuser",$temTipUser[$_SESSION["userv"]["tipoUsuario"]]);
        $smarty->assign("estado","Activo");
    break;
    case 'getdatosPersonales': 
        //print_struc($_SESSION);
        $id=rand(10,100);
        $templateModule = $templateModuleAjax;
        $tenfoto=($_SESSION["userv"]["portada"]!="0"?'<img src="data/config/listaUsuarios/Portada/small/'.$_SESSION["userv"]["itemId"].'.jpg?'.$id.'" />':"");
        $smarty->assign("foto",$tenfoto);
        $smarty->assign("subpage",$templateformdatosPersonal);
        $item = $objItem->getUserData();
        $smarty->assign("item",$item);
    break;
    case 'guardarDatosUser': 
        $estUpdateUser = $objItem->setUpdateDatoUser($pass,$nombre,$apell);
        echo json_encode($estUpdateUser);
        exit;
    break;
    case 'guardarDatosUserDos':
       $telefono=(isset($_REQUEST["telefono"]))?$_REQUEST["telefono"]:'';
       $celular=(isset($_REQUEST["celular"]))?$_REQUEST["celular"]:'';
       $email=(isset($_REQUEST["email"]))?$_REQUEST["email"]:'';
       $direccion=(isset($_REQUEST["direccion"]))?$_REQUEST["direccion"]:'';
       $estUpdateUser=$objItem->setDatoUserPersonales($telefono,$celular,$email,$direccion);
        echo json_encode($estUpdateUser);
        exit;
    break;
    case 'cargarImagen': 
        if($_SESSION["userv"]["itemId"]!="0" and $_SESSION["userv"]["itemId"]!=""){ 
            $estImagen=$objItem->itemSaveImagen($_SESSION["userv"]["itemId"]);  
            echo json_encode($estImagen);      
            exit;            
        }else{
            $templateModule = $templateError;
        }
        exit;
    break;
    case 'listaAsigUser': 
        $listUsuarios = $objCatalog->getModulosSubModulo($_GET);
        echo json_encode($listUsuarios);
        //print_r($objCatalog->verModuloAndSubModulos(1));
        exit;
    break;    
    /**
     * P�gina por defecto
     */
    default:
        $smarty->assign("subpage",$templateIndex);
    break;
    
    case 'getPhoto':
              
              if($itemId!=""){
                $dirAttached = $objItem->directory."listaUsuarios/$itemId/";
            
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
  
}
