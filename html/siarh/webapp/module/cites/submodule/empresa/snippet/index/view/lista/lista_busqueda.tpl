<div class="portlet__body m--margin-5">
    <div class=" row m--padding-bottom-5 busqueda_panel cuadro-verde" >
        <div class="col-lg-12 titulo m--margin-bottom-5 m--padding-left-5"><strong>Criterios de búsqueda para USUARIOS (empresas)</strong></div>

        <div class="col-lg-3 m--margin-bottom-10-tablet-and-mobile">
            <label>Estado de las solicitudes:</label>
            <select class="filtro-buscar form-control m-input select2_busqueda"   data-col-index="1">
                <option value="0">Todos los registros</option>
                {html_options options=$cataobj.estado}
            </select>
        </div>

        {*
        <div class="col-lg-5 m--margin-bottom-10-tablet-and-mobile">
            <label>Nombre de Proyecto:</label>
            <input type="text" class="filtro-buscar-text form-control m-input" placeholder="Buscar por nombre de Proyecto" data-col-index="3">
        </div>

        <div class="col-lg-2 m--margin-bottom-10-tablet-and-mobile">
            <label>Departamento:</label>
            <select class="filtro-buscar form-control m-input select2_busqueda"   data-col-index="7">
                <option value="0">Todos los Departamentos</option>
                {html_options options=$cataobj.departamento}
            </select>
        </div>

        <div class="col-lg-2 m--margin-bottom-10-tablet-and-mobile">
            <label>Acción:</label>
            <select class="filtro-buscar form-control m-input select2_busqueda"   data-col-index="6">
                <option value="0">Todas las Acciones</option>
                {html_options options=$cataobj.accion}
            </select>
        </div>
        *}

    </div>
</div>
