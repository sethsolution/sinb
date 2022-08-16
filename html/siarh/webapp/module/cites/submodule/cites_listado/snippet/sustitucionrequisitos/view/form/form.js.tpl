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
                    swal({type: 'success',title: 'Buen Trabajo! Se guardo todo con exito!',
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
                    swal({type: 'success',title: 'Buen Trabajo! Se a creado el registro con exito!',
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
                    $('#sustitucionrequisitos_tab').trigger('click');
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
            , data: {
                accion:'{/literal}{$subcontrol}_guardar{literal}'
                ,itemId:'{/literal}{$id}{literal}'
                ,type:'{/literal}{$type}{literal}'
                ,item_id: '{/literal}{$item_id}{literal}'
            }
        };
        var handle_form_modal_submit=function(){
            form_modal.ajaxForm(options);
        };

        var handle_form_modal_btn_submit = function() {

            form_btn_submit.click(function(e) {
                e.preventDefault();

                swal({
                    title: '¿Esta seguro de cambiar de estado este requisito?',
                    text: "Se cambiará el estado de este requisito, una vez aceptado, NO podrá ser modificado ",
                    type: 'warning',
                    showCancelButton: true,
                    confirmButtonText: 'Si, Cambiar!',
                    cancelButtonText: "No, cancelar"
                }).then(function(result) {
                    if (result.value) {
                        //var form = $(this).closest('form');
                        var form = $("#form_modal_interface_{/literal}{$subcontrol}{literal}");
                        if (!form.valid()) {
                            return;
                        }
                        $('#observacion_input').val($('#observacion').summernote('code'));
                        form_modal.submit();
                    }
                });
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

            $('.select2_general_form').select2({
                placeholder: "Seleccione una Opcion",
                dropdownParent: $("#form_modal_{/literal}{$subcontrol}{literal}"),
                width: '100%'
            });

            $(".mayus").on("keypress", function () {
                $input=$(this);
                setTimeout(function () {
                    $input.val($input.val().toUpperCase());
                },50);
            });

            $('.summernote').summernote({
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
        };

        var handle_categoria_select = function(){

            $('#select_estado').on('change',function(){
                var id = $(this).val();
                id = id==null? '': id.toString();

                var observacion_msg = $('#observacion_msg');
                var aprobado_alerta = $('#aprobado_alerta');

                observacion_msg.addClass('m--hide');
                aprobado_alerta.addClass('m--hide');
                if(id==3){
                    observacion_msg.removeClass('m--hide');
                }else if(id==4){
                    aprobado_alerta.removeClass('m--hide');
                }

                switch (id){
                    case '3':
                        observacion_msg.removeClass('m--hide');
                        break;
                    case '4':
                        aprobado_alerta.removeClass('m--hide');
                        break;
                }

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
            }, 500);
        };

        return {
            init: function() {
                handle_form_modal_btn_submit();
                handle_form_modal_submit();
                handle_form_modal_components();
                handle_categoria_select();
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