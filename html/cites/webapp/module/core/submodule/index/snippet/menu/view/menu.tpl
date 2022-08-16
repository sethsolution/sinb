<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN" "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head><title>Manager</title>
    <link rel="stylesheet" type="text/css" href="{$templateDir}style/menuizq.css?id=234"/>
    <script type="text/javascript" src="js/jquery/jquery-2.1.1.min.js"></script>

    {literal}
        <script type="text/javascript" language="Javascript">
            <!-- Begin
            //document.oncontextmenu = function(){return false}
            // End -->

            var postData = "";
            var alertInit = false;
            var loginContainerInit = false;
            var style_1;
            //=======================================================
            function getMenu(id){
                $("#menuDatos").load("index.php",
                    {'id':id,'accion':'menu_izq'},
                    function(){
                        //alert("listo");
                    });
            }
            //=============================================
            //= Si da error al ingresar borrar los datos  =
            //= del formulario para poder entrar          =
            //=============================================
            function errorLogin(){
                formz = $("login");
                formz.password.value="";
            }
            //=======================================================
            //= GetInterface                                        =
            //=======================================================
            function getInterface(){
                recogerCss();
                new Ajax("index.php", {
                    method: "get",
                    data:"accion=getInterface",
                    update: $("prinContainer"),
                    evalScripts: true,
                    onComplete: function(){
                        principals.slideIn();
                    }
                }).request();
            }
        </script>
    {/literal}
</head>
<body>
{**
<table width="100%" height="100%" cellspacing="0" cellpadding="0">
<tr><td valign="top" style="padding-left:6px;">
 *}
<div id="menuDatos">&nbsp;</div>
{*
</td></tr>
</table>
</body> *}
</html>