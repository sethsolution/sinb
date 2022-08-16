{literal}
<script>
var urlReporte = '{/literal}{$getModule}{literal}';
$(document).ready(function (){
    $(".chosen-select").chosen({width: "130px"
                       ,no_results_text: "No se encontraron resultados!"});    
    $("#btn_generar").bind("click", function (){
       generarReporte(); 
   s });     
});
  
function generarReporte(){
      $("#btn_print").show();
      institucionId = $("#institucionId").val();
      tipo = $("#tipoUsuario").val();
      grupoId = $("#grupoId").val();
      activo = $("#activo").val();

      accion = "general_view";
      $.post(urlReporte
             ,{accion:accion, idins:institucionId,tipo:tipo , idgru:grupoId ,activo:activo }
             ,function (res, textStatus, jqXHR){
                
                //$("#summaryItem #contentTable").html(res.viewTabla);
                $("#contentGrafica").html(res.viewGrafica);  
               // boxyLoading.hide();  
                    
              }
             ,'json');
 }
</script>
{/literal}