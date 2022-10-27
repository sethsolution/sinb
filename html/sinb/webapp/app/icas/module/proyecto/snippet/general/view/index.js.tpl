{literal}
<script>
    var snippet_general_form = function(){
        "use strict";
        /**
         * Datos del formulario y el boton
         */
        var form = $('#general_form');
        var btn_submit = $('#general_submit');

        var formv;
        /**
         * Antes de enviar el formulario se ejecuta la siguiente funcion
         */
        var showRequest= function(formData, jqForm, op)  {
            btn_submit.addClass('spinner spinner-white spinner-right').attr('disabled', true);
            return true;
        };

        var showResponse = function (res, statusText) {
            btn_submit.removeClass('spinner spinner-white spinner-right').attr('disabled', false);
            let url = "{/literal}{$path_url}{literal}";
            coreUyuni.generalShowResponse(res,url);

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
                document.getElementById('general_form'),
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
                $('#descripcion_input').val($('#descripcion').summernote('code'));

                formv.validate().then(function(status) {
                    if(status === 'Valid'){
                        form.submit();
                    }else{
                        Swal.fire({icon: 'error',title: lngUyuni.formFieldControlTitle, text: lngUyuni.formFieldControlMsg});
                    }
                });

            });
        };
        /**
         * Iniciamos los componentes necesarios como , summernote, select2 entre otros
         */
        var handle_components = function(){
            coreUyuni.setComponents();
        };

        var handle_type_select = function(){
            $('#type_select_category').on('change',function(){
                handle_type();
            });
        };
        var handle_font_select = function(){
            $('#type_select_font').on('change',function(){
                handle_font();
            });
        };

        var mini_div= $('#mini_div');
        var font_div= $('#font_div');

        var handle_type = function(){
            var id = $('#type_select_category').val();
            id = id==null? '': id.toString();
            console.log(id);
            mini_div.addClass('d-none');
            switch (id){
                case '3':
                    mini_div.removeClass('d-none');
                    break;
            }
        };
        var handle_font = function(){
            var id = $('#type_select_font').val();
            id = id==null? '': id.toString();
            font_div.addClass('d-none');
            switch (id){
                case '1':
                    font_div.removeClass('d-none');
                    break;
            }
        };

        return {
            init: function() {
                handle_form_submit();
                handle_btn_submit();
                handle_components();
                handle_type_select();
                handle_font_select();
            }
        };
    }();

    //== Class Initialization
    jQuery(document).ready(function() {
        snippet_general_form.init();
    });

</script>
{/literal}