{include file="form/form.css.tpl"}

<form class="m-form m-form--fit m-form--label-align-right m-form--group-seperator-dashed" method="POST" action="{$getModule}"  id="form_modal_interface_{$subcontrol}">
    <input type="hidden" name="item_id" value="{$item_id}">

    <div class="modal-body">

        <div class="alert alert-focus" role="alert">
            {if $type == 'new'}Nueva{else}Editar{/if} Origen
        </div>


        <div class="form-group row">
            <div class="col-lg-3">
                <label for="recipient-name" class="form-control-label">Activado:</label>
                <div class="col-lg-6">
                    <span class="m-switch">
                        <label><input type="checkbox"
                                      {if $item.activo == 1 or $item.itemId == ''}
                                          checked="checked"
                                      {/if}
                                      name="item[activo]" value="1"  id="activo"/><span></span></label>
                    </span>
                </div>
            </div>
        </div>

        <div class="form-group">
            <label for="recipient-name" class="form-control-label">Nombre:</label>
            <input type="text" class="form-control m-input" data-msg="Campo requerido"
                   required placeholder="Ingrese el nombre del Origen"
                   name="item[nombre]" {$privFace.input} value="{$item.nombre|escape:"html"}">
        </div>

        <div class="form-group">
            <label for="recipient-name" class="form-control-label">Descripción:</label>
            <textarea class="form-control m-input" data-msg="Campo requerido"
                      required placeholder="Ingrese la descripción del Origen"
                      name="item[descripcion]" {$privFace.input} rows="3">{$item.descripcion|escape:"html"}</textarea>

        </div>

        <div class="form-group">
            <label for="recipient-name" class="form-control-label">Sigla:</label>
            <input type="text" class="form-control m-input" data-msg="Campo requerido"
                   required placeholder="Ingrese la sigla representativa"
                   name="item[sigla]" {$privFace.input} value="{$item.sigla|escape:"html"}">
        </div>



    </div>

    <div class="modal-footer">
        <button type="button" class="btn btn-secondary" id="form_modal_close_{$subcontrol}"  data-dismiss="modal">Cerrar</button>
        {if $privFace.editar == 1}
        <button type="button" class="btn btn-focus" id="form_modal_submit_{$subcontrol}">Guardar</button>
        {/if}
    </div>
</form>

{include file="form/form.js.tpl"}
