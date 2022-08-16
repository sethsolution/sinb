<?php

$module  = (isset($_REQUEST["module"]))?$_REQUEST["module"]:'core';
$smodule  = (isset($_REQUEST["smodule"]))?$_REQUEST["smodule"]:'index';
$smoduleName = $smodule;
$smarty->assign("module", $module);
$smarty->assign("smoduleName", $smoduleName);

$accion  = (isset($_REQUEST["accion"]))?$_REQUEST["accion"]:'';

$pathmodule = "./module/" . $module . "/";

include_once($pathmodule."inc/template.php");
include_once($pathmodule."inc/inc.php");
            
$getModule = "index.php?module=" . $module . "&smodule=" . $smodule;
$getModuleOnly = "index.php?module=" . $module;
            
$getModuleVar = "module=" . $module . "&smodule=" . $smodule;
$getModuleVarOnly = "module=" . $module;
            
$smarty->assign("getModuleVar", $getModuleVar);
$smarty->assign("getModule", $getModule);

$smarty->assign("getModuleVarOnly", $getModuleVarOnly);
$smarty->assign("getModuleOnly", $getModuleOnly);
//====================================================//    
$smodule = $pathmodule.$smodule.".php";
//v2.0
$smodule2 = $pathmodule . "submodule/$smoduleName/classes/class.index.php";

//v3.0
$smodule3 = $pathmodule . "submodule/$smoduleName/snippet/index/class.php";
/**
 * Nueva implementación
 * 2018
 * obligamos a tomar a todos la opción 2 en $typeModule
 */
$smodule = "";

if (file_exists($smodule)){
    $ban = 1;
    $typeModule = 1; //tipo de modulo
}else if(file_exists($smodule2)){
    $ban = 1;
    $typeModule = 2; //tipo de modulo
    $smodule = $smodule2;   
}else if(file_exists($smodule3)) {
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
    $smarty->assign("sess",$_SESSION);
}


/* /
echo " smodule3:".$smodule3."<br>";
echo " smodule2:".$smodule2."<br>";
echo "Ban:".$ban."<br>";
echo "type module:".$typeModule."<br>";
echo "s module:".$smodule."<br>";
/**/

/**
 * Sacamos los datos del subsistema que estamos accediendo
 */
if($module!="core"){
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
    if($module != "core"){
        $smo =
        $privSM = $core->getSModulePrivileges($module,$_REQUEST["smodule"]);
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
        
        if($privSM["res"] == 0){
            include($CFG->homeSis."noprivileges.php");
            exit;
        }
        /**
         * Sacamos los datos del Submódulo
         */
        $miga = $core->get_datos_miga($module,$_REQUEST["smodule"]);
        $smarty->assign("miga",$miga);
        /**
         * Generamos el menu
         */
        $menu_modulo_principal = $core->get_module_menu($miga["modulo"]["itemId"]);
        $smarty->assign("menu_modulo_principal",$menu_modulo_principal);
    }
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
