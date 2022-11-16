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
                <div class="col-lg-3">
                    <label>{#field_vigente#}:</label>
                    <div class="input-group">
                    <span class="switch switch-icon">
                        <label><input type="checkbox" {if $item.vigente == 1}checked="checked"{/if} name="item[vigente]" value="1" ><span></span></label>
                    </span>
                    </div>
                    <span class="form-text text-black-50">{#field_msg_vigente#}</span>
                </div>
                <div class="col-lg-3">
                    <label>{#field_red_id#} <span class="text-danger bold">*</span> : </label>
                    <div class="input-group">
                        <select class="form-control m-select2 select2_general"
                                name="item[red_id]" id="type_select_estado"
                                data-placeholder="{#field_Holder_red_id#}" {$privFace.input}
                                required
                                data-fv-not-empty___message="{#glFieldRequired#}"
                        >
                            <option></option>
                            {html_options options=$cataobj.red selected=$item.red_id}
                        </select>
                    </div>
                    <span class="form-text text-black-50">{#field_GroupMsg_red_id#}</span>
                </div>
                <div class="col-lg-6">
                    <label>{#field_nro_registro#}:</label>
                    <div class="input-group">
                        <input type="text" class="form-control number_integer2"
                               name="item[numero_registro]" value="{$item.numero_registro|escape:"html"}"
                        >
                        <div class="input-group-append"><span class="input-group-text field_info"><i class="fa fa-info"></i></span></div>
                    </div>
                    <span class="form-text text-muted">{#field_msg_nro_registro#}</span>
                </div>
                <div class="col-lg-9">
                    <label>{#field_nombre#} <span class="text-danger bold">*</span> : </label>
                    <div class="input-group">
                        <input type="text" class="form-control"
                               name="item[nombre]" value="{$item.nombre|escape:"html"}"
                               required
                               data-fv-not-empty___message="{#glFieldRequired#}"
                               minlength="3"
                               data-fv-string-length___message="{#field_length_nombre#}"
                        >
                        <div class="input-group-append"><span class="input-group-text field_info"><i class="fas flaticon-layer"></i></span></div>
                    </div>
                    <span class="form-text text-black-50">{#field_msg_nombre#}</span>
                </div>
                <div class="col-lg-3">
                    <label>{#field_nit#}:</label>
                    <div class="input-group">
                        <input type="text" class="form-control"
                               name="item[nit]" value="{$item.nit|escape:"html"}"
                               minlength="3"
                               data-fv-string-length___message="{#field_length_nit#}"
                        >
                        <div class="input-group-append"><span class="input-group-text field_key"><i class="fas fa-key"></i></span></div>
                    </div>
                    <span class="form-text text-black-50">{#field_msg_nit#}</span>
                </div>
                <div class="col-lg-12">
                    <label>{#field_representante_legal#}: </label>
                    <div class="input-group">
                        <input type="text" class="form-control"
                               name="item[representante_legal]" value="{$item.representante_legal|escape:"html"}"
                               minlength="3"
                               data-fv-string-length___message="{#field_length_representante_legal#}"
                        >
                        <div class="input-group-append"><span class="input-group-text field_info"><i class="la la-user"></i></span></div>
                    </div>
                    <span class="form-text text-black-50">{#field_msg_representante_legal#}</span>
                </div>
                <div class="col-lg-3">
                    <label>{#field_codigo_actividad#}  : </label>
                    <div class="input-group">
                        <select class="form-control m-select2 select2_general"
                                name="item[institucion_actividad][]" id="institucion_actividad"
                                multiple="multiple"
                                data-placeholder="{#field_holder_codigo_actividad#}" {$privFace.input}
                        >
                            <option></option>
                            {html_options options=$cataobj.actividad selected=$item.institucion_actividad}
                        </select>
                    </div>
                    <span class="form-text text-black-50">{#field_msg_codigo_actividad#}</span>
                </div>
                <div class="col-lg-9">
                    <label>{#field_actividad#}: </label>
                    <div class="input-group">
                        <input type="text" class="form-control"
                               name="item[actividad]" value="{$item.actividad|escape:"html"}"
                               minlength="3"
                               data-fv-string-length___message="{#field_length_actividad#}"
                        >
                        <div class="input-group-append"><span class="input-group-text field_info"><i class="fas fa-calendar-check"></i></span></div>
                    </div>
                    <span class="form-text text-black-50">{#field_msg_actividad#}</span>
                </div>
                <div class="col-lg-3">
                    <label>{#field_departamento_id#}: </label>
                    <div class="input-group">
                        <select class="form-control m-select2 select2_general"
                                name="item[departamento_id]" id="type_select_estado"
                                data-placeholder="{#field_Holder_departamento_id#}" {$privFace.input}
                        >
                            <option></option>
                            {html_options options=$cataobj.departamento selected=$item.departamento_id}
                        </select>
                    </div>
                    <span class="form-text text-black-50">{#field_GroupMsg_departamento_id#}</span>
                </div>
                <div class="col-lg-9">
                    <label>{#field_direccion#}: </label>
                    <div class="input-group">
                        <input type="text" class="form-control"
                               name="item[direccion]" value="{$item.direccion|escape:"html"}"
                               minlength="3"
                               data-fv-string-length___message="{#field_length_direccion#}"
                        >
                        <div class="input-group-append"><span class="input-group-text field_info"><i class="la la-map-marker"></i></span></div>
                    </div>
                    <span class="form-text text-black-50">{#field_msg_direccion#}</span>
                </div>
                <div class="col-lg-6">
                    <label>{#field_telefono#}: </label>
                    <div class="input-group">
                        <input type="text" class="form-control"
                               name="item[telefono]" value="{$item.telefono|escape:"html"}"
                               minlength="3"
                               data-fv-string-length___message="{#field_length_telefono#}"
                        >
                        <div class="input-group-append"><span class="input-group-text field_info"><i class="la la-phone"></i></span></div>
                    </div>
                    <span class="form-text text-black-50">{#field_msg_telefono#}</span>
                </div>
                <div class="col-lg-6">
                    <label>{#field_email#}: </label>
                    <div class="input-group">
                        <input type="text" class="form-control"
                               name="item[email]" value="{$item.email|escape:"html"}"
                               minlength="3"
                               data-fv-string-length___message="{#field_length_email#}"
                        >
                        <div class="input-group-append"><span class="input-group-text field_info">@</i></span></div>
                    </div>
                    <span class="form-text text-black-50">{#field_msg_email#}</span>
                </div>
                <div class="col-lg-6">
                    <label>{#field_fecha_inscripcion#}:</label>
                    <div class="input-group">
                        <input type="text" class="form-control date_general" id="fecha_expiracion"
                               name="item[fecha_inscripcion]" value="{$item.fecha_inscripcion|date_format:'%d/%m/%Y'}"
                               data-fv-not-empty___message="{#glFieldRequired#}" disabled
                        >
                        <div class="input-group-append"><span class="input-group-text calendar"><i class="flaticon-event-calendar-symbol "></i></span></div>
                    </div>
                    {*<span class="form-text text-black-50">{#field_msg_fecha_conclusion_enmienda#}</span>*}
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
                <div class="col-lg-12 pt-3 pb-0">
                    <label>{#field_comentario#} </label>
                    <div class="m-input-icon m-input-icon--right">
                        <div class="summernote" id="comentario">{$item.comentario}</div>
                        <input class="form-control m-input" type="hidden" name="item[comentario]" id="comentario_input" {$privFace.input}>
                    </div>
                </div>
                <div class="col-lg-12 pt-3 pb-0">
                    <label>{#field_comentario_observacion#} </label>
                    <div class="m-input-icon m-input-icon--right">
                        <div class="summernote" id="comentario_observaciones">{$item.comentario_observaciones}</div>
                        <input class="form-control m-input" type="hidden" name="item[comentario_observaciones]" id="comentario_observacion_input" {$privFace.input}>
                    </div>
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