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

        <div class="card-body">
            <div class="form-group row">
                <div class="col-lg-3">
                    <label>{#field_sigla#}  <span class="text-danger bold">*</span> :</label>
                    <div class="input-group">
                        <input type="text" class="form-control"
                               name="item[sigla]" value="{$item.sigla|escape:"html"}"
                               required
                               data-fv-not-empty___message="{#glFieldRequired#}"
                        >
                        <div class="input-group-append"><span class="input-group-text field_key"><i class="fas fa-key"></i></span></div>
                    </div>
                    <span class="form-text text-black-50">{#field_msg_sigla#}</span>
                </div>
                <div class="col-lg-9">
                    <label>{#field_name#}  <span class="text-danger bold">*</span> :</label>
                    <div class="input-group">
                        <input type="text" class="form-control"
                               name="item[nombre]" value="{$item.nombre|escape:"html"}"
                               required
                               data-fv-not-empty___message="{#glFieldRequired#}"
                               minlength="3"
                               data-fv-string-length___message="{#field_length_name#}"
                        >
                        <div class="input-group-append"><span class="input-group-text field_info"><i class="fas fa-info"></i></span></div>
                    </div>
                    <span class="form-text text-black-50">{#field_msg_name#}</span>
                </div>

                <div class="col-lg-4">
                    <label>{#field_estado_id#} <span class="text-danger bold">*</span> : </label>
                    <div class="input-group">
                        <select class="form-control m-select2 select2_general"
                                name="item[estado_id]" id="type_select_estado"
                                data-placeholder="{#field_Holder_estado_id#}" {$privFace.input}
                                required
                                data-fv-not-empty___message="{#glFieldRequired#}"
                        >
                            <option></option>
                            {html_options options=$cataobj.programa_estado selected=$item.estado_id}
                        </select>
                    </div>
                    <span class="form-text text-black-50">{#field_GroupMsg_estado_id#}</span>
                </div>
                <div class="col-lg-4">
                    <label>{#field_fecha_inicio#}:</label>
                    <div class="input-group">
                        <input type="text" class="form-control date_general" id="valid_until"
                               name="item[fecha_inicio]" value="{$item.fecha_inicio|date_format:'%d/%m/%Y'}"
                               data-fv-not-empty___message="{#glFieldRequired#}"
                        >
                        <div class="input-group-append"><span class="input-group-text calendar"><i class="flaticon-event-calendar-symbol"></i></span></div>
                    </div>
                    <span class="form-text text-black-50">{#field_msg_fecha_inicio#}</span>
                </div>
                <div class="col-lg-4">
                    <label>{#field_fecha_conclusion#}:</label>
                    <div class="input-group">
                        <input type="text" class="form-control date_general" id="valid_until"
                               name="item[fecha_conclusion]" value="{$item.fecha_conclusion|date_format:'%d/%m/%Y'}"
                               data-fv-not-empty___message="{#glFieldRequired#}"
                        >
                        <div class="input-group-append"><span class="input-group-text calendar"><i class="flaticon-event-calendar-symbol"></i></span></div>
                    </div>
                    <span class="form-text text-black-50">{#field_msg_fecha_conclusion#}</span>
                </div>

                {* ------------------- Plazo ------------------- *}
                <div class="col-lg-4">
                    <label>{#field_vigencia_anios#}:</label>
                    <div class="input-group">
                        <input type="number" class="form-control number_integer p-5"
                               name="item[vigencia_anios]" value="{$item.vigencia_anios|escape:"html"}"
                               data-fv-not-empty___message="{#glFieldRequired#}"
                        >
                        <div class="input-group-append"><span class="input-group-text"><i class="fas fa-calendar-check"></i></span></div>
                    </div>
                    <span class="form-text text-primary">{#field_msg_vigencia_anios#}</span>
                </div>
                <div class="col-lg-4">
                    <label>{#field_vigencia_mes#}:</label>
                    <div class="input-group">
                        <input type="number" class="form-control number_integer p-5"
                               name="item[vigencia_mes]" value="{$item.vigencia_mes|escape:"html"}"
                               data-fv-not-empty___message="{#glFieldRequired#}"
                        >
                        <div class="input-group-append"><span class="input-group-text"><i class="fas fa-calendar-check"></i></span></div>
                    </div>
                    <span class="form-text text-primary">{#field_msg_vigencia_mes#}</span>
                </div>
                <div class="col-lg-4">
                    <label>{#field_vigencia_dias#}:</label>
                    <div class="input-group">
                        <input type="number" class="form-control number_integer p-5"  min="1" max="30" step="1"
                               name="item[vigencia_dias]" value="{$item.vigencia_dias|escape:"html"}"
                               data-fv-not-empty___message="{#glFieldRequired#}"
                        >
                        <div class="input-group-append"><span class="input-group-text"><i class="fas fa-calendar-check"></i></span></div>
                    </div>
                    <span class="form-text text-primary">{#field_msg_vigencia_dias#}</span>
                </div>
                {* ------------------------------------------ *}
                {* ------------------- Moneda ------------------- *}
                <div class="col-lg-4">
                    <label>{#field_moneda_id#} <span class="text-danger bold">*</span> : </label>
                    <div class="input-group">
                        <select class="form-control m-select2 select2_general"
                                name="item[moneda_id]" id="type_select_estado"
                                data-placeholder="{#field_holder_moneda_id#}" {$privFace.input}
                                required
                                data-fv-not-empty___message="{#glFieldRequired#}"
                        >
                            <option></option>
                            {html_options options=$cataobj.moneda selected=$item.moneda_id}
                        </select>
                    </div>
                    <span class="form-text text-black-50">{#field_msg_moneda_id#}</span>
                </div>
                <div class="col-lg-4">
                    <label>{#field_monto#} :</label>
                    <div class="input-group">
                        <input type="text" class="form-control number_decimal input_money text-right pr-5 "
                               name="item[monto]" value="{$item.monto|escape:"html"}"
                               data-fv-not-empty___message="{#glFieldRequired#}"
                        >
                        <div class="input-group-append"><span class="input-group-text field_money"><i class="fas fa-money-bill-alt"></i></span></div>
                    </div>
                    <span class="form-text text-black-50">{#field_msg_monto#}</span>
                </div>
                <div class="col-lg-4">
                    <label>{#field_monto_bs#} :</label>
                    <div class="input-group">
                        <input type="text" class="form-control number_decimal input_money text-right pr-5"
                               name="item[monto_bs]" value="{$item.monto_bs|escape:"html"}"
                               data-fv-not-empty___message="{#glFieldRequired#}"
                        >
                        <div class="input-group-append"><span class="input-group-text field_money"><i class="fas fa-money-bill-alt"></i></span></div>
                    </div>
                    <span class="form-text text-black-50">{#field_msg_monto_bs#}</span>
                </div>
                {* ------------------------------------------ *}

                {*
                <div class="col-lg-6">
                    <label>{#field_plazo_vigencia#}:</label>
                    <div class="input-group">
                        <input type="text" class="form-control"
                               name="item[plazo_vigencia]" value="{$item.plazo_vigencia|escape:"html"}"
                               data-fv-not-empty___message="{#glFieldRequired#}"
                               minlength="3"
                               data-fv-string-length___message="{#field_length_plazo_vigencia#}"
                        >
                        <div class="input-group-append"><span class="input-group-text"><i class="fas fa-calendar-check"></i></span></div>
                    </div>
                    <span class="form-text text-primary">{#field_msg_plazo_vigencia#}</span>
                </div>
                *}

                <div class="col-lg-6">
                    <label>{#field_proyecto_preinversion#}:</label>
                    <div class="input-group">
                        <input type="text" class="form-control text-right pr-5 number_integer"
                               name="item[proyecto_preinversion]" value="{$item.proyecto_preinversion|escape:"html"}"

                               data-fv-not-empty___message="{#glFieldRequired#}"
                        >
                        <div class="input-group-append"><span class="input-group-text field_number"><i class="fas fa-building"></i></span></div>
                    </div>
                    <span class="form-text text-black-50">{#field_Msg_proyecto_inversion#}</span>
                </div>
                <div class="col-lg-6">
                    <label>{#field_proyecto_inversion#} :</label>
                    <div class="input-group">
                        <input type="text" class="form-control text-right pr-5 number_integer"
                               name="item[proyecto_inversion]" value="{$item.proyecto_inversion|escape:"html"}"
                               data-fv-not-empty___message="{#glFieldRequired#}"
                        >
                        <div class="input-group-append"><span class="input-group-text field_number"><i class="fas fa-building"></i></span></div>
                    </div>
                    <span class="form-text text-black-50">{#field_Msg_proyecto_inversion#}</span>
                </div>

                <div class="col-lg-6">
                    <label>{#field_avance_financiero#} (<span class="text-danger bold">%</span>):</label>
                    <div class="input-group">
                        <input type="text" class="form-control text-right pr-5 number_decimal"
                               name="item[avance_financiero]" value="{$item.avance_financiero|escape:"html"}"
                               data-fv-not-empty___message="{#glFieldRequired#}"
                        >
                        <div class="input-group-append"><span class="input-group-text field_number"><i class="fas fa-percent"></i></span></div>
                    </div>
                    <div class="progress">
                        <div class="progress-bar" role="progressbar" style="width: {$item.avance_financiero|escape:"html"}%;">{$item.avance_financiero|escape:"html"}%</div>
                    </div>
                    <span class="form-text text-black-50">{#field_Msg_avance_financiero#}</span>
                </div>

                <div class="col-lg-6">
                    <label>{#field_avance_fisico#} (<span class="text-danger bold">%</span>):</label>
                    <div class="input-group">
                        <input type="text" class="form-control text-right pr-5 number_decimal"
                               name="item[avance_fisico]" value="{$item.avance_fisico|escape:"html"}"
                               data-fv-not-empty___message="{#glFieldRequired#}"
                        >
                        <div class="input-group-append"><span class="input-group-text field_number"><i class="fas fa-percent"></i></span></div>
                    </div>
                    <div class="progress">
                        <div class="progress-bar" role="progressbar" style="width: {$item.avance_fisico|escape:"html"}%;" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100">{$item.avance_fisico|escape:"html"}%</div>
                    </div>
                    <span class="form-text text-black-50">{#field_Msg_avance_fisico#}</span>
                </div>
                <div class="col-lg-12">
                    <label>{#field_descripcion#} </label>
                    <div class="m-input-icon m-input-icon--right">
                        <div class="summernote" id="descripcion">{$item.descripcion}</div>
                        <input class="form-control m-input" type="hidden" name="item[descripcion]" id="descripcion_input" {$privFace.input}>
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