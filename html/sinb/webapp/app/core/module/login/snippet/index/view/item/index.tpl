{if ($item.itemId != 0 && $item.itemId != "" && $type eq "update") || $type eq "new"}

    {if $type eq 'update'}
        {include file="item/info.tpl"}
    {/if}

    <div class="m-portlet m-portlet--tabs">

        <div class="m-portlet__head">
            <div class="m-portlet__head-tools">

                <ul class="nav nav-tabs        m-tabs-line    m-tabs-line--left   m-tabs-line--success"
                        {*class="nav nav-tabs        m-tabs-line   m-tabs-line--danger m-tabs-line--2x m-tabs-line--right"*}
                    role="tablist">
                    {foreach from=$menu_tab item=row key=idx}
                        <li class="nav-item m-tabs__item">
                            <a class="nav-link m-tabs__link {if $row.active eq 1}active{/if}"
                               data-toggle="tabajax"
                               data-target="#{$row.id_name}_pane"
                               id = "{$row.id_name}_tab"
                               href="{$getModule}&accion={$row.id_name}_index&type={$type}&id={$id}"
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
                <div class="tab-pane {if $row.active eq 1}active{/if}" id="{$row.id_name}_pane"></div>
            {/foreach}
        </div>


    </div>

    {if $type eq 'update'}
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
    {include file=$frontend.error_01}
{/if}

