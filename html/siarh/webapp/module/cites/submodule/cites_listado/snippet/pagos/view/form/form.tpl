{include file="form/form.css.tpl"}

<form class="m-form m-form--fit m-form--label-align-right" method="POST"
      action="{$getModule}"
      id="form_modal_interface_{$subcontrol}">

    <div class="modal-body row">
        {if $item.itemId != "" or $type == 'new'}
            <div class="alert alert-focus col-lg-12" role="alert">
                Ver Datos Registro
            </div>

            <div class="col-lg-6">
                <iframe src="{$getModule}&accion={$subcontrol}_descarga&id={$id}&item_id={$item_id}&tipo=inline"
                        width="100%" height="500px"></iframe>
            </div>

            <div class="col-lg-6">


                <div class="form-group  m-form row">
                    <div class="col-lg-4 m-form__group-sub">
                        <label class="form-control-label">Fecha:</label>
                        <div class="input-group">
                            <input type="text" class="form-control m-input fecha_general"
                                   placeholder="Ingrese la fecha"
                                   name="item[fecha_pago]"  {$privFace.input2}
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
                                   name="item[monto]"  {$privFace.input2} value="{$item.monto|escape:'html'}">
                            <div class="input-group-append"><span class="input-group-text" id="basic-addon2"><i class="fa fa-money-bill"></i></span></div>
                        </div>
                    </div>
                    <div class="col-lg-4 m-form__group-sub">
                        <label class="form-control-label">Número de Boleta:</label>
                        <div class="input-group">
                            <input type="text" class="form-control m-input numero_entero" placeholder="Ingrese el número"
                                   required data-msg="Campo requerido"
                                   name="item[numero_boleta]" {$privFace.input2} value="{$item.numero_boleta|escape:'html'}">
                            <div class="input-group-append"><span class="input-group-text" id="basic-addon2"><i class="fa fa-money-check"></i></span></div>
                        </div>
                    </div>
                </div>

                <div class="form-group  m-form row">
                    <div class="col-lg-12 m-form__group-sub">
                        <label class="form-control-label">Nombre de la empresa depositante: </label>
                        <div class="input-group">
                            <input type="text" class="form-control m-input mayus" placeholder="Ingrese el Nombre"
                                   name="item[nombre_depositante]" {$privFace.input2}
                                   value="{$item.nombre_depositante|escape:'html'}"
                                   required minlength="2" data-msg="Campo requerido">
                            <div class="input-group-append"><span class="input-group-text" id="basic-addon2"><i class="fa fa-user-tag"></i></span></div>
                        </div>
                    </div>
                </div>

                {if $item_padre.estado_id ==2}
                    <div class="form-group  m-form row">
                        <div class="col-lg-12 m-form__group-sub">
                            <label class="form-control-label">Cambiar Estado: </label>
                            <div class="input-group">
                                <select class="form-control m-select2 select2_general"
                                        name="item[estado_id]"  {$privFace.input} id="select_estado"
                                        required
                                        data-msg="Campo requerido">
                                    <option value=""></option>
                                    {html_options options=$cataobj.estado selected=$item.estado_id}
                                </select>

                            </div>
                        </div>


                        <div class="col-lg-12 m-form__group-sub {if $item.estado_id !=3}m--hide{/if}" id="observacion_msg">
                            <label class="form-control-label">Observación:</label>
                            <div class="input-group">
                                <div class="summernote" id="observacion">{$item.observacion}</div>
                                <input class="form-control m-input" type="hidden" name="item[observacion]" id="observacion_input" {$privFace.input}>
                            </div>
                        </div>
                    </div>
                {/if}


                <div class="m--hide m-alert m-alert--icon m-alert--icon-solid m-alert--outline alert alert-success alert-dismissible fade show"
                     id="aprobado_alerta"
                     role="alert">
                    <div class="m-alert__icon">
                        <i class="flaticon-exclamation-2"></i>
                        <span></span>
                    </div>
                    <div class="m-alert__text">
                        Usted esta aprobando este pago, <strong>Si realiza esta acción no podrá volver atras.</strong>
                    </div>
                    <div class="m-alert__close">
                        {*<button type="button" class="close" data-dismiss="alert" aria-label="Close"></button>*}
                    </div>
                </div>

                {if $item.estado_id == 3 and $item.observacion != ""}
                    <div class="m-alert m-alert--icon m-alert--icon-solid m-alert--outline alert alert-danger alert-dismissible fade show" role="alert">
                        <div class="m-alert__icon">
                            <i class="flaticon-exclamation-2"></i>
                            <span></span>
                        </div>
                        <div class="m-alert__text">
                            <strong>Observación:</strong> {$item.observacion}
                            <br>
                            Fecha de observación, <strong>{$item.observacion_fecha|date_format:"%d/%m/%Y %H:%M:%S"}</strong>
                        </div>
                        <div class="m-alert__close">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            </button>
                        </div>
                    </div>
                {/if}

                {if $item.estado_id == 4 }
                    <div class="m-alert m-alert--icon m-alert--icon-solid m-alert--outline alert alert-success alert-dismissible fade show"
                         id="aprobado_alerta"
                         role="alert">
                        <div class="m-alert__icon">
                            <i class="flaticon-exclamation-2"></i>
                            <span></span>
                        </div>
                        <div class="m-alert__text">
                            Fecha de Aprobación, <strong>{$item.aprobado_fecha|date_format:"%d/%m/%Y %H:%M:%S"}</strong>
                        </div>
                        <div class="m-alert__close">
                            {*<button type="button" class="close" data-dismiss="alert" aria-label="Close"></button>*}
                        </div>
                    </div>
                {/if}


            </div>

        {else}
            <div class="col-lg-12">
                <strong>El registro no existe.</strong>
            </div>
        {/if}
    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-secondary" id="form_modal_close_{$subcontrol}" data-dismiss="modal">Cerrar</button>
        {if $privFace.editar == 1}
            <button type="button" class="btn btn-focus" id="form_modal_submit_{$subcontrol}">Guardar y continuar&nbsp;&nbsp;<i class="fa fa-angle-double-right"></i></button>
        {/if}
    </div>
</form>

{include file="form/form.js.tpl"}