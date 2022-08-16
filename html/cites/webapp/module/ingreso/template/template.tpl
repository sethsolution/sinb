<!DOCTYPE html>
<html lang="en">
<head>
    <title>{$module_conf.dashboard_titulo}</title>
    <meta name="description" content="{$module_conf.dashboard_titulo}">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="apple-touch-icon" sizes="180x180" href="/favicon/apple-touch-icon.png">
    <link rel="icon" type="image/png" href="/favicon/favicon-32x32.png" sizes="32x32">
    <link rel="icon" type="image/png" href="/favicon/favicon-16x16.png" sizes="16x16">
    <link rel="manifest" href="/favicon/manifest.json">
    <link rel="mask-icon" href="/favicon/safari-pinned-tab.svg" color="#5bbad5">

    <!--===============================================================================================-->
    <link rel="icon" type="image/png" href="/themes/login/images/icons/favicon.ico"/>
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="/themes/login/js/bootstrap/css/bootstrap.min.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="/themes/login/fonts/font-awesome-4.7.0/css/font-awesome.min.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="/themes/login/fonts/Linearicons-Free-v1.0.0/icon-font.min.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="/themes/login/js/animate/animate.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="/themes/login/js/css-hamburgers/hamburgers.min.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="/themes/login/js/animsition/css/animsition.min.css">
    <!--===============================================================================================-->
    {*<link rel="stylesheet" type="text/css" href="/themes/login/js/select2/select2.min.css">*}
    <!--===============================================================================================-->
    {*<link rel="stylesheet" type="text/css" href="/themes/login/js/daterangepicker/daterangepicker.css">*}
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="/themes/login/css/util.css">
    <link rel="stylesheet" type="text/css" href="/themes/login/css/main.css">
    <!--===============================================================================================-->
</head>
<body>

<div class="limiter">
    <div class="container-login100">
        <div class="wrap-login100">
            {include file="$subpage"}
            <div  style="text-align: center;font-size: 10px; color: #7c7c7c; padding-top: 10px; ">
                <img src="/images/logo/otca.png" width="350"><br>
                El presente sistema ha sido desarrollado en colaboración entre el MMAyA y el Proyecto Bioamazonía,<br>
                proyecto de desarrollo de la Organización del Tratado de Cooperación Amazónica (OTCA),<br>
                cofinanciado por la República Federal de Alemania a través de KfW.
            </div>
            <div  style="text-align: center;font-size: 11px; color: #7c7c7c; padding-top: 2px; padding-bottom: 5px;">
                2022-2023 <a href="https://www.mmaya.gob.bo" target="_blank" style="font-size: 11px;  ">© MMAyA</a> - <a href="http://www.seth.com.bo" target="_blank" style="font-size: 11px;  ">SETH Solution</a> | Uyuni v.0.0.1
                <br>
            </div>
        </div>
    </div>
</div>

<!--===============================================================================================-->
<script src="/themes/login/js/jquery/jquery-3.2.1.min.js"></script>
<!--===============================================================================================-->
<script src="/themes/login/js/animsition/js/animsition.min.js"></script>
<!--===============================================================================================-->
<script src="/themes/login/js/bootstrap/js/popper.js"></script>
<script src="/themes/login/js/bootstrap/js/bootstrap.min.js"></script>
<!--===============================================================================================-->
{*<script src="/themes/login/vendor/select2/select2.min.js"></script>*}
<!--===============================================================================================-->
{*
<script src="/themes/login/vendor/daterangepicker/moment.min.js"></script>
<script src="/themes/login/vendor/daterangepicker/daterangepicker.js"></script>
*}
<!--===============================================================================================-->
<script src="/themes/login/js/countdowntime/countdowntime.js"></script>
<!--===============================================================================================-->
<!--script src="/themes/login/js/main.js"></script-->


{include file="$subpage_js"}

</body>
</html>