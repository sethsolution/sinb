{include file="form/form.css.tpl"}

<form class="m-form m-form--fit m-form--label-align-right" method="POST"
      action="{$getModule}"
      id="form_modal_interface_{$subcontrol}">

    <div class="modal-body row">
        {if $item.itemId != "" or $type == 'new'}

            <div class="alert alert-focus col-lg-12" role="alert">
                Ver Datos Registro
            </div>
        <div class="col-lg-6">

            <div class="form-group m-form__group row m--padding-top-5 m--padding-bottom-5 m--padding-left-15 m--padding-right-15" >
                <div class="col-lg-12  m-form__group-sub" >
                    <div class="cuadro m--padding-5 row">
                        <div class="col-lg-12 titulo m--margin-bottom-5 m--padding-left-5">
                            7/8. Nombre científico y nombre común del animal o planta (género y especie)
                        </div>
                        <div class="col-lg-12 m-form__group-sub">
                            <label class="form-control-label">Seleccione la especie a movilizar:</label>
                            <div class="input-group">
                                <select class="form-control m-select2 select2_general_bus"
                                        name="item[especie_id]"  {$privFace.input} id="select_activo"
                                        required
                                        data-msg="Campo requerido">
                                    {*<option value="NULL">Sin Dato</option>*}
                                    <option value=""></option>
                                    {html_options options=$cataobj.especie selected=$item.especie_id}
                                </select>
                            </div>
                            <span class="m-form__help text-info text-info ">Nombre cientifico (Nombre Común) </span>
                        </div>
                        <div class="col-lg-12 m-form__group-sub {if $item.especie_id != "1"} m--hide{/if}" id="nombre_div">
                            <label class="form-control-label">Nombre Común de la Especie:</label>
                            <div class="input-group">
                                <input type="text" class="form-control m-input mayus"
                                       placeholder="Ingrese el nombre de la especie"
                                        {if $item.especie_id == "1"}required{/if} data-msg="Campo requerido"
                                       name="item[especie_nombre]"  {$privFace.input} value="{$item.especie_nombre|escape:'html'}">
                                <div class="input-group-append"><span class="input-group-text" id="basic-addon2"><i class="fa fa-layer-group"></i></span></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="form-group m-form__group row m--padding-top-5 m--padding-bottom-5 m--padding-left-15 m--padding-right-15 " >
                <div class="col-lg-12  m-form__group-sub" >
                    <div class="cuadro m--padding-5 row">
                        <div class="col-lg-12 titulo m--margin-bottom-5 m--padding-left-5">
                            9. Descripción de los especímenes: Incluso las marcas o números de identificación (edad/sexo, si vivos)
                        </div>
                        <div class="col-lg-12 m-form__group-sub">
                            <label class="form-control-label">Descripción:</label>
                            <div class="input-group">
                                <textarea  class="form-control m-input mayus"
                                           placeholder="Ingrese la descripción" name="item[descripcion]"
                                           cols="4"   required {$privFace.input}>{$item.descripcion|escape:'html'}</textarea>
                            </div>
                        </div>
                        <div class="col-lg-12 m-form__group-sub">

                            {if $item_padre.tipo_id == 2}
                            <div class="input-group-append">
                                <button type="button" class="btn btn-info" data-toggle="popover"
                                        title="Ayuda para el llenado de la sección Descripción"
                                        data-content="
                                        <b>Exportación/Silvestria</b>
                                        <br>1000 Flancos enteros en CRUSTE
                                        <br>Del BO YAC 2014:0016143 AL 0017142
                                        <br>
                                        <b>Exportación/ZOOCRIA</b>
                                        <br>1000 Cortes en Cruste con peso 39,2 Kg. Equivalente a 125 Pieles trozadas
                                        <br>
                                        <b>Re-exportación/zoocria</b>
                                        <br>500 Pieles en WET BLUE
                                        <br>Del BRIBAMA YAC 2017: 42001 AL 42500
                                     ">Ayuda para el llenado</button>
                            </div>
                            {/if}
                            {if $item_padre.tipo_id == 3}
                                <div class="input-group-append">
                                    <button type="button" class="btn btn-info" data-toggle="popover"
                                            title="Ayuda para el llenado de la sección Descripción"
                                            data-content="
                                       <b>Exportación/silvestria</b>
                                       <br>Fibra de vicuña-Predescerdada o descerdada
                                     ">Ayuda para el llenado</button>
                                </div>
                            {/if}
                            {if $item_padre.tipo_id == 1}
                                <div class="input-group-append">
                                    <button type="button" class="btn btn-info" data-toggle="popover"
                                            title="Ayuda para el llenado de la sección Descripción"
                                            data-content="
                                        <b>Madera-cedro (Exportación/silvestria)</b>
                                        <br>Simplemente aserrada, calidad primera. 1980 Pzs, 27635,66  Pt,  65,18 m3

                                     ">Ayuda para el llenado</button>
                                </div>
                            {/if}
                        </div>

                    </div>
                </div>
            </div>

            <div class="form-group m-form__group row m--padding-top-5 m--padding-bottom-5 m--padding-left-15 m--padding-right-15 " >
                <div class="col-lg-12  m-form__group-sub" >
                    <div class="cuadro m--padding-5 row">
                        <div class="col-lg-12 titulo m--margin-bottom-5 m--padding-left-5">
                            10. Apéndice y origen
                        </div>
                        <div class="col-lg-4 m-form__group-sub">
                            <label class="form-control-label">Apéndice:</label>
                            <div class="input-group">
                                <select class="form-control m-select2 select2_general"
                                        name="item[apendice_id]"  {$privFace.input} id="apendice_id"
                                        data-msg="Campo requerido">
                                    <option value="null">Sin Apéndice</option>
                                    {html_options options=$cataobj.apendice selected=$item.apendice_id}
                                </select>
                            </div>
                            <span class="m-form__help text-info">Opcional</span>
                        </div>
                        <div class="col-lg-8 m-form__group-sub">
                            <label class="form-control-label">Origen:</label>
                            <div class="input-group">
                                <select class="form-control m-select2 select2_general"
                                        name="item[origen_id]"  {$privFace.input} id="origen_id"

                                        data-msg="Campo requerido">
                                    <option value="null">Sin Origen</option>
                                    {html_options options=$cataobj.origen selected=$item.origen_id}
                                </select>
                            </div>
                            <span class="m-form__help text-info">Opcional</span>
                        </div>
                    </div>
                </div>
            </div>

            <div class="form-group m-form__group row m--padding-top-5 m--padding-bottom-5 m--padding-left-15 m--padding-right-15 " >
                <div class="col-lg-12  m-form__group-sub" >
                    <div class="cuadro m--padding-5 row">
                        <div class="col-lg-12 titulo m--margin-bottom-5 m--padding-left-5">
                            11. Cantidad (incluyendo la unidad)
                        </div>
                        <div class="col-lg-6 m-form__group-sub">
                            <label class="form-control-label">Cantidad:</label>
                            <div class="input-group">
                                <input type="text" class="form-control m-input numero_decimal"
                                       placeholder="Ingrese la cantidad"
                                       required data-msg="Campo requerido"
                                       name="item[cantidad]"  {$privFace.input} value="{$item.cantidad|escape:'html'}">
                            </div>
                        </div>
                        <div class="col-lg-6 m-form__group-sub">
                            <label class="form-control-label">Unidad:</label>
                            <div class="input-group">
                                <select class="form-control m-select2 select2_general"
                                        name="item[unidad_id]"  {$privFace.input} id="unidad_id"
                                        required
                                        data-msg="Campo requerido">
                                    <option value=""></option>
                                    {html_options options=$cataobj.unidad selected=$item.unidad_id}
                                </select>

                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="form-group m-form__group row m--padding-top-5 m--padding-bottom-5 m--padding-left-15 m--padding-right-15 " >
                <div class="col-lg-12  m-form__group-sub" >
                    <div class="cuadro m--padding-5 row">
                        <div class="col-lg-12 titulo m--margin-bottom-5 m--padding-left-5">
                            12. a/b País de Origen
                        </div>
                        <div class="col-lg-6 m-form__group-sub">
                            <label class="form-control-label">País:</label>
                            <div class="input-group">
                                <select class="form-control"
                                        name="item[pais_id]"  {$privFace.input} id="pais_id"
                                        required
                                        data-msg="Campo requerido">
                                    <option value=""></option>
                                    {html_options options=$cataobj.pais selected=$item.pais_id}
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-6 m-form__group-sub">
                            <label class="form-control-label">Permiso N:</label>
                            <div class="input-group">
                                <input type="text" class="form-control m-input mayus"
                                       placeholder="Ingrese el número de permiso"
                                       data-msg="Campo requerido"
                                       name="item[numero_permiso]"  {$privFace.input} value="{$item.numero_permiso|escape:'html'}">
                            </div>
                            <span class="m-form__help text-info">
                                Solo para Re-exportación (Permiso inicial del pais de Origen)
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>



        <div class="col-lg-6">


            <div class="m-widget1 cuadro-obs-especie m--padding-10 m--margin-bottom-10">
                {if $item_padre.tipo_id == 2 or $item.tipo_id == 2 }
                    <div class="m-portlet__head">
                        <div class="m-portlet__head-caption">
                            <div class="m-portlet__head-title">
                                <h4 class="m--font-brand">Agregar la información de CUPO EXPORTADO</h4>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-12 m--margin-bottom-5 m--padding-left-5">11.a Total exportado / cupo:</div>
                    <div class="form-group m-form__group row m--padding-bottom-5 m--padding-top-5" >
                        <div class="col-lg-6 m-form__group-sub m--padding-right-5 m--padding-left-5" >
                            <div class="cuadro m--padding-10">
                                <div class="col-lg-12 titulo m--margin-bottom-5 m--padding-left-5">Cupo Exportado:</div>
                                <input type="text" class="form-control m-input number"
                                       placeholder="Cupo solicitado en el certificado" name="item[cupo_solicitado]"
                                        {$privFace.input} value="{$item.cupo_solicitado|escape:'html'}">
                            </div>
                        </div>
                        <div class="col-lg-6 m-form__group-sub m--padding-right-5 m--padding-left-5" >
                            <div class="cuadro m--padding-10">
                                <div class="col-lg-12 titulo m--margin-bottom-5 m--padding-left-5">Cupo Total:</div>
                                <div class="input-group">
                                    <input type="text" class="form-control m-input number"
                                           placeholder="Cupo Total designado" name="item[cupo_total]"
                                            {$privFace.input} value="{$item.cupo_total|escape:'html'}">
                                </div>
                            </div>
                        </div>
                    </div>
                {/if}

                <div class="m-portlet__head"  >
                    <div class="m-portlet__head-caption" >
                        <div class="m-portlet__head-title">
                            <h4 class="m--font-danger">
                                VERIFICAR LOS DATOS DE LA ESPECIE (partes o derivados)
                            </h4>
                        </div>
                    </div>
                </div>

                {if $item_padre.estado_id ==2}
                <div class="form-group  m-form row">
                    <div class="col-lg-12 m-form__group-sub">
                        <label class="form-control-label">Cambiar Estado: </label>
                        <div class="input-group">
                            <select class="form-control m-select2 select2_general"
                                    name="item[estado_id]"  {$privFace.input} id="select_estado"
                                    required
                                    data-msg="Campo requerido">
                                <option value=""></option>
                                {html_options options=$cataobj.estado selected=$item.estado_id}
                            </select>

                        </div>
                    </div>


                    <div class="col-lg-12 m-form__group-sub {if $item.estado_id !=3}m--hide{/if}" id="observacion_msg">
                        <label class="form-control-label">Observación:</label>
                        <div class="input-group">
                            <div class="summernote" id="observacion">{$item.observacion}</div>
                            <input class="form-control m-input" type="hidden" name="item[observacion]" id="observacion_input" {$privFace.input}>
                        </div>
                    </div>
                </div>
            {/if}


            <div class="m--hide m-alert m-alert--icon m-alert--icon-solid m-alert--outline alert alert-success alert-dismissible fade show"
                 id="aprobado_alerta"
                 role="alert">
                <div class="m-alert__icon">
                    <i class="flaticon-exclamation-2"></i>
                    <span></span>
                </div>
                <div class="m-alert__text">
                    Usted esta aprobando esta especie, <strong>Si realiza esta acción no podrá volver atras.</strong>
                </div>
                <div class="m-alert__close">
                    {*<button type="button" class="close" data-dismiss="alert" aria-label="Close"></button>*}
                </div>
            </div>

            {if $item.estado_id == 3 and $item.observacion != ""}
                <div class="m-alert m-alert--icon m-alert--icon-solid m-alert--outline alert alert-danger alert-dismissible fade show" role="alert">
                    <div class="m-alert__icon">
                        <i class="flaticon-exclamation-2"></i>
                        <span></span>
                    </div>
                    <div class="m-alert__text">
                        <strong>Observación:</strong> {$item.observacion}
                        <br>
                        Fecha de observación, <strong>{$item.observacion_fecha|date_format:"%d/%m/%Y %H:%M:%S"}</strong>
                    </div>
                    <div class="m-alert__close">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        </button>
                    </div>
                </div>
            {/if}

            {if $item.estado_id == 4 }
                <div class="m-alert m-alert--icon m-alert--icon-solid m-alert--outline alert alert-success alert-dismissible fade show"
                     id="aprobado_alerta"
                     role="alert">
                    <div class="m-alert__icon">
                        <i class="flaticon-exclamation-2"></i>
                        <span></span>
                    </div>
                    <div class="m-alert__text">
                        Fecha de Aprobación, <strong>{$item.aprobado_fecha|date_format:"%d/%m/%Y %H:%M:%S"}</strong>
                    </div>
                    <div class="m-alert__close">
                        {*<button type="button" class="close" data-dismiss="alert" aria-label="Close"></button>*}
                    </div>
                </div>
            {/if}
        </div>
    </div>

        {else}
            <div class="col-lg-12">
                <strong>El registro no existe.</strong>
            </div>
        {/if}
    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-secondary" id="form_modal_close_{$subcontrol}" data-dismiss="modal">Cerrar</button>
        {if $privFace.editar == 1}
            <button type="button" class="btn btn-focus" id="form_modal_submit_{$subcontrol}">Guardar y cambiar estado &nbsp;&nbsp;<i class="fa fa-angle-double-right"></i></button>
        {/if}
    </div>
</form>

{include file="form/form.js.tpl"}