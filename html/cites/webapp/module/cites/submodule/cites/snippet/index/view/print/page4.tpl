<div class="header_title2">DOCUMENTOS DE RESPALDO</div>
<table>
    {if $adjuntos|@count gt 0}
    <tr>
        <td class="pregunta2" style="width: 150px">Nombre: &nbsp;</td>
        <td class="pregunta2">Descripcion:</td>
        <td class="pregunta2" style="width: 170px">Archivo: &nbsp;</td>
        <td class="pregunta2" style="width: 50px">Tamaño:</td>
    </tr>
        {foreach from=$adjuntos item=fila}
            <tr>
                <td class="respuesta">{$fila.nombre}</td>
                <td class="respuesta">{$fila.descripcion}</td>
                <td class="respuesta">{$fila.adjunto_nombre}</td>
                <td class="respuesta">{($fila.adjunto_tamano/1024/1024)|number_format:2:'.':''} Mb.</td>
            </tr>
        {/foreach}
    {else}
        <tr><td colspan="4" class="respuesta2">No existe documentación adjunta</td></tr>
    {/if}
    <br>
</table>