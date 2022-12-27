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

        <div class="card-body  pt-1 pb-0">
            <div class="form-group row">
                <div class="col-lg-8">
                    <label>{#field_nombre#} <span class="text-danger bold">*</span> : </label>
                    <div class="input-group">
                        <input type="text" class="form-control"
                               name="item[nombre]" value="{$item.nombre|escape:"html"}"
                               required
                               data-fv-not-empty___message="{#glFieldRequired#}"
                               minlength="3"
                               data-fv-string-length___message="{#field_length_nombre#}"
                        >
                        <div class="input-group-append"><span class="input-group-text field_info"><i class="fas fa-user"></i></span></div>
                    </div>
                    <span class="form-text text-black-50">{#field_msg_nombre#}</span>
                </div>
                <div class="col-lg-4">
                    <label>{#field_codigo#} <span class="text-danger bold">*</span> : </label>
                    <div class="input-group">
                        <input type="text" class="form-control"
                               name="item[codigo]" value="{$item.codigo|escape:"html"}"
                               required
                               data-fv-not-empty___message="{#glFieldRequired#}"
                               minlength="3"
                               data-fv-string-length___message="{#field_length_codigo#}"
                        >
                        <div class="input-group-append"><span class="input-group-text field_info"><i class="fas fa-code"></i></span></div>
                    </div>
                    <span class="form-text text-black-50">{#field_msg_codigo#}</span>
                </div>
                <div class="col-lg-4">
                    <label>{#field_categoria_id#} <span class="text-danger bold">*</span> : </label>
                    <div class="input-group">
                        <select class="form-control m-select2 select2_general"
                                name="item[categoria_id]" id="categoria_id"
                                data-placeholder="{#field_Holder_categoria_id#}" {$privFace.input}
                                required
                                data-fv-not-empty___message="{#glFieldRequired#}"
                        >
                            <option></option>
                            {html_options options=$cataobj.ccfs_categoria selected=$item.categoria_id}
                        </select>
                    </div>
                    <span class="form-text text-black-50">{#field_GroupMsg_categoria_id#}</span>
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
                    <label>{#field_municipio_id#} <span class="text-danger bold">*</span> : </label>
                    <div class="input-group">
                        <select class="form-control m-select2 select2_general"
                                name="item[municipio_id]" id="municipio_id"
                                data-placeholder="{#field_Holder_municipio_id#}" {$privFace.input}
                                required
                                data-fv-not-empty___message="{#glFieldRequired#}"
                        >
                            <option></option>
                            {*                            {if $type=="update"}*}
                            {html_options options=$cataobj.municipio selected=$item.municipio_id}
                            {*                            {/if}*}
                        </select>
                    </div>
                    <span class="form-text text-black-50">{#field_GroupMsg_municipio_id#}</span>
                </div>
                <div class="col-lg-3">
                    <label>{#field_condicion#} <span class="text-danger bold">*</span> : </label>
                    <div class="input-group">
                        <input type="text" class="form-control"
                               name="item[condicion]" value="{$item.condicion|escape:"html"}"
                               required
                               data-fv-not-empty___message="{#glFieldRequired#}"
                               minlength="3"
                               data-fv-string-length___message="{#field_length_condicion#}"
                        >
                        <div class="input-group-append"><span class="input-group-text field_info"><i class="fas fa-question"></i></span></div>
                    </div>
                    <span class="form-text text-black-50">{#field_msg_condicion#}</span>
                </div>
                <div class="col-lg-3">
                    <label>{#field_licencia_funcionamiento#} <span class="text-danger bold">*</span> : </label>
                    <div class="input-group">
                        <input type="text" class="form-control"
                               name="item[licencia_funcionamiento]" value="{$item.licencia_funcionamiento|escape:"html"}"
                               required
                               data-fv-not-empty___message="{#glFieldRequired#}"
                               minlength="3"
                               data-fv-string-length___message="{#field_length_licencia_funcionamiento#}"
                        >
                        <div class="input-group-append"><span class="input-group-text field_info"><i class="fas fa-address-card"></i></span></div>
                    </div>
                    <span class="form-text text-black-50">{#field_msg_licencia_funcionamiento#}</span>
                </div>
                <div class="col-lg-3">
                    <label>{#field_formato#} <span class="text-danger bold">*</span> : </label>
                    <div class="input-group">
                        <input type="text" class="form-control"
                               name="item[formato]" value="{$item.formato|escape:"html"}"
                               required
                               data-fv-not-empty___message="{#glFieldRequired#}"
                               minlength="3"
                               data-fv-string-length___message="{#field_length_formato#}"
                        >
                        <div class="input-group-append"><span class="input-group-text field_info"><i class="fas fa-ruler"></i></span></div>
                    </div>
                    <span class="form-text text-black-50">{#field_msg_formato#}</span>
                </div>
                <div class="col-lg-3">
                    <label>{#field_superficie#} <span class="text-danger bold">*</span> : </label>
                    <div class="input-group">
                        <input type="text" class="form-control number_integer"
                               name="item[superficie]" value="{$item.superficie|escape:"html"}"
                               required
                               data-fv-not-empty___message="{#glFieldRequired#}"
                               minlength="3"
                               data-fv-string-length___message="{#field_length_superficie#}"
                        >
                        <div class="input-group-append"><span class="input-group-text field_info"><i class="fas fa-mountain"></i></span></div>
                    </div>
                    <span class="form-text text-black-50">{#field_msg_superficie#}</span>
                </div>
                <div class="col-lg-8">
                    <label>{#field_responsable#} <span class="text-danger bold">*</span> : </label>
                    <div class="input-group">
                        <input type="text" class="form-control"
                               name="item[responsable]" value="{$item.responsable|escape:"html"}"
                               required
                               data-fv-not-empty___message="{#glFieldRequired#}"
                               minlength="3"
                               data-fv-string-length___message="{#field_length_responsable#}"
                        >
                        <div class="input-group-append"><span class="input-group-text field_info"><i class="fas fa-user"></i></span></div>
                    </div>
                    <span class="form-text text-black-50">{#field_msg_responsable#}</span>
                </div>
                <div class="col-lg-2">
                    <label>{#field_fecha_emision#}<span class="text-danger bold">*</span> :</label>
                    <div class="input-group">
                        <input type="text" class="form-control date_general"
                               name="item[fecha_emision]" id="fecha_emision"
                               value="{$item.fecha_emision|date_format:'%d/%m/%Y'}"
                               required
                               data-fv-not-empty___message="{#glFieldRequired#}"
                        >
                        <div class="input-group-append"><span class="input-group-text calendar"><i class="flaticon-event-calendar-symbol"></i></span></div>
                    </div>
                    <span class="form-text text-black-50">{#field_msg_fecha_emision#}</span>
                </div>
                <div class="col-lg-2">
                    <label>{#field_fecha_conclusion#}<span class="text-danger bold">*</span> :</label>
                    <div class="input-group">
                        <input type="text" class="form-control date_general"
                               name="item[fecha_conclusion]" id="fecha_conclusion"
                               value="{$item.fecha_conclusion|date_format:'%d/%m/%Y'}"
                               required
                               data-fv-not-empty___message="{#glFieldRequired#}"
                        >
                        <div class="input-group-append"><span class="input-group-text calendar"><i class="flaticon-event-calendar-symbol"></i></span></div>
                    </div>
                    <span class="form-text text-black-50">{#field_msg_fecha_conclusion#}</span>
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