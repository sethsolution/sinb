{literal}
<script>

var urlPermiso = '{/literal}{$getModule}&accion={$subcontrol}_{literal}getItemList&fichaId='+idficha;
var urlPermisoForm = '{/literal}{$getModule}&accion={$subcontrol}_{literal}getItemForm&fichaId='+idficha;
var urlPermisoSave = '{/literal}{$getModule}&accion={$subcontrol}_{literal}savePermiso&fichaId='+idficha;
var urlDelete = '{/literal}{$getModule}&accion={$subcontrol}_{literal}itemDelete&fichaId='+idficha;
var listModuloUser = [];
var oSettingsItem,item_oTable;
    
$(document).ready(function (){
    //console.log($("#moduloIdUSer"));        
    $("#moduloIdUSer").chosen({
            no_results_text: "No se encontraron resultados!"
        ,   allow_single_deselect: true 
    }).change(function(evt, params){
        paramVal = typeof(params.selected) != "undefined"? params.selected: params.deselected;
        setParamArray(paramVal,1);  
    });
    
    item_oTable = $("#item_table").DataTable({
            aoColumnDefs: [
                    {"searchable": false, "targets": [0,1,3,4,5,8,9] }
                ,   {"width": "25px", "targets": [0,1]}
                ,   {"width": "35px", "targets": [3,4,5]} 
                , {"visible": false, "targets":[8,9,6,7]}
                ,   {"className": "txtCenter", "targets": [ 1,3,4,5 ] }  
            ]
        ,   "info": false
        ,   "ordering": false
        //,   "scrollY": "400"
        ,   "scrollX": true
        ,   "scrollCollapse": true
        ,   "jQueryUI":       true
        ,   "language": {"url": "js/DataTables/es_ES.txt?id=42"}
        ,   "lengthChange": false
        ,   "paging": false
        ,   "processing": true
        ,   "serverSide": true
        ,   "destroy": true
        ,   "drawCallback": function ( settings ) {
                var iTotalRecords = settings._iRecordsDisplay-1;
                var api = this.api();
                var rows = api.rows( {page:'current'} ).nodes();
                var last=null;
                var lastIdModulo=null;
                var lastSubmodulo=null;
                var lastIdSubmodulo=null;
                var iTotalCrear=0;
                var iTotalEditar=0;
                var iTotalEliminar=0;
                var iTotalChckbx=0;
                
                api.column(8, {page:'current'} ).data().each( function ( group, i ) {
                    if (last!==group ) {
                        //Primer valor es nombre del modulo, segundo parametro es el ID del modulo
                        textGroup = group.split("|");
                        
                        $(rows).eq( i ).before(
                            '<tr class="group1">'+
                            '<td colspan="3"><div class="dizq50 titulo_m">'+textGroup[0]+'</div>'+
                            '<div class="dder50 boton_m"><input type="button" value="Guardar" class="boton btn_savePermiso" rel="'+textGroup[1]+'" style="margin-left:25px;" id="btn_mod_'+textGroup[1]+'"  ></td>'+
                            '<td class="" style="text-align:center;"><input type="checkbox" class="input m_chckbx" id="m_crear_'+textGroup[1]+'" rel="'+textGroup[1]+'|1" ></td>'+
                            '<td style="text-align:center;"><input type="checkbox" class="input m_chckbx" id="m_editar_'+textGroup[1]+'" rel="'+textGroup[1]+'|2"></td>'+
                            '<td style="text-align:center;"><input type="checkbox" class="input m_chckbx" id="m_eliminar_'+textGroup[1]+'" rel="'+textGroup[1]+'|3"></td>'+
                            '</tr>'
                        );
                        if(iTotalCrear==iTotalChckbx){
                            $("#item_table").find("input.m_chckbx:checkbox[rel='"+lastIdModulo+"|1']").prop("checked",true);
                        }
                        if(iTotalEditar==iTotalChckbx){
                            $("#item_table").find("input.m_chckbx:checkbox[rel='"+lastIdModulo+"|2']").prop("checked",true);
                        }
                        if(iTotalEliminar==iTotalChckbx){
                            $("#item_table").find("input.m_chckbx:checkbox[rel='"+lastIdModulo+"|3']").prop("checked",true);                                                                                                          
                        }
                        last = group;
                        lastIdModulo = textGroup[1];
                        iTotalCrear=0;
                        iTotalEditar=0;
                        iTotalEliminar=0;
                        iTotalChckbx=0;
                    }//END IF
                    
                    if($(rows).eq( i ).find("td:eq(3) .sm_chckbx").prop("checked"))
                        iTotalCrear++;

                    if($(rows).eq( i ).find("td:eq(4) .sm_chckbx").prop("checked"))  
                        iTotalEditar++;
                    
                    if($(rows).eq( i ).find("td:eq(5) .sm_chckbx").prop("checked"))  
                        iTotalEliminar++;

                    iTotalChckbx++;

                    if(i==iTotalRecords){
                        if(iTotalCrear==iTotalChckbx)
                            $("#item_table").find("input.m_chckbx:checkbox[rel='"+lastIdModulo+"|1']").prop("checked",true);
                        if(iTotalEditar==iTotalChckbx)
                            $("#item_table").find("input.m_chckbx:checkbox[rel='"+lastIdModulo+"|2']").prop("checked",true);
                        if(iTotalEliminar==iTotalChckbx)
                            $("#item_table").find("input.m_chckbx:checkbox[rel='"+lastIdModulo+"|3']").prop("checked",true);                                                                                                          
                    }//END IF
                });//END EACH API COLUMN
                api.column(9, {page:'current'} ).data().each( function ( groupSubmodulo, i ) {
                    if (lastSubmodulo!==groupSubmodulo ) {
                        //Primer valor es nombre del modulo, segundo parametro es el ID del modulo
                        textGroup = groupSubmodulo.split("|"); 
                        $(rows).eq( i ).before(
                            '<tr class="group2"><td colspan="3"><div class="titulo_subm">'+textGroup[0]+'</div></td>'+
                            '<td style="text-align:center;"></td>'+'<td style="text-align:center;"></td>'+
                            '<td style="text-align:center;"></td>'+'</tr>'
                        );
                        if(iTotalCrear==iTotalChckbx){
                            $("#item_table").find("input.sm_chckbx:checkbox[rel='"+lastIdModulo+"|1']").prop("checked",true);
                        }
                        if(iTotalEditar==iTotalChckbx){
                            $("#item_table").find("input.sm_chckbx:checkbox[rel='"+lastIdModulo+"|2']").prop("checked",true);
                        }
                        if(iTotalEliminar==iTotalChckbx){
                            $("#item_table").find("input.sm_chckbx:checkbox[rel='"+lastIdModulo+"|3']").prop("checked",true);                                                                                                          
                        }
                        lastSubmodulo = groupSubmodulo;
                        lastIdSubmodulo = textGroup[1];
                    }//END IF
                                            
                });//END EACH API COLUMN
                $("input:checkbox.m_chckbx").bind("click", function(){
                    checkModulo($(this).attr("rel"),$(this).prop('checked'),$(this).attr("id"));
                });
                $("input:checkbox.sm_chckbx").bind("change", function(){
                    checkSubModulo($(this).attr("rel"),$(this).prop('checked'),$(this).attr("id"));
                });
                $("input:button.btn_savePermiso").bind("click", function (){
                    savePermisosModulo($(this).attr("rel"));
                });
                
                item_oTable.columns.adjust();
            }//END FUNCTION
        ,   "initComplete": function(settings, json) {
                                $('.dataTables_scrollBody').css('min-height', '200px');
                                item_oTable.columns.adjust();
                            }    
        ,   "ajax": {"url": urlPermiso, "type": "POST"}
    }); 
        
    //settings de datatable  
    oSettingsItem = item_oTable.settings();
    oSettingsItem = oSettingsItem[0];
    
    $("#btn_addPermiso").bind("click", function(){
        addPermiso('Adicion de permisos',{tipo:'new'});
    });
            
});//END DOCUMENT READY



  function savePermisosModulo(moduloId){
    var listCheckbox={};
    
    //Deshabilitamos el boton respectivo
    $("input.btn_savePermiso:button[id='btn_mod_"+moduloId+"']").val("Guardando....").attr("disabled","disabled").removeClass("boton");
    
    $("input.sm_chckbx:checkbox[rel='"+moduloId+"|3']").each(function (){
      var auxId = $(this).attr("id").split("_");
      auxId = parseInt(auxId[2]);
      
      auxVal = $(this).is(":checked")? 1: 0;
            
      listCheckbox[auxId] = {};      
      listCheckbox[auxId].eliminar = auxVal; 
    })//END EACH

    $("input.sm_chckbx:checkbox[rel='"+moduloId+"|2']").each(function (){
      var auxId = $(this).attr("id").split("_");
      auxId = parseInt(auxId[2]);
      
      auxVal = $(this).is(":checked")? 1: 0;
      listCheckbox[auxId].editar = auxVal;       
    })//END EACH
    
    $("input.sm_chckbx:checkbox[rel='"+moduloId+"|1']").each(function (){
      var auxId = $(this).attr("id").split("_");
      auxId = parseInt(auxId[2]);
      
      auxVal = $(this).is(":checked")? 1: 0;
      listCheckbox[auxId].crear = auxVal; 
    })//END EACH

    $.post(urlPermisoSave
          ,{"list":JSON.stringify(listCheckbox)}
          ,function (res,status){
             
             $("input.btn_savePermiso:button[id='btn_mod_"+moduloId+"']").val("Guardar").removeAttr("disabled").addClass("boton");
             
             if(res.res==1){
                item_oTable.draw();
             }else{
                $.msgbox( 'ERROR: '+responseText.msg+'.'); 
             }//END IF
             
             
          }//END FUNCTION
          ,"json");
  }
  
  function checkModulo(data,state,idChckbx){
      $("#item_table").find("input.sm_chckbx:checkbox[rel='"+data+"']").prop("checked",state);
      idChckbx = idChckbx.split("_");
      idChckbx = idChckbx[2];
      
      auxData = data.split("|");
      var cColumn = auxData[1];

      if(cColumn==1 && state){
        $("#item_table").find("input#m_editar_"+idChckbx).prop("checked",state);
        $("#item_table").find("input.sm_chckbx:checkbox[rel='"+auxData[0]+"|2']").prop("checked",state);
        
      }else if(cColumn==2 && !state){
        $("#item_table").find("input#m_crear_"+idChckbx).prop("checked",state);
        $("#item_table").find("input.sm_chckbx:checkbox[rel='"+auxData[0]+"|1']").prop("checked",state);
      }  
    
  } 
  
  function checkSubModulo(data,state,idChckbx){
    //Check checkbox del modulo si todos submodulos estan activos
    setModuloCheck(data);
    idChckbx = idChckbx.split("_");
    idChckbx = idChckbx[2];
    
    auxData = data.split("|");
    var cColumn = auxData[1];

    if(cColumn==1 && state){
      $("#item_table").find("input#sm_editar_"+idChckbx).prop("checked",state);
      setModuloCheck(auxData[0]+"|2");
    }else if(cColumn==2 && !state){
      $("#item_table").find("input#sm_crear_"+idChckbx).prop("checked",state);
      setModuloCheck(auxData[0]+"|1");
    }  
    
  } 
  //funcion que verifica si todos los checkbox de los dependientes de un modulo (submodulos) estan marcados al ser asi se marca el check correspondiente o se desmarca
  function setModuloCheck(data){
    var auxChckbx = $("#item_table").find("input.sm_chckbx:checkbox[rel='"+data+"']");
    
    if(auxChckbx.length==auxChckbx.filter(':checked').length)
      $("#item_table").find("input.m_chckbx:checkbox[rel='"+data+"']").prop("checked",true);  
    else
      $("#item_table").find("input.m_chckbx:checkbox[rel='"+data+"']").prop("checked",false);
      
  } 
  
  function addPermiso(title,data){
    dialogForm.dialog("option","title",title);
    dialogForm.dialog("option","width",570);
    dialogForm.dialog("option","height",570);
       
    dialogForm.dialog("open");

    $.post(urlPermisoForm
           ,data 
           ,function (res, txtStatus, jqXHR){
                
                if(txtStatus=='success'){
                  contentDialogForm.html(res);
                  progressbar_dialogForm.hide();
                }else{
                  msgDialogForm.html("Error al recibir la informacion.").attr("class","msgWrong");
                  progressbar_dialogForm.hide(); 
                }
                 
          });//END $:POST
          
  }
  
function setParamArray(val){

      var index = jQuery.inArray(val, listModuloUser);
      
      if( index === -1 ){
          listModuloUser.push(val);
      }else{
          listModuloUser.splice( index, 1 );
      }//END IF

      oSettingsItem[0].aoPreSearchCols[6].sSearch = ""+listModuloUser.join()+"";
      item_oTable.draw();
      
}

function itemDelete(id,data){

       $.msgbox("Esta seguro de eliminar este registro?<br>Info<br><b>"+data+"</b>"
                 ,{type: "confirm"
                   ,buttons : [{type: "submit", value: "Si"},
                               {type: "cancel", value: "No"}]}
                 ,function(result){
                    if(result){
                      itemDeleteAction(id);
                    }
                 });
}

    function itemDeleteAction(id){
        boxyLoadingShow();
        randomnumber=Math.floor(Math.random()*11);
        
        $.get( urlDelete,
               {random:randomnumber, id:id}, 
               function(res){
                   if(res.res == 1){
                       item_oTable.draw();
                       boxyLoading.hide();
                   }else if(res.res == 2){
                     $.msgbox( 'ERROR: al eliminar, '+res.msg+'.'
                                  ,{type: "error"
                                    ,buttons : [{type: "submit", value: "Aceptar"}]
                                   }
                                  ,function(result) {
                                     boxyLoading.hide();
                                   }
                                 ); 

                   }else{                                                            
                       $.msgbox( 'ERROR: '+res.msg+'. Notifique al Adminsitrador.'
                                  ,{type: "error"
                                    ,buttons : [{type: "submit", value: "Aceptar"}]
                                   }
                                  ,function(result) {
                                     dialogForm.dialog("close");
                                     boxyLoading.hide();
                                   } 
                                 ); 
                   }//END IF
		       },"json");
    }
    
</script>{/literal}