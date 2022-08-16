{include file="form/form.css.tpl"}

<form class="m-form m-form--fit m-form--label-align-right" method="POST"  action="{$getModule}"  id="form_modal_interface_{$subcontrol}">
    <input type="hidden" name="item_id" value="{$item_id}">

    <div class="modal-body">
        <div class="alert alert-primary" role="alert">
            {if $type == 'new'}Nuevo{else}Editar{/if} Direccion</div>

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
            <div class="col-lg-9">
                <label>Nombre de la Direccion:</label>
                <input type="text" class="form-control m-input" placeholder="Ingrese el nombre de la Direccion" name="item[nombre]"
                       value="{$item.nombre|escape:"html"}" data-msg="Campo requerido">
            </div>
            <div class="col-lg-3">
                <label>Sigla:</label>
                <input type="text" class="form-control m-input" placeholder="Ingrese la sigla" name="item[sigla]"
                       value="{$item.sigla|escape:"html"}" data-msg="Campo requerido">
            </div>
        </div>

        <div class="form-group row">
            <div class="col-lg-3">
                <label>Cod1:</label>
                <input type="text" class="form-control m-input" placeholder="Ingrese el Codigo 1" name="item[cod1]"
                       value="{$item.cod1|escape:"html"}" data-msg="Campo requerido">
            </div>
            <div class="col-lg-3">
                <label>Cod2:</label>
                <input type="text" class="form-control m-input" placeholder="Ingrese el Codigo 2" name="item[cod2]"
                       value="{$item.cod2|escape:"html"}" data-msg="Campo requerido">
            </div>
            <div class="col-lg-3">
                <label>Cod3:</label>
                <input type="text" class="form-control m-input" placeholder="Ingrese el Codigo 3" name="item[cod3]"
                       value="{$item.cod3|escape:"html"}" data-msg="Campo requerido">
            </div>
            <div class="col-lg-3">
                <label>Cod4:</label>
                <input type="text" class="form-control m-input" placeholder="Ingrese el Codigo 4" name="item[cod4]"
                       value="{$item.cod4|escape:"html"}" data-msg="Campo requerido">
            </div>
        </div>


    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-secondary" id="form_modal_close_{$subcontrol}" data-dismiss="modal">Cerrar</button>
        <button type="button" class="btn btn-primary" id="form_modal_submit_{$subcontrol}">Guardar</button>
    </div>
</form>

{include file="form/form.js.tpl"}
