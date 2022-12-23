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
            <th>Especie</th>
            {foreach from=$res.meses item=row key=idx}
                <th>{$row.nombre}</th>
            {/foreach}
            <th>S/R</th>
            <th>Total</th>
        </tr>
        </thead>
        <tbody>
        {foreach from=$res.mesEspecie.especie item=row key=idx}
            <tr>
                <td>{$row.especie}</td>
                {foreach from=$res.mesEspecie.meses item=rowt key=idxt}
                    <td>
                        {foreach from=$rowt.especie item=dato key=idx2}
                            {if $row.especie_id==$dato.id}
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
                <h4 class="titulo_esta">Por especie de CITES</h4>
                <canvas id="chart_especie" width="auto" height="80" ></canvas>
            </div>
        </div>
    </div>
{/if}
{include file="resultado/index.js.tpl"}