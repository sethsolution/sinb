<form class="m-form m-form--fit m-form--label-align-right m-form--group-seperator-dashed" method="POST"
      action="{$getModule}"  id="form_modal_interface_{$subcontrol}">

<div class="portlet__body m--margin-5">
    <div class=" row m--padding-bottom-5 busqueda_panel cuadro-verde" >

        <div class="col-lg-12 titulo m--margin-bottom-5 m--padding-left-5">Reporte de recaudacion anual por Certificados CITES de especies</div>

        <div class="col-lg-6 m--margin-bottom-10-tablet-and-mobile">
            <label>Año Inicio:</label>
            <div class="input-group">

                <input type="text" class="form-control m-input numero_entero monto"
                       placeholder="Ingrese año" name="item[anio_inicio]" id="anio_inicio"
                       required data-msg="Campo requerido"
                       value="{$anio_inicio|escape:'html'}">

            </div>
        </div>
        <div class="col-lg-6 m--margin-bottom-10-tablet-and-mobile">
            <label>Año Final:</label>
            <div class="input-group">

                <input type="text" class="form-control m-input numero_entero monto"
                       placeholder="Ingrese año" name="item[anio_final]" id="anio_final"
                       required data-msg="Campo requerido"
                       value="{$anio_final|escape:'html'}">

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