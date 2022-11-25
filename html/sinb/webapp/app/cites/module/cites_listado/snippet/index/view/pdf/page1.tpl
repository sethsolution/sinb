<div class="item-titulo">FICHA TECNICA</div>

<table class="item-tabla">
    <tr>
        <td class="item-tabla-titulo">Fecha</td>
        <td>{$item.fecha}</td>
    </tr>
    <tr>
        <td class="item-tabla-titulo">Tipo Documento</td>
        <td>{$item.nombre_cites_tipo_documento}</td>
    </tr>
    <tr>
        <td class="item-tabla-titulo">Exportador</td>
        <td>{$item.exportador}</td>
    </tr>
    <tr>
        <td class="item-tabla-titulo">Destinatario</td>
        <td>{$item.destinatario}</td>
    </tr>
    <tr>
        <td class="item-tabla-titulo">Proposito</td>
        <td>{$item.nombre_cites_proposito}</td>
    </tr>
    <tr>
        <td class="item-tabla-titulo">Fecha valido</td>
        <td>{$item.fecha_valido|date_format:'%d/%m/%Y'}</td>
    </tr>
    <tr>
        <td class="item-tabla-titulo">Observacion</td>
        <td>{$item.observacion}</td>
    </tr>
</table>
<table class="item-tabla">
    <tr>
        <td colspan=4" class="item-tabla-titulo txtCenter">ESPECIES CITES</td>
    </tr>
    <tr>
        <td class="item-tabla-header apendice">Apendice</td>
        <td class="item-tabla-header">Nombre Comercial/Nombre Cientifico</td>
        <td class="item-tabla-header">Cantidad - Unidad</td>
        <td class="item-tabla-header">Origen</td>
    </tr>
    {foreach from=$item.especie item=row key=idx}
        <tr>
            <td align="center">{$row.nombre_apendice|escape:"html"}</td>
            <td align="center">{$row.nombre_comercial|escape:"html"} - {$row.nombre_cientifico|escape:"html"}</td>
            <td align="center">{$row.cantidad|escape:"html"} - {$row.nombre_unidad|escape:"html"}</td>
            <td align="center">{$row.nombre_origen|escape:"html"}</td>
        </tr>
    {/foreach}
</table>
<table class="item-tabla">
    <tr>
        <td colspan=3" class="item-tabla-titulo txtCenter">DOCUMENTOS ADJUNTOS</td>
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