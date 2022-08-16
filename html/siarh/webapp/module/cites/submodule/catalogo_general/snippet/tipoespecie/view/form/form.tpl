{include file="form/form.css.tpl"}

<form class="m-form m-form--fit m-form--label-align-right m-form--group-seperator-dashed" method="POST" action="{$getModule}"  id="form_modal_interface_{$subcontrol}">
    <input type="hidden" name="item_id" value="{$item_id}">

    <div class="modal-body">

        <div class="alert alert-focus" role="alert">
            {if $type == 'new'}Nueva{else}Editar{/if} Especie CITES
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
            <label for="recipient-name" class="form-control-label">Nombre Científico:</label>
            <input type="text" class="form-control m-input" data-msg="Campo requerido"
                   required placeholder="Ingrese el nombre científico de la especie"
                   name="item[nombre]" {$privFace.input} value="{$item.nombre|escape:"html"}">
        </div>
        <div class="form-group">
            <label for="recipient-name" class="form-control-label">Nombre Comun:</label>
            <input type="text" class="form-control m-input mayus" data-msg="Campo requerido"
                   required placeholder="Ingrese el nombre comun de la especie"
                   name="item[nombre_comun]" {$privFace.input} value="{$item.nombre_comun|escape:"html"}">
        </div>

        <div class="form-group m-form__group row">
            <div class="col-lg-6 m-form__group-sub">
                <label>Descripción:</label>
                <div class="m-input-icon m-input-icon--right">
                    <input type="text" class="form-control m-input" placeholder="" name="item[descripcion]"  value="{$item.descripcion|escape:"html"}"
                           data-msg="Campo requerido" required minlength="3">
                    <span class="m-input-icon__icon m-input-icon__icon--right"><span><i class="la la-pencil-square-o"></i></span></span>
                </div>
            </div>
            <div class="col-lg-6 m-form__group-sub">
                <label>Apendice:</label>
                <div class="m-input-icon m-input-icon--right">
                    <select style="width: 100%;" class="form-control m-select2 select2_general bigdrop"
                            name="item[apendice_id]"  {$privFace.input} id=""
                            {*required*}
                            data-msg="Campo requerido">
                        <option value="null">Sin Apendice</option>
                        {html_options options=$cataobj.apendice selected=$item.apendice_id}
                    </select>
                    <span class="m-form__help"></span>
                </div>
            </div>
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
