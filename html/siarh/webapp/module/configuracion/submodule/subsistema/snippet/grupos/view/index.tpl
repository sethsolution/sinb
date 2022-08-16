{include file="index.js.tpl"}
{include file="index.btn_registro.js.tpl"}
{include file="index.css.tpl"}

    {include file="index.titulo.tpl"}

<div class="m-portlet__body">
    <!--begin: Search Form -->
    {include file="index.busqueda.tpl"}
    <!--begin: Datatable -->
        <table class="table table-striped table-bordered table-hover table-checkable table-sm m-table m-table--head-bg-success m--hide" id="tabla_{$subcontrol}">
            <thead>
            <tr>
                {foreach from=$grill_list item=row key=idx}
                    <th>{$row.label|escape:"html"}</th>
                {/foreach}
            </tr>
            </thead>
            <tfoot>

            </tfoot>
        </table>
    </div>


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