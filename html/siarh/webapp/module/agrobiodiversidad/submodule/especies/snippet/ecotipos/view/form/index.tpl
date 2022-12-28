{include file="form/index.css.tpl"}
<form class="m-form m-form--state m-form--fit m-form--label-align-right" method="POST" action="{$getModule}" id="general_form" autocomplete="off">
    <div class="modal-header">
        <h4 class="modal-title">Datos de ecotipo</h4>
    </div>

    <div class="modal-body">
        <div class="form-group m-form__group row">
            <div class="col-lg-12">
                <label>Nombre</label>
                <input type="hidden" name="item[espe_itemid]" id="txtEspecieId" value="{$id|escape:"html"}" required>
                <input class="form-control m-input" type="text" name="item[nombre]" id="txtNombre" value="{$item.nombre|escape:"html"}" {$privFace.input} required>
            </div>
        </div>

        <div class="form-group m-form__group row">
            <div class="col-lg-12">
                <label>Descripción</label>
                <textarea class="form-control m-input" name="item[descrip]" id="txtDescrip" rows="4">{$item.descrip|escape:"html"}</textarea>
            </div>
        </div>
    </div>

    <div class="modal-footer">
        <button type="button" class="btn btn-secondary btn-block-custom" data-dismiss="modal" id="btn_modal_close">Cerrar</button>
        <button type="button" class="btn btn-primary btn-block-custom" id="general_submit"><i class="fa fa-check"></i>&nbsp;{if $type == 'new'}Guardar{else}Actualizar{/if}</button>
    </div>
</form>
{include file="form/index.js.tpl"}