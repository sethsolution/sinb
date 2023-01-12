<h4 class="titulo_esta">Filtro</h4>

<div class="row  fade show mb-5 p-2" >

    <div class="col-lg-12 alert-text">
        <label>Departamento:</label>
        <select class="filtro-buscar form-control select2_busqueda"
                name="filtro[departamento]" id="filtro_departamento"
                multiple placeholder="Buscar por nombre">
            {html_options options=$cataobj.departamento}
        </select>
    </div>

    {*
    <div class="col-lg-12 alert-text">
        <label>Tipo de fuente de generación:</label>
        <select class="filtro-buscar form-control select2_busqueda"
                name="filtro[gd_tipo_fuente_generacion]" id="filtro_gd_tipo_fuente_generacion"
                multiple placeholder="Buscar por nombre">
            {html_options options=$cataobj.gd_tipo_fuente_generacion}
        </select>
    </div>
*}

</div>

<div class=" card-custom gutter-b">
    <!--begin::Body-->
    <div class="card-body p-0">
        <!--begin::Wrapper-->

        <h4 class="titulo_esta">Cantidad de ilicitos por departamento</h4>

        <div class="d-flex justify-content-between flex-column h-100 mb-5">
            <!--begin::Container-->
            <div class="mt-0 mb-0">
                <div class="row row-paddingless mb-10" id="box_totales" >

                </div>

                <div class="row row-paddingless">



                </div>
            </div>


            <!--eng::Container-->
        </div>
        <!--end::Wrapper-->


    </div>
    <!--end::Body-->
</div>
