{literal}
<script>
    var table_list
    var concatenado

    function item_update(id){
        //alert("entro");
        swal({
            title: 'Ingresando a los datos!',
            html: '<span>Cargando datos</span> <span><div class="m-loader m-loader--success"></div></span>',
            showConfirmButton: false,
            allowEnterKey: false,
            allowOutsideClick: false,
            allowEscapeKey: false,
        });
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
                    swal("Ocurrio un error!", res.msg, "error");
                }else{
                    swal("ocurrio un error!", res.msg, "error");
                }
            },"json");
    }


    var show_libro_template = function (datos) {
        html = "";
        $("#mostrar_libros").html(html);

        jQuery.each( datos, function( i, val ) {
            console.log(val.Actions);
            var id=val.Actions;
                $.get( "{/literal}{$getModule}{literal}",
                {accion:"get.conteo",
                id:id},
                function(res){
                    console.log(res.conteo);
                    if (res.conteo>0) {
                        //console.log("entro");
                          $(".detalle").html("Documentos No Verificados");
                          $('#detalles').removeClass('m--hide');
                    }else{
                          $(".detalle").html("");
                        $('#detalles').addClass('m--hide');
                    }
                },"json");

             //buscar();


            html += "<div class=\"col-xl-3 col-lg-3 col-md-4 m--padding-5 \" >" +
                "<div class=\"m-portlet m-portlet--bordered-semi m-portlet--full-height  m-portlet--rounded-force\" " +
                //"style='border: 1px dashed #d6d8dd; padding:0px;' rel=\"color_"+Math.floor(Math.random() * 15) +"\">";
                "style='border: 1px dashed #d6d8dd; padding:0px;' rel=\"color_1\">";

            html += '<div class="m-portlet__body m--padding-5" style="padding:0px;" ><div class="m-widget19" >';


            html += "<div class=\"m-widget19__content\" > \n" +
                "<div class=\"m-widget19__header\">\n" +
                '<div class="m-widget19__user-img">' +
                //'<img class="m-widget19__img" src="./images/logo/mmaya_ico01.png" &type=1" alt="">' +
                '</div>'+

                "<div class=\"m-widget19__info\">\n" +
                // "<span class=\"m-widget19__username\">#CuidemosLaMadreTierra</span>\n" +
                "<br>\n" +
                //"<span class=\"m-widget19__time\">MMAyA</span>\n" +
                "</div>\n" +

                "</div>\n" +
                "</div>"

            html += '<div class="m-widget19__content" >';
            html += '<div style="text-align: center; "><img src="{/literal}{$getModule}{literal}&accion=foto.get&id='+val.Actions+'&type=3" alt="" style="height:150px;" id="persona_avatar"/></div>';
            //html += '<div class="m-card-profile__pic"><img src="{/literal}{$getModule}{literal}&accion=foto.get&id='+val.Actions+'&type=3" alt="" style="height:150px;" id="persona_avatar"/><div class="m-card-profile__pic-wrapper"></div></div>';
            //
            

            //var buscar = function() {
            
           // };

           
            

           // console.log( mensaje);
            html += "<strong>Titulo:</strong> "+val.nombres+" "+val.apellido_paterno+" "+val.apellido_materno+"<br>";

            html += '</div>';


            html += '<div class="m-portlet__body m--padding-5" ><div class="tab-content">' +

                '<div class="tab-pane active" id="m_widget4_tab1_content">' +
                '<div class="m-list-timeline m-list-timeline--skin-light"><div class="m-list-timeline__items">' +

                info_data('info','C.I.',val.ci) +
                info_data('success','Expedido',val.ci_exp) +
                info_data('warning','Correo Electrónico',val.correo_electronico) +
                info_data('accent','Fecha de Nacimiento',val.fecha_nacimiento) +
                info_data('danger','Teléfono 1',val.movil_corporativo) +
                info_data('danger','Teléfono 2',val.movil) +
                info_data_url('primary','Facebook',val.facebook_url) +
                info_data_url('info','Twitter',val.twitter_url) +
                //info_data('success','Categoría',val.categoria_id) +
                //info_data('success','Descargas',val.descargas) +
                '</div></div></div>' +
                '</div></div>';
            html += '<div style="text-align: center;">' +
                '<button type="button"  onclick="javascript:item_update(\''+val.Actions+'\');"   class="btn m-btn--pill btn-accent m-btn--wide m-btn--uppercase m-btn--bolder m-btn--sm">Ficha de la Persona</button>' +
                '</div>';
            html += ' <div class="alert alert-danger m--hide" id="detalles" role="alert"><strong class="detalle">Documentos No Verificados</strong></div>';
            html += '</div></div>';

            html += "</div></div>";

        });
        $("#mostrar_libros").html(html);

    };

    var info_data_url = function(color,label,valor){
        html = '<div class="m-list-timeline__item " style=" margin: 0px;">' +
            '<span class="m-list-timeline__badge m-list-timeline__badge--'+color+'"></span>\n' +
            '<span class="m-list-timeline__text"><strong>'+label+' :</strong>  <a href="'+valor+'" target="_blank">'+valor+' :</a> </span>\n' +
            '</div>';
        return html;
    };

    var info_data = function(color,label,valor){
        html = '<div class="m-list-timeline__item " style=" margin: 0px;">' +
            '<span class="m-list-timeline__badge m-list-timeline__badge--'+color+'"></span>\n' +
            '<span class="m-list-timeline__text"><strong>'+label+' :</strong> '+valor+' </span>\n' +
            '</div>';
        return html;
    };

    var snippet_datatable_list = function () {
        $.fn.dataTable.Api.register('column().title()', function() {
            return $(this.header()).text().trim();
        });

        var exporta_titulo = "SIARH - Personas - Lista";
        var exporta_columnas = [':visible :not(.noExport)' ];

        var initTable1 = function() {
            // begin first table
            table_list = $('#index_lista').DataTable({
                initComplete: function(settings, json) {
                    //$('#index_lista').removeClass('m--hide');
                    $('#index_lista').after('<div id="mostrar_libros" class="row"></div>');
                    show_libro_template(settings.json.data);
                },
                drawCallback: function( settings ) {
                    $("#mostrar_libros").html("");
                    show_libro_template(settings.json.data);
                    $('html, body').animate({ scrollTop: 0 }, 'fast');
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
                    /*
                    {extend:'colvis',text:'Ver'
                        ,columnText: function ( dt, idx, title ) {
                            return (idx+1)+': '+title;
                        }
                    },
                    */
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
                language: {"url": "language/datatable.spanish.json"},
                lengthMenu: [ 12, 24, 48],
                pageLength: 12,
                order: [[ 1, "asc" ]], // Por que campo ordenara al momento de desplegar
                searchDelay: 500,
                processing: true,
                serverSide: true,
                ajax: {
                    url: '{/literal}{$getModule}{literal}&accion=getItemList&accion=getItemList',
                    type: 'POST',
                    data: {},
                },
                columns: [
                    {/literal}
                    {foreach from=$grill_list item=row key=idx}
{*                        {literal}{data: '{/literal}{$row.field}{literal}'} ,{/literal}*}
                    {if $idx != 0},{/if}{literal}{data: '{/literal}{if $row.as}{$row.as}{else}{$row.field}{/if}{literal}'{/literal}{if $row.field == 'Actions'}, responsivePriority: -1{/if}{literal}}{/literal}
                    {/foreach}
                    {literal}
                ],
                columnDefs: [
                    {
                        targets: -1,
                        //width: "110px",
                        className: 'noExport',
                        orderable: false,
                        render: function(data, type, full, meta) {
                            var boton = ''+
                                    {/literal}{if $privFace.editar == 1}{literal}
                                '<a href="javascript:item_update(\''+data+'\');" class="m-portlet__nav-link btn m-btn m-btn--hover-warning m-btn--icon m-btn--icon-only m-btn--pill " title="Editar">'+
                                '<i class="la flaticon-edit-1 m--font-brand"></i>'+
                                '</a>'+
                                    {/literal}{/if}{literal}


                                '';
                            return boton;
                        },
                    },
                    /*
                    {
                        targets: [6],
                        //width: "170px",
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
                        targets: [ 5 ],
                        render: function(data,type,full,meta){
                            return '<span class="m--font-bold m--font-primary">' + data + '</span>';
                        },

                    },
                    */

                ],
            });

        };


        var handle_general_components = function(){
            $('.select2_busqueda').select2({
                placeholder: "Seleccione una opción"
            });

        };

        // var conteo = function (id){
        //     $.get( "{/literal}{$getModule}{literal}",
        //         {accion:"get.conteo",
        //         id:id},
        //         function(res){
        //             console.log(res);
        //         },"json");
        // };


        var filtro_categoria = $("#filtro_categoria");
        var handle_filtro = function () {
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
                if(filtro_id.length>=3 || filtro_id==''){
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
        //conteo();
        $('.m-subheader').addClass('m--hide');
    });




</script>{/literal}