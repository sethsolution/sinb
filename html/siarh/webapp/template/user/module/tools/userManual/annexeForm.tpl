{literal}
  <script>  
    function cancelReg(){
      parent.boxyWindows.hide();
    }
</script>
{/literal}


<form method="post" action="{$getModule}" id="itemForm">
    <input type="hidden" name="idSystem" value="{$idSystem}"/>
    {if $accion eq "update"}
      <input type="hidden" name="idannexe" value="{$item.itemId}"/>
      <input type="hidden" name="accion" value="itemUpdateAnnexesql"/>
    {else}
      <input type="hidden" name="accion" value="itemSaveAnnexesql"/>
    {/if}

    <table cellpadding="0" cellspacing="0" border="0" width="100%">
      <tr>
        <td class="titulo2"> 
          <img src="{$templateDir}images/icon/bullet3.gif"/> 
          {if $accion eq "new"}
            Nuevo Anexo
          {else}
            Actualizar Anexo
          {/if}
        </td>
        <td class="titulo2"> <input type="submit" value="Guardar" name="Guardar" class="boton"/> </td>
        <td class="titulo2" align="right">
	      <input type="button" onclick="cancelReg();" name="enviar" value="Cerrar" class="boton"/>
        </td>
      </tr>
    </table>

    <table align='center' width="100%"   cellspacing="0" cellpadding="0" id="formulario">
      <tr>
        <td class="pregunta">Nombre:&nbsp;</td>
        <td class="respuesta">
          <input type="text" id="nameAnnexe" name="item[name]" style="width:95%;" class="input" value="{$item.name|escape:"htmlall"}" />
        </td>
      </tr>
      <tr>
	    <td class="pregunta">Descripci&oacute;n:&nbsp;</td>
	    <td class="respuesta">
          <textarea name="item[description]" id="descrptionAnnexe" style="width:95%;" class="input">{$item.description}</textarea>
	    </td>
      </tr>
      <tr>
	    <td class="pregunta">Archivo:</td>
	    <td class="respuesta">
          <input type="file" name="adjunto" class="input" id="fileAnnexe" />      
	    </td>
      </tr>
    </table>
</form>

{literal}
<script>
var options = {  
	beforeSubmit:showRequest,
	success:showResponse
}; 
$('#itemForm').ajaxForm(options);

function verifica(){
    
    if($("#nameAnnexe").attr("value")==""){
		parent.Sexy.alert('Ingrese el nombre de la fuente');
		return false;
	}else if (($("#descrptionAnnexe").attr("value")=="")){
		parent.Sexy.alert('Ingrese informaci&oacute;n del documento');
		return false;
	}else{
	    parent.boxyLoadingShow();
        return true;   
	}	
	return false;
}

function showRequest(formData, jqForm, options) { 
	var res = verifica();
    return res; 
} 
function showResponse(responseText, statusText)  {
    urlvar = "{/literal}{$getModuleOnly}{literal}&smodule=userManual&accion=itemUpdate&id={/literal}{$idSystem}{literal}&type=update";
    urlvar += "&optab=7";
    parent.location = urlvar 
}
</script>
{/literal}