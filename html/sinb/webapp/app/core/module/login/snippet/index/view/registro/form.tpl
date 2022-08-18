{include file="registro/form.css.tpl"}

<form class="m-form m-form--fit m-form--label-align-right" method="POST"  action="{$getModule}"  id="form_modal_interface_{$subcontrol}">
    <input type="hidden" name="item_id" value="{$item_id}">

    <div class="modal-body">
        <div class="alert alert-brand" role="alert">
            Registro de Nuevo Usuario
        </div>

        <div class="form-group m-form__group row ">
            <label>Email:</label>
            <div class="input-group " >
                <input type="text" class="form-control" placeholder="Ingrese el Nombre / Titulo, del archivo"
                       name="item[nombre]" name=""
                       value="{$item.nombre|escape:"html"}"
                       minlength="2"
                       data-msg="Required field" required
                >
            </div>
        </div>


        <div class="form-group m-form__group row ">
            <label>Email:</label>
            <div class="input-group " >
                <input type="text" class="form-control" placeholder="Email"
                       name="item[email1]"
                       value="{$item.nombre|escape:"html"}"
                       minlength="2"
                       data-msg="Required field" required
                >
            </div>
        </div>

        <div class="form-group m-form__group row ">
            <label>Email Confirmar:</label>
            <div class="input-group " >
                <input type="text" class="form-control" placeholder="Email Confirmar"
                       name="item[email2]"
                       value="{$item.nombre|escape:"html"}"
                       minlength="2"
                       data-msg="Required field" required
                >
            </div>
        </div>

        {*
                <div class="form-group m-form__group row">
                    <label for="recipient-name" class="form-control-label">Nombre / Titulo:</label>
                    <input type="text" class="form-control" placeholder="Ingrese el Nombre / Titulo, del archivo"
                           name="item[nombre]" name=""
                           value="{$item.nombre|escape:"html"}"
                           minlength="2"
                           required
                           >
                </div>
        *}

        <div class="form-group m-form__group row">

            <label>Descripción:</label>
            <div class="input-group " >
                <input type="text" class="form-control" placeholder="Ingrese la descripción del archivo" name="item[descripcion]" name="" value="{$item.descripcion|escape:"html"}">
            </div>

        </div>

        <div class="form-group m-form__group row">
            <label  for="recipient-name" class="form-control-label">Archivo</label>
            <div class="custom-file">
                <input type="file" class="form-control custom-file-input"
                       placeholder="Ingrese el archivo"
                       name="input_archivo"
                       id="input_archivo"
                       accept="application/pdf"
                        {if $type eq 'new'}
                            minlength="2"
                            data-msg="Required field" required
                        {/if}
                       name="" value="{$item.descripcion|escape:"html"}">
                <label class="custom-file-label" for="input_archivo">Seleccione un archivo</label>
            </div>

            <div><span class="m-form__help">
                    {if $type eq 'update'}<span class="m--font-focus">SOLO si quiere actualizar el archivo, seleccione uno nuevo. </span>{/if}
                    Puede subir solo archivos en formato <strong>PDF</strong> (.pdf)
                    <br>
                    {if $type eq 'update'}
                        <strong>Archivo:</strong> <span class="m--font-success">{$item.adjunto_nombre}</span>
                    {/if}

                </span>
            </div>
        </div>

    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-secondary" id="form_modal_close_{$subcontrol}" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary" id="form_modal_submit_{$subcontrol}">Save</button>
    </div>
</form>

{include file="registro/form.js.tpl"}