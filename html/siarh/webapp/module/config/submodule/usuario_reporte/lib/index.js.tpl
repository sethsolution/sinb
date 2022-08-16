{literal}
<style>
  .ui-progressbar {
    position: relative;
    margin-top:50px;
  }
  .progress-label {
    position: absolute;
    left: 50%;
    top: 4px;
    font-weight: bold;
    text-shadow: 1px 1px 0 #fff;
    color:#ffffff;
  }
  
  td.txtCenter{
    text-align:center;
  }
  td.txtRigth{
    text-align:right;
  }
</style>

<script>
var tabModule;
var dataTableModule;
var pageLayoutOptions = {
		name:					'pageLayout' // only for debugging
    ,   applyDefaultStyles: false
    ,   slidable:true
	//,	resizeWithWindowDelay:	250		// delay calling resizeAll when window is *still* resizing
	//,	resizeWithWindowMaxDelay: 2000	// force resize every XX ms while window is being resized
	//,	resizable:				false
	//,	slidable:				false
	//,	closable:				false
    //,   scrollToBookmarkOnLoad:         false
    ,   defaults: {
        }
    ,	north: {
				size:					38
			,   paneSelector:           "#header"
            ,	spacing_open:			0
			,	closable:				false
			,	resizable:				false
			}
    ,	south: {
				size:					28
			,   paneSelector:           "#footer"
            ,	spacing_open:			0
			,	closable:				false
			,	resizable:				false
			}
    ,	east: {
				size:					240
            ,   paneSelector:           "#east_pane"
			,	spacing_closed:			22
			,	togglerLength_closed:	122
			,	togglerAlign_closed:	"top"
            ,	togglerContent_closed:	"<div class='closedEast'></div><div class='closedEastAbrir'></div>"
			,	togglerTip_closed:		"Abrir Panel"
			,	sliderTip:				"Mostrar Panel"
			,	slideTrigger_open:		"mouseover"
            ,	resizable:				false
            ,	initClosed:             false
            ,	closed:                 true

			}
    ,   west:{
				size:					255
            ,   paneSelector:           "#west_pane"
			,	spacing_closed:			22
			,	togglerLength_closed:	100
			,	togglerAlign_closed:	"top"
            ,	togglerContent_closed:	"<div class='closedWestAbrir'></div>"
			,	togglerTip_closed:		"Abrir Panel"
			,	sliderTip:				"Mostrar Panel"
			,	slideTrigger_open:		"mouseover"
            ,	resizable:				false
            ,	initClosed:             false
            ,	closed:                 true
            
			}
    ,   center:{
                paneSelector:           "#center"
			}
	,  west__onresize:  $.layout.callbacks.resizeDataTable
    ,  center__onresize:  $.layout.callbacks.resizeDataTable
	,	onclose_end: function(panName) {
            // update map size when a panel is closed
            //map.updateSize();
            if(panName == 'south') {
                east.resizeAll();
            }
        }
	,	onopen_end: function(panName) {
            // update map size when a panel is opened
            //map.updateSize();
            if(panName == 'south') {
                east.resizeAll();
            }
        }


};

var pageLayout;
var oTable_snirFiv, oSettingssnirFiv;
var urlProvincia = '{/literal}{$getModule}&accion=item{literal}_getProvincia';
var urlMunicipio = '{/literal}{$getModule}&accion=item{literal}_getMunicipio';
/*Var para cada elemento de filtrado*/
var selProvincia, selMunicipio;
var sumTotalFicha, sumTotalArea, sumTotalFamilia;
var selVal=new Array();
var idpanelTab = 1;
var iddep='';
var idpro='';

var urlsummary = '{/literal}{$getModule}{literal}&accion=getSummary';

    
$(document).ready(function() {
    
    //load de provincias
    loadProvincia = $( "#progressbarPro" ).progressbar({value: false});
    //SELECT de Municipios
    selProvincia = $("select#provinciaId");
    
    //load de municipios
    loadMunicipio = $( "#progressbarMun" ).progressbar({value: false});
    //SELECT de Municipios
    selMunicipio = $("select#municipioId");
    
    sumTotalFicha = $("label#item_totalficha");
    sumTotalArea = $("label#item_totalarea");
    sumTotalFamilia = $("label#item_totalfamilia");
    
    
    pageLayout = $("body").layout( pageLayoutOptions );
    pageLayout.hide('east');
    pageLayout.hide('north');
    contdep = $("#busqueda_dep");
    contmun = $("#busqueda_mun");

    $("#departamentoId").bind("change", function(){
        iddep =  $(this).val();
        iddep = iddep==0? '': iddep;
        idpro = '';
        buscarProvincia();
        buscarMunicipio();
    });
    
    $("#provinciaId").bind("change", function(){
        idpro =  $(this).val();
        idpro = idpro==0? '': idpro;
        buscarMunicipio();
    });
    
    $(".itemFilter").bind("change keyup", function (){
        
       if(idpanelTab==1){
         var colFilter = $(this).attr("rel");
         var valFilter = $(this).val();
         
         if(colFilter==4 && valFilter==0){
           setFilterTable(5,"");
           setFilterTable(6,"");
         }else if(colFilter==5 && valFilter==0){
           setFilterTable(6,"");
         }
         
         setFilterTable(colFilter,valFilter);
         
       }else{
        /* selValconv = sel_conv.val(); 
         selValsec = sel_sec.val(); 
         selValproy = sel_proy.val();
         selValavfin = sel_avfin.val().replace(/^\s+/g,'').replace(/\s+$/g,'');
         selValavfis = sel_avfis.val().replace(/^\s+/g,'').replace(/\s+$/g,'');
         setChart();  */                             
       }
//       getSummary();       
    });
    
    var tabsItem =  $("#tabsItem").tabs({
                    
            ajaxOptions:{ error: function(xhr,status,index,anchor){
                    $( anchor.hash ).html("Algun Problema ocurre."+
                        "Muy posible que el servidor este lento nuevamente.");
                    }}
            ,load:  function(event,ui){
                //boxyLoading.hide();
            }
            ,create: function(event,ui){
                //getSummary();
                // boxyLoadingShow();
            }
            ,beforeLoad: function( event, ui ) {
                    ui.jqXHR.error(function() {
                    ui.panel.html("No se pudo cargar esta ficha." +
                        "Vamos a tratar de solucionar este problema lo m&aacute;s pronto posible." );
                    });
            }
            ,beforeActivate: function ( event, ui ){
            
                    ui.oldPanel.html("");
                    //boxyLoadingShow();
                    idpanelTab = ui.newPanel.attr("id");
                    idpanelTab = idpanelTab.split("-");
                    idpanelTab = idpanelTab[2];
                    if(idpanelTab==1){
                        //contdep.show();
                        //contmun.show();
                    }else{
                        $('#item_table tbody td img.iconDetail').die( "click" );
                        //contdep.hide();
                        //contmun.hide();
                    }
            }
            ,activate: function ( event, ui ){
                                   
            }
    });

      
      //Obtenemos los parametros para filtro de datos de la tabla
      $(".sfilter").bind('change keyup', function(){
        var relcolmn = $(this).attr("rel");
        var data = $(this).is("select") && $(this).val()==0? "": $(this).val();
        
        //Reset datos dependientes
        if(relcolmn == 4){//Cambio en deparamento reset provincia y municipio
          progressbar_spro.show();
          progressbar_smun.show();
 
          oSettingssnirFiv.aoPreSearchCols[5].sSearch = "";
          oSettingssnirFiv.aoPreSearchCols[6].sSearch = "";
          
          getListProvincia($(this).val());  
        }else if(relcolmn == 5){
          progressbar_smun.show();
          
          oSettingssnirFiv.aoPreSearchCols[6].sSearch = "";
          
          getListMunicipio($(this).val());
        } 
        
        //Dato seleccionado
        oSettingssnirFiv.aoPreSearchCols[relcolmn].sSearch = data;
        
        oTable_snirFiv.fnDraw();
      });
    
});//END READY
    
    //Funcion para cargar listado de municipios
    function buscarProvincia(){
        loadProvincia.show();console.log(selProvincia);
        selProvincia.attr("disabled","disabled").find("option:eq(0)").text("Cargando....");
        selProvincia.find("option:gt(0)").remove();
   
        $.post(urlProvincia
                 ,{iddep:iddep}
                 ,function (res, textStatus, jqXHR){

                    selProvincia.find("option:eq(0)").text("Todos las provincias.");
                    selOption = $('<option></option>');

                    for (var row in res) {
                      selProvincia.append($('<option></option>').attr("value",row).text(res[row])); 
                    }

                    selProvincia.removeAttr("disabled");
                    loadProvincia.hide();    
                    
                  }
                 ,'json');
    }
      
    //Funcion para cargar listado de municipios
    function buscarMunicipio(){
      
        loadMunicipio.show();
        selMunicipio.attr("disabled","disabled").find("option:eq(0)").text("Cargando....");
        selMunicipio.find("option:gt(0)").remove();
        
        $.post(urlMunicipio
                 ,{iddep:iddep, idpro:idpro}
                 ,function (res, textStatus, jqXHR){
                    
                    selMunicipio.find("option:eq(0)").text("Todos los municipios.");
                    selOption = $('<option></option>');
                    
                    for (var row in res) {
                      selMunicipio.append($('<option></option>').attr("value",row).text(res[row])); 
                    }

                    selMunicipio.removeAttr("disabled");
                    loadMunicipio.hide();    
                    
                  }
                 ,'json');
    }
      
    
    
    function getSummary(){
        var summTotalItem = $("#summaryItem #item_totalficha");
        var summTotalPersona = $("#summaryItem #item_totalpersona");
        
        sel_departamento = $("#departamentoId");
        sel_municipio = $("#municipioId");
        
        $.post( urlsummary,
                {accion:"getSummary"
                ,"rec[departamentoId]":sel_departamento.val()
                ,"rec[municipioId]":sel_municipio.val()},
                
                function (response,textStatus, jqHXR){
                    summTotalItem.html(response.totalItem);
                    summTotalPersona.html(response.totalPersona==null?0:response.totalPersona);
                    
                },
                "json");//END $.POST
    }//END GETSUMARY
    
    function getListProvincia(iditem){
        if(iditem!=0 && $.trim(iditem!="")){
          
          $.post(urlProvincia,
                 {id:iditem},
                 function (response,status,xhr){
                     selProvincia.html(response.opt);
                     
                     progressbar_spro.hide();
                     progressbar_smun.hide();     
                 },"json");
        }else{
          selProvincia.html('<option value ="0">Todas las Provincias</option>');
          selMunicipio.html('<option value ="0">Todos los Municipios</option>');
          
          progressbar_spro.hide();
          progressbar_smun.hide();
        }
    }
    
    function getListMunicipio(iditem){
        if(iditem!=0 && $.trim(iditem!="")){
          
          $.post(urlMunicipio,
                 {id:iditem},
                 function (response,status,xhr){
                     selMunicipio.html(response.opt);
                     progressbar_smun.hide();     
                 },"json");
        }else{
          selMunicipio.html('<option value ="0">Todos los Municipios</option>');
          progressbar_smun.hide();
        }
    }
    
    function itemUpdate(id,type){
      var url = '{/literal}{$getModule}{literal}&accion=itemUpdate&id='+id+'&type='+type;
      location = url;
    }
    
    function itemActive(id,status){
	    boxyLoadingShow();
	    randomnumber=Math.floor(Math.random()*11);
	    $.get( "{/literal}{$getModule}{literal}",
               {  accion:"itemActive", random:randomnumber,
		 				                           id:id,               status:status
						                         }, function(data){
                                                        oTable.fnDraw();
                                                        boxyLoading.hide();			
		                                             });
      }
    
    function itemDelete(id,data){

        $.msgbox( "Esta seguro de eliminar este registro?<br>Info<br><b>"+data+"</b>"
                  ,{type: "error"
                    ,buttons : [{type: "submit", value: "Aceptar"}]
                   }
                  ,function(result) {
                     if(result){
                         itemDeleteAction(id);
                     }
                   }
                 ); 
    }

    function itemDeleteAction(id){
        boxyLoadingShow();
        randomnumber=Math.floor(Math.random()*11);
        
        $.get( "{/literal}{$getModule}{literal}",
               {accion:"itemDelete", random:randomnumber, id:id}, 
               function(res){
                   if(res.res == 1){
                       location.reload();
                   }else if(res.res == 2){
                     $.msgbox('ERROR: al eliminar, '+res.msg,
                                {onComplete: function(returnvalue){location.reload();} }); 
                   }else{                                                            
                       boxyLoading.hide();
                       $.msgbox('ERROR: The data item is related ',{onComplete: function(returnvalue){location.reload();} });
                   }//END IF
		       },"json");
    }
    
    function setFilterTable(colFilter,valFilter){
            
        oSettingssnirFiv.aoPreSearchCols[colFilter].sSearch = valFilter;
        oTable_snirFiv.fnDraw();
    }
    
</script>{/literal}