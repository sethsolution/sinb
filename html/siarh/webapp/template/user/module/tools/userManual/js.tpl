{literal}
  <script>
    var condAbleButon = 0;  
   
    function addNewAnnexe(id,type){
        var w = 550;
        var h = 180;
        var scroll = 0;
        var url = '{/literal}{$getModule}&accion=itemAddAnnexe&id='+id+'{literal}&type='+type+'{/literal}&idSystem={$idSystem}{literal}';
       
        var f = iframeBox(url,w,h);
        
        html = "<div id=\"formContent\" style=\"width:"+w+"px;height:"+h+"px;\">"+f+"</div>";
        
        if(type=='new'){
            titlebox='Nuevo Anexo';
        }else{
            titlebox='Editar Anexo';
        }

    	boxyWindows = new Boxy(html,{  title:titlebox, modal: true,fixed:true,
    					               draggable:true, show:false, afterShow: function() {},
                                       closeable:false,unloadOnHide:true});
    	boxyWindows.show();    
    }
    
     function annexeDelete(id,name){
       Sexy.confirm("Está seguro de eliminar el anexo?<br>Info: <br><b>"+name+"</b>", 
                    {textBoxBtnOk: 'Si', textBoxBtnCancel: 'No',
	                 onComplete:function(returnvalue) {
		                          if(returnvalue){
		                              boxyLoadingShow();
                                      annexeDeleteAction(id);
                                  }
	                            }
	                }); 
    }
    
    function annexeDeleteAction(id,idsystem){
	   randomnumber=Math.floor(Math.random()*11);
	   $.get("{/literal}{$getModule}{literal}",{accion:"deleteAnnexe",
						random:randomnumber,
						id:id,
                        idsystem:idsystem
						}, function(data){
                            urlvar = "{/literal}{$getModuleOnly}{literal}&smodule=userManual&accion=itemUpdate&id={/literal}{$idSystem}{literal}&type=update";
                            urlvar += "&optab=7";
                            location = urlvar;						
		});
    }
  
    function ableSave(){
        if(condAbleButon == 0){
            condAbleButon = 1;
            $('#btnDiagnosis').removeAttr("disabled");
        }
    }  
    
    function saveDiagnosis(id){
     boxyLoadingShow();
     var url = '{/literal}{$getModule}{literal}&accion=updateDiagnosis';
        
        var diagnosis = $('#diagnosis').val();
        $.ajax({ type: "POST", url: url,
                 data: "diag="+diagnosis+"&id="+id,
                 success: function(msg){
                                $('#btnDiagnosis').attr("disabled", "disabled");
                                condAbleButon = 0;
                                boxyLoading.hide();
                          }
              });
  } 
  </script>
{/literal}  