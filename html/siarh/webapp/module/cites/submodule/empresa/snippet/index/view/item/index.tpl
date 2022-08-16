{include file="item/index.css.tpl"}
{if ($item.itemId != 0 && $item.itemId != "" && $type == "update") || $type == "new"}



    <div class="row m--margin-bottom-5">

        <div class="col-lg-12">
            <!--begin::Portlet-->
            <div class="m-portlet m-portlet--last m-portlet--head-lg m-portlet--responsive-mobile" id="main_portlet">
                <div class="m-portlet__head">
                    <div class="m-portlet__head-progress">

                        <!-- here can place a progress bar-->
                    </div>
                    <div class="m-portlet__head-wrapper">
                        <div class="m-portlet__head-caption">


                            <a href="index.php?module={$miga.modulo.carpeta}&smodule={$miga.smodulo.carpeta}"
                               class="btn btn-secondary m-btn m-btn--icon m-btn--wide m-btn--md m--margin-right-10">
                                <span><i class="la la-arrow-left"></i><span>Volver</span></span>
                            </a>
                            {*
                            <div class="m-portlet__head-title">
                             <span class="m-portlet__head-icon"><i class="la la-thumb-tack m--font-success"></i></span>
                                <h3 class="m-portlet__head-text">
                                    {if $type == 'update'}#Item: &nbsp; <strong><span class="m--font-success">{$item.itemId}</span></strong>{/if}
                                </h3>
                            </div>
    *}

                        </div>

                        <div class="m-portlet__head-tools">
                            {*
                            <a href="index.php?module={$miga.modulo.carpeta}&smodule={$miga.smodulo.carpeta}"
                               class="btn btn-secondary m-btn m-btn--icon m-btn--wide m-btn--md m--margin-right-10">
                                <span><i class="la la-arrow-left"></i><span>Volver</span></span>
                            </a>
    *}
                            {if $item.estado_id == 2 }
                                <a href="#" class="btn btn-primary m-btn m-btn--icon m-btn--wide m-btn--md m--margin-right-10 m--hide"
                                   id="btn_obs_enviar" rel="new" >
                                    <span><i class="fa fa-plus"></i><span>Enviar Observación</span></span>
                                </a>
                            {/if}

                            {if $item.estado_id == 2 }
                                <a href="#" class="btn btn-success m-btn m-btn--icon m-btn--wide m-btn--md m--margin-right-10 m--hide"
                                   id="btn_aprobar" rel="new">
                                    <span><i class="fa fa-plus"></i><span>Aprobar solicitud</span></span>
                                </a>
                            {/if}
                        </div>
                    </div>
                </div>
                <div class="m-portlet__body m--hide" >&nbsp;</div>
            </div>
            <!--end::Portlet-->
        </div>


    {if $type == 'update'}
    <div class="col-xl-9 col-lg-8 m--padding-right-5 m--margin-bottom-5 m--padding-bottom-5 " >
    {/if}

     <div class="col-lg-12 " style="padding: 0px!important;">
    <div class="m-portlet m-portlet--tabs">

        <div class="m-portlet__head">
            <div class="m-portlet__head-tools">

                <ul class="nav nav-tabs m-tabs-line m-tabs-line--left m-tabs-line--success" role="tablist">
                    {foreach from=$menu_tab item=row key=idx}
                        <li class="nav-item m-tabs__item">
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
        <div class="col-xl-3 col-lg-4 m--padding-left-5 m--margin-bottom-5 m--padding-bottom-5">
            <div class="m-portlet m-portlet--full-height  m--margin-bottom-5 m--padding-bottom-5">
                <div class="m-portlet__body m--padding-10 ">
                    {include file="item/info.tpl"}
                </div>
            </div>
        </div>
    {/if}


    </div>

    {if $type == 'update'}
        <div class="col-lg-12 m-alert m-alert--icon m-alert--air m-alert--square alert alert-dismissible m--margin-bottom-5 " role="alert">
            <div class="m-alert__icon col-md" title="informacion">
                <i class="la la-hand-o-right m--font-success"></i>
            </div>
            <div class="m-alert__text col-lg-6 ">

                Fecha de Creación:  <span class="m--font-primary">{$item.dateCreate|date_format:"%d/%m/%y %H:%M:%S"}</span>
                Fecha de Actualización:  <span class="m--font-primary">{$item.dateUpdate|date_format:"%d/%m/%y %H:%M:%S"}</span>
                <br>
                Creador : <span class="m--font-primary">{$item.userCreater}</span>
                Actualizador : <span class="m--font-primary">{$item.userUpdater}</span>
            </div>
        </div>
    {/if}

{else}
    {include file="$frontend_error_01"}
{/if}

