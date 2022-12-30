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
                <div class="col-lg-12">
                    <label>{#field_titulo#}<span class="text-danger bold">*</span> :</label>
                    <div class="input-group">
                        <textarea rows="2" class="form-control m-input mayus"
                                  name="item[nombre]"
                                  required
                                  data-fv-not-empty___message="{#glFieldRequired#}"
                        >{$item.nombre|escape:'html'}</textarea>
                        <div class="input-group-append"><span class="input-group-text"><i class="fas fa-calendar-check"></i></span></div>
                    </div>
                    <span class="form-text text-muted">{#field_msg_titulo#}</span>
                </div>

                <div class="col-lg-3">
                    <label>{#field_codigo#}  <span class="text-danger bold">*</span> :</label>
                    <div class="input-group">
                        <input type="text" class="form-control"
                               name="item[codigo]" value="{$item.codigo|escape:"html"}"
                               required
                               data-fv-not-empty___message="{#glFieldRequired#}"
                        >
                        <div class="input-group-append"><span class="input-group-text field_key"><i class="fas fa-key"></i></span></div>
                    </div>
                    <span class="form-text text-black-50">{#field_msg_codigo#}</span>
                </div>

                <div class="col-lg-5">
                    <label>{#field_area_id#} <span class="text-danger bold">*</span> : </label>
                    <div class="input-group">
                        <select class="form-control m-select2 select2_general"
                                name="item[area_id]" id="area_id"
                                data-placeholder="{#field_Holder_area_id#}" {$privFace.input}
                                required
                                data-fv-not-empty___message="{#glFieldRequired#}"
                        >
                            <option></option>
                            {html_options options=$cataobj.icas_area selected=$item.area_id}
                        </select>
                    </div>
                    <span class="form-text text-black-50">{#field_GroupMsg_area_id#}</span>
                </div>
{*                <div class="col-lg-4">*}
{*                    <label>{#field_departamento_id#} <span class="text-danger bold">*</span> : </label>*}
{*                    <div class="input-group">*}
{*                        <select class="form-control m-select2 select2_general"*}
{*                                name="item[departamento_id]" id="departamento_id"*}
{*                                data-placeholder="{#field_Holder_departamento_id#}" {$privFace.input}*}
{*                                required*}
{*                                data-fv-not-empty___message="{#glFieldRequired#}"*}
{*                        >*}
{*                            <option></option>*}
{*                            {html_options options=$cataobj.departamento selected=$item.departamento_id}*}
{*                        </select>*}
{*                    </div>*}
{*                    <span class="form-text text-black-50">{#field_GroupMsg_departamento_id#}</span>*}
{*                </div>*}
            </div>
        </div>

        <div class="card-header py-3">
            <div class="card-title  m-0">
                <span class="card-icon"><i class="flaticon2-next text-dark-25"></i></span>
                <span class="font-weight-bold font-size-h4 text-dark-50">{#title2#}</span>
            </div>
        </div>
        <div class="card-body  pt-1 pb-0 proyecto" >
            <div class="form-group row  pt-0 pb-0 mb-0">
                <div class="col-lg-3">
                    <label>{#field_financiador_id#}<span class="text-danger bold">*</span> : </label>
                    <div class="input-group">
                        <select class="form-control m-select2 select2_general"
                                name="item[fuente_financiamiento_id]" id="type_select_estado"
                                data-placeholder="{#field_Holder_financiador_id#}" {$privFace.input}
                                required
                                data-fv-not-empty___message="{#glFieldRequired#}"
                        >
                            <option></option>
                            {html_options options=$cataobj.financiamiento selected=$item.fuente_financiamiento_id}
                        </select>
                    </div>
                    <span class="form-text text-black-50">{#field_GroupMsg_financiador_id#}</span>
                </div>
                <div class="col-lg-9">
                    <label>{#field_otro_financiamiento#}:</label>
                    <div class="input-group">
                        <input type="text" class="form-control"
                               name="item[fuente_financiamiento_otro]" value="{$item.fuente_financiamiento_otro|escape:"html"}"
{*                               required*}
{*                               data-fv-not-empty___message="{#glFieldRequired#}"*}
                        >
                        <div class="input-group-append"><span class="input-group-text field_info"><i class="fas flaticon-layer"></i></span></div>
                    </div>
                    <span class="form-text text-black-50">{#field_msg_otro_financiamiento#}</span>
                </div>
            </div>
        </div>
        <div class="card-body pt-1 pb-0 ">
            <div class="form-group row">
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
                            {html_options options=$cataobj.icas_estado selected=$item.estado_id}
                        </select>
                    </div>
                    <span class="form-text text-black-50">{#field_GroupMsg_estado_id#}</span>
                </div>
                <div class="col-lg-4">
                    <label>{#field_fecha_inicio#}<span class="text-danger bold">*</span> :</label>
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
        </div>
        </div>
        <div class="card-body pt-1 pb-0">
            <div class="form-group row">
                <div class="col-lg-12">
                    <label>{#field_objetivo_a_j#} </label>
                    <div class="m-input-icon m-input-icon--right">
                        <div class="summernote" id="antecedentes_justificacion">{$item.antecedentes_justificacion}</div>
                        <input class="form-control m-input" type="hidden" name="item[antecedentes_justificacion]" id="a_j_input" {$privFace.input}>
                    </div>
                </div>
                <div class="col-lg-12">
                    <label>{#field_objetivo_g#} </label>
                    <div class="m-input-icon m-input-icon--right">
                        <div class="summernote" id="objetivo_general">{$item.objetivo_general}</div>
                        <input class="form-control m-input" type="hidden" name="item[objetivo_general]" id="general_input" {$privFace.input}>
                    </div>
                </div>
                <div class="col-lg-12">
                    <label>{#field_objetivo_e#} </label>
                    <div class="m-input-icon m-input-icon--right">
                        <div class="summernote" id="objetivos_especificos">{$item.objetivos_especificos}</div>
                        <input class="form-control m-input" type="hidden" name="item[objetivos_especificos]" id="especifico_input" {$privFace.input}>
                    </div>
                </div>

                <div class="col-lg-12">
                    <label>{#field_resultados_e#} </label>
                    <div class="m-input-icon m-input-icon--right">
                        <div class="summernote" id="resultados_esperados">{$item.resultados_esperados}</div>
                        <input class="form-control m-input" type="hidden" name="item[resultados_esperados]" id="resultado_input" {$privFace.input}>
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