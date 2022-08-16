var urls="";
user_oTable=null;
modulo_oTable=null;
function iniciarUser(url){
	urls=url;	
}
function getTabla(){
    urlset=urls+"&accion=getListUsuarios";
    
    user_oTable = $('#listUsuarios').dataTable({     
                                "aoColumns": [{"aTargets": [0],"bSearchable": false, "bSortable": false, "sWidth": "40px", "sType": "numeric"},//# 
                                              {"aTargets": [1],"bSearchable": false, "bSortable": false, "sWidth": "65px", "sType": "string"},//Foto
                                              {"aTargets": [2],"bSearchable": true, "bSortable": true, "sWidth": "100px", "sType": "string"},//usuario
                                              {"aTargets": [3],"bSearchable": true, "bSortable": true, "sWidth": "120px", "sType": "string"},//nombre
                                              {"aTargets": [4],"bSearchable": true, "bSortable": true, "sWidth": "150px", "sType": "string"},//apellido 
                                              {"aTargets": [5],"bSearchable": true, "bSortable": true, "sWidth": "100px", "sType": "string"},//tipo de usuario
                                              {"aTargets": [6],"bSearchable": false, "bSortable": false, "sWidth": "90px", "sType": "string"},//ultimo ingreso  
                                              {"aTargets": [7],"bSearchable": false, "bSortable": false, "sWidth": "40px", "sType": "string","sClass": "center"},//estado
                                              {"aTargets": [8],"bSearchable": false, "bSortable": false, "sWidth": "15px", "sType": "string","sClass": "center"},//accion                                         
                                              ],//longitu
                                
                                /*"iCookieDuration": 60*60,//Duracion de 1 hora de los cookies
                                "bStateSave": true,*/
                                "aaSorting": [[2,'ASC']],
                                "bJQueryUI": true,
                                "sPaginationType": "full_numbers",
                                "bFilter": true,
                                "bRetrieve": true,
                                "bDestroy": true,
                                "fnInitComplete": function(oSettings, json) {
													
                                                    user_oTable.fnDraw(true);
													$(".sorting_1 img").css({
                                                        width : 60+"px",
                                                        height : 60+"px"
                                                    });
                                                    //$("#content_sirtable .dataTables_scrollBody").css({"height": "590px"});
                                                    /*if ( user_oTable.length > 0 ) {
                                            			user_oTable.fnAdjustColumnSizing();
                                            		}*/
                                                  },    
                                "fnDrawCallback": function( oSettings ) { 								
                                                    $(".sorting_1 img").css({
                                                        width : 60+"px",
                                                        height : 60+"px"
                                                    });
													boxyLoading.hide(); 
													},
                                "fnPreDrawCallback": function( oSettings ) {
                                                        /*$(".sorting_1 img").css({
                                                            width : 60+"px",
                                                            height : 60+"px"
                                                        });*/
                                                     },
                                                
                                "sDom": '<"H" lfr<"clear">>t<"F"ip<"clear">>',
                                "iDisplayLength": 20,
                                "bAutoWidth": false,
                                "aLengthMenu": [[20, 50], [20, 50]],
                                "oLanguage": { "sUrl": "js/DataTables/es_ES2.txt"},
                                "bProcessing":true,
                                "bServerSide":true,
                                "sAjaxSource":urlset,
                                //"sScrollY": "450px",
                                //"sScrollX": "100%",
                        		//"sScrollXInner": "150%",
                        		"bScrollCollapse": true,                                
                                 "fnServerParams": function ( aoData ) {
                                    aoData.push( { "name": "otherDatos", "value":[$("#tipousers").val()] } );
                                 }
                                /*,                                
                                "bPaginate": false*/
                                //"iDeferLoading": tamRowCompra
                         });//END DATABLE   
						 var oTableTools = new TableTools( user_oTable, {
                            "sSwfPath": "js/DataTables/extras/TableTools/media/swf/copy_csv_xls_pdf.swf",
                            "aButtons": [
            				"copy",
                            "pdf",
                            {
                                "sExtends": "text",
                                "sButtonText": "Print",
                                "fnClick": function ( nButton, oConfig) {  
                                    console.log("Print");
                                    getContemPrintDatosTem("listadatoUserDatos");
                                }
                            },
            				{
            					"sExtends":    "collection",
            					"sButtonText": "Guardar",
            					"aButtons":    [                                 
                                "csv",
                                "xls"/*,
                                {
                                    "sExtends": "text",
                                    "sButtonText": "Ficha PDF Formato Corto",
                                    "fnClick": function ( nButton, oConfig) { 
                                        if($("#lista_munici").val()!="-1" && $("#lista_munici").val()!=-1 && $("#lista_munici").val()!="" && datoprogramatipoA.join(",")!=""){
                                            getPdfporMunicipio();
                                        }else{
                                            Sexy.alert("Error : Debe de seleccionar un Municipio y Tipo de Programa");
                                        }                                        
                                    }
                                } */
                                ]
            				}
            			]
        				} );
        				
        				$('#listadatoUserDatos').before( oTableTools.dom.container );   
}
function getContemPrintDatosTem(iddiv){
    $('div').remove('#dialog-processoBarPrintdatos');
    $('.dataTables_scrollBody').removeAttr('style'); 
    //$("#dialog-processoBarPrintdatos").show();
    $(getContentDialogTemDatos()).dialog({
          height: 700,
          width: 1100,
          canMinimize: true,
          canMaximize: true,
          modal: true,
          dialogClass: "usuarioNodoPrintNV",
          close: function() { 
            //$("#printGraficoTodo").html(""); 
            //$("#printGraficoTodo").hide().fadeIn('fast');
            $( this ).dialog( "close" );//$("#dialog-processoBarPrintdatos").dialog("close");//'overflow','hidden'
            $('.dataTables_scrollBody').css({'overflow': 'auto', 'height': 200+'px', 'width': 100+'%'}); 
          },
          open:function(){
            var myTem=$('#'+iddiv).clone();
            $("#printGraficoTodo").html(myTem);
            $("#printGraficoTodo").hide().fadeIn('fast');
            $("#dialog-processoBarPrintdatos").show();
            $("#printGraficoTodo .DTTT_container").hide();
            $("#printGraficoTodo #titletabledatos thead tr th").removeAttr('style');
            //$("#grafi1").clone().appendTo("#printGraficoTodo");
            //DTTT_container       printGraficoTodo
          }
    });
} 
function getContentDialogTemDatos(){
    var temContDia='<div id="dialog-processoBarPrintdatos" title="Ventana Para Imprimir">';
    temContDia +='<img id="loadPrint" onclick=" printTools('+"'printGraficoTodo'"+')" src="images/icons/print.gif" style="cursor: pointer" />';
    temContDia +='<center><div id="printGraficoTodo"></div></center></div>';
    return temContDia;
}
function cambiarEstado(id,estado){
	boxyLoadingShow();	 
    $.get( urls,
    	   {accion:"registroUser_cambiarEstadodato",estado:(estado==0?1:0),settablaid:id}, 
    	   function(dato){
    	       if(dato.res==1){
    	           user_oTable.fnDraw();
				   boxyLoading.hide(); 
    	       }else{
					boxyLoading.hide(); 
    	           Sexy.alert("no se puede eliminar");
    	       }          
    	   },
        "json");
}
function cambiarDatos(id,estado){
    $("#registo").val(id);
       dialogTem();
}
function dialogTem(){
    $(getDialog()).dialog({
          height: 450,
          width: 700,
          canMinimize: true,
          canMaximize: true,
          modal: true,
          dialogClass: "usuarioNodo",
          close: function() {             
            $("#dialog-modalTem").dialog("destroy");
            removerNodo();
            user_oTable.fnDraw();
            $("#registo").val("0");
          },
          open:function(){  
            ejecutarTabs(); 
			console.log($("#registo").val());
			if($("#registo").val()=="0"){
				$( "#tabs" ).tabs( "option", "disabled", [1,2] );
			}			
          }
    });
}
function eliminar(id,estado){
	Sexy.confirm("Esta seguro de eliminar este registro?<br>Info<br>", 
				 {textBoxBtnOk: 'Si', textBoxBtnCancel: 'No',
				  onComplete:function(returnvalue) {
								  if(returnvalue){	
									boxyLoadingShow();
									  $.get( urls,
									   {accion:"registroUser_eliminardato",gettablaTem:id}, 
									   function(dato){
										   if(dato.res==1){
											   user_oTable.fnDraw();
											   boxyLoading.hide();
										   }else{
												boxyLoading.hide();
											   Sexy.alert(dato.msg);
										   }          
									   },
									"json");
								  }
							 }
	});
    
}
function getDialog(){	
    var temtex='<div id="dialog-modal" title="Datos de Usuario" >';   
    temtex+='<div id="contenidoDialog">'+getTabs();
    temtex+='</div></div>';
    return temtex;
}
function getTabs(){
    urlset1=urls+"&accion=getdatosSistema&regisestado="+$("#registo").val();
    urlset2=urls+"&accion=getdatosPersonales&regisestado="+$("#registo").val();
    urlset4=urls+"&accion=getdatosPermisos&regisestado="+$("#registo").val();
    var temtex='<div id="tabs">';
    temtex+='<ul>';
    temtex+='<li><a id="unohref" href="'+urlset1+'">Datos Sistema</a></li>';
    temtex+='<li><a id="doshref" href="'+urlset2+'">Datos Personales</a></li>';
    temtex+='<li><a  id="cuatrohref" href="'+urlset4+'">Permisos</a></li>';
    temtex+='</ul>';
    temtex+='<div id="tabs-1">';
    temtex+='<div id="resstade"> <input type="hidden" name="registo" id="registo" value="0" /></div>';
    temtex+='</div>';
    temtex+='</div>';
    return temtex;
}
function ejecutarTabs(){
     $( "#tabs" ).tabs({
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
    
}
function removerNodo(){
     $("body .usuarioNodo").remove();   
}
function addUser(){
     dialogTem();
}
function setRemoveClassU(idDivName,n){
    setTimeout(function() {
        $("#"+n).html("");
        idDivName.removeClass("ui-state-error");
        $("#"+n).removeClass("ui-state-error");
    }, 700 );
    
}
function verdatotipoUser(){
	//console.log($("#tipouserP").val());
}
function guardarDatosSistema(){
    var user = $( "#user" ),pass = $( "#password" ),nombre = $( "#nombre" ),apell = $( "#apellido" ),passd=$("#passss").val();
    
    var estuserVal=(checkLength( user, "erroruser", 3, 30,"Usuario" )==true?(checkRegexp( user, /^[0-9 a-z A-Z áéíóúAÉÍÓÚÑñ.]+$/i, "Valores permitidos : a-z, 0-9 ." , "erroruser","Usuario")==true?true:false):false);
    var estpassVal=(passd=="" || pass.val().length>0?(checkLength( pass, "errorpass", 3, 30,"Contraseña" )==true?(checkRegexp( pass,  /^([0-9a-zA-Z])+$/, "Valores permitidos : a-z 0-9", "errorpass","Contraseña" )==true?true:false):false):true);
    var estnombVal=(checkLength( nombre, "errornomb", 3, 30,"Nombre" )==true?(checkRegexp( nombre, /^[0-9 a-z A-Z áéíóúAÉÍÓÚÑñ.]+$/i, "Valores permitidos a-z, 0-9 ." , "errornomb","Nombre")==true?true:false):false);
    var estapelVal=(apell.val()!="" ?(checkLength( apell, "errorapell", 3, 30,"Apellidos" )==true?(checkRegexp( apell, /^[0-9 a-z A-Z áéíóúAÉÍÓÚÑñ.]+$/i, "Valores permitidos a-z, 0-9 .", "errorapell","Apellidos" )==true?true:false):false):true);
    setRemoveClassU(user,"erroruser");
    setRemoveClassU(pass,"errorpass");
    setRemoveClassU(nombre,"errornomb");
    setRemoveClassU(apell,"errorapell");
    var temurls="";
    if($("#registo").val()==0){
        temurls="registroUser_registraUser";
    }else{
        temurls="registroUser_updateUser";
    }
    if(estuserVal && estpassVal && estnombVal && estapelVal){
		boxyLoadingShow();
		 //console.log("dato-tipo-user"+$("#tipouserP").val());
        $.get( urls,
    	   {accion:temurls,user:user.val(),pass:pass.val(),tipouser:$("#tipouserP").val(),nombre:nombre.val(),apell:apell.val(),estado:$("#estado").val(),badeta:$("#registo").val()}, 
    	   function(dato){
    	      if(dato.res==1){				
                $("#registo").val(dato.id);
                $("#estadoRegistro").html('<div id="temdiv"><img src="template/user/images/icon/accept.png"/> Se '+dato.msg+' correctamente</div>');
                setTimeout(function() {
                    $("#temdiv").remove();
                }, 800 ); 
                $("#estadoRegistro").removeClass("ui-state-error");
                actualizarUrl('a#unohref',urls+"&accion=getdatosSistema&regisestado="+$("#registo").val());
                actualizarUrl('a#doshref',urls+"&accion=getdatosPersonales&regisestado="+$("#registo").val());
                actualizarUrl('a#cuatrohref',urls+"&accion=getdatosPermisos&regisestado="+$("#registo").val());
				//$( "#tabs" ).tabs( "option", "enable", [1,2] );
				$( "#tabs" ).tabs( "enable", 1 );
				$( "#tabs" ).tabs( "enable", 2 );
				boxyLoading.hide(); 
    	      }else{
				boxyLoading.hide(); 
				Sexy.alert(" Error: "+dato.msg);
    	      }	       
    	   },
        "json");
    }
}

function checkLength( o, n, min, max, cp ) {
    if ( o.val().length > max || o.val().length < min ) {
        o.addClass( "ui-state-error" );
        $("#"+n).html("Ingrese los datos Correctamente en el campo "+cp);
        $("#"+n).addClass( "ui-state-error" );
        return false;
    }else {
        $("#"+n).html("");
        o.removeClass("ui-state-error");
        $("#"+n).removeClass("ui-state-error");
        return true;
    }
}
function checkRegexp( o, regexp, n,cam,cp ) {
    if ( !( regexp.test( o.val() ) ) ) {
        o.addClass( "ui-state-error" );
        $("#"+cam).html(n+" :"+cp);
        $("#"+cam).addClass( "ui-state-error" );
        return false;
    } else {
        $("#"+cam).html("");
        o.removeClass("ui-state-error");
        $("#"+cam).removeClass("ui-state-error");
        return true;
    }
}
function EstadoUser(){
    if($("#estado").val()==0){
        $("#estado").val(1);
        $("#estUserss").html('<img src="template/user/images/icon/active.png" class="iconDetail" onclick="EstadoUser()"/>');
    }else{
        $("#estado").val(0);
        $("#estUserss").html('<img src="template/user/images/icon/deactive.png" class="iconDetail" onclick="EstadoUser()"/>');
        
    }
}
function actualizarUrl(campotex,newhref){
    $(campotex).attr({
       'title': 'Ventana',
       'href': newhref
    }); 
}
function seleccionado(){
    
    if(validarformatoImagen($("#archivos").val())){
        if($("#registo").val()!="" && $("#registo").val()!="0"){
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
            urlsetimage=urls+"&accion=registroUser_cargarImagen&regisestado="+$("#registo").val();
            $.ajax({
                url:urlsetimage, //Url a donde la enviaremos
                type:'POST', //Metodo que usaremos
                contentType:false, //Debe estar en false para que pase el objeto sin procesar
                data:data, //Le pasamos el objeto que creamos con los archivos
                processData:false, //Debe estar en false para que JQuery no procese los datos a enviar
                dataType: 'json',
                cache:false //Para que el formulario no guarde cache
                }).done(function(dato){
                    //console.log(dato.estadoUplod+"    ::    "+dato.res);
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
                        Sexy.alert(" Error: Al Subir la imagen.");//jpg,png
                    }
                 //Mostrara los archivos cargados en el div con el id "Cargados"
            });
        }else{
            Sexy.alert(" Error: <p>Modulo no permitido.<br />Debe de registrarse Primeramente para ingresar a este modulo.</p>");//jpg,png
        }        
    }else{
    	Sexy.alert(" Error: Formato no permitido \n formatos permitidos(.jpg, .png) ");//jpg,png
    }
    
    
}
function guardarDatosPersonales(){
    var telefono = $( "#telefono" ),celular = $( "#celular" ),email = $( "#email" ),resizable = $( "#resizable" );
    
    var estteleVal=(telefono.val()!="" ?(checkLength( telefono, "errortele", 6, 9,"Telefono" )==true?(checkRegexp( telefono, /^[0-9]+$/i, "Valores permitidos : 0-9." , "errortele","Telefono")==true?true:false):false):true);
    var estceluVal=(celular.val()!="" ?(checkLength( celular, "errorcelu", 6, 9,"Celular" )==true?(checkRegexp( celular,  /^([0-9])+$/, "Valores permitidos : 0-9", "errorcelu","Celular" )==true?true:false):false):true);
    var estemaiVal=(email.val()!="" ?(checkLength( email, "erroremai", 3, 30,"Email" )==true?(checkRegexp( email, /^((([a-z]|\d|[!#\$%&'\*\+\-\/=\?\^_`{\|}~]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])+(\.([a-z]|\d|[!#\$%&'\*\+\-\/=\?\^_`{\|}~]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])+)*)|((\x22)((((\x20|\x09)*(\x0d\x0a))?(\x20|\x09)+)?(([\x01-\x08\x0b\x0c\x0e-\x1f\x7f]|\x21|[\x23-\x5b]|[\x5d-\x7e]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(\\([\x01-\x09\x0b\x0c\x0d-\x7f]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]))))*(((\x20|\x09)*(\x0d\x0a))?(\x20|\x09)+)?(\x22)))@((([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])*([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])))\.)+(([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])*([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])))\.?$/i, "Ejemplo: miocorreo@hotmail.com. :" , "erroremai","Email")==true?true:false):false):true);
    setRemoveClassU(telefono,"errortele");
    setRemoveClassU(celular,"errorcelu");
    setRemoveClassU(email,"erroremai");
    var temurls="";
    var estadoUserTem=true;
    if($("#registo").val()==0){
        temurls="registroUser_registraUserPersonal";
        if(telefono.val()=="" && celular.val()=="" && email.val()=="" ){
            estadoUserTem=false;
        }
        
    }else{
        temurls="registroUser_updateUserPersonal";
    }
    if(estadoUserTem){
        if(estteleVal && estceluVal && estemaiVal ){
			boxyLoadingShow();
			
            $.get( urls,
        	   {accion:temurls,telefono:telefono.val(),celular:celular.val(),email:email.val(),resizable:resizable.val(),badeta:$("#registo").val()}, 
        	   function(dato){
        	      if(dato.res==1){
                    $("#registo").val(dato.id);
                    $("#estadoRegistrodos").html('<div id="temdiv"><img src="template/user/images/icon/accept.png"/> Se '+dato.evento+' correctamente</div>');
                    setTimeout(function() {
                        $("#temdiv").remove();
                    }, 1500 ); 
                    $("#estadoRegistrodos").removeClass("ui-state-error");
                    actualizarUrl('a#unohref',urls+"&accion=getdatosSistema&regisestado="+$("#registo").val());
                    actualizarUrl('a#doshref',urls+"&accion=getdatosPersonales&regisestado="+$("#registo").val());
                    actualizarUrl('a#cuatrohref',urls+"&accion=getdatosPermisos&regisestado="+$("#registo").val());
					boxyLoading.hide(); 
        	      }else{
                    $("#estadoRegistrodos").html('<img src="template/user/images/icon/red.gif"/> No se '+dato.evento+' correctamente');  
                    $("#estadoRegistrodos").addClass( "ui-state-error" );
					boxyLoading.hide(); 
        	      }	       
        	   },
            "json");
        }
    }else{
        Sexy.alert("Error: Debe de crear un usaurio primero 'NOTA: Datos Sistema'");
    }    
}


function removerNodoSacre(){
     $("body .secretariaNodo").remove();   
}

function getTablaModulo(){
    urlset=urls+"&accion=getListSubModulos";    
    modulo_oTable = $('#listModulos').dataTable({     
                                "aoColumns": [{"aTargets": [0],"bSearchable": false, "bSortable": false, "sWidth": "30px", "sType": "numeric"},//# 
                                              {"aTargets": [1],"bSearchable": false, "bSortable": false, "sWidth": "auto", "sType": "string"},//modulo
                                              {"aTargets": [2],"bSearchable": false, "bSortable": false, "sWidth": "50px", "sType": "string","sClass":"tdCentro"},//Editar 
                                              {"aTargets": [3],"bSearchable": false, "bSortable": false, "sWidth": "50px", "sType": "string","sClass":"tdCentro"},//Editar 
                                              {"aTargets": [4],"bSearchable": false, "bSortable": false, "sWidth": "50px", "sType": "string","sClass":"tdCentro"},//Añadir
                                              {"aTargets": [5],"bSearchable": false, "bSortable": false, "sWidth": "50px", "sType": "string","sClass":"tdCentro"},//Borrar 
                                              {"aTargets": [6],"bSearchable": false, "bSortable": false, "sWidth": "80px", "sType": "string","bVisible": false},//Titulo  
                                              {"aTargets": [7],"bSearchable": false, "bSortable": false, "sWidth": "80px", "sType": "string","bVisible": false},//Class 
                                              {"aTargets": [8],"bSearchable": false, "bSortable": false, "sWidth": "80px", "sType": "string","bVisible": false},//idModulo  
                                              {"aTargets": [9],"bSearchable": false, "bSortable": false, "sWidth": "80px", "sType": "string","bVisible": false},//idSubModulo
                                              {"aTargets": [10],"bSearchable": false, "bSortable": false, "sWidth": "80px", "sType": "string","bVisible": false},//N° de sub modulos 
                                              {"aTargets": [11],"bSearchable": false, "bSortable": false, "sWidth": "80px", "sType": "string","bVisible": false},//Sud modulo                                     
                                              ],//longitu
                                
                                /*"iCookieDuration": 60*60,//Duracion de 1 hora de los cookies
                                "bStateSave": true,*/
                                "aaSorting": [[1,'ASC']],
                                "bJQueryUI": true,
                                "sPaginationType": "full_numbers",
                                "bFilter": true,
                                "bRetrieve": true,
                                "bDestroy": true,
                                "fnInitComplete": function(oSettings, json) {
                                                      $("#listModulos_wrapper .dataTables_scrollBody").css({"height": "185px"});
                                                    },   
                                "fnDrawCallback": function ( oSettings ) {
                                                    if ( oSettings.aiDisplay.length == 0 )                                                    {
                                                        return;
                                                    }
                                                    
                                                    var nTrs = $('#listModulos tbody tr');
                                                    var iColspan = nTrs[0].getElementsByTagName('td').length;
                                                    //console.log("element: "+iColspan); 
                                                    var sLastGroupTitle = "";
                                                    var sLastGroup = "";
                                                    for ( var i=0 ; i<nTrs.length ; i++ )
                                                    {
                                                        var iDisplayIndex = oSettings._iDisplayStart + i;
                                                        var sGroup = oSettings.aoData[ oSettings.aiDisplay[iDisplayIndex] ]._aData[6];
                                                        var titlesP= oSettings.aoData[ oSettings.aiDisplay[iDisplayIndex] ]._aData[11];
                                                        var sGroupClass = oSettings.aoData[ oSettings.aiDisplay[iDisplayIndex] ]._aData[7];
                                                        
                                                        /**datos extras**/
                                                        var idModdulo = oSettings.aoData[ oSettings.aiDisplay[iDisplayIndex] ]._aData[8];
                                                        var idSubModulo = oSettings.aoData[ oSettings.aiDisplay[iDisplayIndex] ]._aData[9];
                                                        var lengthSubM = oSettings.aoData[ oSettings.aiDisplay[iDisplayIndex] ]._aData[10];
                                                        //console.log(sGroupClass); 
                                                        //console.log(sGroup+"  ::   "+titlesP);
                                                        var titles=(titlesP!=sLastGroupTitle?titlesP:"");
                                                        if ( sGroup != sLastGroup ){
                                                            var nGroup = document.createElement( 'tr' );
                                                            var nCell = document.createElement( 'td' );
                                                            nCell.colSpan = iColspan;
                                                            nCell.className = "group";
                                                            //$(".group").css( "background-color" );
                                                            var temTexTodo="setActivarTodo('"+sGroupClass+"')";
                                                            var temTexNinguno="setActivarNinguno('"+sGroupClass+"')";
                                                            var temTexGuardar="setGuardar('"+sGroupClass+"')";
                                                            nCell.innerHTML = '<div class="titlesT"><div class="titleModuloA">'+
                                                                                titles+'</div><div class="titleModuloB">'+
                                                                                sGroup+'    <input type="hidden" id="todo'+
                                                                                sGroupClass+'" value="0" /><input type="hidden" id="moduloId'+
                                                                                sGroupClass+'" value="'+
                                                                                idModdulo+'" /><input type="hidden" id="SubModuloId'+
                                                                                sGroupClass+'" value="'+
                                                                                idSubModulo+'" /><input type="hidden" id="Tamanio'+
                                                                                sGroupClass+'" value="'+lengthSubM+'" /><a onclick="'+
                                                                                temTexTodo+'" class="classBoton0" href="#">Todo</a><a onclick="'+
                                                                                temTexNinguno+'" class="classBoton0" href="#">Ninguno</a><a onclick="'+
                                                                                temTexGuardar+'" class="classBoton0" href="#">Guardar</a><div id="estaRegisPerm'+
                                                                                sGroupClass+'"></div></div></div>';
                                                            nGroup.appendChild( nCell );
                                                            nTrs[i].parentNode.insertBefore( nGroup, nTrs[i] );
                                                            sLastGroup = sGroup;
                                                            sLastGroupTitle=titlesP;
                                                        }
                                                    }
                                                    $("#listModulos_wrapper .dataTables_scrollBody").css({"height": "185px"});
                                                },
                                "fnPreDrawCallback": function( oSettings ) {
                                                        $("#listModulos_wrapper .dataTables_scrollBody").css({"height": "185px"});
                                                     },
                                                
                                "sDom": '<"H" lfr<"clear">>t<"F"ip<"clear">>',
                                "iDisplayLength": 20,
                                "bAutoWidth": false,
                                "aLengthMenu": [[20, 50], [20, 50]],
                                "oLanguage": { "sUrl": "js/DataTables/es_ES2.txt"},
                                "bProcessing":true,
                                "bServerSide":true,
                                "sAjaxSource":urlset,
                                "sScrollY": "180px",
                                //"sScrollX": "100%",
                        		//"sScrollXInner": "150%",
                        		"bScrollCollapse": true,                                
                                 "fnServerParams": function ( aoData ) {
                                    aoData.push( { "name": "otherDatos", "value":[$("#registo").val(),$("#modulo").val()] } );
                                 }
                                /*,                                
                                "bPaginate": false*/
                                //"iDeferLoading": tamRowCompra
                         });//END DATABLE   
}
function setCheckSolo(classss){
	if($(".acceso"+classss).is(":checked")){
		$(".edit"+classss).prop("checked", "checked");
		$(".anadir"+classss).prop("checked", "checked");
		$(".borrar"+classss).prop("checked", "checked");
	}else{
		$(".edit"+classss).prop("checked", "");
		$(".anadir"+classss).prop("checked", "");
		$(".borrar"+classss).prop("checked", "");
	}
}
function setCheckPadre(classss,starId){
	var estCheck=($(".edit"+classss).is(":checked")==true?true:($(".anadir"+classss).is(":checked")?true:($(".borrar"+classss).is(":checked")?true:false)));
	if(estCheck){
		$(".acceso"+classss).prop("checked", "checked");
	}
	var estCheckPartEdit=($(".edit"+classss).is(":checked")==true?true:false);
	var estCheckPartAdd=($(".anadir"+classss).is(":checked")==true?true:false);
	
	if(starId==1){
		if($(".edit"+classss).is(":checked")){
			//$(".anadir"+classss).prop("checked", "checked");
		}else{
			$(".anadir"+classss).prop("checked", "");
		}
	}else{if(starId==2){
			if($(".anadir"+classss).is(":checked")){
				$(".edit"+classss).prop("checked", "checked");
			}else{
				//$(".edit"+classss).prop("checked", "");
			}
		}	
	}	
	//console.log("llego........:"+classss);
}
function setActivarTodo(classTex){    
    $("."+classTex).prop("checked", "checked");   
}
function setActivarNinguno(classTex){
    $("."+classTex).prop("checked", "");
}
function setGuardar(classTex){ 
	
    if(verificarCheckIs(classTex)){
        var datosAguardar = new Array(); 
        var datosAelimianr = new Array();  
        datosAguardar[0]={usuario:$("#registo").val(),modulo:$("#moduloId"+classTex).val(),tipo:2,edit:0,anadir:0,borrar:0};
        datosAelimianr[0]={usuario:$("#registo").val(),modulo:$("#moduloId"+classTex).val()};
        var item=1
        for(var i=1;i<=$("#Tamanio"+classTex).val();i++){
            var acceso=($(".acceso"+$("#moduloId"+classTex).val()+i).is(":checked")==true?true:false);
            var edit=($(".edit"+$("#moduloId"+classTex).val()+i).is(":checked")==true?true:false);
            var anadir=($(".anadir"+$("#moduloId"+classTex).val()+i).is(":checked")==true?true:false);
            var borrar=($(".borrar"+$("#moduloId"+classTex).val()+i).is(":checked")==true?true:false);
            if(acceso){
                datosAguardar[item]={usuario:$("#registo").val(),modulo:$("#submoduloidTem"+classTex+""+i).val(),tipo:0,edit:(edit==true?1:0),anadir:(anadir==true?1:0),borrar:(borrar==true?1:0)};
                item++;
            }            
            datosAelimianr[i]={usuario:$("#registo").val(),modulo:$("#submoduloidTem"+classTex+""+i).val()};            
        }
        
        $.get( urls,
    	   {accion:"registroUser_insertPerm",dato:datosAguardar,dato2:datosAelimianr}, 
    	   function(dato){
    	       if(dato.res==1){
                   $("#estaRegisPerm"+classTex).append('<div id="temguard1"><img src="template/user/images/icon/active.png" />Ok : Registro.</div>');
                   setTimeout(function() {$("#temguard1").remove();}, 600 );
				   boxyLoading.hide(); 
    	       }else{
					boxyLoading.hide(); 
    	           Sexy.alert(" Error: "+dato.msg);
    	       }    	          	       
    	   },
        "json");
    }else{
        Sexy.confirm('¿Esta Seguro de Quitar los permisos de este Sub Modulo?', {
            onComplete:
            function(returnvalue) {
				boxyLoadingShow();
                if (returnvalue) {
                    var datosAelimianr = new Array();  
                    datosAelimianr[0]={usuario:$("#registo").val(),modulo:$("#moduloId"+classTex).val(),tipo:2,edit:1,anadir:1,borrar:1};
                    for(var i=1;i<=$("#Tamanio"+classTex).val();i++){
                        var edit=($(".edit"+$("#moduloId"+classTex).val()+i).is(":checked")==true?false:true);
                        var anadir=($(".anadir"+$("#moduloId"+classTex).val()+i).is(":checked")==true?false:true);
                        var borrar=($(".borrar"+$("#moduloId"+classTex).val()+i).is(":checked")==true?false:true);
                        if(edit || anadir || borrar){
                            datosAelimianr[i]={usuario:$("#registo").val(),modulo:$("#submoduloidTem"+classTex+""+i).val(),tipo:0,edit:(edit==true?1:0),anadir:(anadir==true?1:0),borrar:(borrar==true?1:0)};
                        }            
                    }
                    //console.log(datosAelimianr.toSource());
                    $.get( urls,
                	   {accion:"registroUser_deletePerm",dato:datosAelimianr}, 
                	   function(dato){
                            if(dato.res==1){
                               $("#estaRegisPerm"+classTex).append('<div id="temguard1"><img src="template/user/images/icon/active.png" />Ok : Se elimino los registros.</div>');
                                setTimeout(function() {$("#temguard1").remove();}, 600 );
								boxyLoading.hide();
                            }else{
								boxyLoading.hide();
                               Sexy.alert(" Error: "+dato.msg);
                            }       
                	   },
                    "json");
                } else {
					boxyLoading.hide();
                    alert('presionaste Cancelar');
                }
            }
        });
        
    }    
}
function verificarCheckIs(classTex){
    var estStart=false;
    for(var i=1;i<=$("#Tamanio"+classTex).val();i++){
        if($(".acceso"+$("#moduloId"+classTex).val()+i).is(":checked")){
            estStart=true;
        }          
    }
    return estStart;
}
function filterModulos(){
    modulo_oTable.fnDraw();
}

function insertPermisos(modulo,usuario){
	boxyLoadingShow();
    if($("#pertem"+modulo).val()==0){  		
        $.get( urls,
    	   {accion:"registroUser_insertPerm",usuario:usuario,modulo:modulo}, 
    	   function(dato){
    	       if(dato.res==1){
    	           $("#imagPer"+modulo).html('<img src="template/user/images/icon/active.png" class="iconDetail" onclick="insertPermisos('+modulo+','+usuario+')"/>');
                   $("#edit"+modulo).show(),$("#andir"+modulo).show(),$("#borrar"+modulo).show(),$("#guar"+modulo).show();
                   $("#pertem"+modulo).val("1"); 
				   boxyLoading.hide();
    	       }else{
					boxyLoading.hide();
    	           Sexy.alert(" Error: "+dato.msg);
    	       }    	          	       
    	   },
        "json");
    }else{        
        $.get( urls,
    	   {accion:"registroUser_deletePerm",usuario:usuario,modulo:modulo}, 
    	   function(dato){
    	       	if(dato.res==1){
    	           $("#imagPer"+modulo).html('<img src="template/user/images/icon/deactive.png" class="iconDetail" onclick="insertPermisos('+modulo+','+usuario+')"/>');
                   $("#edit"+modulo).hide(),$("#andir"+modulo).hide(),$("#borrar"+modulo).hide(),$("#guar"+modulo).hide();
                   $("#pertem"+modulo).val("0");
				   boxyLoading.hide();
    	       }else{
    	           Sexy.alert(" Error: "+dato.msg);
				   boxyLoading.hide();
    	       }       
    	   },
        "json");
    }  
}
function guardarPermisos(modulo,usuario){
    if($("#editchecked"+modulo).is(":checked") || $("#anadirchecked"+modulo).is(":checked") || $("#borrarchecked"+modulo).is(":checked")){
         boxyLoadingShow();
		$.get( urls,
    	   {accion:"registroUser_updatePerm",usuario:usuario,modulo:modulo,edit:($("#editchecked"+modulo).is(":checked")==true?1:0),anadir:($("#anadirchecked"+modulo).is(":checked")==true?1:0),borrar:($("#borrarchecked"+modulo).is(":checked")==true?1:0)}, 
    	   function(dato){
    	       	 if(dato.res==1){
    	           $( "#guar"+modulo ).append('<div id="temguard"><img src="template/user/images/icon/active.png" />Ok</div>');
                   setTimeout(function() {$("#temguard").remove();}, 600 );
				   boxyLoading.hide();
    	       }else{
					boxyLoading.hide();
    	           Sexy.alert(" Error: "+dato.msg);
    	       }       
    	   },
        "json");
    }else{
        Sexy.alert(" Debe de seleccionar por lo menos una opción ");
    }
    
}
function validarformatoImagen(img){
	var tipoimagen=false;
	var imgArray = img.split('.');
	var lengthTex=imgArray.length;//String(cadena1.toLowerCase()) == String(cadena2.toLowerCase())
	if(String(imgArray[lengthTex-1].toLowerCase())=="jpg" || String(imgArray[lengthTex-1].toLowerCase())=="png"){
		tipoimagen=true;
	}
	return tipoimagen;
}
