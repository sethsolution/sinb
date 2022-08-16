{literal}
<script>
    var tabsParteI;
    var optabI ={/literal}{$optabParte}{literal}-1;
    var opSubTab ={/literal}{$opSubTab}{literal}-1;
    
    $(document).ready(function() {
            
            tabsParteI =  $("#tabsModulos").tabs({
                    ajaxOptions:{ error: function(xhr,status,index,anchor){
                                            $( anchor.hash ).html(msgNotab);
                                         }
                                },
                    select: function(event,ui){
                        
                               // boxyLoadingShow();
                                $(ui.panel).html(htmlLoading);
                            },
                    load:   function(event,ui){ boxyLoading.hide();},
                  //  create: function(event,ui){ boxyLoadingShow(); },
                    beforeLoad: function( event, ui ) {
                                  ui.jqXHR.error(function() {
                                                   ui.panel.html("Couldn't load this tab. We'll try to fix this as soon as possible. " +
                                                                 "If this wouldn't be a demo." );
                                                });
                                },
                    beforeActivate: function ( event, ui ){
                                       // detroyDialog();
                                        ui.oldPanel.html("");
                                       // boxyLoadingShow();
                                    },
                    activate: function ( event, ui ){ },
                    //selected: optabI
            });//END TABS tabsMenu_snirI 
        });
    
    function detroyDialog(){
        $("body .snirModalDialog").remove();    
    }
</script>
{/literal}