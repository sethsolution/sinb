{literal}
<script>
var fn_cargar_shapefile;

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

    var showResponse = function(responseText, statusText) {
        general_btn_submit.removeClass('m-loader m-loader--right m-loader--light').attr('disabled', false);
        if (responseText.res == 1) {
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

    // BEGIN::FUNCIONES MANEJO DE SHAPEFILE
    var fn_obtener_extension = function(filename) {
		var extension = filename.split(".");
		return extension[extension.length-1];
	};

    fn_cargar_shapefile = function(event) {
		if (event.target.files[0].length != 0) {
			var extension = fn_obtener_extension(event.target.files[0].name);
			if (extension == "zip") {
                var archivo = event.target.files[0];
				JSZip.loadAsync(archivo)
                    .then(function(zip) {
                        var contador = 0;
                        zip.forEach(function (relativePath, zipEntry) {
                            var ext = fn_obtener_extension(zipEntry.name);
                            if (ext == "shp" || ext == "shx" || ext == "dbf" || ext == "prj") {
                                contador++;
                            }
                        });
                        if (contador < 4) {
                            document.getElementById(event.srcElement.id).value = null;
                            swal("Advertencia!", "El archivo no es un shapefile, no contiene los archivos correctos:<br>*.shp, *.shx, *.dbf, *.prj", "warning");
                        } else {
                            console.log("Shapefile cargado");
                        }
                    }, function (e) {
                        document.getElementById(event.srcElement.id).value = null;
                        swal("Advertencia!", "No se puede leer el archivo seleccionado.", "warning");
                    });
			} else {
				document.getElementById(event.srcElement.id).value = null;
				swal("Advertencia!", "El archivo seleccionado debe tener el formato *.zip", "warning");
			}
		}
  	};
    // END::FUNCIONES MANEJO DE SHAPEFILE

    var handle_general_components = function() {
        $('.select2').select2({
            placeholder: "Seleccione una opción"
        });

        $('.summernote').summernote({
            height: 150
        });
    };

    var handle_get_components = function() {
        
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