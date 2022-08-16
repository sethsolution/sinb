{include file="form/form.css.tpl"}

<form class="m-form m-form--fit m-form--label-align-right" method="POST"
      action="{$getModule}"
      id="form_modal_interface_{$subcontrol}">

    <div class="modal-body row">

        {if $item.itemId != "" or $type == 'new'}

        <div class="alert alert-focus col-lg-12" role="alert">Ver Datos Registro</div>

        <div class="col-lg-6">
            {if $item.adjunto_nombre !=""}
                <iframe src="{$getModule}&accion={$subcontrol}_descarga&id={$id}&item_id={$item_id}&tipo=inline"
                        width="100%" height="500px"></iframe>
            {/if}
        </div>


        <div class="col-lg-6">


            <div class="form-group">
                <div class="cuadro-verde m--padding-10" >
                    {$item.nombre_requisito|escape:'html'}
                </div>
            </div>

            <div class="form-group">
                <label>Descripción del Archivo (si corresponde):</label>
                <div class="input-group " >
                    <input type="text" class="form-control m-input"
                           disabled
                           placeholder="Ingrese la descripción del archivo" name="item[descripcion]" name="" {$privFace.input} value="{$item.descripcion|escape:'html'}">
                </div>
            </div>


            {if $item_padre.estado_id ==2}
                <div class="form-group  m-form row">
                    <div class="col-lg-12 m-form__group-sub">
                        <label class="form-control-label">Cambiar Estado:</label>
                        <div class="input-group">
                            <select class="form-control m-select2 select2_general_form"
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
                    Usted esta registrando oficialmente este documento, <strong>Si realiza esta acción no podrá volver atras.</strong>
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
    </div>

    {else}
    <div class="col-lg-12">
        <strong>El registro no existe.</strong>
    </div>
    {/if}

    <div class="modal-footer m-form__actions m-form__actions--solid m-form__actions--left m--padding-top-10 m--padding-bottom-10">
        <button type="button" class="btn btn-secondary" id="form_modal_close_{$subcontrol}" data-dismiss="modal">Cerrar</button>
        {if $privFace.editar == 1}
            <button type="button" class="btn btn-focus" id="form_modal_submit_{$subcontrol}">Guardar y continuar <i class="fa fa-angle-double-right"></i></button>
        {/if}
    </div>
</form>
{include file="form/form.js.tpl"}