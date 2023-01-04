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
                    <label>{#fielDate#}:</label>
                    <div class="input-group">
                        <input type="text" class="form-control date_general" id="valid_until"
                               name="item[fecha_pago]" value="{$item.fecha_pago|date_format:'%d/%m/%Y'}"
                               required
                               data-fv-not-empty___message="{#glFieldRequired#}"
                        >
                        <div class="input-group-append"><span class="input-group-text"><i class="flaticon-event-calendar-symbol"></i></span></div>
                    </div>

                    <span class="form-text text-black-50">{#fielMsgDate#}</span>
                </div>
                <div class="col-lg-4">
                    <label>{#fielAmount#} <span class="text-danger bold">*</span>:</label>
                    <div class="input-group">
                        <input type="text" class="form-control number_decimal amount"
                               name="item[monto]" value="{$item.monto|escape:"html"}"
                               required
                               placeholder=""
                               data-fv-not-empty___message="{#glFieldRequired#}"
                        >
                        <div class="input-group-append"><span class="input-group-text"><i class="fa fa-money-bill"></i></span></div>
                    </div>
                    <span class="form-text text-black-50">{#fielMsgAmount#}</span>
                </div>
                <div class="col-lg-4">
                    <label>{#fielNro#} <span class="text-danger bold">*</span>:</label>
                    <div class="input-group">
                        <input type="text" class="form-control number_integer"
                               name="item[numero_boleta]" value="{$item.numero_boleta|escape:"html"}"
                               required
                               placeholder=""
                               data-fv-not-empty___message="{#glFieldRequired#}"
                        >
                        <div class="input-group-append"><span class="input-group-text"><i class="fa fa-money-check"></i></span></div>
                    </div>
                    <span class="form-text text-black-50">{#fielMsgNro#}</span>

                </div>

                <div class="col-lg-12">
                    <label>{#fieldName#} <span class="text-danger bold">*</span> :</label>
                    <input type="text" class="form-control"
                           name="item[nombre_depositante]"
                           value="{$item.nombre_depositante|escape:"html"}"
                           placeholder=""
                           required
                           data-fv-not-empty___message="{#glFieldRequired#}"
                           minlength="3"
                           data-fv-string-length___message="{#fieldNameLength#}"
                    >
                    <span class="form-text text-black-50">{#fieldNameMsg#}</span>
                </div>
            </div>

            <div class="form-group row">
                <div class="col-lg-12">
                    <label>{#field_file#} </label>
                    <div class="custom-file">
                        <input type="file" class="form-control custom-file-input"
                               placeholder="{#field_holder_file#}"
                               name="input_file" id="input_file"
                               accept="application/pdf,image/jpeg"

                        >
                        <label class="custom-file-label file-name" id="input_file_name" for="input_file"></label>
                    </div>

                        <span class="form-text text-black-50">{#field_msg_file#}</span>

                    {if $item.attached_name != ""}
                        {if $type == 'update'}
                            <strong>Archivo:</strong> <span class="m--font-success">{$item.attached_name}</span>
                        {/if}
                    {/if}
                    </span>
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
