{literal}
<script>
$(document).ready(function() {
    tabsItem =  $("#tabsGrafica").tabs({
            ajaxOptions:{ 
                    error: function(xhr,status,index,anchor){
                        $( anchor.hash ).html(msgNotab);
                    }
            }
        ,   select: function(event,ui){
                boxyLoadingShow();
            }
        ,   load: function(event,ui){}
        ,   create: function(event,ui){}
        ,   beforeLoad: function( event, ui ){
                ui.jqXHR.error(function() {
                    ui.panel.html("Couldn't load this tab. We'll try to fix this as soon as possible. ");
                });
            }
        ,   beforeActivate: function ( event, ui ){ }
        ,   activate: function ( event, ui ){ }
    });    
});
function printReport(){
    $('div#panelGrafica').printArea();
}
</script>
{/literal}