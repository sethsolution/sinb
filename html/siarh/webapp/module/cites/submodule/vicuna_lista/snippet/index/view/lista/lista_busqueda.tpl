
<div class="portlet__body m--margin-5">
    <div class=" row m--padding-bottom-5 busqueda_panel" >

        {**}
        <div class="col-lg-4 m--margin-bottom-10-tablet-and-mobile">
            <label>Empresa:</label>
            <input type="text" class="filtro-buscar-text form-control m-input" placeholder="Buscar por nro" data-col-index="1">
        </div>
        {**}
        <div class="col-lg-4 m--margin-bottom-10-tablet-and-mobile">
            <label>Tipo de Documentación:</label>
            <select class="filtro-buscar form-control m-input select2_busqueda" data-col-index="2">
                <option value="0">Todos los Documentos</option>
                {html_options options=$cataobj.tipo_documento}
            </select>
        </div>
        <div class="col-lg-4 m--margin-bottom-10-tablet-and-mobile">
            <label>Estado:</label>
            <select class="filtro-buscar form-control m-input select2_busqueda"   data-col-index="7">
                <option value="0">Todos los Estados</option>
                {html_options options=$cataobj.estado}
            </select>
        </div>
        <div class="col-lg-6 m--margin-bottom-10-tablet-and-mobile">
            <label>Nombre Importador:</label>
            <input type="text" class="filtro-buscar-text form-control m-input" placeholder="Buscar por Importador" data-col-index="3">
        </div>
        <div class="col-lg-6 m--margin-bottom-10-tablet-and-mobile">
            <label>Nombre Exportador:</label>
            <input type="text" class="filtro-buscar-text form-control m-input" placeholder="Buscar por Exportador" data-col-index="4">
        </div>



    </div>
</div>
