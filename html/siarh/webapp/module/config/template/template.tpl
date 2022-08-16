<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN" "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head><title>Manager</title>
<meta http-equiv="Cache-Control" content="no-cache" />
<meta http-equiv="Expires" content="-1" />
<meta http-equiv="Pragma" content="no-cache" />
{*=========================
    Jquery
  =========================*}
<script type="text/javascript" src="js/jquery/jquery-2.1.1.min.js"></script>
<script type="text/javascript" src="js/jquery/jquery-migrate-1.2.1.js"></script>
<script type="text/javascript" src="js/jquery/jquery.form.min.js"></script>
{*=========================
    Jquery UI
  =========================*}
<link rel="stylesheet" href="js/jquery/jquery-ui/development-bundle/themes/redmond/jquery.ui.all.css" />
<script src="js/jquery/jquery-ui/js/jquery-ui-1.10.4.custom.min.js"></script>
{*=========================
    boxy para Loading
  =========================*}
<script type='text/javascript' src='js/boxy/javascripts/jquery.boxy.js'></script>
<link rel="stylesheet" href="{$templateDir}style/boxy.css" type="text/css" />
<script type="text/javascript" src="js/tools.js?id=2323"></script>
{*=========================
    Msg Box
  =========================*}
<link rel="stylesheet" href="js/jquery.msgbox/javascript/msgbox/jquery.msgbox.css" type="text/css" />
<script type="text/javascript" src="js/jquery.msgbox/javascript/msgbox/jquery.msgbox.min.js"></script>
{*=========================
    DataTable
  =========================*}
<script type="text/javascript" src="js/DataTables/media/js/jquery.dataTables.min.js"></script>
{*=========================
    CHOSEN JQUERY
  =========================*}
<link rel="stylesheet" href="js/chosen/chosen.min.css" />
<script type="text/javascript" src="js/chosen/chosen.jquery.min.js"></script>

<!--<link rel="stylesheet" href="js/DataTables/media/css/jquery-ui.css" />
<link rel="stylesheet" href="js/DataTables/media/css/dataTables.jqueryui.css" />-->
<style type="text/css" title="currentStyle">
    @import "js/DataTables/media/css/jquery.dataTables_themeroller.css";
</style>
{*=========================
    Jquery Layout
  =========================*}
<script type="text/javascript" src="js/jquery.layout/debug.js"></script>
<script type="text/javascript" src="js/jquery.layout/jquery.layout-latest.min.js"></script>
<script type="text/javascript" src="js/jquery.layout/jquery.layout.resizeDataTable.min-1.0.js"></script>
<link rel="stylesheet" type="text/css" href="{$templateDir}style/layout-custom.css"/>
{*=========================
    Estilo Sistema en General
  =========================*}
<link rel="stylesheet" type="text/css" href="{$templateDir}style/portal.css"/>
{literal}
<script type="text/javascript" language="Javascript">
<!-- Begin
//document.oncontextmenu = function(){return false}
// End -->
</script>
{/literal}
</head>
<body>
{include file="$subpage"}
{*Ventana Modal*}
{*Fin Ventana Modal*}
</body></html>