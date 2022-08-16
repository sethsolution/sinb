<div class=" row m--padding-bottom-15 busqueda_panel " >

    <div class="col-lg-12 titulo m--margin-bottom-5 m--padding-left-5">
        Criterios de búsqueda para Certificados de Dispensación
    </div>
    <div class="col-lg-4 m--margin-bottom-10-tablet-and-mobile">
        <label>Nro. de certificación:</label>
        <input type="text" class="filtro-buscar-text form-control m-input" placeholder="Buscar por nro" data-col-index="2">
    </div>
    <div class="col-lg-4 m--margin-bottom-10-tablet-and-mobile">
        <label>Tipo de Documentación:</label>
        <select class="filtro-buscar form-control m-input select2_busqueda"   data-col-index="1">
            <option value="0">Todos los Documentos</option>
            {html_options options=$cataobj.tipo_documento}
        </select>
    </div>
    <div class="col-lg-4 m--margin-bottom-10-tablet-and-mobile">
        <label>Estado:</label>
        <select class="filtro-buscar form-control m-input select2_busqueda"   data-col-index="4">
            <option value="0">Todos los Estados</option>
            {html_options options=$cataobj.estado}
        </select>
    </div>
    <div class="col-lg-4 m--margin-bottom-10-tablet-and-mobile">
        <label>Especie:</label>
        <select class="form-control m-input select2_busqueda" id="especie" data-col-index="2">
            <option value="0">Todas las especies</option>
            {html_options options=$cataobj.especie}
        </select>
    </div>
    <div class="col-lg-4 m--margin-bottom-10-tablet-and-mobile">
        <label>Nombre Importador:</label>
        <input type="text" class="filtro-buscar-text form-control m-input" placeholder="Buscar por Importador" data-col-index="2">
    </div>
    <div class="col-lg-4 m--margin-bottom-10-tablet-and-mobile">
        <label>Nombre Exportador:</label>
        <input type="text" class="filtro-buscar-text form-control m-input" placeholder="Buscar por Exportador" data-col-index="3">
    </div>



</div>