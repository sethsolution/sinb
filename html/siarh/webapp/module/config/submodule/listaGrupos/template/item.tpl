<div class="topMenuItemForm">
  <table cellpadding="0" cellspacing="0" border="0" width="100%">
    <tr><td class="topTitulo">
          <img src="{$templateDir}images/icon/item.png" />
          {if $accion == "new"}Nuevo{/if}
             Registro de grupo
             {if $accion != "new"}:&nbsp;{$item.nombre|escape:"htmlall"}
          {/if}</td>
        <td class="topBotones" align="right">
          {if $accion == "new"}
            <input type="button" onclick="cancelRegItem(1);" value="Cerrar" class="boton" id="btn_cancel1"/>
          {else}
            {*}<input type="button" onclick="javascript:void(0);" value="Imprimir Ficha" class="boton" id="btn_print"/>*}
            <input type="button" onclick="cancelRegItem(2);" value="Cerrar" class="boton" id="btn_cancel1"/>
          {/if}</td></tr>
  </table>
</div>

<br /><br /><br />
<div id="content_item" style="margin-top:5px;">
  <div id="tabsMenu_evalDam" style="">
    <ul><li><a href="{$getModule}&accion=general_index&id={$id}&type={$accion}" >Datos generales</a></li>
        {if $accion == "update"}
        <li><a href="{$getModule}&accion=permiso_index&id={$id}&type={$accion}" >Permisos al sistema</a></li>
        {/if}        
    </ul>
  </div>
</div>

<div id="dialogView" title="Listado">
  <div id="progressbar_dialogView" style="margin:5px auto;"><div class="progress-label">Cargando ...</div></div>
  <div id="content_dialogView"></div>
  <div id="msg_dialogView"></div>
</div>
 
<div id="dialogForm" >
  <div id="progressbar_dialogForm" style="margin:5px auto;"><div class="progress-label">Cargando ...</div></div>
  <div id="content_dialogForm"></div>
  <div id="msg_dialogForm"></div>
</div>
 
  
{include file="item.js.tpl"}