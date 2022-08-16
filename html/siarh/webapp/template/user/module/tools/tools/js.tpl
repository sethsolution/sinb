
{literal}<script>
    $(document).ready(function (){
                            $("#convertTabs").tabs();
                      });//END READY
                      
    function convert(type){
        $("#resutm").hide();
        $("#resdms").hide();
        randomnumber=Math.floor(Math.random()*11);        
        if(verifica(type)){
            boxyLoadingShow();
            if(type ==1){
              latgrade = $.trim($("#latGrade").val());
              latminute = $.trim($("#latMinute").val());
              latsecond = $.trim($("#latSeconds").val());
              longgrade = $.trim($("#longGrade").val());
              longminute = $.trim($("#longMinute").val());
              longsecond = $.trim($("#longSeconds").val());
              
              $.get( "{/literal}{$getModule}{literal}",
                      { accion:"getUTM", random:randomnumber,
                        latgrade:latgrade, latminute:latminute, latsecond:latsecond,
                        longgrade:longgrade, longminute:longminute, longsecond:longsecond}, 
                       function(data){  $("#utmnorth").html(data.utmNorthing);
                                        $("#utmeast").html(data.utmEasting);
                                        $("#utmzone").html(data.utmZone);
                                        $("#resutm").show();
                                        boxyLoading.hide();
		                              },
                      "json");
                                          
            }else if(type == 2){
              north = $.trim($("#north").val());
              east = $.trim($("#east").val());
              zone = $.trim($("#zone").val());
              
              $.get( "{/literal}{$getModule}{literal}",
                      { accion:"getDMS", random:randomnumber,
                        north:north, east:east, zone:zone}, 
                       function(data){  $("#longitude").html(data.longitude);
                                        $("#latitude").html(data.latitude);
                                        $("#resdms").show();
                                        boxyLoading.hide();
		                              },
                       "json");
            }
        }
        return false;    
    }
    
    function verifica(type){
      if(type == 1){  
        if($.trim($("#latGrade").val()) == ""){
            Sexy.alert('Ingrese grados de latitud');
		    return false;
        }else if($.trim($("#latMinute").val()) == ""){
            Sexy.alert('Ingrese minutos de latitud');
		    return false;
        }else if($.trim($("#latSeconds").val()) == ""){
            Sexy.alert('Ingrese segundos de latitud');
		    return false;
        }else if($.trim($("#longGrade").val()) == ""){
            Sexy.alert('Ingrese grados de longitud');
		    return false;
        }else if($.trim($("#longMinute").val()) == ""){
            Sexy.alert('Ingrese minutos de longitud');
		    return false;
        }else if($.trim($("#longSeconds").val()) == ""){
            Sexy.alert('Ingrese segundos de longitud');
		    return false;
        }else{
            return true;
        }
      }else if(type == 2){
        
        if($.trim($("#north").val()) == ""){
            Sexy.alert('Ingrese referencia norte de UTM');
		    return false;
        }else if($.trim($("#east").val()) == ""){
            Sexy.alert('Ingrese referencia este de UTM');
		    return false;
        }else if($.trim($("#zone").val()) == ""){
            Sexy.alert('Ingrese referencia zona de UTM');
		    return false;
        }else{
            return true;
        }
        
      }//END IF  
    }//END FUNCTION
    
</script>{/literal}