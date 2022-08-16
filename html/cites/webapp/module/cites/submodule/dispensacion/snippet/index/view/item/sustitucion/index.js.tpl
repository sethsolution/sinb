{literal}
<script>
    var snippet_general_form_sustitucion = function() {
        var tipo_id;
        var idficha = '{/literal}{$id}{literal}';
        var type = '{/literal}{$type}{literal}';
        var general_form = $('#general_form_sustitucion');
        var general_btn_submit = $('#general_submit_sustitucion');
        //== Private Functions
        var showRequest= function(formData, jqForm, op) {
            general_btn_submit.addClass('m-loader m-loader--right m-loader--light').attr('disabled', true);
            return true;
        };
        var showResponse = function (responseText, statusText) {
            general_btn_submit.removeClass('m-loader m-loader--right m-loader--light').attr('disabled', false);
            if(responseText.res ==1){
                location = "{/literal}{$path_url}{literal}/"+responseText.id;
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
                        "item[tipo_id]": {
                            required: {param:true,}
                        },
                        "item[causal_id]": {
                            required: {
                                param:true,
                                depends: function(element) {
                                    if (tipo_id=='4'){
                                        return true;
                                    }else{
                                        return false;
                                    }
                                },
                            },
                        },
                    },
                    messages: {
                        "item[tipo_id]": "Seleccione el tipo de de Sustitución"
                    },
                    //display error alert on form submit
                    invalidHandler: function(event, validator) {
                        /*
                        var alert = $('#m_form_1_msg');
                        alert.removeClass('m--hide').show();
                        mUtil.scrollTo("general_form",-150);
                         */
                    },
                });


                if (!form.valid()) {
                    return;
                }


                swal({
                    title: 'Esta seguro de realizar la sustición?',
                    text: "Recuerde que al momento de realizar la sustitución se anulará la certificación CITES actual y se creará una nuevo CITES con la misma información.",
                    type: 'warning',
                    showCancelButton: true,
                    confirmButtonText: 'Si, Sustituir!!!',
                    cancelButtonText: "No, Cancelar"
                }).then(function(result) {
                    if (result.value) {
                        general_form.submit();
                    }
                });


            });
        };

        var handle_general_components = function(){

            $('.select2_general_sustitucion').select2({
                placeholder: "Seleccione una Opcion"
                //dropdownParent: $("#modal-content_ver"),
                , width: '100%'
            });
        };

        var msg_error = function(){
            msg_error = '<strong>Ocurrio un error al guardar</strong><br>El registro que quiere editar no existe.';
            swal({position: 'top-center'
                ,html: msg_error
                ,type: 'error'
                ,title: 'No se puede guardar'});

            setTimeout(function() {
                $("#form_modal_{/literal}{$subcontrol}{literal}").modal("hide");
            }, 500);
        };

        var handle_detalle_select = function(){
            $('#select_tipo').on('change',function(){

                var id = $(this).val();

                id = id==null? '': id.toString();
                var div_detalle = $('#div_detalle');
                div_detalle.addClass('m--hide');
                switch (id){
                    case '4':
                        div_detalle.removeClass('m--hide');
                        break;
                }
            });
        };

        var handle_select = function() {
            $('#tipo_id').on('change', function () {
                var id = $(this).val();
                id1 = id == null ? '' : id.toString();
                tipo_id = id;

                if(id == 4){
                    $("#causa_div").removeClass("m--hide");
                }else{
                    $("#causa_div").addClass("m--hide");
                }

            });
        };
        //== Public Functions
        return {
            // public functions
            init: function() {
                handle_select();

                handle_detalle_select();
                handle_general_form_submit();
                handle_form_submit();
                handle_general_components();
            }
            {/literal}
            {if $item.itemId == "" and $type == "update"}
            {literal}
            msg_error();
        {/literal}
        {/if}
        {literal}
    };
    }();

    //== Class Initialization
    jQuery(document).ready(function() {
        snippet_general_form_sustitucion.init();
    });

</script>
{/literal}