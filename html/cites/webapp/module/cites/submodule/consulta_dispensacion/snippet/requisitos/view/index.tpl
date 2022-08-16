{include file="index.js.tpl"}
{include file="index.css.tpl"}

    <div class="m-portlet__body">
        <table class="table table-striped table-bordered table-hover table-checkable table-sm m-table m-table--head-bg-success m--hide" id="tabla_{$subcontrol}">
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
                        {if ($row.estado_id == '1' or $row.estado_id == '3') and ($item.estado_id == 1 or $item.estado_id == 3)}
                            <div class="btn-group btn-group-sm " role="group" aria-label="Default button group">
                                <a href="javascript:item_update_{$subcontrol}('{$row.itemId}');"
                                   class="btn btn-outline-info" title="Modificar">
                                    {if $item.estado_id == 1 or $item.estado_id==3}
                                        Subir Archivo
                                    {else}
                                        Ver Datos
                                    {/if}
                                </a>
                            <div>
                        {/if}

                    </td>
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

                    <td>
                        {if $row.adjunto_nombre!=""}
                            <i class="fa fa-check-circle text-success"></i><span class="m--font-bold m--font-success">SI</span>

                        {else}
                            <i class="fa fa-check-circle text-secondary"></i>
                        {/if}
                    </td>
                    <td>{$row.estado_id}</td>
                    <td>
                        {if $row.estado_id == '3'  and $item.estado_id == '3'}
                            <a href="javascript:item_update_{$subcontrol}('{$row.itemId}');" title="Ver Observación">
                                <i class="fa fa-exclamation text-danger"></i> <span class="m--font-bold m--font-danger">Observado </span>
                            </a>
                        {else}
                            <i class="fa fa-exclamation text-secondary"></i>
                        {/if}
                    </td>
                </tr>


            {/foreach}


            </tbody>
            <tfoot>
            </tfoot>
        </table>
    </div>


<!--begin::Modal-->
<div class="modal fade" id="form_modal_{$subcontrol}" tabindex="-1" role="dialog"
     data-backdrop="static"
     data-keyboard="false"
     aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content" id="modal-content_{$subcontrol}">
        </div>
    </div>
</div>
<!--end::Modal-->


{include file="form.tpl"}