<div class="item-titulo">FICHA TECNICA</div>

<table class="item-tabla">
    <tr>
        <td class="item-tabla-titulo">Nombre</td>
        <td>{$item.nombre}</td>
    </tr>
    <tr>
        <td class="item-tabla-titulo">Codigo</td>
        <td>{$item.codigo}</td>
    </tr>
    <tr>
        <td class="item-tabla-titulo">Categoria</td>
        <td>{$item.nombre_categoria}</td>
    </tr>
    <tr>
        <td class="item-tabla-titulo">Responsable</td>
        <td>{$item.responsable}</td>
    </tr>
    <tr>
        <td class="item-tabla-titulo">Condicion</td>
        <td>{$item.condicion}</td>
    </tr>
    <tr>
        <td class="item-tabla-titulo">Departamento</td>
        <td>{$item.departamento}</td>
    </tr>
    <tr>
        <td class="item-tabla-titulo">Provincia</td>
        <td>{$item.provincia}</td>
    </tr>
    <tr>
        <td class="item-tabla-titulo">Municipio</td>
        <td>{$item.municipio}</td>
    </tr>
    <tr>
        <td class="item-tabla-titulo">Licencia de funcionamiento</td>
        <td>{$item.licencia_funcionamiento}</td>
    </tr>
    <tr>
        <td class="item-tabla-titulo">Formato</td>
        <td>{$item.formato}</td>
    </tr>
    <tr>
        <td class="item-tabla-titulo">Superficie</td>
        <td>{$item.superficie}</td>
    </tr>
    <tr>
        <td class="item-tabla-titulo">Fecha</td>
        <td>
            Emision: {$item.fecha_emision|date_format:'%d/%m/%Y'}
            <br>Conclusion: {$item.fecha_conclusion|date_format:'%d/%m/%Y'}
        </td>
    </tr>
    <tr>
        <td class="item-tabla-titulo">UBICACIÓN GEOGRAFICA</td>
        <td>
            Latitud: {$item.location_latitude_decimal}
            <br>Longitud: {$item.location_longitude_decimal}
        </td>
    </tr>
</table>
<table class="item-tabla">
    <tr>
        <td colspan="3" class="item-tabla-titulo txtCenter">REQUISITOS</td>
    </tr>
    <tr>
        <td class="item-tabla-header">Nombre</td>
        <td class="item-tabla-header">Documento</td>
        <td class="item-tabla-header">Tamaño</td>
    </tr>
    {foreach from=$item.requisitos item=row key=idx}
        <tr>
            <td>{$row.nombre|escape:"html"}</td>
            <td align="center">{$row.attached_name|escape:"html"}</td>
            <td align="center">{$row.attached_size|escape:"html"}</td>
        </tr>
    {/foreach}
</table>
<table class="item-tabla">
    <tr>
        <td colspan="3" class="item-tabla-titulo txtCenter">DOCUMENTOS ADJUNTOS</td>
    </tr>
    <tr>
        <td class="item-tabla-header">Descripción</td>
        <td class="item-tabla-header">Documento</td>
        <td class="item-tabla-header">Tamaño</td>
    </tr>
    {foreach from=$item.adjunto item=row key=idx}
        <tr>
            <td>{$row.descripcion|escape:"html"}</td>
            <td align="center">{$row.attached_name|escape:"html"}</td>
            <td align="center">{$row.attached_size|escape:"html"}</td>
        </tr>
    {/foreach}
</table>
<table class="item-tabla">
    <tr>
        <td colspan="4" class="item-tabla-titulo txtCenter">INFORMES</td>
    </tr>
    <tr>
        <td class="item-tabla-header">GESTION</td>
        <td class="item-tabla-header">TIPO ESPECIE</td>
        <td class="item-tabla-header">ESPECIE</td>
        <td class="item-tabla-header">TOTAL ALBERGADOS</td>
    </tr>
    {foreach from=$item.informe item=row key=idx}
        <tr>
            <td align="center">{$row.gestion_id|escape:"html"}</td>
            <td align="center">{$row.nombre_especie_tipo|escape:"html"}</td>
            <td align="center">{$row.especie|escape:"html"}</td>
            <td align="center">{$row.total_albergados|escape:"html"}</td>
        </tr>
    {/foreach}
</table>