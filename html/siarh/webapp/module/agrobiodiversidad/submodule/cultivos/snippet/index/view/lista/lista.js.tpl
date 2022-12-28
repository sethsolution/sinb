{literal}
<script>
    var table_list;

    function item_update(id) {
        var url = '{/literal}{$getModule}{literal}&accion=itemUpdate&id='+id+'&type=update';
        location = url;
        /*$.get(url, function(respuesta) {
            if (respuesta.res == 1) {
                swal("Actualizado!", "El registro fue actualizado con éxito!", "success");
            } else if (respuesta.res == 2) {
                swal("Ocurrió un error!", respuesta.msg, "error");
            } else {
                swal("Ocurrió un error!", respuesta.msg, "danger");
            }
        });*/
    }

    function item_delete(id) {
        swal({
            title: 'Está seguro de borrar el registro?',
            text: "Recuerde que el registro se eliminará permanentemente. ID="+id+".",
            type: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Si, Eliminar!!!',
            cancelButtonText: "No, cancelar"
        }).then(function(result) {
            if (result.value) {
                itemDeleteAction(id);
            }
        });
    }

    function item_print(id) {
        alert("Imprime el dato:"+id)
    }

    function itemDeleteAction(id) {
        randomnumber=Math.floor(Math.random()*11);
        $.get( "{/literal}{$getModule}{literal}",
            {accion:"itemDelete", random:randomnumber, id:id},
            function(res){
                if(res.res == 1){
                    swal('Eliminado!','El registro fue eliminado.','success');
                    //swal({position: 'top-center',type: 'success',title: 'El registro fue eliminado',showConfirmButton: false,timer: 1200});
                    table_list.draw();
                }else if(res.res == 2){
                    swal("Ocurrió un error!", res.msg, "error");
                }else{
                    swal("ocurrió un error!", res.msg, "error");
                }
            },"json");
    }

    function item_download(id) {
        window.open('{/literal}{$getModule}{literal}&accion=getFicha&id='+id,'blank')
    }

    function item_button_update(id) {
        return '<a href="javascript:item_update(\''+ id +'\');" class="m-portlet__nav-link btn m-btn m-btn--hover-warning m-btn--icon m-btn--icon-only m-btn--pill" title="Editar"><i class="la flaticon-edit-1 m--font-brand"></i></a>';
    }

    function item_button_delete(id) {
        return '<a href="javascript:item_delete(\''+ id +'\');" class="m-portlet__nav-link btn m-btn m-btn--hover-danger m-btn--icon m-btn--icon-only m-btn--pill" title="Eliminar"><i class="la flaticon-delete-2 m--font-brand"></i></a>';
    }

    function item_button_download(id) {
        return '<a href="javascript:item_download(\''+ id +'\');" class="m-portlet__nav-link btn m-btn m-btn--hover-danger m-btn--icon m-btn--icon-only m-btn--pill" title="Descargar ficha"><i class="la flaticon-download m--font-brand"></i></a>';
    }
    
    var snippet_datatable_list = function() {
        $.fn.dataTable.Api.register('column().title()', function() {
            return $(this.header()).text().trim();
        });

        var exporta_titulo = "LISTADO DE CULTIVOS";
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
                processing: true,
                serverSide: true,
                ajax: {
                    url: '{/literal}{$getModule}{literal}&accion=getItemList',
                    type: 'POST',
                    data: {},
                },
                columns: [
                    {/literal}
                    {foreach from=$grill_list item=row key=idx}
                        {literal}{data: '{/literal}{$row.field}{literal}'} ,{/literal}
                    {/foreach}
                    {literal}
                ],
                columnDefs: [
                    {
                        targets: [0],
                        title: 'Acción',
                        orderable: false, 
                        render: function(data, type, full, meta) {
                            var boton = '{/literal}{if $privFace.editar == 1}{literal}'+
                            item_button_update(full.itemId)+
                            '{/literal}{/if}{literal}{/literal}{if $privFace.eliminar == 1}{literal}'+
                            item_button_delete(full.itemId)+'{/literal}{/if}{literal}'+
                            item_button_download(full.itemId);;
                            return boton;
                        }
                    },
                    {
                        targets: [1],
                        visible: false
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