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
                    {"searchable": false, "targets": [0,1] }
                ,   {"width": "25px", "targets": [0,1]}
                //,   {"width": "35px", "targets": [3,4,5]} 
               // ,   {"visible": false, "targets":[8,9,6,7]}
                ,   {"className": "txtCenter", "targets": [ 1 ] }  
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
        ,    "bFilter": false
        ,   "drawCallback": function ( settings ) {
               
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
        addPermiso('Adicion de asignaciones',{tipo:'new'});
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
    dialogView.dialog("option","title",title);
    dialogView.dialog("option","width",570);
    dialogView.dialog("option","height",570);
       
    dialogView.dialog("open");

    $.post(urlPermisoForm
           ,data 
           ,function (res, txtStatus, jqXHR){
                
                if(txtStatus=='success'){
                  contentDialogView.html(res);
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

       $.msgbox("Esta seguro de eliminar este registro?<br><br><b></b>"
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