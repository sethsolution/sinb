<!--begin::Modal-->
<div class="modal fade" id="form_modal_{$subcontrol}" tabindex="-1" role="dialog"
     data-backdrop="static"
     data-keyboard="true"
     aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xlg" role="document">
        <div class="modal-content" id="modal-content_{$subcontrol}">
        </div>
    </div>
</div>
<!--end::Modal-->

{include file="index.css.tpl"}
{*
<div class="m-portlet__head m--margin-bottom-5 m--padding-bottom-5" >
    <div class="m-portlet__head-caption" >
        <div class="m-portlet__head-title">
            <h3 style="color: #0b057b" class="m-portlet__head-text">CARGUE LOS SIGUIENTES DOCUMENTOS DE REQUISITOS </h3>
        </div>
    </div>
</div>
*}
<div class="m-portlet__body m--padding-top-5 m--margin-top-5">
    <table class="table table-striped table-bordered table-hover table-checkable table-sm m-table m-table--head-bg-success m--hide"
           id="tabla_{$subcontrol}">
        <thead>
        <tr>
            {foreach from=$grill_list item=row key=idx}
                <th>{$row.label|escape:"html"}</th>
            {/foreach}
        </tr>
        </thead>
        <tbody>

        {foreach from=$requisito item=row key=idx}
            <tr>

                <td>
                    {if $row.adjunto_nombre != '' }
                    <div class="btn-group btn-group-sm " role="group" aria-label="Default button group">
                        <a href="javascript:item_update_{$subcontrol}('{$row.itemId}');"
                           class="btn btn-outline-info" title="Modificar">
                            {if $item.estado_id == 1 or $item.estado_id==2}
                                Cambiar Estado
                            {else}
                                Ver Datos
                            {/if}
                        </a>
                        <div>
                            {/if}

                </td>
                <td>{$row.itemId}</td>
                <th>{$row.nombre_requisito|escape:"html"}
                    {if $row.dateUpdate != "" }
                        <br>
                        <small>
                            Fecha de Actualización: {$row.dateUpdate|date_format:"%d/%m/%Y %H:%M"}
                        </small>
                    {/if}
                    {if $row.descripcion != ""}
                        <br>
                        <small><strong>Descripcion:</strong>
                            {$row.descripcion}
                        </small>
                    {/if}

                </th>
                <td>
                    {if $row.adjunto_nombre!=""}
                        <a href="javascript:item_descarga_{$subcontrol}('{$row.itemId}');" title="Descargar">
                            <i class="flaticon-tool-1"></i> {$row.adjunto_nombre|escape:"html"}
                        </a>
                    {/if}

                </td>
                <td>{$row.adjunto_tamano|escape:"html"}</td>
                {*<td>
                    {if $row.adjunto_nombre!=""}
                        <span class="m-badge m-badge--success info m-badge--wide"></span>&nbsp;
                        <span class="m--font-bold m--font-success">SI</span>
                    {else}
                        <span class="m-badge m-badge--danger info m-badge--wide"></span>&nbsp;
                        <span class="m--font-bold m--font-danger">SI</span>
                    {/if}
                </td>*}
                {*<td>
                    {if $row.adjunto_nombre!=""}
                        <span class="m-badge m-badge--success info m-badge--wide"></span>&nbsp;
                        <span c>SI</span>
                  *} {* {else}
                            <span class="m-badge m-badge--danger info m-badge--wide"></span>&nbsp;
                            <span class="m--font-bold m--font-danger">SI</span>*}
                {*{/if}*}
                </td>
                <td>
                    {if $row.adjunto_nombre!=""}
                        <i class="fa fa-check-circle text-success"></i><span class="m--font-bold m--font-success">SI</span>
                    {else}
                        <i class="fa fa-check-circle text-secondary"></i>
                    {/if}
                </td>
                <td>{$row.estado_id}</td>
                <td>
                    {if $row.estado_id == '3' }
                        <a href="javascript:item_update_{$subcontrol}('{$row.itemId}');" title="Ver Observación">
                            <i class="fa fa-exclamation text-danger"></i> <span class="m--font-bold m--font-danger">Observado </span>
                        </a>
                    {else}
                        <i class="fa fa-exclamation text-secondary"></i>
                    {/if}
                </td>
                <td>
                    {if $row.observacion_fecha!=""}{$row.observacion_fecha|date_format:"%d/%m/%Y %H:%M:%S"}{/if}
                </td>
                <td>
                    {if $row.aprobado_fecha!=""}{$row.aprobado_fecha|date_format:"%d/%m/%Y %H:%M:%S"}{/if}
                </td>
            </tr>
        {/foreach}
        </tbody>
        <tfoot>
        </tfoot>
    </table>
</div>


{if $item.tipo_id != 8}
    {include file="form.tpl"}
{/if}

{include file="index.js.tpl"}