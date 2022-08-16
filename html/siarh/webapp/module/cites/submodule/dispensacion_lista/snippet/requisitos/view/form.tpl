<!--begin::Portlet-->
<div class="m-portlet">
    <!--begin::Form-->

    <form class="m-form m-form--fit m-form--label-align-right" method="POST" action="{$getModule}" id="general_form">
        {*******************mensaje de campos faltantes ************}
        <div class="m-portlet__body m--padding-bottom-5 m--padding-top-5">

                <div class="m-form__content">
                    <div class="m-alert m-alert--icon alert alert-danger m--hide" role="alert" id="m_form_1_msg">
                        <div class="m-alert__icon">
                            <i class="la la-warning"></i>
                        </div>
                        <div class="m-alert__text">
                            ¡Atención! Revise la información obligatoria faltante e intente continuar con su solicitud.
                        </div>
                        <div class="m-alert__close">
                            <button type="button" class="close" data-close="alert" aria-label="Close">
                            </button>
                        </div>
                    </div>
                </div>

            <div class="m-portlet__head">
                <div class="m-portlet__head-caption">
                    <div class="m-portlet__head-title">
                        <h4 class="m--font-success">Llenar la siguiente información (obligatorio)</h4>
                    </div>
                </div>
            </div>
                {*----------------------------------------------------------------------------------*}
                {if $item.tipo_id == 1}
                    <div class="form-group m-form__group row m--padding-top-5 m--padding-bottom-5 " >
                        <div class="col-lg-12  m-form__group-sub" >
                            <div class="cuadro m--padding-5 row">

                                <div class="col-lg-12 m-form__group-sub">
                                    <label class="form-control-label">Nombre del proyecto:</label>
                                    <div class="input-group">
                                        <input type="text" class="form-control m-input"
                                               placeholder="Ingrese el nombre del proyecto" name="item[nombre_proyecto]"
                                                {$privFace.input} value="{$item.nombre_proyecto|escape:'html'}"
                                               required data-msg="Campo requerido" >
                                        <div class="input-group-append"><span class="input-group-text" id="basic-addon2"><i class="flaticon-file-1 monto"></i></span></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                {/if}

                {*----------------------------------------------------------------------------------*}
                {if $item.tipo_id == 1 or $item.tipo_id == 2 }
                    <div class="form-group m-form__group row m--padding-top-5 m--padding-bottom-5 " >
                        <div class="col-lg-12  m-form__group-sub" >
                            <div class="cuadro m--padding-5 row">
                                <div class="col-lg-12 titulo m--margin-bottom-5 m--padding-left-5">
                                    Factura Comercial (cuando corresponda)
                                </div>
                                <div class="col-lg-6 m-form__group-sub">
                                    <label class="form-control-label">Nombre de Comprador:</label>
                                    <div class="input-group">
                                        <input type="text" class="form-control m-input"
                                               placeholder="Ingrese nombre" name="item[factura_nombre]"
                                                {$privFace.input} value="{$item.factura_nombre|escape:'html'}"
                                               data-msg="Campo requerido" >
                                    </div>
                                </div>
                                <div class="col-lg-6 m-form__group-sub">
                                    <label class="form-control-label">País:</label>
                                    <div class="input-group">
                                        <select class="form-control m-select2 select2_general"
                                                name="item[proforma_pais_id]"  {$privFace.input} id="factura_pais_id"
                                                data-msg="Campo requerido" >
                                            <option value="null">Sin país</option>
                                            {html_options options=$cataobj.pais selected=$item.factura_pais_id}
                                        </select>
                                    </div>

                                </div>
                                <div class="col-lg-4 m-form__group-sub">
                                    <label class="form-control-label">Monto en Bs:</label>
                                    <div class="input-group">
                                        <input type="text" class="form-control m-input numero_decimal monto"
                                               placeholder="Ingrese le monto" name="item[factura_monto]"
                                                {$privFace.input} value="{$item.factura_monto|escape:'html'}"
                                               data-msg="Campo requerido" >
                                        <div class="input-group-append">
                                            <span class="input-group-text" id="basic-addon2">
                                                <i class="flaticon-coins"></i>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-4 m-form__group-sub">
                                    <label class="form-control-label">Monto en Dólares:</label>
                                    <div class="input-group">
                                        <input type="text" class="form-control m-input numero_decimal"
                                               placeholder="Ingrese el monto en dólares" name="item[factura_dolar]"
                                                {$privFace.input} value="{$item.factura_dolar|escape:'html'}"
                                               data-msg="Campo requerido" >
                                        <div class="input-group-append">
                                            <span class="input-group-text" id="basic-addon2">
                                                <i class="flaticon-coins"></i>
                                            </span>
                                        </div>
                                    </div>
                                    <span class="m-form__help text-info text-info ">Opcional (si corresponde)</span>
                                </div>
                                <div class="col-lg-4 m-form__group-sub">
                                    <label class="form-control-label">Tipo de cambio:</label>
                                    <div class="input-group">
                                        <input type="text" class="form-control m-input numero_decimal tipo_cambio"
                                               placeholder="Ingrese el tipo de cambio" name="item[factura_tipo_cambio]"
                                                {$privFace.input} value="{$item.factura_tipo_cambio|escape:'html'}"
                                               data-msg="Campo requerido" >
                                        <div class="input-group-prepend"><span class="input-group-text" id="basic-addon1"><i class="fa fa-exchange-alt tipo_cambio"></i></span></div>
                                    </div>
                                    <span class="m-form__help text-info text-info ">Opcional (Tipo de cambio oficial)</span>
                                </div>
                            </div>
                        </div>
                    </div>
                {/if}


                {*----------------------------------------------------------------------------------*}
                {if  $item.tipo_id == 1 or $item.tipo_id == 2}

                    <div class="form-group m-form__group row m--padding-top-5 m--padding-bottom-5 " >
                        <div class="col-lg-12  m-form__group-sub" >
                            <div class="cuadro m--padding-5 row">
                                <div class="col-lg-12 titulo m--margin-bottom-5 m--padding-left-5">
                                    Certificado Fitosanitario o Zoosanitario del país de origen (en caso de importación)
                                </div>
                                <div class="col-lg-6 m-form__group-sub">
                                    <label class="form-control-label">Nro. de certificado:</label>
                                    <div class="input-group">
                                        <input type="text" class="form-control m-input"
                                               placeholder="Ingrese el número de certificado" name="item[zoosanitario_origen_numero]"
                                                {$privFace.input} value="{$item.zoosanitario_origen_numero|escape:'html'}"
                                               data-msg="Campo requerido" >
                                    </div>
                                </div>
                                <div class="col-lg-6 m-form__group-sub">
                                    <label class="form-control-label">Fecha de emisión:</label>

                                    <div class="input-group">
                                        <input type="text" class="form-control m-input fecha_general"
                                               placeholder="01/01/2020" name="item[zoosanitario_origen_emision]"
                                                {$privFace.input} value="{if $item.zoosanitario_origen_emision}{$item.zoosanitario_origen_emision|date_format:'%d/%m/%Y'}{/if}"
                                               data-msg="Campo requerido" >
                                        <div class="input-group-append">
                                            <span class="input-group-text" id="basic-addon2">
                                                <i class="flaticon-event-calendar-symbol"></i>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                {/if}

                {*----------------------------------------------------------------------------------*}
                {if  $item.tipo_id == 1 or $item.tipo_id == 2}
                    <div class="form-group m-form__group row m--padding-top-5 m--padding-bottom-5 " >
                        <div class="col-lg-12  m-form__group-sub" >
                            <div class="cuadro m--padding-5 row">
                                <div class="col-lg-12 titulo m--margin-bottom-5 m--padding-left-5">
                                    Certificado Fitosanitario o Zoosanitario del país exportador (en caso de re-exportación)
                                </div>
                                <div class="col-lg-6 m-form__group-sub">
                                    <label class="form-control-label">Nro. de certificado:</label>
                                    <div class="input-group">
                                        <input type="text" class="form-control m-input"
                                               placeholder="Ingrese el número de certificado" name="item[zoosanitario_destino_numero]"
                                                {$privFace.input} value="{$item.zoosanitario_destino_numero|escape:'html'}"
                                               data-msg="Campo requerido" >
                                    </div>
                                </div>
                                <div class="col-lg-6 m-form__group-sub">
                                    <label class="form-control-label">Fecha de emisión:</label>

                                    <div class="input-group">
                                        <input type="text" class="form-control m-input fecha_general"
                                               placeholder="01/01/2020" name="item[zoosanitario_destino_emision]"
                                                {$privFace.input} value="{if $item.zoosanitario_destino_emision}{$item.zoosanitario_destino_emision|date_format:'%d/%m/%Y'}{/if}"
                                               data-msg="Campo requerido" >
                                        <div class="input-group-append">
                                            <span class="input-group-text" id="basic-addon2">
                                                <i class="flaticon-event-calendar-symbol"></i>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                {/if}

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

        </div>
    </form>
    <div class="alert alert-primary alert-dismissible fade show   m-alert m-alert--air m-alert--outline" role="alert">
            <span class="m-nav__link-badge">
                <span class="m-badge m-badge--danger m-badge--wide m-badge--rounded">NOTA</span>
            </span>
        <span class="m-nav__link-title">
        <span class="m-nav__link-wrap">
            <span class="m-nav__link-text">Debe continuar con la revisión del Depósito, en la opción <strong>"BOLETA DE DEPÓSITO"</strong>.</span>
            <i class="m-nav__link-icon flaticon-chat-1"></i>
        </span>
    </span>
    </div>
    <!--end::Form-->
</div>
<!--end::Portlet-->

{include file="form.js.tpl"}
