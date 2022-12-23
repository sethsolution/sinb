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
                <div class="col-lg-12">
                    <label>{#field_institucion_id#} <span class="text-danger bold">*</span> : </label>
                    <div class="input-group">
                        <select class="form-control m-select2 select2_general"
                                name="item[institucion_id]" id="type_select_estado"
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
                <div class="col-lg-8">
                    <label>{#field_nombre#} <span class="text-danger bold">*</span> :</label>
                    <input type="text" class="form-control"
                           name="item[nombre]"
                           value="{$item.nombre|escape:"html"}"
                           placeholder=""
                           required
                           data-fv-not-empty___message="{#glFieldRequired#}"
                           minlength="3"
                           data-fv-string-length___message="{#field_length_nombre#}"
                    >
                    <span class="form-text text-black-50">{#field_msg_nombre#}</span>
                </div>
                <div class="col-lg-4">
                    <label>{#field_tipo_id#} <span class="text-danger bold">*</span> : </label>
                    <div class="input-group">
                        <select class="form-control m-select2 select2_general"
                                name="item[tipo_id]" id="type_select_estado"
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
            </div>
            <div class="form-group row">
                <div class="col-lg-6">
                    <label>{#field_direccion#} <span class="text-danger bold">*</span> :</label>
                    <input type="text" class="form-control"
                           name="item[direccion]"
                           value="{$item.direccion|escape:"html"}"
                           placeholder=""
                           required
                           data-fv-not-empty___message="{#glFieldRequired#}"
                           minlength="3"
                           data-fv-string-length___message="{#field_length_direccion#}"
                    >
                    <span class="form-text text-black-50">{#field_msg_direccion#}</span>
                </div>
                <div class="col-lg-6">
                    <label>{#field_email#}:</label>
                    <input type="text" class="form-control"
                           name="item[email]"
                           value="{$item.email|escape:"html"}"
                           placeholder=""
                           minlength="3"
                           data-fv-string-length___message="{#field_length_email#}"
                    >
                    <span class="form-text text-black-50">{#field_msg_email#}</span>
                </div>
            </div>
            <div class="form-group row">
                <div class="col-lg-4">
                    <label>{#field_celular#}:</label>
                    <input type="text" class="form-control"
                           name="item[celular]"
                           value="{$item.celular|escape:"html"}"
                           placeholder=""
                           minlength="3"
                           data-fv-string-length___message="{#field_length_celular#}"
                    >
                    <span class="form-text text-black-50">{#field_msg_celular#}</span>
                </div>
                <div class="col-lg-4">
                    <label>{#field_telefono#}:</label>
                    <input type="text" class="form-control"
                           name="item[telefono]"
                           value="{$item.telefono|escape:"html"}"
                           placeholder=""
                           minlength="3"
                           data-fv-string-length___message="{#field_length_telefono#}"
                    >
                    <span class="form-text text-black-50">{#field_msg_telefono#}</span>
                </div>
                <div class="col-lg-4">
                    <label>{#field_fax#}:</label>
                    <input type="text" class="form-control"
                           name="item[fax]"
                           value="{$item.fax|escape:"html"}"
                           placeholder=""
                           minlength="3"
                           data-fv-string-length___message="{#field_length_fax#}"
                    >
                    <span class="form-text text-black-50">{#field_msg_fax#}</span>
                </div>
            </div>

            <div class="form-group row">
                <div class="col-lg-6">
                    <label>{#field_responsable#}<span class="text-danger bold">*</span> :</label>
                    <input type="text" class="form-control"
                           name="item[responsable]"
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

{*            <div class="form-group row">*}
{*                <div class="col-lg-12">*}
{*                    <label>{#field_file#} </label>*}
{*                    <div class="custom-file">*}
{*                        <input type="file" class="form-control custom-file-input"*}
{*                               placeholder="{#field_holder_file#}"*}
{*                               name="input_file" id="input_file"*}
{*                               *}{*accept="application/pdf,image/jpeg"*}
{*                                {if $type == 'new'}required{/if}*}
{*                               data-fv-not-empty___message="{#glFieldRequired#}"*}

{*                        >*}
{*                        <label class="custom-file-label file-name" id="input_file_name" for="input_file"></label>*}
{*                    </div>*}

{*                        <span class="form-text text-black-50">{#field_msg_file#}</span>*}

{*                    {if $item.attached_name != ""}*}
{*                        {if $type == 'update'}*}
{*                            <strong>Archivo:</strong> <span class="m--font-success">{$item.attached_name}</span>*}
{*                        {/if}*}
{*                    {/if}*}
{*                    </span>*}
{*                </div>*}

{*            </div>*}
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
