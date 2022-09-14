{include file="index.css.tpl"}

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
                            <h3 class="m-portlet__head-text">{$item.empresa_tipo}</h3>
                        </div>
                    </div>

                    <div class="m-portlet__head-tools">
                       {* {if ($item.estado_id == 1 or $item.estado_id == 3) and $item.tipo_id != 11}*}
                        {if ($item.estado_id == 1 or $item.estado_id == 3)}
                            <a href="#" class="btn btn-success m-btn m-btn--icon m-btn--wide m-btn--md m--margin-right-10"
                               id="btn_enviar" rel="new">
                                <span><i class="fa fa-plus"></i><span>ENVIAR INFORMACIÓN</span></span>
                            </a>
                            {else}{if $item.estado_id == 2}

                        <div class="alert m-alert m-alert--icon m-alert--outline  msg-top-verde" role="alert">

                            <div class="m-alert__icon">
                                <i class="la la-warning"></i>
                            </div>
                            <div class="m-alert__text">
                                <strong>Su solicitud fue enviada con éxito,</strong>
                                espere a recibir una notificación.
                            </div>

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
    <div class="col-lg-9"  >
        <div class="m-portlet m-portlet--tabs ">
            <div class="m-portlet__head">
                <div class="m-portlet__head-tools">
                    <ul class="nav nav-tabs m-tabs-line m-tabs-line--left m-tabs-line--success" role="tablist">
                        {foreach from=$menu_tab item=row key=idx}
                            <li class="nav-item m-tabs__item tab-fuente">
                                <a class="nav-link m-tabs__link {if $row.active == 1}active{/if}
                                  "
                                   data-toggle="tabajax"
                                   data-target="#{$row.id_name}_pane"
                                   id = "{$row.id_name}_tab"
                                   href="{$path_url}/{$row.sub_control}_/"
                                   role="tab">
                                    <i class="{$row.icon}"></i> {$row.label}
                                </a>
                            </li>
                        {/foreach}
                    </ul>
                </div>
            </div>

            <div class="tab-content" >
                {foreach from=$menu_tab item=row key=idx}
                    <div class="tab-pane {if $row.active == 1}active{/if}  m--padding-bottom-5"
                         id="{$row.id_name}_pane"></div>
                {/foreach}
            </div>

        </div>
    </div>

    <div class="col-lg-3">
        <div class="m-portlet m-portlet--full-height  ">
            <div class="m-portlet__body m--padding-10">
                {include file="info.tpl"}
            </div>
        </div>
    </div>

</div>