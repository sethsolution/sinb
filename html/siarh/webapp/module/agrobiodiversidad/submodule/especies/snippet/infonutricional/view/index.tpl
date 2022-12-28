{include file="index.css.tpl"}
<!--begin::Portlet-->
<div class="m-portlet">
    <!--begin::Form-->
    <form class="m-form m-form--state m-form--fit m-form--label-align-right" method="POST" action="{$getModule}" id="general_form" autocomplete="off">
        <!-- <div class="m-portlet__head">
            <div class="m-portlet__head-caption">
                <div class="m-portlet__head-title">
                    <h3 class="m-portlet__head-text">Datos del muestreo</h3>
                </div>
            </div>
        </div> -->
    </form>
    <!--end::Form-->

    <!--begin::Table-->
    <div class="m-portlet__body">
        <ul class="nav nav-tabs" id="myTab" role="tablist">
            <li class="nav-item">
                <a class="nav-link active" id="tabFisicoQuimico" data-toggle="tab" href="#fisicoquimico">
                    <span class="nav-icon">
                        <i class="fa fa-flask"></i>
                    </span>
                    <span class="nav-text">Análisis físico químico</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="tabNutricional" data-toggle="tab" href="#nutricional" aria-controls="profile">
                    <span class="nav-icon">
                        <i class="fa fa-child"></i>
                    </span>
                    <span class="nav-text">Análisis nutricional</span>
                </a>
            </li>
        </ul>

        <div class="tab-content mt-5" id="myTabContent">
            <div class="tab-pane fade active show" id="fisicoquimico" role="tabpanel" aria-labelledby="fisicoquimico">
            {foreach from=$listaCompuestos item=row key=idx}
                {if $row.grpanalisis_itemid eq 1}
                <div class="form-group row">
                    <label class="col-lg-3 col-form-label" style="background-color: #fafafa;"><strong>{$row.nombre}</strong>&nbsp;[{$row.medida}]</label>
                    <div class="col-lg-3">
                        <div class="input-group">
                            <select class="form-control select2" name="" id="cboTipoValorCompuesto_{$row.comp_itemid}" data-value="{$row.tipovalor_itemid}">
                                <option value="">--Seleccione una opción--</option>
                                {foreach from=$listaTiposValorCompuesto item=rowTipoValor key=idxTipoValor}
                                <option value="{$rowTipoValor.itemId}" {if $rowTipoValor.itemId eq $row.tipovalor_itemid}selected{/if}>{$rowTipoValor.nombre}</option>
                                {{/foreach}}
                            </select>
                        </div>
                    </div>
                    <div class="col-lg-3" id="rowItemid">
                        <div class="input-group">
                            <input type="hidden" name="id[]" value="{$row.itemId}">
                            <input type="number" class="form-control" name="valor[]" id="txtValor_{$row.comp_itemid}" value="{$row.valor}" min="0" data-itemid="{$row.itemId}" data-compuesto-itemid="{$row.comp_itemid}" data-value="{$row.valor}" placeholder="Ingrese {$row.nombre}">
                            <div class="select-group-append">
                                <button class="btn btn-success" type="button" name="btnGuardar[]" data-compuesto-id="{$row.comp_itemid}" title="Guardar"><span class="fa fa-check"></span></button>
                            </div>
                        </div>
                    </div>
                    
                </div>
                {/if}
            {/foreach}
            </div>
            <div class="tab-pane fade" id="nutricional" role="tabpanel" aria-labelledby="nutricional">
            {foreach from=$listaCompuestos item=row key=idx}
                {if $row.grpanalisis_itemid eq 2}
                <div class="form-group row">
                    <label class="col-lg-3 col-form-label" style="background-color: #fafafa;"><strong>{$row.nombre}</strong>&nbsp;[{$row.medida}]</label>
                    <div class="col-lg-3">
                        <div class="input-group">
                            <select class="form-control select2" name="" id="cboTipoValorCompuesto_{$row.comp_itemid}" data-value="{$row.tipovalor_itemid}">
                                <option value="">--Seleccione una opción--</option>
                                {foreach from=$listaTiposValorCompuesto item=rowTipoValor key=idxTipoValor}
                                <option value="{$rowTipoValor.itemId}" {if $rowTipoValor.itemId eq $row.tipovalor_itemid}selected{/if}>{$rowTipoValor.nombre}</option>
                                {{/foreach}}
                            </select>
                        </div>
                    </div>
                    <div class="col-lg-3">
                        <div class="input-group">
                            <input type="number" class="form-control" name="valor[]" id="txtValor_{$row.comp_itemid}" value="{$row.valor}" min="0" data-itemid="{$row.itemId}" data-compuesto-itemid="{$row.comp_itemid}" data-value="{$row.valor}" placeholder="Ingrese {$row.nombre}">
                            <div class="input-group-append">
                                <button class="btn btn-success" type="button" name="btnGuardar[]" data-compuesto-id="{$row.comp_itemid}" title="Guardar"><span class="fa fa-check"></span></button>
                            </div>
                        </div>
                    </div>
                </div>
                {/if}
            {/foreach}
            </div>
        </div>

    </div>
    <!--end::Table-->


</div>
<!--end::Portlet-->
{include file="index.js.tpl"}