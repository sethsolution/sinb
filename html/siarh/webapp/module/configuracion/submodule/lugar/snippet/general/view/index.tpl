<div class="row">
    <div class="col-lg-3">
        <div class="m-portlet m-portlet--full-height  ">
            <div class="m-portlet__body">
                <div class="m-card-profile">
                    <div class="m-card-profile__title m--hide">Imagen</div>
                    <div class="m-card-profile__pic">
                        <div class="m-card-profile__pic-wrapper"><img src="{$getModule}&accion=foto.get&id={$id}&type=3" alt="" id="persona_avatar"/></div>
                    </div>
                </div>
                <div class="m-widget1 m-widget1--paddingless">
                    <div class="row">
                        <form class="m-form m-form--fit m-form--label-align-right" method="POST"  action="{$getModule}"  id="form_avatar">
                            <input type="hidden" name="item_id" value="{$item_id}">
                            <div class="form-group m-form__group row">

                                <div class="custom-file">
                                    <input type="file" class="form-control m-input custom-file-input"
                                           placeholder="Ingrese el archivo"
                                           name="input_archivo_avatar"
                                           id="input_archivo_avatar"
                                           accept="image/jpeg,image/png"
                                                minlength="2"
                                                data-msg="Campo requerido" required
                                           name="" value="{$item.descripcion|escape:"html"}">
                                    <label class="custom-file-label" for="input_archivo_avatar">Seleccione una foto</label>
                                </div>

                                <div>
                                    <span class="m-form__help">
                                        <span class="m--font-focus">SOLO si quiere actualizar la foto, seleccione uno nuevo. </span>
                                        Puede subir solo archivos en formato <strong>JPG</strong> (.jpg)
                                        <br>
                                    </span>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-danger {if $item.adjunto_nombre == ''}m--hide{/if} btn-sm" onclick="window.location.href='{$getModule}&accion=foto.download&id={$id}'" id="">Descargar Original</button>
                                <button type="button" class="btn btn-info btn-sm" id="form_avatar_submit">Subir Foto</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-9">
        <div class="m-portlet m-portlet--tabs">
            <form class="m-form m-form--label-align-right m-form--group-seperator-dashed" method="POST" action="{$getModule}"  id="general_form">
                <div class="m-portlet__head">
                    <div class="m-portlet__head-caption">
                        <div class="m-portlet__head-title">
                            <h3 class="m-portlet__head-text"> Datos de Lugar - Ubicacion Geográfica</h3>
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
                <div class="m-portlet__body row">
                    <div class="col-md-6">
                        <div class="form-group m-form__group row">
                            <div class="col-lg-12">
                                <label>Entidad:</label>
                                <div class="m-input-icon m-input-icon--right">
                                    <select class="form-control m-select2 select2_general" name="item[entidad_id]" id="entidad_id"
                                            data-placeholder="Elija una Opcion" {$privFace.input} data-msg="Campo requerido" style="width: 100%!important;" required>
                                        <option></option>
                                        {html_options options=$cataobj.entidad selected=$item.entidad_id}
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <label>Nombre Institucion:</label>
                                <div class="m-input-icon m-input-icon--right">
                                    <input type="text" class="form-control m-input" placeholder="Ingrese el nombre de la Mascara" name="item[nombre]" value="{$item.nombre|escape:"html"}"
                                           data-msg="Campo requerido" required minlength="2">
                                    <span class="m-input-icon__icon m-input-icon__icon--right"><span><i class="la la-pencil-square-o"></i></span></span>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <label>Direccion:</label>
                                <div class="m-input-icon m-input-icon--right">
                                    <input type="text" class="form-control m-input" placeholder="Ingrese la Direccion" name="item[direccion]" value="{$item.direccion|escape:"html"}"
                                           data-msg="Campo requerido" required minlength="2">
                                    <span class="m-input-icon__icon m-input-icon__icon--right"><span><i class="la la-pencil-square-o"></i></span></span>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <label>Latitud:</label>
                                <div class="m-input-icon m-input-icon--right">
                                    <input type="text" class="form-control m-input" placeholder="Ingrese Latitud" name="item[latitud]" value="{$item.latitud|escape:"html"}"
                                           data-msg="Campo requerido" id="latitud" required minlength="2" readonly="readonly">
                                    <span class="m-input-icon__icon m-input-icon__icon--right"><span><i class="la la-pencil-square-o"></i></span></span>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <label>Longitud:</label>
                                <div class="m-input-icon m-input-icon--right">
                                    <input type="text" class="form-control m-input" placeholder="Ingrese Longitud" name="item[longitud]" value="{$item.longitud|escape:"html"}"
                                           data-msg="Campo requerido" id="longitud" required minlength="2" readonly="readonly">
                                    <span class="m-input-icon__icon m-input-icon__icon--right"><span><i class="la la-pencil-square-o"></i></span></span>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <label>Telefonos:</label>
                                <div class="m-input-icon m-input-icon--right">
                                    <input type="text" class="form-control m-input" placeholder="Ingrese los Telefonos" name="item[telefonos]" value="{$item.telefonos|escape:"html"}"
                                           data-msg="Campo requerido" required minlength="2">
                                    <span class="m-input-icon__icon m-input-icon__icon--right"><span><i class="la la-pencil-square-o"></i></span></span>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <label>Archivo:</label>
                                <div class="m-input-icon m-input-icon--right">
                                    <input type="text" class="form-control m-input" placeholder="Ingrese los Telefonos" name="item[adjunto_nombre]" value="{$item.adjunto_nombre|escape:"html"}"
                                           data-msg="Campo requerido" readonly="readonly">
                                    <span class="m-input-icon__icon m-input-icon__icon--right"><span><i class="la la-pencil-square-o"></i></span></span>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <label>Extesion:</label>
                                <div class="m-input-icon m-input-icon--right">
                                    <input type="text" class="form-control m-input" placeholder="Ingrese los Telefonos" name="item[adjunto_extension]" value="{$item.adjunto_extension|escape:"html"}"
                                           data-msg="Campo requerido" readonly="readonly">
                                    <span class="m-input-icon__icon m-input-icon__icon--right"><span><i class="la la-pencil-square-o"></i></span></span>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <label>Tipo:</label>
                                <div class="m-input-icon m-input-icon--right">
                                    <input type="text" class="form-control m-input" placeholder="Ingrese los Telefonos" name="item[adjunto_tipo]" value="{$item.adjunto_tipo|escape:"html"}"
                                           data-msg="Campo requerido" readonly="readonly">
                                    <span class="m-input-icon__icon m-input-icon__icon--right"><span><i class="la la-pencil-square-o"></i></span></span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <input id="mapsearch" class="form-control m-input controls hidden" type="text" placeholder="Buscar Lugar ...">
                        <div id="googleMap" style="height:350px;"></div>
                        <hr>
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
        </div>
    </div>
</div>
{include file="index.js.tpl"}
{include file="index.css.tpl"}