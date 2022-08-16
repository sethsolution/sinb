<table style="width:100%;padding:0px;border-spacing: 0px;">
<tr><td class="titulo2">&nbsp;</td>
    <td class="titulo2" style="text-align:right;"> 
      <input type="button" value="Agregar Asignaciones" class="boton" id="btn_addPermiso" style="margin-right:20px;"/></td></tr>
</table>

<table style="width:100%;padding:0px;border-spacing: 0px;" id="item_table" 
  class="display cell-border hover order-column stripe">
<thead>
<tr><td>#</td>
    <td>&nbsp;</td>
    {assign var=numcols value=0}
    {foreach from=$listDataPermiso item=row key=idx}
    <td>{$row.descripcion|escape:"htmlall"}</td>
    {/foreach}</tr>
</thead>
<tbody></tbody>
</table>
{include file="$subcontrol/index.css.tpl"}
{include file="$subcontrol/index.js.tpl"}