{literal}
<script>
var urlDatos = '{/literal}{$getModule}{literal}&accion=getDatos';
var oTable_item;//Var para datatable
var mDialog = new Array();//Var para modal dialog
    
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
oTable_setting.aoColumns = [ 
        {"aTargets":[0], "sWidth": "30px", "sClass":"txtCenter", "bSearchable": false, "bSortable": false}//#
    ,   {"aTargets":[1], "sWidth": "auto", "sClass":"txtCenter"}
    ];
oTable_setting.sScrollY = "500px";
oTable_setting.sScrollX = "100%";
oTable_setting.sScrollXInner = "100%";
oTable_setting.bScrollCollapse = true;
oTable_setting.fnInitComplete = function(oSettings, json) {
                                        this.fnAdjustColumnSizing();
                                    };

$(document).ready(function (){
    $( "#progressbar" ).progressbar({
        value: false
    });
    //MODAL DIALOG FORM
    mDialog[0] = $("#modalDialog_Catalogo" ).dialog({ 
            autoOpen: false
        ,   maxHeight: 500
        ,   width: 600
        ,   modal: true
        ,   dialogClass: "mDialogClass"
        ,   beforeClose: function( event, ui ) {
                mDialog[1].remove();
                $("#contentTable").html(" ");
            }
        ,   buttons: [{
                    text: "Cerrar"
                ,   click: function() { 
                        $( this ).dialog( "close" );
                    }
            }]
    });//END DIALOG FORM
    //DATATABLE
    oTable_item = $('#oTable_1').dataTable(oTable_setting);
    //Settings datatable
    oSettingsTable = oTable_item.fnSettings();
});//END READY
    
function mostrarDatos(key){
    mDialog[0].dialog( "open" );
    $.post(urlDatos, {catalogo:key},function(response, status){
            $("#modalDialog_Catalogo #contentTable").html(response);  
    });
};
</script>
{/literal}