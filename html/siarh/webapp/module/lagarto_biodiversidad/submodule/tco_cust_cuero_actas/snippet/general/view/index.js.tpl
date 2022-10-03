{literal}
<script>
    var snippet_general_form = function() {
        var idficha = '{/literal}{$id}{literal}';
        var type = '{/literal}{$type}{literal}';
        var general_btn_submit= $('#general_submit');

        var handle_general_components = function(){

            $('.select2_general').select2({
                placeholder: "Seleccione una opción"
            });

        };
        var gen_reporte=function(){
            general_btn_submit.click(function(){
                var tco=$("#tco").val();
                var gestion=$("#gestion").val();
                if(tco){
                $.ajax({
                    type: 'GET',
                    url: 'https://konga.mmaya.gob.bo:8443/stl/cust-cuero-tco/pdf/'+tco+'/'+gestion+'',
                    cache: false,
                    contentType: false,
                    processData: false,
                    beforeSend: function(request) {
                        request.setRequestHeader("Authorization", "Bearer eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCIsImlzcyI6IjV5Y1M2NUZIcXU2NTFmQnYzSXNCOXVxM042bEZhY1djIn0.eyJpZCI6IjAwMiIsIm5vbWJyZSI6IkFsdmluIFBvbWEiLCJkZXRhbGxlIjoiT1RDQSIsImZlY2hhIjoiMTQvMDUvMjAyMSJ9.U7k9aRnUzj7P1fdkDoxSfz75My5SG9ll99txo2ARjac");
                        request.setRequestHeader("AuthorizationApp","eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJ1c2VyIjp7ImlkIjoxLCJyb2wiOjEsImlkQ2F6YWRvciI6MX0sImlhdCI6MTYyMjU4NTAwMn0.67OhEtfplZR1d7oNIyuKJtMIe_urg1THCLmQFmz5vqc")
                    },
                }).done(function(data,res,sta) {
                    
                $("#tco").val(tco);
                $("#gestion").val(gestion);
                    if(sta.status==500){
                    swal({type: 'error',title: 'Error en el servidor.',showConfirmButton: false,timer: 1000});
                    }
                    else{
                        if(sta.status==204){
                    swal({type: 'error',title: 'No se encontraron registros para la TCO seleccionada.',showConfirmButton: false,timer: 1000});
                        }
                        else if(sta.status!=200)
                        {
                           swal({type: 'error',title: 'Error en el servidor.',showConfirmButton: false,timer: 1000});
                      
                        }
                        else{
                        function s2ab(s) {
                            var buf = new ArrayBuffer(s.length);
                            var view = new Uint8Array(buf);
                            for (var i=0; i!=s.length; ++i) view[i] = s.charCodeAt(i) & 0xFF;
                            return buf;
                        }

                        var blob = new Blob([s2ab(atob(data))], { type: 'application/vnd.openxmlformats' });
                            var link = document.createElement('a');
                            link.href = window.URL.createObjectURL(blob);
                            link.download = "tco_custodia_cuero_tco_"+tco+".xlsx";

                            document.body.appendChild(link);

                            link.click();

                            document.body.removeChild(link);
                            
                        }
                    }
                });
                }
            });
        }
        var redirectPost= function(location, args)
            {
                var form = $('<form></form>');
                form.attr("method", "post");
                form.attr("action", location);

                $.each( args, function( key, value ) {
                    var field = $('<input></input>');

                    field.attr("type", "hidden");
                    field.attr("name", key);
                    field.attr("value", value);

                    form.append(field);
                });
                $(form).appendTo('body').submit();
        }
	var combo_change=function(){
            
            var tipo='{/literal}{$type}{literal}';
            if(tipo==="new"){
                $("#departamento").change(function(){
                redirectPost('{/literal}{$getModule}{literal}&accion=itemUpdate&id=1&type='+tipo+'&gestion={/literal}{$item.gestion_itemId}{literal}',{
                    data:JSON.stringify(
                        {
                        departamento:$('#departamento').val(),
                        provincia:null,
                        municipio:null,
                    }
                    )
                    });  
                });
                $("#provincia").change(function(){
                redirectPost('{/literal}{$getModule}{literal}&accion=itemUpdate&id=1&type='+tipo+'&gestion={/literal}{$item.gestion_itemId}{literal}',{
                    data:JSON.stringify(
                        {
                        departamento:$('#departamento').val(),
                        provincia:$('#provincia').val(),
                        municipio:null,
                    }
                    )
                    });  
                });
                $("#municipio").change(function(){
                redirectPost('{/literal}{$getModule}{literal}&accion=itemUpdate&id=1&type='+tipo+'&gestion={/literal}{$item.gestion_itemId}{literal}',{
                    data:JSON.stringify(
                        {
                        departamento:$('#departamento').val(),
                        provincia:$('#provincia').val(),
                        municipio:$('#municipio').val(),
                    }
                    )
                    });  
                });
            }
        }

        //== Public Functions
        return {
            // public functions
            init: function() {
                handle_general_components();
                gen_reporte();
                combo_change();
            }
        };
    }();

    //== Class Initialization
    jQuery(document).ready(function() {
        snippet_general_form.init();
    });

</script>
{/literal}