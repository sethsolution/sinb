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
                <th class="cabecera">Año</th>
                <th class="cabecera">Mes</th>
                <th class="cabecera">Recaudación </br>Total</th>
            </tr>

            </thead>
            <tbody>
            {foreach from=$lista.resultado item=row key=idx}
                <tr>
                    <td>{$row.anio}</td>
                    <td>{$row.mes}</td>
                    <td style="text-align: right;color:#066d12;">{$row.total|string_format:'%.0f'}</td>
                </tr>
            {/foreach}
            </tbody>
            <tfoot></tfoot>
        </table>


        <div class="m-widget1__item">
            <div class="row m-row--no-padding">
                <div class="col-md-6 col-lg-12 text-left" >
                    <h4 class="titulo_esta">Recaudacion mensual por Certificados CITES</h4>
                    <canvas id="chart_cantidad" width="auto" height="150" ></canvas>
                </div>
            </div>


        </div>
    </div>


</div>


{include file="resultado/index.js.tpl"}