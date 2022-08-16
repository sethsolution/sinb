
<div class="row m--margin-bottom-20">
    <div class="col-lg-3 m--margin-bottom-10-tablet-and-mobile">
        <label>C.I.:</label>
        <input type="text" class="filtro-buscar-num form-control m-input" placeholder="Buscar un Numero Item" data-col-index="4">
    </div>
    <div class="col-lg-3 m--margin-bottom-10-tablet-and-mobile">
        <label>Nombre:</label>
        <input type="text" class="filtro-buscar-num form-control m-input" placeholder="Buscar un Numero Item" data-col-index="1">
    </div>
    <div class="col-lg-3 m--margin-bottom-10-tablet-and-mobile">
        <label>Apellido:</label>
        <input type="text" class="filtro-buscar-text form-control m-input" placeholder="Buscar un item/Puesto" data-col-index="2">
    </div>
    <div class="col-lg-3 m--margin-bottom-10-tablet-and-mobile">
        <label>Categoria:</label>
        <select class="filtro-buscar form-control m-input select2_busqueda" id="filtro_categoria" data-col-index="5" >
            <option value="0">Todas las categorias</option>
            {html_options options=$cataobj.departamento}
        </select>
    </div>
</div>

<div class="m-separator m-separator--md m-separator--dashed"></div>
