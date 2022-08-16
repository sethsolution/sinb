<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<head>
<title>SNIR - Manager - Sistema Nacional de Informaci&oacute;n de Riego</title>
<meta http-equiv="Cache-Control" content="no-cache" />
<meta http-equiv="Expires" content="-1" />
<meta http-equiv="Pragma" content="no-cache" /> 
<script src="js/jquery/jquery-2.1.3.min.js" type="text/javascript"></script>
<script type="text/javascript" src="js/jquery/jquery-migrate-1.2.1.min.js"></script>

<link rel="shortcut icon" href="images/favicon.ico" type="image/vnd.microsoft.icon" /> 
<link rel="icon" href="favicon.ico" type="image/vnd.microsoft.icon" />

<link rel="stylesheet" type="text/css" href="{$templateDir}style/login.css"/>
<script type='text/javascript' src='js/jquery.boxy/javascripts/jquery.boxy.js'></script>
<link rel="stylesheet" href="{$templateDir}style/boxy.css" type="text/css" />
<script type="text/javascript" src="js/md5.js"></script>
<script type="text/javascript" src="js/login.js"></script>
{literal}
<script type="text/javascript" language="Javascript">
<!-- Begin
//document.oncontextmenu = function(){return false}
// End -->
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
<div id="portada">
<div id="errormsg" style="visibility: hidden;"></div>
	<div id="menusys">
	{* Login de acceso *}
<div style="width:100%;height:70px;text-align:center;"><img width="200" height="70" src="{$templateDir}images/login/title.png" /></div>
{*Sistema de administración de portal Web*}

            <form id="login" action="" onsubmit="sendData();return false;">
			<table style="padding:0px; width:100%;">
			<tr>
				<td style="text-align:right;width:70px;">Usuario : </td>
				<td style="text-align:center;"><input type="text" id="user" 
                name="user" style="width:95%" class="inputText"/></td>
            </tr>
			<tr>
				<td style="text-align:right;">Contrase&ntilde;a :</td>
				<td style="text-align:center;"><input type="password" id="password" 
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

</div>
<div id="pie">
<br />
&copy; 2014-2015 Viceministerio de Recursos H&iacute;dricos y Riego<br />
SNIR / Manager v1.0.0, Sistema Nacional de Informaci&iacute;n de Riego
<br />
<a href="http://www.sethsolution.com/" target="_blank">www.sethsolution.com</a> | 
<a href="mailto:info@sethsolution.com" target="_blank">info@sethsolution.com</a> <br />
</div>
</div>

</body>
</html>