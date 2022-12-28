<header>
    <table>
      <tr>
          <td class="escudo header"><img src="{$templateDir}images/pdf/EscudoBolivia.png" width="130px" /></td>
          <td class="tituloHeader header">
              Ministerio de Medio Ambiente y Agua<br />
          </td>
          <td class="logo02 header"><img src="{$templateDir}images/pdf/MMAyA.jpg" width="120px" /></td>
      </tr>
    </table>
</header>
<footer>
    <table>
      <tr>
        <td style="width:35%;"> <span style="color:#0a6c99;"><b>{if $snir}SIARH{else}SIARH{/if} | Informacion de Convenio</b></span>
        | <b>Usuario:&nbsp;</b>{$userprint.username|escape:"htmlall"}</td>
        <td style="text-align:center;"><div class="page-number"></div></td>
        <td style="width:35%;text-align:right;"><b>Fecha y hora de impresi&oacute;n:&nbsp;</b> {$dateprint}</td>
      </tr>
    </table>
</footer>