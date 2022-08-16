{include file="form/form.css.tpl"}

<form class="m-form m-form--fit m-form--label-align-right" method="POST"
      action="{$path_url}/{$subcontrol}_/{$item_id}/{if $type=="update"}{$id}/{/if}guardar/"
      id="form_modal_interface_{$subcontrol}">

    <div class="modal-body">
        {if $item.itemId != "" or $type == 'new'}
            <div class="alert alert-focus" role="alert">
                {if $type == 'new'}Ingrese{else} {if $privFace.editar == 1}Editar{else}Ver Datos{/if}{/if} los siguientes datos del Depósito bancario
            </div>
            {*******************mensaje de observacion************}
            {if $item.estado_id == 3}
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

            <div class="form-group  m-form row">
                <div class="col-lg-4 m-form__group-sub">
                    <label class="form-control-label">Fecha:</label>
                    <div class="input-group">
                        <input type="text" class="form-control m-input fecha_general"
                               placeholder="Ingrese la fecha"
                               name="item[fecha_pago]"  {$privFace.input}
                               required data-msg="Campo requerido"
                               value="{if $item.fecha_pago}{$item.fecha_pago|date_format:'%d/%m/%Y'}{/if}">
                        <div class="input-group-append"><span class="input-group-text" id="basic-addon2"><i class="flaticon-event-calendar-symbol"></i></span></div>
                    </div>
                </div>
                <div class="col-lg-4 m-form__group-sub">
                    <label class="form-control-label">Monto en Bs:</label>
                    <div class="input-group">
                        <input type="text" class="form-control m-input numero_decimal monto"
                               placeholder="Ingrese el monto"
                               required data-msg="Campo requerido"
                               name="item[monto]"  {$privFace.input} value="{$item.monto|escape:'html'}">
                        <div class="input-group-append"><span class="input-group-text" id="basic-addon2"><i class="fa fa-money-bill"></i></span></div>
                    </div>
                </div>
                <div class="col-lg-4 m-form__group-sub">
                    <label class="form-control-label">Número de Boleta:</label>
                    <div class="input-group">
                        <input type="text" class="form-control m-input numero_entero" placeholder="Ingrese el número"
                               required data-msg="Campo requerido"
                               name="item[numero_boleta]" {$privFace.input} value="{$item.numero_boleta|escape:'html'}">
                        <div class="input-group-append"><span class="input-group-text" id="basic-addon2"><i class="fa fa-money-check"></i></span></div>
                    </div>
                </div>
            </div>

            <div class="form-group  m-form row">
                <div class="col-lg-12 m-form__group-sub">
                    <label class="form-control-label">Nombre de la empresa depositante:</label>
                    <div class="input-group">
                        <input type="text" class="form-control m-input mayus" placeholder="Ingrese el Nombre"
                               name="item[nombre_depositante]" {$privFace.input}
                               value="{$item.nombre_depositante|escape:'html'}"
                               required minlength="2" data-msg="Campo requerido">
                        <div class="input-group-append"><span class="input-group-text" id="basic-addon2"><i class="fa fa-user-tag"></i></span></div>
                    </div>
                </div>
                <div class="col-lg-12 m-form__group-sub">
                    <label class="form-control-label">Adjunte el comprobante del Depósito:</label>
                    <div class="custom-file">
                        <input type="file" class="form-control m-input custom-file-input"
                               placeholder="Ingrese el archivo"
                               name="input_archivo" id="input_archivo"
                               accept="application/pdf,image/jpeg"
                                {if $type == 'new'}
                                    minlength="2" data-msg="Campo requerido" required
                                {/if}
                                {$privFace.input} value="">
                        <label class="custom-file-label" id="archivo_nombre" for="input_archivo">Seleccione un archivo</label>
                    </div>
                    <span class="m-form__help">
                    {if $type == 'update'}<span class="m--font-focsus">SOLO si quiere actualizar el archivo, seleccione uno nuevo. </span>{/if}
                        Puede subir solo archivos en formato <strong>PDF</strong> (.pdf), <strong>JPG</strong> (.jpg)
                    <br>
                        {if $type == 'update'}
                            <strong>Archivo:</strong> <span class="m--font-success">{$item.adjunto_nombre}</span>
                        {/if}
                </span>
                </div>
            </div>

        {else}
            <strong>El registro no existe.</strong>
        {/if}
    </div>
    <div class="modal-footer m-form__actions m-form__actions--solid m-form__actions--left m--padding-top-10 m--padding-bottom-10">
        <button type="button" class="btn btn-secondary" id="form_modal_close_{$subcontrol}" data-dismiss="modal">Cerrar</button>
        {if $privFace.editar == 1}
            <button type="button" class="btn btn-focus" id="form_modal_submit_{$subcontrol}">Guardar y continuar&nbsp;&nbsp;<i class="fa fa-angle-double-right"></i></button>
        {/if}
    </div>
</form>

{include file="form/form.js.tpl"}