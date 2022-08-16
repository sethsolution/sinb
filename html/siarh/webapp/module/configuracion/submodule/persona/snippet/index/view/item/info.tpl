{include file="item/info.css.tpl"}
<!--begin::Portlet-->
<div class="m-portlet  m-portlet--bordered-semi " style="margin-bottom: 0px !important;">
    <div class="m-portlet__head">
        <div class="m-portlet__head-caption">
            <div class="m-portlet__head-title">
						<span class="m-portlet__head-icon">
							<i class="la la-thumb-tack m--font-success"></i>
						</span>
                <h3 class="m-portlet__head-text">
                    ID: &nbsp; <strong><span class="m--font-success">{$item.itemId}</span></strong>
                </h3>
            </div>
        </div>
        <div class="m-portlet__head-tools">
            <ul class="m-portlet__nav">

                {*
                <li class="m-portlet__nav-item">
                    <div class="m-dropdown m-dropdown--inline m-dropdown--arrow m-dropdown--align-right m-dropdown--align-push" m-dropdown-toggle="hover" aria-expanded="true">
                        <a href="#" class="m-portlet__nav-link btn btn-lg btn-secondary  m-btn m-btn--icon m-btn--icon-only m-btn--pill  m-dropdown__toggle">
                            <i class="flaticon-interface-2"></i>
                        </a>
                        <div class="m-dropdown__wrapper">
                            <span class="m-dropdown__arrow m-dropdown__arrow--right m-dropdown__arrow--adjust"></span>
                            <div class="m-dropdown__inner">
                                <div class="m-dropdown__body">
                                    <div class="m-dropdown__content">
                                        <ul class="m-nav">
                                            <li class="m-nav__section m-nav__section--first">
                                                <span class="m-nav__section-text">Reporte</span>
                                            </li>
                                            <li class="m-nav__item">
                                                <a href="#" class="m-nav__link reporte_descarga">
                                                    <i class="m-nav__link-icon flaticon-logout"></i>
                                                    <span class="m-nav__link-text">PDF</span>
                                                </a>
                                            </li>
                                            <li class="m-nav__item">
                                                <a href="#" class="m-nav__link reporte_descarga">
                                                    <i class="m-nav__link-icon fa flaticon-graphic-2"></i>
                                                    <span class="m-nav__link-text">Excel</span>
                                                </a>
                                            </li>
                                            <li class="m-nav__item">
                                                <a href="#" class="m-nav__link reporte_descarga">
                                                    <i class="m-nav__link-icon flaticon-interface-1"></i>
                                                    <span class="m-nav__link-text">RTF / Documento</span>
                                                </a>
                                            </li>
                                            <li class="m-nav__item">
                                                <a href="#" class="m-nav__link reporte_descarga">
                                                    <i class="m-nav__link-icon flaticon-menu-1"></i>
                                                    <span class="m-nav__link-text">Texto</span>
                                                </a>
                                            </li>

                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </li>
                *}

                <li class="m-portlet__nav-item">
                    <a href="index.php?module={$miga.modulo.carpeta}&smodule={$miga.smodulo.carpeta}" class="btn btn-success m-btn m-btn--icon m-btn--icon-only m-btn--custom m-btn--pill" title="Atras">
                        <i class="la la-mail-reply"></i>
                    </a>
                </li>
            </ul>
        </div>
    </div>
{*

    <div class="m-portlet__body m--padding-bottom-5" >
        <strong>Nombre:</strong> {$item.nombres} {$item.apellido_paterno} {$item.apellido_materno}
    </div>


*}


    <div class="row m-row--no-padding">
        <div class="col-xl-3 col-lg-4 m-row--no-padding">
            <div class="m-portlet--full-height txt_info " style="margin: 0px!important;">
                <div class="m-portlet__body" style="padding-bottom: 0px!important;">

                    <div class="m-card-profile">
                        <div class="m-card-profile__title m--hide">Your Profile</div>
                        <div class="m-card-profile__pic">
                            <div class="m-card-profile__pic-wrapper"><img src="{$getModule}&accion=foto.get&id={$id}&type=3" alt="" id="persona_avatar"/></div>
                        </div>
                        {*
                        <div class="m-card-profile__details" id="div_perfil">
                            <span id="a_nombres" class="m-card-profile__name">{$item.nombres} {$item.apellido_paterno} {$item.apellido_materno}</span>
                           Celular: {$item.movil}
                        </div>
                        *}
                    </div>

                    <div class="m-widget1 m-widget1--paddingless">

                        <div class="row">


                                    <form class="m-form m-form--fit m-form--label-align-right" method="POST"  action="{$getModule}"  id="form_avatar">
                                        <input type="hidden" name="item_id" value="{$item_id}">
                                        <div class="form-group m-form__group row">

                                            <div class="custom-file">
                                                <input type="file" class="form-control m-input custom-file-input"
                                                       placeholder="Ingrese el archivo"
                                                       name="input_archivo_avatar"
                                                       id="input_archivo_avatar"
                                                       accept="image/jpeg,image/png"
                                                            minlength="2"
                                                            data-msg="Campo requerido" required
                                                       name="" value="{$item.descripcion|escape:"html"}">
                                                <label class="custom-file-label" for="input_archivo_avatar">Seleccione una fotos</label>
                                            </div>

                                            <div>
                                                <span class="m-form__help">
                                                    <span class="m--font-focus">SOLO si quiere actualizar la foto, seleccione uno nuevo. </span>
                                                    Puede subir solo archivos en formato <strong>JPG</strong> (.jpg)
                                                    <br>
                                                </span>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-success {if $item.adjunto_nombre == ''}m--hide{/if} "
                                                    onclick="window.location.href='{$getModule}&accion=foto.download&id={$id}'"
                                                    id="">Descargar Original</button>
                                            <button type="button" class="btn btn-primary" id="form_avatar_submit">Subir Foto</button>
                                        </div>
                                    </form>


                        </div>

                    </div>

                </div>

            </div>

        </div>

        <div class="col-xl-9 col-lg-8 m-row--no-padding">
            <div class="m-portlet m-portlet--full-height m-portlet--tabs " >

                <div class="m-portlet__head">
                    <div class="m-portlet__head-tools">
                        <ul class="nav nav-tabs m-tabs m-tabs-line   m-tabs-line--left m-tabs-line--primary" role="tablist">
                            <li class="nav-item m-tabs__item">
                                <a class="nav-link m-tabs__link active" data-toggle="tab" href="#resumen01" role="tab">
                                    <i class="flaticon-share"></i>Perfil
                                </a>
                            </li>
                            <li class="nav-item m-tabs__item">
                                <a class="nav-link m-tabs__link" data-toggle="tab" href="#resumen02" role="tab">
                                    Resumen
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>

                <div class="tab-content">


                    <div class="tab-pane active" id="resumen01">



                    </div>

                    <div class="tab-pane " id="resumen02">
                        <div class="m-portlet__body">

                            <br><br>
                            <div class="alert alert-warning" role="alert">
                                <strong>
                                    Noticia !!!
                                </strong>  Se visualizará la configuración del usuarios, "En Desarrollo"
                            </div>

                        </div>

                    </div>
                </div>

            </div>
        </div>

    </div>


</div>
<!--end::Portlet-->

