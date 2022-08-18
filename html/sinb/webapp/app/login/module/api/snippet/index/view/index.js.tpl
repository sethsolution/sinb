<script type="text/javascript" src="/js/md5.js"></script>
{literal}
<script>


    (function ($) {
    })(jQuery);

    var snippet_login_modal = function() {

        var form_btn_submit = $('#form_modal_submit_{/literal}{$subcontrol}{literal}');
        var form_btn_close = $('#form_modal_close_{/literal}{$subcontrol}{literal}');
        //== Private Functions

        function validate (input) {
            if($(input).attr('type') == 'email' || $(input).attr('name') == 'email') {
                if($(input).val().trim().match(/^([a-zA-Z0-9_\-\.]+)@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.)|(([a-zA-Z0-9\-]+\.)+))([a-zA-Z]{1,5}|[0-9]{1,3})(\]?)$/) == null) {
                    return false;
                }
            }
            else {
                if($(input).val().trim() == ''){
                    return false;
                }
            }
        }

        function showValidate(input) {
            var thisAlert = $(input).parent();

            $(thisAlert).addClass('alert-validate');
        }

        function hideValidate(input) {
            var thisAlert = $(input).parent();

            $(thisAlert).removeClass('alert-validate');
        }


        var handle_form_modal_btn_submit = function() {
            "use strict";
            /*==================================================================
                    [ Focus Contact2 ]*/
            $('.input100').each(function(){
                $(this).on('blur', function(){
                    if($(this).val().trim() != "") {
                        $(this).addClass('has-val');
                    }
                    else {
                        $(this).removeClass('has-val');
                    }
                })
            })

            /*==================================================================
            [ Validate ]*/
            var input = $('.validate-input .input100');




            $('.validate-form .input100').each(function(){
                $(this).focus(function(){
                    hideValidate(this);
                });
            });

            $('.validate-form').on('submit',function(){

                $("#error").addClass('dis-none');

                var check = true;

                for(var i=0; i<input.length; i++) {
                    if(validate(input[i]) == false){
                        showValidate(input[i]);
                        check=false;
                    }
                }

                if (check){
                    $("#cargando").removeClass('dis-none');
                    $('#bt_ingresar').prop('disabled', true);
                    var randomnumber = Math.floor(Math.random()*100);

                    $.post("/",{action:"login",
                        random:randomnumber,
                        "user":$("#user").val(),
                        "empresa":$("#empresa").val(),
                        "password":hex_md5($("#password").val())
                    }, function(data){
                        $('#bt_ingresar').prop('disabled', false);
                        if (data.res == 1){
                            $("#error").addClass('dis-none');
                            $("#div_usuario").addClass('dis-none');
                            $("#div_pass").addClass('dis-none');
                            //$("#bt_enviar").addClass('dis-none');
                            $("#div_olvido").addClass('dis-none');
                            $("#bt_enviar").hide();
                            location.reload();
                        }else{
                            if(data.res == 2){
                                $("#error").html('The username or password is incorrect.');
                            }else if (data.res == 3){
                                $("#error").html('The Company is not registered in the system');
                            }else if (data.res == 4){
                                $("#error").html('The user is not related to the company');
                            }
                            $("#cargando").addClass('dis-none');
                            $("#error").removeClass('dis-none');
                        }
                    });
                }
                return false;
            });

        };

        //== Public Functions
        return {
            // public functions
            init: function() {
                handle_form_modal_btn_submit();
            }
        };
    }();

    //== Class Initialization
    jQuery(document).ready(function() {
        snippet_login_modal.init();
    });


</script>

{/literal}



