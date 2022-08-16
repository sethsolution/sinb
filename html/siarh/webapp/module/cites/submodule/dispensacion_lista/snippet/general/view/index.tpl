<!--begin::Portlet-->
<div class="m-portlet m--padding-bottom-5" >
    <!--begin::Form-->
    <form class="m-form m-form--fit m-form--label-align-right" method="POST" action="{$getModule}"  id="general_form">
        <div class="m-portlet__head">
            <div class="m-portlet__head-caption">
                <div class="m-portlet__head-title">
                    <h4 class="m--font-success">Datos Generales</h4>
                </div>
            </div>
        </div>

        <div class="m-portlet__body m--padding-bottom-5 m--padding-top-5">

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

                <div class="form-group m-form__group row m--padding-bottom-5 m--padding-top-5" >
                    <div class="col-lg-7 m-form__group-sub m--padding-right-5 m--padding-left-5" >
                        <div class="cuadro m--padding-10">
                            <div class="col-lg-12 titulo m--margin-bottom-5 m--padding-left-5">1. Permiso / Certificado:</div>
                            <div class="input-group">
                                <div class="m-radio-list">
                                    {foreach from=$cataobj.tipo_documento item=row key=idx}
                                        <label class="m-radio m-radio--success">
                                            <input type="radio" name="item[tipo_documento_id]"  {$privFace.input} value="{$row.itemId}"
                                                    {if $row.itemId== $item.tipo_documento_id} checked{/if}
                                            > {$row.nombre}
                                            <span></span>
                                        </label>
                                    {/foreach}
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-5 m-form__group-sub m--padding-right-5 m--padding-left-5" >
                        <div class="cuadro m--padding-10">
                            <div class="col-lg-12 titulo m--margin-bottom-5 m--padding-left-5">2. Válido Hasta el :</div>
                            <div class="m-input-icon m-input-icon--right">
                                {if $item.estado_id == "4"}
                                    {$item.fecha_expiracion}
                                {else}
                                    La fecha de validez se establecerá automáticamente a partir de la aprobación de su solicitud.
                                {/if}
                            </div>
                        </div>
                    </div>
                </div>
                <div class="form-group m-form__group row m--padding-top-5 m--padding-bottom-5 " >
                    <div class="col-lg-6  m-form__group-sub m--padding-right-5 m--padding-left-5" >
                        <div class="cuadro m--padding-10">
                            <div class="col-lg-12 titulo m--margin-bottom-5 m--padding-left-5">3. Importador:</div>
                            <div class="col-lg-12 m-form__group-sub cuadro-padding-0">
                                <label class="form-control-label">Nombre Importador:</label>

                                <div class="input-group">
                                    <input type="text" class="form-control m-input mayus"
                                           placeholder="Ingrese nombre del importador" name="item[importador_nombre]"
                                            {$privFace.input} value="{$item.importador_nombre|escape:'html'}"
                                           required minlength="2"
                                           data-msg="Campo requerido">
                                    <div class="input-group-append"><span class="input-group-text" id="basic-addon2"><i class="fa fa-truck"></i></span></div>
                                </div>
                                {*<span class="m-form__help text-info ">s</span>*}
                            </div>
                            <div class="col-lg-12 m-form__group-sub cuadro-padding-0">
                                <label class="form-control-label">Dirección Importador:</label>
                                <div class="input-group">
                                    <textarea  class="form-control m-input mayus" placeholder="Ingrese la dirección del importador" name="item[importador_direccion]" cols="4" required minlength="2" {$privFace.input}>{$item.importador_direccion|escape:'html'}</textarea>
                                    <div class="input-group-append"><span class="input-group-text" id="basic-addon2"><i class="fa fa-map-marker-alt"></i></span></div>
                                </div>
                                <span class="m-form__help text-danger text-info ">Ejemplo de llenado:</span>
                                <span class="m-form__help text-info text-info ">
                                    - zona/avenida/calle
                                    <br>- calle
                                    <br>- Nro. de vivienda, piso, nro departamento, Nro. telefono
                                    <br>- Ciudad
                                </span>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6  m-form__group-sub m--padding-right-5 m--padding-left-5" >
                        <div class="cuadro m--padding-10">
                            <div class="col-lg-12 titulo m--margin-bottom-5 m--padding-left-5">4. Exportador / re-exportador:</div>
                            <div class="col-lg-12 m-form__group-sub cuadro-padding-0">
                                <label class="form-control-label">Nombre Exportador:</label>
                                <div class="input-group">
                                    <input type="text" class="form-control m-input mayus"
                                           placeholder="Ingrese el nombre del exportador" name="item[exportador_nombre]"
                                            {$privFace.input} value="{$item.exportador_nombre|escape:'html'}"
                                           data-msg="Campo requerido" required minlength="2">
                                    <div class="input-group-append"><span class="input-group-text" id="basic-addon2"><i class="fa fa-truck"></i></span></div>
                                </div>
                            </div>
                            <div class="col-lg-12 m-form__group-sub cuadro-padding-0">
                                <label class="form-control-label">Dirección Exportador:</label>
                                <div class="input-group">
                                    <textarea  class="form-control m-input mayus" placeholder="Ingrese la dirección del exportador"  name="item[exportador_direccion]" cols="4" required minlength="2" {$privFace.input}>{$item.exportador_direccion|escape:'html'}</textarea>
                                    <div class="input-group-append"><span class="input-group-text" id="basic-addon2"><i class="fa fa-map-marker-alt"></i></span></div>
                                </div>
                                <span class="m-form__help text-danger text-info ">Ejemplo de llenado:</span>
                                <span class="m-form__help text-info text-info ">
                                    - zona/avenida/calle
                                    <br>- calle
                                    <br>- Nro. de vivienda, piso, nro departamento, Nro. telefono
                                    <br>- Ciudad
                                </span>
                            </div>

                            <div class="col-lg-12 m-form__group-sub cuadro-padding-0">
                                <label class="form-control-label">País Exportador:</label>
                                <div class="input-group">
                                    <select class="form-control m-select2 select2_general"
                                            name="item[exportador_pais_id]"  {$privFace.input} id="exportador_pais_id"
                                            required
                                            data-msg="Campo requerido">
                                        <option value="NULL">Sin Dato</option>
                                        {html_options options=$cataobj.pais selected=$item.exportador_pais_id}
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="form-group m-form__group row m--padding-top-5  m--padding-top-5"  >
                    <div class="col-lg-6 row  m-form__group-sub cuadro-margin-0 cuadro-padding-0" >
                        <div class="col-lg-12  m-form__group-sub m--padding-right-5 m--padding-left-5 cuadro-margin-0 m--padding-bottom-10"  >
                            <div  class="cuadro m--padding-10 " >
                                <div class="col-lg-12 titulo m--margin-bottom-5 m--padding-left-5">3a. País de Importación:</div>
                                <div class="m-input-icon m-input-icon--right">
                                    <select class="form-control m-select2 select2_general"
                                            name="item[importacion_pais_id]"  {$privFace.input} id="importacion_pais_id"
                                            required
                                            data-msg="Campo requerido">
                                        <option value="NULL">Sin Dato</option>
                                        {html_options options=$cataobj.pais selected=$item.importacion_pais_id}
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-12  m-form__group-sub m--padding-right-5 m--padding-left-5 m--padding-bottom-10" >
                            <div  class="cuadro m--padding-10">
                                <div class="col-lg-12 titulo m--margin-bottom-5 m--padding-left-5">5. Condiciones Especiales:</div>
                                <div class="input-group">
                                    <textarea class="form-control m-input mayus" placeholder="Ingrese las ondiciones especiales" name="item[condiciones_especiales]" cols="4" required data-msg="Campo requerido" {$privFace.input}>{$item.condiciones_especiales|escape:'html'}</textarea>
                                </div>
                                <span class="m-form__help text-info">
                                        Describa las condiciones especiales
                                 </span>
                            </div>
                        </div>
                        <div class="col-lg-12  m-form__group-sub m--padding-right-5 m--padding-left-5 m--padding-bottom-10" >
                            <div  class="cuadro m--padding-10">
                                <div class="col-lg-12 titulo m--margin-bottom-5 m--padding-left-5">5a. Propósito de la transacción:</div>
                                <div class="input-group">
                                    <select class="form-control m-select2 select2_general"
                                            name="item[proposito_id]"  {$privFace.input} id="proposito_id"
                                            required
                                            data-msg="Campo requerido">
                                        <option value=""></option>
                                        {html_options options=$cataobj.tipo_proposito selected=$item.proposito_id}
                                    </select>
                                </div>

                            </div>
                        </div>


                    </div>
                    <div class="col-lg-6  m-form__group-sub m--padding-right-5 m--padding-left-5" >
                        <div class="cuadro m--padding-10">
                            <div class="col-lg-12 titulo m--margin-bottom-5 m--padding-left-5">6. Nombre, Dirección, Sello/timbre nacional y país de la Autoridad Administrativa:</div>

                            <div class="text-center ">
                                <img src="/module/cites/template/images/logo/logo_estado_pluri.png"  class="img-rounded" width="150" style="width: 150px:"><br>
                                MINISTERIO DE MEDIO AMBIENTE Y AGUA<br>
                                VICEMINISTERIO DE MEDIO AMBIENTE, BIODIVERSIDAD, CAMBIOS CLIMÁTICOS Y DE GESTIÓN Y DESARROLLO FORESTAL<br>
                                Dirección General de Biodiversidad y Áreas Protegidas<br>
                                LA PAZ, BOLIVIA
                            </div>
                        </div>
                    </div>

                </div>
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
                                        <label><input type="checkbox" {if $item.observado == 1}checked="checked"{/if}
                                      name="item[observado]" value="1"  id="observado"/><span></span></label>
                                    </span>
                                        </div>
                                    </div>

                                    <div class="col-lg-12 m-form__group-sub {if $item.observado == 0}m--hide{/if}" id="observacion">
                                        <label class="form-control-label">Observación</label>
                                        <div class="input-group">
                                            <div class="summernote_detalle" id="observacion_detalle">{$item.observacion}</div>
                                            <input class="form-control m-input" type="hidden" name="item[observacion]"
                                                   id="observacion_input_detalle" {$privFace.input2}>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                    {/if}

                    {if $item.estado_id == 3 and $item.observacion!="" }
                        <div class="m-alert m-alert--icon m-alert--icon-solid m-alert--outline alert alert-danger alert-dismissible fade show" role="alert">
                            <div class="m-alert__icon">
                                <i class="flaticon-exclamation-2"></i>
                                <span></span>
                            </div>
                            <div class="m-alert__text {*text-black-50*}">
                                <strong>Observación de Requisitos:</strong> {$item.observacion}
                                <br>
                                {if $item.observacion !=""}
                                    Fecha de observación, <strong>{$item.observacion_texto_fecha|date_format:"%d/%m/%Y %H:%M:%S"}</strong>
                                {/if}
                            </div>
                            <div class="m-alert__close">
                                {*<button type="button" class="close" data-dismiss="alert" aria-label="Close"></button>*}
                            </div>
                        </div>
                    {/if}



            <div class="m-portlet__foot m-portlet__no-border m-portlet__foot--fit">
                <div class="m-form__actions m-form__actions--solid">
                    <div class="row">
                        <div class="col-lg-6">
                            {if $privFace.editar == 1}
                                <button type="reset" class="btn btn-primary" id="general_submit">
                                    <span><i class="fa fa-save"></i>&nbsp;&nbsp;Guardar Cambios</span></button>
                            {/if}
                        </div>
                    </div>
                </div>
            </div>



            <div class="alert alert-primary alert-dismissible fade show   m-alert m-alert--air m-alert--outline" role="alert">
                <span class="m-nav__link-badge">
                    <span class="m-badge m-badge--danger m-badge--wide m-badge--rounded">NOTA</span>
                </span>
                        <span class="m-nav__link-title">
                        <span class="m-nav__link-wrap">
                            <span class="m-nav__link-text">Debe continuar con la revisión de especies, en la opción <strong> "ESPECIE"</strong> de la parte superior.</span>
                            <i class="m-nav__link-icon flaticon-chat-1"></i>
                        </span>
                    </span>
                </div>

        </div>

    </form>

</div>
<!--end::Portlet-->
{include file="index.js.tpl"}
{include file="index.css.tpl"}