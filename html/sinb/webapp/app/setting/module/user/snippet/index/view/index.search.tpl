<div class="row alert alert-custom alert-light-primary fade show mb-5" role="alert" >
    <div class="col-lg-4 alert-text">
        <label>{#filterName#}:</label>
        <input type="text" class="filtro-buscar-text form-control m-input" placeholder="{#filterName#}" data-col-index="0">
    </div>
    <div class="col-lg-4 alert-text">
        <label>{#filterLastName#}:</label>
        <input type="text" class="filtro-buscar-text form-control m-input" placeholder="{#filterLastName#}" data-col-index="1">
    </div>


    <div class="col-lg-4 alert-text">
        <label>{#filterType#}:</label>
        <select class="filtro-buscar form-control m-input select2_busqueda"
                data-placeholder="{#filterHolderType#}" data-col-index="4">
            <option value="3"">{#filterAppStatusSelectAll#}</option>
            {html_options options=$cataobj.tipo}
        </select>
    </div>

</div>

