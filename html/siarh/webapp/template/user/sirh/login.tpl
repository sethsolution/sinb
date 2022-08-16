<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN" "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>SIRH - Sistema de Informaci&oacute;n de Recursos H&iacute;dricos</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />



<link rel="apple-touch-icon" sizes="180x180" href="/favicon/apple-touch-icon.png">
<link rel="icon" type="image/png" href="/favicon/favicon-32x32.png" sizes="32x32">
<link rel="icon" type="image/png" href="/favicon/favicon-16x16.png" sizes="16x16">
<link rel="manifest" href="/favicon/manifest.json">
<link rel="mask-icon" href="/favicon/safari-pinned-tab.svg" color="#5bbad5">
<meta name="theme-color" content="#ffffff">


<!--
<link rel="shortcut icon" href="images/favicon.ico" type="image/vnd.microsoft.icon" /> 
<link rel="icon" href="favicon.ico" type="image/vnd.microsoft.icon" />
-->
<script type="text/javascript" src="js/jquery/jquery-2.1.1.min.js"></script>
<!--
<script type="text/javascript" src="//ajax.googleapis.com/ajax/libs/jquery/2.0.0/jquery.min.js"></script>
-->
<script type="text/javascript" src="js/jquery/jquery-migrate-1.2.1.min.js" ></script>

<script type="text/javascript" src="js/vegas/dist/jquery.vegas.min.js" ></script>
<link rel="stylesheet" type="text/css" href="js/vegas/dist/jquery.vegas.min.css"/>

<link rel="stylesheet" type="text/css" href="{$templateDir}sirh/style/login.css?id=32"/>
<script type='text/javascript' src='js/jquery.boxy/javascripts/jquery.boxy.js'></script>
<link rel="stylesheet" href="{$templateDir}style/boxy.css" type="text/css" />
<script type="text/javascript" src="js/md5.js"></script>

<script type="text/javascript" src="js/login.js"></script>

{literal}
<script type='text/javascript'>
$(document).ready(function () {
    $.vegas('slideshow', {
    backgrounds:[
        { src:'{/literal}{$templateDir}{literal}sirh/images/login/fondo/00.jpg?id=32', fade:500 },
        { src:'{/literal}{$templateDir}{literal}sirh/images/login/fondo/01.jpg?id=32', fade:500 },
        { src:'{/literal}{$templateDir}{literal}sirh/images/login/fondo/02.jpg?id=32', fade:500 },
        { src:'{/literal}{$templateDir}{literal}sirh/images/login/fondo/04.jpg?id=32', fade:500 },
        { src:'{/literal}{$templateDir}{literal}sirh/images/login/fondo/03.jpg?id=32', fade:500 }
    ]
    });
    $.vegas('overlay', {
        src:'js/vegas/dist/overlays/07.png'
    });
});
</script>
<script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-62483734-1', 'auto');
  ga('send', 'pageview');

</script>

<script language="JavaScript">
if (top.location != location) {
top.location = location;
};
</script>
{/literal}
</head>
<body>
	<div id="loginPage">
	{* Login de acceso *}
    <div style="width:100%;height:70px;text-align:center;"><img width="200" height="70" 
src="{$templateDir}sirh/images/login/login_titulo.png?id=32" /></div>
    {*Sistema de administraci�n de portal Web*}

            <form id="login" action="" onsubmit="sendData();return false;" method="post">
			<table style="padding:0px; width:100%;">
			<tr>
				<td style="text-align:right;width:70px;">Usuario : </td>
				<td style="text-align:center;"><input type="text" id="user" 
                name="user" style="width:95%" class="inputText"/></td>
            </tr>
			<tr>
				<td style="text-align:right;">Contrase&ntilde;a :</td>
				<td style="text-align:center;"><input type="password" id="password" autocomplete="off"
                name="password" style="width:95%" class="inputText"/></td>
            </tr>
			<tr>
				<td style="text-align:right;" colspan="2">
				<input type="submit" class="submit" name="Ingresar" value="Entrar"/>
                </td>
            </tr>
			</table>
            </form>
    {* Fin Login de acceso *}
	</div>
    <div id="errormsg" style="visibility: hidden;"></div>

<div id="pie">
<br />
&copy; 2015-2016 Viceministerio de Recursos H&iacute;dricos y Riego<br />
SIRH v1.0.2, Sistema de Informaci&oacute;n de Recursos H&iacute;dricos <br />
Ministerio de Medio Ambiente y Agua<br />
 <br />

<a target="_blank" href="https://www.facebook.com/pages/Viceministerio-de-Recursos-Hidricos-y-Riego/563287193771389"><img width="30" height="30"
src="{$templateDir}sirh/images/login/icon/facebook.png?id=32" 
title="Viceministerio de Recursos H&iacute;dricos y Riego" /></a>

<a target="_blank" href="https://www.facebook.com/pages/Viceministerio-de-Recursos-Hidricos-y-Riego/563287193771389"><img width="30" height="30" 
src="{$templateDir}sirh/images/login/icon/twitter.png?id=32" 
title="Viceministerio de Recursos H&iacute;dricos y Riego"/></a>

<a target="_blank" href="https://www.facebook.com/pages/Viceministerio-de-Recursos-Hidricos-y-Riego/563287193771389"><img width="30" height="30" 
src="{$templateDir}sirh/images/login/icon/google.png?id=32" 
title="Viceministerio de Recursos H&iacute;dricos y Riego"/></a>
 
<!--
<br />
<a href="http://www.sethsolution.com/" target="_blank">www.sethsolution.com</a> | 
<a href="mailto:info@sethsolution.com" target="_blank">info@sethsolution.com</a> <br />
-->
</div>
</div>

</body>
</html>