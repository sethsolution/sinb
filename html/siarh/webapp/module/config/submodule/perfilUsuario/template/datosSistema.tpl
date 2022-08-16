<fieldset class="fieldForm" style="background-color:#ffffff;" align="right">
 <div class="" style="margin-top:15px;margin-bottom:15px;"> 
    
<table cellpadding="5" width="500" cellspacing="0" border="0" class="adminlist" style="margin:0 auto;" id="userEdit">
    <tr>
        <td class="pregunta" align="left" style="border-top:1px solid #e5e5e5;">Usuario :</td>
        <td class="respuesta2" align="left" style="border-top:1px solid #e5e5e5;">
        {$item.usuario|escape:'htmlAll'}</td>        
    </tr> 
    <tr>
        <td class="pregunta"  align="left">Contrase�a :</td>
        <td class="respuesta2" align="left">{*<input type="hidden" id="passssPerf" value="{$contras}" />*}
        <input {$privFace.input}  class="input" style="width:95%;" type="password" name="passwordPerf" id="passwordPerf" 
        value="" disabled="disabled"  />
        <div id="errorpass"></div>
        <p><span class="nota">Nota:</span><br />
        - Si desea cambiar la contrase�a, por favor introduzca la contrase�a nueva.<br />
        - Si no desea cambiar la contrase�a, deje este campo en blanco. </p>
        </td>
    </tr>
    <tr>
        <td class="pregunta"  align="left">Tipo Usuario:</td>
        <td class="respuesta2" align="left">{$tipuser}</td>        
    </tr>
    <tr>
        <td class="pregunta"  align="left">Nombre :</td>
        <td class="respuesta2" align="left"><input {$privFace.input}  class="input" style="width:95%;" type="text" 
        name="nombrePerf" id="nombrePerf" value="{$item.nombre|escape:'htmlAll'}"  
        disabled="disabled"  /><div id="errornomb"></div>
        </td>        
    </tr>  
    <tr>
        <td class="pregunta"  align="left">Apellido :</td>
        <td class="respuesta2" align="left"><input {$privFace.input}  class="input" style="width:95%;" type="text" 
        name="apellidoPerf" id="apellidoPerf" value="{$item.apellido|escape:'htmlAll'}" 
        disabled="disabled"  /><div id="errorapell"></div>
        </td>      
    </tr>
    <tr>
        <td class="pregunta"  align="left">Activo :</td>
        <td class="respuesta2" align="left">{$estado}</td>        
    </tr>         
    </table>
    {if $privFace.editar == true}
    <div align="center"><span class="classBoton" id="edits" onclick="editarDatosSistemaPerf()">Editar</span>
    <span class="classBoton" id="guadars" onclick="guardarDatosSistemaPerf()" style="display:none">Guardar</span> &nbsp
    <span class="classBoton" id="cancels" onclick="cancelDatosSistemaPerf()" style="display:none">Cancelar</span></div>
    </div>
    
    <div align="center"><p class="alerta" style="width:450px;text-align:center;">Nota: Para cambiar o modificar alg&uacute;n dato presion&eacute; Editar. <br /> Al editar solo se habilitara los campos que son editables</p>
    <div id="estadoRegistroPerf"></div></div>
    {/if}
