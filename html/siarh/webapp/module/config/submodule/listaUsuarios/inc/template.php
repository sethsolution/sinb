<?
//=========================================================================
//=Configuración de Template para el modulo
//=========================================================================
$templateDir = "../../module/".$module."/submodule/".$smoduleName."/template/";
//$templateDir = "../../module/".$module;

$smarty->assign("templateDirModule",$templateDir);
//$templateModule = $templateDir."template/template.tpl";
//$templateModuleForm = $templateDir."template/templateForm.tpl";
//$templateModuleAjax = $templateDir."template/templateAjax.tpl";
/**
 * Item Principal Proyecto adm. directa
**/
$templateSmodule = $templateDir;
$templateIndex = "index.tpl";
$templateItem = "item.tpl";
$templateTab01 = "tab01/list.tpl";

$templateModulePrintPage = "print/index.tpl";
