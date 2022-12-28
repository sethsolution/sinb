{literal}
<script>
var snippet_general_form = function() {
    var idficha = '{/literal}{$adjId}{literal}';
    var type = '{/literal}{$type}{literal}';
    var general_form = $('#general_form');
    var general_btn_submit = $('#general_submit');
    var fileArchivoAdjunto = document.getElementById('fileArchivoAdjunto');
    var imgVistaPrevia = document.getElementById('imgVistaPrevia');
    var imgContenedor = document.getElementById('imgContenedor');

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
        var imgAncho = $('#txtImgAncho').val();
        var imgAlto = $('#txtImgAlto').val();
        if (imgAncho != '' && imgAlto != '') {
            var tamano = escalarTamanoImagen(350, imgAncho, imgAlto);
            imgVistaPrevia.width = tamano.ancho;
            imgVistaPrevia.height = tamano.alto;
            imgContenedor.style.display = 'block';
        }
    };

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
                table_list.draw();
                //location = "{/literal}{$getModule}{literal}";
            } else if(responseText.accion == 'update') {
                swal("Actualizado!", "El registro fue actualizado con éxito.!", "success");
                imgContenedor.style.display = 'none';
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

    var reset_form = function() {
        imgContenedor.style.display = 'none';
        $('#fileArchivoAdjunto').val('');
        $('.custom-file-label').html('Seleccione un archivo');
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
                    "item[descrip]": {
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

        imgContenedor.style.display = 'none';
    };

    var handle_get_components = function() {
        $("select").closest("form").on("reset",function(ev){
            var targetJQForm = $(ev.target);
            setTimeout((function(){
                this.find("select").trigger("change");
            }).bind(targetJQForm),0);
        });

        $('#fileArchivoAdjunto').on('change', function() {
            var archivo = fileArchivoAdjunto.files[0];
            var extension = archivo.name.slice(-4);
            $('.custom-file-label').html($('#fileArchivoAdjunto').val());
            if (extension == '.jpg' || extension == 'jpeg' || extension == '.png') {
                var reader = new FileReader();
                reader.onload = function (e) {
                    var image = new Image();
                    image.src = e.target.result;
                    image.onload = function() {
                        tamano = escalarTamanoImagen(350, image.width, image.height);
                        imgVistaPrevia.width = tamano.ancho;
                        imgVistaPrevia.height = tamano.alto;
                        imgVistaPrevia.src = image.src;
                        imgContenedor.style.display = 'block';
                        $('#txtImgAncho').val(tamano.ancho);
                        $('#txtImgAlto').val(tamano.alto);
                    };
                };
                reader.readAsDataURL(archivo);
            } else if (extension == '.pdf') {
                imgContenedor.style.display = 'none';
            } else {
                imgContenedor.style.display = 'none';
                archivo = null;
                $('#fileArchivoAdjunto').val('');
                $('.custom-file-label').html('Seleccione un archivo');
                swal('Advertencia!', 'No se pudo cargar el archivo, seleccione un archivo con alguno de estos formatos:<br> *.jpg | *.jpeg | *.png | *.pdf', 'warning');
            }
        });

    };

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