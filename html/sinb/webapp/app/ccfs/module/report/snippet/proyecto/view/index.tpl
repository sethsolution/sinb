{include file="index.css.tpl"}
<div class="card card-custom gutter-b example example-compact">


    <div class="card-header py-3">
        <div class="card-title">
            <span class="card-icon"><i class="flaticon2-next text-dark-25"></i></span>
            <h3 class="card-label text-primary">{#title#}</h3>
        </div>
    </div>
    <!--begin::Form-->
    <form method="POST"
          action="{$path_url}/{$subcontrol}_/{if $type=="update"}{$id}/{/if}consult/"
          id="general_form">

        <div class="card-body  pt-1 pb-0 programa" >
            <div class="form-group row  pt-0 pb-0 mb-0">

                <div class="col-lg-6">
                    <label>{#field_departamento_id#} : </label>
                    <div class="input-group">
                        <select class="form-control m-select2 select2_general"
                                name="item[departamento_id][]" id="departamento_id"
                                data-placeholder="{#field_holder_departamento_id#}"
                                multiple
                                data-fv-not-empty___message="{#glFieldRequired#}"
                        >
                            <option></option>
                            {html_options options=$cataobj.departamento selected=$item.departamento_id}
                        </select>
                    </div>
                    <span class="form-text text-black-50">{#field_msg_departamento_id#}</span>
                </div>

                <div class="col-lg-6">
                    <label>{#field_area_id#} : </label>
                    <div class="input-group">
                        <select class="form-control m-select2 select2_general"
                                name="item[area_id][]" id="type_select_tipo"
                                data-placeholder="{#field_holder_area_id#}"
                                multiple
                                data-fv-not-empty___message="{#glFieldRequired#}"
                        >
                            {*<option value="0">Todos</option>*}
                            <option></option>
                            {html_options options=$cataobj.icas_area selected=$item.area_id}
                        </select>
                    </div>
                    <span class="form-text text-black-50">{#field_GroupMsg_area_id#}</span>
                </div>

                <div class="col-lg-6">
                    <label>{#field_estado_id#} : </label>
                    <div class="input-group">
                        <select class="form-control m-select2 select2_general"
                                name="item[estado_id][]" id="estado_id"
                                data-placeholder="{#field_Holder_estado_id#}"
                                multiple
                                data-fv-not-empty___message="{#glFieldRequired#}"
                        >
                            <option></option>
                            {html_options options=$cataobj.icas_estado selected=$item.estado_id}
                        </select>
                    </div>
                    <span class="form-text text-black-50">{#field_GroupMsg_estado_id#}</span>
                </div>

                <div class="col-lg-6">
                    <label>{#field_fuente_financiamiento_id#}: </label>
                    <div class="input-group">
                        <select class="form-control m-select2 select2_general"
                                name="item[fuente_financiamiento_id][]" id="fuente_financiamiento_id"
                                data-placeholder="{#field_holder_fuente_financiamiento_id#}"
                                multiple
                                data-fv-not-empty___message="{#glFieldRequired#}"
                        >
                            <option></option>
                            {html_options options=$cataobj.financiamiento selected=$item.fuente_financiamiento_id}
                        </select>
                    </div>
                    <span class="form-text text-black-50">{#field_msg_fuente_financiamiento_id#}</span>
                </div>

            </div>
        </div>

        <div class="card-footer">
            {if $privFace.edit == 1}
                <button type="reset" class="btn btn-primary mr-2" id="general_submit">
                   <i class="fas fa-search"></i>  Consultar
                </button>
            {/if}

            <button type="button" class="btn btn-success mr-2" id="print_window">
                <i class="fas fa-magic"></i> Imprimir
            </button>
        </div>

    </form>
    <!--end::Form-->


    <div class="card-body pb-0 pt-1" id="result"></div>
</div>

{include file="index.js.tpl"}