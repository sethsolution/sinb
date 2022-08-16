{literal}<script>
    var options = {beforeSubmit:showRequest
                   , success:showResponse
                   , dataType: 'json'
                   , clearForm: true
                   , data: { accion: 'saveItemsql', tabla:'{/literal}{$tablaGuardar}{literal}', caso: '{/literal}{$accion}{literal}', id:'{/literal}{$id}{literal}'}}; 
    
    var itemForm = $('form#itemForm').ajaxForm(options);

    
    function cancelReg(){
	  $.msgbox("Seguro de cancelar el registro?<br>Recuerde que los datos no seran registrados.", {
	                       textBoxBtnOk: 'Si',    textBoxBtnCancel: 'No',
	                       onComplete:function(returnvalue) {
		                                      if(returnvalue){mDialog[1].dialog("close");}
	                                   }
	                     });
    }
    
    function verificaForm(){
	     boxyLoadingShow();
         return true;
    }

    function showRequest(formData, jqForm, op) { 
    	var res = verificaForm();
        return res; 
    }
    
    function redibujar(){
         $.post(urlDatos, {catalogo:'{/literal}{$tablaGuardar}{literal}'},function(response, status){
            $("#modalDialog_Catalogo #contentTable").html(response);  
        });        
    }
    function showResponse(responseText, statusText)  { 	
    	if(responseText.res == 1){
          redibujar();
          mDialog[1].dialog("destroy");
          boxyLoading.hide();  
             
    	}else if(responseText.res == 2){
    	  $.msgbox(responseText.msg
                     ,{onComplete:function(returnvalue) {
                                      redibujar();
                                      mDialog[1].dialog("destroy");
                                      boxyLoading.hide();   
                                  }
                      });
    	}else{
    	  $.msgbox("ERROR: Notifique al administrador"
                     ,{onComplete:function(returnvalue) {
                                      redibujar();  
                                      mDialog[1].dialog("destroy");
                                      boxyLoading.hide();   
                                  }
                     }); 
    	}
    }
    
    function submitForm(){
      itemForm.submit();
    }
</script>{/literal}