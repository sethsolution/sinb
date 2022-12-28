{include file="index.css.tpl"}
{include file="geovisor/index.css.tpl"}
<!--begin::Portlet-->
<div class="m-portlet">
    <!--begin::Form-->
    <form class="m-form m-form--state m-form--fit m-form--label-align-right" method="POST" action="{$getModule}" id="general_form" autocomplete="off">

        <div class="m-portlet__head">
            <div class="m-portlet__head-caption">
                <div class="m-portlet__head-title">
                    <h3 class="m-portlet__head-text">Datos del cultivo</h3>
                </div>
            </div>
        </div>

        <div class="m-portlet__body">

            <div class="form-group m-form__group row">
                <div class="col-lg-6">
                    <label>Especie cultivado</label>
                    <select class="form-control m-input select2" name="item[espe_itemid]" id="cboEspecieId" required>
                        <option value="">--Seleccione una opción--</option>
                        {html_options options=$listaEspecies selected=$item.espe_itemid}
                    </select>
                </div>
                <div class="col-lg-6">
                    <label>Ecotipo</label>
                    <select class="form-control m-input select2" name="item[ecotipo_itemid]" id="cboEcotipoId" required>
                        <option value="">--Seleccione una opción--</option>
                    </select>
                </div>
            </div>

            <div class="form-group m-form__group row">
                <div class="col-lg-4">
                    <label>Especie asociada con cultivos</label>
                    <select class="form-control m-input select2" name="item[especie_asocia_cultivo]" id="cboEspecieAsociaCultivo" required>
                        <option value="">--Seleccione una opción--</option>
                        {html_options options=$especieAsociaCultivos selected=$item.especie_asocia_cultivo}
                    </select>
                </div>
                <div class="col-lg-4">
                    <label>Vinculación de Conservación, Producción o Comercialización</label>
                    <select class="form-control m-input select2" name="item[vincula_itemid]" id="cboVinculaId" required>
                        <option value="">--Seleccione una opción--</option>
                        {html_options options=$cataobj.vinculaciones selected=$item.vincula_itemid}
                    </select>
                </div>
                <div class="col-lg-4">
                    <label>Clase de vinculación</label>
                    <select class="form-control m-input select2" name="item[clasevincula_itemid]" id="cboClaseVinculaId" required>
                        <option value="">--Seleccione una opción--</option>
                    </select>
                </div>
            </div>
            
            <div id="pnlConservacion">
                <div class="form-group m-form__group row">
                    <div class="col-lg-4">
                        <label>Especie principal</label>
                        <select class="form-control m-input select2" name="item[espemain_itemid]" id="cboEspeMainId">
                            <option value="">--Seleccione una opción--</option>
                            {html_options options=$listaEspecies selected=$item.espemain_itemid}
                        </select>
                    </div>
                    <div class="col-lg-4">
                        <label>Cantidad</label>
                        <input class="form-control m-input" type="number" name="item[cantidad]" id="txtCantidad" value="{$item.cantidad|escape:'html'}" data-msg="Campo requerido.">
                    </div>
                    <div class="col-lg-4">
                        <label>Semilla o plantín</label>
                        <select class="form-control m-input select2" name="item[unidad_medida]" id="cboUnidadMedida">
                            <option value="">--Seleccione una opción--</option>
                            {html_options options=$semillaPlantin selected=$item.unidad_medida}
                        </select>
                    </div>
                </div>
                <div class="form-group m-form__group row">
                    <div class="col-lg-4">
                        <label>Especies adicionales</label>
                        <input class="form-control m-input" type="text" name="item[espe_adicional]" id="txtEspeAdicional" value="{$item.espe_adicional|escape:'html'}" data-msg="Campo requerido.">
                    </div>
                </div>
            </div>

            <div class="form-group m-form__group row" id="pnlSuperficie">
                <div class="col-lg-4">
                    <label>Superficie [Ha.]</label>
                    <input class="form-control m-input" type="number" name="item[superficie]" id="txtSuperficie" value="{$item.superficie|escape:'html'}" data-msg="Campo requerido.">
                </div>
                <div class="col-lg-4">
                    <label>Superficie ampliada [Ha.]</label>
                    <input class="form-control m-input" type="number" name="item[superficie_amplia]" id="txtSuperficieAmplia" value="{$item.superficie_amplia|escape:'html'}" data-msg="Campo requerido.">
                </div>
                <div class="col-lg-4" id="pnlCodCertifica">
                    <label>Código de certificación</label>
                    <input class="form-control m-input" type="text" name="item[cod_certifica]" id="txtCodCertificacion" value="{$item.cod_certifica|escape:'html'}" data-msg="Campo requerido.">
                </div>
            </div>
            <div class="form-group m-form__group row" id="pnlDensidadSiembra">
                <div class="col-lg-4">
                    <label>Densidad de siembra</label>
                    <input class="form-control m-input" type="number" name="item[densidad]" id="txtDensidad" value="{$item.densidad|escape:'html'}" data-msg="Campo requerido.">
                </div>
                <div class="col-lg-4">
                    <label>Unidad (Densidad de siembra)</label>
                    <select class="form-control m-input select2" name="item[unidad_medida_densidad]" id="cboUnidadMedidaDensidad">
                        <option value="">--Seleccione una opción--</option>
                        {html_options options=$unidadesSiembra selected=$item.unidad_medida_densidad}
                    </select>
                </div>
                <div class="col-lg-4">
                    <label>Cantidad recolectada o cosechada [Kg]</label>
                    <input class="form-control m-input" type="number" name="item[cant_recolectada]" id="txtCantRecolectada" value="{$item.cant_recolectada|escape:'html'}" data-msg="Campo requerido.">
                </div>
            </div>
            <div class="form-group m-form__group row" id="pnlDestino">
                <div class="col-lg-3">
                    <label>Destino conservación (%)</label>
                    <input class="form-control m-input" type="number" name="item[destino_conserva]" id="txtDestinoConserva" value="{$item.destino_conserva|escape:'html'}" min="0" max="100" data-msg="Campo requerido.">
                </div>
                <div class="col-lg-3">
                    <label>Destino autoconsumo (%)</label>
                    <input class="form-control m-input" type="number" name="item[destino_autoconsumo]" id="txtDestinoAutoconsumo" value="{$item.destino_autoconsumo|escape:'html'}" min="0" max="100" data-msg="Campo requerido.">
                </div>
                <div class="col-lg-3">
                    <label>Destino comercialización (%)</label>
                    <input class="form-control m-input" type="number" name="item[destino_comercia]" id="txtDestinoComercia" value="{$item.destino_comercia|escape:'html'}" min="0" max="100" data-msg="Campo requerido.">
                </div>
                <div class="col-lg-3">
                    <label>Precio comercialización (Kg/Bs)</label>
                    <input class="form-control m-input" type="number" name="item[precio_comercia]" id="txtPrecioComercia" value="{$item.precio_comercia|escape:'html'}" data-msg="Campo requerido.">
                </div>
            </div>
            <div class="form-group m-form__group row" id="pnlFliaBeneficiaria">
                <div class="col-lg-3">
                    <label>Familias beneficiarias</label>
                    <input class="form-control m-input" type="number" name="item[cant_familias]" id="txtCantFlias" value="{$item.cant_familias|escape:'html'}" data-msg="Campo requerido.">
                </div>
            </div>
            
            <div id="pnlTransformacion">
                <div class="form-group m-form__group row">
                    <div class="col-lg-4">
                        <label>Cantidad de materia prima anual [Kg]</label>
                        <input class="form-control m-input" type="number" name="item[cant_materia_prima]" id="txtCantMateria" value="{$item.cant_materia_prima|escape:'html'}" data-msg="Campo requerido.">
                    </div>
                    <div class="col-lg-4">
                        <label>Nombre del producto transformado</label>
                        <input class="form-control m-input" type="text" name="item[producto]" id="txtProducto" value="{$item.producto|escape:'html'}" data-msg="Campo requerido.">
                    </div>
                    <div class="col-lg-4">
                        <label>Cantidad del producto transformado</label>
                        <input class="form-control m-input" type="number" name="item[cant_producto]" id="txtCantProducto" value="{$item.cant_producto|escape:'html'}" data-msg="Campo requerido.">
                    </div>
                </div>
                <div class="form-group m-form__group row">
                    <div class="col-lg-4">
                        <label>Precio de producción [Bs]</label>
                        <input class="form-control m-input" type="number" name="item[precio_produccion]" id="txtPrecioProduccion" value="{$item.precio_produccion|escape:'html'}" data-msg="Campo requerido.">
                    </div>
                    <div class="col-lg-4">
                        <label>Precio de venta [Bs]</label>
                        <input class="form-control m-input" type="number" name="item[precio_venta]" id="txtPrecioVenta" value="{$item.precio_venta|escape:'html'}" data-msg="Campo requerido.">
                    </div>
                    <div class="col-lg-4">
                        <label>Personas operarias</label>
                        <input class="form-control m-input" type="number" name="item[operarios]" id="txtOperarios" value="{$item.operario|escape:'html'}" data-msg="Campo requerido.">
                    </div>
                </div>
            </div>

            <div class="m-form__section">
                <div class="m-form__heading">
                    <h5 class="m-form__heading-title">Ubicación de parcela&nbsp;<small><a class="btn btn-success btn-sm" href="javascript:;" id="btnMostrarMapa"><span class="fa fa-map"></span>&nbsp;Ubicar en el mapa</a></small></h5>
                </div>
                <div class="m-form__seperator m-form__seperator--dashed"></div>
                <div id="pnlUbicacion">
                    <div class="form-group m-form__group row">
                        <div class="col-lg-4">
                            <label>UTM Este</label>
                            <input class="form-control m-input" type="number" name="item[utm_este]" id="txtUtmEste" value="{$item.utm_este|escape:'html'}" required data-msg="Campo requerido." readonly>
                        </div>
                        <div class="col-lg-4">
                            <label>UTM Norte</label>
                            <input class="form-control m-input" type="number" name="item[utm_norte]" id="txtUtmNorte" value="{$item.utm_norte|escape:'html'}" required data-msg="Campo requerido." readonly>
                        </div>
                        <div class="col-lg-4">
                            <label>UTM Zona</label>
                            <input class="form-control m-input" type="text" name="item[utm_zona]" id="txtUtmZona" value="{$item.utm_zona|escape:'html'}" required data-msg="Campo requerido." readonly>
                        </div>
                    </div>
                    <div class="form-group m-form__group row">
                        <div class="col-lg-4">
                            <label>Longitud Oeste</label>
                            <input class="form-control m-input" type="number" name="item[longitud]" id="txtLongitud" value="{$item.longitud|escape:'html'}" required data-msg="Campo requerido." readonly>
                        </div>
                        <div class="col-lg-4">
                            <label>Latitud Sur</label>
                            <input class="form-control m-input" type="number" name="item[latitud]" id="txtLatitud" value="{$item.latitud|escape:'html'}" required data-msg="Campo requerido." readonly>
                        </div>
                        <div class="col-lg-4">
                            <label>Macroregión</label>
                            <select class="form-control m-input select2" name="item[macroreg_itemid]" id="cboMacroregItemId">
                                <option value="">--Seleccione una opción--</option>
                                {html_options options=$cataobj.macroregiones selected=$item.macroreg_itemid}
                            </select>
                        </div>
                        <!--
                        <div class="col-lg-4">
                            <label>Macroregión</label>
                            <input class="form-control m-input" type="hidden" name="item[macroreg_itemid]" id="txtMacroId" value="{$item.macroreg_itemid|escape:'html'}">
                            <input class="form-control m-input" type="text" id="txtMacro" value="{$item.macroreg_nombre|escape:'html'}" readonly>
                        </div>
                        -->
                    </div>
                    <div class="form-group m-form__group row">
                        <div class="col-lg-4">
                            <label>Departamento</label>
                            <input class="form-control m-input" type="hidden" name="item[depto_itemid]" id="txtDeptoId" value="{$item.depto_itemid|escape:'html'}">
                            <input class="form-control m-input" type="text" id="txtDepto" value="{$item.depto_nombre|escape:'html'}" readonly>
                        </div>
                        <div class="col-lg-4">
                            <label>Municipio</label>
                            <input class="form-control m-input" type="hidden" name="item[municipio_itemid]" id="txtMunicipioId" value="{$item.municipio_itemid|escape:'html'}">
                            <input class="form-control m-input" type="text" id="txtMunicipio" value="{$item.municipio_nombre|escape:'html'}" readonly>
                        </div>
                    </div>
                </div>
                
                <div class="form-group m-form__group row">
                    <div class="col-lg-4">
                            <label>Comunidad</label>
                            <input class="form-control m-input" type="text" name="item[comunidad]" id="txtComunidad" value="{$item.comunidad|escape:'html'}" required data-msg="Campo requerido.">
                        </div>
                    <div class="col-lg-4">
                        <label>Zona/Lugar</label>
                        <input class="form-control m-input" type="text" name="item[zona]" id="txtZona" {if $type == 'new'}value="No definido"{else}value="{$item.zona|escape:'html'}"{/if} data-msg="Campo requerido.">
                    </div>
                    <div class="col-lg-4">
                        <label>Altitud [m.s.n.m.]</label>
                        <input class="form-control m-input" type="number" name="item[altitud]" id="txtAltitud" value="{$item.altitud|escape:'html'}" data-msg="Campo requerido.">
                    </div>
                </div>
                <!--
                <div class="form-group m-form__group row">
                    <div class="col-lg-3">
                        <label>Fecha de recolección</label>
                        <input class="form-control m-input" type="date" name="item[fecha]" id="txtFecha" value="{$item.fecha|escape:'html'}" required data-msg="Campo requerido.">
                    </div>
                </div>
                -->
                {if $type eq "update" and not $itemFoto eq null}
                <div class="form-group m-form__group row">
                    <div class="col-lg-12">
                        <label>Imagen del cultivo</label>
                        <p class="text-center" id="imgContenedor">
                            <img class="img-thumbnail" id="imgVistaPrevia" width="350" height="350" src="{$getModule}&accion={$subcontrol}_descargarRecurso&id={$itemFoto.itemId}" title="{$itemFoto.adjunto_nombre}"/>
                        </p>
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