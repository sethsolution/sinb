{include file="index.css.tpl"}
<div class="login100-form-title" style="background-image: url(/themes/login/images/bg-01.jpg);">

    <span class="login100-form-title-1">&nbsp;</span>
</div>

<div class="fs-13 m-b-19 w-full  text-center p-l-40 p-r-40 p-t-20" >
    <h4>Restablecimiento de contraseña</h4>
    <br>
    {if $encontro eq 1}
        Por favor ingrese su nueva contraseña por favor.

    {else}
        Los datos enviados para restablecer su contraseña son incorrectos.
    {/if}
</div>

<div class="exito dis-none fs-13 w-full  text-center " id="exito">
    Se ha cambiado su contraseña con exito.<br>
</div>


<form class="login100-form validate-form " style="padding-bottom: 20px!important; padding-top: 0px!important;">
    <div id="div_pass1" class="wrap-input100 validate-input m-b-26" data-validate="Contraseña es requerido" >
        <span class="label-input100"><Usuario>Contraseña:</Usuario></span>
        <input class="input100" type="password" name="pass1" id="pass1" placeholder="Ingrese Contraseña">
        <span class="focus-input100"></span>
    </div>

    <div id="div_pass2" class="wrap-input100 validate-input m-b-26" data-validate="Contraseña es requerido" >
        <span class="label-input100"><Usuario>Repetir contraseña:</Usuario></span>
        <input class="input100" type="password" name="pass2" id="pass2" placeholder="Repita Contraseña">
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
        <button class="login100-form-btn " id="bt_ingresar">Cambiar Contraseña</button>
    </div>

    <div class="container-login100-form-btn p-t-30 ">
    <a href="/ingreso" class="login100-form-btn ">Ingresar al sistema</a>
    </div>

</form>
