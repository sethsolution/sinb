<form class="m-form m-form--fit m-form--label-align-right m-form--group-seperator-dashed" method="POST"
      action="{$getModule}"  id="form_modal_interface_{$subcontrol}">

<div class="portlet__body m--margin-5">
    <div class=" row m--padding-bottom-5 busqueda_panel cuadro-verde" >

        <div class="col-lg-12 titulo m--margin-bottom-5 m--padding-left-5">Reporte de recaudacion mensual por Certificados CITES de especies</div>

        {*
        <div class="col-lg-10 m--margin-bottom-10-tablet-and-mobile">
            <label>Especies:</label>
            <select class="form-control m-input select2_busqueda" id="especies"
                    name="item[especies][]" multiple required data-msg="Campo requerido"
                    data-col-index="2">
                {html_options options=$cataobj.especie selected=$especies}
            </select>
        </div>
*}

        <div class="col-lg-2 m--margin-bottom-10-tablet-and-mobile">
            <label>Año:</label>
            <div class="input-group">

                <input type="text" class="form-control m-input numero_entero monto"
                       placeholder="Ingrese año" name="item[anio]"
                       required data-msg="Campo requerido"
                       value="{$anio|escape:'html'}">

            </div>
        </div>


        <div class="col-lg-12 m-form__actions m-form__actions--solid m-form__actions--left">
            <button type="reset" class="btn btn-primary" id="form_modal_submit_{$subcontrol}">
                <span>&nbsp;Consultar <i class="fa fa-angle-double-right"></i>&nbsp; </span>
            </button>
        </div>

    </div>



</div>
</form>