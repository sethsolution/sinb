<div class="item-titulo">FICHA TECNICA</div>

<table class="item-tabla">
    <tr>
        <td class="item-tabla-titulo">Titulo</td>
        <td>{$item.nombre}</td>
    </tr>
    <tr>
        <td class="item-tabla-titulo">Codigo</td>
        <td>{$item.codigo}</td>
    </tr>
    <tr>
        <td class="item-tabla-titulo">Area tematica</td>
        <td>{$item.nombre_icas_area}</td>
    </tr>
    <tr>
        <td class="item-tabla-titulo">Estado</td>
        <td>{$item.nombre_icas_estado}</td>
    </tr>
    <tr>
        <td class="item-tabla-titulo">Fuente de financiamiento</td>
        <td>{$item.nombre_icas_fuente_financiamiento}</td>
    </tr>
    <tr>
        <td class="item-tabla-titulo">Otra fuente de financiamiento</td>
        <td>{$item.fuente_financiamiento_otro}</td>
    </tr>
    <tr>
        <td class="item-tabla-titulo">Fecha de inicio</td>
        <td>{$item.fecha_inicio|date_format:'%d/%m/%Y'}</td>
    </tr>
    <tr>
        <td class="item-tabla-titulo">Fecha de conclusión</td>
        <td>{$item.fecha_conclusion|date_format:'%d/%m/%Y'}</td>
    </tr>
    <tr>
        <td class="item-tabla-titulo">UBICACIÓN GEOGRAFICA</td>
        <td>
            Latitud: {$item.location_latitude_decimal}
            <br>Longitud: {$item.location_longitude_decimal}
        </td>
    </tr>
    <tr>
        <td class="item-tabla-titulo">Antecedentes y Justificacion</td>
        <td>{$item.antecedentes_justificacion}</td>
    </tr>
    <tr>
        <td class="item-tabla-titulo">Objetivo General</td>
        <td>{$item.objetivo_general}</td>
    </tr>
    <tr>
        <td class="item-tabla-titulo">Objetivos Especificos</td>
        <td>{$item.objetivos_especificos}</td>
    </tr>
    <tr>
        <td class="item-tabla-titulo">Resultados esperados</td>
        <td>{$item.resultados_esperados}</td>
    </tr>
</table>

<table class="item-tabla">
    <tr>
        <td colspan=3" class="item-tabla-titulo txtCenter">INSTITUCIONES</td>
    </tr>
    <tr>
        <td class="item-tabla-header">Nombre</td>
        <td class="item-tabla-header">Tipo Institucion</td>
        <td class="item-tabla-header">Direccion</td>
        <td class="item-tabla-header">Telefono</td>
    </tr>
    {foreach from=$item.instituciones item=row key=idx}
        <tr>
            <td>{$row.nombre|escape:"html"}</td>
            <td>{$row.nombre_icas_institucion_tipo|escape:"html"}</td>
            <td>{$row.direccion|escape:"html"}</td>
            <td>{$row.telefono|escape:"html"}</td>
        </tr>
    {/foreach}
</table>