{literal}
<script>
function cancelReg(type){
	if (type == 1)	
		msg = 'Esta seguro de cancelar el registro?<br> Recuerde que los datos no se guardaran';	
	else
		msg = 'Esta seguro de cancelar la actualización?<br> Recuerde que los datos no se actualizaran';
	parent.	Sexy.confirm(msg, {
	textBoxBtnOk: 'Si',
	textBoxBtnCancel: 'No',
	onComplete:function(returnvalue) {
		if(returnvalue){			
			parent.boxyWindows.hide();
			}
	}
	});
}

$(document).ready(function(){
    $('#user').change(function(){
        verifyUser();
    });
    function verifyUser(){
//        codeRight = 1;
        verifyProcess = 1;
        
        $('#msgUser').html('<div style="width:150px;background-color:#fffbe7;border:1px solid #fff372; padding:2px; margin:4px 2px;"><img src="images/loading/loading.gif" style="width:15px;"/>Verificando Usuario</div>');
        
        var id= $("#user").val();
        
        if($('#useruser').length >0){
          var luser = $("#useruser").val();    
        }else{
            var luser = null;
        }
        
        var url = '{/literal}{$getModule}{literal}&accion=verifyuser';
        
        $.ajax({ type: "POST",  
                 url: url,
                 data: "user="+id+"&luser="+luser,
                 success: function(msg){
                               if(msg == 1){
                                 $('#msgUser').html('<div style="width:150px;background-color:#ffccbc;border:1px solid #ff0000; padding:2px; margin:4px 2px;"><img src="template/user/images/icon/delete.gif" style="width:15px;"/>&nbsp;Usuario no disponible</div>');
                                 codeRight = 1;
                               }else if(msg == 0){
                                 
                                 $('#msgUser').html('<div style="width:150px;background-color:#e2ffdb;border:1px solid #51de31; padding:2px; margin:4px 2px;"><img src="template/user/images/icon/active.png" style="width:15px;"/>&nbsp;Usuario disponible</div>');
                                 codeRight = 0;
                               }else{
                                 $('#msgUser').html('<div style="width:150px;background-color:#ffccbc;border:1px solid #ff0000; padding:2px; margin:4px 2px;"><img src="template/user/images/icon/delete.gif" style="width:15px;"/>&nbsp;Usuario Invalido</div>');
                                 codeRight = 1;
                               }  
                               verifyProcess = 0;
                          }
                });
    }
})


</script>
{/literal}
<form enctype="multipart/form-data" method="POST" action="{$getModule}" id="itemForm">
<input type="hidden" name="accion" value="item{$accion}sql"/>
{if $accion eq "update"}
<input type="hidden" name="id" value="{$id}"/>
<input type="hidden" value="{$item.user}" id="useruser"/>
{/if}

<table cellpadding="0" cellspacing="0" border="0" width="100%">
<tr>
<td class="titulo1"> <img src="{$templateDir}images/icon/bullet3.gif"/> 
{if $accion eq "new"}
Nuevo Usuario
{else}
Actualizar Datos Usuario
{/if}</td>
<td class="titulo1" align="right"><input type="submit" value="Guardar" name="Guardar" class="boton"/></td>
<td class="titulo1" align="right">
<input type="button" onclick="cancelReg({if $accion eq 'new'}1{else}2{/if})" name="Cerrar" value="Cerrar" class="boton"/></td>
</tr>
</table>



<table  align='center' width="100%" cellpadding="0" cellspacing="0"id="formulario">
{if $accion neq "new"}
<tr>
	<td width="25%" class="pregunta">ID:</td>
	<td width="75%" align="left"  class="respuesta">{$id}</td>
</tr>
{/if}

{if $accion eq "new"}
<tr>
	<td class="pregunta">Usuario:</td>
	<td class="respuesta">
        <input style="width:97%;" type="text" id="user" name="item[user]" class="input" value="{$item.user}" />	
        <div id="msgUser" style=""></div>	
    </td>
</tr>
{else}
<tr>
	<td class="pregunta">Usuario:</td>
	<td align="left" class="respuesta">
        <b><font color="green">{$item.user}</font></b>
        
    </td>
</tr>
{/if}

{if $item.typeUser eq '' OR $item.typeUser eq 1 OR $item.typeUser eq 2}
<tr>
	<td class="pregunta" width="25%">Tipo de Usuario:</td>
	<td class="respuesta" width="75%">
    <select class="input" id="typeUser" name="item[typeUser]">
    {html_options options=$typeUserOption selected=$item.typeUser}
    </select>
    </td>
</tr>
{else}
<tr>
	<td class="pregunta" width="25%">Tipo de Usuario:</td>
	<td class="respuesta" width="75%"><font color="red"><b>Root</b></font>
    </td>
</tr>
{/if}

<tr>
	<td class="pregunta" width="25%">Nombres:</td>
	<td class="respuesta" width="75%"><input style="width:97%;" type="text" 
	id="name" name="item[name]" class="input" value="{$item.name}" />	</td>
</tr>
<tr>
	<td class="pregunta">Apellidos:</td>
	<td class="respuesta"><input style="width:97%;" type="text" 
	id="name" name="item[lastName]" class="input" value="{$item.lastName}" /></td>
</tr>

<tr>
	<td class="pregunta">Clave:</td>
	<td class="respuesta"><input style="width:97%;" type="text" id="password" name="item[password]" class="input" value="" />
	{if $accion eq "update"}
	<b>Nota: </b>
    Si desea cambiar la contraseña, por favor introduzca la contraseña nueva.
    <br />
    Si no desea cambiar la contraseña, deje este campo en blanco.
	{/if}	</td>
</tr>

<tr>
	<td class="pregunta">Tel&eacute;fonos:</td>
	<td class="respuesta"><input style="width:97%;" type="text" 
	id="phone" name="item[phone]" class="input" value="{$item.phone}" />	</td>
</tr>

<tr>
	<td class="pregunta">Email:</td>
	<td class="respuesta"><input style="width:97%;" type="text" 
	id="email" name="item[email]" class="input" value="{$item.email}" />	</td>
</tr>
<tr>
	<td class="pregunta">Direcci&oacute;n:</td>
    <td class="respuesta">  <input name="item[address]" type="text" class="input" id="address" style="width:97%;" value="{$item.address}" />	</td>
</tr>
<tr>
	<td class="pregunta">Fotograf&iacute;a:</td>
	<td class="respuesta">
         
    <input type="file" name="portada" id="portada" class="input"  onkeydown="return false;" class="texto" style="width:97%" />
    {if $item.portada eq 1}
		<img  vspace="5" hspace="5" align="right" src="data/{$module}/{$smoduleName}/portada/panel/{$id}.jpg?id={math equation='rand(10,100)'}" />
	{/if}
    
	<b>Nota: </b>Si desea cargar una nueva o sustituir una imagen existente, seleccione la imagen,
    sólo admiten <b>JPG o PNG.</b>
Si no quieres subir o reemplazar, asigne los campos en blanco.      </td>
</tr>
</table>
</form>
{literal}
<script>
var options = {  
	beforeSubmit:showRequest,
	iframe:true,
	success:showResponse
}; 
$('#itemForm').ajaxForm(options);
function verifica(){
	if($("#name").attr("value")==""){
		Sexy.alert('Ingrese nombres del usuario');
		return false;
	}if($("#lastName").attr("value")==""){
		Sexy.alert('Ingrese apellidos del usuario');
		return false;
	}{/literal}
        {if $accion eq "new"}{literal}
            else if($("#user").attr("value")==""){
    		  Sexy.alert('Ingrese nombre de usuario');
    		  return false;
	        }else if($("#password").attr("value")==""){
        		Sexy.alert('Ingrese clave del usuario');
        		return false;
	        }else if(verifyProcess){
                Sexy.alert('Aguarde la comprobaci&oacute;n del usuario');
        		return false;
            }else if(codeRight){
                Sexy.alert('Compruebe el nombre de usuario');
        		return false;
            }{/literal}
        {/if}{literal}else{
		var resp = verifyPortada();
		if (resp){
			boxyLoadingShow();
			return true;
		}
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
function showRequest(formData, jqForm, op) { 
	var res = verifica();
    return res; 
}
function showResponse(responseText, statusText)  { 
	parent.location.reload();
} 

</script>
{/literal}