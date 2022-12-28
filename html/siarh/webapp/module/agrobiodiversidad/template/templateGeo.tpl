<!DOCTYPE html>
<html lang="en" >
<!-- begin::Head -->
<head>
    <meta charset="utf-8" />
    <title>
        {$module_conf.dashboard_titulo} - MMAyA - SIARH
    </title>
    <meta name="description" content="MMAyA - SIARH - {$module_conf.dashboard_titulo}">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!--begin::Page Vendors -->
    <link href="themes/metro/assets/vendors/custom/datatables/datatables.bundle.css" rel="stylesheet" type="text/css" />
    <!--end::Page Vendors -->

    <!--begin::Base Styles -->
    <link href="themes/metro/assets/vendors/base/vendors.bundle.css" rel="stylesheet" type="text/css" />
    <link href="themes/metro/assets/demo/default/base/style.bundle.css" rel="stylesheet" type="text/css" />
    <!--end::Base Styles -->
    <!--begin::Fonts Styles -->
    <link href="themes/fonts.css" rel="stylesheet" type="text/css" />
    <!--end::Fonts Styles -->

    <!--begin::Leaflet Styles -->
    <link href="js/leaflet/leaflet.css" rel="stylesheet" type="text/css" />
    <link href="js/leaflet/plugins/leaflet-panel-layers.src.css" rel="stylesheet" type="text/css" />
    <!-- <link href="js/leaflet/plugins/leaflet.label.css" rel="stylesheet" type="text/css" /> -->
    <link href="js/leaflet/plugins/leaflet-measure.css" rel="stylesheet" type="text/css" />
    <link href="js/leaflet/plugins/leaflet-Control.Coordinates.css" rel="stylesheet" type="text/css" />
    <link href="js/leaflet/plugins/leaflet.markercluster.css" rel="stylesheet" type="text/css" />
    <link href="js/leaflet/plugins/leaflet.markercluster.default.css" rel="stylesheet" type="text/css" />
    <!--end::Leaflet Styles -->

    <!--begin::c3js Styles -->
    <link href="js/c3js/c3.min.css" rel="stylesheet" type="text/css" />
    <!--end::c3js Styles -->

    <link rel="apple-touch-icon" sizes="180x180" href="/favicon/apple-touch-icon.png">
    <link rel="icon" type="image/png" href="/favicon/favicon-32x32.png" sizes="32x32">
    <link rel="icon" type="image/png" href="/favicon/favicon-16x16.png" sizes="16x16">
    <link rel="manifest" href="/favicon/manifest.json">
    <link rel="mask-icon" href="/favicon/safari-pinned-tab.svg" color="#5bbad5">

    {literal}
    <style>
        {/literal}{if $module_conf.menu_bgcolor != ''}{literal}
        .m-aside-left--skin-dark{background-color:{/literal}{$module_conf.menu_bgcolor}{literal} !important;}
        .m-brand--skin-dark{background-color:{/literal}{$module_conf.menu_bgcolor_logo}{literal} !important;}
        {/literal}{/if}{literal}

        {/literal}{if $module_conf.menu_bgcolor_active != ''}{literal}
        .m-aside-menu.m-aside-menu--skin-dark .m-menu__nav>.m-menu__item.m-menu__item--open{
            background-color:{/literal}{$module_conf.menu_bgcolor_active}{literal};
        }
        {/literal}{/if}{literal}

        {/literal}{if $module_conf.menu_bgcolor_over != ''}{literal}
        .m-aside-menu.m-aside-menu--skin-dark .m-menu__nav>.m-menu__item:not(.m-menu__item--parent):not(.m-menu__item--open):not(.m-menu__item--expanded):not(.m-menu__item--active):hover{
            background-color:{/literal}{$module_conf.menu_bgcolor_over}{literal};
        }
        {/literal}{/if}{literal}

        {/literal}{if $module_conf.menu_link_ico_active != ''}{literal}
        .m-aside-menu.m-aside-menu--skin-dark .m-menu__nav>.m-menu__item.m-menu__item--expanded>.m-menu__heading .m-menu__link-icon,.m-aside-menu.m-aside-menu--skin-dark .m-menu__nav>.m-menu__item.m-menu__item--expanded>.m-menu__link .m-menu__link-icon{color:{/literal}{$module_conf.menu_link_ico_active}{literal};}
        .m-aside-menu.m-aside-menu--skin-dark .m-menu__nav>.m-menu__item.m-menu__item--expanded>.m-menu__heading .m-menu__link-text,.m-aside-menu.m-aside-menu--skin-dark .m-menu__nav>.m-menu__item.m-menu__item--expanded>.m-menu__link .m-menu__link-text{color:{/literal}{$module_conf.menu_link_ico_active}{literal};}
        {/literal}{/if}{literal}


        {/literal}{if $module_conf.menu_link_text != ''}{literal}
        .m-aside-menu.m-aside-menu--skin-dark .m-menu__nav>.m-menu__item>.m-menu__heading .m-menu__link-text,.m-aside-menu.m-aside-menu--skin-dark .m-menu__nav>.m-menu__item>.m-menu__link .m-menu__link-text{color:{/literal}{$module_conf.menu_link_text}{literal};}
        {/literal}{/if}{literal}
        {/literal}{if $module_conf.menu_link_ico != ''}{literal}
        .m-aside-menu.m-aside-menu--skin-dark .m-menu__nav>.m-menu__item>.m-menu__heading .m-menu__link-icon,.m-aside-menu.m-aside-menu--skin-dark .m-menu__nav>.m-menu__item>.m-menu__link .m-menu__link-icon{color:{/literal}{$module_conf.menu_link_ico}{literal};}
        {/literal}{/if}{literal}
        {/literal}{if $module_conf.menu_link_arrow != ''}{literal}
        .m-aside-menu.m-aside-menu--skin-dark .m-menu__nav>.m-menu__item>.m-menu__heading .m-menu__ver-arrow,.m-aside-menu.m-aside-menu--skin-dark .m-menu__nav>.m-menu__item>.m-menu__link .m-menu__ver-arrow{color:{/literal}{$module_conf.menu_link_arrow}{literal};}
        {/literal}{/if}{literal}

        {/literal}{if $module_conf.menu_link_ico_over != ''}{literal}
        .m-aside-menu.m-aside-menu--skin-dark .m-menu__nav>.m-menu__item:not(.m-menu__item--parent):not(.m-menu__item--open):not(.m-menu__item--expanded):not(.m-menu__item--active):hover>.m-menu__heading .m-menu__link-icon,.m-aside-menu.m-aside-menu--skin-dark .m-menu__nav>.m-menu__item:not(.m-menu__item--parent):not(.m-menu__item--open):not(.m-menu__item--expanded):not(.m-menu__item--active):hover>.m-menu__link .m-menu__link-icon{color:{/literal}{$module_conf.menu_link_ico_over}{literal};}
        {/literal}{/if}{literal}
        {/literal}{if $module_conf.menu_link_text_over != ''}{literal}
        .m-aside-menu.m-aside-menu--skin-dark .m-menu__nav>.m-menu__item:not(.m-menu__item--parent):not(.m-menu__item--open):not(.m-menu__item--expanded):not(.m-menu__item--active):hover>.m-menu__heading .m-menu__link-text,.m-aside-menu.m-aside-menu--skin-dark .m-menu__nav>.m-menu__item:not(.m-menu__item--parent):not(.m-menu__item--open):not(.m-menu__item--expanded):not(.m-menu__item--active):hover>.m-menu__link .m-menu__link-text{color:{/literal}{$module_conf.menu_link_text_over}{literal};}
        {/literal}{/if}{literal}

        .m-aside-menu.m-aside-menu--skin-dark .m-menu__nav>.m-menu__item.m-menu__item--open>.m-menu__heading .m-menu__link-icon,.m-aside-menu.m-aside-menu--skin-dark .m-menu__nav>.m-menu__item.m-menu__item--open>.m-menu__link .m-menu__link-icon{color:{/literal}{$module_conf.menu_link_ico_active}{literal};}
        .m-aside-menu.m-aside-menu--skin-dark .m-menu__nav>.m-menu__item.m-menu__item--open>.m-menu__heading .m-menu__link-text,.m-aside-menu.m-aside-menu--skin-dark .m-menu__nav>.m-menu__item.m-menu__item--open>.m-menu__link .m-menu__link-text{color:{/literal}{$module_conf.menu_link_text_active}{literal};}
        .m-aside-menu.m-aside-menu--skin-dark .m-menu__nav>.m-menu__item.m-menu__item--open>.m-menu__heading .m-menu__ver-arrow,.m-aside-menu.m-aside-menu--skin-dark .m-menu__nav>.m-menu__item.m-menu__item--open>.m-menu__link .m-menu__ver-arrow{color:{/literal}{$module_conf.menu_link_arrow_active}{literal};}

        .m-aside-menu.m-aside-menu--skin-dark .m-menu__nav>.m-menu__item .m-menu__submenu .m-menu__item>.m-menu__heading .m-menu__link-text,.m-aside-menu.m-aside-menu--skin-dark .m-menu__nav>.m-menu__item .m-menu__submenu .m-menu__item>.m-menu__link .m-menu__link-text{color:{/literal}{$module_conf.submenu_link_ico}{literal};}
        .m-aside-menu.m-aside-menu--skin-dark .m-menu__nav>.m-menu__item .m-menu__submenu .m-menu__item>.m-menu__heading .m-menu__link-icon,.m-aside-menu.m-aside-menu--skin-dark .m-menu__nav>.m-menu__item .m-menu__submenu .m-menu__item>.m-menu__link .m-menu__link-icon{color:{/literal}{$module_conf.submenu_link_text}{literal};}
        .m-aside-menu.m-aside-menu--skin-dark .m-menu__nav>.m-menu__item .m-menu__submenu .m-menu__item>.m-menu__heading .m-menu__ver-arrow,.m-aside-menu.m-aside-menu--skin-dark .m-menu__nav>.m-menu__item .m-menu__submenu .m-menu__item>.m-menu__link .m-menu__ver-arrow{color:{/literal}{$module_conf.submenu_link_arrow}{literal};}

        {/literal}{if $module_conf.submenu_link_ico_over != ''}{literal}
        .m-aside-menu.m-aside-menu--skin-dark .m-menu__nav>.m-menu__item .m-menu__submenu .m-menu__item:not(.m-menu__item--parent):not(.m-menu__item--open):not(.m-menu__item--expanded):not(.m-menu__item--active):hover>.m-menu__heading .m-menu__link-text,.m-aside-menu.m-aside-menu--skin-dark .m-menu__nav>.m-menu__item .m-menu__submenu .m-menu__item:not(.m-menu__item--parent):not(.m-menu__item--open):not(.m-menu__item--expanded):not(.m-menu__item--active):hover>.m-menu__link .m-menu__link-text{color:{/literal}{$module_conf.submenu_link_ico_over}{literal};}
        .m-aside-menu.m-aside-menu--skin-dark .m-menu__nav>.m-menu__item .m-menu__submenu .m-menu__item:not(.m-menu__item--parent):not(.m-menu__item--open):not(.m-menu__item--expanded):not(.m-menu__item--active):hover>.m-menu__heading .m-menu__link-icon,.m-aside-menu.m-aside-menu--skin-dark .m-menu__nav>.m-menu__item .m-menu__submenu .m-menu__item:not(.m-menu__item--parent):not(.m-menu__item--open):not(.m-menu__item--expanded):not(.m-menu__item--active):hover>.m-menu__link .m-menu__link-icon{color:{/literal}{$module_conf.submenu_link_ico_over}{literal};}
        {/literal}{/if}{literal}

        .m-aside-menu.m-aside-menu--skin-dark .m-menu__nav>.m-menu__item .m-menu__submenu .m-menu__item.m-menu__item--active>.m-menu__heading .m-menu__link-text,.m-aside-menu.m-aside-menu--skin-dark .m-menu__nav>.m-menu__item .m-menu__submenu .m-menu__item.m-menu__item--active>.m-menu__link .m-menu__link-text{color:{/literal}{$module_conf.submenu_link_ico_over_active}{literal};}
        .m-aside-menu.m-aside-menu--skin-dark .m-menu__nav>.m-menu__item .m-menu__submenu .m-menu__item.m-menu__item--active>.m-menu__heading .m-menu__link-icon,.m-aside-menu.m-aside-menu--skin-dark .m-menu__nav>.m-menu__item .m-menu__submenu .m-menu__item.m-menu__item--active>.m-menu__link .m-menu__link-icon{color:{/literal}{$module_conf.submenu_link_text_over_active}{literal};}
        .m-aside-menu.m-aside-menu--skin-dark .m-menu__nav>.m-menu__item .m-menu__submenu .m-menu__item.m-menu__item--active>.m-menu__heading .m-menu__ver-arrow,.m-aside-menu.m-aside-menu--skin-dark .m-menu__nav>.m-menu__item .m-menu__submenu .m-menu__item.m-menu__item--active>.m-menu__link .m-menu__ver-arrow{color:{/literal}{$module_conf.submenu_link_arrow_over_active}{literal};}

        {/literal}{if $module_conf.menu_link_ico != ''}{literal}
        .m-aside-left--minimize .m-aside-menu.m-aside-menu--skin-dark .m-menu__nav>.m-menu__item{background:0 0}.m-aside-left--minimize .m-aside-menu.m-aside-menu--skin-dark .m-menu__nav>.m-menu__item>.m-menu__link>.m-menu__link-icon{color:{/literal}{$module_conf.menu_link_ico}{literal};}
        .m-brand.m-brand--skin-dark .m-brand__tools .m-brand__icon>i{color:{/literal}{$module_conf.menu_link_ico}{literal};}
        .m-brand.m-brand--skin-dark .m-brand__tools .m-brand__toggler span{background:{/literal}{$module_conf.menu_link_ico}{literal};}
        .m-brand.m-brand--skin-dark .m-brand__tools .m-brand__toggler span::after,.m-brand.m-brand--skin-dark .m-brand__tools .m-brand__toggler span::before{background:{/literal}{$module_conf.menu_link_ico}{literal};}
        {/literal}{/if}{literal}

        {/literal}{if $module_conf.submenu_link_ico_over != ''}{literal}
        .m-brand.m-brand--skin-dark .m-brand__tools .m-brand__toggler:hover span{background:{/literal}{$module_conf.submenu_link_ico_over}{literal}}
        .m-brand.m-brand--skin-dark .m-brand__tools .m-brand__toggler:hover span::after,.m-brand.m-brand--skin-dark .m-brand__tools .m-brand__toggler:hover span::before{background:{/literal}{$module_conf.submenu_link_ico_over}{literal}}
        .m-aside-left--minimize .m-aside-menu.m-aside-menu--skin-dark .m-menu__nav>.m-menu__item:hover{background:0 0}.m-aside-left--minimize .m-aside-menu.m-aside-menu--skin-dark .m-menu__nav>.m-menu__item:hover>.m-menu__link>.m-menu__link-icon{color:{/literal}{$module_conf.submenu_link_ico_over}{literal} !important;}
        {/literal}{/if}{literal}

        {/literal}{if $module_conf.submenu_link_ico_over_active != ''}{literal}
        .m-brand.m-brand--skin-dark .m-brand__tools .m-brand__toggler.m-brand__toggler--active span{background:{/literal}{$module_conf.submenu_link_ico_over_active}{literal}}
        .m-brand.m-brand--skin-dark .m-brand__tools .m-brand__toggler.m-brand__toggler--active span::after,.m-brand.m-brand--skin-dark .m-brand__tools .m-brand__toggler.m-brand__toggler--active span::before{background:{/literal}{$module_conf.submenu_link_ico_over_active}{literal}}
        {/literal}{/if}{literal}

        .m-aside-left-close.m-aside-left-close--skin-dark{background-color:{/literal}{$module_conf.menu_bgcolor}{literal};}

        {/literal}{if $module_conf.menu_link_ico != ''}{literal}
        .m-aside-left-close.m-aside-left-close--skin-dark>i{color:{/literal}{$module_conf.menu_link_ico}{literal};}
        .m-aside-menu.m-aside-menu--skin-dark .m-menu__nav>.m-menu__section .m-menu__section-text{color:{/literal}{$module_conf.menu_link_ico}{literal};}
        {/literal}{/if}{literal}

        {/literal}{if $module_conf.submenu_link_ico_over_active != ''}{literal}
        .m-aside-left--minimize .m-aside-menu.m-aside-menu--skin-dark .m-menu__nav>.m-menu__item.m-menu__item--hover>.m-menu__link>.m-menu__link-icon,.m-aside-left--minimize .m-aside-menu.m-aside-menu--skin-dark .m-menu__nav>.m-menu__item.m-menu__item--open>.m-menu__link>.m-menu__link-icon{color:{/literal}{$module_conf.submenu_link_ico_over_active}{literal};}
        .m-aside-left--minimize .m-aside-menu.m-aside-menu--skin-dark .m-menu__nav>.m-menu__item.m-menu__item--active>.m-menu__link>.m-menu__link-icon,.m-aside-left--minimize .m-aside-menu.m-aside-menu--skin-dark .m-menu__nav>.m-menu__item.m-menu__item--expanded>.m-menu__link>.m-menu__link-icon{color:{/literal}{$module_conf.submenu_link_ico_over_active}{literal};}
        {/literal}{/if}{literal}

        .loader {
            border: 16px solid #f3f3f3; /* Light grey */
            border-top: 16px solid #3498db; /* Blue */
            border-radius: 50%;
            width: 120px;
            height: 120px;
            animation: spin 2s linear infinite;
        }

        @keyframes spin {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }
    </style>

    {/literal}
</head>
<!-- end::Head -->
<!-- end::Body -->
{*<body  class="m-page--fluid m--skin- m-content--skin-light2 m-header--fixed m-header--fixed-mobile m-aside-left--enabled m-aside-left--skin-dark m-aside-left--offcanvas m-footer--push m-aside--offcanvas-default"  >*}
<body class="m-page--fluid m--skin- m-page--loading m-page--loading-enabled
m-content--skin-light2 m-header--fixed m-header--fixed-mobile m-aside-left--enabled m-aside-left--skin-dark m-aside-left--fixed m-aside-left--offcanvas
 m-footer--push m-aside--offcanvas-default {*m-aside-left--minimize m-brand--minimize*}" >
<!-- begin::Page loader -->
<div class="m-page-loader m-page-loader--base">
    <div class="m-blockui">
        <span>Cargando SIARH...</span>
        <span><div class="m-loader m-loader--success"></div></span>
        {*<div class="loader"></div>*}
    </div>
</div>
<!-- end::Page Loader -->

    {include file="$subpage"}

{*<div class="m-content"></div>*}

<!-- begin::Scroll Top -->
<div id="m_scroll_top" class="m-scroll-top">
    <i class="la la-arrow-up"></i>
</div>
<!-- end::Scroll Top -->

<!--begin::Base Scripts -->
<script src="themes/metro/assets/vendors/base/vendors.bundle.js" type="text/javascript"></script>
<script src="themes/metro/assets/demo/default/base/scripts.bundle.js" type="text/javascript"></script>
<!--end::Base Scripts -->

<!--begin::Page Vendors -->
<script src="themes/metro/assets/vendors/custom/datatables/datatables.bundle.js" type="text/javascript"></script>
<!--end::Page Vendors -->

<!--begin::number -->
<!-- <script src="js/jquery.number/jquery.number.min.js" type="text/javascript"></script> -->
<!--end::number -->

<!--begin::number -->
<script src="js/jquery.number/jquery.number.min.js" type="text/javascript"></script>
<!--end::number -->

<!--begin::Google -->
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBqv2Y6BHPamq9Qa-hpt2EsQfYWpXzxFxo" type="text/javascript"></script>
<!--end::Google -->

<!--begin::Shapefile-JS -->
<script src="js/shapefile-js/dist/shp.min.js" type="text/javascript"></script>
<!--end::Shapefile-JS -->

<!--begin::Leaflet -->
<script src="js/leaflet/leaflet.js" type="text/javascript"></script>
<script src="js/leaflet/plugins/leaflet-bing-layer.js" type="text/javascript"></script>
<script src="js/leaflet/plugins/leaflet.select-layers.min.js" type="text/javascript"></script>
<script src="js/leaflet/plugins/leaflet-panel-layers.src.js" type="text/javascript"></script>
<!-- <script src="js/leaflet/plugins/leaflet-google.js" type="text/javascript"></script> -->
<script src="js/leaflet/plugins/Leaflet.GoogleMutant.js" type="text/javascript"></script>
<script src="js/leaflet/plugins/leaflet.shpfile.js" type="text/javascript"></script>
<!-- <script src="js/leaflet/plugins/leaflet.label.js" type="text/javascript"></script> -->
<script src="js/leaflet/plugins/leaflet-measure.es.js" type="text/javascript"></script>
<script src="js/leaflet/plugins/leaflet-Control.Coordinates.js" type="text/javascript"></script>
<script src="js/leaflet/plugins/leaflet.markercluster.min.js" type="text/javascript"></script>
<script src="js/leaflet/plugins/easyPrint.js" type="text/javascript"></script>
<!--end::Leaflet -->

<!--begin::FileSaver -->
<script src="js/FileSaver.js-master/dist/FileSaver.min.js" type="text/javascript"></script>
<!--end::FileSaver -->

<!--begin::DomToImage -->
<script src="js/dom-to-image-master/dist/dom-to-image.min.js" type="text/javascript"></script>
<!--end::DomToImage -->

<!--begin::x2js -->
<script src="js/x2js/xml2json.min.js" type="text/javascript"></script>
<!--end::x2js -->

<!--begin::Page Snippets -->
{include file="$subpage_js"}
<!--end::Page Snippets -->

<!--begin::Datepicker Spanish Translate -->
<script src="language/datepicker.spanish.js" type="text/javascript"></script>
<!--end::Datepicker Spanish Translate -->

<!-- begin::Page Loader -->
{literal}
<script>
    $(window).on('load', function() {
        $('body').removeClass('m-page--loading');
    });
</script>
{/literal}
<!-- end::Page Loader -->

</body>
<!-- end::Body -->
</html>