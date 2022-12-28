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
                    <h3 class="m-form__heading-title">Resumen del descriptor</h3>
                </div>
                <div class="m-form__seperator m-form__seperator--dashed"></div>
                <div class="form-group m-form__group row">
                    <div class="col-lg-6">
                        <label>Características de la planta</label>
                        <textarea class="form-control m-input" name="item[carac_planta]" id="txtCaracPlanta" rows="3" required>{$item.carac_planta|escape:'html'}</textarea>
                    </div>
                    <div class="col-lg-6">
                        <label>Hábito de crecimiento</label>
                        <textarea class="form-control m-input" name="item[habito_crecimiento]" id="txtHabitoCrecimiento" rows="3" required>{$item.habito_crecimiento|escape:'html'}</textarea>
                    </div>
                </div>
                <div class="form-group m-form__group row">
                    <div class="col-lg-6">
                        <label>Altura de la planta</label>
                        <textarea class="form-control m-input" name="item[altura_planta]" id="txtAlturaPlanta" rows="3" required>{$item.altura_planta|escape:'html'}</textarea>
                    </div>
                    <div class="col-lg-6">
                        <label>Características de floración</label>
                        <textarea class="form-control m-input" name="item[carac_floracion]" id="txtCaracFloracion" rows="3" required>{$item.carac_floracion|escape:'html'}</textarea>
                    </div>
                </div>
                <div class="form-group m-form__group row">
                    <div class="col-lg-6">
                        <label>Características de las hojas</label>
                        <textarea class="form-control m-input" name="item[carac_hojas]" id="txtCaracHojas" rows="3" required>{$item.carac_hojas|escape:'html'}</textarea>
                    </div>
                    <div class="col-lg-6">
                        <label>Características del tallo</label>
                        <textarea class="form-control m-input" name="item[carac_tallo]" id="txtCaracTallo" rows="3" required>{$item.carac_tallo|escape:'html'}</textarea>
                    </div>
                </div>
                <div class="form-group m-form__group row">
                    <div class="col-lg-12">
                        <label>Características del área aprovechable (fruto, grano, tuberculo, inflorecencia y/o raiz)</label>
                        <textarea class="form-control m-input" name="item[carac_area_aprovechable]" id="txtCaracAreaAprovechable" rows="3" required>{$item.carac_area_aprovechable|escape:'html'}</textarea>
                    </div>
                </div>
                {if $type eq "update" and not $itemDescriptor eq null}
                <div class="form-group m-form__group row">
                    <div class="col-lg-12">
                        <label>Documento en formato pdf</label>
                        <a class="nav" href="{$getModule}&accion={$subcontrol}_descargarRecurso&id={$itemDescriptor.itemId}" target="_blank">Descargar documento</a>
                    </div>
                </div>
                {/if}
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