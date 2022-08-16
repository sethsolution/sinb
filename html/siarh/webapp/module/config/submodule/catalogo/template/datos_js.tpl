{literal}<script>
    var urlDatos = '{/literal}{$getModule}{literal}&accion=getDatos';
    var urlForm = '{/literal}{$getModule}{literal}&accion=getForm'; 
    var urlDelete = '{/literal}{$getModule}{literal}&accion=deleteData';       
    var oTable_item;//Var para datatable
    
    var oSettingsTable;//Var establecimento de configuracion para datatbale
    var oTable_setting = { "bFilter": true
                       , "bRetrieve": true
                       , "bDestroy": true
                       , "bAutoWidth": false
                       , "bJQueryUI": true
                       , "sPaginationType": "full_numbers"
                       //, "iCookieDuration": 60*60,//Duracion de 1 hora de los cookies
                       //, "bStateSave": true
                       , "sDom": '<"H"r <l<"clear">f> >t<"F"ip<"clear">>'
                       , "iDisplayLength": 25
                       , "aLengthMenu": [[25, 50, 100, -1], [25, 50, 100, "Todos"]]
                       , "oLanguage": { "sUrl": "js/DataTables/es_ES.txt?id=3273"}
                         
                  };

   // oTable_setting.oTableTools = { "sSwfPath": urlSwfPath};
    oTable_setting.aoColumns = [ {"aTargets":[0], "sWidth": "50px", "sClass":"txtCenter", "bSearchable": false, "bSortable": false}//#
                                ,{"aTargets":[1], "sWidth": "auto", "sClass":"txtCenter"}
                                 ,{"aTargets":[2], "sWidth": "auto", "sClass":"txtCenter"}
                               ];
    oTable_setting.sScrollY = "300px";
    oTable_setting.sScrollX = "100%";
    oTable_setting.sScrollXInner = "100%";
    oTable_setting.bScrollCollapse = true;
    oTable_setting.fnInitComplete = function(oSettings, json) {
                                        this.fnAdjustColumnSizing();
                                    };

        
               
    $(document).ready(function (){
      $("#progressbar").hide();
                //MODAL DIALOG FORM
        mDialog[1] = $("#modalDialog_1" ).dialog({ autoOpen: false
                                                  ,maxHeight: 400
                                                  ,width: 480
                                                  ,modal: true
                                                  ,dialogClass: "mDialogClassForm"
                                                  ,buttons: [{text: "Guardar"
                                                              ,click: function() { 
                                                                        submitForm();
                                                                      }}
                                                             ,{ text: "Cerrar"
                                                               ,click: function() { 
                                                                        $("#contentForm").html(" ");
                                                                         $( this ).dialog( "close" );
                                                                         
                                                                       }}
                                                             
                                                            ]});//END DIALOG FORM
                                                                     
         //DATATABLE
        oTable_itemDatos = $('#oTable_2').dataTable(oTable_setting);
				
;
        
        //Settings datatable
        oSettingsTable = oTable_itemDatos.fnSettings();

    
    });//END READY
    
    function itemUpdate($id,$type){
        mDialog[1].dialog( "open" );
        $.post(urlForm, {id:$id, type:$type, tabla:'{/literal}{$tablaGuardar}{literal}'},function(response, status){
            $("#modalDialog_1 #contentForm").html(response);  
        }); 
    };
    
    function itemDelete($id, $nombre){
      boxyLoadingShow();
      
      $.post(urlDelete,{id:$id, tabla:'{/literal}{$tablaGuardar}{literal}'}
               ,function (res,status,xhr){
                  redibujar();
                  boxyLoading.hide();
                  
                  if(res.res==1){
                    aDTSelected = [];
                  }else{
                    $.msgbox(res.msg);
                  }
                }
               ,"json");
                
    }
    
    function redibujar(){
         $.post(urlDatos, {catalogo:'{/literal}{$tablaGuardar}{literal}'},function(response, status){
            $("#modalDialog_Catalogo #contentTable").html(response);  
        });        
    }
    
</script>{/literal}