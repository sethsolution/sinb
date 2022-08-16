<fieldset class="fieldForm" style="background-color:#ffffff;" align="right">
    <table cellpadding="5" cellspacing="0" border="0" class="adminlist" style="margin:0 auto;">
    <tr>
    <td class="pregunta" align="left"><label for="name">Secretar&iacute;a:</label>
    </td>
    <td class="respuesta">
    <div id="secretariadato">{if $secret == ""}Dato sin asignar{else}{$secret|utf8_decode}{/if}</div>
    </td>        
    </tr>
    <tr>
    <td class="pregunta" align="left"><label for="name">Entidad dentro la Secretar&iacute;a</label>
    </td>
    <td class="respuesta">
    <div id="entidaddato">{if $entida == ""}Dato sin asignar{else}{$entida|utf8_decode}{/if}</div>
    </td>
    </tr>    
    </table>
    <div align="center"><span class="classBoton" title="Desactivo" onclick="editDatosSecretaria()">Modificar</span></div>
</fieldset>