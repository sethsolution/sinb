<div id="searchFps">
  <div class="title1">Filtros</div>
  <br />

  <table style="width:100%;" style="padding:1px !important;">
    <tr>
        <td class="pregunta" style="width:80px;">Instituci&oacute;n: </td>
        <td class="respuesta"> 
        <select style="width:97%;border-color:orange;" id="institucionId" class="input itemFilter" rel="7" data-placeholder="Todos las instituciones"> 
          <option></option>
          <option value="">Todas</option>
          {html_options options=$cataobj.item}
        </select>
        </td></tr>
    <tr><td class="pregunta" style="width:80px;">Tipo de usuario: </td>
        <td class="respuesta"> 
        <select  style="width:97%;border-color:orange;" id="tipoId" class="input itemFilter" rel="6" data-placeholder="Todos los tipos de usuario"> 
            <option></option>
            <option value="">Todas</option>
            {html_options options=$cataobj.tipo}
        </select></td></tr>     
    <tr><td class="pregunta" style="width:80px;">Grupo: </td>
        <td class="respuesta"> 
        <select  style="width:97%;border-color:orange;" id="tipoId" class="input itemFilter" rel="8" data-placeholder="Todos los grupos"> 
            <option></option>
            <option value="">Todas</option>
            {html_options options=$cataobj.grupo}
        </select></td></tr>   
    <tr><td class="pregunta" style="width:80px;">Activo: </td>
        <td class="respuesta"> 
        <select  style="width:97%;border-color:orange;" id="tipoId" class="input itemFilter" rel="16" data-placeholder="Todos"> 
            <option></option>
            <option value="">Todas</option>
            {html_options options=$cataobj.activo}
        </select></td></tr>   
  </table>
</div>

<div id="summaryItem" style="width:100%; display:inline-block;" align="center">
  <div class="title1">Resumen</div><br />
  
  <table cellpadding="2" cellspacing="0" class="sumary">
    <thead>
      <tr><th>Descripci&oacute;n</th>
          <th>Total</th></tr>
    </thead>
    <tbody>
    <tr><td class="titleRs" style="width:150px;"># de Usuario:</td>
        <td class="titleRs"><label id="item_totalficha"></label></td></tr>
    
    </tbody>
  </table>
  
</div>

{include file="index.buscador.js.tpl"}