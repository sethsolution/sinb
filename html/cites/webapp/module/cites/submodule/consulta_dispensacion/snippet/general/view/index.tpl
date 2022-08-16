<!--begin::Portlet-->
<div class="m-portlet">
    <!--begin::Form-->
    <form class="m-form m-form--fit m-form--label-align-right" method="POST"
          action="{$path_url}/{$subcontrol}_/{if $type=="update"}{$id}/{/if}guardar/"
          id="general_form">


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
            {/if}
            <div class="form-group m-form__group row m--padding-bottom-5 m--padding-top-5 m--padding-bottom-5" >
                <div class="col-lg-12 m-form__group-sub m--padding-right-5 m--padding-left-5 " >
                    <div class="cuadro-verde m--padding-10" >
                        <label class="form-control-label">Tipo de Dispensación:</label>
                        <div class="input-group">
                            {if $type == 'new'}
                                <select class="form-control m-select2 select2_general"
                                        name="item[tipo_id]"  {$privFace.input} id="tipo_id"
                                        required
                                        data-msg="Campo requerido" >
                                    <option value=""></option>
                                    {html_options options=$cataobj.dispensacion_tipo selected=$item.tipo_id}
                                </select>

                            {else}
                                {$item.dispensacion_tipo}&nbsp;
                                <br>
                                {if $item.monto != 0}
                                    <span style="color:green;">
                            <strong>Costo</strong>
                            {$item.monto} Bs.
                                    </span>
                                {/if}
                            {/if}
                        </div>
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
                                La fecha se adjuntara cuando el certificado este aprobado.
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
                                <input type="text" class="form-control m-input"
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
                                <input type="text" class="form-control m-input"
                                       placeholder="Ingrese la dirección del importador" name="item[importador_direccion]"
                                        {$privFace.input} value="{$item.importador_direccion|escape:'html'}"
                                       data-msg="Campo requerido" required minlength="2">
                                <div class="input-group-append"><span class="input-group-text" id="basic-addon2"><i class="fa fa-map-marker-alt"></i></span></div>
                            </div>
                            <span class="m-form__help text-info text-info ">Ejemplo: Ciudad, zona, calle, nro de vivienda, piso, nro departamento.</span>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6  m-form__group-sub m--padding-right-5 m--padding-left-5" >
                    <div class="cuadro m--padding-10">
                        <div class="col-lg-12 titulo m--margin-bottom-5 m--padding-left-5">4. Exportador / re-exportador:</div>
                        <div class="col-lg-12 m-form__group-sub cuadro-padding-0">
                            <label class="form-control-label">Nombre Exportador:</label>
                            <div class="input-group">
                                <input type="text" class="form-control m-input"
                                       placeholder="Ingrese el nombre del exportador" name="item[exportador_nombre]"
                                        {$privFace.input} value="{$item.exportador_nombre|escape:'html'}"
                                       data-msg="Campo requerido" required minlength="2">
                                <div class="input-group-append"><span class="input-group-text" id="basic-addon2"><i class="fa fa-truck"></i></span></div>
                            </div>
                        </div>
                        <div class="col-lg-12 m-form__group-sub cuadro-padding-0">
                            <label class="form-control-label">Dirección Exportador:</label>
                            <div class="input-group">
                                <input type="text" class="form-control m-input"
                                       placeholder="Ingrese la dirección del exportador" name="item[exportador_direccion]"
                                        {$privFace.input} value="{$item.exportador_direccion|escape:'html'}"
                                       data-msg="Campo requerido" required minlength="2">
                                <div class="input-group-append"><span class="input-group-text" id="basic-addon2"><i class="fa fa-map-marker-alt"></i></span></div>
                            </div>
                            <span class="m-form__help text-info text-info ">Ejemplo: Ciudad, zona, calle, nro de vivienda, piso, nro departamento.</span>
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
                                        {* required *}
                                        data-msg="Campo requerido"  >
                                    <option value="NULL">Sin Dato</option>
                                    {html_options options=$cataobj.pais selected=$item.importacion_pais_id}
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-12  m-form__group-sub m--padding-right-5 m--padding-left-5 m--padding-bottom-10" >
                        <div  class="cuadro m--padding-10">
                            <div class="col-lg-12 titulo m--margin-bottom-5 m--padding-left-5">5. Condiciones Especiales:</div>
                            <div class="">
                                {if $item.estado_id == "4"}
                                    {$item.condiciones_especiales|escape:'html'}
                                {else}
                                    Las condiciones especiales serán descritas internamente.
                                {/if}

                            </div>

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
                            <img src="/images/logo/logo_estado_pluri.jpg"  class="img-rounded" width="150" style="width: 150px:"><br>
                            MINISTERIO DE MEDIO AMBIENTE Y AGUA<br>
                            VICEMINISTERIO DE MEDIO AMBIENTE, BIODIVERSIDAD, CAMBIOS CLIMÁTICOS Y DE GESTIÓN Y DESARROLLO FORESTAL<br>
                            Dirección General de Biodiversidad y Áreas Protegidas<br>
                            Av. Camacho N 1471<br>
                            LA PAZ, BOLIVIA
                        </div>
                    </div>
                </div>
            </div>
            <div class="m-form__actions m-form__actions--solid m-form__actions--left">
                {if $item.estado_id ==1 or $type == 'new'}
                        <button type="reset" class="btn btn-primary" id="general_submit">
                            <span><i class="fa fa-save"></i>&nbsp;&nbsp;Guardar Cambios</span></button>
                {else}
                    {if $item.estado_id ==3 and $item.observado == '1'}
                        <button type="reset" class="btn btn-primary" id="general_submit">
                            <span><i class="fa fa-save"></i>&nbsp;&nbsp;Guardar Cambios</span>
                        </button>
                    {/if}
                {/if}
                {*<a href="/{$miga.modulo.carpeta}/{$miga.smodulo.carpeta}/" class="btn btn-secondary">Volver</a>*}
            </div>

            {if $item.estado_id ==1 or $item.estado_id ==3}
                <div class="alert alert-primary alert-dismissible fade show   m-alert m-alert--air m-alert--outline" role="alert">
                    <i class="m-nav__link-icon flaticon-chat-1"></i>
                    <strong>NOTA: </strong>
                    <span class="m-nav__link-title">
                        <span class="m-nav__link-wrap">
                            <span class="m-nav__link-text">Debe continuar con el registro de documentos, en la pestaña "REQUISITOS" de la parte superior.</span>
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
<!--end::Portlet-->
{include file="index.js.tpl"}
{include file="index.css.tpl"}