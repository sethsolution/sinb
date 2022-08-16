<?
//=========================================================================
//=Configuraci�n de Template para el modulo
//=========================================================================
//echo "hola mundo".$templateDir."<br/>";
$templateDir = "../../module/".$module."/submodule/".$smoduleName."/template/";
$smarty->assign("templateDirModule",$templateDir);

//$templateModule = $templateDir."template/template.tpl";
//$templateModuleForm = $templateDir."template/templateForm.tpl";
//$templateModuleAjax = $templateDir."template/templateAjax.tpl";

/**
 * Item Principal
**/
$templateSmodule = $templateDir;
$templateModuleIndexa = "index.tpl";
$templateModuleFileExcel = "excelTemplate.tpl";


