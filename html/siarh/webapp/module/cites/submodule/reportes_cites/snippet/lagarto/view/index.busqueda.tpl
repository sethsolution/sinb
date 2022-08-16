<form class="m-form m-form--fit m-form--label-align-right m-form--group-seperator-dashed" method="POST"
      action="{$getModule}"  id="form_modal_interface_{$subcontrol}">

<div class="portlet__body m--margin-5">
    <div class=" row m--padding-bottom-5 busqueda_panel cuadro-verde" >

        <div class="col-lg-12 titulo m--margin-bottom-5 m--padding-left-5">Criterios de búsqueda</div>

        <div class="col-lg-4 m--margin-bottom-10-tablet-and-mobile">
            <label>Tipo de solicitud CITES:</label>
            <select class="form-control m-input select2_busqueda"
                    name="item[tipo_documento][]" multiple
                    id="tipo_documento" data-col-index="2">
                {html_options options=$cataobj.tipo_documento}
            </select>
        </div>

        <div class="col-lg-4 m--margin-bottom-10-tablet-and-mobile">
            <label>Empresa de exportador: </label>
            <input type="text" class="form-control m-input mayus"
                   placeholder="Ingrese el nombre de la empresa " name="item[empresa]"
                   value=""
                    minlength="2">
        </div>
        <div class="col-lg-4 m--margin-bottom-10-tablet-and-mobile">
            <label>Pais destino:</label>
            <select class="form-control m-input select2_busqueda"
                    name="item[pais_destino][]" multiple
                    id="pais_destino" data-col-index="2">
                {html_options options=$cataobj.pais}
            </select>
        </div>
        <div class="col-lg-4 m--margin-bottom-10-tablet-and-mobile">
            <label>Fecha de Inicio:</label>
            <div class="input-group">
                <input type="text" class="form-control m-input fecha_general"
                       placeholder="Ingrese la fecha de Inicio"
                       name="item[fecha_inicio]"
                       data-msg="Campo requerido"
                       value="">

            </div>
        </div>
        <div class="col-lg-4 m--margin-bottom-10-tablet-and-mobile">
            <label>Fecha Fin:</label>
            <input type="text" class="form-control m-input fecha_general"
                   placeholder="Ingrese la fecha Fin"
                   name="item[fecha_fin]"
                   data-msg="Campo requerido"
                   value="">
        </div>


        <div class="col-lg-12 m-form__actions m-form__actions--solid m-form__actions--left">
            <button type="reset" class="btn btn-primary" id="form_modal_submit_{$subcontrol}">
                <span>&nbsp;Consultar <i class="fa fa-angle-double-right"></i>&nbsp; </span>
            </button>
        </div>

    </div>



</div>
</form>