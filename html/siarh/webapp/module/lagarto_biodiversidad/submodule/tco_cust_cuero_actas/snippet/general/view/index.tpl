<!--begin::Portlet-->
<div class="m-portlet">
    <!--begin::Form-->
    <form class="m-form m-form--fit m-form--label-align-right m-form--group-seperator-dashed" method="POST" action="{$getModule}"  id="general_form">

        

        <div class="m-portlet__body">

            <div class="row title-low-green">
                <div class="col-lg-6">
                    <h6 class="m-portlet__head-text">Reporte de Tenencia de Actas por Regional</h6>
                </div>
            </div> 
	    <div class="form-group m-form__group row">  
                {if $usuarioInfo.rol_itemId==1||$usuarioInfo.rol_itemId==6}
		<div class="col-lg-6">          
                    <label>Departamento: </label>
                    <div class="m-input-icon m-input-icon--right">
                        <select  class="form-control m-select2 select2_general"  id="departamento"
                                data-placeholder="Elija un servidor" {$privFace.input} data-msg="Campo requerido" required>
                            <option ></option>
                            {html_options options=$cataobj.Departamento selected=$item.departamento}
                        </select>
                    </div>
                </div>  
                <div class="col-lg-6">
                    <label>Provincia: </label>
                    <div class="m-input-icon m-input-icon--right">
                        <select class="form-control m-select2 select2_general"  id="provincia"
                                data-placeholder="Elija un servidor" {$privFace.input} data-msg="Campo requerido" required>
                            <option></option>
                            {html_options options=$cataobj.Provincia selected=$item.provincia}
                        </select>
                    </div>
                </div>
		{/if}    
            </div>
            <div class="form-group m-form__group row title-low">
		
                <div class="col-lg-4">
                    <label>Municipio: </label>
                    <div class="m-input-icon m-input-icon--right">
                        <select {if $usuarioInfo.rol_itemId==3}disabled{/if} class="form-control m-select2 select2_general"  id="municipio"
                                data-placeholder="Elija un servidor" {$privFace.input} data-msg="Campo requerido" required>
                            <option></option>
                            {html_options options=$cataobj["Municipio"] selected=$item.municipio}
                        </select>
                    </div>
                </div>
                <div class="col-lg-4">
                    <label>Regional: </label>
                    <div class="m-input-icon m-input-icon--right">
                        <select class="form-control m-select2 select2_general"  id="tco"
                                data-placeholder="Elija un servidor" {$privFace.input} data-msg="Campo requerido" required>
                            <option></option>
                            {html_options options=$cataobj["TCO"] selected=$item.tco_itemId}
                        </select>
                    </div>
                </div>
                
                <div class="col-lg-4">
                    <label>Gestion: </label>
                    <div class="m-input-icon m-input-icon--right">
                        <select class="form-control m-select2 select2_general"  id="gestion"
                                data-placeholder="Elija un servidor" {$privFace.input} data-msg="Campo requerido" required>
                            <option></option>
                            {html_options options=$cataobj["Gestion"] selected=$item.tco_itemId}
                        </select>
                    </div>
                </div>
            </div>
        </div>

        <div class="m-portlet__foot m-portlet__no-border m-portlet__foot--fit">
            <div class="m-form__actions m-form__actions--solid">
                <div class="row title-low">
                    <div class="col-lg-6">
                        <button type="reset" class="btn btn-primary" id="general_submit">Generar Reporte</button>
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