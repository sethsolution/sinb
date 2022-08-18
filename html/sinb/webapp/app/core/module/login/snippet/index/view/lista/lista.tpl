{include file="lista/lista.css.tpl"}
<div class="m-portlet m-portlet--mobile">
    {include file="lista/lista_titulo.tpl"}
    <div class="m-portlet__body">
        <!--begin: Search Form -->
        {include file="lista/lista_busqueda.tpl"}
        <!--begin: Datatable -->
        <table class="table table-striped table-bordered table-hover table-checkable table-sm m-table m-table--head-bg-brand {*display responsive nowrap*}  m--hide" id="index_list">
            <thead>
            <tr>
                {foreach from=$gridItem item=row key=idx}
                    <th >{$row.label|escape:"html"}</th>
                {/foreach}
            </tr>
            </thead>
        </table>
    </div>
</div>

<!--begin::Modal-->
<div class="modal fade" id="form_modal_reporte" tabindex="-1" role="dialog"
     data-backdrop="static"
     data-keyboard="false"
     aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content" id="modal-content_{$subcontrol}">

            <div class="modal-body">
                <div class="m-alert m-alert--outline alert alert-success alert-dismissible fade show" role="alert">
                    <strong>Descarga</strong> - Preparando la descarga del archivo
                    <div class="m-loader m-loader--success"></div>
                </div>
            </div>

        </div>
    </div>
</div>
<!--end::Modal-->