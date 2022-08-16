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

</script>
{/literal}
<form enctype="multipart/form-data" method="POST" action="{$getModule}" id="itemForm">
<input type="hidden" name="accion" value="itemPrivilegesSql"/>
<input type="hidden" name="id" value="{$id}"/>




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

<table cellpadding="0" cellspacing="0" border="0" width="100%">
<tr>
<td class="titulo2" style="background:#f0f0f0;border-bottom:1px solid #9d9d9d;">

Nombre: <font style="font-weight:normal;">{$item.name} {$item.lastName}</font>
Usuario: <font style="font-weight:normal;">{$item.user}</font>
<br />

</td>
</tr>
</table>

<div id="cajap">
{section name=i loop=$mL}
<table cellpadding="0" cellspacing="0" border="0" width="100%">
<tr>
<td class="titulo2">
<img src="{$templateDir}images/icon/bullet3.gif"/> &nbsp; {$mL[i].name}
</td></tr>
</table>
    {section name=g loop= $mL[i].subModule}
        <table width="100%" border="0" cellspacing="0" cellpadding="0" class="adminlist"> 
        <tr>
            <th width="20" id="tl">&nbsp;</th>
            <th align="left">
            <img src="{$templateDir}images/icon/bullet3.gif"/> &nbsp; {$mL[i].subModule[g].name}
            </th>
         </tr>
         {section name=z loop= $mL[i].subModule[g].sisModule}
         <tr>
            <td></td>
            <td>
            <input {if $mL[i].subModule[g].sisModule[z].sel eq 1}checked="1"{/if}  
            type="checkbox" name="resPriv[]" value="{$mL[i].subModule[g].sisModule[z].subModuleId}" />
            &nbsp; {$mL[i].subModule[g].sisModule[z].name}
            </td>
         </tr>
         {/section}
         </table>
    {/section}
{/section}
</div>


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
	boxyLoadingShow();
	return true;
}
function showRequest(formData, jqForm, op) { 
	var res = verifica();
    return res; 
}
function showResponse(responseText, statusText)  { 
    //alert(responseText);
	parent.location.reload();
} 

</script>
{/literal}