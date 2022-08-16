{literal}<script>
var url = '{/literal}{$getModule}{literal}&accion=getItemList';
$(document).ready(function (){
    item_oTable = $('#item_table').DataTable({ 
            aoColumnDefs: [
                    { sortable: false, searchable: false, "targets": [0,1] }
                ,   {"width": "40px", "targets": 0}
                ,   {visible: false, "targets": [4]}
                ,   {"width": "50px", "targets": 1}
            ]
        ,   "info": false
        ,   "order": [[ 2, "asc" ]]
        ,   "pagingType": "full_numbers"
        ,   "scrollY": 400
        ,   "scrollX": true
        ,   "scrollCollapse": true
        ,   "jQueryUI":       true
        ,   "language": {"url": "js/DataTables/es_ES.txt?id=42"}
        ,   "lengthMenu": [[10, 20, 50, -1], [10, 20, 50, "Todo"]]
        ,   "processing": true
        ,   "serverSide": true
        ,   "destroy": true
        ,   "fnDrawCallback": function( oSettings ) {
                var totalFicha = oSettings.json.iSummary.totalItem!=''?oSettings.json.iSummary.totalItem:0;
                sumTotalFicha.html(totalFicha);                                            
            }
        ,   "ajax": {"url": url,"type": "POST"}  
    }); 
    oSettingsItem = item_oTable.settings();
    oSettingsItem = oSettingsItem[0];
});//END DOCUMENT READY
    
function itemPrint(idficha){
    randomnumber=Math.floor(Math.random()*11);
    url = "{/literal}{$getModule}{literal}&accion=print&rand="+randomnumber+"&idficha="+idficha;
    window.open(url,'Impresion_ficha');    
} 
</script>{/literal}