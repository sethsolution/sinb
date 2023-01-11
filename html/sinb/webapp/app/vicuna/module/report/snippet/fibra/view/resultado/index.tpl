{include file="resultado/index.css.tpl"}

{if $res.totalPredescerdada >0 || $res.totalVellon>0 || $res.totalBraga>0}
    {include file="resultado/resumen01.tpl"}

    <table class="table {*table-separate table-striped*}  table-bordered table-hover table-head-custom table-checkable  table-sm"
           id="tabla_ingreso_{$subcontrol}" >
        <thead>
        <tr class="thead-dark thead-color">
            <th>Año</th>
            <th>Total ingreso fibra predescerdada (Bs.)</th>
            <th>Total ingreso fibra vellon (Bs.)</th>
            <th>Total ingreso fibra braga (Bs.)</th>
            <th>Total ingreso (Bs.)</th>
        </tr>
        </thead>
        <tbody>
        {foreach from=$res.ingreso item=row key=idx}
            <tr>
                <td>{$row.anio}</td>
                <td style="text-align: right;color:#066d12;">{$row.total_ingreso_predescerdada|number_format:0:'.':','} Bs</td>
                <td style="text-align: right;color:#066d12;">{$row.total_ingreso_vellon|number_format:0:'.':','} Bs</td>
                <td style="text-align: right;color:#066d12;">{$row.total_ingreso_braga|number_format:0:'.':','} Bs</td>
                {assign var="total" value=$row.total_ingreso_predescerdada + $row.total_ingreso_vellon + $row.total_ingreso_braga}
                <td style="text-align: right;color:#066d12;">{$total|number_format:0:'.':','} Bs</td>
            </tr>
        {/foreach}
        </tbody>
        <tfoot></tfoot>
    </table>

{*    <div class="m-widget1__item">*}
{*        <div class="row m-row--no-padding">*}
{*            <div class="col-md-6 col-lg-12 text-left" >*}
{*                <h4 class="titulo_esta">Total de ingresos por año</h4>*}
{*                <canvas id="chart_cantidad" width="auto" height="70" ></canvas>*}
{*            </div>*}
{*        </div>*}
{*    </div>*}

    <table class="table {*table-separate table-striped*}  table-bordered table-hover table-head-custom table-checkable  table-sm  "
           id="tabla_{$subcontrol}" >
        <thead>
        <tr class="thead-dark thead-color">
            <th >Departamento</th>
            <th >Municipio</th>
            <th >Total venta fibra predescerdada</th>
            <th >Total venta fibra vellon</th>
            <th >Total venta fibra braga</th>
            <th >Total Ingreso fibra predescerdada</th>
            <th >Total Ingreso fibra vellon</th>
            <th >Total Ingreso fibra braga</th>
        </tr>
        </thead>
    <tbody>
        {foreach from=$res.resultado item=row key=idx}
            {if $row.total_venta_fibra_predescerdada > 0 || $row.total_venta_fibra_vellon>0 || $row.total_venta_fibra_braga>0}
            <tr>
                <td>{$row.departamento}</td>
                <td>{$row.municipio}</td>
                <td style="text-align: right;color:#066d12;">{$row.total_venta_fibra_predescerdada|string_format:'%.0f'}</td>
                <td style="text-align: right;color:#066d12;">{$row.total_venta_fibra_vellon|string_format:'%.0f'}</td>
                <td style="text-align: right;color:#066d12;">{$row.total_venta_fibra_braga|string_format:'%.0f'}</td>
                <td style="text-align: right;color:#066d12;">{$row.total_ingreso_predescerdada|number_format:0:'.':','} Bs</td>
                <td style="text-align: right;color:#066d12;">{$row.total_ingreso_vellon|number_format:0:'.':','} Bs</td>
                <td style="text-align: right;color:#066d12;">{$row.total_ingreso_braga|number_format:0:'.':','} Bs</td>
            </tr>
            {/if}
        {/foreach}
        </tbody>
        <tfoot></tfoot>
    </table>
{/if}
{include file="resultado/index.js.tpl"}