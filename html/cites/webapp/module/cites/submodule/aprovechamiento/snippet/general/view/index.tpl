<div class="m-portlet m--padding-bottom-5" >
    <form class="m-form m-form--fit m-form--label-align-right" method="POST"
          action="{$path_url}/{$subcontrol}_/{if $type=="update"}{$id}/{/if}guardar/"
          id="general_form">

        <div class="m-portlet__head">
            <div class="m-portlet__head-caption">
                <div class="m-portlet__head-title">
                    <h4 class="m--font-success">Datos Generales del Informe</h4>
                </div>
            </div>
        </div>

        <div class="m-portlet__body m--padding-bottom-5 m--padding-top-5">
            {if $item.itemId != "" or $type == 'new'}
            <div class="m-form__content">
                <div class="m-alert m-alert--icon alert alert-danger m--hide" role="alert" id="m_form_1_msg">
                    <div class="m-alert__icon">
                        <i class="la la-warning"></i>
                    </div>
                    <div class="m-alert__text">
                        ¡Atención! Revise la información faltante e intente continuar con su solicitud.
                    </div>
                    <div class="m-alert__close">
                        <button type="button" class="close" data-close="alert" aria-label="Close">
                        </button>
                    </div>
                </div>
            </div>
                {*******************mensaje de observacion************}
                {if $item.estado_id == 3 and $item.observacion!="" and $item.observado==1}
                    <div class="form-group m-form__group m-form row">
                        <div class="m-alert m-alert--icon m-alert--icon-solid m-alert--outline alert alert-danger alert-dismissible fade show" role="alert">
                            <div class="m-alert__icon">
                                <i class="flaticon-exclamation-2"></i>
                                <span></span>
                            </div>
                            <div class="m-alert__text">
                                <strong>Observación:</strong> {$item.observacion}
                            </div>
                            <div class="m-alert__close">
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                </button>
                            </div>
                        </div>
                    </div>
                {/if}

                <div class="form-group m-form__group row m--padding-bottom-5 m--padding-top-5" >
                    <div class="col-lg-4 m-form__group-sub m--padding-right-5 m--padding-left-5" >
                        <div class="cuadro m--padding-10">
                            <div class="col-lg-12 titulo m--margin-bottom-5 m--padding-left-5">1. Número de informe:</div>
                            <div class="input-group">
                                <input type="text" class="form-control m-input numero_decimal"
                                       placeholder="Ingrese el número de informe"
                                       required data-msg="Este campo es requerido."
                                       name="item[numero_informe]"  {$privFace.input} value="{$item.numero_informe|escape:'html'}">
                                <div class="input-group-append"><span class="input-group-text" id="basic-addon2"><i class="fa fa-file-alt"></i></span></div>
                            </div>
                            <span class="m-form__help text-info text-info ">Utilice el nro de informe con el CITE de su organización</span>
                        </div>
                    </div>
                    <div class="col-lg-4 m-form__group-sub m--padding-right-5 m--padding-left-5" >
                        <div class="cuadro m--padding-10">
                            <div class="col-lg-12 titulo m--margin-bottom-5 m--padding-left-5">2. Fecha del reporte:</div>
                            <div class="input-group">
                                <input type="text" class="form-control m-input fecha_general"
                                       placeholder="Ingrese la fecha"
                                       name="item[fecha_reporte]"  {$privFace.input}
                                       required data-msg="Este campo es requerido."
                                       value="{if $item.fecha_reporte}{$item.fecha_pago|date_format:'%d/%m/%Y'}{/if}">
                                <div class="input-group-append"><span class="input-group-text" id="basic-addon2"><i class="flaticon-event-calendar-symbol"></i></span></div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 m-form__group-sub m--padding-right-5 m--padding-left-5" >
                        <div class="cuadro m--padding-10">
                            <div class="col-lg-12 titulo m--margin-bottom-5 m--padding-left-5">3. Nombre de la Entidad/insitucion/otro:</div>
                            <div class="input-group">
                                <input type="text" class="form-control m-input numero_decimal"
                                       placeholder="Ingrese el número de informe"
                                       required data-msg="Este campo es requerido." disabled
                                       name="item[nombre_entidad]"  {$privFace.input} value="{$item_empresa.nombre|escape:'html'}">
                                <div class="input-group-append"><span class="input-group-text" id="basic-addon2"><i class="fa fa-user"></i></span></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="form-group m-form__group row m--padding-top-5 m--padding-bottom-5 " >
                    <div class="col-lg-6  m-form__group-sub m--padding-right-5 m--padding-left-5" >
                        <div class="cuadro m--padding-10">
                            <div class="col-lg-12 titulo m--margin-bottom-5 m--padding-left-5">4. De:</div>
                            <div class="col-lg-12 m-form__group-sub cuadro-padding-0">
                                <label class="form-control-label">Nombre  de la persona que emite el reporte:</label>
                                <div class="input-group">
                                    <input type="text" class="form-control m-input mayus"
                                           placeholder="Ingrese el nombre" name="item[emite_nombre]"
                                            {$privFace.input} value="{$item.emite_nombre|escape:'html'}"
                                           data-msg="Este campo es requerido, registre la información." required minlength="2">
                                    <div class="input-group-append"><span class="input-group-text" id="basic-addon2"><i class="fa fa-user"></i></span></div>
                                </div>
                            </div>
                            <div class="col-lg-12 m-form__group-sub cuadro-padding-0">
                                <label class="form-control-label">Cargo de la persona que emite el informe:</label>
                                <div class="input-group">
                                    <input type="text" class="form-control m-input mayus"
                                           placeholder="Ingrese el nombre" name="item[emite_cargo]"
                                            {$privFace.input} value="{$item.emite_cargo|escape:'html'}"
                                           data-msg="Este campo es requerido, registre la información." required minlength="2">
                                    <div class="input-group-append"><span class="input-group-text" id="basic-addon2"><i class="fa fa-user-lock"></i></span></div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-6  m-form__group-sub m--padding-right-5 m--padding-left-5" >
                        <div class="cuadro m--padding-10">
                            <div class="col-lg-12 titulo m--margin-bottom-5 m--padding-left-5">5. Para:</div>
                            <div class="col-lg-12 m-form__group-sub cuadro-padding-0">
                                <label class="form-control-label">Nombre de la persona a la que va dirigido el informe:</label>
                                <div class="input-group">
                                    <input type="text" class="form-control m-input mayus"
                                           placeholder="Ingrese el nombre" name="item[para_nombre]"
                                            {$privFace.input} value="{$item.para_nombre|escape:'html'}"
                                           data-msg="Este campo es requerido, registre la información." required minlength="2">
                                    <div class="input-group-append"><span class="input-group-text" id="basic-addon2"><i class="fa fa-user"></i></span></div>
                                </div>
                            </div>
                            <div class="col-lg-12 m-form__group-sub cuadro-padding-0">
                                <label class="form-control-label">Cargo de la persona a la que va dirigido el informe:</label>
                                <div class="input-group">
                                    <input type="text" class="form-control m-input mayus"
                                           placeholder="Ingrese el nombre" name="item[para_cargo]"
                                            {$privFace.input} value="{$item.para_cargo|escape:'html'}"
                                           data-msg="Este campo es requerido, registre la información." required minlength="2">
                                    <div class="input-group-append"><span class="input-group-text" id="basic-addon2"><i class="fa fa-user-lock"></i></span></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6  m-form__group-sub m--padding-right-5 m--padding-left-5" >
                        <div class="cuadro m--padding-10">
                            <div class="col-lg-12 titulo m--margin-bottom-5 m--padding-left-5">4. Procedencia:</div>
                            <div class="col-lg-12 m-form__group-sub cuadro-padding-0">
                                <label class="form-control-label">Departamento:</label>
                                <div class="input-group">
                                    <input type="text" class="form-control m-input mayus"
                                           placeholder="Ingrese el departamento" name="item[departamento_id]"
                                            {$privFace.input} value="{$item_empresa.departamento|escape:'html'}"
                                           required minlength="2" disabled
                                           data-msg="Este campo es requerido, registre la información.">
                                    <div class="input-group-append"><span class="input-group-text" id="basic-addon2"><i class="fa fa-map-marker-alt"></i></span></div>
                                </div>
                            </div>
                            <div class="col-lg-12 m-form__group-sub cuadro-padding-0">
                                <label class="form-control-label">Municipio:</label>
                                <div class="input-group">
                                    <input type="text" class="form-control m-input mayus"
                                           placeholder="Ingrese el departamento" name="item[municipio]"
                                            {$privFace.input} value="{$item_empresa.ciudad|escape:'html'}"
                                           required minlength="2" disabled
                                           data-msg="Este campo es requerido, registre la información.">
                                    <div class="input-group-append"><span class="input-group-text" id="basic-addon2"><i class="fa fa-map-marker-alt"></i></span></div>
                                </div>
                            </div>
                            <div class="col-lg-12 m-form__group-sub cuadro-padding-0">
                                <label class="form-control-label">Ciudad:</label>
                                <div class="input-group">
                                    <input type="text" class="form-control m-input mayus"
                                           placeholder="Ingrese el departamento" name="item[ciudad]"
                                            {$privFace.input} value="{$item.ciudad|escape:'html'}"
                                           required minlength="2"
                                           data-msg="Este campo es requerido, registre la información.">
                                    <div class="input-group-append"><span class="input-group-text" id="basic-addon2"><i class="fa fa-map-marker-alt"></i></span></div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-6  m-form__group-sub m--padding-right-5 m--padding-left-5" >
                        <div class="cuadro m--padding-10">
                            <div class="col-lg-12 titulo m--margin-bottom-5 m--padding-left-5">4. Referencia del documento:</div>
                            <div class="col-lg-12 m-form__group-sub cuadro-padding-0">
                                <div class="input-group">
                                    <textarea class="form-control m-input mayus" placeholder="Ingrese la referencia" name="item[referencia]" cols="4" required data-msg="Este campo es requerido, registre la información." {$privFace.input}>{$item.referencia|escape:'html'}</textarea>
                                    <div class="input-group-append"><span class="input-group-text" id="basic-addon2"><i class="fa fa-file-alt"></i></span></div>
                                </div>
                                <span class="m-form__help text-info text-info ">Ejemplo: Informe de verificación de precintos</span>
                            </div>
                            <div class="col-lg-12 titulo m--margin-bottom-5 m--padding-left-5">4. Texto introductorio:</div>
                            <div class="col-lg-12 m-form__group-sub cuadro-padding-0">
                                <div class="input-group">
                                    <textarea class="form-control m-input mayus" placeholder="Ingrese la referencia" name="item[texto_introductorio]" cols="4" required data-msg="Este campo es requerido, registre la información." {$privFace.input}>{$item.texto_introductorio|escape:'html'}</textarea>
                                    <div class="input-group-append"><span class="input-group-text" id="basic-addon2"><i class="fa fa-file-alt"></i></span></div>
                                </div>
                                <span class="m-form__help text-info text-info ">Describa brevemente el reporte que envia. Maximo 200 palabras</span>
                            </div>

                        </div>
                    </div>
                </div>

            <div class="m-form__actions m-form__actions--solid m-form__actions--left">
                {if $item.estado_id ==1 or $type == 'new'}
                    <button type="reset" class="btn btn-success" id="general_submit">
                        <span>&nbsp;Guardar y continuar <i class="fa fa-angle-double-right"></i>&nbsp; </span>
                    </button>
                {else}
                    {if $item.estado_id ==3 and $item.observado == '1'}
                        <button type="reset" class="btn btn-success" id="general_submit">
                            <span>&nbsp;Guardar y continuar <i class="fa fa-angle-double-right"></i>&nbsp; </span>
                        </button>
                    {/if}
                {/if}
            </div>
            {else}
                <strong>El registro no existe.</strong>
            {/if}

        </div>
    </form>

</div>
{if $item.estado_id ==1 or $item.estado_id ==3}
    <div class="alert alert-primary alert-dismissible fade show   m-alert m-alert--air m-alert--outline" role="alert">
        <span class="m-nav__link-badge">
            <span class="m-badge m-badge--danger m-badge--wide m-badge--rounded">NOTA</span>
        </span>
        <span class="m-nav__link-title">
            <span class="m-nav__link-wrap">
                <span class="m-nav__link-text">Debe continuar con el registro del Cuadro I: Total Precintos utilizado en <strong> "PRECINTOS"</strong> de la parte superior.</span>
                <i class="m-nav__link-icon flaticon-chat-1"></i>
            </span>
        </span>
    </div>
{/if}

{include file="index.js.tpl"}
{include file="index.css.tpl"}