<?PHP
/**
 * Application template configuration
 */

/**
 * For application menu
 */

$frontend_app = array();
$menuTemplateDir = "frontend/";
$frontend_app["left_aside"] = $menuTemplateDir."left_aside.tpl";
$frontend_app["modulo_menu_aside"] = $menuTemplateDir."menu_aside.tpl";
$smarty->assign("frontend_app",$frontend_app);