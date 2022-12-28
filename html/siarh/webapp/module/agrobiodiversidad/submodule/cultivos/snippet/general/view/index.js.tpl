{literal}
<script>
var snippet_general_form = function() {
    var idficha = '{/literal}{$id}{literal}';
    var type = '{/literal}{$type}{literal}';
    var general_form = $('#general_form');
    var general_btn_submit = $('#general_submit');
    var btnMostrarMapa = $('#btnMostrarMapa');
    var pnlUbicacion = $('#pnlUbicacion');

    var cboEspecieId = $('#cboEspecieId');
    var cboEcotipoId = $('#cboEcotipoId');
    var ecotipoId = '{/literal}{$item.ecotipo_itemid}{literal}';
    var cboVinculaId = $('#cboVinculaId');
    var cboClaseVinculaId = $('#cboClaseVinculaId');
    var claseVinculaId = '{/literal}{$item.clasevincula_itemid}{literal}';
    var pnlConservacion = $('#pnlConservacion');
    var pnlSuperficie = $('#pnlSuperficie');
    var pnlCodCertifica = $('#pnlCodCertifica');
    var pnlDensidadSiembra = $('#pnlDensidadSiembra');
    var pnlDestino = $('#pnlDestino');
    var pnlFliaBeneficiaria = $('#pnlFliaBeneficiaria');
    var pnlTransformacion = $('#pnlTransformacion');

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

    var getEcotipos = function () {
        var especieId = cboEspecieId.val();
        cboEcotipoId.empty();
        if(especieId!="") {
            $.post("{/literal}{$getModule}{literal}&accion=general_getEcotipos"
                , {especieId: especieId}
                , function (respuesta, textStatus, jqXHR) {
                    selOption = $('<option></option>');
                    cboEcotipoId.append(selOption.attr("value", "").text("-- Seleccione una opción --"));
                    for (var clave in respuesta) {
                        cboEcotipoId.append($('<option></option>').attr("value", respuesta[clave].itemId).text(respuesta[clave].nombre));
                    }
                    if (type == 'update') {
                        cboEcotipoId.val(ecotipoId).trigger('change');
                    }
                }
                , 'json');
        } else {
            cboEcotipoId.append($('<option></option>').attr("value", "").text("--Seleccione una opción--"));
        }
    };

    var getClasesVinculacion = function () {
        var vinculaId = cboVinculaId.val();
        cboClaseVinculaId.empty();
        if(vinculaId!="") {
            $.post("{/literal}{$getModule}{literal}&accion=general_getClasesVinculacion"
                , {vinculaId: vinculaId}
                , function (respuesta, textStatus, jqXHR) {
                    selOption = $('<option></option>');
                    cboClaseVinculaId.append(selOption.attr("value", "").text("-- Seleccione una opción --"));
                    for (var clave in respuesta) {
                        cboClaseVinculaId.append($('<option></option>').attr("value", respuesta[clave].itemId).text(respuesta[clave].nombre));
                    }
                    if (type == 'update') {
                        cboClaseVinculaId.val(claseVinculaId).trigger('change');
                    }
                }
                , 'json');
        } else {
            cboClaseVinculaId.append($('<option></option>').attr("value", "").text("--Seleccione una opción--"));
        }
    };

    var limpiarConservacion = function() {
        $('#cboEspeMainId').val(null).trigger('change');
        $('#txtCantidad').val('');
        $('#cboUnidadMedida').val(null).trigger('change');
        $('#txtEspeAdicional').val('');
    };

    var limpiarPlanesManejoCertificacion = function() {
        $('#txtSuperficieAmplia').val('');
        $('#txtSuperficie').val('');
        $('#txtCodCertificacion').val('');
        $('#txtDensidad').val('');
        $('#cboUnidadMedidaDensidad').val(null).trigger('change');
        $('#txtCantRecolectada').val('');
        $('#txtDestinoConserva').val('');
        $('#txtDestinoAutoconsumo').val('');
        $('#txtDestinoComercia').val('');
        $('#txtPrecioComercia').val('');
        $('#txtCantFlias').val('');
    };

    var limpiarSiembraRecoleccion = function() {
        $('#txtSuperficieAmplia').val('');
        $('#txtSuperficie').val('');
        $('#txtDensidad').val('');
        $('#cboUnidadMedidaDensidad').val(null).trigger('change');
        $('#txtCantRecolectada').val('');
        $('#txtDestinoConserva').val('');
        $('#txtDestinoAutoconsumo').val('');
        $('#txtDestinoComercia').val('');
        $('#txtPrecioComercia').val('');
    };

    var limpiarTransformacion = function() {
        $('#txtCantMateria').val('');
        $('#txtProducto').val('');
        $('#txtCantProducto').val('');
        $('#txtPrecioProduccion').val(null).trigger('change');
        $('#txtPrecioVenta').val('');
        $('#txtOperarios').val('');
    };

    var mostrarPaneles = function() {
        switch(cboVinculaId.val()) {
            case '1':
                limpiarPlanesManejoCertificacion();
                limpiarSiembraRecoleccion();
                limpiarTransformacion();
                pnlSuperficie.hide();
                pnlCodCertifica.hide();
                pnlDensidadSiembra.hide();
                pnlDestino.hide();
                pnlFliaBeneficiaria.hide();
                pnlTransformacion.hide();
                pnlConservacion.show();
                break;
            case '2':
                limpiarConservacion();
                limpiarTransformacion();
                pnlConservacion.hide();
                pnlTransformacion.hide();
                pnlCodCertifica.show();
                pnlSuperficie.show();
                pnlDensidadSiembra.show();
                pnlDestino.show();
                pnlFliaBeneficiaria.show();
                break;
            case '3':
                limpiarConservacion();
                limpiarTransformacion();
                pnlConservacion.hide();
                pnlTransformacion.hide();
                pnlCodCertifica.hide();
                pnlFliaBeneficiaria.hide();
                pnlSuperficie.show();
                pnlDensidadSiembra.show();
                pnlDestino.show();
                break;
            case '4':
                limpiarConservacion();
                limpiarPlanesManejoCertificacion();
                limpiarSiembraRecoleccion();
                pnlConservacion.hide();
                pnlCodCertifica.hide();
                pnlFliaBeneficiaria.hide();
                pnlSuperficie.hide();
                pnlDensidadSiembra.hide();
                pnlDestino.hide();
                pnlTransformacion.show();
                break;
            default:
                limpiarConservacion();
                limpiarPlanesManejoCertificacion();
                limpiarSiembraRecoleccion();
                limpiarTransformacion();
                pnlConservacion.hide();
                pnlCodCertifica.hide();
                pnlFliaBeneficiaria.hide();
                pnlSuperficie.hide();
                pnlDensidadSiembra.hide();
                pnlDestino.hide();
                pnlTransformacion.hide();
                break;
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

    var fnMostrarPanelUbicacion = function() {
        pnlUbicacion.show();
    };

    var fnOcultarPanelUbicacion = function() {
        pnlUbicacion.hide();
    };

    var handle_general_form_submit = function() {
        general_btn_submit.click(function(e) {
            e.preventDefault();
            var btn = $(this);
            var form = $(this).closest('form');

            form.validate({
                rules: {
                    "item[espe_itemid]": {
                        required: true,
                        minlength: 1
                    },
                    "item[plan_namejo]": {
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

        if (type == 'new') {
            fnOcultarPanelUbicacion();
        }

        pnlConservacion.hide();
        pnlSuperficie.hide();
        pnlCodCertifica.hide();
        pnlDensidadSiembra.hide();
        pnlDestino.hide();
        pnlFliaBeneficiaria.hide();
        pnlTransformacion.hide();
    };

    var handle_get_components = function() {
        $("select").closest("form").on("reset",function(ev){
            var targetJQForm = $(ev.target);
            setTimeout((function(){
                this.find("select").trigger("change");
            }).bind(targetJQForm),0);
        });

        btnMostrarMapa.on('click', function() {
            $('#modal_mapa').modal('show');
        });

        cboEspecieId.on('change', function() {
            getEcotipos();
        });

        cboVinculaId.on('change', function() {
            mostrarPaneles();
            getClasesVinculacion();
        });

        if (type == 'update') {
            cboEspecieId.trigger('change');
            cboVinculaId.trigger('change');
        }
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