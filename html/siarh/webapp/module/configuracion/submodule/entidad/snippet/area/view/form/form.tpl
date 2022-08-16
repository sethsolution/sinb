{include file="form/form.css.tpl"}

<form class="m-form m-form--fit m-form--label-align-right" method="POST"  action="{$getModule}"  id="form_modal_interface_{$subcontrol}">
    <input type="hidden" name="item_id" value="{$item_id}">

    <div class="modal-body">
        <div class="alert alert-primary" role="alert">
            {if $type == 'new'}Nuevo{else}Editar{/if} Area</div>

        <div class="form-group row">
            <div class="col-lg-6">
                <label for="recipient-name" class="form-control-label">Activado:</label>
                <div class="col-lg-9">
                    <span class="m-switch">
                        <label><input type="checkbox" {if $item.activo == 1}checked="checked"{/if} name="item[activo]" value="1"  id="activo"/><span></span></label>
                    </span>
                </div>
            </div>
        </div>

        <div class="form-group row">
            <div class="col-lg-12">
                <label>Dirección</label>
                <div class="m-input-icon m-input-icon--right">
                    <select class="form-control m-select2 select2_general" name="item[direccion_id]" id="direccion" style="width: 100%;"
                            data-placeholder="Elija la Direccion" {$privFace.input} data-msg="Campo requerido" required>
                        <option></option>
                        {html_options options=$cataobj.direccion selected=$item.direccion_id}
                    </select>
                </div>
            </div>
        </div>
        <div class="form-group row">
            <div class="col-lg-12">
                <label>Unidad</label>

                <div class="m-input-icon m-input-icon--right">
                    <select class="form-control m-select2 select3_general" name="item[unidad_id]" id="unidad" style="width: 100%;"
                            data-placeholder="Elija la Unidad" {$privFace.input} data-msg="Campo requerido" required>
                        <option></option>
                        {html_options options=$cataobj.unidad selected=$item.unidad_id}
                    </select>
                </div>
            </div>
        </div>

        <div class="form-group row">
            <div class="col-lg-9">
                <label>Nombre del Area:</label>
                <input type="text" class="form-control m-input" placeholder="Ingrese el nombre del Area" name="item[nombre]"
                       value="{$item.nombre|escape:"html"}" data-msg="Campo requerido">
            </div>
            <div class="col-lg-3">
                <label>Sigla:</label>
                <input type="text" class="form-control m-input" placeholder="Ingrese la sigla" name="item[sigla]" id="sigla"
                       value="{$item.sigla|escape:"html"}" data-msg="Campo requerido">
            </div>
        </div>

    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-secondary" id="form_modal_close_{$subcontrol}" data-dismiss="modal">Cerrar</button>
        <button type="button" class="btn btn-primary" id="form_modal_submit_{$subcontrol}">Guardar</button>
    </div>
</form>

{include file="form/form.js.tpl"}
