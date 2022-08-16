<div class="topMenuItemForm">
<table style="width:100%;padding:0px;border-spacing: 0px;">
<tr>
    <td class="topTitulo">
        <img src="{$templateDir}images/icon/item.png" />
        {if $accion == "new"}Nuevo{/if}
        Registro de usuario
        {if $accion != "new"}:&nbsp;{$item.nombre|escape:"htmlall"} {$item.apellido|escape:"htmlall"}
        {/if}
    </td>
    <td class="topBotones" align="right">
        <input type="button" onclick="visualizarManual();" name="visualizar" value="Ver Manual" class="boton"/>
        {if $accion == "new"}
            <input type="button" onclick="cancelRegItem(1);" value="Cerrar" class="boton" id="btn_cancel1"/>
        {else}
            <input type="button" onclick="cancelRegItem(2);" value="Cerrar" class="boton" id="btn_cancel1"/>
        {/if}
    </td>
</tr>
</table>
</div>

<div id="content_item" style="margin-top:46px;">
  <div id="tabsMenu_evalDam" style="">
    <ul>
    <li><a href="{$getModule}&accion=general_index&id={$id}&type={$accion}" >Datos generales</a></li>
    {if $accion == "update" && ($item.tipoUsuario != 0 && $item.tipoUsuario != 1)}
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
{include file="item.css.tpl"}