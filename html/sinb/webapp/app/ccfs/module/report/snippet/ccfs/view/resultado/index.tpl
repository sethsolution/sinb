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
            <th >Departamento</th>
            <th >Municipio</th>
            <th >Total</th>
        </tr>
        </thead>
        <tbody>
        {foreach from=$res.resultado item=row key=idx}
            <tr>
                <td>{$row.departamento}</td>
                <td>{$row.municipio}</td>
                <td style="text-align: right;color:#066d12;">{$row.total|string_format:'%.0f'}</td>
            </tr>
        {/foreach}
        </tbody>
        <tfoot></tfoot>
    </table>


{*<div class="m-widget1__item">*}
{*    <div class="row m-row--no-padding">*}
{*        <div class="col-md-6 col-lg-12 text-left" >*}
{*            <h4 class="titulo_esta">Total Proyectos</h4>*}
{*            <canvas id="chart_cantidad" width="auto" height="70" ></canvas>*}
{*        </div>*}
{*    </div>*}
{*</div>*}

    <div class="m-widget1__item">
        <div class="row m-row--no-padding">
            <div class="col-md-6 col-lg-12 text-left" >
                <h4 class="titulo_esta">Lista de CCFS</h4>
            </div>
        </div>
    </div>

    <table class="table  {*table-separate table-striped*}  table-bordered table-hover table-head-custom table-checkable table-sm"
           id="tabla_proyecto_resumen" >
        <thead>
        <tr class="thead-dark thead-color">
            <th>Nombre de CCFS</th>
            <th>Código</th>
            <th>Categoría</th>
            <th>Condición</th>
            <th>Departamento</th>
            <th>Provincia</th>
            <th>Municipio</th>
            <th>Licencia de funcionamiento</th>
            <th>Formato</th>
            <th>Responsable</th>
        </tr>
        </thead>
        <tbody>
        {foreach from=$res.ccfs item=c key=idxp}
            <tr>
                <td>{$c.nombre}</td>
                <td>{$c.codigo}</td>
                <td>{$c.categoria}</td>
                <td>{$c.condicion}</td>
                <td>{$c.departamento}</td>
                <td>{$c.provincia}</td>
                <td>{$c.municipio}</td>
                <td>{$c.licencia_funcionamiento}</td>
                <td>{$c.formato}</td>
                <td>{$c.responsable}</td>
            </tr>
        {/foreach}
        </tbody>
        <tfoot></tfoot>
    </table>

{/if}

{include file="resultado/index.js.tpl"}