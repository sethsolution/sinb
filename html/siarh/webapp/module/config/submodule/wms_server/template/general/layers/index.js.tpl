{literal}
  <style>
  .ui-progressbar {
    position: relative;
    margin-top:50px;
  }
  .progress-label {
    position: absolute;
    left: 50%;
    top: 4px;
    font-weight: bold;
    text-shadow: 1px 1px 0 #fff;
    color:#ffffff;
  }
  </style>
  
<script type="text/javascript" src="js/lightbox/js/jquery.lightbox-0.5.min.js"></script>
<link rel="stylesheet" href="js/lightbox/css/jquery.lightbox-0.5.css" type="text/css" />

<script>
    var oTableRPhoto;
    var dialogPhoto;
    var progressbar_photo;
    var idItem;
    var accion;
  
  $(document).ready(function (){
    $("#btn_addPhoto").bind("click", function (){
        itemUpdate('','new'); 
      });
    
      //
      progressbar_photo = $( "#dialog_addPhoto #photo_progressbar" ).progressbar({value: false});
    
      //
      var urlForm = '{/literal}{$getModule}{literal}&accion=general_getLayer&idFicha='+idficha;
      dialogPhoto = $("#dialog_addPhoto").dialog({modal:true, autoOpen: false,
                                                    width:550, height:500,
                                                    resizable: false,
                                                    dialogClass: "snirModalDialog",
                                                    open: function (event){
                                                        $(".ui-dialog-titlebar-close").hide();
                                                        $.post(urlForm,{type:accion,id:idItem},
                                                               function (response,status,xhr){
                                                                   $(".ui-dialog-titlebar-close").show();
                                                                   if(status == "error") {
                                                                     var msg = "Sorry but there was an error: "+xhr.status+" "+xhr.statusText;
                                                                     $("#msg_dialogPhoto").html('<b>'+msg+'</b>');       
                                                                   }else if(status == 'success'){
                                                                     $("#dialog_addPhoto #content_dialogPhoto").html(response);
                                                                   }
                                                                    progressbar_photo.hide();
                                                                  });
                                                               
                                                      },
                                                      close: function (event){
                                                           progressbar_photo.show();
                                                           $("#content_dialogPhoto").html("");
                                                           $("#msg_dialogPhoto").html('');
                                                      }
                                                });
      
    var url = '{/literal}{$getModule}&id={$id}{literal}&accion=general_getListLayer';
    oTableRPhoto = $('#snir_tablePhoto').dataTable({
                        "aoColumns": [ {"aTargets": [0], "bSearchable": false, "bSortable": false, "sWidth":"35px"},//#
                                       {"aTargets": [1], "bSortable": false,  "sWidth":"150px"},//tipo
                                       {"aTargets": [2], "bSortable": false, "bSearchable": false, "sWidth":"100px"},//foto 
                                       {"aTargets": [3], "bSortable": false, "bSearchable": false,},//nombre
                                       {"aTargets": [4], "bSortable": false, "bSearchable": false, "sWidth":"50"},//activo
                                       {"aTargets": [5], "bSortable": false, "bSearchable": false, "sWidth":"50"},//orden
                                       {"aTargets": [6], "bSortable": false, "bSearchable": false, "sWidth":"60"},//accion
                                       {"aTargets": [7], "bSortable": false, "bSearchable": false, "sWidth":"50"},//activo
                                       {"aTargets": [8], "bSortable": false, "bSearchable": false, "sWidth":"50"},//orden
                                       {"aTargets": [9], "bSortable": false, "bSearchable": false, "sWidth":"60"},//accion
                                       {"aTargets": [10], "bSortable": false, "bSearchable": false, "sWidth":"60"}//accion
                                       ,],
                
                "bJQueryUI": true,
                "sPaginationType": "full_numbers",
                
                "fnInitComplete": function(oSettings, json) { },
                "fnStateLoaded": function (oSettings, oData){},
                "fnDrawCallback": function( oSettings ) {},//END FUNCTION
                "iDisplayLength": 10,
                "aLengthMenu": [[10, 20, 50, -1], [10, 20, 50, "All"]],
                "oLanguage": { "sUrl": "js/DataTables/es_ES.txt?id=3273"},
                "bProcessing": true,
                "bServerSide": true,
                "sScrollX": "100%",
      		    "sScrollXInner": "100%",
                "bScrollCollapse": true,
                "sAjaxSource": url
                }); 
     
     $('#tablePhoto tbody td img.iconDetail').live( 'click', function () {
        var nTr = this.parentNode.parentNode;
        if ( this.src.match('details_close') ){/* This row is already open - close it */
            this.src = "./template/user/images/icon/details_open.png";
            oTableRPhoto.fnClose( nTr );
        }else{/* Open this row */
            this.src = "./template/user/images/icon/details_close.png";
            oTableRPhoto.fnOpen( nTr, fnFormatDetails(nTr), 'details' );
        }//END IF
    }); 
    
    /* Formating function for row details */
    function fnFormatDetails ( nTr ){
        var aData = oTableRPhoto.fnGetData( nTr );
        
        var sOut = '<table cellpadding="6" cellspacing="0" border="0" style="padding-left:50px;">';
        sOut += '<tr><td><b>Descripci&oacute;n: </b></td><td>'+aData[6]+'</td></tr>';
        sOut += '</table>';
         
        return sOut;
    }
                                        
  });
  
  function itemUpdate(id,type){
    idItem = id;
    accion = type;
    dialogPhoto.dialog("open");  
  }

  function itemActive(id,status){
	boxyLoadingShow();
	randomnumber=Math.floor(Math.random()*11);
	$.get( "{/literal}{$getModule}{literal}",
           {accion:"general_itemStatus", random:randomnumber,itemId:id, status:status,},
            
           function(data){ 
             if(data.response == 1){
               oTableRPhoto.fnDraw();
               boxyLoading.hide();
             }else{
               $.msgbox( 'ERROR: '+data.msg+'. <br />Vuelva a intentarlo mas tarde'
                 , {type: "error"}
                 , function(result){
                     boxyLoading.hide();       
                   }); 
             } 
           },"json");
    
  }
  
  function photoSetOrder(idActual,type){  
    randomnumber=Math.floor(Math.random()*11);
    boxyLoadingShow();
	$.get( "{/literal}{$getModule}&id={$id}{literal}",
           { accion:"general_setOrder",random:randomnumber,itemId:idActual,tipo:type}, 
           function(data){
               if(data.response == 1){
                 oTableRPhoto.fnDraw();
                 boxyLoading.hide();
               }else{
                 $.msgbox( 'ERROR: '+data.mssg+'. <br />Vuelva a intentarlo mas tarde'
                 , {type: "error"}
                 , function(result){
                     boxyLoading.hide();       
                   });
                    
               } 
               							
		   },
           "json");
  }
  
  function itemDelete(id,name){

    $.msgbox("¿Esta seguro de que desea eliminar el registro?<br>Info<br><b>"+name+"</b>"
                 ,{type: "confirm"
                   ,buttons : [{type: "submit", value: "Si"},
                               {type: "cancel", value: "No"}]}
                 ,function(result){
                    if(result){
                      boxyLoadingShow();
                      photoDeleteAction(id);
                    }
                 });
  }
  
  function photoDeleteAction(itemId){
    randomnumber=Math.floor(Math.random()*11);
         
    $.get( "{/literal}{$getModule}&id={$id}{literal}",
           {accion:"general_deleteLayer", random:randomnumber, itemId:itemId},
           function(data){ 
 			 if(data.response == 1){
 			    boxyLoading.hide();
 			    oTableRPhoto.fnDraw();
                
 			 }else{
 			    $.msgbox( 'ERROR: '+data.mssg+'. <br />Vuelva a intentarlo mas tarde'
                 , {type: "error"}
                 , function(result){
                     boxyLoading.hide();       
                   }); 
 			 }
             
           },"json");
    }
    
</script>{/literal}