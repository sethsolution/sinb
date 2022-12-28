{include file="index.css.tpl"}
<!--begin::Portlet-->
<div class="m-portlet">
    <!--begin::Form-->
    <form class="m-form m-form--state m-form--fit m-form--label-align-right" method="POST" action="{$getModule}" id="general_form" autocomplete="off">
        <input class="form-control m-input" type="hidden" name="item[itemId]" value="{$id|escape:'html'}">

        <!-- <div class="m-portlet__head">
            <div class="m-portlet__head-caption">
                <div class="m-portlet__head-title">
                    <h3 class="m-portlet__head-text">Datos del muestreo</h3>
                </div>
            </div>
        </div> -->

        <div class="m-portlet__body">
            <div class="form-group m-form__group row">
                <div class="col-lg-4">
                    <label>Estado</label>
                    <select class="form-control m-input select2" name="item[estado_itemid]" id="cboEstadoItemId" required>
                        <option value="">--Selecciones una opción--</option>
                        {html_options options=$cataobj.estados_operacion selected=$item.estado_itemid}
                    </select>
                </div>
                <div class="col-lg-4">
                    <label>Cantidad de hombres</label>
                    <input class="form-control m-input" type="number" name="item[cant_hombres]" id="txtCantHombres" value="{$item.cant_hombres|escape:'html'}" min="0" data-msg="Campo requerido." required>
                </div>
                <div class="col-lg-4">
                    <label>Cantidad de mujeres</label>
                    <input class="form-control m-input" type="number" name="item[cant_mujeres]" id="txtCantMujeres" value="{$item.cant_mujeres|escape:'html'}" min="0" data-msg="Campo requerido." required>
                </div>
            </div>
            <div class="form-group m-form__group row">
                <div class="col-lg-4">
                    <label>Fecha inicio de operación</label>
                    <input class="form-control m-input" type="date" name="item[fecha_inicio]" id="txtFechaInicio" value="{$item.fecha_inicio|escape:'html'}" data-msg="Campo requerido." required>
                </div>
                <div class="col-lg-4">
                    <label>Fecha de levantamiento</label>
                    <input class="form-control m-input" type="date" name="item[fecha_levantamiento]" id="txtFechaLevantamiento" value="{$item.fecha_levantamiento|escape:'html'}" data-msg="Campo requerido." required>
                </div>
                <div class="col-lg-4">
                    <label>Fecha de Vigencia</label>
                    <input class="form-control m-input" type="date" name="item[fecha_vigencia]" id="txtFechaVigencia" value="{$item.fecha_vigencia|escape:'html'}" data-msg="Campo requerido." required>
                </div>
            </div>
            <!--
            <div class="m-form__section m-form__section--first">
                <div class="m-form__heading">
                    <h3 class="m-form__heading-title">Otros</h3>
                </div>
                <div class="m-form__seperator m-form__seperator--dashed"></div>
            </div>
            -->
        </div>
        <div class="m-portlet__foot m-portlet__no-border m-portlet__foot--fit">
            <div class="m-form__actions m-form__actions--solid">
                <div class="row">
                    <div class="col-lg-12">
                        <button type="button" class="btn btn-primary btn-block-custom" id="general_submit"><i class="fa fa-check"></i>&nbsp;{if $type == 'new'}Guardar{else}Actualizar{/if}</button>
                        <button type="reset" class="btn btn-default btn-block-custom" id="general_reset">Cancelar</button>
                    </div>
                </div>
            </div>
        </div>

    </form>
    <!--end::Form-->
</div>
<!--end::Portlet-->
{include file="index.js.tpl"}