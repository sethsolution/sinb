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

{include file="index.css.tpl"}
<div class="m-portlet__head m--margin-bottom-5 m--padding-bottom-5" >
    <div class="m-portlet__head-caption" >
        <div class="m-portlet__head-title">
            <h4 class="m--font-primary">Cargue los siguientes documentos de requisitos</h4>
        </div>
    </div>
</div>

<div class="m-portlet__body m--padding-top-5 m--padding-bottom-5 m--padding-left-5 m--padding-right-5">
    <table class="table table-striped table-bordered table-hover table-checkable table-sm m-table
    m-table--head-bg-success m--hide" id="tabla_{$subcontrol}">
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
                    <div class="text-center">
                        {if ($row.estado_id == '1' or $row.estado_id == '3') and ($item.estado_id == 1 or $item.estado_id == 3)}
                            {if $row.requerido == 1}
                                <small class="obligatorio">OBLIGATORIO</small>
                            {else}<small class="opcional">OPCIONAL</small>{/if}
                            <div class="btn-group btn-group-sm " role="group" aria-label="Default button group">
                                <a href="javascript:item_update_{$subcontrol}('{$row.itemId}');"
                                   class="btn btn-warning" title="Modificar">
                                    {if $item.estado_id == 1 or $item.estado_id==3}
                                        Subir Archivo
                                    {else}
                                        Ver Dato
                                    {/if}
                                </a>
                            </div>
                        {else}
                            {if $row.requerido == 1}<small class="obligatorio">OBLIGATORIO</small>
                            {else}<small class="opcional">OPCIONAL</small>{/if}
                        {/if}
                    </div>

                </td>
                <td>
                    <div style="text-align:justify">
                        {$row.nombre_requisito|escape:"html"}
                    </div>

                    {if $row.adjunto_nombre!=""}

                        {if ($row.estado_id == '1' or $row.estado_id == '3') and ($item.estado_id == 1 or $item.estado_id == 3)}
                            {if $item.estado_id == 1 or $item.estado_id==3}
                                <a href="javascript:item_delete_{$subcontrol}('{$row.itemId}');" class="btn btn-danger m-btn m-btn--icon btn-sm m-btn--icon-only" title="Borrar Archivo">
                                    <i class="flaticon-delete-1"></i>
                                </a>
                            {/if}
                        {/if}

                        <a href="javascript:item_descarga_{$subcontrol}('{$row.itemId}');" title="Descargar Archivo"
                           class="btn btn-success btn-sm m-btn 	m-btn m-btn--icon">
                                    <span><i class="fa fa-download"></i>
                                        <span>{$row.adjunto_nombre|escape:"html"}
                                        </span>
                                    </span>
                        </a>
                    {/if}


                    {if $row.descripcion != ""}
                        <br>
                        <small><strong>Descripcion:</strong>
                            {$row.descripcion}
                        </small>
                    {/if}
                    {if $row.dateUpdate != "" }
                        <br>
                        <span style="color: #af84ff; font-size: 10px;">
                                Fecha de Actualización: {$row.dateUpdate|date_format:"%d/%m/%Y %H:%M"}
                            </span>
                    {/if}

                </td>
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
                    {if $row.estado_id == '3' and $item.estado_id == '3'}
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
    </table>


</div>


{if $item.tipo_id != 8}
    <div class="m-portlet__head m--margin-bottom-5 m--padding-bottom-5" >
        <div class="m-portlet__head-caption" >
            <div class="m-portlet__head-title">
                <h4 class="m--font-primary">Otra información a llenar </h4>
            </div>
        </div>
    </div>
{/if}

{include file="form.tpl"}

{include file="index.js.tpl"}