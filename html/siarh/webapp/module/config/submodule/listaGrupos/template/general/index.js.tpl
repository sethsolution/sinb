{literal}<script>
    
    var urlVerificarUser = '{/literal}{$getModule}&accion={$subcontrol}{literal}_verificarUser';
    var urlListInstitucion = '{/literal}{$getModule}&accion={$subcontrol}{literal}_getInstitucion';
    var urlVerificarUsuario = '{/literal}{$getModule}&accion={$subcontrol}{literal}_verificarUsuario';
    
    var idficha = '{/literal}{$id}{literal}';
    var lastuser = '{/literal}{$item.usuario|trim}{literal}';
    var verifyProcess=0,codeRight=0;
        
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
    if($.trim($("#form_nombre").val())==""){
		    $.msgbox('Ingrese el nombre del grupo');
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
  
  function copiarMasiva(id){

       $.msgbox("&iquest;Esta seguro de borrar todos los permisos<br/> y asignar nuevos permisos a todos los<br/> usuarios relacionados.?"
                 ,{type: "confirm"
                   ,buttons : [{type: "submit", value: "Si"},
                               {type: "cancel", value: "No"}]}
                 ,function(result){
                    if(result){
                      copiarDatos(id);
                    }
                 });
    }

  function copiarDatos(id){
        boxyLoadingShow();
        randomnumber=Math.floor(Math.random()*11);
        
        $.get( "{/literal}{$getModule}{literal}",
               {accion:"general_copiarDatos", random:randomnumber, id:id}, 
               function(res){
                   if(res.res == 1){
                       boxyLoading.hide();
                   }else if(res.res == 2){
                     $.msgbox( 'ERROR: al copiar, '+res.msg+'.'
                                  ,{type: "error"
                                    ,buttons : [{type: "submit", value: "Aceptar"}]
                                   }
                                  ,function(result) {
                                     boxyLoading.hide();
                                   }
                                 ); 

                   }else{                                                            
                       $.msgbox( 'ERROR: '+res.msg+'. Notifique al Adminsitrador.'
                                  ,{type: "error"
                                    ,buttons : [{type: "submit", value: "Aceptar"}]
                                   }
                                  ,function(result) {
                                     dialogForm.dialog("close");
                                     boxyLoading.hide();
                                   } 
                                 ); 
                   }//END IF
           },"json");
    }

</script>{/literal}