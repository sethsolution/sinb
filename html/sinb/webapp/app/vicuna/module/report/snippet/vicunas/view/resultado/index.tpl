{include file="resultado/index.css.tpl"}

<div class="m-widget1__item">
    <div class="row m-row--no-padding">
        <div class="col-md-6 col-lg-12 text-left" >
            <h4 class="titulo_esta">Departamento</h4>
            <canvas id="chart_departamento" width="auto" height="50" ></canvas>
        </div>
    </div>
</div>

{include file="resultado/resumen01.tpl"}

{if $res.total >0}

    <div class="m-widget1__item">
        <div class="row m-row--no-padding">
            <div class="col-md-6 col-lg-12 text-left" >
                <h4 class="titulo_esta">Total vicuñas esquiladas por municipio</h4>
            </div>
        </div>
    </div>
    <table class="table {*table-separate table-striped*}  table-bordered table-hover table-head-custom table-checkable  table-sm  "
           id="tabla_{$subcontrol}" >
        <thead>
        <tr class="thead-dark thead-color">
            <th >Departamento</th>
            <th >Municipio</th>
            <th >Total Machos</th>
            <th >Total Hembras</th>
            <th >Total</th>
        </tr>
        </thead>
        <tbody>
        {foreach from=$res.resultado item=row key=idx}
            <tr>
                <td>{$row.departamento}</td>
                <td>{$row.municipio}</td>
                <td style="text-align: right;color:#066d12;">{$row.total_machos|string_format:'%.0f'}</td>
                <td style="text-align: right;color:#066d12;">{$row.total_hembras|string_format:'%.0f'}</td>
                <td style="text-align: right;color:#066d12;">{$row.total|string_format:'%.0f'}</td>
            </tr>
        {/foreach}
        </tbody>
        <tfoot></tfoot>
    </table>
{/if}
{include file="resultado/index.js.tpl"}