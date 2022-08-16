{literal}
<script>
    var table_list;

    function item_form_{/literal}{$subcontrol}{literal}(id,type){
        console.log(id);
        var load_url = '{/literal}{$getModule}&accion={$subcontrol}_get.form{literal}&id='+id+'&type='+type+'&item_id={/literal}{$id}{literal}';

        swal({
            title: 'Cargando formulario',
            html: 'Espere unos segundos hasta que carge el formulario por favor<br>'+cargando_vista,
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
            html: 'Iniciando el proceso de Envio<br>'+cargando_vista,
            showConfirmButton: false,
            allowEnterKey: false,
            allowOutsideClick: false,
            allowEscapeKey: false,
        });
        randomnumber=Math.floor(Math.random()*11);
        var url = "{/literal}{$path_url}/{$subcontrol}_/{literal}"+id+"/enviar/";
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


    function item_update_{/literal}{$subcontrol}{literal}(id){
        item_form_{/literal}{$subcontrol}{literal}(id,"update");
    }
    function item_descarga_{/literal}{$subcontrol}{literal}(id){
        url= '{/literal}{$getModule}&accion={$subcontrol}_descarga{literal}&id='+id+'&item_id={/literal}{$id}{literal}',
        window.open(url, '_blank');
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
                <'row'<'col-sm-12 col-md-5'i><'col-sm-12 col-md-7 dataTables_pager'lp>>`,
                // read more: https://datatables.net/examples/basic_init/dom.html
                //language: {"url": "language/datatable.spanish.json?id=3434"},
                language: {"url": "language/datatable.spanish.json?id=3434"},
                lengthMenu: [ 10, 25, 50],
                pageLength: 25,
                order: [[ 1, "asc" ]], // Por que campo ordenara al momento de desplegar
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
                        {literal}{data: '{/literal}{if $row.as}{$row.as}{else}{$row.field}{/if}{literal}'} ,{/literal}
                    {/foreach}
                    {literal}
                ],
                columnDefs: [
                    {
                        targets: 0,
                        width: "100px",
                        className: 'noExport',
                        orderable: false,
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
                    {
                        targets: [6],
                        render: function(data, type, full, meta) {
                            var status = {
                                1: {'title': '', 'state': 'secondary'},
                                3: {'title': '', 'state': 'secondary'},
                                4: {'title': 'SI', 'state': 'success'},
                                5: {'title': '', 'state': ''},
                                2: {'title': 'SI', 'state': 'success'}
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
                        targets: [7],
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
                        targets: [8],
                        render: function(data, type, full, meta) {
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
                            dato = '<a href="javascript:item_update_{/literal}{$subcontrol}{literal}(\''+full.Actions+'\');" title="Ver Observación">'+
                                '<i class="fa fa-exclamation text-' + status[data].state + '"></i> <span class="m--font-bold m--font-' + status[data].state + '">' + status[data].title + '</span>' +
                                '</a>';
                            return dato;

                        },
                    },
                    {
                        targets: [4],
                        className:"text-right",
                        render: function(data,type,full,meta){
                            return '<span style="color:#27780f;" class="m--font-bold">' + new Intl.NumberFormat('en-US',{ minimumFractionDigits: 2 }).format(data) + ' </span>';
                        },
                    },

                    {
                        targets: [5],
                        render: function(data,type,full,meta){
                            dato = '<a href="javascript:item_descarga_{/literal}{$subcontrol}{literal}(\''+full.Actions+'\');"  title="Descargar">'+
                                '<i class="flaticon-tool-1"></i> '+ data +
                                '</a>';
                            return dato;
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