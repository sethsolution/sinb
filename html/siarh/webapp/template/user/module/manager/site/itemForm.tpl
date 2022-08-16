{literal}
<script>

function cancelReg(){
	Sexy.confirm("Are you sure you cancel register?<br>Remember that any data not saved", {
	textBoxBtnOk: 'Yes',
	textBoxBtnCancel: 'No',
	onComplete:function(returnvalue) {
		if(returnvalue){parent.hidePopWin();}
	}
	});
}

function cancelUpdate(){
	Sexy.confirm("Are you sure you cancel the update?<br>Remember that any data not saved", {
	textBoxBtnOk: 'Yes',
	textBoxBtnCancel: 'No',
	onComplete:function(returnvalue) {
		if(returnvalue){parent.hidePopWin();}
	}
	});
}

</script>
{/literal}


<table class="adminlist" align='center' width="97%" cellpadding="0" cellpadding="0" id="formulario">
<tr>
   <th class="titulo" colspan="2">
   {if $accion eq "new"}
New Item
{else}
Update Item
{/if}
   </th>
</tr>
<form enctype="multipart/form-data" method="POST" action="{$getModule}" id="itemForm">
<input type="hidden" name="accion" value="item{$accion}sql"/>
{if $accion eq "update"}
<input type="hidden" name="id" value="{$id}"/>
{/if}

{if $accion eq "new"}

{else}
<tr>
	<td class="label">ID</td>
	<td align="left">{$id}</td>
</tr>
{/if}

<tr>
	<td class="label">Titulo</td>
	<td><input style="width:100%;" type="text" 
	id="name" name="item[title]" class="input" value="{$item.title}" />
	</td>
</tr>
<tr>
	<td class="label">Url</td>
	<td><input style="width:100%;" type="text" 
	id="url" name="item[url]" class="input" value="{$item.url}" />
	</td>
</tr>

<tr>
	<td class="label">Palabras clave</td>
	<td><input style="width:100%;" type="text" 
	id="phone" name="item[keyword]" class="input" value="{$item.keyword}" />
	</td>
</tr>

<!--tr>
	<td class="label">Email</td>
	<td><input style="width:100%;" type="text" 
	id="email" name="item[email]" class="input" value="{$item.email}" />
	</td>
</tr-->
<tr>
	<td class="label">Responsable</td>
	<td align="left">
		<select name="item[memberId]" id="countryId" class="input">
		{html_options options=$countryList selected=$item.memberId}
		</select>
	</td>
</tr>

<tr>
	<td class="label" colspan="2">Description</td>
</tr>
<tr>
	<td class="label" colspan="2">
	<textarea name="item[description]" class="input" id="description" style="width:100%;" rows="4">{$item.description}</textarea>	
	</td>
</tr>

<tr>
	<td colspan="2" align="center"><input type="submit" value="Save" name="Guardar" class="boton"/>
	{if $accion eq "new"}
	<input type="button" onclick="cancelReg();" name="enviar" value="Cancel Register" class="boton"/>
	{else}
	<input type="button" onclick="cancelUpdate();" name="enviar" value="Cancel Update" class="boton"/>
	{/if}
	</td>
</tr>
</form>
</table>
{literal}
<script type="text/javascript" src="lib/fckeditor/fckeditor.js"></script>
<script>
var options = {  
	beforeSubmit:showRequest,
	iframe:true,
	success:showResponse
}; 
$('#itemForm').ajaxForm(options);
function verifica(){
	if($("#name").attr("value")==""){
		Sexy.alert('Enter names please');
		return false;
	}if($("#url").attr("value")==""){
		Sexy.alert('Enter Url please');
		return false;
	}else{
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
			Sexy.alert('the cover has an invalid extension: '+extension+'<br>only support JPG or PNG');
			return false;
		}else{
			return true;
		}
	}else{
		return true;
	}
}

function showRequest2(formData, jqForm, o) {
	//o.dataType = $('#itemForm')[2].value;
	var res = verifica();
    return res; 
}
function showRequest(formData, jqForm, op) { 
	//op.dataType = $('#itemForm')[3].value;
	var res = verifica();
    return res; 
}
function showResponse(responseText, statusText)  { 
	
/*var form = parent.document.formPrueba;
form.prueba.value =  $("#name").attr("value");
 parent.hidePopWin();	*/
parent.location.reload();

} 

</script>
{/literal}