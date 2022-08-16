<form class="m-form m-form--fit m-form--label-align-right m-form--group-seperator-dashed" method="POST"
      action="{$getModule}"  id="form_modal_interface_{$subcontrol}">

<div class="portlet__body m--margin-5">
    <div class=" row m--padding-bottom-5 busqueda_panel cuadro-verde" >

        <div class="col-lg-12 titulo m--margin-bottom-5 m--padding-left-5">Criterios de búsqueda para Certificados y permisos CITES y dispensación</div>

        <div class="col-lg-4 m--margin-bottom-10-tablet-and-mobile">
            <label>Tipo de certificado :</label>
            <select class="form-control m-input select2_busqueda" id="categoria"
                    name="item[categoria]"  data-col-index="2">
                <option value="0">Todos</option>
                {html_options options=$cataobj.categoria}
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