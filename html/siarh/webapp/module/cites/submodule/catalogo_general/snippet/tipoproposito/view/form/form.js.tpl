{literal}
<script>
    var snippet_form_modal = function() {
        var idficha = '{/literal}{$id}{literal}';
        var type = '{/literal}{$type}{literal}';
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
            form_btn_submit.removeClass('m-loader m-loader--right m-loader--light').attr('disabled', false);
            if(responseText.res ==1){
                $("#form_modal_{/literal}{$subcontrol}{literal}").modal("hide");
                table_list.draw();
                if(responseText.accion =='update') {
                    swal({type: 'success',title: 'Buen Trabajo! Se guardo todo con exito!',showConfirmButton: false,timer: 1000});
                }else{
                    swal({type: 'success',title: 'Buen Trabajo! Se a creado el registro con exito!',showConfirmButton: false,timer: 1000});
                }
            }else{
                swal({position: 'top-center'
                    ,html:'<strong>Ocurrio error al guardar</strong><br>'+responseText.msg+'<br><br><div class="m-alert m-alert--outline alert alert-danger alert-dismissible fade show" role="alert"> <strong>Dato Técnico: </strong>'+responseText.msgdb+'</div>'
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
        var handle_form_modal_submit=function(){
            form_modal.ajaxForm(options);
        };

        var handle_form_modal_btn_submit = function() {

            form_btn_submit.click(function(e) {
                e.preventDefault();
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
            });

            $('.valores_numericos').number( true, 0 ,'','');
        };



        //== Public Functions
        return {
            // public functions
            init: function() {
                handle_form_modal_btn_submit();
                handle_form_modal_submit();
                handle_form_modal_components();
            }
        };
    }();

    //== Class Initialization
    jQuery(document).ready(function() {
        snippet_form_modal.init();
    });

</script>
{/literal}