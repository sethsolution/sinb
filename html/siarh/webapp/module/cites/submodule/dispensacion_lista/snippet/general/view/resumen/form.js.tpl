{literal}
<script>
    var table_list1;
    var table_list2;
    var snippet_datatable_tables = function () {
        $.fn.dataTable.Api.register('column().title()', function() {
            return $(this.header()).text().trim();
        });
        var exporta_columnas = [':visible :not(.noExport)' ];
        var initTable1 = function() {
            // begin first table
            table_list1 = $('#tabla_especies').DataTable({
                initComplete: function(settings, json) {
                    $('#tabla_especies').removeClass('m--hide');
                },
                responsive: true,
                keys: {

                    columns: exporta_columnas,
                    clipboard: false,
                },
                colReorder: true,
                //== Pagination settings
                dom: `<'row'>
                <'row'<'col-sm-12'tr>>
                <'row'>`,
                language: {"url": "/language/datatable.spanish.json"},
                lengthMenu: [ 10, 25, 50],
                pageLength: 100,
                order: [[ 0, "asc" ]], // Por que campo ordenara al momento de desplegar
                InfoFiltered:     false,
                searchDelay: 500,
                processing: true,
                columns: [
                ],
                columnDefs: [
                    {
                        targets: 0,
                        width: "100px",
                        className: 'noExport',
                        orderable: false,
                    },
                ],
            });
        };
        var initTable2 = function() {
            // begin first table
            table_list2 = $('#tabla_requisito').DataTable({
                initComplete: function(settings, json) {
                    $('#tabla_requisito').removeClass('m--hide');
                },
                responsive: true,
                keys: {

                    columns: exporta_columnas,
                    clipboard: false,
                },

                colReorder: true,
                //== Pagination settings

                dom: `<'row'>
                <'row'<'col-sm-12'tr>>
                <'row'>`,

                language: {"url": "/language/datatable.spanish.json"},
                lengthMenu: [ 10, 25, 50],
                pageLength: 100,
                order: [[ 0, "asc" ]], // Por que campo ordenara al momento de desplegar
                InfoFiltered:     false,
                searchDelay: 500,
                processing: true,
                columns: [
                ],
                columnDefs: [
                    {
                        targets: 0,
                        width: "100px",
                        className: 'noExport',
                        orderable: false,
                    },
                    {
                        targets: [3],
                        render: function(data,type,full,meta){
                            if(data!=""){
                                valor = data/1024/1024;
                                valor = valor.toFixed(2);
                                dato = '<span class="m--font-bold m--font-accent">' + valor + ' Mb.</span>';
                            }else{
                                dato = "";
                            }
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
                initTable2();
            },

        };

    }();

    var snippet_form_modal = function() {

        var form_modal = $('#form_modal_interface_ver');
        var form_btn_submit = $('#form_modal_submit_ver');
        var form_btn_close = $('#form_modal_close_ver');
        //== Private Functions
        var showRequest= function(formData, jqForm, op) {
            form_btn_submit.addClass('m-loader m-loader--right m-loader--light').attr('disabled', true);
            form_btn_close.attr('disabled', true);
            return true;
        };
        snippet_resumen.resumen();
        var showResponse = function (responseText, statusText) {

            if(responseText.res ==1){
                $("#form_modal_ver").modal("hide");
                //table_list.draw();
                if(responseText.accion =='update') {
                    swal({type: 'success',title: 'Se guardo todo con exito!',
                        showConfirmButton: false,
                        timer: 1000
                    });
                }else{
                    swal({type: 'success',title: 'Se a creado el registro con exito!',
                        showConfirmButton: false,
                        timer: 1000
                    });
                }

                setTimeout(function() {
                    $('#requisitos_tab').trigger('click');
                }, 1500);

            }else{
                form_btn_close.attr('disabled', false);
                form_btn_submit.removeClass('m-loader m-loader--right m-loader--light').attr('disabled', false);

                msg_error = '<strong>Ocurrio error al guardar</strong><br>'+responseText.msg;
                if (responseText.msgdb !== undefined){
                    msg_error += '<br><br><div class="m-alert m-alert--outline alert alert-danger alert-dismissible fade show" role="alert">';
                    msg_error += '<strong>Dato Técnico: </strong>'+responseText.msgdb+'</div>';
                }
                swal({position: 'top-center'
                    ,html:msg_error
                    ,type: 'error'
                    ,title: 'No se puede eliminar'});
            }
        };

        var options = {
            beforeSubmit:showRequest
            , dataType: 'json'
            , success:  showResponse
            , data: {type:'{/literal}{$type}{literal}'}
        };
        var handle_form_modal_submit=function(){
            form_modal.ajaxForm(options);
        };

        var handle_form_modal_btn_submit = function() {

            form_btn_submit.click(function(e) {
                e.preventDefault();
                //var btn = $(this);
                var form = $(this).closest('form');

                if (!form.valid()) {
                    return;
                }

                form_modal.submit();
            });
        };

        var handle_form_modal_components = function(){
            $('.fecha_general').datepicker({
                todayHighlight: true,
                orientation: "bottom left",
                format: 'dd/mm/yyyy',
                templates: {
                    leftArrow: '<i class="la la-angle-left"></i>',
                    rightArrow: '<i class="la la-angle-right"></i>'
                }
            });

            $('.select2_general').select2({
                placeholder: "Seleccione una opción"
            });
            
            $('#input_archivo').on('change', function() {
                let fileName = $(this).val().split('\\').pop();
                if(fileName!=""){
                    $("#archivo_nombre").addClass("archivo").html(fileName);
                }
            });
        };

        return {
            init: function() {
                handle_form_modal_btn_submit();
                handle_form_modal_submit();
                handle_form_modal_components();
                {/literal}
                {if $item.itemId == "" and $type == "update"}
                {literal}
                msg_error();
                {/literal}
                {/if}
                {literal}
            }
        };
    }();
    jQuery(document).ready(function() {
        snippet_form_modal.init();
        snippet_datatable_tables.init();
    });

</script>
{/literal}