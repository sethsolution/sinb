{literal}
<script>
    var table_list

    function item_update(id){
        var url = '{/literal}{$path_url}{literal}/'+id;
        location = url;
    }

    function item_delete(id){
        swal({
            title: 'Esta seguro de borrar el registro?',
            text: "Recuerde que el registro se eliminará permanentemente. ID="+id+", ",
            type: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Si, Eliminar!!!',
            cancelButtonText: "No, Cancelar"
        }).then(function(result) {
            if (result.value) {
                itemDeleteAction(id);
            }
        });
    }

    function item_print(idficha){
        randomnumber=Math.floor(Math.random()*11);
        url = "{/literal}{$path_url}{literal}/"+idficha+"/print/?rand="+randomnumber;
        window.open(url,'Impresion_ficha_fiv');      
      
    }

    function itemDeleteAction(id){
        swal({
            title: 'Borrando',
            html: 'Iniciando el proceso de borrado'+cargando_vista,
            showConfirmButton: false,
            allowEnterKey: false,
            allowOutsideClick: false,
            allowEscapeKey: false,
        });

        randomnumber=Math.floor(Math.random()*11);
        $.get( "{/literal}{$path_url}/"+id+"/borrar{literal}",
            {random:randomnumber},
            function(res){
                if(res.res == 1){
                    swal.close();
                    swal({type: 'success',title: 'El registro fue eliminado',showConfirmButton: false,timer: 1000});
                    table_list.draw();
                }else{
                    msg_error = '<strong>Ocurrio error al guardar</strong><br>'+res.msg;
                    if (res.msgdb !== undefined){
                        msg_error += '<br><br><div class="m-alert m-alert--outline alert alert-danger alert-dismissible fade show" role="alert">';
                        msg_error += '<strong>Dato Técnico: </strong>'+res.msgdb+'</div>';
                    }
                    swal({position: 'top-center'
                        ,html:msg_error
                        ,type: 'error'
                        ,title: 'No se puede eliminar'});
                }
            },"json");
    }

    var snippet_datatable_list = function () {
        $.fn.dataTable.Api.register('column().title()', function() {
            return $(this.header()).text().trim();
        });

        var exporta_titulo = "CITES - LISTA";
        var exporta_columnas = [':visible :not(.noExport)' ];

        var initTable1 = function() {
            // begin first table
            table_list = $('#index_lista').DataTable({
                initComplete: function(settings, json) {
                    $('#index_lista').removeClass('m--hide');
                },
                responsive: true,
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
                language: {"url": "/config/language/datatable.spanish.json"},
                lengthMenu: [[10, 25, 50,-1], [10, 25, 50, "Todos"]],
                pageLength: 25,
                order: [[ 9, "des" ]], // Por que campo ordenara al momento de desplegar
                searchDelay: 500,
                processing: true,
                serverSide: true,
                ajax: {
                    url: '{/literal}{$path_url}{literal}/lista',
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
                        width: "130px",
                        className: 'noExport',
                        orderable: false,
                        searchable: false,
                        render: function(data, type, full, meta) {
                            var boton = '';
                            boton += '<div class="btn-group btn-group-sm " role="group" aria-label="Default button group">';


                            if( (full.estado_id == '1' || full.estado_id == '3') && full.id_estado != '4'){
                                boton += '<a href="javascript:item_update(\''+data+'\');" class="btn btn-outline-info" title="Modificar">Editar</a>';
                                    {/literal}{if $privFace.editar ==1 and $privFace.eliminar == 1}{literal}
                                    boton += '<a href="javascript:item_delete(\''+data+'\');" class="btn btn-outline-danger" title="Eliminar">Eliminar</a>';
                                    {/literal}{/if}{literal}
                            }else{
                                boton += '<a href="javascript:item_update(\''+data+'\');" class="btn btn-outline-info" title="Modificar">Ver Datos</a>';
                            }
                            boton += '<div>';
                            return boton;
                        },
                    },


                    /*<span class="m-badge m-badge--success m-badge--wide">pending</span>

                     */

                    {
                        targets: [6],
                        className:"text-center",
                        render: function(data, type, full, meta) {
                            var status = {
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

                        },
                    },

                ],
            });
            //new $.fn.dataTable.FixedHeader( table_list );
        };




        var handle_general_components = function(){
            $('.select2_busqueda').select2({
                placeholder: "Seleccione una opción"
                , width: '100%'
            });

        };

        var filtro_categoria = $("#filtro_categoria");
        var handle_filtro = function () {
            $('#especie').on('change',function(){
                var id = $(this).val();
                id = id==null? '': id.toString();

                url = '{/literal}{$path_url}{literal}/lista';

                if(id != 0){
                    url += "?especie_id="+id;
                }
                //table_list.draw();
                table_list.ajax.url( url ).load();

            });

            //filtro_categoria.change(function(evt, params){
            $('.filtro-buscar').change(function(evt, params){
                var filtro_id = $(this).val();
                filtro_id = filtro_id==null? '': filtro_id.toString();
                var i = $(this).data('col-index');
                if(filtro_id==0){filtro_id = '';}
                table_list.column(i).search(filtro_id ? filtro_id : '', false, false);
                table_list.draw();
            });
            $('.filtro-buscar-text').keyup(function(evt, params){
                var filtro_id = $(this).val();
                filtro_id = filtro_id==null? '': filtro_id.toString();
                var i = $(this).data('col-index');
                if(filtro_id.length>=1 || filtro_id==''){
                    table_list.column(i).search(filtro_id ? filtro_id : '', false, false);
                    table_list.draw();
                }
            });
            $('.filtro-buscar-num').keyup(function(evt, params){
                var filtro_id = $(this).val();
                filtro_id = filtro_id==null? '': filtro_id.toString();
                var i = $(this).data('col-index');
                    table_list.column(i).search(filtro_id ? filtro_id : '', false, false);
                    table_list.draw();
            });
        };

        return {

            //main function to initiate the module
            init: function() {
                initTable1();
                handle_general_components();
                handle_filtro();
            },

        };

    }();

    jQuery(document).ready(function() {
        snippet_datatable_list.init();
    });




</script>{/literal}