<header>
    <table>
        <tr>
            <td class="logo"><img src="{$path_image}pdf/logo_mmaya.png" height="60" /></td>
            <td class="">
                &nbsp;
            </td>

            <td class="" style="width:15%;">
                &nbsp;
            </td>
        </tr>
    </table>
</header>

<footer>
    <table>
        <tr>
            <td class="footer" style="width:35%;"> <span class="sinpreh">SINPRE</span>
                | Usuario:&nbsp;{$usuario.username|escape:"htmlall"}</td>
            <td class="pagina"><div class="page-number"></div></td>
            <td class="footer" style="width:35%;text-align:right;">Fecha impresi&oacute;n: {$dateprint|date_format:"%d/%m/%Y %H:%M:%S"}</td>
        </tr>
    </table>
</footer>