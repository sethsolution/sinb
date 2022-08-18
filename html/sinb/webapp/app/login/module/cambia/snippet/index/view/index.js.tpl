<script type="text/javascript" src="js/md5.js"></script>
{literal}
<script>


    (function ($) {
    })(jQuery);

    var snippet_login_modal = function() {
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

                    $.post("/ingreso/recupera",{accion:"enviar",
                        random:randomnumber,
                        "user":$("#user").val()
                    }, function(data){
                        console.log(data);
                        $("#cargando").addClass('dis-none');

                        if (data.resp == 1){
                            $("#div_usuario").addClass('dis-none');
                            $("#error").addClass('dis-none');
                            $("#bt_enviar").hide();
                            $("#exito").removeClass('dis-none');
                        }else{
                            $("#error").html( data.msg);
                            $("#error").removeClass('dis-none');
                            $('#bt_ingresar').prop('disabled', false);
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



