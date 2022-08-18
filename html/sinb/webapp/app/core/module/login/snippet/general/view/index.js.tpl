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
            general_btn_submit.removeClass('m-loader m-loader--right m-loader--light').attr('disabled', false);
            if(responseText.res ==1){
                console.log("test: "+responseText.accion);
                if(responseText.accion =='update') {
                   // swal("Buen Trabajo!", "Se guardo todo con exito!", "success")
                    swal({type: 'success',title: 'Buen Trabajo! Se guardo todo con exito!',showConfirmButton: false,timer: 1000});
                    //console.log("Actualizó : "+responseText.id);
                }else{
                    location = "{/literal}{$getModule}{literal}&accion=itemUpdate&id="+responseText.id+"&type=update";
                    console.log("es nuevo : "+responseText.id);
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
                e.preventDefault();
                var btn = $(this);
                var form = $(this).closest('form');

                if (!form.valid()) {
                    return;
                }
                general_form.submit();
            });
        };

        var entidad_sel = $("#entidad");
        var direccion_sel = $("#direccion");
        var unidad_sel = $("#unidad");
        var escala_maestra_sel = $("#escala_maestra");

        var direccion_url = '{/literal}{$getModule}&accion={$subcontrol}{literal}_get.direccion';
        var unidad_url = '{/literal}{$getModule}&accion={$subcontrol}{literal}_get.unidad';
        var escala_maestra_url = '{/literal}{$getModule}&accion={$subcontrol}{literal}_get.escalamaestra';

        var handle_general_components = function(){
            $('.fecha_general').datepicker({
                todayHighlight: true,
                orientation: "bottom left",
                format: 'dd/mm/yyyy',
                templates: {
                    leftArrow: '<i class="la la-angle-left"></i>',
                    rightArrow: '<i class="la la-angle-right"></i>'
                }
            });

            $('.select2_general').select2({
                placeholder: "Seleccione una opción"
            });

            $("#fuente").change(function(evt, params){
                id = $(this).val();
                if(id==10){
                    $("#organismo_id").val('111');
                }else if(id==11){
                    $("#organismo_id").val('0');
                }

            });

            $('.valores_numericos').TouchSpin({
                mousewheel:false,
                max: 1000000000,
                verticalbuttons: false,

            });

            entidad_sel.change(function(evt, params){
                entidad_id = $(this).val();
                entidad_id = entidad_id==null? '': entidad_id.toString();
                direccion_search(entidad_id);
                //alert("entidad_id: " +entidad_id);
            });
            direccion_sel.change(function(evt, params){
                entidad_id = $(this).val();
                entidad_id = entidad_id==null? '': entidad_id.toString();
                unidad_search(entidad_id);
                //alert("entidad_id: " +entidad_id);
            });

            escala_maestra_sel.change(function(evt, params){
                id = $(this).val();
                id = id==null? '': id.toString();
                escala_maestra_search(id);
            });

        };

        var escala_maestra_search = function (id) {
            if($.trim(id)!="" && $.trim(id)!=0){
                $.post(
                    escala_maestra_url
                    ,{id:id}
                    ,function (res, textStatus, jqXHR){
                        $("#area_id").val(res.area)
                        $("#categoria_id").val(res.categoria)
                        $("#haber_basico").val(res.haber_basico+" Bs.")
                        $("#haber_basico").val(new Intl.NumberFormat().format(res.haber_basico)+" Bs.")
                        $("#gestion_haber").val(res.gestion)

                    }
                    ,'json');
            }
        };

        var direccion_search = function(id){
            direccion_sel.find("option").remove();
            direccion_sel.select2({placeholder: "Loading...."});
            direccion_sel.attr("disabled","disabled").find("option:gt(0)").remove();
            direccion_sel.trigger("chosen:updated");

            unidad_sel.select2({placeholder: "Seleccione Dirección ..."});
            unidad_sel.attr("disabled","disabled").find("option:gt(0)").remove();
            unidad_sel.trigger("chosen:updated");

            if($.trim(id)!="" && $.trim(id)!=0){
                $.post(
                    direccion_url
                    ,{id:id}
                    ,function (res, textStatus, jqXHR){
                        direccion_sel.select2({placeholder: "Seleccione una direccion."});
                        direccion_sel.append($('<option></option>').attr("value","").text("Seleccione una direccion."));
                        for(i=0;i<res.length;i++){
                            direccion_sel.append($('<option></option>').attr("value",res[i].itemId).text(res[i].nombre));
                        }
                        direccion_sel.removeAttr("disabled").trigger("chosen:updated");
                    }
                    ,'json');
            }else{
                direccion_sel.removeAttr("disabled").select2({placeholder: "Seleccione una entidad"});
                direccion_sel.trigger('chosen:updated');
            }
        };

        var unidad_search = function(id){
            unidad_sel.find("option").remove();
            unidad_sel.select2({placeholder: "Loading...."});
            unidad_sel.attr("disabled","disabled").find("option:gt(0)").remove();
            unidad_sel.trigger("chosen:updated");

            if($.trim(id)!="" && $.trim(id)!=0){
                $.post(
                    unidad_url
                    ,{id:id}
                    ,function (res, textStatus, jqXHR){
                        unidad_sel.select2({placeholder: "Seleccione una Unidad."});
                        unidad_sel.append($('<option></option>').attr("value","").text("Seleccione una Unidad."));
                        for(i=0;i<res.length;i++){
                            unidad_sel.append($('<option></option>').attr("value",res[i].itemId).text(res[i].nombre));
                        }
                        unidad_sel.removeAttr("disabled").trigger("chosen:updated");
                    }
                    ,'json');
            }else{
                unidad_sel.removeAttr("disabled").select2({placeholder: "Seleccione una Dirección ..."});
                unidad_sel.trigger('chosen:updated');
            }
        };



        //== Public Functions
        return {
            // public functions
            init: function() {
                handle_general_form_submit();
                handle_form_submit();
                handle_general_components();
            }
        };
    }();

    //== Class Initialization
    jQuery(document).ready(function() {
        snippet_general_form.init();
    });

</script>
{/literal}