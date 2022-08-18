<!DOCTYPE html>
<html lang="en">
<!--begin::Head-->
<head>{*<base href="">*}
    <meta charset="utf-8" />
    <title>{#sbmTitle#} {if $miga.appModuleData.folder  != ''}| {$miga.appModuleData.name}{/if}</title>
    <meta name="description" content="UYUNI - {#sbmTitle#}" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta http-equiv="Cache-control" content="public">
    <!--begin::Fonts-->

    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700" />

    {*
    <link href="/themes/fonts.css" rel="stylesheet" type="text/css" />
    *}
    <!--end::Fonts-->

    <!--begin::Page Vendors Styles(used by this page)-->
    <link href="/themes/metro72/assets/plugins/custom/datatables/datatables.bundle.css" rel="stylesheet" type="text/css" />
    <!--end::Page Vendors Styles-->
    <!--begin::Global Theme Styles(used by all pages)-->
    <link href="/themes/metro72/assets/plugins/global/plugins.bundle.css" rel="stylesheet" type="text/css" />
    <link href="/themes/metro72/assets/plugins/custom/prismjs/prismjs.bundle.css" rel="stylesheet" type="text/css" />
    <link href="/themes/metro72/assets/css/style.bundle.css" rel="stylesheet" type="text/css" />
    <!--end::Global Theme Styles-->
    <!--begin::Layout Themes(used by all pages)-->
    <link href="/themes/metro72/assets/css/themes/layout/header/base/light.css" rel="stylesheet" type="text/css" />
    <link href="/themes/metro72/assets/css/themes/layout/header/menu/light.css" rel="stylesheet" type="text/css" />
    <link href="/themes/metro72/assets/css/themes/layout/brand/dark.css" rel="stylesheet" type="text/css" />
    <link href="/themes/metro72/assets/css/themes/layout/aside/dark.css" rel="stylesheet" type="text/css" />

    <link href="/js/uyuni/core.css" rel="stylesheet" type="text/css" />
    <!--end::Layout Themes-->
    <link rel="apple-touch-icon" sizes="180x180" href="/favicon/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="/favicon/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="/favicon/favicon-16x16.png">
    <link rel="manifest" href="/favicon/site.webmanifest">
    <link rel="mask-icon" href="/favicon/safari-pinned-tab.svg" color="#5bbad5">
    <link rel="shortcut icon" href="/favicon/favicon.ico">
    <meta name="msapplication-TileColor" content="#da532c">
    <meta name="msapplication-config" content="/favicon/browserconfig.xml">
    <meta name="theme-color" content="#ffffff">

    <!-- Global site tag (gtag.js) - Google Analytics -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=G-G533H9V4HE"></script>
    {literal}
    <script>
        window.dataLayer = window.dataLayer || [];
        function gtag(){dataLayer.push(arguments);}
        gtag('js', new Date());

        gtag('config', 'G-G533H9V4HE');
    </script>
    {/literal}
</head>
<!--end::Head-->
<!--begin::Body-->
<body id="kt_body"
      class="header-fixed header-mobile-fixed subheader-enabled
      subheader-fixed aside-enabled aside-fixed
      {* aside-minimize-hoverable  aside-minimize *}
      page-loading">

{include file=$frontend._page_loader}


{include file="$subpage"}


<!--begin::Global Theme Bundle(used by all pages)-->
<script src="/themes/metro72/assets/plugins/global/plugins.bundle.js"></script>
<script src="/themes/metro72/assets/plugins/custom/prismjs/prismjs.bundle.js"></script>
<script>
    var lng = "{$lng}";
</script>
<script src="/language/js/uyuni.{$lng}.js"></script>
<script src="/js/uyuni/core.js"></script>
<script src="/themes/metro72/assets/js/scripts.bundle.js"></script>
<!--end::Global Theme Bundle-->



<!--begin::Page Vendors(used by this page)-->

<script src="/themes/metro72/assets/plugins/custom/datatables/datatables.bundle.js"></script>
<script src="/language/js/datepicker.spanish.js" type="text/javascript"></script>
<script src="/js/jquery.number/jquery.number.min.js" type="text/javascript"></script>
<script src="/js/jquery.form/jquery.form.min.js" type="text/javascript"></script>


{*<script src="/themes/metro72/assets/plugins/custom/fullcalendar/fullcalendar.bundle.js"></script>*}
<!--end::Page Vendors-->

<!--begin::Page Scripts(used by this page)-->
{*<script src="/themes/metro72/assets/js/pages/widgets.js"></script>*}
<!--end::Page Scripts-->


<!--begin::jsPrincipal -->
{include file="$subpage_js"}
<!--end::jsPrincipal -->


</body>
<!--end::Body-->
</html>