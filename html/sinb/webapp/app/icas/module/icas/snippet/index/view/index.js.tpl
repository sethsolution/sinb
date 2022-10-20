{literal}
<script>

    var table_list;
    var snippet_list = function() {
        "use strict";
        var urlsys = '{/literal}{$path_url}{literal}';
        var initTable = function() {
            let table_list_var = $('#index_list');
            let export_title = "{/literal}{#dataTableExportTitle#}{literal}";
            let noExport = tableSetting.noExport;
            // begin first table
            table_list = table_list_var.DataTable({
                initComplete: function(settings, json) {
                    $('#index_list').removeClass('d-none');
                },
                keys: {
                    columns: noExport,
                    clipboard: false,
                },
                dom: tableSetting.dom,
                buttons: [
                    /*
                    {extend:'colvis',text:lngUyuni.dataTableWatch
                        ,columnText: function ( dt, idx, title ) {
                            return (idx+1)+': '+title;
                        }
                    },

                     */
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
                responsive: true,
                colReorder: true,
                language: {"url": "/language/js/datatable."+lng+".json"},
                lengthMenu: [[10, 25, 50,-1], [10, 25, 50, lngUyuni.dataTableAll]],
                pageLength: 10,
                //order: [[ 1, "asc" ]], // Por que campo ordenara al momento de desplegar
                InfoFiltered: false,
                searchDelay: 500,
                processing: true,
                serverSide: true,
                ajax: {
                    url: urlsys+'/list',
                    type: 'POST',
                    data: {},
                },
                columns: [
                    {/literal}{foreach from=$gridItem item=row key=idx}
                    {if $idx != 0},{/if}{literal}{data: '{/literal}{if $row.as}{$row.as}{else}{$row.field}{/if}{literal}'{/literal}{if $row.responsive}, responsivePriority: -1{/if}{literal}}{/literal}
                    {/foreach}{literal}
                ],
                /*
                rowGroup: {
                    dataSrc: ['parentname','groupname']
                },

                 */
                columnDefs: [
                    {
                        targets: -1,
                        width: "90px",
                        className: 'noExport',
                        orderable: false,
                        searchable: false,
                        render: function(data, type, full, meta) {
                            var boton = '<div class="btn-group btn-group-sm " role="group" aria-label="Accion">';
                            var lbEdit = {/literal}{if $privFace.edit == 1}lngUyuni.btnEdit{else}lngUyuni.btnViewData{/if}{literal};
                            boton += '<a href="javascript:snippet_list.update(\''+data+'\');" class="btn btn-success btn-sm" title="'+lbEdit+'">'+lbEdit+'</a>';
                            {/literal}{if $privFace.edit ==1 and $privFace.delete == 1}{literal}
                            boton += '<a href="javascript:snippet_list.delete(\''+data+'\');" class="btn btn-icon btn-light-danger btn-sm" title="'+lngUyuni.btnDelete+'"><i class="flaticon-delete-1"></i></a>';
                            {/literal}{/if}{literal}
                            boton += '<div>';
                            return boton;
                        },
                    },
                    {
                        targets: [0],
                        className:"text-left",
                        render: function(data,type,full,meta){
                            return '<span style="color: #0357ae;">' + data + ' </span>';
                        },
                    },
                    {
                        targets: 2,
                        render: function(data, type, full, meta) {
                            var status = {
                                'Registro': {'title': 'Registro', 'class': ' label-light-primary'},
                                'Ejecución': {'title': 'Ejecución', 'class': ' label-light-warning'},
                                'Concluidos': {'title': 'Concluidos', 'class': ' label-light-info'},
                            };
                            if (typeof status[data] === 'undefined') {
                                return data;
                            }
                            return '<span class="label label-lg font-weight-bold' + status[data].class + ' label-inline">' + status[data].title + '</span>';
                        },
                    },
                    {
                        targets: [8],
                        className: "none",
                    },
                    {
                        targets: [3,5],
                        searchable: false,
                    },
                    {
                        targets: [3,5],
                        className:"text-right",
                        render: function(data,type,full,meta){
                            return '<span style="color: #27780f;">' + new Intl.NumberFormat('en-US',{ minimumFractionDigits: 2 }).format(data) + ' </span>';
                        },
                    },
                    {
                        targets: [-2,-3,6,7],
                        searchable: false,
                        className: "none",
                        render: function(data,type,full,meta){
                            if (data == null){ data = "";}
                            return '<span class="text-primary font-size-xs">' + data+ '</span>';
                        },
                    },

                ],
            });
        };

        /**
         * New and Update
         */
        //var btn_update = $('#btn_update');
        var btn_update = $('#btn_new');
        var handle_button_update = function(){
            btn_update.click(function(e){
                e.preventDefault();
                item_update("","new");
            });
        };

        var item_update = function(id,type){
            coreUyuni.itemUpdateIndex(id,type,urlsys);
        };
        /**
         * Delete
         */
        var  item_delete = function(id){
            var url = urlsys+"/"+id+"/delete";
            coreUyuni.itemDelete(id,url,table_list);
        };
        /**
         * Inicializar componentes
         */
        var handle_components = function(){
            coreUyuni.setComponents();
        };
        /**
         * Filtros
         */
        var handle_filtro = function () {
            coreUyuni.tableFilter();
        };

        return {
            //main function to initiate the module
            init: function() {
                initTable();
                handle_button_update();
                handle_components();
                handle_filtro();
            },
            update: function(id,type){
                item_update(id,type);
            },
            delete: function(id){
                item_delete(id);
            },
        };

    }();

    jQuery(document).ready(function() {
        $('#btn_new').removeClass('d-none');
        snippet_list.init();
    });
</script>
{/literal}