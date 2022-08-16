{if ($item.itemId != 0 && $item.itemId != "" && $type == "update") || $type == "new"}

    {if $type == 'update'}
        {include file="item/info.tpl"}
    {/if}

    <div class="m-portlet m-portlet--tabs">

        <div class="m-portlet__head">
            <div class="m-portlet__head-tools">

                <ul class="nav nav-tabs m-tabs-line m-tabs-line--left m-tabs-line--success"
                    role="tablist">
                    {foreach from=$menu_tab item=row key=idx}
                        {*<li class="nav-item m-tabs__item">
                            <a class="nav-link m-tabs__link {if $row.active == 1}active{/if}"
                               data-toggle="tabajax"
                               data-target="#{$row.id_name}_pane"
                               id = "{$row.id_name}_tab"
                               href="{$getModule}&accion={$row.sub_control}_index&type={$type}&id={$id}"
                               role="tab">
                                <i class="{$row.icon}"></i> {$row.label}
                            </a>
                        </li>*}
                        <li class="nav-item m-tabs__item {if $row.sub_tab|@count gt 0}dropdown{/if}">
                            {if $row.sub_tab|@count gt 0}
                                <a class="nav-link m-tabs__link dropdown-toggle"
                                   data-toggle="dropdown"
                                   href="#"
                                   role="button"
                                   aria-haspopup="true" aria-expanded="false"><i class="{$row.icon}"></i> {$row.label}</a>
                                <div class="dropdown-menu">
                                    {foreach from=$row.sub_tab item=sub_row key=sub_idx}
                                        <a class="dropdown-item {if $sub_row.active == 1}active{/if}"
                                           data-toggle="tabajax"
                                           data-target="#{$sub_row.id_name}_pane"
                                           id = "{$sub_row.id_name}_tab"
                                           href="{$getModule}&accion={$sub_row.sub_control}_index&type={$type}&id={$id}"
                                           role="tab">
                                            <i class="{$sub_row.icon}"></i> {$sub_row.label}
                                        </a>
                                    {/foreach}
                                </div>
                            {else}
                                <a class="nav-link m-tabs__link {if $row.active == 1}active{/if}"
                                   data-toggle="tabajax"
                                   data-target="#{$row.id_name}_pane"
                                   id = "{$row.id_name}_tab"
                                   href="{$getModule}&accion={$row.sub_control}_index&type={$type}&id={$id}"
                                   role="tab">
                                    <i class="{$row.icon}"></i> {$row.label}
                                </a>
                            {/if}
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

    {if $type == 'update'}
        <div class="m-alert m-alert--icon m-alert--air m-alert--square alert alert-dismissible m--margin-bottom-30" role="alert">
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

<link rel="stylesheet" href="/js/leaflet/leaflet.css" />
<link rel="stylesheet" href="/js/leaflet/brunob-leaflet.fullscreen/Control.FullScreen.css" />