<!--begin::Modal-->
<div class="modal fade" id="form_modal_{$subcontrol}" tabindex="-1" role="dialog"
     data-backdrop="static"
     data-keyboard="true"
     aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xlg" role="document">
        <div class="modal-content" id="modal-content_{$subcontrol}">
        </div>
    </div>
</div>
<!--end::Modal-->

{include file="index.css.tpl"}
{if $item_padre.estado_id == 1 or  $item_padre.estado_id == 3}
    {include file="index.titulo.tpl"}
{/if}

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
            <tfoot></tfoot>
        </table>

    </div>
</div>

{if $item_padre.estado_id ==1 or $item_padre.estado_id ==3}
    <div class="alert alert-primary alert-dismissible fade show   m-alert m-alert--air m-alert--outline" role="alert">
        <i class="m-nav__link-icon flaticon-chat-1"></i>
        <strong>NOTA: </strong>
        <span class="m-nav__link-title">
            <span class="m-nav__link-wrap">
                <span class="m-nav__link-text">Si ya completo todos los requisitos, debe enviar su solicitud.</span>
                <span class="m-nav__link-badge">
                    <span class="m-badge m-badge--danger m-badge--wide m-badge--rounded">NOTA</span>
                </span>
            </span>
        </span>
    </div>

{/if}

{include file="index.js.tpl"}
