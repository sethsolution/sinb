{include file="index.css.tpl"}

<!--Begin::Main Portlet-->
<div class="m-portlet m-portlet--full-height">

    <!--begin: Portlet Head-->
    <div class="m-portlet__head">
        <div class="m-portlet__head-caption">
            <div class="m-portlet__head-title">
                <h3 class="m-portlet__head-text">
                    Verificación de certificado CITES
                    <small>Verificación</small>
                </h3>
            </div>
        </div>
    </div>


    <!--begin::Form-->
    <form class="m-form m-form--fit m-form--label-align-right" method="POST"
          action="{$path_url}/guardar/"
          id="general_form">

        <div class="m-portlet__body">
            <div class="form-group m-form__group m--margin-top-10">
                <div class="alert m-alert m-alert--default" style="background: #fafced!important; border:1px solid #deefbe;" role="alert">
                   Estado: <strong> {$item.estado}</strong>
                </div>

                {if $item.estado_id !=4}
                <div class="alert m-alert m-alert--default" style="background: #ffefef!important; border:1px solid #e7a5a5;" role="alert">
                    <strong>CITES NO VALIDO</strong>, la solicitud CITES NO SE ENCUENTRA EN UN ESTADO VÁLIDO
                </div>
                {/if}

            </div>

            {if $item.estado_id ==4}

            <div class="form-group m-form__group row m--padding-bottom-5 m--padding-top-5" >
                <div class="col-lg-6 m-form__group-sub m--padding-right-5 m--padding-left-5">
                    <div class="cuadro d-flex align-items-center ">
                        <div class="box text-center">
                            <img src="/images/logo/cites_logo.jpg"  class="img-rounded" width="100" style="width: 150px:">
                            <label>CONVENCIÓN SOBRE EL COMERCIO INTERNACIONAL DE ESPECIES AMENAZADAS DE FAUNA Y FLORA SILVESTRE</label>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 m-form__group-sub m--padding-right-5 m--padding-left-5" >
                    <div class="cuadro m--padding-10">
                        <div class="col-lg-12 titulo m--margin-bottom-5 m--padding-left-5">1. Permiso / Certificado:</div>
                        <div class="input-group">
                            <div class="m-radio-list">
                                {foreach from=$cataobj.tipo_documento item=row key=idx}
                                    <label class="m-radio m-radio--success">
                                        <input type="radio" name="item[tipo_documento_id]"  {$privFace.input} value="{$row.itemId}" disabled
                                                {if $row.itemId== $item.tipo_documento_id} checked{/if}
                                        > {$row.nombre}
                                        <span></span>
                                    </label>
                                {/foreach}
                            </div>
                        </div>
                    </div>
                </div>

            </div>
            <div class="form-group m-form__group row m--padding-top-5 m--padding-bottom-5 " >
                <div class="col-lg-6  m-form__group-sub m--padding-right-5 m--padding-left-5" >
                    <div class="cuadro m--padding-10">
                        <div class="col-lg-12 titulo m--margin-bottom-5 m--padding-left-5">3. Importador:</div>
                        <div class="col-lg-12 m-form__group-sub cuadro-padding-0">
                            <label class="form-control-label">Nombre Importador:</label>
                            <div class="input-group">
                                <input type="text" class="form-control m-input mayus" disabled
                                       placeholder="Ingrese nombre del importador" name="item[importador_nombre]"
                                        {$privFace.input} value="{$item.importador_nombre|escape:'html'}"
                                       required minlength="2"
                                       data-msg="Este campo es requerido, registre la información.">
                                <div class="input-group-append"><span class="input-group-text" id="basic-addon2"><i class="fa fa-truck"></i></span></div>
                            </div>
                        </div>
                        <div class="col-lg-12 m-form__group-sub cuadro-padding-0">
                            <label class="form-control-label">Dirección Importador:</label>
                            <div class="input-group">{$item.importador_direccion|escape:'html'}</div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-6  m-form__group-sub m--padding-right-5 m--padding-left-5" >
                    <div class="cuadro m--padding-10">
                        <div class="col-lg-12 titulo m--margin-bottom-5 m--padding-left-5">4. Exportador / re-exportador:</div>
                        <div class="col-lg-12 m-form__group-sub cuadro-padding-0">
                            <label class="form-control-label">Nombre Exportador:</label>
                            <div class="input-group">
                                <input type="text" class="form-control m-input mayus" disabled
                                       placeholder="Ingrese el nombre del exportador" name="item[exportador_nombre]"
                                        {$privFace.input} value="{$item.exportador_nombre|escape:'html'}"
                                       data-msg="Este campo es requerido, registre la información." required minlength="2">
                                <div class="input-group-append"><span class="input-group-text" id="basic-addon2"><i class="fa fa-truck"></i></span></div>
                            </div>
                        </div>
                        <div class="col-lg-12 m-form__group-sub cuadro-padding-0">
                            <label class="form-control-label">Dirección Exportador:</label>
                            <div class="input-group">{$item.exportador_direccion|escape:'html'}</div>
                        </div>
                        <div class="col-lg-12 m-form__group-sub cuadro-padding-0">
                            <label class="form-control-label">País Exportador:</label>
                            <div class="input-group">
                                <select class="form-control m-select2 select2_general " disabled
                                        name="item[exportador_pais_id]"  {$privFace.input} id="exportador_pais_id"
                                        required
                                        data-msg="Este campo es requerido, registre la información.">
                                    <option value=""></option>
                                    {html_options options=$cataobj.pais selected=$item.exportador_pais_id}
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="form-group m-form__group row m--padding-top-5  m--padding-top-5"  >
                <div class="col-lg-6 row  m-form__group-sub cuadro-margin-0 cuadro-padding-0" >
                    <div class="col-lg-12  m-form__group-sub m--padding-right-5 m--padding-left-5 cuadro-margin-0 m--padding-bottom-10"  >
                        <div  class="cuadro m--padding-10 " >
                            <div class="col-lg-12 titulo m--margin-bottom-5 m--padding-left-5">3a. País Importador:</div>
                            <div class="m-input-icon m-input-icon--right">
                                <select class="form-control m-select2 select2_general" disabled
                                        name="item[importacion_pais_id]"  {$privFace.input} id="importacion_pais_id"
                                        required
                                        data-msg="Este campo es requerido, registre la información." >
                                    <option value=""></option>
                                    {html_options options=$cataobj.pais selected=$item.importacion_pais_id}
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-12  m-form__group-sub m--padding-right-5 m--padding-left-5 m--padding-bottom-10" >
                        <div  class="cuadro m--padding-10">
                            <div class="col-lg-12 titulo2 m--margin-bottom-5 m--padding-left-5">5. Condiciones Especiales:</div>
                            <div class="input-group">
                                <input type="text" class="form-control m-input mayus nollenar"
                                       placeholder="" name="item[condiciones_especiales]"
                                        value="{$item.condiciones_especiales|escape:'html'}"
                                       data-msg="Este campo es requerido, registre la información." disabled>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6  m-form__group-sub m--padding-right-5 m--padding-left-5 m--padding-bottom-10" >
                        <div  class="cuadro m--padding-10">
                            <div class="col-lg-12 titulo m--margin-bottom-5 m--padding-left-5">5a. Propósito de la transacción:</div>
                            <div class="input-group">
                                <select class="form-control m-select2 select2_general" disabled
                                        name="item[proposito_id]"  {$privFace.input} id="proposito_id"
                                        data-msg="Este campo es requerido, registre la información.">
                                    <option value="null">sin dato</option>
                                    {html_options options=$cataobj.tipo_proposito selected=$item.proposito_id}
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-6  m-form__group-sub m--padding-right-5 m--padding-left-5 m--padding-bottom-10" >
                        <div  class="cuadro m--padding-10">
                            <div class="col-lg-12 titulo2 m--margin-bottom-5 m--padding-left-5">5b. Estampilla de seguridad:</div>
                            <div class="input-group">
                                <input type="text" class="form-control m-input mayus nollenar"
                                       placeholder="" name="item[numero_estampilla]"
                                        {$privFace.input} value="{$item.numero_estampilla|escape:'html'}"
                                       data-msg="Este campo es requerido, registre la información." disabled>
                                <div class="input-group-append"><span class="input-group-text" id="basic-addon2"><i class="flaticon-clipboard"></i></span></div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-12  m-form__group-sub m--padding-right-5 m--padding-left-5 m--padding-bottom-10" >
                        <div  class="cuadro m--padding-10">
                            <div class="col-lg-12 titulo m--margin-bottom-5 m--padding-left-5">15. Puerto de Exportación:</div>
                            <select class="form-control m-select2 select2_general" disabled
                                    name="item[puerto_embarque]"  {$privFace.input} id="puerto_embarque"
                                    required data-msg="Este campo es requerido, registre la información.">
                                <option value=""></option>
                                {html_options options=$cataobj.puerto_embarque selected=$item.puerto_embarque}
                            </select>
                        </div>
                    </div>

                </div>
                <div class="col-lg-6  m-form__group-sub m--padding-right-5 m--padding-left-5" >
                    <div class="cuadro m--padding-10">
                        <div class="titulo m--margin-bottom-5 m--padding-left-5">6. Nombre, Dirección, Sello/timbre nacional y país de la Autoridad Administrativa:</div>

                        <div class="row ">
                            <div class="col-lg-12 text-center">
                                <img src="/images/logo/logo_estado_pluri.jpg"  lass="img-rounded" width="200" style="width: 150px:">
                                <br><br>
                                MINISTERIO DE MEDIO AMBIENTE Y AGUA<br>
                                VICEMINISTERIO DE MEDIO AMBIENTE, BIODIVERSIDAD, CAMBIOS CLIMÁTICOS Y DE GESTIÓN Y DESARROLLO FORESTAL<br>
                                Dirección General de Biodiversidad y Áreas Protegidas<br>
                                LA PAZ - BOLIVIA
                            </div>
                        </div>

                    </div>
                </div>
            </div>

            <h3 style="padding-left: 15px;">Especies</h3>
            <div class="form-group m-form__group row m--padding-top-5  m--padding-top-5"  >


                {foreach from=$especie item=es key=idx}
                <div class="col-lg-6 m-form__group-sub m--padding-right-5 m--padding-left-5" >
                    <div class="cuadro m--padding-10">
                        <span class="tituloEs">7/8 Nombre Científico y Nombre Común:</span><br>

                        <strong>Común:</strong>:<i>{$es.nombre_comun}</i><br>
                        <strong>Científico:</strong>{$es.nombre_especie}

                        <br><br>


                        <span class="tituloEs">9. Descripción de los especímenes:</span><br>
                        {$es.descripcion}
                        <br><br>

                        <span class="tituloEs">10. Apéndice y Origen: </span><br>
                        {$es.apendice} / {$es.origen}
                        <br><br>

                        <span class="tituloEs">10. Cantidad:</span> <br>
                        {$es.unidad}
                        <br><br>
                        <span class="tituloEs">12a. País de Origen:</span> <br>
                        {$es.pais}
                        <br><br>
                    </div>

                </div>
                {/foreach}

            </div>
            {/if}

        </div>


        <div class="m-portlet__foot m-portlet__foot--fit">
            <div class="m-form__actions m-form__actions--solid m-form__actions--left" style="text-align: center;">
                <a class="btn btn-info" href="/ingreso" role="button">  <span> Volver <i class="fa fa-angle-double-left"></i>&nbsp; </span></a>
            </div>


            <div  style="text-align: center;font-size: 10px; color: #7c7c7c; ">
                <img src="/images/logo/otca.png" width="350"><br>
                El presente sistema ha sido desarrollado en colaboración entre el MMAyA y el Proyecto Bioamazonía,<br>
                proyecto de desarrollo de la Organización del Tratado de Cooperación Amazónica (OTCA),<br>
                cofinanciado por la República Federal de Alemania a través de KfW.
                <br><br>
            </div>

        </div>


    </form>
    <!--end: Portlet Head-->
º

</div>

<!--End::Main Portlet-->

