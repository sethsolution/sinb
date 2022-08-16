<!--begin::Portlet-->
<div class="m-portlet">
    <!--begin::Form-->
    <form class="m-form m-form--fit m-form--label-align-right" method="POST"
          action="{$path_url}/{$subcontrol}_/{$id}/guardar.detalle/"
          id="general_form">

        <div class="m-portlet__body m--padding-bottom-5 m--padding-top-5">
            {if $item.itemId != "" or $type == 'new' }
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

                {*----------------------------------------------------------------------------------*}
                {if $item.tipo_id == 1}
                    <div class="form-group m-form__group row m--padding-top-5 m--padding-bottom-5 " >
                        <div class="col-lg-12  m-form__group-sub" >
                            <div class="cuadro m--padding-5 row">

                                <div class="col-lg-12 m-form__group-sub">
                                    <label class="form-control-label">Nombre del proyecto:</label>
                                    <div class="input-group">
                                        <input type="text" class="form-control m-input"
                                               placeholder="Ingrese el nombre" name="item[nombre_proyecto]"
                                                {$privFace.input} value="{$item.nombre_proyecto|escape:'html'}"
                                               required data-msg="Campo requerido" >
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
                            <div class="col-lg-12 m-form__group-sub">
                                <label class="form-control-label">Nombre de Comprador:</label>
                                <div class="input-group">
                                    <input type="text" class="form-control m-input"
                                           placeholder="Ingrese nombre" name="item[proforma_nombre]"
                                            {$privFace.input} value="{$item.factura_nombre|escape:'html'}"
                                           data-msg="Campo requerido" >
                                </div>
                            </div>
                            <div class="col-lg-6 m-form__group-sub">
                                <label class="form-control-label">País:</label>
                                <div class="input-group">
                                    <select class="form-control m-select2 select2_general"
                                            name="item[proforma_pais_id]"  {$privFace.input} id="proforma_pais_id"
                                            data-msg="Campo requerido" >
                                        <option value="null">Sin país</option>
                                        {html_options options=$cataobj.pais selected=$item.factura_pais_id}
                                    </select>
                                </div>

                            </div>
                            <div class="col-lg-6 m-form__group-sub">
                                <label class="form-control-label">Monto:</label>

                                <div class="input-group">
                                    <input type="text" class="form-control m-input numero_decimal"
                                           placeholder="Ingrese le monto" name="item[proforma_monto]"
                                            {$privFace.input} value="{$item.factura_monto|escape:'html'}"
                                           data-msg="Campo requerido" >
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            {/if}


            {*----------------------------------------------------------------------------------*}
            {if  $item_padre.tipo_documento_id == 3 and ($item.tipo_id == 1 or $item.tipo_id == 2)}

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
            {if  $item_padre.tipo_documento_id == 2 and ($item.tipo_id == 1 or $item.tipo_id == 2)}
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


            {*----------------------------------------------------------------------------------*}
                {if $item.tipo_id != 5}
                    <div class="m-form__actions m-form__actions--solid m-form__actions--left">
                        {if $item.estado_id ==1 or $item.estado_id ==3}
                            <button type="reset" class="btn btn-primary" id="general_submit">Guardar Datos de Requisitos</button>
                        {/if}
                    </div>
                {/if}
            {else}
                <strong>El registro no existe.</strong>
            {/if}
        </div>
    </form>
    {if $item.estado_id ==1 or $item.estado_id ==3}
        <div class="alert alert-primary alert-dismissible fade show   m-alert m-alert--air m-alert--outline" role="alert">
            <i class="m-nav__link-icon flaticon-chat-1"></i>
            <strong>NOTA: </strong>
            <span class="m-nav__link-title">
                <span class="m-nav__link-wrap">
                    <span class="m-nav__link-text">Debe continuar con el registro del Depósito, en la pestaña "BOLETA DE DEPÓSITO" de la parte superior.</span>
                    <span class="m-nav__link-badge">
                        <span class="m-badge m-badge--danger m-badge--wide m-badge--rounded">NOTA</span>
                    </span>
                </span>
            </span>

        </div>
    {/if}

    <!--end::Form-->
</div>
<!--end::Portlet-->

{include file="form.js.tpl"}
