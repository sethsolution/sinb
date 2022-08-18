{include file="index.css.tpl"}
<div class="card card-custom">
    <div class="card-header py-3">
        <div class="card-title">
            <span class="card-icon"><i class="flaticon2-next text-dark-25"></i></span>
            <h3 class="card-label text-dark-50">{#title#}</h3>
        </div>
        <div class="card-toolbar">
            {if $privFace.edit == 1 and $privFace.add == 1}
                <a href="#" class="btn btn-success font-weight-bolder" id="btn_update" rel="new">
                    <span><i class="fa fa-plus"></i><span> {#btnNew#}</a>
            {/if}
        </div>
    </div>

    <div class="card-body">
        {include file="index.search.tpl"}
        <!--begin: Datatable-->
        <table class="table {*table-separate*} table-head-custom table-bordered table-hover
            table-checkable d-none table-sm {*table-striped*}" id="index_list">
            <thead class="thead-dark thead-color"><tr>
                {foreach from=$gridItem item=row key=idx}
                    <th>{$row.label|escape:"html"}</th>
                {/foreach}
            </tr></thead>
            <tbody></tbody>
        </table>
        <!--end: Datatable-->
    </div>

</div>
