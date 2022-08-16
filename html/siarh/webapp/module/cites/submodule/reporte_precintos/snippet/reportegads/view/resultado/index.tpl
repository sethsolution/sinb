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
                <th class="cabecera">Nro.</th>
                <th class="cabecera">Procedencia</th>
                <th class="cabecera">Nro. de informe</th>
                <th class="cabecera">Año del aprovechamiento</th>
                <th class="cabecera">Cantidad de envases utilizados en el envio</th>
                <th class="cabecera">Nro. de Precinto inicial utilizado</th>
                <th class="cabecera">Nro. de Precinto final</th>
                <th class="cabecera">Total precintos utilizados </th>
                <th class="cabecera">Total precintos dados de baja</th>
                <th class="cabecera">Cofigos de los precintos dados de baja</th>
                <th class="cabecera">Peso bruto total del envio en Kg (incluyendo el envase) </th>
                <th class="cabecera">Peso neto total en Kg ( solo del producto sin el envase) </th>
                <th class="cabecera">Equivalente total en metros del envio en mt </th>
            </tr>
            </thead>
            <tbody>
            {foreach from=$lista item=row key=idx}
                <tr>
                    <td>{$idx + 1}</td>
                    <td>{$row.nombre}</td>
                    <td>{$row.numero_informe}</td>
                    <td>{$row.gestion}</td>
                    <td>{$row.cantidad_envases}</td>
                    <td>{$row.precinto_inicial}</td>
                    <td>{$row.precinto_final}</td>
                    <td>{$row.precinto_utilizados}</td>
                    <td>{$row.precinto_noutilizados}</td>
                    <td>{$row.precinto_codigo_baja} , {$row.codigo_utilizado}</td>
                    <td>{$row.peso_bruto}</td>
                    <td>{$row.peso_neto}</td>
                    <td>{$row.equivalente_metros}</td>
                </tr>
            {/foreach}
            </tbody>
            <tfoot></tfoot>
        </table>
    </div>
</div>
{include file="resultado/index.js.tpl"}