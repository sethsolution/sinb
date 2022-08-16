{literal}<script>
    var idficha = '{/literal}{$id}{literal}';
    var lastuser = '{/literal}{$item.usuario|trim}{literal}';
    var verifyProcess=0,codeRight=0;

    var urlActualizar = '{/literal}{$getModule}&accion={$subcontrol}{literal}_update&id='+idficha;
    

        
    var options = {beforeSubmit:showRequest
                   ,dataType: 'json'
                   ,success:showResponse
                   ,data:{accion:'{/literal}{$subcontrol}_item{$accion}sql{literal}'
                         ,itemId:idficha
                         ,lastuser:lastuser}}; 
    
    $('#itemFormGral').ajaxForm(options);
    
    $(document).ready(function (){
      
        
    });//END DOCUMENT READY
    //Funcion que valida duplicidad de nombre de usuario


    /* Funcion que valida los campos de una ficha previo a ser guardado*/
    function verifica(){
	 if($.trim($("#form_nombre").val())==""){
		$.msgbox('Ingrese el nombre del Servidor');
		return false;
	}else if($("#form_url").val() == ""){
		$.msgbox('Ingrese la URL del Servidor');
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