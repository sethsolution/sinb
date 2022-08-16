<div class="m-portlet m-portlet--full-height">
    <!--begin: Portlet Head-->
    <div class="m-portlet__head">
        <div class="m-portlet__head-caption">
            <div class="m-portlet__head-title">
                <h3 class="m-portlet__head-text">
                    Verificación de correo electrónico
                    <small>Cuenta de usuario</small>
                </h3>
            </div>
        </div>
        <div class="m-portlet__head-tools">
            <ul class="m-portlet__nav">
                <li class="m-portlet__nav-item">
                    {*
                    <a href="#" data-toggle="m-tooltip" class="m-portlet__nav-link m-portlet__nav-link--icon" data-direction="left" data-width="auto" title="Get help with filling up this form">
                        <i class="flaticon-info m--icon-font-size-lg3"></i>
                    </a>
                    *}
                </li>
            </ul>
        </div>
    </div>
    <form action="/">
        <div class="m-portlet__body">


            {if $verifica == 1}
            <div class="m-alert m-alert--icon m-alert--icon-solid m-alert--outline alert alert-success alert-dismissible fade show" role="alert">
                <div class="m-alert__icon">
                    <i class="fa fa-user-check"></i>
                    <span></span>
                </div>
                <div class="m-alert__text">
                    <strong>Felicidades</strong> Se ha verificado con exito su correo electrónico y se activó su cuenta de usuario.
                    <br>
                    Ya puede ingresar al sistema de información.
                </div>
                <div class="m-alert__close">
                    {*<button type="button" class="close" data-dismiss="alert" aria-label="Close"></button>*}
                </div>
            </div>
            {else}
            <div class="m-alert m-alert--icon m-alert--icon-solid m-alert--outline alert alert-danger alert-dismissible fade show" role="alert">
                <div class="m-alert__icon">
                    <i class="flaticon-exclamation-1"></i>
                    <span></span>
                </div>
                <div class="m-alert__text">
                    <strong>Error!</strong> No se pudo completar el proceso de verificación.
                    <br>
                    Es posible que el usuario ya este activo o los datos enviados de verificación son erroneos.
                </div>
                <div class="m-alert__close">
                    {*<button type="button" class="close" data-dismiss="alert" aria-label="Close"></button>*}
                </div>
            </div>
            {/if}


            <div class="text-center">
            <a class="btn btn-success" href="/" role="button">Entrar al Sistema</a>
            </div>



        </div>

    </form>
</div>