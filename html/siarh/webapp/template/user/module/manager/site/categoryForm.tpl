
{literal}
<script>
function cancelReg(){
	Sexy.confirm("Are you sure you cancel the update of this user?<br>Remember that any data not saved", {
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
function calcula(){
	//alert($("deliverProcessPoolSize").value);
	$("registerProcessPoolSize").value = $("deliverProcessPoolSize").value / 4;
}
</script>
{/literal}

<center><span class="titulo1">
{if $accion eq "new"}
New Plan / Subcategory
{else}
Update Plan / Subcategory
{/if}
</span></center>
<table class="tabla01" align='center' cellpadding="0" cellpadding="0">
<form method="POST" action="{$getModule}" id="cateForm">
<input type="hidden" name="accion" value="category{$accion}sql"/>
<input type="Hidden" name="parent" id="parent" value="{$parent}"/>
{if $accion eq "update"}
<input type="hidden" name="id" value="{$id}"/>
{/if}

{if $accion eq "new"}

{else}
<tr>
	<td class="pregunta">ID</td>
	<td class="respuesta">{$id}</td>
</tr>
{/if}

<tr>
	<td class="pregunta">Name</td>
	<td class="respuesta"><input style="width:250px;" type="text" 
	id="name" name="item[name]" class="input" value="{$item.name}" />
	</td>
</tr>

<tr>
	<td class="pregunta">Description</td>
	<td class="respuesta">
	<textarea name="item[description]" class="input" id="description" style="width:100%;" rows="5">{$item.description}</textarea>	
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
<script>
var options = {  
	beforeSubmit:showRequest,
	success:showResponse
}; 
$('#cateForm').ajaxForm(options);

function verifica(){
	if($("#name").attr("value")==""){
		Sexy.alert('Enter name please');
		return false;
	}else{
		boxyLoadingShow();
		return true;
	}
	return false;
}

function showRequest(formData, jqForm, options) { 
	var res = verifica();
    return res; 
} 
function showResponse(responseText, statusText)  { 
    parent.location.reload();
} 
</script>
{/literal}