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

                <div class="col-lg-9">
                    <label>{#field_area_id#} <span class="text-danger bold">*</span> : </label>
                    <div class="input-group">
                        <select class="form-control m-select2 select2_general"
                                name="item[area_id]" id="type_select_estado"
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

                <div class="col-lg-12">
                    <label>{#field_titulo#}  <span class="text-danger bold">*</span> :</label>
                    <div class="input-group">
                        <textarea
                            class="form-control m-input mayus"
                            name="item[nombre]" cols="4"
                            required
                            required data-msg="{#glFieldRequired#}"
                            minlength="3"
                            data-fv-string-length___message="{#field_length_titulo#}"
                            {$privFace.input}>{$item.nombre|escape:'html'}
                        </textarea>
                        <div class="input-group-append"><span class="input-group-text"><i class="fas fa-calendar-check"></i></span></div>
                    </div>
                    <span class="form-text text-black-50">{#field_msg_titulo#}</span>
                </div>
                {*                *}
                {*                <div class="col-lg-12">*}
                {*                    <label>{#field_descripcion#} </label>*}
                {*                    <div class="m-input-icon m-input-icon--right">*}
                {*                        <div class="summernote" id="descripcion">{$item.descripcion}</div>*}
                {*                        <input class="form-control m-input" type="hidden" name="item[descripcion]" id="descripcion_input" {$privFace.input}>*}
                {*                    </div>*}
                {*                </div>*}

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