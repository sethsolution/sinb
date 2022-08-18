<!--begin::Portlet-->
<div class="m-portlet">
    <!--begin::Form-->
    <form class="m-form m-form--fit m-form--label-align-right m-form--group-seperator-dashed" method="POST" action="{$getModule}"  id="general_form">

        <div class="m-portlet__head">
            <div class="m-portlet__head-caption">
                <div class="m-portlet__head-title">
                    <h3 class="m-portlet__head-text"> Datos del IP Pública</h3>
                </div>
            </div>

            <div class="m-portlet__head-tools">
                <ul class="m-portlet__nav">
                    <li class="m-portlet__nav-item">
                        <span class="m-switch m-switch--lg m-switch--icon" style="padding: 0px; margin: 0px;">
                            <label style="margin: 0px;"><input type="checkbox" {if $item.activo eq 1}checked="checked"{/if} name="item[activo]" value="1" /><span style="margin: 0px;"></span></label>
                        </span>
                    </li>
                </ul>
            </div>
        </div>

        <div class="m-portlet__body">

            <div class="form-group m-form__group row">
                <div class="col-lg-6">
                    <label>IP:</label>
                    <div class="m-input-icon m-input-icon--right">
                        <input type="text" class="form-control m-input" placeholder="Ingrese la IP" name="item[ip]" value="{$item.ip|escape:"html"}"
                               data-msg="Required field" required minlength="3">
                        <span class="m-input-icon__icon m-input-icon__icon--right"><span><i class="la la-pencil-square-o"></i></span></span>
                    </div>
                </div>
                <div class="col-lg-6">
                    <label>Descripción:</label>
                    <div class="m-input-icon m-input-icon--right">
                        <input type="text" class="form-control m-input" placeholder="" name="item[descripcion]"  value="{$item.descripcion|escape:"html"}"
                               data-msg="Required field" required minlength="3">
                        <span class="m-input-icon__icon m-input-icon__icon--right"><span><i class="la la-pencil-square-o"></i></span></span>
                    </div>
                </div>
            </div>

            <div class="form-group m-form__group row">
                <div class="col-lg-6">
                    <label>Proveedor:</label>
                    <div class="m-input-icon m-input-icon--right">
                        <select class="form-control m-select2 select2_general" name="item[proveedor_id]"  data-placeholder="Elija un proveedor" {$privFace.input} data-msg="Required field" required>
                            <option></option>
                            {html_options options=$cataobj.proveedor selected=$item.proveedor_id}
                        </select>

                    </div>
                </div>
                <div class="col-lg-6">
                    <label>Lugar:</label>
                    <div class="m-input-icon m-input-icon--right">
                        <select class="form-control m-select2 select2_general" name="item[lugar_id]"  data-placeholder="Elija un lugar" {$privFace.input} data-msg="Required field" required>
                            <option></option>
                            {html_options options=$cataobj.lugar selected=$item.lugar_id}
                        </select>
                    </div>
                </div>
            </div>


        </div>

        <div class="m-portlet__foot m-portlet__no-border m-portlet__foot--fit">
            <div class="m-form__actions m-form__actions--solid">
                <div class="row">
                    <div class="col-lg-6">
                        {if $privFace.edit eq 1}
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
{include file="index.css.tpl"}
