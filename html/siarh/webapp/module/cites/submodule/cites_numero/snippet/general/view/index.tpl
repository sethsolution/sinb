<!--begin::Portlet-->
<div class="m-portlet">
    <!--begin::Form-->
    <form class="m-form m-form--fit m-form--label-align-right" method="POST" action="{$getModule}"  id="general_form">

        <div class="m-portlet__body">
            <div class="form-group m-form__group row  m-form m--padding-bottom-5 m--padding-top-5" >
                <div class="col-lg-12 m-form__group-sub " >
                    <div class="row cuadro m--padding-bottom-5 ">
                        <div class="col-lg-12 titulo m--margin-bottom-5 m--padding-left-5 m--padding-top-5">
                            NUMERACIÓN CITES
                        </div>
                        <div class="col-lg-8 m-form__group-sub">
                            <label class="form-control-label">Descripción del grupo de numeración:</label>
                            <div class="input-group">
                                <input type="text" class="form-control m-input"
                                       placeholder="Ingrese el codigo de venta" name="item[descripcion]"
                                       required data-msg="Campo requerido"
                                        {$privFace.input} value="{$item.descripcion|escape:'html'}"
                                >
                            </div>
                        </div>
                        <div class="col-lg-4 m-form__group-sub">
                            <label class="form-control-label">Fecha de registro:</label>
                            <div class="input-group">
                                <input type="text" class="form-control m-input fecha_general"
                                       placeholder="01/01/1900" name="item[fecha]"
                                        {$privFace.input} value="{if $item.fecha}{$item.fecha|date_format:'%d/%m/%Y'}{/if}"
                                >
                                <div class="input-group-append"><span class="input-group-text" id="basic-addon2"><i class="fa fa-calendar-alt""></i></span></div>
                            </div>
                        </div>
                        <div class="col-lg-6 m-form__group-sub">
                            <label class="form-control-label">Número Inicial:</label>
                            <div class="input-group">
                                <input type="text" class="form-control m-input monto numero_entero"
                                       placeholder="Ingrese el número inicial" name="item[numero_inicio]"
                                        {$privFace.input} value="{$item.numero_inicio|escape:'html'}"
                                       data-msg="Campo requerido" >
                                <div class="input-group-append"><span class="input-group-text formato_nota" id="basic-addon2"><i class="fab fa-wpforms"></i></span></div>
                            </div>
                        </div>
                        <div class="col-lg-6 m-form__group-sub">
                            <label class="form-control-label">Número final:</label>
                            <div class="input-group">
                                <input type="text" class="form-control m-input monto numero_entero"
                                       placeholder="Ingrese el número final" name="item[numero_fin]"
                                        {$privFace.input} value="{$item.numero_fin|escape:'html'}"
                                       data-msg="Campo requerido" >
                                <div class="input-group-append"><span class="input-group-text formato_nota" id="basic-addon2"><i class="fab fa-wpforms"></i></span></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>

        <div class="m-portlet__foot m-portlet__no-border m-portlet__foot--fit">
            <div class="m-form__actions m-form__actions--solid">
                <div class="row">
                    <div class="col-lg-6">
                        {if $privFace.editar == 1}
                        <button type="reset" class="btn btn-primary" id="general_submit">Guardar Cambios</button>
                        {/if}
                    </div>

                </div>
            </div>
        </div>
    </form>
    <!--end::Form-->
</div>
<!--end::Portlet-->
{include file="index.js.tpl"}
{include file="form.js.tpl"}
{include file="index.css.tpl"}
{*
{if  $type != 'new'}
    <div class="m-portlet__body m--padding-bottom-5 m--padding-top-5">
        <table class="table table-striped table-bordered table-hover table-checkable table-sm m-table m-table--head-bg-success m--hide" id="tabla_{$subcontrol}">
            <thead>
            <tr>
                {foreach from=$grill_list item=row key=idx}
                    <th>{$row.label|escape:"html"}</th>
                {/foreach}
            </tr>
            </thead>
            <tfoot>

            </tfoot>
        </table>
    </div>
{/if}*}