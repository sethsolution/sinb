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
                <h4 class="titulo_esta">Lista de Empresas/instituciones</h4>
            </div>
        </div>
    </div>
{*<div class="print">*}
    <table class="table  {*table-separate table-striped*}  table-bordered table-hover table-head-custom table-checkable table-sm print"
           id="tabla_proyecto_resumen" >
        <thead>
        <tr class="thead-dark thead-color">
            <th>Número de Registro</th>
            <th>Nombre de la empresa/institución</th>
            <th>NIT</th>
            <th>Red</th>
            <th>Departamento</th>
            <th>Actividad</th>
            <th>Representante legal</th>
            <th>Dirección</th>
            <th>Teléfono</th>
            <th>Email</th>
            <th>Fecha Inscripción</th>
            <th>Fecha Expiración</th>
        </tr>
        </thead>
        <tbody>
        {foreach from=$res.instituciones item=ins key=idxp}
            <tr>
                <td>{$ins.numero_registro}</td>
                <td>{$ins.nombre}</td>
                <td>{$ins.nit}</td>
                <td>{$ins.red}</td>
                <td>{$ins.departamento}</td>
                <td>{$ins.actividad}</td>
                <td>{$ins.representante_legal}</td>
                <td>{$ins.direccion}</td>
                <td>{$ins.telefono}</td>
                <td>{$ins.email}</td>
                <td>{$ins.fecha_inscripcion}</td>
                <td>{$ins.fecha_expiracion}</td>
            </tr>
        {/foreach}
        </tbody>
        <tfoot></tfoot>
    </table>
{*</div>*}
{/if}
{include file="resultado/index.js.tpl"}