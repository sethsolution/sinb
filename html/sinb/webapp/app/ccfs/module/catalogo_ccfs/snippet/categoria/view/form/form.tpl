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
            </div>

            <div class="form-group row">
                <div class="col-lg-12">
                    <label>{#field_descripcion#} <span class="text-danger bold">*</span> :</label>
                    <input type="text" class="form-control"
                           name="item[descripcion]"
                           value="{$item.descripcion|escape:"html"}"
                           placeholder=""
                           required
                           data-fv-not-empty___message="{#glFieldRequired#}"
                           minlength="3"
                           data-fv-string-length___message="{#field_length_descripcion#}"
                    >
                    <span class="form-text text-black-50">{#field_msg_descripcion#}</span>
                </div>
            </div>

            <div class="form-group row">
                <div class="col-lg-12">
                    <label>{#field_active#} <span class="text-danger bold">*</span> :</label>
                    <div class="input-group">
                    <span class="switch switch-icon">
                        <label><input type="checkbox" {if $item.active == 1}checked="checked"{/if} name="item[active]" value="1" ><span></span></label>
                    </span>
                    </div>
                    <span class="form-text text-black-50">{#field_msg_active#}</span>
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
