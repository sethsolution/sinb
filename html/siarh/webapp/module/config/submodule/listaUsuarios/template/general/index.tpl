{include file="general/index.css.tpl"}
{include file="general/index.js.tpl"}
<form enctype="multipart/form-data" method="POST" action="{$getModule}" id="itemFormGral" autocomplete="off">
<table style="width:100%;padding:0px;border-spacing: 0px;">
<tr>
    <td class="titulo2">
        <img src="{$templateDir}images/icon/bullet3.gif"/> Datos de la cuenta de usuario
        {if $accion != "new"}: ID = {$id} {/if}</td>
    <td class="titulo2" nowrap="nowrap">
         {if $privFace.editar == true || $privFace.crear == true}
         <input type="submit" value="Guardar" class="boton"/>
         {/if}
    </td>
</tr>
</table>
{* ---------------------------------------------------------------------------------- *}
<fieldset class="fieldForm" >
<legend >Datos personales</legend>
<table style="width:100%;padding:0px;border-spacing: 0px;margin:0 auto;">
<tr>
    <td class="pregunta lt" style="text-align:center;width:250px;">Fotograf&iacute;a</td>
    <td > &nbsp;</td>
</tr>
<tr>
    <td class="respuesta fotoPersona" style="vertical-align:top;">
        <br />
        {if $item.portada  == 1}
            {assign var=randNum value=0|mt_rand:100}
            {*
            <img src="{$getModule}&accion={$subcontrol}_getPhoto&type=0&itemId={$item.itemId}&rand={$randNum}" />
            *}
            <div style="background-color: #000000;background-repeat: no-repeat;background-image: url('{$getModule}&accion={$subcontrol}_getPhoto&type=0&itemId={$item.itemId}&rand={$randNum}');">
        {else}
            <div>
            Sin Fotograf&iacute;a
        {/if}
        </div>
        <br />
        <input type="file" value="Agregar foto" class="input" style="width:95%;" 
         accept="image/jpeg"
        name="portada" class="classImag" id="portada"/>
        {if $accion == "new"}
            .
        {else}
            <b>Nota:</b> Para poder reemplazar la fotograf&iacute;a actual, por favor seleccione 
            un nuevo archivo jpg.
        {/if}
    </td>
    <td class="respuesta">
    
    <fieldset class="fieldForm">
      <legend >Datos de usuario</legend>
        
        <table style="width:100%;padding:0px;border-spacing: 0px;margin:0 auto;">
        {foreach from=$listDataUsuario item=row key=idx name=usuario}
        <tr>
            <td class="pregunta {if $idx == 2}lt{/if} ld" {if $smarty.foreach.usuario.iteration == 2}style="width:150px;"{/if}>
            {$row.descripcion|escape:"htmlall"}:&nbsp;</td>
            <td class="respuesta {if $idx == 2}lt{/if} ld">
                {if $row.tipoInput == 'text' || $row.tipoInput == 'number' || $row.tipoInput == 'decimal'}
                  <input type="text" class="input" name="item[{$row.campo}]" 
                  id="form_{$row.campo}"  {$privFace.input}
                  value="{$item[$row.campo]|escape:"htmlall"}" style="width:250px;;" 
                  {if $row.tipoInput == 'number'}onkeypress="return soloNumeros(event,this.value);"
                  {elseif $row.tipoInput == 'decimal'}onkeypress="return soloNumerosPunto(event,this.value);"
                  {/if} />
                  {if $row.campo == 'usuario'}
                    <img src="{$templateDir}images/icon/archivo/user-green-icon.png" />
                    <div id="msgUsuario"></div>
                  {/if}    
                {elseif $row.tipoInput == 'select'}
                  <select class="input itemFilter" name="item[{$row.campo}]" 
                  id="form_{$row.campo}" {$privFace.input} >
                    {html_options options=$listCatalogo.$idx selected=$item[$row.campo]}
                  </select>
                  {if $row.campo == 'tipoUsuario'}
                  <img src="{$templateDir}images/icon/archivo/admin-min-icon.png" />
                  {/if}
                  
                {elseif $row.tipoInput == 'password'}
                  <input type="password" class="input " name="item[{$row.campo}]" 
                  id="form_{$row.campo}" style="width:250px;" {$privFace.input} />
                  <img src="{$templateDir}images/icon/archivo/change-password-icon.png" />
                    <div class="msghelp">
                    <b>Nota:</b> Ingrese una nueva contrase&ntilde;a,
                    <b>solo</b> si desea cambiar la contrase&ntilde;a,
                    caso contrario deje en blanco este campo.
                    </div>
                {/if}
              </td></tr>
        {/foreach}
        
        <tr id="grupoShow">
            <td class="pregunta">Grupo:&nbsp;</td>
            <td class="respuesta ld">
                <select  style="width:97%;border-color:orange;" 
                id="idGrupo" name="item[grupoId]"
                id="tipoId" class="input itemFilter"> 
                <option value="">SIN GRUPO</option>
                {html_options options=$cataobj.grupo selected=$item.grupoId}
                </select>
                <img src="{$templateDir}images/icon/archivo/users-icon.png" />
            </td>
        </tr>
        {if $accion == "update" and $item.grupoId != ''}
        <tr id="grupoShow2">
            <td class="pregunta" > Permisos de grupo: </td>
            <td class="respuesta ld">
                <input type="button" id="btn_copyGrupo" class="boton" 
                value="Copiar permisos de grupo" style="display:inline-block;" />
                <img src="{$templateDir}images/icon/archivo/change-password-icon.png" />
                
                <div class="msghelp">
                <b>Nota:</b> Esta funcionalidad, permite heredar todas las configuraciones de
                acceso al sistema realizadas en el <b>grupo</b> seleccionado previamente.
                <br />
                Para poder configurar los permisos del grupo, deber&aacute; dirigirse al m&oacute;dulo
                "Gruop de Usuarios".
                </div>
            </td>
        </tr>
        {/if}
        </table>
    </fieldset>
    
    <fieldset class="fieldForm">
    <legend>Instituci&oacute;n</legend>
    <table style="width:100%;padding:0px;border-spacing: 0px;margin:0 auto;">
    <tr>
        <td class="pregunta lt ld" style="width:150px;">Instituci&oacute;n:&nbsp;</td>
        <td class="respuesta lt ld">
            <select class="itemFilter" name="item[institucionId]" 
            {$privFace.input} id="idInstitucion"
            data-placeholder="Elija una institución">
            <option value="">Seleccione una Institución</option>
            {html_options options=$cataobj.programa selected=$item.institucionId}
            </select>
            <div class="msghelp">
                <b>Nota:</b> 
                Seleccione la instituci&oacute;n donde este usuario se encuentra actualmente.
            </div>
        </td>
    </tr>
    <tr>
        <td class="pregunta">Programas:&nbsp;</td>
        <td class="respuesta ld" >
            <select class="itemFilter" name="item[programas][]" 
            id="form_programas" {$privFace.input} data-placeholder="Elija programas" multiple="multiple">
            <option value=""></option>
            {html_options options=$cataobj.programa selected=","|explode:$item.programas}
            </select>
            
            <div class="msghelp">
                <b>Nota:</b> 
                Puede seleccionar uno o mas programas.<br />
                La informaci&oacute;n de los programas seleccionados seran administrados
                por este usuario.
            </div>
                
        </td>
        </tr>
        <tr>
        <td class="pregunta">Coordinador:&nbsp;</td>
        <td class="respuesta ld">
                    {if $listCatalogo.19|@count gt 0}
                      {foreach key=rowId item=row from=$listCatalogo.19}
                        <div style="width:auto;padding:4px 0px;display:inline-block;">
                          <input type="radio" name="item[coordinador]" class="input ubic_opt" value="{$rowId}"
                              {if $rowId == $item.coordinador} checked="checked" {/if} id="coordinador_{$rowId}"/>
                          {$row|escape:"htmlall"}
                        </div>&nbsp;
                      {/foreach}    
                    {else}<b>No existen Opciones configuradas</b>
                    {/if}</td>
        </tr>
      </table>
    </fieldset>
    
    <fieldset class="fieldForm">
    <legend>Datos Personales</legend>
        <table style="width:100%;padding:0px;border-spacing: 0px;margin:0 auto;">
        {foreach from=$listDataPersonal item=row key=idx name=personal}
            <tr>
                <td class="pregunta {if $idx == 3}lt{/if}" {if $smarty.foreach.personal.iteration == 2}style="width:150px;"{/if}>
                    {$row.descripcion|escape:"htmlall"}:&nbsp;</td>
                <td class="respuesta {if $idx == 3}lt{/if} ld">
                    {if $row.tipoInput == 'text' || $row.tipoInput == 'number' || $row.tipoInput == 'decimal'}
                        <input type="text" name="item[{$row.campo}]" 
                        id="form_{$row.campo}" {$privFace.input} 
                        value="{$item[$row.campo]|escape:"htmlall"}" 
                        style="width:98%;" 
                        {if $row.tipoInput == 'number'}
                            class="input num_azul num_entero2" maxlength="10"
                        {elseif $row.tipoInput == 'decimal'}
                            class="input num_azul num_decimal"
                        {elseif $row.tipoInput == 'text'}
                            class="input" onkeypress="return soloAlphanumericos(event,this.value);"
                        {/if} />
                    {elseif $row.tipoInput == 'select'}
                        <select class="input" name="item[{$row.campo}]" id="form_{$row.campo}" {$privFace.input}>
                        {html_options options=$listCatalogo.$idx selected=$item[$row.campo]}
                        </select>
                    {/if}
                </td>
            </tr>             
        {/foreach}
        </table>
    </fieldset>
    
    

    </td>
</tr>
</table>
</fieldset>  

<br style="clear:both;"/>
</form>