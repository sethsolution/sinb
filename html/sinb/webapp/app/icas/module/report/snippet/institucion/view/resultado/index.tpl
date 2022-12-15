{include file="resultado/index.css.tpl"}



{include file="resultado/resumen01.tpl"}


{if $res.total >0}

<table class="table {*table-separate table-striped*}  table-bordered table-hover table-head-custom table-checkable  table-sm  "
       id="tabla_{$subcontrol}" >
    <thead>
    <tr class="thead-dark thead-color">
        <th >Proyecto</th>
        <th >Tipo Institución</th>
        <th >Total</th>
    </tr>
    </thead>
    <tbody>
    {foreach from=$res.resultado item=row key=idx}
        <tr>
            <td>{$row.proyecto}</td>
            <td>{$row.tipo}</td>
            <td style="text-align: right;color:#066d12;">{$row.total|string_format:'%.0f'}</td>
        </tr>
    {/foreach}
    </tbody>
    <tfoot></tfoot>
</table>


<div class="m-widget1__item">
    <div class="row m-row--no-padding">
        <div class="col-md-6 col-lg-12 text-left" >
            <h4 class="titulo_esta">Total Instituciones</h4>
            <canvas id="chart_cantidad" width="auto" height="70" ></canvas>
        </div>
    </div>
</div>

{/if}

{include file="resultado/index.js.tpl"}