
{include file="tab01/list.css.tpl"}
<div id="content_table" style="">

<table width="100%" border="0" cellspacing="0" cellpadding="2" id="item_table" style="font-size:10px;"
 class="display cell-border hover order-column stripe">
    <thead>
    <tr><th>#</th>
        <th>Acci&oacute;n</th>

        {assign var=numcols value=0}
        {foreach from=$listConfig item=row key=idx}        
          <td >{$row.descripcion|escape:"htmlall"}</td>
        {/foreach}
        </tr>
    </thead>
    <tbody></tbody>
</table>
</div>

{include file="tab01/list.js.tpl"}