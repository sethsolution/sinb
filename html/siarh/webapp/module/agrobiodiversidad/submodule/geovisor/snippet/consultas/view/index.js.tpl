{literal}
<script>
    var bgcolorHtml = [
        '#cd6155',
        '#a569bd',
        '#5499c7',
        '#45b39d',
        '#f4d03f',
        '#dc7633',
        '#af7ac5',
        '#ec7063',
        '#5dade2',
        '#48c9b0',
        '#f5b041',
        '#58d68d',
        '#eb984e',
        '#52be80',

        '#cd6155',
        '#a569bd',
        '#5499c7',
        '#45b39d',
        '#f4d03f',
        '#dc7633',
        '#af7ac5',
        '#ec7063',
        '#5dade2',
        '#48c9b0',
        '#f5b041',
        '#58d68d',
        '#eb984e',
        '#52be80' 
    ];

    var bgcolorRgb = [
        'rgba(205, 97, 85, 1)',
        'rgba(165, 105, 189, 1)',
        'rgba(84, 153, 199, 1)',
        'rgba(69, 179, 157, 1)',
        'rgba(244, 208, 63, 1)',
        'rgba(220, 118, 51, 1)',
        'rgba(175, 122, 197, 1)',
        'rgba(236, 112, 99, 1)',
        'rgba(93, 173, 226, 1)',
        'rgba(72, 201, 176, 1)',
        'rgba(245, 146, 65, 1)',
        'rgba(88, 214, 141, 1)',
        'rgba(235, 152, 78, 1)',
        'rgba(82, 190, 128, 1)',

        'rgba(205, 97, 85, 1)',
        'rgba(165, 105, 189, 1)',
        'rgba(84, 153, 199, 1)',
        'rgba(69, 179, 157, 1)',
        'rgba(244, 208, 63, 1)',
        'rgba(220, 118, 51, 1)',
        'rgba(175, 122, 197, 1)',
        'rgba(236, 112, 99, 1)',
        'rgba(93, 173, 226, 1)',
        'rgba(72, 201, 176, 1)',
        'rgba(245, 146, 65, 1)',
        'rgba(88, 214, 141, 1)',
        'rgba(235, 152, 78, 1)',
        'rgba(82, 190, 128, 1)'
    ];

    var ctx = document.getElementById("deptoChart").getContext('2d');
    var deptoChart = new Chart(ctx, {
        type: 'pie',
        data: {
            labels: {/literal}{$pozosEtiquetas}{literal},
            datasets: [{
                label: '# of Votes',
                data: {/literal}{$pozosDatos}{literal},
                backgroundColor: bgcolorRgb,
                borderWidth: 1
            }]
        },
        options: {
            legend: {
                display: true,
                position: 'right',
                labels: {
                    boxWidth: 20,
                    fontSize: 12,
                    padding: 7
                }
            }
        }
    });

    var ctx = document.getElementById("pozosEpsasChart").getContext('2d');
    var pozosEpsasChart = new Chart(ctx, {
        type: 'pie',
        data: {
            labels: {/literal}{$epsasEtiquetas}{literal},
            datasets: [{
                label: '# of Votes',
                data: {/literal}{$epsasDatos}{literal},
                backgroundColor: bgcolorRgb,
                borderWidth: 1
            }]
        },
        options: {
            legend: {
                display: true,
                position: 'right',
                labels: {
                    boxWidth: 20,
                    fontSize: 12,
                    padding: 7
                }
            }
        }
    });

    var ctx = document.getElementById("manantialChart").getContext('2d');
    var manantialChart = new Chart(ctx, {
        type: 'pie',
        data: {
            labels: {/literal}{$manantialEtiquetas}{literal},
            datasets: [{
                label: '# of Votes',
                data: {/literal}{$manantialDatos}{literal},
                backgroundColor: bgcolorRgb,
                borderWidth: 1
            }]
        },
        options: {
            legend: {
                display: true,
                position: 'right',
                labels: {
                    boxWidth: 20,
                    fontSize: 12,
                    padding: 7
                }
            }
        }
    });

    var ctx = document.getElementById("geofisicaChart").getContext('2d');
    var geofisicaChart = new Chart(ctx, {
        type: 'pie',
        data: {
            labels: {/literal}{$geofisicaEtiquetas}{literal},
            datasets: [{
                label: '# of Votes',
                data: {/literal}{$geofisicaDatos}{literal},
                backgroundColor: bgcolorRgb,
                borderWidth: 1
            }]
        },
        options: {
            legend: {
                display: true,
                position: 'right',
                labels: {
                    boxWidth: 20,
                    fontSize: 12,
                    padding: 7
                }
            }
        }
    });

    var snippet_descarga_nacional = function () {
        var btn_descargar_pozos_excel = $('#btn_descargar_pozos_excel');

        var get_descargar_excel = function() {
            var url = "{/literal}{$getModule}{literal}&accion=nacional_getDescargarPozosExcel";
            window.open(url, '_blank');
        };

        var handle_general_components = function(){
            /*$('.select2').select2({
                placeholder: "Seleccione una opción"
            });*/
        };

        var handle_get_components = function() {
            btn_descargar_pozos_excel.click(function() {
                get_descargar_excel();
            });
        };

        return {
            //main function to initiate the module
            init: function() {
                handle_general_components();
                handle_get_components();
            },
        };
    }();

    jQuery(document).ready(function() {
        snippet_descarga_nacional.init();
    });
</script>
{/literal}