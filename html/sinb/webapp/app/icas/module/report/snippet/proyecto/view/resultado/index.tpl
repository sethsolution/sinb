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

<div class="m-widget1__item">
    <div class="row m-row--no-padding">
        <div class="col-md-6 col-lg-12 text-left" >
            <h4 class="titulo_esta">Área temática</h4>
            <canvas id="chart_area" width="auto" height="50" ></canvas>
        </div>
    </div>
</div>

{if $res.total >0}
{*    <div class="m-widget1__item">*}
{*        <div class="row m-row--no-padding">*}
{*            <div class="col-md-6 col-lg-12 text-left" >*}
{*                <h4 class="titulo_esta">Proyectos por ICAs</h4>*}
{*            </div>*}
{*        </div>*}
{*    </div>*}
{*<table class="table  *}{*table-separate table-striped*}{* table-bordered table-hover table-head-custom table-checkable table-sm"*}
{*       id="tabla_ica_total_{$subcontrol}">*}
{*    <thead>*}
{*    <tr class="thead-dark thead-color">*}
{*        <th>ICAS</th>*}
{*        <th>Total</th>*}
{*    </tr>*}
{*    </thead>*}
{*    <tbody>*}
{*    {foreach from=$res.icas item=row key=idxp}*}
{*        <tr>*}
{*            <td>{$row.ica}</td>*}
{*            <td>{$row.total}</td>*}
{*        </tr>*}
{*    {/foreach}*}
{*    </tbody>*}
{*    <tfoot></tfoot>*}
{*</table>*}

{*<table class="table *}{*table-separate table-striped*}{*  table-bordered table-hover table-head-custom table-checkable  table-sm  "*}
{*   id="tabla_ica_{$subcontrol}">*}
{*    <thead>*}
{*    <tr class="thead-dark thead-color">*}
{*        <th>ICAS</th>*}
{*        <th >Proyectos</th>*}
{*    </tr>*}
{*    </thead>*}
{*    <tbody>*}
{*    {foreach from=$res.icasProyecto item=row key=idx}*}
{*        <tr>*}
{*            <td>{$row.ica}</td>*}
{*            <td>{$row.proyecto}</td>*}
{*        </tr>*}
{*    {/foreach}*}
{*    </tbody>*}
{*    <tfoot></tfoot>*}
{*</table>*}


{*<div class="m-widget1__item">*}
{*    <div class="row m-row--no-padding">*}
{*        <div class="col-md-6 col-lg-12 text-left" >*}
{*            <h4 class="titulo_esta"></h4>*}
{*            <canvas id="chart_icas" width="auto" height="50" ></canvas>*}
{*        </div>*}
{*    </div>*}
{*</div>*}

<table class="table {*table-separate table-striped*}  table-bordered table-hover table-head-custom table-checkable  table-sm  "
       id="tabla_{$subcontrol}" >
    <thead>
    <tr class="thead-dark thead-color">
        <th >Fuente de financiamiento</th>
        <th >Estado</th>
        <th >Total</th>
    </tr>
    </thead>
    <tbody>
    {foreach from=$res.resultado item=row key=idx}
        <tr>
            <td>{$row.financiamiento}</td>
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

    <div class="m-widget1__item">
        <div class="row m-row--no-padding">
            <div class="col-md-6 col-lg-12 text-left" >
                <h4 class="titulo_esta">Lista de Proyectos</h4>
            </div>
        </div>
    </div>

    <table class="table  {*table-separate table-striped*}  table-bordered table-hover table-head-custom table-checkable table-sm"
           id="tabla_proyecto_resumen" >
        <thead>
        <tr class="thead-dark thead-color">
            <th>Código</th>
            <th>Nombre del Proyecto</th>
            <th>Área temática</th>
            <th>Departamento</th>
            <th>Estado</th>
            <th>Fuente de financiamiento</th>
            <th>Fuente de financiamiento otro</th>
            <th>Fecha de inicio</th>
            <th>Fecha de conclusión</th>
        </tr>
        </thead>
        <tbody>
        {foreach from=$res.proyectos item=pro key=idxp}
            <tr>
                <td>{$pro.id}</td>
                <td>{$pro.nombre}</td>
                <td>{$pro.area}</td>
                <td>{$pro.departamento}</td>
                <td>{$pro.estado}</td>
                <td>{$pro.financiamiento}</td>
                <td>{$pro.fuente_financiamiento_otro}</td>
                <td>{$pro.fecha_inicio}</td>
                <td>{$pro.fecha_conclusion}</td>
            </tr>
        {/foreach}
        </tbody>
        <tfoot></tfoot>
    </table>

{/if}

{include file="resultado/index.js.tpl"}