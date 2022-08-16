<?php
class Index extends Table {
    var $userId;
	function __construct(){
	   global $module,$smoduleName,$CFG;
       $smoduleTableName = "ficha";
       
       $this->tableName = $this->pref.$smoduleTableName;
	   $this->idName = "itemId";
       
       $this->userId = $_SESSION["userv"]["memberId"]; 
	   $this->directory = $CFG->data.$module."/";
	   $this->viewDirectory($this->directory);
	}
    
    function getUserData(){
        global $db;
        $db->SetFetchMode(ADODB_FETCH_ASSOC);
        $sql = "select * from core_usuario as u where u.itemId =".$this->userId;
        $info = $db->Execute($sql);
        $item = $info->GetRows();
        return $item[0];
    }
    function setUpdateDatoUser($pass,$nombre,$apell){
        global $db,$privFace; 
        $res=array();		
        if ($_SESSION["userv"]["itemId"]!=""){
            if($pass!=""){
                $rec["password"] = md5($pass);
            }      
            $rec["nombre"] = trim($nombre);
            $rec["apellido"] = trim($apell);
            $rec["dateUpdate"] = date("Y-m-d H:i:s");
            if (get_magic_quotes_gpc() ){
                if($pass!=""){
                    if( isset($rec["password"]) ) $rec["password"]= stripslashes($rec["password"]);
                }                
                if( isset($rec["nombre"]) ) $rec["nombre"]= stripslashes(trim($rec["nombre"]));	
                if( isset($rec["apellido"]) ) $rec["apellido"]= stripslashes(trim($rec["apellido"]));
            }
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
            //exit;
            if($privFace["editar"]){$resupdate = $db->AutoExecute("core_usuario",$rec,"UPDATE","itemId=".$_SESSION["userv"]["itemId"]);}                
            if($resupdate){
                $res["res"] = 1;
                $res["msg"] = "Actualizo";
                if($pass!=""){
                    $_SESSION["userv"]["password"]=md5($pass);
                }
                $_SESSION["userv"]["nombre"]=utf8_decode($nombre);
                $_SESSION["userv"]["apellido"]=utf8_decode($apell);
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
    
    function setDatoUserPersonales($telefono,$celular,$email,$direccion){
        global $db,$privFace; 
        $res=array();	
        //echo "-".$_SESSION["userv"]["itemId"]."-";	
        if ($_SESSION["userv"]["itemId"]!=""){            
            $rec["telefono"] = $telefono;
            $rec["celular"] = $celular;
            $rec["email"] =$email;
            $rec["direccion"] = $direccion;
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
            
        if($privFace["editar"]){$resupdate = $db->AutoExecute("core_usuario",$rec,"UPDATE","itemId=".$_SESSION["userv"]["itemId"]);}                
                if($resupdate){
                    $res["res"] = 1;
                    $res["msg"] = "Actualizo";                    
                    $_SESSION["userv"]["telefono"]=$telefono;
                    $_SESSION["userv"]["celular"]=$celular;
                    $_SESSION["userv"]["email"]=utf8_decode($email);
                    $_SESSION["userv"]["direccion"]=utf8_decode($direccion);
                }else{
                    $res["res"] = 2;
                    //$res["msg"] = utf8_encode("No se logr� actualizar los datos de la meta en la BD");
                    $res["msg"] = $db->ErrorMsg();
                }
            
            }else{
                $res["res"] = 2;
                $res["msg"] = utf8_encode("No existe ID relacionado"); 
            }
        return $res;
    }
    
    function itemSaveImagen($rec){
		global $db,$core,$adjunto,$portada,$privFace; 
        $estadoSubir="";
        if($privFace['editar']){
		if(isset($portada["name"]) && $portada["name"]!="" && $portada["error"]==0){
			$estadoSubir=$this->upDateContePortada($portada,$rec);
		}}
		return $estadoSubir;
	}

    function upDateContePortada($portada,$itemId){
        global $db,$privFace;
        $dirPortada = "data/config/listaUsuarios/Portada/"; 
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
                $_SESSION["userv"]["portada"]=1;
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

