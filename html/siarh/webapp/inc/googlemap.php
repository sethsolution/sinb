<?PHP
$CFG->googlemap["key"] = "";
$CFG->googlemap["url"] = "https://maps.googleapis.com/maps/api/js?";
$CFG->googlemap["url_key"] = $CFG->googlemap["url"]."key=".$CFG->googlemap["key"];
$smarty->assign('googlemap_api',$CFG->googlemap["url_key"]);