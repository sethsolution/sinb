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

    var ctx = document.getElementById("macroregionChart").getContext('2d');
    var macroregionChart = new Chart(ctx, {
        type: 'pie',
        data: {
            labels: {/literal}{$etiquetas}{literal},
            datasets: [{
                label: 'Especies cultivados por departamento',
                data: {/literal}{$datos}{literal},
                backgroundColor: bgcolorRgb,
                borderWidth: 1
            }]
        },
        options: {
            legend: {
                display: true,
                position: 'bottom',
                labels: {
                    boxWidth: 20,
                    fontSize: 12,
                    padding: 7
                }
            }
        }
    });

    var ctx = document.getElementById("macroregionSupChart").getContext('2d');
    var macroregionSupChart = new Chart(ctx, {
        type: 'pie',
        data: {
            labels: {/literal}{$etiquetas}{literal},
            datasets: [{
                label: 'Especies cultivados por departamento',
                data: {/literal}{$datos_sup}{literal},
                backgroundColor: bgcolorRgb,
                borderWidth: 1
            }]
        },
        options: {
            legend: {
                display: true,
                position: 'bottom',
                labels: {
                    boxWidth: 20,
                    fontSize: 12,
                    padding: 7
                }
            }
        }
    });

    var ctx = document.getElementById("macroregionEspecieChart").getContext('2d');
    var macroregionEspecieChart = new Chart(ctx, {
        type: 'pie',
        data: {
            labels: {/literal}{$etiquetas_especie}{literal},
            datasets: [{
                label: 'Especies cultivados por departamento',
                data: {/literal}{$datos_especie}{literal},
                backgroundColor: bgcolorRgb,
                borderWidth: 1
            }]
        },
        options: {
            legend: {
                display: true,
                position: 'bottom',
                labels: {
                    boxWidth: 20,
                    fontSize: 12,
                    padding: 7
                }
            }
        }
    });

    jQuery(document).ready(function() {
        $("#btnImprimirReporte").on("click", function() {
            fnImprimirDiv("panelReporte");
        });
    });
</script>
{/literal}