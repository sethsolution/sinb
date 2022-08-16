<div id="panelGrafica">
{literal}
<style>
body{ background-image: none !important ;}
 #C1s g, g g{
    stroke: #006600;
    fill:   #00cc00;
    visibility:hidden;
  }
  #chart .PlotArea {
    fill: transparent;
    stroke: #C5DBEC;
    stroke-width: 10;
  }
  .jchartfx .DataGrid_HeaderBack{
    fill: #ffffff !important;
  }
  .jchartfx .DataGrid_RowHeader,
  .jchartfx .DataGridText{
    /*stroke: #ffffff !important;*/
  }
    .titulo_reporte{ text-transform: uppercase;
    font-size: 12px;
    
    color: #01578f;
    padding: 10px 2px 2px 2px;
    margin: 0px 0px 5px 0px;
    border-bottom: 2px solid #31920a; 
    }
</style>
{/literal}

<table style="width:1000px;padding:0px;border-spacing: 0px;padding:0px;margin:0px auto;" >
<tr>
    <td class="escudo" 
    style="width: 182px;text-align: right;border-bottom:1px solid;"><img 
    src="{$templateDir}images/pdf/EscudoBolivia.png" width="182" height="70"/></td>
    <td class="tituloHeader"  style="text-align: center; font-size: 15px;border-bottom:1px solid;">
        Ministerio de Medio Ambiente y Agua <br />
        Viceministerio de Recursos H&iacute;dricos y Riego<br />
    </td>
    <td class="logo02" style="width: 182px; text-align: rigth;border-bottom:1px solid;"><img 
    src="{$templateDir}images/pdf/MMAyA.jpg"  width="182" height="70"/></td>
</tr>
</table>
  

<table style="width:1000px;padding:0px;border-spacing: 0px;padding:0px;margin:0px auto;">
    <tr>
      <td style="font-size: 9px;text-align:right;"> 
      <span style="color:#0a6c99;"><b>{if $snir}SNIR{else}SIRH{/if}</b></span> | 
      {$userprint.username|escape:"htmlall"} - {$dateprint}</td>
    </tr>
</table>

<table style="width:1000px;padding:0px;border-spacing: 0px;padding:0px;font-size:12px; margin:0px auto;"
    id="tableLeyenda">
    <tr>
        <td class="titulo_reporte" style="text-align:center !important;">{$title.Encabezado}</td>
    </tr>
</table>

<table cellpadding="5" 
style="width:1000px;padding:0px;border-spacing: 0px;padding:0px;font-size:12px; margin:0px auto;">
 <thead>
  <tr class="tHead">
    <td rowspan="2" class="{$colNeutroH}"></td>
      {assign var="color" value='$listColor.h[0]'}
      <td rowspan="2" style="background-color:{$color} !important;" class="lineLeft lineRight" >Total</td>
        {assign var="color" value='$listColor.h[1]'}
      <td colspan="2" style="background-color:{$color} !important;" class="lineLeft lineRight">Activos</td>
        {assign var="color" value='$listColor.h[2]'}
      <td colspan="2" style="background-color:{$color} !important;" class="lineLeft lineRight">Tipo de Usuarios</td>
  </tr>
  <tr class="tHead">
      {assign var="color" value='$listColor.h[1]'}
      <td style="background-color:{$color} !important;width:15%" class="lineLeft lineRight">Si</td>
      <td style="background-color:{$color} !important;width:15%" class="lineLeft lineRight">No</td>
      {assign var="color" value='$listColor.h[2]'}
      <td style="background-color:{$color} !important;width:15%" class="lineLeft lineRight">Administradores</td>
      <td style="background-color:{$color} !important;width:15%" class="lineLeft lineRight">Normales</td>
  </tr>
  </thead>


  <tbody>
      {foreach from=$item item=r key=k name=item}
        {assign var="color" value='$listColor.h[$smarty.foreach.tipo.index]'}
         <tr class="{$stylez}" onMouseOver="this.className='listaDato03'; return true;" onMouseOut="this.className='{$stylez}'; return true;">
              <td class="lineRight lineLeft {$colNeutro}">{$r.Nombre}</td>
                      {assign var="color" value='$listColor.r[0]'}
              <td {if $smarty.foreach.item.index % 2 != 0}style='background-color:{$color};'{/if}  class="lineRight" align='right'>{$r.total|number_format:0:",":"."}</td>
                      {assign var="color" value='$listColor.r[1]'}
              <td {if $smarty.foreach.item.index % 2 != 0}style='background-color:{$color};'{/if}  class="lineRight" align='right'>{$r.totalActivos|number_format:0:",":"."}</td>
              <td {if $smarty.foreach.item.index % 2 != 0}style='background-color:{$color};'{/if}  class="lineRight" align='right'>{$r.totalNoActivos|number_format:0:",":"."}</td>
                        {assign var="color" value='$listColor.r[2]'}
              <td {if $smarty.foreach.item.index % 2 != 0}style='background-color:{$color};'{/if}  class="lineRight" align='right'>{$r.totalAdmin|number_format:0:",":"."}</td>
              <td {if $smarty.foreach.item.index % 2 != 0}style='background-color:{$color};'{/if}  class="lineRight" align='right'>{$r.totalNormal|number_format:0:",":"."}</td>
          </tr>

          {assign var=sumaTotal value="`$sumaTotal+$r.total`"}
          {assign var=sumaActivos value="`$sumaActivos+$r.totalActivos`"}
          {assign var=sumaNoActivos value="`$sumaNoActivos+$r.totalNoActivos`"}
          {assign var=sumaAdmin value="`$sumaAdmin+$r.totalAdmin`"}
          {assign var=sumaNormal value="`$sumaNormal+$r.totalNormal`"}
      {/foreach}
  </tbody>

  <tfoot>
      <tr class="tHead">
        <td class="pregunta lineLeft"><b>TOTAL:&nbsp;</b></td>
            {assign var="color" value='$listColor.h[0]'}
        <td style='text-align:right;background-color:{$color};'>{$sumaTotal|number_format:0:',':'.'}</td>
            {assign var="color" value='$listColor.h[1]'}
        <td style='text-align:right;background-color:{$color};'>{$sumaActivos|number_format:0:',':'.'}</td>
        <td style='text-align:right;background-color:{$color};'>{$sumaNoActivos|number_format:0:',':'.'}</td>
            {assign var="color" value='$listColor.h[2]'}
        <td style='text-align:right;background-color:{$color};'>{$sumaAdmin|number_format:0:',':'.'}</td>
        <td style='text-align:right;background-color:{$color};'>{$sumaNormal|number_format:0:',':'.'}</td>
    </tr>
  </tfoot>    


</table>
  
<div id="ChartDiv{$tipo}" style="width:1000px;height:400px;margin: 0 auto;"></div>
{include file="$subcontrol/grafica.item.js.tpl"}
</div>