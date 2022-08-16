
<!--begin::Modal-->
<div class="modal fade" id="form_modal_{$subcontrol}" tabindex="-1" role="dialog"
     data-backdrop="static"
     data-keyboard="true"
     aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content" id="modal-content_{$subcontrol}"></div>
    </div>
</div>
<!--end::Modal-->

{include file="index.css.tpl"}


<div class="m-portlet m--padding-bottom-5" >
    <div class="m-portlet__body m--padding-bottom-5 m--padding-top-5">

    <table class="table table-striped table-bordered table-hover table-checkable table-sm m-table m-table--head-bg-success m--hide" id="tabla_{$subcontrol}">
        <thead>
        <tr>
            {foreach from=$grill_list item=row key=idx}
                <th>{$row.label|escape:"html"}</th>
            {/foreach}
        </tr>
        </thead>
        <tfoot>
        <tr>
            <th> TOTALES</th>
            <th></th>
            <th></th>
            <th></th>
            <th></th>
            <th></th>
            <th></th>
        </tr>
        </tfoot>
    </table>
    </div>
</div>
{include file="form.tpl"}
{*
{if $item_padre.estado_id ==1 or $item_padre.estado_id ==3}
<div class="m-portlet__body ">
    <div class="m-form__actions m-form__actions--solid m-form__actions--left">
        <button type="reset" class="btn btn-success" id="general_submit">
            <span>&nbsp;Continuar con el registro de cortes&nbsp;&nbsp;<i class="fa fa-angle-double-right"></i>&nbsp; </span>
        </button>
    </div>
</div>
{/if}*}

{if $item_padre.estado_id ==1 or $item_padre.estado_id ==3}
    <div class="alert alert-primary alert-dismissible fade show   m-alert m-alert--air m-alert--outline" role="alert">
        <span class="m-nav__link-badge">
            <span class="m-badge m-badge--danger m-badge--wide m-badge--rounded">NOTA</span>
        </span>
        <span class="m-nav__link-title">
            <span class="m-nav__link-wrap">
                <span class="m-nav__link-text">Debe continuar con el registro Cuadro II: Conteo y peso de los cortes, en la opción <strong> "CORTES"</strong> de la parte superior.</span>
                <i class="m-nav__link-icon flaticon-chat-1"></i>
            </span>
        </span>
    </div>
{/if}
{include file="index.js.tpl"}
