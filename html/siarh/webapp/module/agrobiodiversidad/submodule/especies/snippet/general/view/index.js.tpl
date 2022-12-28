{literal}
<script>
var snippet_general_form = function() {
    var idficha = '{/literal}{$id}{literal}';
    var type = '{/literal}{$type}{literal}';
    var general_form = $('#general_form');
    var general_btn_submit = $('#general_submit');
    var cboMacroId = $('#cboMacroId');
    var cboMunicipioId = $('#cboMunicipioId');
    var itemsMunicipio = '{/literal}{$item.municipio_itemid}{literal}'.split(",");
    var fileArchivoAdjunto = document.getElementById('fileArchivoAdjunto');
    var imgVistaPrevia = document.getElementById('imgVistaPrevia');
    var imgContenedor = document.getElementById('imgContenedor');

    //== Private Functions
    var showRequest= function(formData, jqForm, op) {
        general_btn_submit.addClass('m-loader m-loader--right m-loader--light').attr('disabled', true);
        return true;
    };

    var showResponse = function(responseText, statusText) {
        general_btn_submit.removeClass('m-loader m-loader--right m-loader--light').attr('disabled', false);
        if (responseText.res ==1) {
            if (responseText.accion == 'new') {
                swal("Creado!", "El registro fue creado con éxito.!", "success");
                reset_form();
                //location = "{/literal}{$getModule}{literal}";
            } else if(responseText.accion == 'update') {
                swal("Actualizado!", "El registro fue actualizado con éxito.!", "success");
                //location = "{/literal}{$getModule}{literal}";
            }
            //table_list.draw();
        } else if (responseText.res ==2) {
            swal("Ocurrió un error!", responseText.msg, "error")
        } else {
            swal("ocurrió un error!", responseText.msg, "danger")
        }
    };

    var getMunicipios = function () {
        var macroId = cboMacroId.val();
        cboMunicipioId.empty();
        if(macroId!="") {
            $.post("{/literal}{$getModule}{literal}&accion=general_getMunicipios"
                , {macroId: macroId}
                , function (respuesta, textStatus, jqXHR) {
                    selOption = $('<option></option>');
                    cboMunicipioId.append(selOption.attr("value", "").text("-- Seleccione una opción --"));
                    for (var clave in respuesta) {
                        cboMunicipioId.append($('<option></option>').attr("value", respuesta[clave].itemId).text(respuesta[clave].nombre));
                    }
                    if (type == 'update') {
                        cboMunicipioId.val(itemsMunicipio).trigger('change');
                    }
                }
                , 'json');
        } else {
            cboMunicipioId.append($('<option></option>').attr("value", "").text("--Seleccione una opción--"));
        }
    };

    var escalarTamanoImagen = function(escala, ancho, alto) {
        var ANCHO_MAX = ALTO_MAX = escala;
        if (ancho > alto) {
            if (ancho > ANCHO_MAX) {
                alto *= ANCHO_MAX/ancho;
                ancho = ANCHO_MAX;
            }
        } else {
            if (alto > ALTO_MAX) {
                ancho *= ALTO_MAX/alto;
                alto = ALTO_MAX;
            }
        }
        return {ancho: Math.round(ancho), alto: Math.round(alto)};
    };

    var mostrarImagen = function() {
        var imgAncho = "{/literal}{$itemAdjunto.adjunto_ancho}{literal}";
        var imgAlto = "{/literal}{$itemAdjunto.adjunto_alto}{literal}";
        if (imgAncho != '' && imgAlto != '') {
            var tamano = escalarTamanoImagen(350, imgAncho, imgAlto);
            imgVistaPrevia.width = tamano.ancho;
            imgVistaPrevia.height = tamano.alto;
        }
    };

    var reset_form = function() {
        general_form.trigger("reset");
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

    var handle_form_submit=function() {
        general_form.ajaxForm(options);
    };

    var handle_general_form_submit = function() {
        general_btn_submit.click(function(e) {
            e.preventDefault();
            var btn = $(this);
            var form = $(this).closest('form');

            form.validate({
                rules: {
                    "item[nombre]": {
                        required: true,
                        minlength: 1
                    }
                }
            });

            if (!form.valid()) {
                return;
            }

            general_form.submit();
        });
    };

    var handle_general_components = function() {
        $('.select2').select2({
            placeholder: "Seleccione una opción"
        });

        $('.summernote').summernote({
            height: 150
        });

        if (type == 'update') {
            mostrarImagen();
        }
    };

    var handle_get_components = function() {
        cboMacroId.change(function() {
            getMunicipios();
        });

        if (cboMacroId.val() != '') {
            getMunicipios();
        }

        $("select").closest("form").on("reset",function(ev){
            var targetJQForm = $(ev.target);
            setTimeout((function(){
                this.find("select").trigger("change");
            }).bind(targetJQForm),0);
        });

        $("#btnBack").on("click", function() {
            window.open("{/literal}{$getModule}{literal}&smodule=especies", "_parent");
        });
    }

    //== Public Functions
    return {
        // public functions
        init: function() {
            handle_general_form_submit();
            handle_form_submit();
            handle_general_components();
            handle_get_components();
        }
    };
} ();

//== Class Initialization
jQuery(document).ready(function() {
    snippet_general_form.init();
});
</script>
{/literal}