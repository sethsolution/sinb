{include file="form/index.css.tpl"}
<form class="m-form m-form--state m-form--fit m-form--label-align-right" method="POST" action="{$getModule}" id="general_form" autocomplete="off">
    <input type="hidden" name="item[proy_itemid]" id="txtProyId" value="{$id}" required>
    
    <div class="modal-header">
        <h4 class="modal-title">Datos de financiamiento</h4>
    </div>

    <div class="modal-body">
        <div class="form-group m-form__group row">
            <div class="col-lg-6">
                <label>Organismo financiador</label>
                <select class="form-control m-input select2" name="item[financia_itemid]" id="cboFinanciaId" required data-msg="Campo requerido. Seleccione una opción.">
                    <option value="">--Seleccione una opción--</option>
                    {html_options options=$cataobj.proyecto_financiadores selected=$item.financia_itemid}
                </select>
            </div>
            <div class="col-lg-6">
                <label>Monto [Bs.]</label>
                <input class="form-control m-input" type="number" name="item[monto]" id="txtMonto" value="{$item.monto|escape:"html"}" required data-msg="Campo requerido.">
            </div>
        </div>
        <div class="form-group m-form__group row">
            <div class="col-lg-6">
                <label>Tipo</label>
                <select class="form-control m-input select2" name="item[tipo]" id="cboTipo" required data-msg="Campo requerido. Seleccione una opción.">
                    <option value="">--Seleccione una opción--</option>
                    {html_options options=$listaTipos selected=$item.tipo}
                </select>
            </div>
        </div>
    </div>

    <div class="modal-footer">
        <button type="button" class="btn btn-secondary btn-block-custom" data-dismiss="modal" id="btn_modal_close">Cerrar</button>
        <button type="button" class="btn btn-primary btn-block-custom" id="general_submit"><i class="fa fa-check"></i>&nbsp;{if $type == 'new'}Guardar{else}Actualizar{/if}</button>
    </div>
</form>
{include file="form/index.js.tpl"}