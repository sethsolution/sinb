<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN" "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <head>
        <title>SIARH</title>
        <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
        <link rel="shortcut icon" href="images/favicon.ico" type="image/vnd.microsoft.icon" />
        <link rel="icon" href="images/favicon.ico" type="image/vnd.microsoft.icon" />
        <link rel="stylesheet" type="text/css" href="{$templateDir}style/index.css?id=3d2"/>
        <script type="text/javascript" src="js/jquery/jquery-2.1.1.min.js"></script>
        {literal}
            <script type="text/javascript" language="Javascript">
                <!-- Begin
                document.oncontextmenu = function(){return false}
                // End -->
            </script>
        {/literal}
    </head>
<body>


{if $snir}
<div class="portada">
    {else}
    <div class="sirh_portada"><img src="{$templateDir}/sirh/images/portada.png" width="300" height="250" />
        {/if}
        <br />


    </div>


    <div style="text-align: center;">
        <img src="{$templateDir}images/boxy/alert.png" /><br/><br/>
        <a href="index.php?accion=2" target="_blank" class="boton" style="font-size: 15px; color:green; border: #0B84FA 3px solid !important; padding: 10px;">Probar Interfaz BETA v1.5</a>



        <br/>
        <br/>
    </div>

    <div id="pie">
        <br />
        &copy; 2014-2015 Viceministerio de Recursos H&iacute;dricos y Riego<br />
        SNIR / Manager v1.0.2, Sistema Nacional de Informaci&oacute;n de Riego
        <br />
        <a target="_blank" href="http://www.seth.com.bo/">www.seth.com.bo</a> |
        <a target="_blank" href="mailto:info@sethsolution.com">info@sethsolution.com</a> <br>
    </div>
    {*</div>*}


</body>
</html>