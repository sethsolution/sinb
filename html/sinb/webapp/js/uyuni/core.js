var coreUyuni = function() {
    "use strict";

    var itemUpdateIndex = function (id,type,url) {
        if (type =="new"){
            var url = url+'/new';
        }else{
            var url = url+'/'+id;
        }
        location = url;
    };
    /**
     * itemDeleteAction(id,url)
     * Delete Item Action
     * @param id código del item que se quiere borrar
     * @param url dirección de la acción para borrar
     */
    var itemDeleteAction = function(id,url,tablem){
        Swal.fire({
            title: lngUyuni.deleteActionTitle,
            html: lngUyuni.deleteActionMsg+cargando_vista,
            showConfirmButton: false,
            allowEnterKey: false,
            allowOutsideClick: false,
            allowEscapeKey: false,
        });
        //var url = urlsys+"/"+id+"/borrar";
        $.get( url, {},
            function(res){
                if(res.res == 1){
                    Swal.close();
                    Swal.fire({icon: 'success',title: lngUyuni.deleteActionSucess,showConfirmButton: false,timer: 1000});
                    tablem.ajax.reload();
                }else{
                    //var msg_error = res.msg;
                    var errorname = "lngUyuni.deleteError"+res.type;
                    var msg_error =eval(errorname);
                    if (res.msgdb !== undefined){
                        msg_error += '<div class="alert alert-danger font-size-xs" role="alert">';
                        msg_error += '<strong>'+lngUyuni.technicalData+': </strong>'+res.msgdb+'</div>';
                    }
                    Swal.fire({
                        icon: "error", title: lngUyuni.deleteErrorTitle,
                        html:msg_error, showClass: {popup: 'animate__animated animate__wobble'}
                    });

                }
            },"json");
    };
    /**
     * Borrar un item
     *
     * @param id código del item que se quiere borrar
     * @param url dirección de la acción para borrars
     */
    var itemDelete = function (id,url,tablem) {
        Swal.fire({
            title: lngUyuni.deleteTitle,
            html: lngUyuni.deleteMsg+"<br> <strong>ID : "+id+" </strong> ",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: "<i class='la la-trash'></i> "+lngUyuni.deleteBtnYes,
            cancelButtonText: "<i class='la la-thumbs-down'></i> "+lngUyuni.deleteBtnNo,
            customClass: {
                confirmButton: "btn btn-danger",
                cancelButton: "btn btn-default"
            }
        }).then(function(result) {
            if (result.value) {
                itemDeleteAction(id,url,tablem);
            }
        });
    };

    /**
     * tableFilter
     * inicia formato para los filtros para data table
     */
    var tableFilter = function () {

        $('.filtro-buscar').change(function(evt, params){
            var filtro_id = $(this).val();
            filtro_id = filtro_id==null? '': filtro_id.toString();
            var i = $(this).data('col-index');
            if(filtro_id==0){filtro_id = '';}
            table_list.column(i).search(filtro_id ? filtro_id : '', false, false);
            table_list.draw();

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
            var filtro_id = $(this).val();
            filtro_id = filtro_id==null? '': filtro_id.toString();
            var i = $(this).data('col-index');
            table_list.column(i).search(filtro_id ? filtro_id : '', false, false);
            table_list.draw();
        });
    };
    var setComponents = function () {
        $('.select2_busqueda').select2({
            placeholder: lngUyuni.select2PlaceHolder,
            width: '100%'
        });
        $('.select2_general').select2({
            placeholder: lngUyuni.select2PlaceHolder,
            width: '100%'
        });


        $('.date_general').datepicker({
            autoclose: true,
            todayHighlight: true,
            format: 'dd/mm/yyyy',
            daysOfWeekHighlighted: "0,6",
            templates: {
                leftArrow: '<i class="la la-angle-left"></i>',
                rightArrow: '<i class="la la-angle-right"></i>'
            }
        }).inputmask(undefined, {
            alias: "datetime",
            inputFormat: "dd/mm/yyyy",
            inputmode:"numeric"
        });

        $('.summernote').summernote({
            height: 150,
            toolbar: [
                ['style', ['bold', 'italic', 'underline', 'clear']],
                ['font', ['strikethrough', 'superscript', 'subscript']],
                ['fontsize', ['fontsize']],
                ['color', ['color']],
                ['para', ['ul', 'ol', 'paragraph']],
                ['height', ['height']]
            ]
        });
        $('.number_integer2').number( true, 0 ,'','');
        $('.number_integer').number( true, 0 ,'',',');
        $('.number_decimal').number( true, 2 ,'.',',');

    };

    var previousTab = "";

    var setTabs = function () {
        $('[data-toggle="tabajax"]').click(function(e) {
            //e.preventDefault();
            var $this = $(this),
                loadurl = $this.attr('href'),
                targ = $this.attr('data-target');

            if(previousTab!=""){
                $(previousTab).html('');
            }
            previousTab = targ;

            $(targ).html("<div style='text-align: center;background: #fde19a;'>"+lngUyuni.tabLoading+"</div>");
            Swal.fire({
                title: lngUyuni.tabLoading,
                text: lngUyuni.tabText,
                html: cargando_vista,
                showConfirmButton: false,
                allowEnterKey: false,
                allowOutsideClick: false,
                allowEscapeKey: false
            });

            $.get(loadurl, function(data) {
                $(targ).html(data);
                swal.close();
            });
            $this.tab('show');
            return false;
        });
    };


    var generalShowResponse = function (res,url) {
        if(res.res ==1){
            if(res.accion =='update') {
                Swal.fire({icon: 'success',title: lngUyuni.formShowResponseTitle,showConfirmButton: false,timer: 1000});
            }else{
                location = url+"/"+res.id;
            }
        }else{
            //var msg_error = res.msg;
            var errorname = "lngUyuni.saveError"+res.type;
            var msg_error =eval(errorname);
            if (res.msgdb !== undefined){
                msg_error += '<div class="alert alert-danger font-size-xs" role="alert">';
                msg_error += '<strong>'+lngUyuni.technicalData+': </strong>'+res.msgdb+'</div>';
            }
            Swal.fire({icon: "error", title: lngUyuni.saveErrorTitle, html:msg_error,
                showClass: {popup: 'animate__animated animate__wobble'},
                //hideClass: {popup: 'animate__animated animate__swing'}
            });
        }
    }

    var itemUpdateTabs = function (id,type,url,subcontrol) {
        var load_url = url;
        if(type=='update'){
            load_url += '/'+id+'/';
        }else{
            load_url += '/new';
        }
        let cargando = lngUyuni.loading+'...'+cargando_vista;
        $("#modal-content_"+subcontrol).html(cargando);
        $("#form_modal_"+subcontrol).modal("show");
        $.get(load_url, function(data) {
            $("#modal-content_"+subcontrol).html(data);
        });
    };


    var itemFormShowResponse = function (res,pmodal,tablem) {
        if(res.res ==1){
            pmodal.modal("hide");
            if(tablem!=""){
                tablem.ajax.reload();
            }
            let msge;
            if(res.accion =='update') {
                msge = lngUyuni.formShowResponseUpdate;;
            }else{
                msge = lngUyuni.formShowResponseCreate;;
            }
            Swal.fire({icon: 'success',title: msge,showConfirmButton: false,timer: 1000});
        }else{
            //var msg_error = res.msg;
            var errorname = "lngUyuni.saveError"+res.type;
            var msg_error =eval(errorname);
            if (res.msgdb !== undefined){
                msg_error += '<div class="alert alert-danger font-size-xs" role="alert">';
                msg_error += '<strong>'+lngUyuni.technicalData+': </strong>'+res.msgdb+'</div>';
            }
            Swal.fire({icon: "error", title: lngUyuni.formShowResponseErrorSaveTitle, html:msg_error,
                showClass: {popup: 'animate__animated animate__wobble'}
            });
        }
    }

    return {
        //main function to initiate the module
        init: function() {
        },
        itemUpdateIndex: function(id,type,url){
            itemUpdateIndex(id,type,url);
        },
        itemDelete: function(id,url,tablem){
            itemDelete(id,url,tablem);
        },
        tableFilter: function () {
            tableFilter();
        },
        setComponents: function () {
            setComponents();
        },
        setTabs: function () {
            setTabs();
        },
        generalShowResponse: function (res,url) {
            generalShowResponse(res,url);
        },
        itemUpdateTabs:function (id,type,url,subcontrol) {
            itemUpdateTabs(id,type,url,subcontrol);
        },
        itemFormShowResponse: function (res,pmodal,tablem) {
            itemFormShowResponse(res,pmodal,tablem);
        }
    };

}();

jQuery(document).ready(function() {
    coreUyuni.init();
});

var cargando_vista = '<div class="sk-folding-cube dis-none">' +
    '        <div class="sk-cube1 sk-cube"></div>' +
    '        <div class="sk-cube2 sk-cube"></div>' +
    '        <div class="sk-cube4 sk-cube"></div>' +
    '        <div class="sk-cube3 sk-cube"></div>' +
    '    </div>';

var KTAppSettings = {
    "breakpoints": {
        "sm": 576
        , "md": 768
        , "lg": 992
        , "xl": 1200
        , "xxl": 1400
    },
    "colors": {
        "theme": {
            "base": {
                "white": "#ffffff"
                , "primary": "#3699FF"
                , "secondary": "#E5EAEE"
                , "success": "#1BC5BD"
                , "info": "#8950FC"
                , "warning": "#FFA800"
                , "danger": "#F64E60"
                , "light": "#E4E6EF"
                , "dark": "#181C32"
            },
            "light": {
                "white": "#ffffff"
                , "primary": "#E1F0FF"
                , "secondary": "#EBEDF3"
                , "success": "#C9F7F5"
                , "info": "#EEE5FF"
                , "warning": "#FFF4DE"
                , "danger": "#FFE2E5"
                , "light": "#F3F6F9"
                , "dark": "#D6D6E0"
            },
            "inverse": {
                "white": "#ffffff"
                , "primary": "#ffffff"
                , "secondary": "#3F4254"
                , "success": "#ffffff"
                , "info": "#ffffff"
                , "warning": "#ffffff"
                , "danger": "#ffffff"
                , "light": "#464E5F"
                , "dark": "#ffffff"
            }
        },
        "gray": {
            "gray-100": "#F3F6F9"
            , "gray-200": "#EBEDF3"
            , "gray-300": "#E4E6EF"
            , "gray-400": "#D1D3E0"
            , "gray-500": "#B5B5C3"
            , "gray-600": "#7E8299"
            , "gray-700": "#5E6278"
            , "gray-800": "#3F4254"
            , "gray-900": "#181C32"
        }
    },
    "font-family": "Poppins"
};
var HOST_URL = "";

var tableSetting={
    dom:
        "<'row'<'col-sm-12 col-md-12 dataTables_pager'lp>>" +
        `<'row'<'col-sm-5 text-left'f><'col-sm-7 text-right'B>>
			         <'row'<'col-sm-12'tr>>
                     <'row'<'col-sm-12 col-md-5'i><'col-sm-12 col-md-7 dataTables_pager'lp>>`
    ,noExport : [':visible :not(.noExport)' ]
};