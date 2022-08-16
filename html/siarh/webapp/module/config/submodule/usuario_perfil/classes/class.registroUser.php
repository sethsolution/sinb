<?php
class registro extends Table{  
    
	function __construct(){
	   global $CFG,$module,$smoduleName;
       
       $this->pref = $CFG->prefix;
       $this->conteTableName = $smoduleTableName;
	   $this->conteIdName = "memberId";
		//==================================
		// Directorio de datos del modulo
		//==================================
	   $this->directory = $CFG->data.$module."/";
	   $this->viewDirectory($this->directory);
	   $this->directory = $this->directory.$smoduleName."/";//Cargamos la carpeta del modulo
	   $this->viewDirectory($this->directory);//verificamos si existe la carpeta, si no existe lo crea
	}
    function getValidarUserSistem($user,$pass,$nombre,$apell,$telefono,$celular,$email){
        global $CFG,$db;
		$db->SetFetchMode(ADODB_FETCH_ASSOC);
        $estado=true;
        $sWhere="";
        if($pass!=""){
            $sWhere .=" and cu.itemId<>$pass";
        }
        $sql = "select *
                from core_usuario as cu
                where cu.usuario ='".$user."'".$sWhere;
        //echo $sql; exit;
        $info = $db->Execute($sql);
        $item = $info->GetRows();
        $opt = array();
        if($item){
            $estado=false;
        }       
		return $estado;
    }
    function registrarUser($user,$pass,$tipouser,$nombre,$apell,$estado){
        global $db;
        $res=array();
        //echo $user;
        if(trim($user)!="" && trim($pass)!="" && trim($tipouser)!="" && trim($nombre)!="" && trim($apell)!=""){
            if($this->getValidarUserSistem($user,"",$nombre,$apell,"--","--","--")){
                $rec["usuario"] = $user;
                $rec["password"] = md5($pass);
                $rec["activo"] =$estado;
                $rec["nombre"] = $nombre;
                $rec["apellido"] = $apell;
                $rec["tipoUsuario"] = $tipouser;
                $rec["dateCreate"] = date("Y-m-d");
                
                $resaux = $db->AutoExecute("core_usuario",$rec);
                
                if($resaux){
                    $itemId = $db->Insert_ID();
                    $res["res"] = 1; 
                    $res["id"] = $itemId;
                    $res["msg"] = "Registro";
                }else{
                    $auxmsg = $db->ErrorMsg();  
                    $res["res"] = 2;
                    $res["msg"] = utf8_encode("No se logr� registrar en la BD.<br />".$auxmsg);
                }
            }else{
                $res["res"] = 2;
                $res["msg"] = utf8_encode("Datos Duplicados.");
            } 
        }else{
                $res["res"] = 2;
                $res["msg"] = utf8_encode("Los dato del usuario es incorrecto");  
        }        
        return $res;
    }
    
    function updateUser($user,$pass,$tipouser,$nombre,$apell,$estado,$badeta){
        global $db,$privFace; 
        $res=array();		
        if ($badeta!=""){ 
            if($this->getValidarUserSistem($user,$badeta,$nombre,$apell,"--","--","--")){
                $rec["usuario"] = $user;
                if($pass!=""){
                    $rec["password"] = md5($pass);
                }            
                $rec["activo"] =$estado;
                $rec["nombre"] = $nombre;
                $rec["apellido"] = $apell;
                $rec["tipoUsuario"] = $tipouser;
                $rec["dateUpdate"] = date("Y-m-d H:i:s");
                if (get_magic_quotes_gpc() ){
                    if( isset($rec["usuario"]) ) $rec["usuario"]= stripslashes($rec["usuario"]);
                    if($pass!=""){
                        if( isset($rec["password"]) ) $rec["password"]= stripslashes($rec["password"]);
                    }                
                    if( isset($rec["nombre"]) ) $rec["nombre"]= stripslashes($rec["nombre"]);	
                    if( isset($rec["apellido"]) ) $rec["apellido"]= stripslashes($rec["apellido"]);
                }
                if( isset($rec["usuario"]) ) $rec["usuario"] = utf8_decode($rec["usuario"]);
                if($pass!=""){
                    if( isset($rec["password"]) ) $rec["password"] = utf8_decode($rec["password"]);
                }              
                if( isset($rec["nombre"]) ) $rec["nombre"] = utf8_decode($rec["nombre"]);
                if( isset($rec["apellido"]) ) $rec["apellido"] = utf8_decode($rec["apellido"]);
                /**
                * mascaras
                */
                //if($rec["ventasDeclaradas"]!="") $rec["ventasDeclaradas"] = str_replace(".","",$rec["ventasDeclaradas"]);
                //if($rec["comprasDeclaradas"]!="") $rec["comprasDeclaradas"] = str_replace(".","",$rec["comprasDeclaradas"]);
                
                if($privFace["editar"]){$resupdate = $db->AutoExecute("core_usuario",$rec,"UPDATE","itemId=".$badeta);}                
                    if($resupdate){
                        $res["res"] = 1;
                        $res["id"] = $badeta;
                        $res["msg"] = "Actualizo";
                    }else{
                        $res["res"] = 2;
                        //$res["msg"] = utf8_encode("No se logr� actualizar los datos de la meta en la BD");
                        $res["msg"] = $db->ErrorMsg();
                    }
                }else{
                    $res["res"] = 2;
                    $res["msg"] = utf8_encode("Datos Duplicados.");
                } 
                
            }else{
                $res["res"] = 2;
                $res["msg"] = utf8_encode("No existe ID relacionado a la meta"); 
            }
        return $res;
    }  
    function eliminarUser($gettablaTem){
        global $db; 
        $res=array();
        if($gettablaTem){
            $sql = "delete from core_usuario where itemId = ".$gettablaTem;
    		$resdelete=$db->Execute($sql);
            if($resdelete){
                $res["res"] = 1;
                $res["msg"] = utf8_encode("Se Elimino Correctamente.");
            }else{
                $res["res"] = 2;
                $res["msg"] = utf8_encode("Erro al eliminar");
            }
        }else{
            $res["res"] = 2;
            $res["msg"] = utf8_encode("No existe ID relacionado a la meta");
        } 
        return $res;       
    }
    function cambiarEstadoUser($settablaid,$estado){
        global $db,$privFace; 
        $res=array();
        if($settablaid!="" and $settablaid!="0"){            
            $rec["activo"] =$estado;
            $rec["dateUpdate"] = date("Y-m-d H:i:s");
            
    if($privFace["editar"]){$resupdate = $db->AutoExecute("core_usuario",$rec,"UPDATE","itemId=".$settablaid);}                
            if($resupdate){
                $res["res"] = 1;
                $res["stend"] = $estado;
                $res["evento"] = "Actualizo";
            }else{
                $res["res"] = 2;
                //$res["msg"] = utf8_encode("No se logr� actualizar los datos de la meta en la BD");
                $res["msg"] = $db->ErrorMsg();
            }
        }else{
            $res["res"] = 2;
            $res["msg"] = utf8_encode("No existe ID relacionado a la meta");
        } 
        return $res;  
    }
    function registrarUserPersonal($telefono,$celular,$email,$resizable){
        global $db,$privFace;
        $res=array();
        if(trim($telefono)!="" && trim($celular)!="" && trim($email)!="" && trim($resizable)!=""){
            if($this->getValidarUserSistem("--","--","--","--",$telefono,$celular,$email)){
                $rec["telefono"] = $telefono;
                $rec["celular"] = $celular;
                $rec["email"] =$email;
                $rec["direccion"] = $resizable;
                $rec["dateCreate"] = date("Y-m-d");
                $db->debug=true;
               // print_sctruc($rec);
                if($privFace['editar'])
                $resaux = $db->AutoExecute("core_usuario",$rec);
                
                if($resaux){
                    $itemId = $db->Insert_ID();
                    $res["res"] = 1; 
                    $res["id"] = $itemId;
                    $res["evento"] = "Registro";
                }else{
                    $auxmsg = $db->ErrorMsg();  
                    $res["res"] = 2;
                    $res["msg"] = utf8_encode("No se logr� registrar en la BD.<br />".$auxmsg);
                }
            }else{
                $res["res"] = 2;
                $res["msg"] = utf8_encode("Datos Duplicados.");
            }   
        }else{
            $res["res"] = 2;
            if(trim($newAnio)=="" || trim($newAnio)==0)
                $res["msg"] = utf8_encode("El id de la empresa es incorrecto");
            elseif(trim($idEmpr)=="" || trim($idEmpr)==0)
                $res["msg"] = utf8_encode("La gesti�n es incorrecto");    
        }        
        return $res;    
    }
    function updateUserPersonal($telefono,$celular,$email,$resizable,$badeta){
        global $db,$privFace; 
        $res=array();		
        if ($badeta!=""){            
            $rec["telefono"] = $telefono;
            $rec["celular"] = $celular;
            $rec["email"] =$email;
            $rec["direccion"] = $resizable;
            $rec["dateUpdate"] = date("Y-m-d H:i:s");
            if (get_magic_quotes_gpc() ){
                if( isset($rec["telefono"]) ) $rec["telefono"]= stripslashes($rec["telefono"]);	
                if( isset($rec["celular"]) ) $rec["celular"]= stripslashes($rec["celular"]);
                if( isset($rec["email"]) ) $rec["email"]= stripslashes($rec["email"]);	
                if( isset($rec["direccion"]) ) $rec["direccion"]= stripslashes($rec["direccion"]);
            }
            if( isset($rec["telefono"]) ) $rec["telefono"] = utf8_decode($rec["telefono"]);
            if( isset($rec["celular"]) ) $rec["celular"] = utf8_decode($rec["celular"]);
            if( isset($rec["email"]) ) $rec["email"] = utf8_decode($rec["email"]);
            if( isset($rec["direccion"]) ) $rec["direccion"] = utf8_decode($rec["direccion"]);
            /**
            * mascaras
            */
            //if($rec["ventasDeclaradas"]!="") $rec["ventasDeclaradas"] = str_replace(".","",$rec["ventasDeclaradas"]);
            //if($rec["comprasDeclaradas"]!="") $rec["comprasDeclaradas"] = str_replace(".","",$rec["comprasDeclaradas"]);
            
      if($privFace["editar"]){$resupdate = $db->AutoExecute("core_usuario",$rec,"UPDATE","itemId=".$badeta);}                
                if($resupdate){
                    $res["res"] = 1;
                    $res["id"] = $badeta;
                    $res["evento"] = "Actualizo";
                }else{
                    $res["res"] = 2;
                    //$res["msg"] = utf8_encode("No se logr� actualizar los datos de la meta en la BD");
                    $res["msg"] = $db->ErrorMsg();
                }
            
            }else{
                $res["res"] = 2;
                $res["msg"] = utf8_encode("No existe ID relacionado a la meta"); 
            }
        return $res;
    }
    function updateUserSecreEntid($secretaria,$entidad,$estadoDato){
        global $db,$privFace; 
        $res=array();	
        //$db->debug=true;
        //echo $secretaria;	
        if ($estadoDato!="" and $estadoDato!="0"){
            $secret = explode("-", $secretaria);
            $rec["secretariaId"] = $secret[1];
            if($entidad==0){
                $rec["entidadId"] = $secret[1];
            }else{
                $rec["entidadId"] = $entidad;
            }
            
            $rec["dateUpdate"] = date("Y-m-d H:i:s");
            
      if($privFace["editar"]){$resupdate = $db->AutoExecute("core_usuario",$rec,"UPDATE","itemId=".$estadoDato);}  
                          
            if($resupdate){
                $res["res"] = 1;
                $res["id"] = $estadoDato;
                $res["evento"] = "Actualizo";
            }else{
                $res["res"] = 2;
                //$res["msg"] = utf8_encode("No se logr� actualizar los datos de la meta en la BD");
                $res["msg"] = $db->ErrorMsg();
            }
        
        }else{
            $res["res"] = 2;
            $res["msg"] = utf8_encode("No existe ID relacionado a la meta"); 
        }
        return $res;
    }
    function getGestiones(){
        global $CFG,$db;
		$db->SetFetchMode(ADODB_FETCH_ASSOC);
        
        $sql = "select gg.itemId, gg.descripcion
                from gadc_gestion as gg
                where gg.active=1 ORDER BY gg.itemId DESC";
        
        $info = $db->Execute($sql);
        $item = $info->GetRows();
        $opt = array();
        foreach($item as $row){
            $opt[$row["itemId"]] = utf8_encode($row["descripcion"]);
        }        
		return $opt;
    } 
    function insertUserPermisos($dato,$dato2){
        global $db;
        $res=array();
        $this->deleteUserPermisos($dato2);
        for($i=0;$i<count($dato);$i++){
            //print_r($dato[$i]);
            if($this->getValidarPermisoExiste($dato[$i]["usuario"],$dato[$i]["modulo"])){
                if(trim($dato[$i]["usuario"])!="" && trim($dato[$i]["modulo"])!=""){                  
                    $rec["usuarioId"] = $dato[$i]["usuario"];
                    $rec["subModuloId"] = $dato[$i]["modulo"]; 
                    $rec["tipo"] = $dato[$i]["tipo"]; 
                    $rec["crear"] = $dato[$i]["anadir"];
                    $rec["editar"] = $dato[$i]["edit"];
                    $rec["eliminar"] = $dato[$i]["borrar"];           
                    $resaux = $db->AutoExecute("core_usuario_permisos",$rec);
                    
                    if($resaux){
                        $res["res"] = 1; 
                        $res["id"] = $dato[$i]["usuario"];
                        $res["evento"] = "Registro";
                    }else{
                        $auxmsg = $db->ErrorMsg();  
                        $res["res"] = 2;
                        $res["msg"] = utf8_encode("No se logr� registrar en la BD.<br />".$auxmsg);
                    }
                }else{
                    $res["res"] = 2;
                    if(trim($usuario)=="" || trim($modulo)==0)
                        $res["msg"] = utf8_encode("El id de la empresa es incorrecto");
                    elseif(trim($usuario)=="" || trim($modulo)==0)
                        $res["msg"] = utf8_encode("La gesti�n es incorrecto");    
                } 
            }else{
                $res["res"] = 2;
                $res["msg"] = utf8_encode("Ya se  registro los dato.<br />");
            }
        }
         
        return $res; 
    }
    function getValidarPermisoExiste($usuario,$modulo){
        global $CFG,$db;
		$db->SetFetchMode(ADODB_FETCH_ASSOC);
        $bande=true;
        $sql = "select *
                from core_usuario_permisos as cup
                where cup.usuarioId=$usuario and cup.subModuloId=$modulo";
        //echo $sql;
        $info = $db->Execute($sql);
        $item = $info->GetRows();
        if($item){
            $bande=false;
        }        
		return $bande;
    }
    function deleteUserPermisos($dato){
        global $db; 
        $res=array();
        for($i=0;$i<count($dato);$i++){
            if(trim($dato[$i]["usuario"])!="" && trim($dato[$i]["modulo"])!=""){
                $usuario=$dato[$i]["usuario"];
                $modulo=$dato[$i]["modulo"];
                $sql = "delete from core_usuario_permisos where usuarioId = $usuario and subModuloId = $modulo";
                //echo $sql;
        		$resdelete=$db->Execute($sql);
                if($resdelete){
                    $res["res"] = 1;
                    $res["msg"] = utf8_encode("Se Elimino Correctamente.");
                }else{
                    $res["res"] = 2;
                    $res["msg"] = utf8_encode("Erro al eliminar");
                }
            }else{
                $res["res"] = 2;
                $res["msg"] = utf8_encode("No existe ID relacionado a la meta");
            }
        }
        return $res;
    } 
    function updateUserPermisos($usuario,$modulo,$edit,$anadir,$borrar){
        global $db,$privFace; 
        $res=array();	
        //$db->debug=true;
        //echo $secretaria;	
        if ($usuario!="" and $modulo!="0"){
            $rec["crear"] = $edit;
            $rec["editar"] = $anadir;
            $rec["eliminar"] = $borrar;   
                     
          if($privFace["editar"]){$resupdate = $db->AutoExecute("core_usuario_permisos",$rec,"UPDATE","usuarioId = $usuario and subModuloId = $modulo");}  
                          
            if($resupdate){
                $res["res"] = 1;
                $res["id"] = $resupdate;
                $res["evento"] = "Actualizo";
            }else{
                $res["res"] = 2;
                //$res["msg"] = utf8_encode("No se logr� actualizar los datos de la meta en la BD");
                $res["msg"] = $db->ErrorMsg();
            }
        
        }else{
            $res["res"] = 2;
            $res["msg"] = utf8_encode("No existe ID relacionado a la meta"); 
        }
        return $res;
    } 
    function itemSaveImagen($rec){
		global $db,$core,$adjunto,$portada;       
        $estadoSubir="";
		if(isset($portada["name"]) && $portada["name"]!="" && $portada["error"]==0){
			$estadoSubir=$this->upDateContePortada($portada,$rec);
		}
		return $estadoSubir;
	} 
    /* Table::upDateContePortada()
  * 
  * @param mixed $portada
  * @param mixed $id
  * @return void
  */
 function upDateContePortada($portada,$itemId){
  global $db,$privFace;
       
  $dirPortada = $this->directory."Portada/"; 
        $this->viewDirectory($dirPortada);
       
  $foto["name"]= "$itemId.jpg";
  $foto["tmp_name"]= $portada["tmp_name"];

  $res1["uploadfoto"] = $this->subirFotoServidor($foto,$dirPortada);
  

    $datos=array();
    $datos["portada"]=1;
    $datos["dateUpdate"] = date("Y-m-d H:i:s");
  
  if($privFace["editar"]){$resupdate = $db->AutoExecute("core_usuario",$datos,'UPDATE','itemId = '.$itemId);}
    if($resupdate){
        if($res1["uploadfoto"]["copy"] and $res1["uploadfoto"]["panel"] and $res1["uploadfoto"]["vsmall"] and $res1["uploadfoto"]["small"] and $res1["uploadfoto"]["medium"] and $res1["uploadfoto"]["big"]){
            $res["estadoUplod"]=1;
        }else{
            $res["estadoUplod"]=0;
        }
        $id=rand(10,100);
        $res["res"] = 1; 
        $res["msg"] = utf8_encode('<img src="data/config/listaUsuarios/Portada/small/'.$itemId.'.jpg?'.$id.'" />'); 
    }else{
      $auxmsg = $db->ErrorMsg();
      $res["estadoUplod"]=0;  
      $res["res"] = 2;
      $res["msg"] = utf8_encode("No se actualizo datos de la imagen en la BD.<br />".$auxmsg);  
    }
    return $res;
  //zpLog("UPDATE PORTADA",$this->tableName,$itemId);
 }
    
 /**
  * Table::subirFotoServidor()
  * @param mixed $foto
  * @param mixed $directorio
  * @return void
  */
 function subirFotoServidor($foto, $directorio){
  $nombreFoto = $foto['name'];
  $originalFoto = $foto["tmp_name"];
  $this->viewDirectory($directorio);
        
        $this->viewDirectory($directorio."vsmall/");
  $this->viewDirectory($directorio."small/");
  $this->viewDirectory($directorio."medium/");
  $this->viewDirectory($directorio."big/");  
  $this->viewDirectory($directorio."panel/");
        $this->viewDirectory($directorio."thumbails/");

        $res["copy"] = copy($originalFoto,$directorio.$nombreFoto);
        //====================================================
  $image = new hft_image($originalFoto);
    $image->set_parameters('85');
        
        $contRigth=0;
        $contWrong=0;
    //============================================================
    //= Genera imagen para mostrar en zpanel, width maximo 50
    //= height maximo 50
    //============================================================
    $image->resize(50,'*', '-'); //Foto tama�o 100 px ancho PEQUE�O para mostrar en zpanel
        $res["panel"] = $image->output_resized($directorio."panel/".$nombreFoto, "JPEG");
        chmod($directorio."panel/".$nombreFoto,0777);
        if($res["panel"]) $contRigth++;
        else $contWrong++;
        //============================================================
        
        $image->resize(32,32, '-'); //Foto tama�o Medium width maximo 150px height maximo 113px
        $res["vsmall"] = $image->output_resized($directorio."vsmall/".$nombreFoto, "JPEG");
        chmod($directorio."vsmall/".$nombreFoto,0777);
        if($res["vsmall"]) $contRigth++;
        else $contWrong++;
        
     $image->resize(170,'*', '-'); //Foto tama�o Medium width maximo 150px height maximo 113px
        $res["small"] = $image->output_resized($directorio."small/".$nombreFoto, "JPEG");
        chmod($directorio."small/".$nombreFoto,0777);
        if($res["vsmall"]) $contRigth++;
        else $contWrong++;
        
        $image->resize(500,500, '-'); //Foto tama�o Medium width maximo 400px height maximo 300px
     $res["medium"] = $image->output_resized($directorio."medium/".$nombreFoto, "JPEG");
     chmod($directorio."medium/".$nombreFoto,0777);
        if($res["vsmall"]) $contRigth++;
        else $contWrong++;
        
     $image->resize(740,600,'-'); //Foto tama�o Grande width maximo 700px height maximo 525px
     $res["big"] = $image->output_resized($directorio."big/".$nombreFoto, "JPEG");
     chmod($directorio."big/".$nombreFoto,0777);
     if($res["big"]) $contRigth++;
        else $contWrong++;
        
        $image->set_parameters('90');
        
        $squareOriginal = $directorio."medium/".$nombreFoto;
            
        $tbc = $directorio."thumbails/a_".$nombreFoto;
        $this->saveSquareThumb($squareOriginal,$tbc,50);
     chmod($tbc,0777);
            
        $tbc = $directorio."thumbails/b_".$nombreFoto;
        $this->saveSquareThumb($squareOriginal,$tbc,32);
     chmod($tbc,0777);
        
        $tbc = $directorio."thumbails/c_".$nombreFoto;
        $this->saveSquareThumb($squareOriginal,$tbc,100);
     chmod($tbc,0777);
        
        if($contWrong>0)
          $res["msg"] = utf8_encode("No se crearon todas las imagenes");  
        
        return $res;
 }
}
