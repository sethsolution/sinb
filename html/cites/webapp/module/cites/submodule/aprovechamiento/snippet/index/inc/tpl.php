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
$webm["item_index"] = $template_folder."index.tpl";
$webm["item_index_js"] = $template_folder."index.js.tpl";

$webm["sc_form"] = $template_folder."form/form.tpl";
$webm["sc_form_js"] = $template_folder."form/form.js.tpl";

/**
 * Impresión de pdf con dompdf
 */
$webm["item_print_index"] = $templateDir."print/index.tpl";

/**
 * Formulario de Sustitución
 */
$template_folder = "item/sustitucion/";
$webm["sustitucion_index"] = $template_folder."index.tpl";