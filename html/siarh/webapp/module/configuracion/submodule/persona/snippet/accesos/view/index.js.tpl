{literal}
<script>

    var snippet_accesos_form = function() {
        var idficha = '{/literal}{$id}{literal}';
        var type = '{/literal}{$type}{literal}';
        var accesos_form = $('#accesos_form');
        var accesos_btn_submit = $('#accesos_submit');
        //== Private Functions
        var showRequest= function(formData, jqForm, op) {
            accesos_btn_submit.addClass('m-loader m-loader--right m-loader--light').attr('disabled', true);
            return true;
        };
        var showResponse = function (responseText, statusText) {
            accesos_btn_submit.removeClass('m-loader m-loader--right m-loader--light').attr('disabled', false);
            $('#resultado_asistencia').html(responseText);
            console.log(responseText);
            /*
            if(responseText.res ==1){
                if(responseText.accion =='update') {
                    swal({type: 'success',title: 'Buen Trabajo! Se guardo todo con exito!',showConfirmButton: false,timer: 1000});
                }else{
                    location = "{/literal}{$getModule}{literal}&accion=itemUpdate&id="+responseText.id+"&type=update";
                }
            }else if(responseText.res ==2){
                swal("Ocurrio un error!", responseText.msg, "error")
            }else{
                swal("ocurrio un error!", responseText.msg, "danger")
            }
            */
        };

        var options = {
            beforeSubmit:showRequest
            //, dataType: 'json'
            , success:  showResponse
            , data: {
                accion:'{/literal}{$subcontrol}_verasistencia{literal}'
                ,itemId:idficha
                //,type:type
            }
        };
        var handle_form_submit=function(){
            accesos_form.ajaxForm(options);
        };

        var handle_accesos_form_submit = function() {

            accesos_btn_submit.click(function(e) {
                e.preventDefault();
                var btn = $(this);
                var form = $(this).closest('form');

                if (!form.valid()) {
                    return;
                }
                accesos_form.submit();
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
            });

            $('.select2_general').select2({
                placeholder: "Seleccione una opción"
            });
        };



        //== Public Functions
        return {
            // public functions
            init: function() {
                handle_accesos_form_submit();
                handle_form_submit();
                handle_general_components();
            }
        };
    }();

    //== Class Initialization
    jQuery(document).ready(function() {
        snippet_accesos_form.init();
    });

</script>
{/literal}