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
                <th rowspan="2" class="cabecera">Fecha</th>
                <th rowspan="2" class="cabecera">Año</th>
                <th rowspan="2" class="cabecera">Nombre Común</th>
                <th rowspan="2" class="cabecera">Nombre Científico</th>
                <th rowspan="2" class="cabecera">Código de Comercio</th>
                <th rowspan="2" class="cabecera">Cantidad</th>
                <th rowspan="2" class="cabecera">Unidad</th>
                <th rowspan="2" class="cabecera">País de Importación (Origen)</th>
                <th rowspan="2" class="cabecera">País de Exportación o Reexportación (Destino)</th>
                <th rowspan="2" class="cabecera">Número del Permiso de Exportación Original (Reexpotaciones)</th>
                <th rowspan="2" class="cabecera">Propósito</th>
                <th rowspan="2" class="cabecera">Origen</th>
                <th colspan="2" class="cabecera">Certificado fito o zoosanitario del pais de origen (Importacion)</th>
                <th colspan="2" class="cabecera">Certificado fito o zoosanitario del pais exportador (re-exportación)</th>
                <th rowspan="2" class="cabecera">Observaciones</th>
            </tr>
            <tr>
                <th class="cabecera">Fecha de Emisión</th>
                <th class="cabecera">Nro de Certificado</th>
                <th class="cabecera">Fecha de Emisión</th>
                <th class="cabecera">Nro de Certificado</th>
            </tr>
            </thead>
            <tbody>
            {foreach from=$lista item=row key=idx}
                <tr>
                    <td>{if $row.emitido_fecha}{$row.emitido_fecha|date_format:'%d/%m/%Y'}{/if}</td>
                    <td>{$row.anio}</td>
                    <td>{$row.nombre_comun}</td>
                    <td>{$row.nombre_cientifico}</td>
                    <td>{$row.codigo_comercio}</td>
                    <td>{$row.cantidad}</td>
                    <td>{$row.unidad}</td>
                    <td>{$row.pais_importador}</td>
                    <td>{$row.pais_exportador}</td>
                    <td>{$row.numero_permiso_exportacion}</td>
                    <td>{$row.proposito}</td>
                    <td>{$row.origen}</td>
                    <td>{if $row.zoosanitario_emision}{$row.zoosanitario_emision|date_format:'%d/%m/%Y'}{/if}</td>
                    <td>{$row.zoosanitario_numero}</td>
                    <td>{if $row.zoosanitario_emision}{$row.zoosanitario_emision|date_format:'%d/%m/%Y'}{/if}</td>
                    <td>{$row.zoosanitario_numero}</td>
                    <td>obs</td>
                </tr>
            {/foreach}
            </tbody>
            <tfoot></tfoot>
        </table>
    </div>
</div>
{include file="resultado/index.js.tpl"}