<?
/**
 * Include de clase general
 */
$accion_path = $pathmodule."inc/accion.path.php";
include_once($accion_path);

include_once($pathmodule . "classes/class.modulo_core.php");
$modulo_core = new Modulo_Core();

/**
 * Datos de la empresa
 */
$empresa = $modulo_core->get_empresa_data();
$empresa = $modulo_core->get_empresa_data();
$smarty->assign("empresa",$empresa);
//print_struc($empresa);exit;
/**
 * Modulos segun el tipo de empresa
 */
$permiso_tipo = array();
//$permiso_tipo[1] = (69,70,71,72,73,74,75,76,77,78,79,80,81,82,83,84,85,86,87,89,90,91);

//Empresa/Asociaciones
$permiso_tipo[1] = ('69,70,71,72,75,76,79,80,81,86,87,89,90,91');
//ICAs/Autoridad Cientifica
$permiso_tipo[2] = ('69,70,71,72,75,76,79,80,81,86,87,89,90,91');
//Usuarios Ocasionales
$permiso_tipo[3] = ('69,70,71,72,75,76,79,80,81,86,87,89,90,91');
//Entidades Públicas
$permiso_tipo[9] = ('69,70,83,78,79,80');
//Otros Trámites
$permiso_tipo[11] = ('69,70,89,90,91');

//print_struc($permiso_tipo);
/**
 * Generamos el menu nuevo segun el tipo de usuario
 */
if($_SESSION["userv"]["tipoUsuario"] == 0 || $_SESSION["userv"]["tipoUsuario"] == 1){


}else{
    $modulos_ids = $permiso_tipo[$empresa["tipo"]];
    $privSM = $modulo_core->getSModulePrivileges($module,$smodule,$modulos_ids);
    if($privSM["res"] == 0){
        include($CFG->homeSis."noprivileges.php");
        exit;
    }
    $miga = $core->get_datos_miga($module,$smodule);
    $menu_modulo_principal = $modulo_core->get_module_menu($miga["modulo"]["itemId"],$modulos_ids);
}

/**
 * Configuración del PATH donde se encuentra el módulo para impresión
 */
$path_image = $pathmodule."template/images/";
$smarty->assign("path_image",$path_image);
/**
 * Configuraciones del módulo
 */
$module_conf = array();
/**
 * Textos
 */
$module_conf["btn_inicio"] = "Inicio";
$module_conf["btn_inicio_principal"] = "Volver";
$module_conf["menu_titulo"] = "CITES BOLIVIA";
$module_conf["dashboard_titulo"] = "CITES BOLIVIA";

/**
 * colores
 */
/*
$module_conf["menu_bgcolor"] = "#054775";
$module_conf["menu_bgcolor_logo"] = "#03a6c2";
$module_conf["menu_bgcolor_over"] = "#17518e";
$module_conf["menu_bgcolor_active"] = "#363954";


$module_conf["menu_link_ico"] = "#ffffff";
$module_conf["menu_link_text"] = $module_conf["menu_link_ico"];
$module_conf["menu_link_arrow"] = $module_conf["menu_link_ico"];

$module_conf["menu_link_ico_over"] = "#ffffff";
$module_conf["menu_link_text_over"] = $module_conf["menu_link_ico_over"];

$module_conf["menu_link_ico_active"] = "#c3e3fe";
$module_conf["menu_link_text_active"] = $module_conf["menu_link_ico_active"];
$module_conf["menu_link_arrow_active"] = $module_conf["menu_link_ico_active"];


$module_conf["submenu_link_ico"] = "#ffffff";
$module_conf["submenu_link_text"] = $module_conf["submenu_link_ico"];
$module_conf["submenu_link_arrow"] = $module_conf["submenu_link_ico"];

$module_conf["submenu_link_ico_over"] = "#feffcb";
$module_conf["submenu_link_text_over"] = $module_conf["submenu_link_ico_over"];
$module_conf["submenu_link_arrow_over"] = $module_conf["submenu_link_ico_over"];

$module_conf["submenu_link_ico_over_active"] = "#b9d855";
$module_conf["submenu_link_text_over_active"] = $module_conf["submenu_link_ico_over_active"];
$module_conf["submenu_link_arrow_over_active"] = $module_conf["submenu_link_ico_over_active"];
*/
$smarty->assign("module_conf", $module_conf);

/*    */
//print_struc($menu);
//exit;
/**/