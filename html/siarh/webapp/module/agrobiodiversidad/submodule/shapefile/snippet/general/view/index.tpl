{include file="index.css.tpl"}
<!--begin::Portlet-->
<div class="m-portlet">
    <!--begin::Form-->
    <form class="m-form m-form--state m-form--fit m-form--label-align-right" method="POST" action="{$getModule}" id="general_form" autocomplete="off">

        <div class="m-portlet__head">
            <div class="m-portlet__head-caption">
                <div class="m-portlet__head-title">
                    <h3 class="m-portlet__head-text">Datos de shapefile</h3>
                </div>
            </div>
        </div>

        <div class="m-portlet__body">
            <div class="form-group m-form__group row">
                <div class="col-lg-6">
                    <label>Nombre</label>
                    <input class="form-control m-input" type="text" name="item[nombre]" id="txtNombre" data-msg="Campo requerido." value="{$item.nombre|escape:'html'}" required>
                </div>
            </div>

            <div class="form-group m-form__group row">
                <div class="col-lg-12">
                    <label>Archivo shapefile</label>
                    <input class="form-control" type="file" name="adjunto" id="fileArchivo" onchange="fn_cargar_shapefile(event);" data-msg="Campo requerido." {if $item.adjunto_nombre eq ''}required{/if}>
                    {if $item.adjunto_nombre neq ''}
                    <span class="m-form__help"><b>Archivo actual:</b> {$item.adjunto_nombre|escape:'html'}</span>
                    {/if}
                </div>
            </div>

            <div class="form-group m-form__group row">
                <div class="col-lg-6">
                    <label>Descripción</label>
                    <textarea class="form-control" name="item[descrip]" id="txtDescrip" rows="3">{$item.descrip|escape:'html'}</textarea>
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