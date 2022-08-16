{literal}
<script>
function itemUpdate(id,type){
	showPopWin('{/literal}{$getModule}&parent={$parent}{literal}&accion=itemUpdate&id='+id+'&type='+type, 540, 310, null,true,true);
}
function itemAddCourse(id)
{
	showPopWin('{/literal}{$getModule}&parent={$parent}{literal}&accion=newCourse&id='+id, 540, 300, null,true,true);
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
function deletePortada(id){
	boxyLoadingShow();
	randomnumber=Math.floor(Math.random()*11);
	$.get("{/literal}{$getModule}{literal}",{accion:"itemDeletePortada",
						random:randomnumber,
						id:id
						}, function(data){
							location.reload();					
		});
}
function deleteFileAction(id){
	boxyLoadingShow();
	randomnumber=Math.floor(Math.random()*11);
	$.get("{/literal}{$getModule}{literal}",{accion:"itemDeleteFile",
						random:randomnumber,
						id:id
						}, function(data){
							location.reload();					
		});
}
function deleteFile(id)
{
	Sexy.confirm("Are you sure you want to delete this record?<br>Info", {
	textBoxBtnOk: 'Yes',
	textBoxBtnCancel: 'No',
	onComplete:function(returnvalue) {
		if(returnvalue){deleteFileAction(id);}
	}
	});
}
function itemDelete(id,data){
	Sexy.confirm("Are you sure you want to delete this record?<br>Info<br><b>"+data+"</b>", {
	textBoxBtnOk: 'Yes',
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



<div class="titulo1"><b>Lista de Sitios Web</b></div>
<div id="gallery">
<table width="100%" border="0" cellspacing="0" cellpadding="0" class="adminlist"> 
<tr>
	<td colspan="7" align="right" valign="middle">
	<input type="button" onclick="itemUpdate('','new');" name="new" value="Nuevo Sitio Web" class="boton"/>
	Presione Nuevo Sitio Web	</td>
</tr> 
	{if $itemConte[0].id neq ''} 
    <tr>
      <th width="20" id="tl">#</th>
      <th width="70">Foto</th>

      <th>Titulo</th>
      <th>Url</th>
      <th>Responsable</th>
      <th width="70">Activo</th>
      <th width="70">Accion</th>
    </tr>
    <tbody class="scrollContent3">
    {section name=i loop=$itemConte}
	<tr class="{$itemConte[i].class}">
	    <td align="center">{$itemConte[i].numero}</td>
	    <td align="center">
		{if $itemConte[i].portada eq 1}
		<a href="data/{$module}/{$smoduleName}/portada/medium/m_{$itemConte[i].id}.jpg?id={math equation='rand(10,100)'}" title="{$itemConte[i].title}" class="lightbox">
		<img src="data/{$module}/{$smoduleName}/portada/zpanel/zp_{$itemConte[i].id}.jpg?id={math equation='rand(10,100)'}" /></a>
		<a href="#" title="Delete Portada" onclick="deletePortada({$itemConte[i].id});">
		<img src="{$templateDir}/dibu/ico/delete.gif" alt="delete Portada" /></a>
		{/if}&nbsp;		</td>

    	<td align="left">{$itemConte[i].title}<br /></td>
		<td>{$itemConte[i].url}&nbsp;</td>
		<td>{$itemConte[i].name}&nbsp;{$itemConte[i].lastName}</td>
    	<td align="center">
              
             {if $itemConte[i].active eq 1}
             <a class="toolbar"  href="javascript:itemActivar({$itemConte[i].id},0)">
             <img src='{$templateDir}/dibu/boton/accept.png'  title="Publicado"/> 
             {else}
             <a class="toolbar"  href="javascript:itemActivar({$itemConte[i].id},1)">
             <img src='{$templateDir}/dibu/boton/delete.png' title="No Publicado"/> 
            {/if}</a></td>
        <td align="center">
        <a href="#" onclick="itemUpdate({$itemConte[i].id},'update')"><img src='{$templateDir}/dibu/ico/modificar.gif' border="0" title="Update Item"/></a>
		<a href="#" onclick="itemDelete({$itemConte[i].id},'{$itemConte[i].name} {$itemConte[i].lastName}')" title="Delete Item">
			<img src='{$templateDir}/dibu/ico/delete.gif' title="Delete Item" border="0" /></a>		</td>
		</tr>
    {/section}
	<tr>
	<td id="paginador" class="paginador" colspan="7" align="right">{$navegacionConte}</td>
	</tr>
	{else}
    	<td class="norecord">No records</td>
    {/if}
  </table>


</div>
