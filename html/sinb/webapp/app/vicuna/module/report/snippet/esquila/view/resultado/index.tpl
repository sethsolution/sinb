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

    <div class="m-widget1__item">
        <div class="row m-row--no-padding">
            <div class="col-md-6 col-lg-12 text-left" >
                <h4 class="titulo_esta">Lista de esquilas - actas</h4>
            </div>
        </div>
    </div>
{*<div class="print">*}
    <table class="table  {*table-separate table-striped*}  table-bordered table-hover table-head-custom table-checkable table-sm print"
           id="tabla_proyecto_resumen" >
        <thead>
        <tr class="thead-dark thead-color">
            <th>Nacional ID</th>
            <th>Año</th>
            <th>Departamento</th>
            <th>Provincia</th>
            <th>Municipio</th>
            <th>Localidad</th>
            <th>ARCMV</th>
            <th>CMV</th>
            <th>Número de acta</th>
            <th>Sitio de captura</th>
            <th>Fecha captura</th>
        </tr>
        </thead>
        <tbody>
        {foreach from=$res.esquilas item=ins key=idxp}
            <tr>
                <td>{$ins.nacional_id}</td>
                <td>{$ins.anio}</td>
                <td>{$ins.departamento}</td>
                <td>{$ins.provincia}</td>
                <td>{$ins.municipio}</td>
                <td>{$ins.localidad}</td>
                <td>{$ins.arcmv}</td>
                <td>{$ins.cmv}</td>
                <td>{$ins.numero_acta}</td>
                <td>{$ins.sitio_captura}</td>
                <td>{$ins.fecha_captura}</td>
            </tr>
        {/foreach}
        </tbody>
        <tfoot></tfoot>
    </table>
{*</div>*}
{/if}
{include file="resultado/index.js.tpl"}