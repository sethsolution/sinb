<div id="header">
<table>
<tr>
    <td class="escudo"><img src="{$templateDir}images/pdf/EscudoBolivia.png" width="130px" /></td>
    <td class="tituloHeader">
        Ministerio de Medio Ambiente y Agua <br />
        Viceministerio de Recursos H&iacute;dricos y Riego<br />
         
    </td>
    <td class="logo02"><img src="{$templateDir}images/pdf/MMAyA.jpg" width="120px" /></td>
</tr>
</table>  
</div>

<div id="footer">
  <table>
    <tr>
      <td style="width:35%;"> <span style="color:#0a6c99;"><b>SNIR</b></span> | <b>Usuario:&nbsp;</b>
      {$userprint.username|escape:"htmlall"}</td>
      <td style="text-align:center;">{<div class="page-number"></div>} </td>
      <td style="width:35%;text-align:right;"><b>Fecha y hora de impresi&oacute;n:&nbsp;</b> {$dateprint}</td>
    </tr>
  </table>
</div>