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

                <div class="col-lg-12">
                    <label>{#fieldGroup#} <span class="text-danger bold">*</span> : </label>
                    <div class="input-group">
                        <select class="form-control m-select2 select2_general" name="item[app_group_id]" id="app_group_id"
                                data-placeholder="{#fieldGroupHolder#}" {$privFace.input}
                                required
                                data-fv-not-empty___message="{#glFieldRequired#}"
                        >
                            <option></option>
                            {html_options options=$cataobj.group selected=$item.app_group_id}
                        </select>
                    </div>
                    <span class="form-text text-black-50">{#fieldGroupMsg#}</span>
                </div>

                <div class="col-lg-7">
                    <label>{#fieldName#} <span class="text-danger bold">*</span> :</label>
                    <div class="col-lg-12 ">
                        <input type="text" class="form-control"
                               name="item[name]"
                               value="{$item.name|escape:"html"}"
                               placeholder=""
                               required
                               data-fv-not-empty___message="{#glFieldRequired#}"
                               minlength="3"
                               data-fv-string-length___message="{#fieldNameLength#}"
                        >
                        <span class="form-text text-black-50">{#fieldNameMsg#}</span>
                    </div>
                </div>

                <div class="col-lg-5">
                    <label>{#fielClass#} :</label>
                    <div class="col-lg-12 ">
                        <div class="input-group">
                            <input type="text" class="form-control"
                                   name="item[class]" value="{$item.class|escape:"html"}"
                            >
                            <div class="input-group-prepend"><span class="input-group-text"><i class="fas fa-images text-primary"></i></span></div>
                        </div>
                        <span class="form-text text-black-50">{#fielClassMsg#}</span>
                    </div>
                </div>

                <div class="col-lg-4">
                    <label>{#fieldActive#}:</label>
                    <div class="input-group">
                    <span class="switch switch-icon">
                        <label><input type="checkbox" {if $item.active == 1}checked="checked"{/if} name="item[active]" value="1" id="active"><span></span></label>
                    </span>
                    </div>
                    <span class="form-text text-muted">{#fieldActiveMsg#}</span>
                </div>

                <div class="col-lg-4">
                    <label>{#fieldTarget#}:</label>
                    <div class="input-group">
                    <span class="switch switch-icon">
                        <label><input type="checkbox" {if $item.target == 1}checked="checked"{/if} name="item[target]" value="1" id="target"><span></span></label>
                    </span>
                    </div>
                    <span class="form-text text-muted">{#fieldTargetMsg#}</span>
                </div>

                <div class="col-lg-4">
                    <label>{#fielOrder#}  <span class="text-danger bold">*</span> :</label>
                    <div class="col-lg-12 ">
                        <div class="input-group">
                            <input type="text" class="form-control number_integer"
                                   name="item[order]" value="{$item.order|escape:"html"}"
                                   required
                                   data-fv-not-empty___message="{#glFieldRequired#}"
                            >
                            <div class="input-group-prepend"><span class="input-group-text"><i class="ki ki-double-arrow-back text-primary"></i></span></div>
                        </div>
                        <span class="form-text text-black-50">{#fielOrderMsg#}</span>
                    </div>
                </div>

                <div class="col-lg-4">
                    <label>{#fielType#}: <span class="text-danger bold">*</span></label>
                    <div class="input-group" >
                        <select class="form-control select2_general" name="item[type]"
                                required
                                data-fv-not-empty___message="{#glFieldRequired#}"
                                id="type_select" data-placeholder="{#fielTypeHolder#}">
                            <option></option>
                            {html_options options=$cataobj.tipo selected=$item.type}
                        </select>
                    </div>
                </div>

                <div class="col-lg-8 {if $item.type != 'module'}d-none{/if}" id="folder_div">
                    <label>{#fielFolder#}</label>
                    <div class="col-lg-12 ">
                        <input type="text" class="form-control"
                               name="item[folder]"
                               value="{$item.folder|escape:"html"}"
                        >
                        <span class="form-text text-black-50">{#fielFolderMsg#}</span>
                    </div>
                </div>

                <div class="col-lg-8 {if $item.type != 'url'}d-none{/if}" id="url_div">
                    <label>URL :</label>
                    <div class="col-lg-12 ">
                        <input type="text" class="form-control"
                               name="item[url]"
                               value="{$item.url|escape:"html"}"
                        >
                        <span class="form-text text-black-50">Ingrese la URL</span>
                    </div>
                </div>


                <div class="col-lg-12">
                    <label>{#fieldDescription#} </label>
                    <div class="m-input-icon m-input-icon--right">
                        <div class="summernote" id="description">{$item.description}</div>
                        <input class="form-control m-input" type="hidden" name="item[description]" id="description_input" {$privFace.input}>
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
