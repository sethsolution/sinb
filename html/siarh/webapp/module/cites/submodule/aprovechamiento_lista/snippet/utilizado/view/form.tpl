<div class="m-portlet m--padding-bottom-5" >
    <form class="m-form m-form--fit m-form--label-align-right" method="POST"
          action="{$path_url}/{$subcontrol}_/{$id}/guardar.detalle/"
          id="general_form">

        <div class="m-portlet__body m--padding-bottom-5 m--padding-top-5">
            {if $item.itemId != "" or $type == 'new' }
                {*******************mensaje de observacion************}
                {if $item.requisitos_observado == 1 and $item.requisitos_observacion != "" and $item.estado_id == 3}
                    <div class="m-alert m-alert--icon m-alert--icon-solid m-alert--outline alert alert-danger alert-dismissible fade show" role="alert">
                        <div class="m-alert__icon">
                            <i class="flaticon-exclamation-2"></i>
                            <span></span>
                        </div>
                        <div class="m-alert__text">
                            <strong>Observación - datos requisitos:&nbsp;&nbsp;</strong> {$item.requisitos_observacion}
                        </div>
                        <div class="m-alert__close">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            </button>
                        </div>
                    </div>
                {/if}
            {*----------------------------------------------------------------------------------*}

                    <div class="form-group m-form__group row m--padding-top-5 m--padding-bottom-5 " >
                        <div class="col-lg-12  m-form__group-sub" >
                            <div class="cuadro m--padding-5 row">
                                <div class="col-lg-12 titulo m--margin-bottom-5 m--padding-left-5">Codigo de los precintos dados de BAJA</div>
                                <div class="col-lg-6 m-form__group-sub">
                                    <div class="input-group">
                                        <input type="text" class="form-control m-input"
                                               placeholder="Ingrese el codigo" name="item[codigo_utilizado]"
                                                {$privFace.input} value="{$item.codigo_utilizado|escape:'html'}"
                                               required data-msg="Este campo es requerido." >
                                    </div>
                                    <span class="m-form__help text-info text-info ">Opcional: llenar en caso ser necesario</span>
                                </div>
                                {*
                                <div class="col-lg-6 m-form__group-sub">
                                    <div class="input-group">
                                        {if $item.estado_id ==1 or $item.estado_id ==3}
                                            <button type="reset" class="btn btn-primary" id="general_submit">
                                                <span>Guardar y continuar con el registro de CORTES&nbsp;&nbsp;<i class="fa fa-angle-double-right"></i></span>
                                            </button>
                                        {/if}
                                    </div>
                                </div>
                                *}
                            </div>
                        </div>
                    </div>

            {else}
                <strong>El registro no existe.</strong>
            {/if}
        </div>
    </form>
</div>

{include file="form.js.tpl"}
{include file="index.css.tpl"}
