<div class="header_title6">RESUMEN</div>
<table>
    <tr>
        <td class="pregunta" width="30%">Monto Fuente: &nbsp; <small><i>Moneda del convenio</i></small></td>
        <td class="datos2" width="20%">{$totales.monto|number_format:2:'.':','}</td>
        <td class="pregunta" width="30%">Monto Fuente (Bs.): &nbsp; <small><i>En Bolivianos</i></small></td>
        <td class="datos2">{$totales.monto_bs|number_format:2:'.':','}</td>
    </tr>
    <tr>
        <td class="pregunta">Monto APL: &nbsp; <small><i>Moneda del convenio</i></small></td>
        <td class="datos2">{$totales.monto_apl|number_format:2:'.':','}</td>
        <td class="pregunta">Monto APL (Bs.): &nbsp; <small><i>En Bolivianos</i></small></td>
        <td class="datos2">{$totales.monto_apl_bs|number_format:2:'.':','}</td>
    </tr>
    <tr>
        <td class="pregunta">Monto Total: &nbsp; <small><i>Moneda del convenio</i></small></td>
        <td class="datos2">{$totales.monto_total|number_format:2:'.':','}</td>
        <td class="pregunta">Monto Total (Bs.): &nbsp; <small><i>En Bolivianos</i></small></td>
        <td class="datos2">{$totales.monto_total_bs|number_format:2:'.':','}</td>
    </tr>  
    <br>
</table>

<div class="header_title2">COMPONENTE / SUBCOMPONENTES</div>
<table>
    <tr>
        <td class="pregunta2">SubComponente: &nbsp;</td>
        <td class="pregunta2" width="7%">Tipo Cambio</td>
        <td class="pregunta2" width="10%">Monto Convenio</td>
        <td class="pregunta2" width="10%">Monto Convenio Bs</td>
        <td class="pregunta2" width="10%">Monto APL</td>
        <td class="pregunta2" width="10%">Monto APL Bs</td>
        <td class="pregunta2" width="10%">Monto Total</td>
        <td class="pregunta2" width="10%">Monto Total Bs</td> 
    </tr>
    {foreach from=$row item=rows}
        <tr>
            <td class="componente" colspan="8"><strong>{$rows.componente}</strong></td>
        </tr>
        {assign var="monto" value="0"}
        {assign var="monto_bs" value="0"}
        {assign var="monto_apl" value="0"}
        {assign var="monto_apl_bs" value="0"}
        {assign var="monto_total" value="0"}
        {assign var="monto_total_bs" value="0"}

        {foreach from=$subcomponentes item=fila}
            {if $rows.componente == $fila.convenio_componente_id}
            <tr>
                <td class="subcomponente" style="margin-left: 15px" >{$fila.nombre}</td>
                <td class="datos">{$fila.tipo_cambio}</td>
                <td class="datos">{$fila.monto|number_format:2:'.':','}</td>
                <td class="datos">{$fila.monto_bs|number_format:2:'.':','}</td>
                <td class="datos">{$fila.monto_apl|number_format:2:'.':','}</td>
                <td class="datos">{$fila.monto_apl_bs|number_format:2:'.':','}</td>
                <td class="datos">{$fila.monto_total|number_format:2:'.':','}</td>
                <td class="datos">{$fila.monto_total_bs|number_format:2:'.':','}</td>
            </tr>
            {$monto = $monto + $fila.monto}
            {$monto_bs = $monto_bs + $fila.monto_bs}
            {$monto_apl = $monto_apl + $fila.monto_apl}
            {$monto_apl_bs = $monto_apl_bs + $fila.monto_apl_bs}
            {$monto_total = $monto_total + $fila.monto_total}
            {$monto_total_bs = $monto_total_bs + $fila.monto_total_bs}
            {/if}
        {/foreach}
            <tr>
                <td class="totales" colspan="2"><strong>TOTALES</strong></td>
                <td class="totales">{$monto|number_format:2:'.':','}</td>
                <td class="totales">{$monto_bs|number_format:2:'.':','}</td>
                <td class="totales">{$monto_apl|number_format:2:'.':','}</td>
                <td class="totales">{$monto_apl_bs|number_format:2:'.':','}</td>
                <td class="totales">{$monto_total|number_format:2:'.':','}</td>
                <td class="totales">{$monto_total_bs|number_format:2:'.':','}</td>
            </tr>
            
    {/foreach}
    <br>
</table>