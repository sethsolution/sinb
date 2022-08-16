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

                {*
                <div class="m-widget1 m-widget1--paddingless">
                    <div class="m-widget1__item">
                        <div class="row m-row--no-padding align-items-center">
                            <div class="col">
                                <h3 class="m-widget1__title">Accesos</h3>
                                <span class="m-widget1__desc">Número de accesos al sistema</span>
                            </div>
                            <div class="col m--align-right">
                                <span class="m-widget1__number m--font-success">258</span>
                            </div>
                        </div>
                    </div>
                    <div class="m-widget1__item">
                        <div class="row m-row--no-padding align-items-center">
                            <div class="col">
                                <h3 class="m-widget1__title">Accesos fallidos</h3>
                                <span class="m-widget1__desc">Número de accesos fallidos al sistema</span>
                            </div>
                            <div class="col m--align-right">
                                <span class="m-widget1__number m--font-danger">52</span>
                            </div>
                        </div>
                    </div>
                </div>
                *}

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
                                Actualizar perfil
                            </a>
                        </li>
                        <li class="nav-item m-tabs__item">
                            <a class="nav-link m-tabs__link" data-toggle="tab" href="#m_user_profile_tab_2" role="tab">
                                Configuración
                            </a>
                        </li>
                    </ul>
                </div>
            </div>

            <div class="tab-content">


                <div class="tab-pane active" id="m_user_profile_tab_1">


                    <div class="row">
                        <div class="col-lg-12">
                            <div class="m-portlet">

                                <div class="m-portlet__head">
                                    <div class="m-portlet__head-caption">
                                        <div class="m-portlet__head-title">
                                            <span class="m-portlet__head-icon m--hide"><i class="la la-gear"></i></span>
                                            <h3 class="m-portlet__head-text">1. Datos Personales</h3>
                                        </div>
                                    </div>
                                </div>


                                <form class="m-form m-form--fit m-form--label-align-right m-form--group-seperator-dashed" method="POST" action="{$getModule}" id="general_form">
                                    <div class="m-portlet__body">
                                        <div class="form-group m-form__group row">
                                            <label for="example-text-input" class="col-3 col-form-label">Nombres</label>
                                            <div class="col-lg-9">
                                                <input class="form-control m-input" type="text" placeholder="Ingrese su nombre(s)" name="item[nombre]" name="" value="{$item.nombre|escape:"html"}">
                                            </div>
                                        </div>
                                        <div class="form-group m-form__group row">
                                            <label for="example-text-input" class="col-3 col-form-label">Apellidos</label>
                                            <div class="col-lg-9">
                                                <input class="form-control m-input" type="text" placeholder="Ingrese su apellido(s)" name="item[apellido]" value="{$item.apellido}">
                                            </div>
                                        </div>

                                        <div class="form-group m-form__group row">
                                            <label for="example-text-input" class="col-3 col-form-label">Teléfono</label>
                                            <div class="col-lg-9">
                                                <input class="form-control m-input" type="text" placeholder="Ingrese su telefono" name="item[telefono]" value="{$item.telefono}">
                                                {*<span class="m-form__help">If you want your invoices addressed to a company. Leave blank to use your full name.</span>*}
                                            </div>
                                        </div>
                                        <div class="form-group m-form__group row">
                                            <label for="example-text-input" class="col-3 col-form-label">Celular.</label>
                                            <div class="col-lg-9">
                                                <input class="form-control m-input" type="text" placeholder="Ingrese su número de celular" name="item[celular]" value="{$item.celular}">
                                            </div>
                                        </div>

                                        <div class="form-group m-form__group row">
                                            <label for="example-text-input" class="col-3 col-form-label">Dirección</label>
                                            <div class="col-lg-9">
                                                <input class="form-control m-input" type="text" placeholder="Ingrese su dirección (Ciudad, zona, Calle, Número)" name="item[direccion]" value="{$item.direccion}">
                                            </div>
                                        </div>
                                        <div class="form-group m-form__group row">
                                            <label for="example-text-input" class="col-3 col-form-label">Correo Electrónico</label>
                                            <div class="col-lg-9">
                                                <input class="form-control m-input" type="text" disabled placeholder="Ingrese su correo electrónico" name="item[email]" value="{$item.email}">
                                            </div>
                                        </div>

                                    </div>

                                    <div class="m-portlet__foot m-portlet__no-border m-portlet__foot--fit">
                                        <div class="m-form__actions m-form__actions--solid text-center">
                                            <div class="row">
                                                <div class="col-lg-12">
                                                    <button type="reset" class="btn btn-accent m-btn m-btn--air m-btn--custom" id="general_submit">Guardar Cambios</button>
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                </form>

                            </div>
                        </div>
                    </div>

                </div>


                <div class="tab-pane " id="m_user_profile_tab_2">
                    <div class="m-portlet__body">

                        <br><br>
                        <div class="alert alert-warning" role="alert">
                            <strong>
                                Noticia !!!
                            </strong>  Se visualizará la configuración del usuarios, "En Desarrollo"
                        </div>
                        {*
                        <div class="form-group m-form__group m--margin-top-10">
                            <div class="alert m-alert m-alert--default" role="alert">
                                Se visualizará la configuración del usuarios, "En Desarrollo"
                            </div>
                        </div>
                        *}
                    </div>

                </div>
            </div>

        </div>
    </div>
</div>


{include file="index.css.tpl"}