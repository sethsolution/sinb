{include file="index.css.tpl"}



<div id="sidebar" class="leaflet-sidebar collapsed" style="z-index: 10 !important">
    <!-- Nav tabs -->
    <div class="leaflet-sidebar-tabs menuizq">
        <ul role="tablist">
            <li><a href="#home" role="tab"><i class="text-primary fa fa-search"></i></a></li>
            {foreach from=$menu_tab item=row key=idx}
                <li><a href="#{$row.id_name}" role="tab"
                       data-toggle="tabajax"
                       data-target="{$row.id_name}"
                       {*data-href="{$getModule}&accion={$row.sub_control}_index"*}
                       data-href="{$path_url}/{$row.id_name}_/{$id}"
                    ><i class="text-primary {$row.icon}"></i></a></li>
            {/foreach}
        </ul>

        <ul role="tablist">
            <li><a href="#settings" role="tab"><i class="fa fa-laptop-code"></i></a></li>
        </ul>
    </div>

    <!-- Tab panes -->
    <div class="leaflet-sidebar-content menuizq">
        <div class="leaflet-sidebar-pane" id="home">
            <h1 class="leaflet-sidebar-header">Filtros <span class="leaflet-sidebar-close"><i class="text-white k_i ki-bold-arrow-back"></i></span></h1>
            {include file="bar/op01.tpl"}
        </div>

        {foreach from=$menu_tab item=row key=idx}
            <div class="leaflet-sidebar-pane" id="{$row.id_name}">
                <h1 class="leaflet-sidebar-header">{$row.label} <span class="leaflet-sidebar-close"><i class="text-white ki ki-bold-arrow-back"></i></span></h1>
                <div id="{$row.id_name}_pane"></div>
            </div>
        {/foreach}

        <div class="leaflet-sidebar-pane" id="settings">
            <h1 class="leaflet-sidebar-header">Configuración <span class="leaflet-sidebar-close"><i class="text-white ki ki-bold-arrow-back"></i></span></h1>
        </div>
    </div>
</div>
<div id="map" class=""></div>


<!-- begin::panel menú -->
{*
<div id="panel_menu" class="panel_menu ">
    <div class="btn-group btn-group-circle">
        <button id="btn_mostrar_ventana_poly" type="button" class="btn btn-default btn-sm" title="Abre la ventana de filtros">
            <i class="fa fa-plus"></i>&nbsp;POLÍGONOS
            <button id="btn_mostrar_ventana_filtros" type="button" class="btn btn-default btn-sm" title="Abre la ventana de filtros">
                <i class="fa fa-filter"></i>&nbsp;FILTROS
            </button>
            <button id="btn_mostrar_ventana_reportes" type="button" class="btn btn-default btn-sm" title="Abre la ventana de filtros">
                <i class="fa fa-file"></i>&nbsp;REPORTES
            </button>
            <button id="btn_center_map" type="button" class="btn btn-default btn-sm" title="Centra el mapa a su posición inicial">
                <i class="fa fa-expand"></i>
            </button>
            <button id="btn_show_layer_window" type="button" class="btn btn-primary btn-sm" title="Abre la ventana de capas">
                <i class="fa fa-globe"></i>&nbsp;CAPAS
            </button>
    </div>
</div>
*}
<!-- end::panel menú -->


