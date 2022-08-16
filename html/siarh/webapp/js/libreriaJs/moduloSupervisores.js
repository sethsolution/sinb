var urls="";//asignacion de url temporal para toda la libreria
supervisor_oTable=null;//nombre de la primera datatable
listaAsigItemsSup_oTable=null;//nombre para la segunda datatable
listaAsigItemsSupAsig_oTable=null;//nombre para la tercera datatable
datosuserTem=null;//variable que almacenara los datos temporales de los usuarios al momento de hacer Asignar
/**metodo que es llamdo a inicio de la aplicacion para asignar el valor de la url**/
function iniciarUserUrlSuper(url){
	urls=url;	
}
/*
*metodo que inicia con la visualizacion del datatable en la pantalla.
*/
function getTablaListaSupervisor(){
    urlset=urls+"&accion=getListUsuariosSupeer";    
    supervisor_oTable = $('#listaSupervisores').dataTable({     
                                "aoColumns": [{"aTargets": [0],"bSearchable": false, "bSortable": false, "sWidth": "10px", "sType": "numeric"},//# 
                                              {"aTargets": [1],"bSearchable": false, "bSortable": false, "sWidth": "20px", "sType": "string"},//Accion
                                              {"aTargets": [2],"bSearchable": true, "bSortable": true, "sWidth": "500px", "sType": "string"},//nombre apellido
                                              {"aTargets": [3],"bSearchable": true, "bSortable": true, "sWidth": "100px", "sType": "string"},//Usuario 
                                              {"aTargets": [4],"bSearchable": true, "bSortable": true, "sWidth": "80px", "sType": "string"},//telefono 
                                              {"aTargets": [5],"bSearchable": true, "bSortable": true, "sWidth": "120px", "sType": "string"},//correo                                      
                                              ],//longitu
                                
                                /*"iCookieDuration": 60*60,//Duracion de 1 hora de los cookies
                                "bStateSave": true,*/
                                "aaSorting": [[2,'desc']],
                                "bJQueryUI": true,
                                "sPaginationType": "full_numbers",
                                "bFilter": true,
                                "bRetrieve": true,
                                "bDestroy": true,
                                "fnInitComplete": function(oSettings, json) {
                                                    supervisor_oTable.fnDraw(true);                                                  
                                                    //$("#content_sirtable .dataTables_scrollBody").css({"height": "590px"});
                                                    /*if ( supervisor_oTable.length > 0 ) {
                                            			supervisor_oTable.fnAdjustColumnSizing();
                                            		}*/
                                                  },    
                                "fnDrawCallback": function( oSettings ) {  },
                                "fnPreDrawCallback": function( oSettings ) {/*
                                                        if(selVal.length>0){                                                          
                                                          for (var k in selVal){
                                                            oSettings.aoPreSearchCols[k].sSearch = selVal[k];
                                                          }  
                                                        }*/
                                                     },
                                                
                                "sDom": '<"H" lfr<"clear">>t<"F"ip<"clear">>',
                                "iDisplayLength": 10,
                                "bAutoWidth": false,
                                "aLengthMenu": [[10,20, 50], [10,20, 50]],
                                "oLanguage": { "sUrl": "js/DataTables/es_ES2.txt"},
                                "bProcessing":true,
                                "bServerSide":true,
                                "sAjaxSource":urlset,
                                //"sScrollY": "450px",
                                //"sScrollX": "100%",
                        		//"sScrollXInner": "150%",
                        		"bScrollCollapse": true,                                
                                 "fnServerParams": function ( aoData ) {
                                    //aoData.push( { "name": "otherDatos", "value":[$("#gestion").val(),$("#secretaria").val(),$("#uniprootros").val(),$("#actinoacti").val()] } );
                                 }
                                /*,                                
                                "bPaginate": false*/
                                //"iDeferLoading": tamRowCompra
                         });//END DATABLE 
						var oTableTools = new TableTools( supervisor_oTable, {
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
/*metodo que se encarga de abrir una neuva ventana con los datos establecidos.*/
function newVentanaSuper(usuario,superVi,dato){
    //console.log(dato.toSource());
    datosuserTem=dato;
    dialogTemSuper(usuario,superVi,dato);
}
//metodo que carga el dialog nodal cagnado el contenido asignado.
function dialogTemSuper(titleAsig,idEntidad,dato){
    /*var w = $(window).width();
    var h = $(window).height();*/
    $(getDialogSuper(dato)).dialog({
          height: 650,
          width: 900,
          canMinimize: true,
          canMaximize: true,
          modal: true,
          dialogClass: "usuarioNodoSuper",
          close: function() {             
            $("#dialog-modalListaSuper").dialog("destroy");
            removerNodoAsig();
          },
          open:function(){ 
            //getDialogProssecBar();
            //$("#dialogProssBar").dialog("destroy"); 
            //setTimeout(function() {
                //$(".ui-dialog-titlebar-close").show();
                //$("#dialogProssBar").dialog("destroy");
            //}, 500 ); 
            ejecutarTabsSuper(); 
            $("#fotoImag").css({
                width : 90+"px",
                height : 90+"px"
            });             
          }
    });
}
//metodo que establece en contenido del dialog.
function getDialogSuper(dato){
    var temtex='<div id="dialog-modalListaSuper" title="Nombre y Apellido Usuario : '+dato.nombreApel+'" >';  
    temtex+='<fieldset class="fieldForm">';
    temtex+='<legend>Información de Usuario</legend>';
    temtex+='<table style="width:100%;"><tr><td style="width:50%;"><p><span  class="textonombre">Nombre y Apellido :</span> '+(dato.nombreApel!=""?dato.nombreApel:"")+'</p>';
    temtex+='<p><span  class="textonombre">Telefono :</span> '+(dato.telefo!=""?dato.telefo:"")+'</p>';
    temtex+='<p><span  class="textonombre">Email :</span> '+(dato.email!=""?dato.email:"")+'</p></td>';
    temtex+='<td style="width:50%;">'+(dato.portada==1?'<img id="fotoImag" align="right" src="data/config/listaUsuarios/Portada/small/'+dato.id+'.jpg?'+dato.id+'" />':'')+'</td>'; 
    temtex+='</tr></table></fieldset>'; 
    temtex+='<div id="contenidoDialog">'+getTabsSuper();
    temtex+='</div></div>';
    return temtex;
}
//metodo que se encarga de cargar los tabs en el dialog.
function getTabsSuper(){  
    var urltabs1=urls+"&accion=getTabsItems";//tabs1
    var urltabs2=urls+"&accion=getTabsDemo";//tabs1
    var temtex='<div id="tabsSuper">';
    temtex+='<ul>';
    temtex+='<li><a id="unohref" href="'+urltabs1+'">Items</a></li>';
    temtex+='<li><a id="doshref" href="'+urltabs2+'">Historial</a></li>';
    temtex+='<li><a id="treshref" href="'+urltabs2+'">Reportes</a></li>';
    temtex+='</ul>';
    temtex+='</div>';
    return temtex;
}
//metodo que ejecuta los tabs.
function ejecutarTabsSuper(){
     $( "#tabsSuper" ).tabs({
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
//metodo que retira todo los dialog que se crearon para cargar uno nuevo.
function removerNodoTodo(nameClassRemov){
     $("body ."+nameClassRemov).remove();   
}
//
var isNum2=0;
var tamPuntero2=1;
function getListaAsigItemsSup(){//lista para desasiganr a usuario 
    urlset=urls+"&accion=getListUsuariosSupeerItems";    
    listaAsigItemsSup_oTable = $('#listUserSupAsig').dataTable({     
                                "aoColumns": [{"aTargets": [0],"bSearchable": false, "bSortable": false, "sWidth": "30px", "sType": "numeric"},//# 
                                              {"aTargets": [1],"bSearchable": true, "bSortable": true, "sWidth": "60px", "sType": "string"},//CodigoSISIN
                                              {"aTargets": [2],"bSearchable": true, "bSortable": true, "sWidth": "200px", "sType": "string"},//Nombre
                                              {"aTargets": [3],"bSearchable": false, "bSortable": false, "sWidth": "80px", "sType": "string"},//Tipo 
                                              {"aTargets": [4],"bSearchable": false, "bSortable": false, "sWidth": "80px", "sType": "string"},//Estado 
											  {"aTargets": [5],"bSearchable": false, "bSortable": false, "sWidth": "80px", "sType": "string"},//Gestion 
                                              {"aTargets": [6],"bSearchable": false, "bSortable": false, "sWidth": "50px", "sType": "string"},//Accion  
											  {"aTargets": [7],"bSearchable": false, "bSortable": false, "sWidth": "50px", "sType": "string","bVisible": false},//Accion 											  
                                              ],//longitu
                                
                                /*"iCookieDuration": 60*60,//Duracion de 1 hora de los cookies
                                "bStateSave": true,*/
                                "aaSorting": [[1,'desc']],
                                "bJQueryUI": true,
                                "sPaginationType": "full_numbers",
                                "bFilter": true,
                                "bRetrieve": true,
                                "bDestroy": true,
                                "fnInitComplete": function(oSettings, json) {
								isNum2=0;
                                                    $("#listUserSupAsig_wrapper .dataTables_scrollBody").css({"height": "175px","overflow":"scroll"});
                                                  },    
                                "fnDrawCallback": function( oSettings ) { isNum2=0; $("#listUserSupAsig_wrapper .dataTables_scrollBody").css({"height": "175px","overflow":"scroll"});},
                                "fnPreDrawCallback": function( oSettings ) {isNum2=0;
                                                        $("#listUserSupAsig_wrapper .dataTables_scrollBody").css({"height": "175px","overflow":"scroll"});
                                                     },
                                "fnRowCallback": function( nRow, aData, iDisplayIndex, iDisplayIndexFull ) {
									$("#listUserSupAsig_wrapper .dataTables_scrollBody").css({"height": "175px","overflow":"scroll"});								
									if(isNum2==0){
										//console.log(aData[0].toSource());
										tamPuntero2=parseInt(aData[7]);
										isNum2++;
									}							
								},                
                                "sDom": '<"H" lfr<"clear">>t<"F"ip<"clear">>',
                                "iDisplayLength": 10,
                                "bAutoWidth": false,
                                "aLengthMenu": [[10,20, 50], [10,20, 50]],
                                "oLanguage": { "sUrl": "js/DataTables/es_ES2.txt"},
                                "bProcessing":true,
                                "bServerSide":true,
                                "sAjaxSource":urlset,
                                "sScrollY": "150px",
                                //"sScrollX": "100%",
                        		//"sScrollXInner": "150%",
                        		"bScrollCollapse": true,                                
                                 "fnServerParams": function ( aoData ) {
                                    aoData.push( { "name": "otherDatos", "value":[$("#gestionSup").val(),$("#regionSup").val(),$("#municipioSup").val(),$("#tipoSup").val(),datosuserTem.secretaria] } );
                                 }
                                /*,                                
                                "bPaginate": false*/
                                //"iDeferLoading": tamRowCompra
                         });//END DATABLE   
}
function getListaMunicipiosJson(){
	boxyLoadingShow();
    $.get( urls,
	   {accion:"municipiosLista",region:$("#regionSup").val()}, 
	   function(dato){
	       if(dato.nombre!=undefined){
	           if(dato!=null && dato.nombre.length>0){
    	           var secret="<option value='0'>Todos los municipios</option>";
    	           for(var i=0;i<dato.nombre.length;i++){
    	               secret+="<option value='"+dato.index[i]+"'>"+dato.nombre[i]+"</option>";
    	           }
                   $("#municipioSup").html(secret);
				   boxyLoading.hide();
    	       }
	       }else{
				boxyLoading.hide();
	            $("#municipioSup").html("<option value='0'>Todos los municipios</option>");
	       }  
	   },
    "json");
}
function getDialogAsignarItems(){
    $('<div id="dialog-modalListaBusqueda" title="Busqueda" ><div id="contemBusque"></div></div>').dialog({
          height: 500,
          width: 700,
          canMinimize: true,
          canMaximize: true,
          modal: true,
          dialogClass: "usuarioNodoSuperBusqueda",
          close: function() {             
            $("#dialog-modalListaBusqueda").dialog("destroy");
            removerNodoTodo("usuarioNodoSuperBusqueda");
            listaAsigItemsSup_oTable.fnDraw();            
          },
          open:function(){ 
            getDialogProssecBar();
            $.get( urls,
        	   {accion:"AsignarListaSuper",region:$("#regionSup").val()}, 
        	   function(dato){
        	       $("#contemBusque").html(dato);          
        	   });
            
            setTimeout(function() {
                $(".ui-dialog-titlebar-close").show();
                $("#dialogProssBar").dialog("destroy");
            }, 500 ); 
            //           
          }
    });
}
var isNum=0;
var temPuntero=1;
function getListaAsigItemsSupAsignar(){//lista para asignar los items a usuario

    urlset=urls+"&accion=getListUsuariosSupeerItemsSet";    
    listaAsigItemsSupAsig_oTable = $('#listUserSupAsigBusq').dataTable({     
                                "aoColumns": [{"aTargets": [0],"bSearchable": false, "bSortable": false, "sWidth": "10px", "sType": "numeric"},//# 
                                              {"aTargets": [1],"bSearchable": true, "bSortable": true, "sWidth": "60px", "sType": "string"},//codigo SISIN
                                              {"aTargets": [2],"bSearchable": true, "bSortable": true, "sWidth": "200px", "sType": "string"},//Nombre
                                              {"aTargets": [3],"bSearchable": false, "bSortable": false, "sWidth": "80px", "sType": "string"},//tipo 
                                              {"aTargets": [4],"bSearchable": false, "bSortable": false, "sWidth": "80px", "sType": "string"},//Estado 
                                              {"aTargets": [5],"bSearchable": false, "bSortable": false, "sWidth": "50px", "sType": "string"},//Accion                                     
                                              ],//longitu
                                
                                /*"iCookieDuration": 60*60,//Duracion de 1 hora de los cookies
                                "bStateSave": true,*/
                                "aaSorting": [[1,'desc']],
                                "bJQueryUI": true,
                                "sPaginationType": "full_numbers",
                                "bFilter": true,
                                "bRetrieve": true,
                                "bDestroy": true,
                                "fnInitComplete": function(oSettings, json) {
								isNum=0;
								if ($(this).length ==0 ){
									$("#listUserSupAsigBusq_wrapper tbody").css({"height": "195px"});
								}
								//console.log(oSettings.toSource());
								//console.log(json.toSource());
													//console.log(listaAsigItemsSupAsig_oTable.fnSettings().fnRecordsTotal());
                                                    //$("#listUserSupAsigBusq_wrapper tbody").css({"height": "590px"});                                                    
                                                  },    
                                "fnDrawCallback": function( oSettings ) {isNum=0;  },
                                "fnPreDrawCallback": function( oSettings ) {isNum=0;/*
                                                        if(selVal.length>0){                                                          
                                                          for (var k in selVal){
                                                            oSettings.aoPreSearchCols[k].sSearch = selVal[k];
                                                          }  
                                                        }*/
                                                     },
                                 /*"fnRowCallback": function( nRow, aData, iDisplayIndex, iDisplayIndexFull ) {*/      
								"fnRowCallback": function( nRow, aData, iDisplayIndex, iDisplayIndexFull ) {								
								if(isNum==0){
									//console.log(aData[0].toSource());
									temPuntero=parseInt(aData[0]);
									isNum++;
								}
								
								},								 
                                "sDom": '<"H" lfr<"clear">>t<"F"ip<"clear">>',
                                "iDisplayLength": 10,
                                "bAutoWidth": false,
                                "aLengthMenu": [[10,20, 50], [10,20, 50]],
                                "oLanguage": { "sUrl": "js/DataTables/es_ES2.txt"},
                                "bProcessing":true,
                                "bServerSide":true,
                                "sAjaxSource":urlset,
                                "sScrollY": "198px",
                                //"sScrollX": "100%",
                        		//"sScrollXInner": "150%",
                        		"bScrollCollapse": true,                                
                                 "fnServerParams": function ( aoData ) {
                                    aoData.push( { "name": "otherDatos", "value":[$("#gestionSupBusq").val(),$("#regionSupBusq").val(),$("#municipioSupBusq").val(),$("#tipoSupBusq").val(),datosuserTem.id,datosuserTem.secretaria] } );
                                 }
                                /*,                                
                                "bPaginate": false*/
                                //"iDeferLoading": tamRowCompra
                         });//END DATABLE   
}
function setCheckAsignar(){//setcheck
    if($(".setcheck").is(":checked")){
        var iter=temPuntero,punt=0;
        var starCheck=true;
        var datosAsig = new Array(); 
        while(starCheck){
            if($('#setdatos'+iter).hasClass('setcheck')){
                if($('#setdatos'+iter).is(":checked")){
                    datosAsig[punt]={proyectoId:$("#proyecId"+iter).val(),usuarioId:datosuserTem.id,userCreated:datosuserTem.memberId};
                    punt++;
                }                
                iter++;
            }else{
                starCheck=false;
            }            
        }
		//console.log(datosAsig.toSource());
		boxyLoadingShow();
        $.get( urls,
        {accion:"asignarSupervisores_guardarDatoAsignaSuper",datos:datosAsig}, 
        function(dato){
            if(dato.res==1){
                listaAsigItemsSup_oTable.fnDraw();  
                $("#dialog-modalListaBusqueda").dialog("destroy");
                removerNodoTodo("usuarioNodoSuperBusqueda");
				boxyLoading.hide();
            }else{
				boxyLoading.hide();
                Sexy.alert("Error:<br/>"+dato.msg);
            }     
        },
        "json");
    }else{
        Sexy.alert("Debe de seleccionar una opcion")
    }
}
function deleteAsignacionSuper(proyId,userId){
	boxyLoadingShow();
    $.get( urls,
    {accion:"asignarSupervisores_deleteDatoAsignaSuper",proyId:proyId,userId:userId}, 
    function(dato){
       if(dato.res==1){
           listaAsigItemsSup_oTable.fnDraw();
			boxyLoading.hide();		   
       }else{
	    boxyLoading.hide();
        Sexy.alert("Error:<br/>"+dato.msg);
       }          
    },
    "json");
}
function getListaMunicipiosJsonBus(){
	boxyLoadingShow();
    $.get( urls,
	   {accion:"municipiosLista",region:$("#regionSupBusq").val()}, 
	   function(dato){
	       if(dato.nombre!=undefined){
	           if(dato!=null && dato.nombre.length>0){
    	           var secret="<option value='0'>Todos los municipios</option>";
    	           for(var i=0;i<dato.nombre.length;i++){
    	               secret+="<option value='"+dato.index[i]+"'>"+dato.nombre[i]+"</option>";
    	           }
                   $("#municipioSupBusq").html(secret);
				   boxyLoading.hide();	
    	       }
	       }else{
				boxyLoading.hide();	
	            $("#municipioSupBusq").html("<option value='0'>Todos los municipios</option>");
	       }  
	   },
    "json");
}

function setTodoDelete(){
    $(".setcheckE").prop("checked", "checked");
}
function setTodoNinguno(){
    $(".setcheckE").prop("checked", "");
}
function setTodoQuitar(){
    if($('.setcheckE').is(":checked")){
        var iter=tamPuntero2,punt=0;
        var starCheck=true;
        var datosAsig = new Array(); 
        while(starCheck){
            if($('#setdatosE'+iter).hasClass('setcheckE')){
                if($('#setdatosE'+iter).is(":checked")){
                    var temdatos = $("#proyecSetId"+iter).val().split('-');
                    datosAsig[punt]={proyectoId:temdatos[0],usuarioId:temdatos[1]};
                    punt++;
                }                
                iter++;
            }else{
                starCheck=false;
            }            
        }
		//console.log(datosAsig.toSource());
		boxyLoadingShow();
        $.get( urls,
        {accion:"asignarSupervisores_eliminarDatoAsignados",datos:datosAsig}, 
        function(dato){
			if(dato!=""){			
				if(dato[0].res==1){
					listaAsigItemsSup_oTable.fnDraw(); 
					boxyLoading.hide();					
				}else{
					boxyLoading.hide();
					Sexy.alert("Error:<br/>"+dato.msg);
				}   
			}else{
				boxyLoading.hide();
				Sexy.alert("Error:<br/> al realizar la operación");
			}			
        },
        "json");
    }else{
        Sexy.alert("Debe de seleccionar una opción para ejecutar esta operación");
    }
}
function setTodoDeleteBus(){
    $(".setcheck").prop("checked", "checked");
}
function setTodoNingunoBus(){
    $(".setcheck").prop("checked", "");
}
function setTodoQuitarBus(){
    if($('.setcheckE').is(":checked")){
        var iter=1,punt=0;
        var starCheck=true;
        var datosAsig = new Array(); 
        while(starCheck){
            if($('#setdatosE'+iter).hasClass('setcheckE')){
                if($('#setdatosE'+iter).is(":checked")){
                    var temdatos = $("#proyecSetId"+iter).val().split('-');
                    datosAsig[punt]={proyectoId:temdatos[0],usuarioId:temdatos[1]};
                    punt++;
                }                
                iter++;
            }else{
                starCheck=false;
            }            
        }        
        //console.log(datosAsig.toSource());
        $.get( urls,
        {accion:"asignarSupervisores_eliminarDatoAsignados",datos:datosAsig}, 
        function(dato){
            if(dato[0].res==1){
                listaAsigItemsSup_oTable.fnDraw();  
            }else{
                Sexy.alert("Error:<br/>"+dato.msg);
            }     
        },
        "json");
    }else{
        Sexy.alert("Debe de seleccionar una opción para ejecutar esta operación");
    }
}