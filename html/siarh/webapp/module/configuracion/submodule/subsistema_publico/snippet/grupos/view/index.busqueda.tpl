<div class="row m--margin-bottom-20">

    <div class="col-lg-4 m--margin-bottom-10-tablet-and-mobile">
        <label>Nombre:</label>
        <input type="text" class="filtro-buscar-text form-control m-input" placeholder="Buscar por nombre" data-col-index="1">
    </div>

    <div class="col-lg-4 m--margin-bottom-10-tablet-and-mobile">
        <label>Estado:</label>
        <select class="filtro-buscar form-control m-input select2_busqueda"   data-col-index="7">
            <option value="5">Todos los Estados</option>
            {html_options options=$cataobj.activo}
        </select>
    </div>
</div>
<div class="m-separator m-separator--md m-separator--dashed"></div>
