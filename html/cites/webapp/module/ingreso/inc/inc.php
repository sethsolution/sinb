<?
/**
 * Include de clase general
 */
/*
include_once($pathmodule . "classes/class.modulo_core.php");
$modulo_core = new Modulo_Core();
*/
$accion_path = $pathmodule."inc/accion.path.php";
include_once($accion_path);
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