{literal}
<script>
    var table_list;
    var snippet_list = function() {
        "use strict";
        var urlsys = '{/literal}{$path_url}/{$subcontrol}_/{$id}{literal}';
        var initTable = function() {
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
                //dom: tableSetting.dom,
                dom:
                    "<'row'<'col-sm-12 col-md-12 dataTables_pager'l>>"+
                    "<'row'<'col-sm-12 col-md-12 dataTables_pager'p>>"+
                    `<'row'<'col-sm-12 'f>>
			         <'row'<'col-sm-12'tr>>`,

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
                colReorder: true,
                responsive: true,
                language: {"url": "/language/js/datatable."+lng+".json"},
                lengthMenu: [[10, 25, 50,-1], [10, 25, 50, lngUyuni.dataTableAll]],
                pageLength: 10,
                order: [[ 0, "asc" ]], // Por que campo ordenara al momento de desplegar
                InfoFiltered: false,
                searchDelay: 500,
                processing: true,
                serverSide: true,
                ajax: {
                    url: urlsys+'/list?{/literal}filter[departamento]={$filter.departamento}&filter[filtro_estado]={$filter.filtro_estado}&filter[filtro_gd_tipo_fuente_generacion]={$filter.filtro_gd_tipo_fuente_generacion}{literal}',
                    type: 'POST',
                    data: {},
                },
                columns: [
                    {/literal}{foreach from=$gridItem item=row key=idx}
                    {if $idx != 0},{/if}{literal}{data: '{/literal}{if $row.as}{$row.as}{else}{$row.field}{/if}{literal}'{/literal}{if $row.responsive}, responsivePriority: -1{/if}{literal}}{/literal}
                    {/foreach}{literal}
                ],
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
                            boton += '<a href="javascript:snippet_list.getToThePoint( ['+full.location_latitude_decimal+',  '+full.location_longitude_decimal+'],'+full.actions+');" class="btn btn-icon btn-success btn-sm" title="Ver en el Mapa"><i class="fa fa-location-arrow"></i></a>';
                            boton += '<div>';
                            return boton;
                        },
                    },
                    {
                        targets: [2,-2,-3],
                        searchable: false,
                    },

                ],
            });

        };

        /**
         * Para ir directamente al punto
         */
        function markerFunction(id){
            var markers = json_layer._layers;
            markers = json_layer._layers;
            for (var i in markers){
                var markerID = markers[i].feature.id;
                if (markerID == id){
                    markers[i].openPopup();
                };
            }
        }

        var getToThePoint = function(point,id){
            map.flyTo(point, 10);
            markerFunction(id);
        };

        return {
            //main function to initiate the module
            init: function() {
                initTable();
            },
            getToThePoint:function(point,id){
                getToThePoint(point,id);
            },

        };
    }();

    jQuery(document).ready(function() {
        snippet_list.init();
    });
</script>

{/literal}
