<?php

//$templateDirCore = "../../module/core/submodule/index/template/";
$templateDirCore = "../../module/core/template/";
//$smarty->assign("templateDirModule",$templateDir);

/**
 * Menu Principal
 **/
//$templateSmoduleCore = $templateDirCore."frontend_core/";
$templateSmoduleCore = "";

$frontend = array();
$frontend["menu_horizontal"] = $templateSmoduleCore."core_menu_horizontal.tpl";
$smarty->assign("frontend_menu_horizontal",$frontend["menu_horizontal"] );

$frontend["topbar"] = $templateSmoduleCore."core_topbar.tpl";
$smarty->assign("frontend_topbar",$frontend["topbar"] );

$frontend["topbar_msg"] = $templateSmoduleCore."core_topbar_msg.tpl";
$smarty->assign("frontend_topbar_msg",$frontend["topbar_msg"] );

$frontend["brand"] = $templateSmoduleCore."core_brand.tpl";
$smarty->assign("frontend_brand",$frontend["brand"] );

$frontend["header"] = $templateSmoduleCore."core_header.tpl";
$smarty->assign("frontend_header",$frontend["header"] );

$frontend["menu_aside"] = $templateSmoduleCore."core_menu_aside.tpl";
$smarty->assign("frontend_menu_aside",$frontend["menu_aside"] );

$frontend["left_aside"] = $templateSmoduleCore."core_left_aside.tpl";
$smarty->assign("frontend_left_aside",$frontend["left_aside"] );

$frontend["footer"] = $templateSmoduleCore."core_footer.tpl";
$smarty->assign("frontend_footer",$frontend["footer"] );

$frontend["error_01"] = $templateSmoduleCore."core_error_01.tpl";
$smarty->assign("frontend_error_01",$frontend["error_01"] );

$smarty->assign("frontend",$frontend);
//$smarty->debugging =true;

/**
 * Marca
 */

$marca='2018 &copy; <a href="https://www.sirh.gob.bo" class="m-link">SIARH </a> - Ministerio de Medio Ambiente  y Agua ';
$version = "1.5.0 (beta)";
$smarty->assign("marca",$marca);
$smarty->assign("version",$version);