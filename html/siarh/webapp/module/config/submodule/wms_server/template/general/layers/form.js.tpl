{literal}<script>

var options = { beforeSubmit:showRequest,
                dataType:'json',     
	            success:showResponse};
                 
$('#itemForm_photo').ajaxForm(options);

$(document).ready(function (){
   $("#btn_closePhoto").bind("click", function (){
     dialogPhoto.dialog("close"); 
   }); 

	$( "#slider-range-max" ).slider({
			range: "max",
			min: 0,
			max: 1,
			value: {/literal}{if $item.opacidad == ''}0.5{else}{$item.opacidad}{/if}{literal},
			step: 0.1,
			slide: function( event, ui ) {
			$( "#opacity_num" ).html( ui.value );
			$( "#form_opacidad" ).val( ui.value );
			$( "#box" ).css("opacity", ui.value );
			}
	});
});

function verificaForm(){
    
    if($.trim($("#title").val()) == ""){
		$.msgbox('Ingrese nombre');
		return false;
	}else if($.trim($("#layer").val()) == ""){
		$.msgbox('Ingrese layer');
		return false;
	}else{
	    boxyLoadingShow();
	    return true;   
	}	
	return false;
}

function showRequest(formData, jqForm, options) { 
	var res = verificaForm();
    return res; 
} 

function showResponse(responseText, statusText)  {
    
    if(responseText.res == 1){
        oTableRPhoto.fnDraw();
        boxyLoading.hide();
        dialogPhoto.dialog("close"); 
        
    }else{
       $.msgbox( 'ERROR: '+responseText.msg+'. <br />Vuelva a intentarlo mas tarde'
                 , {type: "error"}
                 , function(result){
                     boxyLoading.hide();  
                     dialogPhoto.dialog("close");       
                   }); 

    } 
}

function cancelReg(){
    $.msgbox( "Seguro de cancelar el registro?<br>Recuerde que los datos no seran registrados o actualizados"
			 ,{type: "error"
                    ,buttons : [{type: "submit", value: "Aceptar"}]
                   }
                  ,function(result) {
					 dialogPhoto.dialog("close");
                   } 
			);
}
</script>{/literal}