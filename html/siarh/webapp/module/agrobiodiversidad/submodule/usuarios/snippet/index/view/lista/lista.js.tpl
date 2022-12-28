{literal}
<script>
    var table_list;

    function item_update(id) {
        var url = '{/literal}{$getModule}{literal}&accion=itemUpdate&id='+id+'&type=update';
        location = url;
    }

    function item_button_update(id) {
        return '<a href="javascript:item_update(\''+ id +'\');" class="btn btn-success btn-sm" title="Editar permisos"><i class="la flaticon-edit-1"></i>&nbsp;Editar permisos</a>';
    }
    
    var snippet_datatable_list = function() {
        $.fn.dataTable.Api.register('column().title()', function() {
            return $(this.header()).text().trim();
        });

        var exporta_titulo = "LISTADO DE USUARIOS";
        var exporta_columnas = [':visible :not(.noExport)'];

        var initTable1 = function() {
            // begin first table
            table_list = $('#index_lista').DataTable({
                initComplete: function(settings, json) {
                    $('#index_lista').removeClass('m--hide');
                },
                responsive: true,
                keys: {
                    blurable: false,
                    columns: exporta_columnas,
                    clipboard: false,
                },
                //stateSave: true,
                colReorder: true,
                //== Pagination settings
                dom:
                "<'row'<'col-sm-12 col-md-12 dataTables_pager'lp>>" +
                    `<'row'<'col-sm-5 text-left'f><'col-sm-7 text-right'B>>
                     <'row'<'col-sm-12'tr>>
                     <'row'<'col-sm-12 col-md-5'i><'col-sm-12 col-md-7 dataTables_pager'lp>>`,
                // read more: https://datatables.net/examples/basic_init/dom.html
                buttons: [
                    {extend:'colvis',text:'Ver'
                        ,columnText: function(dt, idx, title) {
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
                        //, orientation: 'landscape'
                        , pageSize: 'LETTER'
                        ,customize: function(doc) {
                            doc.styles.tableHeader.fontSize = 7;
                            doc.defaultStyle.fontSize = 7;
                            doc.pageMargins= [ 20, 20];
                        }
                    },

                ],
                // read more: https://datatables.net/examples/basic_init/dom.html
                language: {"url": "language/datatable.spanish.json"},
                lengthMenu: [10, 25, 50, 100],
                pageLength: 10,
                order: [[ 1, "desc" ]], // Por que campo ordenara al momento de desplegar
                searchDelay: 500,
                ajax: {
                    url: '{/literal}{$getModule}{literal}&accion=getUserList',
                    type: 'POST',
                    data: {},
                },
                columnDefs: [
                    {
                        targets: [0],
                        title: 'Acción',
                        orderable: false, 
                        render: function(data, type, full, meta) {
                            var boton = '{/literal}{if $privFace.editar == 1}{literal}' + item_button_update(data) + '{/literal}{/if}{literal}';
                            return boton;
                        }
                    }
                ]
            });
        };

        return {
            //main function to initiate the module
            init: function() {
                initTable1();
            }
        };

    }();

    jQuery(document).ready(function() {
        snippet_datatable_list.init();
        $('.search-input-text').on('keyup change', function() {
            var i = $(this).attr('data-column');
            var v = $(this).val();
            table_list.columns(i).search(v).draw();
        });
    });
</script>
{/literal}