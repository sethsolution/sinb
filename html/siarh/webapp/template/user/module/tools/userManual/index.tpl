{* JavaScript del módulo *}
{*
<script type="text/javascript" language="javascript" src="js/DataTables/media/js/jquery.dataTables.js"></script>
*}
{include file="$templateDirModule/userManual/js.tpl"}
{* fin *}

    {*subtitulo Green*} 
    <table cellpadding="0" cellspacing="0" border="0" width="100%">
        <tr>
            <td class="titulo2"> <img src="{$templateDir}images/icon/bullet3.gif"/> 
              Material de apoyo
            </td>
            <td class="titulo2" nowrap="nowrap">
              &nbsp;
            </td>
           <!--<td class="titulo2" align="right">
	            <input type="button" onclick="addNewAnnexe('','new');" name="enviar" value="Agregar" class="boton"/>
            </td>
           --->
        </tr>
    </table>
    {*subtitulo Green*}    

    <div id="gallery">
        
      <table id="tableAnnexeSystem" width="100%" border="0" cellpadding="0" cellspacing="0" class="adminlist">  
      {if $item.anx|@count gt 0}
          <thead>
            <tr>

              <th width="5%"> # </th>
              <th width="25%"> Nombre & Descripci&oacute;n</th>
              <th width="60%"> Archivo </th>
              <th width="5%"> &nbsp; </th>
            </tr>
          </thead>
          <tbody>
            {assign var="stylez" value=""}
            {section name=i loop=$item.anx}
                {if $smarty.section.i.index % 2 eq 0}
                  {assign var="stylez" value="listaDato02"}
                {else}
                  {assign var="stylez" value="listaDato01"}
                {/if}
                <tr class="{$stylez}" onMouseOver="this.className='listaDato04'; return true;" onMouseOut="this.className='{$stylez}'; return true;">

                  <td align="center">
                    {$smarty.section.i.index+1}
                  </td>
                  
                  
                  <td align="left" >
                    <strong>Titulo:</strong> {assign var=name value=$item.anx[i].name|escape:"htmlall"}
                    {$name|nl2br}&nbsp;&nbsp;
                    <br />
                    <strong>Descripci&oacute;n:</strong>
                    {assign var=name value=$item.anx[i].description|escape:"htmlall"}
                    {$name|nl2br}&nbsp;&nbsp;
                  </td>
                  
                  <td align="left">
                   {if $item.anx[i].attachedExt neq "" }			
                      <a href="{$getModule}&accion=itemDownloadAnnexe&id={$item.anx[i].itemId}">
                        <img src="{$templateDir}images/icon/limit.gif" title="Descargar archivo"/>
                      {$item.anx[i].attachedName|escape:"html"}</a>
                      &nbsp;&nbsp;
                        {math equation="x / y / y" x=$item.anx[i].attachedSize y=1024 format="%.2f"}
                        <b>Mb.</b>
                    {/if}
                  </td>
                  
                  
                  <td align="center" >
                    <a href="javascript:void(0);" onclick="addNewAnnexe({$item.anx[i].itemId},'update');">
    		          <img src='{$templateDir}/images/icon/modificar.gif' border="0" title="Modificar"/>
                    </a>
                    {assign var=nameaux value=$item.anx[i].name|replace:"'":"&#039;"}
            		<a href="javascript:void(0);" onclick="annexeDelete({$item.anx[i].itemId},'{$nameaux|escape:"htmlall"}')">
    		      	  <img src='{$templateDir}/images/icon/delete.png' title="Eliminar" border="0" />
                    </a>
                  </td>
                </tr>
            {/section}
          </tbody>
        
      {else}
       
            <tr>
              <td> <div class="labelNoregister"> No existe registro </div></td>
            </tr>
          
      {/if}
      </table>
     <!-- <b>Nota.- </b>Solo se podra anexar los siquientes documentos:
      <ul>
        <li>Mapa de ubicaci&oacute;n del sistema de riego en carta IGM Esc. 1:50.000 o 1:250.000</li>
        <li>Mapa de la cuenca de aporte</li>
        <li>C&aacute;lculo de los aforos realizados</li>
        <li>Fotograf&iacute;as con su respectiva descrpci&oacute;n</li>
        <li>Archivo magn&eacute;tico de la ficha de inventario y Anexos</li>
      </ul>-->
 </div>

