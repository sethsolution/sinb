<!DOCTYPE html>
<html lang="en" >
<!-- begin::Head -->
<head>
    <meta charset="utf-8" />
    <title>
        {$module_conf.dashboard_titulo} ----
    </title>
    <meta name="description" content="UYUNI - {$module_conf.dashboard_titulo}">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!--begin::Page Vendors -->
    <link href="/themes/metro/assets/vendors/custom/datatables/datatables.bundle.css?id=323d" rel="stylesheet" type="text/css" />
    <!--end::Page Vendors -->

    <!--begin::Base Styles -->
    <link href="/themes/metro/assets/vendors/base/vendors.bundle.css?id=323d" rel="stylesheet" type="text/css" />
    <link href="/themes/metro/assets/demo/default/base/style.bundle.css?id=323d" rel="stylesheet" type="text/css" />
    <!--end::Base Styles -->
    <!--begin::Fonts Styles -->
    <link href="/themes/fonts.css?id=323d" rel="stylesheet" type="text/css" />
    <!--end::Fonts Styles -->

    <link href="/module/cites/template/css/main.css?id=323d" rel="stylesheet" type="text/css" />

    <link rel="apple-touch-icon" sizes="180x180" href="/favicon/apple-touch-icon.png">
    <link rel="icon" type="image/png" href="/favicon/favicon-32x32.png" sizes="32x32">
    <link rel="icon" type="image/png" href="/favicon/favicon-16x16.png" sizes="16x16">
    <link rel="manifest" href="/favicon/manifest.json">
    <link rel="mask-icon" href="/favicon/safari-pinned-tab.svg" color="#5bbad5">

    {literal}
    <style>
        .loader {
            border: 16px solid #f3f3f3; /* Light grey */
            border-top: 16px solid #3498db; /* Blue */
            border-radius: 50%;
            width: 120px;
            height: 120px;
            animation: spin 2s linear infinite;
        }
        .titulo1 {
            font-family: inherit !important;
        }

        @keyframes spin {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }




        .sk-folding-cube {
            margin: 20px auto;
            width: 40px;
            height: 40px;
            position: relative;
            -webkit-transform: rotateZ(45deg);
            transform: rotateZ(45deg);
        }

        .sk-folding-cube .sk-cube {
            float: left;
            width: 50%;
            height: 50%;
            position: relative;
            -webkit-transform: scale(1.1);
            -ms-transform: scale(1.1);
            transform: scale(1.1);
        }
        .sk-folding-cube .sk-cube:before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: #333;
            -webkit-animation: sk-foldCubeAngle 2.4s infinite linear both;
            animation: sk-foldCubeAngle 2.4s infinite linear both;
            -webkit-transform-origin: 100% 100%;
            -ms-transform-origin: 100% 100%;
            transform-origin: 100% 100%;
        }
        .sk-folding-cube .sk-cube2 {
            -webkit-transform: scale(1.1) rotateZ(90deg);
            transform: scale(1.1) rotateZ(90deg);
        }
        .sk-folding-cube .sk-cube3 {
            -webkit-transform: scale(1.1) rotateZ(180deg);
            transform: scale(1.1) rotateZ(180deg);
        }
        .sk-folding-cube .sk-cube4 {
            -webkit-transform: scale(1.1) rotateZ(270deg);
            transform: scale(1.1) rotateZ(270deg);
        }
        .sk-folding-cube .sk-cube2:before {
            -webkit-animation-delay: 0.3s;
            animation-delay: 0.3s;
        }
        .sk-folding-cube .sk-cube3:before {
            -webkit-animation-delay: 0.6s;
            animation-delay: 0.6s;
        }
        .sk-folding-cube .sk-cube4:before {
            -webkit-animation-delay: 0.9s;
            animation-delay: 0.9s;
        }
        @-webkit-keyframes sk-foldCubeAngle {
            0%, 10% {
                -webkit-transform: perspective(140px) rotateX(-180deg);
                transform: perspective(140px) rotateX(-180deg);
                opacity: 0;
            } 25%, 75% {
                  -webkit-transform: perspective(140px) rotateX(0deg);
                  transform: perspective(140px) rotateX(0deg);
                  opacity: 1;
              } 90%, 100% {
                    -webkit-transform: perspective(140px) rotateY(180deg);
                    transform: perspective(140px) rotateY(180deg);
                    opacity: 0;
                }
        }

        @keyframes sk-foldCubeAngle {
            0%, 10% {
                -webkit-transform: perspective(140px) rotateX(-180deg);
                transform: perspective(140px) rotateX(-180deg);
                opacity: 0;
            } 25%, 75% {
                  -webkit-transform: perspective(140px) rotateX(0deg);
                  transform: perspective(140px) rotateX(0deg);
                  opacity: 1;
              } 90%, 100% {
                    -webkit-transform: perspective(140px) rotateY(180deg);
                    transform: perspective(140px) rotateY(180deg);
                    opacity: 0;
                }
        }
    </style>

    {/literal}
</head>
<!-- end::Head -->
<!-- end::Body -->
{*<body  class="m-page--fluid m--skin- m-content--skin-light2 m-header--fixed m-header--fixed-mobile m-aside-left--enabled m-aside-left--skin-dark m-aside-left--offcanvas m-footer--push m-aside--offcanvas-default"  >*}
<body class="m-page--fluid m--skin- m-page--loading m-page--loading-enabled
m-content--skin-light2 m-header--fixed m-header--fixed-mobile m-aside-left--enabled m-aside-left--skin-dark m-aside-left--fixed m-aside-left--offcanvas
 m-footer--push m-aside--offcanvas-default {*m-aside-left--minimize m-brand--minimize*}" style="">
<!-- begin::Page loader -->
<div class="m-page-loader m-page-loader--base">
    <div class="m-blockui">
        <span>Cargando CITES...</span>
        <span><div class="m-loader m-loader--success"></div></span>
        {*<div class="loader"></div>*}
    </div>
</div>
<!-- end::Page Loader -->

<!-- begin:: Page -->
<div class="m-grid m-grid--hor m-grid--root m-page">
    <!-- BEGIN: Header -->
    {include file="$frontend_header"}
    <!-- END: Header -->

    <!-- begin::Body -->
    <div class="m-grid__item m-grid__item--fluid m-grid m-grid--ver-desktop m-grid--desktop m-body">
        <!-- BEGIN: Left Aside -->
        {*include file="$frontend_left_aside"*}
        {include file="$modulo_frontend_left_aside"}

        <!-- END: Left Aside -->
        <div class="m-grid__item m-grid__item--fluid m-wrapper">
            <!-- BEGIN: Subheader -->
            <div class="m-subheader m--padding-top-5" >
                <div class="d-flex align-items-center">
                    <div class="mr-auto">
                        <h3 class="m-subheader__title m-subheader__title--separator titulo1">
                            {if $miga.smodulo.carpeta != 'index'}
                                {$miga.smodulo.nombre}
                            {else}
                                {$module_conf.dashboard_titulo}
                            {/if}
                        </h3>
                        <ul class="m-subheader__breadcrumbs m-nav m-nav--inline">
                            <li class="m-nav__item m-nav__item--home">
                                <a href="/{$miga.modulo.carpeta}" class="m-nav__link m-nav__link--icon"><i class="m-nav__link-icon la la-home"></i></a>
                            </li>

                            {*<li class="m-nav__separator">/</li>*}
                            <li class="m-nav__item">
                                <a href="/{$miga.modulo.carpeta}" class="m-nav__link"><span class="m-nav__link-text">
                                        {if $miga.smodulo.carpeta != 'index'}
                                            Inicio
                                        {else}
                                            Menu Principal
                                        {/if}
                                    </span></a>
                            </li>
                            {if $miga.smodulo.carpeta != 'index'}
                                <li class="m-nav__separator">/</li>
                                <li class="m-nav__item">
                                    <a href="/{$miga.modulo.carpeta}" class="m-nav__link"><span class="m-nav__link-text">{$miga.padre.nombre}</span></a>
                                </li>
                                <li class="m-nav__separator">/</li>
                                <li class="m-nav__item">
                                    <a href="/{$miga.modulo.carpeta}/{$miga.smodulo.carpeta}" class="m-nav__link"><span class="m-nav__link-text">{$miga.smodulo.nombre}</span></a>
                                </li>
                            {/if}

                        </ul>
                    </div>

                </div>
            </div>
            <!-- END: Subheader -->
            <div class="m-content m--padding-top-5">
                {include file="$subpage"}
            </div>

        </div>

    </div>
    <!-- end:: Body -->

    <!-- begin::Footer -->
    {include file="$frontend_footer"}
    <!-- end::Footer -->
</div>
<!-- end:: Page -->

<!-- begin::Scroll Top -->
<div id="m_scroll_top" class="m-scroll-top">
    <i class="la la-arrow-up"></i>
</div>
<!-- end::Scroll Top -->
<!--begin::Base Scripts -->
<script src="/themes/metro/assets/vendors/base/vendors.bundle.js" type="text/javascript"></script>
<script src="/themes/metro/assets/demo/default/base/scripts.bundle.js" type="text/javascript"></script>
<!--end::Base Scripts -->

<!--begin::Page Vendors -->
<script src="/themes/metro/assets/vendors/custom/datatables/datatables.bundle.js" type="text/javascript"></script>
<!--end::Page Vendors -->
<!--begin::number -->
<script src="/js/jquery.number/jquery.number.min.js" type="text/javascript"></script>
<!--end::number -->


<!--begin::Page Snippets -->
{include file="$subpage_js"}
<!--end::Page Snippets -->
<script src="/config/language/datepicker.spanish.js" type="text/javascript"></script>

<!-- begin::Page Loader -->
{literal}
    <script>

        $(window).on('load', function() {
            $('body').removeClass('m-page--loading');
        });

        var cargando_vista = '<div class="sk-folding-cube dis-none">' +
            '        <div class="sk-cube1 sk-cube"></div>' +
            '        <div class="sk-cube2 sk-cube"></div>' +
            '        <div class="sk-cube4 sk-cube"></div>' +
            '        <div class="sk-cube3 sk-cube"></div>' +
            '    </div>';
    </script>
{/literal}
<!-- end::Page Loader -->
</body>
<!-- end::Body -->
</html>
