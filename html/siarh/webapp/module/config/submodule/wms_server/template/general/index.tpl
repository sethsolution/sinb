<form enctype="multipart/form-data" method="POST" action="{$getModule}" id="itemFormGral" autocomplete="off">

  <table cellpadding="0" cellspacing="0" border="0" style="width:100%">
    <tr><td class="titulo2">
          <img src="{$templateDir}images/icon/bullet3.gif"/> Datos de la cuenta de servidor
          {if $accion != "new"}: ID = {$id} {/if}</td>
        <td class="titulo2" nowrap="nowrap">
         {if $privFace.editar == true || $privFace.crear == true}
           <input type="submit" value="Guardar" class="boton"/>
         {/if}</td></tr>
  </table>

 <div class="dizq50" style="width:100% !important;">
    <fieldset class="fieldForm" >
      <legend >Datos Servidor</legend>
    
      <table style="width:100%;">
        <tr>
            <td class="respuesta">
              <table cellpadding="0" cellspacing="0" border="0" style="width:100%">
                {foreach from=$listDataServer item=row key=idx name=personal}
                
                    <tr><td class="pregunta" {if $smarty.foreach.personal.iteration == 2}style="width:100px;"{/if}>
                          {$row.descripcion|escape:"htmlall"}:&nbsp;</td>
                        <td class="respuesta">
                          {if $row.tipoInput == 'text' || $row.tipoInput == 'number' || $row.tipoInput == 'decimal'}
                            <input type="text" class="input" name="item[{$row.campo}]" id="form_{$row.campo}" {$privFace.input} 
                                value="{$item[$row.campo]|escape:"htmlall"}" style="width:90%;" 
                                {if $row.tipoInput == 'number'}onkeypress="return soloNumeros(event,this.value);"
                                {elseif $row.tipoInput == 'decimal'}onkeypress="return soloNumerosPunto(event,this.value);"
                                {/if} />
                          {elseif $row.tipoInput == 'select'}
                            <select class="input" name="item[{$row.campo}]" id="form_{$row.campo}" {$privFace.input}>
                              {html_options options=$listCatalogo.$idx selected=$item[$row.campo]}
                            </select>
                          {/if}
                        </td></tr>             
      
                {/foreach}
              </table></td></tr>
      </table>
    </fieldset>  
  </div>

{if $accion == 'update'}

<div class="dizq50" style="width:100% !important;">
  <fieldset class="fieldForm" >
      <legend >Layers</legend>
{include file="general/layers/index.tpl"}
</div>
{/if}

  
</form>

{include file="general/index.js.tpl"}
{include file="general/index.css.tpl"}