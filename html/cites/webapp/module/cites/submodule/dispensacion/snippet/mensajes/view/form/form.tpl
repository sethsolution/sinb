{include file="form/form.css.tpl"}

<form class="m-form m-form--fit m-form--label-align-right" method="POST"
      action="{$path_url}/{$subcontrol}_/{$item_id}/{if $type=="update"}{$id}/{/if}guardar/"
      id="form_modal_interface_{$subcontrol}">

    <div class="modal-body">
        {if $item.itemId != "" or $type == 'new'}
        <div class="alert alert-focus" role="alert">
            {if $type == 'new'}Nuevo{else} {if $privFace.editar == 1}Editar{else}Ver Datos{/if}{/if} Registro
        </div>

        <div class="form-group m-form__group row ">
                <label>Mensaje:</label>
                <div class="input-group " >
                    <input type="text" class="form-control m-input" placeholder="Ingrese el mensaje"
                           name="item[mensaje]" name="" {$privFace.input}
                           value="{$item.mensaje|escape:'html'}"
                           minlength="2"
                           data-msg="Campo requerido" required
                    >
                </div>
        </div>
    </div>
    {else}
    <strong>El registro no existe.</strong>
    {/if}
    <div class="modal-footer">
        <button type="button" class="btn btn-secondary" id="form_modal_close_{$subcontrol}" data-dismiss="modal">Cerrar</button>
        {if $privFace.editar == 1}
        <button type="button" class="btn btn-focus" id="form_modal_submit_{$subcontrol}">Guardar</button>
        {/if}
    </div>
</form>

{include file="form/form.js.tpl"}
