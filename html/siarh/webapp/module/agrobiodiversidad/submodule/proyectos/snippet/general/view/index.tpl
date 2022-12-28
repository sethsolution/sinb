{include file="index.css.tpl"}
<!--begin::Portlet-->
<div class="m-portlet">
    <!--begin::Form-->
    <form class="m-form m-form--state m-form--fit m-form--label-align-right" method="POST" action="{$getModule}" id="general_form" autocomplete="off">

        <div class="m-portlet__head">
            <div class="m-portlet__head-caption">
                <div class="m-portlet__head-title">
                    <h3 class="m-portlet__head-text">Descripción del proyecto</h3>
                </div>
            </div>
        </div>

        <div class="m-portlet__body">

            <div class="form-group m-form__group row">
                <div class="col-lg-6">
                    <label>Nombre</label>
                    <input class="form-control m-input" type="text" name="item[nombre]" id="txtNombre" value="{$item.nombre|escape:'html'}" required data-msg="Campo requerido.">
                </div>
                <div class="col-lg-3">
                    <label>Sigla</label>
                    <input class="form-control m-input" type="text" name="item[sigla]" id="txtSigla" value="{$item.sigla|escape:'html'}" required data-msg="Campo requerido.">
                </div>
                <div class="col-lg-3">
                    <label>Código</label>
                    <input class="form-control m-input" type="text" name="item[codigo]" id="txtCodigo" value="{$item.codigo|escape:'html'}" required data-msg="Campo requerido.">
                </div>
            </div>

            <div class="form-group m-form__group row">
                <div class="col-lg-3">
                    <label>Organización implementador</label>
                    <input class="form-control m-input" type="text" name="item[implementador]" id="txtImplementador" value="{$item.implementador|escape:'html'}" required data-msg="Campo requerido.">
                </div>
                <div class="col-lg-3">
                    <label>Fecha de inicio</label>
                    <input class="form-control m-input" type="date" name="item[fecha_inicio]" id="txtFechaInicio" value="{$item.fecha_inicio|escape:'html'}" required data-msg="Campo requerido.">
                </div>
                <div class="col-lg-3">
                    <label>Fecha de finalización</label>
                    <input class="form-control m-input" type="date" name="item[fecha_final]" id="txtFechaFinal" value="{$item.fecha_final|escape:'html'}" required data-msg="Campo requerido.">
                </div>
                   <div class="col-lg-3">
                    <label>Estado de Proyecto</label>
                    <select class="form-control m-input select2" name="item[estado_itemid]" id="cboEstadoId" required data-msg="Campo requerido. Seleccione una opción.">
                        <option value="">--Seleccione una opción--</option>
                        {html_options options=$cataobj.proyecto_estados selected=$item.estado_itemid}
                    </select>
                </div>
            </div>

            <div class="form-group m-form__group row">
                <div class="col-lg-6">
                    <label>Objetivo principal</label>
                    <textarea class="form-control m-input" name="item[objetivo_principal]" id="txtObjetivoPrin" rows="5" required data-msg="Campo requerido.">{$item.objetivo_principal|escape:'html'}</textarea>
                </div>
                <div class="col-lg-6">
                    <label>Descripción</label>
                    <textarea class="form-control m-input" name="item[descrip]" id="txtDescrip" rows="5" required data-msg="Campo requerido.">{$item.descrip|escape:'html'}</textarea>
                </div>
            </div>

            <div class="m-form__section">
                <div class="m-form__heading">
                    <h5 class="m-form__heading-title">Cobertura</h5>
                </div>
                <div class="m-form__seperator m-form__seperator--dashed"></div>
                <div id="pnlUbicacion">
                    <div class="form-group m-form__group row">
                        <div class="col-lg-6">
                            <label>Departamento</label>
                            <select class="form-control m-input select2" name="item[depto_itemid][]" id="cboDeptoId" data-msg="Campo requerido." required multiple>
                                <option value="">--Seleccione una opción--</option>
                                {html_options options=$deptos}
                            </select>
                        </div>
                        <div class="col-lg-6">
                            <label>Municipio</label>
                            <select class="form-control m-input select2" name="item[municipio_itemid][]" id="cboMunicipioId" data-msg="Campo requerido." required multiple>
                                <option value="">--Seleccione una opción--</option>
                            </select>
                        </div>
                    </div>
                </div>

            </div>
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