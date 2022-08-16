<form enctype="multipart/form-data" method="POST" action="{$getModule}" id="itemForm">
  <table cellpadding="0" cellspacing="0" border="0" width="100%">
    <tr><td class="titulo2"> 
          <img src="{$templateDir}images/icon/bullet3.gif"/> 
          {if $accion == 'new'}Nuevo registro {else} Actualizar registro ID:{$id} {/if}</td></tr>
  </table>
  
  <table align='center' width="100%" cellpadding="0"  cellspacing="0" id="areaForm">
        {foreach from=$dataConfig item=val key=key}
        {if $dataConfigTipo[$key] == 'text' or $dataConfigTipo[$key] == 'number'}
            <tr><td class="pregunta" width="150px">{$dataConfigDescripcion[$key]}:&nbsp;</td>
                <td class="respuesta">
                  <input {$privFace.input} type="text" name="item[{$val}]" id="form_{$val}" 
                        class="input" {if $dataConfigTipo[$key] == 'number'} onkeypress="return soloNumeros(event,this.value);" {/if} value="{$item.$val|utf8_encode}" />
                </td>
            </tr>
        {else}
            {assign var=valorSelecionar value=$val}
            <tr><td class="pregunta">(*){$dataConfigDescripcion[$key]}:&nbsp;</td>
                <td class="respuesta">
                    <select {$privFace.input} name="item[{$valorSelecionar}]" class="input" id="form_{$val}" >
                           {if $valorSelect != 'parent'}
                            <option value="0">Seleccione {$dataConfigDescripcion[$key]}</option>
                                {html_options options=$listas[$val] selected=$item.$valorSelecionar}
                            {else}
                                <option value="0">No tiene Predecesor: {$dataConfigDescripcion[$key]}</option>                      
                                {$listas[$val]}
                            {/if}
                          </select></td>
                    </tr>
        {/if}
                         
        {/foreach}
    
     
     
  </table>
</form>

{include file="$subcontrol/itemForm_js.tpl"}