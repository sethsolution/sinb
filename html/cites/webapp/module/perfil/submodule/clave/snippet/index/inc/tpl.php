<?
/**
 * configuración de los temas
 */
$templateDir = "../.".$path_sbm_snippet_index."view/";
$smarty->assign("templateDirModule",$templateDir);
/**
 * Item Principal Proyecto adm. directa
 **/
$webm["index"] = "index.tpl";
$webm["index_js"] = "index.js.tpl";

/**
 * Construcción del formularios y otros
 */
$template_folder = "item/";
$webm["item_index"] = $templateDir.$template_folder."index.tpl";
$webm["item_index_js"] = $templateDir.$template_folder."index.js.tpl";

