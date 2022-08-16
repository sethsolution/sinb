{literal}
<script type="text/javascript" src="js/jQuery-Mask-Plugin-master/dist/jquery.mask.min.js"></script>
<script type="text/javascript" src="js/seth/jquery.control.js"></script>

<script>
    var idficha = '{/literal}{$id}{literal}';
    var lastuser = '{/literal}{$item.usuario|trim}{literal}';
    var verifyProcess=0,codeRight=0;

    var urlVerificarUser = '{/literal}{$getModule}&accion={$subcontrol}{literal}_verificarUser';
    var urlListInstitucion = '{/literal}{$getModule}&accion={$subcontrol}{literal}_getInstitucion';
    var urlListGrupo = '{/literal}{$getModule}&accion={$subcontrol}{literal}_getGrupo';
    var urlVerificarUsuario = '{/literal}{$getModule}&accion={$subcontrol}{literal}_verificarUsuario';
    var urlActualizar = '{/literal}{$getModule}&accion={$subcontrol}{literal}_update&id='+idficha;
    

        
    var options = {beforeSubmit:showRequest
                   ,dataType: 'json'
                   ,success:showResponse
                   ,data:{accion:'{/literal}{$subcontrol}_item{$accion}sql{literal}'
                         ,itemId:idficha
                         ,lastuser:lastuser}}; 
    
    $('#itemFormGral').ajaxForm(options);
    
$(document).ready(function (){
    
      
       $(".itemFilter").chosen({width: "260px"
                        ,no_results_text: "No se encontraron resultados!"});

       //evento para boton Seleccionar Proyecto 
       $("#btn_viewInstitucion").add("div#institucionName").click(function (){
          searchInstitucion('Seleccionar Institucion',{});
        });

              //evento para boton Seleccionar Proyecto 
       $("#btn_viewGrupo").add("div#grupoName").click(function (){
          searchGrupo('Seleccionar Grupo',{});
        });
       
       $('#form_usuario').change(function(){
         verificarUsuario();
       });

        //evento para boton Seleccionar Fiv 
       $("#btn_copyGrupo").click(function (){
          updatePagina();
       });

       $("#form_tipoUsuario").change(function(){
        var valor = $(this).val();
          if (valor == 1){
            $("#grupoShow").hide("fade");
            $("#grupoShow2").hide("fade");
          }else{
            $("#grupoShow").show("fade");
            $("#grupoShow2").show("fade");
          }
       });

       $("#form_tipoUsuario").trigger("change");
       
       $("#portada").change(function() {
            load_file(this.id,this.value)
        });
});//END DOCUMENT READY


function load_file(id,ext){
   if(validateExtension(ext) == false){
      $.msgbox('Seleccione una fotograf&iacute;a en formato .JPG o .JPEG <br /> El siguiente archivo es invalido: <br /><b>'+ext+'</b>'
                   ,{ buttons : [{type: "submit", value: "Aceptar"}]
					});
      $("#portada").val("");
      $("#portada").focus();
      return;
   }
}
function validateExtension(v){
      var allowedExtensions = new Array("jpg","JPG","jpeg","JPEG");
      for(var ct=0;ct<allowedExtensions.length;ct++)
      {
          sample = v.lastIndexOf(allowedExtensions[ct]);
          if(sample != -1){return true;}
      }
      return false;
}
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
    

    /*Obtenemos el lsitado de las instituciones*/
    function searchGrupo(title,data){
        dialogView.dialog("option","title",title);
        dialogView.dialog("option","width",500);
        dialogView.dialog("option","height",550);
        dialogView.dialog("open");
        
        $.post(urlListGrupo,data
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

    /*if($.trim($("#idInstitucion").val())=="" || $.trim($("#idInstitucion").val())==0){
		$.msgbox('Ingrese una instituci&oacute;n ');
		return false;
	}else */if(!$('#coordinador_0').is(':checked') && !$('#coordinador_1').is(':checked')){
    $.msgbox('Seleccione si es Coordinador');
    return false;
  }else if( portada!="" && (String(imgArray[imgArray.length-1].toLowerCase())!="jpg" & String(imgArray[imgArray.length-1].toLowerCase())!="png")) {
	   $.msgbox('Ingrese un formato de imagen valida. (.jpg o .png)');
		return false;
	}else if($.trim($("#form_nombre").val())==""){
		$.msgbox('Ingrese el nombre del usuario');
		return false;
	}else if($("#form_apellido").val() == ""){
		$.msgbox('Ingrese el apellido d elusuario');
		return false;
	}else if( $.trim($("#email").val())!="" && ($("#email").val().indexOf('@', 0) == -1 || $("#email").val().indexOf('.', 0) == -1) ){
	    $.msgbox('Ingrese un correo electr&oacute;nico valido');
		return false;
	}else if($.trim($("#form_usuario").val())==""){
		$.msgbox('Ingrese un nombre de usuario');
		return false;
	}else if(verifyProcess){
        $.msgbox('Aguarde la comprobaci&oacute;n del usuario');
	    return false;
    }else if(codeRight){
        $.msgbox('Compruebe el nombre de usuario');
  		return false;
    }else if($.trim($("#form_password").val())=="" && "{/literal}{$accion}{literal}"=="new" ){
		$.msgbox('Ingrese una contraseña');
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
                     dialogForm.dialog("close");
                     boxyLoading.hide();
                   }
                 ); 
        
    }else{
        $.msgbox( 'ERROR: '+responseText.msg+'. Consulte con el Adminsitrador.'
                  ,{type: "error"
                    ,buttons : [{type: "submit", value: "Aceptar"}]
                   }
                  ,function(result) {
                     dialogForm.dialog("close");
                     boxyLoading.hide();
                   } 
                 ); 
    }
  }
  
  function updatePagina(){
      
      grupoId = $("#idGrupo").val();
      
      if (grupoId != ""){
        var accion ="update";
        data = {grupoId: grupoId, tipoAccion:accion};
        
        if(accion==='update'){
          $.msgbox("&iquest;Esta seguro de importar datos del grupo seleccionado?.\n\t Se eliminara todos los  permisos registrados para este usuario."
                  ,{type: "confirm"
                    ,buttons: [{type:"submit", value:"Si"}
                              ,{type:"cancel", value:"No"}]  
                   }
                  ,function (res){
                    
                    if(res!==false){
                        boxyLoading.show();
                        migrarDatos(data);
                    }
                    
                   });
                   
        }else{
            boxyLoading.show();
            migrarDatos(data);
        }
        
      }else{
        $.msgbox('Seleccione un Grupo para obtener los datos');
      }//END IF
      
    }//END IF
    
    function migrarDatos(data){
        
        $.post(urlActualizar
           ,data 
           ,function (res, txtStatus, jqXHR){
                boxyLoading.hide();
                
                if(txtStatus=='success'){
                  
                  if(res.res==1){
        
                      refrescarPagina(res.id);  
                    
                  }else{
                    $.msgbox(''+res.msg);
                  }  
                  
                }else{
                  $.msgbox('Error con la conexion al Servidor.'); 
                }
                 
          },"json");//END $:POST

    }
    
    function refrescarPagina(id){
        location = "{/literal}{$getModule}{literal}&accion=itemUpdate&id="+idficha+"&type=update";
    }
    
</script>{/literal}