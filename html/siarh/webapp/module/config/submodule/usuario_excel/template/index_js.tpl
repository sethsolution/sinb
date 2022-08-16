{literal}
<link rel="stylesheet" href="js/chosen/chosen.min.css" />
<script type="text/javascript" src="js/chosen/chosen.jquery.min.js"></script>
  <style>
  .ui-progressbar {
    position: relative;
  }
  .progress-label {
    position: absolute;
    left: 50%;
    top: 4px;
    font-weight: bold;
    text-shadow: 1px 1px 0 #d1d1d1;
    color: #fff;
  }
</style>

<script>
var urlSelected = '';
    
    $(document).ready(function (){
        
        $(".chosen-select").chosen({width: "600px"
                           ,no_results_text: "No se encontraron resultados!"});
                           
       
       $("#btn_excel").bind("click", function (){
        urlSelected = '';    
        $('#itemForm_excel input[type=checkbox]').each(function(){
            if (!this.checked) {
                urlSelected += $(this).val()+' ';
            }
      
        }); 
        
         $("#itemForm_excel").submit();
       });//click
       
    });//END READY
    
    
    function getExcel(){
    	    $("#msg").html('Descargando ................');
            
            url = "{/literal}{$getModule}{literal}&accion=getExcel";
            url += "&item[institucionId]="+$("#institucionId").val();
            url += "&item[tipo]="+$("#tipoUsuario").val();
            url += "&item[grupoId]="+$("#grupoId").val();
            url += "&item[activo]="+$("#activo").val();
            url += "&item[listCheckbox]="+urlSelected;
            
            window.open(url,'Descargando_Ficha');
            setTimeout(function() {
                $("#msg").html('');                
            }, 3500 );                
            return false;        
    }
    
</script>
{/literal}