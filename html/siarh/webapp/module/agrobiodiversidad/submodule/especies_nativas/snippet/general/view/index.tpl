{include file="index.css.tpl"}
{include file="geovisor/index.css.tpl"}
<!--begin::Portlet-->
<div class="m-portlet">
    <!--begin::Form-->
    <form class="m-form m-form--state m-form--fit m-form--label-align-right" method="POST" action="{$getModule}" id="general_form" autocomplete="off">

        <div class="m-portlet__head">
            <div class="m-portlet__head-caption">
                <div class="m-portlet__head-title">
                    <h3 class="m-portlet__head-text">Datos de la especie nativa</h3>
                </div>
            </div>
        </div>

        <div class="m-portlet__body">

            <div class="form-group m-form__group row">
                <div class="col-lg-4">
                    <label>Nombre Común del ecotipo</label>
                    <input class="form-control m-input" type="text" name="item[nombre_comun]" id="txtNombre" value="{$item.nombre_comun|escape:'html'}" data-msg="Campo requerido." required>
                </div>
                <div class="col-lg-4">
                    <label>Nombre científico</label>
                    <input class="form-control m-input" type="text" name="item[nombre_cientifico]" id="txtNombreCientifico" value="{$item.nombre_cientifico|escape:'html'}" data-msg="Campo requerido." style="font-style: italic;" required>
                </div>
                <div class="col-lg-4">
                    <label>Nombre vernacular en la zona de registro</label>
                    <input class="form-control m-input" type="text" name="item[nombre_vernacular]" id="txtNombreVernacular" value="{$item.nombre_vernacular|escape:'html'}" data-msg="Campo requerido." required>
                </div>
            </div>
            <div class="form-group m-form__group row">
                <div class="col-lg-6">
                    <label>Caracteristicas botánicas</label>
                    <textarea class="form-control m-input" name="item[carac_botanicas]" id="txtCaracBotanica" rows="3" required>{$item.carac_botanicas|escape:'html'}</textarea>
                </div>
                <div class="col-lg-6">
                    <label>Comunidad Campesina y/o indigena que cultiva y/o aprovecha</label>
                    <input class="form-control m-input" type="text" name="item[com_cultiva_aprovecha]" id="txtComunidad" value="{$item.com_cultiva_aprovecha|escape:'html'}" data-msg="Campo requerido." required>
                </div>
            </div>
            <div class="form-group m-form__group row">
                <div class="col-lg-4">
                    <label>Macroregión</label>
                    <select class="form-control m-input select2" name="item[macroreg_itemid][]" id="cboMacroId" data-msg="Campo requerido." required multiple>
                        <option value="">--Seleccione una opción--</option>
                        {html_options options=$macroregiones selected=$item.macroregion_itemid}
                    </select>
                </div>
                <div class="col-lg-4">
                    <label>Departamento</label>
                    <select class="form-control m-input select2" name="item[depto_itemid][]" id="cboDeptoId" data-msg="Campo requerido." required multiple>
                        <option value="">--Seleccione una opción--</option>
                    </select>
                </div>
                <div class="col-lg-4">
                    <label>Municipio</label>
                    <select class="form-control m-input select2" name="item[municipio_itemid][]" id="cboMunicipioId" data-msg="Campo requerido." required multiple>
                        <option value="">--Seleccione una opción--</option>
                    </select>
                </div>
            </div>
            <div class="form-group m-form__group row">
                <div class="col-lg-4">
                    <label>Categoría</label>
                    <select class="form-control m-input select2" name="item[catuso_itemid]" id="cboCatUsoId" data-msg="Campo requerido." required>
                        <option value="">--Seleccione una opción--</option>
                        {html_options options=$cataobj.categorias_uso selected=$item.catuso_itemid}
                    </select>
                </div>
                <div class="col-lg-4">
                    <label>Tiempo de uso (años)</label>
                    <input class="form-control m-input" type="number" name="item[tiempo_uso]" id="txtTiempoUso" value="{$item.tiempo_uso|escape:'html'}" min="1" max="{$smarty.now|date_format:"%Y"}" data-msg="Campo requerido." required>
                </div>
                <div class="col-lg-4">
                    <label>Relación Etnobotanica</label>
                    <input class="form-control m-input" type="text" name="item[rel_etnobotanica]" id="txtRelEtnobotanica" value="{$item.rel_etnobotanica|escape:'html'}" data-msg="Campo requerido." required>
                </div>
            </div>
            <div class="form-group m-form__group row">
                <div class="col-lg-6">
                    <label>Caracteristicas bioculturales</label>
                    <textarea class="form-control m-input" name="item[carac_bioculturales]" id="txtCaracBioculturales" rows="3" required>{$item.carac_bioculturales|escape:'html'}</textarea>
                </div>
                <div class="col-lg-6">
                    <label>Status de conservación</label>
                    <select class="form-control m-input select2" name="item[statusconserva_itemid]" id="cboStatusId" data-msg="Campo requerido." required>
                        <option value="">--Seleccione una opción--</option>
                        {html_options options=$cataobj.status_conservacion selected=$item.statusconserva_itemid}
                    </select>
                </div>
            </div>
            <div class="form-group m-form__group row">
                <div class="col-lg-4">
                    <label>Código de registro MMAyA</label>
                    <input class="form-control m-input" type="text" name="item[codigo_registro]" id="txtCodigoRegistro" value="{$item.codigo_registro|escape:'html'}" data-msg="Campo requerido.">
                </div>
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
{include file="geovisor/index.tpl"}
{include file="index.js.tpl"}
{include file="geovisor/index.js.tpl"}