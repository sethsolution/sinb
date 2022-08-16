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
$templateSmodule = $templateDir;
$templateIndex = "index.tpl";
$templateformdatosSistem = "datosSistema.tpl";
$templateformdatosPersonal = "datosPersonales.tpl";
$templateformdatosSecretaria = "datosSecretaria.tpl";
$templateformdatosPermisos = "datosPermisos.tpl";
$templateError = "errordato.tpl";

