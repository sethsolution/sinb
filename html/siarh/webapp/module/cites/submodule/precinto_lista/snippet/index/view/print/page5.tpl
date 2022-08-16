<div class="header_title2">DESEMBOLSOS</div>
<table>
    {if $desembolsos|@count gt 0}
    <tr>
        <td class="pregunta2" width="50%">Monto Fuente: &nbsp;</td>
        <td class="pregunta2">Monto Fuente en Bs.:</td>
    </tr>
    {assign var="monto" value="0"}
    {assign var="monto_bs" value="0"}
    {foreach from=$desembolsos item=fila}
        {$monto = $monto + $fila.monto}
        {$monto_bs = $monto_bs + $fila.monto_bs}
    {/foreach}
        <tr>
            <td class="respuesta2"><strong>{$monto|number_format:2:'.':','}</strong></td>
            <td class="respuesta2"><strong>{$monto_bs|number_format:2:'.':','}</strong></td>
        </tr>
    <br>
    {/if}
</table>
<table>
    {if $desembolsos|@count gt 0}
    <tr>
        <td class="pregunta2" style="width: 100px">Fecha: &nbsp;</td>
        <td class="pregunta2">Codigo/Numero:</td>
        <td class="pregunta2" style="width: 100px">Tipo Cambio: &nbsp;</td>
        <td class="pregunta2" style="width: 100px">Monto Fuente:</td>
        <td class="pregunta2" style="width: 100px">Monto Fuente en Bs.:</td>
    </tr>
    
        {foreach from=$desembolsos item=fila}
            <tr>
                <td class="respuesta2">{$fila.fecha|date_format}</td>
                <td class="respuesta2">{$fila.numero}</td>
                <td class="respuesta2">{$fila.tipo_cambio}</td>
                <td class="respuesta2">{$fila.monto|number_format:2:'.':','}</td>
                <td class="respuesta2">{$fila.monto_bs|number_format:2:'.':','}</td>
            </tr>
        {/foreach}
    {else}
        <tr><td colspan="5" class="respuesta2">No existe desembolsos realizados</td></tr>
    {/if}

    <br>
</table>