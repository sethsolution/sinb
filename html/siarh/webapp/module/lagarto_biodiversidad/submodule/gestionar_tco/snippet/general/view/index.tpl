<!--begin::Portlet-->
<div class="m-portlet">
    <!--begin::Form-->
    <form class="m-form m-form--fit m-form--label-align-right m-form--group-seperator-dashed" method="POST" action="{$getModule}"  id="general_form">

        <div class="m-portlet__head">
            <div class="m-portlet__head-caption">
                <div class="m-portlet__head-title">
                    <h3 class="m-portlet__head-text">{if $type=="update"}Datos a modificar de la Regional{else}Datos de la nueva Regional{/if}</h3>
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
                <div class="col-lg-6">
                    <label>Regional:</label>
                    <div class="m-input-icon m-input-icon--right">
                        <input type="text" class="form-control m-input"  placeholder="Ingrese la Regional" name="item[tco]" name="" value="{$item.tco|escape:"html"}"
                               data-msg="Campo requerido" required minlength="1">
                        <span class="m-input-icon__icon m-input-icon__icon--right"><span><i class="la la-pencil-square-o"></i></span></span>
                    </div>
                </div>                
                {if $type==="update"}
                    <div class="col-lg-6">
                        <label>Municipio:</label>
                        <div class="m-input-icon m-input-icon--right">
                            <input type="text" class="form-control m-input"  disabled placeholder="municipio"  name="" value="{$item.municipio|escape:"html"}"
                                data-msg="Campo requerido" required minlength="1">
                            <span class="m-input-icon__icon m-input-icon__icon--right"><span><i class="la la-pencil-square-o"></i></span></span>
                        </div>
                    </div>
                {else}
                    <div class="col-lg-6">
                        <label>Municipio: </label>
                        <div class="m-input-icon m-input-icon--right">
                            <select class="form-control m-select2 select2_general" name="item[municipio_itemId]" id="municipio_itemId"
                                    data-placeholder="Elija un servidor" {$privFace.input} data-msg="Campo requerido" required>
                                <option></option>
                                {html_options options=$cataobj.Municipio selected=$item.municipio_itemId}
                            </select>
                        </div>
                    </div>
                {/if}
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