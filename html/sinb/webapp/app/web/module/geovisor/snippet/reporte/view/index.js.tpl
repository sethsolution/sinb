{literal}
<script>
    var bgcolorHtml = [
        '#de1f0a',
        '#940fc9',
        '#0098fe',
        '#7dc400',
        '#ffcc00',
        '#dc7633',
        '#ff51f5',
        '#00d8ad',
        '#00eaff',
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
        'rgba(222, 31, 10, 1)',
        'rgba(148, 15, 201, 1)',
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


    var ctx = document.getElementById("chart_cantidad").getContext('2d');
    var chart_cantidad = new Chart(ctx, {
        type: 'doughnut',
        data: {
            labels: [
                {/literal}
                {foreach from=$data item=row key=idx}
                {if $idx != 0},{/if}"{$row.departamento}: {$row.total}"
                {/foreach}{literal}
            ],
            datasets: [{
                label: '# of Votes',
                data: [
                    {/literal}
                    {foreach from=$data item=row key=idx}
                    {if $idx != 0},{/if}{$row.total}
                    {/foreach}{literal}
                ],
                backgroundColor: bgcolorHtml,
                borderWidth: 1
            }]
        },
        options: {
            legend: {
                display: true,
                position: 'left',
                labels: {
                    boxWidth: 20,
                    fontSize: 12,
                    padding: 7
                }
            }
        }
    });



    var ctx_monto_dos = document.getElementById("chart_monto_dos").getContext('2d');
    var chart_monto_dos = new Chart(ctx_monto_dos, {
        type: 'horizontalBar',
        data: {
            labels: [
                {/literal}
                {foreach from=$data item=row key=idx}
                {if $idx != 0},{/if}"{$row.departamento}"
                {/foreach}{literal}
            ],
            datasets: [
                {
                    label: 'cerrado',
                    data: [
                        {/literal}
                        {foreach from=$data item=row key=idx}
                        {if $idx != 0},{/if}{$row.cerrado }
                        {/foreach}{literal}
                    ],
                    backgroundColor: '#440444',
                    borderWidth: 1
                },
                {
                    label: 'paralizado',
                    data: [
                        {/literal}
                        {foreach from=$data item=row key=idx}
                        {if $idx != 0},{/if}{$row.paralizado }
                        {/foreach}{literal}
                    ],
                    backgroundColor: '#90278d',
                    borderWidth: 1
                }
                ,
                {
                    label: 'debito',
                    data: [
                        {/literal}
                        {foreach from=$data item=row key=idx}
                        {if $idx != 0},{/if}{$row.debito }
                        {/foreach}{literal}
                    ],
                    backgroundColor: '#ff00f0',
                    borderWidth: 1
                }
                ,
                {
                    label: 'concluido',
                    data: [
                        {/literal}
                        {foreach from=$data item=row key=idx}
                        {if $idx != 0},{/if}{$row.concluido }
                        {/foreach}{literal}
                    ],
                    backgroundColor: '#006838',
                    borderWidth: 1
                }
                ,
                {
                    label: 'cancelado',
                    data: [
                        {/literal}
                        {foreach from=$data item=row key=idx}
                        {if $idx != 0},{/if}{$row.cancelado }
                        {/foreach}{literal}
                    ],
                    backgroundColor: '#bf0101',
                    borderWidth: 1
                }
                ,
                {
                    label: 'ejecucion',
                    data: [
                        {/literal}
                        {foreach from=$data item=row key=idx}
                        {if $idx != 0},{/if}{$row.ejecucion }
                        {/foreach}{literal}
                    ],
                    backgroundColor: '#32a9dd',
                    borderWidth: 1
                }
                ,
                {
                    label: 'programado',
                    data: [
                        {/literal}
                        {foreach from=$data item=row key=idx}
                        {if $idx != 0},{/if}{$row.programado }
                        {/foreach}{literal}
                    ],
                    backgroundColor: '#f5bb39',
                    borderWidth: 1
                }
                ,
                {
                    label: 'none',
                    data: [
                        {/literal}
                        {foreach from=$data item=row key=idx}
                        {if $idx != 0},{/if}{$row.none }
                        {/foreach}{literal}
                    ],
                    backgroundColor: '#a5a5a5',
                    borderWidth: 1
                }
            ]
        },
        options: {
            legend: {
                display: true,
                position: 'top',
                labels: {
                    boxWidth: 20,
                    fontSize: 12,
                    padding: 7
                }
            }
        }
    });


    var tipogd_0 = "#7b7e82"; // Otros
    var tipogd_1 = "#af25fe"; // Eólica
    var tipogd_2 = "#e6c50d"; // Fotovoltaica
    var tipogd_3 = "#0099fa"; // Hidro

    var ctx_gd_tipo_fuente_generacion = document.getElementById("chart_gd_tipo_fuente_generacion").getContext('2d');
    var chart_gd_tipo_fuente_generacion = new Chart(ctx_gd_tipo_fuente_generacion, {
        type: 'horizontalBar',
        data: {
            labels: [
                {/literal}
                {foreach from=$data item=row key=idx}
                {if $idx != 0},{/if}"{$row.departamento}"
                {/foreach}{literal}
            ],
            datasets: [

                {/literal}{foreach from=$data[0].fuente item=row key=idx}
                    {
                        label: '{$row.nombre}',
                        data: [
                        {foreach from=$data item=row2 key=idx2}
                        {if $idx2 != 0},{/if}{$row2.fuente[$idx].total }
                        {/foreach}],
                        backgroundColor: tipogd_{$idx},
                        borderWidth: 1
                    },
                {/foreach}{literal}
            ]
        },
        options: {
            legend: {
                display: true,
                position: 'top',
                labels: {
                    boxWidth: 20,
                    fontSize: 12,
                    padding: 7
                }
            }
        }
    });

</script>

{/literal}