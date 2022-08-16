<script>
getTablaModulo();
</script>
<fieldset class="fieldForm" style="background-color:#ffffff;" align="right">
    <table cellpadding="5" cellspacing="0" border="0" class="adminlist" style="margin:0 auto;">
    <tr>
    <td class="pregunta"><label for="name">Modulo:</label>
    </td>
    <td class="respuesta">
        <select class="input sfilter" id="modulo" rel="1" onchange="filterModulos()">
            <option value="0">Todas los Modulos</option>
            {html_options options=$ListModulo|utf8_decode}
        </select>
    </td>        
    </tr> 
    </table>
</fieldset>
<table border="0" cellspacing="0" cellpadding="0" style="font-size:11px;" class="adminlist"id="listModulos">
    <thead>
    <tr>
        <th>#</th>
        <th>Modulo(Submodulos)</th>
        <th>Acceso</th>
        <th>Editar</th>
        <th>Añadir</th>
        <th>Borrar</th>
    </tr>
    </thead>
  </table>