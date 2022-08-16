<div class="row">
    <div class="col-xl-3 col-lg-4">
        <div class="m-portlet m-portlet--full-height  ">
            <div class="m-portlet__body">

                <div class="m-card-profile">
                    <div class="m-card-profile__title m--hide">
                        Your Profile
                    </div>
                    <div class="m-card-profile__pic">
                        <div class="m-card-profile__pic-wrapper"><img src="/?accion=getPhoto" alt=""/></div>
                    </div>
                    <div class="m-card-profile__details" id="div_perfil">
                        <span id="a_nombres" class="m-card-profile__name">{$usuarioInfo.nombre} {$usuarioInfo.apellido}</span>
                        <a id="a_email" href="" class="m-card-profile__email m-link">{$usuarioInfo.email}</a>
                    </div>
                </div>

            </div>

        </div>
    </div>


    <div class="col-xl-9 col-lg-8">
        <div class="m-portlet m-portlet--full-height m-portlet--tabs ">

            <div class="m-portlet__head">
                <div class="m-portlet__head-tools">
                    <ul class="nav nav-tabs m-tabs m-tabs-line   m-tabs-line--left m-tabs-line--primary" role="tablist">
                        <li class="nav-item m-tabs__item">
                            <a class="nav-link m-tabs__link active" data-toggle="tab" href="#m_user_profile_tab_1" role="tab">
                                <i class="flaticon-share"></i>
                                Actualizar mi contraseña
                            </a>
                        </li>

                    </ul>
                </div>
            </div>

            <div class="tab-content">
                <div class="tab-pane active" id="m_user_profile_tab_1">
                        <div class="col-lg-12">
                            <div class="m-portlet">

                                <div class="m-portlet__head">
                                    <div class="m-portlet__head-caption">
                                        <div class="m-portlet__head-title">
                                            <span class="m-portlet__head-icon m--hide"><i class="la la-gear"></i></span>
                                            <h3 class="m-portlet__head-text">Elige una contraseña segura</h3>
                                        </div>
                                    </div>
                                </div>

                                {*<form action="#" onsubmit="sendData();return false;" id="login" method="POST">*}
                                <form class="m-form m-form--fit m-form--label-align-right m-form--group-seperator-dashed" method="POST" action="{$getModule}" id="general_form" onSubmit="return limpiar()">

                                    <div class="form-group m-form__group row">
                                        <label for="example-text-input" class="col-3 col-form-label">Contraseña Actual</label>
                                        <div class="col-7 m-input-icon m-input-icon--right">
                                            <input type="password" id="password1" class="form-control m-input" placeholder="Ingrese la contraseña actual"
                                                   name="item[password1]" name="" {* value="{$item.password|escape:"html"} *}"
                                            data-msg="Campo requerido"  minlength="3">
                                            <span class="m-input-icon__icon m-input-icon__icon--right"><span><i class="la la-pencil-square-o"></i></span></span>
                                        </div>
                                    </div>
                                    <div class="form-group m-form__group row">
                                        <label for="example-text-input" class="col-3 col-form-label">Contraseña Nueva</label>
                                        <div class="col-7 m-input-icon m-input-icon--right">
                                            <input type="password" id="password2" class="form-control m-input" placeholder="Ingrese la contraseña nueva"
                                                   name="item[password2]" name="" {* value="{$item.password|escape:"html"} *}"
                                            data-msg="Campo requerido"  minlength="3">
                                            <span class="m-input-icon__icon m-input-icon__icon--right"><span><i class="la la-pencil-square-o"></i></span></span>
                                        </div>
                                    </div>
                                    <div class="form-group m-form__group row">
                                        <label for="example-text-input" class="col-3 col-form-label">Confirme contraseña</label>
                                        <div class="col-7 m-input-icon m-input-icon--right">
                                            <input type="password" id="password3" class="form-control m-input" placeholder="Confirme la contraseña nueva"
                                                   name="item[password3]" name="" {* value="{$item.password|escape:"html"} *}"
                                            data-msg="Campo requerido"  minlength="3">
                                            <span class="m-input-icon__icon m-input-icon__icon--right"><span><i class="la la-pencil-square-o"></i></span></span>

                                        </div>
                                    </div>




                                    <div class="m-portlet__foot m-portlet__no-border m-portlet__foot--fit">
                                        <div class="m-form__actions m-form__actions--solid text-center">
                                            <div class="row">
                                                <div class="col-lg-12">
                                                    <button type="reset" onclick="cifrar()" class="btn btn-accent m-btn m-btn--air m-btn--custom" id="general_submit">Cambiar Contraseña</button>
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

{include file="index.css.tpl"}

<script src="https://cdnjs.cloudflare.com/ajax/libs/blueimp-md5/2.5.0/js/md5.min.js"></script>
{*<script type="text/javascript" src="js/md5.js"></script>*}s
<script>
    function cifrar() {
        var password1 = $("#password1").val();
        $("#password1").val(md5(password1));
        var password2 = $("#password2").val();
        $("#password2").val(md5(password2));
        var password3 = $("#password3").val();
        $("#password3").val(md5(password3));

    }
    function limpiar() {
        document.getElementById("general_form").reset();
    }
</script>
