{literal}
<script>
	var direccionAPI="https://konga.mmaya.gob.bo:8443/stl/";
    var snippet_general_form = function() {
        var idficha = '{/literal}{$id}{literal}';
        var type = '{/literal}{$type}{literal}';
        var general_btn_submit_carne = $('#general_submit_carne');
        var general_btn_submit_cuero = $('#general_submit_cuero');

        var handle_general_components = function(){

            $('.select2_general').select2({
                placeholder: "Seleccione una opción"
            });

        };
    var item_download= function(curt,gest,tipo){
         swal({
              title: "Espere por favor...",
            type: 'info',
              showConfirmButton: false,
              allowOutsideClick: false
            });
        var req = new XMLHttpRequest();
        req.open("GET", direccionAPI+'curt-actas/'+tipo+'/pdf/'+curt+'/'+gest, true);
        req.setRequestHeader("Authorization", "Bearer eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCIsImlzcyI6IjV5Y1M2NUZIcXU2NTFmQnYzSXNCOXVxM042bEZhY1djIn0.eyJpZCI6IjAwMiIsIm5vbWJyZSI6IkFsdmluIFBvbWEiLCJkZXRhbGxlIjoiT1RDQSIsImZlY2hhIjoiMTQvMDUvMjAyMSJ9.U7k9aRnUzj7P1fdkDoxSfz75My5SG9ll99txo2ARjac");
        req.setRequestHeader("AuthorizationApp","eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJ1c2VyIjp7ImlkIjoxLCJyb2wiOjEsImlkQ2F6YWRvciI6MX0sImlhdCI6MTYyMjU4NTAwMn0.67OhEtfplZR1d7oNIyuKJtMIe_urg1THCLmQFmz5vqc")
                          
        req.responseType = "blob";
        req.onload = function (event) {
            if(req.status==200){
                var blob = req.response;
            var fileName = tipo+"-"+curt+"-"+gest+".pdf";//if you have the fileName header available
            var link=document.createElement('a');
            link.href=window.URL.createObjectURL(blob);
            link.download=fileName;
            link.click();
            swal({
                      title: "Exito!",
                      showConfirmButton: false,
                      timer: 1000
                    });
            }
            else{
                console.log("error");
                swal({
                      title: "No se pudo descargar",
                      showConfirmButton: false,
                      timer: 1000
                    });
            }
        };

        req.send();
        
        req.onerror=function(event){
            console.log("dasdf");
                swal({
                      title: "No se pudo descargar el archivo.",
                      showConfirmButton: false,
                      timer: 1000
                    });
        }
    }
        var gen_reporte_carne=function(){
            general_btn_submit_carne.click(function(){
                var curt=$("#curtiembre").val();
                var gest=$("#gestion").val();
                if(gest&&curt){
                item_download(curt,gest,"carne");
                return false;}
                else{}
            });
        }
        var gen_reporte_cuero=function(){
            general_btn_submit_cuero.click(function(){
                var curt=$("#curtiembre").val();
                var gest=$("#gestion").val();
                if(gest&&curt){
                item_download(curt,gest,"cuero");
                return false;}
            });
        }

        //== Public Functions
        return {
            // public functions
            init: function() {
                handle_general_components();
                gen_reporte_carne();
                gen_reporte_cuero();
            }
        };
    }();

    //== Class Initialization
    jQuery(document).ready(function() {
        snippet_general_form.init();
    });

</script>
{/literal}