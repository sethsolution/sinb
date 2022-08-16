{literal}
<script>
    var snippet_resumen = function () {

        var handler_resumen01 = function(){
            loadurl = "{/literal}{$getModule}&accion=resumen01&id={$id}{literal}";
            $.get(loadurl, function(data) {
                $("#resumen01").html(data);
            });
        };
        var handler_resumen02 = function(){
            var loadurl = "{/literal}{$getModule}&accion=resumen02&id={$id}{literal}";
            alert("hola snippet 02");
        };

        return {
            init: function() {
                handler_resumen01();
            }
            ,r01: function () {
                handler_resumen01();
            }
            ,r02: function () {
                handler_resumen02();
            }
        };
    }();

    var snippet_avatar = function(){
        var idficha = '{/literal}{$id}{literal}';
        var form_modal = $('#form_avatar');
        var form_btn_submit = $('#form_avatar_submit');
        var avatar_src= '{/literal}{$getModule}&accion=foto.get&id={$id}&type=3{literal}';

        var showRequest= function(formData, jqForm, op) {
            form_btn_submit.addClass('m-loader m-loader--right m-loader--light').attr('disabled', true);
            return true;
        };

        var showResponse = function (responseText, statusText) {
            form_btn_submit.removeClass('m-loader m-loader--right m-loader--light').attr('disabled', false);
            if(responseText.res ==1){
                $('#input_archivo_avatar').val("");
                $('#input_archivo_avatar').next('.custom-file-label').html("");
                d = new Date();
                $('#persona_avatar').attr("src",avatar_src+"&"+d.getTime());

                if(responseText.accion =='update') {
                    swal({type: 'success',title: 'Buen Trabajo! Se guardo todo con exito!',showConfirmButton: false,timer: 1000});
                }else{
                    swal({type: 'success',title: 'Buen Trabajo! Se a creado el registro con exito!',showConfirmButton: false,timer: 1000});
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
                accion:'{/literal}avatar.updatesql{literal}'
                ,itemId:idficha
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
                if (!form.valid()) {
                    return;
                }
                form_modal.submit();
            });
        };

        var handle_form_modal_components = function(){
            $('#input_archivo_avatar').on('change', function() {
                let fileName = $(this).val().split('\\').pop();
                //console.log(fileName);
                $(this).next('.custom-file-label').addClass("archivo").html(fileName);
            });
        };

        //== Public Functions
        return {
            // public functions
            init: function() {
                handle_form_modal_btn_submit();
                handle_form_modal_submit();
                handle_form_modal_components();
            }
        };


    }();

    jQuery(document).ready(function() {
        snippet_resumen.r01();
        snippet_avatar.init();
    });


</script>
{/literal}