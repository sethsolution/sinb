{literal}
<script>
    var table_list

    function item_update(id){
        var url = '{/literal}{$getModule}{literal}&accion=itemUpdate&id='+id+'&type=update';
        location = url;
    }
    function item_delete(id){
        swal({
            title: 'Are you sure to delete the record?',
            text: "Recuerde que el registro se eliminará permanentemente. ID="+id+", ",
            type: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Yes, Delete',
            cancelButtonText: "No, Cancel"
        }).then(function(result) {
            if (result.value) {
                itemDeleteAction(id);
            }
        });
    }
    function item_print(id){
        alert("Imprime el dato:"+id)
    }

    function itemDeleteAction(id){
        randomnumber=Math.floor(Math.random()*11);
        $.get( "{/literal}{$getModule}{literal}",
            {accion:"itemDelete", random:randomnumber, id:id},
            function(res){
                if(res.res == 1){
                    swal({position: 'top-center',type: 'success',title: 'El registro fue eliminado',showConfirmButton: false,timer: 1000});
                    table_list.draw();
                }else if(res.res == 2){
                    swal({position: 'top-center',html:res.msg+"<br>La IP pública esta siendo utilizado por un servidor virtual<br>",type: 'error',title: 'El registro fue eliminado'});
                }else{
                    swal("ocurrio un error!", res.msg, "error");
                }
            },"json");
    }

    var snippet_datatable_list = function () {
        $.fn.dataTable.Api.register('column().title()', function() {
            return $(this.header()).text().trim();
        });

        var export_title = "Infraestructura - Catálogo IP Públicas";
        var noExport = [':visible :not(.noExport)' ];

        var initTable1 = function() {
            // begin first table
            table_list = $('#index_list').DataTable({
                initComplete: function(settings, json) {
                    $('#index_list').removeClass('m--hide');
                },
                responsive: true,
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
                    {extend:'colvis',text:'Watch'
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
                        , orientation: 'landscape'
                        , pageSize: 'LETTER'
                        ,customize: function(doc) {
                            doc.styles.tableHeader.fontSize = 7;
                            doc.defaultStyle.fontSize = 7;
                            doc.pageMargins= [ 20, 20];
                        }
                    },
                    {extend:'pdfHtml5'
                        ,exportOptions: {columns: noExport}
                        , title: export_title
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
                // read more: https://datatables.net/examples/basic_init/dom.html
                language: {"url": "config/language/datatable.spanish.json"},
                lengthMenu: [[10, 25, 50,-1], [10, 25, 50, "Todos"]],
                pageLength: 25,
                order: [[ 1, "asc" ]], // Por que campo ordenara al momento de desplegar
                searchDelay: 500,
                processing: true,
                serverSide: true,
                ajax: {
                    url: '{/literal}{$getModule}{literal}&accion=getItemList',
                    type: 'POST',
                    data: {},
                },
                columns: [
                    {/literal}
                    {foreach from=$gridItem item=row key=idx}
                        {literal}{data: '{/literal}{$row.field}{literal}'} ,{/literal}
                    {/foreach}
                    {literal}
                ],
                columnDefs: [
                    {
                        targets: 0,
                        width: "80px",
                        className: 'noExport',
                        orderable: false,
                        render: function(data, type, full, meta) {

                            var boton = ''+
                                    {/literal}{if $privFace.edit eq 1}{literal}
                                '<a href="javascript:item_update(\''+data+'\');" class="m-portlet__nav-link btn m-btn m-btn--hover-warning m-btn--icon m-btn--icon-only m-btn--pill " title="View">'+
                                '<i class="la flaticon-edit-1 m--font-brand"></i>'+
                                '</a>'+
                                    {/literal}{/if}{literal}

                                    {/literal}{if $privFace.delete eq 1}{literal}
                                '<a href="javascript:item_delete(\''+data+'\');" class="m-portlet__nav-link btn m-btn m-btn--hover-danger m-btn--icon m-btn--icon-only m-btn--pill" title="View">'+
                                '<i class="la flaticon-delete-2 m--font-brand"></i>'+
                                '</a>'+
                                    {/literal}{/if}{literal}
                                '';
                            return boton;
                        },
                    },

                    {
                        targets: [ 2],
                        render: function(data,type,full,meta){
                            if (data != null){
                                return '<span class="m--font-bold m--font-danger">' + data + '</span>';
                            }else{
                                return data;
                            }

                        },

                    },
                    {
                        targets: [ 3 ],
                        render: function(data,type,full,meta){
                            if (data != null){
                                return '<span class="m--font-bold m--font-danger">' + data + '</span>';
                            }else{
                                return data;
                            }

                        },

                    },
                    {
                        targets: [4],
                        render: function(data, type, full, meta) {
                            var status = {
                                0: {'title': 'Inactivo', 'state': 'danger'},
                                1: {'title': 'Activo', 'state': 'success'}
                            };
                            if (typeof status[data] === 'undefined') {
                                return data;
                            }
                            return '<span class="m-badge m-badge--' + status[data].state + ' info m-badge--wide"></span>&nbsp;' +
                                '<span class="m--font-bold m--font-' + status[data].state + '">' + status[data].title + '</span>';
                        },
                    },

                ],
            });
        };

        var handle_general_components = function(){
            $('.select2_busqueda').select2({
                placeholder: "Seleccione una opción"
            });

        };

        //var filtro_categoria = $("#filtro_lugar");

        var handle_filtro = function () {

            $('.filtro-buscar').change(function(evt, params){
                //alert(evt);
                var filtro_id = $(this).val();
                filtro_id = filtro_id==null? '': filtro_id.toString();
                var i = $(this).data('col-index');
                if(filtro_id==0){filtro_id = '';}
                table_list.column(i).search(filtro_id ? filtro_id : '', false, false);
                table_list.draw();

            });
            $('.filtro-buscar-text').keyup(function(evt, params){
                //console.log("entro");
                var filtro_id = $(this).val();
                filtro_id = filtro_id==null? '': filtro_id.toString();
                var i = $(this).data('col-index');
                if(filtro_id.length>=3 || filtro_id==''){
                    table_list.column(i).search(filtro_id ? filtro_id : '', false, false);
                    table_list.draw();
                }
            });
            $('.filtro-buscar-num').keyup(function(evt, params){
                //console.log("entro");
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
