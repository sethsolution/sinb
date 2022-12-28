<?php
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
$webm["tabla_resumen_index"] = $templateDir."tabla_resumen/index.tpl";

// $template_folder_lista = "lista/";
// $webm["lista_index"] = $template_folder_lista."lista.tpl";
// $webm["lista_index_js"] = $template_folder_lista."lista.js.tpl";