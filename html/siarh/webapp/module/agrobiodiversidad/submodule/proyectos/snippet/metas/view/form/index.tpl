{include file="form/index.css.tpl"}
<form class="m-form m-form--state m-form--fit m-form--label-align-right" method="POST" action="{$getModule}" id="general_form" autocomplete="off">
    <input type="hidden" name="item[proy_itemid]" id="txtProyId" value="{$id}" required>
    
    <div class="modal-header">
        <h4 class="modal-title">Datos de metas de proyecto</h4>
    </div>

    <div class="modal-body">
        <div class="form-group m-form__group row">
            <div class="col-lg-12">
                <label>Detalle</label>
                <select class="form-control m-input select2" name="item[meta_itemid]" id="cboMetaId" data-msg="Campo requerido." required>
                    <option value="">--Seleccione una opción--</option>
                    {html_options options=$cataobj.metas selected=$item.meta_itemid}
                </select>
            </div>
        </div>
        <div class="form-group m-form__group row">
            <div class="col-lg-6">
                <label>Línea base</label>
                <input class="form-control m-input" type="number" name="item[linea_base]" id="txtLineabase" value="{$item.linea_base|escape:'html'}" data-msg="Campo requerido." required>
            </div>
            <div class="col-lg-6">
                <label>Meta</label>
                <input class="form-control m-input" type="number" name="item[meta]" id="txtMeta" value="{$item.meta|escape:'html'}" data-msg="Campo requerido." required>
            </div>
        </div>
    </div>

    <div class="modal-footer">
        <button type="button" class="btn btn-secondary btn-block-custom" data-dismiss="modal" id="btn_modal_close">Cerrar</button>
        <button type="button" class="btn btn-primary btn-block-custom" id="general_submit"><i class="fa fa-check"></i>&nbsp;{if $type == 'new'}Guardar{else}Actualizar{/if}</button>
    </div>
</form>
{include file="form/index.js.tpl"}