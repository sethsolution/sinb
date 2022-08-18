{include file="index.css.tpl"}
<div class="login100-form-title" style="background-image: url(/themes/login/images/bg-01.jpg);">

    <span class="login100-form-title-1">&nbsp;</span>
</div>

<div class="fs-13 m-b-19 w-full  text-center p-l-40 p-r-40 p-t-20" >
    <h4>Restablecimiento de contraseña</h4>
    <br>
    {if $encontro eq 1}
        Pon la dirección de correo electrónico que usaste para registrarte.
        Te enviaremos un mensaje con tu nombre de usuario y un enlace para restablecer tu contraseña.
    {else}
        Los datos del proceso de restablecimiento de contraseña no son correctos.
    {/if}
</div>

<div class="exito dis-none fs-13 w-full  text-center " id="exito">
    Se ha enviado un correo electrónico con una URL, para que pueda realizar el proceso de restauración
    de su contraseña.
    <br>
    Revise su bandeja de <strong>SPAM</strong> si fuera necesario.

</div>
<form class="login100-form validate-form " style="padding-bottom: 20px!important; padding-top: 0px!important;">



    <div id="div_usuario" class="wrap-input100 validate-input m-b-26" data-validate="Usuario es requerido" >
        <span class="label-input100"><Usuario>Correo Electrónico:</Usuario></span>
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
        <button class="login100-form-btn " id="bt_ingresar">Restablecer Contraseña</button>
    </div>

    <div class="container-login100-form-btn p-t-30 ">
    <a href="/ingreso" class="login100-form-btn ">Ingresar al sistema</a>
    </div>

</form>
