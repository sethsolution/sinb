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
                <th rowspan="2" class="cabecera">Nº  de Certificado</th>
                <th rowspan="2" class="cabecera">Fecha de emision de certificado CITES</th>
                <th rowspan="2" class="cabecera">Nº de Boleta</th>
                <th rowspan="2" class="cabecera">Fecha de deposito</th>
                <th rowspan="2" class="cabecera">Nombre (Exportador)</th>
                <th rowspan="2" class="cabecera">Nombre de Empresa (Importador) </th>
                <th rowspan="2" class="cabecera">Pais de Destino</th>
                <th colspan="2" class="cabecera">Producto</th>
                <th rowspan="2" class="cabecera">Proposito</th>
                <th rowspan="2" class="cabecera">Origen</th>
                <th rowspan="2" class="cabecera">Descripción</th>
                <th rowspan="2" class="cabecera">Cantidad</th>
                <th rowspan="2" class="cabecera">Unidad</th>
                <th rowspan="2" class="cabecera">Monto (bs)</th>
                <th rowspan="2" class="cabecera">Monto ($us)</th>
            </tr>
            <tr>
                <th class="cabecera">Nombre común</th>
                <th class="cabecera">Nombre cientifico </th>
            </tr>
            </thead>
            <tbody>
            {foreach from=$lista item=row key=idx}
                <tr>
                    <td>{$row.numero_certificado}</td>
                    <td>{if $row.emitido_fecha}{$row.emitido_fecha|date_format:'%d/%m/%Y'}{/if}</td>
                    <td>{$row.numero_boleta}</td>
                    <td>{if $row.fecha_pago}{$row.fecha_pago|date_format:'%d/%m/%Y'}{/if}</td>
                    <td>{$row.exportador}</td>
                    <td>{$row.importador}</td>
                    <td>{$row.pais_destino}</td>
                    <td>{$row.nombre_comun}</td>
                    <td>{$row.nombre_cientifico}</td>
                    <td>{$row.proposito}</td>
                    <td>{$row.origen}</td>
                    <td>{$row.descripcion}</td>
                    <td>{$row.cantidad}</td>
                    <td>{$row.unidad}</td>
                    <td>{$row.proforma_monto}</td>
                    <td>{$row.proforma_monto_usd}</td>
                </tr>
            {/foreach}
            </tbody>
            <tfoot></tfoot>
        </table>
    </div>
</div>
{include file="resultado/index.js.tpl"}