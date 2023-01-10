{include file="form/form.css.tpl"}
<form method="POST"
      action="{$path_url}/{$subcontrol}_/{$item_id}/{if $type=="update"}{$id}/{/if}save/"
      id="form_{$subcontrol}">
    {if $item.id != "" or $type == 'new'}
        <div class="modal-body">
            <div class="alert alert-primary" role="alert">
                {if $type == 'new'}{#glnew#}{else}{#glupdate#}{/if} - {#title#}
            </div>

            <div class="form-group row">
                <div class="col-lg-3">
                    <label>{#field_tipo_id#} <span class="text-danger bold">*</span> : </label>
                    <div class="input-group">
                        <select class="form-control m-select2 select2_general"
                                name="item[tipo_id]" id="tipo_id"
                                data-placeholder="{#field_Holder_tipo_id#}" {$privFace.input}
                                required
                                data-fv-not-empty___message="{#glFieldRequired#}"
                        >
                            <option></option>
                            {html_options options=$cataobj.icas_institucion_tipo selected=$item.tipo_id}
                        </select>
                    </div>
                    <span class="form-text text-black-50">{#field_GroupMsg_tipo_id#}</span>
                </div>
                <div class="col-lg-9">
                    <label>{#field_institucion_id#} <span class="text-danger bold">*</span> : </label>
                    <div class="input-group">
                        <select class="form-control m-select2 select2_general"
                                name="item[institucion_id]" id="institucion_id"
                                data-placeholder="{#field_Holder_institucion_id#}" {$privFace.input}
                                required
                                data-fv-not-empty___message="{#glFieldRequired#}"
                        >
                            <option></option>
                            {html_options options=$cataobj.institucion selected=$item.institucion_id}
                        </select>
                    </div>
                    <span class="form-text text-black-50">{#field_GroupMsg_institucion_id#}</span>
                </div>
            </div>
            <div class="form-group row">
                <div class="col-lg-12" id="nombre_s">
                    <label>{#field_nombre#} <span class="text-danger bold">*</span> :</label>
                    <input type="text" class="form-control"
                           name="item[nombre]"
                           id="nombre"
                           value="{$item.nombre|escape:"html"}"
                           placeholder=""
                           required
                           data-fv-not-empty___message="{#glFieldRequired#}"
                           minlength="3"
                           data-fv-string-length___message="{#field_length_nombre#}"
                    >
                    <span class="form-text text-black-50">{#field_msg_nombre#}</span>
                </div>
            </div>
            <div class="form-group row">
                <div class="col-lg-6" id="direccion_s">
                    <label>{#field_direccion#} <span class="text-danger bold">*</span> :</label>
                    <input type="text" class="form-control"
                           name="item[direccion]"
                           id="direccion"
                           value="{$item.direccion|escape:"html"}"
                           placeholder=""
                           required
                           data-fv-not-empty___message="{#glFieldRequired#}"
                           minlength="3"
                           data-fv-string-length___message="{#field_length_direccion#}"
                    >
                    <span class="form-text text-black-50">{#field_msg_direccion#}</span>
                </div>
                <div class="col-lg-6" id="email_s">
                    <label>{#field_email#}:</label>
                    <input type="text" class="form-control"
                           name="item[email]"
                           id="email"
                           value="{$item.email|escape:"html"}"
                           placeholder=""
                           minlength="3"
                           data-fv-string-length___message="{#field_length_email#}"
                    >
                    <span class="form-text text-black-50">{#field_msg_email#}</span>
                </div>
            </div>
            <div class="form-group row">
                <div class="col-lg-4" id="celular_s">
                    <label>{#field_celular#}:</label>
                    <input type="text" class="form-control"
                           name="item[celular]"
                           id="celular"
                           value="{$item.celular|escape:"html"}"
                           placeholder=""
                           minlength="3"
                           data-fv-string-length___message="{#field_length_celular#}"
                    >
                    <span class="form-text text-black-50">{#field_msg_celular#}</span>
                </div>
                <div class="col-lg-4" id="telefono_s">
                    <label>{#field_telefono#}:</label>
                    <input type="text" class="form-control"
                           name="item[telefono]"
                           id="telefono"
                           value="{$item.telefono|escape:"html"}"
                           placeholder=""
                           minlength="3"
                           data-fv-string-length___message="{#field_length_telefono#}"
                    >
                    <span class="form-text text-black-50">{#field_msg_telefono#}</span>
                </div>
                <div class="col-lg-4" id="fax_s">
                    <label>{#field_fax#}:</label>
                    <input type="text" class="form-control"
                           name="item[fax]"
                           id="fax"
                           value="{$item.fax|escape:"html"}"
                           placeholder=""
                           minlength="3"
                           data-fv-string-length___message="{#field_length_fax#}"
                    >
                    <span class="form-text text-black-50">{#field_msg_fax#}</span>
                </div>
            </div>

            <div class="form-group row">
                <div class="col-lg-6" id="responsable_s">
                    <label>{#field_responsable#}<span class="text-danger bold">*</span> :</label>
                    <input type="text" class="form-control"
                           name="item[responsable]"
                           id="responsable"
                           value="{$item.responsable|escape:"html"}"
                           placeholder=""
                           required
                           data-fv-not-empty___message="{#glFieldRequired#}"
                           minlength="3"
                           data-fv-string-length___message="{#field_length_responsable#}"
                    >
                    <span class="form-text text-black-50">{#field_msg_responsable#}</span>
                </div>
                <div class="col-lg-6">
                    <label>{#field_responsable_operativo#} <span class="text-danger bold">*</span> :</label>
                    <input type="text" class="form-control"
                           name="item[responsable_operativo]"
                           value="{$item.responsable_operativo|escape:"html"}"
                           placeholder=""
                           required
                           data-fv-not-empty___message="{#glFieldRequired#}"
                           minlength="3"
                           data-fv-string-length___message="{#field_length_responsable_operativo#}"
                    >
                    <span class="form-text text-black-50">{#field_msg_responsable_operativo#}</span>
                </div>
            </div>
        </div>

        <div class="modal-footer">
            <button type="button" class="btn btn-light-primary" id="form_close_{$subcontrol}" data-dismiss="modal"><i class="la la-angle-double-left"></i>{#glBtnCloce#}</button>
            <button type="button" class="btn btn-primary font-weight-bold" id="form_submit_{$subcontrol}"><i class="la la-save"></i>{#glBtnSave#}</button>
        </div>

    {else}
        <div class="modal-body">
            No existe el registro
        </div>

        <div class="modal-footer">
            <button type="button" class="btn btn-light-primary" id="form_close_{$subcontrol}" data-dismiss="modal"><i class="la la-angle-double-left"></i>Cerrar</button>
        </div>
    {/if}

</form>

{include file="form/form.js.tpl"}
