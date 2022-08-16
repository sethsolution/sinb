<!-- <form enctype="multipart/form-data" method="POST" action="{$getModule}" id="itemModalForm" accept-charset="utf-8">

<table style="width:100%;padding:0px;border-spacing: 0px;">
<tr><td class="pregunta">Modulo</td>
    <td class="respuesta">
      <select id="moduloId" data-placeholder="Filtro por modulo (TODOS)" style="width:250px;" 
        multiple class="chosen-select" tabindex="-1">
        {html_options options=$listCatalogo.core_modulo}
      </select></td></tr>
</table> 
</form>  -->  
<!--
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
-->

<div id="content_tableListPersona" >
  <table cellpadding="0" cellspacing="0" border="0" width="100%">
    <tr><td width="6%" class="titulo2" style="text-transform: none;"> 
          <img src="{$templateDir}images/icon/bullet3.gif"/> Lista de Modulos - Fichas</td></tr>
  </table>
  
    <fieldset class="fieldForm" style="display:table-column">
              <div style="padding:5px;">
              <table cellpadding="0" cellspacing="0" border="0" id="tableItem" class="display hover order-column cell-border" style="width:100%;" >
                  <thead>
                  <tr><td>#</td><td>&nbsp;</td>
                        {foreach from=$dataFichas.descripcion item=row key=idx}
                          <td>{$row|escape:"htmlall"}</td>
                        {/foreach}
                        </tr>
                  </thead>
                  <tbody></tbody>
              </table> 
              </div>
    </fieldset>
</div>
{include file="$subcontrol/persona/item.js.tpl"}


{* JavaScript del m�dulo *}
{include file="$subcontrol/itemForm.js.tpl"}
{include file="$subcontrol/itemForm.css.tpl"}
{* fin *} 