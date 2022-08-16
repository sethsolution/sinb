{literal}
<script>
    var snippet_login_modal = function() {

        var form_btn_submit = $('#form_modal_submit_{/literal}{$subcontrol}{literal}');
        var form_btn_close = $('#form_modal_close_{/literal}{$subcontrol}{literal}');
        //== Private Functions

        var handle_form_modal_btn_submit = function() {
            form_btn_submit.click(function(e) {
                e.preventDefault();
                var btn = $(this);

                var form = $(this).closest('form');

                form.validate({
                    rules: {
                        user: {
                            required: true,
                            //email: true
                        },
                        password: {
                            required: true
                        }
                    }
                });

                if (!form.valid()) {
                    return;
                }

                btn.addClass('m-loader m-loader--right m-loader--light').attr('disabled', true);
                randomnumber=Math.floor(Math.random()*100);

                $.post("index.php",{action:"login",
                    random:randomnumber,
                    "user":$("#user").val(),
                    "password":hex_md5($("#password").val())
                }, function(data){
                    if (data == 1){
                        btn.removeClass('m-loader m-loader--right m-loader--light').attr('disabled', false);
                        swal("Ocurrio un error!", "Nombre de usuario o contraseña incorrecta. Inténtalo de nuevo." , "error")

                    }else if (data == 0){
                        btn.removeClass('m-loader m-loader--right m-loader--light').attr('disabled', false);
                        $("#form_modal_login").modal("hide");
                        $(".m-page").addClass('m--hide');

                        swal({
                            type: 'success'
                            ,title: 'Datos de acceso correctos!!!'
                            ,showConfirmButton: false,timer: 1000
                            ,onClose: () => {
                                location.reload();
                            }
                        });
                    }
                });


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



