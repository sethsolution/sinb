<!--begin::Portlet-->
<div class="m-portlet">
    <!--begin::Form-->
    <form class="m-form m-form--fit m-form--label-align-right m-form--group-seperator-dashed" method="POST" action="{$getModule}"  id="general_form">

        <div class="m-portlet__head">
            <div class="m-portlet__head-caption">
                <div class="m-portlet__head-title">
                    <h3 class="m-portlet__head-text"> Datos de Menú</h3>
                </div>
            </div>

            <div class="m-portlet__head-tools">
                <ul class="m-portlet__nav">
                    <li class="m-portlet__nav-item">
                        <span class="m-switch m-switch--lg m-switch--icon" style="padding: 0px; margin: 0px;">
                            <label style="margin: 0px;"><input type="checkbox" {if $item.activo == 1}checked="checked"{/if} name="item[activo]" value="1" /><span style="margin: 0px;"></span></label>
                        </span>
                    </li>
                </ul>
            </div>
        </div>

        <div class="m-portlet__body">

            <div class="form-group m-form__group row">
                <div class="col-lg-12">
                    <label>Grupo</label>
                    <div class="m-input-icon m-input-icon--right">
                        <select class="form-control m-select2 select2_general" name="item[categoria_id]"  style="width: 100%;"
                                data-placeholder="Elija la Direccion" data-msg="Campo requerido">
                            <option></option>
                            {html_options options=$cataobj.grupo selected=$item.categoria_id}
                        </select>
                    </div>
                </div>
            </div>


            <div class="form-group m-form__group row">
                <div class="col-lg-6">
                    <label>Nombre</label>
                    <input type="text" class="form-control m-input" placeholder="Ingrese el nombre de la categoria" name="item[nombre]"
                           value="{$item.nombre|escape:"html"}" data-msg="Campo requerido" required>
                </div>
                <div class="col-lg-6">
                    <label>Icono</label>
                    <input type="text" class="form-control m-input" placeholder="Ingrese la class" name="item[class]"
                           value="{$item.class|escape:"html"}" data-msg="Campo requerido">
                </div>
            </div>
            <div class="form-group m-form__group row">
                <div class="col-lg-4">
                    <label>Categoría tipo: </label>
                    <div class="input-group" >
                        <select class="form-control m-input" name="item[tipo]" id="categoria_select" data-placeholder="Elija un Genero">
                            {html_options options=$cataobj.tipo selected=$item.tipo}
                        </select>
                    </div>
                </div>
                <div class="col-lg-4">
                    <label>Orden</label>
                    <input type="text" class="form-control m-input numero_entero" placeholder="Ingrese el orden" name="item[orden]"
                           value="{$item.orden|escape:"html"}"  minlength="1" maxlength="2" >
                </div>
                <div class="col-lg-4">
                    <label for="recipient-name" class="form-control-label">Abrir en nueva ventada:</label>
                    <div class="col-lg-9">
                        <span class="m-switch m--succes">
                            <label><input type="checkbox" {if $item.target == 1}checked="checked"{/if} name="item[target]" value="1"  id="target"/><span></span></label>
                        </span>
                    </div>
                </div>

            </div>
            <div class="form-group m-form__group row {if $item.tipo != 'SB'}m--hide{/if}" id="submodulo_div">
                <div class="col-lg-12">
                    <label>Submodulo de Subsistema</label>
                    <div class="m-input-icon m-input-icon--right">
                        <select class="form-control m-select2 select2_general" name="item[submodulo_id]" id="submodulo" style="width: 100%;"
                                data-placeholder="Elija la Direccion" {$privFace.input} data-msg="Campo requerido"
                        >
                            <option></option>
                            {html_options options=$cataobj.items selected=$item.submodulo_id}
                        </select>
                    </div>
                </div>
            </div>
            <div class="form-group m-form__group row {if $item.tipo != 'INDEX' && $type != 'new' }m--hide{/if}" id="modulo_div">
                <div class="col-lg-12">
                    <label>Subsistema</label>
                    <div class="m-input-icon m-input-icon--right">
                        <select class="form-control m-select2 select2_general" name="item[modulo_id]" id="modulo" style="width: 100%;"
                                data-placeholder="Elija la Direccion" {$privFace.input} data-msg="Campo requerido"
                        >
                            <option></option>
                            {html_options options=$cataobj.modulo selected=$item.modulo_id}
                        </select>
                    </div>
                </div>
            </div>
            <div class="form-group m-form__group row {if $item.tipo != 'URL'}m--hide{/if}" id="url_div">
                <div class="col-lg-12">
                    <label>Url</label>
                    <input type="text" class="form-control m-input" placeholder="Ingrese la url" name="item[url]"
                           value="{$item.url|escape:"html"}" data-msg="Campo requerido"
                    >
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