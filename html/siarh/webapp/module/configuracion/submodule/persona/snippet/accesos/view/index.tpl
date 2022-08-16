
<!--begin::Portlet-->
<div class="m-portlet">
    <div class="m-portlet__body">

        <div class="form-group m-form__group row">
            <div class="col-lg-3">
                <label>Nombres:</label>
                <div class="m-input-icon m-input-icon--right">
                    <input disabled type="text" class="form-control m-input" placeholder="Ingrese sus nombres" name="item[nombres]" name="" value="{$item.nombres|escape:"html"}">
                    <span class="m-input-icon__icon m-input-icon__icon--right"><span><i class="flaticon-avatar"></i></span></span>
                </div>
            </div>
            <div class="col-lg-3">
                <label class="">Apellido Paterno:</label>
                <div class="m-input-icon m-input-icon--right">
                    <input disabled type="text" class="form-control m-input" placeholder="Ingrese su apellido paterno" name="item[apellido_paterno]" value="{$item.apellido_paterno|escape:"html"}">
                    <span class="m-input-icon__icon m-input-icon__icon--right"><span><i class="fa flaticon-users"></i></span></span>
                </div>
            </div>
            <div class="col-lg-3">
                <label>Apellido Materno:</label>
                <div class="m-input-icon m-input-icon--right">
                    <input disabled type="text" class="form-control m-input" placeholder="Ingrese su apellido materno" name="item[apellido_materno]" value="{$item.apellido_materno|escape:"html"}">
                    <span class="m-input-icon__icon m-input-icon__icon--right"><span><i class="fa flaticon-users"></i></span></span>
                </div>
            </div>

            <div class="col-lg-3">
                <label for="exampleInputEmail1">Carnet de Identidad:</label>
                <div class="input-group m-input-group">
                    <div class="input-group-prepend"><span class="input-group-text"><i class="fa fa-address-card"></i></span></div>
                    <input disabled type="text" class="form-control m-input" placeholder="Ingrese C.I." name="item[ci]" name="" value="{$item.ci|escape:"html"}">
                </div>
            </div>
        </div>
    </div>
    <div class="m-portlet__head">

        <div class="m-portlet__head-caption">
            <div class="m-portlet__head-title">
                <span class="m-portlet__head-icon"><i class="flaticon-search"></i></span>
                <h3 class="m-portlet__head-text">Consulta de Asistencia</h3>
            </div>
        </div>
    </div>

    <form class="m-form m-form--fit m-form--label-align-right m-form--group-seperator-dashed" method="POST" action="{$getModule}"  id="accesos_form">

        <div class="m-portlet__body">
            <div class="form-group m-form__group row">
                <label class="col-lg-1 col-form-label">Fecha Inicio:</label>
                <div class="col-lg-3">
                    <div class="input-group date" >
                        <input type="text" class="form-control m-input fecha_general" readonly  placeholder=""
                               name="item[fecha_inicio]" required
                               value=""/>
                        <div class="input-group-append">
							<span class="input-group-text"><i class="flaticon-calendar-1 "></i></span>
                        </div>
                    </div>
                </div>
                <label class="col-lg-1 col-form-label">Fecha Fin:</label>
                <div class="col-lg-3">
                    <div class="input-group date" >
                        <input type="text" class="form-control m-input fecha_general" readonly  placeholder="Seleccione su fecha Fin"
                               name="item[fecha_fin]" data-msg="Campo requerido" required
                               value="{$smarty.now|date_format:"%d/%m/%Y"}"/>
                        <div class="input-group-append">
							<span class="input-group-text"><i class="flaticon-calendar-1 "></i></span>
                        </div>
                    </div>
                </div>
                <label class="col-lg-1 col-form-label">&nbsp;</label>
                <div class="col-lg-3">
                    <button type="reset" class="btn btn-primary" id="accesos_submit">Ver Asistencia</button>
                </div>
            </div>
        </div>
    </form>

    <div class="m-portlet__body" id="resultado_asistencia">
    </div>
    <!--end::Form-->
</div>
<!--end::Portlet-->

{include file="index.js.tpl"}
{include file="index.css.tpl"}