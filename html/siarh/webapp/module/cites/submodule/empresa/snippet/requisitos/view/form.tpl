<!--begin::Portlet-->
<div class="m-portlet m--margin-bottom-5">
    <!--begin::Form-->
    <form class="m-form m-form--fit m-form--label-align-right" method="POST"
          action="{$getModule}"
          id="general_form">

        <div class="m-portlet__body m--padding-bottom-5 m--padding-top-5">
            {if $item.itemId != "" or $type == 'new' }

                <div class="m-form__content">
                    <div class="m-alert m-alert--icon alert alert-danger m--hide" role="alert" id="m_form_1_msg">
                        <div class="m-alert__icon">
                            <i class="la la-warning"></i>
                        </div>
                        <div class="m-alert__text">
                            Atencion! Revise revise la información obligatoria faltante e intente enviar nuevamente.
                        </div>
                        <div class="m-alert__close">
                            <button type="button" class="close" data-close="alert" aria-label="Close">
                            </button>
                        </div>
                    </div>
                </div>

                {*----------------------------------------------------------------------------------*}
                {* Solo para EMPRESAS  EXPORTADORAS DE ESPECIES MADERABLES CITES *}
                {*----------------------------------------------------------------------------------*}
                {if $item.tipo_id == 5}
                    <div class="form-group m-form__group row m--padding-top-5 m--padding-bottom-5 " >
                        <div class="col-lg-12  m-form__group-sub" >
                            <div class="cuadro m--padding-5 row">
                                <div class="col-lg-12 titulo m--margin-bottom-5 m--padding-left-5">
                                    Programa de Abastecimiento y Procesamiento de Materia Prima (PAPMP) según ABT
                                </div>
                                <div class="col-lg-6 m-form__group-sub">
                                    <label class="form-control-label">Seleccione la Especie 1:</label>
                                    <div class="input-group">
                                        <select class="form-control m-select2 select2_general"
                                                name="item[papmp_especie1_id]"  {$privFace.input} id="select_activo1"
                                                required data-msg="Campo requerido" >
                                            <option value="null">Seleccion Nombre común (Nombre científico)</option>
                                            {html_options options=$cataobj.especie selected=$item.papmp_especie1_id}
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-3 m-form__group-sub">
                                    <label class="form-control-label">Cantidad de Especie 1:</label>
                                    <div class="input-group">
                                        <input type="text" class="form-control m-input numero_entero"
                                               placeholder="Ingrese la cantidad" name="item[papmp_especie1_cantidad]"
                                                {$privFace.input} value="{$item.papmp_especie1_cantidad|escape:'html'}"
                                               data-msg="Campo requerido" >
                                    </div>
                                </div>

                                <div class="col-lg-3 form-group-sub {if $item.papmp_especie1_id != "1"} m--hide{/if}" id="nombre1_div">
                                    <label class="form-control-label">Detalle el Nombre Común:</label>
                                    <div class="input-group">
                                        <input type="text" class="form-control m-input"
                                               placeholder="Ingrese el nombre común" name="item[papmp_especie1_nombre]"
                                                {$privFace.input} value="{$item.papmp_especie1_nombre|escape:'html'}"
                                               data-msg="Campo requerido" >
                                    </div>
                                </div>
                                <div class="col-lg-6 m-form__group-sub">
                                    <label class="form-control-label">Seleccione la Especie 2:</label>
                                    <div class="input-group">
                                        <select class="form-control m-select2 select2_general"
                                                name="item[papmp_especie2_id]"  {$privFace.input} id="select_activo2"
                                                required data-msg="Campo requerido" >
                                            <option value="null">Seleccion Nombre común (Nombre científico)</option>
                                            {html_options options=$cataobj.especie selected=$item.papmp_especie2_id}
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-3 m-form__group-sub">
                                    <label class="form-control-label">Cantidad de especie 2:</label>
                                    <div class="input-group">
                                        <input type="text" class="form-control m-input numero_entero"
                                               placeholder="Ingrese la cantidad" name="item[papmp_especie1_cantidad]"
                                                {$privFace.input} value="{$item.papmp_especie2_cantidad|escape:'html'}"
                                               data-msg="Campo requerido" >
                                    </div>
                                </div>
                                <div class="col-lg-3 form-group-sub {if $item.papmp_especie2_id != "1"} m--hide{/if}" id="nombre2_div">
                                    <label class="form-control-label">Detalle el Nombre Común:</label>
                                    <div class="input-group">
                                        <input type="text" class="form-control m-input"
                                               placeholder="Ingrese el nombre común" name="item[papmp_especie2_nombre]"
                                                {$privFace.input} value="{$item.papmp_especie2_nombre|escape:'html'}"
                                               data-msg="Campo requerido" >
                                    </div>
                                </div>
                                <div class="col-lg-6 m-form__group-sub">
                                    <label class="form-control-label">Seleccione la Especie 3:</label>
                                    <div class="input-group">
                                        <select class="form-control m-select2 select2_general"
                                                name="item[papmp_especie3_id]"  {$privFace.input} id="select_activo3"
                                                required data-msg="Campo requerido" >
                                            <option value="null">Seleccion Nombre común (Nombre científico)</option>
                                            {html_options options=$cataobj.especie selected=$item.papmp_especie3_id}
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-3 m-form__group-sub">
                                    <label class="form-control-label">Cantidad de especie 3:</label>
                                    <div class="input-group">
                                        <input type="text" class="form-control m-input numero_entero"
                                               placeholder="Ingrese la cantidad" name="item[papmp_especie3_cantidad]"
                                                {$privFace.input} value="{$item.papmp_especie1_cantidad|escape:'html'}"
                                               data-msg="Campo requerido" >
                                    </div>
                                </div>
                                <div class="col-lg-3 form-group-sub {if $item.papmp_especie3_id != "1"} m--hide{/if}" id="nombre3_div">
                                    <label class="form-control-label">Detalle el Nombre Común:</label>
                                    <div class="input-group">
                                        <input type="text" class="form-control m-input"
                                               placeholder="Ingrese el nombre común" name="item[papmp_especie3_nombre]"
                                                {$privFace.input} value="{$item.papmp_especie3_nombre|escape:'html'}"
                                               data-msg="Campo requerido" >
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                {/if}
                {*----------------------------------------------------------------------------------*}
                {* Solo para EMPRESAS  EXPORTADORAS DE ESPECIES MADERABLES CITES *}
                {*----------------------------------------------------------------------------------*}
                {if $item.tipo_id == 5}
                    <div class="form-group m-form__group row m--padding-top-5 m--padding-bottom-5 " >
                        <div class="col-lg-12  m-form__group-sub" >
                            <div class="cuadro m--padding-5 row">
                                <div class="col-lg-12 titulo m--margin-bottom-5 m--padding-left-5">
                                    Resolución Administrativa que aprueba el PAPMP legalzada y otorgada por la ABT - vigente
                                </div>
                                <div class="col-lg-4 m-form__group-sub">
                                    <label class="form-control-label">Año:</label>
                                    <div class="input-group">
                                        <input type="text" class="form-control m-input numero_entero"
                                               placeholder="Año" name="item[papmp_anio]"
                                                {$privFace.input} value="{$item.papmp_anio|escape:'html'}"
                                               data-msg="Campo requerido" >
                                    </div>
                                </div>
                                <div class="col-lg-8 m-form__group-sub">
                                    <label class="form-control-label">Nombre de la Empresa:</label>

                                    <div class="input-group">
                                        <input type="text" class="form-control m-input"
                                               placeholder="Ingrese el nombre de la empresa" name="item[papmp_empresa]"
                                                {$privFace.input} value="{$item.papmp_empresa|escape:'html'}"
                                               data-msg="Campo requerido" >
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>


                {/if}
                {*----------------------------------------------------------------------------------*}
                {* Solo para EMPRESAS EXPORTADORAS DE LAGARTO (Caiman yacaré) *}
                {*----------------------------------------------------------------------------------*}
                {if $item.tipo_id == 6}
                    <div class="form-group m-form__group row m--padding-top-5 m--padding-bottom-5 " >
                        <div class="col-lg-12  m-form__group-sub" >
                            <div class="cuadro m--padding-5 row">
                                <div class="col-lg-12 titulo m--margin-bottom-5 m--padding-left-5">
                                    Certificado de inscripción en la Red de Cuero y Carne de lagarto
                                    otorgado por el Programa de Conservación
                                    y Aprovechamiento Sostenible de lagarto (Caiman yacare)
                                    - vigente
                                </div>
                                <div class="col-lg-6 m-form__group-sub">
                                    <label class="form-control-label">Fecha de emisión:</label>
                                    <div class="input-group">
                                        <input type="text" class="form-control m-input fecha_general"
                                               placeholder="01/01/2020" name="item[lagarto_fecha_emision]"
                                                {$privFace.input} value="{if $item.lagarto_fecha_emision}{$item.lagarto_fecha_emision|date_format:'%d/%m/%Y'}{/if}"
                                               required minlength="2"
                                               data-msg="Campo requerido" >
                                        <div class="input-group-append">
                                            <span class="input-group-text" id="basic-addon2">
                                                <i class="flaticon-event-calendar-symbol"></i>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6 m-form__group-sub">
                                    <label class="form-control-label">Fecha de Caducidad:</label>

                                    <div class="input-group">
                                        <input type="text" class="form-control m-input fecha_general"
                                               placeholder="01/01/2020" name="item[lagarto_fecha_caducidad]"
                                                {$privFace.input} value="{if $item.lagarto_fecha_caducidad}{$item.lagarto_fecha_caducidad|date_format:'%d/%m/%Y'}{/if}"
                                               required minlength="2"
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
                {* Solo para EMPRESAS / ASOCIACIONES EXPORTADORAS COMERCIALIZADORAS DE ESPECIMENES,
                PARTES Y O DERIVADOS DE ESPECIES CITES (Por ej: Vicuña, Paiche, otros) *}
                {*----------------------------------------------------------------------------------*}
                {if $item.tipo_id == 4}
                    <div class="form-group m-form__group row m--padding-top-5 m--padding-bottom-5 " >
                        <div class="col-lg-12  m-form__group-sub" >
                            <div class="cuadro m--padding-5 row">
                                <div class="col-lg-12 titulo m--margin-bottom-5 m--padding-left-5">
                                    Resolución Administrativa que aprueba el Plan de Manejo,
                                    emitida por la Autoridad Ambiental Competente Nacional (AACN),
                                    de acuerdo a la especie (vigente en caso que corresponda)
                                </div>
                                <div class="col-lg-4 m-form__group-sub">
                                    <label class="form-control-label">Nro. Resolucón Administrativa:</label>
                                    <div class="input-group">
                                        <input type="text" class="form-control m-input"
                                               placeholder="Ingrese el número de R.A." name="item[aacn_ra]"
                                                {$privFace.input} value="{$item.aacn_ra|escape:'html'}"
                                               required
                                               data-msg="Campo requerido" >
                                        <div class="input-group-append">
                                            <span class="input-group-text" id="basic-addon2">
                                                <i class="flaticon-file-1"></i>
                                            </span>
                                        </div>

                                    </div>

                                </div>
                                <div class="col-lg-4 m-form__group-sub">
                                    <label class="form-control-label">Fecha de Emisión:</label>
                                    <div class="input-group">
                                        <input type="text" class="form-control m-input fecha_general"
                                               placeholder="01/01/2020" name="item[aacn_fecha_emision]"
                                                {$privFace.input} value="{if $item.aacn_fecha_emision}{$item.aacn_fecha_emision|date_format:'%d/%m/%Y'}{/if}"
                                               required minlength="2"
                                               data-msg="Campo requerido" >
                                        <div class="input-group-append">
                                            <span class="input-group-text" id="basic-addon2">
                                                <i class="flaticon-event-calendar-symbol"></i>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-4 m-form__group-sub">
                                    <label class="form-control-label">Fecha de Caducidad:</label>
                                    <div class="input-group">
                                        <input type="text" class="form-control m-input fecha_general"
                                               placeholder="01/01/2020" name="item[aacn_fecha_caducidad]"
                                                {$privFace.input} value="{if $item.aacn_fecha_caducidad}{$item.aacn_fecha_caducidad|date_format:'%d/%m/%Y'}{/if}"
                                               required minlength="2"
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
                {* INSTITUCIONES CIENTIFICAS ACREDITADAS (ICA) Y AUTORIDADES CIENTIFICAS CITES  *}
                {*----------------------------------------------------------------------------------*}

                {if $item.tipo_id == 7}
                    <div class="form-group m-form__group row m--padding-top-5 m--padding-bottom-5 " >
                        <div class="col-lg-12  m-form__group-sub" >
                            <div class="cuadro m--padding-5 row">
                                <div class="col-lg-12 titulo m--margin-bottom-5 m--padding-left-5">
                                    Acreditación como ICA o Autoridad Cientifica CITES (vigente) y/o R.A.
                                </div>
                                <div class="col-lg-4 m-form__group-sub">
                                    <label class="form-control-label">Nro. Resolucón Administrativa:</label>
                                    <div class="input-group">
                                        <input type="text" class="form-control m-input"
                                               placeholder="Ingrese el número de R.A." name="item[ica_ra]"
                                                {$privFace.input} value="{$item.ica_ra|escape:'html'}"
                                               required
                                               data-msg="Campo requerido" >
                                        <div class="input-group-append">
                                            <span class="input-group-text" id="basic-addon2">
                                                <i class="flaticon-file-1"></i>
                                            </span>
                                        </div>

                                    </div>

                                </div>
                                <div class="col-lg-4 m-form__group-sub">
                                    <label class="form-control-label">Fecha de Emisión:</label>
                                    <div class="input-group">
                                        <input type="text" class="form-control m-input fecha_general"
                                               placeholder="01/01/2020" name="item[ica_fecha_emision]"
                                                {$privFace.input} value="{if $item.ica_fecha_emision}{$item.ica_fecha_emision|date_format:'%d/%m/%Y'}{/if}"
                                               required minlength="2"
                                               data-msg="Campo requerido" >
                                        <div class="input-group-append">
                                            <span class="input-group-text" id="basic-addon2">
                                                <i class="flaticon-event-calendar-symbol"></i>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-4 m-form__group-sub">
                                    <label class="form-control-label">Fecha de Caducidad:</label>
                                    <div class="input-group">
                                        <input type="text" class="form-control m-input fecha_general"
                                               placeholder="01/01/2020" name="item[ica_fecha_caducidad]"
                                                {$privFace.input} value="{if $item.ica_fecha_caducidad}{$item.ica_fecha_caducidad|date_format:'%d/%m/%Y'}{/if}"
                                               required minlength="2"
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

                {*  <div class="m-portlet__foot m-portlet__no-border m-portlet__foot--fit">
                      <div class="m-form__actions m-form__actions--solid">
                          <div class="row">
                              <div class="col-lg-6">
                                  {if $privFace.editar == 1}
                                      <button type="reset" class="btn btn-primary" id="general_submit">
                                          <span><i class="fa fa-save"></i>&nbsp;&nbsp;Guardar Datos de Requisitos</span>
                                      </button>
                                  {/if}
                              </div>
                          </div>
                      </div>
                  </div>*}
                {*{if $item.tipo_id != 5}*}
                <div class="m-form__actions m-form__actions--solid m-form__actions--left">
                    {if $privFace.editar == 1}
                        <button type="reset" class="btn btn-primary" id="general_submit">
                            <span><i class="fa fa-save"></i>&nbsp;&nbsp;Guardar Datos de Requisitos</span>
                        </button>
                    {/if}
                </div>
                {* {/if}*}
            {else}
                <strong>El registro no existe.</strong>
            {/if}
        </div>
    </form>
    {if $item.estado_id ==1 or $item.estado_id ==3}
        <div class="alert alert-primary alert-dismissible fade show   m-alert m-alert--air m-alert--outline
m--margin-bottom-5 m--margin-left-5 m--margin-right-5
" role="alert">
            <i class="m-nav__link-icon flaticon-chat-1"></i>
            <strong>NOTA: </strong>
            <span class="m-nav__link-title">
                <span class="m-nav__link-wrap">
                    <span class="m-nav__link-text">Debe continuar con el registro del depósito, en el menú lateral "REGISTRO DE BOLETA".</span>
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
