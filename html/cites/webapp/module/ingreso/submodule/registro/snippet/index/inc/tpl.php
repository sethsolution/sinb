<?
/**
 * configuración de los temas
 */
$templateDir = "";
$smarty->assign("templateDirModule",$templateDir);
/**
 * Item Principal Proyecto adm. directa
 **/
//$webm["index"] = $templateDir."index.tpl";
$webm["index"] = $templateDir."index.reg.tpl";
//$webm["index_js"] = $templateDir."index.js.tpl";
$webm["index_js"] = $templateDir."index.reg.js.tpl";

$template_folder = "verifica/";
$webm["verifica"] = $template_folder."index.tpl";
$webm["verifica_js"] = $template_folder."index.js.tpl";


/**
 * Para el correo electrónico
 */
$template_folder = "email/";
$webm["email"] = $template_folder."email_verifica.tpl";
$webm["email_valida"] = $template_folder."email_valida.tpl";