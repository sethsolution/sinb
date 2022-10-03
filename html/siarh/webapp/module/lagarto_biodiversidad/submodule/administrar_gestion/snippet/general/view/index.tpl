<!--begin::Portlet-->
<div class="m-portlet">
    <!--begin::Form-->
    <form class="m-form m-form--fit m-form--label-align-right m-form--group-seperator-dashed" method="POST" action="{$getModule}"  id="general_form">

        <div class="m-portlet__head">
            <div class="m-portlet__head-caption">
                <div class="m-portlet__head-title">
                    <h3 class="m-portlet__head-text gest">{if $type=="update"}Gestion: {$item.itemId}{else}Gestion: {date("Y")}{/if}</h3>
                </div>
            </div>

        </div>

        <div class="m-portlet__body">   
                       
                     
            {if false}               
            <div class="form-group m-form__group row">       
                <div class="col-lg-6">
                    <label class="rueda">Inicio Rueda de Negocios: </label>
                    <div class="input-group date" >
                        <input type="text" class="form-control m-input fecha_general"   placeholder="Seleccione la fecha del evento"  name="item[ini_rueda_negocios]"
                               value="{$item.ini_rueda_negocios|date_format:"%d/%m/%Y"}" data-msg="Campo requerido"/>
                        <div class="input-group-append">
    							<span class="input-group-text">
    							<i class="flaticon-calendar-1"></i>
    							</span>
                        </div>
                    </div>
                </div>              
                <div class="col-lg-6">
                    <label class="rueda">Fin Rueda de Negocios: </label>
                    
                    <div class="input-group date" >
                        <input type="text" class="form-control m-input fecha_general"   placeholder="Seleccione la fecha del evento"  name="item[fin_rueda_negocios]"
                               value="{$item.fin_rueda_negocios|date_format:"%d/%m/%Y"}" data-msg="Campo requerido"/>
                        <div class="input-group-append">
    							<span class="input-group-text">
    							<i class="flaticon-calendar-1"></i>
    							</span>
                        </div>
                    </div>
                </div>
            </div>{/if}
            <div class="form-group m-form__group row">               
                           
                <div class="col-lg-6">
                    <label class="caza">Inicio Caza: </label>
                    
                    <div class="input-group date" >
                        <input type="text" class="form-control m-input fecha_general"   placeholder="Seleccione la fecha del evento"  name="item[ini_caza]"
                               value="{$item.ini_caza|date_format:"%d/%m/%Y"}" data-msg="Campo requerido"/>
                        <div class="input-group-append">
    							<span class="input-group-text">
    							<i class="flaticon-calendar-1"></i>
    							</span>
                        </div>
                    </div>
                </div>              
                <div class="col-lg-6">
                    <label class="caza">Fin Caza: </label>
                    
                    <div class="input-group date" >
                        <input type="text" class="form-control m-input fecha_general"   placeholder="Seleccione la fecha del evento"  name="item[fin_caza]"
                               value="{$item.fin_caza|date_format:"%d/%m/%Y"}" data-msg="Campo requerido"/>
                        <div class="input-group-append">
    							<span class="input-group-text">
    							<i class="flaticon-calendar-1"></i>
    							</span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="form-group m-form__group row">               
                           
                <div class="col-lg-6">
                    <label class="movi">Inicio Movilización: </label>
                    
                    <div class="input-group date" >
                        <input type="text" class="form-control m-input fecha_general"   placeholder="Seleccione la fecha del evento"  name="item[ini_movilizacion]"
                               value="{$item.ini_movilizacion|date_format:"%d/%m/%Y"}" data-msg="Campo requerido"/>
                        <div class="input-group-append">
    							<span class="input-group-text">
    							<i class="flaticon-calendar-1"></i>
    							</span>
                        </div>
                    </div>
                </div>              
                <div class="col-lg-6">
                    <label class="movi">Fin Movilización: </label>
                    
                    <div class="input-group date" >
                        <input type="text" class="form-control m-input fecha_general"   placeholder="Seleccione la fecha del evento"  name="item[fin_movilizacion]"
                               value="{$item.fin_movilizacion|date_format:"%d/%m/%Y"}" data-msg="Campo requerido"/>
                        <div class="input-group-append">
    							<span class="input-group-text">
    							<i class="flaticon-calendar-1"></i>
    							</span>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="form-group m-form__group row"> 
                {if $type=="new"}      
                <div class="col-lg-6">
                    <label>Archivo de Resolución (PDF): </label>
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
                
                    
                    <label>Archivo de Resolución: </label>
                        
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
                        <label class="custom-file-label" for="input_archivo">{$item.resolucion_path}</label>
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
                        <button type="reset" class="btn btn-primary" id="general_submit">Guardar Cambios</button>
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