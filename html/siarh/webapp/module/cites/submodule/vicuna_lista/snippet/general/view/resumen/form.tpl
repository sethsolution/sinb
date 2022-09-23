<div class="m-portlet m--padding-bottom-5"  style="width: 800px">
    <form class="m-form m-form--fit m-form--label-align-right" method="POST"
          action="{$path_url}/{$subcontrol}_/{if $type=="update"}{$id}/{/if}guardar/"
          id="general_form">

        <div class="form-group m-form__group row m--padding-bottom-5 m--padding-top-5" >
            <div class="col-lg-12 m-form__group-sub m--padding-right-5 m--padding-left-5">
                <div class="titulo-estado text-center">Resumen de la información registrada</div>
            </div>
            <div class="col-lg-12 m-form__group-sub m--padding-right-5 m--padding-left-5">
                <div class="m-widget1 m--padding-15">
                    <div class="cuadro m--padding-10">
                        <div class="col-lg-12 titulo m--margin-bottom-5 m--padding-left-5">Tipo de Usuario:</div>
                        <div class="col m--align-center">
                            <span class="m-widget1__number m--font-info">{$item.vicuna_tipo}</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-12 m-form__group-sub m--padding-right-5 m--padding-left-5">
            <div class="titulo-estado text-center">Documentación cargada (requisitos)</div>
        </div>
        <div class="form-group m-form__group row m--padding-top-5  m--padding-top-5"  >
            Archivos cargados, a continuación se muestran solo los archivos registrados, verifique los requisitos obligatorios.
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
        <div class="form-group m-form__group row m--padding-bottom-5 m--padding-top-5" >
            <div class="col-lg-12 m-form__group-sub m--padding-right-5 m--padding-left-5">
                <div class="titulo-estado text-center">Datos Generales - Empresa Representante Legal</div>
            </div>
            <div class="col-lg-12 m-form__group-sub m--padding-right-5 m--padding-left-5 m--padding-top-10">
{*                <div class="m-widget1 m--padding-15">*}
                    <div class="cuadro m--padding-10">
                        <div class="col-lg-12 titulo m--margin-bottom-5 m--padding-left-5">Nombre Completo del Representante Legal:</div>
                        <div class="col m--align-center">
                            <span class="m-widget1__number m--font-info">{$item.representante_legal_nombre}</span>
                        </div>
                    </div>
{*                </div>*}
            </div>

            <div class="col-lg-4 m-form__group-sub m--padding-right-5 m--padding-left-5 m--padding-5" >
                <div class="cuadro m--padding-10">
                    <div class="col-lg-12 titulo m--margin-bottom-5 m--padding-left-5">Cedula de Identidad:</div>
                    <div class="col m--align-center">
                        <span class="m-widget1__number m--font-info">{$item.representante_legal_ci}</span>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 m-form__group-sub m--padding-right-5 m--padding-left-5 m--padding-5">
                <div class="cuadro m--padding-10">
                    <div class="col-lg-12 titulo m--margin-bottom-5 m--padding-left-5">Expedido:</div>
                    <div class="col m--align-center">
                        <span class="m-widget1__number m--font-info">{$item.representante_legal_ci_exp}</span>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 m-form__group-sub m--padding-right-5 m--padding-left-5 m--padding-5" >
                <div class="cuadro m--padding-10">
                    <div class="col-lg-12 titulo m--margin-bottom-5 m--padding-left-5">Fecha de expiración CI:</div>
                    <div class="col m--align-center">
                        <span class="m-widget1__number m--font-info">{$item.fecha_caducidad_ci|date_format:'%d/%m/%Y'}</span>
                    </div>
                </div>
            </div>
        </div>
        <div class="form-group m-form__group row m--padding-bottom-5 m--padding-top-5" >
            <div class="col-lg-12 m-form__group-sub m--padding-right-5 m--padding-left-5">
                <div class="titulo-estado text-center">Factura de compra-venta de fibra de Vicuña emitida por la Asociación Accidental
                    Comunitaria para la comercialización de Fibra de Vicuña Bolivia - ACOFIV-B</div>
            </div>

            <div class="col-lg-4 m-form__group-sub m--padding-right-5 m--padding-left-5 m--padding-5" >
                <div class="cuadro m--padding-10">
                    <div class="col-lg-12 titulo m--margin-bottom-5 m--padding-left-5">Monto de Venta (Bs.):</div>
                    <div class="col m--align-center">
                        <span class="m-widget1__number m--font-info">{$item.venta_monto}</span>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 m-form__group-sub m--padding-right-5 m--padding-left-5 m--padding-5">
                <div class="cuadro m--padding-10">
                    <div class="col-lg-12 titulo m--margin-bottom-5 m--padding-left-5">Cantidad de la Venta:</div>
                    <div class="col m--align-center">
                        <span class="m-widget1__number m--font-info">{$item.venta_cantidad}</span>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 m-form__group-sub m--padding-right-5 m--padding-left-5 m--padding-5" >
                <div class="cuadro m--padding-10">
                    <div class="col-lg-12 titulo m--margin-bottom-5 m--padding-left-5">Unidad:</div>
                    <div class="col m--align-center">
                        <span class="m-widget1__number m--font-info">{$item.unidad}</span>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal-footer m-form__actions m-form__actions--solid m-form__actions--left m--padding-top-10 m--padding-bottom-10">
            <button type="button" class="btn btn-secondary" id="form_modal_close_ver" data-dismiss="modal">Cerrar</button>
        </div>
    </form>
</div>
{include file="resumen/form.js.tpl"}
{include file="resumen/form.css.tpl"}