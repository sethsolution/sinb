{literal}
<script>
    var listModule = [];
    var table_list_form;

    var snippet_form_{/literal}{$subcontrol}{literal} = function() {
        "use strict";
        let form = $('#form_{/literal}{$subcontrol}{literal}');
        let btn_submit = $('#form_submit_{/literal}{$subcontrol}{literal}');
        let btn_close = $('#form_close_{/literal}{$subcontrol}{literal}');
        let pmodal = $("#form_modal_{/literal}{$subcontrol}{literal}");
        var formv;
        //var formData;
        /**
         * Antes de enviar el formulario se ejecuta la siguiente funcion
         */
        var showRequest= function(formData, jqForm, op) {
            var res = verify();
            if(res){
                btn_submit.addClass('spinner spinner-white spinner-right').attr('disabled', true);
                btn_close.attr('disabled', true);
            }else{
                Swal.fire({icon: "info", {/literal}title: "{#msg_info_title_nodata#}", html:"{#msg_info_msg_nodata#}"{literal}});
            }
            return res;
        };
        var showResponse = function (res, statusText) {
            coreUyuni.itemFormShowResponse(res,pmodal,table_list);
            btn_close.attr('disabled', false);
            btn_submit.removeClass('spinner spinner-white spinner-right').attr('disabled', false);
        };
        /**
         * Opciones para generar el objeto del formulario
         */
        var options = {
            beforeSubmit:showRequest
            //,dataType:'json'
            , success:  showResponse
            , data: {}
        };
        /**
         * Se da las propiedades de ajaxform al formulario
         */
        var handle_form_submit=function(){
            form.ajaxForm(options);
            formv = FormValidation.formValidation(
                document.getElementById('form_{/literal}{$subcontrol}{literal}'),
                {
                    plugins: {
                        declarative: new FormValidation.plugins.Declarative({html5Input: true,}),
                        trigger: new FormValidation.plugins.Trigger(),
                        bootstrap: new FormValidation.plugins.Bootstrap(),
                        submitButton: new FormValidation.plugins.SubmitButton(),
                    }
                }
            );
        };

        var verify = function(){
            if(listModule.length == 0){
                return false;
            }else{
                return true;
            }
            return false;
        };

        /**
         * Se da las funcionalidades al boton enviar
         */
        var handle_btn_submit = function() {
            btn_submit.click(function(e) {
                e.preventDefault();
                /**
                 * Copiamos los datos de summerNote a una variable
                 */
                //$('#description_input').val($('#description').summernote('code'));

                $('#form_module').val(listModule.toString());

                formv.validate().then(function(status) {
                    if(status === 'Valid'){
                        form.submit();
                    }
                });
            });
        };
        /**
         * Iniciamos los componentes necesarios como , summernote, select2 entre otros
         */
        var handle_components = function(){
            coreUyuni.setComponents();

            $('#input_file').on('change', function() {
                let fileName = $(this).val().split('\\').pop();
                if(fileName!=""){
                    $("#input_file_name").addClass("input-attached-file").html(fileName);
                }
            });
        };

        //== Public Functions
        return {
            // public functions
            init: function() {
                handle_form_submit();
                handle_btn_submit();
                handle_components();
            }
        };
    }();


    var snippet_list_form = function() {
        "use strict";
        var urlsys = '{/literal}{$path_url}/{$subcontrol}_/{$item_id}{literal}';
        var initTable = function() {
            let table_list_var = $('#tabla_{/literal}{$subcontrol}{literal}_form');
            let export_title = "{/literal}{#dataTableExportTitle#}{literal}";
            let noExport = tableSetting.noExport;
            table_list_form = table_list_var.DataTable({
                initComplete: function(settings, json) {
                    table_list_var.removeClass('d-none');
                },
                "drawCallback": function( settings ) {
                    setCheckFunction();
                },
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
                "scrollY": 250,
                ajax: {
                    url: urlsys+'/listform',
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
                        //width: '50px',
                        "visible": false,
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
                        "targets": [ -2 ],
                        width: '70px',
                    },

                    {
                        "targets": [ 0,1 ],
                        "visible": false,
//                        "searchable": false
                    },

                    {
                        targets: [3],
                        order:[0,1,3],
                    },

                    {
                        "targets": [2],
                        width: '35px',
                        className: 'text-center',
                        "searchable": false,
                        "orderable": false,
                        render: function(data,type,full,meta){
                            return getCheckBox(full);
                        },
                    },
                    {
                        targets: 4,
                        orderData: [ 0, 3 ],
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


                ],

            });

        };

        var handle_filtro = function () {

            $('.filtro-buscar-form').change(function(evt, params){
                var filtro_id = $(this).val();
                filtro_id = filtro_id==null? '': filtro_id.toString();
                var i = $(this).data('col-index');
                if(filtro_id==3){filtro_id = '';}
                table_list_form.column(i).search(filtro_id ? filtro_id : '', false, false);
                table_list_form.draw();

            });
        };

        var getCheckBox = function(full){
            var id = full.actions;
            id = id.toString();
            var index = listModule.includes(id);
            var ch = '';
            if(index==true){
                ch = 'checked="checked"';
            }

            let check = '<span><label class="checkbox checkbox-success" style="width:25px;">' +
                '<input type="checkbox" '+ch+' class="changeCheckBoxForm" value="1" id="check_form_'+full.actions+'" name="check_form_'+full.actions+'"  data-id="'+full.actions+'">&nbsp;<span></span>' +
                '</label></span>';
            return check;
        }

        var setCheckFunction = function () {
            $('.changeCheckBoxForm').change(function() {
                if(this.checked) {
                    var value = 1;
                }else{
                    var value = 0;
                }
                var $this = $(this),
                    id = $this.attr('data-id');
                    var index = jQuery.inArray(id, listModule);
                    if( index === -1 ){
                        listModule.push(id);
                    }else{
                        listModule.splice( index, 1 );
                    }
            });
        };

        return {
            //main function to initiate the module
            init: function() {
                initTable();
                handle_filtro();
            },
        };
    }();

    //== Class Initialization
    jQuery(document).ready(function() {
        snippet_list_form.init();
        snippet_form_{/literal}{$subcontrol}{literal}.init();
    });

</script>
{/literal}
