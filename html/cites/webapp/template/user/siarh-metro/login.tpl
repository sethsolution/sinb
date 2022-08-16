<!DOCTYPE html>
<html lang="en" >
<!-- begin::Head -->
<head>
    <meta charset="utf-8" />
    <title>
        UYUNI
    </title>
    <meta name="description" content="Latest updates and statistic charts">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!--begin::Web font -->
    <link href='https://fonts.googleapis.com/css?family=Roboto' rel='stylesheet'>
    <link href='https://fonts.googleapis.com/css?family=Poppins' rel='stylesheet'>
    <!--end::Web font -->
    <!--begin::Base Styles -->
    <link href="themes/metro/assets/vendors/base/vendors.bundle.css" rel="stylesheet" type="text/css" />
    <link href="themes/metro/assets/demo/default/base/style.bundle.css" rel="stylesheet" type="text/css" />
    <!--end::Base Styles -->
    <!--link rel="shortcut icon" href="../../../assets/demo/default/media/img/logo/favicon.ico" /-->
    <link rel="apple-touch-icon" sizes="180x180" href="/favicon/apple-touch-icon.png">
    <link rel="icon" type="image/png" href="/favicon/favicon-32x32.png" sizes="32x32">
    <link rel="icon" type="image/png" href="/favicon/favicon-16x16.png" sizes="16x16">
    <link rel="manifest" href="/favicon/manifest.json">
    <link rel="mask-icon" href="/favicon/safari-pinned-tab.svg" color="#5bbad5">
</head>
<!-- end::Head -->
<body class="m-page--fluid m--skin- m-page--loading m-page--loading-enabled m-content--skin-light2 m-header--fixed m-header--fixed-mobile m-aside-left--enabled m-aside-left--skin-dark m-aside-left--fixed m-aside-left--offcanvas m-brand--minimize m-footer--push m-aside--offcanvas-default m-aside-left--minimize" style="">
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
    <div class="m-grid__item m-grid__item--fluid m-grid m-grid--ver-desktop m-grid--desktop m-grid--tablet-and-mobile m-grid--hor-tablet-and-mobile m-login m-login--1 m-login--signin" id="m_login">

        <div class="m-grid__item m-grid__item--order-tablet-and-mobile-2 m-login__aside">
            <div class="m-stack m-stack--hor m-stack--desktop">
                <div class="m-stack__item m-stack__item--fluid">

                    <div class="m-login__wrapper">

                        <div class="m-login__logo">
                            <a href="#"><img src="{$templateDir}siarh-metro/images/logo_mmaya2018.png" width="250"  class="img-responsive"></a>
                        </div>

                        <div class="m-login__signin">

                            <div class="m-login__head">
                                <h3 class="m-login__title">Inicia sesión</h3>
                            </div>

                            <form class="m-login__form m-form" action="">
                                <div class="form-group m-form__group">
                                    <input class="form-control m-input" type="text" placeholder="Usuario" name="user" id="user"
                                           data-msg="Ingrese el Usuario"
                                           autocomplete="off"  style="background-color:#efefef;padding: 10px;">
                                </div>
                                <div class="form-group m-form__group">
                                    <input class="form-control m-input m-login__form-input--last" type="password" id="password"
                                           data-msg="Ingrese la contraseña"
                                           placeholder="Contraseña" name="password" style="background-color:#efefef;padding: 10px;margin-top: 10px;">
                                </div>

                                <div class="m-login__form-action">
                                    <button id="m_login_signin_submit" class="btn btn-info m-btn m-btn--wide m-btn--custom m-btn--air">
                                        Entrar
                                    </button>
                                </div>

                                {**}
                                <div class="form-group m-form__group">
                                    <h4>¿Qué es CITES Bolivia?</h4>
                                    <p align="justify">
                                        Es una aplicación informática  que gestiona información de la base de datos
                                    </p>

                                    <br>

                                    <a target="_blank" href="https://www.facebook.com/sethsolution"><img
                                                width="30" height="30"
                                                src="{$templateDir}siarh-metro/images/icon/facebook.png?id=32"
                                                title="seth.com.bo" /></a>
                                </div>
                                {**}
                            </form>
                        </div>

                        <div class="m-login__signup">
                            <div class="m-login__head">
                                <h3 class="m-login__title">
                                    Sign Up
                                </h3>
                                <div class="m-login__desc">
                                    Enter your details to create your account:
                                </div>
                            </div>
                            <form class="m-login__form m-form" action="">
                                <div class="form-group m-form__group">
                                    <input class="form-control m-input" type="text" placeholder="Fullname" name="fullname">
                                </div>
                                <div class="form-group m-form__group">
                                    <input class="form-control m-input" type="text" placeholder="Email" name="email" autocomplete="off">
                                </div>
                                <div class="form-group m-form__group">
                                    <input class="form-control m-input" type="password" placeholder="Password" name="password">
                                </div>
                                <div class="form-group m-form__group">
                                    <input class="form-control m-input m-login__form-input--last" type="password" placeholder="Confirm Password" name="rpassword">
                                </div>
                                <div class="row form-group m-form__group m-login__form-sub">
                                    <div class="col m--align-left">
                                        <label class="m-checkbox m-checkbox--focus">
                                            <input type="checkbox" name="agree">
                                            I Agree the
                                            <a href="#" class="m-link m-link--focus">
                                                terms and conditions
                                            </a>
                                            .
                                            <span></span>
                                        </label>
                                        <span class="m-form__help"></span>
                                    </div>
                                </div>
                                <div class="m-login__form-action">
                                    <button id="m_login_signup_submit" class="btn btn-focus m-btn m-btn--pill m-btn--custom m-btn--air">
                                        Sign Up
                                    </button>
                                    <button id="m_login_signup_cancel" class="btn btn-outline-focus  m-btn m-btn--pill m-btn--custom">
                                        Cancel
                                    </button>
                                </div>
                            </form>
                        </div>
                        <div class="m-login__forget-password">
                            <div class="m-login__head">
                                <h3 class="m-login__title">
                                    Forgotten Password ?
                                </h3>
                                <div class="m-login__desc">
                                    Enter your email to reset your password:
                                </div>
                            </div>
                            <form class="m-login__form m-form" action="">
                                <div class="form-group m-form__group">
                                    <input class="form-control m-input" type="text" placeholder="Email" name="email" id="m_email" autocomplete="off">
                                </div>
                                <div class="m-login__form-action">
                                    <button id="m_login_forget_password_submit" class="btn btn-focus m-btn m-btn--pill m-btn--custom m-btn--air">
                                        Request
                                    </button>
                                    <button id="m_login_forget_password_cancel" class="btn btn-outline-focus m-btn m-btn--pill m-btn--custom">
                                        Cancel
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

                <!--div class="m-stack__item m-stack__item--center">
                    <div class="m-login__account">
								<span class="m-login__account-msg">
									Don't have an account yet ?
								</span>
                        &nbsp;&nbsp;
                        <a href="javascript:;" id="m_login_signup" class="m-link m-link--focus m-login__account-link">
                            Sign Up
                        </a>
                    </div>
                </div-->
            </div>
        </div>

        <div class="m-grid__item m-grid__item--fluid m-grid m-grid--center m-grid--hor m-grid__item--order-tablet-and-mobile-1	m-login__content m-grid-item--center"
             style="background-image: url(images/login/fondo.jpg)">
            <div class="m-grid__item">
                <h3 class="m-login__welcome" style="text-shadow: -1px -1px 5px #0A0A0A!important;">Bienvenido !!!</h3>
                <p class="m-login__msg" style="text-shadow: -1px -1px 5px #0A0A0A!important;">
                    seth.com.bo
                    <br />
                    Sistema de Información

                </p>
            </div>
        </div>
    </div>
</div>
<!-- end:: Page -->
<!--begin::Base Scripts -->
<script src="themes/metro/assets/vendors/base/vendors.bundle.js" type="text/javascript"></script>
<script src="themes/metro/assets/demo/default/base/scripts.bundle.js" type="text/javascript"></script>
<!--end::Base Scripts -->
<!-- Md5 -->
<script type="text/javascript" src="js/md5.js"></script>
<!--begin::Page Snippets -->
<!--script src="themes/metro/assets/snippets/custom/pages/user/login.js" type="text/javascript"></script-->
<!--end::Page Snippets -->
<script>
    {literal}
    //== Class Definition
    var SnippetLogin = function() {

        var login = $('#m_login');

        var showErrorMsg = function(form, type, msg) {
            var alert = $('<div class="m-alert m-alert--outline alert alert-' + type + ' alert-dismissible" role="alert">\
			<button type="button" class="close" data-dismiss="alert" aria-label="Close"></button>\
			<span></span>\
		</div>');

            form.find('.alert').remove();
            alert.prependTo(form);
            //alert.animateClass('fadeIn animated');
            mUtil.animateClass(alert[0], 'fadeIn animated');
            alert.find('span').html(msg);
        }

        //== Private Functions

        var displaySignUpForm = function() {
            login.removeClass('m-login--forget-password');
            login.removeClass('m-login--signin');

            login.addClass('m-login--signup');
            mUtil.animateClass(login.find('.m-login__signup')[0], 'flipInX animated');
        }

        var displaySignInForm = function() {
            login.removeClass('m-login--forget-password');
            login.removeClass('m-login--signup');

            login.addClass('m-login--signin');
            mUtil.animateClass(login.find('.m-login__signin')[0], 'flipInX animated');
            //login.find('.m-login__signin').animateClass('flipInX animated');
        }

        var displayForgetPasswordForm = function() {
            login.removeClass('m-login--signin');
            login.removeClass('m-login--signup');

            login.addClass('m-login--forget-password');
            //login.find('.m-login__forget-password').animateClass('flipInX animated');
            mUtil.animateClass(login.find('.m-login__forget-password')[0], 'flipInX animated');

        }

        var handleFormSwitch = function() {
            $('#m_login_forget_password').click(function(e) {
                e.preventDefault();
                displayForgetPasswordForm();
            });

            $('#m_login_forget_password_cancel').click(function(e) {
                e.preventDefault();
                displaySignInForm();
            });

            $('#m_login_signup').click(function(e) {
                e.preventDefault();
                displaySignUpForm();
            });

            $('#m_login_signup_cancel').click(function(e) {
                e.preventDefault();
                displaySignInForm();
            });
        }

        var handleSignInFormSubmit = function() {
            $('#m_login_signin_submit').click(function(e) {
                e.preventDefault();
                var btn = $(this);
                var form = $(this).closest('form');

                form.validate({
                    rules: {
                        user: {
                            required: true,
                            //email: true
                        },
                        password: {
                            required: true
                        }
                    }
                });

                if (!form.valid()) {
                    return;
                }

                btn.addClass('m-loader m-loader--right m-loader--light').attr('disabled', true);

                //alert("datos:"+$("#user").val());


                randomnumber=Math.floor(Math.random()*100);
                $.post("index.php",{action:"login",
                    random:randomnumber,
                    "user":$("#user").val(),
                    "password":hex_md5($("#password").val())
                }, function(data){
                    if (data == 1){
                        btn.removeClass('m-loader m-loader--right m-loader--light').attr('disabled', false);
                        showErrorMsg(form, 'danger', 'Nombre de usuario o contraseña incorrecta. Inténtalo de nuevo.');

                    }else if (data == 0){
                        //$("#m_login").slideUp("slow",function() {location="index.php?accion=menu_";});
                        $("#m_login").slideUp("slow",function() {location="index.php";});
                    }
                });

                /*
                            form.ajaxSubmit({
                                url: 'index.php',
                                success: function(response, status, xhr, $form) {
                                    // similate 2s delay
                                    setTimeout(function() {
                                        btn.removeClass('m-loader m-loader--right m-loader--light').attr('disabled', false);
                                        showErrorMsg(form, 'danger', 'Nombre de usuario o contraseña incorrecta. Inténtalo de nuevo.');
                                    }, 2000);
                                }
                            });
                */

            });
        }

        var handleSignUpFormSubmit = function() {
            $('#m_login_signup_submit').click(function(e) {
                e.preventDefault();

                var btn = $(this);
                var form = $(this).closest('form');

                form.validate({
                    rules: {
                        fullname: {
                            required: true
                        },
                        email: {
                            required: true,
                            email: true
                        },
                        password: {
                            required: true
                        },
                        rpassword: {
                            required: true
                        },
                        agree: {
                            required: true
                        }
                    }
                });

                if (!form.valid()) {
                    return;
                }

                btn.addClass('m-loader m-loader--right m-loader--light').attr('disabled', true);

                form.ajaxSubmit({
                    url: '',
                    success: function(response, status, xhr, $form) {
                        // similate 2s delay
                        setTimeout(function() {
                            btn.removeClass('m-loader m-loader--right m-loader--light').attr('disabled', false);
                            form.clearForm();
                            form.validate().resetForm();

                            // display signup form
                            displaySignInForm();
                            var signInForm = login.find('.m-login__signin form');
                            signInForm.clearForm();
                            signInForm.validate().resetForm();

                            showErrorMsg(signInForm, 'success', 'Thank you. To complete your registration please check your email.');
                        }, 2000);
                    }
                });
            });
        }

        var handleForgetPasswordFormSubmit = function() {
            $('#m_login_forget_password_submit').click(function(e) {
                e.preventDefault();

                var btn = $(this);
                var form = $(this).closest('form');

                form.validate({
                    rules: {
                        email: {
                            required: true,
                            email: true
                        }
                    }
                });

                if (!form.valid()) {
                    return;
                }

                btn.addClass('m-loader m-loader--right m-loader--light').attr('disabled', true);

                form.ajaxSubmit({
                    url: '',
                    success: function(response, status, xhr, $form) {
                        // similate 2s delay
                        setTimeout(function() {
                            btn.removeClass('m-loader m-loader--right m-loader--light').attr('disabled', false); // remove
                            form.clearForm(); // clear form
                            form.validate().resetForm(); // reset validation states

                            // display signup form
                            displaySignInForm();
                            var signInForm = login.find('.m-login__signin form');
                            signInForm.clearForm();
                            signInForm.validate().resetForm();

                            showErrorMsg(signInForm, 'success', 'Cool! Password recovery instruction has been sent to your email.');
                        }, 2000);
                    }
                });
            });
        }

        //== Public Functions
        return {
            // public functions
            init: function() {
                handleFormSwitch();
                handleSignInFormSubmit();
                handleSignUpFormSubmit();
                handleForgetPasswordFormSubmit();
            }
        };
    }();

    //== Class Initialization
    jQuery(document).ready(function() {
        SnippetLogin.init();
    });


    {/literal}

</script>


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