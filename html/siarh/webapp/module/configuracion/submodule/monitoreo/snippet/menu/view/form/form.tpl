{include file="form/form.css.tpl"}

<form class="m-form m-form--fit m-form--label-align-right" method="POST"  action="{$getModule}"  id="form_modal_interface_{$subcontrol}">
    <input type="hidden" name="item_id" value="{$item_id}">

    <div class="modal-body">
        <div class="alert alert-primary" role="alert">
            {if $type == 'new'}Nuevo{else}Editar{/if} - <span id="titulo_moni" value=""></span></div>
        <div>
        <div class="form-group row">
            <div class="col-lg-4 form-group form-md-line-input">
                <label class="col-md-2 control-label" for="form_control_1">Nombre: </label>
                <div class="col-md-12 datos-info">
                    {$item.nombre|escape:'html'}
                </div>
            </div>
            <div class="col-lg-2 form-group form-md-line-input">
                <label class="col-md-2 control-label" for="form_control_1">Orden: </label>
                <div class="col-md-12 datos-info center">
                    {$item.orden|escape:'html'}
                </div>
            </div>
            <div class="col-lg-3">
                <div class="mt-comment-info">
                    <span class="mt-comment-author">Icono:</span>
                </div>
                <div class="mt-comment-text center"> <i class="{$item.class|escape:'html'} m--font-success icono_lista"></i> </div>
            </div>
            <div class="col-lg-3">
                <div class="mt-comment-info">
                    <span class="mt-comment-author">Activo:</span>
                </div>
                <div class="mt-comment-text center"> {if $item.activo == 1 } <span class="m-badge m-badge--success m-badge--wide"></span> SI {else} <span class="m-badge m-badge--danger m-badge--wide"></span> NO {/if}</div>
            </div>
        </div>
        <div class="form-group row">
            <div class="col-lg-3 form-group form-md-line-input">
                <label class="col-md-2 control-label" for="form_control_1">Tipo: </label>
                <div class="col-md-12 datos-info">
                    {$item.tipo|escape:'html'}
                </div>
            </div>
            {if $item.tipo|escape:'html' == 'SB'}
            <div class="col-lg-6 form-group form-md-line-input">
                <label class="col-md-2 control-label" for="form_control_1">Submódulo: </label>
                <div class="col-md-12 datos-info">
                    {$submodulo[$item.submodulo_id]|escape:'html'}
                </div>
            </div>
            {/if}
            {if $item.tipo|escape:'html' == 'INDEX'}
            <div class="col-lg-6 form-group form-md-line-input">
                <label class="col-md-2 control-label" for="form_control_1">Módulo: </label>
                <div class="col-md-12 datos-info">
                    {$cataobj.modulo[$item.modulo_id]|escape:'html'}
                </div>
            </div>
            {/if}
            {if $item.tipo|escape:'html' == 'URL'}
            <div class="col-lg-6 form-group form-md-line-input">
                <label class="col-md-2 control-label" for="form_control_1">URL: </label>
                <div class="col-md-12 datos-info">
                    {$item.url|escape:'html'}
                </div>
            </div>
            {/if}
            <div class="col-lg-3 form-group form-md-line-input">
                <label class="col-md-2 control-label" for="form_control_1">Ventana: </label>
                <div class="mt-comment-text center"> {if $item.target == 1 } <span class="m-badge m-badge--success m-badge--wide"></span> SI {else} <span class="m-badge m-badge--danger m-badge--wide"></span> NO {/if}</div>
            </div>
        </div>

        <div class="form-group row">
            <div class="col-lg-2">
                <label for="recipient-name" class="form-control-label">Es SIARH:</label>
                <div class="col-lg-9">
                    <span class="m-switch">
                        <label><input type="checkbox" {if $item.siarh == 1}checked="checked"{/if} name="item[siarh]" value="1"  id="siarh"/><span></span></label>
                    </span>
                </div>
            </div>
            <div class="col-lg-2">
                <label for="recipient-name" class="form-control-label">Público:</label>
                <div class="col-lg-9">
                    <span class="m-switch">
                        <label><input type="checkbox" {if $item.ip_public == 1}checked="checked"{/if} name="item[ip_public]" value="1"  id="ip_public"/><span></span></label>
                    </span>
                </div>
            </div>
        </div>
        
        <div class="form-group row">
            <div class="col-lg-6">
                <label>Lenguaje:</label>
                <input type="text" class="form-control m-input" placeholder="Ingrese el Lenguaje" name="item[lenguaje]"
                       value="{$item.lenguaje|escape:"html"}" data-msg="Campo requerido">
            </div>
            <div class="col-lg-6">
                <label>Framework:</label>
                <input type="text" class="form-control m-input" placeholder="Ingrese el Framework" name="item[framework]"
                       value="{$item.framework|escape:"html"}" data-msg="Campo requerido">
            </div>
        </div>

        <div class="form-group row">
            <div class="col-lg-12">
                <label>Estado de Desarrollo: </label>
                <div class="m-input-icon m-input-icon--right">
                    <div class="summernote" id="estado_desa">{$item.estado_desa}</div>
                    <input class="form-control m-input" type="hidden" name="item[estado_desa]" id="estado_desa_input" {$privFace.input}>

                </div>
            </div>
        </div>

        <div class="form-group row">
            <div class="col-lg-12">
                <label>Responsable Desarrollo: </label>
                <input type="text" class="form-control m-input" placeholder="Ingrese el Responsable" name="item[responsable_desa]"
                       value="{$item.responsable_desa|escape:"html"}" data-msg="Campo requerido">
            </div>
        </div>

        <div class="form-group row">
            <div class="col-lg-12">
                <label>Estado de Gestion de Datos </label>
                <div class="m-input-icon m-input-icon--right">
                    <div class="summernote" id="estado_gest_datos">{$item.estado_gest_datos}</div>
                    <input class="form-control m-input" type="hidden" name="item[estado_gest_datos]" id="estado_gest_datos_input" {$privFace.input}>

                </div>
            </div>
        </div>

        <div class="form-group row">
            <div class="col-lg-12">
                <label>Seguimiento Gestion de Datos: </label>
                <input type="text" class="form-control m-input" placeholder="Ingrese el Responsable" name="item[segui_gest_datos]"
                       value="{$item.segui_gest_datos|escape:"html"}" data-msg="Campo requerido">
            </div>
        </div>
        
    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-secondary" id="form_modal_close_{$subcontrol}" data-dismiss="modal">Cerrar</button>
        <button type="button" class="btn btn-primary" id="form_modal_submit_{$subcontrol}">Guardar</button>
    </div>
</form>

{include file="form/form.js.tpl"}
