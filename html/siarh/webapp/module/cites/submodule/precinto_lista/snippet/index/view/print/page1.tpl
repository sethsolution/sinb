<br><br><br><br><br><br>
<table  border="0.5" align="center">
    <tr>
        <td colspan="2" class="titulo01" style="border: 0px">Nro. de trámite: {$item.itemId}/{$dateprint|date_format:"%Y"} </td>
    </tr>
    <tr>
        <td style="border-bottom: 0px">Fecha  y hora de ingreso de trámite: </td>
        <td style="border-bottom: 0px"><strong> {$item.dateCreate} </strong></td>
    </tr>

    <tr>
        <td style="border-top: 0px">Nombre del trámite administrativo:</td>
        <td style="border-top: 0px"><strong>Solicitud de autorización de elaboración de PRECINTOS DE SEGURIDAD CITES.
            </strong></td>
    </tr>
    <tr>
        <td class="titulo01" colspan="2">SOLICITANTE</td>
    </tr>
    <tr>
        <td colspan="2" style="border-bottom: 0px">NOMBRES Y APELLIDOS:
            {$item.representante_legal_nombre}
        </td>
    </tr>
    <tr>
        <td colspan="2" style="border-top: 0px">EMPRESA/ASOCIACIÓN: {$item.empresa_nombre}</td>
    </tr>
    <tr>
        <td>Cantidad de PRECINTOS DE SEGURIDAD solicitados:</td>
        <td>{$item.cantidad}</td>
    </tr>
    <tr>
        <td>Gestión de la cosecha:</td>
        <td>{$item.gestion}</td>
    </tr>
    <tr>
        <td>Tipo de aprovechamiento:</td>
        <td>{if $item.tipo_aprovechamiento == 1} Silvestria {else} Zoocria {/if}</td>
    </tr>
    <tr>
        <td>Estado:</td>
        <td>{$item.estado}</td>
    </tr>
</table>
<br>
</div>
