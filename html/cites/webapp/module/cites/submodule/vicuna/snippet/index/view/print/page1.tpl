<div class="header_title2">NOTIFICACIÓN DE INICIO TRÁMITE</div>
<br>
<table  border="0.5" align="center">
    <tr>
        <td class="titulo01" colspan="2" style="border: 0px">SOLICITANTE</td>
    </tr>
    <tr>
        <td colspan="2" class="titulo01" style="border: 0px">Nro. de trámite: {$item.itemId}/2020 </td>
    </tr>
    <tr>
        <td style="border-bottom: 0px">Fecha  y hora de ingreso de trámite: </td>
        <td style="border-bottom: 0px"><strong> {$item.dateCreate|date_format:"%d/%m/%Y %H:%M:%S" } </strong></td>
    </tr>

    <tr>
        <td style="border-top: 0px">Nombre del trámite administrativo:</td>
        <td style="border-top: 0px"><strong> Solicitud de LICENCIA DE USO DE MARCA VICUÑA, gestión 2020. </strong></td>
    </tr>
    <tr>
        <td class="titulo01" colspan="2">SOLICITANTE</td>
    </tr>
    <tr>
        <td colspan="2" style="border-bottom: 0px">NOMBRES Y APELLIDOS:
            {$item.representante_legal_nombre}
            {$item.representante_legal_paterno}
            {$item.representante_legal_materno}
        </td>
    </tr>
    <tr>
        <td colspan="2" style="border-top: 0px">EMPRESA/ASOCIACIÓN: {$item.empresa_nombre}</td>
    </tr>
    <tr>
        <td colspan="2" style="border: 0px; text-align: right">
            <br>
            <img src="{$path_image}pdf/logo_vicuna.jpg" width="120px"/>
        </td>
    </tr>
    </table>
<br>


</div>
