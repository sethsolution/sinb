{include file="lista/lista.css.tpl"}
<div class="m-portlet m-portlet--mobile">
    {include file="lista/lista_titulo.tpl"}
    <div class="m-portlet__body">
        {include file="lista/lista_busqueda.tpl"}
        <table class="table table-striped table-bordered table-hover table-checkable table-sm m-table m-table--head-bg-brand m--hide {* nowrap*}" id="index_lista">
            <thead>
            <tr>
                {foreach from=$grill_list item=row key=idx}
                    <th >{$row.label|escape:"html"}</th>
                {/foreach}
            </tr>
            </thead>
            <tfoot>

            </tfoot>
        </table>
    </div>
</div>