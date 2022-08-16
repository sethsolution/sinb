<div class="ui-layout-center" id="center" style="display: none;">
    <ul><li><a href="{$getModule}&accion=item_viewData">Usuarios</a></li></ul>
</div>

<div class="ui-layout-south" id="footer" style="display: none;">
  <div style="text-align:right; padding:2px 2px 2px 2px;">
    &copy; Viceministerio de Recursos Hidricos y Riego | SNIR v1.0.0&nbsp;&nbsp;&nbsp;
  </div>
</div>

<div class="ui-layout-east" id="east_pane" style="display: none;"> &nbsp; </div>

<div class="ui-layout-west" id="west_pane" style="display: none;">
  <div id="panelIzq" style="width:255px;">
    {include file="index.buscador.tpl"}
  </div>
</div>

<div class="ui-layout-north" id="header" style="display: none;">
    <div class="title1">Listado Grupo de Usuarios
    <input type="button" onclick="itemUpdate('','new');" name="new"value="Nuevo Registro" class="boton"/>
    </div>
</div>

{include file="index.js.tpl"}
{include file="index.css.tpl"}