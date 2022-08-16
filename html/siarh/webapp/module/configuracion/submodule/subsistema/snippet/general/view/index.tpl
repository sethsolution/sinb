<!--begin::Portlet-->
<div class="m-portlet">
    <!--begin::Form-->
    <form class="m-form m-form--fit m-form--label-align-right m-form--group-seperator-dashed" method="POST" action="{$getModule}"  id="general_form">

        <div class="m-portlet__head">
            <div class="m-portlet__head-caption">
                <div class="m-portlet__head-title">
                    <h3 class="m-portlet__head-text">Registro del Subsistema Interno</h3>
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
                <div class="col-lg-4">
                    <label>Nombre</label>
                    <div class="m-input-icon m-input-icon--right">
                        <input type="text" class="form-control m-input" placeholder="Ingrese el título del Subsistema" name="item[titulo]"  value="{$item.titulo|escape:"html"}"
                               data-msg="Campo requerido" required minlength="2">
                        <span class="m-input-icon__icon m-input-icon__icon--right"><span><i class="la la-pencil-square-o"></i></span></span>
                    </div>
                </div>
                <div class="col-lg-4">
                    <label>Nombre de la Carpeta</label>
                    <div class="m-input-icon m-input-icon--right">
                        <input type="text" class="form-control m-input" placeholder="Ingrese nombre de la carpeta del Subsistema" name="item[carpeta]" value="{$item.carpeta|escape:"html"}"
                               data-msg="Campo requerido" required minlength="2">
                        <span class="m-input-icon__icon m-input-icon__icon--right"><span><i class="la la-pencil-square-o"></i></span></span>
                    </div>
                </div>
                <div class="col-lg-4">
                    <label>Orden</label>
                    <div class="m-input-icon m-input-icon--right">
                        <input type="text" class="form-control m-input numero_entero" placeholder="Ingrese el Orden" name="item[orden]" value="{$item.orden|escape:"html"}"
                               minlength="1" maxlength="2" data-msg="Campo requerido">
                        <span class="m-input-icon__icon m-input-icon__icon--right"><span><i class="la la-pencil-square-o"></i></span></span>
                    </div>
                </div>
            </div>
             <div class="form-group m-form__group row">
                <div class="col-lg-12">
                    <label>Descripción </label>
                    <div class="m-input-icon m-input-icon--right">
                        <div class="summernote" id="descripcion">{$item.descripcion}</div>
                        <input class="form-control m-input" type="hidden" name="item[descripcion]" id="descripcion_input" {$privFace.input}>

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