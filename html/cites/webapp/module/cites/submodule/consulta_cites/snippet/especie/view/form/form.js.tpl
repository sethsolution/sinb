{literal}
<script>
    var snippet_form_modal = function() {

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

            if(responseText.res ==1){
                $("#form_modal_{/literal}{$subcontrol}{literal}").modal("hide");
                table_list.draw();
                if(responseText.accion =='update') {
                    swal({type: 'success',title: 'Se guardo todo con exito!',showConfirmButton: false,timer: 2000});
                }else{
                    swal({type: 'success',title: 'Se a creado el registro con exito!',showConfirmButton: false,timer: 2000});
                }
            }else{
                form_btn_close.attr('disabled', false);
                form_btn_submit.removeClass('m-loader m-loader--right m-loader--light').attr('disabled', false);

                msg_error = '<strong>Ocurrio error al guardar</strong><br>'+responseText.msg;
                if (responseText.msgdb !== undefined){
                    msg_error += '<br><br><div class="m-alert m-alert--outline alert alert-danger alert-dismissible fade show" role="alert">';
                    msg_error += '<strong>Dato Técnico: </strong>'+responseText.msgdb+'</div>';
                }
                swal({position: 'top-center'
                    ,html:msg_error
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
                placeholder: "Seleccione una Opcion"
                //dropdownParent: $("#form_modal_{/literal}{$subcontrol}{literal}"),
                , width: '100%'
            });

            $('.numero_decimal').number( true, 2 ,'.',',');
            $('.numero_entero').number( true, 0 ,'','');

            $('#input_archivo').on('change', function() {
                let fileName = $(this).val().split('\\').pop();
                //$(this).next('.custom-file-label').addClass("archivo").html(fileName);
                if(fileName!=""){
                    $("#archivo_nombre").addClass("archivo").html(fileName);
                }
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
         var handle_select_activo = function() {
             $('#select_activo').on('change', function () {
                 var id = $(this).val();
                 id1 = id == null ? '' : id.toString();
                 var nombre_div = $('#nombre_div');
                 nombre_div.addClass('m--hide');
                 switch (id) {
                     case '1':
                         nombre_div.removeClass('m--hide');
                         break;
                 }
             });
         }
        //== Public Functions
        return {
            // public functions
            init: function() {
                handle_select_activo();
                handle_form_modal_btn_submit();
                handle_form_modal_submit();
                handle_form_modal_components();

                {/literal}
                {if $item.itemId == "" and $type == "update"}
                {literal}
                msg_error();
                {/literal}
                {/if}
                {literal}
            }
        };
    }();

    //== Class Initialization
    jQuery(document).ready(function() {
        snippet_form_modal.init();
    });

</script>
{/literal}