{include file="index.css.tpl"}
<!--begin::Portlet-->
<div class="m-portlet">
    <!--begin::Form-->
    <form class="m-form m-form--state m-form--fit m-form--label-align-right" method="POST" action="{$getModule}" id="general_form" autocomplete="off">

        <div class="m-portlet__head">
            <div class="m-portlet__head-caption">
                <div class="m-portlet__head-title">
                    <h3 class="m-portlet__head-text">Datos del documento</h3>
                </div>
            </div>
        </div>

        <div class="m-portlet__body">

            <div class="form-group m-form__group row">
                <div class="col-lg-4">
                    <label>Macroregión</label>
                    <select class="form-control m-input select2" name="item[macroreg_itemid]" id="cboMacroId" data-msg="Campo requerido." required>
                        <option value="">--Seleccione una opción--</option>
                        {html_options options=$macroregiones selected=$item.macroreg_itemid}
                    </select>
                </div>
                <div class="col-lg-4">
                    <label>Cobertura de investigación</label>
                    <input class="form-control m-input" type="text" name="item[pais_origen]" id="txtPaisOrigen" value="{$item.pais_origen|escape:'html'}" required data-msg="Campo requerido.">
                </div>
                <div class="col-lg-4">
                    <label>Tipo de documento</label>
                    <select class="form-control m-input select2" name="item[tipodoc_itemid]" id="cboTipoDocId" data-msg="Campo requerido." required>
                        <option value="">--Seleccione una opción--</option>
                        {html_options options=$cataobj.tipo_documentos selected=$item.tipodoc_itemid}
                    </select>
                </div>
            </div>
            <div class="form-group m-form__group row">
                <div class="col-lg-12">
                    <label>Título del documento</label>
                    <input class="form-control m-input" type="text" name="item[titulo]" id="txtTitulo" value="{$item.titulo|escape:'html'}" required data-msg="Campo requerido.">
                </div>
            </div>
            <div class="form-group m-form__group row">
                <div class="col-lg-4">
                    <label>Eje temático</label>
                    <select class="form-control m-input select2" name="item[ejetem_itemid]" id="cboEjeTemId" data-msg="Campo requerido." required>
                        <option value="">--Seleccione una opción--</option>
                        {html_options options=$cataobj.ejes_tematicos selected=$item.ejetem_itemid}
                    </select>
                </div>
                <div class="col-lg-4">
                    <label>Año de publicación</label>
                    <input class="form-control m-input" type="number" name="item[anio_publicacion]" id="txtAnioPublicacion" value="{$item.anio_publicacion|escape:'html'}" required data-msg="Campo requerido.">
                </div>
                <div class="col-lg-4">
                    <label>Origen del libro</label>
                    <select class="form-control m-input select2" name="item[territorio_itemid]" id="cboTerritorioId" data-msg="Campo requerido." required>
                        <option value="">--Seleccione una opción--</option>
                        {html_options options=$cataobj.territorios selected=$item.territorio_itemid}
                    </select>
                </div>
            </div>
            <div class="form-group m-form__group row">
                <div class="col-lg-4">
                    <label>Autor</label>
                    <input class="form-control m-input" type="text" name="item[autor]" id="txtAutor" value="{$item.autor|escape:'html'}" required data-msg="Campo requerido.">
                </div>
                <div class="col-lg-4">
                    <label>Nombre científico</label>
                    <input class="form-control m-input" type="text" name="item[nombre_cientifico]" id="txtNombreCientifico" value="{$item.nombre_cientifico|escape:'html'}" data-msg="Campo requerido.">
                </div>
                <div class="col-lg-4">
                    <label>Sigla de institución</label>
                    <input class="form-control m-input" type="text" name="item[sigla_institucion]" id="txtSiglaInstitucion" value="{$item.sigla_institucion|escape:'html'}" data-msg="Campo requerido.">
                </div>
            </div>
            <div class="form-group m-form__group row">
                <div class="col-lg-12">
                    <label>Especies</label>
                    <textarea class="form-control m-input" name="item[especies]" id="txtEspecies" rows="4" data-msg="Campo requerido.">{$item.especies|escape:'html'}</textarea>
                </div>
            </div>
            <div class="form-group m-form__group row">
                <div class="col-lg-12">
                    <label>Archivo</label>
                    <div class="custom-file">
                        <input type="file" class="form-control m-input custom-file-input" placeholder="Seleccione un archivo" name="archivo_adjunto" id="fileArchivoAdjunto" {if $type == 'new'} minlength="2" required data-msg="Campo requerido. Seleccione un archivo." {/if} value="{$item.adjunto_nombre|escape:'html'}">
                        <label class="custom-file-label" for="archivo_adjunto">Seleccione un archivo</label>
                    </div>
                    {if $type == 'update'}
                    <p style="background-color: #e5e5e5; padding: 7px;">
                        <strong>Archivo actual:</strong>&nbsp;{$item.adjunto_nombre}
                    </p>
                    {/if}
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
{include file="index.js.tpl"}