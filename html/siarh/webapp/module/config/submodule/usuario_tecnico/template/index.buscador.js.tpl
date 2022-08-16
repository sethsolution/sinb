{literal}
<link rel="stylesheet" href="js/chosen/chosen.min.css" />
<script type="text/javascript" src="js/chosen/chosen.jquery.min.js"></script>

<script>
  $(document).ready(function (){
    //SELECT de Institucino
    selInstitucion = $("select#provinciaId");
    //SELECT de Tipo usuario
    selTipo = $("select#municipioId");
    
    $(".itemFilter").chosen({width: "145px"
                        ,no_results_text: "No se encontraron resultados!"}).change(function(evt, params){
                            
                                                        valSel = $(this).chosen().val();
                                                        relSel = $(this).chosen().attr("rel");
                                                        
                                                        setFilterTable(relSel,valSel);
                        });
                                                         
  });
 
 
</script>{/literal}