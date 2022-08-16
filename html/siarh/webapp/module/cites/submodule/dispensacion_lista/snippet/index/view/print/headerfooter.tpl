
<header>
    <table style="border: none">
        <tr>
            <td class="escudo header"><img src="{$templateDir}images/pdf/escudo_cites.png" width="70px" /></td>
            <td class="tituloHeader header">
                1.<strong> CERTIFICADO DE DISPENSACIÓN</strong>
            </td>
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