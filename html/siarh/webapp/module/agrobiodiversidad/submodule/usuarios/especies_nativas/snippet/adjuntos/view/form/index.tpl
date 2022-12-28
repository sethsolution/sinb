{include file="form/index.css.tpl"}
<form class="m-form m-form--state m-form--fit m-form--label-align-right" method="POST" action="{$getModule}" id="general_form" autocomplete="off">
    <input type="hidden" name="item[espenativa_itemid]" id="txtEspecieId" value="{$id|escape:"html"}" required>
    <div class="modal-header">
        <h4 class="modal-title">Datos de archivo adjunto</h4>
    </div>

    <div class="modal-body">
        <div class="form-group m-form__group row">
            <div class="col-lg-12">
                <label>Archivo adjunto</label>
                <div class="custom-file">
                    <input type="file" class="custom-file-input" placeholder="Seleccione un archivo" name="adjunto" id="fileArchivoAdjunto" {if $type == 'new'} minlength="2" required data-msg="Campo requerido. Seleccione un archivo." {/if} value="{$item.adjunto_nombre|escape:'html'}">
                    <label class="custom-file-label selected" for="fileArchivoAdjunto">Seleccione un archivo</label>
                    
                </div>
            </div>
        </div>
        <div class="form-group m-form__group row">
            <div class="col-lg-12">
                <label>Descripción</label>
                <textarea class="form-control m-input" name="item[descrip]" id="txtDescrip" rows="3">{$item.descrip|escape:"html"}</textarea>
            </div>
        </div>
    </div>

    <div class="modal-footer">
        <button type="button" class="btn btn-secondary btn-block-custom" data-dismiss="modal" id="btn_modal_close">Cerrar</button>
        <button type="button" class="btn btn-primary btn-block-custom" id="general_submit"><i class="fa fa-check"></i>&nbsp;{if $type == 'new'}Guardar{else}Actualizar{/if}</button>
    </div>
</form>
{include file="form/index.js.tpl"}