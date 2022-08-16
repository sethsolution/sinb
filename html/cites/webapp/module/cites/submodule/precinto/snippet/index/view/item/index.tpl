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
                            <div class="m-portlet__head-title">
                                <span class="m-portlet__head-icon"><i class="la la-thumb-tack m--font-success"></i></span>
                                <h3 class="m-portlet__head-text">ID: {$item.itemId}</h3>
                            </div>
                        </div>

                        <div class="m-portlet__head-tools">
                            <a href="/{$miga.modulo.carpeta}/{$miga.smodulo.carpeta}/"
                               class="btn btn-secondary m-btn m-btn--icon m-btn--wide m-btn--md m--margin-right-10">
                                <span><i class="la la-arrow-left"></i><span>Volver</span></span>
                            </a>
                            <a href="/{$miga.modulo.carpeta}/{$miga.smodulo.carpeta}/" id="btn_imprime"
                               class="btn btn-primary m-btn m-btn--icon m-btn--wide m-btn--md m--margin-right-10">
                                <span><i class="fa fa-print"></i><span>Impresión de inicio de tramite</span></span>
                            </a>
                            {if $item.estado_id == 1 or $item.estado_id == 3}
                                <a href="#" class="btn btn-primary m-btn m-btn--icon m-btn--wide m-btn--md m--margin-right-10"
                                   id="btn_enviar" rel="new">
                                    <span><i class="fa fa-plus"></i><span>ENVIO DE LA SOLICITUD</span></span>
                                </a>
                                {else}
                                {if $item.estado_id == 2}
                                    <div class="cuadro-verde m--padding-10 m--margin-bottom-10" style=" height: 50%">
                                        <div class="titulo m--margin-bottom-5 m--padding-left-5 m--font-bold">Su solicitud fue enviada con éxito, espere a recibir una notificación.</div>
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
                                    {if $type == 'update'}
                                        href="{$path_url}/{$row.sub_control}_/{$id}"
                                    {else}
                                        href="{$path_url}/{$row.sub_control}_/nuevo/"
                                    {/if}
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

