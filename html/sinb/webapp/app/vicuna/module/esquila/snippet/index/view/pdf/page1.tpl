<div class="item-titulo">FICHA TECNICA</div>

<table class="item-tabla">
    <tr>
        <td class="item-tabla-titulo">Año</td>
        <td>{$item.anio}</td>
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
        <td class="item-tabla-titulo">ARCMV</td>
        <td>{$item.arcmv}</td>
    </tr>
    <tr>
        <td class="item-tabla-titulo">CMV</td>
        <td>{$item.cmv}</td>
    </tr>
    <tr>
        <td class="item-tabla-titulo">Sitio de captura</td>
        <td>{$item.sitio_captura}</td>
    </tr>
    <tr>
        <td class="item-tabla-titulo">Fecha de captura</td>
        <td>{$item.fecha_captura|date_format:'%d/%m/%Y'}</td>
    </tr>
</table>

<table class="item-tabla">
    <tr>
        <td colspan=3" class="item-tabla-titulo txtCenter">DATOS VICUÑAS PRE CAPTURA y CAPTURADAS</td>
    </tr>
    <tr>
        <td class="item-tabla-header">Número vicuñas en sitio de captura</td>
        <td class="item-tabla-header">Número vicuñas capturadas</td>
        <td class="item-tabla-header">Tasa de captura</td>
    </tr>
    <tr>
        <td align="center">{$item.numero_vicuna_sitio_captura}</td>
        <td align="center">{$item.numero_vicuna_capturadas}</td>
        <td align="center">{$item.tasa_captura}</td>
    </tr>
    <tr>
        <td class="item-tabla-header">Número vicuñas esquiladas</td>
        <td class="item-tabla-header">Tasa de esquila</td>
        <td class="item-tabla-header">Número vicuñas muertas en accidente</td>
    </tr>
    <tr>
        <td align="center">{$item.numero_vicuna_esquiladas}</td>
        <td align="center">{$item.tasa_esquila}</td>
        <td align="center">{$item.numero_vicuna_muertas_accidente}</td>
    </tr>
</table>

<table class="item-tabla">
    <tr>
        <td colspan=3" class="item-tabla-titulo txtCenter">VICUÑAS CAPTURADAS POR SEXO</td>
    </tr>
    <tr>
        <td class="item-tabla-header">Machos capturados</td>
        <td class="item-tabla-header">Hembras capturadas</td>
        <td class="item-tabla-header">Prueba A</td>
    </tr>
    <tr>
        <td align="center">{$item.captura_machos}</td>
        <td align="center">{$item.captura_hembras}</td>
        <td align="center">{$item.prueba_a}</td>
    </tr>
</table>

<table class="item-tabla">
    <tr>
        <td colspan=4" class="item-tabla-titulo txtCenter">VICUÑAS CAPTURADAS POR EDAD</td>
    </tr>
    <tr>
        <td class="item-tabla-header">Cría</td>
        <td class="item-tabla-header">Juvenil</td>
        <td class="item-tabla-header">Adulto</td>
        <td class="item-tabla-header">Prueba B</td>
    </tr>
    <tr>
        <td align="center">{$item.edad_cria}</td>
        <td align="center">{$item.edad_juvenil}</td>
        <td align="center">{$item.edad_adulto}</td>
        <td align="center">{$item.edad_prueba_b}</td>
    </tr>
</table>

<table class="item-tabla">
    <tr>
        <td colspan=4" class="item-tabla-titulo txtCenter"> CONDICIÓN CORPORAL Y GESTACIÓN POR ESQUILA Y CMV</td>
    </tr>
    <tr>
        <td colspan="2" class="item-tabla-header">Condición corporal malo</td>
        <td  colspan="1" class="item-tabla-header">Condición corporal regular</td>
        <td colspan="1" class="item-tabla-header">Condición corporal bueno</td>
    </tr>
    <tr>
        <td colspan="2" align="center">{$item.condicion_corporal_malo}</td>
        <td colspan="1" align="center">{$item.condicion_corporal_regular}</td>
        <td colspan="1" align="center">{$item.condicion_corporal_bueno}</td>
    </tr>
    <tr>
        <td class="item-tabla-header">Si gestante</td>
        <td class="item-tabla-header">Si último o tercio</td>
        <td class="item-tabla-header">No gestante</td>
        <td class="item-tabla-header">Prueba 2</td>
    </tr>
    <tr>
        <td align="center">{$item.gestacion_si}</td>
        <td align="center">{$item.gestacion_si_ultimo_tercio}</td>
        <td align="center">{$item.gestacion_no}</td>
        <td align="center">{$item.gestacion_prueba_2}</td>
    </tr>
</table>

<table class="item-tabla">
    <tr>
        <td colspan=3" class="item-tabla-titulo txtCenter">PARÁSITOS DE LAS VICUÑAS POR ESQUILA Y CMV</td>
    </tr>
    <tr>
        <td class="item-tabla-header">Garrapatas</td>
        <td class="item-tabla-header">Piojos</td>
        <td class="item-tabla-header">Sarna</td>
    </tr>
    <tr>
        <td align="center">{$item.parasito_externo_garrapata}</td>
        <td align="center">{$item.parasito_externo_piojo}</td>
        <td align="center">{$item.parasito_externo_sarna}</td>
    </tr>
    <tr>
        <td class="item-tabla-header">Severidad de sarna leve</td>
        <td class="item-tabla-header">Severidad de sarna moderado</td>
        <td class="item-tabla-header">Severidad de sarna severo</td>
    </tr>
    <tr>
        <td align="center">{$item.severidad_sarna_leve}</td>
        <td align="center">{$item.severidad_sarna_moderado}</td>
        <td align="center">{$item.severidad_sarna_severo}</td>
    </tr>
    <tr>
        <td colspan="2" class="item-tabla-header"> Caspa si</td>
        <td colspan="1" class="item-tabla-header"> Caspa no</td>
    </tr>
    <tr>
        <td colspan="2" align="center">{$item.caspa_si}</td>
        <td colspan="1" align="center">{$item.caspa_no}</td>
    </tr>
</table>

<table class="item-tabla">
    <tr>
        <td colspan=4" class="item-tabla-titulo txtCenter">DATOS DE LA FIBRA DE VICUÑA OBTENIDA</td>
    </tr>
    <tr>
        <td class="item-tabla-header">Técnica de tijera manual</td>
        <td class="item-tabla-header">Técnica de máquina eléctrica</td>
        <td class="item-tabla-header">Prueba 1</td>
        <td class="item-tabla-header">Fibra en bruto</td>
    </tr>
    <tr>
        <td align="center">{$item.tecnica_esquila_tijera_manual}</td>
        <td align="center">{$item.tecnica_esquila_maquina_electrica}</td>
        <td align="center">{$item.tecnica_esquila_prueba_1}</td>
        <td align="center">{$item.fibra_en_bruto}</td>
    </tr>
    <tr>
        <td class="item-tabla-header">Fibra predescerdada</td>
        <td class="item-tabla-header">Fibra vellón</td>
        <td class="item-tabla-header">Fibra braga</td>
        <td class="item-tabla-header">Fibra total</td>
    </tr>
    <tr>
        <td align="center">{$item.fibra_predescerdada}</td>
        <td align="center">{$item.fibra_vellon}</td>
        <td align="center">{$item.fibra_braga}</td>
        <td align="center">{$item.fibra_total}</td>
    </tr>
</table>

<table class="item-tabla">
    <tr>
        <td colspan=3" class="item-tabla-titulo txtCenter">RESULTADOS DE PARTICIPACIÓN Y SOCIORGANIZATIVOS</td>
    </tr>
    <tr>
        <td class="item-tabla-header">Participación de las comunidades mujeres</td>
        <td class="item-tabla-header">Participación de las comunidades hombres</td>
        <td class="item-tabla-header">Participación de las comunidades total</td>
    </tr>
    <tr>
        <td align="center">{$item.participacion_comunidades_mujeres}</td>
        <td align="center">{$item.participacion_comunidades_hombres}</td>
        <td align="center">{$item.participacion_comunidades_total}</td>
    </tr>
    <tr>
        <td class="item-tabla-header">Participación de otras CMV mujeres</td>
        <td class="item-tabla-header">Participación de otras CMV hombres</td>
        <td class="item-tabla-header">Participación de otras CMV total</td>
    </tr>
    <tr>
        <td align="center">{$item.participacion_otrascmv_mujeres}</td>
        <td align="center">{$item.participacion_otrascmv_hombres}</td>
        <td align="center">{$item.participacion_otrascmv_total}</td>
    </tr>
    <tr>
        <td class="item-tabla-header"> Participación visitantes mujeres</td>
        <td class="item-tabla-header"> Participación visitantes hombres</td>
        <td class="item-tabla-header"> Participación visitantes total</td>
    </tr>
    <tr>
        <td align="center">{$item.participacion_visitantes_mujeres}</td>
        <td align="center">{$item.participacion_visitantes_hombres}</td>
        <td align="center">{$item.participacion_visitantes_total}</td>
    </tr>
</table>

<table class="item-tabla">
    <tr>
        <td colspan=4" class="item-tabla-titulo txtCenter">DATOS DE LA FIBRA DE VICUÑA PARA LA VENTA</td>
    </tr>
    <tr>
        <td class="item-tabla-header">Venta fibra predescerdada</td>
        <td class="item-tabla-header"> Venta fibra vellón</td>
        <td class="item-tabla-header"> Venta fibra braga</td>
        <td class="item-tabla-header"> Venta fibra total</td>
    </tr>
    <tr>
        <td align="center">{$item.venta_fibra_predescerdada}</td>
        <td align="center">{$item.venta_fibra_vellon}</td>
        <td align="center">{$item.venta_fibra_braga}</td>
        <td align="center">{$item.venta_fibra_total}</td>
    </tr>
</table>

<table class="item-tabla">
    <tr>
        <td colspan=2" class="item-tabla-titulo txtCenter">DOCUMENTOS ADJUNTOS</td>
    </tr>
    <tr>
        <td class="item-tabla-header">Descripción</td>
        <td class="item-tabla-header">Documento</td>
{*        <td class="item-tabla-header">Tamaño</td>*}
    </tr>
    {foreach from=$item.adjunto item=row key=idx}
        <tr>
            <td>{$row.descripcion|escape:"html"}</td>
            <td align="center">{$row.attached_name|escape:"html"}</td>
{*            <td align="center">{$row.attached_size|escape:"html"}</td>*}
        </tr>
    {/foreach}
</table>