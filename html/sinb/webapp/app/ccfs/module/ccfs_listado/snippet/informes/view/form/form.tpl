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
                    <label>{#field_gestion_id#} <span class="text-danger bold">*</span> : </label>
                    <div class="input-group">
                        <select class="form-control m-select2 select2_general" name="item[gestion_id]" id="gestion_id"
                                data-placeholder="{#field_Holder_gestion_id#}" {$privFace.input}
                                required
                                data-fv-not-empty___message="{#glFieldRequired#}"
                        >
                            <option></option>
                            {html_options options=$cataobj.gestion selected=$item.gestion_id}
                        </select>
                    </div>
                    <span class="form-text text-black-50">{#field_GroupMsg_gestion_id#}</span>
                </div>
                <div class="col-lg-4">
                    <label>{#field_especie_tipo_id#} <span class="text-danger bold">*</span> : </label>
                    <div class="input-group">
                        <select class="form-control m-select2 select2_general" name="item[especie_tipo_id]" id="especie_tipo_id"
                                data-placeholder="{#field_Holder_especie_tipo_id#}" {$privFace.input}
                                required
                                data-fv-not-empty___message="{#glFieldRequired#}"
                        >
                            <option></option>
                            {html_options options=$cataobj.especie_tipo selected=$item.especie_tipo_id}
                        </select>
                    </div>
                    <span class="form-text text-black-50">{#field_GroupMsg_especie_tipo_id#}</span>
                </div>
                <div class="col-lg-4">
                    <label>{#field_especie#} <span class="text-danger bold">*</span> :</label>
                    <div class="col-lg-12 ">
                        <input type="text" class="form-control"
                               name="item[especie]"
                               value="{$item.especie|escape:"html"}"
                               placeholder=""
                               required
                               data-fv-not-empty___message="{#glFieldRequired#}"
                               minlength="3"
                               data-fv-string-length___message="{#field_length_especie#}"
                        >
                        <span class="form-text text-black-50">{#field_msg_especie#}</span>
                    </div>
                </div>

                <div class="col-lg-4">
                    <label>{#field_numero_animales_albergar#}  <span class="text-danger bold">*</span> :</label>
                    <div class="col-lg-12 ">
                        <div class="input-group">
                            <input type="text" class="form-control number_integer2"
                                   name="item[numero_animales_albergar]" value="{$item.numero_animales_albergar|escape:"html"}"
                                   required
                                   data-fv-not-empty___message="{#glFieldRequired#}"
                            >
                            <div class="input-group-prepend"><span class="input-group-text"><i class="fas fa-sort-numeric-up text-primary"></i></span></div>
                        </div>
                        <span class="form-text text-black-50">{#field_msg_numero_animales_albergar#}</span>
                    </div>
                </div>
                <div class="col-lg-4">
                    <label>{#field_numero_animales_gestion#}  <span class="text-danger bold">*</span> :</label>
                    <div class="col-lg-12 ">
                        <div class="input-group">
                            <input type="text" class="form-control number_integer2"
                                   name="item[numero_animales_gestion]" value="{$item.numero_animales_gestion|escape:"html"}"
                                   required
                                   data-fv-not-empty___message="{#glFieldRequired#}"
                            >
                            <div class="input-group-prepend"><span class="input-group-text"><i class="fas fa-sort-numeric-up text-primary"></i></span></div>
                        </div>
                        <span class="form-text text-black-50">{#field_msg_numero_animales_gestion#}</span>
                    </div>
                </div>
                <div class="col-lg-4">
                    <label>{#field_nacimientos#}  <span class="text-danger bold">*</span> :</label>
                    <div class="col-lg-12 ">
                        <div class="input-group">
                            <input type="text" class="form-control number_integer2"
                                   name="item[nacimientos]" value="{$item.nacimientos|escape:"html"}"
                                   required
                                   data-fv-not-empty___message="{#glFieldRequired#}"
                            >
                            <div class="input-group-prepend"><span class="input-group-text"><i class="fas fa-sort-numeric-up text-primary"></i></span></div>
                        </div>
                        <span class="form-text text-black-50">{#field_msg_nacimientos#}</span>
                    </div>
                </div>
                <div class="col-lg-4">
                    <label>{#field_ingreso_recepcion#}  <span class="text-danger bold">*</span> :</label>
                    <div class="col-lg-12 ">
                        <div class="input-group">
                            <input type="text" class="form-control number_integer2"
                                   name="item[ingreso_recepcion]" value="{$item.ingreso_recepcion|escape:"html"}"
                                   required
                                   data-fv-not-empty___message="{#glFieldRequired#}"
                            >
                            <div class="input-group-prepend"><span class="input-group-text"><i class="fas fa-sort-numeric-up text-primary"></i></span></div>
                        </div>
                        <span class="form-text text-black-50">{#field_msg_ingreso_recepcion#}</span>
                    </div>
                </div>
                <div class="col-lg-4">
                    <label>{#field_transferencia_de_ccfs#}  <span class="text-danger bold">*</span> :</label>
                    <div class="col-lg-12 ">
                        <div class="input-group">
                            <input type="text" class="form-control number_integer2"
                                   name="item[transferencia_de_ccfs]" value="{$item.transferencia_de_ccfs|escape:"html"}"
                                   required
                                   data-fv-not-empty___message="{#glFieldRequired#}"
                            >
                            <div class="input-group-prepend"><span class="input-group-text"><i class="fas fa-sort-numeric-up text-primary"></i></span></div>
                        </div>
                        <span class="form-text text-black-50">{#field_msg_transferencia_de_ccfs#}</span>
                    </div>
                </div>
                <div class="col-lg-4">
                    <label>{#field_decesos#}  <span class="text-danger bold">*</span> :</label>
                    <div class="col-lg-12 ">
                        <div class="input-group">
                            <input type="text" class="form-control number_integer2"
                                   name="item[decesos]" value="{$item.decesos|escape:"html"}"
                                   required
                                   data-fv-not-empty___message="{#glFieldRequired#}"
                            >
                            <div class="input-group-prepend"><span class="input-group-text"><i class="fas fa-sort-numeric-up text-primary"></i></span></div>
                        </div>
                        <span class="form-text text-black-50">{#field_msg_decesos#}</span>
                    </div>
                </div>
                <div class="col-lg-4">
                    <label>{#field_fugas#}  <span class="text-danger bold">*</span> :</label>
                    <div class="col-lg-12 ">
                        <div class="input-group">
                            <input type="text" class="form-control number_integer2"
                                   name="item[fugas]" value="{$item.fugas|escape:"html"}"
                                   required
                                   data-fv-not-empty___message="{#glFieldRequired#}"
                            >
                            <div class="input-group-prepend"><span class="input-group-text"><i class="fas fa-sort-numeric-up text-primary"></i></span></div>
                        </div>
                        <span class="form-text text-black-50">{#field_msg_fugas#}</span>
                    </div>
                </div>
                <div class="col-lg-4">
                    <label>{#field_transferencia_a_ccfs#}  <span class="text-danger bold">*</span> :</label>
                    <div class="col-lg-12 ">
                        <div class="input-group">
                            <input type="text" class="form-control number_integer2"
                                   name="item[transferencia_a_ccfs]" value="{$item.transferencia_a_ccfs|escape:"html"}"
                                   required
                                   data-fv-not-empty___message="{#glFieldRequired#}"
                            >
                            <div class="input-group-prepend"><span class="input-group-text"><i class="fas fa-sort-numeric-up text-primary"></i></span></div>
                        </div>
                        <span class="form-text text-black-50">{#field_msg_transferencia_a_ccfs#}</span>
                    </div>
                </div>
                <div class="col-lg-4">
                    <label>{#field_total_albergados#}  <span class="text-danger bold">*</span> :</label>
                    <div class="col-lg-12 ">
                        <div class="input-group">
                            <input type="text" class="form-control number_integer2"
                                   name="item[total_albergados]" value="{$item.total_albergados|escape:"html"}"
                                   required
                                   data-fv-not-empty___message="{#glFieldRequired#}"
                            >
                            <div class="input-group-prepend"><span class="input-group-text"><i class="fas fa-sort-numeric-up text-primary"></i></span></div>
                        </div>
                        <span class="form-text text-black-50">{#field_msg_total_albergados#}</span>
                    </div>
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
