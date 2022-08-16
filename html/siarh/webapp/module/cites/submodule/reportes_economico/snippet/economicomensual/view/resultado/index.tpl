{include file="resultado/index.css.tpl"}
{*
<div class="m-portlet__head">
    <div class="m-portlet__head-caption">
        <div class="m-portlet__head-title">
            <h4 class="m--font-success">Llenado de requisitos</h4>
        </div>
    </div>
</div>
*}
<div class="m-portlet m--padding-bottom-5" >
    <div class="m-portlet__body m--padding-bottom-5 m--padding-top-5">
        <table class="table table-striped table-bordered table-hover table-checkable
        table-sm m-table m-table--head-bg-success {*m--hide*}" id="tabla_{$subcontrol}">
            <thead>

            <tr>
                <th rowspan="2" class="cabecera">Fecha de emisión</th>
                <th rowspan="2" class="cabecera">Nro. de certificado</th>
                <th rowspan="2" class="cabecera">Nombre de exportador</th>
                <th rowspan="2" class="cabecera">Monto (Bs)</th>
                <th rowspan="2" class="cabecera">Fecha Boleta de Pago</th>
                <th rowspan="2" class="cabecera">Nro. de Boleta de Pago</th>
                <th rowspan="2" class="cabecera">Estado</th>
                <th rowspan="2" class="cabecera">Observaciones</th>
            </tr>
            </thead>
            <tbody>
            {foreach from=$lista item=row key=idx}
                <tr>
                    <td>{if $row.emitido_fecha}{$row.emitido_fecha|date_format:'%d/%m/%Y'}{/if}</td>
                    <td>{$row.numero_certificado}</td>
                    <td>{$row.nombre_exportador}</td>
                    <td>{$row.monto}</td>
                    <td>{$row.fecha_pago}</td>
                    <td>{$row.numero_boleta}</td>
                    <td>{$row.estado}</td>
                    <td>{$row.observacion}</td>
                    {*<td>obs</td>*}
                </tr>
            {/foreach}
            </tbody>
            <tfoot></tfoot>
        </table>
    </div>
</div>
{include file="resultado/index.js.tpl"}