{literal}<script>
var url = '{/literal}{$getModule}{literal}&accion=getItemList';
var urlPrincipal = '{/literal}{$getModule}{literal}&accion=updatePrincipal';

$(document).ready(function (){
        
    item_oTable = $('#item_table').DataTable({
            aoColumnDefs: [
                    { sortable: false, searchable: false, "targets": [0,1,2,9,10,11,12,13,14,15,17,18] }
                ,   {"width": "40px", "targets": 0}
                ,   {"width": "58px", "targets": 1}
                ,   {"class": "fotoT2","width": "35px", "targets": 2}
                ,   {visible: false, "targets": [9,10,11,12,13,14,15,16,17,18]}
                ,   {class: "details-control", "targets": [0]}
            ]
        ,   "info": false
        ,   "order": [[ 3, "asc" ]]
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
        ,   "drawCallback": function( oSettings ) {
                item_oTable.columns.adjust();
                var totalFicha = oSettings.json.iSummary.totalItem!=''?oSettings.json.iSummary.totalItem:0;
                sumTotalFicha.html(totalFicha);                                            
            }
        ,   "initComplete": function(settings, json) {
                $('.dataTables_scrollBody').css('min-height', '400px');
                item_oTable.columns.adjust();
            }    
        ,   "ajax": {"url": url,"type": "POST"}  
    }); 
        
    // Add event listener for opening and closing details
    $('#item_table tbody').on('click', 'td.details-control', function () {
        var tr = $(this).closest('tr');
        var row = item_oTable.row( tr );
        if ( row.child.isShown() ) {
            // This row is already open - close it
            row.child.hide();
            tr.removeClass('shown');
        }else{
            // Open this row
            row.child( format(row.data()) ).show();
            tr.addClass('shown');
        }
    });
    oSettingsItem = item_oTable.settings();
    oSettingsItem = oSettingsItem[0];
});//END DOCUMENT READY
    
/* Formatting function for row details - modify as you need */
function format ( d ) {
        // `d` is the original data object for the row
        var sOut = '<div class="info02" style="width:95% !important;">';
            sOut += '<div class="title">INFORMACI&Oacute;N PERSONAL</div>';
            
            sOut += '<table width="100%" cellspacing="0" border="0">';
            
            sOut += '<tr><td class="pregunta">Telefono: </td><td class="respuesta" >'+d[10]+' </td>';
            sOut += '<td class="pregunta">Celular: </td><td class="respuesta">'+d[11]+'</td>';
            sOut += '<td class="pregunta">Email: </td><td class="respuesta">'+d[12]+'</td></tr>';
            
            sOut += '<tr><td class="pregunta">Direcci&oacute;n: </td><td class="respuesta" colspan="5">'+d[13]+'</td></tr>';
            sOut += '<tr><td class="pregunta">Descripci&oacute;n: </td><td class="respuesta" colspan="5">'+d[14]+'</td></tr>';
            sOut += '</table><br>';
            
            sOut += '<div class="title">INFORMACI&Oacute;N ADICIONAL</div>';
            
            sOut += '<table width="100%" cellspacing="0" border="0">';
            
            sOut += '<tr><td class="pregunta">Ultimo ingreso: </td><td class="respuesta" >'+d[9]+' </td>';
            sOut += '<td class="pregunta">I.P.: </td><td class="respuesta">'+d[15]+'</td></tr>';

            sOut += '<tr><td class="pregunta">Fecha Creada: </td><td class="respuesta" >'+d[17]+' </td>';
            sOut += '<td class="pregunta">Fecha Actualizada:  </td><td class="respuesta">'+d[18]+'</td></tr>';
            
            
            sOut += '</table>';
            
            sOut += '</div>';
    return sOut;
}
    
    function itemPrint(idficha){
      randomnumber=Math.floor(Math.random()*11);
      url = "{/literal}{$getModule}{literal}&accion=print&rand="+randomnumber+"&idficha="+idficha;
      window.open(url,'Impresion_ficha');    
    } 

    function updatePrincipal(id,tipo){
        data = {id:id,tipo:tipo};
        boxyLoadingShow();
        $.post(urlPrincipal
               ,data 
               ,function (res, txtStatus, jqXHR){
                    boxyLoading.hide();
    
                    if(txtStatus=='success'){
                      if(res.res==1){
                        item_oTable.draw(); 
                          
                      }else{
                        $.msgbox(''+res.msg);
                      }  
                      
                    }else{
                      $.msgbox('Error con la conexion al Servidor.'); 
                    }
                     
              },"json");//END $:POST
    }  
</script>{/literal}