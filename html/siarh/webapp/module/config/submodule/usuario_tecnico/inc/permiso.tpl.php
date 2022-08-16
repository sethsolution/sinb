<?
//=========================================================================
//=Configuraci�n de Template para el modulo
//=========================================================================
$templateDir = "../../module/".$module."/submodule/".$smoduleName."/template/";
$smarty->assign("templateDirModule",$templateDir);

//$templateModule = $templateDir."template/template.tpl";
//$templateModuleForm = $templateDir."template/templateForm.tpl";
//$templateModuleAjax = $templateDir."template/templateAjax.tpl";

/**
 * Item Principal Proyecto adm. directa
**/

$templateItem = $subcontrol."/index.tpl";
$templateFormPermiso = $subcontrol."/itemFormTab.tpl";
$templateFormAsignacion = $subcontrol."/itemForm.tpl";

