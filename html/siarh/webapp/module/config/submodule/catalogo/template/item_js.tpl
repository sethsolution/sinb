{literal}
<script>
var urlTablas = '{/literal}{$getModule}{literal}&accion=getTabla';
var oTable_item;//Var para datatable
var mDialog = new Array();//Var para modal dialog
var oSettingsTable;//Var establecimento de configuracion para datatbale
var oTable_setting = { 
        "bFilter": true
    ,   "bRetrieve": true
    ,   "bDestroy": true
    ,   "bAutoWidth": false
    ,   "bJQueryUI": true
    ,   "sPaginationType": "full_numbers"
    //, "iCookieDuration": 60*60,//Duracion de 1 hora de los cookies
    //, "bStateSave": true
    ,   "sDom": '<"H"r <l<"clear">f> >t<"F"ip<"clear">>'
    ,   "iDisplayLength": 25
    ,   "aLengthMenu": [[25, 50, 100, -1], [25, 50, 100, "Todos"]]
    ,   "oLanguage": { "sUrl": "js/DataTables/es_ES.txt?id=3273"}
};
// oTable_setting.oTableTools = { "sSwfPath": urlSwfPath};
oTable_setting.aoColumns = [ 
        {"aTargets":[0], "sWidth": "40px", "sClass":"txtCenter", "bSearchable": false, "bSortable": false}
    ,   {"aTargets":[1], "sWidth": "auto", "sClass":"txtCenter","bVisible":false, "bSearchable": false, "bSortable": false }
    ,   {"aTargets":[2], "sWidth": "10px", "sClass":"txtCenter", "bSearchable": false, "bSortable": false}
    ,   {"aTargets":[3], "sWidth": "auto", "sClass":"txtCenter"}
    ];
oTable_setting.sScrollY = "700px";
oTable_setting.sScrollX = "100%";
oTable_setting.sScrollXInner = "100%";
oTable_setting.bScrollCollapse = true;
oTable_setting.fnInitComplete = function(oSettings, json) {
        this.fnAdjustColumnSizing();
};

oTable_setting.fnDrawCallback = function ( oSettings ) {
    if ( oSettings.aiDisplay.length == 0 ){
                return;
    }
    var nTrs = $('#oTable_0 tbody tr');
    var iColspan = nTrs[0].getElementsByTagName('td').length;
    var sLastGroup = "";
    for ( var i=0 ; i<nTrs.length ; i++ ){
        var iDisplayIndex = oSettings._iDisplayStart + i;
        var sGroup = oSettings.aoData[ oSettings.aiDisplay[iDisplayIndex] ]._aData[1];
        if ( sGroup != sLastGroup ){
            var nGroup = document.createElement( 'tr' );
            var nCell = document.createElement( 'td' );
            nCell.colSpan = iColspan;
            nCell.className = "group";
            nCell.innerHTML = sGroup;
            nGroup.appendChild( nCell );
            nTrs[i].parentNode.insertBefore( nGroup, nTrs[i] );
            sLastGroup = sGroup;
        }
    }
}   

$(document).ready(function (){
    oTable_item = $('#oTable_0').dataTable(oTable_setting);
    oSettingsTable = oTable_item.fnSettings();
});//END READY

function getSubCategoria(key){
    $.post(urlTablas,{key:key}, function(response, status){
        $("#content_subCategorias").html(response);  
    });        
};
</script>
{/literal}