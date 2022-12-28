{include file="form/index.css.tpl"}
<form class="m-form m-form--state m-form--fit m-form--label-align-right" method="POST" action="{$getModule}" id="general_form" autocomplete="off">
    <input type="hidden" name="item[proy_itemid]" id="txtProyId" value="{$id}" required>
    
    <div class="modal-header">
        <h4 class="modal-title">Datos de referencia</h4>
    </div>

    <div class="modal-body">
        <div class="form-group m-form__group row">
            <div class="col-lg-12">
                <label>Datos de contacto</label>
                <input class="form-control m-input" type="text" name="item[contacto]" id="txtContacto" value="{$item.contacto|escape:'html'}" data-msg="Campo requerido." required>
            </div>
        </div>
        <div class="form-group m-form__group row">
            <div class="col-lg-6">
                <label>Correo-e</label>
                <input class="form-control m-input" type="email" name="item[email]" id="txtEmail" value="{$item.email|escape:'html'}" data-msg="Campo requerido." required>
            </div>
            <div class="col-lg-6">
                <label>Teléfono</label>
                <input class="form-control m-input" type="number" name="item[telefono]" id="txtTelefono" value="{$item.telefono|escape:'html'}" data-msg="Campo requerido." required>
            </div>
             
        </div>
    </div>

    <div class="modal-footer">
        <button type="button" class="btn btn-secondary btn-block-custom" data-dismiss="modal" id="btn_modal_close">Cerrar</button>
        <button type="button" class="btn btn-primary btn-block-custom" id="general_submit"><i class="fa fa-check"></i>&nbsp;{if $type == 'new'}Guardar{else}Actualizar{/if}</button>
    </div>
</form>
{include file="form/index.js.tpl"}