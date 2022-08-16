<!--begin::Portlet-->
<div class="m-portlet">
    <!--begin::Form-->
    <form class="m-form m-form--fit m-form--label-align-right m-form--group-seperator-dashed" method="POST" action="{$getModule}"  id="general_form">

        <div class="m-portlet__head">
            <div class="m-portlet__head-caption">
                <div class="m-portlet__head-title">
                    <h3 class="m-portlet__head-text"> Datos de Mascara</h3>
                </div>
            </div>

            <div class="m-portlet__head-tools">
                <ul class="m-portlet__nav">
                    <li class="m-portlet__nav-item">
                        <span class="m-switch m-switch--lg m-switch--icon" style="padding: 0px; margin: 0px;">
                            <label style="margin: 0px;"><input type="checkbox" {if $item.activo == 1}checked="checked"{/if} name="item[activo]" value="1" /><span style="margin: 0px;"></span></label>
                        </span>
                    </li>
                </ul>
            </div>
        </div>

        <div class="m-portlet__body">

            <div class="form-group m-form__group row">
                <div class="col-lg-6">
                    <label>Nombre de la Entidad:</label>
                    <div class="m-input-icon m-input-icon--right">
                        <input type="text" class="form-control m-input" placeholder="Ingrese el nombre de la Entidad" name="item[nombre]" name="" value="{$item.nombre|escape:"html"}"
                               data-msg="Campo requerido" required minlength="2">
                        <span class="m-input-icon__icon m-input-icon__icon--right"><span><i class="la la-pencil-square-o"></i></span></span>
                    </div>
                </div>
                <div class="col-lg-6">
                    <label>Sigla</label>
                    <div class="m-input-icon m-input-icon--right">
                        <input type="text" class="form-control m-input" placeholder="Ingrese la Sigla" name="item[sigla]" name="" value="{$item.sigla|escape:"html"}"
                               data-msg="Campo requerido" required minlength="2">
                        <span class="m-input-icon__icon m-input-icon__icon--right"><span><i class="la la-pencil-square-o"></i></span></span>
                    </div>
                </div>
            </div>
            <div class="form-group m-form__group row">
                <div class="col-lg-3">
                    <label>Codigo 1:</label>
                    <div class="m-input-icon m-input-icon--right">
                        <input type="text" class="form-control m-input" placeholder="Ingrese el codigo 1" name="item[cod1]" name="" value="{$item.cod1|escape:"html"}"
                               data-msg="Campo requerido" required minlength="1">
                        <span class="m-input-icon__icon m-input-icon__icon--right"><span><i class="la la-pencil-square-o"></i></span></span>
                    </div>
                </div>
                <div class="col-lg-3">
                    <label>Codigo 2</label>
                    <div class="m-input-icon m-input-icon--right">
                        <input type="text" class="form-control m-input" placeholder="Ingrese la codigo 2" name="item[cod2]" name="" value="{$item.cod2|escape:"html"}"
                               data-msg="Campo requerido" required minlength="1">
                        <span class="m-input-icon__icon m-input-icon__icon--right"><span><i class="la la-pencil-square-o"></i></span></span>
                    </div>
                </div>
                <div class="col-lg-3">
                    <label>Codigo 3</label>
                    <div class="m-input-icon m-input-icon--right">
                        <input type="text" class="form-control m-input" placeholder="Ingrese la codigo 3" name="item[cod3]" name="" value="{$item.cod3|escape:"html"}"
                               data-msg="Campo requerido" required minlength="1">
                        <span class="m-input-icon__icon m-input-icon__icon--right"><span><i class="la la-pencil-square-o"></i></span></span>
                    </div>
                </div>
                <div class="col-lg-3">
                    <label>Codigo 4</label>
                    <div class="m-input-icon m-input-icon--right">
                        <input type="text" class="form-control m-input" placeholder="Ingrese la codigo 3" name="item[cod4]" name="" value="{$item.cod4|escape:"html"}"
                               data-msg="Campo requerido" required minlength="1">
                        <span class="m-input-icon__icon m-input-icon__icon--right"><span><i class="la la-pencil-square-o"></i></span></span>
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
{include file="index.css.tpl"}