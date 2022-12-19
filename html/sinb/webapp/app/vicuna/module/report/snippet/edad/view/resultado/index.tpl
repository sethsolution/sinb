{include file="resultado/index.css.tpl"}

{*<div class="m-widget1__item">*}
{*    <div class="row m-row--no-padding">*}
{*        <div class="col-md-6 col-lg-12 text-left" >*}
{*            <h4 class="titulo_esta">Departamento</h4>*}
{*            <canvas id="chart_departamento" width="auto" height="50" ></canvas>*}
{*        </div>*}
{*    </div>*}
{*</div>*}
{if $res.totalCrias >0 || $res.totalJuvenil>0 || $res.totalAdulto>0}
    {include file="resultado/resumen01.tpl"}

    <table class="table {*table-separate table-striped*}  table-bordered table-hover table-head-custom table-checkable  table-sm  "
           id="tabla_{$subcontrol}" >
        <thead>
        <tr class="thead-dark thead-color">
            <th >Departamento</th>
            <th >Municipio</th>
            <th >Total Crias</th>
            <th >Total Juveniles</th>
            <th >Total Adultos</th>
        </tr>
        </thead>
        <tbody>
        {foreach from=$res.resultado item=row key=idx}
            <tr>
                <td>{$row.departamento}</td>
                <td>{$row.municipio}</td>
                <td style="text-align: right;color:#066d12;">{$row.total_crias|string_format:'%.0f'}</td>
                <td style="text-align: right;color:#066d12;">{$row.total_juvenil|string_format:'%.0f'}</td>
                <td style="text-align: right;color:#066d12;">{$row.total_adulto|string_format:'%.0f'}</td>
            </tr>
        {/foreach}
        </tbody>
        <tfoot></tfoot>
    </table>
{/if}
{include file="resultado/index.js.tpl"}