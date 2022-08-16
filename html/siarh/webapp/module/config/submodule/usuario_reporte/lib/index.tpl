<div class="ui-layout-center" id="center" style="display: none;">
    
    {* Titulo *}
    <div class="title1">Listado
    <input type="button" onclick="itemUpdate('','new');" name="new"value="Nuevo registro" class="boton"/>
    </div>
    {* Fin Titulo *}
    <div id="tabsItem">
        <ul><li><a href="{$getModule}&accion=viewData">Datos</a></li></ul>
      </div>
    <br class="spacer" />
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

<div class="ui-layout-north" id="header" style="display: none;">&nbsp;</div>






  



{*include file="index.list.tpl"*}

{include file="index.js.tpl"}
{include file="index.css.tpl"}