{include file="index.css.tpl"}
<!--begin::Portlet-->
<div class="m-portlet">
    <!--begin::Form-->
    <form class="m-form m-form--state m-form--fit m-form--label-align-right" method="POST" action="{$getModule}" id="general_form" autocomplete="off">
        <input type="hidden" name="item[user_itemid]" id="txtUserId" value="{$id|escape:'html'}" required>
        <div class="m-portlet__head">
            <div class="m-portlet__head-caption">
                <div class="m-portlet__head-title">
                    <h3 class="m-portlet__head-text">Datos de permiso de usuario</h3>
                </div>
            </div>
        </div>

        <div class="m-portlet__body">
            <div class="form-group m-form__group row">
                <div class="col-lg-4">
                    <label>Rol</label>
                    <select class="form-control m-input select2" name="item[rol_itemid]" id="cboRolId" data-msg="Campo requerido." required>
                        <option value="">--Seleccione una opción--</option>
                        {html_options options=$cataobj.usuario_roles selected=$item.rol_itemid}
                    </select>
                </div>
            </div>
            <div class="m-form__group form-group" id="pnlUserEditor">
                <label for="">Permisos</label>
                <p>
                    El usuario editor tiene los siguientes permisos:<br>
                    <strong>CREAR</strong> un nuevo registro.<br>
                    <strong>EDITAR</strong> un registro existente.<br>
                    <strong>VISUALIZAR</strong> datos.<br>
                    <strong>DESCARGAR</strong> datos.
                </p>
            </div>
            <div class="m-form__group form-group" id="pnlUserInvitado">
                <label for="">Permisos</label>
                <p>
                    El usuario invitado tiene los siguientes permisos:<br>
                    <strong>VISUALIZAR</strong> datos.<br>
                    <strong>DESCARGAR</strong> datos.
                </p>
            </div>
        </div>

        <div class="m-portlet__foot m-portlet__no-border m-portlet__foot--fit">
            <div class="m-form__actions m-form__actions--solid">
                <div class="row">
                    <div class="col-lg-12">
                        <button type="button" class="btn btn-primary btn-block-custom" id="general_submit"><i class="fa fa-check"></i>&nbsp;{if $type == 'new'}Guardar{else}Actualizar{/if}</button>
                        <button type="reset" class="btn btn-default btn-block-custom" id="general_reset">Cancelar</button>
                    </div>
                </div>
            </div>
        </div>
    </form>
    <!--end::Form-->
</div>
<!--end::Portlet-->
{include file="index.js.tpl"}