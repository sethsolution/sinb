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
                <th colspan="2" class="cabecera">Exportador	</th>
                <th colspan="2" class="cabecera">Importador	</th>
                <th rowspan="2" class="cabecera">Pais de Destino</th>
                <th colspan="2" class="cabecera">Producto</th>
                <th rowspan="2" class="cabecera">Apendice</th>
                <th rowspan="2" class="cabecera">Proposito</th>
                <th rowspan="2" class="cabecera">Origen</th>
                <th rowspan="2" class="cabecera">Descripcion</th>
                <th colspan="3" class="cabecera">Cantidad</th>
                <th rowspan="2" class="cabecera">Nº CEFO</th>
                <th rowspan="2" class="cabecera">Precio total Factura (bs)</th>
                <th rowspan="2" class="cabecera">Precio total Factura  ($)</th>
            </tr>
            <tr>
                <th class="cabecera">Nombre</th>
                <th class="cabecera">Dirección</th>
                <th class="cabecera">Nombre de Empresa</th>
                <th class="cabecera">Dirección</th>
                <th class="cabecera">Nombre común</th>
                <th class="cabecera">Nombre cientifico</th>
                <th class="cabecera">Piezas</th>
                <th class="cabecera">Pt</th>
                <th class="cabecera">M3</th>
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
                    <td>{$row.exportador_direccion}</td>
                    <td>{$row.importador}</td>
                    <td>{$row.importador_direccion}</td>
                    <td>{$row.pais_destino}</td>
                    <td>{$row.nombre_comun}</td>
                    <td>{$row.nombre_cientifico}</td>
                    <td>{$row.apendice}</td>
                    <td>{$row.proposito}</td>
                    <td>{$row.origen}</td>
                    <td>{$row.descripcion}</td>
                    <td>{$row.cantidad_piezas}</td>
                    <td>{$row.cantidad_pt}</td>
                    <td>{$row.cantidad}</td>
                    <td>{$row.cefo_numero}</td>
                    <td>{$row.monto_factura_comercial_bs}</td>
                    <td>{$row.monto_factura_comercial_usd}</td>
                </tr>
            {/foreach}
            </tbody>
            <tfoot></tfoot>
        </table>
    </div>
</div>
{include file="resultado/index.js.tpl"}