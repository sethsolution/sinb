<?
//=========================================================================
//=Configuraci�n de Template para el modulo
//=========================================================================
$templateDir = "module/".$module;
$templateDir = "../../module/".$module;

$smarty->assign("templateDirModule",$templateDir);
$templateModule = $templateDir."/template/template.tpl";
$templateModuleForm = $templateDir."/template/templateForm.tpl";
$templateModuleAjax = $templateDir."/template/templateAjax.tpl";
$templateModulePrint = $templateDir."/template/templatePrint.tpl";
