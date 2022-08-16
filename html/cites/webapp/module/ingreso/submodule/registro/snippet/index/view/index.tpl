{include file="index.css.tpl"}
<div class="login100-form-title" style="background-image: url(/themes/login/images/bg-01.jpg);">

    <span class="login100-form-title-1">&nbsp;</span>
</div>

<div class="fs-13 m-b-19 w-full  text-center p-l-40 p-r-40 p-t-20" >
    <h4>Registro Inicial de Usuario</h4>
    <br>
    Llena los siguientes campos para registrarte, te enviaremos un mensaje de
    confirmación para el acceso al sistema.
</div>

<div class="exito dis-none fs-13 w-full  text-center " id="exito">
    Se ha enviado un correo electrónico con una URL, para que pueda realizar el proceso de validación de la cuenta de usuario.
    <br>
    Revise su bandeja de <strong>SPAM</strong> si fuera necesario.
</div>
<form class="login100-form validate-form " style="padding-bottom: 40px!important; padding-top: 0px!important;">



    <div id="div_usuario" class="wrap-input100 validate-input m-b-26" data-validate="Usuario es requerido" >
        <span class="label-input100"><Usuario>Correo Electrónico:</Usuario></span>
        <input class="input100" type="email" name="user" id="user" placeholder="Ingrese el usuario">
        <span class="focus-input100"></span>
    </div>

    <div id="div_usuario" class="wrap-input100 validate-input m-b-26" data-validate="Usuario es requerido" >
        <span class="label-input100"><Usuario>Correo Electrónico:</Usuario></span>
        <input class="input100" type="email" name="user" id="user" placeholder="Ingrese el usuario">
        <span class="focus-input100"></span>
    </div>
    <div id="div_pass" class="wrap-input100 validate-input m-b-26" data-validate="La constraseña es requerida" >
        <span class="label-input100"><Usuario>Contraseña:</Usuario></span>
        <input class="input100" type="password" name="user" id="pass" placeholder="Ingrese la contraseña">
        <span class="focus-input100"></span>
    </div>
   {* <div id="div_pass2" class="wrap-input100 validate-input m-b-26" data-validate="Repita la contraseña" >
        <span class="label-input100"><Usuario>Repita la contraseña:</Usuario></span>
        <input class="input100" type="email" name="user" id="pass" placeholder="Confirme la contraseña">
        <span class="focus-input100"></span>
    </div>*}
    <div id="div_empresa" class="wrap-input100 validate-input m-b-26" data-validate="Empresa es requerido" >
        <span class="label-input100"><Usuario>Nombres:</Usuario></span>
        <input class="input100" type="text" name="user" id="empresa" placeholder="Ingrese el nombre del usuario">
        <span class="focus-input100"></span>
    </div>
    <div id="div_nombre" class="wrap-input100 validate-input m-b-26" data-validate="Nombre es requerido" >
        <span class="label-input100"><Usuario>Apellidos:</Usuario></span>
        <input class="input100" type="text" name="user" id="nombre" placeholder="Ingrese los apellidos del usuario">
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
        <button class="login100-form-btn " id="bt_ingresar">&nbsp;&nbsp;&nbsp;&nbsp;
            Registrar Usuario&nbsp;&nbsp;&nbsp;&nbsp;
        </button>
   </div>
   <div class="container-login100-form-btn p-t-30 ">
        <a href="/ingreso" class="login100-form-btn ">&nbsp;&nbsp;&nbsp;&nbsp;
            Ingresar al Sistema&nbsp;&nbsp;&nbsp;&nbsp;
        </a>
   </div>
</form>
