{literal}<script>

var tabModule;
var dataTableModule;
var pageLayoutOptions = {
		name:					'pageLayout' // only for debugging
    ,   applyDefaultStyles: false
    ,   slidable:true
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
            ,   onresize: function(){
                    $("#center").tabs( "refresh" );
                    //oSettingsItem.oScroll.sY =$('#item_table').parent().height()-125;
                    item_oTable.columns.adjust();
            }
    }
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
var item_oTable, oSettingsItem,sumTotalFicha;

var idpanelTab = 1;
/* Variables para gráficas */
//var chart01,chart02,chart03,chartaux;

                               
$(document).ready(function () {
    pageLayout = $("body").layout( pageLayoutOptions );
    pageLayout.hide('east');
    sumTotalFicha = $("label#item_totalficha");
    /* fin verificar */
                                         
    var tabsItem =  $("#center").tabs({
                    
            ajaxOptions:{ error: function(xhr,status,index,anchor){
                    $( anchor.hash ).html("Algun Problema ocurre."+
                        "Muy posible que el servidor este lento nuevamente.");
                    }}
            ,load:  function(event,ui){
                //boxyLoading.hide();
            }
            ,create: function(event,ui){
                
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
                    selVal = new Array();
                    alert("entro activar");
                    if(idpanelTab==1){
                        
                        if(sel_gestion.val()!="")  selVal[2]=sel_gestion.val();
                        if(sel_financiador.val()!="")  selVal[13]=sel_financiador.val();
                        if(sel_adenda.val()!="") selVal[10]=sel_adenda.val(); 
                        if(sel_modalidad.val()!="")  selVal[11]=sel_modalidad.val(); 
                        if(sel_tipo.val()!="") selVal[12]=sel_tipo.val();
                        if(sel_contraloria.val()!="") selVal[14]=sel_contraloria.val();
                    }else{
                        selValconv = sel_conv.val(); 
                        selValsec = sel_sec.val(); 
                        selValproy = sel_proy.val();
                        selValavfin = $("#fps_avfincond").val()+" "+sel_avfin.val().replace(/^\s+/g,'').replace(/\s+$/g,'');
                        selValavfis = $("#fps_avfiscond").val()+" "+sel_avfis.val().replace(/^\s+/g,'').replace(/\s+$/g,'');
                    }
                                    
            }
    });

});//END DOCUMENT READY

    
    function itemUpdate(id,type){
      var url = '{/literal}{$getModule}{literal}&accion=itemUpdate&id='+id+'&type='+type;
      location = url;
    }
    
    function itemDelete(id,data){

       $.msgbox("Esta seguro de eliminar este registro?<br>Info<br><b>"+data+"</b>"
                 ,{type: "confirm"
                   ,buttons : [{type: "submit", value: "Si"},
                               {type: "cancel", value: "No"}]}
                 ,function(result){
                    if(result){
                      itemDeleteAction(id);
                    }
                 });
    }

    function itemDeleteAction(id){
        boxyLoadingShow();
        randomnumber=Math.floor(Math.random()*11);
        
        $.get( "{/literal}{$getModule}{literal}",
               {accion:"itemDelete", random:randomnumber, id:id}, 
               function(res){
                   if(res.res == 1){
                       item_oTable.draw();
                       boxyLoading.hide();
                   }else if(res.res == 2){
                     $.msgbox( 'ERROR: al eliminar, '+res.msg+'.'
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
    
    function setFilterTable(colFilter,valFilter){

        oSettingsItem.aoPreSearchCols[colFilter].sSearch = valFilter==0? "": valFilter;
        item_oTable.draw();
    }
    
</script>{/literal}