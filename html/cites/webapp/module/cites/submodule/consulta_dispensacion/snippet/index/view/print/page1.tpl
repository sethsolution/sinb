<div class="titulo01">Ficha - Convenio ({$programa.sigla})</div>
<div class="titulo01"><small><i>({$programa.nombre})</i></small></div>
<table>
  <tr>
    <td>&nbsp;</td>
    <td style="width:80px;" class="pregunta2">Estado</td>
    <td style="width:80px;" class="pregunta2">Código Prog.</td>
  </tr>
  <tr>
      <td class="">&nbsp;</td>
      <td class="respuesta2">{$convenio.estado}</td>
      <td class="respuesta2"><strong>{$convenio.codigo}</strong></td>
  </tr>
</table>
<div class="header_title6">DATOS DEL PROGRAMA</div>
<table>
    <tr>
        <td class="pregunta" width="15%">Nombre: &nbsp;</td>
        <td class="respuesta" colspan="3">{$programa.nombre}</td>
    </tr>
    <tr>
        <td class="pregunta" width="15%">Sigla: &nbsp;</td>
        <td class="respuesta">{$programa.sigla}</td>
        <td class="pregunta" width="15%">Fecha Registro: &nbsp;</td>
        <td class="respuesta">{$programa.fecha_registro|date_format}</td>
    </tr>
    <tr>
        <td class="pregunta">Norma: &nbsp;</td>
        <td class="respuesta">{$programa.norma}</td>
        <td class="pregunta">Departamentos: &nbsp;</td>
        <td class="respuesta">{foreach from=$deptos item=fila}{$fila.departamento} &nbsp;&nbsp;{/foreach}</td>
    </tr>  
    <tr>
        <td class="pregunta">Observaciones: &nbsp;</td>
        <td class="respuesta" colspan="3">{$programa.observaciones}</td>
    </tr>
    <br>
</table>
<div class="header_title2">INFORMACION SECTORIAL</div>
<table>
    <tr>
        <td class="pregunta2">INFORMACION SECTORIAL</td>
    </tr>
    {if $rowsectorial|@count > 0}
        {foreach from=$rowsectorial item=rows}
            <tr>
                <td class="sector"><strong>{$rows.sector}</strong></td>
            </tr>
            {foreach from=$sectorial item=fila}
                {if $rows.sector == $fila.sector}
                <tr>
                    <td class="subsector" style="margin-left: 15px" >&nbsp;&nbsp;&nbsp;- &nbsp;&nbsp;{$fila.subsector}</td>
                </tr>
                {/if}
            {/foreach}
        {/foreach}
    {else}
        <tr><td colspan="2" class="respuesta2">No existe registro</td></tr>
    {/if}
    <br>
</table>