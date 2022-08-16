<form enctype="multipart/form-data" method="POST" action="{$getModule}" id="itemModalForm" accept-charset="utf-8">

<table style="width:100%;padding:0px;border-spacing: 0px;">
<tr><td class="pregunta">Módulo</td>
    <td class="respuesta">
      <select id="moduloId" data-placeholder="Filtro por modulo (TODOS)" style="width:250px;" 
        multiple class="chosen-select" tabindex="-1">
        {html_options options=$listCatalogo.core_modulo}
      </select></td></tr>
</table>
</form>    

<table style="width:100%;padding:0px;border-spacing: 0px;" id="submodulo_table" 
  class="display cell-border hover order-column stripe">
<thead>
<tr><th>&nbsp;</th>
    <th>Submodulo</th>
    <th>Modulo</th>
    <th>Submodulo padre</th></tr>
</thead>
<tbody></tbody>
</table>

{* JavaScript del módulo *}
{include file="$subcontrol/itemForm.js.tpl"}
{include file="$subcontrol/itemForm.css.tpl"}
{* fin *}