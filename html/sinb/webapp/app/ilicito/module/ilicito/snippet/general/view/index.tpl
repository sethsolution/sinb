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
                <div class="col-lg-3">
                    <label>{#field_gestion#}<span class="text-danger bold">*</span> : </label>
                    <div class="input-group">
                        <input type="text" class="form-control number_integer2"
                               name="item[gestion]" value="{$item.gestion|escape:"html"}"
                               required
                               data-fv-not-empty___message="{#glFieldRequired#}"
                        >
                        <div class="input-group-append"><span class="input-group-text field_info"><i class="far fa-calendar"></i></span></div>
                    </div>
                    <span class="form-text text-muted">{#field_msg_gestion#}</span>
                </div>
                <div class="col-lg-4">
                    <label>{#field_mes#} <span class="text-danger bold">*</span> : </label>
                    <div class="input-group">
                        <input type="text" class="form-control"
                               name="item[mes]" value="{$item.mes|escape:"html"}"
                               required
                               data-fv-not-empty___message="{#glFieldRequired#}"
                               minlength="3"
                               data-fv-string-length___message="{#field_length_mes#}"
                        >
                        <div class="input-group-append"><span class="input-group-text field_info"><i class="far fa-calendar"></i></span></div>
                    </div>
                    <span class="form-text text-black-50">{#field_msg_mes#}</span>
                </div>
                <div class="col-lg-5">
                    <label>{#field_fecha#} <span class="text-danger bold">*</span> : </label>
                    <div class="input-group">
                        <input type="text" class="form-control date_general" id="fecha"
                               name="item[fecha]" value="{$item.fecha|date_format:'%d/%m/%Y'}"
                               required
                               data-fv-not-empty___message="{#glFieldRequired#}"
                        >
                        <div class="input-group-append"><span class="input-group-text calendar"><i class="flaticon-event-calendar-symbol "></i></span></div>
                    </div>
                    <span class="form-text text-black-50">{#field_msg_fecha#}</span>
                </div>
                <div class="col-lg-4">
                    <label>{#field_departamento_id#}: </label>
                    <div class="input-group">
                        <select class="form-control m-select2 select2_general"
                                name="item[departamento_id]" id="departamento_id"
                                data-placeholder="{#field_Holder_departamento_id#}" {$privFace.input}
                        >
                            <option></option>
                            {html_options options=$cataobj.departamento selected=$item.departamento_id}
                        </select>
                    </div>
                    <span class="form-text text-black-50">{#field_GroupMsg_departamento_id#}</span>
                </div>
                <div class="col-lg-8">
                    <label>{#field_entregado#} <span class="text-danger bold">*</span> : </label>
                    <div class="input-group">
                        <input type="text" class="form-control"
                               name="item[entregado]" value="{$item.entregado|escape:"html"}"
                               required
                               data-fv-not-empty___message="{#glFieldRequired#}"
                               minlength="3"
                               data-fv-string-length___message="{#field_length_entregado#}"
                        >
                        <div class="input-group-append"><span class="input-group-text field_info"><i class="fas flaticon-layer"></i></span></div>
                    </div>
                    <span class="form-text text-black-50">{#field_msg_entregado#}</span>
                </div>
                <div class="col-lg-3">
                    <label>{#field_procedencia_id#} <span class="text-danger bold">*</span> : </label>
                    <div class="input-group">
                        <select class="form-control m-select2 select2_general"
                                name="item[procedencia_id]" id="procedencia_id"
                                data-placeholder="{#field_Holder_procedencia_id#}" {$privFace.input}
                                required
                                data-fv-not-empty___message="{#glFieldRequired#}"
                        >
                            <option></option>
                            {html_options options=$cataobj.procedencia selected=$item.procedencia_id}
                        </select>
                    </div>
                    <span class="form-text text-black-50">{#field_GroupMsg_procedencia_id#}</span>
                </div>
                <div class="col-lg-6">
                    <label>{#field_especie_id#} <span class="text-danger bold">*</span> : </label>
                    <div class="input-group">
                        <select class="form-control m-select2 select2_general"
                                name="item[especie_id]" id="especie_id"
                                data-placeholder="{#field_Holder_especie_id#}" {$privFace.input}
                                required
                                data-fv-not-empty___message="{#glFieldRequired#}"
                        >
                            <option></option>
                            {html_options options=$cataobj.especie selected=$item.especie_id}
                        </select>
                    </div>
                    <span class="form-text text-black-50">{#field_GroupMsg_especie_id#}</span>
                </div>
                <div class="col-lg-3">
                    <label>{#field_cantidad#}<span class="text-danger bold">*</span> : </label>
                    <div class="input-group">
                        <input type="text" class="form-control number_integer2"
                               name="item[cantidad]" value="{$item.cantidad|escape:"html"}"
                               required
                               data-fv-not-empty___message="{#glFieldRequired#}"
                        >
                        <div class="input-group-append"><span class="input-group-text field_info"><i class="fas flaticon-layer"></i></span></div>
                    </div>
                    <span class="form-text text-muted">{#field_msg_cantidad#}</span>
                </div>
                <div class="col-lg-4">
                    <label>{#field_destino_id#} <span class="text-danger bold">*</span> : </label>
                    <div class="input-group">
                        <select class="form-control m-select2 select2_general"
                                name="item[destino_id]" id="destino_id"
                                data-placeholder="{#field_Holder_destino_id#}" {$privFace.input}
                                required
                                data-fv-not-empty___message="{#glFieldRequired#}"
                        >
                            <option></option>
                            {html_options options=$cataobj.destino selected=$item.destino_id}
                        </select>
                    </div>
                    <span class="form-text text-black-50">{#field_GroupMsg_destino_id#}</span>
                </div>
                <div class="col-lg-4">
                    <label>{#field_categoria_id#} <span class="text-danger bold">*</span> : </label>
                    <div class="input-group">
                        <select class="form-control m-select2 select2_general"
                                name="item[categoria_id]" id="categoria_id"
                                data-placeholder="{#field_Holder_categoria_id#}" {$privFace.input}
                                required
                                data-fv-not-empty___message="{#glFieldRequired#}"
                        >
                            <option></option>
                            {html_options options=$cataobj.categoria selected=$item.categoria_id}
                        </select>
                    </div>
                    <span class="form-text text-black-50">{#field_GroupMsg_categoria_id#}</span>
                </div>
                <div class="col-lg-4    ">
                    <label>{#field_estado_salud_id#} <span class="text-danger bold">*</span> : </label>
                    <div class="input-group">
                        <select class="form-control m-select2 select2_general"
                                name="item[estado_salud_id]" id="estado_salud_id"
                                data-placeholder="{#field_Holder_estado_salud_id#}" {$privFace.input}
                                required
                                data-fv-not-empty___message="{#glFieldRequired#}"
                        >
                            <option></option>
                            {html_options options=$cataobj.estado_salud selected=$item.estado_salud_id}
                        </select>
                    </div>
                    <span class="form-text text-black-50">{#field_GroupMsg_estado_salud_id#}</span>
                </div>
                <div class="col-lg-12">
                    <label>{#field_observaciones#}: </label>
                    <div class="input-group">
                        <input type="text" class="form-control"
                               name="item[observaciones]" value="{$item.observaciones|escape:"html"}"
                               minlength="3"
                               data-fv-string-length___message="{#field_length_observaciones#}"
                        >
                        <div class="input-group-append"><span class="input-group-text field_info"><i class="fas fa-calendar-check"></i></span></div>
                    </div>
                    <span class="form-text text-black-50">{#field_msg_observaciones#}</span>
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