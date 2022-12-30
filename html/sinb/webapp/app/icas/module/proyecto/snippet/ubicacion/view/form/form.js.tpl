{literal}
<script>
    var snippet_form_{/literal}{$subcontrol}{literal} = function() {
        "use strict";
        let form = $('#form_{/literal}{$subcontrol}{literal}');
        let btn_submit = $('#form_submit_{/literal}{$subcontrol}{literal}');
        let btn_close = $('#form_close_{/literal}{$subcontrol}{literal}');
        let pmodal = $("#form_modal_{/literal}{$subcontrol}{literal}");

        var municipio_opt = $("#municipio_id");
        let urlmodule = "{/literal}{$path_url}/{$subcontrol}_{literal}";

        var formv;
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
        var handle_option_municipio = function(){
            $('#departamento_id').on('change',function(){
                var id = $('#departamento_id').val();
                municipio_search(id);
            });
        };
        var municipio_search = function(id){
            municipio_opt.find("option").remove();
            municipio_opt.prop('disabled', true);
            if(id!="") {
                $.post(urlmodule+"/get.municipio"
                    , {id: id}
                    , function (res, textStatus, jqXHR) {
                        let selOption = $('<option></option>');
                        municipio_opt.append(selOption.attr("value", "").text("{/literal}{#field_holder_municipio_id#}{literal}"));
                        let municipio_list = []
                        for (var row in res) {
                            municipio_opt.append($('<option></option>').attr("value", res[row].id).text(res[row].name));
                            municipio_list[res[row].id] = res[row];
                        }
                        municipio_opt.trigger('chosen:updated');
                        municipio_opt.prop('disabled', false);
                    }
                    , 'json');
            }else{
                //handle_options_init();
            }
        };
        /**
         * Iniciamos los componentes necesarios como , summernote, select2 entre otros
         */
        var handle_components = function(){
            coreUyuni.setComponents();
        };

        //== Public Functions
        return {
            // public functions
            init: function() {
                handle_form_submit();
                handle_btn_submit();
                handle_components();
                handle_option_municipio();
            }
        };
    }();

    //== Class Initialization
    jQuery(document).ready(function() {
        snippet_form_{/literal}{$subcontrol}{literal}.init();
    });

</script>
{/literal}
