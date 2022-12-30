{include file="index.css.tpl"}
<div class="card card-custom gutter-b example example-compact">
    <div class="card-body pt-0 pb-0 pl-5 pr-5">
        <div class="alert alert-custom fade show pt-1 pb-1 pl-5 pr-5 ayuda" role="alert">
            <div class="alert-icon"><i class="flaticon-notes"></i></div>
            <div class="alert-text text-justify text-dark-65" >{#message#}</div>
        </div>
    </div>

    <div class="card-header py-3">
        <div class="card-title">
            <span class="card-icon"><i class="flaticon2-next text-dark-25"></i></span>
            <h3 class="card-label text-dark-50">{#title#}</h3>
        </div>
    </div>
    <!--begin::Form-->
    <form method="POST"
          action="{$path_url}/{$subcontrol}_/{if $type=="update"}{$id}/{/if}save/"
          id="general_form">

        <div class="card-body">
            <div class="form-group row">
{*                <div class="col-lg-12">*}
{*                    <label>{#field_vigente#}:</label>*}
{*                    <div class="input-group">*}
{*                    <span class="switch switch-icon">*}
{*                        <label><input type="checkbox" {if $item.vigente == 1}checked="checked"{/if} name="item[vigente]" value="1" ><span></span></label>*}
{*                    </span>*}
{*                    </div>*}
{*                    <span class="form-text text-black-50">{#field_msg_vigente#}</span>*}
{*                </div>*}

                <div class="col-lg-6">
                    <label>{#field_nombre#}  <span class="text-danger bold">*</span> :</label>
                    <div class="input-group">
                        <input type="text" class="form-control"
                               name="item[nombre]" value="{$item.nombre|escape:"html"}"
                               required
                               data-fv-not-empty___message="{#glFieldRequired#}"
                               minlength="3"
                               data-fv-string-length___message="{#field_length_nombre#}"
                        >
                        <div class="input-group-append"><span class="input-group-text field_info"><i class="fas fa-info"></i></span></div>
                    </div>
                    <span class="form-text text-black-50">{#field_msg_nombre#}</span>
                </div>

                <div class="col-lg-6">
                    <label>{#field_direccion#}  <span class="text-danger bold">*</span> :</label>
                    <div class="input-group">
                        <input type="text" class="form-control"
                               name="item[direccion]" value="{$item.direccion|escape:"html"}"
                               required
                               data-fv-not-empty___message="{#glFieldRequired#}"
                               minlength="3"
                               data-fv-string-length___message="{#field_length_direccion#}"
                        >
                        <div class="input-group-append"><span class="input-group-text field_info"><i class="fas fa-info"></i></span></div>
                    </div>
                    <span class="form-text text-black-50">{#field_msg_direccion#}</span>
                </div>

                <div class="col-lg-4">
                    <label>{#field_telefono#}:</label>
                    <div class="input-group">
                        <input type="text" class="form-control"
                               name="item[telefono]" value="{$item.telefono|escape:"html"}"
{*                               required*}
{*                               data-fv-not-empty___message="{#glFieldRequired#}"*}
                               minlength="3"
                               data-fv-string-length___message="{#field_length_telefono#}"
                        >
                        <div class="input-group-append"><span class="input-group-text field_info"><i class="fas fa-calendar-check"></i></span></div>
                    </div>
                    <span class="form-text text-black-50">{#field_msg_telefono#}</span>
                </div>
                <div class="col-lg-4">
                    <label>{#field_fax#}:</label>
                    <div class="input-group">
                        <input type="text" class="form-control"
                               name="item[fax]" value="{$item.fax|escape:"html"}"
{*                               required*}
{*                               data-fv-not-empty___message="{#glFieldRequired#}"*}
                               minlength="3"
                               data-fv-string-length___message="{#field_length_fax#}"
                        >
                        <div class="input-group-append"><span class="input-group-text field_info"><i class="fas fa-info"></i></span></div>
                    </div>
                    <span class="form-text text-black-50">{#field_msg_fax#}</span>
                </div>
                <div class="col-lg-4">
                    <label>{#field_celular#}:</label>
                    <div class="input-group">
                        <input type="text" class="form-control"
                               name="item[celular]" value="{$item.celular|escape:"html"}"
{*                               required*}
{*                               data-fv-not-empty___message="{#glFieldRequired#}"*}
                               minlength="3"
                               data-fv-string-length___message="{#field_length_celular#}"
                        >
                        <div class="input-group-append"><span class="input-group-text field_info"><i class="fas fa-calendar-check"></i></span></div>
                    </div>
                    <span class="form-text text-black-50">{#field_msg_celular#}</span>
                </div>

                <div class="col-lg-6">
                    <label>{#field_email#}:</label>
                    <div class="input-group">
                        <input type="text" class="form-control"
                               name="item[email]" value="{$item.email|escape:"html"}"
{*                               required*}
{*                               data-fv-not-empty___message="{#glFieldRequired#}"*}
                               minlength="3"
                               data-fv-string-length___message="{#field_length_email#}"
                        >
                        <div class="input-group-append"><span class="input-group-text field_info"><i class="fas fa-calendar-check"></i></span></div>
                    </div>
                    <span class="form-text text-black-50">{#field_msg_email#}</span>
                </div>
                <div class="col-lg-6">
                    <label>{#field_web#}:</label>
                    <div class="input-group">
                        <input type="text" class="form-control"
                               name="item[web]" value="{$item.web|escape:"html"}"
{*                               required*}
{*                               data-fv-not-empty___message="{#glFieldRequired#}"*}
                               minlength="3"
                               data-fv-string-length___message="{#field_length_web#}"
                        >
                        <div class="input-group-append"><span class="input-group-text field_info"><i class="fas fa-calendar-check"></i></span></div>
                    </div>
                    <span class="form-text text-black-50">{#field_msg_web#}</span>
                </div>

                <div class="col-lg-4">
                    <label>{#field_pais_id#} <span class="text-danger bold">*</span> : </label>
                    <div class="input-group">
                        <select class="form-control m-select2 select2_general"
                                name="item[pais_id]" id="type_select_estado"
                                data-placeholder="{#field_Holder_pais_id#}" {$privFace.input}
                                required
                                data-fv-not-empty___message="{#glFieldRequired#}"
                        >
                            <option></option>
                            {html_options options=$cataobj.pais selected=$item.pais_id}
                        </select>
                    </div>
                    <span class="form-text text-black-50">{#field_GroupMsg_pais_id#}</span>
                </div>
                <div class="col-lg-4">
                    <label>{#field_departamento_id#} <span class="text-danger bold">*</span> : </label>
                    <div class="input-group">
                        <select class="form-control m-select2 select2_general"
                                name="item[departamento_id]" id="departamento_id"
                                data-placeholder="{#field_Holder_departamento_id#}" {$privFace.input}
                                required
                                data-fv-not-empty___message="{#glFieldRequired#}"
                        >
                            <option></option>
                            {html_options options=$cataobj.departamento selected=$item.departamento_id}
                        </select>
                    </div>
                    <span class="form-text text-black-50">{#field_GroupMsg_departamento_id#}</span>
                </div>
                <div class="col-lg-4">
                    <label>{#field_ciudad#}:</label>
                    <div class="input-group">
                        <input type="text" class="form-control"
                               name="item[ciudad]" value="{$item.ciudad|escape:"html"}"
{*                               required*}
{*                               data-fv-not-empty___message="{#glFieldRequired#}"*}
                               minlength="3"
                               data-fv-string-length___message="{#field_length_ciudad#}"
                        >
                        <div class="input-group-append"><span class="input-group-text"><i class="fas fa-calendar-check"></i></span></div>
                    </div>
                    <span class="form-text text-primary">{#field_msg_ciudad#}</span>
                </div>
                <div class="col-lg-6">
                    <label>{#field_responsable#}:</label>
                    <div class="input-group">
                        <input type="text" class="form-control"
                               name="item[responsable]" value="{$item.responsable|escape:"html"}"
{*                               required*}
{*                               data-fv-not-empty___message="{#glFieldRequired#}"*}
                               minlength="3"
                               data-fv-string-length___message="{#field_length_responsable#}"
                        >
                        <div class="input-group-append"><span class="input-group-text field_info"><i class="fas fa-calendar-check"></i></span></div>
                    </div>
                    <span class="form-text text-black-50">{#field_msg_responsable#}</span>
                </div>
                <div class="col-lg-6">
                    <label>{#field_responsable_operativo#}:</label>
                    <div class="input-group">
                        <input type="text" class="form-control"
                               name="item[responsable_operativo]" value="{$item.responsable_operativo|escape:"html"}"
{*                               required*}
{*                               data-fv-not-empty___message="{#glFieldRequired#}"*}
                               minlength="3"
                               data-fv-string-length___message="{#field_length_responsable_operativo#}"
                        >
                        <div class="input-group-append"><span class="input-group-text field_info"><i class="fas fa-calendar-check"></i></span></div>
                    </div>
                    <span class="form-text text-black-50">{#field_msg_responsable_operativo#}</span>
                </div>
                <div class="col-lg-6">
                    <label>{#field_fecha_acreditacion#}:</label>
                    <div class="input-group">
                        <input type="text" class="form-control date_general" id="fecha_acreditacion"
                               name="item[fecha_acreditacion]" value="{$item.fecha_acreditacion|date_format:'%d/%m/%Y'}"
                               data-fv-not-empty___message="{#glFieldRequired#}" disabled
                        >
                        <div class="input-group-append"><span class="input-group-text calendar"><i class="flaticon-event-calendar-symbol "></i></span></div>
                    </div>
                    {*<span class="form-text text-black-50">{#field_ms  g_fecha_conclusion_enmienda#}</span>*}
                </div>
                <div class="col-lg-6">
                    <label>{#field_fecha_expiracion#}:</label>
                    <div class="input-group">
                        <input type="text" class="form-control date_general" id="fecha_expiracion"
                               name="item[fecha_expiracion]" value="{$item.fecha_expiracion|date_format:'%d/%m/%Y'}"
                               data-fv-not-empty___message="{#glFieldRequired#}" disabled
                        >
                        <div class="input-group-append"><span class="input-group-text calendar"><i class="flaticon-event-calendar-symbol "></i></span></div>
                    </div>
                    {*<span class="form-text text-black-50">{#field_msg_fecha_conclusion_enmienda#}</span>*}
                </div>
            </div>
        </div>


        <div class="card-footer">
            {if $privFace.edit == 1}
                <button type="reset" class="btn btn-primary mr-2" id="general_submit">
                    <i class="la la-save"></i>
                    {#glBtnSaveChanges#}</button>
            {/if}
            <a href="{$path_url}" class="btn btn-light-primary ">
                <i class="la la-angle-double-left"></i>{if $type =="new"} {#glBtnCancel#} {else} {#glBtnBackToList#}{/if}
            </a>
        </div>

    </form>
    <!--end::Form-->
</div>

{include file="index.js.tpl"}