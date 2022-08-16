<div class="titulo01">Linea Base</div>

<table cellpaddig="0" cellspacing="0" border="0" style="width:100%;">
  <tr><td style="" class="pregunta">
        I.- IDENTIFICACI&Oacute;N DEL PROYECTO DE RIEGO</td>
      <td class="respuesta">Fecha</td>
      <td class="pregunta">Nombre y Apellido del Encuestado</td>
      <td class="respuesta">{$item.encuestadoName|escape:"htmlall"}</td></tr>
  
  <tr><td class="respuesta" >{$item.proyectoName|escape:"htmlall"}</td>
      <td class="respuesta">{$item.fecha|date_format(:"%d - %m - %Y")}</td>
      <td class="pregunta">Nombre y Apellido del encuestador:</td>
      <td class="respuesta">{$item.encuestadorName|escape:"htmlall"}</td></tr>
</table>

<table cellpaddig="0" cellspacing="0" border="0" style="width:100%;">
  <tr><td class="pregunta" >Departamento:</td>
      <td class="respuesta">{$item.departamentoName|escape:"htmlall"}</td>
      <td class="pregunta" >Municipio:</td>
      <td class="respuesta">{$item.municipioName|escape:"htmlall"}</td>
      <td class="pregunta" >Comunidad:</td>
      <td class="respuesta">{$item.comunidad q|escape:"htmlall"}</td></tr>
</table><br />

<table>
  <tr><td><div class="header_title2">II.- CARACTERIZACI&Oacute;N SOCIODEMOGR&Aacute;FICA:</td></tr>
</table>

<div class="break_line">&nbsp;</div>