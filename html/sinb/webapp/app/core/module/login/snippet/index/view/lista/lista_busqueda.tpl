
<div class="row m--margin-bottom-20">
    <div class="col-lg-3 m--margin-bottom-10-tablet-and-mobile">
        <label>Proveedor:</label>
        <select class="filtro-buscar form-control select2_busqueda "  data-col-index="2">
            <option value="0">Todos los Proveedores</option>
            {html_options options=$cataobj.proveedor}
        </select>
    </div>
    <div class="col-lg-3 m--margin-bottom-10-tablet-and-mobile">
        <label>Lugar:</label>
        <select class="filtro-buscar form-control select2_busqueda " data-col-index="3">
            <option value="0">Todos los Lugares</option>
            {html_options options=$cataobj.lugar}
        </select>
    </div>
</div>
<div class="m-separator m-separator--md m-separator--dashed"></div>
