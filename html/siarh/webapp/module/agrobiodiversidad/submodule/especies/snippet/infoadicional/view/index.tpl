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
            <div class="m-form__section m-form__section--first">
                <div class="m-form__heading">
                    <h3 class="m-form__heading-title">Clasificación de estrategia</h3>
                </div>
                <div class="m-form__seperator m-form__seperator--dashed"></div>
                <div class="form-group m-form__group row">
                    <div class="col-lg-4">
                        <label>Método de conservación</label>
                        <select class="form-control m-input select2" name="item[metconserva_itemid]" id="cboMetconservaId" data-msg="Campo requerido.">
                            <option value="">--Seleccione una opción--</option>
                            {html_options options=$cataobj.metodos_conservacion selected=$item.metconserva_itemid}
                        </select>
                    </div>
                    <div class="col-lg-4">
                        <label>Estrategia de conservación</label>
                        <select class="form-control m-input select2" name="item[econserva_itemid]" id="cboEconservaId" data-msg="Campo requerido.">
                            <option value="">--Seleccione una opción--</option>
                        </select>
                    </div>
                </div>
            </div>
            <!--
            <div class="m-form__section m-form__section--last">
                <div class="m-form__heading">
                    <h3 class="m-form__heading-title">Otros</h3>
                </div>
                <div class="m-form__seperator m-form__seperator--dashed"></div>
                <div class="form-group m-form__group row">
                    <div class="col-lg-4">
                        <label>Año de investigación</label>
                        <input class="form-control m-input" type="number" name="item[gestion]" id="txtGestion" value="{$item.gestion|escape:'html'}" data-msg="Campo requerido.">
                    </div>
                </div>
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