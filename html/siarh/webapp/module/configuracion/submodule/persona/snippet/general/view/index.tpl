<div class="row">
    <div class="col-lg-12">

        <!--begin::Portlet-->
        <div class="m-portlet">
            <form class="m-form m-form--fit m-form--label-align-right m-form--group-seperator-dashed" method="POST" action="{$getModule}"  id="general_form">
            <div class="m-portlet__head">

                <div class="m-portlet__head-caption">
                    <div class="m-portlet__head-title">
						<span class="m-portlet__head-icon m--hide">
						<i class="la la-gear"></i>
						</span>
                        <h3 class="m-portlet__head-text">
                            Datos Personales
                        </h3>
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

            <!--begin::Form-->

                <div class="m-portlet__body">

                    <div class="form-group m-form__group row">
                        <div class="col-lg-6">
                            <label>Nombres:</label>
                            <div class="m-input-icon m-input-icon--right">
                                <input type="text" class="form-control m-input" placeholder="Ingrese sus nombres" name="item[nombres]" name="" value="{$item.nombres|escape:"html"}">
                                <span class="m-input-icon__icon m-input-icon__icon--right"><span><i class="flaticon-avatar"></i></span></span>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <label class="">Apellido Paterno:</label>
                            <div class="m-input-icon m-input-icon--right">
                                <input type="text" class="form-control m-input" placeholder="Ingrese su apellido paterno" name="item[apellido_paterno]" value="{$item.apellido_paterno|escape:"html"}">
                                <span class="m-input-icon__icon m-input-icon__icon--right"><span><i class="fa flaticon-users"></i></span></span>
                            </div>
                        </div>
                    </div>
                    <div class="form-group m-form__group row">
                        <div class="col-lg-6">
                            <label>Apellido Materno:</label>
                            <div class="m-input-icon m-input-icon--right">
                                <input type="text" class="form-control m-input" placeholder="Ingrese su apellido materno" name="item[apellido_materno]" value="{$item.apellido_materno|escape:"html"}">
                                <span class="m-input-icon__icon m-input-icon__icon--right"><span><i class="fa flaticon-users"></i></span></span>
                            </div>

                        </div>
                        <div class="col-lg-6">
                            <label class="">Apellido Casada:</label>
                            <div class="m-input-icon m-input-icon--right">
                                <input type="text" class="form-control m-input" placeholder="Ingrese el apellido de casada, si aplica" name="item[apellido_casada]" value="{$item.apellido_casada|escape:"html"}">
                                <span class="m-input-icon__icon m-input-icon__icon--right"><span><i class="fa flaticon-user-add"></i></span></span>
                            </div>

                        </div>
                    </div>

                    <div class="form-group m-form__group row">
                        <div class="col-lg-3">
                            <label>Fecha de nacimiento:</label>
                            <div class="input-group date" >
                                <input type="text" class="form-control m-input fecha_general" readonly  placeholder="Seleccione su fecha de nacimiento"  name="item[fecha_nacimiento]"
                                       value="{$item.fecha_nacimiento|date_format:"%d/%m/%Y"}"/>
                                <div class="input-group-append">
							<span class="input-group-text">
							<i class="flaticon-calendar-1 "></i>
							</span>
                                </div>
                            </div>

                        </div>
                        <div class="col-lg-3">
                            <label >Genero </label>
                            <div class="input-group" >
                                <select class="form-control m-select2 select2_general" name="item[genero_id]" data-placeholder="Elija un Genero">
                                        {html_options options=$cataobj.genero selected=$item.genero_id}
                                    </select>
                            </div>
                        </div>
                        <div class="col-lg-3">
                            <label >Estado Civil </label>
                            <div class="input-group" >
                                <select class="form-control m-select2 select2_general" name="item[estado_civil_id]" data-placeholder="Elija un Genero">
                                    <option value="null">Sin dato</option>
                                    {html_options options=$cataobj.estado_civil selected=$item.estado_civil_id}
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-3">
                            <label >Grupo Sanguíneo </label>
                            <div class="input-group" >
                                <select class="form-control m-select2 select2_general" name="item[grupo_sanguineo_id]" data-placeholder="Elija un Genero">
                                    <option value="null">Sin dato</option>
                                    {html_options options=$cataobj.grupo_sanguineo selected=$item.grupo_sanguineo_id}
                                </select>
                            </div>
                        </div>
                    </div>


                    <div class="form-group m-form__group row">
                        <div class="col-lg-3">
                            <label>AFP:</label>
                            <div class="input-group" >
                                <select class="form-control m-select2 select2_general" name="item[afp_id]" data-placeholder="Elija un AFP">
                                    <option value="null">Sin AFP</option>
                                    {html_options options=$cataobj.afp selected=$item.afp_id}
                                </select>
                            </div>

                        </div>
                        <div class="col-lg-3">
                            <label >AFP N# de NUA/CUA </label>
                            <div class="input-group m-input-group">
                                <div class="input-group-prepend"><span class="input-group-text"><i class="fa fa-tag"></i></span></div>
                                <input type="text" class="form-control m-input numero_entero" placeholder="Ingrese NUA/CUA" name="item[nua]" name="" value="{$item.nua|escape:"html"}">
                            </div>
                        </div>
                        <div class="col-lg-3">
                            <label >Institución Financiera </label>
                            <div class="input-group" >
                                <select class="form-control m-select2 select2_general" name="item[institucion_financiera_id]" data-placeholder="Elija una Institución Financiera">
                                    <option value="null">Sin Institución Financiera</option>
                                    {html_options options=$cataobj.institucion_financiera selected=$item.institucion_financiera_id}
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-3">
                            <label >N# de Cuenta Bancaria </label>
                            <div class="input-group m-input-group">
                                <div class="input-group-prepend"><span class="input-group-text"><i class="fa fa-credit-card"></i></span></div>
                                <input type="text" class="form-control m-input numero_entero" placeholder="Ingrese número de cuenta" name="item[numero_cuenta]" name="" value="{$item.numero_cuenta|escape:"html"}">
                            </div>
                        </div>
                    </div>



                    <div class="form-group m-form__group row">
                        <div class="col-lg-6">
                            <label for="exampleInputEmail1">Carnet de Identidad:</label>
                            <div class="input-group m-input-group">
                                <div class="input-group-prepend"><span class="input-group-text"><i class="fa fa-address-card"></i></span></div>
                                <input type="text" class="form-control m-input" placeholder="Ingrese C.I." name="item[ci]" name="" value="{$item.ci|escape:"html"}">
                            </div>
                            <span class="m-form__help">C.I. Numérica: {$item.ci_num|escape:"htmlall"}</span>
                        </div>


                        <div class="col-lg-6">
                            <label >Expedido en:</label>
                            <div class="input-group" >
                                <select class="form-control m-select2 select2_general" name="item[ci_exp]" data-placeholder="Elija un Genero">
                                    {html_options options=$cataobj.departamento selected=$item.ci_exp}
                                </select>
                            </div>
                        </div>
                    </div>


                    <div class="form-group m-form__group row">
                        <div class="col-lg-12">
                            <label>Direción:</label>
                            <div class="m-input-icon m-input-icon--right">
                                <input class="form-control m-input" placeholder="Ingrese una dirección" type="text" name="item[direccion]" name="" value="{$item.direccion|escape:"html"}">
                                <span class="m-input-icon__icon m-input-icon__icon--right"><span><i class="fa fa-map-marker-alt"></i></span></span>
                            </div>
                            <span class="m-form__help">Ingrese una dirección, ejemplo :
                                <strong>Zona San Pedro, calle Capitan Castrillo No. 434, entre calle 20 de Octubre y calle Héroes del Acre, </strong></span>
                        </div>
                    </div>


                </div>

                <div class="m-portlet__foot m-portlet__no-border m-portlet__foot--fit">
                    <div class="m-form__actions m-form__actions--solid">
                        <div class="row">
                            <div class="col-lg-6">
                                <button type="reset" class="btn btn-primary" id="general_submit">Guardar Cambios</button>

                            </div>

                        </div>
                    </div>
                </div>
            </form>
            <!--end::Form-->
        </div>
        <!--end::Portlet-->

    </div>
</div>
{include file="index.js.tpl"}
{include file="index.css.tpl"}