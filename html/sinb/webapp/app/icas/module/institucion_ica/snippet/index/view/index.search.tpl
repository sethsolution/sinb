<div class="row">


    <div class="col-lg-12 alert-text">
        <label class="text-dark-25">{#filterName#}:</label>
        <input type="text" class="filtro-buscar-text form-control"
               placeholder="{#filterHolderName#}" data-col-index="1">
    </div>
    <div class="col-lg-12 alert-text">
        <label class="text-dark-25">{#filterorma#}:</label>
        <select class="filtro-buscar form-control select2_busqueda" data-col-index="2">
            <option value="0">{#filterNormaSelectAll#}</option>
            {html_options options=$cataobj.programa_norma}

        </select>
    </div>

    <div class="col-lg-12 alert-text">
        <label class="text-dark-25">{#filterStatus#}:</label>
        <select class="filtro-buscar form-control select2_busqueda"  data-col-index="3">
            <option value="0">{#filterStatusSelectAll#}</option>
            {html_options options=$cataobj.programa_estado}
        </select>
    </div>

</div>

