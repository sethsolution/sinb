{include file="index.css.tpl"}
<!--begin::Portlet-->
<div class="m-portlet">
    <!--begin::Form-->
    <form class="m-form m-form--state m-form--fit m-form--label-align-right" method="POST" action="{$getModule}" id="general_form" autocomplete="off">

        <div class="m-portlet__head">
            <div class="m-portlet__head-caption">
                <div class="m-portlet__head-title">
                    <h3 class="m-portlet__head-text">Datos de la especie</h3>
                </div>
            </div>
        </div>

        <div class="m-portlet__body">

            <div class="form-group m-form__group row">
                <div class="col-lg-4">
                    <label>Nombre común</label>
                    <input class="form-control m-input" type="text" name="item[nombre_comun]" id="txtNombre" value="{$item.nombre_comun|escape:'html'}" data-msg="Campo requerido." required>
                </div>
                <div class="col-lg-4">
                    <label>Nombre científico</label>
                    <input class="form-control m-input" type="text" name="item[nombre_cientifico]" id="txtNombreCientifico" value="{$item.nombre_cientifico|escape:'html'}" data-msg="Campo requerido." style="font-style: italic;">
                </div>
                <div class="col-lg-4">
                    <label>Categoría</label>
                    <select class="form-control m-input select2" name="item[cat_itemid]" id="cboCatId" data-msg="Campo requerido." required>
                        <option value="">--Seleccione una opción--</option>
                        {html_options options=$cataobj.categorias selected=$item.cat_itemid}
                    </select>
                </div>
            </div>
            <div class="form-group m-form__group row">
                <div class="col-lg-4">
                    <label>Macroregión</label>
                    <select class="form-control m-input select2" name="item[macroreg_itemid]" id="cboMacroId" data-msg="Campo requerido." required>
                        <option value="">--Seleccione una opción--</option>
                        {html_options options=$macroregiones selected=$item.macroreg_itemid}
                    </select>
                </div>
                <div class="col-lg-8">
                    <label>Municipio</label>
                    <select class="form-control m-input select2" name="item[municipio_itemid][]" id="cboMunicipioId" data-msg="Campo requerido." required multiple>
                        <option value="">--Seleccione una opción--</option>
                    </select>
                </div>
            </div>
            <div class="m-form__section m-form__section--last">
                <div class="m-form__heading">
                    <h5 class="m-form__heading-title">Clasificación taxonómica</h5>
                </div>
                <div class="m-form__seperator m-form__seperator--dashed"></div>

                <div class="form-group m-form__group row">
                    <div class="col-lg-4">
                        <label>División</label>
                        <select class="form-control m-input select2" name="item[taxdiv_itemid]" id="cboDivisionId" data-msg="Campo requerido.">
                            <option value="">--Seleccione una opción--</option>
                            {html_options options=$cataobj.taxonomia_division selected=$item.taxdiv_itemid}
                        </select>
                    </div>
                    <div class="col-lg-4">
                        <label>Clase</label>
                        <select class="form-control m-input select2" name="item[taxclase_itemid]" id="cboClaseId" data-msg="Campo requerido.">
                            <option value="">--Seleccione una opción--</option>
                            {html_options options=$cataobj.taxonomia_clase selected=$item.taxclase_itemid}
                        </select>
                    </div>
                    <div class="col-lg-4">
                        <label>Orden</label>
                        <select class="form-control m-input select2" name="item[taxorden_itemid]" id="cboOrdenId" data-msg="Campo requerido.">
                            <option value="">--Seleccione una opción--</option>
                            {html_options options=$cataobj.taxonomia_orden selected=$item.taxorden_itemid}
                        </select>
                    </div>
                </div>
                <div class="form-group m-form__group row">
                    <div class="col-lg-4">
                        <label>Familia</label>
                        <select class="form-control m-input select2" name="item[taxfam_itemid]" id="cboFamiliaId" data-msg="Campo requerido.">
                            <option value="">--Seleccione una opción--</option>
                            {html_options options=$cataobj.taxonomia_familia selected=$item.taxfam_itemid}
                        </select>
                    </div>
                    <div class="col-lg-4">
                        <label>Género</label>
                        <select class="form-control m-input select2" name="item[taxgen_itemid]" id="cboGeneroId" data-msg="Campo requerido.">
                            <option value="">--Seleccione una opción--</option>
                            {html_options options=$cataobj.taxonomia_genero selected=$item.taxgen_itemid}
                        </select>
                    </div>
                    <div class="col-lg-4">
                        <label>Especie</label>
                        <select class="form-control m-input select2" name="item[taxespe_itemid]" id="cboEspecieId" data-msg="Campo requerido.">
                            <option value="">--Seleccione una opción--</option>
                            {html_options options=$cataobj.taxonomia_especie selected=$item.taxespe_itemid}
                        </select>
                    </div>
                </div>
                <div class="form-group m-form__group row">
                    <div class="col-lg-4">
                        <label>Sub especie</label>
                        <input class="form-control m-input" type="text" name="item[subespecie]" id="txtSubespecie" value="{$item.subespecie|escape:'html'}" style="font-style: italic;" data-msg="Campo requerido.">
                    </div>
                </div>
            </div>

            <div class="m-form__section m-form__section--last">
                <div class="m-form__seperator m-form__seperator--dashed"></div>
                <div class="form-group m-form__group row">
                    <div class="col-lg-12">
                        <label>Descripción de la especie</label>
                        <textarea class="form-control m-input" name="item[descrip]" id="txtDescrip" rows="3">{$item.descrip|escape:'html'}</textarea>
                    </div>
                </div>
                {if $type eq "update" and not $itemFoto eq null}
                <div class="form-group m-form__group row">
                    <div class="col-lg-12">
                        <label>Imagen de la especie</label>
                        <p class="text-center" id="imgContenedor">
                            <img class="img-thumbnail" id="imgVistaPrevia" width="350" height="350" src="{$getModule}&accion={$subcontrol}_descargarRecurso&id={$itemFoto.itemId}" title="{$itemFoto.adjunto_nombre}"/>
                        </p>
                    </div>
                </div>
                {/if}
                {if $type eq "update" and not $itemFicha eq null}
                <div class="form-group m-form__group row">
                    <div class="col-lg-12">
                        <label>Documento en formato pdf</label>
                        <a class="nav" href="{$getModule}&accion={$subcontrol}_descargarRecurso&id={$itemFicha.itemId}" target="_blank">Descargar documento</a>
                    </div>
                </div>
                {/if}
            </div>

        </div>

        <div class="m-portlet__foot m-portlet__no-border m-portlet__foot--fit">
            <div class="m-form__actions m-form__actions--solid">
                <div class="row">
                    <div class="col-lg-12">
                        <button type="button" class="btn btn-primary btn-block-custom" id="general_submit"><i class="fa fa-check"></i>&nbsp;{if $type == 'new'}Guardar{else}Actualizar{/if}</button>
                        <button type="reset" class="btn btn-default btn-block-custom" id="general_reset">Cancelar</button>
                        <button type="button" class="btn btn-default btn-block-custom" id="btnBack"><span class="fa fa-arrow-left"></span>&nbsp;Volver</button>
                    </div>
                </div>
            </div>
        </div>
    </form>
    <!--end::Form-->
</div>
<!--end::Portlet-->
{include file="index.js.tpl"}