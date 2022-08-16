
<!--begin::Modal-->
<div class="modal fade" id="form_modal_{$subcontrol}" tabindex="-1" role="dialog"
     data-backdrop="static"
     data-keyboard="false"
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
        <tfoot></tfoot>
    </table>
    </div>
</div>
{include file="index.js.tpl"}
