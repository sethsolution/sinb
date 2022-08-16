<!--begin::Portlet-->
<div class="m-portlet">
    <!--begin::Form-->
    <form class="m-form m-form--fit m-form--label-align-right" method="POST" action="{$getModule}"  id="general_form">



        <div class="m-portlet__body m--padding-bottom-5">
            {******************VERIFICA CAMPOS OBLIGATORIOS LLENOS***************}
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


            <div class="m-portlet__head" >
                <div class="m-portlet__head-caption" >
                    <div class="m-portlet__head-title">
                        <h4 class="m--font-success">
                            Datos generales:&nbsp;&nbsp;
                            {if $item.tipo_id == 4 or $item.tipo_id == 5 or $item.tipo_id == 6}
                                Empresas/Asociaciones
                            {elseif $item.tipo_id == 7}
                                Instituciones Cientificas Autorizadas (ICAs) y
                                Autoridad Cientifica Acreditadas (ACC)
                            {elseif $item.tipo_id == 8}
                                USUARIOS OCASIONALES
                            {elseif $item.tipo_id == 12}
                                OTROS USUARIOS
                            {else}
                                Entidades Públicas
                            {/if}
                        </h4>
                    </div>
                </div>
            </div>
            <div class="form-group m-form__group row m--padding-bottom-5 m--padding-top-5 m--padding-bottom-5" >
                <div class="col-lg-12 m-form__group-sub m--padding-right-5 m--padding-left-5 " >
                    <div class="cuadro-verde m--padding-10" >
                        <label class="form-control-label">Tipo de Institución:</label>
                        <div class="input-group">
                            <select class="form-control m-select2 select2_general"
                                    name="item[tipo_institucion_id]"  {$privFace.input} id="institucion_activo"
                                    required data-msg="Campo requerido">
                                <option value=""></option>
                                {html_options options=$cataobj.empresa_tipo_institucion selected=$item.tipo_institucion_id}
                            </select>
                        </div>
                    </div>
                </div>
            </div>

            <div class="form-group m-form__group m-form row {if $item.tipo_institucion_id != "5"} m--hide{/if}"  id="institucion_div">
                <div class="col-lg-12 m-form__group-sub">
                    <label>
                        Descripción del tipo de la institución o entidad
                    </label>
                    <div class="input-group">
                        <input type="text" class="form-control m-input"
                               placeholder="Ingrese la descripción" name="item[tipo_institucion]" {$privFace.input} value="{$item.tipo_institucion|escape:'html'}"
                               minlength="2" data-msg="Campo requerido" >
                        <div class="input-group-append">
                                <span class="input-group-text" id="basic-addon2">
                                    <i class="la la-home"></i>
                                </span>
                        </div>
                    </div>
                </div>
            </div>

            {if $item.tipo_id == 8}
                <div class="form-group m-form__group m-form row">
                    <div class="col-lg-6 m-form__group-sub">
                        <label>Tipo de usuario ocasional: </label>
                        <div class="m-input-icon m-input-icon--right">
                            <select class="form-control m-select2 select2_general"
                                    name="item[ocasional_id]" {$privFace.input} id="ocasional_activo"
                                    required data-msg="Campo requerido" >
                                <option value=""></option>
                                {html_options options=$cataobj.empresa_ocasional selected=$item.ocasional_id}
                            </select>
                            <span class="m-form__help"></span>
                        </div>
                    </div>
                </div>
            {/if}

            <div class="form-group m-form__group m-form row {if $item.ocasional_id != "2" and $item.ocasional_id != ""} m--hide{/if}"  id="ocasional_div">
                <div class="col-lg-{if $item.tipo_id != 7 and $item.tipo_id != 10}8{else}12{/if} m-form__group-sub">
                    <label>
                        {if $item.tipo_id == 4 or $item.tipo_id == 5 or $item.tipo_id == 6}
                            Nombre Empresa:
                        {elseif $item.tipo_id == 7}
                            Nombre de la ICAs/Autoridad Cientifica
                        {elseif $item.tipo_id == 10}
                            Nombre de la institución o entidad
                        {else}
                            Nombre Empresa:
                        {/if}
                    </label>
                    <div class="input-group">
                        <input type="text" class="form-control m-input"
                               placeholder="Ingrese el nombre" name="item[nombre]" {$privFace.input} value="{$item.nombre|escape:'html'}"
                                {if $item.tipo_id != 8}required minlength="2"{/if} data-msg="Campo requerido" >
                        <div class="input-group-append">
                            <span class="input-group-text" id="basic-addon2">
                                <i class="la la-home"></i>
                            </span>
                        </div>
                    </div>
                </div>
                {if $item.tipo_id == 10}
                    <span class="m-form__help text-info">Formato de llenado (ejemplo): GAD Beni</span>
                {/if}

                {if $item.tipo_id != 7 and $item.tipo_id != 10}
                    <div class="col-lg-4 m-form__group-sub">
                        <label>Nro. de NIT de la empresa:</label>
                        <div class="input-group">
                            <input type="text" class="form-control m-input numero_entero"
                                   placeholder="Ingrese el nit" name="item[nit]"
                                    {$privFace.input} value="{$item.nit|escape:'html'}"
                                    {if $item.tipo_id != 8}required minlength="2"{/if}
                                   data-msg="Campo requerido">
                            <div class="input-group-append">
                                <span class="input-group-text" id="basic-addon2">
                                    <i class="la la-cc-jcb"></i>
                                </span>
                            </div>
                        </div>
                    </div>
                {/if}

                {if $item.tipo_id == 7}
                    <div class="col-lg-6 m-form__group-sub">
                        <label>Tipo de entidad cientifica: </label>
                        <div class="m-input-icon m-input-icon--right">
                            <select class="form-control m-select2 select2_general"
                                    name="item[entidad_cientifica_id]"  {$privFace.input} id="entidad_cientifica_id"
                                    required
                                    data-msg="Campo requerido" >
                                <option value=""></option>
                                {html_options options=$cataobj.empresa_entidad_cientifica selected=$item.entidad_cientifica_id}
                            </select>
                            <span class="m-form__help"></span>
                        </div>
                    </div>
                    <div class="col-lg-6 m-form__group-sub">
                        <label>Universidad Asociada (si corresponde):</label>
                        <div class="input-group">
                            <input type="text" class="form-control m-input"
                                   placeholder="Ingrese el nombre de la Universidad " name="item[universidad_asociada]"
                                    {$privFace.input} value="{$item.universidad_asociada|escape:'html'}"
                                   data-msg="Campo requerido" >
                            <div class="input-group-append">
                                    <span class="input-group-text" id="basic-addon2">
                                        <i class="la la-group"></i>
                                    </span>
                            </div>
                        </div>
                    </div>
                {/if}

                {if $item.tipo_id != 7 and $item.tipo_id != 10}
                    <div class="col-lg-12 m-form__group-sub">
                        <label>Objeto de empresa según FUNDEMPRESA</label>
                        <div class="input-group">
                            <input type="text" class="form-control m-input"
                                   placeholder="Ingrese el objeto de empresa" name="item[fundempresa_objeto]"
                                    {$privFace.input} value="{$item.fundempresa_objeto|escape:'html'}"
                                    {if $item.tipo_id != 8}required {/if}
                                   data-msg="Campo requerido" >
                            <div class="input-group-append">
                            <span class="input-group-text" id="basic-addon2">
                                <i class="la la-group"></i>
                            </span>
                            </div>
                        </div>
                        <span class="m-form__help text-info">ej: Comercializadora/acerraderos/curtiembres/otros </span>
                    </div>
                {/if}
            </div>


            {if $item.tipo_id != 7}
                <div class="m-portlet__head"  >
                    <div class="m-portlet__head-caption" >
                        <div class="m-portlet__head-title">
                            <h4 class="m--font-success">
                                {if $item.tipo_id == 4 or $item.tipo_id == 5 or $item.tipo_id == 6}
                                    Datos Representante Legal
                                {elseif $item.tipo_id == 10}
                                    Datos del representante que realiza el reporte
                                {else}
                                    Datos Representante Legal / Persona
                                {/if}
                            </h4>
                        </div>
                    </div>
                </div>

                <div class="form-group m-form__group m-form row">
                    <div class="col-lg-12 m-form__group-sub">
                        <label>Nombres:</label>
                        <div class="input-group">
                            <input type="text" class="form-control m-input"
                                   placeholder="Ingrese nombre" name="item[representante_legal_nombre]"
                                    {$privFace.input} value="{$item.representante_legal_nombre|escape:'html'}"
                                   required minlength="2"
                                   data-msg="Campo requerido" >
                            <div class="input-group-append">
                            <span class="input-group-text" id="basic-addon2">
                                <i class="la la-user"></i>
                            </span>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-6 m-form__group-sub">
                        <label>Apellido Paterno:</label>
                        <div class="input-group">
                            <input type="text" class="form-control m-input"
                                   placeholder="Ingrese el apellido paterno" name="item[representante_legal_paterno]"
                                    {$privFace.input} value="{$item.representante_legal_paterno|escape:'html'}"
                                   required minlength="2"
                                   data-msg="Campo requerido">
                            <div class="input-group-append">
                            <span class="input-group-text" id="basic-addon2">
                                <i class="la la-user"></i>
                            </span>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6 m-form__group-sub">
                        <label>Apellido Materno:</label>
                        <div class="input-group">
                            <input type="text" class="form-control m-input"
                                   placeholder="Ingrese apellido materno" name="item[representante_legal_materno]"
                                    {$privFace.input} value="{$item.representante_legal_materno|escape:'html'}"
                                   data-msg="Campo requerido">
                            <div class="input-group-append">
                            <span class="input-group-text" id="basic-addon2">
                                <i class="la la-user"></i>
                            </span>
                            </div>
                        </div>
                    </div>
                    {if $item.tipo_id == 10}
                        <div class="col-lg-12 m-form__group-sub">
                            <label>Cargo del representante encargado de realizar el reporte:</label>
                            <div class="input-group">
                                <input type="text" class="form-control m-input"
                                       placeholder="Ingrese el nombre del cargo" name="item[representante_legal_cargo]"
                                        {$privFace.input} value="{$item.representante_legal_cargo|escape:'html'}"
                                       required minlength="2"
                                       data-msg="Campo requerido" >
                                <div class="input-group-append">
                                <span class="input-group-text" id="basic-addon2">
                                    <i class="la la-user"></i>
                                </span>
                                </div>
                            </div>
                        </div>
                    {/if}
                </div>
                {if $item.tipo_id != 10}
                    <div class="form-group m-form__group m-form row">
                        <div class="col-lg-4 m-form__group-sub">
                            <label>Nro. de Carnet de Identidad:</label>
                            <div class="input-group">
                                <input type="text" class="form-control m-input"
                                       placeholder="Ingrese el ci" name="item[representante_legal_ci]"
                                        {$privFace.input} value="{$item.representante_legal_ci|escape:'html'}"
                                       required minlength="2"
                                       data-msg="Campo requerido" >
                                <div class="input-group-append">
                            <span class="input-group-text" id="basic-addon2">
                                <i class="la la-cc-jcb"></i>
                            </span>
                                </div>
                            </div>

                        </div>

                        <div class="col-lg-2 m-form__group-sub">
                            <label>Expedido: </label>
                            <div class="m-input-icon m-input-icon--right">
                                <select class="form-control m-select2 select2_general"
                                        name="item[representante_legal_ci_exp]"  {$privFace.input} id="representante_legal_ci_exp"
                                        required
                                        data-msg="Campo requerido" >
                                    <option value=""></option>
                                    {html_options options=$cataobj.expedido selected=$item.representante_legal_ci_exp}
                                </select>
                                <span class="m-form__help"></span>
                            </div>
                        </div>
                        {if $item.tipo_id == 4 or $item.tipo_id == 5 or $item.tipo_id == 6}
                            <div class="col-lg-6 m-form__group-sub">
                                <label>Número de Teléfono:</label>
                                <div class="input-group">
                                    <input type="text" class="form-control m-input"
                                           placeholder="Ingrese el número de teléfono del representante" name="item[representante_legal_telefono]"
                                            {$privFace.input} value="{$item.representante_legal_telefono|escape:'html'}"
                                            {*required*} minlength="2"
                                           data-msg="Campo requerido">
                                    <div class="input-group-append">
                                <span class="input-group-text" id="basic-addon2">
                                    <i class="la la-phone"></i>
                                </span>
                                    </div>
                                </div>
                            </div>
                        {/if}
                    </div>

                {/if}
            {/if}
            <div class="m-portlet__head"  >
                <div class="m-portlet__head-caption" >
                </div>
            </div>

            <div class="form-group m-form__group m-form row">
                {if $item.tipo_id != 7 and $item.tipo_id != 8 and $item.tipo_id != 10 }
                    <div class="col-lg-12 m-form__group-sub">
                        <label>Nro. de RUEX - Registro Único de Exportador {if $item.tipo_id == 8}(si coresponde){/if}:</label>
                        <div class="input-group">
                            <input type="text" class="form-control m-input numero_entero"
                                   placeholder="Ingrese el ruex" name="item[ruex]"
                                    {$privFace.input} value="{$item.ruex|escape:'html'}"
                                    {if $item.tipo_id != 8}required {/if} data-msg="Campo requerido" >
                            <div class="input-group-append">
                            <span class="input-group-text" id="basic-addon2">
                                <i class="la la-group"></i>
                            </span>
                            </div>
                        </div>
                    </div>
                {/if}
                <div class="col-lg-4 m-form__group-sub">
                    <label>País: </label>
                    <div class="m-input-icon m-input-icon--right">
                        <select class="form-control m-select2 select2_general"
                                name="item[pais_id]"  {$privFace.input} id="pais_id"
                                {if $item.tipo_id != 8} disabled="true" {/if}
                                required  data-msg="Campo requerido">
                            {if $item.tipo_id != 8}
                                <option value="26"> Bolivia, Estado Plurinacional de </option>
                            {else}
                                {html_options options=$cataobj.pais selected=$item.pais_id}
                            {/if}

                        </select>
                        <span class="m-form__help"></span>
                    </div>
                </div>

                <div class="col-lg-4 m-form__group-sub">
                    <label>Departamento: </label>
                    <div class="m-input-icon m-input-icon--right">
                        <select class="form-control m-select2 select2_general"
                                name="item[departamento_id]"  {$privFace.input} id="departamento_id"
                                required data-msg="Campo requerido" >
                            {*<option value="null">No Aplica</option>*}
                            <option value=""></option>
                            {html_options options=$cataobj.departamento selected=$item.departamento_id}
                        </select>
                        <span class="m-form__help"></span>
                    </div>

                    {if $item.tipo_id != 10}
                        <span class="m-form__help text-info">Opcional (si corresponde)</span>
                    {/if}
                </div>

                <div class="col-lg-4 m-form__group-sub">
                    <label>
                        {if $item.tipo_id == 4 or $item.tipo_id == 5 or $item.tipo_id == 6}
                            Ciudad (oficina central)
                        {elseif $item.tipo_id == 7}
                            Ciudad
                        {elseif $item.tipo_id == 10}
                            Municipio
                        {else}
                            Ciudad de residencia
                        {/if}
                    </label>
                    <div class="m-input-icon m-input-icon--right">
                        <input type="text" class="form-control m-input"
                               placeholder="Ingrese la ciudad" name="item[ciudad]"
                                {$privFace.input} value="{$item.ciudad|escape:'html'}"
                               required minlength="2"
                               data-msg="Campo requerido" >
                    </div>
                </div>
            </div>

            <div class="form-group m-form__group m-form row">
                <div class="col-lg-{if $item.tipo_id != 10}6{else}3{/if} m-form__group-sub">
                    <label>
                        {if $item.tipo_id == 4 or $item.tipo_id == 5 or $item.tipo_id == 6}
                            Número de teléfono de la empresa
                        {elseif $item.tipo_id == 7}
                            Número de teléfono
                        {else}
                            Número de celular
                        {/if}
                    </label>
                    <div class="input-group">
                        <input type="text" class="form-control m-input"
                               placeholder="Ingrese el número de teléfono" name="item[telefono]"
                                {$privFace.input} value="{$item.telefono|escape:'html'}"
                               data-msg="Campo requerido" required minlength="2">
                        <div class="input-group-append">
                            <span class="input-group-text" id="basic-addon2">
                                <i class="la la-phone"></i>
                            </span>
                        </div>
                    </div>
                </div>
                {if $item.tipo_id == 10}
                    <div class="col-lg-3 m-form__group-sub">
                        <label>
                            Número de teléfono fijo
                        </label>
                        <div class="input-group">
                            <input type="text" class="form-control m-input"
                                   placeholder="Ingrese el número" name="item[telefono_fijo]"
                                    {$privFace.input} value="{$item.telefono_fijo|escape:'html'}"
                                   data-msg="Campo requerido" required minlength="2">
                            <div class="input-group-append">
                                    <span class="input-group-text" id="basic-addon2">
                                        <i class="la la-at"></i>
                                    </span>
                            </div>
                        </div>
                    </div>
                {/if}

                <div class="col-lg-6 m-form__group-sub">
                    <label>
                        {if $item.tipo_id == 4 or $item.tipo_id == 5 or $item.tipo_id == 6}
                            Correo electronico de la empresa
                        {elseif $item.tipo_id == 7}
                            Correo electrónico
                        {else}
                            Correo electrónico
                        {/if}
                    </label>
                    <div class="input-group">
                        <input type="text" class="form-control m-input"
                               placeholder="Ingrese el correo electrónico" name="item[email]"
                                {$privFace.input} value="{$item.email|escape:'html'}"
                               data-msg="Campo requerido" required minlength="2">
                        <div class="input-group-append">
                                <span class="input-group-text" id="basic-addon2">
                                    <i class="la la-at"></i>
                                </span>
                        </div>
                    </div>
                </div>


                <div class="col-lg-12 m-form__group-sub">
                    <label>
                        {if $item.tipo_id == 4 or $item.tipo_id == 5 or $item.tipo_id == 6}
                            Direccción de la empresa
                        {elseif $item.tipo_id == 7}
                            Direccción
                        {else}
                            Direccción
                        {/if}
                    </label>
                    <div class="input-group">
                        <input type="text" class="form-control m-input"
                               placeholder="Ingrese la dirección" name="item[direccion]"
                                {$privFace.input} value="{$item.direccion|escape:'html'}"
                               data-msg="Campo requerido" required minlength="2">
                        <div class="input-group-append">
                            <span class="input-group-text" id="basic-addon2">
                                <i class="la la-map-marker"></i>
                            </span>
                        </div>

                    </div>
                </div>
                <span class="m-form__help text-info">Formato de llenado: Ciudad, zona, calle, nro. de vivienda, piso, nro. departamento.</span>
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


            {*if $item.estado_id == 3 and $item.observacion!="" and $item.observado==1*}
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



        </div>

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

    </form>
    <!--end::Form-->
</div>
<!--end::Portlet-->
{include file="index.js.tpl"}
{include file="index.css.tpl"}