{literal}
<script>
    var table_list;

    var snippet_datatable_list = function () {

        $.fn.dataTable.Api.register('column().title()', function() {
            return $(this.header()).text().trim();
        });

        var exporta_columnas = [':visible :not(.noExport)' ];

        var initTable1 = function() {
            // begin first table
            table_list = $('#tabla_{/literal}{$subcontrol}{literal}').DataTable({
                initComplete: function(settings, json) {
                    $('#tabla_{/literal}{$subcontrol}{literal}').removeClass('m--hide');
                },
                responsive: true,
                keys: {

                    columns: exporta_columnas,
                    clipboard: false,
                },

                colReorder: true,
                //== Pagination settings
                dom:
                    `<'row'<'col-sm-12 col-md-12 dataTables_pager'lp>>
                <'row'<'col-sm-12'tr>>
                <'row'<'col-sm-12 col-md-5'i>>`,
                // read more: https://datatables.net/examples/basic_init/dom.html
                //language: {"url": "language/datatable.spanish.json?id=3434"},
                language: {"url": "/config/language/datatable.spanish.json"},
                lengthMenu: [ 10, 25, 50],
                pageLength: 25,
                order: [[ 1, "asc" ]], // Por que campo ordenara al momento de desplegar
                InfoFiltered:     false,
                searchDelay: 500,
                processing: true,
                serverSide: true,
                ajax: {
                    url: '{/literal}{$path_url}/{$subcontrol}_/{$id}/lista{literal}',
                    type: 'POST',
                    data: {},
                },
                columns: [
                    {/literal}
                    {foreach from=$grill_list item=row key=idx}
                        {literal}{data: '{/literal}{if $row.as}{$row.as}{else}{$row.field}{/if}{literal}'} ,{/literal}
                    {/foreach}
                    {literal}
                ],
                columnDefs: [
                    {
                        targets: 0,
                        width: "100px",
                        className: 'noExport',
                        orderable: false,

                        render: function(data, type, full, meta) {
                            var boton = '';
                            boton += '<div class="btn-group btn-group-sm " role="group" aria-label="Default button group">';
                            boton += '<a href="/cites/cites/'+data+'" target="_blank" class="btn btn-outline-info" title="Modificar">Ver Solicitud</a>';
                            boton += '<div>';
                            return boton;
                        },
                    },

                    {
                        targets: [6],
                        className:"text-center",
                        render: function(data, type, full, meta) {
                            var status = {
                                'Sustituido': {'estilo': 'estado-sustituido'},
                                'Registrado Oficialmente': {'estilo': 'estado-registrado-oficial'},
                                'Registrado': {'estilo': 'estado-registrado'},
                                'En Proceso de Validación': {'estilo': 'estado-validacion'},
                                'Observado': {'estilo': 'estado-observado'},

                            };
                            if (typeof status[data] === 'undefined') {
                                return data;
                            }

                            return '<span class="m-badge  m-badge--wide '+ status[data].estilo+' " >' +data+'</span>';
                        },
                    },
                    {
                        targets: [7],
                        render: function(data, type, full, meta) {
                            var status = {
                                1: {'title': '', 'state': 'secondary'},
                                3: {'title': 'SI', 'state': 'success'},
                                4: {'title': 'SI', 'state': 'success'},
                                5: {'title': '', 'state': 'secondary'},
                                2: {'title': 'SI', 'state': 'success'},
                                7: {'title': 'SI', 'state': 'success'}
                            };
                            if (typeof status[data] === 'undefined') {
                                return data;
                            }

                            /* return '<span class="m-badge m-badge--' + status[data].state + ' info m-badge--wide"></span>&nbsp;' +
                                 '<span class="m--font-bold m--font-' + status[data].state + '">' + status[data].title + '</span>';
 */
                            return '<i class="fa fa-check-circle text-' + status[data].state + '"></i>&nbsp;' +
                                '<span class="m--font-bold m--font-' + status[data].state + '">' + status[data].title + '</span>';
                        },
                    },
                    {
                        targets: [8],
                        render: function(data, type, full, meta) {
                            var status = {
                                1: {'title': '', 'state': 'secondary'},
                                2: {'title': '', 'state': 'secondary'},
                                3: {'title': '', 'state': 'secondary'},
                                5: {'title': '', 'state': 'secondary'},
                                4: {'title': 'SI', 'state': 'success'},
                                7: {'title': 'SI', 'state': 'success'}
                            };
                            if (typeof status[data] === 'undefined') {
                                return data;
                            }
                            return '<i class="fa fa-check-circle text-' + status[data].state + '"></i>&nbsp;' +
                                '<span class="m--font-bold m--font-' + status[data].state + '">' + status[data].title + '</span>';
                        },
                    },
                    {
                        targets: [9],
                        render: function(data, type, full, meta) {
                            var status = {
                                1: {'title': '', 'state': 'secondary'},
                                2: {'title': '', 'state': 'secondary'},
                                4: {'title': '', 'state': 'secondary'},
                                5: {'title': '', 'state': 'secondary'},
                                3: {'title': 'SI', 'state': 'danger'},
                                7: {'title': '', 'state': 'secondary'}
                            };
                            if (typeof status[data] === 'undefined') {
                                return data;
                            }

                            return '<i class="fa fa-exclamation text-' + status[data].state + '"></i>&nbsp;' +
                                '<span class="m--font-bold m--font-' + status[data].state + '">' + status[data].title + '</span>';

                            /*  dato = '<a href="javascript:item_update(\''+data+'\');" title="Ver Observación">'+
                                  '<i class="fa fa-exclamation text-' + status[data].state + '"></i> <span class="m--font-bold m--font-' + status[data].state + '">' + status[data].title + '</span>' +
                                  '</a>';
                              return dato;*/
                        },
                    },

                    {
                        targets: [10],
                        className:"text-center",
                        render: function(data, type, full, meta) {
                            var status = {
                                '1': {'estilo': 'tipo-sustituido','title': 'Sustitución'},
                                '0': {'estilo': 'tipo-original','title': 'Original'},
                            };
                            if (typeof status[data] === 'undefined') {
                                return data;
                            }

                            return '<span class="m-badge  m-badge--wide '+ status[data].estilo+' " >' +status[data].title+'</span>';
                        },
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




</script>

{/literal}