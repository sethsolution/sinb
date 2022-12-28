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
                <div class="form-group m-form__group row">
                    <div class="col-lg-6">
                        <label>Nombre de organización/asociación/comunidad</label>
                        <input class="form-control m-input" type="text" name="item[prod_organizacion]" id="txtProdOrganizacion" value="{$item.prod_organizacion|escape:'html'}" data-msg="Campo requerido.">
                    </div>
                </div>
                <div class="m-form__heading">
                    <h3 class="m-form__heading-title">Información de custodio/productor/representante</h3>
                </div>
                <div class="m-form__seperator m-form__seperator--dashed"></div>
                <div class="form-group m-form__group row">
                    <div class="col-lg-3">
                        <label>C.I.</label>
                        <input class="form-control m-input" type="number" name="item[prod_ci]" id="txtProdCi" value="{$item.prod_ci|escape:'html'}" data-msg="Campo requerido.">
                    </div>
                    <div class="col-lg-9">
                        <label>Nombres y Apellidos</label>
                        <input class="form-control m-input" type="text" name="item[prod_nombres_apellidos]" id="txtProdNombresApellidos" value="{$item.prod_nombres_apellidos|escape:'html'}" data-msg="Campo requerido.">
                    </div>
                </div>
                <div class="form-group m-form__group row">
                    <div class="col-lg-3">
                        <label>Sexo</label>
                        <select class="form-control m-input select2" name="item[prod_sexo]" id="txtProdSexo" data-msg="Campo requerido.">
                            <option value="">--Seleccione una opción--</option>
                            {html_options options=$listaSexo selected=$item.prod_sexo}
                        </select>
                    </div>
                    <div class="col-lg-3">
                        <label>Celular</label>
                        <input class="form-control m-input" type="number" name="item[prod_celular]" id="txtProdCelular" value="{$item.prod_celular|escape:'html'}" data-msg="Campo requerido.">
                    </div>
                    <div class="col-lg-6">
                        <label>Correo electrónico</label>
                        <input class="form-control m-input" type="email" name="item[correo_e]" id="txtCorreoElectronico" value="{$item.correo_e|escape:'html'}" data-msg="Campo requerido.">
                    </div>
                </div>
            </div>

            <!--
            <div class="m-form__section m-form__section--last">
                <div class="m-form__heading">
                    <h3 class="m-form__heading-title">Información del custodio&nbsp;[<small><a href="javascript:;" id="btnCopiar">Copiar datos del productor</a></small>]</h3>
                </div>
                <div class="m-form__seperator m-form__seperator--dashed"></div>
                <div class="form-group m-form__group row">
                    <div class="col-lg-3">
                        <label>C.I.</label>
                        <input class="form-control m-input" type="number" name="item[cus_ci]" id="txtCusCi" value="{$item.cus_ci|escape:'html'}" data-msg="Campo requerido.">
                    </div>
                    <div class="col-lg-9">
                        <label>Nombres y Apellidos</label>
                        <input class="form-control m-input" type="text" name="item[cus_nombres_apellidos]" id="txtCusNombresApellidos" value="{$item.cus_nombres_apellidos|escape:'html'}" data-msg="Campo requerido.">
                    </div>
                </div>
                <div class="form-group m-form__group row">
                    <div class="col-lg-3">
                        <label>Sexo</label>
                        <select class="form-control m-input select2" name="item[cus_sexo]" id="txtCusSexo" data-msg="Campo requerido.">
                            <option value="">--Seleccione una opción--</option>
                            {html_options options=$listaSexo selected=$item.cus_sexo}
                        </select>
                    </div>
                    <div class="col-lg-3">
                        <label>Celular</label>
                        <input class="form-control m-input" type="number" name="item[cus_celular]" id="txtCusCelular" value="{$item.cus_celular|escape:'html'}" data-msg="Campo requerido.">
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