<div class="m-portlet m--padding-bottom-5">
    <form class="m-form m-form--fit m-form--label-align-right" method="POST"
          action="{$path_url}/{$subcontrol}_/{if $type=="update"}{$id}/{/if}guardar/"
          id="general_form">

        <div class="form-group m-form__group row m--padding-bottom-5 m--padding-top-5" >
            <div class="col-lg-12 m-form__group-sub m--padding-right-5 m--padding-left-5">
                <div class="titulo-estado text-center">Resumen de la información registrada</div>
            </div>
            <div class="col-lg-12 m-form__group-sub m--padding-right-5 m--padding-left-5">
                <div class="m-widget1 m--padding-15">
                    <table style="width: -moz-available;border-spacing: 20px 10px;border-collapse: separate;">
                        <tr><td><div class="m-widget1__item resumen_global" >
                                    <div class="row m-row--no-padding align-items-center">
                                        <div class="col">
                                            <h3 class="m-widget1__title">Total especies </h3>
                                            <span class="m-widget1__desc">Total de especies registradas</span>
                                        </div>
                                        <div class="col m--align-right">
                                            <span class="m-widget1__number m--font-info" id="resumen_especies">0</span>
                                        </div>
                                    </div>
                                </div><div class="m-widget1__item resumen_global">
                                    <div class="row m-row--no-padding align-items-center">
                                        <div class="col">
                                            <h3 class="m-widget1__title">Total certificados</h3>
                                            <span class="m-widget1__desc">Número de Certificados que necesitará</span>
                                        </div>
                                        <div class="col m--align-right">
                                            <span class="m-widget1__number m--font-danger" id="resumen_certificados">0</span>
                                        </div>
                                    </div>
                                </div></td>
                            <td><div class="m-widget1__item resumen_global">
                                    <div class="row m-row--no-padding align-items-center">
                                        <div class="col">
                                            <h4 class="m-widget1__title ">Total a Depositar</h4>
                                            <span class="m-widget1__desc">El mónto que tiene que depositar</span>
                                        </div>
                                        <div class="col m--align-right">
                                            <span class="m-widget1__number m--font-success" id="resumen_depositar">0</span>
                                        </div>
                                    </div>
                                </div>

                                <div class="m-widget1__item resumen_global">
                                    <div class="row m-row--no-padding align-items-center">
                                        <div class="col">
                                            <h3 class="m-widget1__title">Deposito registrado</h3>
                                            <span class="m-widget1__desc">Depositos registrados</span>
                                        </div>
                                        <div class="col m--align-right">
                                            <span class="m-widget1__number m--font-brand" id="resumen_depositos">0</span>
                                        </div>
                                    </div>
                                </div></td></tr>
                    </table>
                </div>
            </div>
        </div>
        <div class="form-group m-form__group row m--padding-bottom-5 m--padding-top-5" >
            <div class="col-lg-12 m-form__group-sub m--padding-right-5 m--padding-left-5">
                <div class="titulo-estado text-center">Información de la certificación Dispensación</div>
            </div>
        </div>
        <div class="form-group m-form__group row m--padding-bottom-5 m--padding-top-5" >

            <div class="col-lg-7 m-form__group-sub m--padding-right-5 m--padding-left-5" >
                <div class="cuadro m--padding-10">
                    <div class="col-lg-12 titulo m--margin-bottom-5 m--padding-left-5">1. Permiso / Certificado:</div>
                    <div class="col m--align-center">
                        <span class="m-widget1__number m--font-info">{$item.documento}</span>
                    </div>

                </div>
            </div>
            <div class="col-lg-5 m-form__group-sub m--padding-right-5 m--padding-left-5" >
                <div class="cuadro m--padding-10">
                    <div class="col-lg-12 titulo m--margin-bottom-5 m--padding-left-5">2. Válido Hasta el :</div>
                    <div class="m-input-icon m-input-icon--right">
                        {if $item.estado_id == "4"}
                            {$item.fecha_expiracion}
                        {else}
                            <span style="color: #990a1e; text-align: justify;">La fecha de validez se establecerá automáticamente a partir de la aprobación de su solicitud.</span>
                        {/if}
                    </div>
                </div>
            </div>
        </div>
        <div class="form-group m-form__group row m--padding-top-5 m--padding-bottom-5 " >
            <div class="col-lg-6  m-form__group-sub m--padding-right-5 m--padding-left-5" >
                <div class="cuadro m--padding-10">
                    <div class="col-lg-12 titulo m--margin-bottom-5 m--padding-left-5">3. Importador:</div>
                    <div class="col-lg-12 m-form__group-sub cuadro-padding-0">
                        <div class="col m--align-center">
                            <span class="m-widget1__number m--font-info">{$item.importador_nombre}</span>
                        </div>
                        <div class="col m--align-center">
                            <span class="m-widget1__number m--font-info">{$item.importador_direccion}</span>
                        </div>
                    </div>

                </div>
            </div>
            <div class="col-lg-6  m-form__group-sub m--padding-right-5 m--padding-left-5" >
                <div class="cuadro m--padding-10">
                    <div class="col-lg-12 titulo m--margin-bottom-5 m--padding-left-5">4. Exportador / re-exportador:</div>
                    <div class="col-lg-12 m-form__group-sub cuadro-padding-0">
                        <div class="col m--align-center">
                            <span class="m-widget1__number m--font-info">{$item.exportador_nombre}</span>
                        </div>
                        <div class="col m--align-center">
                            <span class="m-widget1__number m--font-info">{$item.exportador_direccion}</span>
                        </div>
                        <div class="col m--align-center">
                            <span class="m-widget1__number m--font-info" >{$item.paisexportador}</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="form-group m-form__group row m--padding-top-5  m--padding-top-5"  >
            <div class="col-lg-6 row  m-form__group-sub cuadro-margin-0 cuadro-padding-0" >
                <div class="col-lg-12  m-form__group-sub m--padding-right-5 m--padding-left-5 cuadro-margin-0 m--padding-bottom-10"  >
                    <div  class="cuadro m--padding-10 " >
                        <div class="col-lg-12 titulo m--margin-bottom-5 m--padding-left-5">3a. País de Importación:</div>
                        <div class="m-input-icon m-input-icon--right">
                            <div class="col m--align-center">
                                <span class="m-widget1__number m--font-info">{$item.paisimportador}</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-12  m-form__group-sub m--padding-right-5 m--padding-left-5 m--padding-bottom-10" >
                    <div  class="cuadro m--padding-10">
                        <div class="col-lg-12 titulo m--margin-bottom-5 m--padding-left-5">5. Condiciones Especiales:</div>
                        <div class="input-group">
                            <input type="text" class="form-control m-input"
                                   disabled>
                        </div>

                    </div>
                </div>
                <div class="col-lg-12  m-form__group-sub m--padding-right-5 m--padding-left-5 m--padding-bottom-10" >
                    <div  class="cuadro m--padding-10">
                        <div class="col-lg-12 titulo m--margin-bottom-5 m--padding-left-5">5a. Propósito de la transacción:</div>
                        <div class="col m--align-center">
                            <span class="m-widget1__number m--font-info">{$item.proposito}</span>
                        </div>

                    </div>
                </div>


            </div>
            <div class="col-lg-6  m-form__group-sub m--padding-right-5 m--padding-left-5" >
                <div class="cuadro m--padding-10">
                    <div class="col-lg-12 titulo m--margin-bottom-5 m--padding-left-5">6. Nombre, Dirección, Sello/timbre nacional y país de la Autoridad Administrativa:</div>

                    <div class="text-center ">
                        <img src="/module/cites/template/images/logo/logo_estado_pluri.png"  class="img-rounded" width="150" style="width: 150px:"><br>
                        MINISTERIO DE MEDIO AMBIENTE Y AGUA<br>
                        VICEMINISTERIO DE MEDIO AMBIENTE, BIODIVERSIDAD, CAMBIOS CLIMÁTICOS Y DE GESTIÓN Y DESARROLLO FORESTAL<br>
                        Dirección General de Biodiversidad y Áreas Protegidas<br>
                        LA PAZ, BOLIVIA
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-12 m-form__group-sub m--padding-right-5 m--padding-left-5">
            <div class="titulo-estado text-center">Especies registradas para la solicitud</div>
        </div>
        <div class="form-group m-form__group row m--padding-top-5  m--padding-top-5"  >
            <table class="table table-sm m-table m-table--head-bg-brand" id="tabla_especies">
                <thead class="thead-inverse">
                <tr>
                    <th>Nombre científico y nombre común del animal o planta</th>
                    <th>Descripción de los especimenes: incluso las marcas o números de identificación</th>
                    <th>Cantidad(incluyendo la unidad)</th>
                </tr>
                </thead>
                <tbody>
                {foreach from=$especie item=row key=idx}
                    <tr>
                        <td>{$row.nombre_especie}</td>
                        <td>{$row.descripcion}</td>
                        <td>{$row.unidad}</td>

                    </tr>
                {/foreach}
                </tbody>
            </table>
        </div>
        <div class="col-lg-12 m-form__group-sub m--padding-right-5 m--padding-left-5">
            <div class="titulo-estado text-center">Documentación cargada (requisitos)</div>
        </div>

        <div class="form-group m-form__group row m--padding-top-5  m--padding-top-5"  >
            <table class="table table-sm m-table m-table--head-bg-brand" id="tabla_requisito">
                <thead class="thead-inverse">
                <tr>
                    <th>Descripción del requisito</th>
                    <th>Nombre del archivo</th>
                    <th>Tamaño</th>
                </tr>
                </thead>
                <tbody>
                {foreach from=$requisito item=row key=idx}
                    <tr>
                        <td>{$row.nombre}</td>
                        <td>{$row.adjunto_nombre}</td>
                        <td>{$row.adjunto_tamano|escape:"html"}</td>
                    </tr>
                {/foreach}
                </tbody>

            </table>
        </div>
        <div class="modal-footer m-form__actions m-form__actions--solid m-form__actions--left m--padding-top-10 m--padding-bottom-10">
            <button type="button" class="btn btn-success" id="form_modal_close_ver" data-dismiss="modal">Cerrar resumen <i class="fa fa-angle-double-right"></i>&nbsp;</button>
        </div>
    </form>

</div>
{include file="resumen/form.js.tpl"}
{include file="resumen/form.css.tpl"}