<table cellpadding="0" cellspacing="0" width="100%" border="0">
<tr><td class="migaBar">
	<div id="pettabs" class="shadetabs">
	<ul>
	<li><a href="{$getModule}&parent="><img src="{$templateDir}images/icon/bullet.gif" /> Usuarios</a></li>	
	</ul>
	</div>

</td></tr>
</table>



{literal}
<script>
function search(){
	location = "{/literal}{$getModule}{literal}&q="+$("#q").attr("value");
	return false;
}
function itemUpdate(id,type){
	var w = 550;
    var h = 400;
    var scroll = 0;
    var url = '{/literal}{$getModule}&parent={$parent}{literal}&accion=itemUpdate&id='+id+'&type='+type;
    var f = iframeBox(url,w,h);
        
    html = "<div id=\"formContent\" style=\"width:"+w+"px;height:"+h+"px;\">"+f+"</div>";
    titlebox='Usuario';
	boxyWindows = new Boxy(html,{title:titlebox, modal: true,fixed:true,
					draggable:true,show:false,afterShow: function() {
						//alert("hola");
   					},closeable:false,unloadOnHide:true});
	boxyWindows.show();
}

function itemPrivileges(id){
    var w = 550;
    var h = 430;
    var scroll = 0;
    var url = '{/literal}{$getModule}&parent={$parent}{literal}&accion=itemPrivileges&id='+id;
    var f = iframeBox(url,w,h);
        
    html = "<div id=\"formContent\" style=\"width:"+w+"px;height:"+h+"px;\">"+f+"</div>";
    titlebox='Privilegios de acdeso del Usuario';
	boxyWindows = new Boxy(html,{title:titlebox, modal: true,fixed:true,
					draggable:true,show:false,afterShow: function() {
   					},closeable:false,unloadOnHide:true});
	boxyWindows.show();
}

function itemActivar(id,status){
	boxyLoadingShow();
	randomnumber=Math.floor(Math.random()*11);
	$.get("{/literal}{$getModule}{literal}",{accion:"itemStatus",
						random:randomnumber,
						id:id,
						status:status
						}, function(data){
							location.reload();					
		});
}
function deletePortada(id,data){

Sexy.confirm("Esta seguro de eliminar la fotografia del usuario?<br>Info<br><b>"+data+"</b>", {
	textBoxBtnOk: 'Si',
	textBoxBtnCancel: 'No',
	onComplete:function(returnvalue) {
		if(returnvalue){
			boxyLoadingShow();
			randomnumber=Math.floor(Math.random()*11);
			$.get("{/literal}{$getModule}{literal}",{accion:"itemDeletePortada",
								random:randomnumber,
								id:id
								}, function(data){
									location.reload();					
				});
				}
	}
	});
}
function itemDelete(id,data){
	Sexy.confirm("Esta seguro de eliminar los datos del usuario?<br>Info<br><b>"+data+"</b>", {
	textBoxBtnOk: 'Si',
	textBoxBtnCancel: 'No',
	onComplete:function(returnvalue) {
		if(returnvalue){itemDeleteAction(id);}
	}
	});
}

function itemDeleteAction(id){
	randomnumber=Math.floor(Math.random()*11);
		$.get("{/literal}{$getModule}{literal}",{accion:"itemDelete",
						random:randomnumber,
						id:id
						}, function(data){
							location.reload();
							//alert(data);					
		});
}
</script>
{/literal}

<table cellpadding="0" cellspacing="0" border="0" width="100%">
<tr>
<td width="6%" class="titulo2"> <img src="{$templateDir}images/icon/bullet3.gif"/> Lista de Usuarios</td>
<td width="77%"  nowrap="nowrap" align="left" class="titulo2"><form id="itemForm" onsubmit="return search();">
	Buscador<input type="text" class="input" name="q" id="q" value="{$q}"/>
	<input type="button" name="Search" value="Buscar" class="boton" onclick="search();" />
	</form></td>
<td width="17%" align="right" class="titulo2">
<input type="button" onclick="itemUpdate('','new');" name="new" value="Nuevo Usuario" class="boton"/></td>
</tr>
</table>
<div id="gallery">
<table width="100%" border="0" cellspacing="0" cellpadding="0" class="adminlist"> 
	{if $itemConte[0].id neq ''} 
    <tr>
      <th width="20" id="tl">#</th>
      <th>Usuario</th>
      <th>Tipo Usuario</th>
      <th width="70">Foto</th>

      <th>Nombres y Apellidos</th>
      <th>Tel&eacute;fonos</th>
      <th>E-mail</th>
      <th width="70">Activo</th>
      <th width="70">Acci&oacute;n</th>
    </tr>
    <tbody class="scrollContent3">
    {section name=i loop=$itemConte}
	<tr class="{$itemConte[i].class}">
	    <td align="center">{$itemConte[i].numero}</td>
	    <td >
        <img src="{$templateDir}images/icon/user.png" />
        <b><font color="green">{$itemConte[i].user}</font></b></td>
	    <td>
        
        {if $itemConte[i].typeUser eq 0}
        <b><font color="red">Root</font></b>
        {elseif $itemConte[i].typeUser eq 1}
        <b>Administrador</b>
        {else}
        Normal
        {/if}
        
        
        </td>
        <td align="center">
		{if $itemConte[i].portada eq 1}
		<a href="data/{$module}/{$smoduleName}/portada/medium/{$itemConte[i].id}.jpg?id={math equation='rand(10,100)'}" title="{$itemConte[i].title}" class="lightbox">
		<img src="data/{$module}/{$smoduleName}/portada/panel/{$itemConte[i].id}.jpg?id={math equation='rand(10,100)'}" /></a>
		<a href="#" title="Delete Portada" onclick="deletePortada({$itemConte[i].id},'{$itemConte[i].name} {$itemConte[i].lastName}');">
	 <img src='{$templateDir}/images/icon/delete.png' title="Eliminar Fotografia" border="0" /></a>
		{/if}&nbsp;		
		</td>

    	<td align="left">{$itemConte[i].name} {$itemConte[i].lastName}</td>
		<td>{$itemConte[i].phone}&nbsp;</td>
		<td>{$itemConte[i].email}&nbsp;</td>
    	<td align="center">
              
             {if $itemConte[i].active eq 1}
             <a class="toolbar"  href="javascript:itemActivar({$itemConte[i].id},0)">
             <img src='{$templateDir}/images/icon/active.png'  title="Activo" border="0"/>
             {else}
             <a class="toolbar"  href="javascript:itemActivar({$itemConte[i].id},1)">
              <img src='{$templateDir}/images/icon/deactive.png' title="No Activo" border="0" />
            {/if}</a></td>
        <td align="right">
        
        {if $itemConte[i].typeUser neq 0 && $itemConte[i].typeUser neq 1}
        <a href="#" onclick="itemPrivileges({$itemConte[i].id})" title="Accesos de usuario"><img 
        src='{$templateDir}/images/icon/key.gif' border="0" title="Accesos de usuario"/></a>
        {/if}
        
        <a href="#" onclick="itemUpdate({$itemConte[i].id},'update')" >
        <img src='{$templateDir}/images/icon/modificar.gif' border="0" title="Editar Datos Usuario"/></a>
		
        {if $itemConte[i].typeUser neq 0}
        <a href="#" onclick="itemDelete({$itemConte[i].id},'{$itemConte[i].name} {$itemConte[i].lastName}')">
		<img src='{$templateDir}/images/icon/delete.png' title="Quitar Usuario" border="0" /></a>
        {/if}
		&nbsp;
        </td>
	</tr>
    {/section}
	<tr>
	<td id="paginador" class="paginador" colspan="9" align="right">{$navegacionConte}</td>
	</tr>
	{else}
    	<td class="norecord">No records</td>
    {/if}
  </table>
</div>