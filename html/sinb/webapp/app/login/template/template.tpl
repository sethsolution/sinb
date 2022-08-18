<!DOCTYPE html>
<html lang="en">
<head>
    <title>{$module_conf.dashboard_titulo}</title>
    <meta name="description" content="{$module_conf.dashboard_titulo}">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="apple-touch-icon" sizes="180x180" href="/favicon/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="/favicon/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="/favicon/favicon-16x16.png">
    <link rel="manifest" href="/favicon/site.webmanifest">
    <link rel="mask-icon" href="/favicon/safari-pinned-tab.svg" color="#5bbad5">
    <link rel="shortcut icon" href="/favicon/favicon.ico">
    <meta name="apple-mobile-web-app-title" content="Eva">
    <meta name="application-name" content="Eva">
    <meta name="msapplication-TileColor" content="#674b9d">
    <meta name="msapplication-config" content="/favicon/browserconfig.xml">
    <meta name="theme-color" content="#ffffff">


    <link rel="icon" type="image/png" href="/themes/login/images/icons/favicon.ico"/>
    <link rel="stylesheet" type="text/css" href="/themes/login/js/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="/themes/login/fonts/font-awesome-4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="/themes/login/fonts/Linearicons-Free-v1.0.0/icon-font.min.css">
    <link rel="stylesheet" type="text/css" href="/themes/login/js/animate/animate.css">
    <link rel="stylesheet" type="text/css" href="/themes/login/js/css-hamburgers/hamburgers.min.css">
    <link rel="stylesheet" type="text/css" href="/themes/login/js/animsition/css/animsition.min.css">
    <link rel="stylesheet" type="text/css" href="/themes/login/css/util.css">
    <link rel="stylesheet" type="text/css" href="/themes/login/css/main.css">

</head>
<body>

<div class="limiter">
    <div class="container-login100">
        <div class="wrap-login100">
            {include file="$subpage"}
        </div>
    </div>
</div>


<script src="/themes/login/js/jquery/jquery-3.2.1.min.js"></script>
<script src="/themes/login/js/animsition/js/animsition.min.js"></script>
<script src="/themes/login/js/bootstrap/js/popper.js"></script>
<script src="/themes/login/js/bootstrap/js/bootstrap.min.js"></script>
<script src="/themes/login/js/countdowntime/countdowntime.js"></script>

{include file="$subpage_js"}

</body>
</html>