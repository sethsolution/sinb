<!--begin::Portlet-->
<div class="m-portlet">
    <!--begin::Form-->
    <form class="m-form m-form--fit m-form--label-align-right m-form--group-seperator-dashed" method="POST" action="{$getModule}"  id="general_form">

        <div class="m-portlet__head">
            <div class="m-portlet__head-caption">
                <div class="m-portlet__head-title">
                    <h3 class="m-portlet__head-text">{if $type=="update"}Datos a modificar de los Cupos{else}Datos del nuevo Cupo{/if}</h3>
                </div>
            </div>

        </div>

        <div class="m-portlet__body">
            <div class="form-group m-form__group row">     
                {if $type==="update"}
                    <div class="col-lg-6">
                        <label>Departamento:</label>
                        <div class="m-input-icon m-input-icon--right">
                            <input type="text" class="form-control m-input"  disabled placeholder="municipio"  name="" value="{$item.departamento|escape:"html"}"
                                data-msg="Campo requerido" required minlength="1">
                            <span class="m-input-icon__icon m-input-icon__icon--right"><span><i class="la la-pencil-square-o"></i></span></span>
                        </div>
                    </div>
                {else} 
                <div class="col-lg-6">          
                    <label>Departamento: </label>
                    <div class="m-input-icon m-input-icon--right">
                        <select class="form-control m-select2 select2_general"  id="departamento"
                                data-placeholder="Elija un servidor" {$privFace.input} data-msg="Campo requerido" required>
                            <option></option>
                            {html_options options=$cataobj.Departamento selected=$item.departamento}
                        </select>
                    </div>
                </div>   
                {/if}           
                {if $type==="update"}
                    <div class="col-lg-6">
                        <label>Provincia:</label>
                        <div class="m-input-icon m-input-icon--right">
                            <input type="text" class="form-control m-input"  disabled placeholder="municipio"  name="" value="{$item.provincia|escape:"html"}"
                                data-msg="Campo requerido" required minlength="1">
                            <span class="m-input-icon__icon m-input-icon__icon--right"><span><i class="la la-pencil-square-o"></i></span></span>
                        </div>
                    </div>
                {else}     
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
            <div class="form-group m-form__group row">    
                       
                           
                {if $type==="new"}
                <div class="col-lg-6">
                    <label>Municipio: </label>
                    <div class="m-input-icon m-input-icon--right">
                        <select class="form-control m-select2 select2_general"  id="municipio"
                                data-placeholder="Elija un servidor" {$privFace.input} data-msg="Campo requerido" required>
                            <option></option>
                            {html_options options=$cataobj["Municipio"] selected=$item.municipio}
                        </select>
                    </div>
                </div> 
                {/if} 
                {if $type==="update"}
                <div class="col-lg-6">
                    <label>Municipio: </label>
                    
                    <div class="m-input-icon m-input-icon--right">
                        <input type="text" disabled class="form-control m-input" placeholder="Ingrese el cupo Total"  value="{$item["municipio"]|escape:"html"}"
                               data-msg="Campo requerido" required minlength="1">
                        <span class="m-input-icon__icon m-input-icon__icon--right"><span><i class="la la-pencil-square-o"></i></span></span>
                    </div>
                </div> 
                {/if}           
            </div>
            <div class="form-group m-form__group row">    

                {if $type==="new"}                    
                <div class="col-lg-6">
                    <label>Regional: </label>
                    <div class="m-input-icon m-input-icon--right">
                        <select class="form-control m-select2 select2_general" name="item[tco_itemId]" id="tco_itemId"
                                data-placeholder="Elija un servidor" {$privFace.input} data-msg="Campo requerido" required>
                            <option></option>
                            {html_options options=$cataobj["Tco"] selected=$item.tco_itemId}
                        </select>
                    </div>
                </div>
                {/if} 
                {if $type==="update"}
                <div class="col-lg-6">
                    <label>Regional: </label>
                    
                    <div class="m-input-icon m-input-icon--right">
                        <input type="text"  disabled class="form-control m-input" placeholder="Ingrese el cupo Total" name="itesdfgsdfgsdfg" name="" value="{$item["tco"]}"
                               data-msg="Campo requerido" required minlength="1">
                        <span class="m-input-icon__icon m-input-icon__icon--right"><span><i class="la la-pencil-square-o"></i></span></span>
                    </div>
                </div> 
                {/if}                 
                {if $type==="new"}
                    <div class="col-lg-6">
                        <label>Gestion: </label>
                        <div class="m-input-icon m-input-icon--right">
                            <select class="form-control m-select2 select2_general" name="item[gestion_itemId]" id="gestion_itemId"
                                    data-placeholder="Elija un servidor" {$privFace.input} data-msg="Campo requerido" required>
                                <option></option>
                                {html_options options=$cataobj["Gestion"] selected=$item.gestion_itemId}
                            </select>
                        </div>
                    </div>
                {else}
                <div class="col-lg-6">
                    <label>Gestion: </label>
                    
                    <div class="m-input-icon m-input-icon--right">
                        <input type="text" disabled class="form-control m-input" placeholder="Ingrese el cupo Total" name="itesdfgsdfgsdfg" name="" value="{$item["gestion_itemId"]|escape:"html"}"
                               data-msg="Campo requerido" required minlength="1">
                        <span class="m-input-icon__icon m-input-icon__icon--right"><span><i class="la la-pencil-square-o"></i></span></span>
                    </div>
                </div> 
                {/if}
            </div>
            <div class="form-group m-form__group row">               
                           
                <div class="col-lg-6">
                    <label>Cupo Total: </label>
                    
                    <div class="m-input-icon m-input-icon--right">
                        <input type="number" class="form-control m-input" placeholder="Ingrese el cupo Total" name="item[cupo_total]" name="" value="{$item.cupo_total|escape:"html"}"
                               data-msg="Campo requerido" required minlength="1">
                        <span class="m-input-icon__icon m-input-icon__icon--right"><span><i class="la la-pencil-square-o"></i></span></span>
                    </div>
                </div>              
                <div class="col-lg-6">
                    <label>Cupo Parcial: </label>
                    
                    <div class="m-input-icon m-input-icon--right">
                        <input type="number" class="form-control m-input" readonly placeholder="Ingrese el cupo parcial" name="item[cupo_parcial]" name="" id="parcial" value="{$item.cupo_parcial|escape:"html"}"
                               data-msg="Campo requerido" required minlength="1">
                        <span class="m-input-icon__icon m-input-icon__icon--right"><span><i class="la la-pencil-square-o"></i></span></span>
                    </div>
                </div>
            </div>
        </div>       
                

        <div class="m-portlet__foot m-portlet__no-border m-portlet__foot--fit">
            <div class="m-form__actions m-form__actions--solid">
                <div class="row">
                    <div class="col-lg-6">
                        {if $privFace.editar == 1}
                        <button type="reset" class="btn btn-primary" id="general_submit">Guardar Cambios</button>
                        {/if}
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