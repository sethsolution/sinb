{include file="form/form.css.tpl"}

<form class="m-form m-form--fit m-form--label-align-right" method="POST"  action="{$getModule}"  id="form_modal_interface_{$subcontrol}">
<input type="hidden" name="item_id" value="{$item_id}">
    <div class="modal-body">
        <div class="alert alert-focus" role="alert">
            {if $type == 'new'}Nuevo{else}{if $privFace.editar == 1}Editar{else}Ver Datos{/if}{/if} Archivo
        </div>

        <div class="form-group m-form__group row ">
                <label>Nombre:</label>
                <div class="input-group " >
                    <input type="text" class="form-control m-input" placeholder="Ingrese el Nombre / Titulo, del archivo"
                           name="item[nombre]" name=""
                           value="{$item.nombre|escape:'html'}" {$privFace.input}
                           minlength="2"
                           data-msg="Campo requerido" required
                    >
                </div>
        </div>

        <div class="form-group m-form__group row">

            <label>Descripción:</label>
            <div class="input-group " >
                <input type="text" class="form-control m-input"  {$privFace.input} placeholder="Ingrese la descripción del archivo" name="item[descripcion]" name="" value="{$item.descripcion|escape:'html'}">
            </div>

        </div>

        <div class="form-group m-form__group row">
                <label  for="recipient-name" class="form-control-label">Archivo</label>
                <div class="custom-file">
                    <input type="file" class="form-control m-input custom-file-input"
                           placeholder="Ingrese el archivo"
                           name="input_archivo"
                           id="input_archivo"
                           accept="application/pdf,image/*,application/msword,application/vnd.ms-excel,application/xml,application/zip,application/x-rar-compressed,application/vnd.ms-powerpoint,text/csv,application/rtf,application/vnd.visio,application/x-7z-compressed"
                            {if $type == 'new'}
                                minlength="2"
                                data-msg="Campo requerido" required
                            {/if}
                           {$privFace.input} name="" value="{$item.descripcion|escape:'html'}">
                    <label class="custom-file-label" for="input_archivo">Seleccione un archivo</label>
                </div>

                <div><span class="m-form__help">
                    {if $type == 'update'}<span class="m--font-focus">SOLO si quiere actualizar el archivo, seleccione uno nuevo. </span>{/if}
                        Puede subir solo archivos en formato <strong>PDF</strong> (.pdf)
                    <br>
                        {if $type == 'update'}
                            <strong>Archivo:</strong> <span class="m--font-success">{$item.adjunto_nombre}</span>
                        {/if}

                    </span>
                </div>
        </div>

    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-secondary" id="form_modal_close_{$subcontrol}" data-dismiss="modal">Cerrar</button>
        {if $privFace.editar == 1}
        <button type="button" class="btn btn-focus" id="form_modal_submit_{$subcontrol}">Guardar</button>
        {/if}
    </div>
</form>

{include file="form/form.js.tpl"}
