<?
//=========================================================================
//= Configuración de Template para el modulo
//=========================================================================
use function GuzzleHttp\Psr7\str;

$templateDir = "../../module/".$module;

$smarty->assign("templateDirModule",$templateDir);

$templateModule = $templateDir."/template/template.tpl";
$templateModuleRegistro = $templateDir."/template/template_registro.tpl";
$templateModuleReg = $templateDir."/template/template_reg.tpl";
$templateModuleAjax = $templateDir."/template/templateAjax.tpl";


//$templateModulePrint = $templateDir."/template/templatePrint.tpl";

/**
 * Para menu del módulo
 */

$fontend_modulo = array();
//$menuTemplateDir = $templateDir."/template/frontend/";
$menuTemplateDir = "";

$fontend_modulo["left_aside"] = "left_aside.tpl";
$smarty->assign("modulo_frontend_left_aside",$fontend_modulo["left_aside"] );


$fontend_modulo["modulo_menu_aside"] = "menu_aside.tpl";
$smarty->assign("modulo_frontend_menu_aside",$fontend_modulo["modulo_menu_aside"] );

$fontend_modulo["modulo_titulo_ayuda"] = "titulo_ayuda.tpl";
$smarty->assign("modulo_frontend_titulo_ayuda",$fontend_modulo["modulo_titulo_ayuda"] );


$fontend_modulo["modulo_header"] = "header_ingreso.tpl";

$smarty->assign("modulo_frontend_header",$fontend_modulo["modulo_header"] );
