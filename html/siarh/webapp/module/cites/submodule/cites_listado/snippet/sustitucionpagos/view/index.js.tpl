{literal}
<script>
    var table_list;

    function item_form_{/literal}{$subcontrol}{literal}(id,type){
        type="update";
        var load_url = '{/literal}{$getModule}&accion={$subcontrol}_get.form{literal}&id='+id+'&type='+type+'&item_id={/literal}{$id}{literal}';

        swal({
            title: 'Cargando formulario',
            html: 'Espere unos segundos hasta que cargue el formulario por favor'+cargando_vista,
            showConfirmButton: false,
            allowEnterKey: false,
            allowOutsideClick: false,
            allowEscapeKey: false,
        });

        $.get(load_url, function(data) {
            $("#modal-content_{/literal}{$subcontrol}{literal}").html(data);
            swal.close();
            $("#form_modal_{/literal}{$subcontrol}{literal}").modal("show");

        });
    }

    var snippet_button_form = function () {
        var btn_update = $('#btn_form_{/literal}{$subcontrol}{literal}');
        var handle_button_form = function(){
            btn_update.click(function(e){
                e.preventDefault();
                item_form_{/literal}{$subcontrol}{literal}("","new");
            });
        }

        return {
            // public functions
            init: function() {
                handle_button_form();

            }
        };
    }();



    function item_update_{/literal}{$subcontrol}{literal}(id){
        item_form_{/literal}{$subcontrol}{literal}(id,"update");
    }
    function item_descarga_{/literal}{$subcontrol}{literal}(id){
        url = '{/literal}{$getModule}&accion={$subcontrol}_descarga{literal}&id='+id+'&item_id={/literal}{$id}{literal}';
        window.open(url, '_blank');
    }

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
                language: {"url": "/language/datatable.spanish.json"},
                lengthMenu: [ 10, 25, 50],
                pageLength: 25,
                order: [[ 1, "asc" ]], // Por que campo ordenara al momento de desplegar
                InfoFiltered:     false,
                searchDelay: 500,
                processing: true,
                serverSide: true,
                ajax: {

                    url: '{/literal}{$getModule}&accion={$subcontrol}_lista{literal}&item_id={/literal}{$id}{literal}',
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
                            {/literal}{if $item_padre.estado_id == 1 or $item_padre.estado_id == 2}{literal}
                            bt_text = "Cambiar Estado";
                            {/literal}{else}{literal}
                            bt_text = "Ver Datos";
                            {/literal}{/if}{literal}
                            boton += '<a href="javascript:item_update_{/literal}{$subcontrol}{literal}(\''+data+'\');" class="btn btn-outline-info" title="'+bt_text+'">'+bt_text+'</a>';
                            boton += '<div>';
                            return boton;
                        },
                    },
                    {
                        targets: [5],
                        render: function(data, type, full, meta) {
                            var status = {
                                1: {'title': '', 'state': 'secondary'},
                                3: {'title': '', 'state': 'secondary'},
                                4: {'title': 'SI', 'state': 'success'},
                                5: {'title': '', 'state': ''},
                                2: {'title': 'SI', 'state': 'success'}
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
                        targets: [6],
                        render: function(data, type, full, meta) {
                            var status = {
                                1: {'title': '', 'state': 'secondary'},
                                2: {'title': '', 'state': 'secondary'},
                                3: {'title': '', 'state': 'secondary'},
                                5: {'title': '', 'state': 'secondary'},
                                4: {'title': 'SI', 'state': 'success'}
                            };
                            if (typeof status[data] === 'undefined') {
                                return data;
                            }

                            return '<i class="fa fa-check-circle text-' + status[data].state + '"></i>&nbsp;' +
                                '<span class="m--font-bold m--font-' + status[data].state + '">' + status[data].title + '</span>';
                        },
                    },
                    {
                        targets: [7],
                        render: function(data, type, full, meta) {
                            console.log(full.Actions);
                            var status = {
                                1: {'title': '', 'state': 'secondary'},
                                2: {'title': '', 'state': 'secondary'},
                                4: {'title': '', 'state': 'secondary'},
                                5: {'title': '', 'state': 'secondary'},
                                3: {'title': 'Observado', 'state': 'danger'}
                            };
                            if (typeof status[data] === 'undefined') {
                                return data;
                            }
                            {/literal}{if $item_padre.estado_id == 3}{literal}
                            dato = '<a href="javascript:item_update_{/literal}{$subcontrol}{literal}(\''+full.Actions+'\');" title="Ver Observación">'+
                                '<i class="fa fa-exclamation text-' + status[data].state + '"></i> <span class="m--font-bold m--font-' + status[data].state + '">' + status[data].title + '</span>' +
                                '</a>';
                            return dato;
                            {/literal}{else} {literal}
                            return '<i class="fa fa-check-circle text-' + status[data].state + '"></i>&nbsp;' +
                                '<span class="m--font-bold m--font-' + status[data].state + '">' + status[data].title + '</span>';
                            {/literal}{/if} {literal}

                        },
                    },
                    {
                        targets: [2],
                        className:"text-right",
                        render: function(data,type,full,meta){
                            return '<span style="color:#27780f;" class="m--font-bold">' + new Intl.NumberFormat('en-US',{ minimumFractionDigits: 2 }).format(data) + ' </span>';
                        },
                    },
                    /*{
                        targets: [ 1 ],
                        render: function(data,type,full,meta){
                            return '<i class="' + data + ' m--font-brand icono_lista"></i>';
                        },
                    },*/

                    {
                        targets: [4],
                        render: function(data,type,full,meta){
                            dato = '<a href="javascript:item_descarga_{/literal}{$subcontrol}{literal}(\''+full.Actions+'\');"  title="Descargar">'+
                                '<i class="flaticon-tool-1"></i> '+ data +
                                '</a>';
                            return dato;
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
        snippet_button_form.init();
    });




</script>

{/literal}