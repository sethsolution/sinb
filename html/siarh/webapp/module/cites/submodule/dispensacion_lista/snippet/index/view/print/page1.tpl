<table style="background-image: url('{$path_image}pdf/nooficial.png'); background-repeat: no-repeat;
        background-position: left;">
    //fila 1
    <tr>
        <td rowspan="2" >
            {*<div class="m-radio-list">
                 {foreach from=$cataobj.tipo_documento item=row key=idx}
                     <label class="m-radio">
                         <input type="radio" name="item[tipo_documento_id]" value="{$row.itemId}"
                                 {if $row.itemId == $item.tipo_documento_id} checked{/if}>
                         {$row.nombre}

                     </label>
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
        <td class="pregunta2">3. Importador (nombre, dirección)</td>
        <td class="pregunta2">4. Exportador / re-exportador (nombre, dirección y país)</td>
    </tr>
    <tr>
        <td class="respuesta2" height="40">{$item.importador_nombre}<br>{$item.importador_direccion}</td>
        <td class="respuesta2">{$item.exportador_nombre}<br>{$item.exportador_direccion}<br>{$item.paisexportador}
        </td>
    </tr>
    //fila 3
    <tr>
        <td class="pregunta2">3a. País de importación</td>
        <td class="pregunta2">6. Nombre, dirección, sello/timbre nacional y país de la Autoridad Administrativa</td>
    </tr>
    <tr>
        <td class="respuesta2" width="350px">
            <select style="border: none;"
                    name="item[importacion_pais_id]" >
                {html_options options=$cataobj.pais selected=$item.importacion_pais_id}
            </select>
        </td>
        <td rowspan="5" class="respuesta2" height="130">
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
        <td class="pregunta2">5. Condiciones especiales</td>
    </tr>
    <tr>
        <td height="30" class="respuesta2"></td>
    </tr>
    //fila 5
    <tr>
        <td class="pregunta2">5a. Propósito de la transacción.</td>
    </tr>
    <tr>
        <td class="respuesta2">{$item.proposito}</td>
    </tr>
    </tbody>
</table>

<div class="m-section__content">
    <table id="tabla_especie">
        <thead>
        <tr>
            <th class="pregunta3">7/8. Nombre científico y nombre común del animal o planta</th>
            <th class="pregunta3">9. Descripción de los especimenes: incluso las marcas o números de identificación</th>
            <th class="pregunta3">11. Cantidad(incluyendo la unidad)</th>
        </tr>
        </thead>
        <tbody style="background: {$path_image}pdf/cites_logo.jpg">
        {foreach from=$especie item=row key=idx}
            <tr>
                <td class="respuesta2">{$row.nombre_especie} </td>
                <td class="respuesta2">{$row.descripcion}</td>
                <td class="respuesta2">{$row.unidad} </td>
            </tr>
        {/foreach}
        </tbody>
    </table>

    <table>

        <tr>
            <td rowspan="2" class="pregunta2" width="30"><img src="{$templateDir}images/pdf/sustentable.jpg" width="100px" style="float: left; margin: 0.5em;" /></td>
            <td class="pregunta2" style="height: 50px">11. Lugar:</td>
            <td class="respuesta"></td>
            <td class="respuesta"></td>
        </tr>
        <tr>
            <td class="pregunta2" style="height: 50px">12. Fecha:</td>
            <td class="respuesta2">.............................................<br>Firma</td>
            <td class="respuesta2">.............................................<br>Sello y cargo</td>
        </tr>

    </table>
</div>
