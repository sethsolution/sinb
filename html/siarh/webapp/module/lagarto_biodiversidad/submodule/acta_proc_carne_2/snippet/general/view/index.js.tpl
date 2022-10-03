{literal}
<script>
    var snippet_general_form = function() {
        var idficha = '{/literal}{$id}{literal}';
        var type = '{/literal}{$type}{literal}';
        var general_form = $('#general_form');
        var general_btn_submit = $('#general_submit');
        var preview_btn_submit = $('#preview_submit');
        var showRequest= function(formData, jqForm, op) {
            general_btn_submit.addClass('m-loader m-loader--right m-loader--light').attr('disabled', true);
            return true;
        };
        var showResponse = function (responseText, statusText) {
            general_btn_submit.removeClass('m-loader m-loader--right m-loader--light').attr('disabled', false);
            if(responseText.res ==1){
                console.log("test: "+responseText.accion);
                if(responseText.accion =='update')
                { 
                    var title='Buen Trabajo! Se guardo todo con exito!';
                    if(responseText.prev=="yes"){
                        title='Buen Trabajo! Se guardo el borrador con exito!';                    
                    }
                    swal({type: 'success',title: 'Buen Trabajo! Se guardo todo con exito!',showConfirmButton: false,timer: 1000});
                
                   
                    if(responseText.prev!="yes"){
                        location = "{/literal}{$getModule}{literal}";
                    }

                   // swal("Buen Trabajo!", "Se guardo todo con exito!", "success")
                     //console.log("Actualizó : "+responseText.id);
                }else{
                    location = "{/literal}{$getModule}{literal}&accion=itemUpdate&id="+responseText.id+"&type=update";
                    console.log("es nuevo : "+responseText.id);
                }
            }else if(responseText.res ==2){
                swal("!Ocurrió un error!", responseText.msg, "error")
            }else{
                swal("!Ocurrió un error!", responseText.msg, "error")
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
        var handle_form_submit=function(){
            general_form.ajaxForm(options);
        };
        
        var modificarCantidad=function(){
            var cantidadPrimera=Number($("#cantidadPrimera").val());
            var cantidadSegunda=Number($("#cantidadSegunda").val());
            $("#cantidadTotal").val(cantidadPrimera+cantidadSegunda);
            $("#cantidadPrimera").change(function(){
            var cantidadPrimera=Number($("#cantidadPrimera").val());
            var cantidadTotal=Number($("#cantidadTotal").val());
            var cantidadSegunda=Number($("#cantidadSegunda").val());
                if(cantidadPrimera>cantidadTotal){
                    $("#cantidadPrimera").val(0);
                    $("#cantidadSegunda").val(cantidadTotal);
                }
                else{
                    $("#cantidadSegunda").val(cantidadTotal-cantidadPrimera);
                    
                }
            });
        }
        var handle_general_form_submit = function() {

            general_btn_submit.click(function(e) {
                
                options={
                beforeSubmit:showRequest
                , dataType: 'json'
                , success:  showResponse
                , data: {
                    accion:'{/literal}{$subcontrol}_itemupdatesql{literal}'
                    ,itemId:idficha
                    ,type:type

                }};  
                e.preventDefault();
                var btn = $(this);
                var form = $(this).closest('form');
                handle_form_submit();

                if (!form.valid()) {
                    return;
                }
                Swal.fire({
                    type: 'warning',
                    title: 'Una vez guardados estos cambios no podra revertirlos.',
                    showCancelButton: true,
                    confirmButtonText: `Guardar`,
                    cancelButtonText: `Cancelar`,
                    }).then((result) => {
                    if (result.value) {
                            general_form.submit();
                    } 
                    })
            });
        };
        var handle_preview_form_submit = function() {

            preview_btn_submit.click(function(e) {
                
                options={
                beforeSubmit:showRequest
                , dataType: 'json'
                , success:  showResponse
                , data: {
                    accion:'{/literal}{$subcontrol}_itemupdatesql{literal}'
                    ,itemId:idficha
                    ,type:type,
                    prev:true                    

                }};  
                e.preventDefault();
                var btn = $(this);
                var form = $(this).closest('form');
                handle_form_submit();

                if (!form.valid()) {
                    return;
                }
                general_form.submit();
            });
        };

        var handle_general_components = function(){

            $('.select2_general').select2({
                placeholder: "Seleccione una opción"
            });

        };


        //== Public Functions
        return {
            // public functions
            init: function() {
                handle_general_form_submit();
                handle_preview_form_submit();
                handle_form_submit();
                handle_general_components();
                modificarCantidad();
            }
        };
    }();

    //== Class Initialization
    jQuery(document).ready(function() {
        snippet_general_form.init();
    });

</script>
{/literal}