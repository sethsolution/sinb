<?php
/**
 * funcionalida de URL amigables
 */
$url = parse_url($_SERVER['REQUEST_URI']) ;
$ruta = $url["path"];
$ruta = explode('/',$ruta);

if(isset($ruta[1])) $ruta[1] = trim($ruta[1]);
if(isset($ruta[2])) $ruta[2] = trim($ruta[2]);
if(isset($ruta[3])) $ruta[3] = trim($ruta[3]);

if( !isset($ruta[1]) || $ruta[1]== "index.php" || $ruta[1]== ""){
    $module = "core";
}else{
    $module =$ruta[1];
}
/**
 * Un Hack para ver si el segundo parametro es un numero
 * si es numero por defecto colocaremos index
 */


if( !isset($ruta[2]) || $ruta[2]==""){
    $smodule = "index";
}else{
    if(is_numeric($ruta[2])){
        //echo "es número";
        $smodule = "index";
        $core_id = $ruta[2];
    }else{
        //echo "No es número".$ruta[2];
        $smodule =$ruta[2];
    }
}

if( isset($ruta[3]) || $ruta[3] !="" ){
    $ruta_accion =$ruta[3];
    $ruta_id =$ruta[3];
}

if(count($ruta)>3){
    $variables  = array();
    for($i=3;$i<count($ruta);$i++){
        $variables[] = $ruta[$i];
    }
}

/*
echo "smodule".$smodule."<br>";
echo "module".$module."<br>";
*/
/**
 * Definimos por URL las variables de module y smodule
 */
if (isset($_REQUEST["module"])) $module  = $_REQUEST["module"];
if (isset($_REQUEST["smodule"])) $smodule  = $_REQUEST["smodule"];


$smoduleName = $smodule;
$smarty->assign("module", $module);
$smarty->assign("smoduleName", $smoduleName);

$accion  = (isset($_REQUEST["accion"]))?$_REQUEST["accion"]:'';

$pathmodule = "./module/" . $module . "/";

include_once($pathmodule."inc/template.php");
include_once($pathmodule."inc/inc.php");
            
//$getModule = "index.php?module=" . $module . "&smodule=" . $smodule;
$getModule = "/".$module."/".$smodule."/?";

$getModuleOnly = "index.php?module=" . $module;
            
$getModuleVar = "module=" . $module . "&smodule=" . $smodule;
$getModuleVarOnly = "module=" . $module;
            
$smarty->assign("getModuleVar", $getModuleVar);
$smarty->assign("getModule", $getModule);

$smarty->assign("getModuleVarOnly", $getModuleVarOnly);
$smarty->assign("getModuleOnly", $getModuleOnly);
//====================================================//    

$smodule3 = $pathmodule . "submodule/$smoduleName/snippet/index/class.php";
/**
 * Nueva implementación
 * 2018
 * obligamos a tomar a todos la opción 2 en $typeModule
 */
//$smodule = "";

if(file_exists($smodule3)) {
    $ban = 1;
    $typeModule = 3; //tipo de modulo
}


/**
 * Sacamos datos frescos del usuario siempre
 */

if ( isset($_SESSION["auth"]) and $_SESSION["auth"] == 1) {
    /**
     * Autentificación de usuario
     */
    $usuarioInfo = $core->getUsuarioInfo($_SESSION["userv"]["itemId"]);
    $smarty->assign("usuarioInfo", $usuarioInfo);

    //$smarty->assign("usuarioEntro",true);
    $smarty->assign("sess",$_SESSION);
}

/**
 * Sacamos los datos del subsistema que estamos accediendo
 */
if($module!="core" && $module!="ingreso"){
    $subsistema = $core->get_subsistema_data($module);
    if($subsistema["itemId"]){
        /**
         * si es  un módulo del core, necesita saber si esta con una sessión iniciada
         */
        if($subsistema["core"]==1  || $subsistema["privado"]==1 ){
            if ( isset($_SESSION["auth"]) and $_SESSION["auth"] == 1){
                /**
                 * Si es un modulo del core y estamos con la sesión iniciada
                 */
            }else{
                //$ban = 0;
                include($CFG->homeSis."noprivileges.php");
                exit;
            }
        }else{
            //print_struc($subsistema);
            //include($CFG->homeSis."noprivileges.php");
            //exit;
        }
    }else{
        $ban = 0;
    }
}

if($ban == 1){
    /**
     * Si esta en un módulo cargamos la libreria para datatable
     */
    require("./lib/datatable/ssp.seth.class.php");
    $obj_datatable = new SSP();
    //print_struc($obj_datatable);
    /**
     * objeto principal
     **/
    $objItem = new SSP();
    /**
     * objeto principal
     **/
    //$objItem = new Index();
    //$objCatalog = new Catalogo();
    /**
     * Permisos de acceso al módulo
     */
    if($module != "core" && $module != "perfil"){
        $privSM = $core->getSModulePrivileges($module,$smodule);

        /**
         * Des habilitamos los checkbox en caso de ser usuario normal y no tener permisos de edición
         * Todos los casos de edicion
         */
        if ($privSM["admin"]==0 && isset($privSM["permiso"]) && $privSM["permiso"]["editar"]==0){
            $privFace["checkbox"] = " disabled='true' ";
            $privFace["input"] = " disabled='true' ";
            $privFace["editar"] = false;
        }else{
            $privFace["editar"] = true;
        }
        
        if ($privSM["admin"]==0 && isset($privSM["permiso"]) && $privSM["permiso"]["eliminar"]==0){
            $privFace["eliminar"] = false;
        }else{
            $privFace["eliminar"] = true;
        }
                
        if ($privSM["admin"]==0 && isset($privSM["permiso"]) && $privSM["permiso"]["crear"]==0){
            $privFace["crear"] = false;
        }else{
            $privFace["crear"] = true;
        }

        $smarty->assign("privFace",$privFace);
        $smarty->assign("privSM",$privSM);

        if($subsistema["privado"]!=0){
            if($privSM["res"] == 0){
                include($CFG->homeSis."noprivileges.php");
                exit;
            }
        }
    }


    /**
     * Generamos el menu
     */

    if (!isset($menu_modulo_principal)){
        /**
         * Sacamos los datos de la miga de pan
         */
        $miga = $core->get_datos_miga($module,$smodule);
        $menu_modulo_principal = $core->get_module_menu($miga["modulo"]["itemId"]);
    }

    $smarty->assign("miga",$miga);
    $smarty->assign("menu_modulo_principal",$menu_modulo_principal);


    if ($typeModule == 2){
        include($CFG->homeSis."submodule.php");
    }elseif($typeModule== 3){
        include($CFG->homeSis."snippet.php");
    }else{
        include $smodule;    
    }
}else{

    include($CFG->homeSis."nomodule.php");


}

/**
 * calcula el tiempo de procesamiento
 */
//$time_total = intval(( time()-$_SESSION["start"]) / 60);
$time_total =  time()-$_SESSION["start"];
$smarty->assign("time_total",$time_total);
