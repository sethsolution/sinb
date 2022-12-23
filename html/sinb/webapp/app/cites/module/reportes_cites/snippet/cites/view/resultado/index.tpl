{include file="resultado/index.css.tpl"}
{*<div class="m-widget1__item">*}
{*    <div class="row m-row--no-padding">*}
{*        <div class="col-md-6 col-lg-12 text-left" >*}
{*            <h4 class="titulo_esta">Departamento</h4>*}
{*            <canvas id="chart_departamento" width="auto" height="50" ></canvas>*}
{*        </div>*}
{*    </div>*}
{*</div>*}

{include file="resultado/resumen01.tpl"}

{if $res.total >0}
    <table class="table {*table-separate table-striped*}  table-bordered table-hover table-head-custom table-checkable  table-sm"
           id="tabla_tipo_{$subcontrol}" >
        <thead>
        <tr class="thead-dark thead-color">
            <th> Año</th>
            {foreach from=$res.estadoCites.estados item=row key=idx}
                <th>{$row.estado}</th>
            {/foreach}
{*            <th>S/R</th>*}
            <th>Total</th>
        </tr>
        </thead>
        <tbody>
        {foreach from=$res.estadoCites.years item=row key=idx}
            <tr>
                <td>{$row.year}</td>
                {foreach from=$res.estadoCites.citesEstado item=rowt key=idxt}
                    <td>
                        {foreach from=$rowt.year item=dato key=idx2}
                            {if $row.year==$dato.year}
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
                <h4 class="titulo_esta">Por estado de CITES</h4>
                <canvas id="chart_estado" width="auto" height="80" ></canvas>
            </div>
        </div>
    </div>

{*    <table class="table *}{*table-separate table-striped*}{*  table-bordered table-hover table-head-custom table-checkable  table-sm  "*}
{*           id="tabla_{$subcontrol}" >*}
{*        <thead>*}
{*        <tr class="thead-dark thead-color">*}
{*            <th >Mes</th>*}
{*            <th >Estado</th>*}
{*            <th >Total</th>*}
{*        </tr>*}
{*        </thead>*}
{*        <tbody>*}
{*        {foreach from=$res.resultado item=row key=idx}*}
{*            <tr>*}
{*                <td>{$row.mes}</td>*}
{*                <td>{$row.estado}</td>*}
{*                <td style="text-align: right;color:#066d12;">{$row.total|string_format:'%.0f'}</td>*}
{*            </tr>*}
{*        {/foreach}*}
{*        </tbody>*}
{*        <tfoot></tfoot>*}
{*    </table>*}

    <table class="table {*table-separate table-striped*}  table-bordered table-hover table-head-custom table-checkable  table-sm"
           id="tabla_tipo_{$subcontrol}" >
        <thead>
        <tr class="thead-dark thead-color">
            <th>Estado de la Esquila - Acta</th>
            {foreach from=$res.meses item=row key=idx}
                <th>{$row.nombre}</th>
            {/foreach}
            <th>S/R</th>
            <th>Total</th>
        </tr>
        </thead>
        <tbody>
        {foreach from=$res.mesCites.estado item=row key=idx}
            <tr>
                <td>{$row.estado}</td>
                {foreach from=$res.mesCites.meses item=rowt key=idxt}
                    <td>
                        {foreach from=$rowt.estado item=dato key=idx2}
                            {if $row.estado_id==$dato.id}
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
                <h4 class="titulo_esta">Lista de CITES</h4>
            </div>
        </div>
    </div>
{*<div class="print">*}
    <table class="table  {*table-separate table-striped*}  table-bordered table-hover table-head-custom table-checkable table-sm print"
           id="tabla_proyecto_resumen" >
        <thead>
        <tr class="thead-dark thead-color">
            <th>Número de cites</th>
            <th>Fecha</th>
            <th>Tipo de documento</th>
            <th>Exportador</th>
            <th>Destinatario</th>
            <th>Propósito</th>
            <th>Fecha válido</th>
            <th>Estado</th>
            <th>Observación</th>
        </tr>
        </thead>
        <tbody>
        {foreach from=$res.esquilas item=esq key=idxp}
            <tr>
                <td>{$esq.numero_cites}</td>
                <td>{$esq.fecha}</td>
                <td>{$esq.tipo_documento}</td>
                <td>{$esq.exportador}</td>
                <td>{$esq.destinatario}</td>
                <td>{$esq.proposito}</td>
                <td>{$esq.fecha_valido}</td>
                <td>{$esq.estado}</td>
                <td>{$esq.observacion}</td>
            </tr>
        {/foreach}
        </tbody>
        <tfoot></tfoot>
    </table>
{*</div>*}
{/if}
{include file="resultado/index.js.tpl"}