{include file="lista/lista.css.tpl"}
<div class="m-portlet m-portlet--mobile">
    {include file="lista/lista_titulo.tpl"}
    <div class="m-portlet__body">
        <!--begin: Search Form -->
        {include file="lista/lista_busqueda.tpl"}
        <!--begin: Datatable -->
        <table class="table table-striped table-bordered table-hover table-checkable table-sm m-table m-table--head-bg-brand m--hide" id="index_lista">
            <thead>
            <tr>
                {foreach from=$grill_list item=row key=idx}
                    <th>{$row.label|escape:"html"}</th>
                {/foreach}
            </tr>
            </thead>
            <!-- <tfoot>
            <tr>
                {foreach from=$grill_list item=row key=idx}
                    <th >{$row.label|escape:"html"}</th>
                {/foreach}
            </tr>
            </tfoot> -->
        </table>
    </div>
</div>

<!--begin::Modal-->
<div class="modal fade" id="modalWindow" tabindex="-1" role="dialog"
     data-backdrop="static"
     data-keyboard="false"
     aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content" id="modalContent"></div>
    </div>
</div>
<!--end::Modal-->
{include file="lista/lista.js.tpl"}
