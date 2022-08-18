{include file="login/form.css.tpl"}

<form class="m-form m-form--fit m-form--label-align-right"   action="" >

    <input type="hidden" name="item_id" value="{$item_id}">

    <div class="modal-body">
        <div class="alert alert-info" role="alert">Inicia sesi&oacute;n en <strong>UYUNI/P&uacute;blico</strong></div>

        <div class="form-group m-form__group row ">
            <label>Usuario:</label>
            <div class="input-group " >

                <input class="form-control" type="text" placeholder="Usuario" name="user" id="user"
                       data-msg="Ingrese el Usuario"
                       autocomplete="off"  style="padding: 10px; border-color: #53b0f8;">
            </div>
        </div>

        <div class="form-group m-form__group row">
            <label>Contraseña</label>
            <div class="input-group " >

                <input class="form-control m-login__form-input--last" type="password" id="password"
                       data-msg="Ingrese la contraseña"
                       placeholder="Contraseña" name="password" style="border-color: #53b0f8;padding: 10px;">
            </div>

        </div>
    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-secondary" id="form_modal_close_{$subcontrol}" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-info" id="form_modal_submit_{$subcontrol}">Entrar</button>
    </div>
</form>

{include file="login/form.js.tpl"}
