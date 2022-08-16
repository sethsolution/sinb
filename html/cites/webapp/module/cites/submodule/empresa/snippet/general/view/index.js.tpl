{literal}
<script>
    var snippet_general_form = function() {
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

                if(responseText.accion =='update') {
                    swal({type: 'success',title: 'Los datos se han guardado correctamente!',showConfirmButton: false,timer: 2000});
                    $('#m_form_1_msg').addClass('m--hide'); //ocultamos el mensaje de campos faltantes si se guarda corectamente

                }else{
                    location = "{/literal}{$path_url}{literal}/"+responseText.id;
                }
            }else{
                msg_error = '<strong>Ocurrio error al guardar</strong><br>'+responseText.msg;
                if (responseText.msgdb !== undefined){
                    msg_error += '<br><br><div class="m-alert m-alert--outline alert alert-danger alert-dismissible fade show" role="alert">';
                    msg_error += '<strong>Dato Técnico: </strong>'+responseText.msgdb+'</div>';
                }
                swal({position: 'top-center'
                    ,html: msg_error
                    ,type: 'error'
                    ,title: 'No se puede eliminar'});
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
                        "item[tipo_documento_id]": {
                            required: {param:true,}
                        }
                    },
                    messages: {
                        "item[tipo_documento_id]": "Seleccione el tipo de Permiso "
                    },
                    //display error alert on form submit
                    invalidHandler: function(event, validator) {
                        var alert = $('#m_form_1_msg');
                        alert.removeClass('m--hide').show();
                        mUtil.scrollTop();
                    },
                });

                if (!form.valid()) {
                    return;
                }

                $( "#m_form_1" ).validate({
                    // define validation rules
                    rules: {
                        email: {
                            required: true,
                            email: true,
                            minlength: 10
                        },
                        url: {
                            required: true
                        },
                        digits: {
                            required: true,
                            digits: true
                        },
                        creditcard: {
                            required: true,
                            creditcard: true
                        },
                        phone: {
                            required: true,
                            phoneUS: true
                        },
                        option: {
                            required: true
                        },
                        options: {
                            required: true,
                            minlength: 2,
                            maxlength: 4
                        },
                        memo: {
                            required: true,
                            minlength: 10,
                            maxlength: 100
                        },

                        checkbox: {
                            required: true
                        },
                        checkboxes: {
                            required: true,
                            minlength: 1,
                            maxlength: 2
                        },
                        radio: {
                            required: true
                        }
                    },

                    //display error alert on form submit
                    invalidHandler: function(event, validator) {
                        var alert = $('#m_form_1_msg');
                        alert.removeClass('m--hide').show();
                        mUtil.scrollTop();
                    },

                    submitHandler: function (form) {
                        //form[0].submit(); // submit the form
                    }
                });
                $('#descripcion_input').val($('#descripcion').summernote('code'));
                general_form.submit();
            });
        };

        var handle_general_components = function(){

            $('.fecha_general').datepicker({
                todayHighlight: true,
                orientation: "bottom left",
                format: 'dd/mm/yyyy',
                templates: {
                    leftArrow: '<i class="la la-angle-left"></i>',
                    rightArrow: '<i class="la la-angle-right"></i>'
                }
            }).inputmask("dd/mm/yyyy");

            $('.select2_general').select2({
                placeholder: "Seleccione una opción"
                , width: '100%'
            });

            $('.summernote').summernote({
                height: 150
            });
            $('.numero_entero').number( true, 0 ,'','');

            $(".mayus").on("keypress", function () {
               $input=$(this);
               setTimeout(function () {
                $input.val($input.val().toUpperCase());
               },50);
            });
        };
        //== Public Functions

        var handle_categoria_select = function(){

            $('#ocasional_activo').on('change',function(){
                var id = $(this).val();
                id = id==null? '': id.toString();

                var ocasional_div = $('#ocasional_div');
                ocasional_div.addClass('m--hide');

                switch (id){
                    case '2':
                        ocasional_div.removeClass('m--hide');
                        break;
                }

            });
            $('#institucion_activo').on('change',function(){
                var id = $(this).val();
                id = id==null? '': id.toString();

                var institucion_div = $('#institucion_div');
                institucion_div.addClass('m--hide');

                switch (id){
                    case '5':
                        institucion_div.removeClass('m--hide');
                        break;
                }

            });
        };
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