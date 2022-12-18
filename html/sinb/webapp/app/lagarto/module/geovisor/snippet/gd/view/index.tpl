<div class="card card-custom">
    <!--begin: Lista de Datos-->
    <div class="card-body p-2">

        <!--begin: Datatable-->
        <table class="table {*table-separate table-striped*}  table-bordered table-hover table-head-custom table-checkable d-none table-sm  "
               id="tabla_{$subcontrol}" >
            <thead class="thead-dark thead-color">
            <tr>
                {foreach from=$gridItem item=row key=idx}
                    <th>{$row.label|escape:"html"}</th>
                {/foreach}
            </tr>
            </thead>
            <tbody></tbody>
            <tfoot></tfoot>
        </table>
        <!--end: Datatable-->
    </div>
    <!--end: Lista de Datos-->

</div>
<!--end::Modal-->
{include file="index.js.tpl"}