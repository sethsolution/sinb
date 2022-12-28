<!--begin::Portlet-->
<div class="m-portlet">
    <!--begin::Form-->
    <form class="m-form" method="POST" action="{$getModule}" id="general_form" autocomplete="off">

        <div class="m-portlet__head">
            <div class="m-portlet__head-caption">
                <div class="m-portlet__head-title">
                    <h3 class="m-portlet__head-text">Catálogo</h3>
                </div>
            </div>
        </div>

        <div class="m-portlet__body">
            <div class="form-group m-form__group row">
                <div class="col-lg-4">
                    <label>Nombre de catálogo</label>
                    <input class="form-control m-input" type="text" name="item[nombre]" id="txtNombre" value="{$item.nombre|escape:"html"}" {$privFace.input} maxlength="255" required>
                </div>

                <div class="col-lg-4">
                    <label>Ruta de la carpeta</label>
                    <input class="form-control m-input" type="text" name="item[ruta]" id="txtRuta" value="{$item.ruta|escape:"html"}" maxlength="150" required>
                </div>
                <div class="col-lg-4">
                    <label>Orden de visualización</label>
                    <input class="form-control m-input" type="number" name="item[orden]" id="txtOrden" value="{$item.orden|escape:"html"}" required>
                </div>
            </div>
        </div>

        <div class="m-portlet__foot m-portlet__no-border m-portlet__foot--fit">
            <div class="m-form__actions m-form__actions--solid">
                <div class="row">
                    <div class="col-lg-12">
                        <button type="submit" class="btn btn-primary btn-block-custom" id="general_submit"><i class="fa fa-check"></i>&nbsp;{if $type == 'new'} Guardar {else} Actualizar {/if}</button>
                        <a href="{$getModule}" class="btn btn-secondary btn-block-custom"><i class="fa fa-arrow-left"></i>&nbsp;Volver</a>
                    </div>
                </div>
            </div>
        </div>

    </form>
    <!--end::Form-->
</div>
<!--end::Portlet-->

{include file="index.js.tpl"}
{include file="index.css.tpl"}