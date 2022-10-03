<!--begin::Portlet-->
<div class="m-portlet">
    <!--begin::Form-->
    <form class="m-form m-form--fit m-form--label-align-right m-form--group-seperator-dashed" method="POST" action="{$getModule}"  id="general_form">

        <div class="m-portlet__head">
            <div class="m-portlet__head-caption">
                <div class="m-portlet__head-title">
                    <h3 class="m-portlet__head-text">{if $type=="update"}Datos a modificar de la empresa{else}Datos de la empresa{/if}</h3>
                </div>
            </div>

        </div>

        <div class="m-portlet__body">
            <div class="form-group m-form__group row">                
                <div class="col-lg-6">
                    <label>Nombre de la empresa:</label>
                    <div class="m-input-icon m-input-icon--right">
                        <input type="text" class="form-control m-input" placeholder="Ingrese el nombre de la empresa" name="item[curtiembre]" name="" value="{$item.curtiembre|escape:"html"}"
                               data-msg="Campo requerido" required minlength="1">
                        <span class="m-input-icon__icon m-input-icon__icon--right"><span><i class="la la-pencil-square-o"></i></span></span>
                    </div>
                </div>       
                <div class="col-lg-6">
                    <label>C&oacutedigo de Verificaci&oacuten:</label>
                    <div class="m-input-icon m-input-icon--right">
                        <input type="text" class="form-control m-input" placeholder="Ingrese el nombre de la curtiembre" name="item[codigo]" name="" value="{$item.codigo|escape:"html"}"
                               data-msg="Campo requerido" required minlength="1">
                        <span class="m-input-icon__icon m-input-icon__icon--right"><span><i class="la la-pencil-square-o"></i></span></span>
                    </div>
                </div>
            </div>
	    <div class="form-group m-form__group row">  
                <div class="col-lg-6">          
                    <label>Tipo de empresa: </label>
                    <div class="m-input-icon m-input-icon--right">
                        <select class="form-control m-select2 select2_general"  id="tipo_empresa" name="item[tipo_empresa_itemId]"
                                data-placeholder="Elija un tipo de empresa" {$privFace.input} data-msg="Campo requerido" required>
                            <option></option>
                            {html_options options=$cataobj.TipoEmpresa selected=$item.tipo_empresa_itemId}
                        </select>
                    </div>
                </div>             
                           
                <div class="col-lg-6">
                    <label class="caza">Tiempo de validéz de la empresa (fecha de Expiración): </label>
                    
                    <div class="input-group date" >
                        <input type="text" class="form-control m-input fecha_general"   placeholder="Seleccione la fecha"  name="item[fecha_exp]"
                               value="{$item.fecha_exp|date_format:"%d/%m/%Y"}" data-msg="Campo requerido"/>
                        <div class="input-group-append">
    							<span class="input-group-text">
    							<i class="flaticon-calendar-1"></i>
    							</span>
                        </div>
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