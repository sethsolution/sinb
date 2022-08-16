{literal}
<link rel="stylesheet" type="text/css" href="js/jchartfx/styles/Palettes/jchartfx.palette.css" />
<link rel="stylesheet" type="text/css" href="js/jchartfx/styles/Attributes/jchartfx.attributes.css" />

<script type="text/javascript" src="js/jchartfx/js/jchartfx.system.js"></script>
<script type="text/javascript" src="js/jchartfx/js/jchartfx.coreBasic.js"></script>
<script type="text/javascript" src="js/jchartfx/js/jchartfx.advanced.js"></script>


<script type="text/javascript" src="js/print/jquery.PrintArea.js"></script>
<link rel="stylesheet" href="js/chosen/chosen.min.css" />
<script type="text/javascript" src="js/chosen/chosen.jquery.min.js"></script> 
<script>

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
			}
	,	onclose_end: function(panName) {
            if(panName == 'south') {
                east.resizeAll();
            }
        }
	,	onopen_end: function(panName) {
            if(panName == 'south') {
                east.resizeAll();
            }
        }


};

var pageLayout;
var accion, departamentoId;
var urlMunicipio = '{/literal}{$getModule}&accion=item{literal}_getMunicipio';
var tabsItem;
/*Var para cada elemento de filtrado*/
var idpanelTab = 1;

$(document).ready(function() {
    pageLayout = $("body").layout( pageLayoutOptions );
    pageLayout.hide('east');
    $("#btn_print").click(function (){
        printReport();
    });
    $("#btn_print").hide();
});//END READY
</script>
{/literal}