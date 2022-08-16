<div class="header_title2">DATOS DEL CONVENIO</div>
<table>
    <tr>
        <td class="pregunta" width="15%">Nombre: &nbsp;</td>
        <td class="respuesta" width="35%">{$convenio.nombre}</td>
        <td class="pregunta" width="15%">Cartera: &nbsp;</td>
        <td class="respuesta">{if $convenio.cartera == 1} SI {else} NO {/if}</td>
    </tr>
    <tr>
        <td class="pregunta">Fecha Firma: &nbsp;</td>
        <td class="respuesta">{$convenio.fecha_firma|date_format}</td>
        <td class="pregunta">Fecha Aprobación: &nbsp;</td>
        <td class="respuesta">{$convenio.fecha_aprobacion|date_format}</td>
    </tr>
    <tr>
        <td class="pregunta">Fecha Finalización: &nbsp;</td>
        <td class="respuesta">{$convenio.fecha_finalizacion|date_format}</td>
        <td class="pregunta">Fecha Desembolso: &nbsp;</td>
        <td class="respuesta">{$convenio.fecha_max_ultimo_desembolso|date_format}</td>
    </tr>  
    <tr>
        <td class="pregunta">Moneda: &nbsp;</td>
        <td class="respuesta">{$convenio.moneda}</td>
        <td class="pregunta">Financiadora: &nbsp;</td>
        <td class="respuesta">{$convenio.financiadora}</td>
    </tr>
    <tr>
        <td class="pregunta">Implementadora: &nbsp;</td>
        <td class="respuesta">{$convenio.implementadora}</td>
        <td class="pregunta">Tipo Financimiento: &nbsp;</td>
        <td class="respuesta">{$convenio.tipo_financimiento}</td>
    </tr>
    <tr>
        <td class="pregunta">Co Ejecutor: &nbsp;</td>
        <td class="respuesta">{$convenio.co_ejecutor}</td>
        <td class="pregunta">Monto: &nbsp;</td>
        <td class="respuesta">{$convenio.monto|number_format:2:'.':','}</td>
    </tr>
    <tr>
        <td class="pregunta">Tipo Cambio: &nbsp;</td>
        <td class="respuesta">{$convenio.tipo_cambio}</td>
        <td class="pregunta">Monto Bs: &nbsp;</td>
        <td class="respuesta">{$convenio.monto_bs|number_format:2:'.':','}</td>
    </tr>
    <tr>
        <td class="pregunta">GAM/GAD: &nbsp;</td>
        <td class="respuesta">{$convenio.gam_gad}</td>
        <td class="pregunta">Detalle: &nbsp;</td>
        <td class="respuesta">{$convenio.reg_detalle}</td>
    </tr>
    <br>
</table>

