{include file="form/form.css.tpl"}

    {if $item.id != "" or $type == 'new'}
        <form method="POST"
              action="{$path_url}/{$subcontrol}_/{$item_id}/{if $type=="update"}{$id}/{/if}save/"
              id="form_{$subcontrol}">

        <div class="modal-body">
            <div class="alert alert-primary" role="alert">
                {if $type == 'new'}{#glnew#}{else}{#glupdate#}{/if} - {#title#}
            </div>

            <div class="form-group row">
                    <label class="col-2 col-form-label">{#field_app#} <span class="text-danger bold">*</span> : </label>
                    <div class="col-10">
                        <select class="form-control m-select2 select2_general filtro-buscar-form"
                                name="item[mes]" id="mes" data-col-index="0"
                                data-placeholder="{#field_holder_app#}" {$privFace.input}
                                required
                                data-fv-not-empty___message="{#glFieldRequired#}">
                            <option value="3">{#field_all_app#}</option>
                            {html_options options=$cataobj.app selected=$item.mes}
                        </select>
                    </div>
            </div>

            <div class="card-body p-0">
                <input type="hidden" name="item[module]" id="form_module" value="">
                <table class="table {*table-separate table-striped*} form-table table-bordered table-hover table-head-custom table-checkable  table-sm  "
                       id="tabla_{$subcontrol}_form" >
                    <thead class="thead-dark thead-color"><tr>
                        {foreach from=$gridItem item=row key=idx}
                            <th>{$row.label|escape:"html"}</th>
                        {/foreach}
                    </tr></thead>
                    <tbody></tbody>
                    <tfoot></tfoot>
                </table>
            </div>
        </div>
        </form>

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

{include file="form/form.js.tpl"}
