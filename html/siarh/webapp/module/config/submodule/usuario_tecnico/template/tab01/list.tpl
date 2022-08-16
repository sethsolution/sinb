{include file="tab01/list.css.tpl"}
<table style="width:100%;padding:0px;border-spacing: 0px;padding:0px;" id="item_table"
class="display cell-border hover order-column stripe">
<thead>
<tr>
    <th>#</th>
    <th>Acci&oacute;n</th>
    {assign var=numcols value=0}
    {foreach from=$listConfig item=row key=idx}        
    <th>{$row.descripcion|escape:"htmlall"}</th>
    {/foreach}
</tr>
</thead>
<tbody></tbody>
</table>
{include file="tab01/list.js.tpl"}