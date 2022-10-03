<!--begin::Portlet-->
<div class="m-portlet">
    <!--begin::Form-->
    <form class="m-form m-form--fit m-form--label-align-right m-form--group-seperator-dashed" method="POST" action="{$getModule}"  id="general_form">

        

        <div class="m-portlet__body" >
            <div class ="tabla">
                <div class="row title-low">
                    <div class="col-lg-2 col-md-3 col-sm-3 col-xs-3 title-low-green  col-6" >
                        <h6 class="m-portlet__head-text">Longitud (m)</h6>
                    </div>
                    <div class="col-lg-2 col-md-3 col-sm-3 col-xs-3  title-low-green  col-6">
                        <h6 class="m-portlet__head-text">Cantidad</h6>
                    </div>

                </div>
                {foreach from=$filas item=fila key=key name=name}
                </br>
                <div class="row title-low">
                    <div class=" col-md-3 col-lg-2 col-sm-3 col-6 text-blue">
                        <h6 class="m-portlet__head-text">{$fila.longitud_literal}</h6>
                    </div>
                    <div class=" col-md-3 col-lg-2 col-sm-3 col-6">
                        <div class="m-input-icon m-input-icon--right">
                            <input id="cantidad{$key+1}" {if $type=="update"}disabled{/if} type="number" class="form-control m-input" placeholder="Ingrese la cantidad"  name="" value="{$fila.cantidad|escape:"html"}"
                                data-msg="Campo requerido" required minlength="1">
                            <span class="m-input-icon__icon m-input-icon__icon--right"><span><i class="la la-pencil-square-o"></i></span></span>
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
                    <label style="color:#387ec9;">Total Disponible:</label>
                    <div class="m-input-icon m-input-icon--right">
                        <input  class="form-control m-input" style="background-color:#387ec9; color:white;" readonly placeholder="Cantidad de cueros disponibles" name="item[total_chalecos]"  value="{$item.total_chalecos|escape:"html"}"
                               data-msg="Campo requerido"  required minlength="1">
                    </div>
                </div>

                <div class="col-lg-6">
                    <label>Total Entregado:</label>
                    <div class="m-input-icon m-input-icon--right">
                        <input type="number" readonly {if $item.estado=="1"}disabled{/if} class="form-control m-input" placeholder="Cantidad de cueros entregados" name="item[entregado_chalecos]"  value="{$item.entregado_chalecos|escape:"html"}"
                               data-msg="Campo requerido" id="total_chalecos" required minlength="1">
                        <span class="m-input-icon__icon m-input-icon__icon--right"><span><i class="la la-pencil-square-o"></i></span></span>
                    </div>
                </div>



            </div>
            <div class="form-group m-form__group row">

                <div class="col-lg-6">
                    <label style="color:#387ec9;">Colas Disponibles:</label>
                    <div class="m-input-icon m-input-icon--right" >
                        <input type="number" style="background-color:#387ec9; color:white;" readonly class="form-control m-input" placeholder="Ingrese la cantidad" name="item[total_colas]" value="{$item.total_colas|escape:"html"}"
                               data-msg="Campo requerido" required minlength="1">
                    </div>
                </div>
                <div class="col-lg-6">
                    <label>Colas Entregadas:</label>
                    <div class="m-input-icon m-input-icon--right">
                        <input type="number" {if $item.estado=="1"||$type=="update"}disabled{/if} class="form-control m-input" placeholder="Ingrese la cantidad" name="item[entregado_colas]"  value="{$item.entregado_colas|escape:"html"}"
                               data-msg="Campo requerido" required minlength="1">
                        <span class="m-input-icon__icon m-input-icon__icon--right"><span><i class="la la-pencil-square-o"></i></span></span>
                    </div>
                </div>


            </div>
            <div class="form-group m-form__group row">


                <div class="col-lg-6">
                    <label>Comunidad:</label>
                    <div class="m-input-icon m-input-icon--right">
                        <input  {if $item.estado=="1"||$type=="update"}disabled{/if} class="form-control m-input" placeholder="Ingrese la comunidad" name="item[comunidad]" name="" value="{$item.comunidad|escape:"html"}"
                               data-msg="Campo requerido" required minlength="1">
                        <span class="m-input-icon__icon m-input-icon__icon--right"><span><i class="la la-pencil-square-o"></i></span></span>
                    </div>
                </div>

                <div class="col-lg-6">
                    <label>Empresa: </label>
                    <div class="m-input-icon m-input-icon--right">
                        <select {if $item.estado=="1"}disabled{/if} class="form-control m-select2 select2_general" name="item[responsable_curtiembre_itemId]" id="responsable_curtiembre_itemId"
                                data-placeholder="Elija un servidor" {$privFace.input} data-msg="Campo requerido" required>
                            <option {if $item.estado=="1"}disabled{/if} ></option>
                            {html_options options=$cataobj selected=$item.responsable_curtiembre_itemId}
                        </select>
                    </div>
                </div>



            </div>
	    <div class="form-group m-form__group row">


                <div class="col-lg-6">
                    <label>Numero de acta f&iacutesica:</label>
                    <div class="m-input-icon m-input-icon--right">
                        <input  class="form-control m-input" placeholder="Ingrese el numero de acta" name="item[id_acta_fisica]"  value="{$item.id_acta_fisica|escape:"html"}"
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
                        {if $item.estado!="1"}
                        <button type="reset"  class="btn btn-primary" id="general_submit">Guardar Cambios</button>
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