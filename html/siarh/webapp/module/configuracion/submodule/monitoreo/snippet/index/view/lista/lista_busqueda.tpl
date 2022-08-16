
<div class="row m--margin-bottom-20">
    <div class="col-lg-4 m--margin-bottom-10-tablet-and-mobile">
        <label>Nombre:</label>
        <input type="text" class="filtro-buscar-text form-control m-input" placeholder="Buscar un nombre" data-col-index="2">
    </div>

    <div class="col-lg-4 m--margin-bottom-10-tablet-and-mobile">
        <label>Activo:</label>
        <select class="filtro-buscar2 form-control m-input select2_busqueda"  data-col-index="6">
            <option value="5">Todas los Categorias</option>
            {html_options options=$cataobj.activo}
        </select>
    </div>
</div>
<div class="m-separator m-separator--md m-separator--dashed"></div>

