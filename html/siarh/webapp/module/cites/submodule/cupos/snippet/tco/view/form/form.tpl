{include file="form/form.css.tpl"}

<form class="m-form m-form--fit m-form--label-align-right" method="POST"
      action="{$getModule}"
      id="form_modal_interface_{$subcontrol}">

    <div class="modal-body">
        {if $item.itemId != "" or $type == 'new'}
            <div class="alert alert-focus" role="alert">
                {if $type == 'new'}Ingrese{else} {if $privFace.editar == 1}Editar{else}Ver Datos{/if}{/if} los siguientes datos del Depósito bancario
            </div>


            <div class="form-group  m-form row">
                <div class="col-lg-6 m-form__group-sub">
                    <label class="form-control-label">Departamento:</label>
                    <div class="input-group">
                        <select class="form-control m-select2 select2_general_form"
                                name="item[cupo_id]"  {$privFace.input} id="cupo_id"
                                required
                                data-msg="Campo requerido">
                            <option value=""></option>
                            {html_options options=$cataobj.departamento selected=$item.cupo_id}
                        </select>
                    </div>
                </div>

                <div class="col-lg-6 m-form__group-sub">
                    <label class="form-control-label">TCO/PREDIO:</label>
                    <div class="input-group">
                        <select class="form-control m-select2 select2_general_form"
                                name="item[tco_id]"  {$privFace.input} id="tco_id"
                                required
                                data-msg="Campo requerido">
                            <option value=""></option>
                            {html_options options=$cataobj.tco selected=$item.tco_id}
                        </select>
                    </div>
                </div>

                <div class="col-lg-12 m-form__group-sub">
                    <label class="form-control-label">Cupo:</label>
                    <div class="input-group">
                        <input type="text" class="form-control m-input numero_entero monto"
                               placeholder="Ingrese cupo"
                               required data-msg="Este campo es requerido."
                               name="item[cupo_autorizado]"  {$privFace.input} value="{$item.cupo_autorizado|escape:'html'}">
                        <div class="input-group-append"><span class="input-group-text" id="basic-addon2"><i class="fa fa-money-bill"></i></span></div>
                    </div>
                </div>


                <div class="col-lg-12 m-form__group-sub">
                    <label class="form-control-label">Descripción:</label>
                    <div class="input-group">
                        <input type="text" class="form-control m-input mayus" placeholder="Ingrese una descripción"
                               name="item[descripcion]" {$privFace.input}
                               value="{$item.descripcion|escape:'html'}"
                               data-msg="Este campo es requerido.">
                        <div class="input-group-append"><span class="input-group-text" id="basic-addon2"><i class="fa fa-user-tag"></i></span></div>
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
            <button type="button" class="btn btn-focus" id="form_modal_submit_{$subcontrol}">Guardar y continuar&nbsp;&nbsp;<i class="fa fa-angle-double-right"></i></button>
        {/if}
    </div>
</form>

{include file="form/form.js.tpl"}