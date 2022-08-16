<div class="m-portlet m--padding-bottom-5" >
    <form class="m-form m-form--fit m-form--label-align-right" method="POST" action="{$getModule}" id="general_form">

        <div class="m-portlet__body m--padding-bottom-5 m--padding-top-5">
            {if $item.itemId != "" or $type == 'new' }

                <div class="m-form__content">
                    <div class="m-alert m-alert--icon alert alert-danger m--hide" role="alert" id="m_form_1_msg">
                        <div class="m-alert__icon">
                            <i class="la la-warning"></i>
                        </div>
                        <div class="m-alert__text">
                            ¡Atención! Revise los campos faltantes e intente continuar con su solicitud.
                        </div>
                        <div class="m-alert__close">
                            <button type="button" class="close" data-close="alert" aria-label="Close">
                            </button>
                        </div>
                    </div>
                </div>
                {*******************mensaje de observacion************}
                {if $item.requisitos_observado == 1 and $item.requisitos_observacion != "" and $item.estado_id == 3}
                    <div class="m-alert m-alert--icon m-alert--icon-solid m-alert--outline alert alert-danger alert-dismissible fade show" role="alert">
                        <div class="m-alert__icon">
                            <i class="flaticon-exclamation-2"></i>
                            <span></span>
                        </div>
                        <div class="m-alert__text">
                            <strong>Observación - datos requisitos:&nbsp;&nbsp;</strong> {$item.requisitos_observacion}
                        </div>
                        <div class="m-alert__close">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            </button>
                        </div>
                    </div>
                {/if}
            {*----------------------------------------------------------------------------------*}

                <div class="form-group m-form__group row m--padding-top-5 m--padding-bottom-5 " >
                    <div class="col-lg-12  m-form__group-sub" >
                        <div class="cuadro m--padding-5 row">
                            <div class="col-lg-12 titulo m--margin-bottom-5 m--padding-left-5">
                                Datos Generales
                            </div>
                            <div class="col-lg-6 m-form__group-sub">
                                <label class="form-control-label">Nombre de la empresa/asociación:</label>
                                <div class="input-group">
                                    <input type="text" class="form-control m-input mayus"
                                           placeholder="Ingrese el nombre de la empresa" name="item[empresa_nombre]"
                                            {$privFace.input} value="{$item.empresa_nombre|escape:'html'}"
                                    >
                                </div>
                            </div>

                            <div class="col-lg-6 m-form__group-sub">
                                <label class="form-control-label">Nombre completo del representante legal:</label>
                                <div class="input-group">
                                    <input type="text" class="form-control m-input mayus"
                                           placeholder="Ingrese el nombre completo" name="item[representante_legal_nombre]"
                                            {$privFace.input} value="{$item.representante_legal_nombre|escape:'html'}"
                                           required data-msg="Campo requerido">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="form-group m-form__group row m--padding-top-5 m--padding-bottom-5 " >
                    <div class="col-lg-12  m-form__group-sub" >
                        <div class="cuadro m--padding-5 row">
                            <div class="col-lg-12 titulo m--margin-bottom-5 m--padding-left-5">
                                Carta de Solicitud dirigida al Viceministerio de Medio Ambiente, Biodiversidad, Cambio Climático y de Gestión y Desarrollo Forestal, en su calidad de Autoridad Ambiental Competente Nacional.</div>
                            <div class="col-lg-4 m-form__group-sub">
                                <label class="form-control-label">Tipo de aprovechamiento:</label>
                                <div class="m-input-icon m-input-icon--right">
                                    <select class="form-control m-select2 select2_general"
                                            name="item[tipo_aprovechamiento]"  {$privFace.input} id="tipo_aprovechamiento"
                                            required data-msg="Campo requerido" >
                                        <option value=""></option>
                                        <option value="1" {if $item.tipo_aprovechamiento == '1'} selected {/if}>Silvestria</option>
                                        <option value="2" {if $item.tipo_aprovechamiento == '2'} selected {/if}>Zoocria</option>
                                    </select>
                                    <span class="m-form__help"></span>
                                </div>
                            </div>
                            <div class="col-lg-4 m-form__group-sub">
                                <label class="form-control-label">Cantidad de precintos solicitados:</label>
                                <div class="input-group">
                                    <input type="text" class="form-control m-input numero_entero"
                                           placeholder="Ingrese la cantidad" name="item[cantidad]"
                                            {$privFace.input} value="{$item.cantidad|escape:'html'}"
                                           required data-msg="Campo requerido" >
                                </div>
                            </div>

                            <div class="col-lg-4 m-form__group-sub">
                                <label class="form-control-label">Gestión de la cosecha:</label>
                                <div class="input-group">
                                    <input type="text" class="form-control m-input"
                                           placeholder="Ingrese le monto" name="item[gestion]"
                                            {$privFace.input} value="{$item.gestion|escape:'html'}"
                                           required data-msg="Campo requerido" >
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            {*----------------------------------------------------------------------------------*}


                {if $item.estado_id == 2}
                    <div class="form-group m-form__group row m--padding-top-5 m--padding-bottom-5 " >
                        <div class="col-lg-12  m-form__group-sub" >
                            <div class="cuadro m--padding-5 row">
                                <div class="col-lg-12 titulo m--margin-bottom-5 m--padding-left-5">
                                    Observaciones a requisitos
                                </div>
                                <div class="col-lg-12 m-form__group-sub">
                                    <label class="form-control-label">¿Observar?:</label>
                                    <div class="input-group">
                                    <span class="m-switch">
                                        <label><input type="checkbox" {if $item.requisitos_observado == 1}checked="checked"{/if}
                                      name="item[requisitos_observado]" value="1"  id="requisitos_observado"/><span></span></label>
                                    </span>
                                    </div>
                                </div>

                                <div class="col-lg-12 m-form__group-sub {if $item.requisitos_observado == 0}m--hide{/if}" id="observacion">
                                    <label class="form-control-label">Observación</label>
                                    <div class="input-group">
                                        <div class="summernote_detalle" id="observacion_detalle">{$item.requisitos_observacion}</div>
                                        <input class="form-control m-input" type="hidden" name="item[requisitos_observacion]"
                                               id="observacion_input_detalle" {$privFace.input2}>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                {/if}

                {if $item.estado_id == 3 and $item.requisitos_observacion!="" }
                    <div class="m-alert m-alert--icon m-alert--icon-solid m-alert--outline alert alert-danger alert-dismissible fade show" role="alert">
                        <div class="m-alert__icon">
                            <i class="flaticon-exclamation-2"></i>
                            <span></span>
                        </div>
                        <div class="m-alert__text {*text-black-50*}">
                            <strong>Observación de Requisitos:</strong> {$item.requisitos_observacion}
                            <br>
                            {if $item.requisitos_fecha !=""}
                                Fecha de observación de Requisitos, <strong>{$item.requisitos_fecha|date_format:"%d/%m/%Y %H:%M:%S"}</strong>
                            {/if}
                        </div>
                        <div class="m-alert__close">
                            {*<button type="button" class="close" data-dismiss="alert" aria-label="Close"></button>*}
                        </div>
                    </div>
                {/if}

                {if $item.estado_id == 2}
                    <div class="m-form__actions m-form__actions--solid m-form__actions--left">
                        {if $privFace.editar == 1}
                            <button type="reset" class="btn btn-primary" id="general_submit">
                                <span>Guardar Observacion&nbsp;&nbsp;<i class="fa fa-angle-double-right"></i></span>
                            </button>
                        {/if}
                    </div>
                {/if}


                {if $item.estado_id ==1 or $item.estado_id ==3}
                    <div class="alert alert-primary alert-dismissible fade show   m-alert m-alert--air m-alert--outline" role="alert">
                        <span class="m-nav__link-badge">
                            <span class="m-badge m-badge--danger m-badge--wide m-badge--rounded">NOTA</span>
                        </span>
                                <span class="m-nav__link-title">
                        <span class="m-nav__link-wrap">
                            <span class="m-nav__link-text">Debe continuar con el registro del Depósito, en la opción <strong>"BOLETA DE DEPÓSITO"</strong>.</span>
                            <i class="m-nav__link-icon flaticon-chat-1"></i>
                        </span>
                    </span>
                    </div>
                {/if}

            {else}
                <strong>El registro no existe.</strong>
            {/if}
        </div>
    </form>
</div>

{include file="form.js.tpl"}
