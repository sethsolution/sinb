{include file="item/sustitucion/index.css.tpl"}

<form class="m-form m-form--fit m-form--label-align-right" method="POST"
      action="{$path_url}/{$id}/guardar.detalle/"
      id="general_form_sustitucion"
      id="form_modal_interface_{$subcontrol}">

    <div class="modal-body">
        {if $item.itemId != "" or $type == 'new'}
            <div class="alert alert-success" role="alert">
                Realizar Sustitución
            </div>

            <div class="form-group  m-form row">
                <div class="col-lg-12 m-form__group-sub ">
                    <label class="form-control-label">Motivo:</label>
                    <div class="input-group">

                            <select class="form-control m-select2 select2_general_sustitucion "
                                    name="item[tipo_id]"  {$privFace.input} id="tipo_id"
                                    required
                                    data-msg="Campo requerido" >
                                <option value=""></option>
                                {*html_options options=$cataobj.tipo selected=$item.tipo_id*}
                                {html_options options=$cataobj.tipo}
                            </select>
                    </div>
                </div>

                <div class="col-lg-12 m-form__group-sub  m--hide" id="causa_div">
                    <label class="form-control-label">Causa de la Sustitución:</label>
                    <div class="input-group">

                            <select class="form-control m-select2 select2_general_sustitucion " style="width: 100%;"
                                    name="item[causal_id]"  {$privFace.input} id="causal_id"
                                    data-msg="Campo requerido" >
                                <option value=""></option>
                                {*html_options options=$cataobj.causal selected=$item.causal_id*}
                                {html_options options=$cataobj.causal }
                            </select>

                    </div>
                </div>

            </div>

        {else}
            <strong>El registro no existe.</strong>
        {/if}
    </div>

    <div class="modal-footer m-form__actions m-form__actions--solid m-form__actions--left m--padding-top-10 m--padding-bottom-10">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
        {if $privFace.editar == 1}
            <button type="button" class="btn btn-focus" id="general_submit_sustitucion">Sustituir <i class="fa fa-angle-double-right"></i></button>
        {/if}
    </div>
</form>
{include file="item/sustitucion/index.js.tpl"}