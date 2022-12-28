{include file="index.css.tpl"}
<!--begin::Portlet-->
<div class="m-portlet">
    <!--begin::Form-->
    <form class="m-form m-form--state m-form--fit m-form--label-align-right" method="POST" action="{$getModule}" id="general_form" autocomplete="off">

        <div class="m-portlet__head">
            <div class="m-portlet__head-caption">
                <div class="m-portlet__head-title">
                    <h3 class="m-portlet__head-text">Datos de enlace institucional</h3>
                </div>
            </div>
        </div>

        <div class="m-portlet__body">
            <div class="form-group m-form__group row">
                <div class="col-lg-8">
                    <label>Institución</label>
                    <input class="form-control m-input" type="text" name="item[institucion]" id="txtInstitucion" value="{$item.institucion|escape:'html'}" required data-msg="Campo requerido.">
                </div>
                <div class="col-lg-4">
                    <label>Sigla</label>
                    <input class="form-control m-input" type="text" name="item[sigla]" id="txtSigla" value="{$item.sigla|escape:'html'}" required data-msg="Campo requerido.">
                </div>
            </div>
            <div class="form-group m-form__group row">
                <div class="col-lg-12">
                    <label>Sitio Web</label>
                    <input class="form-control m-input" type="text" name="item[sitio_web]" id="txtSitioWeb" value="{$item.sitio_web|escape:'html'}" required data-msg="Campo requerido.">
                    <span class="m-form__help">Ejemplo: https://www.mmaya.gob.bo</span>
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