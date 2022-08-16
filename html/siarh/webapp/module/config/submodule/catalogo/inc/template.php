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
 * Item Principal Proyecto adm. directa
**/
$templateSmodule = $templateDir;
$templateModuleCatalogoOrganigramaForm="item.tpl";
$templateModuleEntidadPadreForm="entidadPadre.tpl";
$templateModuleEntidadForm="item.tpl";


$templateIndex = "index.tpl";
$templateCatalogos = "tablas.tpl";
$templateDatos = "datos.tpl";
$templateForm = "itemForm.tpl";
