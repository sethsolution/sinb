<div class="ui-layout-center" id="center" style="display: none;">
  <div id="contentGrafica"></div>
  <br class="spacer" />
</div>

<div class="ui-layout-south" id="footer" style="display: none;">
  <div style="text-align:right; padding:2px 2px 2px 2px;">
    &copy; Viceministerio de Recursos Hidricos y Riego | <b>{if $snir}SNIR{else}SIRH{/if}</b>&nbsp;&nbsp;&nbsp;
  </div>
</div>

<div class="ui-layout-east" id="east_pane" style="display:none;"> &nbsp; </div>

<div class="ui-layout-west" id="west_pane" style="display: none;">
  <div id="panelIzq" style="width:255px;">
    {include file="index.buscador.tpl"}
  </div>
</div>

<div class="ui-layout-north" id="header" style="display: none;">
  <div class="title1">Reportes Gr&aacute;ficos
  <input type="button" value="Imprimir" class="boton" id="btn_print"/>
  </div>
</div>

{include file="index.js.tpl"}
{include file="index.css.tpl"}