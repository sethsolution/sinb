<? 
include($pathmodule."submodule/listaUsuarios/classes/class.reportesEcoregion.php");
$objecRegis=new registro();
switch($accion){ //
    case 'updateSecreEnti': 
        $estRegisSecreEnti=$objecRegis->updateUserSecreEntid($secretaria,$entidad,$estadoDato);  
        echo json_encode($estRegisSecreEnti);      
        exit;
    break;
    case 'registraUserPersonal': 
        $estRegisPer=$objecRegis->registrarUserPersonal($telefono,$celular,$email,$resizable);  
        echo json_encode($estRegisPer);      
        exit;
    break;
    case 'updateUserPersonal': 
        $estupdatPer=$objecRegis->updateUserPersonal($telefono,$celular,$email,$resizable,$badeta);  
        echo json_encode($estupdatPer);      
        exit;
    break;
    case 'cambiarEstadodato': 
        $estEstado=$objecRegis->cambiarEstadoUser($settablaid,$estado);  
        echo json_encode($estEstado);      
        exit;
    break;
    case 'eliminardato': 
        $estElim=$objecRegis->eliminarUser($gettablaTem);  
        echo json_encode($estElim);      
        exit;
    break;
    case 'registraUser': 
        $estInset=$objecRegis->registrarUser($user,$pass,$tipouser,$nombre,$apell,$estado);  
        echo json_encode($estInset);      
        exit;
    break;
    case 'updateUser': 
        $estUpdate=$objecRegis->updateUser($user,$pass,$tipouser,$nombre,$apell,$estado,$badeta);  
        echo json_encode($estUpdate);      
        exit;
    break; 
    case 'insertPerm': //:usuario,
        $estInsert=$objecRegis->insertUserPermisos($dato,$dato2);  
        echo json_encode($estInsert);     
        exit;
    break;
    case 'deletePerm': 
        $estDelete=$objecRegis->deleteUserPermisos($dato);  
        echo json_encode($estDelete);      
        exit;
    break;  
    case 'updatePerm': 
        $estUpdate=$objecRegis->updateUserPermisos($usuario,$modulo,$edit,$anadir,$borrar);  
        echo json_encode($estUpdate);      
        exit;
    break;    
    /**imagen**/
    case 'cargarImagen': 
        if($regisestado!="0" and $regisestado!=""){ 
            $estImagen=$objecRegis->itemSaveImagen($_SESSION["userv"]["itemId"]);  
            echo json_encode($estImagen);      
            exit;            
        }else{
            $templateModule = $templateError;
        }
        exit;
    break;
          
    default: 
        
    break;
}
