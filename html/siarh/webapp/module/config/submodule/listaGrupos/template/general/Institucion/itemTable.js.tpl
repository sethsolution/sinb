{literal}<script>

    var urlItemTable = '{/literal}{$getModule}&accion={$subcontrol}{literal}_getListInstitucion';
    
    $(document).ready(function() {
        
        oTableItem = $('#tableItem').DataTable(
                    { aoColumnDefs: [{ sortable: false, searchable: false, "targets": [0] }
                                     ,{"width": "15px", "targets": 0}   
                                    ]
                     ,"info": false
                     , "order": [[ 1, "asc" ]]
                     ,"pagingType": "full_numbers"
                     ,"scrollY": 300
                     ,"scrollX": true
                     ,"scrollCollapse": true
                     ,"jQueryUI":       true
                     ,"language": {"lengthMenu": "Mostrar _MENU_ registros"
                                    ,"zeroRecords": "No existen datos - Lo siento"
                                    /*,"info": "Showing page _PAGE_ of _PAGES_"*/
                                    ,"info": ""
                                    ,"infoEmpty": "No existe registros disponibles"
                                    ,"infoFiltered": "(Filtrado de _MAX_ registros)"}
                     ,"lengthMenu": [[10, 20, 50, -1], [10, 20, 50, "Todo"]]
                     ,"processing": true
                     ,"serverSide": true
                     ,"destroy": true
                     ,"ajax": {"url": urlItemTable, "type": "POST"}
                     ,"fnInitComplete": function(oSettings, json) {
                                            progressbar_dialogView.hide();
                                            contentDialogForm.show();
                                              
                                        }
                     });//END DATATABLE 
        oTableItem.columns.adjust().draw();
    });//END READY


    function setInstitucion(id,name){
        $("#idInstitucion").val(id);
        $("#institucionName").html(name);
        dialogView.dialog("close");
    }
</script>{/literal}