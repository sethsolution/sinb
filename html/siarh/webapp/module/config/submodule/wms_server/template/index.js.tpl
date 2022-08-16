{literal}<script>

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


var item_oTable, oSettingsItem,sumTotalFicha;

var idpanelTab = 1;
/* Variables para gráficas */
//var chart01,chart02,chart03,chartaux;

                               
$(document).ready(function () {
    
    pageLayout = $("body").layout( pageLayoutOptions );
    pageLayout.hide('east');
    pageLayout.hide('north')

    sumTotalFicha = $("label#item_totalficha");
    
    /* fin verificar */
                                         
    var tabsItem =  $("#tabsItem").tabs({
                    
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


    function setChart(){
        
        chart01 = new cfx.Chart();
        chart02 = new cfx.Chart();
        chart03 = new cfx.Chart();chartaux = new cfx.Chart();
        
        $.post(urlchart,
               {selValconv:selValconv,selValsec:selValsec,selValproy:selValproy,selValavfin:selValavfin,selValavfis:selValavfis},
               function (response,textStatus, jqHXR){
                    if(response.departamento.length>0){
                      //FIRST CHART    
                      var items = $.map(response.proyecto, function(item, index) {
                                                                return window.parseInt(item);
                                                            });
                      
                      chart01.getAxisX().getTitle().setText("Departamentos");
                      chart01.getAxisY().getTitle().setText("Cantidad");
                        
                      var data = chart01.getData();
                      data.setSeries(1);
                      data.setPoints(response.proyecto.length);
                      
                      for(var i=0; i<response.proyecto.length; i++){
                          data.setItem(0, i, items[i]);
                          chart01.getAxisX().getLabels().setItem(i, response.departamento[i].substr(0,3));
                      }

                      chart01.getToolTips().setEnabled(true);
                      chart01.getDataGrid().setVisible(true); 
                      chart01.getSeries().getItem(0).setText("Cant. Proyectos");
                      chart01.setGallery(cfx.Gallery.bar);

                      var divHolder01 = $('#ChartDivProy');
                      divHolder01.html("");                      
                      chart01.create(divHolder01[0]);                                                                       


                      //SECOND CHART
                      var itemsMontobs = $.map(response.montoBS, function(item, index) {
                                                                return window.parseInt(item);
                                                            });
                      var itemsMontous = $.map(response.montoUS, function(item, index) {
                                                                return window.parseInt(item);
                                                            });
                      chart02.getAxisX().getTitle().setText("Departamentos");
                      chart02.getAxisY().getTitle().setText("Monto");
                        
                      var data = chart02.getData();
                      data.setSeries(2);
                      data.setPoints(response.proyecto.length);
                        
                      for(var i=0; i<response.proyecto.length; i++){
                          data.setItem(0, i, itemsMontobs[i]);
                          data.setItem(1, i, itemsMontous[i]);
                          chart02.getAxisX().getLabels().setItem(i, response.departamento[i].substr(0,3));
                      }
chart02.getToolTips().setEnabled(true);
chart02.getDataGrid().setVisible(true);
                      
                      chart02.setGallery(cfx.Gallery.bar);
                      chart02.getSeries().getItem(0).setText("Monto en Bs.");
                      chart02.getSeries().getItem(1).setText("Monto en Us.");
                      chart02.getLegendBox().setDock(cfx.DockArea.Bottom);
                      chart02.getLegendBox().setContentLayout(cfx.ContentLayout.Near);

                      var divHolder02 = $('#ChartDivMonto');
                      divHolder02.html("");                      
                      chart02.create(divHolder02[0]);  
                      
                      
                      //THIRD CHART
                      var itemsFinanciero = $.map(response.avfinanciero, function(item, index) {
                                                                return window.parseInt(item);
                                                            });  
                      var itemsFisico = $.map(response.avfisico, function(item, index) {
                                                                return window.parseInt(item);
                                                            });
                      chart03.getAxisX().getTitle().setText("Departamentos");
                      chart03.getAxisY().getTitle().setText("Avances Fisico vs Financiero");
                        
                      var data = chart03.getData();
                      data.setSeries(2);
                      data.setPoints(response.proyecto.length);
                        
                      for(var i=0; i<response.proyecto.length; i++){
                          data.setItem(0, i, itemsFinanciero[i]);
                          data.setItem(1, i, itemsFisico[i]);
                          chart03.getAxisX().getLabels().setItem(i, response.departamento[i].substr(0,3));
                      }
chart03.getToolTips().setEnabled(true);
chart03.getDataGrid().setVisible(true);
                      
                      chart03.setGallery(cfx.Gallery.Lines);
                      chart03.getSeries().getItem(0).setText("Avance Financiero");
                      chart03.getSeries().getItem(1).setText("Avance Fisico");

                      var divHolder03 = $('#ChartDivAvn');
                      divHolder03.html("");                      
                      chart03.create(divHolder03[0]);
                      
                    }else{
                        
                    }
                },
                "json");//END $.POST
    
    }//END FUNCTIO SETCHART
    
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