<div class="item-titulo">FICHA TECNICA</div>

<table class="item-tabla">
    <tr>
        <td class="item-tabla-titulo">Red</td>
        <td>{$item.red}</td>
    </tr>
    <tr>
        <td class="item-tabla-titulo">Nombre de la empresa/Razón social</td>
        <td>{$item.nombre}</td>
    </tr>
    <tr>
        <td class="item-tabla-titulo">NIT</td>
        <td>{$item.nit}</td>
    </tr>
    <tr>
        <td class="item-tabla-titulo">Representante legal</td>
        <td>{$item.representante_legal}</td>
    </tr>
    <tr>
        <td class="item-tabla-titulo">Código Actividad(es)</td>
        <td>
            {foreach from=$item.codigo_actividad item=row key=idx}
                |   {$row.codigo|escape:"html"}
            {/foreach}
        </td>
    </tr>
    <tr>
        <td class="item-tabla-titulo">Actividad</td>
        <td>{$item.actividad}</td>
    </tr>
    <tr>
        <td class="item-tabla-titulo">Departamento</td>
        <td>{$item.departamento}</td>
    </tr>
    <tr>
        <td class="item-tabla-titulo">Dirección</td>
        <td>{$item.direccion}</td>
    </tr>
    <tr>
        <td class="item-tabla-titulo">Telefono</td>
        <td>{$item.telefono}</td>
    </tr>
    <tr>
        <td class="item-tabla-titulo">Email</td>
        <td>{$item.email}</td>
    </tr>
    <tr>
        <td class="item-tabla-titulo">Fecha Inscripción</td>
        <td>{$item.fecha_inscripcion|date_format:'%d/%m/%Y'}</td>
    </tr>
    <tr>
        <td class="item-tabla-titulo">Fecha Expiración</td>
        <td>{$item.fecha_expiracion|date_format:'%d/%m/%Y'}</td>
    </tr>
    <tr>
        <td class="item-tabla-titulo">UBICACIÓN GEOGRAFICA</td>
        <td>
            Latitud: {$item.location_latitude_decimal}
            <br>Longitud: {$item.location_longitude_decimal}
        </td>
    </tr>
    <tr>
        <td class="item-tabla-titulo">Cometarios</td>
        <td>{$item.comentario}</td>
    </tr>
    <tr>
        <td class="item-tabla-titulo">Cometarios y/u Observaciones</td>
        <td>{$item.comentario_observaciones}</td>
    </tr>
</table>

<table class="item-tabla">
    <tr>
        <td colspan=3" class="item-tabla-titulo txtCenter">INSCRIPCIONES</td>
    </tr>
    <tr>
        <td class="item-tabla-header">Fecha Inscripción</td>
        <td class="item-tabla-header">Fecha Expiración</td>
        <td class="item-tabla-header">Fecha Descripcion</td>
    </tr>
    {foreach from=$item.inscripcion item=row key=idx}
        <tr>
            <td align="center">{$row.fecha_inscripcion|date_format:'%d/%m/%Y'}</td>
            <td align="center">{$row.fecha_expiracion|date_format:'%d/%m/%Y'}</td>
            <td>{$row.descripcion|escape:"html"}</td>
        </tr>
    {/foreach}
</table>

<table class="item-tabla">
    <tr>
        <td colspan=4" class="item-tabla-titulo txtCenter">CUPOS</td>
    </tr>
    <tr>
        <td class="item-tabla-header">Gestión</td>
        <td class="item-tabla-header">Cupos autorizado</td>
        <td class="item-tabla-header">Cupos utilizado</td>
        <td class="item-tabla-header">Descripción</td>
    </tr>
    {foreach from=$item.cupo item=row key=idx}
        <tr>
            <td align="center">{$row.gestion_id|escape:"html"}</td>
            <td align="center">{$row.cupos_autorizado|escape:"html"}</td>
            <td align="center">{$row.cupos_utilizado|escape:"html"}</td>
            <td>{$row.descripcion|escape:"html"}</td>
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