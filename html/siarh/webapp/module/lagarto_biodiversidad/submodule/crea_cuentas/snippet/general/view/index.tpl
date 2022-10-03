<!--begin::Portlet-->
<div class="m-portlet">
    <!--begin::Form-->
    <form method="POST" action="{$getModule}"  id="rol_form">
    </form>
    <form class="m-form m-form--fit m-form--label-align-right m-form--group-seperator-dashed" method="POST" action="{$getModule}"  id="general_form">
    
        <div class="m-portlet__head">
            <div class="m-portlet__head-caption">
                <div class="m-portlet__head-title">
                    <h3 class="m-portlet__head-text">{if $type=="update"}Datos a modificar del usuario{else}Datos del nuevo usuario{/if}</h3>
                </div>
            </div>

            
        </div>

        <div class="m-portlet__body">
        {if ($item.rol_itemId==4)&&$type==="new"}
        <div class="form-group m-form__group row">            
                <div class="col-lg-6">
                    <label>Empresa: </label>
                    <div class="m-input-icon m-input-icon--right">
                        <select id="curtiembre_itemId" class="form-control m-select2 select2_general" readonly name="item[curtiembre_itemId]"
                                data-placeholder="Elija un servidor" {$privFace.input} data-msg="Campo requerido" required>
                            <option></option>
                            {html_options options=$cataobj["Curtiembre"] selected=$item.curtiembre_itemId}
                        </select>
                    </div>
                </div>         
        </div>{/if}
        {if ($item.rol_itemId==5)&&$type==="new"}
        <div class="form-group m-form__group row">            
                <div class="col-lg-6">
                    <label>Empresa: </label>
                    <div class="m-input-icon m-input-icon--right">
                        <select id="curtiembre_itemId" class="form-control m-select2 select2_general" readonly name="item[empresa_itemId]"
                                data-placeholder="Elija un servidor" {$privFace.input} data-msg="Campo requerido" required>
                            <option></option>
                            {html_options options=$cataobj["Empresa"] selected=$item.empresa_itemId}
                        </select>
                    </div>
                </div>         
        </div>{/if}
        {if ($item.rol_itemId==2||$item.rol_itemId==3)&&$type==="new"}
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
                    <label>Municipio: </label>
                    <div class="m-input-icon m-input-icon--right">
                        <select class="form-control m-select2 select2_general" readonly  id="municipio_itemId"
                                data-placeholder="Elija un servidor" {$privFace.input} data-msg="Campo requerido" required>
                            <option></option>
                            {html_options options=$cataobj["Municipio"] selected=$item.municipio_itemId}
                        </select>
                    </div>
                </div>          
                <div class="col-lg-6">
                    <label>Regional: </label>
                    <div class="m-input-icon m-input-icon--right">
                        <select id="tco_itemId" class="form-control m-select2 select2_general" name="item[tco_itemId]" 
                                data-placeholder="Elija un servidor" {$privFace.input} data-msg="Campo requerido" required>
                            <option></option>
                            {html_options options=$cataobj["TCO"] selected=$item.tco_itemId}
                        </select>
                    </div>
                </div>
        </div>{/if}
        {if ($item.rol_itemId==4)&&$type==="update"}
        <div class="form-group m-form__group row">           
                           
                <div class="col-lg-6">
                    <label>Empresa: </label>
                    <div class="m-input-icon m-input-icon--right">
                        <input type="text" readonly class="form-control m-input" placeholder="Ingrese el nombre del usuario" name="" name="" value="{$cataobj["Curtiembre"][$item.curtiembre_itemId]|escape:"html"}"
                               data-msg="Campo requerido" required minlength="5">
                        <span class="m-input-icon__icon m-input-icon__icon--right"><span><i class="la la-pencil-square-o"></i></span></span>
                    </div>
                </div>        
        </div>{/if}
        {if ($item.rol_itemId==5)&&$type==="update"}
        <div class="form-group m-form__group row">           
                           
                <div class="col-lg-6">
                    <label>Empresa: </label>
                    <div class="m-input-icon m-input-icon--right">
                        <input type="text" readonly class="form-control m-input" placeholder="Ingrese el nombre del usuario" name="" name="" value="{$cataobj["Empresa"][$item.empresa_itemId]|escape:"html"}"
                               data-msg="Campo requerido" required minlength="5">
                        <span class="m-input-icon__icon m-input-icon__icon--right"><span><i class="la la-pencil-square-o"></i></span></span>
                    </div>
                </div>        
        </div>{/if}
        {if ($item.rol_itemId==2||$item.rol_itemId==3)&&$type==="update"}
        <div class="form-group m-form__group row">            
                <div class="col-lg-6">
                    <label>Municipio: </label>
                    <div class="m-input-icon m-input-icon--right">
                        <input type="text" readonly class="form-control m-input" placeholder="Ingrese el nombre del usuario" name="" value="{$cataobj["Municipio"][$item.municipio_itemId]|escape:"html"}"
                               data-msg="Campo requerido" required minlength="5">
                        <span class="m-input-icon__icon m-input-icon__icon--right"><span><i class="la la-pencil-square-o"></i></span></span>
                    </div>
                </div>          
                <div class="col-lg-6">
                    <label>Regional: </label>
                    <div class="m-input-icon m-input-icon--right">
                        <input type="text"  readonly class="form-control m-input" placeholder="Ingrese el nombre del usuario" name="" name="" value="{$cataobj["TCO"][$item.tco_itemId]|escape:"html"}"
                               data-msg="Campo requerido" required minlength="5">
                        <span class="m-input-icon__icon m-input-icon__icon--right"><span><i class="la la-pencil-square-o"></i></span></span>
                    </div>
                </div>
        </div>{/if}
            <div class="form-group m-form__group row">                
                <div class="col-lg-6">
                    <label>Usuario (inicio de sesión):</label>
                    <div class="m-input-icon m-input-icon--right">
                        <input type="text" id="usuario" class="form-control m-input" placeholder="Ingrese el nombre del usuario" name="item[usuario]" name="" value="{$item.usuario|escape:"html"}"
                               data-msg="Campo requerido" required minlength="5">
                        <span class="m-input-icon__icon m-input-icon__icon--right"><span><i class="la la-pencil-square-o"></i></span></span>
                    </div>
                </div>
                {if $type!=="update"}
                <div class="col-lg-6">
                    <label>Rol:</label>
                    <div class="m-input-icon m-input-icon--right">
                        <select id="rol_itemId" class="form-control m-select2 select2_general" name="item[rol_itemId]" id="rol_itemId"
                                data-placeholder="Elija un servidor" {$privFace.input} data-msg="Campo requerido" required>
                            <option></option>
                            {html_options options=$cataobj["Rol"] selected=$item.rol_itemId}
                        </select>
                    </div>
                </div>  
                {else}
                <div class="col-lg-6">
                    <label>Rol: </label>
                    <div class="m-input-icon m-input-icon--right">
                        <input type="text"  readonly class="form-control m-input" placeholder="Ingrese el nombre del usuario" name="" name="" value="{$cataobj["Rol"][$item.rol_itemId]|escape:"html"}"
                               data-msg="Campo requerido" required minlength="5">
                        <span class="m-input-icon__icon m-input-icon__icon--right"><span><i class="la la-pencil-square-o"></i></span></span>
                    </div>
                </div>
                {/if}
            </div>
            <div class="form-group m-form__group row">                
                <div class="col-lg-6">
                    <label>Nombre(s):{$hola}</label>
                    <div class="m-input-icon m-input-icon--right">
                        <input id="nombre" type="text" class="form-control m-input" placeholder="Ingrese el nombre del usuario" name="item[nombre]" name="" value="{$item.nombre|escape:"html"}"
                               data-msg="Campo requerido" required minlength="2">
                        <span class="m-input-icon__icon m-input-icon__icon--right"><span><i class="la la-pencil-square-o"></i></span></span>
                    </div>
                </div>
                <div class="col-lg-6">
                    <label>Apellidos:</label>
                    <div class="m-input-icon m-input-icon--right">
                        <input id="apellido" type="text" class="form-control m-input" placeholder="Ingrese el apellido del usuario" name="item[apellido]" name="" value="{$item.apellido|escape:"html"}"
                               data-msg="Campo requerido" required minlength="2">
                        <span class="m-input-icon__icon m-input-icon__icon--right"><span><i class="la la-pencil-square-o"></i></span></span>
                    </div>
                </div>
            </div>
            
            <div class="form-group m-form__group row">                
                <div class="col-lg-6">
                    <label>Número de CI:</label>
                    <div class="m-input-icon m-input-icon--right">
                        <input id="ci" type="text" class="form-control m-input" placeholder="Ingrese el nombre del usuario" name="item[ci]" name="" value="{$item.ci|escape:"html"}"
                               data-msg="Campo requerido" required minlength="5">
                        <span class="m-input-icon__icon m-input-icon__icon--right"><span><i class="la la-pencil-square-o"></i></span></span>
                    </div>
                </div>
                <div class="col-lg-6">
                    <label>Expedición de CI: </label>
                    <div  class="m-input-icon m-input-icon--right">
                        <select id="ci_exp_itemId" class="form-control m-select2 select2_general" name="item[ci_exp_itemId]" id="ci_exp_itemId"
                                data-placeholder="Elija un servidor" {$privFace.input} data-msg="Campo requerido" required>
                            <option></option>
                            {html_options options=$cataobj["CI_exp"] selected=$item.ci_exp_itemId}
                        </select>
                    </div>
                </div>
            </div>
            <div class="form-group m-form__group row">
                <div class="col-lg-6">
                    <label>Correo electrónico:</label>
                    <div class="m-input-icon m-input-icon--right">
                        <input id="email" type="text" class="form-control m-input" placeholder="Ingrese el correo del usuario" name="item[email]" name="" value="{$item.email|escape:"html"}"
                               data-msg="Campo requerido" required minlength="10">
                        <span class="m-input-icon__icon m-input-icon__icon--right"><span><i class="la la-pencil-square-o"></i></span></span>
                    </div>
                </div>
		<div class="col-lg-6">
                    <label>Número celular o teléfono de contacto:</label>
                    <div class="m-input-icon m-input-icon--right">
                        <input id="telefono" type="text" class="form-control m-input" placeholder="Ingrese el telefono o celular" name="item[telefono]" name="" value="{$item.telefono|escape:"html"}"
                               data-msg="Campo requerido" required minlength="8">
                        <span class="m-input-icon__icon m-input-icon__icon--right"><span><i class="la la-pencil-square-o"></i></span></span>
                    </div>
                </div>
            </div>
            <div class="form-group m-form__group row">
                <div class="col-lg-8">
                    <label>Contraseña:</label>
                    <div class="m-input-icon m-input-icon--right">
                        <input id="password"type="text" class="form-control m-input" placeholder="Ingrese la contraseña del  usuario" name="item[password]" name="" value="{$item.password|escape:"html"}"
                               data-msg="Campo requerido" required minlength="6" id="password">
                        <span class="m-input-icon__icon m-input-icon__icon--right"><span><i class="la la-pencil-square-o"></i></span></span>
                    </div>
                </div>
            </div>
            <div class="form-group m-form__group row">
                {if $type=="new"}      
                <div class="col-lg-6">
                    <label>Archivo de Verificación (PDF): </label>
                    <div class="custom-file">
                        <input type="file" class="form-control m-input custom-file-input "
                            placeholder="Ingrese el archivo"
                            name="input_archivo"
                            id="input_archivo"
                            accept="application/pdf"
                                {if $type == 'new'}
                                    minlength="2"
                                    data-msg="Campo requerido" required
                                {/if}
                            name="" value="{$item.descripcion|escape:"html"}">
                        <label class="custom-file-label" for="input_archivo">Seleccione un archivo</label>
                    </div>
                    
                </div> 
                {else}    
                <div class="col-lg-6">
                
                    
                    <label>Archivo de Verificación: </label>
                        
                    <div class="custom-file">
                        <input type="file" class="form-control m-input custom-file-input "
                            placeholder="Cambiar"
                            name="input_archivo"
                            id="input_archivo"
                            accept="application/pdf"
                                {if $type == 'new'}
                                    minlength="2"
                                    data-msg="Campo requerido" required
                                {/if}
                            name="" value="{$item.descripcion|escape:"html"}">
                        <label class="custom-file-label" for="input_archivo">{$item.path_doc_ver}</label>
                    </div>
                    </br></br>
                    <button type="reset" class="btn btn-info" id="descargar_archivo">Descargar Archivo</button>
                    
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