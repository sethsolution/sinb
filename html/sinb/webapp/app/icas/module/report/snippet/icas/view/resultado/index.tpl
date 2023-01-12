{include file="resultado/index.css.tpl"}

{*{if $res.total >0}*}
    <div class="m-widget1__item">
        <div class="row m-row--no-padding">
            <div class="col-md-6 col-lg-12 text-left" >
                <h4 class="titulo_esta">Proyectos por ICAs</h4>
            </div>
        </div>
    </div>
<table class="table  {*table-separate table-striped*} table-bordered table-hover table-head-custom table-checkable table-sm"
       id="tabla_ica_total_{$subcontrol}">
    <thead>
    <tr class="thead-dark thead-color">
        <th>ICAS</th>
        <th>Total</th>
    </tr>
    </thead>
    <tbody>
    {foreach from=$res.icas item=row key=idxp}
        <tr>
            <td>{$row.ica}</td>
            <td>{$row.total}</td>
        </tr>
    {/foreach}
    </tbody>
    <tfoot></tfoot>
</table>

<table class="table {*table-separate table-striped*}  table-bordered table-hover table-head-custom table-checkable  table-sm  "
   id="tabla_ica_{$subcontrol}">
    <thead>
    <tr class="thead-dark thead-color">
        <th>ICAS</th>
        <th >Proyectos</th>
    </tr>
    </thead>
    <tbody>
    {foreach from=$res.icasProyecto item=row key=idx}
        <tr>
            <td>{$row.ica}</td>
            <td>{$row.proyecto}</td>
        </tr>
    {/foreach}
    </tbody>
    <tfoot></tfoot>
</table>


<div class="m-widget1__item">
    <div class="row m-row--no-padding">
        <div class="col-md-6 col-lg-12 text-left" >
            <h4 class="titulo_esta"></h4>
            <canvas id="chart_icas" width="auto" height="50" ></canvas>
        </div>
    </div>
</div>

{*{/if}*}

{include file="resultado/index.js.tpl"}