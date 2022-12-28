<!-- begin:: modal mapa -->
<div id="modal_mapa" class="modal fade" tabindex="-1" data-replace="true" style="display: none;">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <!-- <div class="modal-header">
                <h4 class="modal-title">Ubicar en el mapa</h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
            </div> -->
            <div class="modal-body">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-3">
                            <div class="row">
                                <div class="col-lg-12" style="padding-bottom: 10px;">
                                    <h5>Ingrese UTM</h5>
                                </div>
                            </div>
                            <div class="form-group m-form__group row">
                                <div class="col-lg-12">
                                    <input class="form-control m-input" type="number" id="txtMapaUtmEste" value="" placeholder="UTM Este">
                                </div>
                            </div>
                            <div class="form-group m-form__group row">
                                <div class="col-lg-12">
                                    <input class="form-control m-input" type="number" id="txtMapaUtmNorte" value="" placeholder="UTM Norte">
                                </div>
                            </div>
                            <div class="form-group m-form__group row">
                                <div class="col-lg-12">
                                    <select class="form-control m-input select2_zona" id="cboMapaUtmZona">
                                        <option value="">--Seleccione una opción--</option>
                                        <option value="19K">Zona 19</option>
                                        <option value="20K">Zona 20</option>
                                        <option value="21K">Zona 21</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group m-form__group row">
                                <div class="col-lg-12">
                                    <button type="button" id="btnUbicarUtm" class="btn btn-success btn-sm btn-block">Ubicar en el mapa</button>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-12" style="padding-bottom: 10px;">
                                    <h5>Ingrese grados decimales</h5>
                                </div>
                            </div>
                            <div class="form-group m-form__group row">
                                <div class="col-lg-12">
                                    <input class="form-control m-input" type="number" id="txtMapaLongitud" value="" placeholder="Longitud">
                                </div>
                            </div>
                            <div class="form-group m-form__group row">
                                <div class="col-lg-12">
                                    <input class="form-control m-input" type="number" id="txtMapaLatitud" value="" placeholder="Latitud">
                                </div>
                            </div>
                            <div class="form-group m-form__group row">
                                <div class="col-lg-12">
                                    <button type="button" id="btnUbicar" class="btn btn-success btn-sm btn-block">Ubicar en el mapa</button>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-9">
                            <div id="mapa" class="mapa"></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-success" id="btnLimpiar">Limpiar</button>
                <button type="button" data-dismiss="modal" class="btn dark btn-outline">Cerrar</button>
            </div>
        </div>
    </div>
</div>
<!-- end:: modal mapa -->