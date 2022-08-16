{include file="index.css.tpl"}

<!--Begin::Main Portlet-->
<div class="m-portlet m-portlet--full-height">

    <!--begin: Portlet Head-->
    <div class="m-portlet__head">
        <div class="m-portlet__head-caption">
            <div class="m-portlet__head-title">
                <h3 class="m-portlet__head-text">
                    Registro Inicial de Usuario
                    <small>Formulario de Registro</small>
                </h3>
            </div>
        </div>
        <div class="m-portlet__head-tools">
            <ul class="m-portlet__nav">
                <li class="m-portlet__nav-item">
                    {*
                    <a href="#" data-toggle="m-tooltip" class="m-portlet__nav-link m-portlet__nav-link--icon" data-direction="left" data-width="auto" title="Get help with filling up this form">
                        <i class="flaticon-info m--icon-font-size-lg3"></i>
                    </a>
                    *}
                </li>
            </ul>
        </div>
    </div>


    <!--begin::Form-->
    <form class="m-form m-form--fit m-form--label-align-right" method="POST"
          action="{$path_url}/guardar/"
          id="general_form">

        <div class="m-portlet__body">
            <div class="form-group m-form__group m--margin-top-10">
                <div class="alert m-alert m-alert--default" role="alert">
                    Llenado de la siguiente información inicial
                </div>
            </div>



            <div class="form-group m-form__group">
                <label for="exampleInputEmail1">Tipo de Usuario</label>
                <select class="form-control m-select2 select2_general "
                        name="item[tipo_id]"  {$privFace.input} id="tipo_id"
                        required
                        data-msg="Este campo es requerido, registre la información." >
                    <option value=""></option>
                    {html_options options=$cataobj.empresa_tipo selected=$item.tipo_id}
                </select>
                <span class="m-form__help">Seleccione el tipo de usuario a registrar, No podrá realizar el cambio despues.</span>
            </div>

            <div class="form-group m-form__group">
                <label for="exampleInputEmail1">Correo Electrónico (Usuario)</label>
                <input type="email" class="form-control m-input"
                       placeholder="Ingrese Correo electrónico" name="item[usuario]" id="usuario"
                       value="" required
                       data-msg="Ingrese Correo electrónico">

                <span class="m-form__help">Se enviara un correo de verificación a su cuenta de correo electrónico.</span>
            </div>
            <div class="form-group m-form__group">
                <label for="exampleInputPassword1">Contraseña</label>
                <input type="password" class="form-control m-input"
                       placeholder="Ingrese Contraseña" name="item[password]" id="password"
                        value="" required
                       data-msg="Ingrese su contraseña">
            </div>

        </div>
        <div class="m-portlet__foot m-portlet__foot--fit">
            {*
            <div class="m-form__actions">
                <button type="reset" class="btn btn-primary">Submit</button>
                <button type="reset" class="btn btn-secondary">Cancel</button>
            </div>
*}

            <div class="m-form__actions m-form__actions--solid m-form__actions--left">
                <button type="reset" class="btn btn-success" id="general_submit">
                    <span> Registrar Usuario &nbsp; </span>
                </button>
                <a class="btn btn-info" href="/ingreso" role="button">  <span> Volver <i class="fa fa-angle-double-left"></i>&nbsp; </span></a>

            </div>


            <div  style="text-align: center;font-size: 10px; color: #7c7c7c; ">
                <img src="/images/logo/otca.png" width="350"><br>
                El presente sistema ha sido desarrollado en colaboración entre el MMAyA y el Proyecto Bioamazonía,<br>
                proyecto de desarrollo de la Organización del Tratado de Cooperación Amazónica (OTCA),<br>
                cofinanciado por la República Federal de Alemania a través de KfW.
                <br><br>
            </div>

        </div>


    </form>
    <!--end: Portlet Head-->


</div>

<!--End::Main Portlet-->

