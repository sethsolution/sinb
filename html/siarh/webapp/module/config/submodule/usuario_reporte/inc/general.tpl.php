<?
//=========================================================================
//=Configuración de Template para el modulo
//=========================================================================
$templateDir = "../../module/".$module."/submodule/".$smoduleName."/template/";
$smarty->assign("templateDirModule",$templateDir);

//$templateModule = $templateDir."template/template.tpl";
//$templateModuleForm = $templateDir."template/templateForm.tpl";
//$templateModuleAjax = $templateDir."template/templateAjax.tpl";

/**
 * Item Principal Proyecto adm. directa
**/

$templateTabla = $subcontrol."/tabla.tpl";
$templateGrafica = $subcontrol."/grafica.tpl";
$templateGraficaItem = $subcontrol."/grafica.item.tpl";

