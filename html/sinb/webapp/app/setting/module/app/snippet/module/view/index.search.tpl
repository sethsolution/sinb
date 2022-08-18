<div class="row alert alert-custom alert-light-primary fade show mb-5" role="alert" >
    <div class="col-lg-4 alert-text">
        <label>Group:</label>
        <select class="filtro-buscar form-control select2_busqueda " data-col-index="0">
            <option value="3">All the groups</option>
            {html_options options=$cataobj.group}
        </select>
    </div>
    <div class="col-lg-4 alert-text">
        <label>Name:</label>
        <input type="text" class="filtro-buscar-text form-control" placeholder="Search by name" data-col-index="1">
    </div>
    {*
    <div class="col-lg-4 alert-text">
        <label>Status:</label>
        <select class="filtro-buscar form-control select2_busqueda " data-col-index="13">
            <option value="5">All the states</option>
            {html_options options=$cataobj.activo}
        </select>
    </div>
*}
</div>

<div class="m-separator m-separator--md m-separator--dashed"></div>

