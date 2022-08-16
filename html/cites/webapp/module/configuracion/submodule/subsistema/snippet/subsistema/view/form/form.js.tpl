{literal}
<script>
    var snippet_form_modal = function() {
        var categoria_id;
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
                    swal({type: 'success',title: 'Buen Trabajo! Se guardo todo con exito!',showConfirmButton: false,timer: 900});
                }else{
                    swal({type: 'success',title: 'Buen Trabajo! Se a creado el registro con exito!',showConfirmButton: false,timer: 900});
                }
            }else if(responseText.res ==2){
                swal("Ocurrio un error!", responseText.msg, "error")
            }else{
                swal("ocurrio un error!", responseText.msg, "danger")
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
                //var btn = $(this);
                var form = $(this).closest('form');
                form.validate({

                    rules: {
                        "item[url]": {
                            required: {
                                param:true,
                                depends: function(element) {
                                    if (categoria_id=='URL'){
                                        return true;
                                    }else{
                                        return false;
                                    }
                                },
                            },
                        },
                        "item[carpeta]": {
                            required: {
                                param:true,
                                depends: function(element) {
                                    if (categoria_id=='CARPETA'){
                                        return true;
                                    }else{
                                        return false;
                                    }
                                },
                            },
                        },
                    }
                });

                if (!form.valid()) {
                    return;
                }
                $('#descripcion_input').val($('#descripcion').summernote('code'));

                //$('#carpeta_input').val($('#carpeta').text().trim().toLowerCase());

                form_modal.submit();
            });

        };

        var handle_form_modal_components = function(){
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
                //,dropdownParent: $("#form_modal_{/literal}{$subcontrol}{literal}")
                , width: '100%'

            });
            $('#input_archivo').on('change', function() {
                let fileName = $(this).val().split('\\').pop();
                console.log(fileName);
                $(this).next('.custom-file-label').addClass("archivo").html(fileName);
            });
            $('.valores_numericos').number( true, 0 ,'','');

            $('.summernote').summernote({
                height: 150
            });

        };
        var handle_categoria_select = function(){

            $('#categoria_select').on('change',function(){
                id = $(this).val();

                var id = $(this).val();
                id = id==null? '': id.toString();


                categoria_id = id;
                console.log(categoria_id);

                //form_btn_submit.removeClass('m-loader m-loader--right m-loader--light');
                //form_btn_submit.addClass('m-loader m-loader--right m-loader--light');

                var submodulo_div = $('#submodulo_div');
                var modulo_div = $('#modulo_div');
                var url_div = $('#url_div');
                var carpeta_div= $('#carpeta_div');

                url_div.addClass('m--hide');
                modulo_div.addClass('m--hide');
                submodulo_div.addClass('m--hide');
                carpeta_div.addClass('m--hide');

                switch (id){
                    case 'URL':
                        url_div.removeClass('m--hide');
                        break;
                    case 'INDEX':
                        modulo_div.removeClass('m--hide');
                        break;
                    case 'SB':
                        submodulo_div.removeClass('m--hide');
                        break;
                    case 'CARPETA':
                        carpeta_div.removeClass('m--hide');
                        break;
                }

            });
        };
             //== Public Functions
        return {
            // public functions
            init: function() {
                handle_categoria_select();
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
