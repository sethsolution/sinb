{if $resumen.usuario.nombre.id != ''}
<div class="m-portlet">
    <div class="m-portlet__head" rel="color_1">
        <div class="m-portlet__head-caption">
            <div class="m-portlet__head-title">
                <span class="m-portlet__head-icon"><i class="fa fa-user-tag"></i></span>
                <h3 class="m-portlet__head-text">Datos de Usuario Codice</h3>
            </div>
        </div>
    </div>
    <!--begin::Form-->

        <div class="m-portlet__body">

            <div class="form-group m-form__group row">
                <div class="col-lg-4">
                    <label>Nombres:</label>
                    <div class="m-input-icon m-input-icon--right">
                        <input type="text" class="form-control m-input" placeholder=""
                               name="item[nombres]" name="" value="{$resumen.usuario.nombre|escape:"html"}" disabled>
                        <span class="m-input-icon__icon m-input-icon__icon--right"><span><i class="fa flaticon-user"></i></span></span>
                    </div>
                </div>
                <div class="col-lg-4">
                    <label class="">Cargo:</label>
                    <div class="m-input-icon m-input-icon--right">
                        <input type="text" class="form-control m-input" placeholder="" name="item[apellido_paterno]"
                               value="{$resumen.usuario.cargo|escape:"html"}" disabled>
                        <span class="m-input-icon__icon m-input-icon__icon--right"><span><i class="la la-suitcase"></i></span></span>
                    </div>
                </div>
                <div class="col-lg-4">
                    <label class="">Usuario:</label>
                    <div class="m-input-icon m-input-icon--right">
                        <input type="text" class="form-control m-input" placeholder="" name="item[apellido_paterno]"
                               value="{$resumen.usuario.username|escape:"html"}" disabled>
                        <span class="m-input-icon__icon m-input-icon__icon--right"><span><i class="fa fa-address-card"></i></span></span>
                    </div>
                </div>
            </div>

            <div class="form-group m-form__group row">
                <div class="col-lg-4">
                    <label>Entidad:</label>
                    <div class="m-input-icon m-input-icon--right">
                        <input type="text" class="form-control m-input" placeholder=""
                               name="item[nombres]" name="" value="{$resumen.usuario.entidad|escape:"html"}" disabled>
                        <span class="m-input-icon__icon m-input-icon__icon--right"><span><i class="la la-institution"></i></span></span>
                    </div>
                </div>
                <div class="col-lg-4">
                    <label class="">Oficina:</label>
                    <div class="m-input-icon m-input-icon--right">
                        <input type="text" class="form-control m-input" placeholder="" name="item[apellido_paterno]"
                               value="{$resumen.usuario.oficina|escape:"html"}" disabled>
                        <span class="m-input-icon__icon m-input-icon__icon--right"><span><i class="la la-building"></i></span></span>
                    </div>
                </div>
                <div class="col-lg-4">
                    <label class="">Sigla Oficina:</label>
                    <div class="m-input-icon m-input-icon--right">
                        <input type="text" class="form-control m-input" placeholder="" name="item[apellido_paterno]"
                               value="{$resumen.usuario.oficina_sigla|escape:"html"}" disabled>
                        <span class="m-input-icon__icon m-input-icon__icon--right"><span><i class="la la-bookmark-o"></i></span></span>
                    </div>
                </div>
            </div>

            <div class="form-group m-form__group row">
                <div class="col-lg-4">
                    <label>Fecha de Creación:</label>
                    <div class="m-input-icon m-input-icon--right">
                        <input type="text" class="form-control m-input" placeholder=""
                               name="item[nombres]" name="" value="{$resumen.usuario.fecha_creacion|escape:"html"}" disabled>
                        <span class="m-input-icon__icon m-input-icon__icon--right"><span><i class="fa flaticon-calendar-1"></i></span></span>
                    </div>
                </div>
                <div class="col-lg-4">
                    <label class="">Ultimo Acceso:</label>
                    <div class="m-input-icon m-input-icon--right">
                        <input type="text" class="form-control m-input" placeholder="" name="item[apellido_paterno]"
                               value="{$resumen.usuario.last_login|escape:"html"}" disabled>
                        <span class="m-input-icon__icon m-input-icon__icon--right"><span><i class="fa flaticon-clock-2"></i></span></span>
                    </div>
                </div>
                <div class="col-lg-4">
                    <label class="">Número de ingresos:</label>
                    <div class="m-input-icon m-input-icon--right">
                        <input type="text" class="form-control m-input" placeholder="" name="item[apellido_paterno]"
                               value="{$resumen.usuario.logins|escape:"html"}" disabled>
                        <span class="m-input-icon__icon m-input-icon__icon--right"><span><i class="la la-sort-numeric-asc"></i></span></span>
                    </div>
                </div>
            </div>





        </div>


    <!--end::Form-->
</div>
<!--end::Portlet-->




<!--Begin::Section-->
<div class="m-portlet">
    <div class="m-portlet__body m-portlet__body--no-padding">
        <div class="row m-row--no-padding m-row--col-separator-xl">
            <div class="col-md-12 col-lg-12 col-xl-6">

                <!--begin:: Widgets/Stats2-1 -->
                <div class="m-widget1">
                    <div class="m-widget1__item">
                        <div class="row m-row--no-padding align-items-center">
                            <div class="col">
                                <h3 class="m-widget1__title">Entrada</h3>
                                <span class="m-widget1__desc">Correspondencias Nuevas (No Recibida)</span>
                            </div>
                            <div class="col m--align-right">
                                <span class="m-widget1__number m--font-success">{if $resumen.bandeja.1.cantidad == '' }0{else}{$resumen.bandeja.1.cantidad}{/if}</span>
                            </div>
                        </div>
                    </div>
                    <div class="m-widget1__item">
                        <div class="row m-row--no-padding align-items-center">
                            <div class="col">
                                <h3 class="m-widget1__title">Pendientes</h3>
                                <span class="m-widget1__desc">Correspondencias Pendientes</span>
                            </div>
                            <div class="col m--align-right">
                                <span class="m-widget1__number m--font-danger">{if $resumen.bandeja.2.cantidad == '' }0{else}{$resumen.bandeja.2.cantidad}{/if}</span>
                            </div>
                        </div>
                    </div>
                    <div class="m-widget1__item">
                        <div class="row m-row--no-padding align-items-center">
                            <div class="col">
                                <h3 class="m-widget1__title">Archivados</h3>
                                <span class="m-widget1__desc">Correspondencias Archivadas</span>
                            </div>
                            <div class="col m--align-right">
                                <span class="m-widget1__number m--font-brand">{if $resumen.bandeja.10.cantidad == '' }0{else}{$resumen.bandeja.10.cantidad}{/if}</span>
                            </div>
                        </div>
                    </div>
                    <div class="m-widget1__item">
                        <div class="row m-row--no-padding align-items-center">
                            <div class="col">
                                <h3 class="m-widget1__title">Agrupados</h3>
                                <span class="m-widget1__desc">Correspondencias Agrupadas</span>
                            </div>
                            <div class="col m--align-right">
                                <span class="m-widget1__number m--font-info">{if $resumen.bandeja.6.cantidad == '' }0{else}{$resumen.bandeja.6.cantidad}{/if}</span>
                            </div>
                        </div>
                    </div>
                </div>

                <!--end:: Widgets/Stats2-1 -->
            </div>


            <div class="col-md-12 col-lg-12 col-xl-6">

                <!--begin:: Widgets/Stats2-2 -->
                <div class="m-widget1">
                {foreach from=$resumen.documentos item=row key=idx}
                    <div class="m-widget1__item">
                        <div class="row m-row--no-padding align-items-center">
                            <div class="col">
                                <h3 class="m-widget1__title">{$row.plural}</h3>
                                <span class="m-widget1__desc">Documentos</span>
                            </div>
                            <div class="col m--align-right">
                                <span class="m-widget1__number m--font-info">{$row.cantidad}</span>
                            </div>
                        </div>
                    </div>
                {/foreach}
                </div>

                <!--begin:: Widgets/Stats2-2 -->
            </div>

        </div>
    </div>
</div>

<!--End::Section-->


<div class="m-portlet">
    <div class="m-portlet__head"rel="color_2">
        <div class="m-portlet__head-caption" >
            <div class="m-portlet__head-title">
                <span class="m-portlet__head-icon"><i class="fa fa-user-friends"></i></span>
                <h3 class="m-portlet__head-text">Usuarios Dependientes</h3>
            </div>
        </div>
    </div>
    <!--begin::Form-->

    <div class="m-portlet__body row">


    {foreach from=$resumen.dependientes item=row key=idx}

    <div class="col-xl-4">
        <!--begin:: Widgets/Blog-->
        <div class="m-portlet m-portlet--bordered-semi m-portlet--full-height  m-portlet--rounded-force">

            <div class="m-portlet__body">
                <div class="m-widget19">

                    <div class="m-widget4">
                        <div class="m-widget4__item">
                            <div class="m-widget4__img m-widget4__img--logo">
                                <img src="./template/user/images/icon/genero-{if $row.genero == 'mujer'}femenino{else}masculino{/if}.png" alt="">
                            </div>
                            <div class="m-widget4__info">
                                <span class="m-widget4__title">{$row.nombre}</span>
                                <br>
                                <span class="m-widget4__sub">{$row.mosca} - Pendientes</span>
                            </div>
                            <span class="m-widget4__ext">
                                <span class="m-widget4__number m--font-danger">{$row.pendientes}</span>
                            </span>
                        </div>
                    </div>
                    <div class="m-widget19__body">
                        {$row.cargo}
                        <br />
                        Ultimo Ingreso: <strong>{$row.last_login|date_format:"%D %H:%M:%S"}</strong>
                    </div>
                </div>
            </div>
        </div>
        <!--end:: Widgets/Blog-->
    </div>
    {/foreach}


    </div>
</div>
{else}

<div class="m-portlet">
    <div class="m-portlet__head">
        <div class="m-portlet__head-caption">
            <div class="m-portlet__head-title">
                <span class="m-portlet__head-icon"><i class="fa fa-user-astronaut"></i></span>
                <h3 class="m-portlet__head-text">No Existe Datos Codice</h3>
            </div>
        </div>
    </div>
    <!--begin::Form-->
    <div class="m-portlet__body">

        <div class="alert alert-danger" role="alert">
            <strong>SIN DATOS!</strong> Esta persona no tiene configurado una cuenta CODICE, activa
            <br />
            Usted puede configurar una cuenta activa para esta persona.
        </div>

    </div>
</div>


{/if}

{include file="index.js.tpl"}
{include file="index.css.tpl"}