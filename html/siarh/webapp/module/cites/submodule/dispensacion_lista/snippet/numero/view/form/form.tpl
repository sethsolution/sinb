{include file="form/form.css.tpl"}

<form class="m-form m-form--fit m-form--label-align-right" method="POST"
      action="{$getModule}"
      id="form_modal_interface_{$subcontrol}">

    <div class="modal-body">
        {if $item.itemId != "" or $type == 'new'}
            <div class="alert alert-focus" role="alert">
                {if $type == 'new'}Nuevo{else} {if $privFace.editar == 1}Editar{else}Ver Datos{/if}{/if} Registro de número
            </div>

<!--            <div class="form-group m-form__group row m--padding-top-5 m--padding-bottom-5 m--padding-left-15 m--padding-right-15" >
                <div class="col-lg-12  m-form__group-sub" >
                    <div class="cuadro m--padding-5 row">
                        <div class="col-lg-12 titulo m--margin-bottom-5 m--padding-left-5">
                            Seleccione un número de asignación
                        </div>
                        <div class="col-lg-12 m-form__group-sub">
                            <label class="form-control-label">Número:</label>
                            <div class="input-group">
                                <select class="form-control m-select2 select2_general_bus"
                                        name="item[numero_id]"  {$privFace.input} id="select_activo"
                                        required id="numero_id"
                                        data-msg="Campo requerido">
                                    <option value=""></option>
                                    {html_options options=$cataobj.numero selected=$item.numero_id}
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
-->
            <div class="form-group m-form__group row m--padding-top-5 m--padding-bottom-5 m--padding-left-15 m--padding-right-15 " >
                <div class="col-lg-12  m-form__group-sub" >
                    <div class="cuadro m--padding-5 row">
                        <div class="col-lg-12 titulo m--margin-bottom-5 m--padding-left-5">
                            Ingrese el número de Dispensación asignado
                            <!--Descripción-->
                        </div>
                        <div class="col-lg-12 m-form__group-sub">
                            <!--<label class="form-control-label">Descripción:</label>-->
                            <div class="input-group">
                                <textarea class="form-control m-input mayus" placeholder="Ingrese la descripción del número" name="item[descripcion]"
                                          cols="4"  {$privFace.input}>{$item.descripcion|escape:'html'}</textarea>
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
            <button type="button" class="btn btn-focus" id="form_modal_submit_{$subcontrol}">Guardar y continuar &nbsp;&nbsp;<i class="fa fa-angle-double-right"></i></button>
        {/if}
    </div>
</form>

{include file="form/form.js.tpl"}