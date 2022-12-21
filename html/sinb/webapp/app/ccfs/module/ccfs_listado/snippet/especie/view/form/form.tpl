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
                <div class="col-lg-4">
                    <label>{#field_apendice_id#} <span class="text-danger bold">*</span> : </label>
                    <div class="input-group">
                        <select class="form-control m-select2 select2_general" name="item[apendice_id]" id="apendice_id"
                                data-placeholder="{#field_Holder_apendice_id#}" {$privFace.input}
                                required
                                data-fv-not-empty___message="{#glFieldRequired#}"
                        >
                            <option></option>
                            {html_options options=$cataobj.apendice selected=$item.apendice_id}
                        </select>
                    </div>
                    <span class="form-text text-black-50">{#field_GroupMsg_apendice_id#}</span>
                </div>
                <div class="col-lg-4">
                    <label>{#field_nombre_comercial#} <span class="text-danger bold">*</span> :</label>
                    <div class="col-lg-12 ">
                        <input type="text" class="form-control"
                               name="item[nombre_comercial]"
                               value="{$item.nombre_comercial|escape:"html"}"
                               placeholder=""
                               required
                               data-fv-not-empty___message="{#glFieldRequired#}"
                               minlength="3"
                               data-fv-string-length___message="{#field_length_nombre_comercial#}"
                        >
                        <span class="form-text text-black-50">{#field_msg_nombre_comercial#}</span>
                    </div>
                </div>
                <div class="col-lg-4">
                    <label>{#field_nombre_cientifico#} <span class="text-danger bold">*</span> :</label>
                    <div class="col-lg-12 ">
                        <input type="text" class="form-control"
                               name="item[nombre_cientifico]"
                               value="{$item.nombre_cientifico|escape:"html"}"
                               placeholder=""
                               required
                               data-fv-not-empty___message="{#glFieldRequired#}"
                               minlength="3"
                               data-fv-string-length___message="{#field_length_nombre_cientifico#}"
                        >
                        <span class="form-text text-black-50">{#field_msg_nombre_cientifico#}</span>
                    </div>
                </div>

                <div class="col-lg-4">
                    <label>{#field_cantidad#}  <span class="text-danger bold">*</span> :</label>
                    <div class="col-lg-12 ">
                        <div class="input-group">
                            <input type="text" class="form-control number_integer"
                                   name="item[cantidad]" value="{$item.cantidad|escape:"html"}"
                                   required
                                   data-fv-not-empty___message="{#glFieldRequired#}"
                            >
                            <div class="input-group-prepend"><span class="input-group-text"><i class="ki ki-double-arrow-back text-primary"></i></span></div>
                        </div>
                        <span class="form-text text-black-50">{#field_msg_cantidad#}</span>
                    </div>
                </div>
                <div class="col-lg-4">
                    <label>{#field_unidad_id#} <span class="text-danger bold">*</span> : </label>
                    <div class="input-group">
                        <select class="form-control m-select2 select2_general" name="item[unidad_id]" id="unidad_id"
                                data-placeholder="{#field_Holder_unidad_id#}" {$privFace.input}
                                required
                                data-fv-not-empty___message="{#glFieldRequired#}"
                        >
                            <option></option>
                            {html_options options=$cataobj.unidad selected=$item.unidad_id}
                        </select>
                    </div>
                    <span class="form-text text-black-50">{#field_GroupMsg_unidad_id#}</span>
                </div>
                <div class="col-lg-4">
                    <label>{#field_origen_id#} <span class="text-danger bold">*</span> : </label>
                    <div class="input-group">
                        <select class="form-control m-select2 select2_general" name="item[origen_id]" id="origen_id"
                                data-placeholder="{#field_Holder_origen_id#}" {$privFace.input}
                                required
                                data-fv-not-empty___message="{#glFieldRequired#}"
                        >
                            <option></option>
                            {html_options options=$cataobj.origen selected=$item.origen_id}
                        </select>
                    </div>
                    <span class="form-text text-black-50">{#field_GroupMsg_origen_id#}</span>
                </div>

                <div class="col-lg-12">
                    <label>{#field_descripcion#}:</label>
                    <input type="text" class="form-control"
                           name="item[descripcion]"
                           value="{$item.descripcion|escape:"html"}"
                           minlength="3"
                           data-fv-string-length___message="{#field_length_descripcion#}"
                    >
                    <span class="form-text text-black-50">{#field_msg_descripcion#}</span>
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
