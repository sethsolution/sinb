{*
<table style="background-image: url('/module/cites/template/images/logo/CITES.png');
background-repeat: no-repeat;">*}
    <table>
    <tr><td>


    <table >
    //fila 1
    <tr>
        <td colspan="2" rowspan="3" align="center" >
            <img src="{$templateDir}images/pdf/cites_logo.jpg" width="100px" style="float: left; margin: 0.5em;" /><br>
            CONVENCIÓN SOBRE EL COMERCIO<br>
            INTERNACIONAL DE ESPECIES<br>
            AMENAZADAS DE FAUNA <br>
            Y FLORA SILVESTRE
        </td>
        <td>1. PERMISO / CERTIFICADO</td>
        <td class="respuesta2" style="text-align: left; color: #a01c15"><strong> Nro. 02120 </strong></td>
    </tr>
    <tr>
        <td rowspan="2" class="respuesta2">
           {* <div class="m-radio-list">
                {foreach from=$cataobj.tipo_documento item=row key=idx}
                <label class="m-radio">
                    <input type="radio" name="item[tipo_documento_id]" value="{$row.itemId}"
                            {if $row.itemId== $item.tipo_documento_id} checked{/if}>
                    {$row.nombre}
                    <span></span>
                </label>
                {/foreach}
            </div>*}
            Re - exportador
           {* <div class="respuesta2">
                {*{foreach from=$cataobj.tipo_documento item=row key=idx}
                    <label class="m-radio">
                        <input type="radio" name="item[tipo_documento_id]" value="{$row.itemId}"
                                {if $row.itemId == $item.tipo_documento_id} checked{/if}>
                        {$row.nombre}
                        <span></span>
                    </label><br>
                {/foreach}
            </div>*}
        </td>
        <td class="pregunta2">2. Válido Hasta el</td>
    </tr>
    <tr>

        <td class="respuesta2">03/08/2020</td>
    </tr>
    //fila 2
    <tr>
        <td colspan="2" class="pregunta2">3. Importador (nombre, dirección)</td>
        <td colspan="2" class="pregunta2">4. Exportador / re-exportador (nombre, dirección y país)</td>
    </tr>
    <tr>
        <td colspan="2" class="respuesta2" height="40">{$item.importador_nombre}<br>{$item.importador_direccion}</td>
        <td colspan="2" class="respuesta2">{$item.exportador_nombre}<br>{$item.exportador_direccion}<br>{$item.paisexportador}
            </td>
    </tr>
    //fila 3
    <tr>
        <td colspan="2" class="pregunta2">3a. País de importación</td>
        <td colspan="2" class="pregunta2">6. Nombre, dirección, sello/timbre nacional y país de la Autoridad Administrativa</td>
    </tr>
    <tr>
        <td colspan="2" class="respuesta2" width="350px">
            <select style="border: none;"
                    name="item[importacion_pais_id]" >
                {html_options options=$cataobj.pais selected=$item.importacion_pais_id}
            </select>
          </td>
        <td colspan="2" rowspan="5" class="respuesta2" height="130">
            <img src="{$templateDir}images/pdf/escudo_cites.png" width="100px" style="float: left; margin: 0.5em;" /><br>
            MINISTERIO DE MEDIO AMBIENTE Y AGUA<br>
            VICEMINISTERIO DE MEDIO AMBIENTE, BIODIVERSIDAD, <br>
            CAMBIOS CLIMÁTICOS Y DE GESTIÓN<br>
            Y DESARROLLO FORESTAL<br><br>
            Dirección General de Biodiversidad y Áreas Protegidas<br>LA PAZ - BOLIVIA

        </td>
    </tr>
    //fila 4
    <tr>
        <td colspan="2" class="pregunta2">5. Condiciones especiales</td>
    </tr>
    <tr>
        <td height="30" colspan="2" class="respuesta2"></td>
    </tr>
    //fila 5
    <tr>
        <td class="pregunta2">5a. Propósito de la transacción.</td>
        <td class="pregunta2">5b. Estampilla de Seguridad N°</td>
    </tr>
    <tr>
        <td class="respuesta2">{$item.proposito}</td>
        <td class="respuesta2"></td>
    </tr>
</table>
        </td></tr>
    <tr>
        <td>
<div class="m-section__content">
    <table id="tabla_especie">
        <thead>
        <tr>
            <th class="pregunta3">7/8. Nombre científico y nombre común del animal o planta</th>
            <th class="pregunta3">9. Descripción de los especimenes: incluso las marcas o números de identificación</th>
            <th class="pregunta3">10. Apéndice y origen</th>
            <th class="pregunta3">11. Cantidad(incluyendo la unidad)</th>
            <th class="pregunta3">11.a Total exportado / cupo</th>
        </tr>
        </thead>
        <tbody style="background: {$path_image}pdf/cites_logo.jpg">
        {foreach from=$especie item=row key=idx}
            <tr>
            <td rowspan="3" class="respuesta2"  height="40">{$row.nombre_especie} </td>
            <td rowspan="3" class="respuesta2">{$row.descripcion}</td>
            <td class="respuesta2">{$row.nombre}</td>
            <td class="respuesta2">{$row.unidad} </td>
            <td class="respuesta2"></td>
        </tr>
            <tr>
                <td colspan="2" class="pregunta2">12. a/b País de origen </td>
                <td class="pregunta2">Permiso Nro </td>
            </tr>
            <tr>
                <td colspan="2"  class="respuesta2">{$row.pais}</td>
                <td  class="respuesta2"> </td>
            </tr>
        {/foreach}
        </tbody>
    </table>
        </td>
    </tr>
    <tr>
        <td>
    <table>
        <tr>
            <td colspan="5" class="pregunta2">13. ESTE PERMISO ES EMITIDO POR:</td>
        </tr>
        <tr>
            <td class="respuesta" height="50">........................<br>Lugar</td>
            <td class="respuesta">........................<br>Fecha</td>
            <td class="respuesta">........................<br>Firma</td>
            <td class="respuesta">.........................<br>Sello y cargo oficial</td>
            <td class="respuesta">.........................<br>Estampilla de seguridad</td>
        </tr>
        <tr>
            <td colspan="2" class="pregunta2">14. APROBACION DE LA EXPORTACION</td>
            <td colspan="4" class="pregunta2">15. Conocimiento de embarque / Número de guia aéreo:</td>
        </tr>
        <tr>
            <td class="pregunta3">Sección</td>
            <td class="pregunta3">Cantidad</td>
            <td rowspan="6" class="respuesta" height="50">........................<br>Puerto de exportación</td>
            <td rowspan="6" class="respuesta">........................<br>Fecha</td>
            <td rowspan="6" class="respuesta">........................<br>Firma</td>
            <td rowspan="6" class="respuesta">........................<br>Sello y cargo oficiales</td>
        </tr>
        <tr>
            <td class="pregunta3">A</td>
            <td class="pregunta3"></td>
        </tr>
        <tr>
            <td class="pregunta3">B</td>
            <td class="pregunta3"></td>
        </tr>
        <tr>
            <td class="pregunta3">C</td>
            <td class="pregunta3"></td>
        </tr>
        <tr>
            <td class="pregunta3">D</td>
            <td class="pregunta3"></td>
        </tr>
        <tr>
            <td class="pregunta3">E</td>
            <td class="pregunta3"></td>
        </tr>
        <tr>
            <td class="pregunta3">F</td>
            <td class="pregunta3"></td>
        </tr>
    </table>
        </td>
    </tr>
</table>
</div>
