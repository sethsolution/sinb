<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN" "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head><title>Manager</title>
    <link rel="stylesheet" type="text/css" href="{$templateDir}style/top.css?id=32"/>
    <meta http-equiv="Content-Type" content="text/html; charset={#default_char_set#}"/>
    <script type="text/javascript" src="js/jquery/jquery-2.1.1.min.js"></script>
    <script type="text/javascript" src="js/jquery.idTabs.min.js"></script>

    {literal}
        <script type="text/javascript" language="Javascript">
            <!-- Begin
            //document.oncontextmenu = function(){return false}
            // End -->

            function optionMenu(module,id){
                parent.menu.getMenu(id);
                //parent.center.location="index.php?module="+module;
                parent.center.location="index.php?accion=menu_principal";
            }
            function home(){
                parent.menu.getMenu(0);
                parent.center.location="index.php?accion=menu_principal";
            }
        </script>
    {/literal}

</head>
<body>
<div class="printTop">
    <table width="100%" cellspacing="0" cellpadding="0" border="0">
        <tr><td valign="top" class="top" height="38">
                <table cellspacing="0" cellpadding="0" width="99%">
                    <tr>
                        {if $snir}
                            <td class="menuLogo" height="38"></td>
                        {else}
                            <td class="sirh_menuLogo" style="height:38;"><img src="{$templateDir}/sirh/images/menu/logoTop.png"
                                                                              width="168" height="38" /></td>
                        {/if}
                        <td align="center">&nbsp;</td>
                        <td valign="bottom" nowrap="nowrap">
                            <div id="pettabs" class="indentmenu">
                                <ul><li>
                                        <a href="#t01" onclick="home();" class="selected">
                                            <img src="{$templateDir}images/icon/0.png" align="left" /> &nbsp; Inicio</a></li>
                                    {section name=i loop=$item}
                                        <li><a href="#t02" onclick="optionMenu('{$item[i].carpeta}',{$item[i].itemId});" >
                                                <img src="{$templateDir}images/icon/{$item[i].itemId}.png?id=7" align="left" />
                                                &nbsp;{$item[i].titulo}</a></li>
                                    {/section}
                                </ul>
                                <br style="clear: left" />
                            </div>

                            <div id="t01"></div>
                            <div id="t02"></div>

                            <script type="text/javascript">
                                $("#pettabs ul").idTabs();
                            </script></td>

                        <td align="right" >
                            <img src="{$dirPhoto}" />
                            Usuario: <b>{$user}</b>
                            <img src="{$templateDir}images/icon/logout2.png" />
                            <a href="index.php?action=close" target="_top" class="cerrar">Cerrar Sesion</a></td></tr>
                </table>

            </td></tr>
        <tr><td class="menuBar" height="5" align="right"><img src="{$templateDir}images/sp.gif" /></td></tr>
    </table>
</div>
</body></html>