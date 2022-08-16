
{* JavaScript del módulo *}
{include file="$templateDirModule/tools/js.tpl"}
{* fin *}

  <table cellpadding="0" cellspacing="0" border="0" width="100%">
    <tr><td class="titulo2"> 
          <img src="{$templateDir}images/icon/bullet3.gif"/> Generador de UTM</td>
        <td width="77%"  nowrap="nowrap" align="left" class="titulo2">&nbsp;</td></tr>
  </table>
  <br />
  
  <div id="convertTabs">
  <ul><li><a href="#convertUTM">Conversi&oacute;n a UTM</a></li> 
      <li><a href="#convertDMS">Conversi&oacute;n a DMS</a></li></ul>
    
  <div id="convertUTM">
    <center>
      <form id="itemFormSearch1" onsubmit="convert(1);return false;">
      <table cellpadding="0" cellspacing="0" border="0" width="1000">
        <tr><td class="titulo3"> Ingerso de datos</td></tr>
        <tr><td>
              <fieldset class="fieldForm">
                <legend>LATITUD</legend>
                <table cellpadding="5" cellspacing="0" border="0" width="1000">
                  
                  <tr><td class="pregunta">Grados:&nbsp;</td>
                      <td class="respuesta"><input type="text" id="latGrade" value="" class="input" onkeypress="return soloNumeros(event);" /></td>
                      <td class="pregunta" >Minutos:&nbsp;</td>
                      <td class="respuesta" ><input type="text" id="latMinute" value="" class="input" onkeypress="return soloNumeros(event);" /></td>
                      <td class="pregunta" >Segundos:&nbsp;</td>
                      <td class="respuesta" ><input type="text" id="latSeconds" value="" class="input" onkeypress="return soloNumeros(event);" /></td></tr>
                </table>
              </fieldset></td></tr>
        <tr><td>
              <fieldset class="fieldForm">
                <legend>LONGITUD</legend>
                <table cellpadding="5" cellspacing="0" border="0" width="1000">
                  
                  <tr><td class="pregunta">Grados:&nbsp;</td>
                      <td class="respuesta"><input type="text" id="longGrade" value="" class="input" onkeypress="return soloNumeros(event);" /></td>
                      <td class="pregunta" >Minutos:&nbsp;</td>
                      <td class="respuesta" ><input type="text" id="longMinute" value="" class="input" onkeypress="return soloNumeros(event);" /></td>
                      <td class="pregunta" >Segundos:&nbsp;</td>
                      <td class="respuesta" ><input type="text" id="longSeconds" value="" class="input" onkeypress="return soloNumeros(event);" /></td></tr>
                </table>
              </fieldset></td></tr>
        <tr><td colspan="6" align="center">
              <input type="submit" name="Search" value="Convertir" class="boton" /></td></tr>              
      </table>
      </form>
      <br /><br />
      <div id="resutm" style="display:none;">
        <table cellpadding="0" cellspacing="0" border="0" width="100%">
          <tr><td class="pregunta">UTM Norte</td>
              <td class="respuesta"><div id="utmnorth"></div></td>
              <td class="pregunta">UTM Este</td>
              <td class="respuesta"><div id="utmeast"></div></td>
              <td class="pregunta">UTM Zona</td>
              <td class="respuesta"><div id="utmzone"></div></td></tr>
        </table>
      </div>
    </center>
  </div>
  
  <div id="convertDMS">
    <center>
      <form id="itemFormSearch1" onsubmit="convert(2);return false;">
      <table cellpadding="0" cellspacing="0" border="0" width="1000">
        <tr><td class="titulo3"> Ingerso de datos</td></tr>
        <tr><td>
              <fieldset class="fieldForm">
                <legend>UTM</legend>
                <table cellpadding="5" cellspacing="0" border="0" width="1000">
                  
                  <tr><td class="pregunta">Norte:&nbsp;</td>
                      <td class="respuesta"><input type="text" id="north" value="" class="input" /></td>
                      <td class="pregunta" >Este:&nbsp;</td>
                      <td class="respuesta" ><input type="text" id="east" value="" class="input" /></td>
                      <td class="pregunta" >Zona:&nbsp;</td>
                      <td class="respuesta" ><input type="text" id="zone" value="" class="input" /></td></tr>
                </table>
              </fieldset></td></tr>
        <tr><td colspan="6" align="center">
              <input type="submit" name="Search" value="Convertir" class="boton" /></td></tr>              
      </table>
      </form>
      
      <br /><br />
      <div id="resdms" style="display:none;">
        <table cellpadding="0" cellspacing="0" border="0" width="100%">
          <tr><td class="pregunta">Longitud</td>
              <td class="respuesta"><div id="longitude"></div></td>
              <td class="pregunta">Latitud</td>
              <td class="respuesta"><div id="latitude"></div></td></tr>
        </table>
      </div>
    </center>
  </div>
  </div>