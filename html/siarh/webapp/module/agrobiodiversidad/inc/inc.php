<?
/**
 * Include de clase general
 */
include_once($pathmodule."classes/class.modulo_core.php");
$modulo_core = new Modulo_Core();

/**
 * Configuraciones del módulo
 */
$module_conf = array();

/**
 * Textos
 */
$module_conf["btn_inicio"]="Inicio Agrobiodiversidad";
$module_conf["btn_inicio_principal"]="Volver a SIARH";
$module_conf["menu_titulo"]="Sistema de Información de Agrobiodiversidad";
$module_conf["dashboard_titulo"]="Sistema de Información de Agrobiodiversidad";

/**
 * colores
 */
$module_conf["menu_bgcolor"] = "#2c2e3e";
$module_conf["menu_bgcolor_logo"] = "#202233";
$module_conf["menu_bgcolor_over"] = "#17518e";
$module_conf["menu_bgcolor_active"] = "#363954";

/*
$module_conf["menu_link_ico"] = "#ffffff";
$module_conf["menu_link_text"] = $module_conf["menu_link_ico"];
$module_conf["menu_link_arrow"] = $module_conf["menu_link_ico"];

$module_conf["menu_link_ico_over"] = "#29aef6";
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