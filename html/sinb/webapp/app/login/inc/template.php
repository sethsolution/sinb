<?PHP
/**
 * Configuracion de template del modulo
 */

/**
 * For application menu
 */
$frontend_app = array();
$frontend_app["template"] = "template.tpl";

$menuTemplateDir = "frontend/";
$frontend_app["left_aside"] = $menuTemplateDir."left_aside.tpl";
$frontend_app["modulo_menu_aside"] = $menuTemplateDir."menu_aside.tpl";
$smarty->assign("frontend_app",$frontend_app);