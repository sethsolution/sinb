<form enctype="multipart/form-data" method="POST" action="{$getModule}" id="itemFormGral" autocomplete="off">

  <table cellpadding="0" cellspacing="0" border="0" style="width:100%">
    <tr><td class="titulo2" style="text-transform: none;">
          <img src="{$templateDir}images/icon/bullet3.gif"/> Datos de la cuenta de usuario
           ID = {$id}</td>
        <td class="titulo2" nowrap="nowrap">
         {if $privFace.editar == true || $privFace.crear == true}
           <input type="submit" value="Guardar" class="boton"/>
         {/if}</td></tr>
  </table>
    
  <div class="dizq50" style="width:60% !important;">
    <fieldset class="fieldForm" >
      <legend >Datos personales</legend>
    
      <table style="width:100%;">
        <tr><td class="respuesta" style="width:45%;">
              <b>Foto:</b><br />
              {if $item.portada  == 1}
                {assign var=randNum value=0|mt_rand:100}
                <div style="text-align:center;">
                  <img src="{$getModule}&accion=getPhoto&type=0&itemId={$item.itemId}&rand={$randNum}" /></a>
                </div>  
              {/if}
              <input type="file" value="Agregar foto" class="input" name="portada" class="classImag" id="portada"/>
              </td>
            <td class="respuesta">
              <table cellpadding="0" cellspacing="0" border="0" style="width:100%">
                {foreach from=$listDataPersonal item=row key=idx name=personal}
                
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

  <div class="dder50" style="width:40% !important;">
    <fieldset class="fieldForm">
      <legend >Datos de usuario</legend>
        
      <table cellpadding="0" cellspacing="0" border="0" style="width:100%;">
        {foreach from=$listDataUsuario item=row key=idx name=usuario}
          <tr><td class="pregunta" {if $smarty.foreach.usuario.iteration == 2}style="width:100px;"{/if}>
                {$row.descripcion|escape:"htmlall"}:&nbsp;</td>
              <td class="respuesta">
                {if $row.tipoInput == 'text' || $row.tipoInput == 'number' || $row.tipoInput == 'decimal'}
                  <input type="text" class="input" name="item[{$row.campo}]" id="form_{$row.campo}"  {$privFace.input}
                      value="{$item[$row.campo]|escape:"htmlall"}" style="width:90%;" 
                      {if $row.tipoInput == 'number'}onkeypress="return soloNumeros(event,this.value);"
                      {elseif $row.tipoInput == 'decimal'}onkeypress="return soloNumerosPunto(event,this.value);"
                      {/if} />
                  {if $row.campo == 'usuario'}
                    <div id="msgUsuario"></div>
                  {/if}    
                {elseif $row.tipoInput == 'select'}
                  <select class="input" name="item[{$row.campo}]" id="form_{$row.campo}" {$privFace.input} >
                    {html_options options=$listCatalogo.$idx selected=$item[$row.campo]}
                  </select>
                {elseif $row.tipoInput == 'password'}
                  <input type="password" class="input" name="item[{$row.campo}]" id="form_{$row.campo}" style="width:90%;" {$privFace.input} />
                {/if}
              </td></tr>
        {/foreach}
      </table>
    </fieldset>
  </div>
  
</form>

{include file="index.js.tpl"}
{include file="index.css.tpl"}