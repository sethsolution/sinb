{literal}  
  <script>
    function profileUpdate(){
      
      $("#editProfile").hide();
      var url = '{/literal}{$getModule}{literal}&accion=edit';
      $.ajax({ type: "POST",  url: url,
               success: function(msg){ $('#profileItem').html(msg);
                                       }});
                                       
    }
    
    function cancelEdit(){
        location.reload();
    }
    
  </script>
{/literal}

<!--
<table width="100%" cellspacing="0" cellpadding="0" border="0">
  <tbody>
    <tr>
      <td class="titulo2"> <img src="./template/user/images/icon/bullet3.gif" /> Perfil de Usuario</td>
    </tr>
  </tbody>
</table>-->
<div class="usualInfo">
<table border="0" cellpadding="0" cellspacing="0" width="100%" class="kardex">
  <tr>
    <td colspan="5" class="sectionItem"> <strong>PERFIL</strong> </td>    
  </tr>
  <tr>
    <td colspan="5" class="titulo2">
      DATOS USUARIO &nbsp;&nbsp;
      <a href="javascript:void(0);" onclick="profileUpdate({$itemConte.memberId})" id="editProfile" >
        <img src="{$templateDir}images/icon/modificar.gif" border="0" title="Editar Datos"/>Editar
      </a>   
    </td>
  </tr>
  <tr>
    <td class="dataProfile" width="5%">&nbsp;</td>
    <td>
        
      <div id="profileItem" class="dataProfile">
        <table border="0">
          <tr>
            <td class="dataProfile" width="25%" rowspan="8"><br />
              <img src="data/{$module}/user/portada/small/{$itemConte.memberId}.jpg?id={math equation='rand(10,100)'}" class="photoProfile" />  
            </td>    
         
            <td class="dataProfile" width="15%" align="right">
              <b>Nombre(s):&nbsp;</b>
            </td>
            <td class="dataProfile" >    
              {$itemConte.name}&nbsp;{$itemConte.lastName}
            </td>
          </tr>
          <tr>
            <td class="dataProfile" align="right">
              <b>Tel&eacute;fono:</b>
            </td>
            <td class="dataProfile" >
              {$itemConte.phone}        
            </td>
          </tr>
          
          <tr>
            <td class="dataProfile" align="right">
              <b>Celular:</b>
            </td>
            <td class="dataProfile" >  
              {$itemConte.mobile}      
            </td>
          </tr>
  
        <tr>
          <td class="dataProfile" align="right">
            <b>E-mail:</b>
          </td><td class="dataProfile" >  
            {$itemConte.email}    
          </td>
        </tr>       
        <tr>
          <td class="dataProfile" align="right">
            <b>Direcci&oacute;n:</b>
          </td><td class="dataProfile" >  
            {$itemConte.address}    
          </td>
        </tr>  
        <tr>
          <td class="dataProfile" align="right">
            <b>Usuario:</b>
          </td><td class="dataProfile" >  
            {$itemConte.user}  
          </td>
        </tr> 
        <tr>
          <td class="dataProfile" align="right">
            <b>Tipo de usuario:</b>
          </td><td class="dataProfile" >  
            {if $itemConte.typeUser eq 0 OR $itemConte.typeUser eq 1}
              Administrador
            {elseif $itemConte.typeUser eq 2}
              Usuario normal
            {elseif $itemConte.typeUser eq 3}
              Dealer
            {/if}  
          </td>
        </tr> 
      </table>
    </div>
    
    </td>
    <td class="dataProfile" width="10%">&nbsp;</td>  
  </tr>    
    
  <tr>
    <td colspan="5" class="dataProfile">&nbsp;</td>
  </tr>
</table>
</div>
