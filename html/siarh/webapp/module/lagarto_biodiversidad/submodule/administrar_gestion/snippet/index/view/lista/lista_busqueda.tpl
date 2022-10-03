
    <div class="row m--margin-bottom-20">
        <div class="col-lg-3 m--margin-bottom-10-tablet-and-mobile">
            <label>Gestion:</label>
            <select class=" form-control m-input select2_busqueda" id="filtro_gestion" data-col-index="6" {*multiple*}>
                {html_options options=$cataobj.Gestion selected=$gestionId}
            </select>
        </div>

        {*
        <div class="col-lg-3 m--margin-bottom-10-tablet-and-mobile">
            <label>Modalidad:</label>
            <select class="form-control m-input select2_busqueda" data-col-index="12" multiple>
                {html_options options=$cataobj.modalidad selected=$item.modalidad_id}
            </select>
        </div>
        <div class="col-lg-3 m--margin-bottom-10-tablet-and-mobile">
            <label>genero:</label>
            <select class="form-control m-input select2_busqueda" data-col-index="7" multiple>
                {html_options options=$cataobj.genero selected=$item.genero_id}
            </select>
        </div>
        *}
    </div>
{*
    <div class="row m--margin-bottom-20">
        <div class="col-lg-3 m--margin-bottom-10-tablet-and-mobile">
            <label>Departamento:</label>
            <input type="text" class="form-control m-input" placeholder="E.g: 4590" data-col-index="0">
        </div>
        <div class="col-lg-3 m--margin-bottom-10-tablet-and-mobile">
            <label>Modalidad:</label>
            <input type="text" class="form-control m-input" placeholder="E.g: 37000-300" data-col-index="1">
        </div>
        <div class="col-lg-3 m--margin-bottom-10-tablet-and-mobile">
            <label>Genero:</label>
            <select class="form-control m-input" data-col-index="2">
                <option value="">Select</option>
            </select>
        </div>
        <div class="col-lg-3 m--margin-bottom-10-tablet-and-mobile">
            <label>Agent:</label>
            <input type="text" class="form-control m-input" placeholder="Agent ID or name" data-col-index="4">
        </div>
    </div>
*}


    <div class="m-separator m-separator--md m-separator--dashed"></div>

