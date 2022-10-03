{literal}
<script>
    var table_list

    function item_update(id){
        var url = '{/literal}{$getModule}{literal}&accion=itemUpdate&id='+id+'&type=update';
        location = url;
    }
    function item_delete(id){
        swal({
            title: 'Esta seguro de borrar el registro?',
            text: "Recuerde que el registro se eliminará permanentemente. ID="+id+", ",
            type: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Si, Elimnar!!!',
            cancelButtonText: "No, cancelar"
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
                    //swal('Eliminado!','El registro fue eliminado','success');
                    swal({position: 'top-center',type: 'success',title: 'El registro fue eliminado',showConfirmButton: false,timer: 1000});
                    table_list.draw();
                }else if(res.res == 2){
                    swal({position: 'top-center'
                        ,html:'<strong>Tiene IP Públicas asociadas.</strong><br>'+res.msg+'<br><br><div class="m-alert m-alert--outline alert alert-danger alert-dismissible fade show" role="alert"> <strong>Dato Técnico: </strong>'+res.msgdb+'</div>'
                        ,type: 'error'
                        ,title: 'No se puede eliminar'});
                }else{
                    swal("ocurrio un error!", res.msg, "error");
                }
            },"json");
    }

    var snippet_datatable_list = function () {
        $.fn.dataTable.Api.register('column().title()', function() {
            return $(this.header()).text().trim();
        });

        var exporta_titulo = "Administrar_Gestion";
        var exporta_columnas = [':visible :not(.noExport)' ];

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
                language: {"url": "language/datatable.spanish.json"},
                lengthMenu: [[10, 25, 50,-1], [10, 25, 50, "Todos"]],
                pageLength: 25,
                order: [[ 1, "asc" ]], // Por que campo ordenara al momento de desplegar
                searchDelay: 500,
                processing: true,
                serverSide: true,
                ajax: {
                    url: '{/literal}{$getModule}{literal}&accion=getItemList&accion=getItemList&gestion={/literal}{$gestionId}{literal}',
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
                        width: "40px",
                        className: 'noExport',
                        orderable: false,
                        render: function(data, type, full, meta) {
                            var boton = '';
                            if ('{/literal}{$usuarioInfo.rol_itemId}{literal}'==='1'){
                            boton = ''+
                                '<a href="javascript:item_update(\''+data+'\');" class="m-portlet__nav-link btn m-btn m-btn--hover-warning m-btn--icon m-btn--icon-only m-btn--pill " title="View">'+
                                '<i class="la flaticon-edit-1 m--font-brand"></i>'+
                                '</a>'

                                '';}
                            return boton;
                        },
                    },{
                        targets: 2,
                        render: function(data, type, full, meta) {
                            var boton="";
                            if(data!=null){
                                boton="<div style='color: #483DB6;font-weight:400'>"+fechaLiteral(data)+"</div>";
                            }
                            return boton;
                        },
                    },{
                        targets:3 ,
                        render: function(data, type, full, meta) {
                            var boton="";
                            if(data!=null){
                                boton="<div style='color: #483DB6;font-weight:400'>"+fechaLiteral(data)+"</div>";
                            }
                            return boton;
                        },
                    },{
                        targets: 4,
                        render: function(data, type, full, meta) {
                            var boton="";
                            if(data!=null){
                                boton="<div style='color: #DE9428;font-weight:400'>"+fechaLiteral(data)+"</div>";
                            }
                            return boton;
                        },
                    },{
                        targets: 5,
                        render: function(data, type, full, meta) {
                            var boton="";
                            if(data!=null){
                                boton="<div style='color: #DE9428;font-weight:400'>"+fechaLiteral(data)+"</div>";
                            }
                            return boton;
                        },
                    }

                ],
            });
            //new $.fn.dataTable.FixedHeader( table_list );
        };



        var fechaLiteral=function(fecha){
            var fechas=fecha.split("-");
            var meses=["Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre"]
            var mes=meses[Number(fechas[1])-1];
            return fechas[2]+" - "+mes;
        }
        var handle_general_components = function(){
            $('.select2_busqueda').select2({
                placeholder: "Seleccione una opción"
            });

        };

        var filtro_categoria = $("#filtro_categoria");
        var handle_filtro = function () {
            //filtro_categoria.change(function(evt, params){
            $('#filtro_gestion').change(function(evt, params){
                var filtro_id = $("#filtro_gestion option:selected").val();
                location='{/literal}{$getModule}{literal}&gestion='+filtro_id;
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

            $('.reporte_descarga').click(function(){
                /*
                $("#form_modal_reporte").modal("show");
                $.fileDownload($(this).attr('href'), {
                    successCallback: function(url) {
                        $("#form_modal_reporte").modal("hide");
                    },
                    failCallback: function(responseHtml, url) {
                        $("#form_modal_reporte").modal("hide");
                        alert("Ocurrio un error");
                    }
                });
                return false;
                */

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