{literal}
<script>

    var table_list_ingreso;
    var snippet_datatable_list_ingreso = function () {

        $.fn.dataTable.Api.register('column().title()', function() {
            return $(this.header()).text().trim();
        });

        var initTable = function() {
            // begin first table
            let table_list_var = $('#tabla_ingreso_{/literal}{$subcontrol}{literal}');
            let export_title = "{/literal}{#dataTableExportTitle#}{literal}";
            let noExport = tableSetting.noExport;
            table_list_ingreso = table_list_var.DataTable({
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
                order: [[ 0, "asc" ]], // Por que campo ordenara al momento de desplegar
                InfoFiltered:     false,
                searchDelay: 500,
                processing: true,
                scrollX: true,
                columnDefs: [
                    {
                        targets: [0,1,2,3,4],
                        width: "100px",
                    },
                ],
            });

        };

        return {
            //main function to initiate the module
            init: function() {
                initTable();
            },

        };

    }();

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
                    {
                        targets: 3,
                        orderData: [0,3],
                        width: "100px",
                    },
                    {
                        targets: 4,
                        orderData: [0,4],
                        width: "100px",
                    },
                    {
                        targets: 5,
                        orderData: [0,5],
                        width: "100px",
                    },
                    {
                        targets: 6,
                        orderData: [0,6],
                        width: "100px",
                    },
                    {
                        targets: 7,
                        orderData: [0,7],
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
        snippet_datatable_list_ingreso.init();
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

    /**var ctx_monto_dos = document.getElementById("chart_cantidad").getContext('2d');
    var chart_monto_dos = new Chart(ctx_monto_dos, {
        type: 'bar',
        data: {
            labels: [
                {/literal}
                {foreach from=$res.ingreso item=row key=idx}
                {if $idx != 0},{/if}"{$row.anio}"
                {/foreach}
                {literal}
            ],
            datasets: [
                {/literal}
                {foreach from=$res.dato item=row key=idx}
                {if $idx != 0},{/if}
                {
                    label: '{$row.fibra}',
                    data: [
{*                        {foreach from=$row.anio item=dato key=idx2}*}
{*                            {if $idx2 != 0},{/if}'{$dato.total_braga}'*}
{*                                            ,'{$dato.total_vellon}'*}
{*                        {/foreach}*}
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
    });*/

</script>
{/literal}