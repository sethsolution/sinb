{literal}
<script>

    var snippet_tab_item = function () {
        var borra_contenido_tabs = function () {
            {/literal}
            {foreach from=$menu_tab item=row key=idx}
            $("#{$row.id_name}_pane").html("");
            {/foreach}
            {literal}
        };
        var handler_tab_build = function(){
            $('[data-toggle="tabajax"]').click(function(e) {
                //e.preventDefault();
                var $this = $(this),
                    loadurl = $this.attr('href'),
                    targ = $this.attr('data-target');
                //Vaciamos el tab
                borra_contenido_tabs();
                $(targ).html(" Cargando su solicitud... ");
                swal({
                    title: 'Cargando su solicitud!',
                    text: 'Procesando datos',
                    imageUrl: '/images/loading/loading05.gif',
                    showConfirmButton: false,
                    allowEnterKey: false,
                    allowOutsideClick: false,
                    allowEscapeKey: false,
                })

                $.get(loadurl, function(data) {
                    $(targ).html(data);
                    swal.close();
                });
                snippet_resumen.resumen();

                $this.tab('show');
                return false;
            });
        }
        return {
            init: function() {
                handler_tab_build();
            }
        };
    }();


{/literal}{if $type == "update"}{literal}
    var snippet_resumen = function () {
        var resumen = function (){

            url = '{/literal}{$getModule}&accion=resumen&item_id={$id}{literal}';
            $.get( url, {},
                function(res){
                    $("#pais_exportador").html(res.paisexportador);


                    $("#obs_form2").removeClass("m--font-info").removeClass("m--font-danger");
                    if(res.obs_form2==0){
                        $("#obs_form2").addClass("m--font-info");
                    }else{
                        $("#obs_form2").addClass("m--font-danger");
                    }
                    $("#obs_form2").html(new Intl.NumberFormat('en-US',{ minimumFractionDigits: 0 }).format(res.obs_form2));

                    $("#obs_requisitos").removeClass("m--font-info").removeClass("m--font-danger");
                    if(res.obs_requisitos==0){
                        $("#obs_requisitos").addClass("m--font-info");
                    }else{
                        $("#obs_requisitos").addClass("m--font-danger");
                    }
                    $("#obs_requisitos").html(new Intl.NumberFormat('en-US',{ minimumFractionDigits: 0 }).format(res.obs_requisitos));

                     /**
                     * Verificamos los botones
                     */
                    {/literal}{if $item.estado_id == 2}{literal}
                    if(res.obs_total==0){
                        $("#obs_cuadro").addClass("m--hide");
                        $("#btn_obs_enviar").addClass("m--hide");
                        $("#btn_aprobar").removeClass("m--hide");
                    }else{
                        $("#obs_cuadro").removeClass("m--hide");
                        $("#btn_obs_enviar").removeClass("m--hide");
                        $("#btn_aprobar").addClass("m--hide");
                    }
                    {/literal}{/if}{literal}


                },"json");
        };
        return {
            init: function() {
                resumen();
            },
            resumen:function() {
                resumen();
            },
        };
    }();


    var snippet_item = function () {

        var btn_enviar = $('#btn_enviar');
        var btn_imprime = $('#btn_imprime');
        var btn_ver = $('#btn_ver');

        var btn_obs_enviar = $('#btn_obs_enviar');
        var btn_aprobar = $('#btn_aprobar');


        /**
         * Envio la aprobación btn_aprobar
         */
        var aprobar_accion = function () {
            swal({
                title: 'Enviando',
                html: cargando_vista,
                showConfirmButton: false,
                allowEnterKey: false,
                allowOutsideClick: false,
                allowEscapeKey: false,
            });
            var url = '{/literal}{$getModule}{literal}';
            $.get( url,{
                    accion:"enviar.aprobar"
                    ,'item[item_id]':{/literal}{$id}{literal}
                },
                function(res){
                    btn_aprobar.removeClass('m-loader m-loader--right m-loader--light').attr('disabled', false);
                    if(res.res == 1){
                        swal.close();
                        swal({position: 'top-center',type: 'success',title: 'La solicitud de Marcas de seguridad fue aprobada.',showConfirmButton: false,timer: 1500});
                        location = "{/literal}{$getModule}{literal}&accion=itemUpdate&id={/literal}{$path_url}{$id}{literal}&type=update";
                    }else if(res.res ==3){
                        msg_error = '<span style="color:red;"><strong>Datos faltantes</strong><br></span>'+res.msg;

                        swal({position: 'top-center'
                            ,html:msg_error
                            ,type: 'error'
                            ,title: 'No se puede enviar la aprobación'});
                    }else{
                        msg_error = '<strong>Ocurrio error al guardar</strong><br>'+res.msg;
                        if (res.msgdb !== undefined){
                            msg_error += '<br><br><div class="m-alert m-alert--outline alert alert-danger alert-dismissible fade show" role="alert">';
                            msg_error += '<strong>Dato Técnico: </strong>'+res.msgdb+'</div>';
                        }
                        swal({position: 'top-center'
                            ,html:msg_error
                            ,type: 'error'
                            ,title: 'No se puede enviar la aprobación'});
                    }
                },"json");
        };

        var aprobar = function (){
            swal({
                title: '¿Esta seguro de aprobar la solicitud?',
                html: 'Recuerde que una vez aprobada la solicitud, se enviara un correo de aprobación al usuario y  <br>'+
                    '<span style="color:red;"><strong>no podrá realizar alguna modificación </strong></span>',
                type: 'warning',
                showCancelButton: true,
                confirmButtonText: '¡Si, Enviar!',
                cancelButtonText: "No, Cancelar"
            }).then(function(result) {
                if (result.value) {
                    aprobar_accion();
                }else{
                    btn_aprobar.removeClass('m-loader m-loader--right m-loader--light').attr('disabled', false);
                }
            });
        };
        var boton_aprobar = function () {
            btn_aprobar.click(function(e) {
                e.preventDefault();
                btn_aprobar.addClass('m-loader m-loader--right m-loader--light').attr('disabled', true);
                aprobar();
            });
        };


        /**
         * Boton de previsualización
         */
        var boton_ver = function () {
            btn_ver.click(function(e) {
                e.preventDefault();
                var url = "{/literal}{$getModule}&accion=general_ver&id={$id}{literal}";
                swal({
                    title: 'Cargando formulario',
                    text: 'Espere unos segundos hasta que carge el formulario por favor',
                    imageUrl: '/images/loading/loading05.gif',
                    showConfirmButton: false,
                    allowEnterKey: false,
                    allowOutsideClick: false,
                    allowEscapeKey: false,
                });

                $.get(url, function(data) {
                    $("#modal-content_ver").html(data);
                    swal.close();

                    $("#form_modal_ver").modal("show");
                });
            });
        };
        var boton_imprime = function () {
            btn_imprime.click(function(e) {
                e.preventDefault();
                randomnumber=Math.floor(Math.random()*11);
                url = "{/literal}{$getModule}&accion=imprime&rand="+randomnumber+"&item_id={$id}{literal}";
                console.log (url);
                window.open(url,'impresion_cites_fiv');
            });
        };

        /**
         * Boton de enviar
         */
        var enviar = function (){

            swal({
                title: '¿Esta seguro de Enviar la solicitud de certificado CITES?',
                html: 'Recuerde que una vez enviado la solicitud  <br>'+
                    '<span style="color:red;"><strong>no podrá realizar alguna modificación </strong></span>',
                type: 'warning',
                showCancelButton: true,
                confirmButtonText: '¡Si, Enviar!',
                cancelButtonText: "No, Cancelar"
            }).then(function(result) {
                if (result.value) {
                    enviar_accion();
                }else{
                    btn_enviar.removeClass('m-loader m-loader--right m-loader--light').attr('disabled', false);
                }
            });
        };

        var enviar_accion = function () {
            swal({
                title: 'Enviando',
                html: cargando_vista,
                showConfirmButton: false,
                allowEnterKey: false,
                allowOutsideClick: false,
                allowEscapeKey: false,
            });

            var url = '{/literal}{$path_url}/{$id}/enviar/{literal}';
            $.get( url,{},
                function(res){
                    btn_enviar.removeClass('m-loader m-loader--right m-loader--light').attr('disabled', false);
                    if(res.res == 1){
                        swal.close();
                        swal({position: 'top-center',type: 'success',title: 'El cite fue enviado',showConfirmButton: false,timer: 2000});

                        location = "{/literal}{$path_url}/{$id}/{literal}";

                    }else if(res.res ==3){
                        msg_error = '<span style="color:red;"><strong>Datos faltantes</strong><br></span>'+res.msg;

                        swal({position: 'top-center'
                            ,html:msg_error
                            ,type: 'error'
                            ,title: 'No se puede enviar la solicitud'});
                    }else{
                        msg_error = '<strong>Ocurrio error al guardar</strong><br>'+res.msg;
                        if (res.msgdb !== undefined){
                            msg_error += '<br><br><div class="m-alert m-alert--outline alert alert-danger alert-dismissible fade show" role="alert">';
                            msg_error += '<strong>Dato Técnico: </strong>'+res.msgdb+'</div>';
                        }
                        swal({position: 'top-center'
                            ,html:msg_error
                            ,type: 'error'
                            ,title: 'No se puede enviar la solicitud'});
                    }
                },"json");
        };

        var boton_enviar = function () {

            btn_enviar.click(function(e) {
                e.preventDefault();
                btn_enviar.addClass('m-loader m-loader--right m-loader--light').attr('disabled', true);
                enviar();

            });
        };



        /**
         * Envio de observaciones
         */
        var enviar_obs_accion = function () {
            swal({
                title: 'Enviando',
                html: cargando_vista,
                showConfirmButton: false,
                allowEnterKey: false,
                allowOutsideClick: false,
                allowEscapeKey: false,
            });
            var url = '{/literal}{$getModule}{literal}';;
            $.get( url,{
                    accion:"enviar.obs"
                    ,'item[item_id]':{/literal}{$id}{literal}
                },
                function(res){
                    btn_obs_enviar.removeClass('m-loader m-loader--right m-loader--light').attr('disabled', false);
                    if(res.res == 1){
                        swal.close();
                        swal({position: 'top-center',type: 'success',title: 'El usuario fue observado',showConfirmButton: false,timer: 1000});
                        location = "{/literal}{$getModule}{literal}&accion=itemUpdate&id={/literal}{$path_url}{$id}{literal}&type=update";
                    }else if(res.res ==3){
                        msg_error = '<span style="color:red;"><strong>Datos faltantes</strong><br></span>'+res.msg;

                        swal({position: 'top-center'
                            ,html:msg_error
                            ,type: 'error'
                            ,title: 'No se puede enviar la observación'});
                    }else{
                        msg_error = '<strong>Ocurrio error al guardar</strong><br>'+res.msg;
                        if (res.msgdb !== undefined){
                            msg_error += '<br><br><div class="m-alert m-alert--outline alert alert-danger alert-dismissible fade show" role="alert">';
                            msg_error += '<strong>Dato Técnico: </strong>'+res.msgdb+'</div>';
                        }
                        swal({position: 'top-center'
                            ,html:msg_error
                            ,type: 'error'
                            ,title: 'No se puede enviar la observación'});
                    }
                },"json");
        };

        var enviar_obs = function (){

            swal({
                title: '¿Esta seguro de Enviar las observaciones?',
                html: 'Recuerde que una vez enviado las observaciones, se enviara un email al usuario y  <br>'+
                    '<span style="color:red;"><strong>no podrá realizar alguna modificación </strong></span>',
                type: 'warning',
                showCancelButton: true,
                confirmButtonText: '¡Si, Enviar!',
                cancelButtonText: "No, Cancelar"
            }).then(function(result) {
                if (result.value) {
                    enviar_obs_accion();
                }else{
                    btn_obs_enviar.removeClass('m-loader m-loader--right m-loader--light').attr('disabled', false);
                }
            });
        };
        var boton_enviar_obs = function () {
            btn_obs_enviar.click(function(e) {
                e.preventDefault();
                btn_obs_enviar.addClass('m-loader m-loader--right m-loader--light').attr('disabled', true);
                enviar_obs();
            });
        };

        
        return {
            init: function() {
                boton_enviar_obs();
                boton_aprobar();

                boton_enviar();
                boton_imprime();
                boton_ver();
            },
            enviar:function(){
                enviar();
            }
        };
    }();

    {/literal}{/if}{literal}

    jQuery(document).ready(function() {
        snippet_tab_item.init();
        $('#{/literal}{$menu_tab_active}{literal}_tab').trigger('click');
        $('#tabs_principal').removeClass('m--hide');

        {/literal}{if $type == "update"}{literal}
        snippet_resumen.init();
        snippet_item.init();
        {/literal}{/if}{literal}
    });
</script>
{/literal}

