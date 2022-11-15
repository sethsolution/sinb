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
                    <label>{#field_gestion_id#}: </label>
                    <div class="input-group">
                        <select class="form-control m-select2 select2_general"
                                name="item[gestion_id]" id="type"
                                data-placeholder="{#field_Holder_gestion_id#}" {$privFace.input}
{*                                required*}
{*                                data-fv-not-empty___message="{#glFieldRequired#}"*}
                        >
                            <option></option>
                            {html_options options=$cataobj.gestion selected=$item.gestion_id}
                        </select>
                    </div>
                    <span class="form-text text-muted">{#field_GroupMsg_gestion_id#}</span>
                </div>
                <div class="col-lg-4">
                    <label>{#field_cupos_autorizado#}:</label>
                    <div class="input-group">
                        <input type="text" class="form-control number_integer2"
                               name="item[cupos_autorizado]" value="{$item.cupos_autorizado|escape:"html"}"
                        >
                        <div class="input-group-append"><span class="input-group-text"><i class="fa fa-info"></i></span></div>
                    </div>
                    <span class="form-text text-muted">{#field_msg_cupos_autorizado#}</span>
                </div>
                <div class="col-lg-4">
                    <label>{#field_cupos_utilizado#}:</label>
                    <div class="input-group">
                        <input type="text" class="form-control number_integer2"
                               name="item[cupos_utilizado]" value="{$item.cupos_utilizado|escape:"html"}"
                        >
                        <div class="input-group-append"><span class="input-group-text"><i class="fa fa-info"></i></span></div>
                    </div>
                    <span class="form-text text-muted">{#field_msg_cupos_utilizado#}</span>
                </div>
            </div>
            <div class="form-group row">
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
