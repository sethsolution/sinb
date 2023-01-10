{literal}
<script>
    var snippet_form_{/literal}{$subcontrol}{literal} = function() {
        "use strict";
        let form = $('#form_{/literal}{$subcontrol}{literal}');
        let btn_submit = $('#form_submit_{/literal}{$subcontrol}{literal}');
        let btn_close = $('#form_close_{/literal}{$subcontrol}{literal}');
        let pmodal = $("#form_modal_{/literal}{$subcontrol}{literal}");
        var formv;

        var institucion_opt = $("#institucion_id");
        let urlmodule = "{/literal}{$path_url}/{$subcontrol}_{literal}";
        /**
         * Antes de enviar el formulario se ejecuta la siguiente funcion
         */
        var showRequest= function(formData, jqForm, op) {
            btn_submit.addClass('spinner spinner-white spinner-right').attr('disabled', true);
            btn_close.attr('disabled', true);
            return true;
        };
        var showResponse = function (res, statusText) {
            coreUyuni.itemFormShowResponse(res,pmodal,table_list);
            btn_close.attr('disabled', false);
            btn_submit.removeClass('spinner spinner-white spinner-right').attr('disabled', false);
        };
        /**
         * Opciones para generar el objeto del formulario
         */
        var options = {
            beforeSubmit:showRequest
            , success:  showResponse
            , data: {type:'{/literal}{$type}{literal}'}
        };
        /**
         * Se da las propiedades de ajaxform al formulario
         */
        var handle_form_submit=function(){
            form.ajaxForm(options);
            formv = FormValidation.formValidation(
                document.getElementById('form_{/literal}{$subcontrol}{literal}'),
                {
                    plugins: {
                        declarative: new FormValidation.plugins.Declarative({html5Input: true,}),
                        trigger: new FormValidation.plugins.Trigger(),
                        bootstrap: new FormValidation.plugins.Bootstrap(),
                        submitButton: new FormValidation.plugins.SubmitButton(),
                    }
                }
            );
        };
        /**
         * Se da las funcionalidades al boton enviar
         */
        var handle_btn_submit = function() {
            btn_submit.click(function(e) {
                e.preventDefault();
                /**
                 * Copiamos los datos de summerNote a una variable
                 */
                $('#description_input').val($('#description').summernote('code'));
                formv.validate().then(function(status) {
                    if(status === 'Valid'){
                        form.submit();
                    }
                });
            });
        };
        /**
         * Iniciamos los componentes necesarios como , summernote, select2 entre otros
         */
        var handle_components = function(){
            coreUyuni.setComponents();

            $('#input_file').on('change', function() {
                let fileName = $(this).val().split('\\').pop();
                if(fileName!=""){
                    $("#input_file_name").addClass("input-attached-file").html(fileName);
                }
            });
        };

        var handle_option_institucion = function(){
            $('#tipo_id').on('change',function(){
                var id = $('#tipo_id').val();
                institucion_search(id);
            });
        };
        var institucion_search = function(id){
            institucion_opt.find("option").remove();
            institucion_opt.prop('disabled', true);
            if(id!="") {
                $.post(urlmodule+"/get.institucion"
                    , {id: id}
                    , function (res, textStatus, jqXHR) {
                        let selOption = $('<option></option>');
                        institucion_opt.append(selOption.attr("value", "").text("{/literal}{#field_Holder_institucion_id#}{literal}"));
                        let institucion_list = []
                        for (var row in res) {
                            institucion_opt.append($('<option></option>').attr("value", res[row].id).text(res[row].nombre));
                            institucion_list[res[row].id] = res[row];
                        }
                        institucion_opt.trigger('chosen:updated');
                        institucion_opt.prop('disabled', false);
                    }
                    , 'json');
            }else{
                //handle_options_init();
            }
        };

        var handle_select_institucion = function(){
            $('#institucion_id').on('change',function(){
                var id = $('#institucion_id').val();
                $('#nombre_s').addClass('spinner spinner-right').attr('disabled', true);
                $('#nombre').prop('disabled', true);
                $('#direccion_s').addClass('spinner spinner-right').attr('disabled', true);
                $('#direccion').prop('disabled', true);
                $('#email_s').addClass('spinner spinner-right').attr('disabled', true);
                $('#email').prop('disabled', true);
                $('#celular_s').addClass('spinner spinner-right').attr('disabled', true);
                $('#celular').prop('disabled', true);
                $('#telefono_s').addClass('spinner spinner-right').attr('disabled', true);
                $('#telefono').prop('disabled', true);
                $('#fax_s').addClass('spinner spinner-right').attr('disabled', true);
                $('#fax').prop('disabled', true);
                $('#responsable_s').addClass('spinner spinner-right').attr('disabled', true);
                $('#responsable').prop('disabled', true);
                if(id!="") {
                    $.post(urlmodule+"/get.item"
                        , {id: id}
                        , function (res, textStatus, jqXHR) {
                            for (var row in res) {
                                $('#nombre').val(res[row].nombre);
                                $('#direccion').val(res[row].direccion);
                                $('#email').val(res[row].email);
                                $('#celular').val(res[row].celular);
                                $('#telefono').val(res[row].telefono);
                                $('#fax').val(res[row].fax);
                                $('#responsable').val(res[row].responsable);
                            }
                            $('#nombre_s').removeClass('spinner spinner-right').attr('disabled', false);
                            $('#nombre').prop('disabled', false);
                            $('#direccion_s').removeClass('spinner spinner-right').attr('disabled', false);
                            $('#direccion').prop('disabled', false);
                            $('#email_s').removeClass('spinner spinner-right').attr('disabled', false);
                            $('#email').prop('disabled', false);
                            $('#celular_s').removeClass('spinner spinner-right').attr('disabled', false);
                            $('#celular').prop('disabled', false);
                            $('#telefono_s').removeClass('spinner spinner-right').attr('disabled', false);
                            $('#telefono').prop('disabled', false);
                            $('#fax_s').removeClass('spinner spinner-right').attr('disabled', false);
                            $('#fax').prop('disabled', false);
                            $('#responsable_s').removeClass('spinner spinner-right').attr('disabled', false);
                            $('#responsable').prop('disabled', false);
                        }
                        , 'json');
                }
            });
        };

        //== Public Functions
        return {
            // public functions
            init: function() {
                handle_form_submit();
                handle_btn_submit();
                handle_components();
                handle_option_institucion();
                handle_select_institucion();
            }
        };
    }();

    //== Class Initialization
    jQuery(document).ready(function() {
        snippet_form_{/literal}{$subcontrol}{literal}.init();
    });

</script>
{/literal}
