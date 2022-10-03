<!--begin::Portlet-->
<div class="m-portlet">
    <!--begin::Form-->
    <form class="m-form m-form--fit m-form--label-align-right m-form--group-seperator-dashed" method="POST" action="{$getModule}"  id="general_form">

        

        <div class="m-portlet__body" >
            <div class ="tabla">
                <div class="row title-low">
                    <div class="col-lg-2 col-md-2 col-sm-3 col-xs-3 title-low-green  col-12" >
                        <h6 class="m-portlet__head-text">Longitud (m)</h6>
                    </div>    
                    <div class="col-lg-1 col-md-1 col-sm-3 col-xs-3  title-low-green  col-12">
                        <h6 class="m-portlet__head-text">Cantidad</h6>
                    </div>   
                    <div class="col-lg-1 col-md-1 col-sm-3 col-xs-3  title-low-green  col-12">
                        <h6 class="m-portlet__head-text">Primera</h6>
                    </div>  
                    <div class="col-lg-1 col-md-1 col-sm-3 col-xs-3  title-low-green  col-12">
                        <h6 class="m-portlet__head-text">Segunda</h6>
                    </div>  
                    <div class="col-lg-1 col-md-1 col-sm-3 col-xs-3  title-low-green  col-12">
                        <h6 class="m-portlet__head-text">Rechazados</h6>
                    </div>  
                    <div class="col-lg-1 col-md-2 col-sm-3 col-xs-3  title-low-green  col-12">
                        <h6 class="m-portlet__head-text">Pie Cuadrado</h6>
                    </div>  
                    <div class="col-lg-1 col-md-2 col-sm-3 col-xs-3  title-low-green  col-12">
                        <h6 class="m-portlet__head-text">Precio/u</h6>
                    </div>   
                    <div class="col-lg-1 col-md-2 col-sm-3 col-xs-3  title-low-green  col-12">
                        <h6 class="m-portlet__head-text">Total/Bs.</h6>
                    </div>         
                    
                </div>
                {foreach from=$filas item=fila key=key name=name}
                </br>
                <div class="row title-low">
                    <div class=" col-md-2 col-lg-2 col-sm-3 col-12 text-blue">
                        <h6 class="m-portlet__head-text">{$fila.longitud_literal}</h6>
                    </div>
                    <div class=" col-md-1 col-lg-1 col-sm-3 col-12">
                        <div class="m-input-icon">
                            <input id="cantidad{$key+1}" type="text" disabled class="form-control m-input" placeholder="Ingrese la cantidad" name="{$fila.longitud_literal}1"  value="{$fila.cantidad}"
                                data-msg="*Requerido" required minlength="1">
                        </div>
                    </div> 
                    <div class=" col-md-1 col-lg-1 col-sm-3 col-12">
                        <div class="m-input-icon ">
                            <input id="primera{$key+1}" type="number" {if $item.estado==1||$item.rol_itemId==1}disabled{/if} class="form-control m-input"  name="{$fila.longitud_literal}2"  value="{$fila.primera}"
                                data-msg="*Requerido" required minlength="1">
                        </div>
                    </div> 
                    <div class=" col-md-1 col-lg-1 col-sm-3 col-12">
                        <div class="m-input-icon ">
                            <input id="segunda{$key+1}" type="number" {if $item.estado==1||$item.rol_itemId==1}disabled{/if} class="form-control m-input"  name="{$fila.longitud_literal}3"  value="{$fila.segunda}"
                                data-msg="*Requerido" required minlength="1">
                        </div>
                    </div> 
                    <div class=" col-md-1 col-lg-1 col-sm-3 col-12">
                        <div class="m-input-icon ">
                            <input id="rechazados{$key+1}" type="number" {if $item.estado==1||$item.rol_itemId==1}disabled{/if} class="form-control m-input"  name="{$fila.longitud_literal}4"  value="{$fila.rechazados}"
                                data-msg="*Requerido" required minlength="1">
                        </div>
                    </div>   
                    <div class=" col-md-2 col-lg-1 col-sm-3 col-12">
                        <div class="m-input-icon ">
                            <input id="pieCuadrado{$key+1}" type="number" {if $item.estado==1||$item.rol_itemId==1}disabled{/if} class="form-control m-input" name="{$fila.longitud_literal}5"  value="{$fila.pie_cuadrado}" 
                                data-msg="*Requerido" required minlength="1">
                        </div>
                    </div> 
                    <div class=" col-md-2 col-lg-1 col-sm-3 col-12">
                        <div class="m-input-icon ">
                            <input id="precioUnidad{$key+1}" type="number" {if $item.estado==1||$item.rol_itemId==1}disabled{/if} class="form-control m-input"  name="{$fila.longitud_literal}6"  value="{$fila.precio_unidad}" 
                                data-msg="*Requerido" required minlength="1">
                        </div>
                    </div> 
                    <div class=" col-md-2 col-lg-1 col-sm-3 col-12">
                        <div class="m-input-icon">
                            <input id="precioTotal{$key+1}" type="number" {if $item.estado==1||$item.rol_itemId==1}disabled{/if} class="form-control m-input"  name="{$fila.longitud_literal}7"  value="{$fila.precio_total}" 
                                data-msg="*Requerido" required minlength="1">
                        </div>
                    </div> 
                              
                    
                </div> 
                {/foreach}
            </div>
            <div class="row title-low-green">
                <div class="col-lg-6">
                    <h6 class="m-portlet__head-text">Totales</h6>
                </div>
            </div>    
            <div class="form-group m-form__group row">
                <div class="col-lg-6">
                    <label>Total Chalecos:</label>
                    <div class="m-input-icon m-input-icon--right">
                        <input type="number" readonly class="form-control m-input" style="background-color:#387ec9; color:white;" disabled placeholder="Cantidad de cueros de primera" name="item[total_chalecos]"  value="{$item.total_chalecos|escape:"html"}"
                               data-msg="Campo requerido" id="total_chalecos" required minlength="1">
                    </div>
                </div>
                <div class="col-lg-6">
                    <label>Chalecos Entregados:</label>
                    <div class="m-input-icon m-input-icon--right">
                        <input type="number"   class="form-control m-input" disabled placeholder="Ingrese la cantidad" name="item[entregado_chalecos]" name="" value="{$item.entregado_chalecos|escape:"html"}"
                               data-msg="Campo requerido" required minlength="1">
                        <span class="m-input-icon__icon m-input-icon__icon--right"><span><i class="la la-pencil-square-o"></i></span></span>
                    </div>
                </div>
                
                
                
                
            </div>
            <div class="form-group m-form__group row">
                
                
                <div class="col-lg-6">
                    <label>Total Colas:</label>
                    <div class="m-input-icon m-input-icon--right">
                        <input type="number" class="form-control m-input" style="background-color:#387ec9; color:white;" disabled placeholder="Ingrese la cantidad" name="item[total_colas]" name="" value="{$item.total_colas|escape:"html"}"
                               data-msg="Campo requerido" required minlength="1">
                    </div>
                </div>
                <div class="col-lg-6">
                    <label>Colas Entregadas:</label>
                    <div class="m-input-icon m-input-icon--right">
                        <input type="number"   class="form-control m-input" disabled placeholder="Ingrese la cantidad" name="item[entregado_colas]" name="" value="{$item.entregado_colas|escape:"html"}"
                               data-msg="Campo requerido" required minlength="1">
                        <span class="m-input-icon__icon m-input-icon__icon--right"><span><i class="la la-pencil-square-o"></i></span></span>
                    </div>
                </div>
                
                
                
                
            </div>
            <div class="form-group m-form__group row">
                
                
                <div class="col-lg-6">
                    <label>Total Precio (Bs):</label>
                    <div class="m-input-icon m-input-icon--right">
                        <input type="number"  id="totalPrecio" class="form-control m-input" {if $item.estado==1||$item.rol_itemId==1}disabled{/if} readonly placeholder="Ingrese la cantidad" name="item[total_precio]" name="" value="{$item.total_precio|escape:"html"}"
                               data-msg="Campo requerido" required minlength="1">
                        <span class="m-input-icon__icon m-input-icon__icon--right"><span><i class="la la-pencil-square-o"></i></span></span>
                    </div>
                </div>
                
                <div class="col-lg-6">
                    <label>Precio Total Colas (Bs):</label>
                    <div class="m-input-icon m-input-icon--right">
                        <input type="number"  id="precioColas" class="form-control m-input" {if $item.estado==1||$item.rol_itemId==1}disabled{/if}  placeholder="Ingrese la cantidad" name="item[precio_colas]" value="{$item.precio_colas|escape:"html"}"
                               data-msg="Campo requerido" required minlength="1">
                        <span class="m-input-icon__icon m-input-icon__icon--right"><span><i class="la la-pencil-square-o"></i></span></span>
                    </div>
                </div>
                
                
                
            </div>
            <div class="form-group m-form__group row">
                <div class="col-lg-6">
                    <label>Total Pie Cuadrados:</label>
                    <div class="m-input-icon m-input-icon--right">
                        <input type="number"  id="totalPieCuadrado" class="form-control m-input" {if $item.estado==1||$item.rol_itemId==1}disabled{/if}  placeholder="Ingrese la cantidad" name="item[total_pie_cuadrado]" name="" value="{$item.total_pie_cuadrado|escape:"html"}"
                               data-msg="Campo requerido" required minlength="1">
                        <span class="m-input-icon__icon m-input-icon__icon--right"><span><i class="la la-pencil-square-o"></i></span></span>
                    </div>
                </div>
                <div class="col-lg-6">
                    <label>Comunidad:</label>
                    <div class="m-input-icon m-input-icon--right">
                        <input type="text"  class="form-control m-input" disabled  placeholder="Ingrese la cantidad" name="item[total_comunidad]" name="" value="{$item.comunidad|escape:"html"}"
                               data-msg="Campo requerido" required minlength="1">
                        <span class="m-input-icon__icon m-input-icon__icon--right"><span><i class="la la-pencil-square-o"></i></span></span>
                    </div>
                </div>
            </div>
            <div class="form-group m-form__group row">
                <div class="col-lg-6">
                    <label>Curtiembre:</label>
                    <div class="m-input-icon m-input-icon--right">
                        <input type="text" class="form-control m-input" disabled readonly placeholder="Ingrese la cantidad" name="item[total_colas]" name="" value="{$cataobj[$item.responsable_curtiembre_itemId]|escape:"html"}"
                               data-msg="Campo requerido" required minlength="1">
                        <span class="m-input-icon__icon m-input-icon__icon--right"><span><i class="la la-pencil-square-o"></i></span></span>
                    </div>
                </div>
            </div>
        </div>

        <div class="m-portlet__foot m-portlet__no-border m-portlet__foot--fit">
            <div class="m-form__actions m-form__actions--solid">
                <div class="row">
                    {if $item.rol_itemId==4}
                    <div class=" col-md-3 col-lg-3 col-sm-4 col-6">
                        {if $privFace.editar == 1}
                        <button type="reset" {if $item.estado==1||$item.rol_itemId==1}disabled{/if} class="btn btn-primary" id="general_submit">Guardar Cambios</button>
                        {/if}
                    </div>
                    <div class=" col-md-3 col-lg-3 col-sm-4 col-6">
                        {if $privFace.editar == 1}
                        <button type="reset" {if $item.estado==1||$item.rol_itemId==1}disabled{/if} class="btn btn-warning" id="preview_submit">Guardar Borrador</button>
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