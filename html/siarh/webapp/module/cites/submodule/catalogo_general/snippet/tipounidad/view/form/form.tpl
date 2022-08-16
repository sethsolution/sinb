{include file="form/form.css.tpl"}

<form class="m-form m-form--fit m-form--label-align-right m-form--group-seperator-dashed" method="POST" action="{$getModule}"  id="form_modal_interface_{$subcontrol}">
    <input type="hidden" name="item_id" value="{$item_id}">

    <div class="modal-body">

        <div class="alert alert-focus" role="alert">
            {if $type == 'new'}Nueva{else}Editar{/if} Unidad
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
            <label for="recipient-name" class="form-control-label">Unidad:</label>
            <input type="text" class="form-control m-input" data-msg="Campo requerido"
                   required placeholder="Ingrese la unidad"
                   name="item[unidad]" {$privFace.input} value="{$item.unidad|escape:"html"}">
        </div>
         <div class="form-group">
            <label for="recipient-name" class="form-control-label">Descripción:</label>
            <input type="text" class="form-control m-input" data-msg="Campo requerido"
                   required placeholder="Ingrese la descripción de la unidad"
                   name="item[nombre]" {$privFace.input} value="{$item.nombre|escape:"html"}">
        </div>
        <div class="form-group">
            <label for="recipient-name" class="form-control-label">Codigo:</label>
            <input type="text" class="form-control m-input" data-msg="Campo requerido"
                   placeholder="Ingrese el codigo de la unidad"
                   name="item[codigo]" {$privFace.input} value="{$item.codigo|escape:"html"}">
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
