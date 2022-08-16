{literal}<style>
.ui-resizable-se {
	bottom: 17px;
}
#resizable { width: 200px; height: 150px; padding: 5px; }
</style>
<script> 
$( "#resizable" ).resizable({
	handles: "se"
});
</script>
 {/literal} 
    <div style="margin-top:15px;margin-bottom:15px;">  
    
    <table cellpadding="5" cellspacing="0" border="0" class="adminlist" style="margin:0 auto; width:600px;">
    <tr>
        <td rowspan="5" class="pregunta" style="border-top:1px solid #e5e5e5;text-align:center; padding:1px;width:174px;">
        <div id="imagencargado" style="width:174px;">{$foto}</div>
        
        <br />
        Seleccionar Imagen:
        <br />
        <p style="text-align:center;">
        
        <input {$privFace.input} id="archivos" type="file" name="archivos[]" multiple="multiple"   style="width:100px;"
        onchange="imagenSetUsers();" class="classImag" style="width:6cm;"  disabled="disabled"/></p>
    
        </td>
    </tr>
    <tr>    
        <td class="pregunta" align="right" style="border-top:1px solid #e5e5e5;">Tel&eacute;fono :</td>
        <td class="respuesta2" align="left" style="border-top:1px solid #e5e5e5;">
        <input {$privFace.input} class="input" size="40" type="text" style="width:95%;" name="telefonoPerf" id="telefonoPerf" value="{$item.telefono}"  
        disabled="disabled"  onkeypress="return soloNumerosPunto(event,this.value);"/><div id="errortele"></div>
        </td>        
    </tr>
    <tr>
        <td class="pregunta" align="right">Celular : </td>
        <td class="respuesta2" align="left"><input {$privFace.input} class="input" size="40" type="text" 
        name="celularPerf" style="width:95%;" id="celularPerf" value="{$item.celular}"  disabled="disabled"  
        onkeypress="return soloNumerosPunto(event,this.value);"/><div id="errorcelu"></div>
        </td>
    </tr>             
    <tr>
        <td class="pregunta" align="right">Email :</td>
        <td class="respuesta2" align="left">
        <input {$privFace.input} class="input" size="40" type="text" name="emailPerf" id="emailPerf"  style="width:95%;"
        value="{$item.email|escape:'htmlAll'}" disabled="disabled" /><div id="erroremai"></div>
        </td>        
    </tr>
    <tr>
        <td class="pregunta" align="right">Direcci&oacute;n :</td>
        <td class="respuesta2" align="left"><textarea class="input"  style="width:95%;"
        cols="38" id="resizablePerf" rows="5" cols="40" disabled="disabled">{$item.direccion|escape:'htmlAll'}</textarea>
        <div id="errordire"></div>
    </td>        
    </tr>        
    </table>
  {if $privFace.editar == true}
    <div align="center">
    <p class="alerta"  style="width:500px;" align="left">Nota:<br />
    - Para editar presion&eacute; Editar. Al editar solo se habilitara los campos que son editables<br />
    - Si desea cargar una nueva o sustituir una imagen existente, seleccione la imagen, s&oacute;lo admite los siguientes 
    formatos JPG o PNG.</p>
    <div id="estadoRegistrodosPerf"></div></div>
    <br />    
    <div align="center"><span class="classBoton" id="editss" onclick="editarDatosPersonalesPerf()">Editar</span>
    <span class="classBoton" id="guadarss" onclick="guardarDatosPersonalesPerf()" style="display:none">Guardar</span> &nbsp
    <span class="classBoton" id="cancelss" onclick="cancelDatosPersonalesPerf()" style="display:none">Cancelar</span>
    </div>
   {/if} 
    </div>
