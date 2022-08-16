<?PHP
//=========================================================================
//= Configuración de Template para el modulo
//=========================================================================
$templateDir = "../../module/".$module;
$templateDirPrint = $templateDir."/submodule/".$smoduleName."/snippet/";

$smarty->assign("templateDirModule",$templateDir);
$smarty->assign("templateDirModulePrint",$templateDirPrint);

$templateModule = $templateDir."/template/template.tpl";
$templateModuleAjax = $templateDir."/template/templateAjax.tpl";
$templateModulegeo = $templateDir."/template/template.geo.tpl";
//$templateModulePrintPage = $templateDirPrint."index/print/index.tpl";

/**
 * Para menu del módulo
 */

$fontend_modulo = array();
$menuTemplateDir = "/template/frontend/";

$fontend_modulo["left_aside"] = "left_aside.tpl";
$smarty->assign("modulo_frontend_left_aside",$fontend_modulo["left_aside"] );


$fontend_modulo["modulo_menu_aside"] = "menu_aside.tpl";
$smarty->assign("modulo_frontend_menu_aside",$fontend_modulo["modulo_menu_aside"] );

$fontend_modulo["modulo_titulo_ayuda"] = "titulo_ayuda.tpl";
$smarty->assign("modulo_frontend_titulo_ayuda",$fontend_modulo["modulo_titulo_ayuda"] );

/**
 * Para el header
 */

$fontend_modulo["header"] = "header.tpl";
$smarty->assign("module_frontend_header",$fontend_modulo["header"] );

$fontend_modulo["brand"] = "brand.tpl";
$smarty->assign("module_frontend_brand",$fontend_modulo["brand"] );

$fontend_modulo["menu_horizontal"] = "menu_horizontal.tpl";
$smarty->assign("module_frontend_menu_horizontal",$fontend_modulo["menu_horizontal"] );

$fontend_modulo["topbar"] = "topbar.tpl";
$smarty->assign("module_frontend_topbar",$fontend_modulo["topbar"] );