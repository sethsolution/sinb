<header>
    <table>
        <tr>
            <td class="logo"><img src="{$path_image}pdf/logo_mmaya.png" height="60" /></td>
            <td class="">
                &nbsp;
            </td>

            <td class="header-resumen" style="width:15%;">
                <table>
                    <tr>
                        <td class="tabla-titulo-top">Nacional ID</td>
                        <td>{$item.nacional_id}</td>
                    </tr>
                    <tr>
                        <td class="tabla-titulo-top">Número de acta</td>
                        <td>{$item.numero_acta}</td>
                    </tr>
                </table>

            </td>
        </tr>
    </table>
</header>
<footer>
    <table>
        <tr>
            <td class="footer" style="width:35%;"> <span class="vicuna">VICUÑA</span>
                | Usuario:&nbsp;{$usuario.username|escape:"htmlall"}</td>
            <td class="pagina"><div class="page-number"></div></td>
            <td class="footer" style="width:35%;text-align:right;">Fecha impresi&oacute;n: {$dateprint|date_format:"%d/%m/%Y %H:%M:%S"}</td>
        </tr>
    </table>
</footer>