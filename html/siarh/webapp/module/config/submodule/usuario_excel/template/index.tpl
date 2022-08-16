<div  id="topMenuRiego">
  <table cellpadding="0" cellspacing="0" border="0" width="100%">
    <tr><td class="topTitulo">
          <img src="{$templateDir}images/icon/item.png" />
          {$titleSmodule} - USUARIO</td>
        <td class="topBotones" align="right">&nbsp;</td></tr>
  </table>
</div> 
  
<br /><br /><br />

<fieldset class="fieldForm" style="background-color:#ffffff;">
    <legend >Opciones de generaci&oacute;n de informe:</legend>
    <form id="itemForm_excel" onsubmit="return getExcel();">
    <table style="width:100%;">
      
    </tr>
    
      <div>
      <table style="width:100%;">
            <tr>
              <td class="pregunta" style="width:120px">Instituci&oacute;n:</td>
              <td class="respuesta" style="width:10%;">
                <select data-placeholder="Elija Instituci&oacute;n" id="institucionId"  multiple class="chosen-select">
                     <option value=""></option>
                     {html_options options=$cataobj.institucion }
                  </select>
              </td>
              <td>  
                  <input class="messageCheckbox" type="checkbox" id="institucionCheck" name="formCheck[]" value="D" checked>
                Visible<br />
                </td>
            </tr>  
            
         <tr><td class="pregunta">Tipo de Usuario:&nbsp;</td>
            <td class="respuesta" >        
              <select data-placeholder="Elija Tipo" id="tipoUsuario"  multiple class="chosen-select">
                     <option value=""></option>
                     {html_options options=$cataobj.tipo }           
              </select>
              <td>  
                  <input class="messageCheckbox" type="checkbox" id="tipoCheck" name="formCheck[]" value="F" checked>
               Visible<br />
                </td></tr>
                 
            <tr>
              <td class="pregunta">Grupo:</td>
              <td class="respuesta" style="width:10%;">
                <select data-placeholder="Elija Grupo" id="grupoId"  multiple class="chosen-select">
                     <option value=""></option>
                     {html_options options=$cataobj.grupo }
                  </select>
              </td>
              <td>  
                  <input class="messageCheckbox" type="checkbox" id="grupoCheck" name="formCheck[]" value="E" checked>
                Visible<br />
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
     
      </table>
    </div>
    
    
    <tr>
        <td colspan="4" style="text-align:center;">
        <input type="button" value="Generar Excel" class="boton" id="btn_excel" />
        </td>
    </tr>
    </table>
    </form>
</fieldset>
<br style="lear:both;" />
<div  align="center" id="msg"></div>


{include file="index_js.tpl"}
