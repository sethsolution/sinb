{literal}
<script>
    var table_list;

    function item_form_{/literal}{$subcontrol}{literal}(id,type){
        var load_url = '{/literal}{$getModule}&accion={$subcontrol}_get.form{literal}&id='+id+'&type='+type+'&item_id={/literal}{$id}{literal}';

        swal({
            title: 'Cargando formulario',
            text: 'Espere unos segundos hasta que cargue el formulario por favor',
            imageUrl: '/images/loading/loading05.gif',
            showConfirmButton: false,
            allowEnterKey: false,
            allowOutsideClick: false,
            allowEscapeKey: false,
        });

        $.get(load_url, function(data) {
            $("#modal-content_{/literal}{$subcontrol}{literal}").html(data);
            swal.close();
            $("#form_modal_{/literal}{$subcontrol}{literal}").modal("show");

        });
    }

    var snippet_button_form = function () {
        var btn_update = $('#btn_form_{/literal}{$subcontrol}{literal}');
        var handle_button_form = function(){
            btn_update.click(function(e){
                e.preventDefault();
                item_form_{/literal}{$subcontrol}{literal}("","new");
            });
        }

        return {
            // public functions
            init: function() {
                handle_button_form();

            }
        };
    }();

    function item_enviar_{/literal}{$subcontrol}{literal}(id){
        swal({
            title: '¿Esta de enviar este documento?',
            text: "Este documento sera enviado y despues no podrá ser modificado hasta su revisión ",
            type: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Si, Enviar!',
            cancelButtonText: "No, cancelar"
        }).then(function(result) {
            if (result.value) {
                item_enviar_action_{/literal}{$subcontrol}{literal}(id);
            }
        });
    }

    function item_enviar_action_{/literal}{$subcontrol}{literal}(id){
        swal({
            title: 'Enviando',
            text: 'Iniciando el proceso de Envio',
            imageUrl: '/images/loading/loading05.gif',
            showConfirmButton: false,
            allowEnterKey: false,
            allowOutsideClick: false,
            allowEscapeKey: false,
        });
        randomnumber=Math.floor(Math.random()*11);
        var url = "{/literal}{$path_url}/{$subcontrol}_/{$id}/{literal}"+id+"/enviar/";
        $.get( url, { random:randomnumber},
            function(res){
                if(res.res == 1){
                    swal.close();
                    swal({position: 'top-center',type: 'success',title: 'El registro fue enviado',showConfirmButton: false,timer: 1000});
                    table_list.draw();
                }else{
                    msg_error = '<strong>Ocurrio error al enviar</strong><br>'+res.msg;
                    if (res.msgdb !== undefined){
                        msg_error += '<br><br><div class="m-alert m-alert--outline alert alert-danger alert-dismissible fade show" role="alert">';
                        msg_error += '<strong>Dato Técnico: </strong>'+res.msgdb+'</div>';
                    }
                    swal({position: 'top-center'
                        ,html:msg_error
                        ,type: 'error'
                        ,title: 'No se puede enviar'});
                }
            },"json");
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
        url= "{/literal}{$path_url}/{$subcontrol}_/{$id}/{literal}"+id+"/descarga/";
        window.open(url, '_blank');
    }

    function itemDeleteAction_{/literal}{$subcontrol}{literal}(id){
        swal({
            title: 'Borrando',
            text: 'Iniciando el proceso de borrado',
            imageUrl: '/images/loading/loading05.gif',
            showConfirmButton: false,
            allowEnterKey: false,
            allowOutsideClick: false,
            allowEscapeKey: false,
        });
        randomnumber=Math.floor(Math.random()*11);
        var url = "{/literal}{$path_url}/{$subcontrol}_/{$id}/{literal}"+id+"/borrar/";
        $.get( url, { random:randomnumber},
            function(res){
                if(res.res == 1){
                    swal.close();
                    swal({position: 'top-center',type: 'success',title: 'El registro fue eliminado',showConfirmButton: false,timer: 1000});
                    table_list.draw();
                    snippet_resumen.resumen();
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
                dom:
                    `<'row'<'col-sm-12 col-md-12 dataTables_pager'lp>>
                <'row'<'col-sm-12'tr>>
                <'row'<'col-sm-12 col-md-5'i>>`,
                // read more: https://datatables.net/examples/basic_init/dom.html
                //language: {"url": "language/datatable.spanish.json?id=3434"},
                language: {"url": "/language/datatable.spanish.json"},
                lengthMenu: [ 10, 25, 50],
                pageLength: 25,
                order: [[ 0, "asc" ]], // Por que campo ordenara al momento de desplegar
                InfoFiltered:     false,
                searchDelay: 500,
                processing: true,
                serverSide: true,
                ajax: {
                    url: '{/literal}{$getModule}&accion={$subcontrol}_lista{literal}&item_id={/literal}{$id}{literal}',
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
                        width: "100px",
                        className: 'noExport',
                        "searchable": false,

                        //orderable: false,
                        render: function(data, type, full, meta) {
                            var boton = '';
                            boton += '<div class="btn-group btn-group-sm " role="group" aria-label="Default button group">';
                            if( full.estado_id == '2'  ){
                                bt_text = "Cambiar Estado";
                            }else{
                                bt_text = "Ver Datos";
                            }
                            boton += '<a href="javascript:item_update_{/literal}{$subcontrol}{literal}(\''+data+'\');" class="btn btn-outline-info" title="'+bt_text+'">'+bt_text+'</a>';
                            boton += '<div>';
                            return boton;
                        },
                    },




                    /**
                     * Nombre de la especie
                     */
                    {
                        targets: [1,2,3],
                        orderable: false,
                        visible: false,
                        //searchable: false
                    },
                    {
                        targets: [4],
                        render: function(data, type, full, meta) {
                            var dato ="";
                            dato += "<strong>Cientifico: </strong>" + data+ "<br>";
                            if(full.especie_id_id==1){
                                dato += "<strong>Común: </strong>"+full.especie_nombre;
                            }else{
                                dato += "<strong>Común: </strong>"+full.especie_id_comun;
                            }
                            return dato;
                        },
                    },

                    /**
                     * Cantidad y Unidad
                     */
                    {
                        targets: [7],
                        orderable: false,
                        visible: false,
                        //searchable: false
                    },
                    {
                        targets: [6],
                        render: function(data, type, full, meta) {
                            var dato ="";
                            dato += "<strong>"+data+ "</strong> ("+full.unidad_id+")";
                            return dato;
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
                        targets: [9],
                        render: function(data, type, full, meta) {
                            console.log(full.Actions);
                            var status = {
                                1: {'title': '', 'state': 'secondary'},
                                2: {'title': '', 'state': 'secondary'},
                                4: {'title': '', 'state': 'secondary'},
                                5: {'title': '', 'state': 'secondary'},
                                3: {'title': 'Observado', 'state': 'danger'}
                            };
                            if (typeof status[data] === 'undefined') {
                                return data;
                            }
                            {/literal}{if $item_padre.estado_id == 3}{literal}
                            dato = '<a href="javascript:item_update_{/literal}{$subcontrol}{literal}(\''+full.Actions+'\');" title="Ver Observación">'+
                                '<i class="fa fa-exclamation text-' + status[data].state + '"></i> <span class="m--font-bold m--font-' + status[data].state + '">' + status[data].title + '</span>' +
                                '</a>';
                            return dato;
                            {/literal}{else} {literal}
                            return '<i class="fa fa-check-circle text-' + status[data].state + '"></i>&nbsp;' +
                                '<span class="m--font-bold m--font-' + status[data].state + '">' + status[data].title + '</span>';
                            {/literal}{/if} {literal}

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
        snippet_button_form.init();
    });




</script>

{/literal}