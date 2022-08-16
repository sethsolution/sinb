{literal}
<script>
    var table_list;

    function item_form_{/literal}{$subcontrol}{literal}(id,type){
        var load_url = '{/literal}{$path_url}/{$subcontrol}_/{$id}{literal}';
        if(type=='update'){
            load_url += '/'+id+'/';
        }else{
            load_url += '/nuevo';
        }

        var msgEspere = 'Espere unos segundos hasta que cargue el formulario por favor'+cargando_vista;
        $("#modal-content_{/literal}{$subcontrol}{literal}").html(msgEspere);
        $("#form_modal_{/literal}{$subcontrol}{literal}").modal("show");

        $.get(load_url, function(data) {
            $("#modal-content_{/literal}{$subcontrol}{literal}").html(data);
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
            html: 'Iniciando el proceso de Envio '+cargando_vista,
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
            html: 'Iniciando el proceso de borrado '+cargando_vista,
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
                    `<'row'<'col-sm-6 text-left'f><'col-sm-12 col-md-6 dataTables_pager'lp>>
                <'row'<'col-sm-12'tr>>
                <'row'<'col-sm-12 col-md-5'i><'col-sm-12 col-md-7 dataTables_pager'lp>>`,
                // read more: https://datatables.net/examples/basic_init/dom.html
                //language: {"url": "language/datatable.spanish.json?id=3434"},
                language: {"url": "/config/language/datatable.spanish.json"},
                lengthMenu: [ 10, 25, 50],
                pageLength: 25,
                order: [[ 0, "asc" ]], // Por que campo ordenara al momento de desplegar
                InfoFiltered:     false,
                searchDelay: 500,
                processing: true,
                serverSide: true,
                ajax: {
                    url: '{/literal}{$path_url}/{$subcontrol}_/{$id}/lista{literal}',
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
                            {/literal}{if $item_padre.estado_id == 1 or $item_padre.estado_id == 3}{literal}
                            boton += '<a href="javascript:item_update_{/literal}{$subcontrol}{literal}(\''+data+'\');" class="btn btn-outline-info" title="Modificar">{/literal}{if $privFace.editar == 1}Editar{else}Ver Datos{/if}{literal}</a>';
                                {/literal}{if $privFace.editar ==1 and $privFace.eliminar == 1}{literal}
                                    boton += '<a href="javascript:item_delete_{/literal}{$subcontrol}{literal}(\''+data+'\');" class="btn btn-outline-danger" title="Eliminar">Eliminar</a>';
                                {/literal}{/if}{literal}
                            {/literal}{/if}{literal}

                            {/literal}{if $item_padre.estado_id == 4}{literal}
                            boton += '<a href="javascript:item_update_{/literal}{$subcontrol}{literal}(\''+data+'\');" class="btn btn-outline-info" title="Modificar">Ver Datos</a>';
                            {/literal}{/if}{literal}
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
                     * Apéndice y Origen
                     */
                    {
                        targets: [7,8],
                        orderable: false,
                        visible: false,
                        //searchable: false
                    },
                    {
                        targets: [6],
                        render: function(data, type, full, meta) {
                            var dato ="";
                            dato += data+ " / "+ full.origen_id_sigla;
                            return dato;
                        },
                    },
                    /**
                     * Cantidad y Unidad
                     */
                    {
                        targets: [10],
                        orderable: false,
                        visible: false,
                        //searchable: false
                    },
                    {
                        targets: [9],
                        render: function(data, type, full, meta) {
                            var dato ="";
                            dato += "<strong>"+data+ "</strong> "+ full.unidad_id;
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