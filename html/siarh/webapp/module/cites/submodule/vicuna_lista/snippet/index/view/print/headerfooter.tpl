{*
<header>
    <br><br><br><br>
    <table align="center">
        <tr><td class="titulo01">ESTADO PLURINACIONAL DE BOLIVIA</td></tr>
        <tr><td class="titulo01">SISTEMA ADMINISTRATIVO CITES </td></tr>
        <tr><td class="header_title"><strong>NOTIFICACIÓN DE INICIO TRÁMITE</strong></td></tr>
    </table>
</header>
*}
<header>
    <table>
        <tr>
            <td class="escudo header"><img src="{$path_image}pdf/logo.png" width="70px" /></td>
            <td class="tituloHeader header">
                ESTADO PLURINACIONAL DE BOLIVIA<br>
                SISTEMA ADMINISTRATIVO CITES
            </td>
            <td class="logo02 header"><img src="{$path_image}pdf/cites_logo.jpg" width="70px" /></td>
        </tr>
    </table>
</header>

<footer>
    <table>
        <tr>
            <td style="width:35%;font-size: 9px;"> <span style="color:#0a6c99;"><b>CITES BOLIVIA </b></span>
                | Usuario:&nbsp;{$usuario.usuario|escape:"htmlall"}</td>
            <td style="text-align:center;"><div class="page-number"></div></td>
            <td style="width:35%;text-align:right;font-size: 9px;"><b>Fecha y hora de impresi&oacute;n:&nbsp;</b> {$dateprint|date_format:"%d/%m/%Y %H:%M:%S"}</td>
        </tr>
    </table>
</footer>