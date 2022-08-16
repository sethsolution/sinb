{include file="form/form.css.tpl"}

<form class="m-form m-form--fit m-form--label-align-right" method="POST"  action="{$getModule}"  id="form_modal_interface_{$subcontrol}">
    <input type="hidden" name="item_id" value="{$item_id}">

    <div class="modal-body">
        <div class="alert alert-primary" role="alert">
            {if $type == 'new'}Nuevo{else}Editar{/if} Menu</div>

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
            <div class="col-lg-6">
                <label>Nombre</label>
                <input type="text" class="form-control m-input" placeholder="Ingrese el nombre de la categoria" name="item[nombre]"
                       value="{$item.nombre|escape:"html"}" data-msg="Campo requerido">
            </div>
            <div class="col-lg-6">
                <label>Class</label>
                <input type="text" class="form-control m-input" placeholder="Ingrese la class" name="item[class]"
                       value="{$item.class|escape:"html"}" data-msg="Campo requerido">
            </div>
        </div>
        <div class="form-group row">
            <div class="col-lg-4">
                <label>Categoría tipo: </label>
                <div class="input-group" >
                    <select class="form-control m-input" name="item[tipo]" id="categoria_select" data-placeholder="Elija un Genero">
                        {html_options options=$cataobj.tipo selected=$item.tipo}
                    </select>
                </div>
            </div>
            <div class="col-lg-4">
                <label>Orden</label>
                <input type="text" class="form-control m-input numero_entero" placeholder="Ingrese el orden" name="item[orden]"
                       value="{$item.orden|escape:"html"}"  minlength="1" maxlength="2" data-msg="Campo requerido">
            </div>
            <div class="col-lg-4">
                <label for="recipient-name" class="form-control-label">Abrir en nueva ventada:</label>
                <div class="col-lg-9">
                            <span class="m-switch m-switch--outline m-switch--icon m-switch--primary">
                                <label><input type="checkbox" {if $item.target == 1}checked="checked"{/if} name="item[target]" value="1"  id="target"/><span></span></label>
                            </span>
                </div>
            </div>
        </div>

        <div class="form-group row {if $item.tipo != 'SB'}m--hide{/if}" id="submodulo_div">
            <div class="col-lg-12">
                <label>SUBMODULO DE SUBSISTEMA</label>
                <div class="m-input-icon m-input-icon--right">
                    <select class="form-control m-select2 select2_general" name="item[submodulo_id]" id="submodulo" style="width: 100%;"
                            data-placeholder="Elija la Direccion" {$privFace.input} data-msg="Campo requerido"
                    >
                        <option></option>
                        {html_options options=$opt_item selected=$item.submodulo_id}
                    </select>
                </div>
            </div>
        </div>
        <div class="form-group row {if $item.tipo != 'INDEX' && $type != 'new' }m--hide{/if}" id="modulo_div">
            <div class="col-lg-12">
                <label>SUBSISTEMA</label>
                <div class="m-input-icon m-input-icon--right">
                    <select class="form-control m-select2 select2_general" name="item[modulo_id]" id="modulo" style="width: 100%;"
                            data-placeholder="Elija la Direccion" {$privFace.input} data-msg="Campo requerido"
                    >
                        <option></option>
                        {html_options options=$cataobj.modulo selected=$item.modulo_id}
                    </select>
                </div>
            </div>
        </div>
        <div class="form-group row {if $item.tipo != 'URL'}m--hide{/if}" id="url_div">
            <div class="col-lg-12">
                <label>Url</label>
                <input type="text" class="form-control m-input" placeholder="Ingrese la url" name="item[url]"
                       value="{$item.url|escape:"html"}" data-msg="Campo requerido">
            </div>
        </div>
    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-secondary" id="form_modal_close_{$subcontrol}" data-dismiss="modal">Cerrar</button>
        <button type="button" class="btn btn-primary" id="form_modal_submit_{$subcontrol}">Guardar</button>
    </div>
</form>

{include file="form/form.js.tpl"}
