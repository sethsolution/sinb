<div id="tabsModulos" >

  <ul>
  	{foreach from=$listModulos item=r key=k name=item}
     <li><a href="{$getModule}&accion=permiso_getModulosList&fichaId={$fichaId}&nameTable={$r.nameTable}&moduloId={$r.itemId}" >{$r.nombre}</a> </li>
     {/foreach}   
  </ul>

</div>
{include file="$subcontrol/itemFormTab.js.tpl"}
