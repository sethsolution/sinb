<!--begin::Portlet-->
<div class="m-portlet">
    <!--begin::Form-->
    <form class="m-form m-form--fit m-form--label-align-right m-form--group-seperator-dashed" method="POST" action="{$getModule}"  id="general_form">

        

        <div class="m-portlet__body">

            <div class="row title-low-green">
                <div class="col-lg-6">
                    <h6 class="m-portlet__head-text">Reporte de Tenencia de Actas por Empresa</h6>
                </div>
            </div> 
            <div class="form-group m-form__group row title-low">
                <div class="col-lg-6">
                    <label>Empresa: </label>
                    <div class="m-input-icon m-input-icon--right">
                        <select class="form-control m-select2 select2_general"  id="curtiembre"
                                data-placeholder="Elija un servidor" {$privFace.input} data-msg="Campo requerido" required>
                            <option></option>
                            {html_options options=$cataobj.Curtiembre selected=$item.modalidad_id}
                        </select>
                    </div>
                </div>
                <div class="col-lg-6">
                    <label>Gestion: </label>
                    <div class="m-input-icon m-input-icon--right">
                        <select class="form-control m-select2 select2_general"  id="gestion"
                                data-placeholder="Elija un servidor" {$privFace.input} data-msg="Campo requerido" required>
                            <option></option>
                            {html_options options=$cataobj.Gestion selected=$item.modalidad_id}
                        </select>
                    </div>
                </div>
            </div>
        </div>

        <div class="m-portlet__foot m-portlet__no-border m-portlet__foot--fit">
            <div class="m-form__actions m-form__actions--solid">
                <div class="row title-low">
                    <div class="col-lg-6">
                        <button type="reset" class="btn btn-primary" id="general_submit_cuero">Generar Reporte Cuero</button>
                    </div>
                    <div class="col-lg-6">
                        <button type="reset" class="btn btn-success" id="general_submit_carne">Generar Reporte Carne</button>
                    </div>

                </div>
                
            </div>
        </div>
    </form>
    <!--end::Form-->
</div>
<!--end::Portlet-->
{include file="index.js.tpl"}
{include file="index.css.tpl"}