
<table class="table table-bordered table-striped table-condensed table-hover flip-content" id="sample_1">
    <thead class="flip-content">
    <tr>
        <th  style="font-size: 11px; text-align: center;">Fecha</th>
        <th  style="font-size: 11px; text-align: center;">Horario</th>
        <th  style="font-size: 11px; text-align: center;">Marcado</th>
        <th  style="font-size: 11px; text-align: center;">Entrada</th>
        <th  style="font-size: 11px; text-align: center;">Horario</th>
        <th  style="font-size: 11px; text-align: center;">Marcado</th>
        <th  style="font-size: 11px; text-align: center;">Salida</th>
        <th  style="font-size: 11px; text-align: center;">Atraso</th>
        <th  style="font-size: 11px; text-align: center;">Horario</th>
        <th  style="font-size: 11px; text-align: center;">Marcado</th>
        <th  style="font-size: 11px; text-align: center;">Entrada</th>
        <th  style="font-size: 11px; text-align: center;">Horario</th>
        <th  style="font-size: 11px; text-align: center;">Marcado</th>
        <th  style="font-size: 11px; text-align: center;">Salida</th>
        <th  style="font-size: 11px; text-align: center;">Atraso</th>
        <th  style="font-size: 11px; text-align: center;">Total Atraso</th>
    </tr>
    </thead>
    <tbody>

    {foreach from=$reporte item=row key=idx}
    <tr>
        <td  style="font-size: 11px; text-align: center;">{$row.fecha}</td>


        <td  style="font-size: 11px; text-align: center;">{$row.dato.horario1}</td>
        <td  style="font-size: 11px; text-align: center;">{$row.dato.oficina1}</td>
        <td  style="font-size: 11px; text-align: center;">{$row.dato.hora1}</td>


        <td  style="font-size: 11px; text-align: center;">{$row.dato.horario2}</td>
        <td  style="font-size: 11px; text-align: center;">{$row.dato.oficina2}</td>
        <td  style="font-size: 11px; text-align: center;">{$row.dato.hora2}</td>

        <td  style="font-size: 11px; text-align: center;{if $row.dato.atraso1 != 0}color: #f00;{/if}">{$row.dato.atraso1}</td>

        <td  style="font-size: 11px; text-align: center;">{$row.dato.horario3}</td>
        <td  style="font-size: 11px; text-align: center;">{$row.dato.oficina3}</td>
        <td  style="font-size: 11px; text-align: center;">{$row.dato.hora3}</td>

        <td  style="font-size: 11px; text-align: center;">{$row.dato.horario4}</td>
        <td  style="font-size: 11px; text-align: center;">{$row.dato.oficina4}</td>
        <td  style="font-size: 11px; text-align: center;">{$row.dato.hora4}</td>

        <td  style="font-size: 11px; text-align: center;{if $row.dato.atraso2 != 0}color: #f00;{/if}">{$row.dato.atraso2}</td>

        <td  style="font-size: 11px; text-align: center;color: #f00;"> {math equation="x + y" x=$row.dato.atraso2 y=$row.dato.atraso1}</td>
    </tr>
    {/foreach}
    </tbody>
</table>

{*

<div class="row">
    <div class="col-md-4">
        <table class="table table-bordered table-striped table-condensed table-hover flip-content">
            <thead class="flip-content">
            <tr class="warning">
                <th colspan="2" style="font-size: 11px; text-align: center;">Resumen de Asistencia</th>
            </tr>
            </thead>
            <tbody>
            <tr>
                <td style="font-size: 11px; text-align: center;"><?php echo 'Días Trabajados'; ?></td>
                <td style="font-size: 11px; text-align: center;"><?php echo $resumen['trabajo']; ?></td>
            </tr>
            <tr>
                <td style="font-size: 11px; text-align: center;"><?php echo 'Feriados'; ?></td>
                <td style="font-size: 11px; text-align: center;"><?php echo $resumen['feriado']; ?></td>
            </tr>
            <tr>
                <td style="font-size: 11px; text-align: center;"><?php echo 'Vacaciones'; ?></td>
                <td style="font-size: 11px; text-align: center;"><?php echo $resumen['vacacion']; ?></td>
            </tr>
            <tr>
                <td style="font-size: 11px; text-align: center;"><?php echo 'Permisos Día'; ?></td>
                <td style="font-size: 11px; text-align: center;"><?php echo $resumen['permisodia']; ?></td>
            </tr>
            <tr>
                <td style="font-size: 11px; text-align: center;"><?php echo 'Faltas'; ?></td>
                <td style="font-size: 11px; text-align: center;"><?php echo $resumen['faltas']; ?></td>
            </tr>
            <tr>
                <td style="font-size: 11px; text-align: center;"><?php echo 'Total Días'; ?></td>
                <td style="font-size: 11px; text-align: center;"><?php echo $t=$resumen['trabajo']+$resumen['feriado']+$resumen['vacacion']+$resumen['permisodia']+$resumen['faltas']; ?></td>
            </tr>
            </tbody>
        </table>
    </div>
    <div class="col-md-4">
        <table class="table table-bordered table-striped table-condensed table-hover flip-content">
            <thead class="flip-content">
            <tr class="warning">
                <th colspan="2" style="font-size: 11px; text-align:center">Resumen de Marcadas</th>
            </tr>
            </thead>
            <tbody>
            <tr>
                <td style="font-size: 11px; text-align: center;"><?php echo 'Entradas Marcadas'; ?></td>
                <td style="font-size: 11px; text-align: center;"><?php echo $resumen['entradamarcada']; ?></td>
            </tr>
            <tr>
                <td style="font-size: 11px; text-align: center;"><?php echo 'Entradas No Marcadas'; ?></td>
                <td style="font-size: 11px; text-align: center;"><?php echo $resumen['entradanomarcada']; ?></td>
            </tr>
            <tr>
                <td style="font-size: 11px; text-align: center;"><?php echo 'Salidas Marcadas'; ?></td>
                <td style="font-size: 11px; text-align: center;"><?php echo $resumen['salidamarcada']; ?></td>
            </tr>
            <tr>
                <td style="font-size: 11px; text-align: center;"><?php echo 'Salidas No Marcadas'; ?></td>
                <td style="font-size: 11px; text-align: center;"><?php echo $resumen['salidanomarcada']; ?></td>
            </tr>
            <tr>
                <td style="font-size: 11px; text-align: center;"><?php echo 'Permisos hora'; ?></td>
                <td style="font-size: 11px; text-align: center;"><?php echo $resumen['permisohora']; ?></td>
            </tr>
            </tbody>
        </table>
    </div>
    <div class="col-md-4">
        <table class="table table-bordered table-striped table-condensed table-hover flip-content">
            <thead class="flip-content">
            <tr class="warning">
                <th colspan="2" style="font-size: 11px; text-align: center;">Atrasos</th>
            </tr>
            </thead>
            <tbody>
            <tr>
                <td style="font-size: 11px; text-align: center;"><?php echo '31 A 60 Min.'; ?></td>
                <td style="font-size: 11px; text-align: center;"><?php echo $resumen['atraso']>=31&&$resumen['atraso']<=60?'<span style="color:#f00">'.$resumen['atraso'].'</span>':'0'; ?></td>
            </tr>
            <tr>
                <td style="font-size: 11px; text-align: center;"><?php echo '61 A 90 Min.'; ?></td>
                <td style="font-size: 11px; text-align: center;"><?php echo $resumen['atraso']>=61&&$resumen['atraso']<=90?'<span style="color:#f00">'.$resumen['atraso'].'</span>':'0'; ?></td>
            </tr>
            <tr>
                <td style="font-size: 11px; text-align: center;"><?php echo '91 A 120 Min.'; ?></td>
                <td style="font-size: 11px; text-align: center;"><?php echo $resumen['atraso']>=91&&$resumen['atraso']<=120?'<span style="color:#f00">'.$resumen['atraso'].'</span>':'0'; ?></td>
            </tr>
            <tr>
                <td style="font-size: 11px; text-align: center;"><?php echo 'Más 120 Min.'; ?></td>
                <td style="font-size: 11px; text-align: center;"><?php echo $resumen['atraso']>120?'<span style="color:#f00">'.$resumen['atraso'].'</span>':'0'; ?></td>
            </tr>
            </tbody>
        </table>
    </div>
</div>


<div class="form-actions fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="col-md-offset-3 col-md-9">
                <a href="<?php echo url_for('conregistroindividual/imprimir?ci='.$ci.'&fecha_inicio='.$inicio.'&fecha_fin='.$fin); ?>" target="_blank" class="btn green"><i class="fa fa-print"></i> Imprimir</a>
                <button type="button" class="btn red principal" data-url="<?php echo url_for('conregistroindividual/index') ?>"><i class="fa fa-times-circle"></i> Cancel</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="modal_nuevo" role="basic" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
        </div>
    </div>
</div>
*}