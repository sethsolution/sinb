{include file="form/form.css.tpl"}

<form class="m-form m-form--fit m-form--label-align-right" method="POST"
      action="{$path_url}/{$subcontrol}_/{$item_id}/{if $type=="update"}{$id}/{/if}guardar/"
      id="form_modal_interface_{$subcontrol}">

    <div class="modal-body">
        {if $item.itemId != "" or $type == 'new'}
            <div class="alert alert-focus" role="alert">
                {if $type == 'new'}Nuevo{else} {if $privFace.editar == 1}Editar{else}Ver Datos{/if}{/if} Registro de Especie
            </div>
            {*******************mensaje de observacion************}
            {if $item.estado_id == 3}
                <div class="m-alert m-alert--icon m-alert--icon-solid m-alert--outline alert alert-danger alert-dismissible fade show" role="alert">
                    <div class="m-alert__icon">
                        <i class="flaticon-exclamation-2"></i>
                        <span></span>
                    </div>
                    <div class="m-alert__text">
                        <strong>Observación:</strong> {$item.observacion}
                    </div>
                    <div class="m-alert__close">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        </button>
                    </div>
                </div>
            {/if}

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
                        <div class="col-lg-9 m-form__group-sub">
                            <label class="form-control-label">Descripción:</label>
                            <div class="input-group">
                                <textarea class="form-control m-input mayus" placeholder="Ingrese la descripción" name="item[descripcion]" cols="4" required {$privFace.input}>{$item.descripcion|escape:'html'}</textarea>
                            </div>
                        </div>
                        <div class="col-lg-3 m-form__group-sub">
                            <br><br>
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
                                        <br>Del BRIBAMA YAC ZOO CRI 2017: 42001 AL 42500
                                     ">Ayuda de llenado</button>
                            </div>
                            {/if}
                            {if $item_padre.tipo_id == 3}
                                <div class="input-group-append">
                                    <button type="button" class="btn btn-info" data-toggle="popover"
                                            title="Ayuda para el llenado de la sección Descripción"
                                            data-content="
                                       <b>Exportación/silvestria</b>
                                       <br>Fibra de vicuña-Predescerdada o descerdada
                                     ">Ayuda de llenado</button>
                                </div>
                            {/if}
                            {if $item_padre.tipo_id == 1}
                                <div class="input-group-append">
                                    <button type="button" class="btn btn-info" data-toggle="popover"
                                            title="Ayuda para el llenado de la sección Descripción"
                                            data-content="
                                        <b>Madera-cedro (Exportación/silvestria)</b>
                                        <br>Simplemente aserrada, calidad primera. 1980 Pzs, 27635,66  Pt,  65,18 m3

                                     ">Ayuda de llenado</button>
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
                            <span class="m-form__help text-danger">Opcional (si corresponde)</span>
                        </div>
                        <div class="col-lg-8 m-form__group-sub">
                            <label class="form-control-label">Origen:</label>
                            <div class="input-group">
                                <select class="form-control"
                                        name="item[origen_id]"  {$privFace.input} id="select_origen"
                                        data-msg="Campo requerido">
                                    <option value="null">Sin Origen</option>
                                    {html_options options=$cataobj.origen selected=$item.origen_id}
                                </select>
                            </div>
                            <span class="m-form__help text-danger">Opcional (si corresponde)</span>
                        </div>
                        <div class="col-lg-12 m-form__group-sub {if $item.origen_id != "7"} m--hide{/if}" id="origen_div">
                            <label class="form-control-label">Descripción/justificación del origen desconocido:</label>
                            <div class="input-group">
                                <input type="text" class="form-control m-input mayus"
                                       placeholder="Ingrese la descripción del origen desconocido"
                                        data-msg="Campo requerido"
                                       name="item[origen_descripcion]"  {$privFace.input} value="{$item.origen_descripcion|escape:'html'}">
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
                                {*<select class="form-control m-select2 select2_general"*}
                                <select class="form-control"
                                        name="item[unidad_id]" {$privFace.input} id="select_unidad"
                                        required
                                        data-msg="Campo requerido">
                                    <option value="">Seleccione la unidad</option>
                                    {html_options options=$cataobj.unidad selected=$item.unidad_id}
                                </select>

                            </div>
                        </div>
                        <div class="col-lg-12 m-form__group-sub {if $item.unidad_id != "1"} m--hide{/if}" id="unidad_div">
                            <label class="form-control-label">Descripción de la unidad:</label>
                            <div class="input-group">
                                <input type="text" class="form-control m-input mayus"
                                       placeholder="Ingrese la descripción de la unidad que no se encuentra en el listado"
                                       {if $item.especie_id == "1"}required{/if} data-msg="Campo requerido"
                                       name="item[unidad_nombre]"  {$privFace.input} value="{$item.unidad_nombre|escape:'html'}">
                                <div class="input-group-append"><span class="input-group-text" id="basic-addon2"><i class="fa fa-layer-group"></i></span></div>
                            </div>
                        </div>

                        {if $item_padre.tipo_id == 1 }
                            <div class="col-lg-6 m-form__group-sub">
                                <label class="form-control-label">Cantidad Pt (Pies Tablares):</label>
                                <div class="input-group">
                                    <input type="text" class="form-control m-input numero_decimal"
                                           placeholder="Ingrese la cantidad Pt (Pies Tablares)"
                                           required data-msg="Campo requerido"
                                           name="item[cantidad_pt]"  {$privFace.input} value="{$item.cantidad_pt|escape:'html'}">
                                </div>
                            </div>
                            <div class="col-lg-6 m-form__group-sub">
                                <label class="form-control-label">Cantidad Pzs (Piezas):</label>
                                <div class="input-group">
                                    <input type="text" class="form-control m-input numero_decimal"
                                           placeholder="Ingrese la cantidad Pzs (Piezas)"
                                           required data-msg="Campo requerido"
                                           name="item[cantidad_pzs]"  {$privFace.input} value="{$item.cantidad_pzs|escape:'html'}">
                                </div>
                            </div>
                        {/if}


                        {if $item_padre.tipo_id == 2 or $item_padre.tipo_id == 3}
                        <div class="col-lg-6 m-form__group-sub">
                            <label class="form-control-label">Monto Bs. del item (especie):</label>
                            <div class="input-group">
                                <input type="text" class="form-control m-input numero_decimal"
                                       placeholder="Ingrese la monto en Bs." style="color:green;"
                                       required data-msg="Campo requerido"
                                       name="item[monto]"  {$privFace.input} value="{$item.monto|escape:'html'}">
                                <div class="input-group-append">
                                            <span class="input-group-text" id="basic-addon2">
                                                <i class="flaticon-coins tipo_cambio"></i>
                                            </span>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-6 m-form__group-sub">
                            <label class="form-control-label">Monto USD. del item (especie):</label>
                            <div class="input-group">
                                <input type="text" class="form-control m-input numero_decimal"
                                       placeholder="Ingrese la monto en Dólares" style="color:green;"
                                       required data-msg="Campo requerido"
                                       name="item[monto_usd]"  {$privFace.input} value="{$item.monto_usd|escape:'html'}">
                                <div class="input-group-append">
                                        <span class="input-group-text" id="basic-addon2">
                                            <i class="flaticon-coins tipo_cambio"></i>
                                        </span>
                                </div>
                            </div>
                        </div>
                        {/if}
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
                                        name="item[pais_id]" {$privFace.input} id="pais_id"
                                        required
                                        data-msg="Campo requerido">
                                    <option value="">Seleccione el Pais</option>
                                    {html_options options=$cataobj.pais selected=$item.pais_id}
                                </select>
                            </div>
                        </div>
                        {if $item_padre.tipo_documento_id == 2}
                            <div class="col-lg-6 m-form__group-sub">
                                <label class="form-control-label">Permiso Nro:</label>
                                <div class="input-group">
                                    <input type="text" class="form-control m-input mayus"
                                           placeholder="Ingrese el número de permiso"
                                           data-msg="Campo requerido"
                                           name="item[numero_permiso]"  {$privFace.input} value="{$item.numero_permiso|escape:'html'}">
                                </div>
                                <span class="m-form__help text-danger">
                                    Solo para Re-exportación <br>(N° de Permiso correspondiente al país de origen)
                                </span>
                            </div>
                        {/if}
                    </div>
                </div>
            </div>


        {else}
            <strong>El registro no existe.</strong>
        {/if}
    </div>
    <div class="modal-footer m-form__actions m-form__actions--solid m-form__actions--left m--padding-top-10 m--padding-bottom-10">
        <button type="button" class="btn btn-secondary" id="form_modal_close_{$subcontrol}" data-dismiss="modal">Cerrar</button>
        {if $privFace.editar == 1}
            <button type="button" class="btn btn-focus" id="form_modal_submit_{$subcontrol}">Guardar y continuar &nbsp;&nbsp;<i class="fa fa-angle-double-right"></i></button>
        {/if}
    </div>
</form>

{include file="form/form.js.tpl"}