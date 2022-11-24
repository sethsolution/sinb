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
                <div class="col-lg-6">
                    <label>{#field_tipo_documento_id#} <span class="text-danger bold">*</span> : </label>
                    <div class="input-group">
                        <select class="form-control m-select2 select2_general"
                                name="item[tipo_documento_id]" id="tipo_documento_id"
                                data-placeholder="{#field_Holder_tipo_documento_id#}" {$privFace.input}
                                required
                                data-fv-not-empty___message="{#glFieldRequired#}"
                        >
                            <option></option>
                            {html_options options=$cataobj.tipo_documento selected=$item.tipo_documento_id}
                        </select>
                    </div>
                    <span class="form-text text-black-50">{#field_GroupMsg_tipo_documento_id#}</span>
                </div>
                <div class="col-lg-6">
                    <label>{#field_proposito_id#} <span class="text-danger bold">*</span> : </label>
                    <div class="input-group">
                        <select class="form-control m-select2 select2_general"
                                name="item[proposito_id]" id="proposito_id"
                                data-placeholder="{#field_Holder_proposito_id#}" {$privFace.input}
                                required
                                data-fv-not-empty___message="{#glFieldRequired#}"
                        >
                            <option></option>
                            {html_options options=$cataobj.proposito selected=$item.proposito_id}
                        </select>
                    </div>
                    <span class="form-text text-black-50">{#field_GroupMsg_proposito_id#}</span>
                </div>

                <div class="col-lg-6">
                    <label>{#field_fecha#}<span class="text-danger bold">*</span> :</label>
                    <div class="input-group">
                        <input type="text" class="form-control date_general" id="valid_until"
                               name="item[fecha]" value="{$item.fecha|date_format:'%d/%m/%Y'}"
                               required
                               data-fv-not-empty___message="{#glFieldRequired#}"
                        >
                        <div class="input-group-append"><span class="input-group-text calendar"><i class="flaticon-event-calendar-symbol"></i></span></div>
                    </div>
                    <span class="form-text text-black-50">{#field_msg_fecha#}</span>
                </div>
                <div class="col-lg-6">
                    <label>{#field_numero_cites#}:</label>
                    <div class="input-group">
                        <input type="text" class="form-control number_integer2"
                               name="item[numero_cites]" value="{$item.numero_cites|escape:"html"}"
                        >
                        <div class="input-group-append"><span class="input-group-text field_info"><i class="fa fa-info"></i></span></div>
                    </div>
                    <span class="form-text text-muted">{#field_msg_numero_cites#}</span>
                </div>


                <div class="col-lg-6">
                    <label>{#field_exportador#} <span class="text-danger bold">*</span> : </label>
                    <div class="input-group">
                        <input type="text" class="form-control"
                               name="item[exportador]" value="{$item.exportador|escape:"html"}"
                               required
                               data-fv-not-empty___message="{#glFieldRequired#}"
                               minlength="3"
                               data-fv-string-length___message="{#field_length_exportador#}"
                        >
                        <div class="input-group-append"><span class="input-group-text field_info"><i class="fas fa-user"></i></span></div>
                    </div>
                    <span class="form-text text-black-50">{#field_msg_exportador#}</span>
                </div>
                <div class="col-lg-6">
                    <label>{#field_destinatario#} <span class="text-danger bold">*</span> : </label>
                    <div class="input-group">
                        <input type="text" class="form-control"
                               name="item[destinatario]" value="{$item.destinatario|escape:"html"}"
                               required
                               data-fv-not-empty___message="{#glFieldRequired#}"
                               minlength="3"
                               data-fv-string-length___message="{#field_length_destinatario#}"
                        >
                        <div class="input-group-append"><span class="input-group-text field_info"><i class="fas fa-user"></i></span></div>
                    </div>
                    <span class="form-text text-black-50">{#field_msg_destinatario#}</span>
                </div>


                <div class="col-lg-3">
                    <label>{#field_fecha_valido#}<span class="text-danger bold">*</span> :</label>
                    <div class="input-group">
                        <input type="text" class="form-control date_general" id="valid_until"
                               name="item[fecha_valido]" value="{$item.fecha_valido|date_format:'%d/%m/%Y'}"
                               required
                               data-fv-not-empty___message="{#glFieldRequired#}"
                        >
                        <div class="input-group-append"><span class="input-group-text calendar"><i class="flaticon-event-calendar-symbol"></i></span></div>
                    </div>
                    <span class="form-text text-black-50">{#field_msg_fecha_valido#}</span>
                </div>
                <div class="col-lg-9">
                    <label>{#field_observacion#} </label>
                    <div class="m-input-icon m-input-icon--right">
                        <div class="summernote" id="observacion">{$item.observacion}</div>
                        <input class="form-control m-input" type="hidden" name="item[observacion]" id="observacion_input" {$privFace.input}>
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