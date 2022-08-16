<!-- {include file="lista/lista.tpl"}

{include file="index.css.tpl"} -->

{include file="index.css.tpl"}

{*if $item.itemId !="" *}

<div class="m-portlet m-portlet--tabs">

    <div class="m-portlet__head">
        <div class="m-portlet__head-tools">

            <ul class="nav nav-tabs        m-tabs-line    m-tabs-line--left   m-tabs-line--success"
                    {*class="nav nav-tabs        m-tabs-line   m-tabs-line--danger m-tabs-line--2x m-tabs-line--right"*}
                role="tablist">
                {foreach from=$menu_tab item=row}

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
<!--                 {if $row.id_name=='referencias'}
                 <li class="nav-item m-tabs__item nav-item dropdown">
                        <a class="nav-link m-tabs__link {if $row.active == 1}active{/if} dropdown-toggle"
                           data-toggle="dropdown"
                           id = "{$row.id_name}_tab"
                           href="{$getModule}&accion=itemUpdate&id=29&type=update#"
                           role="button">
                            <i class="{$row.icon}"></i> {$row.label}
                        </a>

                        <div class="dropdown-menu">
                {foreach from=$row.sub_tab item=subrow}
                          <a class="dropdown-item {if $subrow.active == 1}active{/if}"
                           data-toggle="tabajax"
                           data-target="#{$subrow.id_name}_pane"
                           id = "{$subrow.id_name}_tab"
                           href="{$getModule}&accion={$subrow.sub_control}_index&type=&id={$id}"
                           role="tab">
                            <i class="{$subrow.icon}"></i> {$subrow.label}
                            </a>
                {/foreach}

                </div>
                 </li>
                {else}
                {if $row.id_name=='familia'}

                 <li class="nav-item m-tabs__item nav-item dropdown">
                        <a class="nav-link m-tabs__link {if $row.active == 1}active{/if} dropdown-toggle"
                           data-toggle="dropdown"
                           id = "{$row.id_name}_tab"
                           href="#"
                           role="button">
                            <i class="{$row.icon}"></i> {$row.label}
                        </a>

                        <div class="dropdown-menu">
                {foreach from=$row.sub_tab item=subrow}
                          <a class="dropdown-item {if $subrow.active == 1}active{/if}"
                           data-toggle="tabajax"
                           data-target="#{$subrow.id_name}_pane"
                           id = "{$subrow.id_name}_tab"
                           href="{$getModule}&accion={$subrow.sub_control}_index&type={$type}&id={$id}"
                           role="tab">
                            <i class="{$subrow.icon}"></i> {$subrow.label}
                            </a>
                {/foreach}

                </div>
                 </li>
                {else}
                     <li class="nav-item m-tabs__item nav-item dropdown">
                        <a class="nav-link m-tabs__link {if $row.active == 1}active{/if}"
                           data-toggle="tabajax"
                           data-target="#{$row.id_name}_pane"
                           id = "{$row.id_name}_tab"
                           href="{$getModule}&accion={$row.sub_control}_index&type={$type}&id={$id}"
                           role="tab">
                            <i class="{$row.icon}"></i> {$row.label}
                        </a>
                    </li>
                {/if}
                     {/if} -->
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

{*else*}
<!--
    <div class="m-portlet m-portlet--mobile">
        <div class="m-portlet__body">
        No Exite una persona relacionada a este usuario
        </div>
    </div>
-->
{*/if*}
