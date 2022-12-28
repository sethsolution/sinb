{include file="index.css.tpl"}
<!--begin::Portlet-->
<div class="m-portlet">
    <!--begin::Form-->
    <form class="m-form m-form--state m-form--fit m-form--label-align-right" method="POST" action="{$getModule}" id="general_form" autocomplete="off">
        <input class="form-control m-input" type="hidden" name="item[proy_itemid]" value="{$id|escape:'html'}">

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
                    <h3 class="m-form__heading-title">Memoria resumen del proyecto</h3>
                </div>
                <div class="m-form__seperator m-form__seperator--dashed"></div>
                <div class="form-group m-form__group row">
                    <div class="col-lg-12">
                        <label>Descripción</label>
                        <textarea class="form-control m-input" name="item[descrip]" id="txtDescrip" rows="5">{$item.descrip|escape:'html'}</textarea>
                    </div>
                </div>
                <div class="form-group m-form__group row">
                    <div class="col-lg-6">
                        <label>Archivo</label>
                        <div class="custom-file">
                            <input type="file" class="form-control m-input custom-file-input" placeholder="Seleccione un archivo" name="archivo_adjunto" id="fileArchivoAdjunto" {if $type == 'new'} minlength="2" required data-msg="Campo requerido. Seleccione un archivo." {/if} value="{$item.adjunto_nombre|escape:'html'}">
                            <label class="custom-file-label" for="archivo_adjunto">Seleccione un archivo</label>
                        </div>
                        {if $type == 'update'}
                        <p style="background-color: #e5e5e5; padding: 7px;">
                            <strong>Archivo actual:</strong>&nbsp;{$item.adjunto_nombre}<br>
                            <button class="btn btn-warning btn-sm" type="button" id="btnDescargarArchivo"><i class="la flaticon-download"></i>&nbsp;Descargar archivo</button>
                        </p>
                        {/if}
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