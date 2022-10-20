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



<table class="table {*table-separate table-striped*}  table-bordered table-hover table-head-custom table-checkable  table-sm  "
       id="tabla_{$subcontrol}" >
    <thead>
    <tr class="thead-dark thead-color">
        <th >Tipo</th>
        <th >Estado</th>
        <th >Total</th>
    </tr>
    </thead>
    <tbody>
    {foreach from=$res.resultado item=row key=idx}
        <tr>
            <td>{$row.tipo}</td>
            <td>{$row.estado}</td>
            <td style="text-align: right;color:#066d12;">{$row.total|string_format:'%.0f'}</td>
        </tr>
    {/foreach}
    </tbody>
    <tfoot></tfoot>
</table>


<div class="m-widget1__item">
    <div class="row m-row--no-padding">
        <div class="col-md-6 col-lg-12 text-left" >
            <h4 class="titulo_esta">Total Proyectos</h4>
            <canvas id="chart_cantidad" width="auto" height="70" ></canvas>
        </div>
    </div>
</div>

<table class="table {*table-separate table-striped*}  table-bordered table-hover table-head-custom table-checkable  table-sm"
       id="tabla_tipo_{$subcontrol}" >
    <thead>
    <tr class="thead-dark thead-color">
        <th>Tipo de proyecto</th>
        {foreach from=$res.years item=row key=idx}
        <th>{$row}</th>
        {/foreach}
        <th>S/R</th>
        <th>Total</th>
    </tr>
    </thead>
    <tbody>
    {foreach from=$res.tipoProyecto.tipo item=row key=idx}
        <tr>
            <td>{$row.tipo_proyecto}</td>
            {foreach from=$res.tipoProyecto.years item=rowt key=idxt}
                <td>
                {foreach from=$rowt.tipo item=dato key=idx2}
                    {if $row.tipo_proyecto_id==$dato.id}
                        {$dato.total}{/if}
                {/foreach}
                </td>
            {/foreach}
            <td>{$row.total}</td>
        </tr>
    {/foreach}
    </tbody>
    <tfoot></tfoot>
</table>




    <div class="m-widget1__item">
        <div class="row m-row--no-padding">
            <div class="col-md-6 col-lg-12 text-left" >
                <h4 class="titulo_esta">Por Tipo de Proyecto</h4>
                <canvas id="chart_tipoproyecto" width="auto" height="80" ></canvas>
            </div>
        </div>
    </div>

{/if}

{include file="resultado/index.js.tpl"}