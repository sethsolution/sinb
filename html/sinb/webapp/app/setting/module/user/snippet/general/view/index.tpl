{include file="index.css.tpl"}
<div class="card card-custom gutter-b example example-compact">
    <div class="card-header py-3">
        <div class="card-title">
            <span class="card-icon"><i class="flaticon2-next text-dark-25"></i></span>
            <h3 class="card-label text-dark-50">{#title#}</h3>
        </div>
    </div>

    <div class="card-body pt-0 pb-0 pl-5 pr-5">
        <div class="alert alert-custom fade show pt-1 pb-1 pl-5 pr-5 ayuda" role="alert">
            <div class="alert-icon">
                <i class="flaticon-notes"></i>
            </div>
            <div class="alert-text text-justify text-dark-65" >
                {#message#}
            </div>

        </div>
    </div>

    <!--begin::Form-->
    <form method="POST"
          action="{$path_url}/{$subcontrol}_/{if $type=="update"}{$id}/{/if}save/"
          id="general_form">

        <div class="card-body pt-0 pb-0">

            <div class="form-group row">
                <div class="col-lg-6">
                    <label>{#fieldUserName#}  <span class="text-danger bold">*</span> :</label>
                    <div class="input-group">
                        <input type="text" class="form-control"
                               name="item[username]" value="{$item.username|escape:"html"}"
                               required
                               data-fv-not-empty___message="{#glFieldRequired#}"

                        >
                        <div class="input-group-append"><span class="input-group-text"><i class="fa fa-user"></i></span></div>
                    </div>
                    <span class="form-text text-muted">{#fieldUserNameMsg#}</span>
                </div>

                <div class="col-lg-6">
                    <label>{#fieldPass#} <span class="text-danger bold">*</span> :</label>
                    <div class="input-group">
                        <input type="text" class="form-control"
                               name="item[password]"
                               placeholder=""
                               {if $type == 'new'}
                                    required
                                    data-fv-not-empty___message="{#glFieldRequired#}"
                                {/if}
                               minlength="3"
                               data-fv-string-length___message="{#fieldPassLength#}"
                        >
                        <div class="input-group-append"><span class="input-group-text"><i class="fa fa-unlock-alt"></i></span></div>
                    </div>
                    {if $type == 'new'}
                        <span class="form-text text-muted">{#fieldPassMsg#}</span>
                    {else}
                        <span class="form-text text-muted">{#fieldPassUpdateMsg#}</span>
                    {/if}
                </div>
                <div class="col-lg-4">
                    <label>{#fieldName#}  <span class="text-danger bold">*</span> :</label>
                    <div class="input-group">
                        <input type="text" class="form-control"
                               name="item[name]" value="{$item.name|escape:"html"}"
                               required
                               data-fv-not-empty___message="{#glFieldRequired#}"
                               minlength="3"
                               data-fv-string-length___message="{#fieldNameLength#}"
                        >
                        <div class="input-group-append"><span class="input-group-text"><i class="fa fa-user"></i></span></div>
                    </div>
                    <span class="form-text text-muted">{#fieldNameMsg#}</span>
                </div>


                <div class="col-lg-4">
                    <label>{#fieldLastName#} <span class="text-danger bold">*</span> :</label>
                    <div class="input-group">
                        <input type="text" class="form-control"
                               name="item[last_name]"
                               value="{$item.last_name|escape:"html"}"
                               placeholder=""
                               required
                               data-fv-not-empty___message="{#glFieldRequired#}"
                               minlength="3"
                               data-fv-string-length___message="{#fieldLastNameLength#}"
                        >
                        <div class="input-group-append"><span class="input-group-text"><i class="fa fa-user"></i></span></div>
                    </div>
                    <span class="form-text text-muted">{#fieldLastNameMsg#}</span>
                </div>
                <div class="col-lg-4">
                    <label>{#fieldType#} <span class="text-danger bold">*</span>: </label>
                    <div class="input-group">
                        <select class="form-control m-select2 select2_general"
                                name="item[type]" id="type"
                                data-placeholder="{#field_Holder_type#}" {$privFace.input}
                                required
                                data-fv-not-empty___message="{#glFieldRequired#}"
                        >
                            <option></option>
                            {html_options options=$cataobj.type selected=$item.type}
                        </select>



                    </div>
                    <span class="form-text text-muted">{#field_GroupMsg_type#}</span>
                </div>

                <div class="col-lg-4">
                    <label>{#fieldPhone#} :</label>
                    <div class="input-group">
                        <input type="text" class="form-control number_integer"
                               name="item[phone]" value="{$item.phone|escape:"html"}"
                               minlength="3"
                               data-fv-string-length___message="{#fieldPhoneLength#}"
                        >
                        <div class="input-group-append"><span class="input-group-text"><i class="fa fa-phone"></i></span></div>
                    </div>
                    <span class="form-text text-muted">{#fieldPhoneMsg#}</span>
                </div>

                <div class="col-lg-4">
                    <label>{#fieldMobile#}:</label>
                    <div class="input-group">
                        <input type="text" class="form-control number_integer"
                               name="item[mobile]" value="{$item.mobile|escape:"html"}"
                               minlength="3"
                               data-fv-string-length___message="{#fieldMobileLength#}"
                        >
                        <div class="input-group-append"><span class="input-group-text"><i class="fa fa-phone"></i></span></div>
                    </div>
                    <span class="form-text text-muted">{#fieldMobileMsg#}</span>
                </div>

                <div class="col-lg-4">
                    <label>{#fieldActiveName#}:</label>
                    <div class="input-group">
                    <span class="switch switch-icon">
                        <label><input type="checkbox" {if $item.active == 1}checked="checked"{/if} name="item[active]" value="1" ><span></span></label>
                    </span>
                    </div>
                    <span class="form-text text-muted">{#fieldActiveMsg#}</span>
                </div>

                <div class="col-lg-12">
                    <label>{#fieldDescription#}:</label>
                    <div class="input-group">
                        <textarea rows="2" class="form-control m-input"
                                  name="item[description]" value="{$item.description|escape:"html"}"
                        >{$item.description|escape:'html'}</textarea>
                    </div>
                    <span class="form-text text-muted">{#fieldDescriptionMsg#}</span>
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