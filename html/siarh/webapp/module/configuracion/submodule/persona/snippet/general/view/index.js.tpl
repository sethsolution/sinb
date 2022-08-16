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
        var showResponse = function (res, statusText) {
            general_btn_submit.removeClass('m-loader m-loader--right m-loader--light').attr('disabled', false);
            if(res.res ==1){
                snippet_resumen.r01();
                if(res.accion =='update') {
                    swal({type: 'success',title: 'Buen Trabajo! Se guardo todo con exito!',showConfirmButton: false,timer: 1000});
                }else{
                    location = "{/literal}{$getModule}{literal}&accion=itemUpdate&id="+res.id+"&type=update";
                }
            }else{
                swal({position: 'top-center'
                    ,html:'<strong>Ocurrio error al guardar</strong><br>'+res.msg+'<br><br><div class="m-alert m-alert--outline alert alert-danger alert-dismissible fade show" role="alert"> <strong>Dato Técnico: </strong>'+res.msgdb+'</div>'
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

                if (!form.valid()) {
                    return;
                }

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
            });

            $('.select2_general').select2({
                placeholder: "Seleccione una opción"
            });

            $('.numero_entero').number( true, 0 ,'','');

        };



        //== Public Functions
        return {
            // public functions
            init: function() {
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