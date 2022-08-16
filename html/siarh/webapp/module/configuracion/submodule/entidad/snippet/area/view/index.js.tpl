{literal}
<script>
    var table_list;

    function hiddenPass(data, type, meta){
      if (type == 1) {
        $('#'+meta).text(data);
        $('<input class="appinput">').val(data).appendTo('body').select();
        document.execCommand('copy');
      }else if(type == 2){
        $('#'+meta).text('');
        $('.appinput').remove();
      }
    }


    function item_delete_{/literal}{$subcontrol}{literal}(id){
        swal({
            title: 'Esta seguro de borrar el registro?',
            text: "Recuerde que el registro se eliminará permanentemente. ID="+id+", ",
            type: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Si, Elimnar!!!',
            cancelButtonText: "No, cancelar"
        }).then(function(result) {
            if (result.value) {
                itemDeleteAction_{/literal}{$subcontrol}{literal}(id);
            }
        });
    }

    function item_update_{/literal}{$subcontrol}{literal}(id){
        item_form_{/literal}{$subcontrol}{literal}(id,"update");
    }
    function item_descarga_{/literal}{$subcontrol}{literal}(id){
        url= "{/literal}{$getModule}&accion={$subcontrol}_itemDescarga{literal}&id="+id+"&item_id="+{/literal}{$id}{literal};
        window.open(url, '_blank');
    }

    function itemDeleteAction_{/literal}{$subcontrol}{literal}(id){
        randomnumber=Math.floor(Math.random()*11);
        $.get( "{/literal}{$getModule}{literal}",
            {accion:"{/literal}{$subcontrol}_itemDelete{literal}", random:randomnumber, id:id,item_id:'{/literal}{$id}{literal}'},
            function(res){
                if(res.res == 1){
                    swal({position: 'top-center',type: 'success',title: 'El registro fue eliminado',showConfirmButton: false,timer: 900});
                    table_list.draw();
                }else if(res.res == 2){
                    swal("Ocurrio un error!", res.msg, "error");
                }else{
                    swal("ocurrio un error!", res.msg, "error");
                }
            },"json");
    }

    var snippet_datatable_list = function () {

        $.fn.dataTable.Api.register('column().title()', function() {
            return $(this.header()).text().trim();
        });

        var exporta_titulo = "SIARH - Infraestructura - Sistema - Usuarios";
        var exporta_columnas = [':visible :not(.noExport)' ];

        var initTable1 = function() {
            // begin first table
            table_list = $('#tabla_{/literal}{$subcontrol}{literal}').DataTable({
                initComplete: function(settings, json) {
                    $('#tabla_{/literal}{$subcontrol}{literal}').removeClass('m--hide');
                },
                responsive: true,
                keys: {
                    blurable: false,
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

                // read more: https://datatables.net/examples/basic_init/dom.html
                language: {"url": "language/datatable.spanish.json?id=3434"},
                lengthMenu: [ 10, 25, 50],
                pageLength: 25,
                order: [[ 2, "asc" ]], // Por que campo ordenara al momento de desplegar
                InfoFiltered:     false,
                searchDelay: 500,
                processing: true,
                serverSide: true,
                ajax: {
                    url: '{/literal}{$getModule}&accion={$subcontrol}_getItemList{literal}&item_id={/literal}{$id}{literal}',
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
                        targets: 0,
                        width: "60px",
                        className: 'noExport',
                        orderable: false,
                        render: function(data, type, full, meta) {
                            var boton = ''+
                                    {/literal}{if $privFace.editar == 1}{literal}
                                '<a href="javascript:item_update_{/literal}{$subcontrol}{literal}(\''+data+'\');" class="m-portlet__nav-link btn m-btn m-btn--hover-warning m-btn--icon m-btn--icon-only m-btn--pill" title="Editar">'+
                                '<i class="flaticon-edit-1 m--font-success"></i>'+
                                '</a>'+
                                  /*  {/literal}{/if}{literal}
                                '<a href="javascript:item_descarga_{/literal}{$subcontrol}{literal}(\''+data+'\');" class="m-portlet__nav-link btn m-btn m-btn--hover-success m-btn--icon m-btn--icon-only m-btn--pill" title="Descargar">'+
                                '<i class="flaticon-tool-1 m--font-success" ></i>'+
                                '</a>'+*/
                                    {/literal}{if $privFace.eliminar == 1}{literal}
                                '<a href="javascript:item_delete_{/literal}{$subcontrol}{literal}(\''+data+'\');" class="m-portlet__nav-link btn m-btn m-btn--hover-danger m-btn--icon m-btn--icon-only m-btn--pill" title="Borrar">'+
                                '<i class="flaticon-delete-2 m--font-success"></i>'+
                                '</a>'+
                                    {/literal}{/if}{literal}
                                '';
                            return boton;
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
                    {
                        targets: [3],
                        render: function(data,type,full,meta){
                            return '<span class="m--font-bold m--font-focus">' + data + '</span>';
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
