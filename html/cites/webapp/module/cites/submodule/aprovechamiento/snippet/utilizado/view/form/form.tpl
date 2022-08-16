{include file="form/form.css.tpl"}

<form class="m-form m-form--fit m-form--label-align-right" method="POST"
      action="{$path_url}/{$subcontrol}_/{$item_id}/{if $type=="update"}{$id}/{/if}guardar/"
      id="form_modal_interface_{$subcontrol}">

    <div class="modal-body">
        {if $item.itemId != "" or $type == 'new'}
            <div class="alert alert-focus" role="alert">
                {if $type == 'new'}Nuevo{else} {if $privFace.editar == 1}Editar{else}Ver Datos{/if}{/if} Registro de Precintos
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

            <div class="form-group m-form__group row m--padding-top-5 m--padding-bottom-5 m--padding-left-15 m--padding-right-15 " >
                <div class="col-lg-12  m-form__group-sub" >
                    <div class="cuadro m--padding-5 row">
                        <div class="col-lg-12 titulo m--margin-bottom-5 m--padding-left-5">
                            Detalle de los precintos utilizados
                        </div>
                        <div class="col-lg-4 m-form__group-sub">
                            <label class="form-control-label">Gestión de aprovechamiento</label>
                            <div class="input-group">
                                <input type="text" class="form-control m-input numero_entero"
                                       placeholder="Ingrese la gestión"
                                       required data-msg="Campo requerido"
                                       name="item[anio]" {$privFace.input} value="{$item.anio|escape:'html'}">
                            </div>
                        </div>
                        <div class="col-lg-4 m-form__group-sub">
                            <label class="form-control-label">Nro. de Precinto inicial utilizado:</label>
                            <div class="input-group">
                                <input type="text" class="form-control m-input numero_entero calcula"
                                       placeholder="Ingrese la cantidad"
                                       required data-msg="Campo requerido" id="inicio"
                                       name="item[precinto_inicial]"  {$privFace.input} value="{$item.precinto_inicial|escape:'html'}">
                            </div>
                        </div>
                        <div class="col-lg-4 m-form__group-sub">
                            <label class="form-control-label">Nro. de Precinto final utilizado</label>
                            <div class="input-group">
                                <input type="text" class="form-control m-input numero_entero calcula"
                                       placeholder="Ingrese la cantidad"
                                       required data-msg="Campo requerido" id="fin"
                                       name="item[precinto_final]"  {$privFace.input} value="{$item.precinto_final|escape:'html'}">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="form-group m-form__group row m--padding-top-5 m--padding-bottom-5 m--padding-left-15 m--padding-right-15 " >
                <div class="col-lg-12  m-form__group-sub" >
                    <div class="cuadro m--padding-5 row">
                        <div class="col-lg-12 titulo m--margin-bottom-5 m--padding-left-5">
                            Totales de los precintos
                        </div>

                        <div class="col-lg-6 m-form__group-sub">
                            <label class="form-control-label">Total precintos utilizados </label>
                            <div class="input-group">
                                <input type="text" class="form-control m-input numero_entero formato_total"
                                       placeholder="Ingrese la cantidad"
                                       required data-msg="Campo requerido"
                                       name="item[precinto_total_utilizados]" id="total"
                                        {$privFace.input} value="{$item.precinto_total_utilizados|escape:'html'}">
                            </div>
                        </div>
                        <div class="col-lg-6 m-form__group-sub">
                            <label class="form-control-label">Total precintos NO utilizados</label>
                            <div class="input-group">
                                <input type="text" class="form-control m-input numero_entero"
                                       placeholder="Ingrese la cantidad"
                                       required data-msg="Campo requerido"
                                       name="item[precinto_total_noutilizados]"  {$privFace.input} value="{$item.precinto_total_noutilizados|escape:'html'}">
                            </div>
                            <span class="m-form__help text-info text-info ">Precintos dados de BAJA</span>
                        </div>
                        <div class="col-lg-12 m-form__group-sub">
                            <label class="form-control-label">Codigo alfa-numero de precintos dados de BAJA</label>
                            <div class="input-group">
                                <input type="text" class="form-control m-input numero"
                                       placeholder="Ingrese la cantidad"
                                       name="item[codigo_precintos_baja]"  {$privFace.input} value="{$item.codigo_precintos_baja|escape:'html'}">
                            </div>
                            <span class="m-form__help text-info text-danger ">(Si coresponde)</span>
                            <span class="m-form__help text-info text-info ">Ejemplo de llenado: BOYAC/2018:1221 al BOYAC/2018:1299</span>
                        </div>
                    </div>
                </div>
        </div>
            <div class="form-group m-form__group row m--padding-top-5 m--padding-bottom-5 m--padding-left-15 m--padding-right-15 " >
                <div class="col-lg-12  m-form__group-sub" >
                    <div class="cuadro m--padding-5 row">
                        <div class="col-lg-12 titulo m--margin-bottom-5 m--padding-left-5">
                            Observaciones
                        </div>
                        <div class="col-lg-12 m-form__group-sub">
                            <div class="input-group">
                                <textarea class="form-control m-input mayus" placeholder="Ingrese la descripción" name="item[observaciones]" cols="4" {$privFace.input}>{$item.observaciones|escape:'html'}</textarea>
                            </div>
                        </div>
                    </div>
                </div>
            </div>


        {else}
            <strong>El registro no existe.</strong>
        {/if}
    </div>
    <div class="modal-footer m-form__actions m-form__actions--solid m-form__actions--left m--padding-top-10 m--padding-bottom-10">
        <button type="button" class="btn btn-secondary" id="form_modal_close_{$subcontrol}" data-dismiss="modal">Cerrar</button>
        {if $privFace.editar == 1}
            <button type="button" class="btn btn-focus" id="form_modal_submit_{$subcontrol}">Guardar y continuar &nbsp;&nbsp;<i class="fa fa-angle-double-right"></i></button>
        {/if}
    </div>
</form>

{include file="form/form.js.tpl"}