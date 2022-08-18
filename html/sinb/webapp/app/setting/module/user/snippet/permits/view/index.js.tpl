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
                "drawCallback": function( settings ) {
                    //var api = this.api();
                    // Output the data for the visible rows to the browser's console
                    //console.log( api.rows( {page:'current'} ).data() );
                    setCheckFunction();
                },
                /*
                keys: {
                    columns: noExport,
                    clipboard: false,
                },

                 */
                //dom: tableSetting.dom,
                dom:
                    `<'row'<'col-sm-5 text-left'f><'col-sm-7 text-right'l>>
			         <'row'<'col-sm-12'tr>>
                     <'row'<'col-sm-12 col-md-5'i><'col-sm-12 col-md-7 dataTables_pager'p>>`
                ,
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
                pageLength: 25,
                order: [[ 0, "asc" ],[ 1, "asc" ]], // Por que campo ordenara al momento de desplegar
                InfoFiltered: false,
                searchDelay: 500,
                processing: true,
                serverSide: true,
                ajax: {
                    url: urlsys+'/list',
                    type: 'POST',
                    data: {},
                },
                columns: [
                    {/literal}{foreach from=$gridItem item=row key=idx}
                    {if $idx != 0},{/if}{literal}{data: '{/literal}{if $row.as}{$row.as}{else}{$row.field}{/if}{literal}'{/literal}{if $row.responsive}, responsivePriority: -1{/if}{literal}}{/literal}
                    {/foreach}{literal}
                ],
                rowGroup: {
                    dataSrc: ['app','group']
                },
                autoWidth: false,
                columnDefs: [
                    {
                        "targets": -1,
                        width: '50px',
                        className: 'noExport',
                        orderable: false,
                        searchable: false,
                        render: function(data, type, full, meta) {
                            var boton = '';
                            {/literal}{if $privFace.edit ==1 and $privFace.delete == 1}{literal}
                            boton += '<a href="javascript:snippet_list.delete(\''+data+'\');" class="btn btn-icon btn-light-danger btn-sm" title="'+lngUyuni.btnDelete+'"><i class="flaticon-delete-1"></i></a>';
                            {/literal}{/if}{literal}
                            boton += '';
                            return boton;
                        },
                    },
                    {
                        "targets": [ 0,1 ],
                        "visible": false,
                        responsivePriority:7,
                        //"searchable": false
                    },
                    {
                        "targets": [ 4,5,6 ],
                        width: '50px',
                    },

                    {
                        targets: [2],
                        order:[0,1,2],
                    },

                    {
                        targets: 3,
                        orderData: [ 0, 4 ],
                        width: '50px',
                        "orderable": false,
                        "searchable": false,
                        render: function(data, type, full, meta) {

                            var status = {
                                'module': {'title': '{/literal}{#opt_type_1#}{literal}', 'class': ' label-light-primary'},
                                'url': {'title': '{/literal}{#opt_type_2#}{literal}', 'class': ' label-light-success'},
                            };
                            if (typeof status[data] === 'undefined') {
                                return data;
                            }
                            return '<span class="label label-lg font-weight-bold' + status[data].class + ' label-inline">' + status[data].title + '</span>';
                        },
                    },
                    {//añadir
                        targets: [4],
                        "orderable": false,
                        "searchable": false,
                        responsivePriority:2,
                        render: function(data,type,full,meta){
                            return getSwitch(full,1);
                        },
                    },
                    {//editar
                        targets: [5],
                        "orderable": false,
                        "searchable": false,
                        responsivePriority:2,
                        render: function(data,type,full,meta){
                            return getSwitch(full,2);
                        },
                    },
                    {//borrar
                        targets: [6],
                        "orderable": false,
                        "searchable": false,
                        responsivePriority:2,
                        render: function(data,type,full,meta){
                            return getSwitch(full,3);
                        },
                    },
                    {
                        targets: [7],
                        orderData: [0,7],
                        width: '60px',
                        className: '',
                        render: function(data, type, full, meta) {
                            var status = {
                                'false': { 'state': 'metal'},
                                'true': { 'state': 'success'}
                            };
                            if (typeof status[data] === 'undefined') {
                                return data;
                            }
                            return '<div class="text-center"><i class="fa fa-check-double text-' + status[data].state + '"></i></div>';
                        },
                    },
                    {
                        targets: [7,-2,-3],
                        searchable: false,
                    },
                    {
                        targets: [-2,-3],
                        className: "none"
                    },
                    {
                        targets: [-2,-3],
                        render: function(data,type,full,meta){
                            if (data == null){ data = "";}
                            return '<span class="text-primary font-size-xs">' + data+ '</span>';
                        },
                    },


                ],

            });

        };

        /**
         *
         */
        var getSwitch = function(full,type){
            let bt = "";
            let st = "";
            let ch = "";
            switch (type) {
                case 1:
                    st="primary";
                    if(full.add) ch = 'checked="checked"';
                break;
                case 2:
                    st="info";
                    if(full.edit) ch = 'checked="checked"';
                    break;
                case 3:
                    st="danger";
                    if(full.delete) ch = 'checked="checked"';
                    break;
            }
            if(full.type =="module") {

                bt += '<div><span class="switch switch-outline switch-sm switch-icon switch-'+st+'"><label>' +
                    '<input type="checkbox" '+ch+' class="changeCheckBox" id="check_'+full.actions+'_'+type+'" name="check_'+full.actions+'_'+type+'" data-type="'+type+'" data-id="'+full.actions+'"><span></span>'
                '</label></span></div>';
            }
            return bt;
        };

        var setCheckFunction = function () {
            $('.changeCheckBox').change(function() {
                if(this.checked) {
                    var value = 1;
                    var previous  = 0;
                }else{
                    var value = 0;
                    var previous  = 1;
                }
                var $this = $(this),
                    id = $this.attr('data-id'),
                    type = $this.attr('data-type');

                let comp =$("#check_"+id+"_"+type);

                comp.prop( "disabled", true );
                comp.parent("label").addClass('spinner spinner-info spinner-left');

                $.post(urlsys+"/saveCheck",{
                    "user_module_id":id,
                    "permitType":type,
                    "value":value
                }, function(res){
                    comp.parent("label").removeClass('spinner spinner-primary spinner-left');
                    comp.prop( "disabled", false );
                    if(res.res==1){
                        if(!value && type==2) {
                            $("#check_" + id + "_" + 1).prop("checked", false);
                            $("#check_" + id + "_" + 3).prop("checked", false);
                        }
                        if(value && (type==1 || type==3)) {
                            $("#check_" + id + "_" + 2).prop("checked", true);
                        }
                    }else{
                        if(value){
                            comp.prop("checked", false);
                        }else{
                            comp.prop("checked", true);
                        }
                        var msg_error = res.msg;
                        if (res.msgdb !== undefined){
                            msg_error += '<div class="alert alert-danger font-size-xs" role="alert">';
                            msg_error += '<strong>'+lngUyuni.technicalData+': </strong>'+res.msgdb+'</div>';
                        }
                        Swal.fire({icon: "error", title: "Error", html:msg_error,
                            showClass: {popup: 'animate__animated animate__wobble'}
                        });

                    }
                });

            });
        };

        /**
         * Download File
         */
        function download(id){
            var url = urlsys+"/"+id+"/download";
            window.open(url, '_blank');
        }

        /**
         * New and Update
         */
        var btn_update = $('#btn_form_{/literal}{$subcontrol}{literal}');
        var handle_button_update = function(){
            btn_update.click(function(e){
                e.preventDefault();
                item_update("","new");
            });
        };

        var item_update = function(id,type){
            var subcontrol = "{/literal}{$subcontrol}{literal}";
            coreUyuni.itemUpdateTabs(id,type,urlsys,subcontrol);
        };
        /**
         * Delete
         */
        var  item_delete = function(id){
            var url = urlsys+"/"+id+"/delete";
            coreUyuni.itemDelete(id,url,table_list);
        };
        /**
         * Inicializar componentes
         */
        var handle_components = function(){
            coreUyuni.setComponents();
        };
        /**
         * Filtros
         */
        var handle_filtro = function () {
            coreUyuni.tableFilter();
        };

        return {
            //main function to initiate the module
            init: function() {
                handle_button_update();
                initTable();
                handle_components();
                handle_filtro();
            },
            update: function(id,type){
                item_update(id,"update");
            },
            delete: function(id){
                item_delete(id);
            },
            download: function (id) {
                download(id);
            },
        };
    }();

    jQuery(document).ready(function() {
        snippet_list.init();
    });
</script>

{/literal}
