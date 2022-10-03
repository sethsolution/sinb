{literal}
<script>
    var snippet_general_form = function() {
        var idficha = '{/literal}{$id}{literal}';
        var type = '{/literal}{$type}{literal}';
        var general_form = $('#general_form');
        var general_btn_submit = $('#general_submit');
        //== Private Functions
        var showRequest= function(formData, jqForm, op) {
            general_btn_submit.addClass('m-loader m-loader--right m-loader--light').attr('disabled', true);
            return true;
        };
        var showResponse = function (responseText, statusText) {
                console.log(responseText);
            general_btn_submit.removeClass('m-loader m-loader--right m-loader--light').attr('disabled', false);
            if(responseText.res ==1){
                console.log("test: "+responseText.accion);
                if(responseText.accion =='update') {
                   // swal("Buen Trabajo!", "Se guardo todo con exito!", "success")
                    swal({type: 'success',title: 'Buen Trabajo! Se guardo todo con exito!',showConfirmButton: false,timer: 1000});
                    //console.log("Actualizó : "+responseText.id);
                }else{
                    location = "{/literal}{$getModule}{literal}&accion=itemUpdate&id="+responseText.id+"&type=update&gestion={/literal}{$item.gestion_itemId}{literal}";
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
                general_form.submit();
            });
        };
        var redirectPost= function(location, args)
            {
                var form = $('<form></form>');
                form.attr("method", "post");
                form.attr("action", location);

                $.each( args, function( key, value ) {
                    var field = $('<input></input>');

                    field.attr("type", "hidden");
                    field.attr("name", key);
                    field.attr("value", value);

                    form.append(field);
                });
                $(form).appendTo('body').submit();
        }
        var combo_change=function(){
            
            var tipo='{/literal}{$type}{literal}';
            if(tipo==="new"){
                $("#departamento").change(function(){
                redirectPost('{/literal}{$getModule}{literal}&accion=itemUpdate&id=1&type='+tipo+'&gestion={/literal}{$item.gestion_itemId}{literal}',{
                    data:JSON.stringify(
                        {
                        departamento:$('#departamento').val(),
                        provincia:null,
                        municipio:null,
                    }
                    )
                    });  
                });
                $("#provincia").change(function(){
                redirectPost('{/literal}{$getModule}{literal}&accion=itemUpdate&id=1&type='+tipo+'&gestion={/literal}{$item.gestion_itemId}{literal}',{
                    data:JSON.stringify(
                        {
                        departamento:$('#departamento').val(),
                        provincia:$('#provincia').val(),
                        municipio:null,
                    }
                    )
                    });  
                });
                $("#municipio").change(function(){
                redirectPost('{/literal}{$getModule}{literal}&accion=itemUpdate&id=1&type='+tipo+'&gestion={/literal}{$item.gestion_itemId}{literal}',{
                    data:JSON.stringify(
                        {
                        departamento:$('#departamento').val(),
                        provincia:$('#provincia').val(),
                        municipio:$('#municipio').val(),
                    }
                    )
                    });  
                });
            }
        }
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
                handle_form_submit();
                handle_general_components();
                combo_change();
            }
        };
    }();

    //== Class Initialization
    jQuery(document).ready(function() {
        if('{/literal}{$type}{literal}'==="new")
        document.getElementById("parcial").defaultValue = 0;
        $("#municipio_itemId").change(function(){
            var muniId = $("#municipio_itemId option:selected").val();
            var tipo='{/literal}{$type}{literal}';
        var url = '{/literal}{$getModule}{literal}&accion=itemUpdate&id='+muniId+'&type='+tipo+'&gestion={/literal}{$item.gestion_itemId}{literal}';
        location=url;
        });
        snippet_general_form.init();
    });

</script>
{/literal}