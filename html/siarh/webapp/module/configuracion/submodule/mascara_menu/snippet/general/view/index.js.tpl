{literal}
<script>
    var snippet_general_form = function() {
        var categoria_id;
        var idficha = '{/literal}{$id}{literal}';
        var type = '{/literal}{$type}{literal}';
        var general_form = $('#general_form');
        var general_btn_submit = $('#general_submit');
        //== Private Functions
        var showRequest= function(formData, jqForm, op) {
            general_btn_submit.addClass('m-loader m-loader--right m-loader--light').attr('disabled', true);
            return true;
        };
        var showResponse = function (responseText, statusText) {
            general_btn_submit.removeClass('m-loader m-loader--right m-loader--light').attr('disabled', false);
            if(responseText.res ==1){
                console.log("test: "+responseText.accion);
                if(responseText.accion =='update') {
                   // swal("Buen Trabajo!", "Se guardo todo con exito!", "success")
                    swal({type: 'success',title: 'Buen Trabajo! Se guardo todo con exito!',showConfirmButton: false,timer: 1000});
                    //console.log("Actualizó : "+responseText.id);
                }else{
                    location = "{/literal}{$getModule}{literal}&accion=itemUpdate&id="+responseText.id+"&type=update";
                    console.log("es nuevo : "+responseText.id);
                }
            }else if(responseText.res ==2){
                swal("Ocurrio un error!", responseText.msg, "error")
            }else{
                swal("ocurrio un error!", responseText.msg, "danger")
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

            }
        };
        var handle_form_submit=function(){
            general_form.ajaxForm(options);
        };

        var handle_general_form_submit = function() {

            general_btn_submit.click(function(e) {
                e.preventDefault();
                var btn = $(this);
                var form = $(this).closest('form');

                form.validate({

                    rules: {
                        "item[url]": {
                            required: {
                                param:true,
                                depends: function(element) {
                                    if (categoria_id=='URL'){
                                        return true;
                                    }else{
                                        return false;
                                    }
                                },
                            },
                        },
                    }
                });
                if (!form.valid()) {
                    return;
                }
                $('#descripcion_input').val($('#descripcion').summernote('code'));
                general_form.submit();
            });
        };

        var handle_general_components = function(){

            $('.select2_general').select2({
                placeholder: "Seleccione una Opcion"
            });
            $('#input_archivo').on('change', function() {
                let fileName = $(this).val().split('\\').pop();
                console.log(fileName);
                $(this).next('.custom-file-label').addClass("menu").html(fileName);
            });
            $('.numero_entero').number( true, 0 ,'','');

        };

        var handle_categoria_select = function(){

            $('#categoria_select').on('change',function(){
                id = $(this).val();

                var id = $(this).val();
                id = id==null? '': id.toString();

                //console.log(id);
                categoria_id = id;

                //form_btn_submit.removeClass('m-loader m-loader--right m-loader--light');
                //form_btn_submit.addClass('m-loader m-loader--right m-loader--light');

                var submodulo_div = $('#submodulo_div');
                var modulo_div = $('#modulo_div');
                var url_div = $('#url_div');

                url_div.addClass('m--hide');
                modulo_div.addClass('m--hide');
                submodulo_div.addClass('m--hide');

                switch (id){
                    case 'URL':
                        url_div.removeClass('m--hide');
                        break;
                    case 'INDEX':
                        modulo_div.removeClass('m--hide');
                        break;
                    case 'SB':
                        submodulo_div.removeClass('m--hide');
                        break;
                }

                /*
                if(id==null){
                    id = '';
                }else{
                    id = id.toString();
                }
                */


            });
        };


        //== Public Functions
        return {
            // public functions
            init: function() {
                handle_categoria_select();
                handle_general_form_submit();
                handle_form_submit();
                handle_general_components();
            }
        };
    }();

    //== Class Initialization
    jQuery(document).ready(function() {
        snippet_general_form.init();
    });

</script>
{/literal}