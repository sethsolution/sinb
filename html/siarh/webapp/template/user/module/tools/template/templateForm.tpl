<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN" "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<html>
<head><title>Manager - Administrador de sistema de subastas On-Line</title>

<!--
<link rel="stylesheet" type="text/css" href="{$templateDir}style/sis.css"/>
<link rel="stylesheet" type="text/css" href="{$templateDir}style/web.css"/>
-->
<link rel="stylesheet" type="text/css" href="{$templateDir}style/portal.css"/>

<meta http-equiv="Cache-Control" content="no-cache" />
<meta http-equiv="Expires" content="-1" />
<meta http-equiv="Pragma" content="no-cache" />

<!--------------- Componente Jquery --------------->
<script type="text/javascript" src="js/jquery/jquery-1.3.2.min.js"></script>
<script type="text/javascript" src="js/jquery/jquery.form.js"></script>
<!--------------- Componente lightbox --------------->
<script type="text/javascript" src="js/lightbox/js/jquery.lightbox-0.5.js"></script>
<link rel="stylesheet" href="js/lightbox/css/jquery.lightbox-0.5.css" type="text/css" />
<!--------------- Componente Jquery --------------->
<script type='text/javascript' src='js/boxy/javascripts/jquery.boxy.js'></script>
<link rel="stylesheet" href="{$templateDir}style/boxy.css" type="text/css" />

<script type="text/javascript" src="js/tools.js"></script>

<!--------------- Componente Jquery SexyAlert --------------->
<script type="text/javascript" src="js/sexyAlert/jquery.easing.1.3.js"></script>
<script type="text/javascript" src="js/sexyAlert/sexyalertbox.v1.2.jquery.js"></script>
<link rel="stylesheet" type="text/css" media="all" href="js/sexyAlert/sexyalertbox.css"/>

<!--------------- Componente Jquery --------------->
<link rel="stylesheet" href="js/jquery/jquery-ui/development-bundle/themes/redmond/jquery.ui.all.css" />
<script src="js/jquery/jquery-ui/development-bundle/ui/jquery.ui.core.js"></script>
<script src="js/jquery/jquery-ui/development-bundle/ui/jquery.ui.widget.js"></script>
<script src="js/jquery/jquery-ui/development-bundle/ui/jquery.ui.accordion.js"></script>
<script src="js/jquery/jquery-ui/development-bundle/ui/jquery.ui.tabs.js"></script>
<style type="text/css" title="currentStyle">
	@import "js/DataTables/media/css/demo_page.css";
	@import "js/DataTables/media/css/demo_table_jui.css";
</style>
<script type="text/javascript" language="javascript" src="js/DataTables/media/js/jquery.dataTables.js"></script>
<!--------------- Componente Jquery --------------->
{literal}
<script type="text/javascript" language="Javascript"> 
<!-- Begin
//document.oncontextmenu = function(){return false}
// End -->
</script>
<script type="text/javascript">
    $(function() {
        $('a.lightbox').lightBox({fixedNavigation:true});
    });
</script>
{/literal}

<script type="text/javascript" src="js/jquery.idTabs.min.js"></script>

</head>
<body>

{include file="$subpage"}


</body></html>