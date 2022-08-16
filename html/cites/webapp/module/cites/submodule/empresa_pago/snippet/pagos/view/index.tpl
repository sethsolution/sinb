<!--begin::Modal-->
<div class="modal fade" id="form_modal_{$subcontrol}" tabindex="-1" role="dialog"
     data-backdrop="static"
     data-keyboard="false"
     aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content" id="modal-content_{$subcontrol}">
        </div>
    </div>
</div>
<!--end::Modal-->

{include file="index.css.tpl"}

<div class="m-portlet__head">
    <div class="m-portlet__head-caption"><div class="m-portlet__head-title"><h7></h7></div></div>
    <div class="m-portlet__head-tools">
        {if $item_padre.estado_id == 1 or  $item_padre.estado_id == 3}
            <ul class="m-portlet__nav">
                <li class="m-portlet__nav-item">
                    {if $privFace.editar == 1 and $privFace.crear == 1}
                        <a href="#" class="btn btn-focus m-btn m-btn--custom m-btn--bolder m-btn--icon" id="btn_form_{$subcontrol}" rel="new">
                            <span><i class="fa fa-plus"></i><span>Nuevo Registro de Depósito</span></span>
                        </a>
                    {/if}
                </li>
                <li class="m-portlet__nav-item"></li>
            </ul>
        {/if}
    </div>
</div>


<div class="m-portlet m--padding-bottom-5" >

    <div class="alert m-alert m-alert--default" role="alert" style="text-align: justify">

        El costo de la inscripción en la Oficina Administrativa CITES es de <strong>Bs. 150 (anual)</strong>,
        excepto para Usuarios ocasionales que estara sujeto a evaluacion. El Depósito debe realizarse
        en el Banco Union, Cuenta N° <strong>1-3517288 MMAYA-CITES</strong> y tendra una validez de <strong>90 días</strong> calendario.
    </div>

    <div class="m-portlet__head-caption">
        <div class="m-portlet__head-title">
            <h4 class="m--font-primary"> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Verificación del registro </h4>
        </div>
    </div>

    <div class="m-portlet__body m--padding-bottom-5 m--padding-top-5 m--padding-left-5 m--padding-right-5">
        <table class="table table-striped table-bordered table-hover table-checkable table-sm m-table m-table--head-bg-success m--hide" id="tabla_{$subcontrol}">
            <thead>
            <tr>
                {foreach from=$grill_list item=row key=idx}
                    <th>{$row.label|escape:"html"}</th>
                {/foreach}
            </tr>
            </thead>
            <tfoot></tfoot>
        </table>

    </div>
</div>

{if $item_padre.estado_id ==1 or $item_padre.estado_id ==3}
    <div class="alert alert-primary alert-dismissible fade show   m-alert m-alert--air m-alert--outline" role="alert">
                <span class="m-nav__link-badge">
                    <span class="m-badge m-badge--danger m-badge--wide m-badge--rounded">NOTA</span>
                </span>
        <span class="m-nav__link-title">
            <span class="m-nav__link-wrap">
                <span class="m-nav__link-text">Debe continuar con el registro de los datos en el menú lateral <strong>"REGISTRO DE USUARIO"</strong>.</span>
                <i class="m-nav__link-icon flaticon-chat-1"></i>
            </span>
        </span>
    </div>
{/if}

{include file="index.js.tpl"}
