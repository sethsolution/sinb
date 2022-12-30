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
                <div class="col-lg-6">
                    <label>{#field_departamento_id#} <span class="text-danger bold">*</span> : </label>
                    <div class="input-group">
                        <select class="form-control m-select2 select2_general"
                                name="item[departamento_id]" id="departamento_id"
                                data-placeholder="{#field_holder_departamento_id#}" {$privFace.input}
                                required
                                data-fv-not-empty___message="{#glFieldRequired#}"
                        >
                            <option></option>
                            {html_options options=$cataobj.departamento selected=$item.departamento_id}
                        </select>
                    </div>
                    <span class="form-text text-black-50">{#field_msg_departamento_id#}</span>
                </div>

                <div class="col-lg-6">
                    <label>{#field_municipio_id#} <span class="text-danger bold">*</span> : </label>
                    <div class="input-group">
                        <select class="form-control m-select2 select2_general"
                                name="item[municipio_id]" id="municipio_id"
                                data-placeholder="{#field_holder_municipio_id#}" {$privFace.input}
                                required
                                data-fv-not-empty___message="{#glFieldRequired#}"
                        >
                            <option></option>
                            {if $type=="update"}
                            {html_options options=$cataobj.municipio selected=$item.municipio_id}
                            {/if}
                        </select>
                    </div>
                    <span class="form-text text-black-50">{#field_msg_municipio_id#}</span>
                </div>
                <div class="col-lg-12">
                    <label>{#field_localidad#}  :</label>
                    <div class="input-group">
                        <input type="text" class="form-control" name="item[localidad]"
                               value="{$item.localidad|escape:"html"}" placeholder=""
                               data-fv-not-empty___message="{#glFieldRequired#}"
                               minlength="3"
                               data-fv-string-length___message="{#field_length_localidad#}"
                        >
                        <div class="input-group-append"><span class="input-group-text field_info"><i class="fas fa-map-marker-alt"></i></span></div>
                    </div>
                    <span class="form-text text-black-50">{#field_msg_localidad#}</span>
                </div>
                <div class="col-lg-12">
                    <label>{#field_area_aproximada#}  :</label>
                    <div class="input-group">
                        <input type="text" class="form-control" name="item[area_aproximada]"
                               value="{$item.area_aproximada|escape:"html"}" placeholder=""
                               data-fv-not-empty___message="{#glFieldRequired#}"
                               minlength="3"
                               data-fv-string-length___message="{#field_length_area_aproximada#}"
                        >
                        <div class="input-group-append"><span class="input-group-text field_info"><i class="fas fa-map-marker-alt"></i></span></div>
                    </div>
                    <span class="form-text text-black-50">{#field_msg_area_aproximada#}</span>
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
