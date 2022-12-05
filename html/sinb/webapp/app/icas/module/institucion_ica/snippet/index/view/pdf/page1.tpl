<div class="item-titulo">FICHA TECNICA</div>

<table class="item-tabla">
    <tr>
        <td class="item-tabla-titulo">Tipo Institucion</td>
        <td>{$item.tipo}</td>
    </tr>
    <tr>
        <td class="item-tabla-titulo">Nombre de la institucion</td>
        <td>{$item.nombre}</td>
    </tr>
    <tr>
        <td class="item-tabla-titulo">Responsable</td>
        <td>{$item.responsable}</td>
    </tr>
    <tr>
        <td class="item-tabla-titulo">Responsable operativo</td>
        <td>{$item.responsable_operativo}</td>
    </tr>
    <tr>
        <td class="item-tabla-titulo">Direccion</td>
        <td>{$item.direccion}</td>
    </tr>
    <tr>
        <td class="item-tabla-titulo">Telefono</td>
        <td>{$item.telefono}</td>
    </tr>
    <tr>
        <td class="item-tabla-titulo">Celular</td>
        <td>{$item.celular}</td>
    </tr>
    <tr>
        <td class="item-tabla-titulo">Fax</td>
        <td>{$item.fax}</td>
    </tr>
    <tr>
        <td class="item-tabla-titulo">Email</td>
        <td>{$item.email}</td>
    </tr>
    <tr>
        <td class="item-tabla-titulo">Web</td>
        <td>{$item.web}</td>
    </tr>
    <tr>
        <td class="item-tabla-titulo">Pais</td>
        <td>{$item.pais}</td>
    </tr>
    <tr>
        <td class="item-tabla-titulo">Departamento</td>
        <td>{$item.nombre_departamento}</td>
    </tr>
    <tr>
        <td class="item-tabla-titulo">Ciudad</td>
        <td>{$item.ciudad}</td>
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
        <td colspan=4" class="item-tabla-titulo txtCenter">ACREDITACIONES</td>
    </tr>
    <tr>
        <td class="item-tabla-header">Fecha Acreditación</td>
        <td class="item-tabla-header">Fecha Expiración</td>
        <td class="item-tabla-header">Descripción</td>
        <td class="item-tabla-header">Estado</td>
    </tr>
    {foreach from=$item.acreditacion item=row key=idx}
        <tr>
            <td align="center">{$row.fecha_acreditacion|date_format:'%d/%m/%Y'}</td>
            <td align="center">{$row.fecha_expiracion|date_format:'%d/%m/%Y'}</td>
            <td>{$row.descripcion|escape:"html"}</td>
            <td align="center">{if $row.estado == 1}Activo {else} Inactivo{/if}</td>
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
        <?php
            var size =  ($row.estado / (1024*1024)).toFixed(2)
        ?>
        <tr>
            <td>{$row.descripcion|escape:"html"}</td>
            <td align="center">{$row.attached_name|escape:"html"}</td>
            <td align="center">{$row.attached_size|escape:"html"}</td>
        </tr>
    {/foreach}
</table>