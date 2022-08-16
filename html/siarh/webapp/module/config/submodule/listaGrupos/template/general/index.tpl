<form enctype="multipart/form-data" method="POST" action="{$getModule}" 
id="itemFormGral" autocomplete="off">

<table style="width:100%;padding:0px;border-spacing: 0px;">
<tr>
    <td class="titulo2">
        <img src="{$templateDir}images/icon/bullet3.gif"/> Datos de la cuenta de grupos
        {if $accion != "new"}: ID = {$id} {/if}
    </td>
    <td class="titulo2" nowrap="nowrap">
         {if $privFace.editar == true || $privFace.crear == true}
           <input type="submit" value="Guardar" class="boton"/>
         {/if}
    </td>
</tr>
</table>  


<fieldset class="fieldForm" >
<legend >Datos de grupo</legend>
    
<table style="width:100%;padding:0px;border-spacing: 0px;">
{foreach from=$listDataPersonal item=row key=idx name=personal}
{if $idx != 3}
<tr>
    <td class="pregunta {if $idx == 1}lt{/if}"
    {if $smarty.foreach.personal.iteration == 1}style="width:200px;"{/if}>
        {$row.descripcion|escape:"htmlall"}:
    </td>
    <td class="respuesta {if $idx == 1}lt{/if} ld" >
        {if $row.tipoInput == 'text' || $row.tipoInput == 'number' || $row.tipoInput == 'decimal'}
            <input type="text" class="input" 
            name="item[{$row.campo}]" id="form_{$row.campo}" {$privFace.input} 
            value="{$item[$row.campo]|escape:"htmlall"}" style="width:97%;" 
        {if $row.tipoInput == 'number'} onkeypress="return soloNumeros(event,this.value);"
        {elseif $row.tipoInput == 'decimal'} onkeypress="return soloNumerosPunto(event,this.value);"
    {/if} />
    {elseif $row.tipoInput == 'select'}
    <select class="input" name="item[{$row.campo}]" id="form_{$row.campo}" {$privFace.input}>
    {html_options options=$listCatalogo.$idx selected=$item[$row.campo]}
    </select>
    {/if}
    </td>
</tr>
{/if}             
{/foreach}

</table>
</fieldset>

{if $accion != "new"}
<fieldset class="fieldForm" >
<legend >Asignaci&oacute;n Masiva</legend>
<table style="width:100%;padding:0px;border-spacing: 0px;">
<tr>
    <td class="pregunta lt " style="width:200px;">Asignaci&oacute;n Masiva: </td>
    <td class="respuesta lt ld" >
    <input  type="button" value="Asignar permisos de acceso de forma  masiva" 
    class="boton" onclick="copiarMasiva({$id})"/>
    
        <div class="msghelp">
        <b>Nota:</b> Puede utilizar esta opci&oacute;n
        para asignar permisos de forma masiva a todos los usuarios que esten dentro de este 
        grupo.
        <br /><br />
        <b>RECUERDE</b> que al momento de asignar masivamente los permisos, 
        se <b>BORRARAN</b> cualquier configuraci&oacute;n
        previa de cada uno de los usuarios.
        </div>
                    
    </td>
    </tr>

</table>
</fieldset>  

{/if}
</form>

{include file="general/index.js.tpl"}
{include file="general/index.css.tpl"}