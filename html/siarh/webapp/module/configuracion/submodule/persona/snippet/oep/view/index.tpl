<div class="row">
    <div class="col-lg-12">
        {if $item_oep.itemId != ''}
            <div class="m-portlet__head">
                <div class="m-portlet__head-caption">
                    <div class="m-portlet__head-title"><span class="m-portlet__head-icon "><i class="fa fa-user-tag"></i></span>
                        <h3 class="m-portlet__head-text">Datos Personales OEP</h3>
                    </div>
                </div>
            </div>


            <div class="m-portlet__body">
                <div class="form-group m-form__group row">
                    <label class="col-lg-1 col-form-label">Nombres:</label>
                    <div class="col-lg-3"><input type="text" class="form-control m-input" placeholder="" value="{$item_oep.nombres|escape:"html"}" disabled></div>
                    <label class="col-lg-1 col-form-label">Apellido Paterno:</label>
                    <div class="col-lg-3">
                        <input type="text" class="form-control m-input" placeholder="" value="{$item_oep.paterno|escape:"html"}" disabled>
                    </div>
                    <label class="col-lg-1 col-form-label">Apellido Materno:</label>
                    <div class="col-lg-3">
                        <input type="text" class="form-control m-input" placeholder="" value="{$item_oep.materno|escape:"html"}" disabled>
                    </div>
                </div>

                <div class="form-group m-form__group row">
                    <label class="col-lg-1 col-form-label">Apellido Casada:</label>
                    <div class="col-lg-3"><input type="text" class="form-control m-input" placeholder="" value="{$item_oep.apesposo|escape:"html"}" disabled></div>
                    <label class="col-lg-1 col-form-label">Fecha de Nacimiento:</label>
                    <div class="col-lg-3">
                        <input type="text" class="form-control m-input" placeholder="" value="{$item_oep.nacimiento|escape:"html"}" disabled>
                    </div>
                    <label class="col-lg-1 col-form-label">Estado:</label>
                    <div class="col-lg-3">
                        <input type="text" class="form-control m-input" placeholder="" value="{$item_oep.estado|escape:"html"}" disabled>
                    </div>
                </div>
            </div>

            <div class="m-portlet__head">
                <div class="m-portlet__head-caption">
                    <div class="m-portlet__head-title"><span class="m-portlet__head-icon"><i class="fa flaticon-interface-11"></i></span>
                        <h3 class="m-portlet__head-text">Recinto OEP</h3>
                    </div>
                </div>
            </div>


            <div class="m-portlet__body">
                <div class="form-group m-form__group row">
                    <label class="col-lg-1 col-form-label">Nombre:</label>
                    <div class="col-lg-7"><input type="text" class="form-control m-input" placeholder="" value="{$item_oep.recinto_nombre|escape:"html"}" disabled></div>
                    <label class="col-lg-1 col-form-label">Mesa:</label>
                    <div class="col-lg-3">
                        <input type="text" class="form-control m-input" placeholder="" value="{$item_oep.recinto_mesa|escape:"html"}" disabled>
                    </div>
                </div>
                <div class="form-group m-form__group row">
                    <label class="col-lg-1 col-form-label">Dirección:</label>
                    <div class="col-lg-11"><input type="text" class="form-control m-input" placeholder="" value="{$item_oep.recinto_direccion|escape:"html"}" disabled></div>

                </div>

                <div class="form-group m-form__group row">
                    <label class="col-lg-1 col-form-label">Depto:</label>
                    <div class="col-lg-3">
                        <input type="text" class="form-control m-input" placeholder="" value="{$item_oep.recinto_depto_ciudad|escape:"html"}" disabled>
                    </div>
                    <label class="col-lg-1 col-form-label">Latitud:</label>
                    <div class="col-lg-3"><input type="text" class="form-control m-input" placeholder="" value="{$item_oep.recinto_latitud|escape:"html"}" disabled></div>
                    <label class="col-lg-1 col-form-label">Longitud:</label>
                    <div class="col-lg-3">
                        <input type="text" class="form-control m-input" placeholder="" value="{$item_oep.recinto_longitud|escape:"html"}" disabled>
                    </div>

                </div>


            </div>


            <div class="m-portlet__head">
                <div class="m-portlet__head-caption">
                    <div class="m-portlet__head-title"><span class="m-portlet__head-icon"><i class="fa flaticon-map-location"></i></span>
                        <h3 class="m-portlet__head-text">Mapa</h3>
                    </div>
                </div>
            </div>

            <div id="oep_map"  class="siarh_map" style="height:500px;"></div>
            {include file="index.leaflet.js.tpl"}
            {*include file="index.js.tpl"*}
        {else}
            <div class="m-portlet__head">
                <div class="m-portlet__head-caption">
                    <div class="m-portlet__head-title"><span class="m-portlet__head-icon "><i class="la la-gear"></i></span>
                        <h3 class="m-portlet__head-text">Datos Personales OEP</h3>
                    </div>
                </div>
            </div>

            <div class="m-portlet__body">
                <div class="form-group m-form__group row">
                    <div class="col-lg-12">
                        <div class="m-alert m-alert--icon m-alert--icon-solid m-alert--outline alert alert-danger alert-dismissible fade show" role="alert">
                            <div class="m-alert__icon">
                                <i class="flaticon-signs-2"></i>
                                <span></span>
                            </div>
                            <div class="m-alert__text">



                            </div>

                        </div>
                        <strong>Alerta!</strong>
                        {if $item.oep_respuesta == 'Person not found'}
                            <br>
                            No se ha logrado encontrar los dataos del usuario en la base de datos de la OEP
                            <br>
                            Uno de los siguientes datos son incorrectos
                            C.I.: <strong{$item.ci}</strong> /
                                                             Fecha de nacimiento: <strong>{$item.fecha_nacimiento}</strong>
                        {/if}

                        {if $item.oep_respuesta == ''}
                            <br>
                            No se ha generado la llave para realizar la consulta a la OEP<br>
                            Uno de los siguientes datos no se ha registrado<br>
                            C.I.: <strong{$item.ci}</strong> <br>
                            Fecha de nacimiento: <strong>{$item.fecha_nacimiento}</strong><br>
                        {/if}

                    </div>
                </div>

            </div>

        {/if}
    </div>
</div>


{include file="index.css.tpl"}