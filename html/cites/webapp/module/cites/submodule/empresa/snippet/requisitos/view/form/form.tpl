{include file="form/form.css.tpl"}

<form class="m-form m-form--fit m-form--label-align-right" method="POST"
      action="{$path_url}/{$subcontrol}_/0/{if $type=="update"}{$id}/{/if}guardar/"
      id="form_modal_interface_{$subcontrol}">

    <div class="modal-body">
        {if $item.itemId != "" or $type == 'new'}
        <div class="alert alert-focus" role="alert">
            {if $type == 'new'}Nuevo{else} {if $privFace.editar == 1}Editar{else}Ver Datos{/if}{/if} Requisito
        </div>
        {*******************mensaje de observacion************}
        {if $item.estado_id == 3 and $item.observacion!=""}
            <div class="m-alert m-alert--icon m-alert--icon-solid m-alert--outline alert alert-danger alert-dismissible fade show" role="alert">
                <div class="m-alert__icon">
                    <i class="flaticon-exclamation-2"></i>
                    <span></span>
                </div>
                <div class="m-alert__text">
                    <strong>Observación:</strong> {$item.observacion}
                </div>
                <div class="m-alert__close">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    </button>
                </div>
            </div>
        {/if}
        <div class="form-group">
            <div class="m--padding-5" style="background: #f1fef4;border: 1px solid #cbe5d2;color:#415e49">
                {$item.nombre_requisito|escape:'html'}
            </div>
        </div>

        <div class="form-group">
            <label  for="recipient-name" class="form-control-label">Archivo</label>
            <div class="custom-file">
                <input type="file" class="form-control m-input custom-file-input"
                       placeholder="Ingrese el archivo"
                       name="input_archivo"
                       id="input_archivo"
                       accept="application/pdf,image/jpeg"
                        {if $type == 'new'}
                            minlength="2"
                            data-msg="Campo requerido" required
                        {/if}
                       name="" {$privFace.input} value="{$item.descripcion|escape:'html'}">
                <label class="custom-file-label" for="input_archivo">Seleccione un archivo</label>
            </div>

            <div><span class="m-form__help">
                    {if $type == 'update'}
                        <span class="m-form__help text-info">SOLO si quiere actualizar el archivo, seleccione uno nuevo. </span>
                    {/if}
                        Puede subir solo archivos en formato <strong>PDF</strong> (.pdf) y <strong>JPG</strong> (.jpg)
                    <br>
                        {if $type == 'update' and $item.adjunto_nombre != ""}
                            <strong>Archivo:</strong> <span class="m--font-success">{$item.adjunto_nombre}</span>
                        {/if}

                    </span>
            </div>
        </div>


        <div class="form-group">
            <label>Descripción del Archivo (si corresponde):</label>
            <div class="input-group">
                <input type="text" class="form-control m-input" placeholder="Ingrese la descripción del archivo"
                       name="item[descripcion]" name="" {$privFace.input} value="{$item.descripcion|escape:'html'}">

                <div class="input-group-append">
                    <span class="input-group-text" id="basic-addon2">
                        <i class="fa fa-list-ul"></i>
                    </span>
                </div>
            </div>
            <span class="m-form__help text-info">
                Opcional: Llenar en caso de necesitar realizar alguna aclaración sobre el documento.
             </span>
        </div>



    </div>
    {else}
    <strong>El registro no existe.</strong>
    {/if}
    <div class="modal-footer">
        <button type="button" class="btn btn-secondary" id="form_modal_close_{$subcontrol}" data-dismiss="modal">Cerrar</button>
        {if $privFace.editar == 1}
            <button type="button" class="btn btn-focus" id="form_modal_submit_{$subcontrol}">Guardar y continuar <i class="fa fa-angle-double-right"></i></button>
        {/if}
    </div>
</form>

{include file="form/form.js.tpl"}