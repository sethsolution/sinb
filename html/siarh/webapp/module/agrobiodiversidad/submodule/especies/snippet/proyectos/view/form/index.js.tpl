{literal}
<script>
var snippet_general_form = function() {
    var idficha = '{/literal}{$proyId}{literal}';
    //var type = '{/literal}{$type}{literal}';
    var type = 'new';
    var general_form = $('#general_form');
    var general_btn_submit = $('#general_submit');

    var txtNombreProy = $('#txtNombreProy');
    var btnBuscar = $('#btnBuscar');
    var dlProyectos = $('#dlProyectos');

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
                //reset_form();
                table_list.draw();
                limpiarForm();
                //location = "{/literal}{$getModule}{literal}";
            } else if(responseText.accion == 'update') {
                swal("Actualizado!", "El registro fue actualizado con éxito.!", "success");
                table_list.draw();
                //location = "{/literal}{$getModule}{literal}";
            }
            //table_list.draw();
        } else if (responseText.res ==2) {
            swal("Ocurrió un error!", responseText.msg, "error")
        } else {
            swal("ocurrió un error!", responseText.msg, "danger")
        }
    };

    var getProyectos = function () {
        var buscaProy = txtNombreProy.val();
        var especieId = $('#txtEspecieId').val();
        dlProyectos.empty();
        dsProyectos = {};
        if(buscaProy!="") {
            $.post("{/literal}{$getModule}{literal}&accion=proyectos_getProyectos"
                , {buscaProy: buscaProy, especieId: especieId}
                , function (respuesta, textStatus, jqXHR) {
                    for (var clave in respuesta) {
                        dlProyectos.append($('<option></option>').attr("data-value", respuesta[clave].itemId).text(respuesta[clave].nombre));
                    }
                    txtNombreProy.val('');
                    txtNombreProy.focus();
                }
                , 'json');
        }
    };

    var limpiarForm = function() {
        txtNombreProy.val('');
        txtProyId.val('');
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
                    "item[espe_itemid]": {
                        required: true,
                        minlength: 1
                    },
                    "item[proy_itemid]": {
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
    };

    var handle_get_components = function() {
        $("select").closest("form").on("reset",function(ev){
            var targetJQForm = $(ev.target);
            setTimeout((function(){
                this.find("select").trigger("change");
            }).bind(targetJQForm),0);
        });

        txtNombreProy.bind('change', function () {
            var fuente = this.value;
            if (fuente != '') {
                dlProyectos.find("option").each(function() {
                    if ($(this).val() == fuente) {
                        $('#txtProyId').val($(this).attr('data-value'));
                        $(this).remove();
                    }
                });
            } else {
                $('#txtProyId').val('');
            }
        });

        btnBuscar.on('click', function () {
            if (txtNombreProy.val() != '') {
                getProyectos();
            }
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