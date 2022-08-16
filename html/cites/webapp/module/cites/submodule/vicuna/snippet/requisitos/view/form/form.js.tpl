{literal}
<script>
    var snippet_form_modal = function() {

        var form_modal = $('#form_modal_interface_{/literal}{$subcontrol}{literal}');
        var form_btn_submit = $('#form_modal_submit_{/literal}{$subcontrol}{literal}');
        var form_btn_close = $('#form_modal_close_{/literal}{$subcontrol}{literal}');
        //== Private Functions
        var showRequest= function(formData, jqForm, op) {
            form_btn_submit.addClass('m-loader m-loader--right m-loader--light').attr('disabled', true);
            form_btn_close.attr('disabled', true);
            return true;
        };
        var showResponse = function (responseText, statusText) {

            if(responseText.res ==1){
                $("#form_modal_{/literal}{$subcontrol}{literal}").modal("hide");
                //table_list.draw();
                if(responseText.accion =='update') {
                    swal({type: 'success',title: 'Se guardo todo con exito!',
                        showConfirmButton: false,
                        timer: 1000
                        /*
                        ,
                        onClose: () => {
                            $('#requisitos_tab').trigger('click');
                        }
                        */

                    });
                }else{
                    swal({type: 'success',title: 'Se a creado el registro con exito!',
                        showConfirmButton: false,
                        timer: 1000
                        /*
                        ,
                        onClose: () => {
                            $('#requisitos_tab').trigger('click');
                        }

                         */

                    });
                }

                setTimeout(function() {
                    $('#requisitos_tab').trigger('click');
                }, 1500);

            }else{
                form_btn_close.attr('disabled', false);
                form_btn_submit.removeClass('m-loader m-loader--right m-loader--light').attr('disabled', false);

                msg_error = '<strong>Ocurrio error al guardar</strong><br>'+responseText.msg;
                if (responseText.msgdb !== undefined){
                    msg_error += '<br><br><div class="m-alert m-alert--outline alert alert-danger alert-dismissible fade show" role="alert">';
                    msg_error += '<strong>Dato Técnico: </strong>'+responseText.msgdb+'</div>';
                }
                swal({position: 'top-center'
                    ,html:msg_error
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
        var handle_form_modal_submit=function(){
            form_modal.ajaxForm(options);
        };

        var handle_form_modal_btn_submit = function() {

            form_btn_submit.click(function(e) {
                e.preventDefault();
                //var btn = $(this);
                var form = $(this).closest('form');

                if (!form.valid()) {
                    return;
                }

                form_modal.submit();
            });
        };

        var handle_form_modal_components = function(){
            $('.fecha_general').datepicker({
                todayHighlight: true,
                orientation: "bottom left",
                format: 'dd/mm/yyyy',
                templates: {
                    leftArrow: '<i class="la la-angle-left"></i>',
                    rightArrow: '<i class="la la-angle-right"></i>'
                }
            });

            $('.select2_general').select2({
                placeholder: "Seleccione una opción"
                , width: '100%'
            });
            
            $('#input_archivo').on('change', function() {
                let fileName = $(this).val().split('\\').pop();
                if(fileName!=""){
                    $("#archivo_nombre").addClass("archivo").html(fileName);
                }
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
                ,title: 'No existe'});

            setTimeout(function() {
                $("#form_modal_{/literal}{$subcontrol}{literal}").modal("hide");
            }, 1000);
        };

        return {
            init: function() {
                handle_form_modal_btn_submit();
                handle_form_modal_submit();
                handle_form_modal_components();

                {/literal}
                {if $item.itemId == "" and $type == "update"}
                {literal}
                msg_error();
                {/literal}
                {/if}
                {literal}
            }
        };
    }();
    jQuery(document).ready(function() {
        snippet_form_modal.init();
    });

</script>
{/literal}