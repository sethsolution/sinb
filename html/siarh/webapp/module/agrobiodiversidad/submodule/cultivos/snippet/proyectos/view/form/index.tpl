{include file="form/index.css.tpl"}
<form class="m-form m-form--state m-form--fit m-form--label-align-right" method="POST" action="{$getModule}" id="general_form" autocomplete="off">
    <div class="modal-header">
        <h4 class="modal-title">Datos de proyecto</h4>
    </div>

    <div class="modal-body">
        <div class="form-group m-form__group row">
            <div class="col-lg-12">
                <label>Código o nombre de proyecto</label>
                <div class="input-group">
                    <input type="hidden" name="item[cult_itemid]" id="txtCultivoId" value="{$id|escape:"html"}" required>
                    <input type="hidden" name="item[proy_itemid]" id="txtProyId" value="{$item.proy_itemid|escape:"html"}" data-msg="Campo requerido." required>
                    <input class="form-control m-input" type="text" id="txtNombreProy" value="" list="dlProyectos" data-msg="Campo requerido." required>
                    <datalist id="dlProyectos">
                    </datalist>
                    <div class="input-group-append">
                        <button class="btn btn-success" type="button" id="btnBuscar" title="Buscar"><span class="fa fa-search"></span></button>
                        <button type="button" class="btn btn-primary btn-block-custom" id="general_submit"><i class="fa fa-check"></i>&nbsp;Guardar</button>
                    </div>
                </div>
                <br>
                <p style="background-color: #f5f5f5; padding: 7px;">
                    <strong>Info: </strong>Busque los proyectos por código o nombre, luego seleccione y guarde la opción de su preferencia.
                </p>
            </div>
        </div>
    </div>

    <div class="modal-footer">
        <button type="button" class="btn btn-secondary btn-block-custom" data-dismiss="modal" id="btn_modal_close">Cerrar</button>
    </div>
</form>
{include file="form/index.js.tpl"}