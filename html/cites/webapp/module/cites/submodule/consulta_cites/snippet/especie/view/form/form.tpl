{include file="form/form.css.tpl"}

<form class="m-form m-form--fit m-form--label-align-right" method="POST"
      action="{$path_url}/{$subcontrol}_/{$item_id}/{if $type=="update"}{$id}/{/if}guardar/"
      id="form_modal_interface_{$subcontrol}">

    <div class="modal-body">
        {if $item.itemId != "" or $type == 'new'}
            <div class="alert alert-focus" role="alert">
                {if $type == 'new'}Nuevo{else} {if $privFace.editar == 1}Editar{else}Ver Datos{/if}{/if} Registro de Depósito
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
                            7/8. Nombre científico y nombre común del animal o planta (genero y especie)
                        </div>
                        <div class="col-lg-12 m-form__group-sub">
                            <label class="form-control-label">Especie:</label>
                            <div class="input-group">
                                <select class="form-control m-select2 select2_general"
                                        name="item[especie_id]"  {$privFace.input} id="especie_id"
                                        required
                                        data-msg="Campo requerido">
                                    {*<option value="NULL">Sin Dato</option>*}
                                    <option value=""></option>
                                    {html_options options=$cataobj.especie selected=$item.especie_id}
                                </select>

                            </div>
                        </div>
                        <div class="col-lg-12 m-form__group-sub">
                            <label class="form-control-label">Nombre de la Especie:</label>
                            <div class="input-group">
                                <input type="text" class="form-control m-input"
                                       placeholder="Ingrese el nombre de la especie"
                                       required data-msg="Campo requerido"
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
                            9. Descripción de los especímenes: Incluso las marcas o núeros de identificación (edad/sexo/, si vivos).
                        </div>
                        <div class="col-lg-12 m-form__group-sub">
                            <label class="form-control-label">Descripción:</label>
                            <div class="input-group">
                        <textarea  class="form-control m-input"
                                   placeholder="Ingrese la descripción" name="item[descripcion]"
                                   cols="4"   required {$privFace.input}
                        >{$item.descripcion|escape:'html'}</textarea>
                            </div>
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
                                    <option value="null">Sin Apendice</option>
                                    {html_options options=$cataobj.apendice selected=$item.apendice_id}
                                </select>

                            </div>
                        </div>
                        <div class="col-lg-8 m-form__group-sub">
                            <label class="form-control-label">Origen:</label>
                            <div class="input-group">
                                <select class="form-control m-select2 select2_general"
                                        name="item[origen_id]"  {$privFace.input} id="origen_id"
                                        required
                                        data-msg="Campo requerido">
                                    <option value=""></option>
                                    {html_options options=$cataobj.origen selected=$item.origen_id}
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
                            11. Cantidad (incluyendo la unidad)
                        </div>
                        <div class="col-lg-6 m-form__group-sub">
                            <label class="form-control-label">Cantidad:</label>
                            <div class="input-group">
                                <input type="text" class="form-control m-input numero_decimal"
                                       placeholder="Ingrese cantidad"
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
                            12a/b País de Origen / Permiso N
                        </div>
                        <div class="col-lg-6 m-form__group-sub">
                            <label class="form-control-label">País:</label>
                            <div class="input-group">
                                <select class="form-control m-select2 select2_general"
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
                                <input type="text" class="form-control m-input "
                                       placeholder="Ingrese el número de permiso"
                                       required data-msg="Campo requerido"
                                       name="item[numero_permiso]"  {$privFace.input} value="{$item.numero_permiso|escape:'html'}">
                            </div>
                        </div>
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
            <button type="button" class="btn btn-focus" id="form_modal_submit_{$subcontrol}">Guardar</button>
        {/if}
    </div>
</form>

{include file="form/form.js.tpl"}