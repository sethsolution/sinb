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
 * catalogo_geofisica_dev_config
 **/
$webm["geofisicaDevConfig_index"] = "geofisicaDevConfig_index.tpl";
$webm["geofisicaDevConfig_index_js"] = "geofisicaDevConfig_index.js.tpl";

/*------------------------------------------------------------------------------*/
/**
 * Construcción del formularios y otros
 */
$template_folder = "item/";
$webm["item_index"] = $template_folder."index.tpl";
$webm["item_index_js"] = $template_folder."index.js.tpl";

/**
 * catalogo_geofisica_dev_config
 **/
$template_folder = "geofisicaDevConfig_item/";
$webm["geofisicaDevConfig_item_index"] = $template_folder."index.tpl";
$webm["geofisicaDevConfig_item_index_js"] = $template_folder."index.js.tpl";