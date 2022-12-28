<form class="m-form m-form--fit m--margin-bottom-20">
    <div class="row m--margin-bottom-20">
        <div class="col-lg-3 m--margin-bottom-10-tablet-and-mobile">
            <label>Departamento:</label>
            <select class="form-control m-input select2_busqueda" data-col-index="6" multiple>

                {html_options options=$cataobj.departamento selected=$item.departamentoId}
            </select>
        </div>
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

    <div class="row">
        <div class="col-lg-12">
            <button class="btn btn-brand m-btn m-btn--icon" id="m_search">
						<span>
							<i class="la la-search"></i>
							<span>Buscar</span>
						</span>
            </button>
            &nbsp;&nbsp;
            <button class="btn btn-secondary m-btn m-btn--icon" id="m_reset">
						<span>
							<i class="la la-close"></i>
							<span>Limpiar</span>
						</span>
            </button>
        </div>
    </div>
</form>