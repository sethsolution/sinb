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
<script type="text/javascript" src="js/jquery/jquery-1.8.2.min.js"></script>
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
<!--<link rel="stylesheet" type="text/css" href="js/submodal/subModal.css" />
<script type="text/javascript" src="js/submodal/common.js"></script>
<script type="text/javascript" src="js/submodal/subModal.js"></script>-->
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
</head>
<body>

{include file="$subpage"}


</body></html>