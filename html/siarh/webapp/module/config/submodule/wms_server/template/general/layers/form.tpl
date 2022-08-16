<form enctype="multipart/form-data" method="POST" action="{$getModule}" id="itemForm_photo" accept-charset="utf-8">
<input type="hidden" name="accion" id="accion" value="general_layer{$accion}sql"/>
<input type="hidden" name="id" id="id" value="{$id}"/>

  <table cellpadding="0" cellspacing="0" border="0" width="100%">
    <tr><td class="titulo2"> <img src="{$templateDir}images/icon/bullet3.gif"/>
          {if $accion == "new"}Nuevo Layer
          {else}Actualizar Layer{/if}</td>
        <td class="titulo2"><input type="submit" value="Guardar" name="Save" class="boton"/></td>
        <td class="titulo2" align="right"><input type="button" value="Cerrar" class="boton" id="btn_closePhoto"/></td></tr>
  </table>

  <table align='center' width="100%" cellpadding="0"  cellspacing="0" >
    {if $accion == "update"}
        <input type="hidden" name="itemId" value="{$item.itemId}"/>
    {else}
        <input type="hidden" value="{$idFicha}" name="item[serverId]">
    {/if}

    {if $accion != "new"}
      <tr><td class="pregunta">ID</td>
	      <td class="respuesta">{$item.itemId}</td></tr>
    {/if}

    <tr><td class="pregunta">(*)Nombre:</td>
	    <td class="respuesta" >
          <input style="width:84%;" type="text" id="title" name="item[nombre]" class="input" value="{$item.nombre}" /></td></tr>


    <tr><td class="pregunta">(*)Layer:</td>
      <td class="respuesta" >
          <input style="width:84%;" type="text" id="layer" name="item[layer]" class="input" value="{$item.layer}" /></td></tr>


    <tr><td class="pregunta">(*)Formato:</td>
      <td class="respuesta" >
        <select class="input" name="item[formatoId]" id="form_formatoId" {$privFace.input}>
                    {html_options options=$listCatalogo.formato selected=$item.formatoId}
                  </select></td></tr>

    <tr><td class="pregunta">(*)Visible:</td>
      <td class="respuesta" >
        <select class="input" name="item[visible]" id="form_visible" {$privFace.input}>
                    {html_options options=$arrayCondicion selected=$item.visible}
                  </select></td></tr>

    <tr><td class="pregunta">(*)Transparente:</td>
      <td class="respuesta" >
        <select class="input" name="item[transparencia]" id="form_transparencia" {$privFace.input}>
                    {html_options options=$arrayCondicion selected=$item.transparencia}
                  </select></td></tr>

    <tr><td class="pregunta">Descripci&oacute;n:</td>
	    <td class="respuesta">
	      <textarea name="item[descripcion]" class="input" id="description" style="width:84%;" rows="4">{$item.descripcion}</textarea></td></tr>

    <tr><td class="pregunta">Opacidad:</td>
      <td><div id="slider-range-max" style="width:50%"></div><div style="width:50%; height:50px; margin-left: 25px; opacity: {$item.opacidad};  background-color: LightBlue;" id="box" >
            <p style="font-size:16px"><b>&nbsp;&nbsp;&nbsp;Texto de prueba...</b></p>
          </div><div id="opacity_num" style="padding:7px;font-size:12px;font-weight:bold;" class="box_numb">{if $item.opacidad == ''}0.5{else}{$item.opacidad}{/if}</div>
          <input style="width:84%;" type="hidden" id="form_opacidad" name="item[opacidad]" class="input" value="{if $item.opacidad == ''}0.5{else}{$item.opacidad}{/if}" /></td>
  </table>
</form>

{* JavaScript del m�dulo *}
{include file="$subcontrol/layers/form.js.tpl"}
{* fin *}