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
            table_list = $('#tabla_{/literal}{$subcontrol}{literal}').DataTable({
                initComplete: function(settings, json) {
                    $('#tabla_{/literal}{$subcontrol}{literal}').removeClass('m--hide');
                },
                responsive: false,
                keys: {

                    columns: exporta_columnas,
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
                    {extend:'colvis',text:'Ver'
                        ,columnText: function ( dt, idx, title ) {
                            return (idx+1)+': '+title;
                        }
                    },
                    {extend:'excelHtml5'
                        ,exportOptions: {columns: exporta_columnas}
                        , title: exporta_titulo
                    },
                    {extend:'pdfHtml5'
                        ,exportOptions: {columns: exporta_columnas}
                        , title: exporta_titulo
                        , download: 'open'
                        , orientation: 'landscape'
                        , pageSize: 'LETTER'
                        ,customize: function(doc) {
                            doc.styles.tableHeader.fontSize = 7;
                            doc.defaultStyle.fontSize = 7;
                            doc.pageMargins= [ 20, 20];
                        }
                    },

                ],

                language: {"url": "/language/datatable.spanish.json"},
                lengthMenu: [[10, 25, 50,-1], [10, 25, 50, "Todos"]],
                pageLength: 25,
               // order: [[ 0, "asc" ]], // Por que campo ordenara al momento de desplegar
                InfoFiltered:     false,
                searchDelay: 500,
                processing: true,
                scrollX: true,
                columnDefs: [
                    {
                        targets: 0,
                        width: "100px",
                        //className: 'noExport',
                        //orderable: false,
                        //visible: false,
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

    //console.log(bgcolorRgb);
    var ctx_monto_dos = document.getElementById("chart_cantidad").getContext('2d');
    var chart_monto_dos = new Chart(ctx_monto_dos, {
        type: 'bar',
        data: {
            labels: [
                {/literal}
                {foreach from=$lista.anios item=row key=idx}
                {if $idx != 0},{/if}"{$row}"
                {/foreach}
                {literal}
            ],
            datasets: [

                {/literal}
                {foreach from=$lista.especies item=row key=idx}
                {if $idx != 0},{/if}
                    {
                    label: '{$row.nombre_comun} - {$row.nombre}',
                    data: [
                        {foreach from=$lista.resultado item=dato key=idx2}
                        {if $idx2 != 0},{/if}'{$dato[$row.itemId]|string_format:'%.0f'}'
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
            }
        }
    });

</script>
{/literal}