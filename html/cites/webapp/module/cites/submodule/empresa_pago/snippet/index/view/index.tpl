{include file="index.css.tpl"}


<div class="m-portlet  m-portlet--bordered-semi m--margin-bottom-5 ">
    <div class="m-portlet__head">
        <div class="m-portlet__head-caption">
            <div class="m-portlet__head-title">
                     <span class="m-portlet__head-icon">
                         <i class="la la-thumb-tack m--font-success"></i>
                     </span>
                 <h3 class="m-portlet__head-text">
                     {$item.empresa_tipo}
                     {if $type == 'update'}#Item: &nbsp; <strong><span class="m--font-success">{$item.itemId}</span></strong>{/if}
                 </h3>
             </div>
        </div>
    </div>
</div>

<div class="m-portlet m-portlet--tabs">

    <div class="m-portlet__head">

        <div class="m-portlet__head-tools">
            <ul class="nav nav-tabs        m-tabs-line    m-tabs-line--left   m-tabs-line--success" role="tablist">
                {foreach from=$menu_tab item=row key=idx}
                    <li class="nav-item m-tabs__item tab-fuente">
                        <a class="nav-link m-tabs__link {if $row.active == 1}active{/if}"
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


    <div class="tab-content">
        {foreach from=$menu_tab item=row key=idx}
            <div class="tab-pane {if $row.active == 1}active{/if}" id="{$row.id_name}_pane"></div>
        {/foreach}
    </div>

</div>