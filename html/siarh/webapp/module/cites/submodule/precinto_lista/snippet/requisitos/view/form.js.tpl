{literal}
<script>
    var snippet_general_form = function() {


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
                    swal({type: 'success',title: 'Se guardo todo con exito!',showConfirmButton: false,timer: 2000});
                    $('#m_form_1_msg').addClass('m--hide');// quitamos el mensaje de obligatorios
                }else{
                    location = "{/literal}{$path_url}{literal}/"+responseText.id;
                }

                snippet_resumen.resumen();

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
                accion:'{/literal}{$subcontrol}_guardar.detalle{literal}'
                ,itemId:'{/literal}{$id}{literal}'
                ,type:'{/literal}{$type}{literal}'
                ,item_id: '{/literal}{$id}{literal}'
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
                    invalidHandler: function(event, validator) {
                        var alert = $('#m_form_1_msg');
                        alert.removeClass('m--hide').show();
                        //mUtil.scrollTop();
                        mUtil.scrollTo("general_form",-100);
                    },
                });

                if (!form.valid()) {
                    return;
                }
                $('#observacion_input_detalle').val($('#observacion_detalle').summernote('code'));
                general_form.submit();
            });
        };

        var handle_general_components = function(){

            $('.fecha_general').datepicker({
                todayHighlight: true,
                orientation: "bottom left",
                format: 'dd/mm/yyyy',
                autoclose: true,
                templates: {
                    leftArrow: '<i class="la la-angle-left"></i>',
                    rightArrow: '<i class="la la-angle-right"></i>'
                }
            }).inputmask("dd/mm/yyyy");

            $('.select2_general').select2({
                placeholder: "Seleccione una opción"
            });

            $('.summernote_detalle').summernote({
                height: 150, width: '100%'
                ,followingToolbar: false
                , dialogsInBody: true,
                toolbar: [
                    ['style', ['bold', 'italic', 'underline', 'clear']],
                    ['font', ['strikethrough', 'superscript', 'subscript']],
                    ['fontsize', ['fontsize']],
                    ['color', ['color']],
                    ['para', ['ul', 'ol', 'paragraph']],
                    ['height', ['height']]
                ]
            });

            $('.numero_entero').number( true, 0 ,'','');
            $('.numero_decimal').number( true, 2 ,'.',',');

            $(".mayus").on("keypress", function () {
                $input=$(this);
                setTimeout(function () {
                    $input.val($input.val().toUpperCase());
                },50);
            });
        };

        var handle_categoria_select_activo = function(){
            $('#requisitos_observado').on('click',function(){

                var nombre1_div = $('#observacion');
                if ($(this).is(':checked')) {
                    nombre1_div.removeClass('m--hide');
                }else{
                    nombre1_div.addClass('m--hide');
                }
            });

        };

        //== Public Functions
        return {
            // public functions
            init: function() {
                handle_categoria_select_activo();
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