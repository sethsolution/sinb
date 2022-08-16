{literal}
<script>
var optionsModalForm = { beforeSubmit:showRequestModalForm
                       ,dataType:'json'
                       ,success:showResponseModalForm
                       ,data:{idficha:idficha,accion:'{/literal}{$subcontrol}{literal}_submoduloSaveSql'}};
              
var listModulo = [], listSubmodulo = [];
var urlListSubmodulo = '{/literal}{$getModule}&accion={$subcontrol}_{literal}getSubmoduloList&fichaId='+idficha;
var oSettingsSubmodulo,submodulo_oTable;

$(document).ready(function (){
    
    $('#itemModalForm').ajaxForm(optionsModalForm);
    
    $("#moduloId").chosen({ no_results_text: "No se encontraron resultados!"
                           ,allow_single_deselect: true})
                  .change(function(evt, params){
                            paramVal = typeof(params.selected) != "undefined"? params.selected: params.deselected;
                            setParamArray(paramVal,1);  
                          });
    
    submodulo_oTable = $('#submodulo_table').DataTable({ 
            aoColumnDefs: [ {"searchable": false, "targets": [0,3] }
                           ,{"width": "25px", "targets": 0}
                           ,{"visible": false, "targets":[2,3]}
                          ]
        ,   "info": false
        ,   "ordering": false
        ,   "pagingType": "full_numbers"
        ,   "sScrollY": "260"
        ,   "sScrollX": "100%"
        ,   "bScrollCollapse": true
        ,   "jQueryUI":       true
        ,   "language": {"url": "js/DataTables/es_ES.txt?id=42"}
        ,   "lengthMenu": [[10, 20, 50, -1], [10, 20, 50, "Todo"]]
        ,   "destroy": true
        ,   "createdRow": function ( row, data, index ) {
                            var rowid = $(row).attr("id");
                            rowid = rowid.substring(4);
                            if (jQuery.inArray(rowid, listSubmodulo)!='-1'){
                                $(row).find("input:checkbox").attr('checked', 'checked');
                            }
                         }
        ,   "drawCallback": function ( settings ) {
                                var api = this.api();
                                var rows = api.rows( {page:'current'} ).nodes();
                                var last=null;
                                api.column(2, {page:'current'} ).data().each( function ( group, i ) {
                                    if ( last !== group ) {
                                        $(rows).eq( i ).before(
                                            '<tr class="group1"><td colspan="2"><div class="titulo_m">'+group+'</div></td></tr>'
                                        );
                                        last = group;
                                    }//END IF
                                });
                                api.column(3, {page:'current'} ).data().each( function ( group, i ) {
                                    if ( last !== group ) {
                                        $(rows).eq( i ).before(
                                        '<tr class="group2"><td colspan="2"><div class="titulo_subm">'+group+'</div></td></tr>'
                                        );
                                        last = group;
                                    }//END IF
                                });
                                submodulo_oTable.columns.adjust();
                            }//END FUNCTION
        ,   "initComplete": function(settings, json) {
                                $('.dataTables_scrollBody').css('min-height', '250px');
                                submodulo_oTable.columns.adjust();
                            }
        ,   "processing": true
        ,   "serverSide": true
        ,   "destroy": true
        ,   "ajax": {"url": urlListSubmodulo, "type": "POST"}
    }); 
    
    //settings de datatable
    oSettingsSubmodulo = submodulo_oTable.settings();
    oSettingsSubmodulo = oSettingsSubmodulo[0];
        
});

function setParamArray(val,tipo){
    
    if(tipo==1){
      var index = jQuery.inArray(val, listModulo);
      
      if( index === -1 ){
          listModulo.push(val);
      }else{
          listModulo.splice( index, 1 );
      }//END IF
      
      //oSettingsSubmodulo[0].aoPreSearchCols[2].sSearch = ""+listModulo.join()+"";
      
      oSettingsSubmodulo.aoPreSearchCols[2].sSearch = ""+listModulo.join()+"";;
      submodulo_oTable.draw();
      
      ///submodulo_oTable.filter( listModulo.join(), 2 );;
        
    }else if(tipo==2){
      var index = jQuery.inArray(val, listSubmodulo);  
      
      if( index === -1 ){
          listSubmodulo.push(val);
        }else{
          listSubmodulo.splice( index, 1 );
      }//END IF
      
    }
    
}

function showRequestModalForm(formData, jqForm, options) { 
    options.data.submodulo = listSubmodulo;
    options.extraData.submodulo = listSubmodulo;

    var res = verifica();
        
    return res; 
} 

function showResponseModalForm(responseText, statusText)  {
   
    if(responseText.res == 1){
        
        item_oTable.draw();
        dialogForm.dialog("close");
        boxyLoading.hide();
        
    }else if(responseText.res == 2){
       $.msgbox( 'ERROR: '+responseText.msg+'.'
                  ,{type: "error"
                    ,buttons : [{type: "submit", value: "Aceptar"}]
                   }
                  ,function(result) {
                     dialogForm.dialog("close");
                     boxyLoading.hide();
                   }
                 ); 

    }else{
       $.msgbox( 'ERROR: '+responseText.msg+'. Consulte con el Adminsitrador.'
                  ,{type: "error"
                    ,buttons : [{type: "submit", value: "Aceptar"}]
                   }
                  ,function(result) {
                     dialogForm.dialog("close");
                     boxyLoading.hide();
                   } 
                 ); 

    } 
}

function verifica(){
    if(listSubmodulo.length == 0){
		$.msgbox('Seleccione uno o m&aacute;s submodulo(s).');
		return false;
	}else{
        boxyLoadingShow();
    	return true;
	}
    
	return false;
}
</script>{/literal}