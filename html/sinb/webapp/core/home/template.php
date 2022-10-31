<?PHP

/**
 * Menu Principal
 **/
$frontend = array();





/**
 * Email Template Core
 */
$frontend["email_base"] = "email_core/"."email_base.tpl";
/**
 * Template base
 */
$tmBase = "base/";
$frontend["base"] = $tmBase."base.tpl";
$frontend["baseGeo"] = $tmBase."baseGeo.tpl";
$frontend["baseGeo2"] = $tmBase."baseGeo2.tpl";
$frontend["baseAjax"] = $tmBase."baseAjax.tpl";
$frontend["error_01"] = $tmBase."core_error_01.tpl";
$frontend["error_02"] = $tmBase."core_error_02.tpl";

$templateModule = $frontend["base"]; // por defecto

/**
 * Template para uso de Metronic 72X
 */
$tmBase = "frontend_core_72/";
$frontend["_page_loader"] =$tmBase."_page_loader.tpl";
$frontend["_header_mobile"] = $tmBase."_header_mobile.tpl";
$frontend["_aside"] = $tmBase."_aside.tpl";
$frontend["_header"] = $tmBase."_header.tpl";
$frontend["_subheader_v1"] = $tmBase."_subheader_v1.tpl";
$frontend["_footer"] = $tmBase."_footer.tpl";
$frontend["_quick_user"] = $tmBase."_quick_user.tpl";
$frontend["_quick_panel"] = $tmBase."_quick_panel.tpl";
$frontend["_scrolltop"] = $tmBase."_scrolltop.tpl";


$smarty->assign("frontend",$frontend);
/**
 * Marca
 */
$version = "0.1.0";
$smarty->assign("version",$version);