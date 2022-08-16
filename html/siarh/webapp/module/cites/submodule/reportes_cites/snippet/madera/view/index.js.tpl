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

            //$("#resultado").html(responseText);
            //$("#resultado").html("test termino");
            //$("#resultado").html(responseText);
            //console.log();
            swal.close();
            form_btn_submit.removeClass('m-loader m-loader--right m-loader--light').attr('disabled', false);

        };

        var options = {
            beforeSubmit:showRequest
            //, dataType: 'script'
            , target:     '#resultado'
            , success:  showResponse
            , data: {
                accion:'{/literal}{$subcontrol}_consultar{literal}'
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

                $("#resultado").html("");
                $("#resultado").html(" Cargando su solicitud... ");
                swal({
                    title: 'Cargando información!',
                    html: 'Procesando datos<br>'+cargando_vista,
                    showConfirmButton: false,
                    allowEnterKey: false,
                    allowOutsideClick: false,
                    allowEscapeKey: false,
                });
                form_modal.submit();
            });
        };

        var handle_form_modal_components = function(){

            $('.select2_busqueda').select2({
                placeholder: "Todos"
            });


            $('.fecha_general').datepicker({
                todayHighlight: true,
                orientation: "bottom left",
                format: 'dd/mm/yyyy',
                templates: {
                    leftArrow: '<i class="la la-angle-left"></i>',
                    rightArrow: '<i class="la la-angle-right"></i>'
                }
            });
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