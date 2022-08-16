{literal}<script>

    var urlFichasTable = '{/literal}{$getModule}&accion={$subcontrol}_getFichasList&nameTable={$nameTable}&moduloId={$moduloId}{literal}&fichaId='+idficha;
    
    //var urlPersonaAdd = '{/literal}{$getModule}&accion={$subcontrol}{literal}_setPersona&fichaId='+idficha;
    var urlFichaAdd = '{/literal}{$getModule}&accion={$subcontrol}_setPersona&nameTable={$nameTable}{literal}&fichaId='+idficha;
    
    $(document).ready(function() {

         var idficha = '{/literal}{$id}{literal}';
         var tipoRiego = '{/literal}{$tipoRiego}{literal}';
        
          oTableItem = $('#tableItem').dataTable(
            { aoColumnDefs: [{ sortable: false, searchable: false, "targets": [0,1] }
                       ,{"width": "15px", "targets": 0},{"width": "35px", "targets": 1}
                               ]
                     //,"info": false
                     , "order": [[ 2, "asc" ]]
                    /* ,"dom": '<"top"lfr<"clear">>t<"bottom"ip<"clear">><"clear">'*/
                     ,"pagingType": "full_numbers"           
                     ,"fnInitComplete": function(oSettings, json) {
                        progressbar_dialogView.hide();
                        contentDialogForm.show();
                        contentDialogForm.find(".dataTables_scrollBody").css({"max-height": "200px"});
                          
                        if($(this).length > 0 ) {
                          oTableItem.fnAdjustColumnSizing();                                           
                        } 
                      }
                     ,"scrollY": 400
                     ,"scrollX": true
                     ,"scrollCollapse": true
                     ,"jQueryUI":       true
                     ,"language": {"url": "js/DataTables/es_ES.txt?id=42"}
                     ,"lengthMenu": [[10, 20, 50, -1], [10, 20, 50, "Todo"]]
                     ,"processing": true
                     ,"serverSide": true
                     ,"destroy": true
                     ,"ajax": urlFichasTable 
                     });
    

        
    });

    
    function setPersonas(idFichaSet,idModulo){
        $.post(urlFichaAdd
               ,{idFichaSet:idFichaSet ,idModulo:idModulo} 
               ,function (res, txtStatus, jqXHR){
                 if(txtStatus=='success'){
                    //contentDialogForm.html(res);
                    progressbar_dialogForm.hide();
                    oTableItem.fnDraw();
                    item_oTable.draw();
                 }else{
                   msgDialogForm.html("Error al recibir la informacion.").attr("class","msgWrong");
                   progressbar_dialogForm.hide(); 
                 }
                 
       });
    }

</script>{/literal}