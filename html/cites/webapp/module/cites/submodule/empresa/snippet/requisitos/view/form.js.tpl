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
                    swal({type: 'success',title: 'Los datos se han guardado correctamente!',showConfirmButton: false,timer: 2000});
                    var alert1 = $('#m_form_1_msg');
                    alert1.addClass('m--hide');
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
                $('#descripcion_input').val($('#descripcion').summernote('code'));
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
        var handle_categoria_select_activo = function(){
            $('#select_activo1').on('change',function(){
                var id1 = $(this).val();
                id1 = id1==null? '': id1.toString();
                var nombre1_div = $('#nombre1_div');
                nombre1_div.addClass('m--hide');
                switch (id1){
                    case '1':
                        nombre1_div.removeClass('m--hide');
                        break;
                }
            });
            $('#select_activo2').on('change',function(){
                var id2 = $(this).val();
                id2 = id2==null? '': id2.toString();
                var nombre2_div = $('#nombre2_div');
                nombre2_div.addClass('m--hide');
                switch (id2){
                    case '1':
                        nombre2_div.removeClass('m--hide');
                        break;
                }
            });
            $('#select_activo3').on('change',function(){
                var id3 = $(this).val();
                id3 = id3==null? '': id3.toString();
                var nombre3_div = $('#nombre3_div');
                nombre3_div.addClass('m--hide');
                switch (id3){
                    case '1':
                        nombre3_div.removeClass('m--hide');
                        break;
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