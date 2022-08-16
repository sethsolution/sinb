{literal}

{/literal}

<!--------------------- miga de pan --------------------->
<div id="pettabs" class="shadetabs">
<ul>
<li><a href="{$getModule}&parent=" class="selected">Home</a></li>
</ul>
</div>
<!--------------------- miga de pan --------------------->
<!--------------------- Titulo --------------------->
<div class="titulo1">Buscar Sitio Web</div>

<!--------------------- Titulo --------------------->
{literal}
<script>
function search(){
	location = "{/literal}{$getModule}{literal}&q="+$("#q").attr("value");
	return false;
}
</script>
{/literal}
<center>
<table class="adminlist" align='center' cellpadding="0" cellpadding="0" >
<tr>
	<td align="center" valign="middle">
	<form id="itemForm" onsubmit="return search();">
	<input type="text" class="input" name="q" id="q" value="{$q}"/>
	<input type="button" name="Search" value="Search" class="boton" onclick="search();" />
	</form>

	</td>
</tr>
</table>
</center>
{include file="$templateDirModule/site/itemList.tpl"} 
