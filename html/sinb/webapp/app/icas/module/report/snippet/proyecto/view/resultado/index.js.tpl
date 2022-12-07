{literal}
<script>
    var table_list;

    var snippet_datatable_list = function () {

        $.fn.dataTable.Api.register('column().title()', function() {
            return $(this.header()).text().trim();
        });


        var exporta_titulo = "CITES - REPORTE ANUAL BOLIVIA";
        var exporta_columnas = [':visible :not(.noExport)' ];

        var initTable1 = function() {
            // begin first table
            let table_list_var = $('#tabla_{/literal}{$subcontrol}{literal}');
            let export_title = "{/literal}{#dataTableExportTitle#}{literal}";
            let noExport = tableSetting.noExport;
            table_list = table_list_var.DataTable({
                initComplete: function(settings, json) {
                    table_list_var.removeClass('d-none');
                },

                keys: {
                    columns: noExport,
                    clipboard: false,
                },

                colReorder: true,
                //== Pagination settings
                dom:
                    "<'row'<'col-sm-12 col-md-12 dataTables_pager'lp>>" +
                    `<'row'<'col-sm-5 text-left'f><'col-sm-7 text-right'B>>
			         <'row'<'col-sm-12'tr>>
                     <'row'<'col-sm-12 col-md-5'i><'col-sm-12 col-md-7 dataTables_pager'lp>>`,
                buttons: [
                    {extend:'colvis',text:lngUyuni.dataTableWatch
                        ,columnText: function ( dt, idx, title ) {
                            return (idx+1)+': '+title;
                        }
                    },
                    {extend:'excelHtml5'
                        ,exportOptions: {columns: noExport}
                        , title: export_title
                    },
                    {extend:'pdfHtml5'
                        ,exportOptions: {columns: noExport}
                        , title: export_title
                        , download: 'open'

                        , pageSize: 'LETTER'
                        ,customize: function(doc) {
                            doc.styles.tableHeader.fontSize = 7;
                            doc.defaultStyle.fontSize = 7;
                            doc.pageMargins= [ 20, 20];
                        }
                    },
                    {extend:'print'
                        ,exportOptions: {columns: noExport}
                        ,text: lngUyuni.dataTablePrint
                    }

                ],
                responsive: false,
                language: {"url": "/language/js/datatable."+lng+".json"},
                lengthMenu: [[10, 25, 50,-1], [10, 25, 50, lngUyuni.dataTableAll]],
                pageLength: -1,
                order: [[ 0, "asc" ],[ 1, "asc" ]], // Por que campo ordenara al momento de desplegar
                InfoFiltered:     false,
                searchDelay: 500,
                processing: true,
                scrollX: true,

                rowGroup: {
                    dataSrc: [0]
                },

                columnDefs: [
                    {
                        targets: 0,
                        visible:false,
                    },
                    {
                        targets: 1,
                        orderData: [0,1],
                    },
                    {
                        targets: 2,
                        orderData: [0,2],
                        width: "100px",
                    },
                ],
            });

        };

        return {
            //main function to initiate the module
            init: function() {
                initTable1();
            },

        };

    }();

    jQuery(document).ready(function() {
        snippet_datatable_list.init();
    });


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
    {/literal}
    {if $res.total >0}
    {literal}
    //console.log(bgcolorRgb);
    var ctx_monto_dos = document.getElementById("chart_cantidad").getContext('2d');
    var chart_monto_dos = new Chart(ctx_monto_dos, {
        type: 'bar',
        data: {
            labels: [
                {/literal}
                {foreach from=$res.tipo item=row key=idx}
                {if $idx != 0},{/if}"{$row.area}"
                {/foreach}
                {literal}
            ],
            datasets: [
                {/literal}
                {foreach from=$res.dato item=row key=idx}
                {if $idx != 0},{/if}
                {
                    label: '{$row.nombre}',
                    data: [
                        {foreach from=$row.area item=dato key=idx2}
                        {if $idx2 != 0},{/if}'{$dato.total}'
                        {/foreach}
                    ],
                    backgroundColor: bgcolorRgb[{$idx}+2],
                    borderWidth: 1
                }
                {/foreach}
                {literal}
            ]
        },
        options: {
            responsive: true,
            legend: {
                display: true,
                position: 'top',
                labels: {
                    boxWidth: 20,
                    fontSize: 11,
                    padding: 7
                }
            },
            scales: {
                x: {
                    stacked: true,
                },
                y: {
                    stacked: true
                }
            }
        }
    });


    /**
     * Tipo proyecto
     */

    var ctx_monto_dos = document.getElementById("chart_tipoproyecto").getContext('2d');
    var chart_monto_dos = new Chart(ctx_monto_dos, {
        type: 'bar',
        data: {
            labels: [
                {/literal}
                {foreach from=$res.tipoProyecto.tipo item=row key=idx}
                {if $idx != 0},{/if}"{$row.tipo_proyecto}"
                {/foreach}
                {literal}
            ],
            datasets: [
                {/literal}
                {foreach from=$res.tipoProyecto.years item=row key=idx}
                {if $idx != 0},{/if}
                {
                    label: '{$row.year}',
                    data: [
                        {foreach from=$row.tipo item=dato key=idx2}
                        {if $idx2 != 0},{/if}'{$dato.total}'
                        {/foreach}
                    ],
                    backgroundColor: bgcolorRgb[{$idx}+2],
                    borderWidth: 1
                }
                {/foreach}
                {literal}
            ]
        },
        options: {
            responsive: true,
            legend: {
                display: true,
                position: 'top',
                labels: {
                    boxWidth: 20,
                    fontSize: 11,
                    padding: 7
                }
            },
            scales: {
                x: {
                    stacked: true,
                },
                y: {
                    stacked: true
                }
            }
        }
    });


    var ctx = document.getElementById("chart_departamento").getContext('2d');
    var chart_cantidad = new Chart(ctx, {
        type: 'doughnut',
        data: {
            labels: [
                {/literal}
                {foreach from=$res.departamento item=row key=idx}
                {if $idx != 0},{/if}"{$row.departamento}: {$row.total}"
                {/foreach}{literal}
            ],
            datasets: [{
                label: '# of Votes',
                data: [
                    {/literal}
                    {foreach from=$res.departamento item=row key=idx}
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

    {/literal}
    {/if}
    {literal}
</script>
{/literal}