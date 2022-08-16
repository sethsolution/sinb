<div class="m-portlet m--padding-bottom-5" >
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
                            ¡Atención! Cambie algunas cosas e intente continuar con su solicitud.
                        </div>
                        <div class="m-alert__close">
                            <button type="button" class="close" data-close="alert" aria-label="Close">
                            </button>
                        </div>
                    </div>
                </div>

            {*----------------------------------------------------------------------------------*}
                {if $item.tipo_id == 1 or  $item.tipo_id == 2 or  $item.tipo_id == 3}
                    <div class="form-group m-form__group row m--padding-top-5 m--padding-bottom-5 " >
                        <div class="col-lg-12  m-form__group-sub" >
                            <div class="cuadro m--padding-5 row">
                                <div class="col-lg-12 titulo m--margin-bottom-5 m--padding-left-5">Factura comercial y/o proforma de factura comercial (según corresponda)</div>
                                <div class="col-lg-12 m-form__group-sub">
                                    <label class="form-control-label">Nombre de Comprador:</label>
                                    <div class="input-group">
                                        <input type="text" class="form-control m-input"
                                               placeholder="Ingrese nombre" name="item[proforma_nombre]"
                                                {$privFace.input} value="{$item.proforma_nombre|escape:'html'}"
                                               data-msg="Campo requerido" >
                                    </div>
                                </div>
                                <div class="col-lg-6 m-form__group-sub">
                                    <label class="form-control-label">País:</label>
                                    <div class="input-group">
                                        <select class="form-control m-select2 select2_general"
                                                name="item[proforma_pais_id]"  {$privFace.input} id="proforma_pais_id"
                                                required
                                                data-msg="Campo requerido" >
                                            <option value="null">Sin país</option>
                                            {html_options options=$cataobj.pais selected=$item.proforma_pais_id}
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-6 m-form__group-sub">
                                    <label class="form-control-label">Monto:</label>

                                    <div class="input-group">
                                        <input type="text" class="form-control m-input numero_decimal"
                                               placeholder="Ingrese le monto" name="item[proforma_monto]"
                                                {$privFace.input} value="{$item.proforma_monto|escape:'html'}"
                                               data-msg="Campo requerido" >
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                {/if}
            {*----------------------------------------------------------------------------------*}
                {if $item.tipo_id == 1}
                    <div class="form-group m-form__group row m--padding-top-5 m--padding-bottom-5 " >
                        <div class="col-lg-12  m-form__group-sub" >
                            <div class="cuadro m--padding-5 row">
                                <div class="col-lg-12 titulo m--margin-bottom-5 m--padding-left-5">
                                    Certificado forestal de origen para productos maderables emitido por la ABT (CFO)
                                </div>
                                <div class="col-lg-6 m-form__group-sub">
                                    <label class="form-control-label">Nro de CFO:</label>
                                    <div class="input-group">
                                        <input type="text" class="form-control m-input numero_entero"
                                               placeholder="Nro de CFO" name="item[cefo_numero]"
                                                {$privFace.input} value="{$item.cefo_numero|escape:'html'}"
                                               data-msg="Campo requerido" >
                                    </div>
                                </div>
                                <div class="col-lg-6 m-form__group-sub">
                                    <label class="form-control-label">Fecha de caducidad:</label>
                                    <div class="input-group">
                                        <input type="text" class="form-control m-input fecha_general"
                                               placeholder="01/01/2020" name="item[cefo_caducidad]"
                                                {$privFace.input} value="{if $item.cefo_caducidad}{$item.cefo_caducidad|date_format:'%d/%m/%Y'}{/if}"
                                               required minlength="2"
                                               data-msg="Campo requerido" >
                                        <div class="input-group-append"><span class="input-group-text" id="basic-addon2"><i class="flaticon-event-calendar-symbol"></i></span></div>
                                    </div>
                                </div>
                                <div class="col-lg-6 m-form__group-sub">
                                    <label class="form-control-label">Destinatario (coincidir con el importador):</label>

                                    <div class="input-group">
                                        <input type="text" class="form-control m-input"
                                               placeholder="Ingrese el destino" name="item[cefo_destinatario]"
                                                {$privFace.input} value="{$item.cefo_destinatario|escape:'html'}"
                                               data-msg="Campo requerido" >
                                    </div>
                                </div>
                                <div class="col-lg-6 m-form__group-sub">
                                    <label class="form-control-label">Detalle de la cantidad autorizada por el CFO:</label>

                                    <div class="input-group">
                                        <input type="text" class="form-control m-input numero_entero"
                                               placeholder="Ingrese la cantidad" name="item[cefo_catidad]"
                                                {$privFace.input} value="{$item.cefo_catidad|escape:'html'}"
                                               data-msg="Campo requerido" >
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                {/if}
            {*----------------------------------------------------------------------------------*}
                {if $item.tipo_id == 2}
                    <div class="form-group m-form__group row m--padding-top-5 m--padding-bottom-5 " >
                        <div class="col-lg-12  m-form__group-sub" >
                            <div class="cuadro m--padding-5 row">
                                <div class="col-lg-12 titulo m--margin-bottom-5 m--padding-left-5">
                                    Acta e informe de precintado de cuero de lagarto emitido por la Gobernación a cargo
                                </div>
                                <div class="col-lg-4 m-form__group-sub">
                                    <label class="form-control-label">Numero de precintos:</label>
                                    <div class="input-group">
                                        <input type="text" class="form-control m-input numero_entero"
                                               placeholder="Ingrese el número" name="item[precinto_numero]"
                                                {$privFace.input} value="{$item.precinto_numero|escape:'html'}"
                                               data-msg="Campo requerido" >
                                    </div>
                                </div>
                                <div class="col-lg-4 m-form__group-sub">
                                    <label class="form-control-label">Inicio:</label>
                                    <div class="input-group">
                                        <input type="text" class="form-control m-input numero_entero"
                                               placeholder="Ingrese inicio" name="item[precinto_inicio]"
                                                {$privFace.input} value="{$item.precinto_inicio|escape:'html'}"
                                               data-msg="Campo requerido" >
                                    </div>
                                </div>
                                <div class="col-lg-4 m-form__group-sub">
                                    <label class="form-control-label">Ultimo:</label>

                                    <div class="input-group">
                                        <input type="text" class="form-control m-input numero_entero"
                                               placeholder="Ingrese último" name="item[precinto_ultimo]"
                                                {$privFace.input} value="{$item.precinto_ultimo|escape:'html'}"
                                               data-msg="Campo requerido" >
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                {/if}

            {*----------------------------------------------------------------------------------*}
                {if $item.tipo_id == 2 }
                    <div class="form-group m-form__group row m--padding-top-5 m--padding-bottom-5 " >
                        <div class="col-lg-12  m-form__group-sub" >
                            <div class="cuadro m--padding-5 row">
                                <div class="col-lg-12 titulo m--margin-bottom-5 m--padding-left-5">
                                    Factura Comercial o documento validado por Aduana Nacional,
                                    en el que conste la descripción del producto y costo referencia de la transacción
                                </div>
                                <div class="col-lg-12 m-form__group-sub">
                                    <label class="form-control-label">Nombre de Comprador:</label>
                                    <div class="input-group">
                                        <input type="text" class="form-control m-input"
                                               placeholder="Ingrese nombre" name="item[factura_nombre]"
                                                {$privFace.input} value="{$item.factura_nombre|escape:'html'}"
                                               data-msg="Campo requerido" >
                                    </div>
                                </div>
                                <div class="col-lg-6 m-form__group-sub">
                                    <label class="form-control-label">País de destino:</label>
                                    <div class="input-group">
                                        <select class="form-control m-select2 select2_general"
                                                name="item[factura_pais_id]"  {$privFace.input} id="factura_pais_id"
                                                required
                                                data-msg="Campo requerido" >
                                            <option value="null">Sin Epecie</option>
                                            {html_options options=$cataobj.pais selected=$item.factura_pais_id}
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-6 m-form__group-sub">
                                    <label class="form-control-label">Monto:</label>

                                    <div class="input-group">
                                        <input type="text" class="form-control m-input numero_decimal"
                                               placeholder="Ingrese le monto" name="item[factura_monto]"
                                                {$privFace.input} value="{$item.factura_monto|escape:'html'}"
                                               data-msg="Campo requerido" >
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                {/if}
            {*----------------------------------------------------------------------------------*}
                {if  $item_padre.tipo_documento_id != 1 and ($item.tipo_id == 2 or $item.tipo_id == 3)}
                    <div class="form-group m-form__group row m--padding-top-5 m--padding-bottom-5 " >
                        <div class="col-lg-12  m-form__group-sub" >
                            <div class="cuadro m--padding-5 row">
                                <div class="col-lg-12 titulo m--margin-bottom-5 m--padding-left-5">
                                    Permiso CITES (En caso de re-exportación, importación)
                                </div>
                                <div class="col-lg-6 m-form__group-sub">
                                    <label class="form-control-label">Nro. de Permiso CITES</label>
                                    <div class="input-group">
                                        <input type="text" class="form-control m-input"
                                               placeholder="Ingrese el Nro" name="item[cites_numero]"
                                                {$privFace.input} value="{$item.cites_numero|escape:'html'}"
                                               data-msg="Campo requerido" >
                                    </div>
                                </div>
                                <div class="col-lg-6 m-form__group-sub">
                                    <label class="form-control-label">Fecha de caducidad:</label>

                                    <div class="input-group">
                                        <input type="text" class="form-control m-input fecha_general"
                                               placeholder="01/01/2020" name="item[cites_emision]"
                                                {$privFace.input} value="{if $item.cites_emision}{$item.cites_emision|date_format:'%d/%m/%Y'}{/if}"
                                               data-msg="Campo requerido" >
                                        <div class="input-group-append"><span class="input-group-text" id="basic-addon2"><i class="flaticon-event-calendar-symbol"></i></span></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                {/if}

            {*----------------------------------------------------------------------------------*}
                {if $item.tipo_id == 6 and $item_padre.tipo_documento_id == 3}
                    <div class="form-group m-form__group row m--padding-top-5 m--padding-bottom-5 " >
                        <div class="col-lg-12  m-form__group-sub" >
                            <div class="cuadro m--padding-5 row">
                                <div class="col-lg-12 titulo m--margin-bottom-5 m--padding-left-5">
                                    Certificado zoosanitario o fitosanitario (para importaciones)
                                </div>
                                <div class="col-lg-6 m-form__group-sub">
                                    <label class="form-control-label">Nro de certificado</label>
                                    <div class="input-group">
                                        <input type="text" class="form-control m-input"
                                               placeholder="Ingrese el Nro" name="item[zoosanitario_numero]"
                                               required
                                                {$privFace.input} value="{$item.zoosanitario_numero|escape:'html'}"
                                               data-msg="Campo requerido" >
                                    </div>
                                </div>
                                <div class="col-lg-6 m-form__group-sub">
                                    <label class="form-control-label">Fecha de emisión:</label>
                                    <div class="input-group">
                                        <input type="text" class="form-control m-input fecha_general"
                                               placeholder="01/01/2020" name="item[zoosanitario_emision]"
                                                {$privFace.input} value="{if $item.zoosanitario_emision}{$item.zoosanitario_emision|date_format:'%d/%m/%Y'}{/if}"
                                               required
                                               data-msg="Campo requerido" data-msg="Campo requerido">
                                        <div class="input-group-append"><span class="input-group-text" id="basic-addon2"><i class="flaticon-event-calendar-symbol"></i></span></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                {/if}

            {*----------------------------------------------------------------------------------*}
                {if $item.tipo_id == 7}
                    <div class="form-group m-form__group row m--padding-top-5 m--padding-bottom-5 " >
                        <div class="col-lg-12  m-form__group-sub" >
                            <div class="cuadro m--padding-5 row">
                                <div class="col-lg-12 titulo m--margin-bottom-5 m--padding-left-5">
                                    Documentación respaldatoria dirección, teléfono del destino
                                </div>
                                <div class="col-lg-12 m-form__group-sub">
                                    <label class="form-control-label">Dirección</label>
                                    <div class="input-group">
                                        <input type="text" class="form-control m-input"
                                               placeholder="Ingrese la dirección" name="item[destino_direccion]"
                                               required
                                                {$privFace.input} value="{$item.destino_direccion|escape:'html'}"
                                               data-msg="Campo requerido" >
                                    </div>
                                </div>
                                <div class="col-lg-12 m-form__group-sub">
                                    <label class="form-control-label">Teléfono del destino:</label>
                                    <div class="input-group">
                                        <input type="text" class="form-control m-input"
                                               placeholder="Ingrese el teléfono" name="item[destino_telefono]"
                                               required
                                                {$privFace.input} value="{$item.destino_telefono|escape:'html'}"
                                               data-msg="Campo requerido" >
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                {/if}
            {*----------------------------------------------------------------------------------*}
                {if $item.tipo_id == 4}
                    <div class="form-group m-form__group row m--padding-top-5 m--padding-bottom-5 " >
                        <div class="col-lg-12  m-form__group-sub" >
                            <div class="cuadro m--padding-5 row">
                                <div class="col-lg-12 titulo m--margin-bottom-5 m--padding-left-5">
                                    Nombre del proyecto
                                </div>
                                <div class="col-lg-12 m-form__group-sub">
                                    <label class="form-control-label">Nombre del proyecto (si corresponde)</label>
                                    <div class="input-group">
                                        <input type="text" class="form-control m-input"
                                               placeholder="Ingrese el nombre" name="item[nombre_proyecto]"

                                                {$privFace.input} value="{$item.nombre_proyecto|escape:'html'}"
                                               data-msg="Campo requerido" >
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

            {else}
                <strong>El registro no existe.</strong>
            {/if}
        </div>
    </form>
</div>

{include file="form.js.tpl"}
