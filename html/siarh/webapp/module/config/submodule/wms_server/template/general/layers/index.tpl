{*subtitulo Green*} 
<table cellpadding="0" cellspacing="0" border="0" width="100%">
  <tr><td class="titulo2"><img src="{$templateDir}images/icon/bullet3.gif"/>&nbsp;Conjunto de Layers</td>
      <td class="titulo2" nowrap="nowrap">&nbsp;</td>
      <td class="titulo2" align="right">{if $privFace.crear}
        <input type="button" onclick="itemUpdate('','new');" name="enviar" value="Agregar" class="boton"/>{/if}</td></tr>
</table>
{*subtitulo Green*}

<div id="content_tablePhoto">
    <table id="snir_tablePhoto" width="100%" border="0" cellpadding="0" cellspacing="0" class="highlightDatatable">  
      <thead>
        <tr><th align="center"> #</th>
            <th align="center"> Nombre </th>
            <th align="center"> Layer</th>
            <th align="center"> Descripci&oacute;n </th>            
            <th align="center"> Formato </th>
            <th align="center"> Visible </th>
            <th align="center"> Transparente </th>
            <th align="center"> Opacidad </th>
            <th align="center"> Activo </th>
            <th align="center"> Orden </th>
            <th align="center"> &nbsp; </th>
            </tr>
      </thead>
      <tbody></tbody>
    </table>
 </div>
 
<div id="dialog_addPhoto" title="Registro de layers">
  <div id="photo_progressbar"><div class="progress-label">C a r g a n d o ...</div></div>
  <div id="content_dialogPhoto"></div>
  <div id="msg_dialogPhoto"></div>
</div>
{* JavaScript del m�dulo *}
{include file="$subcontrol/layers/index.js.tpl"}
{* fin *}
