<!--begin::Portlet-->
<div class="m-portlet">
    <!--begin::Form-->
    <form class="m-form m-form--state m-form--fit m-form--label-align-right" method="POST" action="{$getModule}" id="general_form" autocomplete="off">

        <div class="m-portlet__head">
            <div class="m-portlet__head-caption">
                <div class="m-portlet__head-title">
                    <h3 class="m-portlet__head-text">Catálogo certificación ecológica</h3>
                </div>
            </div>
        </div>
        
        <div class="form-group m-form__group row">
            <div class="col-lg-6">
                <label>Nombre</label>
                <input class="form-control m-input" type="text" name="item[nombre]" id="txtNombre" value="{$item.nombre|escape:"html"}" {$privFace.input} required>
            </div>
            <div class="col-lg-3">
                <label>Estado</label>
                <select class="form-control m-input select2" name="item[activo]" id="cboActivo" required>
                    <option value="">Seleccione estado</option>
                    {html_options options=$listaEstados selected=$item.activo}
                </select>
            </div>
        </div>

        <div class="m-portlet__foot m-portlet__no-border m-portlet__foot--fit">
            <div class="m-form__actions m-form__actions--solid">
                <div class="row">
                    <div class="col-lg-12">
                        <button type="submit" class="btn btn-primary btn-block-custom" id="general_submit"><i class="fa fa-check"></i>&nbsp;{if $type == 'new'} Guardar {else} Actualizar {/if}</button>
                        <button type="reset" class="btn btn-light btn-block-custom" id="general_volver">Volver</button>
                    </div>
                </div>
            </div>
        </div>

    </form>
    <!--end::Form-->
</div>
<!--end::Portlet-->

{include file="form/index.js.tpl"}
{include file="form/index.css.tpl"}