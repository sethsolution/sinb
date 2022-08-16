{include file="form/form.css.tpl"}

<form class="m-form m-form--fit m-form--label-align-right m-form--group-seperator-dashed" method="POST" action="{$getModule}"  id="form_modal_interface_{$subcontrol}">
    <input type="hidden" name="item_id" value="{$item_id}">

    <div class="modal-body">

        <div class="alert alert-focus" role="alert">
            {if $type == 'new'}Nueva{else}Editar{/if} País
        </div>

        <div class="form-group">
            <label for="recipient-name" class="form-control-label">Nombre del País:</label>
            <input type="text" class="form-control m-input" data-msg="Campo requerido"
                   required placeholder="Ingrese el nombre del país"
                   name="item[nombre]" {$privFace.input} value="{$item.nombre|escape:"html"}">
        </div>

        <div class="form-group">
            <label for="recipient-name" class="form-control-label">Sigla del País:</label>
            <input type="text" class="form-control m-input" data-msg="Campo requerido"
                   required placeholder="Ingrese la sigla del País"
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
