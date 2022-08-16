{literal}
<script>
    var table_list;

    function item_update_{/literal}{$subcontrol}{literal}(id){
        var load_url = '{/literal}{$path_url}/{$subcontrol}_/{$id}{literal}';
        load_url += '/'+id+'/';

        var msgEspere = 'Espere unos segundos hasta que cargue el formulario por favor'+cargando_vista;
        $("#modal-content_{/literal}{$subcontrol}{literal}").html(msgEspere);
        $("#form_modal_{/literal}{$subcontrol}{literal}").modal("show");


        $.get(load_url, function(data) {
            $("#modal-content_{/literal}{$subcontrol}{literal}").html(data);
        });
    }

    function item_descarga_{/literal}{$subcontrol}{literal}(id){
        url= "{/literal}{$path_url}/{$subcontrol}_/{$id}/{literal}"+id+"/descarga/";
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

                dom: `<'row'>
                <'row'<'col-sm-12'tr>>
                <'row'>`,

                language: {"url": "/config/language/datatable.spanish.json"},
                lengthMenu: [ 10, 25, 50],
                pageLength: 100,
                //order: [[ 0, "asc" ]], // Por que campo ordenara al momento de desplegar
                InfoFiltered:     false,
                searchDelay: 500,
                processing: true,
                //serverSide: true,
                /*
                ajax: {
                    url: '{/literal}{$path_url}/{$subcontrol}_/{$id}/lista{literal}',
                    type: 'POST',
                    data: {},
                },
                */
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
                        {/literal}{if $item_padre.estado_id != 1 and $item_padre.estado_id != 3}{literal}
                        //visible: false,
                        {/literal}{/if}{literal}

                    },
                    {
                        targets: [4],
                        render: function(data, type, full, meta) {
                            var status = {
                                0: {'title': '', 'state': 'secondary'},
                                1: {'title': '', 'state': 'secondary'},
                                3: {'title': '', 'state': 'secondary'},
                                4: {'title': 'SI', 'state': 'success'},
                                5: {'title': '', 'state': 'secondary'},
                                2: {'title': 'SI', 'state': 'success'}
                            };
                            if (typeof status[data] === 'undefined') {
                                return data;
                            }
                            return '<i class="fa fa-check-circle text-' + status[data].state + '"></i>&nbsp;' +
                                '<span class="m--font-bold m--font-' + status[data].state + '">' + status[data].title + '</span>';

                        },
                    },
                    {
                        targets: [5],
                        render: function(data, type, full, meta) {
                            var status = {
                                0: {'title': '', 'state': 'secondary'},
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
                        targets: [2],
                        visible: false,
                    },
                    {
                        targets: [3],
                        render: function(data,type,full,meta){
                            if(data!=""){
                                valor = data/1024/1024;
                                valor = valor.toFixed(2);
                                dato = '<span class="m--font-bold m--font-accent">' + valor + ' Mb.</span>';
                            }else{
                                dato = "";
                            }
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
    });




</script>

{/literal}