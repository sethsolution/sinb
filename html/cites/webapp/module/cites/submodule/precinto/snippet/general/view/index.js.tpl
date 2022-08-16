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
                    swal({type: 'success',title: 'Se guardo todo con exito!',showConfirmButton: false,timer: 1000});
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
            , data: {type:'{/literal}{$type}{literal}'}
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
                        //mUtil.scrollTop();
                        mUtil.scrollTo("general_form",-150);
                    },
                });


                if (!form.valid()) {
                    return;
                }

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

            $(".mayus").on("keypress", function () {
               $input=$(this);
               setTimeout(function () {
                $input.val($input.val().toUpperCase());
               },50);
            });
        };

        var msg_error = function(){
            msg_error = '<strong>Ocurrio un error al guardar</strong><br>El registro que quiere editar no existe.';
            swal({position: 'top-center'
                ,html: msg_error
                ,type: 'error'
                ,title: 'No se puede guardar'});

            setTimeout(function() {
                $("#form_modal_{/literal}{$subcontrol}{literal}").modal("hide");
            }, 500);
        };

        //== Public Functions
        return {
            // public functions
            init: function() {
                handle_general_form_submit();
                handle_form_submit();
                handle_general_components();
            }
            {/literal}
                {if $item.itemId == "" and $type == "update"}
            {literal}
                 msg_error();
            {/literal}
                {/if}
            {literal}
        };
    }();

    //== Class Initialization
    jQuery(document).ready(function() {
        snippet_general_form.init();
    });

</script>
{/literal}