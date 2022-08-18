{include file="index.css.tpl"}
<div class="login100-form-title logodiv" style="background-image: url(/themes/login/images/bg-01.jpg);">

    <span class="login100-form-title-1">&nbsp;</span>
</div>

<div class="fs-13 m-b-19 w-full  text-center p-l-40 p-r-40 p-t-20" >
    <h4>Password reset</h4>
    <br>
    Enter the email address you used to register. We will send you a message with your username and a link to reset your password.
</div>

<div class="exito dis-none fs-13 w-full  text-center " id="exito">
    An email has been sent with a URL address, so that you can perform the restore process
    of your password.
    <br>
    Check your <strong>SPAM</strong> tray if necessary.

</div>
<form class="login100-form validate-form " style="padding-bottom: 20px!important; padding-top: 0px!important;">



    <div id="div_usuario" class="wrap-input100 validate-input m-b-26" data-validate="Usuario es requerido" >
        <span class="label-input100"><Usuario>Email:</Usuario></span>
        <input class="input100" type="email" name="user" id="user" placeholder="Ingrese usuario">
        <span class="focus-input100"></span>
    </div>


    <div class="sk-folding-cube dis-none" id="cargando">
        <div class="sk-cube1 sk-cube"></div>
        <div class="sk-cube2 sk-cube"></div>
        <div class="sk-cube4 sk-cube"></div>
        <div class="sk-cube3 sk-cube"></div>
    </div>


    <div class="error  dis-none m-b-19 w-full p-1  text-center lh-2-3" id="error"></div>

    <div class="container-login100-form-btn" id="bt_enviar">
        <button class="login100-form-btn " id="bt_ingresar">Restore password</button>
    </div>

    <div class="container-login100-form-btn p-t-30 ">
    <a href="/ingreso" class="login100-form-btn ">Login to the system</a>
    </div>

</form>

<div  style="text-align: center;font-size: 10px; color: #7c7c7c; ">
    <img src="/images/logo/otca.png" width="350"><br>
    This system is part of the Bioamazon Project and has been developed as a collaboration between the
    <br>GWCMC and the Amazon Cooperation Treaty Organization (ACTO).<br>
    Co-financed by the Federal Republic of Germany through KfW.
    <br><br>
</div>