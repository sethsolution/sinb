{literal}

<script type="text/javascript" src="js/md5.js"></script>
<script>
    var snippet_general_form = function() {
        var idficha = '{/literal}{$item.itemId}{literal}';
        var type = '{/literal}{$type}{literal}';
        var general_form = $('#general_form');
        var general_btn_submit = $('#general_submit');
        var password="";
        //== Private Functions
        var showRequest= function(formData, jqForm, op) {
            general_btn_submit.addClass('m-loader m-loader--right m-loader--light').attr('disabled', true);
            return true;
        };
        var showResponse = function (responseText, statusText) {
            console.log(responseText);
            if(responseText.res ==1){
                var input = document.getElementById('input_archivo');
                    var file = input.files[0];
                    if(file==undefined){
            		general_btn_submit.removeClass('m-loader m-loader--right m-loader--light').attr('disabled', false);
                         if(responseText.accion =='update') {
                   // swal("Buen Trabajo!", "Se guardo todo con exito!", "success")
                            swal({type: 'success',title: 'Buen Trabajo! Se guardo todo con exito!',showConfirmButton: false,timer: 1000});
                            //console.log("Actualizó : "+responseText.id);
                        }else{
                            location = "{/literal}{$getModule}{literal}&accion=itemUpdate&id="+responseText.idUser+"&type=update";
                        }
                    }
                    else{
                        var data = new FormData();
                        data.append('archivo', file);
						console.log(file);
                        if(file.size>500000){
            				general_btn_submit.removeClass('m-loader m-loader--right m-loader--light').attr('disabled', false);
                            swal("Tamaño de archivo muy grande", "El tamaño no debe superar los 500kb.", "error");
							
							}
						
						else{
						data.append('id',responseText.idUser);
                        jQuery.ajax({
                            url: 'https://konga.mmaya.gob.bo:8443/stl/profile/',
                            data: data,
                            cache: false,
                            contentType: false,
                            beforeSend: function(request) {
                                request.setRequestHeader("Authorization", "Bearer eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCIsImlzcyI6IjV5Y1M2NUZIcXU2NTFmQnYzSXNCOXVxM042bEZhY1djIn0.eyJpZCI6IjAwMiIsIm5vbWJyZSI6IkFsdmluIFBvbWEiLCJkZXRhbGxlIjoiT1RDQSIsImZlY2hhIjoiMTQvMDUvMjAyMSJ9.U7k9aRnUzj7P1fdkDoxSfz75My5SG9ll99txo2ARjac");
                                request.setRequestHeader("AuthorizationApp","eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJ1c2VyIjp7ImlkIjoxLCJyb2wiOjEsImlkQ2F6YWRvciI6MX0sImlhdCI6MTYyMjU4NTAwMn0.67OhEtfplZR1d7oNIyuKJtMIe_urg1THCLmQFmz5vqc")
                            },
                            processData: false,
                            type: 'POST',
                            success: function(data){
                                 if(responseText.accion =='update') {
            				general_btn_submit.removeClass('m-loader m-loader--right m-loader--light').attr('disabled', false);
                                    // swal("Buen Trabajo!", "Se guardo todo con exito!", "success")
                                        swal({type: 'success',title: 'Buen Trabajo! Se guardo todo con exito!',showConfirmButton: false,timer: 1000});
                                        //console.log("Actualizó : "+responseText.id);
                                    }else{
                                        location = "{/literal}{$getModule}{literal}&accion=itemUpdate&id="+responseText.idUser+"&type=update";
                                    }
                                },
                            error: function(err){
            				general_btn_submit.removeClass('m-loader m-loader--right m-loader--light').attr('disabled', false);
							if(err.responseJSON.code=="LIMIT_FILE_SIZE")
                            swal("Tamaño de archivo muy grande", responseText.msg, "error")
							else
                            swal("!Ocurrió un error con la subidad del archivo!", responseText.msg, "error")

                            }
                        });}
                    }
               
            }else if(responseText.res ==2){
            general_btn_submit.removeClass('m-loader m-loader--right m-loader--light').attr('disabled', false);
                swal("!Ocurrió un error!", responseText.msg, "error")
            }else{
            				general_btn_submit.removeClass('m-loader m-loader--right m-loader--light').attr('disabled', false);
                swal("!Ocurrió un error!", responseText.msg, "error")
            }
        };
        var options = {
            beforeSubmit:showRequest
            , dataType: 'json'
            , success:  showResponse
            , data: {
                accion:'{/literal}{$subcontrol}_itemupdatesql{literal}'
                ,itemId:idficha
                ,type:type
                ,pass:password,
                idUser:'{/literal}{$id}{literal}'


            }
        };
        var handle_form_submit=function(){

            general_form.ajaxForm(options);
        };
        var item_download=function(data){
         swal({
              title: "Espere por favor...",
            type: 'info',
              showConfirmButton: false,
              allowOutsideClick: false
            });
                var req = new XMLHttpRequest();
                req.open("GET", 'https://konga.mmaya.gob.bo:8443/stl/files/usuario/'+data, true);
                req.setRequestHeader("Authorization", "Bearer eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCIsImlzcyI6IjV5Y1M2NUZIcXU2NTFmQnYzSXNCOXVxM042bEZhY1djIn0.eyJpZCI6IjAwMiIsIm5vbWJyZSI6IkFsdmluIFBvbWEiLCJkZXRhbGxlIjoiT1RDQSIsImZlY2hhIjoiMTQvMDUvMjAyMSJ9.U7k9aRnUzj7P1fdkDoxSfz75My5SG9ll99txo2ARjac");
                req.setRequestHeader("AuthorizationApp","eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJ1c2VyIjp7ImlkIjoxLCJyb2wiOjEsImlkQ2F6YWRvciI6MX0sImlhdCI6MTYyMjU4NTAwMn0.67OhEtfplZR1d7oNIyuKJtMIe_urg1THCLmQFmz5vqc")
                                
                req.responseType = "blob";
                req.onload = function (event) {
                    if(req.status==200){
                        var blob = req.response;
                    var fileName = "cuenta-"+data+".pdf";//if you have the fileName header available
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
        var handle_general_form_submit = function() {
            $('#descargar_archivo').click(function(){
                var nombre=String("{/literal}{$item.path_doc_ver}{literal}").split(".");
                item_download(nombre[0]);
                return false;
            })
            $('#input_archivo').on('change', function() {
                let fileName = $(this).val().split('\\').pop();
                $(this).next('.custom-file-label').addClass("archivo").html(fileName);
            });
            general_btn_submit.click(function(e) {
                password=hex_md5($("#password").val());
                options={
                beforeSubmit:showRequest,
    		dataType: 'json'
                , success:  showResponse
                , error: function (e){
                    console.log(e);
                }
                , data: {
                    accion:'{/literal}{$subcontrol}_itemupdatesql{literal}'
                    ,itemId:idficha
                    ,type:type
                    ,pass:password
                    ,idUser:'{/literal}{$id}{literal}'

                }};    
                e.preventDefault();
                var btn = $(this);
                var form = $(this).closest('form');
                handle_form_submit();
                if (!form.valid()) {
                    return;
                }
                general_form.submit();
            });
        };

        var handle_general_components = function(){

            $('.select2_general').select2({
                placeholder: "Seleccione una opción"
            });

        };
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
        var rol_municipio_change=function(){
            
            var tipo='{/literal}{$type}{literal}';
            if(tipo==="new"){
                $("#rol_itemId , #municipio_itemId, #departamento, #provincia").change(function(){
                    
                var verRol= '{/literal}{$item.rol_itemId}{literal}';
                var rolId = $("#rol_itemId option:selected").val();
                if(verRol==="2"||rolId==="2"||verRol==="3"||rolId==="3"||verRol==="4"||rolId==="4"||verRol==="5"||rolId==="5"){
                redirectPost('{/literal}{$getModule}{literal}&accion=itemUpdate&id=1&type='+tipo,{
                    data:JSON.stringify(
                        {
                        usuario:$('#usuario').val(),
                        password:$('#password').val(),
                        nombre:$('#nombre').val(),
                        apellido:$('#apellido').val(),
                        email:$('#email').val(),
                        ci:$('#ci').val(),
                        ci_exp_itemId:$( "#ci_exp_itemId" ).val(),
                        rol_itemId:$( "#rol_itemId" ).val(),
                        tco_itemId:$( "#tco_itemId" ).val(),
                        municipio_itemId:$( "#municipio_itemId" ).val(),
                        provincia:$( "#provincia" ).val(),
                        departamento:$( "#departamento" ).val(),
                        curtiembre_itemId:$( "#curtiembre_itemId" ).val(),
                        empresa_itemId:$( "#curtiembre_itemId" ).val(),
                        telefono:$( "#telefono" ).val()
                    }
                    )
                    });  
                }
                });
            }
        }


        //== Public Functions
        return {
            // public functions
            init: function() {
                handle_general_form_submit();
                handle_form_submit();
                handle_general_components();
                rol_municipio_change();
            }
        };
    }();

    //== Class Initialization
    jQuery(document).ready(function() {
        
        snippet_general_form.init();
    });

</script>
{/literal}