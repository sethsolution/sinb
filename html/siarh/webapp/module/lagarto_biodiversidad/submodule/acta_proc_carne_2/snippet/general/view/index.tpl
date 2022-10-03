<!--begin::Portlet-->
<div class="m-portlet">
    <!--begin::Form-->
    <form class="m-form m-form--fit m-form--label-align-right m-form--group-seperator-dashed" method="POST" action="{$getModule}"  id="general_form">

        

        <div class="m-portlet__body" >
            <div class ="tabla">
                <div class="row title-low">      
                    <div class="col-lg-2 col-md-3 col-sm-3 col-xs-3 title-low-green  col-6" >
                        <h6 class="m-portlet__head-text">Cantidad Charque (Kg)</h6>
                    </div>   
                    <div class="col-lg-2 col-md-3 col-sm-3 col-xs-3 title-low-green  col-6" >
                        <h6 class="m-portlet__head-text">Cantidad Carne (Kg)</h6>
                    </div>   
                         
                    
                </div>
                </br>
                <div class="row title-low">
                    <div class=" col-md-3 col-lg-2 col-sm-3 col-6">
                        
                        <div class="m-input-icon m-input-icon--right">
                            <input id="cantidad{$key+1}" disabled type="number" class="form-control m-input" placeholder="Ingrese la cantidad" name="item[total_charque]" name="" value="{$item.total_charque|escape:"html"}"
                                data-msg="Campo requerido" required minlength="1">
                            <span class="m-input-icon__icon m-input-icon__icon--right"><span><i class="la la-pencil-square-o"></i></span></span>
                        </div>
                    </div>
                    
                    <div class=" col-md-3 col-lg-2 col-sm-3 col-6">
                        <div class="m-input-icon m-input-icon--right">
                            <input  disabled type="number" class="form-control m-input" placeholder="Ingrese la cantidad"  name="" value="{$item.total_carne|escape:"html"}"
                                data-msg="Campo requerido" required minlength="1">
                            <span class="m-input-icon__icon m-input-icon__icon--right"><span><i class="la la-pencil-square-o"></i></span></span>
                        </div>
                    </div>   
                     
                            
                              
                    
                </div> 
            </div>
            <div class="row title-low-green">
                <div class="col-lg-6">
                    <h6 class="m-portlet__head-text">Precios</h6>
                </div>
            </div>    
            <div class="form-group m-form__group row">
                <div class="col-lg-4">
                    <label>Precio de carne de primera por Kg:</label>
                    <div class="m-input-icon m-input-icon--right">
                        <input type="number"  {if $item.estado=="1"||$usuarioInfo.rol_itemId!=4}disabled{/if} class="form-control m-input" placeholder="Cantidad de cueros de primera" name="item[precio_carne_primera]"  value="{$item.precio_carne_primera|escape:"html"}"
                               data-msg="Campo requerido" required minlength="1">
                        <span class="m-input-icon__icon m-input-icon__icon--right"><span><i class="la la-pencil-square-o"></i></span></span>
                    </div>
                </div>
                
                <div class="col-lg-4">
                    <label>Precio de carne de segunda por Kg:</label>
                    <div class="m-input-icon m-input-icon--right">
                        <input type="number" {if $item.estado=="1"||$usuarioInfo.rol_itemId!=4}disabled{/if} class="form-control m-input" placeholder="Ingrese la cantidad" name="item[precio_carne_segunda]" name="" value="{$item.precio_carne_segunda|escape:"html"}"
                               data-msg="Campo requerido" required minlength="1">
                        <span class="m-input-icon__icon m-input-icon__icon--right"><span><i class="la la-pencil-square-o"></i></span></span>
                    </div>
                </div>
                <div class="col-lg-4">
                    <label>Precio de Charque por Kg:</label>
                    <div class="m-input-icon m-input-icon--right">
                        <input type="number" {if $item.estado=="1"||$usuarioInfo.rol_itemId!=4}disabled{/if} class="form-control m-input" placeholder="Ingrese la cantidad" name="item[precio_charque]" name="" value="{$item.precio_charque|escape:"html"}"
                               data-msg="Campo requerido" required minlength="1">
                        <span class="m-input-icon__icon m-input-icon__icon--right"><span><i class="la la-pencil-square-o"></i></span></span>
                    </div>
                </div>
                
                
                
            </div>
            <div class="row title-low-green">
                <div class="col-lg-6">
                    <h6 class="m-portlet__head-text">Cantidad Entregada</h6>
                </div>
            </div>    
            <div class="form-group m-form__group row">
                <div class="col-lg-4">
                    <label>Entregado Carne Primera (Kg):</label>
                    <div class="m-input-icon m-input-icon--right">
                        <input type="number" disabled class="form-control m-input" placeholder="Cantidad de cueros de primera" name="item[entregado_carne_primera]"  value="{$item.entregado_carne_primera|escape:"html"}"
                               data-msg="Campo requerido" id="total_chalecos" required minlength="1">
                        <span class="m-input-icon__icon m-input-icon__icon--right"><span><i class="la la-pencil-square-o"></i></span></span>
                    </div>
                </div>
                
                <div class="col-lg-4">
                    <label>Entregado Carne Segunda (Kg):</label>
                    <div class="m-input-icon m-input-icon--right">
                        <input type="number"disabled class="form-control m-input" placeholder="Ingrese la cantidad" name="item[entregado_carne_segunda]" name="" value="{$item.entregado_carne_segunda|escape:"html"}"
                               data-msg="Campo requerido" required minlength="1">
                        <span class="m-input-icon__icon m-input-icon__icon--right"><span><i class="la la-pencil-square-o"></i></span></span>
                    </div>
                </div>
                <div class="col-lg-4">
                    <label>Entregado Charque (Kg):</label>
                    <div class="m-input-icon m-input-icon--right">
                        <input type="number" disabled class="form-control m-input" placeholder="Ingrese la cantidad" name="item[entregado_charque]" name="" value="{$item.entregado_charque|escape:"html"}"
                               data-msg="Campo requerido" required minlength="1">
                        <span class="m-input-icon__icon m-input-icon__icon--right"><span><i class="la la-pencil-square-o"></i></span></span>
                    </div>
                </div>
                
                
                
            </div>
            <div class="form-group m-form__group row">
                
                
                <div class="col-lg-6 col-md-6">
                    <label>Curtiembre: </label>
                    <div class="m-input-icon m-input-icon--right">
                        <select disabled class="form-control m-select2 select2_general" name="item[responsable_curtiembre_itemId]" id="responsable_curtiembre_itemId"
                                data-placeholder="Elija un servidor" {$privFace.input} data-msg="Campo requerido" required>
                            <option {if $item.estado=="1"}disabled{/if} ></option>
                            {html_options options=$cataobj selected=$item.responsable_curtiembre_itemId}
                        </select>
                    </div>
                </div> 
                <div class="col-lg-6 col-md-6">
                    <label>Comunidad:</label>
                    <div class="m-input-icon m-input-icon--right">
                        <input  disabled class="form-control m-input" placeholder="Ingrese la comunidad" name="item[comunidad]" name="" value="{$item.comunidad|escape:"html"}"
                               data-msg="Campo requerido" required minlength="1">
                        <span class="m-input-icon__icon m-input-icon__icon--right"><span><i class="la la-pencil-square-o"></i></span></span>
                    </div>
                </div>
                
                
                
            </div>
        </div>

        <div class="m-portlet__foot m-portlet__no-border m-portlet__foot--fit">
            <div class="m-form__actions m-form__actions--solid">
                <div class="row">
                    {if $usuarioInfo.rol_itemId==4}
                    <div class=" col-md-3 col-lg-3 col-sm-4 col-6">
                        {if $privFace.editar == 1}
                        <button type="reset" {if $item.estado==1}disabled{/if} class="btn btn-success" id="general_submit">Generar Reporte</button>
                        {/if}
                    </div>
                    <div class=" col-md-3 col-lg-3 col-sm-4 col-6">
                        {if $privFace.editar == 1}
                        <button type="reset" {if $item.estado==1}disabled{/if} class="btn btn-warning" id="preview_submit">Guardar Borrador</button>
                        {/if}
                    </div>
                    {/if}

                </div>
            </div>
        </div>
    </form>
    <!--end::Form-->
</div>
<!--end::Portlet-->
{include file="index.js.tpl"}
{include file="index.css.tpl"}