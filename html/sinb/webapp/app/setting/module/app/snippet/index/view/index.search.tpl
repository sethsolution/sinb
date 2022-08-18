<div class="row alert alert-custom alert-light-primary fade show mb-5" role="alert" >
    <div class="col-lg-4 alert-text">
        <label>{#filterName#}:</label>
        <input type="text" class="filtro-buscar-text form-control m-input" placeholder="{#filterNameHolder#}" data-col-index="2">
    </div>
    <div class="col-lg-4 alert-text">
        <label>{#filterFolderName#}:</label>
        <input type="text" class="filtro-buscar-text form-control m-input" placeholder="{#filterFolderNameHolder#}" data-col-index="8">
    </div>

    {*
    <div class="col-lg-4 alert-text">
        <label>{#filterAppStatus#}:</label>
        <select class="filtro-buscar form-control m-input select2_busqueda"  data-col-index="3">
            <option value="3">{#filterAppStatusSelectAll#}</option>
            {html_options options=$cataobj.activo}
        </select>
    </div>
    *}
</div>

