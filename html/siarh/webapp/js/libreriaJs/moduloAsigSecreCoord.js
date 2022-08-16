var urls="";
var asigna_oTable=null;
var modulo_oTable=null;
function iniciarUserUrl(url){
	urls=url;	
}
function getTablaListaAsigSecreCoord(){
    urlset=urls+"&accion=getListUsuarios";    
    asigna_oTable = $('#listaAsignacion').dataTable({     
                                "aoColumns": [{"aTargets": [0],"bSearchable": false, "bSortable": false, "sWidth": "10px", "sType": "numeric"},//# 
                                              {"aTargets": [1],"bSearchable": false, "bSortable": false, "sWidth": "100px", "sType": "string"},//Accion
                                              {"aTargets": [2],"bSearchable": true, "bSortable": true, "sWidth": "30px", "sType": "string"},//gestion
                                              {"aTargets": [3],"bSearchable": true, "bSortable": true, "sWidth": "450px", "sType": "string"},//Secretaria 
                                              {"aTargets": [4],"bSearchable": false, "bSortable": false, "sWidth": "100px", "sType": "string"},//nombre coordinador  
                                              {"aTargets": [5],"bSearchable": false, "bSortable": false, "sWidth": "100px", "sType": "string"},//usuario                                      
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
                                                    asigna_oTable.fnDraw(true);
                                                    //$("#content_sirtable .dataTables_scrollBody").css({"height": "590px"});
                                                    /*if ( asigna_oTable.length > 0 ) {
                                            			asigna_oTable.fnAdjustColumnSizing();
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
                                    //aoData.push( { "name": "otherDatos", "value":[$("#gestion").val(),$("#secretaria").val(),$("#uniprootros").val(),$("#actinoacti").val()] } );
                                 }
                                /*,                                
                                "bPaginate": false*/
                                //"iDeferLoading": tamRowCompra
                         });//END DATABLE   
}
function getDialogProssecBar(){
    $('<div id="dialogProssBar" title="Cargando......" ><div id="progressbar"></div></div>').dialog({
        height: 100,
        width: 300,
        modal: true,
        dialogClass: "dialogProsseBar",
        close: function() {             
            $("#dialogProssBar").dialog("destroy");
        },
        open:function(){ 
        $(".ui-dialog-titlebar-close").hide();
        $( "#progressbar" ).progressbar({
            value: false
        });                
        }
    });
}

function setEliminarAsignacion(iDdesAsidnar){
	//console.log(iDdesAsidnar);	
	boxyLoadingShow();
	$.get( urls,
    	   {accion:"asignarSecretaria_desasignarSecre",idDesAsig:iDdesAsidnar}, 
    	   function(dato){  
				if(dato.res==1){  
					asigna_oTable.fnDraw();					
					boxyLoading.hide();
				}else{
					boxyLoading.hide();
					Sexy.alert("Error:"+dato.msg);
				}
			},
        "json");
}
function newVentana(dato){
    //console.log(dato.toSource())
   dialogTemAsig(dato.titles,dato.entidadId,dato.coordinadorId);
}
function dialogTemAsig(titleAsig,idEntidad,dato6){
    /*var w = $(window).width();
    var h = $(window).height();*/
    $(getDialogAsig(titleAsig)).dialog({
          height: 450,
          width: 700,
          canMinimize: true,
          canMaximize: true,
          modal: true,
          dialogClass: "usuarioNodoAsig",
          close: function() {             
            $("#dialog-modalListaAsig").dialog("destroy");
            removerNodoAsig();
            asigna_oTable.fnDraw();
          },
          open:function(){ 
            getDialogProssecBar();
            //$("#dialogProssBar").dialog("destroy"); 
            setTimeout(function() {
                $(".ui-dialog-titlebar-close").show();
                $("#dialogProssBar").dialog("destroy");
            }, 500 ); 
            getListaAsignarUsuarios(idEntidad,dato6);               
          }
    });
}
function getDialogAsig(TitleAsig){
    var temtex='<div id="dialog-modalListaAsig" title="ASIGNAR USUARIO A : '+TitleAsig+'" >';   
    temtex+='<div id="contenidoDialog">'+getListaUsuarios();
    temtex+='</div></div>';
    return temtex;
}
function getListaUsuarios(){ 
    var temtex='<div>';
    temtex +='<table border="0" cellspacing="0" cellpadding="0" style="font-size:11px;" id="listaAsignarUser">';
    temtex +='<thead>';
    temtex +='<tr>';
    temtex +='<th>#</th>';
    temtex +='<th>Acci&oacute;n</th>';
    temtex +='<th>Nombre</th>';
    temtex +='<th>Usuario</th>';
    temtex +='</tr>';
    temtex +='</thead>';
    temtex +='</table> ';
    temtex +='</div>';    
    return temtex;
}
function getListaAsignarUsuarios(idEntidad,dato6){
    urlset=urls+"&accion=listaAsigUser";    
    list_asignaUser_oTable = $('#listaAsignarUser').dataTable({     
                                "aoColumns": [{"aTargets": [0],"bSearchable": false, "bSortable": false, "sWidth": "10px", "sType": "numeric"},//# 
                                              {"aTargets": [1],"bSearchable": false, "bSortable": false, "sWidth": "60px", "sType": "string"},//Accion
                                              {"aTargets": [2],"bSearchable": true, "bSortable": true, "sWidth": "100px", "sType": "string"},//gestion
                                              {"aTargets": [3],"bSearchable": true, "bSortable": true, "sWidth": "100px", "sType": "string"},//Secretaria                                     
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
                                                    $("#listaAsignarUser_wrapper .dataTables_scroll").css({"height": "345px","overflow":"scroll"});                                                   
                                                  },    
                                "fnDrawCallback": function( oSettings ) {  },
                                "fnPreDrawCallback": function( oSettings ) {
                                                        //$("#listaAsignarUser .dataTables_scrollBody").css({"height": "200px"});
                                                     },
                                                
                                "sDom": '<"H" lfr<"clear">>t<"F"ip<"clear">>',
                                "iDisplayLength": 20,
                                "bAutoWidth": false,
                                "aLengthMenu": [[20, 50], [20, 50]],
                                "oLanguage": { "sUrl": "js/DataTables/es_ES2.txt"},
                                "bProcessing":true,
                                "bServerSide":true,
                                "sAjaxSource":urlset,
                                "sScrollY": "200px",
                                //"sScrollX": "100%",
                        		//"sScrollXInner": "150%",
                        		"bScrollCollapse": true,                                
                                 "fnServerParams": function ( aoData ) {
                                    aoData.push( { "name": "otherDatos", "value":[idEntidad,dato6] } );
                                 }
                                /*,                                
                                "bPaginate": false*/
                                //"iDeferLoading": tamRowCompra
                         });//END DATABLE  
}

function removerNodoAsig(){
     $("body .usuarioNodoAsig").remove();   
}

function registarAsignar(user,entidad,id){
    if(user!="" && entidad!=""){
		boxyLoadingShow();
        $.get( urls,
    	   {accion:"asignarSecretaria_asignarSecretaria",user:user,entidad:entidad}, 
    	   function(dato){
    	      if(dato.res==1){
    	       //$("#asignarSecre"+id).append('<div id="estdoAsignar"><img src="template/user/images/icon/active.png" />Ok : Registro</div>');
   	            //setTimeout(function() {
                    //$("#estdoAsignar").remove();
                    $("#dialog-modalListaAsig").dialog("destroy");
                    removerNodoAsig();
                    asigna_oTable.fnDraw();
                //}, 700 ); 
				boxyLoading.hide();
    	      }else{
			   boxyLoading.hide();
    	       Sexy.alert("Error:"+dato.msg);
    	      }                     
    	   },
        "json");
    }else{
        Sexy.alert("Error: En los datos que quiere enviar.");
    }    
}
