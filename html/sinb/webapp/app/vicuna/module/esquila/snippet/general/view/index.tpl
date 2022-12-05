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
                    <label>{#field_nacional_id#}:</label>
                    <div class="input-group">
                        <input type="text" class="form-control number_integer2"
                               name="item[nacional_id]" value="{$item.nacional_id|escape:"html"}"
                        >
                        <div class="input-group-append"><span class="input-group-text field_info"><i class="fab fa-centercode"></i></span></div>
                    </div>
                    <span class="form-text text-muted">{#field_msg_nacional_id#}</span>
                </div>
                <div class="col-lg-6">
                    <label>{#field_anio#}:</label>
                    <div class="input-group">
                        <input type="text" class="form-control number_integer2"
                               name="item[anio]" value="{$item.anio|escape:"html"}"
                        >
                        <div class="input-group-append"><span class="input-group-text field_info"><i class="far fa-calendar"></i></span></div>
                    </div>
                    <span class="form-text text-muted">{#field_msg_anio#}</span>
                </div>
                <div class="col-lg-6">
                    <label>{#field_departameto_id#}: </label>
                    <div class="input-group">
                        <select class="form-control m-select2 select2_general"
                                name="item[departamento_id]" id="type_select_estado"
                                data-placeholder="{#field_Holder_departameto_id#}" {$privFace.input}
                        >
                            <option></option>
                            {html_options options=$cataobj.departamento selected=$item.departamento_id}
                        </select>
                    </div>
                    <span class="form-text text-black-50">{#field_GroupMsg_departameto_id#}</span>
                </div>
                <div class="col-lg-6">
                    <label>{#field_provincia_id#}: </label>
                    <div class="input-group">
                        <select class="form-control m-select2 select2_general"
                                name="item[provincia_id]" id="type_select_estado"
                                data-placeholder="{#field_Holder_provincia_id#}" {$privFace.input}
                        >
                            <option></option>
                            {html_options options=$cataobj.departamento selected=$item.provincia_id}
                        </select>
                    </div>
                    <span class="form-text text-black-50">{#field_GroupMsg_provincia_id#}</span>
                </div>
                <div class="col-lg-6">
                    <label>{#field_arcmv#}: </label>
                    <div class="input-group">
                        <input type="text" class="form-control"
                               name="item[arcmv]" value="{$item.arcmv|escape:"html"}"
                               minlength="3"
                               data-fv-string-length___message="{#field_length_arcmv#}"
                        >
                        <div class="input-group-append"><span class="input-group-text field_info"><i class="fas flaticon-layer"></i></span></div>
                    </div>
                    <span class="form-text text-black-50">{#field_msg_arcmv#}</span>
                </div>
                <div class="col-lg-6">
                    <label>{#field_cmv#}: </label>
                    <div class="input-group">
                        <input type="text" class="form-control"
                               name="item[cmv]" value="{$item.cmv|escape:"html"}"
                               minlength="3"
                               data-fv-string-length___message="{#field_length_cmv#}"
                        >
                        <div class="input-group-append"><span class="input-group-text field_info"><i class="fas flaticon-layer"></i></span></div>
                    </div>
                    <span class="form-text text-black-50">{#field_msg_cmv#}</span>
                </div>
                <div class="col-lg-4">
                    <label>{#field_numero_acta#}:</label>
                    <div class="input-group">
                        <input type="text" class="form-control number_integer2"
                               name="item[numero_acta]"
                               value="{$item.numero_acta|escape:"html"}"
                        >
                        <div class="input-group-append"><span class="input-group-text field_info"><i class="far fa-clipboard"></i></span></div>
                    </div>
                    <span class="form-text text-muted">{#field_msg_numero_acta#}</span>
                </div>
                <div class="col-lg-4">
                    <label>{#field_sitio_captura#}:</label>
                    <div class="input-group">
                        <input type="text" class="form-control"
                               name="item[sitio_captura]" value="{$item.sitio_captura|escape:"html"}"
                               minlength="3"
                               data-fv-string-length___message="{#field_length_sitio_captura#}"
                        >
                        <div class="input-group-append"><span class="input-group-text field_info"><i class="fas fa-location-arrow"></i></span></div>
                    </div>
                    <span class="form-text text-black-50">{#field_msg_sitio_captura#}</span>
                </div>
                <div class="col-lg-4">
                    <label>{#field_fecha_captura#}:</label>
                    <div class="input-group">
                        <input type="text" class="form-control date_general" id="fecha_captura"
                               name="item[fecha_captura]"
                               value="{$item.fecha_captura|date_format:'%d/%m/%Y'}"
                               data-fv-not-empty___message="{#glFieldRequired#}"
                        >
                        <div class="input-group-append"><span class="input-group-text calendar"><i class="flaticon-event-calendar-symbol "></i></span></div>
                    </div>
                    <span class="form-text text-black-50">{#field_msg_fecha_captura#}</span>
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