
{literal}<script>
urls='{/literal}{$getModule}{literal}';
$(document).ready(function() {
   $( "#tabsUser" ).tabs({
        ajaxOptions:{ error: function(xhr,status,index,anchor){
                                            $( anchor.hash ).html(msgNotab);
                                         }
                                },
		select: function(event,ui){},
		load:   function(event,ui){/*console.log("cargado");*/boxyLoading.hide();},
		create: function(event,ui){ },
		beforeLoad: function( event, ui ) {
			/*console.log("cargando......");*/
			boxyLoadingShow();
					  ui.jqXHR.error(function() {
									   ui.panel.html("Couldn't load this tab. We'll try to fix this as soon as possible. " +
													 "If this wouldn't be a demo." );
									});
					},
		beforeActivate: function ( event, ui ){
							ui.oldPanel.html("");
						},
		activate: function ( event, ui ){ },
		selected: 1
    });
       
    //boxyLoading.close();     
});//END DOCUMENT READY
/**
funciones que se estan usando.
activar
    -$("#passwordPerf").removeAttr("disabled");
desactivar
    -$("#passwordPerf").attr("disabled", true);
tootip
    $("#userEdit :input").tooltip({
 
      // place tooltip on the right edge
      position: "right",
 
      // a little tweaking of the position
      offset: [100, 100],
 
      // use the built-in fadeIn/fadeOut effect
      effect: "fade",
 
      // custom opacity setting
      opacity: 0.7
 
      });
**/
/*funcion que habilita los campos de texto y oculta el boton editar, habilita los botones de guardar y editar*/
function editarDatosSistemaPerf(){
    $("#edits").hide();
    $("#passwordPerf").removeAttr("disabled");
    $("#nombrePerf").removeAttr("disabled");
    $("#apellidoPerf").removeAttr("disabled");
    $("#guadars").show();
    $("#cancels").show();
    $(".info").hide();
}
/*funcion que deshabilita los campo de texto, oculta los botones de guardar y cancelar, habilita en boton editar*/
function cancelDatosSistemaPerf(){
    $("#guadars").hide();
    $("#cancels").hide();    
    $("#passwordPerf").attr("disabled", true);
    $("#nombrePerf").attr("disabled", true);
    $("#apellidoPerf").attr("disabled", true);
    $("#edits").show();
    $(".info").show();
}
/*funcion que guarda los datos de los campos de texto que se habilito para editar*/
function guardarDatosSistemaPerf(){
	boxyLoadingShow();
    var pass = $( "#passwordPerf" ),nombre = $( "#nombrePerf" ),apell = $( "#apellidoPerf" );
        
    var estpassVal=(pass.val()!="" ?(checkLength( pass, "errorpass", 3, 30,"ContraseÒa" )==true?(checkRegexp( pass,  /^([0-9a-zA-Z])+$/, "Valores permitidos : a-z 0-9", "errorpass","ContraseÒa" )==true?true:false):false):true);
    var estnombVal=(checkLength( nombre, "errornomb", 3, 30,"Nombre" )==true?(checkRegexp( nombre, /^[a-z A-Z ·ÈÌÛ˙A…Õ”⁄—Ò]+$/i, "Valores permitidos a-z, 0-9." , "errornomb","Nombre")==true?true:false):false);
    var estapelVal=(apell.val()!=""?(checkLength( apell, "errorapell", 3, 30,"Apellidos" )==true?(checkRegexp( apell, /^[a-z A-Z ·ÈÌÛ˙A…Õ”⁄—Ò]+$/i, "Valores permitidos a-z, 0-9.", "errorapell","Apellidos" )==true?true:false):false):true);
    setRemoveClass(pass,"errorpass");
    setRemoveClass(nombre,"errornomb");
    setRemoveClass(apell,"errorapell");
//    alert("-"+estnombVal+"-");
    if(estpassVal && estnombVal && estapelVal){
        $.get( urls,
            {accion:"guardarDatosUser",nombre:nombre.val(),apell:apell.val(),pass:pass.val()}, 
            function(dato){
             //   alert(dato.res);
                if(dato.res==1){
                    $("#estadoRegistroPerf").html('<div id="temdiv"><img src="template/user/images/icon/accept.png"/> Se '+dato.msg+' correctamente</div>');
                    setTimeout(function() {
                        $("#temdiv").remove();
                    }, 500 ); 
                    boxyLoading.hide();        
                }else{
                    boxyLoading.hide(); 
                    Sexy.alert("Error: No se logr&oacute; actualizar en la BD.");
                }	       
            },
        "json");
    }else{ 
        boxyLoading.hide();  
        Sexy.alert("Verifique que los datos que ingreso esten correctos.");
         
    }  
}
function setRemoveClass(idDivName,n){
    setTimeout(function() {
        $("#"+n).html("");
        idDivName.removeClass("ui-state-error");
        $("#"+n).removeClass("ui-state-error");
    }, 700 );
    
}
function editarDatosPersonalesPerf(){
    $("#editss").hide();
    $("#telefonoPerf").removeAttr("disabled");
    $("#celularPerf").removeAttr("disabled");
    $("#emailPerf").removeAttr("disabled");
    $("#resizablePerf").removeAttr("disabled");
    $("#archivos").removeAttr("disabled");
    $("#guadarss").show();
    $("#cancelss").show();
    $(".info").hide();
}
function cancelDatosPersonalesPerf(){    
    $("#guadarss").hide();
    $("#cancelss").hide();
    $("#telefonoPerf").attr("disabled", true);
    $("#celularPerf").attr("disabled", true);
    $("#emailPerf").attr("disabled", true);
    $("#resizablePerf").attr("disabled", true);
    $("#archivos").attr("disabled", true);
    $("#editss").show();
    $(".info").show();
}
function imagenSetUsers(){
    
    if(validarformatoImagen($("#archivos").val())){
		boxyLoadingShow();
		
        var archivos = document.getElementById("archivos");//Damos el valor del input tipo file
        var archivo = archivos.files; //Obtenemos el valor del input (los arcchivos) en modo de arreglo
        
        //El objeto FormData nos permite crear un formulario pasandole clave/valor para poder enviarlo, este tipo de objeto ya tiene la propiedad multipart/form-data para poder subir archivos
        var data = new FormData();
        
        //Como no sabemos cuantos archivos subira el usuario, iteramos la variable y al
        //objeto de FormData con el metodo "append" le pasamos calve/valor, usamos el indice "i" para
        //que no se repita, si no lo usamos solo tendra el valor de la ultima iteracion
        data.append('portada',archivo[0]);
        data.append('texto','');  
        //console.log("ingresa...:"+urls);      
        $.ajax({
            url:urls+"&accion=cargarImagen", //Url a donde la enviaremos
            type:'POST', //Metodo que usaremos
            contentType:false, //Debe estar en false para que pase el objeto sin procesar
            data:data, //Le pasamos el objeto que creamos con los archivos
            processData:false, //Debe estar en false para que JQuery no procese los datos a enviar
            dataType: 'json',
            cache:false //Para que el formulario no guarde cache
            }).done(function(dato){
                if(dato.estadoUplod==1){
                    if(dato.res==1){
                        $("#imagencargado").html("");
                        $("#imagencargado").html(dato.msg);
                        boxyLoading.hide(); 
                    }else{
                        boxyLoading.hide(); 
                        Sexy.alert(" Error: Al registra la imagen"+dato.msg);//jpg,png
                    }
                }else{
                    boxyLoading.hide(); 
                    Sexy.alert(" Error: Al Subir la imagen."+dato.msg);//jpg,png
                }
             //Mostrara los archivos cargados en el div con el id "Cargados"
        });
            
    }else{
    	Sexy.alert(" Error: Formato no permitido \n formatos permitidos(.jpg, .png) ");//jpg,png
    }
    
    
}
function validarformatoImagen1(img){
	var tipoimagen=false;
	var imgArray = img.split('.');
	var lengthTex=imgArray.length;//String(cadena1.toLowerCase()) == String(cadena2.toLowerCase())
	if(String(imgArray[lengthTex-1].toLowerCase())=="jpg" || String(imgArray[lengthTex-1].toLowerCase())=="png"){
		tipoimagen=true;
	}
	return tipoimagen;
}
function guardarDatosPersonalesPerf(){
    var telefono = $( "#telefonoPerf" ),celular = $( "#celularPerf" ),email = $( "#emailPerf" ),resizable = $( "#resizablePerf" );
    var estteleVal=(telefono.val()!="" ?(checkLength( telefono, "errortele", 6, 9,"Telefono" )==true?(checkRegexp( telefono,/^[0-9]+$/i, "Valores permitidos : 0-9." , "errortele","Telefono")==true?true:false):false):true);
    var estceluVal=(celular.val()!="" ?(checkLength( celular, "errorcelu", 6, 9,"Celular" )==true?(checkRegexp( celular, /^([0-9])+$/, "Valores permitidos : 0-9", "errorcelu","Celular" )==true?true:false):false):true);
    var estemaiVal= (email.val()!="" ?(checkLength( email, "erroremai", 3, 30,"Email" )==true?(checkRegexp( email, /^((([a-z]|\d|[!#\$%&'\*\+\-\/=\?\^_`{\|}~]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])+(\.([a-z]|\d|[!#\$%&`'\*\+\-\/=\?\^_{\|}~]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])+)*)|((\x22)((((\x20|\x09)*(\x0d\x0a))?(\x20|\x09)+)?(([\x01-\x08\x0b\x0c\x0e-\x1f\x7f]|\x21|[\x23-\x5b]|[\x5d-\x7e]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(\\([\x01-\x09\x0b\x0c\x0d-\x7f]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]))))*(((\x20|\x09)*(\x0d\x0a))?(\x20|\x09)+)?(\x22)))@((([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])*([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])))\.)+(([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])*([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])))\.?$/i, "Ejemplo: miocorreo@hotmail.com. :" , "erroremai","Email")==true?true:false):false):true);
  
   //  var estdireVal=(resizable.val()!="" ?(checkLength( resizable, "errordire", 3, 100,"Direccion" )==true?(checkRegexp( resizable," /^[0-9 a-z A-Z ·ÈÌÛ˙A…Õ”⁄—Ò  ]+$/i", "Valores permitidos a-z, 0-9.",  "errordire","Direccion" )==true?true:false):false):true);
    //alert(estemaiVal);
   // setRemoveClass(telefono,"errortele");
   // setRemoveClass(celular,"errorcelu");
   // setRemoveClass(email,"erroremai");
 //   setRemoveClass(email,"errordire");
 
    if(estteleVal && estceluVal && estemaiVal /*&& estdireVal*/){
		boxyLoadingShow();
		
        $.get( urls,
            {accion:"guardarDatosUserDos",telefono:telefono.val(),celular:celular.val(),
            email:email.val(),direccion:resizable.val()}, 
            function(dato){
                 if(dato.res==1){
                    $("#estadoRegistrodosPerf").html('<div id="temdiv"><img src="template/user/images/icon/accept.png"/> Se '+dato.msg+' correctamente</div>');
                    setTimeout(function() {
                        $("#temdiv").remove();
                    }, 500 );  
                    boxyLoading.hide();       
                }else{
                    boxyLoading.hide(); 
                    Sexy.alert("Error: No se logr&oacute; actualizar en la BD.");
                }	       
            },
        "json");
    } 
    boxyLoading.hide();  
}

</script>{/literal}