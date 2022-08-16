
<form enctype="multipart/form-data" method="POST" action="{$getModule}" id="itemFormEdiProfile" onsubmit="return verifica();">
  <input type="hidden" name="accion" value="updateProfile" />
    <table>
        <tr>
            <td class="dataProfile" width="20%" rowspan="9" align="center"><br />
              <img src="data/{$module}/user/portada/small/{$itemConte.memberId}.jpg?id={math equation='rand(10,100)'}" class="photoProfile" />
              <input type="file" name="portada" class="dataProfileItem" id="portada" />  
              
              <b>Nota: </b>Si desea cargar una nueva o sustituir una imagen existente, seleccione la imagen,
              s&oacute;lo admiten <b>JPG o PNG.</b>
    
            </td>
            <td class="dataProfile" width="23%" align="right">
                <b>Nombre(s) y apellido(s):&nbsp;</b>
            </td><td class="dataProfile" >    
            <input type="text" value="{$itemConte.name}" name="profile[name]" class="dataProfileItem" id="name"/>&nbsp;
            <input type="text" value="{$itemConte.lastName}" name="profile[lastName]" class="dataProfileItem" id="lastName"/>
          </td>
        </tr>
        <tr>
            <td class="dataProfile" align="right">
                <b>Tel&eacute;fono:</b>
            </td><td class="dataProfile" >
                <input type="text" value="{$itemConte.phone}" name="profile[phone]" class="dataProfileItem"/>        
            </td>
        </tr>
  
        <tr>
            <td class="dataProfile" align="right">
                <b>Celular:</b>
            </td><td class="dataProfile" >  
                <input type="text" value="{$itemConte.mobile}" name="profile[mobile]" class="dataProfileItem"/>      
            </td>
        </tr>
  
        <tr>
            <td class="dataProfile" align="right">
                <b>E-mail:</b>
            </td><td class="dataProfile" >  
                <input type="text" value="{$itemConte.email}" name="profile[email]" class="dataProfileItem"/>    
            </td>
        </tr>       
        
        <tr>
          <td class="dataProfile" align="right">
            <b>Direcci&oacute;n:</b>
          </td><td class="dataProfile" >  
            <input type="text" value="{$itemConte.address}" name="profile[address]" class="dataProfileItem"/>   
          </td>
        </tr>  
        
        <tr>
            <td class="dataProfile" align="right">
                <b>Usuario:</b>
            </td><td class="dataProfile" >  
                {$itemConte.user}
            </td>
        </tr> 
        
        <tr>
          <td class="dataProfile" align="right">
            <b>Tipo de usuario:</b>
          </td><td class="dataProfile" >  
            {if $itemConte.typeUser eq 0 OR $itemConte.typeUser eq 1}
              Administrador
            {elseif $itemConte.typeUser eq 2}
              Usuario normal
            {elseif $itemConte.typeUser eq 3}
              Dealer
            {/if}  
          </td>
        </tr> 
        
        <tr>
            <td class="dataProfile" align="right">
                <b>Contrase&ntilde;a:</b>
            </td><td class="dataProfile">  
                <input type="password" value="" name="profile[password]" class="dataProfileItem" id="passwordProfile"/>        
            </td>
        </tr> 
          
        <tr>
            <td class="dataProfile" align="right">
                <b>Confirmar Contrase&ntilde;a:</b>
            </td><td class="dataProfile">
                <input type="password" value="" class="dataProfileItem" id="passwordProfile2" />        
            </td>
        </tr>
        <tr>
            <td align="right">
                <input type="submit" value="Guardar" />
            </td>
            <td align="left">    
                <input type="button" value="Cancelar" onclick="cancelEdit();" />
            </td>
        </tr>  
      </table>
</form>

{literal}
  <script>
    
    function verifica(){
	  if($("#name").attr("value")==""){
        Sexy.alert('Ingrese nombres del usuario');
		return false;
	  }if($("#lastName").attr("value")==""){	
        Sexy.alert('Ingrese apellidos del usuario');
		return false;  
	  }if( ($("#passwordProfile").attr("value") != '') || ($("#passwordProfile2").attr("value") != '')){
        var pasw1 = $("#passwordProfile").attr("value");
        var pasw2 = $("#passwordProfile2").attr("value");
        if(pasw1 != pasw2){
          Sexy.alert('Las contrase&ntilde;as introducidas no coninciden');
		  return false;
        }
      }
      var resp = verifyPortada();
	  if (resp){
		boxyLoadingShow();
		return true;
	  }
	return false;
}

function verifyPortada(){
	if($("#portada").attr("value")!=""){
		var archivo = $("#portada").attr("value");
		var extension = (archivo.substring(archivo.lastIndexOf("."))).toLowerCase();
		if (extension != '.jpg' && extension != '.png') {
			Sexy.alert('Extension no valida: '+extension+'<br>Solo soporta JPG o PNG');
			return false;
		}else{
			return true;
		}
	}else{
		return true;
	}
}   

</script>
{/literal}