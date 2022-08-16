<div id="searchFps">
  <div class="title1">Filtros</div>
  <br />

  <table style="width:100%;" style="padding:1px !important;">
    <tr>
              <td class="pregunta" style="width:120px">Instituci&oacute;n:</td>
              <td class="respuesta" style="width:10%;">
                <select data-placeholder="Elija Instituci&oacute;n" id="institucionId"  multiple class="chosen-select">
                     <option value=""></option>
                     {html_options options=$cataobj.institucion }
                  </select>
              </td>
            </tr>  
            
         <tr><td class="pregunta">Tipo de Usuario:&nbsp;</td>
            <td class="respuesta" >        
              <select data-placeholder="Elija Tipo" id="tipoUsuario"  multiple class="chosen-select">
                     <option value=""></option>
                     {html_options options=$cataobj.tipo }           
              </select>
                 
            <tr>
              <td class="pregunta">Grupo:</td>
              <td class="respuesta" style="width:10%;">
                <select data-placeholder="Elija Grupo" id="grupoId"  multiple class="chosen-select">
                     <option value=""></option>
                     {html_options options=$cataobj.grupo }
                  </select>
              </td>
            </tr>      

            <tr>
              <td class="pregunta">Activo:</td>
              <td class="respuesta" style="width:10%;">
                <select data-placeholder="Elija" id="activo"  multiple class="chosen-select">
                     <option value=""></option>
                     {html_options options=$cataobj.activo }
                  </select>
              </td>
            </tr>     


    <tr><td class="respuesta" style="text-align:center !important;" colspan="2">
          <input type="button" value="Generar Reporte" class="boton" id="btn_generar" /> </td></tr>
  </table>
</div>


{include file="index.buscador.js.tpl"}
