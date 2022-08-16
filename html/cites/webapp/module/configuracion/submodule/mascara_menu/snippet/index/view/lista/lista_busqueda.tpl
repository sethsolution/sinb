
<div class="row m--margin-bottom-20">
    <div class="col-lg-4 m--margin-bottom-10-tablet-and-mobile">
        <label>Categoria:</label>
        <select class="filtro-buscar form-control m-input select2_busqueda " data-col-index="1">
            <option value="0">Todas los Categorias</option>
            {html_options options=$cataobj.categoria}
        </select>
    </div>

    <div class="col-lg-4 m--margin-bottom-10-tablet-and-mobile">
        <label>Nombre:</label>
        <input type="text" class="filtro-buscar-text form-control m-input" placeholder="Buscar un nombre" data-col-index="2">
    </div>

    <div class="col-lg-4 m--margin-bottom-10-tablet-and-mobile">
        <label>Tipo:</label>
        <select class="filtro-buscar form-control m-input select2_busqueda"  data-col-index="5">
            <option value="0">Todos los Tipos</option>
            {html_options options=$cataobj.activo}
        </select>
    </div>

</div>


<div class="m-separator m-separator--md m-separator--dashed"></div>

