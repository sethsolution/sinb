<div class="card card-custom">
    <!--begin:Titulo-->

    <div class="card-body pt-0 pb-0 pl-5 pr-5">
        <div class="alert alert-custom fade show pt-1 pb-1 pl-5 pr-5 ayuda" role="alert">
            <div class="alert-icon"><i class="flaticon-notes"></i></div>
            <div class="alert-text text-justify text-dark-65" >
                {#message#}
            </div>

        </div>
    </div>

    <div class="card-header py-3">
        <div class="card-title">
            <span class="card-icon"><i class="flaticon2-next text-dark-25"></i></span>
            <h3 class="card-label text-dark-50">{#title#}</h3>
        </div>
        <div class="card-toolbar">
            {if $privFace.edit == 1 and $privFace.add == 1}
                <a href="#" class="btn btn-success font-weight-bolder" id="btn_form_{$subcontrol}" rel="new">
                    <span><i class="fa fa-plus"></i><span> {#btnNew#}</a>
            {/if}
        </div>
    </div>
    <!--end:Titulo-->
    <!--begin: Lista de Datos-->
    <div class="card-body">
        {*include file="index.search.tpl"*}
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
<!--begin::Modal-->
<div class="modal fade" id="form_modal_{$subcontrol}"
     data-backdrop="static" tabindex="-1" role="dialog"
     aria-labelledby="staticBackdrop" aria-hidden="true"
     >
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content modal-lg" id="modal-content_{$subcontrol}">
        </div>
    </div>
</div>
<!--end::Modal-->
{include file="index.js.tpl"}