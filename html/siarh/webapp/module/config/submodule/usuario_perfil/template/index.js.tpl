{literal}<script>
    
    var urlVerificarUser = '{/literal}{$getModule}&accion={literal}verificarUser';
    var urlListInstitucion = '{/literal}{$getModule}&accion={literal}getInstitucion';
    var urlVerificarUsuario = '{/literal}{$getModule}&accion={literal}verificarUsuario';
    
    var idficha = '{/literal}{$id}{literal}';
    var lastuser = '{/literal}{$item.usuario|trim}{literal}';
    var verifyProcess=0,codeRight=0;
        
    var options = {beforeSubmit:showRequest
                   ,dataType: 'json'
                   ,success:showResponse
                   ,data:{accion:'{/literal}item{$accion}sql{literal}'
                         ,itemId:idficha
                         ,lastuser:lastuser}}; 
    
    $('#itemFormGral').ajaxForm(options);
    
    $(document).ready(function (){
       $('#form_usuario').change(function(){
         verificarUsuario();
       });
        
    });//END DOCUMENT READY
    //Funcion que valida duplicidad de nombre de usuario
    function verificarUsuario(){
//        codeRight = 1;
        verifyProcess = 1;
      
        $('#msgUsuario').html('<div style="width:150px;background-color:#fffbe7;border:1px solid #fff372; padding:2px; margin:4px 2px;"><img src="images/loading/loading.gif" style="width:15px;"/>Verificando Usuario...</div>');
        
        $.post(urlVerificarUsuario
               ,{currentUser:$.trim($("#form_usuario").val()), lastUser:lastuser}
               ,function(res){
                   if(res.res == 0){
                     $('#msgUsuario').html('<div style="width:90%;background-color:#e2ffdb;border:1px solid #51de31; padding:2px; margin:4px 2px;"><img src="template/user/images/icon/active.png" style="width:15px;"/>&nbsp;'+res.msg+'</div>');
                     codeRight = 0;
                   }else{
                     $('#msgUsuario').html('<div style="width:90%;background-color:#ffccbc;border:1px solid #ff0000; padding:2px; margin:4px 2px;"><img src="template/user/images/icon/delete.gif" style="width:15px;"/>&nbsp;'+res.msg+'</div>');
                     codeRight = 1;
                   }//END IF
                   
                   verifyProcess = 0;
               }//END FUNCTION
               ,'json'
        );//END POST
        
    }
    
    /*Obtenemos el lsitado de las instituciones*/
    function searchInstitucion(title,data){
        dialogView.dialog("option","title",title);
        dialogView.dialog("option","width",500);
        dialogView.dialog("option","height",550);
        dialogView.dialog("open");
        
        $.post(urlListInstitucion,data
               ,function (res, txtStatus, jqXHR){
                 if(txtStatus=='success'){
                    contentDialogView.html(res);
                 }else{
                   msgDialogView.html("Error al recibir la informacion.").attr("class","msgWrong"); 
                 }//END IF
                 
               }//END FUNCTION
               );//END POST
        
    }//END FUNCTION
    
    /* Funcion que valida los campos de una ficha previo a ser guardado*/
    function verifica(){
    var portada = $("#portada").val();
      var imgArray = portada.split('.');
      
  if( portada!="" && (String(imgArray[imgArray.length-1].toLowerCase())!="jpg" & String(imgArray[imgArray.length-1].toLowerCase())!="png")) {
     $.msgbox('Ingrese un formato de imagen valida. (.jpg o .png)');
    return false;
  }else if($.trim($("#form_nombre").val())==""){
    $.msgbox('Ingrese el nombre del usuario');
    return false;
  }else if($("#form_apellido").val() == ""){
    $.msgbox('Ingrese el apellido d elusuario');
    return false;
  }else if( $.trim($("#email").val())!="" && ($("#email").val().indexOf('@', 0) == -1 || $("#email").val().indexOf('.', 0) == -1) ){
      $.msgbox('Ingrese un correo electrónico valido');
    return false;
  }else if($.trim($("#form_password").val()) != $.trim($("#form_passwordConfirmar").val())){
    $.msgbox('Los campos de contraseña no coinciden');
    return false;
  }else{
        boxyLoadingShow();
      return true;
  }
    
  return false;
  }
  
  /*  Funciones en el proceso de envio de formulario */
  function showRequest(formData, jqForm, op) { 
  var res = verifica();
    return res; 
  }
  
  function showResponse(responseText, statusText)  {
    if(responseText.res ==1){

      location = "{/literal}{$getModule}{literal}&accion=itemUpdate&id="+responseText.id+"&type=update";
       
    }else if(responseText.res ==2){
        boxyLoading.hide();
        $.msgbox( 'ERROR: '+responseText.msg+'.'
                  ,{type: "error"
                    ,buttons : [{type: "submit", value: "Aceptar"}]
                   }
                  ,function(result) {
                     boxyLoading.hide();
                   }
                 ); 
        
    }else{
        $.msgbox( 'ERROR: '+responseText.msg+'. Consulte con el Adminsitrador.'
                  ,{type: "error"
                    ,buttons : [{type: "submit", value: "Aceptar"}]
                   }
                  ,function(result) {
                     boxyLoading.hide();
                   } 
                 ); 
    }
  }
  
    
</script>{/literal}