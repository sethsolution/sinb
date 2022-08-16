{include file="form/form.css.tpl"}

<form class="m-form m-form--fit m-form--label-align-right" method="POST"  action="{$getModule}"  id="form_modal_interface_{$subcontrol}">
<input type="hidden" name="item_id" value="{$item_id}">

    <div class="modal-body">
        <div class="alert alert-primary" role="alert">
            {if $type == 'new'}Nuevo{else}Editar{/if} Grupo del Sistema
        </div>



        <div class="form-group row">
            <div class="col-lg-3">
                <label for="recipient-name" class="form-control-label">Activado:</label>
                <div class="col-lg-6">
                    <span class="m-switch">
                        <label><input type="checkbox" {if $item.activo == 1}checked="checked"{/if} name="item[activo]" value="1"  id="activo"/><span></span></label>
                    </span>
                </div>
             </div>
            <div class="col-lg-3">
                <label for="recipient-name" class="form-control-label">Principal:</label>
                <div class="col-lg-9">
                    <span class="m-switch m--succes">
                        <label><input type="checkbox" {if $item.principal == 1}checked="checked"{/if} name="item[principal]" value="1"  id="principal"/><span></span></label>
                    </span>
                </div>
            </div>
        </div>

        <div class="form-group row">
            <div class="col-lg-4">
                <label>Nombre</label>
                <input type="text" class="form-control m-input" placeholder="Ingrese el nombre del grupo" name="item[nombre]"
                       value="{$item.nombre|escape:"html"}" data-msg="Campo requerido" required minlength="2">

            </div>
            <div class="col-lg-4">
                <label>Orden</label>
                <div class="m-input-icon m-input-icon--right">
                    <input type="text" class="form-control m-input numero_entero" placeholder="Ingrese el Orden" name="item[orden]" value="{$item.orden|escape:"html"}"
                           minlength="1" maxlength="2" data-msg="Campo requerido">
                    <span class="m-input-icon__icon m-input-icon__icon--right"><span><i class="la la-pencil-square-o"></i></span></span>
                </div>
            </div>
            <div class="col-lg-4">
                <label>Class Icono</label>
                <div class="m-input-icon m-input-icon--right">
                    <input type="text" class="form-control m-input" placeholder="Ingrese el icono class" name="item[class]"  value="{$item.class|escape:"html"}">
                    <span class="m-input-icon__icon m-input-icon__icon--right"><span><i class="la la-pencil-square-o"></i></span></span>
                </div>
            </div>
        </div>
        <div class="form-group row">
            <div class="col-lg-12">
                <label>Descripción </label>
                <div class="m-input-icon m-input-icon--right">
                    <div class="summernote" id="descripcion">{$item.descripcion}</div>
                    <input class="form-control m-input" type="hidden" name="item[descripcion]" id="descripcion_input" {$privFace.input}>

                </div>
            </div>
        </div>
    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-secondary" id="form_modal_close_{$subcontrol}" data-dismiss="modal">Cerrar</button>
        <button type="button" class="btn btn-primary" id="form_modal_submit_{$subcontrol}">Guardar</button>
    </div>
</form>

{include file="form/form.js.tpl"}
