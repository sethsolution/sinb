<fieldset class="fieldForm" style="display:table-column;margin-top:5px;width:99%;">
  <table cellpadding="0" cellspacing="0" border="0" width="100%">
    <tr><td class="topTitulo" align="right">
          <img src="{$templateDir}images/icon/item.png" />Lista de Datos</td>
        <td class="topBotones" align="right">
          <input type="button" onclick="itemUpdate('','new');" name="new"value="Nueva Dato" class="boton"/></td></tr>
  </table>
<table id="oTable_2" class="tableHighlight" style="width:95%;">
  
  <thead>
    <tr><th>#</th>
        <th>Nombre</th>
        <th>Accion</th></tr>
  </thead>
  <tbody>
        {foreach from=$listDatos item=val key=key name=listDatos}
            <tr ><td>{$smarty.foreach.listDatos.iteration}</td>
                <td>{$val.nombre|utf8_encode}</td>
                <td>
                    {if $tablaGuardar != 'gestion_estadistico'}
                    <a class="linkAction" href="javascript:void(0);" onclick="itemUpdate({$val.itemId},'update')">
                        <img src="./template/user/images/icon/modificar.gif" border="0" title="Modificar"/></a>
                    {/if}
                    <a class="linkAction" href="javascript:void(0);" onclick="itemDelete({$val.itemId}, '{$val.nombre}')" title="Borrar">
                    <img src="./template/user/images/icon/delete.png" title="Borrar" border="0" /></a></td>
            </tr>          
        {/foreach}
  </tbody>
</table>

<div id="modalDialog_1" title="Formulario">
    <div id="contentForm"> 
    
    </div>    
</div>  

</fieldset>
{include file="datos_js.tpl"}