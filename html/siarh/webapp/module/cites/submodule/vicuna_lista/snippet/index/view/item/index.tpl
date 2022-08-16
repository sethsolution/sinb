<div class="modal fade" id="form_modal_ver" tabindex="-1" role="dialog"
     data-backdrop="static"
     data-keyboard="false"
     aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content" id="modal-content_ver">

        </div>
    </div>
</div>
{include file="item/index.css.tpl"}
{if ($item.itemId != 0 && $item.itemId != "" && $type == "update") || $type == "new"}


    <div class="row">
        <div class="col-lg-12">

            <!--begin::Portlet-->
            <div class="m-portlet m-portlet--last m-portlet--head-lg m-portlet--responsive-mobile" id="main_portlet">
                <div class="m-portlet__head">
                    <div class="m-portlet__head-progress">

                        <!-- here can place a progress bar-->
                    </div>
                    <div class="m-portlet__head-wrapper">
                        <div class="m-portlet__head-caption">
                            <a href="/{$miga.modulo.carpeta}/{$miga.smodulo.carpeta}/"
                               class="btn btn-secondary m-btn m-btn--icon m-btn--wide m-btn--md m--margin-right-10">
                                <span><i class="la la-arrow-left"></i><span>Volver</span></span>
                            </a>
                            {if $type != "new" }
                               <a href="#" id="btn_ver" rel="new"
                                   class="btn btn-brand m-btn m-btn--icon m-btn--wide m-btn--md m--margin-right-10">
                                    <span><i class="fa fa-print"></i><span>Ver Resumen</span></span>
                                </a>
                            <a href="/{$miga.modulo.carpeta}/{$miga.smodulo.carpeta}/" id="btn_imprime"
                               class="btn btn-brand m-btn m-btn--icon m-btn--wide m-btn--md m--margin-right-10">
                                <span><i class="fa fa-print"></i><span>Imprimir</span></span>
                            </a>
                            {/if}
                        </div>

                        <div class="m-portlet__head-tools">
                            {if $item.estado_id == 2 }
                                <a href="#" class="btn btn-primary m-btn m-btn--icon m-btn--wide m-btn--md m--margin-right-10 m--hide"
                                   id="btn_obs_enviar" rel="new" >
                                    <span><i class="fa fa-plus"></i><span>Enviar Observación</span></span>
                                </a>
                            {else}{if $item.estado_id == 3}
                                <div class="cuadro-verde m--padding-10 m--margin-bottom-10" style=" height: 50%">
                                    <div class="titulo2 m--margin-bottom-5 m--padding-left-5 m--font-bold">Las observaciones fueron enviadas al usuario.</div>
                                </div>
                            {/if}
                            {/if}

                            {if $item.estado_id == 2 }
                                <a href="#" class="btn btn-success m-btn m-btn--icon m-btn--wide m-btn--md m--margin-right-10 m--hide"
                                   id="btn_aprobar" rel="new">
                                    <span><i class="fa fa-plus"></i><span>Aprobar solicitud</span></span>
                                </a>
                            {else}{if $item.estado_id == 4}
                                <div class="cuadro-verde m--padding-10 m--margin-bottom-10" style=" height: 50%">
                                    <div class="titulo2 m--margin-bottom-5 m--padding-left-5 m--font-bold">La solicitud fue aprobada y se envió una notificación al usuario.</div>
                                </div>
                            {/if}
                            {/if}


                        </div>
                    </div>
                </div>
                <div class="m-portlet__body m--hide" >&nbsp;</div>
            </div>
            <!--end::Portlet-->
        </div>


    {if $type == 'update'}

        <div class="col-xl-9 col-lg-8 m--padding-right-5" >
    {/if}
<div class="col-lg-12 " style="padding: 0px!important;">
    <div class="m-portlet m-portlet--tabs ">
        <div class="m-portlet__head">
            <div class="m-portlet__head-tools">
                <ul class="nav nav-tabs m-tabs-line    m-tabs-line--left   m-tabs-line--success" role="tablist">
                    {foreach from=$menu_tab item=row key=idx}
                        <li class="nav-item m-tabs__item tab-fuente">
                            <a class="nav-link m-tabs__link {if $row.active == 1}active{/if}"
                               data-toggle="tabajax"
                               data-target="#{$row.id_name}_pane"
                               id = "{$row.id_name}_tab"
                               href="{$getModule}&accion={$row.sub_control}_index&type={$type}&id={$id}"
                               role="tab">
                                <i class="{$row.icon}"></i> {$row.label}
                            </a>
                        </li>
                    {/foreach}
                </ul>
            </div>
        </div>
        <div class="tab-content">
            {foreach from=$menu_tab item=row key=idx}
                <div class="tab-pane {if $row.active == 1}active{/if}" id="{$row.id_name}_pane"></div>
            {/foreach}
        </div>
    </div>
</div>
    {if $type == 'update'}
        </div>

        <div class="col-xl-3 col-lg-4 m--padding-left-5">
            <div class="m-portlet m-portlet--full-height  ">
                <div class="m-portlet__body m--padding-10">
                    {include file="item/info.tpl"}
                </div>

            </div>
        </div>

    {/if}
    </div>

{else}
    {include file="$frontend_error_01"}
{/if}