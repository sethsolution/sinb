{literal}
<script>
    var snippet_button_update = function() {
        var formMain = $('#formMain');
		
		var downloadReporteTecnico = function(proy_id, fecha_inicio, fecha_final) {
			var url = '{/literal}{$getModule}{literal}&accion=downloadReporteTecnico&proy_id='+proy_id+"&fecha_inicio="+fecha_inicio+"&fecha_final="+fecha_final;
            window.open(url, "_blank");
		};

        var downloadReporteGeneral = function(fecha_inicio, fecha_final) {
			var url = '{/literal}{$getModule}{literal}&accion=downloadReporteGeneral&fecha_inicio='+fecha_inicio+"&fecha_final="+fecha_final;
            window.open(url, "_blank");
		};

        var showReporteMetas = function(proy_id) {
            //var url = '?module=agrobiodiversidad&smodule=proyectos&accion=metas_verResumen&id='+proy_id;
            var url = '{/literal}{$getModule}{literal}&accion=downloadReporteMetas&proy_id='+proy_id;
            $.get(url, function(respuesta) {
                mostrarResultadoMetas(respuesta);
            });
		};

        var mostrarPanelFechas = function() {
            $("#pnlFechas").show();
        };

        var ocultarPanelFechas = function() {
            $("#pnlFechas").hide();
        };

        var mostrarPanelProyecto = function() {
            $("#pnlProyecto").show();
        };

        var ocultarPanelProyecto = function() {
            $("#pnlProyecto").hide();
        };

        var mostrarResultadoMetas = function(resultado) {
            $("#pnlReporteMetas").html(resultado);
        }

        var limpiarResultadoMetas = function() {
            $("#pnlReporteMetas").html("");
        }
		
        var handle_button_update = function() {
            formMain.submit(function(e) {
                var proy_id = $("#cboProyId").val();
                var fecha_inicio = $("#txtFechaInicio").val();
                var fecha_final = $("#txtFechaFinal").val();
                switch($("#cboTipoId").val()) {
                    case '1':
                        limpiarResultadoMetas();
                        downloadReporteTecnico(proy_id, fecha_inicio, fecha_final);
                        break;
                    case '2':
                        limpiarResultadoMetas();
                        downloadReporteGeneral(fecha_inicio, fecha_final);
                        break;
                    case '3':
                        limpiarResultadoMetas();
                        showReporteMetas(proy_id);
                        break;
                }
                e.preventDefault();
            });

            $("#cboTipoId").on("change", function() {
                switch($(this).val()) {
                    case "1":
                        $("#cboProyId").attr("required", "true");
                        mostrarPanelProyecto();
                        $("#txtFechaInicio").attr("required", "true");
                        $("#txtFechaFinal").attr("required", "true");
                        mostrarPanelFechas();
                        break;
                    case "2":
                        $("#cboProyId").removeAttr("required");
                        ocultarPanelProyecto();
                        $("#txtFechaInicio").attr("required", "true");
                        $("#txtFechaFinal").attr("required", "true");
                        mostrarPanelFechas();
                        break;
                    case "3":
                        $("#cboProyId").attr("required", "true");
                        mostrarPanelProyecto();
                        $("#txtFechaInicio").removeAttr("required");
                        $("#txtFechaFinal").removeAttr("required");
                        ocultarPanelFechas();
                        break;
                }
            });

            $("#btnCancelar").on("click", function() {
                limpiarResultadoMetas();
                $("#cboTipoId").val(null).trigger("change");
                $("#cboProyId").val(null).trigger("change");
            });
        }

        var handle_general_components = function() {
            $('.select2').select2({
                placeholder: "Seleccione una opción"
            });
        };
		
        return {
            // public functions
            init: function() {
                handle_button_update();
                handle_general_components();

                ocultarPanelFechas();
                ocultarPanelProyecto();
            }
        };
    }();

    jQuery(document).ready(function() {
        snippet_button_update.init();
    });
</script>
{/literal}