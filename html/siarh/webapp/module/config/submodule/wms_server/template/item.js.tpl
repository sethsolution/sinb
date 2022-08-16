{literal}<script>
    
    var privFace={};
    privFace.crear = '{/literal}{$privFace.crear}{literal}';
    privFace.editar = '{/literal}{$privFace.editar}{literal}';
    privFace.eliminar = '{/literal}{$privFace.eliminar}{literal}';
    
    var settingDialog = { modal:true
                         ,autoOpen: false
                         ,buttons: [{ text: "Cerrar"
                                      ,click: function() { 
                                                $( this ).dialog( "close" ); 
                                              } 
                                    }]
                         ,resizable: false
                         ,dialogClass: ""
                         ,show: {effect: "slide",   duration: 500}
                         ,hide: {effect: "clip", duration: 500}
                         ,title: "Dialog Title"                          
                        };
    
    var dialogView,dialogForm,progressbarView,progressbarForm,contentDialogForm,contentDialogView,msgDialogForm,msgDialogView;
    
    //Ventanas emergentes
    var oTableContratista;
    
    var tabsEvalDam;
    var optab ={/literal}{$optab}{literal}-1;
    var idficha = '{/literal}{$id}{literal}'; 

    $(document).ready(function() {
            tabsEvalDam =  $("#content_item #tabsMenu_evalDam").tabs({
                    ajaxOptions:{ error: function(xhr,status,index,anchor){
                                            $( anchor.hash ).html(msgNotab);
                                         }
                                },
                    select: function(event,ui){
                                boxyLoadingShow();
                            },
                    load:   function(event,ui){ boxyLoading.hide();},
                    create: function(event,ui){ boxyLoadingShow(); },
                    beforeLoad: function( event, ui ) {
                                  ui.jqXHR.error(function() {
                                                   ui.panel.html("Couldn't load this tab. We'll try to fix this as soon as possible. " +
                                                                 "If this wouldn't be a demo." );
                                                });
                                },
                    beforeActivate: function ( event, ui ){
                                        detroyDialog();
                                        ui.oldPanel.html("");
                                        boxyLoadingShow();
                                    },
                    activate: function ( event, ui ){ 
                        $( $.fn.dataTable.tables( true ) ).DataTable().columns.adjust();
                    },
                    selected: optab
            });//END TABS tabsMenu_snirI 
            
            $("#btn_print").click(function (){
              imprimirForm();   
            });//END CLICK
            
            
            
        //dialog View
        progressbar_dialogView = $("div#progressbar_dialogView");
        progressbar_dialogForm = $("div#progressbar_dialogForm");
        progressbar_dialogView.progressbar({value: false});
        progressbar_dialogForm.progressbar({value: false});
        
        contentDialogView = $("#dialogView div#content_dialogView");
        contentDialogForm = $("#dialogForm div#content_dialogForm");
        
        msgDialogView = $("#dialogView div#msg_dialogView");
        msgDialogForm = $("#dialogForm div#msg_dialogForm");
        
        var dialogViewSetting = {};
        dialogViewSetting = $.extend( {}, settingDialog );
        dialogViewSetting.close = function (event){
                                    progressbar_dialogView.show();
                                    contentDialogView.html('');
                                    msgDialogView.html('');
                                  };                                  
        dialogViewSetting.open = function (event,ui){};
        dialogView = $("div#dialogView").dialog(dialogViewSetting);
        
        var dialogFormSetting = {};
        dialogFormSetting = $.extend( {}, settingDialog );        
        dialogFormSetting.close = function (event){
                                    progressbar_dialogForm.show();
                                    contentDialogForm.html('');
                                    msgDialogForm.html('');
                                  };
        dialogFormSetting.open = function (event,ui){};
        
        if(privFace.crear){
            dialogFormSetting.buttons.push({text: "Guardar"
                                            ,click: function() { 
                                                        $(this).find("form#itemModalForm").submit(); 
                                                    } });
        }
       dialogForm = $("div#dialogForm").dialog(dialogFormSetting);
                                               
            
        });
    
    function detroyDialog(){
        $("body .snirModalDialog").remove();    
    }
    
    function cancelRegItem(type){	
      if (type == 1){
        msg = '&iquest;Quiere salir del registro de la ficha?<br> Recuerde que los datos no se guardaran';
      }else{
        msg = '&iquest;Est&aacute; seguro de salir de la actualizaci&oacute;n de la ficha de usuario';
      }
       
      $.msgbox(msg
                 ,{type: "confirm"
                   ,buttons : [{type: "submit", value: "Si"},
                               {type: "cancel", value: "No"}]}
                 ,function(result){
                    if(result){
                      location = '{/literal}{$getModule}{literal}';
                    }
                 });  
      
    }

    function imprimirForm(){
      randomnumber=Math.floor(Math.random()*11);
      url = "{/literal}{$getModule}{literal}&accion=print&rand="+randomnumber+"&idficha="+idficha;
      window.open(url,'Impresion_ficha');    
    } 

    function changeTabsid(){
            var current_index = $("#content_item #tabsMenu_evalDam").tabs("option","active");
            $("#tabsMenu_evalDam").tabs('load',current_index);
    }
    
</script>
{/literal}